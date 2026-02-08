<?php

namespace App\Models;

use CodeIgniter\Model;

class CategoriaSolicitudAyudaModel extends Model
{
    protected $table            = 'categorias_solicitud_ayuda';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    
    protected $allowedFields = [
        'nombre', 'descripcion', 'color', 'icono', 'activo', 'orden'
    ];
    
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    
    /**
     * Obtener todas las categorías activas ordenadas
     */
    public function getCategoriasActivas()
    {
        return $this->where('activo', true)
                   ->orderBy('orden', 'ASC')
                   ->findAll();
    }
    
    /**
     * Obtener categoría por ID
     */
    public function getCategoria($id)
    {
        return $this->find($id);
    }
    
    /**
     * Obtener categoría por nombre
     */
    public function getCategoriaPorNombre($nombre)
    {
        return $this->where('nombre', $nombre)->first();
    }
    
    /**
     * Verificar si una categoría es "Otro Asunto"
     */
    public function esOtroAsunto($categoriaId)
    {
        $categoria = $this->find($categoriaId);
        return $categoria && $categoria['nombre'] === 'Otro Asunto';
    }
    
    /**
     * Obtener estadísticas de uso por categoría
     */
    public function getEstadisticasUso()
    {
        $db = \Config\Database::connect();
        
        $sql = "SELECT 
                    c.id,
                    c.nombre,
                    c.color,
                    c.icono,
                    COUNT(s.id) as total_solicitudes,
                    SUM(CASE WHEN s.estado = 'Pendiente' THEN 1 ELSE 0 END) as pendientes,
                    SUM(CASE WHEN s.estado = 'En Proceso' THEN 1 ELSE 0 END) as en_proceso,
                    SUM(CASE WHEN s.estado = 'Resuelta' THEN 1 ELSE 0 END) as resueltas,
                    SUM(CASE WHEN s.estado = 'Cerrada' THEN 1 ELSE 0 END) as cerradas
                FROM categorias_solicitud_ayuda c
                LEFT JOIN solicitudes_ayuda s ON c.id = s.categoria_id
                WHERE c.activo = 1
                GROUP BY c.id, c.nombre, c.color, c.icono
                ORDER BY c.orden ASC";
        
        $result = $db->query($sql);
        return $result->getResultArray();
    }
}
