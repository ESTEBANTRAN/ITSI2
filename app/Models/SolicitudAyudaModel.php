<?php

namespace App\Models;

use CodeIgniter\Model;

class SolicitudAyudaModel extends Model
{
    protected $table = 'solicitudes_ayuda';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'id_estudiante', 
        'asunto', 
        'categoria_id', 
        'asunto_personalizado', 
        'descripcion', 
        'prioridad', 
        'estado', 
        'fecha_solicitud', 
        'fecha_respuesta'
    ];
    protected $useTimestamps = true;
    protected $createdField = 'fecha_solicitud';
    protected $updatedField = 'fecha_actualizacion';

    public function getSolicitudesPorEstudiante($estudiante_id)
    {
        return $this->where('id_estudiante', $estudiante_id)
                    ->orderBy('fecha_solicitud', 'DESC')
                    ->findAll();
    }

    public function getSolicitudesPendientes($estudiante_id)
    {
        return $this->where('id_estudiante', $estudiante_id)
                    ->where('estado', 'Pendiente')
                    ->findAll();
    }

    public function getSolicitudesResueltas($estudiante_id)
    {
        return $this->where('id_estudiante', $estudiante_id)
                    ->whereIn('estado', ['Aprobada', 'Rechazada'])
                    ->findAll();
    }
} 