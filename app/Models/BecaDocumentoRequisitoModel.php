<?php

namespace App\Models;

use CodeIgniter\Model;

class BecaDocumentoRequisitoModel extends Model
{
    protected $table            = 'becas_documentos_requisitos';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;

    protected $allowedFields = [
        'beca_id',
        'nombre_documento',
        'descripcion',
        'tipo_documento',
        'obligatorio',
        'orden_verificacion',
        'estado'
    ];

    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = '';
    protected $updatedField  = '';
    protected $deletedField  = '';

    protected $validationRules = [
        'beca_id'             => 'required|integer',
        'nombre_documento'    => 'required|max_length[255]',
        'tipo_documento'      => 'required|max_length[100]',
        'obligatorio'         => 'required|in_list[0,1]',
        'orden_verificacion'  => 'required|integer',
        'estado'              => 'required|in_list[Activo,Inactivo]'
    ];

    protected $validationMessages = [
        'beca_id' => [
            'required' => 'El ID de la beca es obligatorio',
            'integer' => 'El ID de la beca debe ser un número entero'
        ],
        'nombre_documento' => [
            'required' => 'El nombre del documento es obligatorio',
            'max_length' => 'El nombre del documento no puede exceder 255 caracteres'
        ],
        'tipo_documento' => [
            'required' => 'El tipo de documento es obligatorio',
            'max_length' => 'El tipo de documento no puede exceder 100 caracteres'
        ],
        'obligatorio' => [
            'required' => 'El campo obligatorio es requerido',
            'in_list' => 'El campo obligatorio debe ser 0 o 1'
        ],
        'orden_verificacion' => [
            'required' => 'El orden de verificación es obligatorio',
            'integer' => 'El orden de verificación debe ser un número entero'
        ],
        'estado' => [
            'required' => 'El estado es obligatorio',
            'in_list' => 'El estado debe ser Activo o Inactivo'
        ]
    ];

    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    /**
     * Obtener documentos requisitos de una beca específica
     */
    public function getDocumentosRequisitos($becaId)
    {
        return $this->where('beca_id', $becaId)
                   ->where('estado', 'Activo')
                   ->orderBy('orden_verificacion', 'ASC')
                   ->findAll();
    }

    /**
     * Obtener documentos requisitos activos ordenados
     */
    public function getDocumentosActivos($becaId)
    {
        return $this->where('beca_id', $becaId)
                   ->where('estado', 'Activo')
                   ->where('obligatorio', 1)
                   ->orderBy('orden_verificacion', 'ASC')
                   ->findAll();
    }

    /**
     * Verificar si un documento es el siguiente en la secuencia
     */
    public function esSiguienteDocumento($becaId, $ordenActual)
    {
        $siguiente = $this->where('beca_id', $becaId)
                          ->where('orden_verificacion', $ordenActual + 1)
                          ->where('estado', 'Activo')
                          ->first();
        
        return $siguiente !== null;
    }

    /**
     * Obtener el siguiente documento en la secuencia
     */
    public function getSiguienteDocumento($becaId, $ordenActual)
    {
        return $this->where('beca_id', $becaId)
                   ->where('orden_verificacion', $ordenActual + 1)
                   ->where('estado', 'Activo')
                   ->first();
    }

    /**
     * Contar documentos requisitos de una beca
     */
    public function contarDocumentosRequisitos($becaId)
    {
        return $this->where('beca_id', $becaId)
                   ->where('estado', 'Activo')
                   ->where('obligatorio', 1)
                   ->countAllResults();
    }

    /**
     * Obtener documentos por tipo
     */
    public function getDocumentosPorTipo($becaId, $tipo)
    {
        return $this->where('beca_id', $becaId)
                   ->where('tipo_documento', $tipo)
                   ->where('estado', 'Activo')
                   ->orderBy('orden_verificacion', 'ASC')
                   ->findAll();
    }
}
