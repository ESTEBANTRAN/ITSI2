<?= $this->extend('layouts/mainAdmin') ?>

<?= $this->section('content') ?>

<div class="container-fluid">
    <!-- Header -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <i class="fas fa-calendar-alt mr-2"></i>Gestión de Períodos Académicos
        </h1>
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalCrearPeriodo">
            <i class="fas fa-plus mr-1"></i>Nuevo Período
        </button>
    </div>

    <!-- Estadísticas -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Períodos</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="totalPeriodos">0</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
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
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Períodos Activos</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="periodosActivos">0</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-check-circle fa-2x text-gray-300"></i>
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
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Fichas Activas</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="fichasActivas">0</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-file-alt fa-2x text-gray-300"></i>
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
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Becas Activas</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="becasActivas">0</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-award fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Gráficos de Estadísticas -->
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Estadísticas Generales</h6>
                    <button type="button" class="btn btn-sm btn-outline-primary" onclick="exportarGrafico('chartGeneral', 'Estadisticas_Periodos')">
                        <i class="fas fa-download"></i> Exportar PNG
                    </button>
                </div>
                <div class="card-body">
                    <div class="chart-container" style="position: relative; height: 300px;">
                        <canvas id="chartGeneral"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Distribución por Estado</h6>
                    <button type="button" class="btn btn-sm btn-outline-primary" onclick="exportarGrafico('chartEstados', 'Distribucion_Estados_Periodos')">
                        <i class="fas fa-download"></i> Exportar PNG
                    </button>
                </div>
                <div class="card-body">
                    <div class="chart-container" style="position: relative; height: 300px;">
                        <canvas id="chartEstados"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Fichas vs Becas por Período</h6>
                    <button type="button" class="btn btn-sm btn-outline-primary" onclick="exportarGrafico('chartFichasBecas', 'Fichas_vs_Becas')">
                        <i class="fas fa-download"></i> Exportar PNG
                    </button>
                </div>
                <div class="card-body">
                    <div class="chart-container" style="position: relative; height: 300px;">
                        <canvas id="chartFichasBecas"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Tendencias por Mes</h6>
                    <button type="button" class="btn btn-sm btn-outline-primary" onclick="exportarGrafico('chartTendencias', 'Tendencias_Periodos')">
                        <i class="fas fa-download"></i> Exportar PNG
                    </button>
                </div>
                <div class="card-body">
                    <div class="chart-container" style="position: relative; height: 300px;">
                        <canvas id="chartTendencias"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filtros Avanzados -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                <i class="fas fa-filter mr-1"></i>Filtros Avanzados
            </h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="filtroNombre" class="font-weight-bold text-dark">
                            <i class="fas fa-search mr-1"></i>Nombre del Período
                        </label>
                        <input type="text" class="form-control" id="filtroNombre" placeholder="Buscar por nombre...">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="filtroEstado" class="font-weight-bold text-dark">
                            <i class="fas fa-toggle-on mr-1"></i>Estado
                        </label>
                        <select class="form-control" id="filtroEstado">
                            <option value="">Todos los estados</option>
                            <option value="1">Activo</option>
                            <option value="0">Inactivo</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="filtroFichas" class="font-weight-bold text-dark">
                            <i class="fas fa-file-alt mr-1"></i>Fichas
                        </label>
                        <select class="form-control" id="filtroFichas">
                            <option value="">Todas las fichas</option>
                            <option value="1">Fichas Activas</option>
                            <option value="0">Fichas Inactivas</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="filtroBecas" class="font-weight-bold text-dark">
                            <i class="fas fa-award mr-1"></i>Becas
                        </label>
                        <select class="form-control" id="filtroBecas">
                            <option value="">Todas las becas</option>
                            <option value="1">Becas Activas</option>
                            <option value="0">Becas Inactivas</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="filtroFecha" class="font-weight-bold text-dark">
                            <i class="fas fa-calendar mr-1"></i>Fecha
                        </label>
                        <select class="form-control" id="filtroFecha">
                            <option value="">Todas las fechas</option>
                            <option value="vigente">Períodos vigentes</option>
                            <option value="pasado">Períodos pasados</option>
                            <option value="futuro">Períodos futuros</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-1">
                    <div class="form-group">
                        <label class="font-weight-bold text-dark">&nbsp;</label>
                        <button type="button" class="btn btn-primary btn-block" onclick="aplicarFiltros()">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-12">
                    <button type="button" class="btn btn-outline-secondary btn-sm" onclick="limpiarFiltros()">
                        <i class="fas fa-times mr-1"></i>Limpiar Filtros
                    </button>
                    <span class="ml-2 text-muted" id="filtrosActivos"></span>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabla de Períodos -->
    <div class="card shadow">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">
                <i class="fas fa-list mr-1"></i>Períodos Académicos
            </h6>
            <div class="d-flex align-items-center">
                <span class="text-muted mr-2" id="contadorPeriodos">Mostrando 0 períodos</span>
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-outline-primary btn-sm" onclick="exportarPeriodos('excel')">
                        <i class="fas fa-file-excel mr-1"></i>Excel
                    </button>
                    <button type="button" class="btn btn-outline-danger btn-sm" onclick="exportarPeriodos('pdf')">
                        <i class="fas fa-file-pdf mr-1"></i>PDF
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover" id="tablaPeriodos">
                    <thead class="thead-dark">
                        <tr>
                            <th class="text-center" style="width: 5%;">ID</th>
                            <th style="width: 20%;">Nombre</th>
                            <th class="text-center" style="width: 12%;">Fecha Inicio</th>
                            <th class="text-center" style="width: 12%;">Fecha Fin</th>
                            <th class="text-center" style="width: 10%;">Estado</th>
                            <th class="text-center" style="width: 10%;">Fichas</th>
                            <th class="text-center" style="width: 10%;">Becas</th>
                            <th class="text-center" style="width: 21%;">Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="tbodyPeriodos">
                        <tr>
                            <td colspan="8" class="text-center text-muted">
                                <i class="fas fa-spinner fa-spin mr-2"></i>Cargando períodos...
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
            <!-- Paginación -->
            <div class="d-flex justify-content-between align-items-center mt-3">
                <div class="text-muted" id="infoPaginacion">
                    Mostrando 0 a 0 de 0 períodos
                </div>
                <nav aria-label="Paginación de períodos">
                    <ul class="pagination pagination-sm mb-0" id="paginacionPeriodos">
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>

