<?= $this->extend('layouts/mainAdmin') ?>

<?= $this->section('content') ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="mb-0">Gestión de Administrativos</h1>
    <div class="d-flex gap-2">
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#nuevoAdminModal">
            <i class="bi bi-plus-circle"></i> Nuevo Administrativo
        </button>
        <button type="button" class="btn btn-info" onclick="exportarAdmins()">
            <i class="bi bi-download"></i> Exportar
        </button>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#filterModal">
            <i class="bi bi-funnel"></i> Filtros
        </button>
    </div>
</div>

<!-- Estadísticas de Administrativos -->
<div class="row mb-4">
    <div class="col-md-3">
        <div class="card bg-primary text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h6 class="card-title">Total Administrativos</h6>
                        <h3 class="mb-0">12</h3>
                    </div>
                    <div class="align-self-center">
                        <i class="bi bi-person-badge fs-1"></i>
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
                        <h6 class="card-title">Activos</h6>
                        <h3 class="mb-0">10</h3>
                    </div>
                    <div class="align-self-center">
                        <i class="bi bi-check-circle fs-1"></i>
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
                        <h6 class="card-title">Tickets Asignados</h6>
                        <h3 class="mb-0">45</h3>
                    </div>
                    <div class="align-self-center">
                        <i class="bi bi-ticket-detailed fs-1"></i>
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
                        <h6 class="card-title">Pendientes</h6>
                        <h3 class="mb-0">8</h3>
                    </div>
                    <div class="align-self-center">
                        <i class="bi bi-clock fs-1"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Filtros Rápidos -->
