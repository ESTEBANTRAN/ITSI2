<?= $this->extend('layouts/mainEstudiante') ?>

<?= $this->section('content') ?>

<div class="row">
    <div class="col-lg-12 d-flex align-items-center justify-content-between mx-auto" style="max-width: 1000px;">
        <div class="d-flex align-items-center">
            <div>
                <h4 class="mb-1">Dashboard del Estudiante</h4>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= base_url('index.php/estudiante') ?>">Inicio</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12 d-flex align-items-center justify-content-between mx-auto" style="max-width: 1000px;">
        <div class="d-flex align-items-center">
            <div>
                <h4 class="mb-1">Bienvenido/a, <?= session('nombre') ?> <?= session('apellido') ?></h4>
                <p class="text-muted mb-0">Panel de control del estudiante</p>
            </div>
        </div>
    </div>
</div>

<!-- Stats Cards -->
<div class="row">
    <div class="col-lg-12 d-flex align-items-center justify-content-between mx-auto" style="max-width: 1000px;">
        <div class="row g-4 w-100">
            <div class="col-xl-3 col-md-6">
                <div class="card border-primary">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="card-title text-muted" style="font-size: 0.85rem;">Fichas Socioeconómicas</h6>
                                <h3 class="mb-0 text-primary" style="font-size: 2.2rem;"><?= $estadisticas['total_fichas'] ?? 0 ?></h3>
                            </div>
                            <div class="text-primary d-flex align-items-center justify-content-center" style="min-width: 60px;">
                                <i class="bi bi-file-earmark-text" style="font-size: 3rem; opacity: 0.8; line-height: 1;"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-xl-3 col-md-6">
                <div class="card border-success">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="card-title text-muted" style="font-size: 0.85rem;">Fichas Aprobadas</h6>
                                <h3 class="mb-0 text-success" style="font-size: 2.2rem;"><?= $estadisticas['fichas_aprobadas'] ?? 0 ?></h3>
                            </div>
                            <div class="text-success d-flex align-items-center justify-content-center" style="min-width: 60px;">
                                <i class="bi bi-check-circle" style="font-size: 3rem; opacity: 0.8; line-height: 1;"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-xl-3 col-md-6">
                <div class="card border-warning">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="card-title text-muted" style="font-size: 0.85rem;">Solicitudes de Becas</h6>
                                <h3 class="mb-0 text-warning" style="font-size: 2.2rem;"><?= $estadisticas['solicitudes_becas'] ?? 0 ?></h3>
                            </div>
                            <div class="text-warning d-flex align-items-center justify-content-center" style="min-width: 60px;">
                                <i class="bi bi-award" style="font-size: 3rem; opacity: 0.8; line-height: 1;"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-xl-3 col-md-6">
                <div class="card border-info">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="card-title text-muted" style="font-size: 0.85rem;">Solicitudes de Ayuda</h6>
                                <h3 class="mb-0 text-info" style="font-size: 2.2rem;"><?= $estadisticas['solicitudes_ayuda'] ?? 0 ?></h3>
                            </div>
                            <div class="text-info d-flex align-items-center justify-content-center" style="min-width: 60px;">
                                <i class="bi bi-question-circle" style="font-size: 3rem; opacity: 0.8; line-height: 1;"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="row">
    <div class="col-lg-12 d-flex align-items-center justify-content-between mx-auto" style="max-width: 1000px;">
        <div class="card w-100">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="bi bi-lightning me-2"></i>Acciones Rápidas
                </h5>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-3">
                        <a href="<?= base_url('index.php/estudiante/ficha-socioeconomica') ?>" class="btn btn-outline-primary w-100 h-100 d-flex flex-column align-items-center justify-content-center py-4">
                            <i class="bi bi-file-earmark-text mb-2" style="font-size: 2.5rem;"></i>
                            <span class="text-center">Nueva Ficha Socioeconómica</span>
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a href="<?= base_url('index.php/estudiante/becas') ?>" class="btn btn-outline-success w-100 h-100 d-flex flex-column align-items-center justify-content-center py-4">
                            <i class="bi bi-award mb-2" style="font-size: 2.5rem;"></i>
                            <span class="text-center">Solicitar Beca</span>
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a href="<?= base_url('index.php/estudiante/solicitudes-ayuda') ?>" class="btn btn-outline-warning w-100 h-100 d-flex flex-column align-items-center justify-content-center py-4">
                            <i class="bi bi-question-circle mb-2" style="font-size: 2.5rem;"></i>
                            <span class="text-center">Solicitar Ayuda</span>
                        </a>
                    </div>
                    <div class="col-md-3">
                        <a href="<?= base_url('index.php/estudiante/documentos') ?>" class="btn btn-outline-info w-100 h-100 d-flex flex-column align-items-center justify-content-center py-4">
                            <i class="bi bi-folder mb-2" style="font-size: 2.5rem;"></i>
                            <span class="text-center">Mis Documentos</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
<?= view('partials/footer') ?>