<!-- Modal Crear Período -->
<div class="modal fade" id="modalCrearPeriodo" tabindex="-1" role="dialog" aria-labelledby="modalCrearPeriodoLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="modalCrearPeriodoLabel">
                    <i class="fas fa-plus mr-2"></i>Crear Nuevo Período Académico
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="formCrearPeriodo">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="nombre" class="font-weight-bold">
                                    <i class="fas fa-calendar mr-1"></i>Nombre del Período *
                                </label>
                                <input type="text" class="form-control form-control-lg" id="nombre" name="nombre" required placeholder="Ej: Período Académico 2024-2025">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="fecha_inicio" class="font-weight-bold">
                                    <i class="fas fa-calendar-plus mr-1"></i>Fecha de Inicio *
                                </label>
                                <input type="date" class="form-control form-control-lg" id="fecha_inicio" name="fecha_inicio" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="fecha_fin" class="font-weight-bold">
                                    <i class="fas fa-calendar-minus mr-1"></i>Fecha de Fin *
                                </label>
                                <input type="date" class="form-control form-control-lg" id="fecha_fin" name="fecha_fin" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="estado" class="font-weight-bold">
                                    <i class="fas fa-toggle-on mr-1"></i>Estado del Período *
                                </label>
                                <select class="form-control form-control-lg" id="estado" name="estado" required>
                                    <option value="">Seleccionar estado</option>
                                    <option value="Activo">Activo</option>
                                    <option value="Inactivo">Inactivo</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="descripcion" class="font-weight-bold">
                                    <i class="fas fa-align-left mr-1"></i>Descripción
                                </label>
                                <textarea class="form-control" id="descripcion" name="descripcion" rows="3" placeholder="Descripción del período académico..."></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="limite_fichas" class="font-weight-bold">
                                    <i class="fas fa-file-alt mr-1"></i>Límite de Fichas
                                </label>
                                <input type="number" class="form-control form-control-lg" id="limite_fichas" name="limite_fichas" min="0" placeholder="Número máximo de fichas">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="limite_becas" class="font-weight-bold">
                                    <i class="fas fa-award mr-1"></i>Límite de Becas
                                </label>
                                <input type="number" class="form-control form-control-lg" id="limite_becas" name="limite_becas" min="0" placeholder="Número máximo de becas">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        <i class="fas fa-times mr-1"></i>Cancelar
                    </button>
                    <button type="button" class="btn btn-primary" id="btnCrearPeriodo" onclick="crearPeriodo()">
                        <i class="fas fa-save mr-1"></i>Crear Período
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
/* CSS para asegurar texto negro en toda la tabla */
#tablaPeriodos tbody td,
#tablaPeriodos tbody td *,
#tablaPeriodos tbody td span,
#tablaPeriodos tbody td div,
#tablaPeriodos tbody td strong,
#tablaPeriodos tbody td .badge,
#tablaPeriodos tbody td .badge * {
    color: #000 !important;
    font-weight: 700 !important;
}

