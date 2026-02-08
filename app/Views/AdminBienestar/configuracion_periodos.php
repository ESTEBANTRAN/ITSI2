<?= $this->extend('layouts/mainAdmin') ?>

<?= $this->section('content') ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="mb-0">Definir Periodo Socioeconómico</h1>
    <div class="d-flex gap-2">
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#nuevoPeriodoModal">
            <i class="bi bi-plus-circle"></i> Nuevo Periodo
        </button>
        <button type="button" class="btn btn-info" onclick="exportarPeriodos()">
            <i class="bi bi-download"></i> Exportar
        </button>
    </div>
</div>

<!-- Periodo Activo -->
<div class="row mb-4">
    <div class="col-md-12">
        <div class="card border-success">
            <div class="card-header bg-success text-white">
                <h5 class="card-title mb-0">
                    <i class="bi bi-calendar-check"></i> Periodo Académico Activo
                </h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <h6>Periodo</h6>
                        <p class="fw-bold">2024-2</p>
                    </div>
                    <div class="col-md-3">
                        <h6>Fecha Inicio</h6>
                        <p class="fw-bold">01/09/2024</p>
                    </div>
                    <div class="col-md-3">
                        <h6>Fecha Fin</h6>
                        <p class="fw-bold">31/01/2025</p>
                    </div>
                    <div class="col-md-3">
                        <h6>Estado</h6>
                        <span class="badge bg-success">Activo</span>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-6">
                        <h6>Configuración de Fichas</h6>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" checked disabled>
                            <label class="form-check-label">Fichas Socioeconómicas Habilitadas</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" checked disabled>
                            <label class="form-check-label">Solicitudes de Becas Habilitadas</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h6>Fechas Límite</h6>
                        <p><strong>Fichas:</strong> 15/02/2025</p>
                        <p><strong>Becas:</strong> 28/02/2025</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Estadísticas del Periodo -->
<div class="row mb-4">
    <div class="col-md-3">
        <div class="card bg-primary text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h6 class="card-title">Total Estudiantes</h6>
                        <h3 class="mb-0">1,247</h3>
                    </div>
                    <div class="align-self-center">
                        <i class="bi bi-people fs-1"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-success text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h6 class="card-title">Fichas Completadas</h6>
                        <h3 class="mb-0">892</h3>
                        <small>71.5% de cobertura</small>
                    </div>
                    <div class="align-self-center">
                        <i class="bi bi-file-earmark-check fs-1"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-info text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h6 class="card-title">Becas Solicitadas</h6>
                        <h3 class="mb-0">156</h3>
                        <small>12.5% de estudiantes</small>
                    </div>
                    <div class="align-self-center">
                        <i class="bi bi-award fs-1"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-warning text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h6 class="card-title">Días Restantes</h6>
                        <h3 class="mb-0">45</h3>
                        <small>Hasta 15/02/2025</small>
                    </div>
                    <div class="align-self-center">
                        <i class="bi bi-calendar-event fs-1"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Tabla de Periodos -->
