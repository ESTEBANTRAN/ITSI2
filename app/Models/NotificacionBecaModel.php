<?php

namespace App\Models;

use CodeIgniter\Model;

class NotificacionBecaModel extends Model
{
    protected $table            = 'notificaciones_becas';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;

    protected $allowedFields = [
        'usuario_id',
        'solicitud_beca_id',
        'tipo_notificacion',
        'titulo',
        'mensaje',
        'leida',
        'fecha_creacion',
        'fecha_lectura',
        'datos_adicionales'
    ];

    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = '';
    protected $updatedField  = '';
    protected $deletedField  = '';

    protected $validationRules = [
        'usuario_id'           => 'required|integer',
        'tipo_notificacion'    => 'required|max_length[100]',
        'titulo'               => 'required|max_length[255]',
        'mensaje'              => 'required|max_length[1000]',
        'leida'                => 'required|in_list[0,1]'
    ];

    protected $validationMessages = [
        'usuario_id' => [
            'required' => 'El ID del usuario es obligatorio',
            'integer' => 'El ID del usuario debe ser un número entero'
        ],
        'tipo_notificacion' => [
            'required' => 'El tipo de notificación es obligatorio',
            'max_length' => 'El tipo de notificación no puede exceder 100 caracteres'
        ],
        'titulo' => [
            'required' => 'El título es obligatorio',
            'max_length' => 'El título no puede exceder 255 caracteres'
        ],
        'mensaje' => [
            'required' => 'El mensaje es obligatorio',
            'max_length' => 'El mensaje no puede exceder 1000 caracteres'
        ],
        'leida' => [
            'required' => 'El campo leída es requerido',
            'in_list' => 'El campo leída debe ser 0 o 1'
        ]
    ];

    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    /**
     * Obtener notificaciones de un usuario
     */
    public function getNotificacionesUsuario($usuarioId, $limit = 50)
    {
        return $this->where('usuario_id', $usuarioId)
                   ->orderBy('fecha_creacion', 'DESC')
                   ->limit($limit)
                   ->findAll();
    }

    /**
     * Obtener notificaciones no leídas de un usuario
     */
    public function getNotificacionesNoLeidas($usuarioId)
    {
        return $this->where('usuario_id', $usuarioId)
                   ->where('leida', 0)
                   ->orderBy('fecha_creacion', 'DESC')
                   ->findAll();
    }

    /**
     * Contar notificaciones no leídas de un usuario
     */
    public function contarNotificacionesNoLeidas($usuarioId)
    {
        return $this->where('usuario_id', $usuarioId)
                   ->where('leida', 0)
                   ->countAllResults();
    }

    /**
     * Marcar notificación como leída
     */
    public function marcarComoLeida($id)
    {
        return $this->update($id, [
            'leida' => 1,
            'fecha_lectura' => date('Y-m-d H:i:s')
        ]);
    }

    /**
     * Marcar todas las notificaciones de un usuario como leídas
     */
    public function marcarTodasComoLeidas($usuarioId)
    {
        return $this->where('usuario_id', $usuarioId)
                   ->where('leida', 0)
                   ->set([
                       'leida' => 1,
                       'fecha_lectura' => date('Y-m-d H:i:s')
                   ])
                   ->update();
    }

    /**
     * Crear notificación de solicitud enviada
     */
    public function crearNotificacionSolicitudEnviada($usuarioId, $solicitudId)
    {
        return $this->insert([
            'usuario_id' => $usuarioId,
            'solicitud_beca_id' => $solicitudId,
            'tipo_notificacion' => 'Solicitud_Enviada',
            'titulo' => 'Solicitud de Beca Enviada',
            'mensaje' => 'Tu solicitud de beca ha sido enviada exitosamente. Revisa el estado de tus documentos.',
            'leida' => 0,
            'fecha_creacion' => date('Y-m-d H:i:s')
        ]);
    }

    /**
     * Crear notificación de documento aprobado
     */
    public function crearNotificacionDocumentoAprobado($usuarioId, $solicitudId, $nombreDocumento)
    {
        return $this->insert([
            'usuario_id' => $usuarioId,
            'solicitud_beca_id' => $solicitudId,
            'tipo_notificacion' => 'Documento_Aprobado',
            'titulo' => 'Documento Aprobado',
            'mensaje' => "Tu documento '{$nombreDocumento}' ha sido aprobado. Continúa subiendo los siguientes documentos requeridos.",
            'leida' => 0,
            'fecha_creacion' => date('Y-m-d H:i:s')
        ]);
    }