/* Excepción para badges de estado */
#tablaPeriodos tbody td .badge.badge-success,
#tablaPeriodos tbody td .badge.badge-warning,
#tablaPeriodos tbody td .badge.badge-danger,
#tablaPeriodos tbody td .badge.badge-info,
#tablaPeriodos tbody td .badge.badge-secondary {
    color: #fff !important;
}

/* Estilos para filtros */
.card-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
}

.form-control:focus {
    border-color: #667eea;
    box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
}

/* Animaciones */
.table-hover tbody tr:hover {
    background-color: rgba(102, 126, 234, 0.1);
    transform: scale(1.01);
    transition: all 0.2s ease;
}

/* Responsive */
@media (max-width: 768px) {
    .card-body .row > div {
        margin-bottom: 1rem;
    }
}
</style>

<script>
// Variables globales
let periodosData = [];
let periodosFiltrados = [];
let paginaActual = 1;
const periodosPorPagina = 10;
let filtrosAplicados = {};

// Inicialización
$(document).ready(function() {
    console.log('Document ready - iniciando carga de períodos...');
    cargarPeriodos();
    
    // Eventos de filtros
    $('#filtroNombre').on('input', aplicarFiltros);
    $('#filtroEstado, #filtroFichas, #filtroBecas, #filtroFecha').on('change', aplicarFiltros);
});

// Cargar períodos desde el servidor
function cargarPeriodos() {
    console.log('Cargando períodos...');
    $.ajax({
        url: '<?= base_url('index.php/admin-bienestar/obtener-periodos-academicos') ?>',
        type: 'GET',
        success: function(response) {
            console.log('Respuesta períodos:', response);
            if (response.success) {
                periodosData = response.data;
                console.log('Períodos cargados:', periodosData.length);
                aplicarFiltros();
                cargarEstadisticas();
            } else {
                console.error('Error al cargar períodos:', response.message);
                mostrarError('Error al cargar períodos: ' + response.message);
            }
        },
        error: function(xhr, status, error) {
            console.error('Error AJAX períodos:', status, error);
            console.error('Respuesta del servidor:', xhr.responseText);
            mostrarError('Error de conexión al cargar períodos');
        }
    });
}

// Aplicar filtros
function aplicarFiltros() {
    console.log('Aplicando filtros períodos...');
    console.log('periodosData disponible:', typeof periodosData !== 'undefined' ? periodosData.length : 'undefined');
    
    if (typeof periodosData === 'undefined' || !periodosData) {
        console.error('periodosData no está disponible para filtrar');
        return;
    }
    
    const nombreFiltro = $('#filtroNombre').val().toLowerCase();
    const estadoFiltro = $('#filtroEstado').val();
    const fichasFiltro = $('#filtroFichas').val();
    const becasFiltro = $('#filtroBecas').val();
    const fechaFiltro = $('#filtroFecha').val();
    
    filtrosAplicados = { 
        nombre: nombreFiltro, 
        estado: estadoFiltro, 
        fichas: fichasFiltro,
        becas: becasFiltro,
        fecha: fechaFiltro
    };
    
    periodosFiltrados = periodosData.filter(periodo => {
        const cumpleNombre = !nombreFiltro || periodo.nombre.toLowerCase().includes(nombreFiltro);
        const cumpleEstado = !estadoFiltro || periodo.activo == estadoFiltro;
        const cumpleFichas = !fichasFiltro || periodo.activo_fichas == fichasFiltro;
        const cumpleBecas = !becasFiltro || periodo.activo_becas == becasFiltro;
        
        let cumpleFecha = true;
        if (fechaFiltro) {
            const hoy = new Date();
            const fechaInicio = new Date(periodo.fecha_inicio);
            const fechaFin = new Date(periodo.fecha_fin);
            
            if (fechaFiltro === 'vigente') {
                cumpleFecha = fechaInicio <= hoy && fechaFin >= hoy;
            } else if (fechaFiltro === 'pasado') {
                cumpleFecha = fechaFin < hoy;
            } else if (fechaFiltro === 'futuro') {
                cumpleFecha = fechaInicio > hoy;
            }
        }
        
        return cumpleNombre && cumpleEstado && cumpleFichas && cumpleBecas && cumpleFecha;
    });
    
    console.log('Períodos filtrados:', periodosFiltrados.length);
    
    paginaActual = 1;
    mostrarPeriodosPaginados();
    actualizarFiltrosActivos();
}

