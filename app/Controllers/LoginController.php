<?php

namespace App\Controllers;

use App\Models\UsuarioModel;

class LoginController extends BaseController 
{
    public function index()
    {
        // Si el usuario ya está logueado, redirigir al dashboard
        if (session()->get('logged_in')) {
            return redirect()->to('/dashboard');
        }
        return view('login');
    }
}