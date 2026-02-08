<?= $this->extend('layouts/mainAdmin') ?>

<?= $this->section('content') ?>

<div class="page-wrapper">
    <div class="page-content">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0">Comunicación y Resolución de Solicitudes</h4>
                    <div class="page-title-right">
                        <button class="btn btn-success" onclick="enviarNotificacionMasiva()">
                            <i class="bi bi-bell me-1"></i>Notificación Masiva
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Panel de Comunicación -->
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Panel de Comunicación</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Tipo de Comunicación</label>
                                    <select class="form-select" id="tipoComunicacion">
                                        <option value="email">Correo Electrónico</option>
                                        <option value="sms">SMS</option>
                                        <option value="notificacion">Notificación Interna</option>
                                        <option value="llamada">Llamada Telefónica</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Plantilla</label>
                                    <select class="form-select" id="plantillaComunicacion">
                                        <option value="">Seleccionar plantilla</option>
                                        <option value="solicitud_recibida">Solicitud Recibida</option>
                                        <option value="solicitud_en_proceso">Solicitud En Proceso</option>
                                        <option value="solicitud_resuelta">Solicitud Resuelta</option>
                                        <option value="documentos_requeridos">Documentos Requeridos</option>
                                        <option value="cita_programada">Cita Programada</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Asunto</label>
                            <input type="text" class="form-control" id="asuntoComunicacion" placeholder="Asunto de la comunicación">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Mensaje</label>
                            <textarea class="form-control" id="mensajeComunicacion" rows="6" placeholder="Escriba su mensaje aquí..."></textarea>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Destinatarios</label>
                                    <select class="form-select" id="destinatariosComunicacion" multiple>
                                        <option value="todos">Todos los estudiantes</option>
                                        <option value="pendientes">Solo solicitudes pendientes</option>
                                        <option value="urgentes">Solo solicitudes urgentes</option>
                                        <option value="especificos">Destinatarios específicos</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Programar Envío</label>
                                    <input type="datetime-local" class="form-control" id="programarEnvio">
                                </div>
                            </div>
                        </div>
                        <div class="text-end">
                            <button class="btn btn-secondary me-2" onclick="previsualizarComunicacion()">
                                <i class="bi bi-eye me-1"></i>Previsualizar
                            </button>
                            <button class="btn btn-primary" onclick="enviarComunicacion()">
                                <i class="bi bi-send me-1"></i>Enviar Comunicación
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Estadísticas de Comunicación</h5>
                    </div>
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <div class="flex-shrink-0">
                                <div class="avatar-sm rounded-circle bg-primary">
                                    <span class="avatar-title text-white">
                                        <i class="bi bi-envelope"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6 class="mb-1">Correos Enviados</h6>
                                <h4 class="mb-0">1,247</h4>
                            </div>
                        </div>
                        <div class="d-flex align-items-center mb-3">
                            <div class="flex-shrink-0">
                                <div class="avatar-sm rounded-circle bg-success">
                                    <span class="avatar-title text-white">
                                        <i class="bi bi-check-circle"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6 class="mb-1">Leídos</h6>
                                <h4 class="mb-0">1,156</h4>
                            </div>
                        </div>
                        <div class="d-flex align-items-center mb-3">
                            <div class="flex-shrink-0">
                                <div class="avatar-sm rounded-circle bg-warning">
                                    <span class="avatar-title text-white">
                                        <i class="bi bi-clock"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6 class="mb-1">Pendientes</h6>
                                <h4 class="mb-0">91</h4>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <div class="avatar-sm rounded-circle bg-info">
                                    <span class="avatar-title text-white">
                                        <i class="bi bi-phone"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6 class="mb-1">Llamadas</h6>
                                <h4 class="mb-0">89</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Historial de Comunicaciones -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Historial de Comunicaciones</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Fecha</th>
                                        <th>Tipo</th>
                                        <th>Asunto</th>
                                        <th>Destinatarios</th>
                                        <th>Estado</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>2024-01-15 14:30</td>
                                        <td><i class="bi bi-envelope text-primary"></i> Email</td>
                                        <td>Actualización sobre solicitud de ayuda</td>
                                        <td>María González</td>
                                        <td><span class="badge bg-success">Enviado</span></td>
                                        <td>
                                            <button class="btn btn-sm btn-outline-primary" onclick="verComunicacion(1)">
                                                <i class="bi bi-eye"></i>
                                            </button>
                                            <button class="btn btn-sm btn-outline-secondary" onclick="reenviarComunicacion(1)">
                                                <i class="bi bi-arrow-repeat"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>2024-01-15 11:15</td>
                                        <td><i class="bi bi-bell text-warning"></i> Notificación</td>
                                        <td>Recordatorio de documentación pendiente</td>
                                        <td>Carlos Rodríguez</td>
                                        <td><span class="badge bg-success">Enviado</span></td>
                                        <td>
                                            <button class="btn btn-sm btn-outline-primary" onclick="verComunicacion(2)">
                                                <i class="bi bi-eye"></i>
                                            </button>
                                            <button class="btn btn-sm btn-outline-secondary" onclick="reenviarComunicacion(2)">
                                                <i class="bi bi-arrow-repeat"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>2024-01-14 16:45</td>
                                        <td><i class="bi bi-phone text-info"></i> Llamada</td>
                                        <td>Confirmación de cita</td>
                                        <td>Laura Silva</td>
                                        <td><span class="badge bg-success">Completada</span></td>
                                        <td>
                                            <button class="btn btn-sm btn-outline-primary" onclick="verComunicacion(3)">
                                                <i class="bi bi-eye"></i>
                                            </button>
                                            <button class="btn btn-sm btn-outline-secondary" onclick="reenviarComunicacion(3)">
                                                <i class="bi bi-arrow-repeat"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Ver Comunicación -->