// Limpiar filtros
function limpiarFiltros() {
    $('#filtroNombre').val('');
    $('#filtroEstado').val('');
    $('#filtroFichas').val('');
    $('#filtroBecas').val('');
    $('#filtroFecha').val('');
    aplicarFiltros();
}

// Actualizar filtros activos
function actualizarFiltrosActivos() {
    const filtros = [];
    if (filtrosAplicados.nombre) filtros.push(`Nombre: "${filtrosAplicados.nombre}"`);
    if (filtrosAplicados.estado) {
        const estadoText = filtrosAplicados.estado === '1' ? 'Activo' : 'Inactivo';
        filtros.push(`Estado: ${estadoText}`);
    }
    if (filtrosAplicados.fichas) {
        const fichasText = filtrosAplicados.fichas === '1' ? 'Activas' : 'Inactivas';
        filtros.push(`Fichas: ${fichasText}`);
    }
    if (filtrosAplicados.becas) {
        const becasText = filtrosAplicados.becas === '1' ? 'Activas' : 'Inactivas';
        filtros.push(`Becas: ${becasText}`);
    }
    if (filtrosAplicados.fecha) {
        const fechaText = {
            'vigente': 'Vigentes',
            'pasado': 'Pasados',
            'futuro': 'Futuros'
        }[filtrosAplicados.fecha];
        filtros.push(`Fecha: ${fechaText}`);
    }
    
    $('#filtrosActivos').text(filtros.length > 0 ? `Filtros activos: ${filtros.join(', ')}` : '');
}

