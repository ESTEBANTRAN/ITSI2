<?= $this->extend('layouts/mainSuperAdmin') ?>

<?= $this->section('content') ?>

<div class="container-fluid py-4">
    <!-- Header del Dashboard -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card bg-gradient-primary text-white">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h2 class="mb-2">
                                <i class="bi bi-shield-check me-3"></i>
                                Dashboard Super Administrador
                            </h2>
                            <p class="mb-0 opacity-75">
                                Panel de control principal del sistema de bienestar estudiantil
                            </p>
                        </div>
                        <div class="col-md-4 text-md-end">
                            <div class="d-flex align-items-center justify-content-md-end">
                                <div class="me-3">
                                    <small class="opacity-75">Último acceso</small>
                                    <div class="fw-bold"><?= date('d/m/Y H:i') ?></div>
                                </div>
                                <div class="bg-white bg-opacity-25 rounded-circle p-3">
                                    <i class="bi bi-person-circle fs-1"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tarjetas de Estadísticas -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Usuarios
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?= number_format($total_usuarios) ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-people-fill fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Roles Activos
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?= number_format($total_roles) ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-shield-lock fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Sistema
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                Operativo
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-check-circle-fill fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Versión
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                4.6.1
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="bi bi-code-slash fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Estadísticas de Roles -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="bi bi-pie-chart me-2"></i>
                        Distribución de Usuarios por Rol
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <?php foreach ($estadisticas_roles as $estadistica): ?>
                            <div class="col-lg-3 col-md-6 mb-3">
                                <div class="card border-0 bg-light">
                                    <div class="card-body text-center">
                                        <h5 class="card-title text-primary">
                                            <?= esc($estadistica['rol']['nombre']) ?>
                                        </h5>
                                        <div class="row text-center">
                                            <div class="col-6">
                                                <div class="text-success">
                                                    <i class="bi bi-check-circle me-1"></i>
                                                    <strong><?= $estadistica['usuarios_activos'] ?></strong>
                                                    <br><small>Activos</small>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="text-danger">
                                                    <i class="bi bi-x-circle me-1"></i>
                                                    <strong><?= $estadistica['usuarios_inactivos'] ?></strong>
                                                    <br><small>Inactivos</small>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-2">
                                            <span class="badge bg-primary">
                                                Total: <?= $estadistica['total_usuarios'] ?>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Usuarios Recientes -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="bi bi-clock-history me-2"></i>
                        Usuarios Registrados Recientemente
                    </h6>
                    <a href="<?= base_url('super-admin/gestion-usuarios') ?>" class="btn btn-sm btn-primary">
                        <i class="bi bi-arrow-right me-1"></i>Ver Todos
                    </a>
                </div>
                <div class="card-body">
                    <?php if (!empty($usuarios_recientes)): ?>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th>Usuario</th>
                                        <th>Email</th>
                                        <th>Rol</th>
                                        <th>Estado</th>
                                        <th>Fecha Registro</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($usuarios_recientes as $usuario): ?>
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar-sm me-3">
                                                        <?php if (!empty($usuario['foto_perfil'])): ?>
                                                            <img src="<?= base_url($usuario['foto_perfil']) ?>" 
                                                                 class="rounded-circle" width="40" height="40" 
                                                                 alt="Foto perfil">
                                                        <?php else: ?>
                                                            <div class="bg-secondary rounded-circle d-flex align-items-center justify-content-center" 
                                                                 style="width: 40px; height: 40px;">
                                                                <i class="bi bi-person text-white"></i>
                                                            </div>
                                                        <?php endif; ?>
                                                    </div>
                                                    <div>
                                                        <div class="fw-bold">
                                                            <?= esc($usuario['nombre'] . ' ' . $usuario['apellido']) ?>
                                                        </div>
                                                        <small class="text-muted">
                                                            <?= esc($usuario['cedula']) ?>
                                                        </small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td><?= esc($usuario['email']) ?></td>
                                            <td>
                                                <span class="badge bg-info">
                                                    <?= esc($usuario['rol_id'] == 1 ? 'Super Admin' : 
                                                           ($usuario['rol_id'] == 2 ? 'Admin Bienestar' : 
                                                           ($usuario['rol_id'] == 3 ? 'Estudiante' : 'Docente'))) ?>
                                                </span>
                                            </td>
                                            <td>
                                                <?php
                                                $estadoClass = match($usuario['estado']) {
                                                    'Activo' => 'success',
                                                    'Inactivo' => 'secondary',
                                                    'Suspendido' => 'danger',
                                                    default => 'secondary'
                                                };
                                                ?>
                                                <span class="badge bg-<?= $estadoClass ?>">
                                                    <?= esc($usuario['estado']) ?>
                                                </span>
                                            </td>
                                            <td>
                                                <?= date('d/m/Y H:i', strtotime($usuario['fecha_registro'])) ?>
                                            </td>
                                            <td>
                                                <a href="<?= base_url('super-admin/ver-usuario/' . $usuario['id']) ?>" 
                                                   class="btn btn-sm btn-outline-primary">
                                                    <i class="bi bi-eye me-1"></i>Ver
                                                </a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <div class="text-center py-4">
                            <i class="bi bi-inbox display-4 text-muted"></i>
                            <h5 class="mt-3 text-muted">No hay usuarios registrados</h5>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Acciones Rápidas -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="bi bi-lightning me-2"></i>
                        Acciones Rápidas
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-3 col-md-6 mb-3">
                            <a href="<?= base_url('super-admin/gestion-roles') ?>" class="text-decoration-none">
                                <div class="card border-0 bg-light h-100">
                                    <div class="card-body text-center">
                                        <i class="bi bi-shield-lock display-4 text-primary mb-3"></i>
                                        <h5 class="card-title">Gestión de Roles</h5>
                                        <p class="card-text text-muted">
                                            Ver información de roles y permisos del sistema
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        
                        <div class="col-lg-3 col-md-6 mb-3">
                            <a href="<?= base_url('super-admin/gestion-usuarios') ?>" class="text-decoration-none">
                                <div class="card border-0 bg-light h-100">
                                    <div class="card-body text-center">
                                        <i class="bi bi-people display-4 text-success mb-3"></i>
                                        <h5 class="card-title">Gestión de Usuarios</h5>
                                        <p class="card-text text-muted">
                                            Administrar usuarios del sistema
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        
                        <div class="col-lg-3 col-md-6 mb-3">
                            <a href="<?= base_url('super-admin/reportes') ?>" class="text-decoration-none">
                                <div class="card border-0 bg-light h-100">
                                    <div class="card-body text-center">
                                        <i class="bi bi-graph-up display-4 text-info mb-3"></i>
                                        <h5 class="card-title">Reportes</h5>
                                        <p class="card-text text-muted">
                                            Ver estadísticas y reportes del sistema
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        
                        <div class="col-lg-3 col-md-6 mb-3">
                            <a href="<?= base_url('super-admin/configuracion') ?>" class="text-decoration-none">
                                <div class="card border-0 bg-light h-100">
                                    <div class="card-body text-center">
                                        <i class="bi bi-gear display-4 text-warning mb-3"></i>
                                        <h5 class="card-title">Configuración</h5>
                                        <p class="card-text text-muted">
                                            Configurar parámetros del sistema
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.border-left-primary {
    border-left: 0.25rem solid #4e73df !important;
}

.border-left-success {
    border-left: 0.25rem solid #1cc88a !important;
}

.border-left-info {
    border-left: 0.25rem solid #36b9cc !important;
}

.border-left-warning {
    border-left: 0.25rem solid #f6c23e !important;
}

.bg-gradient-primary {
    background: linear-gradient(45deg, #4e73df 0%, #224abe 100%);
}

.avatar-sm img {
    object-fit: cover;
}

.card {
    transition: transform 0.2s ease-in-out;
}

.card:hover {
    transform: translateY(-2px);
}

.bg-light {
    background-color: #f8f9fc !important;
}

.text-gray-300 {
    color: #dddfeb !important;
}

.text-gray-800 {
    color: #5a5c69 !important;
}
</style>

<?= $this->endSection() ?>
