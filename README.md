# 📚 ITSI - Sistema de Bienestar Estudiantil

## 📋 Descripción General

**ITSI** es un sistema integral de gestión de bienestar estudiantil desarrollado con **CodeIgniter 4**, diseñado para instituciones educativas. El sistema permite administrar fichas socioeconómicas, gestionar becas, procesar solicitudes de ayuda estudiantil y mantener un control completo sobre los períodos académicos.

El sistema cuenta con tres niveles de acceso:
- **Estudiantes**: Gestión de fichas socioeconómicas, solicitudes de becas y ayuda
- **Administradores de Bienestar**: Gestión de fichas, becas, períodos y usuarios
- **Super Administradores (GlobalAdmin)**: Control total del sistema, respaldos, logs y configuración

---

## 🛠️ Stack Tecnológico

### Backend
| Tecnología | Versión | Descripción |
|-----------|---------|-------------|
| **PHP** | ^8.1 | Lenguaje de programación principal |
| **CodeIgniter 4** | ^4.0 | Framework MVC para PHP |
| **MariaDB** | 10.4.32 | Sistema de gestión de base de datos |
| **TCPDF** | ^6.10 | Generación de documentos PDF |
| **PHPWord** | ^1.3 | Generación de documentos Word |

### Frontend
| Tecnología | Descripción |
|-----------|-------------|
| **Bootstrap** | Framework CSS responsive |
| **JavaScript/jQuery** | Interactividad y AJAX |
| **Chart.js** | Gráficos y estadísticas visuales |

### Servidor
| Componente | Descripción |
|-----------|-------------|
| **XAMPP** | Stack de desarrollo local |
| **Apache** | Servidor web |

---

## 📁 Estructura del Proyecto

