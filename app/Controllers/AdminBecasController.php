<?php

namespace App\Controllers;

use App\Models\BecaModel;
use App\Models\SolicitudBecaModel;
use App\Models\PeriodoAcademicoModel;
use App\Models\CarreraModel;

class AdminBecasController extends BaseController
{
    protected $becaModel;
    protected $solicitudBecaModel;
    protected $periodoModel;
    protected $carreraModel;

    public function __construct()
    {
        $this->becaModel = new BecaModel();
        $this->solicitudBecaModel = new SolicitudBecaModel();
        $this->periodoModel = new PeriodoAcademicoModel();
        $this->carreraModel = new CarreraModel();
    }

    /**
     * Vista principal de gestión de becas
     */
    public function index()
    {
        $data = [
            'titulo' => 'Gestión de Becas',
            'estadisticas' => $this->becaModel->getEstadisticasBecas(),
            'periodos' => $this->periodoModel->findAll(),
            'carreras' => $this->carreraModel->findAll()
        ];

        return view('AdminBecas/index', $data);
    }

    /**
     * Listar todas las becas
     */
    public function listarBecas()
    {
        $filtros = [
            'tipo_beca' => $this->request->getGet('tipo_beca'),
            'estado' => $this->request->getGet('estado'),
            'periodo_id' => $this->request->getGet('periodo_id'),
            'busqueda' => $this->request->getGet('busqueda')
        ];

        $builder = $this->becaModel->select('becas.*, periodos_academicos.nombre as periodo_nombre, usuarios.nombre as admin_nombre, usuarios.apellido as admin_apellido')
                                  ->join('periodos_academicos', 'periodos_academicos.id = becas.periodo_vigente_id', 'left')
                                  ->join('usuarios', 'usuarios.id = becas.creado_por', 'left');

        // Aplicar filtros
        if (!empty($filtros['tipo_beca'])) {
            $builder->where('becas.tipo_beca', $filtros['tipo_beca']);
        }
        if (!empty($filtros['estado'])) {
            $builder->where('becas.estado', $filtros['estado']);
        }
        if (!empty($filtros['periodo_id'])) {
            $builder->where('becas.periodo_vigente_id', $filtros['periodo_id']);
        }
        if (!empty($filtros['busqueda'])) {
            $builder->groupStart()
                    ->like('becas.nombre', $filtros['busqueda'])
                    ->orLike('becas.descripcion', $filtros['busqueda'])
                    ->groupEnd();
        }

        $becas = $builder->orderBy('becas.fecha_creacion', 'DESC')->findAll();

        return $this->response->setJSON([
            'success' => true,
            'data' => $becas
        ]);
    }

    /**
     * Mostrar formulario para crear nueva beca
     */
    public function crearBeca()
    {
        $data = [
            'titulo' => 'Crear Nueva Beca',
            'periodos' => $this->periodoModel->findAll(),
            'tipos_beca' => ['Académica', 'Económica', 'Deportiva', 'Cultural', 'Investigación', 'Otros']
        ];

        return view('AdminBecas/crear_beca', $data);
    }

