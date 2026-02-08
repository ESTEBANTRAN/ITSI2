<?php declare(strict_types=1);

namespace App\Controllers;

use App\Models\RolModel;
use App\Models\UsuarioModel;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

/**
 * Class SuperAdminController
 * Controlador para el Super Administrador del sistema
 */
final class SuperAdminController extends Controller
{
    protected $request;
    protected $helpers = ['form', 'url'];
    protected $rolModel;
    protected $usuarioModel;

    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);
        
        // Verificar que sea super admin
        if (session('rol_id') != 1) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Acceso denegado');
        }
        
        $this->rolModel = new RolModel();
        $this->usuarioModel = new UsuarioModel();
    }

    /**
     * Dashboard principal del super admin
     */
    public function index(): string
    {
        $data = [
            'titulo' => 'Dashboard Super Admin',
            'total_usuarios' => $this->usuarioModel->countAll(),
            'total_roles' => $this->rolModel->countAll(),
            'estadisticas_roles' => $this->rolModel->getEstadisticasRoles(),
            'usuarios_recientes' => $this->usuarioModel->orderBy('fecha_registro', 'DESC')->limit(10)->findAll()
        ];
        
        return view('SuperAdmin/dashboard', $data);
    }

    /**
     * Gestión de roles (solo informativa)
     */
    public function gestionRoles(): string
    {
        $data = [
            'titulo' => 'Gestión de Roles',
            'roles' => $this->rolModel->findAll(),
            'estadisticas_roles' => $this->rolModel->getEstadisticasRoles()
        ];
        
        return view('SuperAdmin/gestion_roles', $data);
    }

    /**
     * Ver detalles de un rol específico
     */
    public function verRol(int $rolId): string
    {
        $rol = $this->rolModel->getRolById($rolId);
        
        if (!$rol) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Rol no encontrado');
        }
        
        $data = [
            'titulo' => 'Detalles del Rol: ' . $rol['nombre'],
            'rol' => $rol,
            'usuarios' => $this->rolModel->getUsuariosPorRol($rolId),
            'total_usuarios' => $this->rolModel->contarUsuariosPorRol($rolId)
        ];
        
        return view('SuperAdmin/ver_rol', $data);
    }

    /**
     * Gestión de usuarios
     */
    public function gestionUsuarios(): string
    {
        $data = [
            'titulo' => 'Gestión de Usuarios',
            'usuarios' => $this->usuarioModel->getUsuariosConRol(),
            'roles' => $this->rolModel->findAll()
        ];
        
        return view('SuperAdmin/gestion_usuarios', $data);
    }

    /**
     * Ver detalles de un usuario específico
     */
    public function verUsuario(int $usuarioId): string
    {
        $usuario = $this->usuarioModel->getUsuarioConRol($usuarioId);
        
        if (!$usuario) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Usuario no encontrado');
        }
        
        $data = [
            'titulo' => 'Detalles del Usuario: ' . $usuario['nombre'] . ' ' . $usuario['apellido'],
            'usuario' => $usuario,
            'rol' => $this->rolModel->getRolById($usuario['rol_id'])
        ];
        
        return view('SuperAdmin/ver_usuario', $data);
    }

    /**
     * Cambiar estado de un usuario
     */
    public function cambiarEstadoUsuario(): ResponseInterface
    {
        try {
            $usuarioId = $this->request->getPost('usuario_id');
            $nuevoEstado = $this->request->getPost('nuevo_estado');
            
            if (!in_array($nuevoEstado, ['Activo', 'Inactivo', 'Suspendido'])) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Estado no válido'
                ]);
            }
            
            $usuario = $this->usuarioModel->find($usuarioId);
            if (!$usuario) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Usuario no encontrado'
                ]);
            }
            
            // No permitir cambiar estado del super admin
            if ($usuario['rol_id'] == 1) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'No se puede cambiar el estado del Super Admin'
                ]);
            }
            
            $this->usuarioModel->update($usuarioId, ['estado' => $nuevoEstado]);
            
            log_message('info', "Super Admin cambió estado del usuario {$usuarioId} a {$nuevoEstado}");
            
            return $this->response->setJSON([
                'success' => true,
                'message' => 'Estado del usuario actualizado correctamente'
            ]);
            
        } catch (\Exception $e) {
            log_message('error', 'Error cambiando estado de usuario: ' . $e->getMessage());
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Error del sistema'
            ]);
        }
    }

    /**
     * Cambiar rol de un usuario
     */
    public function cambiarRolUsuario(): ResponseInterface
    {
        try {
            $usuarioId = $this->request->getPost('usuario_id');
            $nuevoRolId = (int) $this->request->getPost('nuevo_rol_id');
            
            $usuario = $this->usuarioModel->find($usuarioId);
            if (!$usuario) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Usuario no encontrado'
                ]);
            }
            
            // No permitir cambiar rol del super admin
            if ($usuario['rol_id'] == 1) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'No se puede cambiar el rol del Super Admin'
                ]);
            }
            
            // Verificar que el nuevo rol existe
            $nuevoRol = $this->rolModel->find($nuevoRolId);
            if (!$nuevoRol) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Rol no válido'
                ]);
            }
            
            $this->usuarioModel->update($usuarioId, ['rol_id' => $nuevoRolId]);
            
            log_message('info', "Super Admin cambió rol del usuario {$usuarioId} a {$nuevoRolId}");
            
            return $this->response->setJSON([
                'success' => true,
                'message' => 'Rol del usuario actualizado correctamente'
            ]);
            
        } catch (\Exception $e) {
            log_message('error', 'Error cambiando rol de usuario: ' . $e->getMessage());
            return $this->response->setJSON([
                'success' => false,
                    'message' => 'Error del sistema'
            ]);
        }
    }

    /**
     * Reportes del sistema
     */
    public function reportes(): string
    {
        $data = [
            'titulo' => 'Reportes del Sistema',
            'estadisticas_generales' => $this->getEstadisticasGenerales(),
            'estadisticas_roles' => $this->rolModel->getEstadisticasRoles()
        ];
        
        return view('SuperAdmin/reportes', $data);
    }

    /**
     * Configuración del sistema
     */
    public function configuracion(): string
    {
        $data = [
            'titulo' => 'Configuración del Sistema'
        ];
        
        return view('SuperAdmin/configuracion', $data);
    }

    /**
     * Obtener estadísticas generales del sistema
     */
    private function getEstadisticasGenerales(): array
    {
        $db = \Config\Database::connect();
        
        return [
            'total_usuarios' => $this->usuarioModel->countAll(),
            'usuarios_activos' => $this->usuarioModel->where('estado', 'Activo')->countAllResults(),
            'usuarios_inactivos' => $this->usuarioModel->where('estado !=', 'Activo')->countAllResults(),
            'total_roles' => $this->rolModel->countAll(),
            'roles_activos' => $this->rolModel->where('estado', 'Activo')->countAllResults()
        ];
    }
}
