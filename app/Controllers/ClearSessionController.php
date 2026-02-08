<?php

namespace App\Controllers;

class ClearSessionController extends BaseController
{
    public function index()
    {
        // Limpiar todas las sesiones
        session()->destroy();
        
        echo "<h1>Sesión Limpiada</h1>";
        echo "<p>La sesión ha sido destruida correctamente.</p>";
        echo "<p><a href='" . base_url('index.php/login') . "'>Ir al Login</a></p>";
        
        // También limpiar cookies
        if (isset($_COOKIE[session_name()])) {
            setcookie(session_name(), '', time() - 3600, '/');
        }
    }
} 