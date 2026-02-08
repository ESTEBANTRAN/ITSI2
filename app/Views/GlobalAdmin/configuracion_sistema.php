<?= $this->extend('layouts/mainGlobalAdmin') ?>

<?= $this->section('content') ?>
<div class="page-wrapper">
    <div class="page-content">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0">Configuración del Sistema</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="<?= base_url('index.php/global-admin/dashboard') ?>">Dashboard</a></li>
                            <li class="breadcrumb-item active">Configuración</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">
                            <i class="bi bi-gear me-2"></i>Configuración General del Sistema
                        </h5>
                    </div>
                    <div class="card-body">
                        <form id="configuracionForm">
                            <!-- Configuración de la Institución -->
                            <div class="row mb-4">
                                <div class="col-12">
                                    <h6 class="text-primary mb-3">Información de la Institución</h6>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="nombreInstitucion" class="form-label">Nombre de la Institución</label>
                                        <input type="text" class="form-control" id="nombreInstitucion" name="nombre_institucion" value="Instituto Superior Tecnológico Ibarra">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="direccionInstitucion" class="form-label">Dirección</label>
                                        <input type="text" class="form-control" id="direccionInstitucion" name="direccion" value="Ibarra, Av. Atahualpa 14-148 y José M. Leoro">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="telefonoInstitucion" class="form-label">Teléfono</label>
                                        <input type="text" class="form-control" id="telefonoInstitucion" name="telefono" value="062-952-535">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="celularInstitucion" class="form-label">Celular</label>
                                        <input type="text" class="form-control" id="celularInstitucion" name="celular" value="0978609734">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="emailInstitucion" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="emailInstitucion" name="email" value="itsiibarra@itsi.edu.ec">
                                    </div>
                                </div>
                            </div>

                            <!-- Configuración del Sistema -->
                            <div class="row mb-4">
                                <div class="col-12">
                                    <h6 class="text-primary mb-3">Configuración del Sistema</h6>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="nombreSistema" class="form-label">Nombre del Sistema</label>
                                        <input type="text" class="form-control" id="nombreSistema" name="nombre_sistema" value="Sistema de Bienestar Estudiantil">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="versionSistema" class="form-label">Versión del Sistema</label>
                                        <input type="text" class="form-control" id="versionSistema" name="version_sistema" value="1.0.0">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="timezone" class="form-label">Zona Horaria</label>
                                        <select class="form-select" id="timezone" name="timezone">
                                            <option value="America/Guayaquil" selected>Ecuador (GMT-5)</option>
                                            <option value="UTC">UTC</option>
                                            <option value="America/New_York">Eastern Time (GMT-5)</option>
                                            <option value="America/Los_Angeles">Pacific Time (GMT-8)</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="idioma" class="form-label">Idioma Predeterminado</label>
                                        <select class="form-select" id="idioma" name="idioma">
                                            <option value="es" selected>Español</option>
                                            <option value="en">English</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!-- Configuración de Seguridad -->
                            <div class="row mb-4">
                                <div class="col-12">
                                    <h6 class="text-primary mb-3">Configuración de Seguridad</h6>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="tiempoSesion" class="form-label">Tiempo de Sesión (minutos)</label>
                                        <input type="number" class="form-control" id="tiempoSesion" name="tiempo_sesion" value="120" min="30" max="480">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="intentosLogin" class="form-label">Intentos de Login Máximos</label>
                                        <input type="number" class="form-control" id="intentosLogin" name="intentos_login" value="3" min="1" max="10">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="captchaLogin" name="captcha_login">
                                            <label class="form-check-label" for="captchaLogin">
                                                Habilitar CAPTCHA en login
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="logAcciones" name="log_acciones" checked>
                                            <label class="form-check-label" for="logAcciones">
                                                Registrar todas las acciones
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Configuración de Notificaciones -->
                            <div class="row mb-4">
                                <div class="col-12">
                                    <h6 class="text-primary mb-3">Configuración de Notificaciones</h6>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="notifEmail" name="notif_email" checked>
                                            <label class="form-check-label" for="notifEmail">
                                                Notificaciones por Email
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="notifSistema" name="notif_sistema" checked>
                                            <label class="form-check-label" for="notifSistema">
                                                Notificaciones del Sistema
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="emailSistema" class="form-label">Email del Sistema</label>
                                        <input type="email" class="form-control" id="emailSistema" name="email_sistema" value="sistema@itsi.edu.ec">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="nombreSistemaEmail" class="form-label">Nombre del Remitente</label>
                                        <input type="text" class="form-control" id="nombreSistemaEmail" name="nombre_sistema_email" value="Sistema de Bienestar Estudiantil">
                                    </div>
                                </div>
                            </div>

                            <!-- Configuración de Respaldo -->
                            <div class="row mb-4">
                                <div class="col-12">
                                    <h6 class="text-primary mb-3">Configuración de Respaldo</h6>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="frecuenciaRespaldo" class="form-label">Frecuencia de Respaldo</label>
                                        <select class="form-select" id="frecuenciaRespaldo" name="frecuencia_respaldo">
                                            <option value="diario">Diario</option>
                                            <option value="semanal" selected>Semanal</option>
                                            <option value="mensual">Mensual</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="retenerRespaldo" class="form-label">Retener Respaldos (días)</label>
                                        <input type="number" class="form-control" id="retenerRespaldo" name="retener_respaldo" value="30" min="7" max="365">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="respaldoAutomatico" name="respaldo_automatico" checked>
                                            <label class="form-check-label" for="respaldoAutomatico">
                                                Respaldo Automático
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" id="comprimirRespaldo" name="comprimir_respaldo" checked>
                                            <label class="form-check-label" for="comprimirRespaldo">
                                                Comprimir Respaldos
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Botones de Acción -->
                            <div class="row">
                                <div class="col-12">
                                    <div class="d-flex justify-content-end gap-2">
                                        <button type="button" class="btn btn-secondary" onclick="restaurarConfiguracion()">
                                            <i class="bi bi-arrow-clockwise me-2"></i>Restaurar Valores
                                        </button>
                                        <button type="submit" class="btn btn-primary">
                                            <i class="bi bi-save me-2"></i>Guardar Configuración
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    // Cargar configuración actual
    cargarConfiguracion();
    
    // Manejar envío del formulario
    $('#configuracionForm').on('submit', function(e) {
        e.preventDefault();
        guardarConfiguracion();
    });
});

