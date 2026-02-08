<?= $this->extend('layouts/mainEstudiante') ?>

<?= $this->section('content') ?>

<!-- Page Header -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-flex align-items-center justify-content-between">
            <div>
                <h4 class="mb-0">Solicitudes de Ayuda</h4>
                <p class="text-muted mb-0">Solicita ayuda y seguimiento a tus consultas</p>
            </div>
            <div class="page-title-right">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalNuevaSolicitud">
                    <i class="bi bi-plus-circle me-2"></i>Nueva Solicitud
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Estadísticas -->
<div class="row mb-4">
    <div class="col-md-3">
        <div class="card text-center">
            <div class="card-body">
                <div class="text-primary">
                    <i class="bi bi-chat-dots fs-2"></i>
                </div>
                <h3 class="mt-2"><?= count($solicitudes) ?></h3>
                <p class="text-muted mb-0">Total Solicitudes</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-center">
            <div class="card-body">
                <div class="text-warning">
                    <i class="bi bi-clock fs-2"></i>
                </div>
                <h3 class="mt-2"><?= count(array_filter($solicitudes, function($s) { return $s['estado'] == 'Pendiente'; })) ?></h3>
                <p class="text-muted mb-0">Pendientes</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-center">
            <div class="card-body">
                <div class="text-info">
                    <i class="bi bi-gear fs-2"></i>
                </div>
                <h3 class="mt-2"><?= count(array_filter($solicitudes, function($s) { return $s['estado'] == 'En Proceso'; })) ?></h3>
                <p class="text-muted mb-0">En Proceso</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-center">
            <div class="card-body">
                <div class="text-success">
                    <i class="bi bi-check-circle fs-2"></i>
                </div>
                <h3 class="mt-2"><?= count(array_filter($solicitudes, function($s) { return $s['estado'] == 'Resuelta'; })) ?></h3>
                <p class="text-muted mb-0">Resueltas</p>
            </div>
        </div>
    </div>
</div>

