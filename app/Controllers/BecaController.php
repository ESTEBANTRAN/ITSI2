<?php

namespace App\Controllers;

class BecaController extends BaseController
{
    public function index()
    {
        if (session('rol_id') == 1) {
            return view('Estudiante/BecasES');
        }
        return redirect()->to('/login');
    }

    public function adminIndex()
    {
        if (session('rol_id') == 2) {
            return view('AdminBienestar/becas');
        }
        return redirect()->to('/login');
    }
}