// Mostrar períodos paginados
function mostrarPeriodosPaginados() {
    console.log('Mostrando períodos paginados...');
    console.log('periodosFiltrados:', periodosFiltrados ? periodosFiltrados.length : 'undefined');
    console.log('paginaActual:', paginaActual);
    
    if (typeof periodosFiltrados === 'undefined' || !periodosFiltrados) {
        console.error('periodosFiltrados no está disponible');
        return;
    }
    
    const inicio = (paginaActual - 1) * periodosPorPagina;
    const fin = inicio + periodosPorPagina;
    const periodosPagina = periodosFiltrados.slice(inicio, fin);
    
    console.log('Períodos para mostrar en esta página:', periodosPagina.length);
    
    const tbody = $('#tbodyPeriodos');
    tbody.empty();
    
    if (periodosFiltrados.length === 0) {
        tbody.html(`
            <tr>
                <td colspan="8" class="text-center text-muted">
                    <i class="fas fa-search mr-2"></i>No se encontraron períodos con los filtros aplicados
                </td>
            </tr>
        `);
        actualizarPaginacion(0);
        actualizarContadores(0);
        return;
    }
    
    periodosPagina.forEach(function(periodo) {
        const tr = `
            <tr>
                <td class="text-center font-weight-bold">${periodo.id}</td>
                <td>
                    <div class="font-weight-bold text-primary">${periodo.nombre}</div>
                    <small class="text-muted">${periodo.descripcion || 'Sin descripción'}</small>
                </td>
                <td class="text-center">
                    <div class="fecha-display">
                        <i class="fas fa-calendar-plus text-success mr-1"></i>
                        <span class="badge badge-success badge-pill text-white fecha-text" style="color: #000 !important; font-weight: 700 !important;">${formatearFecha(periodo.fecha_inicio)}</span>
                    </div>
                </td>
                <td class="text-center">
                    <div class="fecha-display">
                        <i class="fas fa-calendar-minus text-danger mr-1"></i>
                        <span class="badge badge-danger badge-pill text-white fecha-text" style="color: #000 !important; font-weight: 700 !important;">${formatearFecha(periodo.fecha_fin)}</span>
                    </div>
                </td>
                <td class="text-center">
                    <span class="badge badge-${periodo.activo == 1 ? 'success' : 'secondary'} badge-pill estado-badge text-white" style="color: #000 !important; font-weight: 700 !important;">
                        <i class="fas fa-${periodo.activo == 1 ? 'check-circle' : 'times-circle'} mr-1" style="color: #000 !important;"></i>
                        <span class="estado-text" style="color: #000 !important; font-weight: 700 !important;">${periodo.activo == 1 ? 'Activo' : 'Inactivo'}</span>
                    </span>
                </td>
                <td class="text-center">
                    <span class="badge badge-${periodo.activo_fichas == 1 ? 'success' : 'secondary'} badge-pill fichas-badge text-white" style="color: #000 !important; font-weight: 700 !important;">
                        <i class="fas fa-${periodo.activo_fichas == 1 ? 'check-circle' : 'times-circle'} mr-1" style="color: #000 !important;"></i>
                        <span class="fichas-text" style="color: #000 !important; font-weight: 700 !important;">${periodo.activo_fichas == 1 ? 'Activas' : 'Inactivas'}</span>
                    </span>
                </td>
                <td class="text-center">
                    <span class="badge badge-${periodo.activo_becas == 1 ? 'success' : 'secondary'} badge-pill becas-badge text-white" style="color: #000 !important; font-weight: 700 !important;">
                        <i class="fas fa-${periodo.activo_becas == 1 ? 'check-circle' : 'times-circle'} mr-1" style="color: #000 !important;"></i>
                        <span class="becas-text" style="color: #000 !important; font-weight: 700 !important;">${periodo.activo_becas == 1 ? 'Activas' : 'Inactivas'}</span>
                    </span>
                </td>
                <td class="text-center">
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-sm btn-outline-primary" onclick="editarPeriodo(${periodo.id})" title="Editar">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button type="button" class="btn btn-sm btn-outline-${periodo.activo == 1 ? 'warning' : 'success'}" 
                                onclick="toggleEstadoPeriodo(${periodo.id}, ${periodo.activo})" title="${periodo.activo == 1 ? 'Desactivar' : 'Activar'}">
                            <i class="fas fa-${periodo.activo == 1 ? 'pause' : 'play'}"></i>
                        </button>
                        <button type="button" class="btn btn-sm btn-outline-info" 
                                onclick="toggleFichas(${periodo.id}, ${periodo.activo_fichas})" title="${periodo.activo_fichas == 1 ? 'Desactivar' : 'Activar'} fichas">
                            <i class="fas fa-file-alt"></i>
                        </button>
                        <button type="button" class="btn btn-sm btn-outline-warning" 
                                onclick="toggleBecas(${periodo.id}, ${periodo.activo_becas})" title="${periodo.activo_becas == 1 ? 'Desactivar' : 'Activar'} becas">
                            <i class="fas fa-award"></i>
                        </button>
                        <button type="button" class="btn btn-sm btn-outline-danger" onclick="eliminarPeriodo(${periodo.id})" title="Eliminar">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </td>
            </tr>
        `;
        tbody.append(tr);
    });
    
    actualizarPaginacion(periodosFiltrados.length);
    actualizarContadores(periodosFiltrados.length);
}

// Actualizar paginación
function actualizarPaginacion(totalPeriodos) {
    const totalPaginas = Math.ceil(totalPeriodos / periodosPorPagina);
    const paginacion = $('#paginacionPeriodos');
    paginacion.empty();
    
    if (totalPaginas <= 1) return;
    
    // Botón anterior
    const btnAnterior = `
        <li class="page-item ${paginaActual === 1 ? 'disabled' : ''}">
            <a class="page-link" href="#" onclick="cambiarPagina(${paginaActual - 1})">
                <i class="fas fa-chevron-left"></i>
            </a>
        </li>
    `;
    paginacion.append(btnAnterior);
    
    // Números de página
    for (let i = 1; i <= totalPaginas; i++) {
        if (i === 1 || i === totalPaginas || (i >= paginaActual - 2 && i <= paginaActual + 2)) {
            const btnPagina = `
                <li class="page-item ${i === paginaActual ? 'active' : ''}">
                    <a class="page-link" href="#" onclick="cambiarPagina(${i})">${i}</a>
                </li>
            `;
            paginacion.append(btnPagina);
        } else if (i === paginaActual - 3 || i === paginaActual + 3) {
            paginacion.append('<li class="page-item disabled"><span class="page-link">...</span></li>');
        }
    }
    
    // Botón siguiente
    const btnSiguiente = `
        <li class="page-item ${paginaActual === totalPaginas ? 'disabled' : ''}">
            <a class="page-link" href="#" onclick="cambiarPagina(${paginaActual + 1})">
                <i class="fas fa-chevron-right"></i>
            </a>
        </li>
    `;
    paginacion.append(btnSiguiente);
}

