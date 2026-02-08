<?= $this->extend('layouts/mainAdmin') ?>

<?= $this->section('content') ?>

<!-- Page Header -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <div>
                <h4 class="mb-0">Gestión de Fichas Socioeconómicas</h4>
                <p class="text-muted mb-0">Administra y revisa las fichas socioeconómicas de los estudiantes</p>
            </div>
            <div class="page-title-right">
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-success" onclick="exportarTodas()">
                        <i class="bi bi-file-excel"></i> Exportar Excel
                    </button>
                    <button type="button" class="btn btn-primary" onclick="generarReporte()">
                        <i class="bi bi-file-pdf"></i> Reporte PDF
                    </button>
                    <button type="button" class="btn btn-info" onclick="actualizarDatos()">
                        <i class="bi bi-arrow-clockwise"></i> Actualizar
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Tarjetas de Estadísticas -->
<div class="row mb-4">
    <div class="col-xl-2 col-md-4 col-sm-6">
        <div class="card mini-stats-wid">
            <div class="card-body">
                <div class="d-flex">
                    <div class="flex-grow-1">
                        <p class="text-muted fw-medium mb-1">Total Fichas</p>
                        <h5 class="mb-0" id="total-fichas"><?= $estadisticas['total'] ?? 0 ?></h5>
                    </div>
                    <div class="flex-shrink-0 align-self-center">
                        <div class="mini-stat-icon avatar-sm rounded-circle bg-primary">
                            <span class="avatar-title">
                                <i class="bi bi-file-earmark-text"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-xl-2 col-md-4 col-sm-6">
        <div class="card mini-stats-wid">
            <div class="card-body">
                <div class="d-flex">
                    <div class="flex-grow-1">
                        <p class="text-muted fw-medium mb-1">Enviadas</p>
                        <h5 class="mb-0 text-warning" id="fichas-enviadas">
                            <?= array_sum(array_filter($estadisticas['estados'] ?? [], function($e) { return $e['estado'] === 'Enviada'; })) ?>
                        </h5>
                    </div>
                    <div class="flex-shrink-0 align-self-center">
                        <div class="mini-stat-icon avatar-sm rounded-circle bg-warning">
                            <span class="avatar-title">
                                <i class="bi bi-clock"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-xl-2 col-md-4 col-sm-6">
        <div class="card mini-stats-wid">
            <div class="card-body">
                <div class="d-flex">
                    <div class="flex-grow-1">
                        <p class="text-muted fw-medium mb-1">En Revisión</p>
                        <h5 class="mb-0 text-info" id="fichas-revision">
                            <?= array_sum(array_filter($estadisticas['estados'] ?? [], function($e) { return $e['estado'] === 'Revisada'; })) ?>
                        </h5>
                    </div>
                    <div class="flex-shrink-0 align-self-center">
                        <div class="mini-stat-icon avatar-sm rounded-circle bg-info">
                            <span class="avatar-title">
                                <i class="bi bi-eye"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-xl-2 col-md-4 col-sm-6">
        <div class="card mini-stats-wid">
            <div class="card-body">
                <div class="d-flex">
                    <div class="flex-grow-1">
                        <p class="text-muted fw-medium mb-1">Aprobadas</p>
                        <h5 class="mb-0 text-success" id="fichas-aprobadas">
                            <?= array_sum(array_filter($estadisticas['estados'] ?? [], function($e) { return $e['estado'] === 'Aprobada'; })) ?>
                        </h5>
                    </div>
                    <div class="flex-shrink-0 align-self-center">
                        <div class="mini-stat-icon avatar-sm rounded-circle bg-success">
                            <span class="avatar-title">
                                <i class="bi bi-check-circle"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-xl-2 col-md-4 col-sm-6">
        <div class="card mini-stats-wid">
            <div class="card-body">
                <div class="d-flex">
                    <div class="flex-grow-1">
                        <p class="text-muted fw-medium mb-1">Rechazadas</p>
                        <h5 class="mb-0 text-danger" id="fichas-rechazadas">
                            <?= array_sum(array_filter($estadisticas['estados'] ?? [], function($e) { return $e['estado'] === 'Rechazada'; })) ?>
                        </h5>
                    </div>
                    <div class="flex-shrink-0 align-self-center">
                        <div class="mini-stat-icon avatar-sm rounded-circle bg-danger">
                            <span class="avatar-title">
                                <i class="bi bi-x-circle"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-xl-2 col-md-4 col-sm-6">
        <div class="card mini-stats-wid">
            <div class="card-body">
                <div class="d-flex">
                    <div class="flex-grow-1">
                        <p class="text-muted fw-medium mb-1">Con Beca</p>
                        <h5 class="mb-0 text-primary" id="fichas-con-beca">
                            <?= count(array_filter($fichas ?? [], function($f) { return !empty($f['tipo_relacion']); })) ?>
                        </h5>
                    </div>
                    <div class="flex-shrink-0 align-self-center">
                        <div class="mini-stat-icon avatar-sm rounded-circle bg-primary">
                            <span class="avatar-title">
                                <i class="bi bi-award"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Filtros Avanzados -->
