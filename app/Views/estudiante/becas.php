<?= $this->extend('layouts/mainEstudiante') ?>

<?= $this->section('content') ?>

<div class="container-fluid">
    <!-- Encabezado de la página -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <i class="fas fa-graduation-cap mr-2"></i>Becas Disponibles
        </h1>
            <div>
            <button class="btn btn-info btn-sm" onclick="actualizarBecas()">
                <i class="fas fa-sync-alt mr-1"></i>Actualizar
            </button>
        </div>
    </div>

    <!-- Tarjetas de estadísticas -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Becas Disponibles
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="becasDisponibles">0</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-graduation-cap fa-2x text-gray-300"></i>
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
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Solicitudes Activas
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="solicitudesActivas">0</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-file-alt fa-2x text-gray-300"></i>
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
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                En Revisión
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="enRevision">0</div>
                                    </div>
                        <div class="col-auto">
                            <i class="fas fa-clock fa-2x text-gray-300"></i>
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
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Aprobadas
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800" id="becasAprobadas">0</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-check-circle fa-2x text-gray-300"></i>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>

    <!-- Filtros -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Filtros de Búsqueda</h6>
        </div>
        <div class="card-body">
<div class="row">
                <div class="col-md-4">
                    <label for="filtroTipo">Tipo de Beca</label>
                    <select class="form-control" id="filtroTipo">
                        <option value="">Todos los tipos</option>
                        <option value="Académica">Académica</option>
                        <option value="Económica">Económica</option>
                        <option value="Deportiva">Deportiva</option>
                        <option value="Cultural">Cultural</option>
                        <option value="Investigación">Investigación</option>
                        <option value="Otros">Otros</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="filtroPeriodo">Período Académico</label>
                    <select class="form-control" id="filtroPeriodo">
                        <option value="">Todos los períodos</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="filtroBuscar">Buscar</label>
                    <input type="text" class="form-control" id="filtroBuscar" placeholder="Nombre de beca...">
                </div>
            </div>
            <div class="row mt-3">
    <div class="col-12">
                    <button class="btn btn-primary" id="btnAplicarFiltros">
                        <i class="fas fa-search mr-1"></i>Aplicar Filtros
                    </button>
                    <button class="btn btn-secondary ml-2" id="btnLimpiarFiltros">
                        <i class="fas fa-times mr-1"></i>Limpiar Filtros
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Lista de becas disponibles -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Becas Disponibles</h6>
        </div>
        <div class="card-body">
            <div id="listaBecas">
                <!-- Las becas se cargarán dinámicamente -->
            </div>
        </div>
    </div>

    <!-- Mis solicitudes de becas -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Mis Solicitudes de Becas</h6>
            </div>
            <div class="card-body">
            <div id="misSolicitudes">
                <!-- Las solicitudes se cargarán dinámicamente -->
            </div>
        </div>
    </div>
</div>

<!-- Modal para solicitar beca -->
<div class="modal fade" id="modalSolicitarBeca" tabindex="-1" role="dialog" aria-labelledby="modalSolicitarBecaLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalSolicitarBecaLabel">Solicitar Beca</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                                            </button>
            </div>
            <div class="modal-body" id="modalSolicitarBecaBody">
                <!-- El contenido se cargará dinámicamente -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" id="btnConfirmarSolicitud">
                    <i class="fas fa-paper-plane mr-1"></i>Enviar Solicitud
                                            </button>
            </div>
        </div>
    </div>
                                        </div>

<!-- Modal para ver detalles de beca -->
<div class="modal fade" id="modalVerBeca" tabindex="-1" role="dialog" aria-labelledby="modalVerBecaLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalVerBecaLabel">Detalles de la Beca</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                    </div>
            <div class="modal-body" id="modalVerBecaBody">
                <!-- El contenido se cargará dinámicamente -->
                    </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" id="btnSolicitarDesdeDetalle">
                    <i class="fas fa-paper-plane mr-1"></i>Solicitar Beca
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal para ver estado de solicitud -->
<div class="modal fade" id="modalEstadoSolicitud" tabindex="-1" role="dialog" aria-labelledby="modalEstadoSolicitudLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEstadoSolicitudLabel">Estado de mi Solicitud</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="modalEstadoSolicitudBody">
                <!-- El contenido se cargará dinámicamente -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
let becaSeleccionada = null;
let solicitudSeleccionada = null;