<!-- Lista de Solicitudes -->
<div class="card">
    <div class="card-header">
        <h5 class="card-title mb-0">Mis Solicitudes de Ayuda</h5>
    </div>
    <div class="card-body">
        <?php if (empty($solicitudes)): ?>
        <div class="text-center py-5">
            <i class="bi bi-inbox fs-1 text-muted"></i>
            <h5 class="mt-3 text-muted">No tienes solicitudes de ayuda</h5>
            <p class="text-muted">Crea tu primera solicitud usando el botón "Nueva Solicitud"</p>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalNuevaSolicitud">
                <i class="bi bi-plus-circle me-2"></i>Nueva Solicitud
            </button>
        </div>
        <?php else: ?>
        <div class="row">
            <?php foreach ($solicitudes as $solicitud): ?>
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card border-start-primary">
                    <div class="card-header pb-2">
                        <div class="d-flex justify-content-between align-items-start">
                            <h6 class="card-title mb-1"><?= esc($solicitud['asunto']) ?></h6>
                            <?php
                            $estadoClass = '';
                            switch($solicitud['estado']) {
                                case 'Pendiente': $estadoClass = 'bg-warning'; break;
                                case 'En Proceso': $estadoClass = 'bg-info'; break;
                                case 'Resuelta': $estadoClass = 'bg-success'; break;
                                default: $estadoClass = 'bg-secondary';
                            }
                            ?>
                            <span class="badge <?= $estadoClass ?> text-white"><?= $solicitud['estado'] ?></span>
                        </div>
                        <small class="text-muted">
                            <i class="bi bi-calendar me-1"></i>
                            <?= date('d/m/Y H:i', strtotime($solicitud['fecha_creacion'])) ?>
                        </small>
                    </div>
                    <div class="card-body">
                        <div class="mb-2">
                            <?php
                            $categoriaClass = '';
                            switch($solicitud['categoria']) {
                                case 'Académico': $categoriaClass = 'bg-primary'; break;
                                case 'Económico': $categoriaClass = 'bg-success'; break;
                                case 'Psicológico': $categoriaClass = 'bg-info'; break;
                                case 'Social': $categoriaClass = 'bg-warning text-dark'; break;
                                case 'Técnico': $categoriaClass = 'bg-secondary'; break;
                                default: $categoriaClass = 'bg-light text-dark';
                            }
                            ?>
                            <span class="badge <?= $categoriaClass ?>"><?= $solicitud['categoria'] ?></span>
                            
                            <?php if ($solicitud['prioridad'] == 'Alta'): ?>
                            <span class="badge bg-danger ms-1">
                                <i class="bi bi-exclamation-triangle me-1"></i>Alta Prioridad
                            </span>
                            <?php elseif ($solicitud['prioridad'] == 'Media'): ?>
                            <span class="badge bg-warning text-dark ms-1">Media Prioridad</span>
                            <?php endif; ?>
                        </div>
                        
                        <p class="card-text text-muted small">
                            <?= strlen($solicitud['descripcion']) > 100 ? 
                                esc(substr($solicitud['descripcion'], 0, 100)) . '...' : 
                                esc($solicitud['descripcion']) ?>
                        </p>
                        
                        <?php if (!empty($solicitud['comentarios_resolucion'])): ?>
                        <div class="alert alert-light py-2 mb-2">
                            <small><strong>Respuesta:</strong></small>
                            <small class="d-block text-muted">
                                <?= strlen($solicitud['comentarios_resolucion']) > 80 ? 
                                    esc(substr($solicitud['comentarios_resolucion'], 0, 80)) . '...' : 
                                    esc($solicitud['comentarios_resolucion']) ?>
                            </small>
                        </div>
                        <?php endif; ?>
                        
                        <?php if ($solicitud['estado'] == 'Resuelta' && !empty($solicitud['fecha_resolucion'])): ?>
                        <small class="text-success">
                            <i class="bi bi-check-circle me-1"></i>
                            Resuelta el <?= date('d/m/Y', strtotime($solicitud['fecha_resolucion'])) ?>
                        </small>
                        <?php endif; ?>
                    </div>
                    <div class="card-footer bg-transparent">
                        <div class="d-flex justify-content-between">
                            <button type="button" class="btn btn-sm btn-outline-primary" onclick="verDetalle(<?= $solicitud['id'] ?>)">
                                <i class="bi bi-eye me-1"></i>Ver Detalle
                            </button>
                            <?php if ($solicitud['estado'] != 'Resuelta'): ?>
                            <button type="button" class="btn btn-sm btn-outline-info" onclick="actualizarSolicitud(<?= $solicitud['id'] ?>)">
                                <i class="bi bi-pencil me-1"></i>Actualizar
                            </button>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
    </div>
</div>

<!-- Modal Nueva Solicitud -->
<div class="modal fade" id="modalNuevaSolicitud" tabindex="-1" aria-labelledby="modalNuevaSolicitudLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalNuevaSolicitudLabel">Nueva Solicitud de Ayuda</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="formNuevaSolicitud">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="mb-3">
                                <label for="asunto" class="form-label">Asunto <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="asunto" name="asunto" required 
                                       placeholder="Título breve de tu solicitud">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="categoria" class="form-label">Categoría <span class="text-danger">*</span></label>
                                <select class="form-select" id="categoria" name="categoria" required>
                                    <option value="">Seleccionar...</option>
                                    <option value="Académico">Académico</option>
                                    <option value="Económico">Económico</option>
                                    <option value="Psicológico">Psicológico</option>
                                    <option value="Social">Social</option>
                                    <option value="Técnico">Técnico</option>
                                    <option value="Otro">Otro</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="descripcion" class="form-label">Descripción <span class="text-danger">*</span></label>
                                <textarea class="form-control" id="descripcion" name="descripcion" rows="4" required
                                          placeholder="Describe detalladamente tu consulta o problema..."></textarea>
                                <div class="form-text">Sé específico para recibir una mejor ayuda</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="prioridad" class="form-label">Prioridad</label>
                                <select class="form-select" id="prioridad" name="prioridad">
                                    <option value="Baja">Baja</option>
                                    <option value="Media" selected>Media</option>
                                    <option value="Alta">Alta</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="contacto_preferido" class="form-label">Contacto Preferido</label>
                                <select class="form-select" id="contacto_preferido" name="contacto_preferido">
                                    <option value="Email">Email</option>
                                    <option value="Teléfono">Teléfono</option>
                                    <option value="Presencial">Presencial</option>
                                    <option value="WhatsApp">WhatsApp</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-send me-2"></i>Enviar Solicitud
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Ver Detalle -->
<div class="modal fade" id="modalDetalleSolicitud" tabindex="-1" aria-labelledby="modalDetalleSolicitudLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalDetalleSolicitudLabel">Detalle de Solicitud</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="modalDetalleSolicitudBody">
                <!-- Contenido cargado dinámicamente -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<style>
