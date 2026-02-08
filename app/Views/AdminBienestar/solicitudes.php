<?= $this->extend('layouts/mainAdmin') ?>

<?= $this->section('content') ?>

<div class="page-wrapper">
    <div class="page-content">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0">Gestión de Solicitudes de Ayuda</h4>
                    <div class="page-title-right">
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#nuevaSolicitudModal">
                            <i class="bi bi-plus-circle me-1"></i>Nueva Solicitud
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Estadísticas Rápidas -->
        <div class="row">
            <div class="col-xl-3 col-lg-6 col-md-6">
                <div class="card mini-stat">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <h4 class="fw-medium">Total Solicitudes</h4>
                                <h4 class="mb-0">1,247</h4>
                            </div>
                            <div class="flex-shrink-0 align-self-center">
                                <div class="mini-stat-icon avatar-sm rounded-circle bg-primary">
                                    <span class="avatar-title">
                                        <i class="bi bi-ticket-detailed font-size-24"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6">
                <div class="card mini-stat">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <h4 class="fw-medium">Pendientes</h4>
                                <h4 class="mb-0">89</h4>
                            </div>
                            <div class="flex-shrink-0 align-self-center">
                                <div class="mini-stat-icon avatar-sm rounded-circle bg-warning">
                                    <span class="avatar-title">
                                        <i class="bi bi-clock font-size-24"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6">
                <div class="card mini-stat">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <h4 class="fw-medium">En Proceso</h4>
                                <h4 class="mb-0">156</h4>
                            </div>
                            <div class="flex-shrink-0 align-self-center">
                                <div class="mini-stat-icon avatar-sm rounded-circle bg-info">
                                    <span class="avatar-title">
                                        <i class="bi bi-gear font-size-24"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6">
                <div class="card mini-stat">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <h4 class="fw-medium">Resueltas</h4>
                                <h4 class="mb-0">1,002</h4>
                            </div>
                            <div class="flex-shrink-0 align-self-center">
                                <div class="mini-stat-icon avatar-sm rounded-circle bg-success">
                                    <span class="avatar-title">
                                        <i class="bi bi-check-circle font-size-24"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filtros y Búsqueda -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-md-3">
                                <label class="form-label">Estado</label>
                                <select class="form-select" id="filtroEstado">
                                    <option value="">Todos los estados</option>
                                    <option value="Pendiente">Pendiente</option>
                                    <option value="En Proceso">En Proceso</option>
                                    <option value="Resuelta">Resuelta</option>
                                    <option value="Cerrada">Cerrada</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Prioridad</label>
                                <select class="form-select" id="filtroPrioridad">
                                    <option value="">Todas las prioridades</option>
                                    <option value="Baja">Baja</option>
                                    <option value="Media">Media</option>
                                    <option value="Alta">Alta</option>
                                    <option value="Urgente">Urgente</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Fecha Desde</label>
                                <input type="date" class="form-control" id="fechaDesde">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Fecha Hasta</label>
                                <input type="date" class="form-control" id="fechaHasta">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Buscar por asunto, estudiante..." id="busquedaSolicitudes">
                                    <button class="btn btn-outline-secondary" type="button">
                                        <i class="bi bi-search"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="col-md-6 text-end">
                                <button class="btn btn-outline-primary me-2" onclick="exportarSolicitudes()">
                                    <i class="bi bi-download me-1"></i>Exportar
                                </button>
                                <button class="btn btn-outline-secondary" onclick="limpiarFiltros()">
                                    <i class="bi bi-arrow-clockwise me-1"></i>Limpiar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabla de Solicitudes -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover" id="tablaSolicitudes">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Estudiante</th>
                                        <th>Asunto</th>
                                        <th>Estado</th>
                                        <th>Prioridad</th>
                                        <th>Responsable</th>
                                        <th>Fecha</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>#001</td>
                                        <td>María González</td>
                                        <td>Solicitud de ayuda económica</td>
                                        <td><span class="badge bg-warning">Pendiente</span></td>
                                        <td><span class="badge bg-danger">Urgente</span></td>
                                        <td>Ana Martínez</td>
                                        <td>2024-01-15</td>
                                        <td>
                                            <button class="btn btn-sm btn-outline-primary" onclick="verSolicitud(1)">
                                                <i class="bi bi-eye"></i>
                                            </button>
                                            <button class="btn btn-sm btn-outline-success" onclick="responderSolicitud(1)">
                                                <i class="bi bi-chat-dots"></i>
                                            </button>
                                            <button class="btn btn-sm btn-outline-warning" onclick="editarSolicitud(1)">
                                                <i class="bi bi-pencil"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>#002</td>
                                        <td>Carlos Rodríguez</td>
                                        <td>Problema con acceso a plataforma</td>
                                        <td><span class="badge bg-info">En Proceso</span></td>
                                        <td><span class="badge bg-warning">Media</span></td>
                                        <td>Luis Pérez</td>
                                        <td>2024-01-14</td>
                                        <td>
                                            <button class="btn btn-sm btn-outline-primary" onclick="verSolicitud(2)">
                                                <i class="bi bi-eye"></i>
                                            </button>
                                            <button class="btn btn-sm btn-outline-success" onclick="responderSolicitud(2)">
                                                <i class="bi bi-chat-dots"></i>
                                            </button>
                                            <button class="btn btn-sm btn-outline-warning" onclick="editarSolicitud(2)">
                                                <i class="bi bi-pencil"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>#003</td>
                                        <td>Laura Silva</td>
                                        <td>Consulta sobre becas disponibles</td>
                                        <td><span class="badge bg-success">Resuelta</span></td>
                                        <td><span class="badge bg-secondary">Baja</span></td>
                                        <td>Ana Martínez</td>
                                        <td>2024-01-13</td>
                                        <td>
                                            <button class="btn btn-sm btn-outline-primary" onclick="verSolicitud(3)">
                                                <i class="bi bi-eye"></i>
                                            </button>
                                            <button class="btn btn-sm btn-outline-success" onclick="responderSolicitud(3)">
                                                <i class="bi bi-chat-dots"></i>
                                            </button>
                                            <button class="btn btn-sm btn-outline-warning" onclick="editarSolicitud(3)">
                                                <i class="bi bi-pencil"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        
                        <!-- Paginación -->
                        <nav aria-label="Paginación de solicitudes">
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
            </div>
        </div>
    </div>
