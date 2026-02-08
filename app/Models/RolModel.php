<?php declare(strict_types=1);

namespace App\Models;

use CodeIgniter\Model;

final class RolModel extends Model
{
    protected $table            = 'roles';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['nombre', 'descripcion', 'permisos', 'estado'];
    
    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    
    // Validation
    protected $validationRules = [
        'nombre' => 'required|min_length[3]|max_length[50]|is_unique[roles.nombre,id,{id}]',
        'descripcion' => 'permit_empty|max_length[500]',
        'estado' => 'required|in_list[Activo,Inactivo]'
    ];
    
    protected $validationMessages = [
        'nombre' => [
            'required' => 'El nombre del rol es obligatorio',
            'min_length' => 'El nombre del rol debe tener al menos 3 caracteres',
            'max_length' => 'El nombre del rol no puede exceder 50 caracteres',
            'is_unique' => 'Ya existe un rol con ese nombre'
        ],
        'estado' => [
            'required' => 'El estado del rol es obligatorio',
            'in_list' => 'El estado debe ser Activo o Inactivo'
        ]
    ];
    
    protected $skipValidation = false;
    protected $cleanValidationRules = true;
    
    /**
     * Obtener todos los roles activos
     */
    public function getRolesActivos(): array
    {
        return $this->where('estado', 'Activo')->findAll();
    }
    
    /**
     * Obtener rol por ID
     */
    public function getRolById(int $id): ?array
    {
        $rol = $this->find($id);
        return $rol ?: null;
    }
    
    /**
     * Obtener rol por nombre
     */
    public function getRolPorNombre(string $nombre): ?array
    {
        return $this->where('nombre', $nombre)->first();
    }
    
    /**
     * Obtener usuarios por rol
     */
    public function getUsuariosPorRol(int $rolId): array
    {
        $db = \Config\Database::connect();
        
        return $db->table('usuarios u')
            ->select('u.id, u.nombre, u.apellido, u.cedula, u.email, u.estado, u.ultimo_acceso, u.fecha_registro')
            ->where('u.rol_id', $rolId)
            ->orderBy('u.nombre', 'ASC')
            ->get()
            ->getResultArray();
    }
    
    /**
     * Contar usuarios por rol
     */
    public function contarUsuariosPorRol(int $rolId): int
    {
        $db = \Config\Database::connect();
        
        $result = $db->table('usuarios')
            ->select('COUNT(*) as total')
            ->where('rol_id', $rolId)
            ->get()
            ->getRowArray();
            
        return (int) ($result['total'] ?? 0);
    }
    
    /**
     * Obtener estadísticas de roles
     */
    public function getEstadisticasRoles(): array
    {
        $db = \Config\Database::connect();
        
        $roles = $this->findAll();
        $estadisticas = [];
        
        foreach ($roles as $rol) {
            $estadisticas[] = [
                'rol' => $rol,
                'total_usuarios' => $this->contarUsuariosPorRol($rol['id']),
                'usuarios_activos' => $this->contarUsuariosActivosPorRol($rol['id']),
                'usuarios_inactivos' => $this->contarUsuariosInactivosPorRol($rol['id'])
            ];
        }
        
        return $estadisticas;
    }
    
    /**
     * Contar usuarios activos por rol
     */
    private function contarUsuariosActivosPorRol(int $rolId): int
    {
        $db = \Config\Database::connect();
        
        $result = $db->table('usuarios')
            ->select('COUNT(*) as total')
            ->where('rol_id', $rolId)
            ->where('estado', 'Activo')
            ->get()
            ->getRowArray();
            
        return (int) ($result['total'] ?? 0);
    }
    
    /**
     * Contar usuarios inactivos por rol
     */
    private function contarUsuariosInactivosPorRol(int $rolId): int
    {
        $db = \Config\Database::connect();
        
        $result = $db->table('usuarios')
            ->select('COUNT(*) as total')
            ->where('rol_id', $rolId)
            ->where('estado !=', 'Activo')
            ->get()
            ->getRowArray();
            
        return (int) ($result['total'] ?? 0);
    }
}
