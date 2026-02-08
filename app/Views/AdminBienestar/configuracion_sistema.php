<?= $this->extend('layouts/mainAdmin') ?>

<?= $this->section('content') ?>

<div class="container-fluid">
    <!-- Encabezado de la página -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">
            <i class="fas fa-cog mr-2"></i>Configuración del Sistema
        </h1>
</div>

    <!-- Configuraciones del sistema -->
    <div class="row">
<!-- Configuración General -->
        <div class="col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Configuración General</h6>
            </div>
            <div class="card-body">
                    <form id="formConfiguracionGeneral">
                        <div class="form-group">
                            <label for="nombre_institucion">Nombre de la Institución</label>
                            <input type="text" class="form-control" id="nombre_institucion" name="nombre_institucion" value="Instituto Tecnológico Superior de Informática">
                    </div>
                        <div class="form-group">
                            <label for="email_contacto">Email de Contacto</label>
                            <input type="email" class="form-control" id="email_contacto" name="email_contacto" value="bienestar@itsi.edu.ec">
                    </div>
                        <div class="form-group">
                            <label for="telefono_contacto">Teléfono de Contacto</label>
                            <input type="text" class="form-control" id="telefono_contacto" name="telefono_contacto" value="+593 2 1234567">
                    </div>
                        <div class="form-group">
                            <label for="direccion">Dirección</label>
                            <textarea class="form-control" id="direccion" name="direccion" rows="2">Av. Principal 123, Quito, Ecuador</textarea>
                    </div>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save mr-1"></i>Guardar Configuración
                        </button>
                </form>
        </div>
    </div>
</div>

<!-- Configuración de Notificaciones -->
        <div class="col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Configuración de Notificaciones</h6>
            </div>
            <div class="card-body">
                    <form id="formConfiguracionNotificaciones">
                        <div class="form-group">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="notificaciones_email" name="notificaciones_email" checked>
                                <label class="custom-control-label" for="notificaciones_email">Notificaciones por Email</label>
                    </div>
                    </div>
                        <div class="form-group">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="notificaciones_sistema" name="notificaciones_sistema" checked>
                                <label class="custom-control-label" for="notificaciones_sistema">Notificaciones del Sistema</label>
                    </div>
                    </div>
                        <div class="form-group">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="recordatorios_automaticos" name="recordatorios_automaticos" checked>
                                <label class="custom-control-label" for="recordatorios_automaticos">Recordatorios Automáticos</label>
                    </div>
                    </div>
                        <div class="form-group">
                            <label for="frecuencia_recordatorios">Frecuencia de Recordatorios</label>
                            <select class="form-control" id="frecuencia_recordatorios" name="frecuencia_recordatorios">
                                <option value="diario">Diario</option>
                                <option value="semanal" selected>Semanal</option>
                                <option value="quincenal">Quincenal</option>
                                <option value="mensual">Mensual</option>
                        </select>
                    </div>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save mr-1"></i>Guardar Configuración
                        </button>
                </form>
            </div>
        </div>
    </div>
</div>

    <!-- Configuración de Seguridad -->
                <div class="row">
        <div class="col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Configuración de Seguridad</h6>
                            </div>
                            <div class="card-body">
                    <form id="formConfiguracionSeguridad">
                        <div class="form-group">
                            <label for="tiempo_sesion">Tiempo de Sesión (minutos)</label>
                            <input type="number" class="form-control" id="tiempo_sesion" name="tiempo_sesion" value="30" min="5" max="480">
                                </div>
                        <div class="form-group">
                            <label for="intentos_login">Intentos de Login Máximos</label>
                            <input type="number" class="form-control" id="intentos_login" name="intentos_login" value="3" min="1" max="10">
                                </div>
                        <div class="form-group">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="requerir_cambio_password" name="requerir_cambio_password">
                                <label class="custom-control-label" for="requerir_cambio_password">Requerir Cambio de Contraseña</label>
                                </div>
                            </div>
                        <div class="form-group">
                            <label for="dias_cambio_password">Días para Cambio de Contraseña</label>
                            <input type="number" class="form-control" id="dias_cambio_password" name="dias_cambio_password" value="90" min="30" max="365">
                        </div>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save mr-1"></i>Guardar Configuración
                        </button>
                    </form>
        </div>
    </div>
</div>

        <!-- Configuración de Archivos -->
        <div class="col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Configuración de Archivos</h6>
            </div>
            <div class="card-body">
                    <form id="formConfiguracionArchivos">
                        <div class="form-group">
                            <label for="tamano_maximo_archivo">Tamaño Máximo de Archivo (MB)</label>
                            <input type="number" class="form-control" id="tamano_maximo_archivo" name="tamano_maximo_archivo" value="10" min="1" max="100">
                    </div>
                        <div class="form-group">
                            <label for="tipos_archivo_permitidos">Tipos de Archivo Permitidos</label>
                            <input type="text" class="form-control" id="tipos_archivo_permitidos" name="tipos_archivo_permitidos" value="pdf,jpg,jpeg,png,doc,docx" placeholder="pdf,jpg,jpeg,png,doc,docx">
                    </div>
                        <div class="form-group">
                            <label for="directorio_uploads">Directorio de Uploads</label>
                            <input type="text" class="form-control" id="directorio_uploads" name="directorio_uploads" value="uploads/" readonly>
                    </div>
                        <div class="form-group">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="comprimir_imagenes" name="comprimir_imagenes" checked>
                                <label class="custom-control-label" for="comprimir_imagenes">Comprimir Imágenes Automáticamente</label>
            </div>
        </div>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save mr-1"></i>Guardar Configuración
                        </button>
                </form>
            </div>
        </div>
    </div>