// Cambiar página
function cambiarPagina(pagina) {
    if (pagina < 1 || pagina > Math.ceil(periodosFiltrados.length / periodosPorPagina)) return;
    paginaActual = pagina;
    mostrarPeriodosPaginados();
}

// Actualizar contadores
function actualizarContadores(totalPeriodos) {
    const inicio = (paginaActual - 1) * periodosPorPagina + 1;
    const fin = Math.min(paginaActual * periodosPorPagina, totalPeriodos);
    
    $('#contadorPeriodos').text(`Mostrando ${inicio} a ${fin} de ${totalPeriodos} períodos`);
    $('#infoPaginacion').text(`Mostrando ${inicio} a ${fin} de ${totalPeriodos} períodos`);
}

// Formatear fecha
function formatearFecha(fecha) {
    if (!fecha) return 'N/A';
    const d = new Date(fecha);
    return d.toLocaleDateString('es-ES', {
        day: '2-digit',
        month: '2-digit',
        year: 'numeric'
    });
}

// Crear período
function crearPeriodo() {
    const form = document.getElementById('formCrearPeriodo');
    if (!form.checkValidity()) {
        form.reportValidity();
        return;
    }
    
    const formData = new FormData(form);
    const estado = formData.get('estado');
    formData.set('activo', estado === 'Activo' ? '1' : '0');
    formData.append('activo_fichas', '1');
    formData.append('activo_becas', '1');
    
    $('#btnCrearPeriodo').prop('disabled', true).html('<i class="fas fa-spinner fa-spin mr-1"></i>Creando...');
    
    $.ajax({
        url: '<?= base_url('index.php/admin-bienestar/crear-periodo') ?>',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
            if (response.success) {
                Swal.fire({
                    icon: 'success',
                    title: '¡Éxito!',
                    text: response.message,
                    timer: 2000,
                    showConfirmButton: false
                });
                $('#modalCrearPeriodo').modal('hide');
                form.reset();
                cargarPeriodos();
                cargarEstadisticas();
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: response.message
                });
            }
        },
        error: function(xhr, status, error) {
            Swal.fire({
                icon: 'error',
                title: 'Error de conexión',
                text: 'No se pudo conectar con el servidor'
            });
        },
        complete: function() {
            $('#btnCrearPeriodo').prop('disabled', false).html('<i class="fas fa-save mr-1"></i>Crear Período');
        }
    });
}

// Cargar estadísticas
function cargarEstadisticas() {
    console.log('Cargando estadísticas de períodos...');
    console.log('periodosData disponible:', typeof periodosData !== 'undefined' ? periodosData.length : 'undefined');
    
    if (typeof periodosData === 'undefined' || !periodosData) {
        console.error('periodosData no está disponible para estadísticas');
        return;
    }
    
    const totalPeriodos = periodosData.length;
    const periodosActivos = periodosData.filter(p => p.activo == 1).length;
    const periodosInactivos = totalPeriodos - periodosActivos;
    const fichasActivas = periodosData.filter(p => p.activo_fichas == 1).length;
    const becasActivas = periodosData.filter(p => p.activo_becas == 1).length;
    const conFichas = periodosData.filter(p => p.total_fichas > 0).length;
    const conBecas = periodosData.filter(p => p.total_becas > 0).length;
    
    $('#totalPeriodos').text(totalPeriodos);
    $('#periodosActivos').text(periodosActivos);
    $('#fichasActivas').text(fichasActivas);
    $('#becasActivas').text(becasActivas);
    
    // Actualizar gráficos si existen
    if (window.updateChartGeneral) {
        window.updateChartGeneral({
            total: totalPeriodos,
            activos: periodosActivos,
            inactivos: periodosInactivos,
            conFichas: conFichas,
            conBecas: conBecas
        });
    }
    
    if (window.updateChartEstados) {
        window.updateChartEstados({
            activos: periodosActivos,
            inactivos: periodosInactivos
        });
    }
    
    if (window.updateChartFichasBecas) {
        window.updateChartFichasBecas({
            total: totalPeriodos,
            conFichas: conFichas,
            conBecas: conBecas
        });
    }
}