<div class="card mb-4">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0">
                <i class="bi bi-funnel me-2"></i>Filtros Avanzados
            </h5>
            <div>
                <button type="button" class="btn btn-sm btn-outline-secondary" onclick="limpiarFiltros()">
                    <i class="bi bi-x-circle me-1"></i>Limpiar
                </button>
                <button type="button" class="btn btn-sm btn-primary" onclick="aplicarFiltros()">
                    <i class="bi bi-search me-1"></i>Aplicar
                </button>
            </div>
        </div>
    </div>
    <div class="card-body">
        <form id="formFiltros">
            <div class="row g-3">
                <div class="col-md-2">
                    <label for="filtro_estado" class="form-label">Estado</label>
                    <select class="form-select" id="filtro_estado" name="estado">
                        <option value="">Todos</option>
                        <option value="Enviada" <?= $filtros['estado'] === 'Enviada' ? 'selected' : '' ?>>Enviada</option>
                        <option value="Revisada" <?= $filtros['estado'] === 'Revisada' ? 'selected' : '' ?>>En Revisión</option>
                        <option value="Aprobada" <?= $filtros['estado'] === 'Aprobada' ? 'selected' : '' ?>>Aprobada</option>
                        <option value="Rechazada" <?= $filtros['estado'] === 'Rechazada' ? 'selected' : '' ?>>Rechazada</option>
                    </select>
                </div>
                
                <div class="col-md-2">
                    <label for="filtro_periodo" class="form-label">Período</label>
                    <select class="form-select" id="filtro_periodo" name="periodo_id">
                        <option value="">Todos</option>
                        <?php foreach ($periodos as $periodo): ?>
                            <option value="<?= $periodo['id'] ?>" <?= $filtros['periodo_id'] == $periodo['id'] ? 'selected' : '' ?>>
                                <?= $periodo['nombre'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                
                <div class="col-md-2">
                    <label for="filtro_carrera" class="form-label">Carrera</label>
                    <select class="form-select" id="filtro_carrera" name="carrera_id">
                        <option value="">Todas</option>
                        <?php foreach ($carreras as $carrera): ?>
                            <option value="<?= $carrera['id'] ?>" <?= $filtros['carrera_id'] == $carrera['id'] ? 'selected' : '' ?>>
                                <?= $carrera['nombre'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                
                <div class="col-md-2">
                    <label for="filtro_tipo_beca" class="form-label">Tipo Estudiante</label>
                    <select class="form-select" id="filtro_tipo_beca" name="tipo_beca">
                        <option value="">Todos</option>
                        <option value="con_beca" <?= $filtros['tipo_beca'] === 'con_beca' ? 'selected' : '' ?>>Con Beca</option>
                        <option value="sin_beca" <?= $filtros['tipo_beca'] === 'sin_beca' ? 'selected' : '' ?>>Sin Beca</option>
                    </select>
                </div>
                
                <div class="col-md-2">
                    <label for="filtro_fecha_desde" class="form-label">Desde</label>
                    <input type="date" class="form-control" id="filtro_fecha_desde" name="fecha_desde" 
                           value="<?= $filtros['fecha_desde'] ?? '' ?>">
                </div>
                
                <div class="col-md-2">
                    <label for="filtro_fecha_hasta" class="form-label">Hasta</label>
                    <input type="date" class="form-control" id="filtro_fecha_hasta" name="fecha_hasta" 
                           value="<?= $filtros['fecha_hasta'] ?? '' ?>">
                </div>
                
                <div class="col-md-12">
                    <label for="filtro_busqueda" class="form-label">Búsqueda</label>
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-search"></i></span>
                        <input type="text" class="form-control" id="filtro_busqueda" name="busqueda" 
                               placeholder="Buscar por nombre, apellido, cédula o email..." 
                               value="<?= $filtros['busqueda'] ?? '' ?>">
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Tabla de Fichas -->
<div class="card">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0">
                <i class="bi bi-table me-2"></i>Fichas Socioeconómicas
            </h5>
            <div class="d-flex gap-2">
                <div class="dropdown">
                    <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                        <i class="bi bi-gear"></i> Opciones
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#" onclick="seleccionarTodas()">
                            <i class="bi bi-check-all me-2"></i>Seleccionar todas
                        </a></li>
                        <li><a class="dropdown-item" href="#" onclick="deseleccionarTodas()">
                            <i class="bi bi-x me-2"></i>Deseleccionar todas
                        </a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="#" onclick="aprobarSeleccionadas()">
                            <i class="bi bi-check-circle me-2"></i>Aprobar seleccionadas
                        </a></li>
                        <li><a class="dropdown-item" href="#" onclick="rechazarSeleccionadas()">
                            <i class="bi bi-x-circle me-2"></i>Rechazar seleccionadas
                        </a></li>
                    </ul>
                </div>
                <select class="form-select form-select-sm" style="width: auto;" onchange="cambiarPorPagina(this.value)">
                    <option value="10">10 por página</option>
                    <option value="25" selected>25 por página</option>
                    <option value="50">50 por página</option>
                    <option value="100">100 por página</option>
                </select>
            </div>
        </div>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0" id="tabla-fichas">
                <thead class="bg-light">
                    <tr>
                        <th width="40">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="selectAll" onchange="toggleSelectAll()">
                            </div>
                        </th>
                        <th>Estudiante</th>
                        <th>Carrera</th>
                        <th>Período</th>
                        <th>Estado</th>
                        <th>Beca</th>
                        <th>Puntaje</th>
                        <th>Fecha</th>
                        <th width="150">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($fichas)): ?>
                        <tr>
                            <td colspan="9" class="text-center py-4">
                                <div class="text-muted">
                                    <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                                    <p class="mb-0">No se encontraron fichas con los filtros aplicados</p>
                                </div>
                            </td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($fichas as $ficha): ?>
                            <tr data-ficha-id="<?= $ficha['id'] ?>">
                                <td>
                                    <div class="form-check">
                                        <input class="form-check-input ficha-checkbox" type="checkbox" value="<?= $ficha['id'] ?>">
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="avatar-sm me-2">
                                            <div class="avatar-title rounded-circle bg-soft-primary text-primary">
                                                <?= strtoupper(substr($ficha['nombre'], 0, 1) . substr($ficha['apellido'], 0, 1)) ?>
                                            </div>
                                        </div>
                                        <div>
                                            <h6 class="mb-0"><?= $ficha['nombre'] . ' ' . $ficha['apellido'] ?></h6>
                                            <small class="text-muted"><?= $ficha['cedula'] ?></small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge bg-soft-info text-info">
                                        <?= $ficha['carrera_nombre'] ?? 'N/A' ?>
                                    </span>
                                </td>
                                <td><?= $ficha['periodo_nombre'] ?></td>
                                <td>
                                    <?php
                                    $badgeClass = [
                                        'Enviada' => 'bg-warning',
                                        'Revisada' => 'bg-info',
                                        'Aprobada' => 'bg-success',
                                        'Rechazada' => 'bg-danger'
                                    ][$ficha['estado']] ?? 'bg-secondary';
                                    ?>
                                    <span class="badge <?= $badgeClass ?>"><?= $ficha['estado'] ?></span>
                                </td>
                                <td>
                                    <?php if (!empty($ficha['tipo_relacion'])): ?>
                                        <span class="badge bg-primary">
                                            <i class="bi bi-award me-1"></i><?= $ficha['tipo_relacion'] ?>
                                        </span>
                                    <?php else: ?>
                                        <span class="text-muted">Sin beca</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if (!empty($ficha['puntaje_total'])): ?>
                                        <span class="fw-bold text-primary"><?= number_format($ficha['puntaje_total'], 2) ?></span>
                                    <?php else: ?>
                                        <span class="text-muted">-</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <small class="text-muted">
                                        <?= date('d/m/Y', strtotime($ficha['fecha_creacion'])) ?>
                                    </small>
                                </td>
                                <td>
                                    <div class="btn-group btn-group-sm" role="group">
                                        <button type="button" class="btn btn-outline-primary" 
                                                onclick="verFicha(<?= $ficha['id'] ?>)" 
                                                title="Ver detalles">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                        
                                        <?php if ($ficha['estado'] === 'Enviada'): ?>
                                            <button type="button" class="btn btn-outline-success" 
                                                    onclick="cambiarEstado(<?= $ficha['id'] ?>, 'Aprobada')" 
                                                    title="Aprobar">
                                                <i class="bi bi-check"></i>
                                            </button>
                                            <button type="button" class="btn btn-outline-danger" 
                                                    onclick="cambiarEstado(<?= $ficha['id'] ?>, 'Rechazada')" 
                                                    title="Rechazar">
                                                <i class="bi bi-x"></i>
                                            </button>
                                        <?php endif; ?>
                                        
                                        <div class="btn-group btn-group-sm" role="group">
                                            <button type="button" class="btn btn-outline-secondary dropdown-toggle" 
                                                    data-bs-toggle="dropdown" title="Más opciones">
                                                <i class="bi bi-three-dots"></i>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="#" onclick="exportarFichaPDF(<?= $ficha['id'] ?>)">
                                                    <i class="bi bi-file-pdf me-2"></i>Exportar PDF
                                                </a></li>
                                                <li><a class="dropdown-item" href="#" onclick="enviarNotificacion(<?= $ficha['id'] ?>)">
                                                    <i class="bi bi-envelope me-2"></i>Enviar notificación
                                                </a></li>
                                                <li><a class="dropdown-item" href="#" onclick="verHistorial(<?= $ficha['id'] ?>)">
                                                    <i class="bi bi-clock-history me-2"></i>Ver historial
                                                </a></li>
                                                <?php if ($ficha['estado'] !== 'Aprobada'): ?>
                                                    <li><hr class="dropdown-divider"></li>
                                                    <li><a class="dropdown-item" href="#" onclick="asignarBeca(<?= $ficha['id'] ?>)">
                                                        <i class="bi bi-award me-2"></i>Asignar beca
                                                    </a></li>
                                                <?php endif; ?>
                                            </ul>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
    
    <!-- Paginación -->
    <?php if (!empty($fichas)): ?>
        <div class="card-footer">
            <div class="d-flex justify-content-between align-items-center">
                <div class="text-muted">
                    Mostrando <?= count($fichas) ?> de <?= $estadisticas['total'] ?? 0 ?> fichas
                </div>
                <nav>
                    <ul class="pagination pagination-sm mb-0">
                        <li class="page-item">
                            <a class="page-link" href="#" onclick="cambiarPagina(1)">
                                <i class="bi bi-chevron-double-left"></i>
                            </a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="#" onclick="cambiarPagina(<?= max(1, ($filtros['page'] ?? 1) - 1) ?>)">
                                <i class="bi bi-chevron-left"></i>
                            </a>
                        </li>
                        <li class="page-item active">
                            <span class="page-link"><?= $filtros['page'] ?? 1 ?></span>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="#" onclick="cambiarPagina(<?= ($filtros['page'] ?? 1) + 1 ?>)">
                                <i class="bi bi-chevron-right"></i>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    <?php endif; ?>
</div>

<!-- Modal para ver ficha -->
<div class="modal fade" id="modalVerFicha" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detalles de la Ficha Socioeconómica</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="contenido-ficha">
                <!-- Se carga dinámicamente -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" onclick="exportarFichaPDFModal()">
                    <i class="bi bi-file-pdf me-1"></i>Exportar PDF
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal para cambiar estado -->
<div class="modal fade" id="modalCambiarEstado" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Cambiar Estado de Ficha</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="formCambiarEstado">
                    <input type="hidden" id="ficha_id" name="ficha_id">
                    <input type="hidden" id="nuevo_estado" name="estado">
                    
                    <div class="mb-3">
                        <label for="observaciones" class="form-label">Observaciones</label>
                        <textarea class="form-control" id="observaciones" name="observaciones" rows="4" 
                                  placeholder="Ingrese observaciones sobre la decisión..."></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" onclick="confirmarCambioEstado()">Confirmar</button>
            </div>
        </div>
    </div>
</div>

<script>
// Variables globales
let fichaSeleccionada = null;

// Funciones de filtrado
function aplicarFiltros() {
    const form = document.getElementById('formFiltros');
    const formData = new FormData(form);
    const params = new URLSearchParams(formData);
    
    // Agregar parámetros a la URL
    const newUrl = window.location.pathname + '?' + params.toString();
    window.location.href = newUrl;
}

function limpiarFiltros() {
    document.getElementById('formFiltros').reset();
    window.location.href = window.location.pathname;
}

function cambiarPagina(pagina) {
    const url = new URL(window.location);
    url.searchParams.set('page', pagina);
    window.location.href = url.toString();
}

function cambiarPorPagina(cantidad) {
    const url = new URL(window.location);
    url.searchParams.set('per_page', cantidad);
    url.searchParams.delete('page');
    window.location.href = url.toString();
}

// Funciones de selección
function toggleSelectAll() {
    const selectAll = document.getElementById('selectAll');
    const checkboxes = document.querySelectorAll('.ficha-checkbox');
    
    checkboxes.forEach(checkbox => {
        checkbox.checked = selectAll.checked;
    });
}

function seleccionarTodas() {
    document.getElementById('selectAll').checked = true;
    toggleSelectAll();
}

function deseleccionarTodas() {
    document.getElementById('selectAll').checked = false;
    toggleSelectAll();
}

// Funciones de gestión de fichas
function verFicha(id) {
    fetch(`<?= base_url('admin-bienestar/verFicha') ?>/${id}`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                mostrarDetallesFicha(data.data);
                new bootstrap.Modal(document.getElementById('modalVerFicha')).show();
            } else {
                mostrarNotificacion('Error cargando ficha: ' + data.error, 'error');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            mostrarNotificacion('Error de conexión', 'error');
        });
}