.border-start-primary {
    border-left: 4px solid #007bff !important;
}

.card {
    box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
    transition: box-shadow 0.15s ease-in-out;
}

.card:hover {
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
}

.badge {
    font-size: 0.7rem;
}

.alert-light {
    background-color: #f8f9fa;
    border: 1px solid #dee2e6;
}
</style>

<script>
// Variables globales
let solicitudActualId = null;

function verDetalle(id) {
    solicitudActualId = id;
    
    fetch(`<?= base_url('index.php/estudiante/solicitud-ayuda/') ?>${id}`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.getElementById('modalDetalleSolicitudBody').innerHTML = data.html;
                new bootstrap.Modal(document.getElementById('modalDetalleSolicitud')).show();
            } else {
                Swal.fire('Error', data.error, 'error');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            Swal.fire('Error', 'Error al cargar el detalle de la solicitud', 'error');
        });
}

function actualizarSolicitud(id) {
    // TODO: Implementar modal de actualización
    Swal.fire('Info', 'Funcionalidad de actualización en desarrollo', 'info');
}

// Crear nueva solicitud
document.getElementById('formNuevaSolicitud').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    const datos = Object.fromEntries(formData);
    
    // Validaciones básicas
    if (!datos.asunto.trim()) {
        Swal.fire('Error', 'El asunto es obligatorio', 'error');
        return;
    }
    
    if (!datos.descripcion.trim()) {
        Swal.fire('Error', 'La descripción es obligatoria', 'error');
        return;
    }
    
    if (datos.descripcion.length < 20) {
        Swal.fire('Error', 'La descripción debe tener al menos 20 caracteres', 'error');
        return;
    }
    
    // Mostrar loading
    const submitBtn = this.querySelector('button[type="submit"]');
    const originalText = submitBtn.innerHTML;
    submitBtn.innerHTML = '<i class="bi bi-hourglass-split me-2"></i>Enviando...';
    submitBtn.disabled = true;
    
    fetch(`<?= base_url('index.php/estudiante/solicitud-ayuda/crear') ?>`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-Requested-With': 'XMLHttpRequest'
        },
        body: JSON.stringify(datos)
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            Swal.fire({
                title: '¡Solicitud Enviada!',
                text: 'Tu solicitud ha sido enviada correctamente. Recibirás una respuesta pronto.',
                icon: 'success',
                confirmButtonText: 'Entendido'
            }).then(() => {
                bootstrap.Modal.getInstance(document.getElementById('modalNuevaSolicitud')).hide();
                location.reload();
            });
        } else {
            Swal.fire('Error', data.error, 'error');
            submitBtn.innerHTML = originalText;
            submitBtn.disabled = false;
        }
    })
    .catch(error => {
        console.error('Error:', error);
        Swal.fire('Error', 'Error al enviar la solicitud', 'error');
        submitBtn.innerHTML = originalText;
        submitBtn.disabled = false;
    });
});

// Limpiar formulario cuando se cierra el modal
document.getElementById('modalNuevaSolicitud').addEventListener('hidden.bs.modal', function() {
    document.getElementById('formNuevaSolicitud').reset();
    const submitBtn = this.querySelector('button[type="submit"]');
    submitBtn.innerHTML = '<i class="bi bi-send me-2"></i>Enviar Solicitud';
    submitBtn.disabled = false;
});

// Auto-resize textarea
document.getElementById('descripcion').addEventListener('input', function() {
    this.style.height = 'auto';
    this.style.height = (this.scrollHeight) + 'px';
});
</script>

<?= $this->endSection() ?>