```
ITSI/
├── app/
│   ├── Config/                    # Configuraciones del sistema
│   │   ├── App.php               # Configuración principal de la aplicación
│   │   ├── Database.php          # Configuración de base de datos
│   │   ├── Routes.php            # Definición de todas las rutas
│   │   ├── Filters.php           # Configuración de filtros (autenticación)
│   │   ├── PlantillasPDF.php     # Configuración de plantillas PDF
│   │   └── ...
│   │
│   ├── Controllers/               # Controladores principales
│   │   ├── AuthController.php            # Autenticación y login
│   │   ├── AdminBienestarController.php  # Panel de Admin Bienestar (~4290 líneas)
│   │   ├── EstudianteController.php      # Panel de estudiantes (~1911 líneas)
│   │   ├── DashboardController.php       # Dashboard general
│   │   ├── PerfilController.php          # Gestión de perfil de usuario
│   │   ├── CuentaController.php          # Configuración de cuenta
│   │   ├── PlantillasController.php      # Gestión de plantillas PDF/Word
│   │   ├── GlobalAdmin/                  # Controladores del Super Admin
│   │   │   └── GlobalAdminController.php # Panel Super Admin (~2303 líneas)
│   │   └── ...
│   │
│   ├── Models/                    # Modelos de datos
│   │   ├── UsuarioModel.php              # Gestión de usuarios
│   │   ├── BecaModel.php                 # Gestión de becas
│   │   ├── SolicitudBecaModel.php        # Solicitudes de becas
│   │   ├── FichaSocioeconomicaModel.php  # Fichas socioeconómicas
│   │   ├── PeriodoAcademicoModel.php     # Períodos académicos
│   │   ├── SolicitudAyudaModel.php       # Solicitudes de ayuda
│   │   ├── NotificacionBecaModel.php     # Notificaciones de becas
│   │   ├── CarreraModel.php              # Carreras académicas
│   │   ├── RolModel.php                  # Roles de usuario
│   │   ├── GlobalAdmin/                  # Modelos del Super Admin
│   │   │   ├── UsuarioGlobalModel.php
│   │   │   ├── RolModel.php
│   │   │   ├── SistemaModel.php
│   │   │   └── BackupModel.php
│   │   └── ...
│   │
│   ├── Services/                  # Servicios de lógica de negocio
│   │   ├── AdminBienestarService.php     # Servicios para Admin Bienestar
│   │   ├── EstudianteBecasService.php    # Servicios de becas para estudiantes
│   │   ├── PlantillaPDFService.php       # Generación de PDFs
│   │   └── PlantillaWordService.php      # Generación de documentos Word
│   │
│   ├── Filters/                   # Filtros de peticiones
│   │   └── AuthFilter.php                # Filtro de autenticación
│   │
│   ├── Views/                     # Vistas del sistema
│   │   ├── layouts/                      # Layouts principales
│   │   │   ├── mainAdmin.php            # Layout Admin Bienestar
│   │   │   ├── mainEstudiante.php       # Layout Estudiante  
│   │   │   ├── mainGlobalAdmin.php      # Layout Super Admin
│   │   │   └── mainSuperAdmin.php       # Layout Super Admin alternativo
│   │   ├── AdminBienestar/              # Vistas del Admin (33 archivos)
│   │   │   ├── dashboard.php
│   │   │   ├── fichas_socioeconomicas.php
│   │   │   ├── becas.php
│   │   │   ├── solicitudes_becas.php
│   │   │   ├── usuarios.php
│   │   │   ├── gestion_periodos.php
│   │   │   ├── configuracion_becas.php
│   │   │   ├── reportes.php
│   │   │   └── ...
│   │   ├── estudiante/                  # Vistas del estudiante (19 archivos)
│   │   │   ├── becas.php
│   │   │   ├── ficha_socioeconomica.php
│   │   │   ├── solicitudes_ayuda.php
│   │   │   ├── documentos.php
│   │   │   ├── perfil.php
│   │   │   └── ...
│   │   ├── GlobalAdmin/                 # Vistas del Super Admin (12 archivos)
│   │   │   ├── dashboard.php
│   │   │   ├── gestion_usuarios.php
│   │   │   ├── gestion_roles.php
│   │   │   ├── respaldos.php
│   │   │   ├── logs.php
│   │   │   └── ...
│   │   ├── auth/                        # Vistas de autenticación
│   │   │   └── login.php
│   │   └── ...
│   │
│   └── Helpers/                   # Funciones auxiliares
│
├── public/                        # Archivos públicos
│   ├── index.php                 # Punto de entrada
│   ├── login/                    # Assets del login
│   ├── sistema/                  # Assets del sistema (CSS, JS, imágenes)
│   └── uploads/                  # Archivos subidos por usuarios
│
├── writable/                      # Archivos escribibles
│   ├── cache/
│   ├── logs/
│   └── session/
│
├── bienestar_estudiantil_db.sql  # Dump completo de la base de datos
├── composer.json                  # Dependencias PHP
└── README.md                      # Esta documentación
```

---

## 🗄️ Base de Datos

### Información General
- **Nombre**: `bienestar_estudiantil_db`
- **Motor**: MariaDB 10.4.32
- **Charset**: utf8mb4

### Diagrama de Tablas Principales