function mostrarDetallesFicha(ficha) {
    const contenido = document.getElementById('contenido-ficha');
    
    contenido.innerHTML = `
        <div class="row">
            <div class="col-md-6">
                <h6>Información del Estudiante</h6>
                <table class="table table-borderless table-sm">
                    <tr><td><strong>Nombre:</strong></td><td>${ficha.nombre} ${ficha.apellido}</td></tr>
                    <tr><td><strong>Cédula:</strong></td><td>${ficha.cedula}</td></tr>
                    <tr><td><strong>Email:</strong></td><td>${ficha.email}</td></tr>
                    <tr><td><strong>Carrera:</strong></td><td>${ficha.carrera_nombre || 'N/A'}</td></tr>
                    <tr><td><strong>Período:</strong></td><td>${ficha.periodo_nombre}</td></tr>
                </table>
            </div>
            <div class="col-md-6">
                <h6>Estado de la Ficha</h6>
                <table class="table table-borderless table-sm">
                    <tr><td><strong>Estado:</strong></td><td><span class="badge bg-primary">${ficha.estado}</span></td></tr>
                    <tr><td><strong>Puntaje:</strong></td><td>${ficha.puntaje_total || 'N/A'}</td></tr>
                    <tr><td><strong>Fecha:</strong></td><td>${new Date(ficha.fecha_creacion).toLocaleDateString()}</td></tr>
                    <tr><td><strong>Beca:</strong></td><td>${ficha.tipo_relacion || 'Sin beca asignada'}</td></tr>
                </table>
            </div>
        </div>
        
        <hr>
        
        <div class="row">
            <div class="col-12">
                <h6>Información Socioeconómica</h6>
                <div class="row">
                    <div class="col-md-4">
                        <strong>Ingresos Familiares:</strong><br>
                        $${ficha.ingresos_familia || 'N/A'}
                    </div>
                    <div class="col-md-4">
                        <strong>Miembros de la Familia:</strong><br>
                        ${ficha.miembros_familia || 'N/A'}
                    </div>
                    <div class="col-md-4">
                        <strong>Tipo de Vivienda:</strong><br>
                        ${ficha.tipo_vivienda || 'N/A'}
                    </div>
                </div>
            </div>
        </div>
        
        ${ficha.observaciones ? `
            <hr>
            <div class="row">
                <div class="col-12">
                    <h6>Observaciones</h6>
                    <div class="alert alert-info">
                        ${ficha.observaciones}
                    </div>
                </div>
            </div>
        ` : ''}
    `;
    
    fichaSeleccionada = ficha.id;
}