    /**
     * Crear notificación de documento rechazado
     */
    public function crearNotificacionDocumentoRechazado($usuarioId, $solicitudId, $nombreDocumento, $motivoRechazo)
    {
        return $this->insert([
            'usuario_id' => $usuarioId,
            'solicitud_beca_id' => $solicitudId,
            'tipo_notificacion' => 'Documento_Rechazado',
            'titulo' => 'Documento Rechazado',
            'mensaje' => "Tu documento '{$nombreDocumento}' ha sido rechazado. Motivo: {$motivoRechazo}. Por favor, súbelo nuevamente.",
            'leida' => 0,
            'fecha_creacion' => date('Y-m-d H:i:s'),
            'datos_adicionales' => json_encode(['motivo_rechazo' => $motivoRechazo])
        ]);
    }

    /**
     * Crear notificación de solicitud aprobada
     */
    public function crearNotificacionSolicitudAprobada($usuarioId, $solicitudId, $nombreBeca)
    {
        return $this->insert([
            'usuario_id' => $usuarioId,
            'solicitud_beca_id' => $solicitudId,
            'tipo_notificacion' => 'Solicitud_Aprobada',
            'titulo' => '¡Beca Aprobada!',
            'mensaje' => "¡Felicidades! Tu solicitud para la beca '{$nombreBeca}' ha sido aprobada. Revisa los detalles en tu panel.",
            'leida' => 0,
            'fecha_creacion' => date('Y-m-d H:i:s')
        ]);
    }

    /**
     * Crear notificación de solicitud rechazada
     */
    public function crearNotificacionSolicitudRechazada($usuarioId, $solicitudId, $nombreBeca, $motivoRechazo)
    {
        return $this->insert([
            'usuario_id' => $usuarioId,
            'solicitud_beca_id' => $solicitudId,
            'tipo_notificacion' => 'Solicitud_Rechazada',
            'titulo' => 'Solicitud de Beca Rechazada',
            'mensaje' => "Tu solicitud para la beca '{$nombreBeca}' ha sido rechazada. Motivo: {$motivoRechazo}. Puedes contactar al administrador para más información.",
            'leida' => 0,
            'fecha_creacion' => date('Y-m-d H:i:s'),
            'datos_adicionales' => json_encode(['motivo_rechazo' => $motivoRechazo])
        ]);
    }

    /**
     * Crear notificación de solicitud en lista de espera
     */
    public function crearNotificacionListaEspera($usuarioId, $solicitudId, $nombreBeca)
    {
        return $this->insert([
            'usuario_id' => $usuarioId,
            'solicitud_beca_id' => $solicitudId,
            'tipo_notificacion' => 'Lista_Espera',
            'titulo' => 'Solicitud en Lista de Espera',
            'mensaje' => "Tu solicitud para la beca '{$nombreBeca}' ha sido colocada en lista de espera. Te notificaremos cuando haya cupos disponibles.",
            'leida' => 0,
            'fecha_creacion' => date('Y-m-d H:i:s')
        ]);
    }

    /**
     * Crear notificación de recordatorio de documentos
     */
    public function crearNotificacionRecordatorioDocumentos($usuarioId, $solicitudId, $nombreBeca)
    {
        return $this->insert([
            'usuario_id' => $usuarioId,
            'solicitud_beca_id' => $solicitudId,
            'tipo_notificacion' => 'Recordatorio_Documentos',
            'titulo' => 'Recordatorio: Documentos Pendientes',
            'mensaje' => "Recuerda que tienes documentos pendientes para la beca '{$nombreBeca}'. Completa tu solicitud subiendo todos los documentos requeridos.",
            'leida' => 0,
            'fecha_creacion' => date('Y-m-d H:i:s')
        ]);
    }

