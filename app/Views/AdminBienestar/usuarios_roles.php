<?= $this->extend('layouts/mainAdmin') ?>

<?= $this->section('content') ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="mb-0">Gestión de Roles</h1>
    <div class="d-flex gap-2">
        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#nuevoRolModal">
            <i class="bi bi-plus-circle"></i> Nuevo Rol
        </button>
        <button type="button" class="btn btn-info" onclick="exportarRoles()">
            <i class="bi bi-download"></i> Exportar
        </button>
    </div>
</div>

<!-- Estadísticas de Roles -->
<div class="row mb-4">
    <div class="col-md-3">
        <div class="card bg-primary text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h6 class="card-title">Total Roles</h6>
                        <h3 class="mb-0">4</h3>
                    </div>
                    <div class="align-self-center">
                        <i class="bi bi-shield-lock fs-1"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-success text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h6 class="card-title">Roles Activos</h6>
                        <h3 class="mb-0">4</h3>
                    </div>
                    <div class="align-self-center">
                        <i class="bi bi-check-circle fs-1"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-info text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h6 class="card-title">Usuarios Asignados</h6>
                        <h3 class="mb-0">1,259</h3>
                    </div>
                    <div class="align-self-center">
                        <i class="bi bi-people fs-1"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-warning text-white">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <h6 class="card-title">Permisos Configurados</h6>
                        <h3 class="mb-0">24</h3>
                    </div>
                    <div class="align-self-center">
                        <i class="bi bi-gear fs-1"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Tabla de Roles -->