</div>

    <!-- Configuración de Respaldo -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Configuración de Respaldo</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                            <form id="formConfiguracionRespaldo">
                                <div class="form-group">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="respaldo_automatico" name="respaldo_automatico" checked>
                                        <label class="custom-control-label" for="respaldo_automatico">Respaldo Automático</label>
                                    </div>
                        </div>
                                <div class="form-group">
                                    <label for="frecuencia_respaldo">Frecuencia de Respaldo</label>
                                    <select class="form-control" id="frecuencia_respaldo" name="frecuencia_respaldo">
                                        <option value="diario">Diario</option>
                                        <option value="semanal" selected>Semanal</option>
                                        <option value="mensual">Mensual</option>
                                    </select>
                        </div>
                                <div class="form-group">
                                    <label for="hora_respaldo">Hora de Respaldo</label>
                                    <input type="time" class="form-control" id="hora_respaldo" name="hora_respaldo" value="02:00">
                        </div>
                                <div class="form-group">
                                    <label for="retener_respaldos">Retener Respaldos (días)</label>
                                    <input type="number" class="form-control" id="retener_respaldos" name="retener_respaldos" value="30" min="7" max="365">
                        </div>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save mr-1"></i>Guardar Configuración
                                </button>
                            </form>
                    </div>
                    <div class="col-md-6">
                            <h6>Acciones de Respaldo</h6>
                        <div class="mb-3">
                                <button type="button" class="btn btn-success btn-block" onclick="crearRespaldoManual()">
                                    <i class="fas fa-download mr-1"></i>Crear Respaldo Manual
                                </button>
                        </div>
                        <div class="mb-3">
                                <button type="button" class="btn btn-info btn-block" onclick="verRespaldos()">
                                    <i class="fas fa-list mr-1"></i>Ver Respaldos Existentes
                                </button>
                        </div>
                        <div class="mb-3">
                                <button type="button" class="btn btn-warning btn-block" onclick="restaurarRespaldo()">
                                    <i class="fas fa-upload mr-1"></i>Restaurar Respaldo
                                </button>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
$(document).ready(function() {
    cargarConfiguracion();

    // Eventos para guardar configuración
    $('#formConfiguracionGeneral').submit(function(e) {
        e.preventDefault();
        guardarConfiguracion('general');
    });

    $('#formConfiguracionNotificaciones').submit(function(e) {
        e.preventDefault();
        guardarConfiguracion('notificaciones');
    });

    $('#formConfiguracionSeguridad').submit(function(e) {
        e.preventDefault();
        guardarConfiguracion('seguridad');
    });

    $('#formConfiguracionArchivos').submit(function(e) {
        e.preventDefault();
        guardarConfiguracion('archivos');
    });

    $('#formConfiguracionRespaldo').submit(function(e) {
        e.preventDefault();
        guardarConfiguracion('respaldo');
    });
});

function cargarConfiguracion() {
    // Aquí se cargarían las configuraciones desde la base de datos
    // Por ahora usamos valores por defecto
}

function guardarConfiguracion(tipo) {
    const formData = new FormData(document.getElementById('formConfiguracion' + tipo.charAt(0).toUpperCase() + tipo.slice(1)));
    
    $.ajax({
        url: '<?= base_url('admin-bienestar/guardar-configuracion') ?>',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
            if (response.success) {
                mostrarExito('Configuración guardada exitosamente');
            } else {
                mostrarError('Error al guardar la configuración: ' + response.message);
            }
        },
        error: function() {
            mostrarError('Error de conexión al guardar la configuración');
        }
    });
}

function crearRespaldoManual() {
    Swal.fire({
        title: '¿Crear respaldo manual?',
        text: 'Esto puede tomar varios minutos...',
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Sí, crear respaldo',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: '<?= base_url('admin-bienestar/crear-respaldo-manual') ?>',
                type: 'POST',
                success: function(response) {
                    if (response.success) {
                        mostrarExito('Respaldo creado exitosamente');
                    } else {
                        mostrarError('Error al crear el respaldo: ' + response.message);
                    }
                },
                error: function() {
                    mostrarError('Error de conexión al crear el respaldo');
                }
            });
        }
    });
}

function verRespaldos() {
    // Implementar vista de respaldos
    mostrarInfo('Función en desarrollo');
}

function restaurarRespaldo() {
    // Implementar restauración de respaldo
    mostrarInfo('Función en desarrollo');
}

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