    /**
     * Crear notificación de cambio de estado
     */
    public function crearNotificacionCambioEstado($usuarioId, $solicitudId, $estadoAnterior, $estadoNuevo, $nombreBeca)
    {
        $mensajes = [
            'Postulada' => 'enviada',
            'En Revisión' => 'enviada a revisión',
            'Aprobada' => 'aprobada',
            'Rechazada' => 'rechazada',
            'Lista de Espera' => 'colocada en lista de espera'
        ];

        $mensaje = "El estado de tu solicitud para la beca '{$nombreBeca}' ha cambiado de '{$estadoAnterior}' a '{$estadoNuevo}'.";

        return $this->insert([
            'usuario_id' => $usuarioId,
            'solicitud_beca_id' => $solicitudId,
            'tipo_notificacion' => 'Cambio_Estado',
            'titulo' => 'Cambio de Estado en Solicitud',
            'mensaje' => $mensaje,
            'leida' => 0,
            'fecha_creacion' => date('Y-m-d H:i:s'),
            'datos_adicionales' => json_encode([
                'estado_anterior' => $estadoAnterior,
                'estado_nuevo' => $estadoNuevo
            ])
        ]);
    }

    /**
     * Obtener notificaciones por tipo
     */
    public function getNotificacionesPorTipo($usuarioId, $tipo)
    {
        return $this->where('usuario_id', $usuarioId)
                   ->where('tipo_notificacion', $tipo)
                   ->orderBy('fecha_creacion', 'DESC')
                   ->findAll();
    }

    /**
     * Obtener notificaciones por período
     */
    public function getNotificacionesPorPeriodo($usuarioId, $fechaInicio, $fechaFin)
    {
        return $this->where('usuario_id', $usuarioId)
                   ->where('fecha_creacion >=', $fechaInicio)
                   ->where('fecha_creacion <=', $fechaFin)
                   ->orderBy('fecha_creacion', 'DESC')
                   ->findAll();
    }

    /**
     * Eliminar notificaciones antiguas
     */
    public function eliminarNotificacionesAntiguas($dias = 90)
    {
        $fechaLimite = date('Y-m-d H:i:s', strtotime("-{$dias} days"));
        
        return $this->where('fecha_creacion <', $fechaLimite)
                   ->where('leida', 1)
                   ->delete();
    }

    /**
     * Obtener estadísticas de notificaciones
     */
    public function getEstadisticasNotificaciones($usuarioId)
    {
        $total = $this->where('usuario_id', $usuarioId)->countAllResults();
        $noLeidas = $this->where('usuario_id', $usuarioId)->where('leida', 0)->countAllResults();
        $leidas = $this->where('usuario_id', $usuarioId)->where('leida', 1)->countAllResults();

        $porTipo = $this->select('tipo_notificacion, COUNT(*) as total')
                        ->where('usuario_id', $usuarioId)
                        ->groupBy('tipo_notificacion')
                        ->findAll();

        return [
            'total' => $total,
            'no_leidas' => $noLeidas,
            'leidas' => $leidas,
            'por_tipo' => $porTipo
        ];
    }

    /**
     * Obtener notificaciones con datos de solicitud
     */
    public function getNotificacionesConSolicitud($usuarioId, $limit = 50)
    {
        return $this->select('notificaciones_becas.*, solicitudes_becas.estado as estado_solicitud, becas.nombre as nombre_beca')
                   ->join('solicitudes_becas', 'solicitudes_becas.id = notificaciones_becas.solicitud_beca_id', 'left')
                   ->join('becas', 'becas.id = solicitudes_becas.beca_id', 'left')
                   ->where('notificaciones_becas.usuario_id', $usuarioId)
                   ->orderBy('notificaciones_becas.fecha_creacion', 'DESC')
                   ->limit($limit)
                   ->findAll();
    }

    /**
     * Crear notificación personalizada
     */
    public function crearNotificacionPersonalizada($usuarioId, $solicitudId, $tipo, $titulo, $mensaje, $datosAdicionales = null)
    {
        $datos = [
            'usuario_id' => $usuarioId,
            'solicitud_beca_id' => $solicitudId,
            'tipo_notificacion' => $tipo,
            'titulo' => $titulo,
            'mensaje' => $mensaje,
            'leida' => 0,
            'fecha_creacion' => date('Y-m-d H:i:s')
        ];

        if ($datosAdicionales) {
            $datos['datos_adicionales'] = json_encode($datosAdicionales);
        }

        return $this->insert($datos);
    }
}
