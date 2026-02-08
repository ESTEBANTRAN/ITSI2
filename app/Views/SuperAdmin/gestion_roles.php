<?= $this->extend('layouts/mainSuperAdmin') ?>

<?= $this->section('content') ?>

<div class="container-fluid py-4">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card bg-gradient-primary text-white">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-md-8">
                            <h2 class="mb-2">
                                <i class="bi bi-shield-lock me-3"></i>
                                Gestión de Roles del Sistema
                            </h2>
                            <p class="mb-0 opacity-75">
                                Información detallada sobre los roles y permisos del sistema
                            </p>
                        </div>
                        <div class="col-md-4 text-md-end">
                            <div class="bg-white bg-opacity-25 rounded-circle p-3 d-inline-block">
                                <i class="bi bi-shield-check fs-1"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Información Importante -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="alert alert-info border-0 shadow-sm">
                <div class="d-flex align-items-center">
                    <i class="bi bi-info-circle-fill fs-4 me-3"></i>
                    <div>
                        <h6 class="alert-heading mb-1">Panel Informativo</h6>
                        <p class="mb-0">
                            Esta sección es únicamente informativa. Los roles del sistema están predefinidos 
                            y no pueden ser modificados para mantener la seguridad del sistema. Aquí puedes 
                            ver qué usuarios pertenecen a cada rol y qué permisos tienen.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Estadísticas de Roles -->
    <div class="row mb-4">
        <?php foreach ($estadisticas_roles as $estadistica): ?>
            <div class="col-lg-3 col-md-6 mb-4">
                <div class="card border-0 shadow h-100">
                    <div class="card-body text-center">
                        <div class="mb-3">
                            <?php
                            $iconClass = match($estadistica['rol']['nombre']) {
                                'Super Admin' => 'bi-shield-check text-danger',
                                'Admin Bienestar' => 'bi-shield-lock text-primary',
                                'Estudiante' => 'bi-person-badge text-success',
                                'Docente' => 'bi-person-workspace text-info',
                                default => 'bi-shield text-secondary'
                            };
                            ?>
                            <i class="bi <?= $iconClass ?> display-4"></i>
                        </div>
                        <h5 class="card-title text-primary mb-2">
                            <?= esc($estadistica['rol']['nombre']) ?>
                        </h5>
                        <p class="card-text text-muted small mb-3">
                            <?= esc($estadistica['rol']['descripcion']) ?>
                        </p>
                        
                        <div class="row text-center mb-3">
                            <div class="col-6">
                                <div class="text-success">
                                    <div class="h4 mb-0 fw-bold"><?= $estadistica['usuarios_activos'] ?></div>
                                    <small class="text-muted">Activos</small>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="text-danger">
                                    <div class="h4 mb-0 fw-bold"><?= $estadistica['usuarios_inactivos'] ?></div>
                                    <small class="text-muted">Inactivos</small>
                                </div>
                            </div>
                        </div>
                        
                        <div class="d-grid">
                            <a href="<?= base_url('super-admin/ver-rol/' . $estadistica['rol']['id']) ?>" 
                               class="btn btn-outline-primary btn-sm">
                                <i class="bi bi-eye me-1"></i>Ver Detalles
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- Tabla Detallada de Roles -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="bi bi-table me-2"></i>
                        Información Detallada de Roles
                    </h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>Rol</th>
                                    <th>Descripción</th>
                                    <th>Total Usuarios</th>
                                    <th>Usuarios Activos</th>
                                    <th>Usuarios Inactivos</th>
                                    <th>Estado</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($estadisticas_roles as $estadistica): ?>
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <?php
                                                $iconClass = match($estadistica['rol']['nombre']) {
                                                    'Super Admin' => 'bi-shield-check text-danger',
                                                    'Admin Bienestar' => 'bi-shield-lock text-primary',
                                                    'Estudiante' => 'bi-person-badge text-success',
                                                    'Docente' => 'bi-person-workspace text-info',
                                                    default => 'bi-shield text-secondary'
                                                };
                                                ?>
                                                <i class="bi <?= $iconClass ?> fs-4 me-3"></i>
                                                <div>
                                                    <div class="fw-bold"><?= esc($estadistica['rol']['nombre']) ?></div>
                                                    <small class="text-muted">ID: <?= $estadistica['rol']['id'] ?></small>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="text-muted">
                                                <?= esc($estadistica['rol']['descripcion']) ?>
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge bg-primary fs-6">
                                                <?= $estadistica['total_usuarios'] ?>
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge bg-success fs-6">
                                                <?= $estadistica['usuarios_activos'] ?>
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge bg-danger fs-6">
                                                <?= $estadistica['usuarios_inactivos'] ?>
                                            </span>
                                        </td>
                                        <td>
                                            <?php
                                            $estadoClass = $estadistica['rol']['estado'] === 'Activo' ? 'success' : 'secondary';
                                            ?>
                                            <span class="badge bg-<?= $estadoClass ?>">
                                                <?= esc($estadistica['rol']['estado']) ?>
                                            </span>
                                        </td>
                                        <td>
                                            <div class="btn-group btn-group-sm" role="group">
                                                <a href="<?= base_url('super-admin/ver-rol/' . $estadistica['rol']['id']) ?>" 
                                                   class="btn btn-outline-primary" title="Ver detalles">
                                                    <i class="bi bi-eye"></i>
                                                </a>
                                                <a href="<?= base_url('super-admin/gestion-usuarios') ?>" 
                                                   class="btn btn-outline-info" title="Ver usuarios">
                                                    <i class="bi bi-people"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Información de Seguridad -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card border-warning shadow">
                <div class="card-header bg-warning text-dark">
                    <h6 class="mb-0">
                        <i class="bi bi-exclamation-triangle me-2"></i>
                        Información de Seguridad
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h6 class="text-warning">¿Por qué no se pueden crear nuevos roles?</h6>
                            <ul class="text-muted">
                                <li>Mantiene la integridad del sistema</li>
                                <li>Previene conflictos de permisos</li>
                                <li>Facilita el mantenimiento</li>
                                <li>Garantiza la seguridad</li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <h6 class="text-warning">¿Qué puedo hacer aquí?</h6>
                            <ul class="text-muted">
                                <li>Ver estadísticas de cada rol</li>
                                <li>Revisar usuarios por rol</li>
                                <li>Monitorear la distribución</li>
                                <li>Identificar patrones de uso</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.bg-gradient-primary {
    background: linear-gradient(45deg, #4e73df 0%, #224abe 100%);
}

.card {
    transition: transform 0.2s ease-in-out;
}

.card:hover {
    transform: translateY(-2px);
}

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

.table th {
    background-color: #f8f9fa;
    border-bottom: 2px solid #dee2e6;
    font-weight: 600;
}

.table td {
    vertical-align: middle;
}

.btn-group-sm .btn {
    padding: 0.25rem 0.5rem;
    font-size: 0.75rem;
}

.badge {
    font-size: 0.875em;
}
</style>

<?= $this->endSection() ?>
