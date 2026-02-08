<?php

namespace App\Models;

use CodeIgniter\Model;

class FichaSocioeconomicaModel extends Model
{
    protected $table = 'fichas_socioeconomicas';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'estudiante_id', 
        'periodo_id', 
        'json_data', 
        'estado', 
        'observaciones_admin',
        'fecha_creacion', 
        'fecha_envio', 
        'fecha_revision'
    ];
    protected $useTimestamps = false;
    protected $createdField = 'fecha_creacion';
    protected $updatedField = 'fecha_actualizacion';

    public function getFichasPorEstudiante($estudiante_id)
    {
        return $this->where('estudiante_id', $estudiante_id)
                    ->orderBy('fecha_creacion', 'DESC')
                    ->findAll();
    }

    public function getFichasConPeriodo($estudiante_id)
    {
        return $this->select('fichas_socioeconomicas.*, periodos_academicos.nombre as nombre_periodo')
                    ->join('periodos_academicos', 'periodos_academicos.id = fichas_socioeconomicas.periodo_id')
                    ->where('fichas_socioeconomicas.estudiante_id', $estudiante_id)
                    ->orderBy('fichas_socioeconomicas.fecha_creacion', 'DESC')
                    ->findAll();
    }

    public function getFichaCompleta($id, $estudiante_id)
    {
        return $this->select('fichas_socioeconomicas.*, periodos_academicos.nombre as nombre_periodo')
                    ->join('periodos_academicos', 'periodos_academicos.id = fichas_socioeconomicas.periodo_id')
                    ->where('fichas_socioeconomicas.id', $id)
                    ->where('fichas_socioeconomicas.estudiante_id', $estudiante_id)
                    ->first();
    }

    public function verificarFichaExistente($estudiante_id, $periodo_id)
    {
        return $this->where('estudiante_id', $estudiante_id)
                    ->where('periodo_id', $periodo_id)
                    ->first();
    }

    public function getFichasAprobadas($estudiante_id)
    {
        return $this->where('estudiante_id', $estudiante_id)
                    ->where('estado', 'Aprobada')
                    ->findAll();
    }

    public function getFichasPendientes($estudiante_id)
    {
        return $this->where('estudiante_id', $estudiante_id)
                    ->whereIn('estado', ['Borrador', 'Enviada'])
                    ->findAll();
    }

    public function getFichasParaAdmin()
    {
        return $this->select('fichas_socioeconomicas.*, usuarios.nombre, usuarios.apellido, usuarios.cedula, usuarios.email, periodos_academicos.nombre as nombre_periodo')
                    ->join('usuarios', 'usuarios.id = fichas_socioeconomicas.estudiante_id')
                    ->join('periodos_academicos', 'periodos_academicos.id = fichas_socioeconomicas.periodo_id')
                    ->orderBy('fichas_socioeconomicas.fecha_creacion', 'DESC')
                    ->findAll();
    }

    public function getFichaParaAdmin($id)
    {
        return $this->select('fichas_socioeconomicas.*, usuarios.nombre, usuarios.apellido, usuarios.cedula, usuarios.email, periodos_academicos.nombre as nombre_periodo')
                    ->join('usuarios', 'usuarios.id = fichas_socioeconomicas.estudiante_id')
                    ->join('periodos_academicos', 'periodos_academicos.id = fichas_socioeconomicas.periodo_id')
                    ->where('fichas_socioeconomicas.id', $id)
                    ->first();
    }

    public function getFichaCompletaAdmin($id)
    {
        return $this->select('fichas_socioeconomicas.*, usuarios.nombre, usuarios.apellido, usuarios.cedula, usuarios.email, periodos_academicos.nombre as nombre_periodo')
                    ->join('usuarios', 'usuarios.id = fichas_socioeconomicas.estudiante_id')
                    ->join('periodos_academicos', 'periodos_academicos.id = fichas_socioeconomicas.periodo_id')
                    ->where('fichas_socioeconomicas.id', $id)
                    ->first();
    }
} 