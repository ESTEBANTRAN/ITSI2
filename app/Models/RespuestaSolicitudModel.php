<?php

namespace App\Models;

use CodeIgniter\Model;

class RespuestaSolicitudModel extends Model
{
    protected $table = 'respuestas_solicitudes';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = [
        'solicitud_id',
        'usuario_id',
        'mensaje',
        'fecha_creacion'
    ];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat = 'datetime';
    protected $createdField = 'fecha_creacion';
    protected $updatedField = '';
    protected $deletedField = '';

    // Validation
    protected $validationRules = [
        'solicitud_id' => 'required|integer',
        'usuario_id' => 'required|integer',
        'mensaje' => 'required|min_length[5]'
    ];
    protected $validationMessages = [
        'solicitud_id' => [
            'required' => 'El ID de la solicitud es requerido',
            'integer' => 'El ID de la solicitud debe ser un número entero'
        ],
        'usuario_id' => [
            'required' => 'El ID del usuario es requerido',
            'integer' => 'El ID del usuario debe ser un número entero'
        ],
        'mensaje' => [
            'required' => 'El mensaje es requerido',
            'min_length' => 'El mensaje debe tener al menos 5 caracteres'
        ]
    ];
    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert = [];
    protected $afterInsert = [];
    protected $beforeUpdate = [];
    protected $afterUpdate = [];
    protected $beforeFind = [];
    protected $afterFind = [];
    protected $beforeDelete = [];
    protected $afterDelete = [];

    /**
     * Obtiene respuestas de una solicitud
     */
    public function getRespuestasSolicitud($solicitudId)
    {
        return $this->where('solicitud_id', $solicitudId)
                    ->orderBy('fecha_creacion', 'ASC')
                    ->findAll();
    }

    /**
     * Obtiene respuestas de un usuario
     */
    public function getRespuestasUsuario($usuarioId)
    {
        return $this->where('usuario_id', $usuarioId)
                    ->orderBy('fecha_creacion', 'DESC')
                    ->findAll();
    }

    /**
     * Obtiene la última respuesta de una solicitud
     */
    public function getUltimaRespuesta($solicitudId)
    {
        return $this->where('solicitud_id', $solicitudId)
                    ->orderBy('fecha_creacion', 'DESC')
                    ->first();
    }

    /**
     * Obtiene respuestas con información del usuario
     */
    public function getRespuestasConInformacion($solicitudId)
    {
        $db = \Config\Database::connect();
        
        $query = $db->query("
            SELECT 
                r.*,
                CONCAT(u.nombre, ' ', u.apellido) as usuario_nombre,
                u.rol_id
            FROM respuestas_solicitudes r
            LEFT JOIN usuarios u ON r.usuario_id = u.id
            WHERE r.solicitud_id = ?
            ORDER BY r.fecha_creacion ASC
        ", [$solicitudId]);
        
        return $query->getResultArray();
    }

    /**
     * Cuenta respuestas de una solicitud
     */
    public function contarRespuestas($solicitudId)
    {
        return $this->where('solicitud_id', $solicitudId)->countAllResults();
    }
} 