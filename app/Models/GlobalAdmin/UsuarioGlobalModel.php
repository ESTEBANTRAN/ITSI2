<?php

namespace App\Models\GlobalAdmin;

use CodeIgniter\Model;

class UsuarioGlobalModel extends Model
{
    protected $table = 'usuarios';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $useTimestamps = true;
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    protected $allowedFields = [
        'rol_id',
        'nombre',
        'apellido',
        'cedula',
        'email',
        'password_hash',
        'telefono',
        'direccion',
        'carrera',
        'semestre',
        'foto_perfil',
        'estado',
        'ultimo_acceso',
        'intentos_login',
        'bloqueado_hasta'
    ];

    /**
     * Obtiene usuarios con información de roles
     */
    public function getUsuariosConRoles()
    {
        return $this->select('usuarios.*, roles.nombre as nombre_rol')
                    ->join('roles', 'roles.id = usuarios.rol_id')
                    ->orderBy('usuarios.created_at', 'DESC')
                    ->findAll();
    }

    /**
     * Obtiene usuarios por rol
     */
    public function getUsuariosPorRol($rol_id)
    {
        return $this->where('rol_id', $rol_id)->findAll();
    }

    /**
     * Obtiene usuarios activos
     */
    public function getUsuariosActivos()
    {
        return $this->where('estado', 'Activo')->findAll();
    }

    /**
     * Obtiene usuarios bloqueados
     */
    public function getUsuariosBloqueados()
    {
        return $this->where('estado', 'Bloqueado')->findAll();
    }

    /**
     * Bloquea un usuario
     */
    public function bloquearUsuario($id, $motivo = '')
    {
        return $this->update($id, [
            'estado' => 'Bloqueado',
            'bloqueado_hasta' => date('Y-m-d H:i:s', strtotime('+24 hours')),
            'intentos_login' => 0
        ]);
    }

    /**
     * Desbloquea un usuario
     */
    public function desbloquearUsuario($id)
    {
        return $this->update($id, [
            'estado' => 'Activo',
            'bloqueado_hasta' => null,
            'intentos_login' => 0
        ]);
    }

    /**
     * Cambia el rol de un usuario
     */
    public function cambiarRol($id, $nuevo_rol_id)
    {
        return $this->update($id, ['rol_id' => $nuevo_rol_id]);
    }

    /**
     * Obtiene estadísticas de usuarios
     */
    public function getEstadisticasUsuarios()
    {
        $stats = [];
        
        // Total de usuarios por rol
        $roles = $this->db->table('roles')->get()->getResultArray();
        foreach ($roles as $rol) {
            $stats['por_rol'][$rol['nombre']] = $this->where('rol_id', $rol['id'])->countAllResults();
        }
        
        // Usuarios activos vs bloqueados
        $stats['activos'] = $this->where('estado', 'Activo')->countAllResults();
        $stats['bloqueados'] = $this->where('estado', 'Bloqueado')->countAllResults();
        
        // Usuarios nuevos este mes
        $stats['nuevos_mes'] = $this->where('created_at >=', date('Y-m-01'))->countAllResults();
        
        return $stats;
    }

    /**
     * Busca usuarios por término
     */
    public function buscarUsuarios($termino)
    {
        return $this->select('usuarios.*, roles.nombre as nombre_rol')
                    ->join('roles', 'roles.id = usuarios.rol_id')
                    ->groupStart()
                        ->like('usuarios.nombre', $termino)
                        ->orLike('usuarios.apellido', $termino)
                        ->orLike('usuarios.email', $termino)
                        ->orLike('usuarios.cedula', $termino)
                    ->groupEnd()
                    ->findAll();
    }

    /**
     * Obtiene actividad reciente de usuarios
     */
    public function getActividadReciente($limite = 10)
    {
        return $this->select('usuarios.id, usuarios.nombre, usuarios.apellido, usuarios.ultimo_acceso, roles.nombre as rol')
                    ->join('roles', 'roles.id = usuarios.rol_id')
                    ->where('usuarios.ultimo_acceso IS NOT NULL')
                    ->orderBy('usuarios.ultimo_acceso', 'DESC')
                    ->limit($limite)
                    ->findAll();
    }

