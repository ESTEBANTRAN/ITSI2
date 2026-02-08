<?php

namespace App\Controllers;

use App\Models\SolicitudAyudaModel;
use App\Models\RespuestaSolicitudModel;

class SolicitudController extends BaseController
{
    protected $solicitudModel;
    protected $respuestaModel;

    public function __construct()
    {
        $this->solicitudModel = new SolicitudAyudaModel();
        $this->respuestaModel = new RespuestaSolicitudModel();
    }

    public function index()
    {
        if (session('rol_id') == 1) {
            return view('Estudiante/SolicitudesES');
        } elseif (session('rol_id') == 2) {
            return view('AdminBienestar/solicitudes');
        }
        return redirect()->to('/login');
    }

    public function adminIndex()
    {
        if (session('rol_id') == 2) {
            return view('AdminBienestar/solicitudes');
        }
        return redirect()->to('/login');
    }

    public function comunicacion()
    {
        if (session('rol_id') == 2) {
            return view('AdminBienestar/solicitudes_comunicacion');
        }
        return redirect()->to('/login');
    }

    public function integracion()
    {
        if (session('rol_id') == 2) {
            return view('AdminBienestar/solicitudes_integracion');
        }
        return redirect()->to('/login');
    }

    /**
     * Obtiene todas las solicitudes para el dashboard
     */
    public function getSolicitudes()
    {
        $solicitudes = $this->solicitudModel->getSolicitudesConInformacion();
        return $this->response->setJSON($solicitudes);
    }

    /**
     * Obtiene una solicitud específica
     */
    public function getSolicitud($id)
    {
        $solicitud = $this->solicitudModel->find($id);
        if (!$solicitud) {
            return $this->response->setJSON(['error' => 'Solicitud no encontrada'])->setStatusCode(404);
        }
        return $this->response->setJSON($solicitud);
    }

    /**
     * Crea una nueva solicitud
     */
    public function crear()
    {
        $data = [
            'id_estudiante' => session('user_id'),
            'asunto' => $this->request->getPost('asunto'),
            'descripcion' => $this->request->getPost('descripcion'),
            'prioridad' => $this->request->getPost('prioridad') ?? 'Media',
            'estado' => 'Pendiente',
            'fecha_solicitud' => date('Y-m-d H:i:s'),
            'fecha_actualizacion' => date('Y-m-d H:i:s')
        ];

        if ($this->solicitudModel->insert($data)) {
            return $this->response->setJSON(['success' => 'Solicitud creada exitosamente']);
        } else {
            return $this->response->setJSON(['error' => 'Error al crear la solicitud'])->setStatusCode(500);
        }
    }

    /**
     * Actualiza una solicitud
     */
    public function actualizar($id)
    {
        $data = [
            'asunto' => $this->request->getPost('asunto'),
            'descripcion' => $this->request->getPost('descripcion'),
            'estado' => $this->request->getPost('estado'),
            'prioridad' => $this->request->getPost('prioridad'),
            'id_responsable' => $this->request->getPost('id_responsable'),
            'fecha_actualizacion' => date('Y-m-d H:i:s')
        ];

        if ($this->solicitudModel->update($id, $data)) {
            return $this->response->setJSON(['success' => 'Solicitud actualizada exitosamente']);
        } else {
            return $this->response->setJSON(['error' => 'Error al actualizar la solicitud'])->setStatusCode(500);
        }
    }

    /**
     * Elimina una solicitud
     */
    public function eliminar($id)
    {
        if ($this->solicitudModel->delete($id)) {
            return $this->response->setJSON(['success' => 'Solicitud eliminada exitosamente']);
        } else {
            return $this->response->setJSON(['error' => 'Error al eliminar la solicitud'])->setStatusCode(500);
        }
    }

    /**
     * Asigna una solicitud a un administrativo
     */
    public function asignar($id)
    {
        $adminId = $this->request->getPost('admin_id');
        
        if ($this->solicitudModel->asignarSolicitud($id, $adminId)) {
            return $this->response->setJSON(['success' => 'Solicitud asignada exitosamente']);
        } else {
            return $this->response->setJSON(['error' => 'Error al asignar la solicitud'])->setStatusCode(500);
        }
    }

    /**
     * Cambia el estado de una solicitud
     */
    public function cambiarEstado($id)
    {
        $estado = $this->request->getPost('estado');
        
        if ($this->solicitudModel->cambiarEstado($id, $estado)) {
            return $this->response->setJSON(['success' => 'Estado cambiado exitosamente']);
        } else {
            return $this->response->setJSON(['error' => 'Error al cambiar el estado'])->setStatusCode(500);
        }
    }

    /**
     * Obtiene las respuestas de una solicitud
     */
    public function getRespuestas($solicitudId)
    {
        $respuestas = $this->respuestaModel->getRespuestasConInformacion($solicitudId);
        return $this->response->setJSON($respuestas);
    }

    /**
     * Agrega una respuesta a una solicitud
     */
    public function agregarRespuesta($solicitudId)
    {
        $data = [
            'solicitud_id' => $solicitudId,
            'usuario_id' => session('user_id'),
            'mensaje' => $this->request->getPost('mensaje'),
            'fecha_creacion' => date('Y-m-d H:i:s')
        ];

        if ($this->respuestaModel->insert($data)) {
            return $this->response->setJSON(['success' => 'Respuesta agregada exitosamente']);
        } else {
            return $this->response->setJSON(['error' => 'Error al agregar la respuesta'])->setStatusCode(500);
        }
    }

    /**
     * Obtiene estadísticas de solicitudes
     */
    public function getEstadisticas()
    {
        $estadisticas = $this->solicitudModel->getEstadisticasSolicitudes();
        return $this->response->setJSON($estadisticas);
    }
} 