```
┌─────────────────────┐     ┌─────────────────────┐
│      usuarios       │     │        roles        │
├─────────────────────┤     ├─────────────────────┤
│ id (PK)             │────▶│ id (PK)             │
│ rol_id (FK)         │     │ nombre              │
│ carrera_id (FK)     │     │ descripcion         │
│ nombre              │     │ permisos (JSON)     │
│ apellido            │     │ estado              │
│ cedula (UNIQUE)     │     └─────────────────────┘
│ email (UNIQUE)      │
│ password_hash       │     ┌─────────────────────┐
│ telefono            │     │      carreras       │
│ direccion           │     ├─────────────────────┤
│ carrera             │────▶│ id (PK)             │
│ semestre            │     │ nombre              │
│ foto_perfil         │     │ codigo (UNIQUE)     │
│ estado              │     │ semestres           │
│ ultimo_acceso       │     │ activa              │
│ intentos_fallidos   │     └─────────────────────┘
│ bloqueado_hasta     │
└─────────────────────┘
         │
         │ 1:N
         ▼
┌────────────────────────────┐     ┌────────────────────────┐
│  fichas_socioeconomicas    │     │   periodos_academicos  │
├────────────────────────────┤     ├────────────────────────┤
│ id (PK)                    │     │ id (PK)                │
│ estudiante_id (FK)         │────▶│ nombre                 │
│ periodo_id (FK)            │     │ estado                 │
│ json_data (JSON)           │     │ fecha_inicio           │
│ estado                     │     │ fecha_fin              │
│ revisada_por_admin         │     │ activo_fichas          │
│ fecha_revision_admin       │     │ activo_becas           │
│ observaciones_admin        │     │ limite_fichas          │
│ puntaje_calculado          │     │ limite_becas           │
│ relacionada_beca           │     │ vigente_estudiantes    │
└────────────────────────────┘     └────────────────────────┘
         │
         │ M:N (a través de solicitudes)
         ▼
┌────────────────────────────┐     ┌────────────────────────┐
│        becas               │     │   solicitudes_becas    │
├────────────────────────────┤     ├────────────────────────┤
│ id (PK)                    │◀────│ id (PK)                │
│ nombre                     │     │ estudiante_id (FK)     │
│ descripcion                │     │ beca_id (FK)           │
│ requisitos                 │     │ periodo_id (FK)        │
│ puntaje_minimo_requerido   │     │ estado                 │
│ activa                     │     │ observaciones          │
│ tipo_beca                  │     │ fecha_solicitud        │
│ monto_beca                 │     │ fecha_revision         │
│ cupos_disponibles          │     │ revisado_por           │
│ estado                     │     │ motivo_rechazo         │
│ periodo_vigente_id (FK)    │     │ documentos_revisados   │
│ documentos_requisitos      │     │ porcentaje_avance      │
└────────────────────────────┘     └────────────────────────┘
```

### Descripción de Tablas

#### Tablas Principales

| Tabla | Descripción | Registros |
|-------|-------------|-----------|
| `usuarios` | Almacena todos los usuarios del sistema (estudiantes, admins) | ~72 |
| `roles` | Roles del sistema con permisos | 4 |
| `carreras` | Carreras académicas disponibles | 11 |
| `periodos_academicos` | Períodos académicos para fichas y becas | ~11 |
| `fichas_socioeconomicas` | Fichas socioeconómicas de estudiantes | ~32 |
| `becas` | Catálogo de becas disponibles | ~29 |
| `solicitudes_becas` | Solicitudes de becas realizadas | ~41 |
| `solicitudes_ayuda` | Solicitudes de ayuda estudiantil | ~27 |

#### Tablas de Soporte

| Tabla | Descripción |
|-------|-------------|
| `becas_documentos_requisitos` | Documentos requeridos por cada beca |
| `documentos_solicitud_becas` | Documentos subidos para solicitudes de beca |
| `estudiantes_habilitacion_becas` | Estado de habilitación para solicitar becas |
| `historial_estados_becas` | Historial de cambios de estado en solicitudes |
| `notificaciones_becas` | Notificaciones relacionadas con becas |
| `observaciones_fichas` | Observaciones administrativas en fichas |
| `flujo_aprobacion_documentos` | Tracking del flujo de aprobación |
| `categorias_solicitud_ayuda` | Categorías para solicitudes de ayuda |
| `respuestas_solicitudes_ayuda` | Respuestas a solicitudes de ayuda |
| `respuestas_predefinidas` | Plantillas de respuestas rápidas |
| `citas` | Citas programadas con estudiantes |
| `pdf_codigos_verificacion` | Códigos QR para verificación de PDFs |
| `logs` | Logs de actividad del sistema |
| `competencias` | Catálogo de competencias (HR) |
| `categorias_evaluacion` | Categorías de evaluación (HR) |

#### Vistas (Views)

| Vista | Descripción |
|-------|-------------|
| `v_becas_completas` | Becas con estadísticas de solicitudes |
| `v_dashboard_admin_bienestar` | Datos para dashboard administrativo |
| `v_estadisticas_sistema` | Estadísticas globales del sistema |
| `v_fichas_admin` | Fichas con datos de estudiante y período |
| `v_fichas_socioeconomicas_completa` | Fichas con información completa |
| `v_solicitudes_becas_completas` | Solicitudes con datos detallados |
| `v_solicitudes_becas_detallada` | Vista detallada de solicitudes |