$(document).ready(function() {
    cargarBecasDisponibles();
    cargarMisSolicitudes();
    cargarEstadisticas();
    cargarPeriodosAcademicos();

    // Eventos de filtros
    $('#btnAplicarFiltros').click(function() {
        cargarBecasDisponibles();
    });

    $('#btnLimpiarFiltros').click(function() {
        limpiarFiltros();
        cargarBecasDisponibles();
    });

    // Eventos de modales
    $('#btnConfirmarSolicitud').click(confirmarSolicitud);
    $('#btnSolicitarDesdeDetalle').click(function() {
        if (becaSeleccionada) {
            solicitarBeca(becaSeleccionada);
        }
    });
});

function cargarBecasDisponibles() {
    const filtros = {
        tipo: $('#filtroTipo').val(),
        periodo: $('#filtroPeriodo').val(),
        buscar: $('#filtroBuscar').val()
    };

    $.ajax({
        url: '<?= base_url('estudiante/obtener-becas-disponibles') ?>',
        type: 'POST',
        data: filtros,
        success: function(response) {
            if (response.success) {
                mostrarBecasDisponibles(response.data);
            } else {
                mostrarError('Error al cargar las becas: ' + response.message);
            }
        },
        error: function() {
            mostrarError('Error de conexión al cargar las becas');
        }
    });
}

function mostrarBecasDisponibles(becas) {
    const container = $('#listaBecas');
    container.empty();

    if (becas.length === 0) {
        container.html(`
            <div class="text-center py-4">
                <i class="fas fa-info-circle fa-3x text-muted mb-3"></i>
                <h5 class="text-muted">No hay becas disponibles</h5>
                <p class="text-muted">En este momento no hay becas disponibles para tu perfil.</p>
            </div>
        `);
        return;
    }

    becas.forEach(function(beca) {
        const card = `
            <div class="card mb-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <h5 class="card-title">${beca.nombre}</h5>
                            <p class="card-text">${beca.descripcion || 'Sin descripción disponible'}</p>
                            <div class="row">
                                <div class="col-md-6">
                                    <small class="text-muted">
                                        <i class="fas fa-tag mr-1"></i>
                                        <span class="badge badge-info">${beca.tipo_beca}</span>
                                    </small>
                                </div>
                                <div class="col-md-6">
                                    <small class="text-muted">
                                        <i class="fas fa-dollar-sign mr-1"></i>
                                        ${beca.monto_beca ? '$' + beca.monto_beca : 'No especificado'}
                                    </small>
                                </div>
                            </div>
                            ${beca.requisitos ? `
                                <div class="mt-2">
                                    <small class="text-muted">
                                        <i class="fas fa-list mr-1"></i>
                                        <strong>Requisitos:</strong> ${beca.requisitos}
                                    </small>
                                </div>
                            ` : ''}
                        </div>
                        <div class="col-md-4 text-right">
                            <div class="d-flex flex-column">
                                <button class="btn btn-info btn-sm mb-2" onclick="verDetallesBeca(${beca.id})">
                                    <i class="fas fa-eye mr-1"></i>Ver Detalles
                                </button>
                                <button class="btn btn-primary btn-sm" onclick="solicitarBeca(${beca.id})">
                                    <i class="fas fa-paper-plane mr-1"></i>Solicitar Beca
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    `;
        container.append(card);
    });
}

function cargarMisSolicitudes() {
    // Aquí se implementaría la carga de solicitudes del estudiante
    // Por ahora mostramos un mensaje
    $('#misSolicitudes').html(`
        <div class="text-center py-4">
            <i class="fas fa-file-alt fa-3x text-muted mb-3"></i>
            <h5 class="text-muted">Funcionalidad en desarrollo</h5>
            <p class="text-muted">La gestión de solicitudes estará disponible próximamente.</p>
        </div>
    `);
}

function cargarEstadisticas() {
    // Aquí se implementarían las estadísticas del estudiante
    // Por ahora mostramos valores por defecto
    $('#becasDisponibles').text('0');
    $('#solicitudesActivas').text('0');
    $('#enRevision').text('0');
    $('#becasAprobadas').text('0');
}

function cargarPeriodosAcademicos() {
    // Aquí se cargarían los períodos académicos
    // Por ahora mostramos opciones por defecto
    const select = $('#filtroPeriodo');
    select.empty().append('<option value="">Todos los períodos</option>');
    select.append('<option value="1">2024-2025</option>');
    select.append('<option value="2">2025-2026</option>');
}