// Funciones auxiliares
function mostrarError(mensaje) {
    Swal.fire({
        icon: 'error',
        title: 'Error',
        text: mensaje
    });
}

function editarPeriodo(id) {
    // Implementar edición de período
    Swal.fire({
        icon: 'info',
        title: 'Función en desarrollo',
        text: 'La edición de períodos estará disponible próximamente'
    });
}

function toggleEstadoPeriodo(id, estadoActual) {
    const nuevoEstado = estadoActual == 1 ? 0 : 1;
    
    Swal.fire({
        title: '¿Confirmar cambio?',
        text: `¿Desea cambiar el estado del período a "${nuevoEstado == 1 ? 'Activo' : 'Inactivo'}"?`,
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Sí, cambiar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: '<?= base_url('index.php/admin-bienestar/toggle-estado-periodo') ?>',
                type: 'POST',
                data: { id: id, activo: nuevoEstado },
                success: function(response) {
                    if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: '¡Éxito!',
                            text: response.message,
                            timer: 2000,
                            showConfirmButton: false
                        });
                        cargarPeriodos();
                        cargarEstadisticas();
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: response.message
                        });
                    }
                },
                error: function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error de conexión',
                        text: 'No se pudo conectar con el servidor'
                    });
                }
            });
        }
    });
}

function toggleFichas(id, estadoActual) {
    const nuevoEstado = estadoActual == 1 ? 0 : 1;
    
    if (nuevoEstado == 1) {
        const periodo = periodosData.find(p => p.id == id);
        if (periodo && periodo.activo != 1) {
            Swal.fire({
                icon: 'warning',
                title: 'No se puede activar',
                text: 'Las fichas solo se pueden activar si el período académico está activo'
            });
            return;
        }
    }
    
    Swal.fire({
        title: '¿Confirmar cambio?',
        text: `¿Desea ${nuevoEstado == 1 ? 'activar' : 'desactivar'} las fichas para este período?`,
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Sí, cambiar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: '<?= base_url('index.php/admin-bienestar/toggle-fichas-periodo') ?>',
                type: 'POST',
                data: { id: id, activo_fichas: nuevoEstado },
                success: function(response) {
                    if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: '¡Éxito!',
                            text: response.message,
                            timer: 2000,
                            showConfirmButton: false
                        });
                        cargarPeriodos();
                        cargarEstadisticas();
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: response.message
                        });
                    }
                },
                error: function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error de conexión',
                        text: 'No se pudo conectar con el servidor'
                    });
                }
            });
        }
    });
}

function toggleBecas(id, estadoActual) {
    const nuevoEstado = estadoActual == 1 ? 0 : 1;
    
    if (nuevoEstado == 1) {
        const periodo = periodosData.find(p => p.id == id);
        if (periodo && periodo.activo != 1) {
            Swal.fire({
                icon: 'warning',
                title: 'No se puede activar',
                text: 'Las becas solo se pueden activar si el período académico está activo'
            });
            return;
        }
    }
    
    Swal.fire({
        title: '¿Confirmar cambio?',
        text: `¿Desea ${nuevoEstado == 1 ? 'activar' : 'desactivar'} las becas para este período?`,
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Sí, cambiar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: '<?= base_url('index.php/admin-bienestar/toggle-becas-periodo') ?>',
                type: 'POST',
                data: { id: id, activo_becas: nuevoEstado },
                success: function(response) {
                    if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: '¡Éxito!',
                            text: response.message,
                            timer: 2000,
                            showConfirmButton: false
                        });
                        cargarPeriodos();
                        cargarEstadisticas();
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: response.message
                        });
                    }
                },
                error: function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error de conexión',
                        text: 'No se pudo conectar con el servidor'
                    });
                }
            });
        }
    });
}

function eliminarPeriodo(id) {
    Swal.fire({
        title: '¿Eliminar período?',
        text: 'Esta acción no se puede deshacer',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar',
        confirmButtonColor: '#d33'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: '<?= base_url('index.php/admin-bienestar/eliminar-periodo') ?>',
                type: 'POST',
                data: { id: id },
                success: function(response) {
                    if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: '¡Éxito!',
                            text: response.message,
                            timer: 2000,
                            showConfirmButton: false
                        });
                        cargarPeriodos();
                        cargarEstadisticas();
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: response.message
                        });
                    }
                },
                error: function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error de conexión',
                        text: 'No se pudo conectar con el servidor'
                    });
                }
            });
        }
    });
}