<div class="modal fade" id="verComunicacionModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detalles de la Comunicación</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-8">
                        <h6>Asunto</h6>
                        <p id="comunicacionAsunto">Actualización sobre solicitud de ayuda</p>
                        
                        <h6>Mensaje</h6>
                        <div class="border rounded p-3 bg-light">
                            <p id="comunicacionMensaje">
                                Estimada María González,<br><br>
                                Hemos recibido su solicitud de ayuda económica y queremos informarle que está siendo procesada. 
                                Nuestro equipo de bienestar estudiantil revisará su caso en los próximos días.<br><br>
                                Le mantendremos informada sobre cualquier actualización.<br><br>
                                Saludos cordiales,<br>
                                Equipo de Bienestar Estudiantil
                            </p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h6>Información de la Comunicación</h6>
                                <table class="table table-sm">
                                    <tr>
                                        <td><strong>Tipo:</strong></td>
                                        <td>Email</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Destinatario:</strong></td>
                                        <td>María González</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Fecha:</strong></td>
                                        <td>2024-01-15 14:30</td>
                                    </tr>
                                    <tr>
                                        <td><strong>Estado:</strong></td>
                                        <td><span class="badge bg-success">Enviado</span></td>
                                    </tr>
                                    <tr>
                                        <td><strong>Leído:</strong></td>
                                        <td><span class="badge bg-success">Sí</span></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" onclick="reenviarComunicacion()">Reenviar</button>
            </div>
        </div>
    </div>
</div>

<script>
function enviarComunicacion() {
    // Implementar lógica para enviar comunicación
    alert('Comunicación enviada exitosamente');
}

function previsualizarComunicacion() {
    // Implementar lógica para previsualizar
    alert('Previsualizando comunicación...');
}

function enviarNotificacionMasiva() {
    // Implementar lógica para notificación masiva
    alert('Enviando notificación masiva...');
}

function verComunicacion(id) {
    // Cargar datos de la comunicación
    $('#verComunicacionModal').modal('show');
}

function reenviarComunicacion(id) {
    // Implementar lógica para reenviar
    alert('Comunicación reenviada exitosamente');
}

// Cargar plantillas según selección
document.getElementById('plantillaComunicacion').addEventListener('change', function() {
    const plantilla = this.value;
    const asunto = document.getElementById('asuntoComunicacion');
    const mensaje = document.getElementById('mensajeComunicacion');
    
    switch(plantilla) {
        case 'solicitud_recibida':
            asunto.value = 'Solicitud Recibida - Bienestar Estudiantil';
            mensaje.value = 'Estimado/a estudiante,\n\nHemos recibido su solicitud y está siendo procesada. Le mantendremos informado/a sobre cualquier actualización.\n\nSaludos cordiales,\nEquipo de Bienestar Estudiantil';
            break;
        case 'solicitud_en_proceso':
            asunto.value = 'Solicitud En Proceso - Actualización';
            mensaje.value = 'Estimado/a estudiante,\n\nSu solicitud está siendo procesada activamente. Esperamos tener una respuesta para usted en los próximos días.\n\nSaludos cordiales,\nEquipo de Bienestar Estudiantil';
            break;
        case 'solicitud_resuelta':
            asunto.value = 'Solicitud Resuelta - Información Importante';
            mensaje.value = 'Estimado/a estudiante,\n\nSu solicitud ha sido resuelta. Por favor revise los detalles adjuntos.\n\nSaludos cordiales,\nEquipo de Bienestar Estudiantil';
            break;
    }
});
</script>

<?= $this->endSection() ?> 