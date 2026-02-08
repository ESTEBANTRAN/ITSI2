<?php

namespace App\Controllers;

use App\Models\UsuarioModel;

class TestController extends BaseController
{
    public function index()
    {
        echo "<h1>Test del Sistema</h1>";
        
        // Verificar conexión a la base de datos
        try {
            $db = \Config\Database::connect();
            echo "<h2>✅ Conexión a la base de datos: OK</h2>";
        } catch (\Exception $e) {
            echo "<h2>❌ Error de conexión a la base de datos: " . $e->getMessage() . "</h2>";
            return;
        }
        
        // Verificar tabla usuarios
        try {
            $model = new UsuarioModel();
            $total_usuarios = $model->countAllResults();
            echo "<h2>✅ Tabla usuarios: OK (Total: $total_usuarios usuarios)</h2>";
            
            // Buscar usuarios con rol 4
            $super_admins = $model->where('rol_id', 4)->findAll();
            echo "<h3>Usuarios con rol 4 (Super Administrador):</h3>";
            if (empty($super_admins)) {
                echo "<p style='color: red;'>❌ No hay usuarios con rol 4</p>";
            } else {
                echo "<ul>";
                foreach ($super_admins as $admin) {
                    echo "<li>ID: {$admin['id']} - Nombre: {$admin['nombre']} {$admin['apellido']} - Email: {$admin['email']} - Rol: {$admin['rol_id']}</li>";
                }
                echo "</ul>";
            }
            
        } catch (\Exception $e) {
            echo "<h2>❌ Error con tabla usuarios: " . $e->getMessage() . "</h2>";
        }
        
        // Verificar sesión actual
        echo "<h2>Información de Sesión Actual:</h2>";
        echo "<ul>";
        echo "<li>ID: " . (session('id') ?? 'No definido') . "</li>";
        echo "<li>Rol ID: " . (session('rol_id') ?? 'No definido') . "</li>";
        echo "<li>Nombre: " . (session('nombre') ?? 'No definido') . "</li>";
        echo "<li>Email: " . (session('email') ?? 'No definido') . "</li>";
        echo "</ul>";
        
        // Enlaces de prueba
        echo "<h2>Enlaces de Prueba:</h2>";
        echo "<ul>";
        echo "<li><a href='" . base_url('index.php/login') . "'>Ir al Login</a></li>";
        echo "<li><a href='" . base_url('index.php/test-global-admin') . "'>Test Global Admin</a></li>";
        echo "<li><a href='" . base_url('index.php/global-admin/dashboard') . "'>Dashboard Global Admin</a></li>";
        echo "</ul>";
    }
} 