    /**
     * Actualiza último acceso
     */
    public function actualizarUltimoAcceso($id)
    {
        return $this->update($id, ['ultimo_acceso' => date('Y-m-d H:i:s')]);
    }

    /**
     * Incrementa intentos de login
     */
    public function incrementarIntentosLogin($id)
    {
        $usuario = $this->find($id);
        $intentos = ($usuario['intentos_login'] ?? 0) + 1;
        
        $data = ['intentos_login' => $intentos];
        
        // Bloquear después de 5 intentos
        if ($intentos >= 5) {
            $data['estado'] = 'Bloqueado';
            $data['bloqueado_hasta'] = date('Y-m-d H:i:s', strtotime('+1 hour'));
        }
        
        return $this->update($id, $data);
    }

    /**
     * Resetea intentos de login
     */
    public function resetearIntentosLogin($id)
    {
        return $this->update($id, [
            'intentos_login' => 0,
            'estado' => 'Activo',
            'bloqueado_hasta' => null
        ]);
    }

    /**
     * Obtiene usuarios con información de roles y paginación
     */
    public function getUsuariosConRolesPaginados($page = 1, $perPage = 30, $search = '')
    {
        $offset = ($page - 1) * $perPage;
        
        // Debug: Log de parámetros
        log_message('info', 'UsuarioGlobalModel::getUsuariosConRolesPaginados - Page: ' . $page . ', PerPage: ' . $perPage . ', Search: "' . $search . '"');
        
        // Construir la consulta base
        $builder = $this->db->table('usuarios');
        $builder->select('usuarios.*, roles.nombre as nombre_rol');
        $builder->join('roles', 'roles.id = usuarios.rol_id');
        
        // Aplicar búsqueda si se proporciona
        if (!empty($search)) {
            log_message('info', 'UsuarioGlobalModel::getUsuariosConRolesPaginados - Aplicando búsqueda: "' . $search . '"');
            $builder->groupStart();
            $builder->like('usuarios.nombre', $search);
            $builder->orLike('usuarios.apellido', $search);
            $builder->orLike('usuarios.email', $search);
            $builder->orLike('usuarios.cedula', $search);
            $builder->orLike('roles.nombre', $search);
            $builder->groupEnd();
        }
        
        // Obtener el total de registros (sin LIMIT)
        $totalQuery = $this->db->table('usuarios');
        $totalQuery->select('COUNT(*) as total');
        $totalQuery->join('roles', 'roles.id = usuarios.rol_id');
        
        if (!empty($search)) {
            $totalQuery->groupStart();
            $totalQuery->like('usuarios.nombre', $search);
            $totalQuery->orLike('usuarios.apellido', $search);
            $totalQuery->orLike('usuarios.email', $search);
            $totalQuery->orLike('usuarios.cedula', $search);
            $totalQuery->orLike('roles.nombre', $search);
            $totalQuery->groupEnd();
        }
        
        $totalResult = $totalQuery->get()->getRow();
        $total = $totalResult->total;
        
        // Debug: Log del total
        log_message('info', 'UsuarioGlobalModel::getUsuariosConRolesPaginados - Total usuarios en búsqueda: ' . $total);
        
        // Obtener los usuarios con LIMIT
        $builder->orderBy('usuarios.created_at', 'DESC');
        $builder->limit($perPage, $offset);
        $usuarios = $builder->get()->getResultArray();
        
        // Debug: Log de usuarios encontrados
        log_message('info', 'UsuarioGlobalModel::getUsuariosConRolesPaginados - Usuarios encontrados en esta página: ' . count($usuarios));
        
        return [
            'usuarios' => $usuarios,
            'total' => $total,
            'per_page' => $perPage,
            'current_page' => $page,
            'total_pages' => ceil($total / $perPage),
            'search' => $search
        ];
    }

    /**
     * Obtiene todos los usuarios con roles para exportar
     */
    public function getTodosLosUsuariosConRoles()
    {
        return $this->select('usuarios.*, roles.nombre as nombre_rol')
                    ->join('roles', 'roles.id = usuarios.rol_id')
                    ->orderBy('usuarios.created_at', 'DESC')
                    ->findAll();
    }
} 