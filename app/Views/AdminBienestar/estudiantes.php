<?= $this->extend('layouts/mainAdmin') ?>

<?= $this->section('content') ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="mb-0">Información Estudiantil</h1>
    <div class="d-flex gap-2">
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#nuevoEstudianteModal">
            <i class="bi bi-plus-circle"></i> Nuevo Estudiante
        </button>
        <button type="button" class="btn btn-info" onclick="exportarEstudiantes()">
            <i class="bi bi-download"></i> Exportar
        </button>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#filterModal">
            <i class="bi bi-funnel"></i> Filtros
        </button>
    </div>
</div>

<!-- Estadísticas de Estudiantes -->
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
                        <h6 class="card-title">Con Fichas</h6>
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
                    <h6 class="card-title">Con Becas</h6>
                    <h3 class="mb-0">156</h3>
                    <small>12.5% de beneficiarios</small>
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
                        <h6 class="card-title">Pendientes</h6>
                        <h3 class="mb-0">23</h3>
                        <small>Tickets abiertos</small>
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
                        <label for="searchEstudiante" class="form-label">Buscar Estudiante</label>
                        <input type="text" class="form-control" id="searchEstudiante" placeholder="Cédula, nombre o email...">
                    </div>
                    <div class="col-md-2">
                        <label for="filterCarrera" class="form-label">Carrera</label>
                        <select class="form-select" id="filterCarrera">
                            <option value="">Todas</option>
                            <option value="Ingeniería Informática">Ingeniería Informática</option>
                            <option value="Ingeniería Industrial">Ingeniería Industrial</option>
                            <option value="Administración">Administración</option>
                            <option value="Contabilidad">Contabilidad</option>
                            <option value="Marketing">Marketing</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label for="filterSemestre" class="form-label">Semestre</label>
                        <select class="form-select" id="filterSemestre">
                            <option value="">Todos</option>
                            <option value="1">1er Semestre</option>
                            <option value="2">2do Semestre</option>
                            <option value="3">3er Semestre</option>
                            <option value="4">4to Semestre</option>
                            <option value="5">5to Semestre</option>
                            <option value="6">6to Semestre</option>
                            <option value="7">7mo Semestre</option>
                            <option value="8">8vo Semestre</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label for="filterEstado" class="form-label">Estado</label>
                        <select class="form-select" id="filterEstado">
                            <option value="">Todos</option>
                            <option value="Activo">Activo</option>
                            <option value="Inactivo">Inactivo</option>
                            <option value="Graduado">Graduado</option>
                            <option value="Retirado">Retirado</option>
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