#### Triggers

| Trigger | Tabla | Descripción |
|---------|-------|-------------|
| `tr_ficha_completada_habilitar_becas` | `fichas_socioeconomicas` | Habilita solicitud de becas al aprobar ficha |
| `validar_comentario_rechazo` | `fichas_socioeconomicas` | Obliga comentario al rechazar ficha |
| `tr_actualizar_documentos_revisados` | `documentos_solicitud_becas` | Actualiza contadores al aprobar documentos |
| `actualizar_porcentaje_avance_beca` | `solicitudes_becas_documentos` | Calcula avance de verificación |

### Estados del Sistema

#### Estados de Fichas Socioeconómicas
| Estado | Descripción |
|--------|-------------|
| `Borrador` | Ficha en edición, no enviada |
| `Enviada` | Ficha enviada, pendiente de revisión |
| `Revisada` | Ficha revisada, pendiente de decisión |
| `Aprobada` | Ficha aprobada por administrador |
| `Rechazada` | Ficha rechazada (requiere correcciones) |

#### Estados de Solicitudes de Beca
| Estado | Descripción |
|--------|-------------|
| `Postulada` | Solicitud enviada, pendiente de revisión |
| `En Revisión` | Documentos siendo verificados |
| `Aprobada` | Beca otorgada al estudiante |
| `Rechazada` | Solicitud rechazada |
| `Lista de Espera` | En espera de cupos disponibles |

#### Estados de Solicitudes de Ayuda
| Estado | Descripción |
|--------|-------------|
| `Pendiente` | Solicitud nueva sin atender |
| `En Proceso` | Siendo atendida por administrador |
| `Resuelta` | Problema resuelto |
| `Cerrada` | Solicitud cerrada |

---

## 👥 Sistema de Roles

### Roles Definidos

| ID | Rol | Descripción | Acceso |
|----|-----|-------------|--------|
| 1 | Estudiante | Usuario estudiantil | `/estudiante/*` |
| 2 | Admin Bienestar | Administrador del área | `/admin-bienestar/*` |
| 3 | Docente | Usuario docente (limitado) | - |
| 4 | Super Admin | Administrador global | `/global-admin/*` |

### Permisos por Rol

#### Estudiante (rol_id = 1)
- ✅ Crear y editar fichas socioeconómicas
- ✅ Solicitar becas disponibles
- ✅ Crear solicitudes de ayuda
- ✅ Subir documentos
- ✅ Ver estado de solicitudes
- ✅ Descargar PDFs de fichas
- ✅ Gestionar perfil y cuenta

#### Admin Bienestar (rol_id = 2)
- ✅ Revisar fichas socioeconómicas
- ✅ Aprobar/Rechazar fichas
- ✅ Gestionar becas (CRUD)
- ✅ Revisar solicitudes de becas
- ✅ Aprobar/Rechazar documentos
- ✅ Gestionar períodos académicos
- ✅ Atender solicitudes de ayuda
- ✅ Generar reportes
- ✅ Exportar datos (PDF/CSV)
- ✅ Gestionar usuarios (limitado)

#### Super Admin (rol_id = 4)
- ✅ Todos los permisos anteriores
- ✅ Gestión completa de usuarios
- ✅ Gestión de roles y permisos
- ✅ Configuración del sistema
- ✅ Respaldos de base de datos
- ✅ Logs del sistema
- ✅ Estadísticas globales
- ✅ Acceso a todas las vistas

---

## 🚀 Módulos del Sistema

### 1. Módulo de Autenticación

**Controlador**: `AuthController.php`

Funcionalidades:
- Login con cédula o email
- Validación de credenciales
- Gestión de sesiones
- Bloqueo por intentos fallidos (5 intentos = 30 min bloqueo)
- Redirección según rol