function cambiarEstado(id, estado) {
    document.getElementById('ficha_id').value = id;
    document.getElementById('nuevo_estado').value = estado;
    
    const modal = new bootstrap.Modal(document.getElementById('modalCambiarEstado'));
    modal.show();
}

function confirmarCambioEstado() {
    const formData = new FormData(document.getElementById('formCambiarEstado'));
    
    fetch('<?= base_url('admin-bienestar/actualizarEstadoFicha') ?>', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            mostrarNotificacion('Estado actualizado correctamente', 'success');
            bootstrap.Modal.getInstance(document.getElementById('modalCambiarEstado')).hide();
            location.reload();
        } else {
            mostrarNotificacion('Error: ' + data.error, 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        mostrarNotificacion('Error de conexión', 'error');
    });
}

// Funciones de exportación
function exportarFichaPDF(id) {
    window.open(`<?= base_url('admin-bienestar/exportarFichaPDF') ?>/${id}`, '_blank');
}

function exportarFichaPDFModal() {
    if (fichaSeleccionada) {
        exportarFichaPDF(fichaSeleccionada);
    }
}

function exportarTodas() {
    const filtros = new FormData(document.getElementById('formFiltros'));
    filtros.append('formato', 'excel');
    
    fetch('<?= base_url('admin-bienestar/exportarDatos') ?>', {
        method: 'POST',
        body: filtros
    })
    .then(response => response.blob())
    .then(blob => {
        const url = window.URL.createObjectURL(blob);
        const a = document.createElement('a');
        a.href = url;
        a.download = 'fichas_socioeconomicas.xlsx';
        a.click();
        window.URL.revokeObjectURL(url);
    })
    .catch(error => {
        console.error('Error:', error);
        mostrarNotificacion('Error exportando datos', 'error');
    });
}

