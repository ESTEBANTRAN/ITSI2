<?= $this->extend('layouts/mainAdmin') ?>

<?= $this->section('content') ?>

<div class="page-wrapper">
    <div class="page-content">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-flex align-items-center justify-content-between">
                    <h4 class="mb-0">Integración de Información de Solicitudes</h4>
                    <div class="page-title-right">
                        <button class="btn btn-primary" onclick="sincronizarDatos()">
                            <i class="bi bi-arrow-repeat me-1"></i>Sincronizar Datos
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Panel de Integración -->
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Configuración de Integración</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Sistema de Origen</label>
                                    <select class="form-select" id="sistemaOrigen">
                                        <option value="academico">Sistema Académico</option>
                                        <option value="financiero">Sistema Financiero</option>
                                        <option value="matricula">Sistema de Matrícula</option>
                                        <option value="externo">Sistema Externo</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Tipo de Datos</label>
                                    <select class="form-select" id="tipoDatos" multiple>
                                        <option value="estudiantes">Información de Estudiantes</option>
                                        <option value="academicos">Datos Académicos</option>
                                        <option value="financieros">Datos Financieros</option>
                                        <option value="documentos">Documentos</option>
                                        <option value="contacto">Información de Contacto</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Frecuencia de Sincronización</label>
                                    <select class="form-select" id="frecuenciaSincronizacion">
                                        <option value="manual">Manual</option>
                                        <option value="diaria">Diaria</option>
                                        <option value="semanal">Semanal</option>
                                        <option value="mensual">Mensual</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Última Sincronización</label>
                                    <input type="text" class="form-control" value="2024-01-15 14:30" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">URL de API</label>
                            <input type="url" class="form-control" id="urlApi" placeholder="https://api.sistema.edu.ec/">
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Usuario API</label>
                                    <input type="text" class="form-control" id="usuarioApi" placeholder="usuario_api">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Contraseña API</label>
                                    <input type="password" class="form-control" id="passwordApi" placeholder="••••••••">
                                </div>
                            </div>
                        </div>
                        <div class="text-end">
                            <button class="btn btn-secondary me-2" onclick="probarConexion()">
                                <i class="bi bi-wifi me-1"></i>Probar Conexión
                            </button>
                            <button class="btn btn-primary" onclick="guardarConfiguracion()">
                                <i class="bi bi-save me-1"></i>Guardar Configuración
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Estado de Integración</h5>
                    </div>
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-3">
                            <div class="flex-shrink-0">
                                <div class="avatar-sm rounded-circle bg-success">
                                    <span class="avatar-title text-white">
                                        <i class="bi bi-check-circle"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6 class="mb-1">Conexión Activa</h6>
                                <small class="text-muted">Última verificación: 2 min</small>
                            </div>
                        </div>
                        <div class="d-flex align-items-center mb-3">
                            <div class="flex-shrink-0">
                                <div class="avatar-sm rounded-circle bg-info">
                                    <span class="avatar-title text-white">
                                        <i class="bi bi-database"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6 class="mb-1">Datos Sincronizados</h6>
                                <small class="text-muted">1,247 registros</small>
                            </div>
                        </div>
                        <div class="d-flex align-items-center mb-3">
                            <div class="flex-shrink-0">
                                <div class="avatar-sm rounded-circle bg-warning">
                                    <span class="avatar-title text-white">
                                        <i class="bi bi-exclamation-triangle"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6 class="mb-1">Errores</h6>
                                <small class="text-muted">3 errores menores</small>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0">
                                <div class="avatar-sm rounded-circle bg-primary">
                                    <span class="avatar-title text-white">
                                        <i class="bi bi-clock"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="flex-grow-1 ms-3">
                                <h6 class="mb-1">Próxima Sincronización</h6>
                                <small class="text-muted">En 2 horas</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Log de Sincronización -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Log de Sincronización</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Fecha</th>
                                        <th>Tipo</th>
                                        <th>Descripción</th>
                                        <th>Registros</th>
                                        <th>Estado</th>
                                        <th>Duración</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>2024-01-15 14:30</td>
                                        <td><span class="badge bg-success">Sincronización</span></td>
                                        <td>Sincronización automática de datos de estudiantes</td>
                                        <td>1,247</td>
                                        <td><span class="badge bg-success">Completado</span></td>
                                        <td>2m 15s</td>
                                    </tr>
                                    <tr>
                                        <td>2024-01-15 12:15</td>
                                        <td><span class="badge bg-warning">Actualización</span></td>
                                        <td>Actualización de información financiera</td>
                                        <td>89</td>
                                        <td><span class="badge bg-success">Completado</span></td>
                                        <td>45s</td>
                                    </tr>
                                    <tr>
                                        <td>2024-01-15 10:00</td>
                                        <td><span class="badge bg-danger">Error</span></td>
                                        <td>Error de conexión con sistema externo</td>
                                        <td>0</td>
                                        <td><span class="badge bg-danger">Fallido</span></td>
                                        <td>30s</td>
                                    </tr>
                                    <tr>
                                        <td>2024-01-14 18:00</td>
                                        <td><span class="badge bg-success">Sincronización</span></td>
                                        <td>Sincronización manual de documentos</td>
                                        <td>156</td>
                                        <td><span class="badge bg-success">Completado</span></td>
                                        <td>1m 30s</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Mapeo de Campos -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Mapeo de Campos</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Campo Origen</th>
                                        <th>Tipo</th>
                                        <th>Campo Destino</th>
                                        <th>Transformación</th>
                                        <th>Estado</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>student_id</td>
                                        <td>Integer</td>
                                        <td>id_estudiante</td>
                                        <td>Directo</td>
                                        <td><span class="badge bg-success">Activo</span></td>
                                        <td>
                                            <button class="btn btn-sm btn-outline-warning">
                                                <i class="bi bi-pencil"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>full_name</td>
                                        <td>String</td>
                                        <td>nombre_completo</td>
                                        <td>Concatenación</td>
                                        <td><span class="badge bg-success">Activo</span></td>
                                        <td>
                                            <button class="btn btn-sm btn-outline-warning">
                                                <i class="bi bi-pencil"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>email_address</td>
                                        <td>String</td>
                                        <td>email</td>
                                        <td>Directo</td>
                                        <td><span class="badge bg-success">Activo</span></td>
                                        <td>
                                            <button class="btn btn-sm btn-outline-warning">
                                                <i class="bi bi-pencil"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>phone_number</td>
                                        <td>String</td>
                                        <td>telefono</td>
                                        <td>Formato</td>
                                        <td><span class="badge bg-warning">Pendiente</span></td>
                                        <td>
                                            <button class="btn btn-sm btn-outline-warning">
                                                <i class="bi bi-pencil"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="text-end mt-3">
                            <button class="btn btn-primary" onclick="agregarMapeo()">
                                <i class="bi bi-plus-circle me-1"></i>Agregar Mapeo
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Configuración Avanzada -->
<div class="modal fade" id="configuracionAvanzadaModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Configuración Avanzada de Integración</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <h6>Configuración de API</h6>
                        <div class="mb-3">
                            <label class="form-label">Timeout (segundos)</label>
                            <input type="number" class="form-control" value="30">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Reintentos</label>
                            <input type="number" class="form-control" value="3">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Tamaño de Lote</label>
                            <input type="number" class="form-control" value="100">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h6>Configuración de Seguridad</h6>
                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="sslVerification" checked>
                                <label class="form-check-label" for="sslVerification">
                                    Verificación SSL
                                </label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="dataEncryption" checked>
                                <label class="form-check-label" for="dataEncryption">
                                    Encriptación de Datos
                                </label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="auditLog">
                                <label class="form-check-label" for="auditLog">
                                    Log de Auditoría
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" onclick="guardarConfiguracionAvanzada()">Guardar</button>
            </div>
        </div>
    </div>
</div>

<script>
function sincronizarDatos() {
    // Implementar lógica de sincronización
    alert('Iniciando sincronización de datos...');
}

function probarConexion() {
    // Implementar lógica para probar conexión
    alert('Probando conexión con el sistema...');
}

function guardarConfiguracion() {
    // Implementar lógica para guardar configuración
    alert('Configuración guardada exitosamente');
}

function agregarMapeo() {
    // Implementar lógica para agregar mapeo
    alert('Agregando nuevo mapeo de campos...');
}

function guardarConfiguracionAvanzada() {
    // Implementar lógica para guardar configuración avanzada
    alert('Configuración avanzada guardada');
    $('#configuracionAvanzadaModal').modal('hide');
}

// Validar URL de API
document.getElementById('urlApi').addEventListener('blur', function() {
    const url = this.value;
    if (url && !url.startsWith('http')) {
        this.classList.add('is-invalid');
        alert('La URL debe comenzar con http:// o https://');
    } else {
        this.classList.remove('is-invalid');
    }
});

// Mostrar configuración avanzada
function mostrarConfiguracionAvanzada() {
    $('#configuracionAvanzadaModal').modal('show');
}
</script>

<?= $this->endSection() ?> 