```php
// Flujo de autenticación
1. Usuario ingresa credenciales
2. Se busca por cédula o email
3. Se verifica password con bcrypt
4. Se crea sesión con datos del usuario
5. Se redirige según rol_id
```

### 2. Módulo de Fichas Socioeconómicas

**Controladores**: 
- `EstudianteController.php` (crear/editar)
- `AdminBienestarController.php` (revisar/aprobar)

**Modelo**: `FichaSocioeconomicaModel.php`

Características:
- Formulario dinámico con múltiples secciones
- Almacenamiento en JSON flexible
- Estados de flujo de trabajo
- Trigger automático para habilitar becas
- Exportación a PDF con código QR de verificación
- Una ficha por estudiante por período

Secciones de la ficha:
1. Datos personales del estudiante
2. Información de vivienda
3. Situación económica familiar
4. Composición familiar
5. Información de salud
6. Comentarios adicionales

### 3. Módulo de Becas

**Controlador**: `AdminBienestarController.php` (gestión)
**Controlador**: `EstudianteController.php` (solicitud)
**Servicio**: `EstudianteBecasService.php`

**Modelos**:
- `BecaModel.php`
- `SolicitudBecaModel.php`
- `SolicitudBecaDocumentoModel.php`
- `BecaDocumentoRequisitoModel.php`

Tipos de becas:
- Académica
- Económica
- Deportiva
- Cultural
- Investigación
- Otros

Flujo de solicitud:
```
1. Estudiante tiene ficha aprobada
2. Estudiante selecciona beca disponible
3. Sistema verifica elegibilidad y cupos
4. Se crean registros de documentos requeridos
5. Estudiante sube documentos
6. Admin revisa documentos uno por uno
7. Admin aprueba/rechaza solicitud
8. Sistema envía notificación
```

### 4. Módulo de Solicitudes de Ayuda

**Controladores**:
- `EstudianteController.php` (crear)
- `AdminBienestarController.php` (gestionar)

**Modelos**:
- `SolicitudAyudaModel.php`
- `CategoriaSolicitudAyudaModel.php`
- `RespuestaSolicitudModel.php`

Categorías:
- Académicas
- Económicas
- Salud
- Vivienda
- Sociales
- Técnicas
- Otro Asunto

Niveles de prioridad:
- Baja (verde)
- Media (amarillo)
- Alta (naranja)
- Urgente (rojo)

### 5. Módulo de Períodos Académicos

**Controlador**: `AdminBienestarController.php`
**Modelo**: `PeriodoAcademicoModel.php`

Características:
- Definición de fechas de inicio/fin
- Límites de fichas y becas por período
- Activación/desactivación independiente para fichas y becas
- Visibilidad para estudiantes configurable
- Estadísticas por período

### 6. Módulo de Reportes

**Controlador**: `AdminBienestarController.php`
**Servicio**: `AdminBienestarService.php`

Reportes disponibles:
- Estadísticas generales del sistema
- Fichas por estado y período
- Solicitudes de becas por estado
- Becas por tipo y cupos
- Usuarios por rol

Formatos de exportación:
- PDF (TCPDF)
- Excel/CSV
- Word (PHPWord)

### 7. Módulo de Super Administrador (GlobalAdmin)

**Controlador**: `GlobalAdmin/GlobalAdminController.php`

**Modelos**:
- `GlobalAdmin/UsuarioGlobalModel.php`
- `GlobalAdmin/RolModel.php`
- `GlobalAdmin/SistemaModel.php`
- `GlobalAdmin/BackupModel.php`

Funcionalidades:
- Dashboard global con métricas KPI
- Gestión completa de usuarios (CRUD)
- Gestión de roles y permisos
- Sistema de respaldos de BD
- Visor de logs del sistema
- Estadísticas avanzadas
- Configuración del sistema

---

## 🔐 Seguridad

### Autenticación
- Contraseñas hasheadas con bcrypt (`password_hash`)
- Bloqueo temporal por intentos fallidos
- Sesiones manejadas por CodeIgniter

### Autorización
- Filtro de autenticación (`AuthFilter.php`)
- Verificación de rol en cada controlador
- Rutas protegidas por grupos