<div class="card">
    <div class="card-header">
        <h5 class="card-title mb-0">Roles del Sistema</h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover" id="tablaRoles">
                <thead class="table-light">
                    <tr>
                        <th>Rol</th>
                        <th>Descripción</th>
                        <th>Usuarios</th>
                        <th>Permisos</th>
                        <th>Estado</th>
                        <th>Última Modificación</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Datos de ejemplo -->
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center me-2" 
                                     style="width: 32px; height: 32px;">
                                    <i class="bi bi-person text-white"></i>
                                </div>
                                <div>
                                    <div class="fw-bold">Estudiante</div>
                                    <small class="text-muted">Rol básico del sistema</small>
                                </div>
                            </div>
                        </td>
                        <td>Acceso a formularios socioeconómicos, solicitudes de becas y tickets de atención</td>
                        <td>
                            <span class="badge bg-primary">1,247 usuarios</span>
                        </td>
                        <td>
                            <span class="badge bg-info">8 permisos</span>
                        </td>
                        <td>
                            <span class="badge bg-success">Activo</span>
                        </td>
                        <td>Hace 2 días</td>
                        <td>
                            <div class="btn-group" role="group">
                                <button type="button" class="btn btn-sm btn-outline-primary" 
                                        onclick="verRol(1)" title="Ver Detalles">
                                    <i class="bi bi-eye"></i>
                                </button>
                                <button type="button" class="btn btn-sm btn-outline-secondary" 
                                        onclick="editarRol(1)" title="Editar">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <button type="button" class="btn btn-sm btn-outline-info" 
                                        onclick="verPermisos(1)" title="Ver Permisos">
                                    <i class="bi bi-shield-check"></i>
                                </button>
                                <button type="button" class="btn btn-sm btn-outline-warning" 
                                        onclick="duplicarRol(1)" title="Duplicar">
                                    <i class="bi bi-files"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="bg-success rounded-circle d-flex align-items-center justify-content-center me-2" 
                                     style="width: 32px; height: 32px;">
                                    <i class="bi bi-person-badge text-white"></i>
                                </div>
                                <div>
                                    <div class="fw-bold">Administrativo Bienestar</div>
                                    <small class="text-muted">Gestión de bienestar estudiantil</small>
                                </div>
                            </div>
                        </td>
                        <td>Gestión completa de fichas socioeconómicas, becas, tickets y reportes</td>
                        <td>
                            <span class="badge bg-success">8 usuarios</span>
                        </td>
                        <td>
                            <span class="badge bg-info">15 permisos</span>
                        </td>
                        <td>
                            <span class="badge bg-success">Activo</span>
                        </td>
                        <td>Hace 1 día</td>
                        <td>
                            <div class="btn-group" role="group">
                                <button type="button" class="btn btn-sm btn-outline-primary" 
                                        onclick="verRol(2)" title="Ver Detalles">
                                    <i class="bi bi-eye"></i>
                                </button>
                                <button type="button" class="btn btn-sm btn-outline-secondary" 
                                        onclick="editarRol(2)" title="Editar">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <button type="button" class="btn btn-sm btn-outline-info" 
                                        onclick="verPermisos(2)" title="Ver Permisos">
                                    <i class="bi bi-shield-check"></i>
                                </button>
                                <button type="button" class="btn btn-sm btn-outline-warning" 
                                        onclick="duplicarRol(2)" title="Duplicar">
                                    <i class="bi bi-files"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="bg-info rounded-circle d-flex align-items-center justify-content-center me-2" 
                                     style="width: 32px; height: 32px;">
                                    <i class="bi bi-person-workspace text-white"></i>
                                </div>
                                <div>
                                    <div class="fw-bold">Administrativo Vinculación</div>
                                    <small class="text-muted">Gestión de vinculación</small>
                                </div>
                            </div>
                        </td>
                        <td>Gestión de proyectos de vinculación y actividades extracurriculares</td>
                        <td>
                            <span class="badge bg-info">4 usuarios</span>
                        </td>
                        <td>
                            <span class="badge bg-info">12 permisos</span>
                        </td>
                        <td>
                            <span class="badge bg-success">Activo</span>
                        </td>
                        <td>Hace 3 días</td>
                        <td>
                            <div class="btn-group" role="group">
                                <button type="button" class="btn btn-sm btn-outline-primary" 
                                        onclick="verRol(3)" title="Ver Detalles">
                                    <i class="bi bi-eye"></i>
                                </button>
                                <button type="button" class="btn btn-sm btn-outline-secondary" 
                                        onclick="editarRol(3)" title="Editar">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <button type="button" class="btn btn-sm btn-outline-info" 
                                        onclick="verPermisos(3)" title="Ver Permisos">
                                    <i class="bi bi-shield-check"></i>
                                </button>
                                <button type="button" class="btn btn-sm btn-outline-warning" 
                                        onclick="duplicarRol(3)" title="Duplicar">
                                    <i class="bi bi-files"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="bg-danger rounded-circle d-flex align-items-center justify-content-center me-2" 
                                     style="width: 32px; height: 32px;">
                                    <i class="bi bi-shield-fill text-white"></i>
                                </div>
                                <div>
                                    <div class="fw-bold">Super Administrador</div>
                                    <small class="text-muted">Control total del sistema</small>
                                </div>
                            </div>
                        </td>
                        <td>Acceso completo a todas las funcionalidades del sistema</td>
                        <td>
                            <span class="badge bg-danger">2 usuarios</span>
                        </td>
                        <td>
                            <span class="badge bg-danger">Todos los permisos</span>
                        </td>
                        <td>
                            <span class="badge bg-success">Activo</span>
                        </td>
                        <td>Hace 1 semana</td>
                        <td>
                            <div class="btn-group" role="group">
                                <button type="button" class="btn btn-sm btn-outline-primary" 
                                        onclick="verRol(4)" title="Ver Detalles">
                                    <i class="bi bi-eye"></i>
                                </button>
                                <button type="button" class="btn btn-sm btn-outline-secondary" 
                                        onclick="editarRol(4)" title="Editar">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <button type="button" class="btn btn-sm btn-outline-info" 
                                        onclick="verPermisos(4)" title="Ver Permisos">
                                    <i class="bi bi-shield-check"></i>
                                </button>
                                <button type="button" class="btn btn-sm btn-outline-warning" 
                                        onclick="duplicarRol(4)" title="Duplicar">
                                    <i class="bi bi-files"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Matriz de Permisos -->
