<?= $this->extend('layouts/mainAdmin') ?>

<?= $this->section('content') ?>

<!-- Page Header -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <div>
                <h4 class="mb-0">Gestión de Becas</h4>
                <p class="text-muted mb-0">Administra el catálogo de becas y sus solicitudes</p>
            </div>
            <div class="page-title-right">
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-success" onclick="mostrarModalCrearBeca()">
                        <i class="bi bi-plus-circle"></i> Nueva Beca
                    </button>
                    <button type="button" class="btn btn-primary" onclick="exportarBecas()">
                        <i class="bi bi-file-excel"></i> Exportar
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
                        <p class="text-muted fw-medium mb-1">Total Becas</p>
                        <h5 class="mb-0"><?= count($becas ?? []) ?></h5>
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
    
    <div class="col-xl-2 col-md-4 col-sm-6">
        <div class="card mini-stats-wid">
            <div class="card-body">
                <div class="d-flex">
                    <div class="flex-grow-1">
                        <p class="text-muted fw-medium mb-1">Activas</p>
                        <h5 class="mb-0 text-success">
                            <?= count(array_filter($becas ?? [], function($b) { return $b['estado'] === 'Activa'; })) ?>
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
                        <p class="text-muted fw-medium mb-1">Inactivas</p>
                        <h5 class="mb-0 text-warning">
                            <?= count(array_filter($becas ?? [], function($b) { return $b['estado'] === 'Inactiva'; })) ?>
                        </h5>
                    </div>
                    <div class="flex-shrink-0 align-self-center">
                        <div class="mini-stat-icon avatar-sm rounded-circle bg-warning">
                            <span class="avatar-title">
                                <i class="bi bi-pause-circle"></i>
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
                        <p class="text-muted fw-medium mb-1">Cupos Totales</p>
                        <h5 class="mb-0 text-info">
                            <?= array_sum(array_column($becas ?? [], 'cupos_disponibles')) ?>
                        </h5>
                    </div>
                    <div class="flex-shrink-0 align-self-center">
                        <div class="mini-stat-icon avatar-sm rounded-circle bg-info">
                            <span class="avatar-title">
                                <i class="bi bi-people"></i>
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
                        <p class="text-muted fw-medium mb-1">Monto Total</p>
                        <h5 class="mb-0 text-primary">
                            $<?= number_format(array_sum(array_column($becas ?? [], 'monto_beca')), 0) ?>
                        </h5>
                    </div>
                    <div class="flex-shrink-0 align-self-center">
                        <div class="mini-stat-icon avatar-sm rounded-circle bg-primary">
                            <span class="avatar-title">
                                <i class="bi bi-currency-dollar"></i>
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
                        <p class="text-muted fw-medium mb-1">Tipos</p>
                        <h5 class="mb-0 text-secondary">
                            <?= count(array_unique(array_column($becas ?? [], 'tipo_beca'))) ?>
                        </h5>
                    </div>
                    <div class="flex-shrink-0 align-self-center">
                        <div class="mini-stat-icon avatar-sm rounded-circle bg-secondary">
                            <span class="avatar-title">
                                <i class="bi bi-tags"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Filtros -->
