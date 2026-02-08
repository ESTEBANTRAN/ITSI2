<?php

namespace App\Controllers;

class TestGlobalAdminController extends BaseController
{
    public function index()
    {
        echo "<h1>Test Global Admin</h1>";
        echo "<h2>Información de Sesión:</h2>";
        echo "<ul>";
        echo "<li>ID: " . (session('id') ?? 'No definido') . "</li>";
        echo "<li>Rol ID: " . (session('rol_id') ?? 'No definido') . "</li>";
        echo "<li>Nombre: " . (session('nombre') ?? 'No definido') . "</li>";
        echo "<li>Email: " . (session('email') ?? 'No definido') . "</li>";
        echo "</ul>";
        
        if (session('rol_id') == 4) {
            echo "<div style='color: green; font-weight: bold;'>✅ Usuario es Super Administrador</div>";
            echo "<a href='" . base_url('index.php/global-admin/dashboard') . "'>Ir al Dashboard del Super Admin</a>";
        } else {
            echo "<div style='color: red; font-weight: bold;'>❌ Usuario NO es Super Administrador</div>";
        }
        
        echo "<br><br>";
        echo "<a href='" . base_url('index.php/login') . "'>Volver al Login</a>";
    }
} 