<div class="row mt-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Matriz de Permisos por Rol</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm table-bordered">
                        <thead class="table-light">
                            <tr>
                                <th>Módulo/Función</th>
                                <th>Estudiante</th>
                                <th>Admin Bienestar</th>
                                <th>Admin Vinculación</th>
                                <th>Super Admin</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><strong>Fichas Socioeconómicas</strong></td>
                                <td><span class="badge bg-success">Crear/Ver</span></td>
                                <td><span class="badge bg-primary">Gestionar</span></td>
                                <td><span class="badge bg-secondary">Sin acceso</span></td>
                                <td><span class="badge bg-danger">Control Total</span></td>
                            </tr>
                            <tr>
                                <td><strong>Becas</strong></td>
                                <td><span class="badge bg-success">Solicitar</span></td>
                                <td><span class="badge bg-primary">Gestionar</span></td>
                                <td><span class="badge bg-secondary">Sin acceso</span></td>
                                <td><span class="badge bg-danger">Control Total</span></td>
                            </tr>
                            <tr>
                                <td><strong>Tickets</strong></td>
                                <td><span class="badge bg-success">Crear/Ver</span></td>
                                <td><span class="badge bg-primary">Gestionar</span></td>
                                <td><span class="badge bg-secondary">Sin acceso</span></td>
                                <td><span class="badge bg-danger">Control Total</span></td>
                            </tr>
                            <tr>
                                <td><strong>Reportes</strong></td>
                                <td><span class="badge bg-secondary">Sin acceso</span></td>
                                <td><span class="badge bg-primary">Ver/Exportar</span></td>
                                <td><span class="badge bg-secondary">Sin acceso</span></td>
                                <td><span class="badge bg-danger">Control Total</span></td>
                            </tr>
                            <tr>
                                <td><strong>Usuarios</strong></td>
                                <td><span class="badge bg-secondary">Sin acceso</span></td>
                                <td><span class="badge bg-warning">Ver</span></td>
                                <td><span class="badge bg-secondary">Sin acceso</span></td>
                                <td><span class="badge bg-danger">Control Total</span></td>
                            </tr>
                            <tr>
                                <td><strong>Configuración</strong></td>
                                <td><span class="badge bg-secondary">Sin acceso</span></td>
                                <td><span class="badge bg-warning">Ver</span></td>
                                <td><span class="badge bg-secondary">Sin acceso</span></td>
                                <td><span class="badge bg-danger">Control Total</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('modal') ?>
