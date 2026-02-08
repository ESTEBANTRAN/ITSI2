<?php

namespace App\Controllers;

use App\Models\UsuarioModel;

class PerfilController extends BaseController
{
    protected $usuarioModel;

    public function __construct()
    {
        $this->usuarioModel = new UsuarioModel();
    }

    public function editar()
    {
        if (!session('id')) {
            return redirect()->to('/login');
        }

        $rol_id = session('rol_id');
        
        if ($rol_id == 1) {
            // Estudiante
            return view('perfil/estudiante');
        } elseif ($rol_id == 2 || $rol_id == 4) {
            // Administrativo Bienestar o Super Administrador
            return view('perfil/administrador');
        } else {
            return redirect()->to('/login');
        }
    }

    public function actualizar()
    {
        if (!session('id')) {
            return redirect()->to('/login');
        }

        $userId = session('id');
        $rol_id = session('rol_id');

        // Validar datos según el rol
        if ($rol_id == 1) {
            // Validación para estudiantes
            $rules = [
                'nombre' => 'required|min_length[2]|max_length[50]',
                'apellido' => 'required|min_length[2]|max_length[50]',
                'email' => 'required|valid_email',
                'telefono' => 'required|min_length[10]',
                'direccion' => 'required|min_length[10]',
                'carrera' => 'required',
                'semestre' => 'required|integer|greater_than[0]|less_than[11]'
            ];
        } else {
            // Validación para administradores
            $rules = [
                'nombre' => 'required|min_length[2]|max_length[50]',
                'apellido' => 'required|min_length[2]|max_length[50]',
                'email' => 'required|valid_email',
                'telefono' => 'required|min_length[10]',
                'direccion' => 'required|min_length[10]'
            ];
        }

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', 'Por favor corrija los errores en el formulario.');
        }

        // Preparar datos para actualizar
        $data = [
            'nombre' => $this->request->getPost('nombre'),
            'apellido' => $this->request->getPost('apellido'),
            'email' => $this->request->getPost('email'),
            'telefono' => $this->request->getPost('telefono'),
            'direccion' => $this->request->getPost('direccion')
        ];

        // Agregar campos específicos de estudiantes
        if ($rol_id == 1) {
            $data['carrera'] = $this->request->getPost('carrera');
            $data['semestre'] = $this->request->getPost('semestre');
        }

        // Verificar si se está cambiando la contraseña
        $password = $this->request->getPost('password');
        $confirmPassword = $this->request->getPost('confirm_password');

        if (!empty($password)) {
            if ($password !== $confirmPassword) {
                return redirect()->back()->withInput()->with('error', 'Las contraseñas no coinciden.');
            }
            if (strlen($password) < 6) {
                return redirect()->back()->withInput()->with('error', 'La contraseña debe tener al menos 6 caracteres.');
            }
            $data['password_hash'] = password_hash($password, PASSWORD_DEFAULT);
        }

        // Actualizar usuario
        if ($this->usuarioModel->update($userId, $data)) {
            // Actualizar datos de sesión
            session()->set([
                'nombre' => $data['nombre'],
                'apellido' => $data['apellido'],
                'email' => $data['email'],
                'telefono' => $data['telefono'],
                'direccion' => $data['direccion']
            ]);

            if ($rol_id == 1) {
                session()->set([
                    'carrera' => $data['carrera'],
                    'semestre' => $data['semestre']
                ]);
            }

            return redirect()->back()->with('success', 'Perfil actualizado exitosamente.');
        } else {
            return redirect()->back()->withInput()->with('error', 'Error al actualizar el perfil.');
        }
    }

    public function cambiarFoto()
    {
        if (!session('id')) {
            return $this->response->setJSON(['error' => 'No autorizado'])->setStatusCode(401);
        }

        $file = $this->request->getFile('foto');

        if (!$file->isValid()) {
            return $this->response->setJSON(['error' => 'Archivo no válido'])->setStatusCode(400);
        }

        // Validar tipo de archivo
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        if (!in_array($file->getClientMimeType(), $allowedTypes)) {
            return $this->response->setJSON(['error' => 'Tipo de archivo no permitido'])->setStatusCode(400);
        }

        // Validar tamaño (máximo 2MB)
        if ($file->getSize() > 2 * 1024 * 1024) {
            return $this->response->setJSON(['error' => 'El archivo es demasiado grande'])->setStatusCode(400);
        }

        // Generar nombre único
        $newName = session('id') . '_' . time() . '.' . $file->getExtension();
        
        // Mover archivo
        if ($file->move(ROOTPATH . 'public/uploads/perfiles/', $newName)) {
            // Actualizar en base de datos
            $this->usuarioModel->update(session('id'), ['foto_perfil' => $newName]);
            
            // Actualizar sesión
            session()->set('foto_perfil', $newName);
            
            return $this->response->setJSON([
                'success' => true,
                'filename' => $newName,
                'url' => base_url('uploads/perfiles/' . $newName)
            ]);
        } else {
            return $this->response->setJSON(['error' => 'Error al subir el archivo'])->setStatusCode(500);
        }
    }
}