### Validación
- Validación de entrada en modelos
- Reglas de validación personalizadas
- Sanitización de datos

### Protección de Documentos
- Códigos QR de verificación en PDFs
- Registro de generación de documentos
- Verificación de autenticidad

---

## 📡 API de Rutas Principales

### Rutas Públicas
```
GET  /                          # Página de login
GET  /login                     # Página de login
POST /auth/attemptLogin         # Procesar login
GET  /auth/logout               # Cerrar sesión
```

### Rutas de Estudiante
```
GET  /estudiante                        # Dashboard estudiante
GET  /estudiante/ficha-socioeconomica   # Gestión de fichas
POST /estudiante/crear-ficha            # Crear nueva ficha
POST /estudiante/enviar-ficha           # Enviar ficha para revisión
GET  /estudiante/ver-ficha/:id          # Ver ficha específica
GET  /estudiante/exportar-ficha-pdf/:id # Descargar PDF

GET  /estudiante/becas                  # Ver becas disponibles
POST /estudiante/solicitar-beca         # Solicitar una beca
GET  /estudiante/documentos-beca/:id    # Gestionar documentos

GET  /estudiante/solicitudes-ayuda      # Ver solicitudes de ayuda
POST /estudiante/crear-solicitud-ayuda  # Crear solicitud

GET  /estudiante/perfil                 # Ver perfil
POST /estudiante/actualizar-perfil      # Actualizar perfil
POST /estudiante/cambiar-password       # Cambiar contraseña
```

### Rutas de Admin Bienestar
```
GET  /admin-bienestar/dashboard                  # Dashboard administrativo
GET  /admin-bienestar/fichas-socioeconomicas     # Listar fichas
POST /admin-bienestar/aprobar-ficha/:id          # Aprobar ficha
POST /admin-bienestar/rechazar-ficha/:id         # Rechazar ficha

GET  /admin-bienestar/becas                      # Listar becas
POST /admin-bienestar/crear-beca                 # Crear beca
POST /admin-bienestar/actualizar-beca            # Actualizar beca
POST /admin-bienestar/eliminar-beca              # Eliminar beca

GET  /admin-bienestar/solicitudes-becas          # Listar solicitudes
GET  /admin-bienestar/revision-documentos/:id    # Revisar documentos
POST /admin-bienestar/aprobar-solicitud-beca     # Aprobar solicitud
POST /admin-bienestar/rechazar-solicitud-beca    # Rechazar solicitud

GET  /admin-bienestar/gestion-periodos           # Gestionar períodos
POST /admin-bienestar/crear-periodo              # Crear período
POST /admin-bienestar/actualizar-periodo         # Actualizar período

GET  /admin-bienestar/solicitudes-ayuda          # Listar solicitudes
POST /admin-bienestar/responder-solicitud-ayuda  # Responder solicitud

GET  /admin-bienestar/usuarios                   # Listar usuarios
GET  /admin-bienestar/reportes                   # Generar reportes
```

### Rutas de Super Admin
```
GET  /global-admin/dashboard                # Dashboard global
GET  /global-admin/usuarios                 # Gestión de usuarios
POST /global-admin/crear-usuario            # Crear usuario
POST /global-admin/actualizar-usuario       # Actualizar usuario
POST /global-admin/eliminar-usuario         # Eliminar usuario

GET  /global-admin/roles                    # Gestión de roles
POST /global-admin/crear-rol                # Crear rol
POST /global-admin/actualizar-rol           # Actualizar rol

GET  /global-admin/respaldos                # Gestión de respaldos
POST /global-admin/crear-respaldo           # Crear respaldo BD
GET  /global-admin/descargar-respaldo/:id   # Descargar respaldo
POST /global-admin/restaurar-respaldo       # Restaurar respaldo

GET  /global-admin/logs                     # Ver logs del sistema
GET  /global-admin/estadisticas             # Estadísticas globales
GET  /global-admin/configuracion            # Configuración del sistema
```

---

## ⚙️ Instalación y Configuración

### Requisitos Previos
- PHP 8.1 o superior
- MariaDB/MySQL 10.4+
- Composer
- XAMPP o servidor Apache equivalente