<!-- Tabla de Estudiantes -->
<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover" id="tablaEstudiantes">
                <thead class="table-light">
                    <tr>
                        <th>
                            <input type="checkbox" class="form-check-input" id="selectAll">
                        </th>
                        <th>Estudiante</th>
                        <th>Cédula</th>
                        <th>Carrera</th>
                        <th>Semestre</th>
                        <th>Estado</th>
                        <th>Ficha</th>
                        <th>Becas</th>
                        <th>Tickets</th>
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
                                <img src="<?= base_url('sistema/assets/images/profile/user-1.jpg') ?>" 
                                     class="rounded-circle me-2" width="32" height="32" alt="Foto">
                                <div>
                                    <div class="fw-bold">María González</div>
                                    <small class="text-muted">maria.gonzalez@estudiante.itsi.edu.ec</small>
                                </div>
                            </div>
                        </td>
                        <td>1723456789</td>
                        <td>Ingeniería Informática</td>
                        <td>6to</td>
                        <td>
                            <span class="badge bg-success">Activo</span>
                        </td>
                        <td>
                            <span class="badge bg-success">Completada</span>
                        </td>
                        <td>
                            <span class="badge bg-info">1 Beca</span>
                        </td>
                        <td>
                            <span class="badge bg-warning">2 Abiertos</span>
                        </td>
                        <td>
                            <div class="btn-group" role="group">
                                <button type="button" class="btn btn-sm btn-outline-primary" 
                                        onclick="verEstudiante(1)" title="Ver Perfil">
                                    <i class="bi bi-eye"></i>
                                </button>
                                <button type="button" class="btn btn-sm btn-outline-secondary" 
                                        onclick="editarEstudiante(1)" title="Editar">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <button type="button" class="btn btn-sm btn-outline-info" 
                                        onclick="verFichas(1)" title="Ver Fichas">
                                    <i class="bi bi-file-earmark-text"></i>
                                </button>
                                <button type="button" class="btn btn-sm btn-outline-warning" 
                                        onclick="verBecas(1)" title="Ver Becas">
                                    <i class="bi bi-award"></i>
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
                                <img src="<?= base_url('sistema/assets/images/profile/user-2.jpg') ?>" 
                                     class="rounded-circle me-2" width="32" height="32" alt="Foto">
                                <div>
                                    <div class="fw-bold">Carlos Rodríguez</div>
                                    <small class="text-muted">carlos.rodriguez@estudiante.itsi.edu.ec</small>
                                </div>
                            </div>
                        </td>
                        <td>1754321098</td>
                        <td>Ingeniería Industrial</td>
                        <td>4to</td>
                        <td>
                            <span class="badge bg-success">Activo</span>
                        </td>
                        <td>
                            <span class="badge bg-success">Completada</span>
                        </td>
                        <td>
                            <span class="badge bg-info">2 Becas</span>
                        </td>
                        <td>
                            <span class="badge bg-success">0 Abiertos</span>
                        </td>
                        <td>
                            <div class="btn-group" role="group">
                                <button type="button" class="btn btn-sm btn-outline-primary" 
                                        onclick="verEstudiante(2)" title="Ver Perfil">
                                    <i class="bi bi-eye"></i>
                                </button>
                                <button type="button" class="btn btn-sm btn-outline-secondary" 
                                        onclick="editarEstudiante(2)" title="Editar">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <button type="button" class="btn btn-sm btn-outline-info" 
                                        onclick="verFichas(2)" title="Ver Fichas">
                                    <i class="bi bi-file-earmark-text"></i>
                                </button>
                                <button type="button" class="btn btn-sm btn-outline-warning" 
                                        onclick="verBecas(2)" title="Ver Becas">
                                    <i class="bi bi-award"></i>
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
                                    <div class="fw-bold">Ana Martínez</div>
                                    <small class="text-muted">ana.martinez@estudiante.itsi.edu.ec</small>
                                </div>
                            </div>
                        </td>
                        <td>1798765432</td>
                        <td>Administración</td>
                        <td>2do</td>
                        <td>
                            <span class="badge bg-success">Activo</span>
                        </td>
                        <td>
                            <span class="badge bg-warning">Pendiente</span>
                        </td>
                        <td>
                            <span class="badge bg-secondary">Sin Becas</span>
                        </td>
                        <td>
                            <span class="badge bg-danger">1 Urgente</span>
                        </td>
                        <td>
                            <div class="btn-group" role="group">
                                <button type="button" class="btn btn-sm btn-outline-primary" 
                                        onclick="verEstudiante(3)" title="Ver Perfil">
                                    <i class="bi bi-eye"></i>
                                </button>
                                <button type="button" class="btn btn-sm btn-outline-secondary" 
                                        onclick="editarEstudiante(3)" title="Editar">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <button type="button" class="btn btn-sm btn-outline-info" 
                                        onclick="verFichas(3)" title="Ver Fichas">
                                    <i class="bi bi-file-earmark-text"></i>
                                </button>
                                <button type="button" class="btn btn-sm btn-outline-warning" 
                                        onclick="verBecas(3)" title="Ver Becas">
                                    <i class="bi bi-award"></i>
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
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item">
                    <a class="page-link" href="#">Siguiente</a>
                </li>
            </ul>
        </nav>
    </div>
