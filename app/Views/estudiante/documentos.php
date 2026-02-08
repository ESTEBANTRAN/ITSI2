<?= $this->extend('layouts/mainEstudiante') ?>

<?= $this->section('breadcrumb') ?>Mis Documentos<?= $this->endSection() ?>

<?= $this->section('content') ?>

<!-- Page Header -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <div>
                <h4 class="mb-0">Mis Documentos</h4>
                <p class="text-muted mb-0">Documentos subidos en solicitudes de becas</p>
            </div>
        </div>
    </div>
</div>

<!-- Información -->
<div class="row mb-3">
    <div class="col-12">
        <div class="alert alert-info">
            <i class="bi bi-info-circle me-2"></i>
            <strong>Información:</strong> En esta sección puedes visualizar todos los documentos que has subido al momento de solicitar becas. 
            Los documentos se organizan por beca y período académico. Para subir nuevos documentos, debes solicitar una beca desde la sección de Becas.
        </div>
    </div>
</div>

<!-- Resumen Estadístico -->
<?php if (!empty($documentos)): ?>
<?php
$totalDocumentos = count($documentos);
$documentosPendientes = count(array_filter($documentos, fn($d) => $d['estado'] === 'Pendiente'));
$documentosAprobados = count(array_filter($documentos, fn($d) => $d['estado'] === 'Aprobado'));
$documentosRechazados = count(array_filter($documentos, fn($d) => $d['estado'] === 'Rechazado'));
?>
<div class="row mb-4">
    <div class="col-md-3">
        <div class="card bg-primary text-white">
            <div class="card-body text-center">
                <i class="bi bi-folder fs-1 mb-2"></i>
                <h4 class="mb-0"><?= $totalDocumentos ?></h4>
                <p class="mb-0">Total Documentos</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-warning text-white">
            <div class="card-body text-center">
                <i class="bi bi-clock fs-1 mb-2"></i>
                <h4 class="mb-0"><?= $documentosPendientes ?></h4>
                <p class="mb-0">Pendientes</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-success text-white">
            <div class="card-body text-center">
                <i class="bi bi-check-circle fs-1 mb-2"></i>
                <h4 class="mb-0"><?= $documentosAprobados ?></h4>
                <p class="mb-0">Aprobados</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-danger text-white">
            <div class="card-body text-center">
                <i class="bi bi-x-circle fs-1 mb-2"></i>
                <h4 class="mb-0"><?= $documentosRechazados ?></h4>
                <p class="mb-0">Rechazados</p>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>

<!-- Documentos -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="bi bi-folder me-2"></i>Documentos de Solicitudes de Becas
                </h5>
            </div>
            <div class="card-body">
                <?php if (!empty($documentos)): ?>
                    <?php
                    // Agrupar documentos por período académico
                    $documentosPorPeriodo = [];
                    foreach ($documentos as $documento) {
                        $periodoId = $documento['periodo_id'];
                        if (!isset($documentosPorPeriodo[$periodoId])) {
                            $documentosPorPeriodo[$periodoId] = [
                                'periodo_nombre' => $documento['periodo_nombre'],
                                'documentos' => []
                            ];
                        }
                        $documentosPorPeriodo[$periodoId]['documentos'][] = $documento;
                    }
                    ?>
                    
                    <?php foreach ($documentosPorPeriodo as $periodoId => $periodoData): ?>
                    <div class="mb-4">
                        <h6 class="text-primary mb-3">
                            <i class="bi bi-calendar me-2"></i>
                            Período: <?= htmlspecialchars($periodoData['periodo_nombre']) ?>
                        </h6>
                        
                        <div class="table-responsive">
                            <table class="table table-hover table-sm">
                                <thead class="table-light">
                                    <tr>
                                        <th>Documento</th>
                                        <th>Tipo de Documento</th>
                                        <th>Beca</th>
                                        <th>Estado</th>
                                        <th>Tamaño</th>
                                        <th>Fecha de Subida</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($periodoData['documentos'] as $documento): ?>
                                    <tr>
                                        <td>
                                            <strong><?= htmlspecialchars($documento['nombre_archivo']) ?></strong>
                                            <?php if ($documento['descripcion']): ?>
                                                <br><small class="text-muted"><?= htmlspecialchars($documento['descripcion']) ?></small>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <span class="badge bg-primary"><?= htmlspecialchars($documento['nombre_documento']) ?></span>
                                        </td>
                                        <td>
                                            <span class="text-info"><?= htmlspecialchars($documento['nombre_beca']) ?></span>
                                        </td>
                                        <td>
                                            <?php
                                            $estadoClass = '';
                                            $estadoText = $documento['estado'];
                                            switch ($documento['estado']) {
                                                case 'Pendiente':
                                                    $estadoClass = 'bg-warning';
                                                    break;
                                                case 'Aprobado':
                                                    $estadoClass = 'bg-success';
                                                    break;
                                                case 'Rechazado':
                                                    $estadoClass = 'bg-danger';
                                                    break;
                                                default:
                                                    $estadoClass = 'bg-secondary';
                                            }
                                            ?>
                                            <span class="badge <?= $estadoClass ?>"><?= $estadoText ?></span>
                                        </td>
                                        <td><?= number_format($documento['tamano_archivo'] / 1024, 2) ?> MB</td>
                                        <td><?= date('d/m/Y H:i', strtotime($documento['fecha_subida'])) ?></td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <button class="btn btn-sm btn-outline-primary" onclick="descargarDocumento(<?= $documento['id'] ?>)">
                                                    <i class="bi bi-download"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="text-center py-4">
                        <i class="bi bi-folder fs-1 text-muted mb-3"></i>
                        <p class="text-muted">No tienes documentos subidos en solicitudes de becas</p>
                        <p class="text-muted small">Los documentos aparecerán aquí cuando solicites una beca y subas los archivos requeridos.</p>
                        <a href="<?= base_url('index.php/estudiante/becas') ?>" class="btn btn-primary">
                            <i class="bi bi-award me-2"></i>Ver Becas Disponibles
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
// Descargar documento
function descargarDocumento(id) {
    window.open('<?= base_url('index.php/estudiante/descargar-documento-beca') ?>/' + id, '_blank');
}
</script>
<?= $this->endSection() ?> 