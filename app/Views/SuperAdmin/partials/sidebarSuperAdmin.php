<!-- app/Views/SuperAdmin/partials/sidebarSuperAdmin.php -->
<aside class="left-sidebar">
    <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
            <a href="<?= base_url('index.php/super-admin') ?>" class="text-nowrap logo-img">
                <img src="<?= base_url('sistema/assets/images/logos/logo2.jpg?v=2') ?>" alt="Logo" />
                <span class="ms-2 fw-bold" style="font-size: 1.3rem; color: #000;">Super Administrador<br>del Sistema<br></span>
            </a>
            <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                <i class="ti ti-x fs-8"></i>
            </div>
        </div>  
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
            <ul id="sidebarnav">
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-6"></i>
                    <span class="hide-menu">INICIO</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="<?= base_url('index.php/super-admin') ?>" aria-expanded="false">
                        <span><i class="bi bi-house-door"></i></span>
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-6"></i>
                    <span class="hide-menu">ADMINISTRACIÓN DEL SISTEMA</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="<?= base_url('index.php/super-admin/gestion-roles') ?>" aria-expanded="false">
                        <span><i class="bi bi-shield-check"></i></span>
                        <span class="hide-menu">Gestión de Roles</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="<?= base_url('index.php/super-admin/gestion-usuarios') ?>" aria-expanded="false">
                        <span><i class="bi bi-people"></i></span>
                        <span class="hide-menu">Gestión de Usuarios</span>
                    </a>
                </li>
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-6"></i>
                    <span class="hide-menu">REPORTES Y MONITOREO</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="<?= base_url('index.php/super-admin/reportes') ?>" aria-expanded="false">
                        <span><i class="bi bi-bar-chart"></i></span>
                        <span class="hide-menu">Reportes del Sistema</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="<?= base_url('index.php/super-admin/configuracion') ?>" aria-expanded="false">
                        <span><i class="bi bi-gear"></i></span>
                        <span class="hide-menu">Configuración del Sistema</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