</div>

<!-- Distribución por Carrera -->
<div class="row mt-4">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Distribución por Carrera</h5>
            </div>
            <div class="card-body">
                <canvas id="chartCarreras" width="400" height="200"></canvas>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Distribución por Semestre</h5>
            </div>
            <div class="card-body">
                <canvas id="chartSemestres" width="400" height="200"></canvas>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('modal') ?>
<!-- Modal Ver Estudiante -->
<div class="modal fade" id="modalVerEstudiante" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Perfil del Estudiante</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4 text-center">
                        <img src="<?= base_url('sistema/assets/images/profile/user-1.jpg') ?>" 
                             class="rounded-circle mb-3" width="120" height="120" alt="Foto">
                        <h5>María González</h5>
                        <p class="text-muted">Ingeniería Informática - 6to Semestre</p>
                        <span class="badge bg-success">Activo</span>
                    </div>
                    <div class="col-md-8">
                        <h6>Información Personal</h6>
                        <div class="row">
                            <div class="col-md-6">
                                <table class="table table-sm">
                                    <tr><td><strong>Cédula:</strong></td><td>1723456789</td></tr>
                                    <tr><td><strong>Email:</strong></td><td>maria.gonzalez@estudiante.itsi.edu.ec</td></tr>
                                    <tr><td><strong>Teléfono:</strong></td><td>0987654321</td></tr>
                                    <tr><td><strong>Dirección:</strong></td><td>Quito, Ecuador</td></tr>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <table class="table table-sm">
                                    <tr><td><strong>Carrera:</strong></td><td>Ingeniería Informática</td></tr>
                                    <tr><td><strong>Semestre:</strong></td><td>6to</td></tr>
                                    <tr><td><strong>Promedio:</strong></td><td>8.7/10</td></tr>
                                    <tr><td><strong>Estado:</strong></td><td><span class="badge bg-success">Activo</span></td></tr>
                                </table>
                            </div>
                        </div>
                        
                        <hr>
                        
                        <h6>Resumen de Actividad</h6>
                        <div class="row">
                            <div class="col-md-3 text-center">
                                <div class="card bg-primary text-white">
                                    <div class="card-body p-2">
                                        <h6 class="mb-0">1</h6>
                                        <small>Fichas Completadas</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 text-center">
                                <div class="card bg-success text-white">
                                    <div class="card-body p-2">
                                        <h6 class="mb-0">1</h6>
                                        <small>Becas Activas</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 text-center">
                                <div class="card bg-warning text-white">
                                    <div class="card-body p-2">
                                        <h6 class="mb-0">2</h6>
                                        <small>Tickets Abiertos</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 text-center">
                                <div class="card bg-info text-white">
                                    <div class="card-body p-2">
                                        <h6 class="mb-0">5</h6>
                                        <small>Tickets Resueltos</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" onclick="editarEstudianteDesdeModal()">
                    <i class="bi bi-pencil"></i> Editar
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Nuevo Estudiante -->
<div class="modal fade" id="nuevoEstudianteModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Registrar Nuevo Estudiante</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="formNuevoEstudiante">
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
                            <label class="form-label">Dirección</label>
                            <input type="text" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Carrera</label>
                            <select class="form-select" required>
                                <option value="">Seleccionar carrera...</option>
                                <option value="Ingeniería Informática">Ingeniería Informática</option>
                                <option value="Ingeniería Industrial">Ingeniería Industrial</option>
                                <option value="Administración">Administración</option>
                                <option value="Contabilidad">Contabilidad</option>
                                <option value="Marketing">Marketing</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Semestre</label>
                            <select class="form-select" required>
                                <option value="">Seleccionar semestre...</option>
                                <option value="1">1er Semestre</option>
                                <option value="2">2do Semestre</option>
                                <option value="3">3er Semestre</option>
                                <option value="4">4to Semestre</option>
                                <option value="5">5to Semestre</option>
                                <option value="6">6to Semestre</option>
                                <option value="7">7mo Semestre</option>
                                <option value="8">8vo Semestre</option>
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
                <button type="button" class="btn btn-success" onclick="crearNuevoEstudiante()">
                    <i class="bi bi-plus-circle"></i> Registrar Estudiante
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
                        <label class="form-label">Rango de Fechas de Registro</label>
                        <div class="input-group">
                            <input type="date" class="form-control" id="fechaDesde">
                            <span class="input-group-text">hasta</span>
                            <input type="date" class="form-control" id="fechaHasta">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Rango de Promedios</label>
                        <div class="input-group">
                            <input type="number" class="form-control" id="promedioMin" step="0.1" placeholder="Mínimo">
                            <span class="input-group-text">-</span>
                            <input type="number" class="form-control" id="promedioMax" step="0.1" placeholder="Máximo">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Estado de Fichas</label>
                        <select class="form-select" id="filterEstadoFichas">
                            <option value="">Todos</option>
                            <option value="Completada">Completada</option>
                            <option value="Pendiente">Pendiente</option>
                            <option value="Sin Ficha">Sin Ficha</option>
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Estado de Becas</label>
                        <select class="form-select" id="filterEstadoBecas">
                            <option value="">Todos</option>
                            <option value="Con Becas">Con Becas</option>
                            <option value="Sin Becas">Sin Becas</option>
                            <option value="Pendiente">Pendiente</option>
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
function verEstudiante(id) {
    $('#modalVerEstudiante').modal('show');
}