<div class="card">
    <div class="card-header">
        <h5 class="card-title mb-0">Periodos Académicos Configurados</h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover" id="tablaPeriodos">
                <thead class="table-light">
                    <tr>
                        <th>Periodo</th>
                        <th>Fecha Inicio</th>
                        <th>Fecha Fin</th>
                        <th>Estado</th>
                        <th>Fichas</th>
                        <th>Becas</th>
                        <th>Estudiantes</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Datos de ejemplo -->
                    <tr class="table-success">
                        <td>
                            <div class="d-flex align-items-center">
                                <i class="bi bi-calendar-check text-success me-2"></i>
                                <div>
                                    <div class="fw-bold">2024-2</div>
                                    <small class="text-muted">Periodo Actual</small>
                                </div>
                            </div>
                        </td>
                        <td>01/09/2024</td>
                        <td>31/01/2025</td>
                        <td>
                            <span class="badge bg-success">Activo</span>
                        </td>
                        <td>
                            <span class="badge bg-success">Habilitadas</span>
                        </td>
                        <td>
                            <span class="badge bg-success">Habilitadas</span>
                        </td>
                        <td>
                            <span class="badge bg-primary">1,247</span>
                        </td>
                        <td>
                            <div class="btn-group" role="group">
                                <button type="button" class="btn btn-sm btn-outline-primary" 
                                        onclick="verPeriodo(1)" title="Ver Detalles">
                                    <i class="bi bi-eye"></i>
                                </button>
                                <button type="button" class="btn btn-sm btn-outline-secondary" 
                                        onclick="editarPeriodo(1)" title="Editar">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <button type="button" class="btn btn-sm btn-outline-warning" 
                                        onclick="duplicarPeriodo(1)" title="Duplicar">
                                    <i class="bi bi-files"></i>
                                </button>
                                <button type="button" class="btn btn-sm btn-outline-danger" 
                                        onclick="cerrarPeriodo(1)" title="Cerrar Periodo">
                                    <i class="bi bi-x-circle"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <i class="bi bi-calendar-x text-secondary me-2"></i>
                                <div>
                                    <div class="fw-bold">2024-1</div>
                                    <small class="text-muted">Periodo Anterior</small>
                                </div>
                            </div>
                        </td>
                        <td>01/03/2024</td>
                        <td>31/08/2024</td>
                        <td>
                            <span class="badge bg-secondary">Cerrado</span>
                        </td>
                        <td>
                            <span class="badge bg-secondary">Cerradas</span>
                        </td>
                        <td>
                            <span class="badge bg-secondary">Cerradas</span>
                        </td>
                        <td>
                            <span class="badge bg-secondary">1,189</span>
                        </td>
                        <td>
                            <div class="btn-group" role="group">
                                <button type="button" class="btn btn-sm btn-outline-primary" 
                                        onclick="verPeriodo(2)" title="Ver Detalles">
                                    <i class="bi bi-eye"></i>
                                </button>
                                <button type="button" class="btn btn-sm btn-outline-warning" 
                                        onclick="reabrirPeriodo(2)" title="Reabrir">
                                    <i class="bi bi-arrow-clockwise"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <i class="bi bi-calendar-plus text-info me-2"></i>
                                <div>
                                    <div class="fw-bold">2025-1</div>
                                    <small class="text-muted">Periodo Futuro</small>
                                </div>
                            </div>
                        </td>
                        <td>01/02/2025</td>
                        <td>31/08/2025</td>
                        <td>
                            <span class="badge bg-info">Programado</span>
                        </td>
                        <td>
                            <span class="badge bg-secondary">Pendiente</span>
                        </td>
                        <td>
                            <span class="badge bg-secondary">Pendiente</span>
                        </td>
                        <td>
                            <span class="badge bg-secondary">-</span>
                        </td>
                        <td>
                            <div class="btn-group" role="group">
                                <button type="button" class="btn btn-sm btn-outline-primary" 
                                        onclick="verPeriodo(3)" title="Ver Detalles">
                                    <i class="bi bi-eye"></i>
                                </button>
                                <button type="button" class="btn btn-sm btn-outline-secondary" 
                                        onclick="editarPeriodo(3)" title="Editar">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <button type="button" class="btn btn-sm btn-outline-success" 
                                        onclick="activarPeriodo(3)" title="Activar">
                                    <i class="bi bi-play-circle"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Configuración de Notificaciones -->
<div class="row mt-4">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Configuración de Notificaciones</h5>
            </div>
            <div class="card-body">
                <form>
                    <div class="mb-3">
                        <label class="form-label">Recordatorio de Fichas</label>
                        <div class="input-group">
                            <input type="number" class="form-control" value="7" min="1" max="30">
                            <span class="input-group-text">días antes del cierre</span>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Recordatorio de Becas</label>
                        <div class="input-group">
                            <input type="number" class="form-control" value="10" min="1" max="30">
                            <span class="input-group-text">días antes del cierre</span>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Notificaciones por Email</label>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" checked>
                            <label class="form-check-label">Enviar recordatorios por email</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" checked>
                            <label class="form-check-label">Notificar cierre de periodos</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox">
                            <label class="form-check-label">Notificar apertura de periodos</label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Guardar Configuración</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Configuración de Fechas</h5>
            </div>
            <div class="card-body">
                <form>
                    <div class="mb-3">
                        <label class="form-label">Apertura de Fichas</label>
                        <input type="date" class="form-control" value="2024-09-01">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Cierre de Fichas</label>
                        <input type="date" class="form-control" value="2025-02-15">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Apertura de Becas</label>
                        <input type="date" class="form-control" value="2024-09-15">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Cierre de Becas</label>
                        <input type="date" class="form-control" value="2025-02-28">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Configuración Automática</label>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" checked>
                            <label class="form-check-label">Cerrar automáticamente al vencimiento</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" checked>
                            <label class="form-check-label">Notificar vencimientos próximos</label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Guardar Fechas</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('modal') ?>