<div class="card mb-4">
    <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0">
                <i class="bi bi-funnel me-2"></i>Filtros
            </h5>
            <button type="button" class="btn btn-sm btn-outline-secondary" onclick="limpiarFiltros()">
                <i class="bi bi-x-circle me-1"></i>Limpiar
            </button>
        </div>
    </div>
    <div class="card-body">
        <div class="row g-3">
            <div class="col-md-3">
                <label for="filtro_tipo" class="form-label">Tipo de Beca</label>
                <select class="form-select" id="filtro_tipo" onchange="filtrarBecas()">
                    <option value="">Todos los tipos</option>
                    <option value="Académica">Académica</option>
                    <option value="Económica">Económica</option>
                    <option value="Deportiva">Deportiva</option>
                    <option value="Cultural">Cultural</option>
                    <option value="Investigación">Investigación</option>
                    <option value="Otros">Otros</option>
                </select>
            </div>
            
            <div class="col-md-3">
                <label for="filtro_estado" class="form-label">Estado</label>
                <select class="form-select" id="filtro_estado" onchange="filtrarBecas()">
                    <option value="">Todos los estados</option>
                    <option value="Activa">Activa</option>
                    <option value="Inactiva">Inactiva</option>
                    <option value="Cerrada">Cerrada</option>
                </select>
            </div>
            
            <div class="col-md-3">
                <label for="filtro_periodo" class="form-label">Período</label>
                <select class="form-select" id="filtro_periodo" onchange="filtrarBecas()">
                    <option value="">Todos los períodos</option>
                    <?php foreach ($periodos as $periodo): ?>
                        <option value="<?= $periodo['id'] ?>"><?= $periodo['nombre'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            
            <div class="col-md-3">
                <label for="filtro_busqueda" class="form-label">Búsqueda</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-search"></i></span>
                    <input type="text" class="form-control" id="filtro_busqueda" 
                           placeholder="Buscar por nombre..." onkeyup="filtrarBecas()">
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Grid de Becas -->
<div class="row" id="grid-becas">
    <?php if (empty($becas)): ?>
        <div class="col-12">
            <div class="card">
                <div class="card-body text-center py-5">
                    <i class="bi bi-award fs-1 text-muted d-block mb-3"></i>
                    <h5>No hay becas registradas</h5>
                    <p class="text-muted">Comience creando su primera beca.</p>
                    <button type="button" class="btn btn-primary" onclick="mostrarModalCrearBeca()">
                        <i class="bi bi-plus-circle me-1"></i>Crear Primera Beca
                    </button>
                </div>
            </div>
        </div>
    <?php else: ?>
        <?php foreach ($becas as $beca): ?>
            <div class="col-xl-4 col-lg-6 col-md-6 beca-card" data-tipo="<?= $beca['tipo_beca'] ?>" 
                 data-estado="<?= $beca['estado'] ?>" data-periodo="<?= $beca['periodo_vigente_id'] ?? '' ?>" 
                 data-nombre="<?= strtolower($beca['nombre']) ?>">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-start">
                        <div>
                            <h6 class="card-title mb-1"><?= $beca['nombre'] ?></h6>
                            <span class="badge bg-soft-primary text-primary"><?= $beca['tipo_beca'] ?></span>
                        </div>
                        <div class="dropdown">
                            <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" 
                                    data-bs-toggle="dropdown">
                                <i class="bi bi-three-dots-vertical"></i>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#" onclick="verBeca(<?= $beca['id'] ?>)">
                                    <i class="bi bi-eye me-2"></i>Ver detalles
                                </a></li>
                                <li><a class="dropdown-item" href="#" onclick="editarBeca(<?= $beca['id'] ?>)">
                                    <i class="bi bi-pencil me-2"></i>Editar
                                </a></li>
                                <li><a class="dropdown-item" href="#" onclick="duplicarBeca(<?= $beca['id'] ?>)">
                                    <i class="bi bi-files me-2"></i>Duplicar
                                </a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="#" onclick="verSolicitudes(<?= $beca['id'] ?>)">
                                    <i class="bi bi-envelope me-2"></i>Ver solicitudes
                                </a></li>
                                <li><a class="dropdown-item" href="#" onclick="exportarBecaPDF(<?= $beca['id'] ?>)">
                                    <i class="bi bi-file-pdf me-2"></i>Exportar PDF
                                </a></li>
                                <li><hr class="dropdown-divider"></li>
                                <?php if ($beca['estado'] === 'Activa'): ?>
                                    <li><a class="dropdown-item text-warning" href="#" onclick="cambiarEstadoBeca(<?= $beca['id'] ?>, 'Inactiva')">
                                        <i class="bi bi-pause-circle me-2"></i>Desactivar
                                    </a></li>
                                <?php else: ?>
                                    <li><a class="dropdown-item text-success" href="#" onclick="cambiarEstadoBeca(<?= $beca['id'] ?>, 'Activa')">
                                        <i class="bi bi-play-circle me-2"></i>Activar
                                    </a></li>
                                <?php endif; ?>
                                <li><a class="dropdown-item text-danger" href="#" onclick="eliminarBeca(<?= $beca['id'] ?>)">
                                    <i class="bi bi-trash me-2"></i>Eliminar
                                </a></li>
                            </ul>
                        </div>
                    </div>
                    
                    <div class="card-body">
                        <p class="text-muted mb-3"><?= substr($beca['descripcion'], 0, 100) ?>...</p>
                        
                        <div class="row g-2 mb-3">
                            <div class="col-6">
                                <div class="text-center">
                                    <div class="text-muted small">Monto</div>
                                    <div class="fw-bold text-success">
                                        <?php if ($beca['monto_beca']): ?>
                                            $<?= number_format($beca['monto_beca'], 0) ?>
                                        <?php else: ?>
                                            No especificado
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="text-center">
                                    <div class="text-muted small">Cupos</div>
                                    <div class="fw-bold text-primary">
                                        <?= $beca['cupos_disponibles'] ?? 'Ilimitado' ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <?php
                                $badgeClass = [
                                    'Activa' => 'bg-success',
                                    'Inactiva' => 'bg-warning',
                                    'Cerrada' => 'bg-danger'
                                ][$beca['estado']] ?? 'bg-secondary';
                                ?>
                                <span class="badge <?= $badgeClass ?>"><?= $beca['estado'] ?></span>
                            </div>
                            <div>
                                <small class="text-muted">
                                    <?= date('d/m/Y', strtotime($beca['fecha_creacion'])) ?>
                                </small>
                            </div>
                        </div>
                        
                        <?php if ($beca['fecha_inicio_vigencia'] && $beca['fecha_fin_vigencia']): ?>
                            <div class="mt-2">
                                <small class="text-muted">
                                    <i class="bi bi-calendar-range me-1"></i>
                                    Vigencia: <?= date('d/m/Y', strtotime($beca['fecha_inicio_vigencia'])) ?> 
                                    - <?= date('d/m/Y', strtotime($beca['fecha_fin_vigencia'])) ?>
                                </small>
                            </div>
                        <?php endif; ?>
                    </div>
                    
                    <div class="card-footer bg-transparent">
                        <div class="btn-group w-100" role="group">
                            <button type="button" class="btn btn-outline-primary btn-sm" onclick="verBeca(<?= $beca['id'] ?>)">
                                <i class="bi bi-eye"></i> Ver
                            </button>
                            <button type="button" class="btn btn-outline-success btn-sm" onclick="editarBeca(<?= $beca['id'] ?>)">
                                <i class="bi bi-pencil"></i> Editar
                            </button>
                            <button type="button" class="btn btn-outline-info btn-sm" onclick="verSolicitudes(<?= $beca['id'] ?>)">
                                <i class="bi bi-envelope"></i> Solicitudes
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

<!-- Modal para crear/editar beca -->
<div class="modal fade" id="modalBeca" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalBecaTitle">Nueva Beca</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="formBeca">
                    <input type="hidden" id="beca_id" name="beca_id">
                    
                    <div class="row">
                        <div class="col-md-8">
                            <div class="mb-3">
                                <label for="nombre" class="form-label">Nombre de la Beca *</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="tipo_beca" class="form-label">Tipo de Beca *</label>
                                <select class="form-select" id="tipo_beca" name="tipo_beca" required>
                                    <option value="">Seleccionar tipo</option>
                                    <option value="Académica">Académica</option>
                                    <option value="Económica">Económica</option>
                                    <option value="Deportiva">Deportiva</option>
                                    <option value="Cultural">Cultural</option>
                                    <option value="Investigación">Investigación</option>
                                    <option value="Otros">Otros</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="descripcion" class="form-label">Descripción *</label>
                        <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required></textarea>
                    </div>
                    
                    <div class="mb-3">
                        <label for="requisitos" class="form-label">Requisitos</label>
                        <textarea class="form-control" id="requisitos" name="requisitos" rows="4"></textarea>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="monto" class="form-label">Monto ($)</label>
                                <input type="number" class="form-control" id="monto" name="monto" min="0" step="0.01">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="cupos" class="form-label">Cupos Disponibles</label>
                                <input type="number" class="form-control" id="cupos" name="cupos" min="1">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="puntaje_minimo" class="form-label">Puntaje Mínimo</label>
                                <input type="number" class="form-control" id="puntaje_minimo" name="puntaje_minimo" 
                                       min="0" max="10" step="0.1">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="periodo_id" class="form-label">Período</label>
                                <select class="form-select" id="periodo_id" name="periodo_id">
                                    <option value="">Sin período específico</option>
                                    <?php foreach ($periodos as $periodo): ?>
                                        <option value="<?= $periodo['id'] ?>"><?= $periodo['nombre'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="fecha_inicio" class="form-label">Fecha de Inicio</label>
                                <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="fecha_fin" class="form-label">Fecha de Fin</label>
                                <input type="date" class="form-control" id="fecha_fin" name="fecha_fin">
                            </div>
                        </div>
                    </div>
                    
                    <!-- Documentos Requisitos -->
                    <div class="mb-3">
                        <label class="form-label">Documentos Requeridos</label>
                        <div id="documentos-container">
                            <div class="documento-item border rounded p-3 mb-2">
                                <div class="row">
                                    <div class="col-md-4">
                                        <input type="text" class="form-control" name="documentos[0][nombre]" 
                                               placeholder="Nombre del documento">
                                    </div>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control" name="documentos[0][descripcion]" 
                                               placeholder="Descripción">
                                    </div>
                                    <div class="col-md-2">
                                        <select class="form-select" name="documentos[0][tipo]">
                                            <option value="PDF">PDF</option>
                                            <option value="IMG">Imagen</option>
                                            <option value="DOC">Documento</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" 
                                                   name="documentos[0][obligatorio]" checked>
                                            <label class="form-check-label">Obligatorio</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-sm btn-outline-primary" onclick="agregarDocumento()">
                            <i class="bi bi-plus"></i> Agregar Documento
                        </button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" onclick="guardarBeca()">Guardar Beca</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal para ver detalles de beca -->
<div class="modal fade" id="modalVerBeca" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detalles de la Beca</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="contenido-beca">
                <!-- Se carga dinámicamente -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" onclick="editarBecaModal()">
                    <i class="bi bi-pencil me-1"></i>Editar
                </button>
            </div>
        </div>
    </div>
</div>

<script>
// Variables globales
let becaSeleccionada = null;
let documentoIndex = 1;

// Funciones de filtrado
function filtrarBecas() {
    const tipo = document.getElementById('filtro_tipo').value.toLowerCase();
    const estado = document.getElementById('filtro_estado').value.toLowerCase();
    const periodo = document.getElementById('filtro_periodo').value;
    const busqueda = document.getElementById('filtro_busqueda').value.toLowerCase();
    
    const becaCards = document.querySelectorAll('.beca-card');
    
    becaCards.forEach(card => {
        const cardTipo = card.dataset.tipo.toLowerCase();
        const cardEstado = card.dataset.estado.toLowerCase();
        const cardPeriodo = card.dataset.periodo;
        const cardNombre = card.dataset.nombre;
        
        let mostrar = true;
        
        if (tipo && cardTipo !== tipo) mostrar = false;
        if (estado && cardEstado !== estado) mostrar = false;
        if (periodo && cardPeriodo !== periodo) mostrar = false;
        if (busqueda && !cardNombre.includes(busqueda)) mostrar = false;
        
        card.style.display = mostrar ? 'block' : 'none';
    });
}

function limpiarFiltros() {
    document.getElementById('filtro_tipo').value = '';
    document.getElementById('filtro_estado').value = '';
    document.getElementById('filtro_periodo').value = '';
    document.getElementById('filtro_busqueda').value = '';
    filtrarBecas();
}

// Funciones de gestión de becas
function mostrarModalCrearBeca() {
    document.getElementById('modalBecaTitle').textContent = 'Nueva Beca';
    document.getElementById('formBeca').reset();
    document.getElementById('beca_id').value = '';
    
    // Resetear documentos
    document.getElementById('documentos-container').innerHTML = `
        <div class="documento-item border rounded p-3 mb-2">
            <div class="row">
                <div class="col-md-4">
                    <input type="text" class="form-control" name="documentos[0][nombre]" 
                           placeholder="Nombre del documento">
                </div>
                <div class="col-md-4">
                    <input type="text" class="form-control" name="documentos[0][descripcion]" 
                           placeholder="Descripción">
                </div>
                <div class="col-md-2">
                    <select class="form-select" name="documentos[0][tipo]">
                        <option value="PDF">PDF</option>
                        <option value="IMG">Imagen</option>
                        <option value="DOC">Documento</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" 
                               name="documentos[0][obligatorio]" checked>
                        <label class="form-check-label">Obligatorio</label>
                    </div>
                </div>
            </div>
        </div>
    `;
    documentoIndex = 1;
    
    new bootstrap.Modal(document.getElementById('modalBeca')).show();
}

function verBeca(id) {
    fetch(`<?= base_url('admin-bienestar/obtenerBeca') ?>/${id}`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                mostrarDetallesBeca(data.data);
                new bootstrap.Modal(document.getElementById('modalVerBeca')).show();
            } else {
                mostrarNotificacion('Error cargando beca: ' + data.error, 'error');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            mostrarNotificacion('Error de conexión', 'error');
        });
}

function mostrarDetallesBeca(beca) {
    const contenido = document.getElementById('contenido-beca');
    
    let documentosHtml = '';
    if (beca.documentos_requisitos && beca.documentos_requisitos.length > 0) {
        documentosHtml = `
            <h6>Documentos Requeridos:</h6>
            <ul class="list-group list-group-flush mb-3">
                ${beca.documentos_requisitos.map(doc => `
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            <strong>${doc.nombre_documento}</strong>
                            <small class="text-muted d-block">${doc.descripcion}</small>
                        </div>
                        <div>
                            <span class="badge bg-info">${doc.tipo_documento}</span>
                            ${doc.obligatorio ? '<span class="badge bg-warning ms-1">Obligatorio</span>' : ''}
                        </div>
                    </li>
                `).join('')}
            </ul>
        `;
    }
    
    contenido.innerHTML = `
        <div class="row">
            <div class="col-md-8">
                <h4>${beca.nombre}</h4>
                <span class="badge bg-primary mb-3">${beca.tipo_beca}</span>
                
                <h6>Descripción:</h6>
                <p>${beca.descripcion}</p>
                
                ${beca.requisitos ? `
                    <h6>Requisitos:</h6>
                    <p>${beca.requisitos}</p>
                ` : ''}
                
                ${documentosHtml}
            </div>
            <div class="col-md-4">
                <div class="card bg-light">
                    <div class="card-body">
                        <h6>Información General</h6>
                        <table class="table table-borderless table-sm">
                            <tr><td><strong>Estado:</strong></td><td><span class="badge bg-success">${beca.estado}</span></td></tr>
                            <tr><td><strong>Monto:</strong></td><td>$${beca.monto_beca ? Number(beca.monto_beca).toLocaleString() : 'N/A'}</td></tr>
                            <tr><td><strong>Cupos:</strong></td><td>${beca.cupos_disponibles || 'Ilimitado'}</td></tr>
                            <tr><td><strong>Puntaje Mín:</strong></td><td>${beca.puntaje_minimo_requerido || 'N/A'}</td></tr>
                            <tr><td><strong>Creada:</strong></td><td>${new Date(beca.fecha_creacion).toLocaleDateString()}</td></tr>
                        </table>
                        
                        ${beca.fecha_inicio_vigencia ? `
                            <h6 class="mt-3">Vigencia</h6>
                            <p class="small">
                                <strong>Inicio:</strong> ${new Date(beca.fecha_inicio_vigencia).toLocaleDateString()}<br>
                                <strong>Fin:</strong> ${new Date(beca.fecha_fin_vigencia).toLocaleDateString()}
                            </p>
                        ` : ''}
                    </div>
                </div>
            </div>
        </div>
    `;
    
    becaSeleccionada = beca.id;
}

function editarBeca(id) {
    fetch(`<?= base_url('admin-bienestar/obtenerBeca') ?>/${id}`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                cargarDatosBecaModal(data.data);
                new bootstrap.Modal(document.getElementById('modalBeca')).show();
            } else {
                mostrarNotificacion('Error cargando beca: ' + data.error, 'error');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            mostrarNotificacion('Error de conexión', 'error');
        });
}

