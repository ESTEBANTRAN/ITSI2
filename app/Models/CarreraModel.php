<?php

namespace App\Models;

use CodeIgniter\Model;

class CarreraModel extends Model
{
    protected $table = 'carreras';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nombre', 'codigo', 'semestres', 'activa'];
    protected $useTimestamps = false;

    public function getCarrerasActivas()
    {
        return $this->where('activa', 1)->findAll();
    }

    public function getCarreraById($id)
    {
        return $this->find($id);
    }

    public function getCarreraByCodigo($codigo)
    {
        return $this->where('codigo', $codigo)->first();
    }
} 