function editarEstudiante(id) {
    window.location.href = '<?= base_url('index.php/estudiantes/editar/') ?>' + id;
}

function verFichas(id) {
    window.location.href = '<?= base_url('index.php/fichas/estudiante/') ?>' + id;
}

function verBecas(id) {
    window.location.href = '<?= base_url('index.php/becas/estudiante/') ?>' + id;
}

function limpiarFiltros() {
    $('#searchEstudiante').val('');
    $('#filterCarrera').val('');
    $('#filterSemestre').val('');
    $('#filterEstado').val('');
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

function exportarEstudiantes() {
    if (confirm('¿Desea exportar la lista de estudiantes?')) {
        // Lógica para exportar estudiantes
        alert('Estudiantes exportados exitosamente');
    }
}

function crearNuevoEstudiante() {
    if (confirm('¿Está seguro de que desea registrar este nuevo estudiante?')) {
        $('#nuevoEstudianteModal').modal('hide');
        alert('Estudiante registrado exitosamente');
    }
}

function editarEstudianteDesdeModal() {
    $('#modalVerEstudiante').modal('hide');
    // Lógica para editar estudiante
    alert('Redirigiendo a edición...');
}

// Select all functionality
$('#selectAll').change(function() {
    $('.select-item').prop('checked', $(this).is(':checked'));
});

// Initialize charts when document is ready
$(document).ready(function() {
    // Gráfico de Distribución por Carrera
    const ctxCarreras = document.getElementById('chartCarreras').getContext('2d');
    new Chart(ctxCarreras, {
        type: 'doughnut',
        data: {
            labels: ['Ing. Informática', 'Ing. Industrial', 'Administración', 'Contabilidad', 'Marketing', 'Otros'],
            datasets: [{
                data: [245, 198, 167, 145, 123, 369],
                backgroundColor: [
                    '#007bff', '#28a745', '#ffc107', '#dc3545', '#6f42c1', '#6c757d'
                ]
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false
        }
    });
    
    // Gráfico de Distribución por Semestre
    const ctxSemestres = document.getElementById('chartSemestres').getContext('2d');
    new Chart(ctxSemestres, {
        type: 'bar',
        data: {
            labels: ['1er', '2do', '3er', '4to', '5to', '6to', '7mo', '8vo'],
            datasets: [{
                label: 'Estudiantes',
                data: [156, 189, 167, 145, 123, 98, 76, 45],
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