function cargarConfiguracion() {
    // Aquí se cargarían los valores actuales desde la base de datos
    console.log('Cargando configuración actual...');
}

function guardarConfiguracion() {
    const formData = new FormData($('#configuracionForm')[0]);
    
    $.ajax({
        url: '<?= base_url('index.php/global-admin/guardar-configuracion') ?>',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
            if (response.success) {
                Swal.fire({
                    icon: 'success',
                    title: '¡Configuración Guardada!',
                    text: 'Los cambios se han aplicado correctamente.',
                    confirmButtonText: 'Aceptar'
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: response.error || 'Error al guardar la configuración.',
                    confirmButtonText: 'Aceptar'
                });
            }
        },
        error: function() {
            Swal.fire({
                icon: 'error',
                title: 'Error de Conexión',
                text: 'No se pudo conectar con el servidor.',
                confirmButtonText: 'Aceptar'
            });
        }
    });
}

function restaurarConfiguracion() {
    Swal.fire({
        title: '¿Restaurar Configuración?',
        text: '¿Estás seguro de que quieres restaurar los valores por defecto?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, restaurar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            // Lógica para restaurar configuración
            Swal.fire(
                '¡Restaurado!',
                'La configuración ha sido restaurada a los valores por defecto.',
                'success'
            );
        }
    });
}
</script>
<?= $this->endSection() ?> 