function generarReporte() {
    const filtros = new FormData(document.getElementById('formFiltros'));
    filtros.append('tipo', 'fichas');
    filtros.append('formato', 'pdf');
    
    fetch('<?= base_url('admin-bienestar/generarReporte') ?>', {
        method: 'POST',
        body: filtros
    })
    .then(response => response.blob())
    .then(blob => {
        const url = window.URL.createObjectURL(blob);
        const a = document.createElement('a');
        a.href = url;
        a.download = 'reporte_fichas.pdf';
        a.click();
        window.URL.revokeObjectURL(url);
    })
    .catch(error => {
        console.error('Error:', error);
        mostrarNotificacion('Error generando reporte', 'error');
    });
}

// Funciones de acciones masivas
function aprobarSeleccionadas() {
    const seleccionadas = Array.from(document.querySelectorAll('.ficha-checkbox:checked')).map(cb => cb.value);
    
    if (seleccionadas.length === 0) {
        mostrarNotificacion('Seleccione al menos una ficha', 'warning');
        return;
    }
    
    if (confirm(`¿Está seguro de aprobar ${seleccionadas.length} fichas seleccionadas?`)) {
        procesarAccionMasiva(seleccionadas, 'Aprobada');
    }
}

function rechazarSeleccionadas() {
    const seleccionadas = Array.from(document.querySelectorAll('.ficha-checkbox:checked')).map(cb => cb.value);
    
    if (seleccionadas.length === 0) {
        mostrarNotificacion('Seleccione al menos una ficha', 'warning');
        return;
    }
    
    if (confirm(`¿Está seguro de rechazar ${seleccionadas.length} fichas seleccionadas?`)) {
        procesarAccionMasiva(seleccionadas, 'Rechazada');
    }
}

