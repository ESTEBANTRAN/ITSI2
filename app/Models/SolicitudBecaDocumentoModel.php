<?php

namespace App\Models;

use CodeIgniter\Model;

class SolicitudBecaDocumentoModel extends Model
{
    protected $table            = 'solicitudes_becas_documentos';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;

    protected $allowedFields = [
        'solicitud_beca_id',
        'documento_requisito_id',
        'nombre_archivo',
        'ruta_archivo',
        'tipo_archivo',
        'tamano_archivo',
        'estado',
        'fecha_subida',
        'fecha_revision',
        'revisado_por',
        'observaciones',
        'motivo_rechazo'
    ];

    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = '';
    protected $updatedField  = '';
    protected $deletedField  = '';

    protected $validationRules = [
        'solicitud_beca_id'      => 'required|integer',
        'documento_requisito_id' => 'required|integer',
        'nombre_archivo'         => 'required|max_length[255]',
        'ruta_archivo'           => 'required|max_length[500]',
        'tipo_archivo'           => 'required|max_length[100]',
        'tamano_archivo'         => 'required|integer',
        'estado'                 => 'required|in_list[Pendiente,Aprobado,Rechazado]'
    ];

    protected $validationMessages = [
        'solicitud_beca_id' => [
            'required' => 'El ID de la solicitud de beca es obligatorio',
            'integer' => 'El ID de la solicitud de beca debe ser un número entero'
        ],
        'documento_requisito_id' => [
            'required' => 'El ID del documento requisito es obligatorio',
            'integer' => 'El ID del documento requisito debe ser un número entero'
        ],
        'nombre_archivo' => [
            'required' => 'El nombre del archivo es obligatorio',
            'max_length' => 'El nombre del archivo no puede exceder 255 caracteres'
        ],
        'ruta_archivo' => [
            'required' => 'La ruta del archivo es obligatoria',
            'max_length' => 'La ruta del archivo no puede exceder 500 caracteres'
        ],
        'tipo_archivo' => [
            'required' => 'El tipo de archivo es obligatorio',
            'max_length' => 'El tipo de archivo no puede exceder 100 caracteres'
        ],
        'tamano_archivo' => [
            'required' => 'El tamaño del archivo es obligatorio',
            'integer' => 'El tamaño del archivo debe ser un número entero'
        ],
        'estado' => [
            'required' => 'El estado es obligatorio',
            'in_list' => 'El estado debe ser Pendiente, Aprobado o Rechazado'
        ]
    ];

    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    /**
     * Obtener documentos de una solicitud específica
     */
    public function getDocumentosSolicitud($solicitudId)
    {
        return $this->select('solicitudes_becas_documentos.*, becas_documentos_requisitos.nombre_documento, becas_documentos_requisitos.orden_verificacion')
                   ->join('becas_documentos_requisitos', 'becas_documentos_requisitos.id = solicitudes_becas_documentos.documento_requisito_id')
                   ->where('solicitudes_becas_documentos.solicitud_beca_id', $solicitudId)
                   ->orderBy('becas_documentos_requisitos.orden_verificacion', 'ASC')
                   ->findAll();
    }

    /**
     * Obtener documentos pendientes de una solicitud
     */
    public function getDocumentosPendientes($solicitudId)
    {
        return $this->select('solicitudes_becas_documentos.*, becas_documentos_requisitos.nombre_documento, becas_documentos_requisitos.orden_verificacion')
                   ->join('becas_documentos_requisitos', 'becas_documentos_requisitos.id = solicitudes_becas_documentos.documento_requisito_id')
                   ->where('solicitudes_becas_documentos.solicitud_beca_id', $solicitudId)
                   ->where('solicitudes_becas_documentos.estado', 'Pendiente')
                   ->orderBy('becas_documentos_requisitos.orden_verificacion', 'ASC')
                   ->findAll();
    }

