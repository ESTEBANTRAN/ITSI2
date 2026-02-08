<?php

namespace App\Controllers;

class ReporteController extends BaseController
{
    public function index()
    {
        if (session('rol_id') == 2) {
            return view('AdminBienestar/reportes');
        }
        return redirect()->to('/login');
    }
}