function procesarAccionMasiva(fichas, estado) {
    const promises = fichas.map(id => {
        const formData = new FormData();
        formData.append('ficha_id', id);
        formData.append('estado', estado);
        formData.append('observaciones', 'Acción masiva');
        
        return fetch('<?= base_url('admin-bienestar/actualizarEstadoFicha') ?>', {
            method: 'POST',
            body: formData
        });
    });
    
    Promise.all(promises)
        .then(responses => Promise.all(responses.map(r => r.json())))
        .then(results => {
            const exitosos = results.filter(r => r.success).length;
            mostrarNotificacion(`${exitosos} de ${fichas.length} fichas procesadas correctamente`, 'success');
            location.reload();
        })
        .catch(error => {
            console.error('Error:', error);
            mostrarNotificacion('Error procesando fichas', 'error');
        });
}

// Funciones auxiliares
function actualizarDatos() {
    location.reload();
}

function mostrarNotificacion(mensaje, tipo = 'info') {
    const alerta = document.createElement('div');
    alerta.className = `alert alert-${tipo} alert-dismissible fade show position-fixed`;
    alerta.style.cssText = 'top: 20px; right: 20px; z-index: 9999; min-width: 300px;';
    alerta.innerHTML = `
        ${mensaje}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    `;
    
    document.body.appendChild(alerta);
    
    setTimeout(() => {
        if (alerta.parentNode) {
            alerta.remove();
        }
    }, 5000);
}