function verDetallesBeca(id) {
    becaSeleccionada = id;
    
    // Aquí se cargarían los detalles de la beca
    // Por ahora mostramos información básica
    $('#modalVerBecaBody').html(`
        <div class="text-center py-4">
            <i class="fas fa-info-circle fa-3x text-muted mb-3"></i>
            <h5 class="text-muted">Detalles de la Beca</h5>
            <p class="text-muted">Los detalles completos de la beca se cargarán próximamente.</p>
        </div>
    `);
    
    $('#modalVerBeca').modal('show');
}

function solicitarBeca(id) {
    becaSeleccionada = id;
    
    // Verificar elegibilidad antes de mostrar el modal
    $.ajax({
        url: '<?= base_url('estudiante/verificar-elegibilidad-beca') ?>',
        type: 'POST',
        data: { beca_id: id },
        success: function(response) {
            if (response.success && response.elegible) {
                mostrarFormularioSolicitud(response.beca);
            } else {
                mostrarError(response.message || 'No eres elegible para esta beca');
            }
        },
        error: function() {
            mostrarError('Error al verificar elegibilidad');
        }
    });
}

function mostrarFormularioSolicitud(beca) {
    const modalBody = $('#modalSolicitarBecaBody');
    
    let html = `
            <div class="row">
                <div class="col-md-6">
                <h6 class="font-weight-bold">Información de la Beca</h6>
                <p><strong>Nombre:</strong> ${beca.nombre}</p>
                <p><strong>Tipo:</strong> ${beca.tipo_beca}</p>
                <p><strong>Monto:</strong> ${beca.monto_beca ? '$' + beca.monto_beca : 'No especificado'}</p>
                <p><strong>Descripción:</strong> ${beca.descripcion || 'No disponible'}</p>
                </div>
                <div class="col-md-6">
                <h6 class="font-weight-bold">Documentos Requisitos</h6>
                <div id="documentosRequisitos">
                    <div class="text-center py-3">
                        <i class="fas fa-spinner fa-spin fa-2x text-muted"></i>
                        <p class="text-muted mt-2">Cargando requisitos...</p>
                    </div>
                </div>
                </div>
            </div>
        
        <div class="row mt-3">
            <div class="col-12">
                <div class="form-group">
                    <label for="motivoSolicitud">Motivo de la Solicitud *</label>
                    <textarea class="form-control" id="motivoSolicitud" rows="3" 
                              placeholder="Explique detalladamente por qué desea solicitar esta beca..." required></textarea>
                </div>
                </div>
            </div>
        `;
    
    modalBody.html(html);
    
    // Cargar documentos requisitos
    cargarDocumentosRequisitos(beca.id);
    
    $('#modalSolicitarBeca').modal('show');
}

function cargarDocumentosRequisitos(becaId) {
    // Aquí se cargarían los documentos requisitos de la beca
    // Por ahora mostramos un mensaje
    setTimeout(function() {
        $('#documentosRequisitos').html(`
            <div class="text-center py-3">
                <i class="fas fa-info-circle fa-2x text-muted mb-2"></i>
                <p class="text-muted">Documentos requisitos en desarrollo</p>
            </div>
        `);
    }, 1000);
}

function confirmarSolicitud() {
    const motivoSolicitud = $('#motivoSolicitud').val();
    
    if (!motivoSolicitud.trim()) {
        mostrarError('El motivo de la solicitud es obligatorio');
        return;
    }
    
    // Aquí se enviaría la solicitud
    // Por ahora mostramos un mensaje de éxito
    mostrarExito('Solicitud enviada exitosamente');
    $('#modalSolicitarBeca').modal('hide');
    
    // Recargar datos
    cargarBecasDisponibles();
    cargarMisSolicitudes();
    cargarEstadisticas();
}

function limpiarFiltros() {
    $('#filtroTipo').val('');
    $('#filtroPeriodo').val('');
    $('#filtroBuscar').val('');
}

function actualizarBecas() {
    cargarBecasDisponibles();
    cargarMisSolicitudes();
    cargarEstadisticas();
    mostrarExito('Información actualizada');
}

// Funciones de utilidad
function mostrarExito(mensaje) {
    Swal.fire({
        icon: 'success',
        title: 'Éxito',
        text: mensaje,
        timer: 3000,
        showConfirmButton: false
    });
}

function mostrarError(mensaje) {
    Swal.fire({
        icon: 'error',
        title: 'Error',
        text: mensaje
    });
}

function mostrarInfo(mensaje) {
    Swal.fire({
        icon: 'info',
        title: 'Información',
        text: mensaje
    });
}
</script>
<?= $this->endSection() ?> 