### Pasos de Instalación

1. **Clonar/Copiar el proyecto**
   ```bash
   cd C:\xampp\htdocs
   # Copiar la carpeta ITSI
   ```

2. **Instalar dependencias**
   ```bash
   cd ITSI
   composer install
   ```

3. **Crear base de datos**
   ```sql
   CREATE DATABASE bienestar_estudiantil_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
   ```

4. **Importar estructura y datos**
   ```bash
   mysql -u root bienestar_estudiantil_db < bienestar_estudiantil_db.sql
   ```

5. **Configurar base de datos**
   Editar `app/Config/Database.php`:
   ```php
   public array $default = [
       'hostname' => 'localhost',
       'username' => 'root',
       'password' => '',
       'database' => 'bienestar_estudiantil_db',
       'DBDriver' => 'MySQLi',
       'charset'  => 'utf8mb4',
   ];
   ```

6. **Configurar URL base**
   Editar `app/Config/App.php`:
   ```php
   public string $baseURL = 'http://localhost/ITSI/public/';
   ```

7. **Permisos de escritura**
   ```bash
   chmod -R 755 writable/
   ```

8. **Acceder al sistema**
   ```
   http://localhost/ITSI/public/
   ```

### Usuarios de Prueba

| Rol | Email/Cédula | Contraseña |
|-----|--------------|------------|
| Admin Bienestar | test@mail.com | admin123 |
| Estudiante | estudiante@testmail.com | estudiante123 |
| Super Admin | superadmin@gmail.com | superadmin123 |

---

## 📊 Dashboards

### Dashboard Estudiante
- Resumen de fichas socioeconómicas
- Estado de solicitudes de beca
- Solicitudes de ayuda activas
- Accesos directos a servicios
- Notificaciones recientes

### Dashboard Admin Bienestar
- Estadísticas de fichas por estado
- Solicitudes pendientes de revisión
- Becas activas y cupos disponibles
- Gráficos de tendencias
- Alertas del sistema

### Dashboard Super Admin
- KPIs globales del sistema
- Usuarios por rol
- Actividad reciente
- Estado de respaldos
- Métricas de rendimiento
- Gráficos interactivos (Chart.js)

---

## 🔧 Mantenimiento

### Respaldos
- Respaldos automáticos configurables
- Respaldos manuales desde panel
- Descarga de archivos SQL
- Restauración desde panel

### Logs
- Registro de acciones críticas
- Filtrado por fecha/tipo/usuario
- Exportación de logs
- Limpieza automática

### Monitoreo
- Estadísticas en tiempo real
- Métricas de uso
- Alertas por límites

---

## 📝 Notas de Desarrollo

### Convenciones de Código
- Nombres de clases: PascalCase
- Nombres de métodos: camelCase
- Nombres de tablas: snake_case
- Variables: camelCase

### Estructura de Vistas
- Layouts base en `/Views/layouts/`
- Vistas específicas en carpetas por módulo
- Parciales en subcarpetas `/partials/`

### Servicios
- Lógica de negocio compleja en `/Services/`
- Reutilización entre controladores
- Transacciones de base de datos

---

## 🐛 Troubleshooting

### Problema: Error 500 al cargar
**Solución**: Verificar permisos de `writable/` y revisar logs en `writable/logs/`

### Problema: Login no funciona
**Solución**: Verificar conexión a BD y que la tabla `usuarios` tenga datos

### Problema: PDFs no se generan
**Solución**: Verificar instalación de TCPDF (`composer require tecnickcom/tcpdf`)

### Problema: Sesión se pierde
**Solución**: Verificar configuración de sesiones en `app/Config/Session.php`

---

## 📞 Contacto y Soporte

Este sistema fue desarrollado para gestión de bienestar estudiantil institucional.

**Versión**: 1.0.0
**Última actualización**: 2025-08-21
**Framework**: CodeIgniter 4
**Base de datos**: MariaDB 10.4.32

---

## 📜 Licencia

MIT License - Ver archivo `LICENSE` para más detalles.
