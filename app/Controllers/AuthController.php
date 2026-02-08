<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsuarioModel;

class AuthController extends BaseController
{
    public function index()
    {
        // Si ya está logueado, redirigir según el rol
        if (session('id')) {
            $rol_id = session('rol_id');
            
            if ($rol_id == 1) {
                return redirect()->to('/estudiante');
            } elseif ($rol_id == 2) {
                return redirect()->to('/admin-bienestar');
            } elseif ($rol_id == 4) {
                return redirect()->to('/global-admin/dashboard');
            } else {
                // Rol no válido, destruir sesión
                session()->destroy();
                return view('auth/login');
            }
        }
        return view('auth/login');
    }

    public function attemptLogin()
    {
        // 1. Validar los datos de entrada
        $rules = [
            'identificador' => 'required',
            'password'      => 'required'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', 'Por favor complete todos los campos.');
        }

        // 2. Obtener datos del formulario
        $identifier = $this->request->getPost('identificador');
        $password = $this->request->getPost('password');

        // Debug: log de intento de login
        log_message('debug', 'AuthController::attemptLogin - Intentando login con identificador: ' . $identifier);

        // 3. Usar el modelo para buscar al usuario
        $model = new UsuarioModel();
        $user = $model->findUserByIdentifier($identifier);

        // Debug: verificar si el usuario existe
        if (!$user) {
            log_message('debug', 'AuthController::attemptLogin - Usuario no encontrado');
            return redirect()->back()->withInput()->with('error', 'Usuario no encontrado. Verifique su cédula o correo.');
        }

        log_message('debug', 'AuthController::attemptLogin - Usuario encontrado, rol_id: ' . $user['rol_id']);

        // Debug: verificar si la contraseña es correcta
        if (!password_verify($password, $user['password_hash'])) {
            log_message('debug', 'AuthController::attemptLogin - Contraseña incorrecta');
            return redirect()->back()->withInput()->with('error', 'Contraseña incorrecta.');
        }

        log_message('debug', 'AuthController::attemptLogin - Credenciales correctas, configurando sesión');

        // 4. Si llegamos aquí, las credenciales son correctas
        $this->setSession($user);
        
        // 5. Redirigir según el rol
        $rol_id = $user['rol_id'];
        
        log_message('debug', 'AuthController::attemptLogin - Redirigiendo según rol_id: ' . $rol_id);
        
        if ($rol_id == 1) {
            // Estudiante
            log_message('debug', 'AuthController::attemptLogin - Redirigiendo a /estudiante');
            return redirect()->to('/estudiante');
        } elseif ($rol_id == 2) {
            // Administrativo Bienestar
            log_message('debug', 'AuthController::attemptLogin - Redirigiendo a /admin-bienestar');
            return redirect()->to('/admin-bienestar');
        } elseif ($rol_id == 4) {
            // Super Administrador
            log_message('debug', 'AuthController::attemptLogin - Redirigiendo a /global-admin/dashboard');
            return redirect()->to('/global-admin/dashboard');
        } else {
            // Rol no reconocido
            log_message('debug', 'AuthController::attemptLogin - Rol no reconocido: ' . $rol_id);
            session()->destroy();
            return redirect()->back()->withInput()->with('error', 'Rol de usuario no válido.');
        }
    }

    /**
     * Guarda los datos del usuario en la sesión.
     */
    private function setSession($user)
    {
        session()->set([
            'id'        => $user['id'],
            'rol_id'    => $user['rol_id'],
            'nombre'    => $user['nombre'],
            'apellido'  => $user['apellido'],
            'cedula'    => $user['cedula'],
            'email'     => $user['email'],
            'telefono'  => $user['telefono'],
            'direccion' => $user['direccion'],
            'carrera'   => $user['carrera'],
            'semestre'  => $user['semestre'],
            'foto_perfil' => $user['foto_perfil'],
            'isLoggedIn' => true,
        ]);
    }
    
    /**
     * Cierra la sesión del usuario.
     */
    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}