<div class="row mb-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-3">
                        <label for="searchAdmin" class="form-label">Buscar Administrativo</label>
                        <input type="text" class="form-control" id="searchAdmin" placeholder="Cédula, nombre o email...">
                    </div>
                    <div class="col-md-2">
                        <label for="filterRol" class="form-label">Rol</label>
                        <select class="form-select" id="filterRol">
                            <option value="">Todos</option>
                            <option value="Administrativo Bienestar">Administrativo Bienestar</option>
                            <option value="Administrativo Vinculación">Administrativo Vinculación</option>
                            <option value="Super Administrador">Super Administrador</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label for="filterEstado" class="form-label">Estado</label>
                        <select class="form-select" id="filterEstado">
                            <option value="">Todos</option>
                            <option value="Activo">Activo</option>
                            <option value="Inactivo">Inactivo</option>
                            <option value="Vacaciones">Vacaciones</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label for="filterArea" class="form-label">Área</label>
                        <select class="form-select" id="filterArea">
                            <option value="">Todas</option>
                            <option value="Bienestar">Bienestar</option>
                            <option value="Vinculación">Vinculación</option>
                            <option value="Administración">Administración</option>
                        </select>
                    </div>
                    <div class="col-md-3 d-flex align-items-end">
                        <button type="button" class="btn btn-outline-secondary me-2" onclick="limpiarFiltros()">
                            <i class="bi bi-arrow-clockwise"></i> Limpiar
                        </button>
                        <button type="button" class="btn btn-primary" onclick="aplicarFiltros()">
                            <i class="bi bi-search"></i> Buscar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Tabla de Administrativos -->
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover" id="tablaAdmins">
                <thead class="table-light">
                    <tr>
                        <th>
                            <input type="checkbox" class="form-check-input" id="selectAll">
                        </th>
                        <th>Administrativo</th>
                        <th>Rol</th>
                        <th>Área</th>
                        <th>Estado</th>
                        <th>Tickets Asignados</th>
                        <th>Última Actividad</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Datos de ejemplo -->
                    <tr>
                        <td>
                            <input type="checkbox" class="form-check-input select-item">
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <img src="<?= base_url('sistema/assets/images/profile/user-2.jpg') ?>" 
                                     class="rounded-circle me-2" width="32" height="32" alt="Foto">
                                <div>
                                    <div class="fw-bold">Ana Gómez</div>
                                    <small class="text-muted">ana.gomez@itsi.edu.ec</small>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="badge bg-primary">Administrativo Bienestar</span>
                        </td>
                        <td>Bienestar</td>
                        <td>
                            <span class="badge bg-success">Activo</span>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <span class="fw-bold me-2">12</span>
                                <div class="progress flex-grow-1" style="height: 6px;">
                                    <div class="progress-bar bg-success" style="width: 80%"></div>
                                </div>
                            </div>
                        </td>
                        <td>Hace 2 horas</td>
                        <td>
                            <div class="btn-group" role="group">
                                <button type="button" class="btn btn-sm btn-outline-primary" 
                                        onclick="verAdmin(1)" title="Ver Perfil">
                                    <i class="bi bi-eye"></i>
                                </button>
                                <button type="button" class="btn btn-sm btn-outline-secondary" 
                                        onclick="editarAdmin(1)" title="Editar">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <button type="button" class="btn btn-sm btn-outline-info" 
                                        onclick="verTickets(1)" title="Ver Tickets">
                                    <i class="bi bi-ticket-detailed"></i>
                                </button>
                                <button type="button" class="btn btn-sm btn-outline-warning" 
                                        onclick="cambiarEstado(1)" title="Cambiar Estado">
                                    <i class="bi bi-gear"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="checkbox" class="form-check-input select-item">
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <img src="<?= base_url('sistema/assets/images/profile/user-1.jpg') ?>" 
                                     class="rounded-circle me-2" width="32" height="32" alt="Foto">
                                <div>
                                    <div class="fw-bold">Carlos Rodríguez</div>
                                    <small class="text-muted">carlos.rodriguez@itsi.edu.ec</small>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="badge bg-info">Administrativo Vinculación</span>
                        </td>
                        <td>Vinculación</td>
                        <td>
                            <span class="badge bg-success">Activo</span>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <span class="fw-bold me-2">8</span>
                                <div class="progress flex-grow-1" style="height: 6px;">
                                    <div class="progress-bar bg-warning" style="width: 60%"></div>
                                </div>
                            </div>
                        </td>
                        <td>Hace 1 hora</td>
                        <td>
                            <div class="btn-group" role="group">
                                <button type="button" class="btn btn-sm btn-outline-primary" 
                                        onclick="verAdmin(2)" title="Ver Perfil">
                                    <i class="bi bi-eye"></i>
                                </button>
                                <button type="button" class="btn btn-sm btn-outline-secondary" 
                                        onclick="editarAdmin(2)" title="Editar">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <button type="button" class="btn btn-sm btn-outline-info" 
                                        onclick="verTickets(2)" title="Ver Tickets">
                                    <i class="bi bi-ticket-detailed"></i>
                                </button>
                                <button type="button" class="btn btn-sm btn-outline-warning" 
                                        onclick="cambiarEstado(2)" title="Cambiar Estado">
                                    <i class="bi bi-gear"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="checkbox" class="form-check-input select-item">
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <img src="<?= base_url('sistema/assets/images/profile/user-3.jpg') ?>" 
                                     class="rounded-circle me-2" width="32" height="32" alt="Foto">
                                <div>
                                    <div class="fw-bold">María López</div>
                                    <small class="text-muted">maria.lopez@itsi.edu.ec</small>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="badge bg-danger">Super Administrador</span>
                        </td>
                        <td>Administración</td>
                        <td>
                            <span class="badge bg-warning">Vacaciones</span>
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <span class="fw-bold me-2">0</span>
                                <div class="progress flex-grow-1" style="height: 6px;">
                                    <div class="progress-bar bg-secondary" style="width: 0%"></div>
                                </div>
                            </div>
                        </td>
                        <td>Hace 3 días</td>
                        <td>
                            <div class="btn-group" role="group">
                                <button type="button" class="btn btn-sm btn-outline-primary" 
                                        onclick="verAdmin(3)" title="Ver Perfil">
                                    <i class="bi bi-eye"></i>
                                </button>
                                <button type="button" class="btn btn-sm btn-outline-secondary" 
                                        onclick="editarAdmin(3)" title="Editar">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <button type="button" class="btn btn-sm btn-outline-info" 
                                        onclick="verTickets(3)" title="Ver Tickets">
                                    <i class="bi bi-ticket-detailed"></i>
                                </button>
                                <button type="button" class="btn btn-sm btn-outline-warning" 
                                        onclick="cambiarEstado(3)" title="Cambiar Estado">
                                    <i class="bi bi-gear"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        
        <!-- Paginación -->
        <nav aria-label="Navegación de páginas" class="mt-4">
            <ul class="pagination justify-content-center">
                <li class="page-item disabled">
                    <a class="page-link" href="#" tabindex="-1">Anterior</a>
                </li>
                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item">
                    <a class="page-link" href="#">Siguiente</a>
                </li>
            </ul>
        </nav>
    </div>