<!-- Modal Ver Rol -->
<div class="modal fade" id="modalVerRol" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detalles del Rol</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <h6>Información del Rol</h6>
                        <table class="table table-sm">
                            <tr><td><strong>Nombre:</strong></td><td>Administrativo Bienestar</td></tr>
                            <tr><td><strong>Descripción:</strong></td><td>Gestión completa de bienestar estudiantil</td></tr>
                            <tr><td><strong>Estado:</strong></td><td><span class="badge bg-success">Activo</span></td></tr>
                            <tr><td><strong>Usuarios Asignados:</strong></td><td>8</td></tr>
                            <tr><td><strong>Permisos:</strong></td><td>15</td></tr>
                            <tr><td><strong>Fecha Creación:</strong></td><td>15/01/2023</td></tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <h6>Permisos Asignados</h6>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" checked disabled>
                                    <label class="form-check-label">Ver Fichas</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" checked disabled>
                                    <label class="form-check-label">Editar Fichas</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" checked disabled>
                                    <label class="form-check-label">Aprobar Fichas</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" checked disabled>
                                    <label class="form-check-label">Ver Becas</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" checked disabled>
                                    <label class="form-check-label">Gestionar Becas</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" checked disabled>
                                    <label class="form-check-label">Ver Tickets</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" checked disabled>
                                    <label class="form-check-label">Responder Tickets</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" checked disabled>
                                    <label class="form-check-label">Ver Reportes</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" checked disabled>
                                    <label class="form-check-label">Exportar Datos</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" checked disabled>
                                    <label class="form-check-label">Configurar Sistema</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <hr>
                
                <h6>Usuarios con este Rol</h6>
                <div class="table-responsive">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>Usuario</th>
                                <th>Email</th>
                                <th>Estado</th>
                                <th>Última Actividad</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Ana Gómez</td>
                                <td>ana.gomez@itsi.edu.ec</td>
                                <td><span class="badge bg-success">Activo</span></td>
                                <td>Hace 2 horas</td>
                            </tr>
                            <tr>
                                <td>Carlos Rodríguez</td>
                                <td>carlos.rodriguez@itsi.edu.ec</td>
                                <td><span class="badge bg-success">Activo</span></td>
                                <td>Hace 1 hora</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" onclick="editarRolDesdeModal()">
                    <i class="bi bi-pencil"></i> Editar
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Nuevo Rol -->
<div class="modal fade" id="nuevoRolModal" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Crear Nuevo Rol</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="formNuevoRol">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Nombre del Rol</label>
                            <input type="text" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Estado</label>
                            <select class="form-select" required>
                                <option value="activo">Activo</option>
                                <option value="inactivo">Inactivo</option>
                            </select>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">Descripción</label>
                            <textarea class="form-control" rows="3" required></textarea>
                        </div>
                        
                        <div class="col-md-12">
                            <h6>Permisos del Sistema</h6>
                            <div class="row">
                                <div class="col-md-6">
                                    <h6 class="text-primary">Fichas Socioeconómicas</h6>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="permiso_ver_fichas">
                                        <label class="form-check-label" for="permiso_ver_fichas">Ver Fichas</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="permiso_editar_fichas">
                                        <label class="form-check-label" for="permiso_editar_fichas">Editar Fichas</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="permiso_aprobar_fichas">
                                        <label class="form-check-label" for="permiso_aprobar_fichas">Aprobar Fichas</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="permiso_eliminar_fichas">
                                        <label class="form-check-label" for="permiso_eliminar_fichas">Eliminar Fichas</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <h6 class="text-success">Becas</h6>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="permiso_ver_becas">
                                        <label class="form-check-label" for="permiso_ver_becas">Ver Becas</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="permiso_gestionar_becas">
                                        <label class="form-check-label" for="permiso_gestionar_becas">Gestionar Becas</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="permiso_aprobar_becas">
                                        <label class="form-check-label" for="permiso_aprobar_becas">Aprobar Becas</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="permiso_configurar_becas">
                                        <label class="form-check-label" for="permiso_configurar_becas">Configurar Becas</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <h6 class="text-warning">Tickets</h6>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="permiso_ver_tickets">
                                        <label class="form-check-label" for="permiso_ver_tickets">Ver Tickets</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="permiso_responder_tickets">
                                        <label class="form-check-label" for="permiso_responder_tickets">Responder Tickets</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="permiso_asignar_tickets">
                                        <label class="form-check-label" for="permiso_asignar_tickets">Asignar Tickets</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="permiso_cerrar_tickets">
                                        <label class="form-check-label" for="permiso_cerrar_tickets">Cerrar Tickets</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <h6 class="text-info">Reportes</h6>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="permiso_ver_reportes">
                                        <label class="form-check-label" for="permiso_ver_reportes">Ver Reportes</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="permiso_exportar_reportes">
                                        <label class="form-check-label" for="permiso_exportar_reportes">Exportar Reportes</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="permiso_configurar_reportes">
                                        <label class="form-check-label" for="permiso_configurar_reportes">Configurar Reportes</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="permiso_ver_analiticas">
                                        <label class="form-check-label" for="permiso_ver_analiticas">Ver Analíticas</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-success" onclick="crearNuevoRol()">
                    <i class="bi bi-plus-circle"></i> Crear Rol
                </button>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<script>
// Funciones JavaScript para la funcionalidad
function verRol(id) {
    $('#modalVerRol').modal('show');
}

function editarRol(id) {
    window.location.href = '<?= base_url('index.php/usuarios/roles/editar/') ?>' + id;
}

function verPermisos(id) {
    window.location.href = '<?= base_url('index.php/usuarios/roles/permisos/') ?>' + id;
}

function duplicarRol(id) {
    if (confirm('¿Desea duplicar este rol?')) {
        // Lógica para duplicar rol
        alert('Rol duplicado exitosamente');
    }
}

function exportarRoles() {
    if (confirm('¿Desea exportar la configuración de roles?')) {
        // Lógica para exportar roles
        alert('Roles exportados exitosamente');
    }
}

function crearNuevoRol() {
    if (confirm('¿Está seguro de que desea crear este nuevo rol?')) {
        $('#nuevoRolModal').modal('hide');
        alert('Nuevo rol creado exitosamente');
    }
}

function editarRolDesdeModal() {
    $('#modalVerRol').modal('hide');
    // Lógica para editar rol
    alert('Redirigiendo a edición...');
}

// Initialize tooltips
$(document).ready(function() {
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
});
</script> 