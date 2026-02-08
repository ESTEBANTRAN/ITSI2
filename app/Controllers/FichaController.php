<?php

namespace App\Controllers;

class FichaController extends BaseController
{
    public function index()
    {
        if (session('rol_id') == 1) {
            return view('Estudiante/FichaSocioeconomicaES');
        }
        return redirect()->to('/login');
    }

    public function adminIndex()
    {
        if (session('rol_id') == 2) {
            return view('AdminBienestar/fichas');
        }
        return redirect()->to('/login');
    }
}