</div>

<!-- Modal Nueva Solicitud -->
<div class="modal fade" id="nuevaSolicitudModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Nueva Solicitud de Ayuda</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="formNuevaSolicitud">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Estudiante</label>
                                <select class="form-select" required>
                                    <option value="">Seleccionar estudiante</option>
                                    <option value="1">María González</option>
                                    <option value="2">Carlos Rodríguez</option>
                                    <option value="3">Laura Silva</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Prioridad</label>
                                <select class="form-select" required>
                                    <option value="Baja">Baja</option>
                                    <option value="Media" selected>Media</option>
                                    <option value="Alta">Alta</option>
                                    <option value="Urgente">Urgente</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Asunto</label>
                        <input type="text" class="form-control" placeholder="Título de la solicitud" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Descripción</label>
                        <textarea class="form-control" rows="4" placeholder="Descripción detallada de la solicitud" required></textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Responsable</label>
                                <select class="form-select">
                                    <option value="">Sin asignar</option>
                                    <option value="1">Ana Martínez</option>
                                    <option value="2">Luis Pérez</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Estado</label>
                                <select class="form-select" required>
                                    <option value="Pendiente" selected>Pendiente</option>
                                    <option value="En Proceso">En Proceso</option>
                                    <option value="Resuelta">Resuelta</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" onclick="guardarSolicitud()">Guardar Solicitud</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Ver Solicitud -->
<div class="modal fade" id="verSolicitudModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detalles de la Solicitud</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-8">
                        <h6>Asunto</h6>
                        <p id="solicitudAsunto">Solicitud de ayuda económica</p>
                        
                        <h6>Descripción</h6>
                        <p id="solicitudDescripcion">Necesito ayuda económica para continuar mis estudios. Mi situación familiar es complicada y no puedo cubrir los gastos de matrícula.</p>
                        
                        <h6>Historial de Respuestas</h6>
                        <div class="border rounded p-3" style="max-height: 300px; overflow-y: auto;">
                            <div class="d-flex mb-3">
                                <div class="flex-shrink-0">
                                    <div class="avatar-sm rounded-circle bg-primary">
                                        <span class="avatar-title text-white">AM</span>
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h6 class="mb-1">Ana Martínez <small class="text-muted">2024-01-15 10:30</small></h6>
                                    <p class="mb-0">Hola María, hemos revisado tu solicitud. Te contactaremos en los próximos días para coordinar la ayuda económica.</p>
                                </div>
                            </div>
                            <div class="d-flex mb-3">
                                <div class="flex-shrink-0">
                                    <div class="avatar-sm rounded-circle bg-success">
                                        <span class="avatar-title text-white">MG</span>
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h6 class="mb-1">María González <small class="text-muted">2024-01-15 09:15</small></h6>
                                    <p class="mb-0">Gracias por la información. ¿Qué documentos necesito presentar?</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h6>Información de la Solicitud</h6>
                                <table class="table table-sm">
                                    <tr>
                                        <td><strong>ID:</strong></td>
                                        <td>#001</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Estado:</strong></td>
                                        <td><span class="badge bg-warning">Pendiente</span></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Prioridad:</strong></td>
                                        <td><span class="badge bg-danger">Urgente</span></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Estudiante:</strong></td>
                                        <td>María González</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Responsable:</strong></td>
                                        <td>Ana Martínez</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Fecha:</strong></td>
                                        <td>2024-01-15</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" onclick="responderSolicitud()">Responder</button>
            </div>
        </div>
    </div>
</div>

<script>
function verSolicitud(id) {
    // Aquí cargarías los datos de la solicitud
    $('#verSolicitudModal').modal('show');
}

function responderSolicitud(id) {
    // Implementar lógica para responder
    alert('Función de respuesta para solicitud #' + id);
}

function editarSolicitud(id) {
    // Implementar lógica para editar
    alert('Función de edición para solicitud #' + id);
}

function guardarSolicitud() {
    // Implementar lógica para guardar
    alert('Solicitud guardada exitosamente');
    $('#nuevaSolicitudModal').modal('hide');
}

function exportarSolicitudes() {
    // Implementar lógica de exportación
    alert('Exportando solicitudes...');
}

function limpiarFiltros() {
    $('#filtroEstado').val('');
    $('#filtroPrioridad').val('');
    $('#fechaDesde').val('');
    $('#fechaHasta').val('');
    $('#busquedaSolicitudes').val('');
}
</script>

<?= $this->endSection() ?> 