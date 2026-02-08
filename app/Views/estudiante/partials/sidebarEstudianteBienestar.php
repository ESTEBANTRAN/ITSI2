<!-- app/Views/estudiante/partials/sidebarEstudianteBienestar.php -->
<aside class="left-sidebar">
    <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
            <a href="<?= base_url('estudiante-bienestar') ?>" class="text-nowrap logo-img">
                <img src="<?= base_url('sistema/assets/images/logos/logo2.jpg?v=2') ?>" alt="Logo" />
                <span class="ms-2 fw-bold" style="font-size: 1.3rem; color: #000;">Estudiante de <br>Bienestar Institucional <br></span>
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
                    <a class="sidebar-link" href="<?= base_url('index.php/estudiante-bienestar') ?>" aria-expanded="false">
                        <span><i class="bi bi-house-door"></i></span>
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-6"></i>
                    <span class="hide-menu">GESTIÓN ESTUDIANTIL</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="<?= base_url('index.php/estudiante-bienestar/fichas') ?>" aria-expanded="false">
                        <span><i class="bi bi-file-earmark-text"></i></span>
                        <span class="hide-menu">Formularios Socioeconómicos</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="<?= base_url('index.php/estudiante-bienestar/solicitudes-becas') ?>" aria-expanded="false">
                        <span><i class="bi bi-award"></i></span>
                        <span class="hide-menu">Solicitudes de Becas</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="<?= base_url('index.php/estudiante-bienestar/perfil') ?>" aria-expanded="false">
                        <span><i class="bi bi-person-circle"></i></span>
                        <span class="hide-menu">Mi Perfil</span>
                    </a>
                </li>
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-6"></i>
                    <span class="hide-menu">SOLICITUDES</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="<?= base_url('index.php/estudiante-bienestar/solicitudes-ayuda') ?>" aria-expanded="false">
                        <span><i class="bi bi-chat-square-dots"></i></span>
                        <span class="hide-menu">Solicitudes de Ayuda</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="<?= base_url('index.php/estudiante-bienestar/documentos') ?>" aria-expanded="false">
                        <span><i class="bi bi-file-earmark-pdf"></i></span>
                        <span class="hide-menu">Mis Documentos</span>
                    </a>
                </li>
                <li class="nav-small-cap">
                    <i class="ti ti-dots nav-small-cap-icon fs-6"></i>
                    <span class="hide-menu">INFORMACIÓN</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="<?= base_url('index.php/estudiante-bienestar/informacion') ?>" aria-expanded="false">
                        <span><i class="bi bi-info-circle"></i></span>
                        <span class="hide-menu">Información del Perfil</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="<?= base_url('index.php/estudiante-bienestar/ayuda') ?>" aria-expanded="false">
                        <span><i class="bi bi-question-circle"></i></span>
                        <span class="hide-menu">Centro de Ayuda</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside> 