</div>

<!-- Distribución de Carga de Trabajo -->
<div class="row mt-4">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Distribución por Rol</h5>
            </div>
            <div class="card-body">
                <canvas id="chartRoles" width="400" height="200"></canvas>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Carga de Trabajo</h5>
            </div>
            <div class="card-body">
                <canvas id="chartCarga" width="400" height="200"></canvas>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('modal') ?>
<!-- Modal Ver Administrativo -->
<div class="modal fade" id="modalVerAdmin" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Perfil del Administrativo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4 text-center">
                        <img src="<?= base_url('sistema/assets/images/profile/user-2.jpg') ?>" 
                             class="rounded-circle mb-3" width="120" height="120" alt="Foto">
                        <h5>Ana Gómez</h5>
                        <p class="text-muted">Administrativo Bienestar</p>
                        <span class="badge bg-success">Activo</span>
                    </div>
                    <div class="col-md-8">
                        <h6>Información Personal</h6>
                        <div class="row">
                            <div class="col-md-6">
                                <table class="table table-sm">
                                    <tr><td><strong>Cédula:</strong></td><td>0987654321</td></tr>
                                    <tr><td><strong>Email:</strong></td><td>ana.gomez@itsi.edu.ec</td></tr>
                                    <tr><td><strong>Teléfono:</strong></td><td>0999888777</td></tr>
                                    <tr><td><strong>Área:</strong></td><td>Bienestar</td></tr>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <table class="table table-sm">
                                    <tr><td><strong>Rol:</strong></td><td><span class="badge bg-primary">Administrativo Bienestar</span></td></tr>
                                    <tr><td><strong>Estado:</strong></td><td><span class="badge bg-success">Activo</span></td></tr>
                                    <tr><td><strong>Fecha Ingreso:</strong></td><td>15/01/2023</td></tr>
                                    <tr><td><strong>Última Sesión:</strong></td><td>Hace 2 horas</td></tr>
                                </table>
                            </div>
                        </div>
                        
                        <hr>
                        
                        <h6>Estadísticas de Trabajo</h6>
                        <div class="row">
                            <div class="col-md-3 text-center">
                                <div class="card bg-primary text-white">
                                    <div class="card-body p-2">
                                        <h6 class="mb-0">12</h6>
                                        <small>Tickets Asignados</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 text-center">
                                <div class="card bg-success text-white">
                                    <div class="card-body p-2">
                                        <h6 class="mb-0">8</h6>
                                        <small>Tickets Resueltos</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 text-center">
                                <div class="card bg-warning text-white">
                                    <div class="card-body p-2">
                                        <h6 class="mb-0">4</h6>
                                        <small>En Proceso</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 text-center">
                                <div class="card bg-info text-white">
                                    <div class="card-body p-2">
                                        <h6 class="mb-0">156</h6>
                                        <small>Fichas Revisadas</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" onclick="editarAdminDesdeModal()">
                    <i class="bi bi-pencil"></i> Editar
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Nuevo Administrativo -->
<div class="modal fade" id="nuevoAdminModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Registrar Nuevo Administrativo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="formNuevoAdmin">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Nombre</label>
                            <input type="text" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Apellido</label>
                            <input type="text" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Cédula</label>
                            <input type="text" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Teléfono</label>
                            <input type="tel" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Área</label>
                            <select class="form-select" required>
                                <option value="">Seleccionar área...</option>
                                <option value="Bienestar">Bienestar</option>
                                <option value="Vinculación">Vinculación</option>
                                <option value="Administración">Administración</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Rol</label>
                            <select class="form-select" required>
                                <option value="">Seleccionar rol...</option>
                                <option value="Administrativo Bienestar">Administrativo Bienestar</option>
                                <option value="Administrativo Vinculación">Administrativo Vinculación</option>
                                <option value="Super Administrador">Super Administrador</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Estado</label>
                            <select class="form-select" required>
                                <option value="Activo">Activo</option>
                                <option value="Inactivo">Inactivo</option>
                                <option value="Vacaciones">Vacaciones</option>
                            </select>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">Contraseña</label>
                            <input type="password" class="form-control" required>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-success" onclick="crearNuevoAdmin()">
                    <i class="bi bi-plus-circle"></i> Registrar Administrativo
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Filtros Avanzados -->
<div class="modal fade" id="filterModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Filtros Avanzados</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Rango de Fechas de Ingreso</label>
                        <div class="input-group">
                            <input type="date" class="form-control" id="fechaDesde">
                            <span class="input-group-text">hasta</span>
                            <input type="date" class="form-control" id="fechaHasta">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Rango de Tickets Asignados</label>
                        <div class="input-group">
                            <input type="number" class="form-control" id="ticketsMin" placeholder="Mínimo">
                            <span class="input-group-text">-</span>
                            <input type="number" class="form-control" id="ticketsMax" placeholder="Máximo">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Última Actividad</label>
                        <select class="form-select" id="filterUltimaActividad">
                            <option value="">Todos</option>
                            <option value="hoy">Hoy</option>
                            <option value="semana">Esta semana</option>
                            <option value="mes">Este mes</option>
                            <option value="inactivo">Más de 1 mes</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Permisos</label>
                        <select class="form-select" id="filterPermisos">
                            <option value="">Todos</option>
                            <option value="admin">Administrador</option>
                            <option value="editor">Editor</option>
                            <option value="viewer">Solo Lectura</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" onclick="aplicarFiltrosAvanzados()">Aplicar Filtros</button>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<script>