function exportarPeriodos(formato) {
    Swal.fire({
        icon: 'info',
        title: 'Función en desarrollo',
        text: `La exportación a ${formato.toUpperCase()} estará disponible próximamente`
    });
}

function exportarGrafico(canvasId, nombreArchivo) {
    const canvas = document.getElementById(canvasId);
    const link = document.createElement('a');
    link.download = `${nombreArchivo}.png`;
    link.href = canvas.toDataURL();
    link.click();
}

// Inicialización de gráficos cuando el DOM esté listo
document.addEventListener('DOMContentLoaded', function() {
    // Gráfico de Estadísticas Generales
    const ctxGeneral = document.getElementById('chartGeneral');
    if (ctxGeneral) {
        const chartGeneral = new Chart(ctxGeneral.getContext('2d'), {
            type: 'bar',
            data: {
                labels: ['Total Períodos', 'Activos', 'Inactivos', 'Con Fichas', 'Con Becas'],
                datasets: [{
                    label: 'Cantidad',
                    data: [0, 0, 0, 0, 0],
                    backgroundColor: [
                        '#4e73df',
                        '#1cc88a',
                        '#e74a3b',
                        '#f6c23e',
                        '#36b9cc'
                    ],
                    borderColor: [
                        '#4e73df',
                        '#1cc88a',
                        '#e74a3b',
                        '#f6c23e',
                        '#36b9cc'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });
        
        // Actualizar datos del gráfico cuando se carguen las estadísticas
        window.updateChartGeneral = function(data) {
            chartGeneral.data.datasets[0].data = [
                data.total || 0,
                data.activos || 0,
                data.inactivos || 0,
                data.conFichas || 0,
                data.conBecas || 0
            ];
            chartGeneral.update();
        };
    }

    // Gráfico de Distribución por Estado
    const ctxEstados = document.getElementById('chartEstados');
    if (ctxEstados) {
        const chartEstados = new Chart(ctxEstados.getContext('2d'), {
            type: 'doughnut',
            data: {
                labels: ['Activos', 'Inactivos'],
                datasets: [{
                    data: [0, 0],
                    backgroundColor: ['#1cc88a', '#e74a3b'],
                    borderWidth: 2,
                    borderColor: '#fff'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });
        
        window.updateChartEstados = function(data) {
            chartEstados.data.datasets[0].data = [
                data.activos || 0,
                data.inactivos || 0
            ];
            chartEstados.update();
        };
    }

    // Gráfico de Fichas vs Becas por Período
    const ctxFichasBecas = document.getElementById('chartFichasBecas');
    if (ctxFichasBecas) {
        const chartFichasBecas = new Chart(ctxFichasBecas.getContext('2d'), {
            type: 'pie',
            data: {
                labels: ['Períodos con Fichas', 'Períodos con Becas', 'Períodos sin Fichas/Becas'],
                datasets: [{
                    data: [0, 0, 0],
                    backgroundColor: ['#f6c23e', '#36b9cc', '#858796'],
                    borderWidth: 2,
                    borderColor: '#fff'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });
        
        window.updateChartFichasBecas = function(data) {
            chartFichasBecas.data.datasets[0].data = [
                data.conFichas || 0,
                data.conBecas || 0,
                (data.total || 0) - (data.conFichas || 0) - (data.conBecas || 0)
            ];
            chartFichasBecas.update();
        };
    }

    // Gráfico de Tendencias por Mes
    const ctxTendencias = document.getElementById('chartTendencias');
    if (ctxTendencias) {
        const chartTendencias = new Chart(ctxTendencias.getContext('2d'), {
            type: 'line',
            data: {
                labels: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
                datasets: [{
                    label: 'Períodos Creados',
                    data: [2, 1, 3, 2, 1, 2, 1, 3, 2, 1, 2, 1],
                    borderColor: '#4e73df',
                    backgroundColor: 'rgba(78, 115, 223, 0.1)',
                    tension: 0.4,
                    fill: true
                }, {
                    label: 'Períodos Activos',
                    data: [1, 1, 2, 1, 1, 1, 1, 2, 1, 1, 1, 1],
                    borderColor: '#1cc88a',
                    backgroundColor: 'rgba(28, 200, 138, 0.1)',
                    tension: 0.4,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                plugins: {
                    legend: {
                        position: 'top'
                    }
                }
            }
        });
    }
});
</script>

<?= $this->endSection() ?>