<!-- Modal Nuevo Periodo -->
<div class="modal fade" id="nuevoPeriodoModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Crear Nuevo Periodo Académico</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="formNuevoPeriodo">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Nombre del Periodo</label>
                            <input type="text" class="form-control" placeholder="Ej: 2025-1" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Estado</label>
                            <select class="form-select" required>
                                <option value="programado">Programado</option>
                                <option value="activo">Activo</option>
                                <option value="cerrado">Cerrado</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Fecha de Inicio</label>
                            <input type="date" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Fecha de Fin</label>
                            <input type="date" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Apertura de Fichas</label>
                            <input type="date" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Cierre de Fichas</label>
                            <input type="date" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Apertura de Becas</label>
                            <input type="date" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Cierre de Becas</label>
                            <input type="date" class="form-control" required>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">Descripción</label>
                            <textarea class="form-control" rows="3" placeholder="Descripción del periodo académico..."></textarea>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">Configuración de Módulos</label>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="activar_fichas" checked>
                                <label class="form-check-label" for="activar_fichas">Habilitar Fichas Socioeconómicas</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="activar_becas" checked>
                                <label class="form-check-label" for="activar_becas">Habilitar Solicitudes de Becas</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="activar_tickets">
                                <label class="form-check-label" for="activar_tickets">Habilitar Sistema de Tickets</label>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-success" onclick="crearNuevoPeriodo()">
                    <i class="bi bi-plus-circle"></i> Crear Periodo
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Ver Periodo -->
<div class="modal fade" id="modalVerPeriodo" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detalles del Periodo Académico</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <h6>Información General</h6>
                        <table class="table table-sm">
                            <tr><td><strong>Periodo:</strong></td><td>2024-2</td></tr>
                            <tr><td><strong>Estado:</strong></td><td><span class="badge bg-success">Activo</span></td></tr>
                            <tr><td><strong>Fecha Inicio:</strong></td><td>01/09/2024</td></tr>
                            <tr><td><strong>Fecha Fin:</strong></td><td>31/01/2025</td></tr>
                            <tr><td><strong>Duración:</strong></td><td>5 meses</td></tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <h6>Configuración de Módulos</h6>
                        <table class="table table-sm">
                            <tr><td><strong>Fichas Socioeconómicas:</strong></td><td><span class="badge bg-success">Habilitadas</span></td></tr>
                            <tr><td><strong>Solicitudes de Becas:</strong></td><td><span class="badge bg-success">Habilitadas</span></td></tr>
                            <tr><td><strong>Sistema de Tickets:</strong></td><td><span class="badge bg-success">Habilitado</span></td></tr>
                            <tr><td><strong>Reportes:</strong></td><td><span class="badge bg-success">Habilitados</span></td></tr>
                        </table>
                    </div>
                </div>
                
                <hr>
                
                <h6>Fechas Límite</h6>
                <div class="row">
                    <div class="col-md-6">
                        <table class="table table-sm">
                            <tr><td><strong>Apertura Fichas:</strong></td><td>01/09/2024</td></tr>
                            <tr><td><strong>Cierre Fichas:</strong></td><td>15/02/2025</td></tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-sm">
                            <tr><td><strong>Apertura Becas:</strong></td><td>15/09/2024</td></tr>
                            <tr><td><strong>Cierre Becas:</strong></td><td>28/02/2025</td></tr>
                        </table>
                    </div>
                </div>
                
                <hr>
                
                <h6>Estadísticas del Periodo</h6>
                <div class="row">
                    <div class="col-md-3 text-center">
                        <div class="card bg-primary text-white">
                            <div class="card-body p-2">
                                <h6 class="mb-0">1,247</h6>
                                <small>Total Estudiantes</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 text-center">
                        <div class="card bg-success text-white">
                            <div class="card-body p-2">
                                <h6 class="mb-0">892</h6>
                                <small>Fichas Completadas</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 text-center">
                        <div class="card bg-info text-white">
                            <div class="card-body p-2">
                                <h6 class="mb-0">156</h6>
                                <small>Becas Solicitadas</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 text-center">
                        <div class="card bg-warning text-white">
                            <div class="card-body p-2">
                                <h6 class="mb-0">45</h6>
                                <small>Días Restantes</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" onclick="editarPeriodoDesdeModal()">
                    <i class="bi bi-pencil"></i> Editar
                </button>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<script>
// Funciones JavaScript para la funcionalidad
function verPeriodo(id) {
    $('#modalVerPeriodo').modal('show');
}

function editarPeriodo(id) {
    window.location.href = '<?= base_url('index.php/configuracion/periodos/editar/') ?>' + id;
}

function duplicarPeriodo(id) {
    if (confirm('¿Desea duplicar este periodo académico?')) {
        // Lógica para duplicar periodo
        alert('Periodo duplicado exitosamente');
    }
}

function cerrarPeriodo(id) {
    if (confirm('¿Está seguro de que desea cerrar este periodo? Esta acción no se puede deshacer.')) {
        // Lógica para cerrar periodo
        alert('Periodo cerrado exitosamente');
    }
}

function reabrirPeriodo(id) {
    if (confirm('¿Desea reabrir este periodo académico?')) {
        // Lógica para reabrir periodo
        alert('Periodo reabierto exitosamente');
    }
}

function activarPeriodo(id) {
    if (confirm('¿Desea activar este periodo académico? Esto desactivará el periodo actual.')) {
        // Lógica para activar periodo
        alert('Periodo activado exitosamente');
    }
}

function exportarPeriodos() {
    if (confirm('¿Desea exportar la configuración de periodos?')) {
        // Lógica para exportar periodos
        alert('Periodos exportados exitosamente');
    }
}

function crearNuevoPeriodo() {
    if (confirm('¿Está seguro de que desea crear este nuevo periodo académico?')) {
        $('#nuevoPeriodoModal').modal('hide');
        alert('Nuevo periodo creado exitosamente');
    }
}

function editarPeriodoDesdeModal() {
    $('#modalVerPeriodo').modal('hide');
    // Lógica para editar periodo
    alert('Redirigiendo a edición...');
}

// Initialize tooltips
$(document).ready(function() {
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
});
</script> 