    /**
     * Guardar nueva beca
     */
    public function guardarBeca()
    {
        try {
            $datosBeca = [
                'nombre' => $this->request->getPost('nombre'),
                'descripcion' => $this->request->getPost('descripcion'),
                'tipo_beca' => $this->request->getPost('tipo_beca'),
                'monto_beca' => $this->request->getPost('monto_beca') ?: null,
                'cupos_disponibles' => $this->request->getPost('cupos_disponibles') ?: null,
                'periodo_vigente_id' => $this->request->getPost('periodo_vigente_id'),
                'fecha_inicio_vigencia' => $this->request->getPost('fecha_inicio_vigencia'),
                'fecha_fin_vigencia' => $this->request->getPost('fecha_fin_vigencia'),
                'estado' => 'Activa',
                'activa' => 1,
                'creado_por' => session()->get('user_id')
            ];

            $documentosRequisitos = json_decode($this->request->getPost('documentos_requisitos'), true);

            if (empty($documentosRequisitos)) {
                throw new \Exception('Debe especificar al menos un documento requisito');
            }

            $resultado = $this->becaModel->crearBecaConRequisitos($datosBeca, $documentosRequisitos);

            if ($resultado) {
                return $this->response->setJSON([
                    'success' => true,
                    'message' => 'Beca creada exitosamente'
                ]);
            } else {
                throw new \Exception('Error al crear la beca');
            }
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'success' => false,
                'error' => $e->getMessage()
            ]);
        }
    }

    /**
     * Mostrar formulario para editar beca
     */
    public function editarBeca($id)
    {
        $beca = $this->becaModel->getBecaConRequisitos($id);
        
        if (!$beca) {
            return redirect()->to('/admin-becas')->with('error', 'Beca no encontrada');
        }

        $data = [
            'titulo' => 'Editar Beca',
            'beca' => $beca,
            'periodos' => $this->periodoModel->findAll(),
            'tipos_beca' => ['Académica', 'Económica', 'Deportiva', 'Cultural', 'Investigación', 'Otros']
        ];

        return view('AdminBecas/editar_beca', $data);
    }

    /**
     * Actualizar beca existente
     */
    public function actualizarBeca($id)
    {
        try {
            $datosBeca = [
                'nombre' => $this->request->getPost('nombre'),
                'descripcion' => $this->request->getPost('descripcion'),
                'tipo_beca' => $this->request->getPost('tipo_beca'),
                'monto_beca' => $this->request->getPost('monto_beca') ?: null,
                'cupos_disponibles' => $this->request->getPost('cupos_disponibles') ?: null,
                'periodo_vigente_id' => $this->request->getPost('periodo_vigente_id'),
                'fecha_inicio_vigencia' => $this->request->getPost('fecha_inicio_vigencia'),
                'fecha_fin_vigencia' => $this->request->getPost('fecha_fin_vigencia'),
                'estado' => $this->request->getPost('estado')
            ];

            $documentosRequisitos = json_decode($this->request->getPost('documentos_requisitos'), true);

            if (empty($documentosRequisitos)) {
                throw new \Exception('Debe especificar al menos un documento requisito');
            }

            $resultado = $this->becaModel->actualizarBecaConRequisitos($id, $datosBeca, $documentosRequisitos);

            if ($resultado) {
                return $this->response->setJSON([
                    'success' => true,
                    'message' => 'Beca actualizada exitosamente'
                ]);
            } else {
                throw new \Exception('Error al actualizar la beca');
            }
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'success' => false,
                'error' => $e->getMessage()
            ]);
        }
    }

    /**
     * Cambiar estado de una beca
     */
    public function cambiarEstadoBeca($id)
    {
        try {
            $nuevoEstado = $this->request->getPost('estado');
            $motivo = $this->request->getPost('motivo');

            $datos = ['estado' => $nuevoEstado];
            if ($nuevoEstado === 'Cerrada' && !empty($motivo)) {
                $datos['descripcion'] = $motivo;
            }

            $resultado = $this->becaModel->update($id, $datos);

            if ($resultado) {
                return $this->response->setJSON([
                    'success' => true,
                    'message' => 'Estado de la beca actualizado exitosamente'
                ]);
            } else {
                throw new \Exception('Error al actualizar el estado de la beca');
            }
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'success' => false,
                'error' => $e->getMessage()
            ]);
        }
    }

    /**
     * Eliminar beca
     */
    public function eliminarBeca($id)
    {
        try {
            // Verificar que no haya solicitudes activas
            $solicitudesActivas = $this->solicitudBecaModel->where('beca_id', $id)
                                                          ->whereIn('estado', ['Postulada', 'En Revisión'])
                                                          ->countAllResults();

            if ($solicitudesActivas > 0) {
                throw new \Exception('No se puede eliminar la beca porque tiene solicitudes activas');
            }

            $resultado = $this->becaModel->delete($id);

            if ($resultado) {
                return $this->response->setJSON([
                    'success' => true,
                    'message' => 'Beca eliminada exitosamente'
                ]);
            } else {
                throw new \Exception('Error al eliminar la beca');
            }
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'success' => false,
                'error' => $e->getMessage()
            ]);
        }
    }

    /**
     * Vista de solicitudes de becas
     */
    public function solicitudesBecas()
    {
        try {
            // Verificar conexión a la base de datos
            $db = \Config\Database::connect();
            if (!$db->connect()) {
                throw new \Exception('Error de conexión a la base de datos');
            }

            // Obtener estadísticas con manejo de errores
            $estadisticas = [];
            if (method_exists($this->solicitudBecaModel, 'getEstadisticasSolicitudes')) {
                $estadisticas = $this->solicitudBecasModel->getEstadisticasSolicitudes() ?: [];
            }

            // Obtener períodos con manejo de errores
            $periodos = [];
            if ($this->periodoModel) {
                $periodos = $this->periodoModel->findAll() ?: [];
            }

            // Obtener carreras con manejo de errores
            $carreras = [];
            if ($this->carreraModel) {
                $carreras = $this->carreraModel->findAll() ?: [];
            }

            $data = [
                'titulo' => 'Solicitudes de Becas',
                'estadisticas' => $estadisticas,
                'periodos' => $periodos,
                'carreras' => $carreras
            ];

            return view('AdminBecas/solicitudes_becas', $data);

        } catch (\Exception $e) {
            log_message('error', 'Error en solicitudesBecas: ' . $e->getMessage());
            
            // Devolver datos vacíos pero permitir que la vista se cargue
            return view('AdminBecas/solicitudes_becas', [
                'titulo' => 'Solicitudes de Becas',
                'estadisticas' => [],
                'periodos' => [],
                'carreras' => [],
                'error' => 'Error al cargar los datos: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * Listar solicitudes de becas
     */
    public function listarSolicitudes()
    {
        try {
            $filtros = [
                'estado' => $this->request->getGet('estado'),
                'periodo_id' => $this->request->getGet('periodo_id'),
                'carrera_id' => $this->request->getGet('carrera_id'),
                'beca_id' => $this->request->getGet('beca_id'),
                'busqueda' => $this->request->getGet('busqueda')
            ];

            // Verificar conexión a la base de datos
            $db = \Config\Database::connect();
            if (!$db->connect()) {
                throw new \Exception('Error de conexión a la base de datos');
            }

            // Usar LEFT JOIN en lugar de JOIN para manejar relaciones opcionales
            $builder = $this->solicitudBecaModel->select('solicitudes_becas.*, 
                becas.nombre as nombre_beca, 
                becas.tipo_beca, 
                IFNULL(usuarios.nombre, "") as nombre, 
                IFNULL(usuarios.apellido, "") as apellido, 
                IFNULL(usuarios.cedula, "") as cedula, 
                IFNULL(carreras.nombre, "Sin carrera") as carrera, 
                IFNULL(periodos_academicos.nombre, "Sin período") as periodo_nombre')
                ->join('becas', 'becas.id = solicitudes_becas.beca_id', 'left')
                ->join('usuarios', 'usuarios.id = solicitudes_becas.estudiante_id', 'left')
                ->join('carreras', 'carreras.id = usuarios.carrera_id', 'left')
                ->join('periodos_academicos', 'periodos_academicos.id = solicitudes_becas.periodo_id', 'left');

            // Aplicar filtros
            if (!empty($filtros['estado'])) {
                $builder->where('solicitudes_becas.estado', $filtros['estado']);
            }
            if (!empty($filtros['periodo_id']) && is_numeric($filtros['periodo_id'])) {
                $builder->where('solicitudes_becas.periodo_id', (int)$filtros['periodo_id']);
            }
            if (!empty($filtros['carrera_id']) && is_numeric($filtros['carrera_id'])) {
                $builder->where('usuarios.carrera_id', (int)$filtros['carrera_id']);
            }
            if (!empty($filtros['beca_id']) && is_numeric($filtros['beca_id'])) {
                $builder->where('solicitudes_becas.beca_id', (int)$filtros['beca_id']);
            }
            if (!empty($filtros['busqueda'])) {
                $search = trim($filtros['busqueda']);
                $builder->groupStart()
                        ->like('usuarios.nombre', $search)
                        ->orLike('usuarios.apellido', $search)
                        ->orLike('usuarios.cedula', $search)
                        ->groupEnd();
            }

            $solicitudes = $builder->orderBy('solicitudes_becas.fecha_solicitud', 'DESC')
                                 ->findAll();

            return $this->response->setJSON([
                'success' => true,
                'data' => $solicitudes ?: []
            ]);

        } catch (\Exception $e) {
            log_message('error', 'Error en listarSolicitudes: ' . $e->getMessage());
            return $this->response->setJSON([
                'success' => false,
                'error' => 'Error al cargar las solicitudes: ' . $e->getMessage(),
                'data' => []
            ]);
        }
    }

    /**
     * Ver detalles de una solicitud
     */
    public function verSolicitud($id)
    {
        $solicitud = $this->solicitudBecaModel->getSolicitudCompleta($id);
        
        if (!$solicitud) {
            return $this->response->setJSON([
                'success' => false,
                'error' => 'Solicitud no encontrada'
            ]);
        }

        return $this->response->setJSON([
            'success' => true,
            'data' => $solicitud
        ]);
    }

    /**
     * Aprobar documento de una solicitud
     */
    public function aprobarDocumento()
    {
        try {
            $solicitudId = $this->request->getPost('solicitud_id');
            $requisitoId = $this->request->getPost('requisito_id');
            $observaciones = $this->request->getPost('observaciones');

            $resultado = $this->solicitudBecaModel->aprobarDocumento(
                $solicitudId, 
                $requisitoId, 
                session()->get('user_id'), 
                $observaciones
            );

            if ($resultado) {
                return $this->response->setJSON([
                    'success' => true,
                    'message' => 'Documento aprobado exitosamente'
                ]);
            } else {
                throw new \Exception('Error al aprobar el documento');
            }
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'success' => false,
                'error' => $e->getMessage()
            ]);
        }
    }

    /**
     * Rechazar documento de una solicitud
     */
    public function rechazarDocumento()
    {
        try {
            $solicitudId = $this->request->getPost('solicitud_id');
            $requisitoId = $this->request->getPost('requisito_id');
            $motivoRechazo = $this->request->getPost('motivo_rechazo');

            if (empty($motivoRechazo)) {
                throw new \Exception('El motivo del rechazo es obligatorio');
            }

            $resultado = $this->solicitudBecaModel->rechazarDocumento(
                $solicitudId, 
                $requisitoId, 
                session()->get('user_id'), 
                $motivoRechazo
            );

            if ($resultado) {
                return $this->response->setJSON([
                    'success' => true,
                    'message' => 'Documento rechazado exitosamente'
                ]);
            } else {
                throw new \Exception('Error al rechazar el documento');
            }
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'success' => false,
                'error' => $e->getMessage()
            ]);
        }
    }

    /**
     * Aprobar solicitud de beca
     */
    public function aprobarSolicitud()
    {
        try {
            $solicitudId = $this->request->getPost('solicitud_id');
            $observaciones = $this->request->getPost('observaciones');

            $resultado = $this->solicitudBecaModel->aprobarSolicitud(
                $solicitudId, 
                session()->get('user_id'), 
                $observaciones
            );

            if ($resultado) {
                return $this->response->setJSON([
                    'success' => true,
                    'message' => 'Solicitud de beca aprobada exitosamente'
                ]);
            } else {
                throw new \Exception('Error al aprobar la solicitud');
            }
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'success' => false,
                'error' => $e->getMessage()
            ]);
        }
    }

    /**
     * Rechazar solicitud de beca
     */
    public function rechazarSolicitud()
    {
        try {
            $solicitudId = $this->request->getPost('solicitud_id');
            $motivoRechazo = $this->request->getPost('motivo_rechazo');

            if (empty($motivoRechazo)) {
                throw new \Exception('El motivo del rechazo es obligatorio');
            }

            $resultado = $this->solicitudBecaModel->rechazarSolicitud(
                $solicitudId, 
                session()->get('user_id'), 
                $motivoRechazo
            );

            if ($resultado) {
                return $this->response->setJSON([
                    'success' => true,
                    'message' => 'Solicitud de beca rechazada exitosamente'
                ]);
            } else {
                throw new \Exception('Error al rechazar la solicitud');
            }
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'success' => false,
                'error' => $e->getMessage()
            ]);
        }
    }

    /**
     * Obtener estadísticas para dashboard
     */
    public function getEstadisticasDashboard()
    {
        try {
            $stats = [
                'becas' => $this->becaModel->getEstadisticasBecas(),
                'solicitudes' => $this->solicitudBecaModel->getEstadisticasSolicitudes()
            ];

            return $this->response->setJSON([
                'success' => true,
                'data' => $stats
            ]);
        } catch (\Exception $e) {
            return $this->response->setJSON([
                'success' => false,
                'error' => $e->getMessage()
            ]);
        }
    }
}