function editarBecaModal() {
    bootstrap.Modal.getInstance(document.getElementById('modalVerBeca')).hide();
    editarBeca(becaSeleccionada);
}

function cargarDatosBecaModal(beca) {
    document.getElementById('modalBecaTitle').textContent = 'Editar Beca';
    document.getElementById('beca_id').value = beca.id;
    document.getElementById('nombre').value = beca.nombre;
    document.getElementById('tipo_beca').value = beca.tipo_beca;
    document.getElementById('descripcion').value = beca.descripcion;
    document.getElementById('requisitos').value = beca.requisitos || '';
    document.getElementById('monto').value = beca.monto_beca || '';
    document.getElementById('cupos').value = beca.cupos_disponibles || '';
    document.getElementById('puntaje_minimo').value = beca.puntaje_minimo_requerido || '';
    document.getElementById('periodo_id').value = beca.periodo_vigente_id || '';
    document.getElementById('fecha_inicio').value = beca.fecha_inicio_vigencia || '';
    document.getElementById('fecha_fin').value = beca.fecha_fin_vigencia || '';
    
    // Cargar documentos
    const container = document.getElementById('documentos-container');
    container.innerHTML = '';
    
    if (beca.documentos_requisitos && beca.documentos_requisitos.length > 0) {
        beca.documentos_requisitos.forEach((doc, index) => {
            container.innerHTML += `
                <div class="documento-item border rounded p-3 mb-2">
                    <div class="row">
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="documentos[${index}][nombre]" 
                                   value="${doc.nombre_documento}" placeholder="Nombre del documento">
                        </div>
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="documentos[${index}][descripcion]" 
                                   value="${doc.descripcion}" placeholder="Descripción">
                        </div>
                        <div class="col-md-2">
                            <select class="form-select" name="documentos[${index}][tipo]">
                                <option value="PDF" ${doc.tipo_documento === 'PDF' ? 'selected' : ''}>PDF</option>
                                <option value="IMG" ${doc.tipo_documento === 'IMG' ? 'selected' : ''}>Imagen</option>
                                <option value="DOC" ${doc.tipo_documento === 'DOC' ? 'selected' : ''}>Documento</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" 
                                       name="documentos[${index}][obligatorio]" ${doc.obligatorio ? 'checked' : ''}>
                                <label class="form-check-label">Obligatorio</label>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-sm btn-outline-danger mt-2" onclick="eliminarDocumento(this)">
                        <i class="bi bi-trash"></i> Eliminar
                    </button>
                </div>
            `;
        });
        documentoIndex = beca.documentos_requisitos.length;
    } else {
        agregarDocumento();
    }
}

