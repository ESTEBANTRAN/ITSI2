<!-- Sidebar -->
<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
            <a href="<?= base_url('index.php/global-admin/dashboard') ?>" class="text-nowrap logo-img">
                <img src="<?= base_url('sistema/assets/images/logos/logo2.jpg?v=2') ?>" alt="Logo" width="40" height="40" style="width:40px; height:40px; object-fit:contain;" />
                <span class="ms-2 fw-bold" style="font-size: 1.3rem; color: #000;">Super Administrador</span>
            </a>
            <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                <i class="ti ti-x fs-8"></i>
            </div>
        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar>
            <ul id="sidebarnav">
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Super Administración</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="<?= base_url('index.php/global-admin/dashboard') ?>" aria-expanded="false">
                        <span>
                            <i class="ti ti-layout-dashboard"></i>
                        </span>
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Gestión del Sistema</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="<?= base_url('index.php/global-admin/usuarios') ?>" aria-expanded="false">
                        <span>
                            <i class="ti ti-users"></i>
                        </span>
                        <span class="hide-menu">Gestión de Usuarios</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="<?= base_url('index.php/global-admin/roles') ?>" aria-expanded="false">
                        <span>
                            <i class="ti ti-shield-lock"></i>
                        </span>
                        <span class="hide-menu">Gestión de Roles</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="<?= base_url('index.php/global-admin/configuracion') ?>" aria-expanded="false">
                        <span>
                            <i class="ti ti-settings"></i>
                        </span>
                        <span class="hide-menu">Configuración del Sistema</span>
                    </a>
                </li>
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Mantenimiento</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="<?= base_url('index.php/global-admin/respaldos') ?>" aria-expanded="false">
                        <span>
                            <i class="ti ti-database-check"></i>
                        </span>
                        <span class="hide-menu">Respaldos</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="<?= base_url('index.php/global-admin/logs') ?>" aria-expanded="false">
                        <span>
                            <i class="ti ti-file-text"></i>
                        </span>
                        <span class="hide-menu">Logs del Sistema</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="<?= base_url('index.php/global-admin/estadisticas') ?>" aria-expanded="false">
                        <span>
                            <i class="ti ti-chart-bar"></i>
                        </span>
                        <span class="hide-menu">Estadísticas Globales</span>
                    </a>
                </li>
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                    <span class="hide-menu">Personal</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="<?= base_url('index.php/perfil/editar') ?>" aria-expanded="false">
                        <span>
                            <i class="ti ti-user"></i>
                        </span>
                        <span class="hide-menu">Mi Perfil</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="<?= base_url('index.php/cuenta/configuracion') ?>" aria-expanded="false">
                        <span>
                            <i class="ti ti-settings-2"></i>
                        </span>
                        <span class="hide-menu">Mi Cuenta</span>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside> 