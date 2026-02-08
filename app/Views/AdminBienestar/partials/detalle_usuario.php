<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h6 class="card-title mb-0">Información Personal</h6>
            </div>
            <div class="card-body">
                <table class="table table-borderless table-sm">
                    <tr>
                        <td><strong>Nombre Completo:</strong></td>
                        <td><?= esc($usuario['nombre'] . ' ' . $usuario['apellido']) ?></td>
                    </tr>
                    <tr>
                        <td><strong>Cédula:</strong></td>
                        <td><?= esc($usuario['cedula']) ?></td>
                    </tr>
                    <tr>
                        <td><strong>Email:</strong></td>
                        <td><?= esc($usuario['email']) ?></td>
                    </tr>
                    <tr>
                        <td><strong>Teléfono:</strong></td>
                        <td><?= esc($usuario['telefono'] ?? 'No especificado') ?></td>
                    </tr>
                    <tr>
                        <td><strong>Dirección:</strong></td>
                        <td><?= esc($usuario['direccion'] ?? 'No especificada') ?></td>
                    </tr>
                    <tr>
                        <td><strong>Estado:</strong></td>
                        <td>
                            <?php if ($usuario['activo']): ?>
                                <span class="badge bg-success">Activo</span>
                            <?php else: ?>
                                <span class="badge bg-danger">Inactivo</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h6 class="card-title mb-0">Información Académica</h6>
            </div>
            <div class="card-body">
                <table class="table table-borderless table-sm">
                    <tr>
                        <td><strong>Rol:</strong></td>
                        <td>
                            <?php
                            $rolClass = '';
                            switch($usuario['rol_id']) {
                                case 1: $rolClass = 'bg-primary'; $rolText = 'Estudiante'; break;
                                case 2: $rolClass = 'bg-warning'; $rolText = 'Admin Bienestar'; break;
                                case 3: $rolClass = 'bg-danger'; $rolText = 'Super Admin'; break;
                                default: $rolClass = 'bg-secondary'; $rolText = 'Indefinido';
                            }
                            ?>
                            <span class="badge <?= $rolClass ?>"><?= $rolText ?></span>
                        </td>
                    </tr>
                    <?php if ($carrera): ?>
                    <tr>
                        <td><strong>Carrera:</strong></td>
                        <td>
                            <span class="badge bg-info"><?= esc($carrera['nombre']) ?></span>
                        </td>
                    </tr>
                    <?php endif; ?>
                    <tr>
                        <td><strong>Fecha Registro:</strong></td>
                        <td><?= date('d/m/Y H:i', strtotime($usuario['created_at'])) ?></td>
                    </tr>
                    <tr>
                        <td><strong>Último Acceso:</strong></td>
                        <td>
                            <?php if (!empty($usuario['ultimo_acceso'])): ?>
                                <?= date('d/m/Y H:i', strtotime($usuario['ultimo_acceso'])) ?>
                            <?php else: ?>
                                <span class="text-muted">Nunca</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>

<?php if ($estadisticas && $usuario['rol_id'] == 1): ?>
<div class="row mt-3">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h6 class="card-title mb-0">Estadísticas del Estudiante</h6>
            </div>
            <div class="card-body">
                <div class="row text-center">
                    <div class="col-md-4">
                        <div class="p-3">
                            <i class="bi bi-file-text fs-2 text-primary"></i>
                            <h4 class="mt-2"><?= $estadisticas['fichas'] ?></h4>
                            <p class="text-muted mb-0">Fichas Socioeconómicas</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="p-3">
                            <i class="bi bi-award fs-2 text-success"></i>
                            <h4 class="mt-2"><?= $estadisticas['solicitudes_becas'] ?></h4>
                            <p class="text-muted mb-0">Solicitudes de Becas</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="p-3">
                            <i class="bi bi-chat-dots fs-2 text-info"></i>
                            <h4 class="mt-2"><?= $estadisticas['solicitudes_ayuda'] ?></h4>
                            <p class="text-muted mb-0">Solicitudes de Ayuda</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>