function guardarBeca() {
    const formData = new FormData(document.getElementById('formBeca'));
    const becaId = document.getElementById('beca_id').value;
    
    // Procesar documentos
    const documentos = [];
    const documentoItems = document.querySelectorAll('.documento-item');
    
    documentoItems.forEach((item, index) => {
        const nombre = item.querySelector(`input[name="documentos[${index}][nombre]"]`)?.value;
        const descripcion = item.querySelector(`input[name="documentos[${index}][descripcion]"]`)?.value;
        const tipo = item.querySelector(`select[name="documentos[${index}][tipo]"]`)?.value;
        const obligatorio = item.querySelector(`input[name="documentos[${index}][obligatorio]"]`)?.checked;
        
        if (nombre) {
            documentos.push({
                nombre: nombre,
                descripcion: descripcion,
                tipo: tipo,
                obligatorio: obligatorio ? 1 : 0,
                orden: index + 1
            });
        }
    });
    
    formData.append('documentos_requisitos', JSON.stringify(documentos));
    
    const url = becaId ? 
        '<?= base_url('admin-bienestar/actualizarBeca') ?>' : 
        '<?= base_url('admin-bienestar/crearBeca') ?>';
    
    fetch(url, {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            mostrarNotificacion(becaId ? 'Beca actualizada correctamente' : 'Beca creada correctamente', 'success');
            bootstrap.Modal.getInstance(document.getElementById('modalBeca')).hide();
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

function agregarDocumento() {
    const container = document.getElementById('documentos-container');
    const documentoHtml = `
        <div class="documento-item border rounded p-3 mb-2">
            <div class="row">
                <div class="col-md-4">
                    <input type="text" class="form-control" name="documentos[${documentoIndex}][nombre]" 
                           placeholder="Nombre del documento">
                </div>
                <div class="col-md-4">
                    <input type="text" class="form-control" name="documentos[${documentoIndex}][descripcion]" 
                           placeholder="Descripción">
                </div>
                <div class="col-md-2">
                    <select class="form-select" name="documentos[${documentoIndex}][tipo]">
                        <option value="PDF">PDF</option>
                        <option value="IMG">Imagen</option>
                        <option value="DOC">Documento</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" 
                               name="documentos[${documentoIndex}][obligatorio]" checked>
                        <label class="form-check-label">Obligatorio</label>
                    </div>
                </div>
            </div>
            <button type="button" class="btn btn-sm btn-outline-danger mt-2" onclick="eliminarDocumento(this)">
                <i class="bi bi-trash"></i> Eliminar
            </button>
        </div>
    `;
    
    container.insertAdjacentHTML('beforeend', documentoHtml);
    documentoIndex++;
}

function eliminarDocumento(btn) {
    btn.closest('.documento-item').remove();
}

function cambiarEstadoBeca(id, estado) {
    if (confirm(`¿Está seguro de ${estado === 'Activa' ? 'activar' : 'desactivar'} esta beca?`)) {
        const formData = new FormData();
        formData.append('beca_id', id);
        formData.append('estado', estado);
        
        fetch('<?= base_url('admin-bienestar/toggleEstadoBeca') ?>', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                mostrarNotificacion('Estado actualizado correctamente', 'success');
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
}

function eliminarBeca(id) {
    if (confirm('¿Está seguro de eliminar esta beca? Esta acción no se puede deshacer.')) {
        const formData = new FormData();
        formData.append('beca_id', id);
        
        fetch('<?= base_url('admin-bienestar/eliminarBeca') ?>', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                mostrarNotificacion('Beca eliminada correctamente', 'success');
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
}

function duplicarBeca(id) {
    fetch(`<?= base_url('admin-bienestar/obtenerBeca') ?>/${id}`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const beca = data.data;
                cargarDatosBecaModal(beca);
                
                // Limpiar ID y cambiar nombre
                document.getElementById('beca_id').value = '';
                document.getElementById('nombre').value = beca.nombre + ' (Copia)';
                document.getElementById('modalBecaTitle').textContent = 'Duplicar Beca';
                
                new bootstrap.Modal(document.getElementById('modalBeca')).show();
            } else {
                mostrarNotificacion('Error cargando beca: ' + data.error, 'error');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            mostrarNotificacion('Error de conexión', 'error');
        });
}

function verSolicitudes(id) {
    window.location.href = `<?= base_url('admin-bienestar/solicitudes') ?>?beca_id=${id}`;
}

function exportarBecaPDF(id) {
    window.open(`<?= base_url('admin-bienestar/exportarBecaPDF') ?>/${id}`, '_blank');
}

function exportarBecas() {
    window.open('<?= base_url('admin-bienestar/exportarBecas') ?>', '_blank');
}

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
    color: #556ee6 !important;
}

.beca-card {
    margin-bottom: 1.5rem;
}

.beca-card .card {
    height: 100%;
    transition: transform 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
}

.beca-card .card:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}

.documento-item {
    background-color: #f8f9fa;
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
    
    .beca-card .card-body {
        padding: 1rem;
    }
}
</style>

<?= $this->endSection() ?>