    /**
     * Obtener documentos aprobados de una solicitud
     */
    public function getDocumentosAprobados($solicitudId)
    {
        return $this->select('solicitudes_becas_documentos.*, becas_documentos_requisitos.nombre_documento, becas_documentos_requisitos.orden_verificacion')
                   ->join('becas_documentos_requisitos', 'becas_documentos_requisitos.id = solicitudes_becas_documentos.documento_requisito_id')
                   ->where('solicitudes_becas_documentos.solicitud_beca_id', $solicitudId)
                   ->where('solicitudes_becas_documentos.estado', 'Aprobado')
                   ->orderBy('becas_documentos_requisitos.orden_verificacion', 'ASC')
                   ->findAll();
    }

    /**
     * Obtener el siguiente documento pendiente de una solicitud
     */
    public function getSiguienteDocumentoPendiente($solicitudId)
    {
        return $this->select('solicitudes_becas_documentos.*, becas_documentos_requisitos.nombre_documento, becas_documentos_requisitos.orden_verificacion')
                   ->join('becas_documentos_requisitos', 'becas_documentos_requisitos.id = solicitudes_becas_documentos.documento_requisito_id')
                   ->where('solicitudes_becas_documentos.solicitud_beca_id', $solicitudId)
                   ->where('solicitudes_becas_documentos.estado', 'Pendiente')
                   ->orderBy('becas_documentos_requisitos.orden_verificacion', 'ASC')
                   ->first();
    }

    /**
     * Verificar si todos los documentos de una solicitud están aprobados
     */
    public function todosDocumentosAprobados($solicitudId)
    {
        $totalDocumentos = $this->where('solicitud_beca_id', $solicitudId)->countAllResults();
        $documentosAprobados = $this->where('solicitud_beca_id', $solicitudId)
                                   ->where('estado', 'Aprobado')
                                   ->countAllResults();
        
        return $totalDocumentos > 0 && $totalDocumentos === $documentosAprobados;
    }

    /**
     * Obtener documentos rechazados de una solicitud
     */
    public function getDocumentosRechazados($solicitudId)
    {
        return $this->select('solicitudes_becas_documentos.*, becas_documentos_requisitos.nombre_documento, becas_documentos_requisitos.orden_verificacion')
                   ->join('becas_documentos_requisitos', 'becas_documentos_requisitos.id = solicitudes_becas_documentos.documento_requisito_id')
                   ->where('solicitudes_becas_documentos.solicitud_beca_id', $solicitudId)
                   ->where('solicitudes_becas_documentos.estado', 'Rechazado')
                   ->orderBy('becas_documentos_requisitos.orden_verificacion', 'ASC')
                   ->findAll();
    }

    /**
     * Contar documentos por estado en una solicitud
     */
    public function contarDocumentosPorEstado($solicitudId)
    {
        return $this->select('estado, COUNT(*) as total')
                   ->where('solicitud_beca_id', $solicitudId)
                   ->groupBy('estado')
                   ->findAll();
    }

    /**
     * Obtener documentos por tipo de archivo
     */
    public function getDocumentosPorTipo($solicitudId, $tipoArchivo)
    {
        return $this->where('solicitud_beca_id', $solicitudId)
                   ->where('tipo_archivo', $tipoArchivo)
                   ->orderBy('fecha_subida', 'ASC')
                   ->findAll();
    }

    /**
     * Buscar documentos por nombre
     */
    public function buscarDocumentosPorNombre($solicitudId, $nombre)
    {
        return $this->select('solicitudes_becas_documentos.*, becas_documentos_requisitos.nombre_documento')
                   ->join('becas_documentos_requisitos', 'becas_documentos_requisitos.id = solicitudes_becas_documentos.documento_requisito_id')
                   ->where('solicitudes_becas_documentos.solicitud_beca_id', $solicitudId)
                   ->like('solicitudes_becas_documentos.nombre_archivo', $nombre)
                   ->orLike('becas_documentos_requisitos.nombre_documento', $nombre)
                   ->findAll();
    }
}