// Funciones JavaScript para la funcionalidad
function verAdmin(id) {
    $('#modalVerAdmin').modal('show');
}

function editarAdmin(id) {
    window.location.href = '<?= base_url('index.php/usuarios/admin/editar/') ?>' + id;
}

function verTickets(id) {
    window.location.href = '<?= base_url('index.php/tickets/admin/') ?>' + id;
}

function cambiarEstado(id) {
    if (confirm('¿Desea cambiar el estado de este administrativo?')) {
        // Lógica para cambiar estado
        alert('Estado cambiado exitosamente');
    }
}

function limpiarFiltros() {
    $('#searchAdmin').val('');
    $('#filterRol').val('');
    $('#filterEstado').val('');
    $('#filterArea').val('');
}

function aplicarFiltros() {
    // Lógica para aplicar filtros
    console.log('Aplicando filtros...');
}

function aplicarFiltrosAvanzados() {
    // Lógica para aplicar filtros avanzados
    $('#filterModal').modal('hide');
    console.log('Aplicando filtros avanzados...');
}

function exportarAdmins() {
    if (confirm('¿Desea exportar la lista de administrativos?')) {
        // Lógica para exportar administrativos
        alert('Administrativos exportados exitosamente');
    }
}

function crearNuevoAdmin() {
    if (confirm('¿Está seguro de que desea registrar este nuevo administrativo?')) {
        $('#nuevoAdminModal').modal('hide');
        alert('Administrativo registrado exitosamente');
    }
}

function editarAdminDesdeModal() {
    $('#modalVerAdmin').modal('hide');
    // Lógica para editar administrativo
    alert('Redirigiendo a edición...');
}

// Select all functionality
$('#selectAll').change(function() {
    $('.select-item').prop('checked', $(this).is(':checked'));
});

// Initialize charts when document is ready
$(document).ready(function() {
    // Gráfico de Distribución por Rol
    const ctxRoles = document.getElementById('chartRoles').getContext('2d');
    new Chart(ctxRoles, {
        type: 'doughnut',
        data: {
            labels: ['Administrativo Bienestar', 'Administrativo Vinculación', 'Super Administrador'],
            datasets: [{
                data: [6, 4, 2],
                backgroundColor: [
                    '#007bff', '#17a2b8', '#dc3545'
                ]
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false
        }
    });
    
    // Gráfico de Carga de Trabajo
    const ctxCarga = document.getElementById('chartCarga').getContext('2d');
    new Chart(ctxCarga, {
        type: 'bar',
        data: {
            labels: ['Ana Gómez', 'Carlos Rodríguez', 'María López', 'Juan Pérez', 'Laura Silva'],
            datasets: [{
                label: 'Tickets Asignados',
                data: [12, 8, 0, 15, 10],
                backgroundColor: '#007bff'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
    
    // Initialize tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
});
</script> 