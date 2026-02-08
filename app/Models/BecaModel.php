<?php

namespace App\Models;

use CodeIgniter\Model;

class BecaModel extends Model
{
    protected $table            = 'becas';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'nombre',
        'descripcion',
        'tipo_beca',
        'monto_beca',
        'cupos_disponibles',
        'requisitos',
        'documentos_requisitos',
        'activa',
        'fecha_inicio_vigencia',
        'fecha_fin_vigencia',
        'periodo_vigente_id',
        'puntaje_minimo_requerido',
        'estado',
        'fecha_creacion',
        'creado_por',
        'fecha_actualizacion',
        'actualizado_por',
        'prioridad'
    ];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'fecha_creacion';
    protected $updatedField  = 'fecha_actualizacion';

    // Validation
    protected $validationRules = [
        'nombre'             => 'required|min_length[3]|max_length[255]',
        'tipo_beca'         => 'required|in_list[Académica,Económica,Deportiva,Cultural,Investigación,Otros]',
        'monto_beca'        => 'permit_empty|numeric|greater_than[0]',
        'cupos_disponibles' => 'permit_empty|integer|greater_than_equal_to[0]',
        'activa'            => 'required|in_list[0,1]',
        'periodo_vigente_id' => 'permit_empty|integer|greater_than[0]'
    ];

    protected $validationMessages = [
        'nombre' => [
            'required' => 'El nombre de la beca es obligatorio',
            'min_length' => 'El nombre debe tener al menos 3 caracteres',
            'max_length' => 'El nombre no puede exceder 255 caracteres'
        ],
        'tipo_beca' => [
            'required' => 'El tipo de beca es obligatorio',
            'in_list' => 'El tipo de beca debe ser válido'
        ],
        'monto_beca' => [
            'numeric' => 'El monto debe ser un número válido',
            'greater_than' => 'El monto debe ser mayor a 0'
        ],
        'cupos_disponibles' => [
            'integer' => 'Los cupos deben ser un número entero',
            'greater_than_equal_to' => 'Los cupos no pueden ser negativos'
        ]
    ];

    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $beforeInsert = ['beforeInsert'];
    protected $beforeUpdate = ['beforeUpdate'];

    protected function beforeInsert(array $data)
    {
        $data['data']['creado_por'] = session()->get('id') ?? 1;
        $data['data']['fecha_creacion'] = date('Y-m-d H:i:s');
        return $data;
    }

    protected function beforeUpdate(array $data)
    {
        $data['data']['actualizado_por'] = session()->get('id') ?? 1;
        $data['data']['fecha_actualizacion'] = date('Y-m-d H:i:s');
        return $data;
    }

    /**
     * Obtener todas las becas con información relacionada
     */
    public function getBecasCompletas()
    {
        return $this->select('
                b.*, 
                p.nombre as periodo_nombre,
                p.fecha_inicio as periodo_inicio,
                p.fecha_fin as periodo_fin,
                COUNT(sb.id) as solicitudes_recibidas,
                COUNT(CASE WHEN sb.estado = "Aprobada" THEN 1 END) as solicitudes_aprobadas
            ')
            ->from('becas b')
            ->join('periodos_academicos p', 'p.id = b.periodo_vigente_id', 'left')
            ->join('solicitudes_becas sb', 'sb.beca_id = b.id', 'left')
            ->groupBy('b.id')
            ->orderBy('b.nombre', 'ASC')
            ->findAll();
    }

    /**
     * Obtener becas por período
     */
    public function getBecasPorPeriodo($periodoId)
    {
        return $this->where('periodo_vigente_id', $periodoId)
                   ->where('activa', 1)
                   ->findAll();
    }

    /**
     * Obtener becas activas
     */
    public function getBecasActivas()
    {
        return $this->where('activa', 1)
                   ->orderBy('nombre', 'ASC')
                   ->findAll();
    }

    /**
     * Obtener becas por tipo
     */
    public function getBecasPorTipo($tipo)
    {
        return $this->where('tipo_beca', $tipo)
                   ->where('activa', 1)
                   ->findAll();
    }

    /**
     * Obtener estadísticas de becas
     */
    public function getEstadisticasBecas()
    {
        $total = $this->countAllResults();
        $activas = $this->where('activa', 1)->countAllResults();
        $inactivas = $this->where('activa', 0)->countAllResults();
        
        $tipos = $this->select('tipo_beca, COUNT(*) as total')
                      ->groupBy('tipo_beca')
                      ->findAll();
        
        $montos = $this->select('SUM(monto_beca) as total_montos')
                       ->where('monto_beca >', 0)
                       ->get()
                       ->getRowArray();
        
        $cupos = $this->select('SUM(cupos_disponibles) as total_cupos')
                      ->where('cupos_disponibles >', 0)
                      ->get()
                      ->getRowArray();
        
        return [
            'total' => $total,
            'activas' => $activas,
            'inactivas' => $inactivas,
            'tipos' => $tipos,
            'total_montos' => $montos['total_montos'] ?? 0,
            'total_cupos' => $cupos['total_cupos'] ?? 0
        ];
    }

    /**
     * Buscar becas por criterios
     */
    public function buscarBecas($criterios = [])
    {
        $builder = $this->builder();
        
        if (!empty($criterios['nombre'])) {
            $builder->like('nombre', $criterios['nombre']);
        }
        
        if (!empty($criterios['tipo_beca'])) {
            $builder->where('tipo_beca', $criterios['tipo_beca']);
        }
        
        if (isset($criterios['activa'])) {
            $builder->where('activa', $criterios['activa']);
        }
        
        if (!empty($criterios['periodo_id'])) {
            $builder->where('periodo_vigente_id', $criterios['periodo_id']);
        }
        
        if (!empty($criterios['monto_min'])) {
            $builder->where('monto_beca >=', $criterios['monto_min']);
        }
        
        if (!empty($criterios['monto_max'])) {
            $builder->where('monto_beca <=', $criterios['monto_max']);
        }
        
        return $builder->orderBy('nombre', 'ASC')->get()->getResultArray();
    }

    /**
     * Verificar si una beca puede ser eliminada
     */
    public function puedeEliminar($becaId)
    {
        $solicitudes = $this->db->table('solicitudes_becas')
                               ->where('beca_id', $becaId)
                               ->countAllResults();
        
        return $solicitudes === 0;
    }

    /**
     * Obtener becas con cupos disponibles
     */
    public function getBecasConCupos()
    {
        return $this->where('activa', 1)
                   ->where('cupos_disponibles >', 0)
                   ->orWhere('cupos_disponibles IS NULL')
                   ->findAll();
    }

    /**
     * Actualizar cupos disponibles
     */
    public function actualizarCupos($becaId, $cuposUtilizados)
    {
        $beca = $this->find($becaId);
        if (!$beca || empty($beca['cupos_disponibles'])) {
            return false;
        }
        
        $nuevosCupos = max(0, $beca['cupos_disponibles'] - $cuposUtilizados);
        return $this->update($becaId, ['cupos_disponibles' => $nuevosCupos]);
    }



    /**
     * Obtener tipos de beca disponibles
     */
    public function getTiposBeca()
    {
        return [
            'Académica' => 'Beca por excelencia académica',
            'Económica' => 'Beca por recursos limitados',
            'Deportiva' => 'Beca por logros deportivos',
            'Cultural' => 'Beca por actividades culturales',
            'Investigación' => 'Beca para proyectos de investigación',
            'Otros' => 'Otros tipos de becas'
        ];
    }

    /**
     * Obtener carreras habilitadas para una beca
     */
    public function getCarrerasHabilitadas($becaId)
    {
        // Campo no disponible en la tabla actual
        return [];
    }

    /**
     * Validar requisitos de una beca
     */
    public function validarRequisitos($becaId, $datosEstudiante)
    {
        $beca = $this->find($becaId);
        if (!$beca || !$beca['activa']) {
            return ['valida' => false, 'mensaje' => 'Beca no disponible'];
        }
        
        // Verificar cupos disponibles
        if (!empty($beca['cupos_disponibles']) && $beca['cupos_disponibles'] <= 0) {
            return ['valida' => false, 'mensaje' => 'No hay cupos disponibles'];
        }
        
        // Verificar período
        if (!empty($beca['periodo_vigente_id'])) {
            $periodo = $this->db->table('periodos_academicos')->find($beca['periodo_vigente_id']);
            if ($periodo && !$periodo['activo']) {
                return ['valida' => false, 'mensaje' => 'Período no activo'];
            }
        }
        
        // Verificar puntaje mínimo
        if (!empty($beca['puntaje_minimo_requerido']) && 
            (!isset($datosEstudiante['puntaje']) || $datosEstudiante['puntaje'] < $beca['puntaje_minimo_requerido'])) {
            return ['valida' => false, 'mensaje' => 'No cumple con el puntaje mínimo requerido'];
        }
        
        return ['valida' => true, 'mensaje' => 'Requisitos cumplidos'];
    }
} 