// Eventos al cargar la página
document.addEventListener('DOMContentLoaded', function() {
    // Aplicar filtros automáticamente cuando se cambien
    document.getElementById('filtro_estado').addEventListener('change', aplicarFiltros);
    document.getElementById('filtro_periodo').addEventListener('change', aplicarFiltros);
    document.getElementById('filtro_carrera').addEventListener('change', aplicarFiltros);
    document.getElementById('filtro_tipo_beca').addEventListener('change', aplicarFiltros);
    
    // Búsqueda con delay
    let timeoutId;
    document.getElementById('filtro_busqueda').addEventListener('input', function() {
        clearTimeout(timeoutId);
        timeoutId = setTimeout(aplicarFiltros, 500);
    });
    
    // Enter en campos de fecha
    document.getElementById('filtro_fecha_desde').addEventListener('change', aplicarFiltros);
    document.getElementById('filtro_fecha_hasta').addEventListener('change', aplicarFiltros);
});

</script>

<style>
.mini-stats-wid .card-body {
    padding: 1.25rem;
}

.avatar-title {
    align-items: center;
    background-color: #556ee6;
    border-radius: 50%;
    color: #fff;
    display: flex;
    font-size: 16px;
    font-weight: 500;
    height: 100%;
    justify-content: center;
    width: 100%;
}

.bg-soft-primary {
    background-color: rgba(85, 110, 230, 0.15) !important;
}

.bg-soft-info {
    background-color: rgba(80, 165, 241, 0.15) !important;
}

.table th {
    font-weight: 600;
    font-size: 0.875rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.btn-group-sm > .btn, .btn-sm {
    padding: 0.25rem 0.5rem;
    font-size: 0.75rem;
}

.page-link {
    padding: 0.375rem 0.75rem;
}

.modal-xl {
    max-width: 1200px;
}

@media (max-width: 768px) {
    .col-xl-2 {
        margin-bottom: 1rem;
    }
    
    .btn-group {
        flex-direction: column;
        gap: 0.25rem;
    }
    
    .table-responsive {
        font-size: 0.85rem;
    }
}
</style>

<?= $this->endSection() ?>
