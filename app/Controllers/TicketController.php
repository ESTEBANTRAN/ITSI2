<?php

namespace App\Controllers;

class TicketController extends BaseController
{
    public function index()
    {
        if (session('rol_id') == 1) {
            return view('tickets/estudiante');
        } elseif (session('rol_id') == 2) {
            return view('tickets/administrativo');
        }
        return redirect()->to('/login');
    }
}