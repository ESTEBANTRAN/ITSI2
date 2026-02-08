<?= $this->extend('layouts/mainAdmin') ?>

<?= $this->section('content') ?>

<div class="container-fluid py-4">
    <!-- Header con botón de regreso -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h4 class="mb-0">
                        <i class="bi bi-arrow-left me-2" style="cursor: pointer;" onclick="history.back()"></i>
                        📊 Detalles del Período Académico
                    </h4>
                    <p class="text-muted mb-0">Información completa de <?= esc($periodo['nombre']) ?></p>
                </div>
                <div class="btn-group">
                    <button type="button" class="btn btn-outline-primary" onclick="exportarDetallePeriodo()">
                        <i class="bi bi-file-excel me-1"></i> Exportar
                    </button>
                    <button type="button" class="btn btn-outline-secondary" onclick="history.back()">
                        <i class="bi bi-arrow-left me-1"></i> Volver
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Información del Período -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="bi bi-calendar-event me-2"></i>Información del Período
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tr>
                                    <td><strong>Nombre:</strong></td>
                                    <td><?= esc($periodo['nombre']) ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Descripción:</strong></td>
                                    <td><?= esc($periodo['descripcion'] ?? 'Sin descripción') ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Estado:</strong></td>
                                    <td>
                                        <span class="badge <?= $periodo['activo'] ? 'bg-success' : 'bg-secondary' ?>">
                                            <?= $periodo['activo'] ? 'Activo' : 'Inactivo' ?>
                                        </span>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table class="table table-borderless">
                                <tr>
                                    <td><strong>Fecha Inicio:</strong></td>
                                    <td><?= date('d/m/Y', strtotime($periodo['fecha_inicio'])) ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Fecha Fin:</strong></td>
                                    <td><?= date('d/m/Y', strtotime($periodo['fecha_fin'])) ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Configuración:</strong></td>
                                    <td>
                                        <span class="badge <?= $periodo['activo_fichas'] ? 'bg-success' : 'bg-secondary' ?> me-1">
                                            Fichas <?= $periodo['activo_fichas'] ? 'Activas' : 'Inactivas' ?>
                                        </span>
                                        <span class="badge <?= $periodo['activo_becas'] ? 'bg-success' : 'bg-secondary' ?>">
                                            Becas <?= $periodo['activo_becas'] ? 'Activas' : 'Inactivas' ?>
                                        </span>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Estadísticas Generales -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-3">
            <div class="card border-start border-primary border-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-uppercase text-muted mb-1">Total Fichas</h6>
                            <h3 class="mb-0 text-primary"><?= number_format($estadisticas['fichas']) ?></h3>
                        </div>
                        <div class="icon-shape icon-lg bg-soft-primary text-primary rounded-3">
                            <i class="bi bi-file-earmark-text"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-xl-3 col-md-6 mb-3">
            <div class="card border-start border-success border-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-uppercase text-muted mb-1">Total Becas</h6>
                            <h3 class="mb-0 text-success"><?= number_format($estadisticas['becas']) ?></h3>
                        </div>
                        <div class="icon-shape icon-lg bg-soft-success text-success rounded-3">
                            <i class="bi bi-award"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-xl-3 col-md-6 mb-3">
            <div class="card border-start border-info border-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-uppercase text-muted mb-1">Fichas Aprobadas</h6>
                            <h3 class="mb-0 text-info"><?= number_format($estadisticas['fichas_aprobadas']) ?></h3>
                        </div>
                        <div class="icon-shape icon-lg bg-soft-info text-info rounded-3">
                            <i class="bi bi-check-circle"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-xl-3 col-md-6 mb-3">
            <div class="card border-start border-warning border-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-uppercase text-muted mb-1">Becas Aprobadas</h6>
                            <h3 class="mb-0 text-warning"><?= number_format($estadisticas['becas_aprobadas']) ?></h3>
                        </div>
                        <div class="icon-shape icon-lg bg-soft-warning text-warning rounded-3">
                            <i class="bi bi-star"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Resúmenes por Carrera y Tipo de Beca -->
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="bi bi-graph-up me-2"></i>Resumen por Carreras
                    </h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead class="table-light">
                                <tr>
                                    <th>Carrera</th>
                                    <th class="text-center">Total</th>
                                    <th class="text-center">Aprobadas</th>
                                    <th class="text-center">Rechazadas</th>
                                    <th class="text-center">Pendientes</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($resumen_carreras)): ?>
                                    <?php foreach ($resumen_carreras as $carrera): ?>
                                        <tr>
                                            <td><?= esc($carrera['carrera'] ?? 'Sin carrera') ?></td>
                                            <td class="text-center">
                                                <span class="badge bg-primary"><?= $carrera['total_fichas'] ?></span>
                                            </td>
                                            <td class="text-center">
                                                <span class="badge bg-success"><?= $carrera['aprobadas'] ?></span>
                                            </td>
                                            <td class="text-center">
                                                <span class="badge bg-danger"><?= $carrera['rechazadas'] ?></span>
                                            </td>
                                            <td class="text-center">
                                                <span class="badge bg-warning"><?= $carrera['pendientes'] ?></span>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="5" class="text-center text-muted">No hay datos de carreras</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="bi bi-award me-2"></i>Resumen por Tipo de Beca
                    </h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead class="table-light">
                                <tr>
                                    <th>Tipo de Beca</th>
                                    <th class="text-center">Total</th>
                                    <th class="text-center">Aprobadas</th>
                                    <th class="text-center">Rechazadas</th>
                                    <th class="text-center">Pendientes</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($resumen_becas)): ?>
                                    <?php foreach ($resumen_becas as $beca): ?>
                                        <tr>
                                            <td><?= esc($beca['tipo_beca'] ?? 'Sin especificar') ?></td>
                                            <td class="text-center">
                                                <span class="badge bg-primary"><?= $beca['total_solicitudes'] ?></span>
                                            </td>
                                            <td class="text-center">
                                                <span class="badge bg-success"><?= $beca['aprobadas'] ?></span>
                                            </td>
                                            <td class="text-center">
                                                <span class="badge bg-danger"><?= $beca['rechazadas'] ?></span>
                                            </td>
                                            <td class="text-center">
                                                <span class="badge bg-warning"><?= $beca['pendientes'] ?></span>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="5" class="text-center text-muted">No hay datos de becas</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabs para Fichas y Becas -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <ul class="nav nav-tabs card-header-tabs" id="detalleTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="fichas-tab" data-bs-toggle="tab" data-bs-target="#fichas" type="button" role="tab">
                                <i class="bi bi-file-earmark-text me-2"></i>Fichas Socioeconómicas (<?= count($fichas) ?>)
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="becas-tab" data-bs-toggle="tab" data-bs-target="#becas" type="button" role="tab">
                                <i class="bi bi-award me-2"></i>Solicitudes de Becas (<?= count($becas) ?>)
                            </button>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content" id="detalleTabsContent">
                        <!-- Tab Fichas -->
                        <div class="tab-pane fade show active" id="fichas" role="tabpanel">
                            <div class="table-responsive">
                                <table class="table table-hover table-sm" id="tablaFichas">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Estudiante</th>
                                            <th>Cédula</th>
                                            <th>Carrera</th>
                                            <th>Estado</th>
                                            <th>Email</th>
                                            <th>Fecha Creación</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (!empty($fichas)): ?>
                                            <?php foreach ($fichas as $ficha): ?>
                                                <tr>
                                                    <td>
                                                        <div>
                                                            <h6 class="mb-0"><?= esc($ficha['nombre'] . ' ' . $ficha['apellido']) ?></h6>
                                                        </div>
                                                    </td>
                                                    <td><?= esc($ficha['cedula']) ?></td>
                                                    <td><?= esc($ficha['carrera_nombre'] ?? 'Sin carrera') ?></td>
                                                    <td>
                                                        <span class="badge bg-<?= $ficha['estado'] === 'Aprobada' ? 'success' : ($ficha['estado'] === 'Rechazada' ? 'danger' : 'warning') ?>">
                                                            <?= esc($ficha['estado']) ?>
                                                        </span>
                                                    </td>
                                                    <td><?= esc($ficha['email'] ?? 'Sin email') ?></td>
                                                    <td><?= date('d/m/Y H:i', strtotime($ficha['created_at'])) ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <tr>
                                                <td colspan="6" class="text-center py-4">
                                                    <div class="text-muted">
                                                        <i class="bi bi-inbox display-6 d-block mb-2"></i>
                                                        No hay fichas registradas en este período
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        
                        <!-- Tab Becas -->
                        <div class="tab-pane fade" id="becas" role="tabpanel">
                            <div class="table-responsive">
                                <table class="table table-hover table-sm" id="tablaBecas">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Estudiante</th>
                                            <th>Cédula</th>
                                            <th>Carrera</th>
                                            <th>Tipo de Beca</th>
                                            <th>Estado</th>
                                            <th>Email</th>
                                            <th>Fecha Solicitud</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (!empty($becas)): ?>
                                            <?php foreach ($becas as $beca): ?>
                                                <tr>
                                                    <td>
                                                        <div>
                                                            <h6 class="mb-0"><?= esc($beca['nombre'] . ' ' . $beca['apellido']) ?></h6>
                                                        </div>
                                                    </td>
                                                    <td><?= esc($beca['cedula']) ?></td>
                                                    <td><?= esc($beca['carrera_nombre'] ?? 'Sin carrera') ?></td>
                                                    <td><?= esc($beca['nombre_beca'] ?? 'Sin especificar') ?></td>
                                                    <td>
                                                        <span class="badge bg-<?= $beca['estado'] === 'Aprobada' ? 'success' : ($beca['estado'] === 'Rechazada' ? 'danger' : 'warning') ?>">
                                                            <?= esc($beca['estado']) ?>
                                                        </span>
                                                    </td>
                                                    <td><?= esc($beca['email'] ?? 'Sin email') ?></td>
                                                    <td><?= date('d/m/Y H:i', strtotime($beca['created_at'])) ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <tr>
                                                <td colspan="7" class="text-center py-4">
                                                    <div class="text-muted">
                                                        <i class="bi bi-inbox display-6 d-block mb-2"></i>
                                                        No hay becas registradas en este período
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
function exportarDetallePeriodo() {
    Swal.fire({
        title: 'Exportando...',
        text: 'Preparando archivo de exportación',
        allowOutsideClick: false,
        didOpen: () => {
            Swal.showLoading();
        }
    });

    // Crear enlace temporal para descarga
    const url = '<?= base_url('admin-bienestar/exportar-periodos') ?>?tipo=excel&periodo_id=<?= $periodo['id'] ?>';
    const link = document.createElement('a');
    link.href = url;
    link.download = 'detalle_periodo_<?= $periodo['id'] ?>_<?= date('Y-m-d_H-i-s') ?>.csv';
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
    
    Swal.fire('Éxito', 'Archivo exportado exitosamente', 'success');
}

// Inicializar DataTables si están disponibles
$(document).ready(function() {
    if (typeof $.fn.DataTable !== 'undefined') {
        $('#tablaFichas').DataTable({
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json'
            },
            pageLength: 25,
            order: [[0, 'asc']]
        });
        
        $('#tablaBecas').DataTable({
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json'
            },
            pageLength: 25,
            order: [[0, 'asc']]
        });
    }
});
</script>

<style>
.icon-shape {
    width: 48px;
    height: 48px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.bg-soft-primary { background-color: rgba(85, 110, 230, 0.1); }
.bg-soft-success { background-color: rgba(40, 167, 69, 0.1); }
.bg-soft-info { background-color: rgba(23, 162, 184, 0.1); }
.bg-soft-warning { background-color: rgba(255, 193, 7, 0.1); }

.nav-tabs .nav-link {
    color: #6c757d;
}

.nav-tabs .nav-link.active {
    color: #495057;
    font-weight: 500;
}

.table th {
    font-weight: 600;
    font-size: 0.875rem;
}

.badge {
    font-size: 0.75rem;
}
</style>

<?= $this->endSection() ?>
