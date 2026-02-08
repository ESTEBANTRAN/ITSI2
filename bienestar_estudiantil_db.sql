-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-08-2025 a las 16:31:46
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bienestar_estudiantil_db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `becas`
--

CREATE TABLE `becas` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `requisitos` text DEFAULT NULL COMMENT 'Descripción de los requisitos generales',
  `puntaje_minimo_requerido` decimal(5,2) DEFAULT NULL COMMENT 'Ejemplo de requisito verificable por el sistema',
  `activa` tinyint(1) DEFAULT 1,
  `nombre_beca` varchar(255) GENERATED ALWAYS AS (`nombre`) STORED,
  `documentos_requisitos` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL COMMENT 'Lista de documentos requeridos para la beca' CHECK (json_valid(`documentos_requisitos`)),
  `periodo_vigente_id` int(10) UNSIGNED DEFAULT NULL COMMENT 'ID del per??odo acad??mico vigente para la beca',
  `fecha_inicio_vigencia` date DEFAULT NULL COMMENT 'Fecha de inicio de vigencia de la beca',
  `fecha_fin_vigencia` date DEFAULT NULL COMMENT 'Fecha de fin de vigencia de la beca',
  `monto_beca` decimal(10,2) DEFAULT NULL COMMENT 'Monto de la beca',
  `tipo_beca` enum('AcadÚmica','Econ¾mica','Deportiva','Cultural','Investigaci¾n','Otros') NOT NULL DEFAULT 'AcadÚmica' COMMENT 'Tipo de beca',
  `cupos_disponibles` int(10) UNSIGNED DEFAULT NULL COMMENT 'N??mero de cupos disponibles',
  `estado` enum('Activa','Inactiva','Cerrada') NOT NULL DEFAULT 'Activa' COMMENT 'Estado de la beca',
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'Fecha de creaci??n de la beca',
  `creado_por` int(10) UNSIGNED DEFAULT NULL COMMENT 'ID del administrador que cre?? la beca',
  `fecha_actualizacion` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `actualizado_por` int(10) UNSIGNED DEFAULT NULL,
  `prioridad` int(10) UNSIGNED NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `becas`
--

INSERT INTO `becas` (`id`, `nombre`, `descripcion`, `requisitos`, `puntaje_minimo_requerido`, `activa`, `documentos_requisitos`, `periodo_vigente_id`, `fecha_inicio_vigencia`, `fecha_fin_vigencia`, `monto_beca`, `tipo_beca`, `cupos_disponibles`, `estado`, `fecha_creacion`, `creado_por`, `fecha_actualizacion`, `actualizado_por`, `prioridad`) VALUES
(1, 'Beca Excelencia Académica', 'Beca para estudiantes con excelente rendimiento académico', 'Promedio mínimo de 9.0, sin materias reprobadas', 9.00, 1, NULL, NULL, NULL, NULL, NULL, '', NULL, 'Activa', '2025-08-14 02:07:43', NULL, '2025-08-20 23:15:34', NULL, 1),
(2, 'Beca Socioeconómica', 'Beca para estudiantes con necesidades económicas', 'Ficha socioeconómica aprobada, promedio mínimo de 7.5', 7.50, 1, NULL, NULL, NULL, NULL, NULL, '', NULL, 'Activa', '2025-08-14 02:07:43', NULL, '2025-08-20 23:15:34', NULL, 1),
(3, 'Beca Deportiva', 'Beca para deportistas destacados', 'Participación activa en equipos deportivos, promedio mínimo de 7.0', 7.00, 1, NULL, NULL, NULL, NULL, NULL, '', NULL, 'Activa', '2025-08-14 02:07:43', NULL, '2025-08-20 23:15:34', NULL, 1),
(4, 'Beca Cultural', 'Beca para estudiantes con talentos culturales', 'Participación en actividades culturales, promedio mínimo de 7.0', 7.00, 1, NULL, NULL, NULL, NULL, NULL, '', NULL, 'Activa', '2025-08-14 02:07:43', NULL, '2025-08-20 23:15:34', NULL, 1),
(5, 'Beca Excelencia Acad??mica', 'Beca para estudiantes con promedio superior a 8.5', NULL, NULL, 1, NULL, 2, '2025-01-01', '2025-12-31', 500.00, '', 20, 'Activa', '2025-08-14 02:07:44', 8, '2025-08-20 23:15:34', NULL, 1),
(6, 'Beca Apoyo Econ??mico', 'Beca para estudiantes en situaci??n econ??mica vulnerable', NULL, NULL, 1, NULL, 2, '2025-01-01', '2025-12-31', 300.00, '', 50, 'Activa', '2025-08-14 02:07:44', 8, '2025-08-20 23:15:39', 7, 1),
(7, 'Beca Deportiva', 'Beca para estudiantes destacados en deportes', NULL, NULL, 1, NULL, 2, '2025-01-01', '2025-12-31', 200.00, 'Deportiva', 15, 'Activa', '2025-08-14 02:07:44', 8, NULL, NULL, 1),
(15, 'Beca Excelencia Acad??mica', 'Beca para estudiantes con excelente rendimiento acad??mico', 'Promedio m??nimo 8.5, sin materias reprobadas', NULL, 1, NULL, NULL, NULL, NULL, 800.00, '', NULL, 'Activa', '2025-08-14 03:42:43', 7, '2025-08-20 23:15:34', NULL, 1),
(16, 'Beca Socioecon??mica', 'Beca para estudiantes con necesidades econ??micas', 'Ficha socioecon??mica aprobada, ingresos familiares bajos', NULL, 1, NULL, NULL, NULL, NULL, 600.00, '', NULL, 'Activa', '2025-08-14 03:42:43', 7, '2025-08-20 23:15:39', NULL, 1),
(17, 'Beca Deportiva', 'Beca para deportistas destacados', 'Representaci??n deportiva institucional, promedio m??nimo 7.0', NULL, 1, NULL, NULL, NULL, NULL, 400.00, 'Deportiva', NULL, 'Activa', '2025-08-14 03:42:43', 7, NULL, NULL, 1),
(18, 'Beca Cultural', 'Beca para estudiantes con talento cultural', 'Participaci??n en actividades culturales, promedio m??nimo 7.5', NULL, 1, NULL, NULL, NULL, NULL, 350.00, 'Cultural', 6, 'Activa', '2025-08-14 03:42:43', 7, NULL, NULL, 1),
(20, 'Beca Investigaci??n', 'Beca para proyectos de investigaci??n', 'Proyecto de investigaci??n aprobado, promedio m??nimo 8.0', NULL, 1, NULL, NULL, NULL, NULL, 700.00, '', NULL, 'Activa', '2025-08-14 03:42:43', 7, '2025-08-20 23:15:43', NULL, 1),
(21, 'Beca Liderazgo', 'Beca para l??deres estudiantiles', 'Cargo en organizaci??n estudiantil, promedio m??nimo 7.5', NULL, 1, NULL, NULL, NULL, NULL, 450.00, 'Otros', NULL, 'Activa', '2025-08-14 03:42:43', 7, NULL, NULL, 1),
(22, 'Beca Excelencia Acad??mica', 'Beca para estudiantes con excelente rendimiento acad??mico', 'Promedio m??nimo 8.5, sin materias reprobadas', NULL, 1, NULL, NULL, NULL, NULL, 800.00, '', NULL, 'Activa', '2025-08-14 03:43:28', 7, '2025-08-20 23:15:34', NULL, 1),
(23, 'Beca Socioecon??mica', 'Beca para estudiantes con necesidades econ??micas', 'Ficha socioecon??mica aprobada, ingresos familiares bajos', NULL, 1, NULL, NULL, NULL, NULL, 600.00, '', NULL, '', '2025-08-14 03:43:28', 7, '2025-08-20 23:15:39', NULL, 1),
(24, 'Beca Deportiva', 'Beca para deportistas destacados', 'Representaci??n deportiva institucional, promedio m??nimo 7.0', NULL, 1, NULL, NULL, NULL, NULL, 400.00, 'Deportiva', NULL, 'Activa', '2025-08-14 03:43:28', 7, NULL, NULL, 1),
(25, 'Beca Cultural', 'Beca para estudiantes con talento cultural', 'Participaci??n en actividades culturales, promedio m??nimo 7.5', NULL, 1, NULL, NULL, NULL, NULL, 350.00, 'Cultural', NULL, 'Activa', '2025-08-14 03:43:28', 7, NULL, NULL, 1),
(26, 'Beca Investigaci??n', 'Beca para proyectos de investigaci??n', 'Proyecto de investigaci??n aprobado, promedio m??nimo 8.0', NULL, 1, NULL, NULL, NULL, NULL, 700.00, '', NULL, 'Activa', '2025-08-14 03:43:28', 7, '2025-08-20 23:15:43', NULL, 1),
(27, 'beca por iq', 'sadasdsada', 'documento de identidad, documento de no ruc, documento de no automovil', 10.00, 1, '[\"no posesi\\u00f3n vehicular\",\"certificado de nacimiento\",\"lololo\"]', 5, NULL, NULL, 2000.00, 'Otros', 1000, 'Activa', '2025-08-21 03:53:16', 7, '2025-08-21 05:05:18', 7, 1),
(28, 'Beca Excelencia Acad├®mica 2024-2', 'Beca para estudiantes con excelente rendimiento acad├®mico en el per├¡odo 2024-2', NULL, 4.00, 1, '[\"Carn├® estudiantil\", \"Certificado de notas\", \"Carta de recomendaci├│n docente\", \"Certificado de buena conducta\", \"Comprobante de ingresos familiares\"]', 2, NULL, NULL, 500000.00, '', 10, 'Activa', '2025-08-21 00:16:52', NULL, NULL, NULL, 1),
(29, 'Beca Deportiva 2024-2', 'Beca para estudiantes destacados en deportes del per├¡odo 2024-2', NULL, 3.50, 1, '[\"Carn├® estudiantil\", \"Certificado deportivo\", \"Certificado m├®dico\", \"Fotograf├¡as de competencias\", \"Carta de recomendaci├│n del entrenador\"]', 2, NULL, NULL, 300000.00, 'Deportiva', 5, 'Activa', '2025-08-21 00:18:00', NULL, NULL, NULL, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `becas_documentos_requisitos`
--

CREATE TABLE `becas_documentos_requisitos` (
  `id` int(10) UNSIGNED NOT NULL,
  `beca_id` int(10) UNSIGNED NOT NULL COMMENT 'ID de la beca',
  `nombre_documento` varchar(255) NOT NULL COMMENT 'Nombre del documento requerido',
  `descripcion` text DEFAULT NULL COMMENT 'Descripci??n del documento',
  `tipo_documento` varchar(100) NOT NULL COMMENT 'Tipo de documento (PDF, IMG, etc.)',
  `obligatorio` tinyint(1) NOT NULL DEFAULT 1 COMMENT 'Si el documento es obligatorio',
  `orden_verificacion` int(10) UNSIGNED NOT NULL DEFAULT 1 COMMENT 'Orden en que se debe verificar',
  `estado` enum('Activo','Inactivo') NOT NULL DEFAULT 'Activo' COMMENT 'Estado del requisito'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Documentos requisitos para cada beca';

--
-- Volcado de datos para la tabla `becas_documentos_requisitos`
--

INSERT INTO `becas_documentos_requisitos` (`id`, `beca_id`, `nombre_documento`, `descripcion`, `tipo_documento`, `obligatorio`, `orden_verificacion`, `estado`) VALUES
(1, 1, 'Certificado de Promedio Acad??mico', 'Certificado oficial del promedio acad??mico del per??odo anterior', 'PDF', 1, 1, 'Activo'),
(2, 1, 'Carta de Recomendaci??n Acad??mica', 'Carta de recomendaci??n de un profesor o director de carrera', 'PDF', 1, 2, 'Activo'),
(3, 1, 'Ficha Socioecon??mica', 'Ficha socioecon??mica aprobada del per??odo vigente', 'PDF', 1, 3, 'Activo'),
(4, 2, 'Certificado de Ingresos Familiares', 'Certificado de ingresos familiares del ??ltimo a??o', 'PDF', 1, 1, 'Activo'),
(5, 2, 'Certificado de No Tener RUC', 'Certificado de no tener RUC activo', 'PDF', 1, 2, 'Activo'),
(6, 2, 'Certificado de No Tener Veh??culo', 'Certificado de no tener veh??culo registrado', 'PDF', 1, 3, 'Activo'),
(7, 2, 'Ficha Socioecon??mica', 'Ficha socioecon??mica aprobada del per??odo vigente', 'PDF', 1, 4, 'Activo'),
(8, 3, 'Certificado Deportivo', 'Certificado de participaci??n en actividades deportivas', 'PDF', 1, 1, 'Activo'),
(9, 3, 'Carta de Recomendaci??n Deportiva', 'Carta de recomendaci??n del entrenador o coordinador deportivo', 'PDF', 1, 2, 'Activo'),
(10, 3, 'Ficha Socioecon??mica', 'Ficha socioecon??mica aprobada del per??odo vigente', 'PDF', 1, 3, 'Activo'),
(11, 1, 'Certificado de Notas', 'Certificado oficial de calificaciones del ??ltimo per??odo', '', 1, 1, 'Activo'),
(12, 1, 'Carta de Motivaci??n', 'Carta explicando las razones para solicitar la beca', '', 1, 2, 'Activo'),
(13, 1, 'Certificado de Participaci??n', 'Certificado de participaci??n en actividades institucionales', '', 0, 3, 'Activo'),
(14, 2, 'Ficha Socioecon??mica', 'Ficha socioecon??mica aprobada por el departamento', '', 1, 1, 'Activo'),
(15, 2, 'Certificado de Ingresos', 'Certificado de ingresos familiares del ??ltimo a??o', '', 1, 2, 'Activo'),
(16, 2, 'Certificado de No RUC', 'Certificado de no tener RUC activo', '', 1, 3, 'Activo'),
(17, 2, 'Certificado de No Veh??culos', 'Certificado de no poseer veh??culos', '', 0, 4, 'Activo'),
(18, 3, 'Certificado Deportivo', 'Certificado de participaci??n en deportes institucionales', '', 1, 1, 'Activo'),
(19, 3, 'Certificado de Notas', 'Certificado oficial de calificaciones', '', 1, 2, 'Activo'),
(20, 3, 'Carta del Entrenador', 'Carta de recomendaci??n del entrenador', '', 1, 3, 'Activo'),
(21, 4, 'Certificado Cultural', 'Certificado de participaci??n en actividades culturales', '', 1, 1, 'Activo'),
(22, 4, 'Portafolio', 'Portafolio de trabajos culturales realizados', '', 1, 2, 'Activo'),
(23, 4, 'Certificado de Notas', 'Certificado oficial de calificaciones', '', 1, 3, 'Activo'),
(24, 5, 'Certificado de Discapacidad', 'Certificado m??dico de discapacidad', '', 1, 1, 'Activo'),
(25, 5, 'Certificado de Notas', 'Certificado oficial de calificaciones', '', 1, 2, 'Activo'),
(26, 5, 'Carta de Motivaci??n', 'Carta explicando las necesidades espec??ficas', '', 1, 3, 'Activo'),
(27, 6, 'Proyecto de Investigaci??n', 'Documento del proyecto de investigaci??n', '', 1, 1, 'Activo'),
(28, 6, 'Carta del Director', 'Carta de aprobaci??n del director de investigaci??n', '', 1, 2, 'Activo'),
(29, 6, 'Certificado de Notas', 'Certificado oficial de calificaciones', '', 1, 3, 'Activo'),
(30, 7, 'Certificado de Cargo', 'Certificado del cargo en organizaci??n estudiantil', '', 1, 1, 'Activo'),
(31, 7, 'Carta de Motivaci??n', 'Carta explicando el liderazgo ejercido', '', 1, 2, 'Activo'),
(32, 7, 'Certificado de Notas', 'Certificado oficial de calificaciones', '', 1, 3, 'Activo'),
(33, 1, 'Certificado de Notas', 'Certificado oficial de calificaciones del ??ltimo per??odo', '', 1, 1, 'Activo'),
(34, 1, 'Carta de Motivaci??n', 'Carta explicando las razones para solicitar la beca', '', 1, 2, 'Activo'),
(35, 1, 'Certificado de Participaci??n', 'Certificado de participaci??n en actividades institucionales', '', 0, 3, 'Activo'),
(36, 2, 'Ficha Socioecon??mica', 'Ficha socioecon??mica aprobada por el departamento', '', 1, 1, 'Activo'),
(37, 2, 'Certificado de Ingresos', 'Certificado de ingresos familiares del ??ltimo a??o', '', 1, 2, 'Activo'),
(38, 2, 'Certificado de No RUC', 'Certificado de no tener RUC activo', '', 1, 3, 'Activo'),
(39, 3, 'Certificado Deportivo', 'Certificado de participaci??n en deportes institucionales', '', 1, 1, 'Activo'),
(40, 3, 'Certificado de Notas', 'Certificado oficial de calificaciones', '', 1, 2, 'Activo'),
(41, 3, 'Carta del Entrenador', 'Carta de recomendaci??n del entrenador', '', 1, 3, 'Activo'),
(42, 4, 'Certificado Cultural', 'Certificado de participaci??n en actividades culturales', '', 1, 1, 'Activo'),
(43, 4, 'Portafolio', 'Portafolio de trabajos culturales realizados', '', 1, 2, 'Activo'),
(44, 4, 'Certificado de Notas', 'Certificado oficial de calificaciones', '', 1, 3, 'Activo'),
(45, 5, 'Proyecto de Investigaci??n', 'Documento del proyecto de investigaci??n', '', 1, 1, 'Activo'),
(46, 5, 'Carta del Director', 'Carta de aprobaci??n del director de investigaci??n', '', 1, 2, 'Activo'),
(47, 5, 'Certificado de Notas', 'Certificado oficial de calificaciones', '', 1, 3, 'Activo'),
(48, 28, 'Carn├® estudiantil', 'Carn├® de identificaci├│n estudiantil vigente', 'Identificaci├│n', 1, 1, 'Activo'),
(49, 28, 'Certificado de notas', 'Certificado de notas del per├¡odo anterior con promedio m├¡nimo 4.0', 'Acad├®mico', 1, 2, 'Activo'),
(50, 28, 'Carta de recomendaci├│n docente', 'Carta de recomendaci├│n de un docente del instituto', 'Recomendaci├│n', 1, 3, 'Activo'),
(51, 28, 'Certificado de buena conducta', 'Certificado de buena conducta emitido por la instituci├│n', 'Conducta', 1, 4, 'Activo'),
(52, 28, 'Comprobante de ingresos familiares', 'Comprobante de ingresos familiares del ├║ltimo mes', 'Econ├│mico', 1, 5, 'Activo'),
(53, 29, 'Carn├® estudiantil', 'Carn├® de identificaci├│n estudiantil vigente', 'Identificaci├│n', 1, 1, 'Activo'),
(54, 29, 'Certificado deportivo', 'Certificado de participaci├│n en actividades deportivas', 'Deportivo', 1, 2, 'Activo'),
(55, 29, 'Certificado m├®dico', 'Certificado m├®dico de aptitud f├¡sica', 'M├®dico', 1, 3, 'Activo'),
(56, 29, 'Fotograf├¡as de competencias', 'Fotograf├¡as de participaci├│n en competencias deportivas', 'Evidencia', 1, 4, 'Activo'),
(57, 29, 'Carta de recomendaci├│n del entrenador', 'Carta de recomendaci├│n del entrenador deportivo', 'Recomendaci├│n', 1, 5, 'Activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carreras`
--

CREATE TABLE `carreras` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `codigo` varchar(50) NOT NULL,
  `semestres` int(2) NOT NULL DEFAULT 5,
  `activa` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `carreras`
--

INSERT INTO `carreras` (`id`, `nombre`, `codigo`, `semestres`, `activa`, `created_at`) VALUES
(1, 'Atención Integral Adultos Mayores', 'atencion-integral-adultos-mayores', 5, 1, '2025-07-30 23:34:24'),
(2, 'Desarrollo de Software', 'desarrollo-de-software', 5, 1, '2025-07-30 23:34:24'),
(3, 'Diseño Gráfico', 'diseno-grafico', 5, 1, '2025-07-30 23:34:24'),
(4, 'Administración', 'administracion', 5, 1, '2025-07-30 23:34:24'),
(5, 'Marketing Digital y Comercio Electrónico', 'marketing-digital-comercio-electronico', 5, 1, '2025-07-30 23:34:24'),
(6, 'Redes y Telecomunicaciones', 'redes-telecomunicaciones', 5, 1, '2025-07-30 23:34:24'),
(7, 'Desarrollo y Análisis de Software (Virtual)', 'desarrollo-analisis-software-virtual', 5, 1, '2025-07-30 23:34:24'),
(8, 'Ingeniería Informática', 'ingenieria-informatica', 5, 1, '2025-07-31 06:59:52'),
(9, 'Ingeniería Industrial', 'ingenieria-industrial', 5, 1, '2025-07-31 06:59:52'),
(10, 'Contabilidad', 'contabilidad', 5, 1, '2025-07-31 06:59:52'),
(11, 'Marketing', 'marketing', 5, 1, '2025-07-31 06:59:52');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias_evaluacion`
--

CREATE TABLE `categorias_evaluacion` (
  `id_categoria` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `peso` decimal(3,2) DEFAULT 1.00,
  `estado` enum('Activa','Inactiva') DEFAULT 'Activa',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categorias_evaluacion`
--

INSERT INTO `categorias_evaluacion` (`id_categoria`, `nombre`, `descripcion`, `peso`, `estado`, `created_at`, `updated_at`) VALUES
(1, 'Desempe??o Laboral', 'Evaluaci??n del rendimiento en las tareas asignadas', 0.30, 'Activa', '2025-08-20 15:48:59', '2025-08-20 15:48:59'),
(2, 'Competencias T??cnicas', 'Evaluaci??n de habilidades t??cnicas espec??ficas', 0.25, 'Activa', '2025-08-20 15:48:59', '2025-08-20 15:48:59'),
(3, 'Trabajo en Equipo', 'Evaluaci??n de la colaboraci??n y comunicaci??n', 0.20, 'Activa', '2025-08-20 15:48:59', '2025-08-20 15:48:59'),
(4, 'Liderazgo', 'Evaluaci??n de capacidades de liderazgo', 0.15, 'Activa', '2025-08-20 15:48:59', '2025-08-20 15:48:59'),
(5, 'Innovaci??n', 'Evaluaci??n de creatividad e innovaci??n', 0.10, 'Activa', '2025-08-20 15:48:59', '2025-08-20 15:48:59'),
(6, 'Desempe├▒o Laboral', 'Evaluaci├│n del rendimiento en las tareas asignadas', 0.30, 'Activa', '2025-08-20 15:49:02', '2025-08-20 15:49:02'),
(7, 'Competencias T├®cnicas', 'Evaluaci├│n de habilidades t├®cnicas espec├¡ficas', 0.25, 'Activa', '2025-08-20 15:49:02', '2025-08-20 15:49:02'),
(8, 'Trabajo en Equipo', 'Evaluaci├│n de la colaboraci├│n y comunicaci├│n', 0.20, 'Activa', '2025-08-20 15:49:02', '2025-08-20 15:49:02'),
(9, 'Liderazgo', 'Evaluaci├│n de capacidades de liderazgo', 0.15, 'Activa', '2025-08-20 15:49:02', '2025-08-20 15:49:02'),
(10, 'Innovaci├│n', 'Evaluaci├│n de creatividad e innovaci├│n', 0.10, 'Activa', '2025-08-20 15:49:02', '2025-08-20 15:49:02');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias_solicitud_ayuda`
--

CREATE TABLE `categorias_solicitud_ayuda` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `color` varchar(7) DEFAULT '#007bff',
  `icono` varchar(50) DEFAULT 'bi-question-circle',
  `activo` tinyint(1) DEFAULT 1,
  `orden` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `categorias_solicitud_ayuda`
--

INSERT INTO `categorias_solicitud_ayuda` (`id`, `nombre`, `descripcion`, `color`, `icono`, `activo`, `orden`, `created_at`, `updated_at`) VALUES
(36, 'Académicas', 'Problemas relacionados con estudios, materias, profesores, horarios, etc.', '#28a745', 'bi-book', 1, 1, '2025-08-20 18:21:09', '2025-08-20 18:21:09'),
(37, 'Económicas', 'Becas, ayudas financieras, problemas de pago, etc.', '#ffc107', 'bi-currency-dollar', 1, 2, '2025-08-20 18:21:09', '2025-08-20 18:21:09'),
(38, 'Salud', 'Problemas médicos, psicológicos, atención en salud, etc.', '#dc3545', 'bi-heart-pulse', 1, 3, '2025-08-20 18:21:09', '2025-08-20 18:21:09'),
(39, 'Vivienda', 'Alojamiento, transporte, problemas de residencia, etc.', '#17a2b8', 'bi-house', 1, 4, '2025-08-20 18:21:09', '2025-08-20 18:21:09'),
(40, 'Sociales', 'Integración, compañerismo, problemas de convivencia, etc.', '#6f42c1', 'bi-people', 1, 5, '2025-08-20 18:21:09', '2025-08-20 18:21:09'),
(41, 'Técnicas', 'Problemas con el sistema, tecnología, acceso a plataformas, etc.', '#fd7e14', 'bi-gear', 1, 6, '2025-08-20 18:21:09', '2025-08-20 18:21:09'),
(42, 'Otro Asunto', 'Casos especiales que no se ajustan a las categorías anteriores', '#6c757d', 'bi-three-dots', 1, 7, '2025-08-20 18:21:09', '2025-08-20 18:21:09');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `citas`
--

CREATE TABLE `citas` (
  `id` int(10) UNSIGNED NOT NULL,
  `ticket_id` int(10) UNSIGNED DEFAULT NULL,
  `estudiante_id` int(10) UNSIGNED NOT NULL,
  `admin_id` int(10) UNSIGNED NOT NULL,
  `asunto` varchar(255) NOT NULL,
  `fecha_hora` datetime NOT NULL,
  `lugar_o_enlace` varchar(255) NOT NULL,
  `estado` enum('Programada','Completada','Cancelada') NOT NULL DEFAULT 'Programada'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `citas`
--

INSERT INTO `citas` (`id`, `ticket_id`, `estudiante_id`, `admin_id`, `asunto`, `fecha_hora`, `lugar_o_enlace`, `estado`) VALUES
(2, 2, 3, 2, 'Asesoría sobre ficha socioeconómica', '2024-10-17 14:00:00', 'Oficina de Bienestar - Sala 1', 'Programada');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `competencias`
--

CREATE TABLE `competencias` (
  `id_competencia` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `categoria` enum('T??cnica','Soft Skills','Liderazgo','Gesti??n') NOT NULL,
  `nivel_requerido` enum('B??sico','Intermedio','Avanzado','Experto') NOT NULL,
  `estado` enum('Activa','Inactiva') DEFAULT 'Activa',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `competencias`
--

INSERT INTO `competencias` (`id_competencia`, `nombre`, `descripcion`, `categoria`, `nivel_requerido`, `estado`, `created_at`, `updated_at`) VALUES
(1, 'Programaci??n', 'Habilidades de desarrollo de software', 'T??cnica', 'Intermedio', 'Activa', '2025-08-20 15:48:59', '2025-08-20 15:48:59'),
(2, 'Comunicaci??n', 'Habilidades de comunicaci??n efectiva', 'Soft Skills', 'Avanzado', 'Activa', '2025-08-20 15:48:59', '2025-08-20 15:48:59'),
(3, 'Gesti??n de Proyectos', 'Capacidad para liderar proyectos', 'Liderazgo', 'Intermedio', 'Activa', '2025-08-20 15:48:59', '2025-08-20 15:48:59'),
(4, 'An??lisis de Datos', 'Habilidades de an??lisis y interpretaci??n', 'T??cnica', 'B??sico', 'Activa', '2025-08-20 15:48:59', '2025-08-20 15:48:59'),
(5, 'Trabajo en Equipo', 'Colaboraci??n efectiva en grupos', 'Soft Skills', 'Avanzado', 'Activa', '2025-08-20 15:48:59', '2025-08-20 15:48:59'),
(6, 'Programaci├│n', 'Habilidades de desarrollo de software', '', 'Intermedio', 'Activa', '2025-08-20 15:49:02', '2025-08-20 15:49:02'),
(7, 'Comunicaci├│n', 'Habilidades de comunicaci├│n efectiva', 'Soft Skills', 'Avanzado', 'Activa', '2025-08-20 15:49:02', '2025-08-20 15:49:02'),
(8, 'Gesti├│n de Proyectos', 'Capacidad para liderar proyectos', 'Liderazgo', 'Intermedio', 'Activa', '2025-08-20 15:49:02', '2025-08-20 15:49:02'),
(9, 'An├ílisis de Datos', 'Habilidades de an├ílisis y interpretaci├│n', '', '', 'Activa', '2025-08-20 15:49:02', '2025-08-20 15:49:02'),
(10, 'Trabajo en Equipo', 'Colaboraci├│n efectiva en grupos', 'Soft Skills', 'Avanzado', 'Activa', '2025-08-20 15:49:02', '2025-08-20 15:49:02');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documentos`
--

CREATE TABLE `documentos` (
  `id` int(10) UNSIGNED NOT NULL,
  `usuario_id` int(10) UNSIGNED NOT NULL COMMENT 'El usuario que sube el documento',
  `ficha_id` int(10) UNSIGNED DEFAULT NULL COMMENT 'Asociado a una ficha socioeconómica',
  `solicitud_beca_id` int(10) UNSIGNED DEFAULT NULL COMMENT 'Asociado a una solicitud de beca',
  `tipo_documento` varchar(255) DEFAULT NULL COMMENT 'Describe el requisito. Ej: Cédula, Certificado de Notas.',
  `nombre_archivo` varchar(255) NOT NULL,
  `path_archivo` varchar(255) NOT NULL,
  `tipo_mime` varchar(100) NOT NULL,
  `tamano_kb` int(10) UNSIGNED NOT NULL,
  `fecha_subida` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `documentos`
--

INSERT INTO `documentos` (`id`, `usuario_id`, `ficha_id`, `solicitud_beca_id`, `tipo_documento`, `nombre_archivo`, `path_archivo`, `tipo_mime`, `tamano_kb`, `fecha_subida`) VALUES
(3, 3, 2, NULL, 'Cédula de Identidad', 'cedula_ana_martinez.pdf', 'uploads/documentos/cedula_ana_martinez.pdf', 'application/pdf', 230, '2024-09-20 19:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `documentos_solicitud_becas`
--

CREATE TABLE `documentos_solicitud_becas` (
  `id` int(10) UNSIGNED NOT NULL,
  `solicitud_beca_id` int(10) UNSIGNED NOT NULL,
  `documento_requerido_id` int(10) UNSIGNED NOT NULL,
  `nombre_archivo` varchar(255) NOT NULL,
  `ruta_archivo` varchar(500) NOT NULL,
  `orden_revision` int(10) UNSIGNED NOT NULL DEFAULT 1,
  `estado` enum('Pendiente','En Revision','Aprobado','Rechazado') NOT NULL DEFAULT 'Pendiente',
  `observaciones` text DEFAULT NULL,
  `revisado_por` int(10) UNSIGNED DEFAULT NULL,
  `fecha_subida` timestamp NOT NULL DEFAULT current_timestamp(),
  `fecha_revision` timestamp NULL DEFAULT NULL,
  `tama±o_archivo` int(10) UNSIGNED DEFAULT NULL,
  `tipo_mime` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `documentos_solicitud_becas`
--

INSERT INTO `documentos_solicitud_becas` (`id`, `solicitud_beca_id`, `documento_requerido_id`, `nombre_archivo`, `ruta_archivo`, `orden_revision`, `estado`, `observaciones`, `revisado_por`, `fecha_subida`, `fecha_revision`, `tama±o_archivo`, `tipo_mime`) VALUES
(1, 41, 48, 'CARTA TALENTO HUMANO.pdf', 'uploads/documentos_becas/doc_41_1_1755749345.pdf', 1, 'En Revision', NULL, NULL, '2025-08-21 09:09:05', NULL, 205158, 'application/pdf'),
(2, 41, 50, 'pendiente_subida.tmp', '/temp/pendiente_subida.tmp', 2, 'Pendiente', NULL, NULL, '2025-08-21 00:57:04', NULL, NULL, NULL),
(3, 41, 51, 'pendiente_subida.tmp', '/temp/pendiente_subida.tmp', 3, 'Pendiente', NULL, NULL, '2025-08-21 00:57:04', NULL, NULL, NULL),
(4, 41, 49, 'pendiente_subida.tmp', '/temp/pendiente_subida.tmp', 4, 'Pendiente', NULL, NULL, '2025-08-21 00:57:04', NULL, NULL, NULL),
(5, 41, 52, 'pendiente_subida.tmp', '/temp/pendiente_subida.tmp', 5, 'Pendiente', NULL, NULL, '2025-08-21 00:57:04', NULL, NULL, NULL);

--
-- Disparadores `documentos_solicitud_becas`
--
DELIMITER $$
CREATE TRIGGER `tr_actualizar_documentos_revisados` AFTER UPDATE ON `documentos_solicitud_becas` FOR EACH ROW BEGIN
    DECLARE docs_aprobados INT DEFAULT 0;
    DECLARE total_docs INT DEFAULT 0;
    
    IF NEW.estado = 'Aprobado' AND OLD.estado != 'Aprobado' THEN
        SELECT COUNT(*) INTO docs_aprobados 
        FROM `documentos_solicitud_becas` 
        WHERE `solicitud_beca_id` = NEW.solicitud_beca_id AND `estado` = 'Aprobado';
        
        SELECT COUNT(*) INTO total_docs 
        FROM `documentos_solicitud_becas` 
        WHERE `solicitud_beca_id` = NEW.solicitud_beca_id;
        
        UPDATE `solicitudes_becas` 
        SET `documentos_revisados` = docs_aprobados,
            `total_documentos` = total_docs,
            `documento_actual_revision` = LEAST(docs_aprobados + 1, total_docs)
        WHERE `id` = NEW.solicitud_beca_id;
        
        
        IF docs_aprobados = total_docs THEN
            UPDATE `solicitudes_becas` 
            SET `estado` = 'Documentos Aprobados'
            WHERE `id` = NEW.solicitud_beca_id;
        END IF;
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estudiantes_habilitacion_becas`
--

CREATE TABLE `estudiantes_habilitacion_becas` (
  `id` int(10) UNSIGNED NOT NULL,
  `estudiante_id` int(10) UNSIGNED NOT NULL,
  `periodo_id` int(10) UNSIGNED NOT NULL,
  `ficha_completada` tinyint(1) NOT NULL DEFAULT 0,
  `puede_solicitar_becas` tinyint(1) NOT NULL DEFAULT 0,
  `fecha_habilitacion` timestamp NULL DEFAULT NULL,
  `habilitado_por` int(10) UNSIGNED DEFAULT NULL,
  `observaciones` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `estudiantes_habilitacion_becas`
--

INSERT INTO `estudiantes_habilitacion_becas` (`id`, `estudiante_id`, `periodo_id`, `ficha_completada`, `puede_solicitar_becas`, `fecha_habilitacion`, `habilitado_por`, `observaciones`, `created_at`, `updated_at`) VALUES
(1, 3, 7, 1, 1, '2025-08-20 15:11:34', 2, NULL, '2025-08-20 15:11:34', '2025-08-20 15:11:34'),
(2, 40, 5, 1, 1, '2025-08-21 09:38:41', NULL, NULL, '2025-08-20 23:19:41', '2025-08-21 09:38:41'),
(3, 40, 1, 1, 1, '2025-08-21 09:38:41', NULL, NULL, '2025-08-21 04:40:58', '2025-08-21 09:38:41'),
(4, 40, 2, 1, 1, '2025-08-21 09:38:41', NULL, NULL, '2025-08-21 04:40:58', '2025-08-21 09:38:41'),
(5, 40, 4, 1, 1, '2025-08-21 09:38:41', NULL, NULL, '2025-08-21 04:40:58', '2025-08-21 09:38:41');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fichas_becas_relacion`
--

CREATE TABLE `fichas_becas_relacion` (
  `id` int(10) UNSIGNED NOT NULL,
  `ficha_id` int(10) UNSIGNED NOT NULL,
  `solicitud_beca_id` int(10) UNSIGNED DEFAULT NULL,
  `tipo_relacion` enum('Solicitando','Becado','Sin_Beca') NOT NULL DEFAULT 'Sin_Beca',
  `observaciones` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `fichas_becas_relacion`
--

INSERT INTO `fichas_becas_relacion` (`id`, `ficha_id`, `solicitud_beca_id`, `tipo_relacion`, `observaciones`, `created_at`) VALUES
(1, 2, 2, 'Solicitando', NULL, '2025-07-30 23:34:24'),
(2, 3, NULL, 'Sin_Beca', NULL, '2025-07-30 23:34:24'),
(3, 4, NULL, 'Sin_Beca', NULL, '2025-07-30 23:34:24');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fichas_socioeconomicas`
--

CREATE TABLE `fichas_socioeconomicas` (
  `id` int(10) UNSIGNED NOT NULL,
  `estudiante_id` int(10) UNSIGNED NOT NULL,
  `periodo_id` int(10) UNSIGNED NOT NULL,
  `json_data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL COMMENT 'Campo flexible para almacenar toda la data de la ficha en formato JSON' CHECK (json_valid(`json_data`)),
  `estado` enum('Borrador','Enviada','Revisada','Aprobada','Rechazada') NOT NULL DEFAULT 'Borrador',
  `revisada_por_admin` tinyint(1) DEFAULT 0,
  `fecha_revision_admin` datetime DEFAULT NULL,
  `observaciones_admin` text DEFAULT NULL COMMENT 'Comentario obligatorio cuando se rechaza una ficha',
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp(),
  `fecha_envio` datetime DEFAULT NULL,
  `fecha_revision` datetime DEFAULT NULL,
  `revisado_por` int(10) UNSIGNED DEFAULT NULL COMMENT 'ID del admin que revisó la ficha',
  `fecha_actualizacion` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `actualizado_por` int(10) UNSIGNED DEFAULT NULL,
  `puntaje_calculado` decimal(5,2) DEFAULT NULL,
  `relacionada_beca` tinyint(1) DEFAULT 0 COMMENT 'Indica si la ficha estß relacionada con una solicitud de beca',
  `fecha_relacion_beca` datetime DEFAULT NULL COMMENT 'Fecha cuando se relacion¾ con beca'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `fichas_socioeconomicas`
--

INSERT INTO `fichas_socioeconomicas` (`id`, `estudiante_id`, `periodo_id`, `json_data`, `estado`, `revisada_por_admin`, `fecha_revision_admin`, `observaciones_admin`, `fecha_creacion`, `fecha_envio`, `fecha_revision`, `revisado_por`, `fecha_actualizacion`, `actualizado_por`, `puntaje_calculado`, `relacionada_beca`, `fecha_relacion_beca`) VALUES
(2, 3, 2, '{\"ingresos_familiares\": 800, \"miembros_familia\": 6, \"vivienda\": \"alquilada\", \"estudios_padres\": \"primaria\"}', 'Aprobada', 1, '2025-08-15 05:44:40', 'Ficha revisada y aprobada por el administrador', '2024-09-15 15:00:00', '2024-09-20 14:00:00', NULL, 2, '2025-08-15 10:44:40', NULL, NULL, 0, NULL),
(3, 40, 1, '{\"test\":\"Ficha de prueba\",\"fecha_creacion\":\"2025-07-30 20:06:56\"}', 'Rechazada', 1, '2025-07-31 15:38:58', '', '2025-07-31 01:06:56', '2025-07-30 22:14:28', NULL, NULL, NULL, NULL, NULL, 0, NULL),
(4, 40, 2, '{\"apellidos_nombres\":\"estudiante estudiante\",\"nacionalidad\":\"Ecuatoriana\",\"cedula\":\"0003\",\"lugar_nacimiento\":\"Otavalo 11\\/09\\/2002\",\"edad\":[\"3\",\"3\"],\"estado_civil\":[\"Soltero\\/a\",\"Soltero\\/a\"],\"ciudad\":\"Otavalo\",\"barrio\":\"Miravallle\",\"calle_principal\":\"miravalle\",\"calle_secundaria\":\"los olivos\",\"etnia\":\"Blanco\",\"trabaja\":\"NO\",\"telefono_domicilio\":\"2134324\",\"celular\":\"123124\",\"email\":\"estudiante@testmail.com\",\"vive_con\":\"Solo Mama\",\"padres_separados\":\"SI\",\"nombre_apellido\":[\"ewrwerr\",\"qweqweq\"],\"parentesco\":[\"rewrwe\",\"ewqeqweqwe\"],\"ocupacion\":[\"wrewrwer\",\"ewqeqw\"],\"institucion\":[\"rewrw\",\"ewqewq\"],\"ingresos\":[\"3333\",\"2121212\"],\"observaciones\":[\"sdfdsfsdf\",\"sdasdasdsa\"],\"total_ingresos_familiares\":\"1000\",\"total_gastos_familiares\":\"500\",\"diferencia_ingresos_egresos\":\"500.00\",\"tipo_vivienda\":\"Propia\",\"condicion_vivienda\":\"Excelente\",\"numero_habitaciones\":\"2\",\"registra_prestamos\":\"NO\",\"monto_prestamos\":\"\",\"institucion_prestamista\":\"\",\"enfermedad_grave\":\"NO\",\"familiar_emigrante\":\"SI\",\"tipo_enfermedad\":\"\",\"familiar_afectado\":\"\",\"quien_emigrante\":[\"Padre\",\"Madre\",\"Hermano\",\"Otro\"],\"pais_destino\":\"veneco\",\"comentarios_estudiante\":\"12aerasdfas\",\"datos_familia\":[{\"nombre_apellido\":\"ewrwerr\",\"parentesco\":\"rewrwe\",\"edad\":\"3\",\"estado_civil\":\"Soltero\\/a\",\"ocupacion\":\"wrewrwer\",\"institucion\":\"rewrw\",\"ingresos\":\"3333\",\"observaciones\":\"sdfdsfsdf\"},{\"nombre_apellido\":\"qweqweq\",\"parentesco\":\"ewqeqweqwe\",\"edad\":\"3\",\"estado_civil\":\"Soltero\\/a\",\"ocupacion\":\"ewqeqw\",\"institucion\":\"ewqewq\",\"ingresos\":\"2121212\",\"observaciones\":\"sdasdasdsa\"}],\"servicios_basicos\":[],\"tipo_cuentas\":[]}', 'Aprobada', 1, '2025-08-15 05:44:40', 'Ficha revisada y aprobada por el administrador', '2025-07-31 03:20:09', '2025-07-30 23:02:26', NULL, 2, '2025-08-21 00:57:04', NULL, NULL, 1, '2025-08-21 00:57:04'),
(15, 40, 4, '{\"apellidos_nombres\":\"estudiante estudiante\",\"nacionalidad\":\"Ecuatoriana\",\"cedula\":\"0003\",\"lugar_nacimiento\":\"Otavalo 11\\/09\\/2002\",\"edad\":\"123\",\"estado_civil\":\"Soltero\\/a\",\"ciudad\":\"Otavalo\",\"barrio\":\"Miravallle\",\"calle_principal\":\"miravalle\",\"calle_secundaria\":\"los olivos\",\"etnia\":\"Blanco\",\"trabaja\":\"NO\",\"lugar_trabajo\":\"sadasdas\",\"sueldo_mensual\":\"223\",\"tiempo_servicios\":\"\",\"cargo\":\"\",\"telefono_domicilio\":\"2134324\",\"telefono_trabajo\":\"1231231\",\"celular\":\"123124\",\"email\":\"estudiante@testmail.com\",\"vive_con\":\"Solo Papa\",\"padres_separados\":\"SI\",\"colegio_graduacion\":\"asdasdas\",\"ciudad_colegio\":\"Otavalo\",\"provincia_colegio\":\"imbabura\",\"tipo_colegio\":\"Fiscal\",\"anio_grado\":\"2020\",\"carrera\":\"dsada\",\"nivel_ingresa\":\"cuarto\",\"modalidad\":\"presencial\",\"estudia_otra_carrera\":\"NO\",\"institucion_otra_carrera\":\"\",\"forma_pago\":\"Al Contado\",\"especificar_pago\":\"\",\"toma_ingles\":\"SI\",\"modalidad_ingles\":\"virtual\",\"nivel_ingles\":\"A2\",\"apellidos_nombres_dependiente\":\"sadsadasdas\",\"cedula_dependiente\":\"123213\",\"parentesco\":\"madre\",\"ciudad_dependiente\":\"Otavalo\",\"barrio_dependiente\":\"miravalle\",\"parroquia_dependiente\":\"jordaan\",\"calle_principal_dependiente\":\"sldaso\",\"calle_secundaria_dependiente\":\"qwewqe\",\"profesion_dependiente\":\"judicatura\",\"trabaja_dependiente\":\"NO\",\"lugar_trabajo_dependiente\":\"\",\"direccion_trabajo_dependiente\":\"\",\"tiempo_servicios_dependiente\":\"\",\"sueldo_mensual_dependiente\":\"\",\"telefono_domicilio_dependiente\":\"12334123\",\"telefono_trabajo_dependiente\":\"\",\"celular_dependiente\":\"12 3123\",\"email_dependiente\":\"sdasdasdas@gmail.com\",\"lugar_negocio_propio\":\"3213123\",\"actividad_dependiente\":\"sdasdsd\",\"ingreso_estimado_dependiente\":\"3000\",\"total_ingresos_familiares\":\"3000\",\"total_gastos_familiares\":\"100\",\"diferencia_ingresos_egresos\":\"3900\",\"tipo_vivienda\":\"Propia\",\"costo_arriendo\":\"\",\"especificar_cedida_compartida\":\"dsa\",\"tipo_construccion\":\"Casa\",\"especificar_tipo_vivienda\":\"dasd\",\"material_construccion\":\"Hormig\\u00f3n\",\"servicios_basicos\":[\"Agua Potable\",\"Alcantarillado\",\"Luz El\\u00e9ctrica\",\"Tel\\u00e9fono\",\"Internet\",\"TV Cable\"],\"vehiculo_propio\":\"SI\",\"marca_ano_vehiculo\":\"chevrolet 2023\",\"uso_vehiculo\":\"Herramienta de Trabajo\",\"especificar_uso_vehiculo\":\"asd\",\"otras_propiedades\":\"SI\",\"especificar_propiedades\":\"asdas\",\"tipo_cuentas\":[\"Ahorro\"],\"registra_prestamos\":\"NO\",\"valor_deuda_actual\":\"\",\"valor_pago_mensual_deuda\":\"\",\"motivo_deuda\":\"\",\"enfermedad_grave\":\"NO\",\"especificar_enfermedad\":\"\",\"anio_inicio_tratamiento\":\"\",\"discapacidad\":\"NO\",\"especificar_discapacidad\":\"\",\"carnet_conadis\":\"NO\",\"porcentaje_discapacidad\":\"\",\"familiar_emigrante\":\"NO\",\"especificar_otros_emigrante\":\"\",\"lugar_emigrante\":\"\",\"tiempo_permanencia_emigrante\":\"\",\"comentarios_estudiante\":\"gracias \",\"datos_familia\":[],\"quien_emigrante\":[]}', 'Rechazada', 1, '2025-08-13 23:18:03', '', '2025-07-31 09:26:15', '2025-07-31 04:27:12', NULL, NULL, NULL, NULL, NULL, 0, NULL),
(16, 41, 7, '{\"nombre\":\"Juan Pérez\",\"carrera\":\"Desarrollo de Software\",\"semestre\":\"5to\",\"promedio\":\"8.5\",\"trabaja\":\"No\",\"ingresos_familia\":1200}', 'Aprobada', 1, '2025-08-15 05:44:40', 'Ficha revisada y aprobada por el administrador', '2024-08-15 15:30:00', '2024-08-20 14:20:00', '2024-08-25 09:15:00', 2, '2025-08-15 10:44:40', NULL, NULL, 0, NULL),
(17, 42, 7, '{\"nombre\":\"Ana López\",\"carrera\":\"Administración\",\"semestre\":\"3ro\",\"promedio\":\"8.2\",\"trabaja\":\"Sí\",\"ingresos_familia\":1500}', 'Rechazada', 1, '2025-08-13 23:17:58', '', '2024-08-18 16:45:00', '2024-08-22 16:30:00', NULL, NULL, NULL, NULL, NULL, 0, NULL),
(18, 43, 7, '{\"nombre\":\"Carlos Ruiz\",\"carrera\":\"Marketing Digital\",\"semestre\":\"7mo\",\"promedio\":\"9.1\",\"trabaja\":\"No\",\"ingresos_familia\":800}', 'Enviada', 0, NULL, NULL, '2024-08-20 14:15:00', NULL, NULL, NULL, '2025-08-15 10:47:28', NULL, NULL, 0, NULL),
(19, 39, 2, '{\"nombre\":\"Estebansito\",\"carrera\":\"Desarrollo\",\"semestre\":\"4to\",\"promedio\":\"9.1\",\"trabaja\":\"No\",\"ingresos_familia\":800}', 'Borrador', 0, NULL, NULL, '2025-07-30 07:36:32', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL),
(23, 1, 2, '{\"datos_personales\": {\"nombre\": \"Juan P├®rez\", \"edad\": 20}, \"situacion_economica\": {\"ingresos_familiares\": 500000}}', 'Enviada', 0, NULL, NULL, '2025-08-15 10:44:40', '2025-08-15 05:44:40', NULL, NULL, NULL, NULL, NULL, 0, NULL),
(24, 2, 2, '{\"datos_personales\": {\"nombre\": \"Mar├¡a Garc├¡a\", \"edad\": 19}, \"situacion_economica\": {\"ingresos_familiares\": 300000}}', 'Aprobada', 1, '2025-08-15 05:44:40', 'Ficha revisada y aprobada por el administrador', '2025-08-15 10:44:40', '2025-08-15 05:44:40', NULL, 2, '2025-08-15 10:44:40', NULL, NULL, 0, NULL),
(25, 3, 7, '{\"datos_personales\": {\"nombre\": \"Carlos L├│pez\", \"edad\": 21}, \"situacion_economica\": {\"ingresos_familiares\": 400000}}', 'Aprobada', 0, NULL, 'En proceso de revisi├│n', '2025-08-15 10:44:40', '2025-08-15 05:44:40', '2025-08-20 15:11:34', 2, '2025-08-20 15:11:34', NULL, NULL, 0, NULL),
(26, 1, 7, '{\"datos_personales\": {\"nombre\": \"Ana Mart├¡nez\", \"edad\": 22}, \"situacion_economica\": {\"ingresos_familiares\": 350000}}', 'Borrador', 0, NULL, NULL, '2025-08-15 10:44:40', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL),
(27, 4, 11, '{\"datos_personales\": {\"nombre\": \"Luis Hern├índez\", \"edad\": 23}, \"situacion_economica\": {\"ingresos_familiares\": 450000}}', 'Enviada', 0, NULL, NULL, '2025-08-15 10:44:40', '2025-08-15 05:44:40', NULL, NULL, NULL, NULL, NULL, 0, NULL),
(28, 55, 11, '{\"ingresos_padre\": \"300\", \"ingresos_madre\": \"150\", \"otros_ingresos\": \"0\", \"gastos_vivienda\": \"200\", \"gastos_alimentacion\": \"150\", \"otros_gastos\": \"100\", \"numero_dependientes\": \"4\", \"tipo_vivienda\": \"Propia\", \"zona_residencia\": \"Rural\", \"nivel_educativo_padres\": \"Primaria\"}', 'Enviada', 0, NULL, NULL, '2025-08-20 15:58:26', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL),
(29, 63, 11, '{\"ingresos_padre\": \"400\", \"ingresos_madre\": \"250\", \"otros_ingresos\": \"100\", \"gastos_vivienda\": \"300\", \"gastos_alimentacion\": \"200\", \"otros_gastos\": \"150\", \"numero_dependientes\": \"3\", \"tipo_vivienda\": \"Arrendada\", \"zona_residencia\": \"Urbana\", \"nivel_educativo_padres\": \"Secundaria\"}', 'Enviada', 0, NULL, NULL, '2025-08-20 15:58:26', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL),
(30, 64, 11, '{\"ingresos_padre\": \"600\", \"ingresos_madre\": \"400\", \"otros_ingresos\": \"200\", \"gastos_vivienda\": \"400\", \"gastos_alimentacion\": \"250\", \"otros_gastos\": \"200\", \"numero_dependientes\": \"2\", \"tipo_vivienda\": \"Propia\", \"zona_residencia\": \"Urbana\", \"nivel_educativo_padres\": \"Universitaria\"}', 'Revisada', 0, NULL, NULL, '2025-08-20 15:58:26', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL),
(31, 65, 11, '{\"ingresos_padre\": \"800\", \"ingresos_madre\": \"600\", \"otros_ingresos\": \"400\", \"gastos_vivienda\": \"500\", \"gastos_alimentacion\": \"300\", \"otros_gastos\": \"250\", \"numero_dependientes\": \"1\", \"tipo_vivienda\": \"Propia\", \"zona_residencia\": \"Urbana\", \"nivel_educativo_padres\": \"Universitaria\"}', 'Enviada', 0, NULL, NULL, '2025-08-20 15:58:26', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL),
(32, 40, 5, '{\"apellidos_nombres\":\"estudiante estudiante\",\"nacionalidad\":\"Ecuatoriana\",\"cedula\":\"02121321321003\",\"lugar_nacimiento\":\"Otavalo 26\\/04\\/2002\",\"edad\":\"22\",\"estado_civil\":\"Soltero\\/a\",\"ciudad\":\"otavalo\",\"barrio\":\"miravalle\",\"calle_principal\":\"miravalle\",\"calle_secundaria\":\"asdasdasd\",\"etnia\":\"Ind\\u00edgena\",\"trabaja\":\"NO\",\"lugar_trabajo\":\"\",\"sueldo_mensual\":\"\",\"tiempo_servicios\":\"\",\"cargo\":\"\",\"telefono_domicilio\":\"1231231\",\"telefono_trabajo\":\"3121231232\",\"celular\":\"12312413213321321\",\"email\":\"estudialolololosnte@testmail.com\",\"vive_con\":\"Hermanos\",\"padres_separados\":\"SI\",\"colegio_graduacion\":\"dasdsadas\",\"ciudad_colegio\":\"dasdasdas\",\"provincia_colegio\":\"dasdasdasda\",\"tipo_colegio\":\"Fiscal\",\"anio_grado\":\"2018\",\"carrera\":\"dsadaasdasd\",\"nivel_ingresa\":\"dsadasdasdas\",\"modalidad\":\"dasdasdasdasd\",\"estudia_otra_carrera\":\"NO\",\"institucion_otra_carrera\":\"\",\"forma_pago\":\"Al Contado\",\"especificar_pago\":\"\",\"toma_ingles\":\"SI\",\"modalidad_ingles\":\"dasdasd\",\"nivel_ingles\":\"asdadas\",\"apellidos_nombres_dependiente\":\"dasdasdasdasd\",\"cedula_dependiente\":\"123123213\",\"parentesco\":\"asdasdasdas\",\"ciudad_dependiente\":\"dsadas\",\"barrio_dependiente\":\"dasdasdasd\",\"parroquia_dependiente\":\"dsadasd\",\"calle_principal_dependiente\":\"asdasdasd\",\"calle_secundaria_dependiente\":\"dasdasdasd\",\"profesion_dependiente\":\"asdasdas\",\"trabaja_dependiente\":\"NO\",\"lugar_trabajo_dependiente\":\"\",\"direccion_trabajo_dependiente\":\"\",\"tiempo_servicios_dependiente\":\"\",\"sueldo_mensual_dependiente\":\"\",\"telefono_domicilio_dependiente\":\"1323123\",\"telefono_trabajo_dependiente\":\"12312312\",\"celular_dependiente\":\"3123123123123\",\"email_dependiente\":\"asdsadsadas@GMAIL.COM\",\"lugar_negocio_propio\":\"asdasdsadasd\",\"actividad_dependiente\":\"dasdsadasd\",\"ingreso_estimado_dependiente\":\"200\",\"total_ingresos_familiares\":\"200\",\"total_gastos_familiares\":\"100\",\"diferencia_ingresos_egresos\":\"100\",\"tipo_vivienda\":\"Propia\",\"costo_arriendo\":\"\",\"especificar_cedida_compartida\":\"sadasdasd\",\"tipo_construccion\":\"Casa\",\"especificar_tipo_vivienda\":\"sadasdasdasd\",\"material_construccion\":\"Hormig\\u00f3n\",\"servicios_basicos\":[\"Agua Potable\",\"Alcantarillado\",\"Luz El\\u00e9ctrica\",\"Tel\\u00e9fono\",\"Internet\"],\"vehiculo_propio\":\"SI\",\"marca_ano_vehiculo\":\"asdasdsada2001\",\"uso_vehiculo\":\"Familiar\",\"especificar_uso_vehiculo\":\"sdasdasdas\",\"otras_propiedades\":\"NO\",\"especificar_propiedades\":\"dasdasdas\",\"tipo_cuentas\":[\"Ahorro\"],\"registra_prestamos\":\"NO\",\"valor_deuda_actual\":\"\",\"valor_pago_mensual_deuda\":\"\",\"motivo_deuda\":\"\",\"enfermedad_grave\":\"NO\",\"especificar_enfermedad\":\"\",\"anio_inicio_tratamiento\":\"\",\"discapacidad\":\"NO\",\"especificar_discapacidad\":\"\",\"carnet_conadis\":\"NO\",\"porcentaje_discapacidad\":\"\",\"familiar_emigrante\":\"NO\",\"especificar_otros_emigrante\":\"\",\"lugar_emigrante\":\"\",\"tiempo_permanencia_emigrante\":\"\",\"comentarios_estudiante\":\"dasdasdasdadasd\",\"datos_familia\":[],\"quien_emigrante\":[]}', 'Aprobada', 0, NULL, NULL, '2025-08-20 23:04:18', '2025-08-20 23:05:02', '2025-08-20 23:19:41', NULL, '2025-08-20 23:19:41', NULL, NULL, 0, NULL);

--
-- Disparadores `fichas_socioeconomicas`
--
DELIMITER $$
CREATE TRIGGER `tr_ficha_completada_habilitar_becas` AFTER UPDATE ON `fichas_socioeconomicas` FOR EACH ROW BEGIN
    IF NEW.estado = 'Aprobada' AND OLD.estado != 'Aprobada' THEN
        INSERT INTO `estudiantes_habilitacion_becas` 
        (`estudiante_id`, `periodo_id`, `ficha_completada`, `puede_solicitar_becas`, `fecha_habilitacion`, `habilitado_por`)
        VALUES 
        (NEW.estudiante_id, NEW.periodo_id, 1, 1, NOW(), NEW.revisado_por)
        ON DUPLICATE KEY UPDATE 
        `ficha_completada` = 1,
        `puede_solicitar_becas` = 1,
        `fecha_habilitacion` = NOW(),
        `habilitado_por` = NEW.revisado_por,
        `updated_at` = NOW();
    END IF;
    
    IF NEW.estado = 'Rechazada' AND OLD.estado != 'Rechazada' THEN
        UPDATE `estudiantes_habilitacion_becas` 
        SET `puede_solicitar_becas` = 0, `updated_at` = NOW()
        WHERE `estudiante_id` = NEW.estudiante_id AND `periodo_id` = NEW.periodo_id;
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `validar_comentario_rechazo` BEFORE UPDATE ON `fichas_socioeconomicas` FOR EACH ROW BEGIN
    IF NEW.estado = 'Rechazada' AND (NEW.observaciones_admin IS NULL OR TRIM(NEW.observaciones_admin) = '') THEN
        SIGNAL SQLSTATE '45000' 
        SET MESSAGE_TEXT = 'Es obligatorio ingresar un comentario cuando se rechaza una ficha';
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `flujo_aprobacion_documentos`
--

CREATE TABLE `flujo_aprobacion_documentos` (
  `id` int(10) UNSIGNED NOT NULL,
  `solicitud_beca_id` int(10) UNSIGNED NOT NULL,
  `documento_id` int(10) UNSIGNED NOT NULL,
  `admin_id` int(10) UNSIGNED NOT NULL,
  `accion` enum('Aprobar','Rechazar','Devolver','Observar') NOT NULL,
  `observaciones` text DEFAULT NULL,
  `fecha_accion` timestamp NOT NULL DEFAULT current_timestamp(),
  `ip_origen` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial_estados_becas`
--

CREATE TABLE `historial_estados_becas` (
  `id` int(10) UNSIGNED NOT NULL,
  `solicitud_beca_id` int(10) UNSIGNED NOT NULL COMMENT 'ID de la solicitud de beca',
  `estado_anterior` enum('Postulada','En Revisi??n','Aprobada','Rechazada','Lista de Espera') DEFAULT NULL COMMENT 'Estado anterior de la solicitud',
  `estado_nuevo` enum('Postulada','En Revisi??n','Aprobada','Rechazada','Lista de Espera') NOT NULL COMMENT 'Nuevo estado de la solicitud',
  `motivo_cambio` text DEFAULT NULL COMMENT 'Motivo del cambio de estado',
  `cambiado_por` int(10) UNSIGNED NOT NULL COMMENT 'ID del administrador que realiz?? el cambio',
  `fecha_cambio` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'Fecha del cambio de estado',
  `observaciones` text DEFAULT NULL COMMENT 'Observaciones adicionales del cambio'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Historial de cambios de estado de solicitudes de becas';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `logs`
--

CREATE TABLE `logs` (
  `id` int(11) NOT NULL,
  `accion` varchar(100) NOT NULL,
  `tabla` varchar(100) NOT NULL,
  `registro_id` varchar(50) DEFAULT NULL,
  `datos` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`datos`)),
  `fecha_creacion` datetime DEFAULT current_timestamp(),
  `id_usuario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notificaciones_becas`
--

CREATE TABLE `notificaciones_becas` (
  `id` int(10) UNSIGNED NOT NULL,
  `usuario_id` int(10) UNSIGNED NOT NULL COMMENT 'ID del usuario que recibe la notificaci??n',
  `solicitud_beca_id` int(10) UNSIGNED DEFAULT NULL COMMENT 'ID de la solicitud de beca relacionada',
  `tipo_notificacion` enum('Solicitud_Enviada','Documento_Aprobado','Documento_Rechazado','Beca_Aprobada','Beca_Rechazada','Documento_Pendiente') NOT NULL COMMENT 'Tipo de notificaci??n',
  `titulo` varchar(255) NOT NULL COMMENT 'T??tulo de la notificaci??n',
  `mensaje` text NOT NULL COMMENT 'Mensaje de la notificaci??n',
  `leida` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'Si la notificaci??n ha sido le??da',
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'Fecha de creaci??n de la notificaci??n',
  `fecha_lectura` timestamp NULL DEFAULT NULL COMMENT 'Fecha en que se ley?? la notificaci??n'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Notificaciones relacionadas con becas';

--
-- Volcado de datos para la tabla `notificaciones_becas`
--

INSERT INTO `notificaciones_becas` (`id`, `usuario_id`, `solicitud_beca_id`, `tipo_notificacion`, `titulo`, `mensaje`, `leida`, `fecha_creacion`, `fecha_lectura`) VALUES
(1, 10, 21, 'Beca_Aprobada', 'Beca Aprobada', '', 0, '2025-08-14 04:34:05', NULL),
(2, 9, 20, 'Beca_Rechazada', 'Beca Rechazada', 'sadasd', 0, '2025-08-14 04:34:11', NULL),
(3, 3, 19, 'Beca_Aprobada', 'Beca en Lista de Espera', 'sadasdsd', 0, '2025-08-14 04:34:17', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `observaciones_fichas`
--

CREATE TABLE `observaciones_fichas` (
  `id` int(10) UNSIGNED NOT NULL,
  `ficha_id` int(10) UNSIGNED NOT NULL,
  `admin_id` int(10) UNSIGNED NOT NULL,
  `observacion` text NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Observaciones sobre fichas socioeconómicas';

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pdf_codigos_verificacion`
--

CREATE TABLE `pdf_codigos_verificacion` (
  `id` int(11) NOT NULL,
  `codigo` varchar(50) NOT NULL,
  `tipo_documento` varchar(100) NOT NULL,
  `id_documento` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `fecha_generacion` datetime DEFAULT current_timestamp(),
  `ip_generacion` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `estado` enum('activo','verificado','expirado') DEFAULT 'activo',
  `fecha_verificacion` datetime DEFAULT NULL,
  `ip_verificacion` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pdf_codigos_verificacion`
--

INSERT INTO `pdf_codigos_verificacion` (`id`, `codigo`, `tipo_documento`, `id_documento`, `id_usuario`, `fecha_generacion`, `ip_generacion`, `user_agent`, `estado`, `fecha_verificacion`, `ip_verificacion`) VALUES
(1, 'ITSI-20250820-175717-64EBB', 'ficha_socioeconomica', 29, 7, '2025-08-20 17:57:17', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:142.0) Gecko/20100101 Firefox/142.0', 'activo', NULL, NULL),
(2, 'ITSI-20250820-175719-4BB94', 'ficha_socioeconomica', 29, 7, '2025-08-20 17:57:19', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:142.0) Gecko/20100101 Firefox/142.0', 'activo', NULL, NULL),
(3, 'ITSI-20250820-180348-BD528', 'ficha_socioeconomica', 28, 7, '2025-08-20 18:04:01', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:142.0) Gecko/20100101 Firefox/142.0', 'verificado', '2025-08-20 18:04:01', '127.0.0.1'),
(4, 'ITSI-20250820-180349-ACD5D', 'ficha_socioeconomica', 28, 7, '2025-08-20 18:03:49', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:142.0) Gecko/20100101 Firefox/142.0', 'activo', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `periodos_academicos`
--

CREATE TABLE `periodos_academicos` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(50) NOT NULL COMMENT 'Ej: 2025-2026 Semestre I',
  `estado` varchar(20) DEFAULT 'Activo',
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date NOT NULL,
  `activo_fichas` tinyint(1) DEFAULT 0 COMMENT 'Indica si el período está activo para subir fichas',
  `activo_becas` tinyint(1) DEFAULT 0 COMMENT 'Indica si el período está activo para solicitar becas',
  `activo` tinyint(1) DEFAULT 1 COMMENT 'Campo de compatibilidad para mantener activo el período',
  `vigente_estudiantes` tinyint(1) DEFAULT 0 COMMENT 'Indica si el período es visible para estudiantes',
  `limite_fichas` int(10) UNSIGNED DEFAULT NULL COMMENT 'Límite de fichas socioeconómicas para este período',
  `limite_becas` int(10) UNSIGNED DEFAULT NULL COMMENT 'Límite de becas para este período',
  `fichas_creadas` int(10) UNSIGNED DEFAULT 0 COMMENT 'Contador de fichas creadas en este período',
  `becas_asignadas` int(10) UNSIGNED DEFAULT 0 COMMENT 'Contador de becas asignadas en este período',
  `descripcion` text DEFAULT NULL COMMENT 'Descripción adicional del período',
  `created_by` int(10) UNSIGNED DEFAULT NULL,
  `updated_by` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `periodos_academicos`
--

INSERT INTO `periodos_academicos` (`id`, `nombre`, `estado`, `fecha_inicio`, `fecha_fin`, `activo_fichas`, `activo_becas`, `activo`, `vigente_estudiantes`, `limite_fichas`, `limite_becas`, `fichas_creadas`, `becas_asignadas`, `descripcion`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, '2024-1', 'Activo', '2024-03-01', '2026-08-31', 1, 1, 1, 1, 3000, 3000, 1, 0, '', NULL, 7, '2025-08-15 09:19:31', '2025-08-21 01:45:28'),
(2, '2024-2', 'Activo', '2024-09-01', '2026-01-31', 1, 1, 1, 1, 100, 50, 2, 2, '', NULL, 7, '2025-08-15 09:19:31', '2025-08-21 01:42:19'),
(4, 'PERIODO 2026', 'Activo', '2025-07-30', '2026-07-31', 1, 1, 1, 1, 3000, 274, 1, 0, 'funcionando', NULL, 7, '2025-08-15 09:19:31', '2025-08-21 01:42:38'),
(5, 'PERIODO 2025', 'Activo', '2024-07-01', '2026-07-31', 1, 1, 1, 1, 3000, 3000, 1, 0, '', NULL, 7, '2025-08-15 09:19:31', '2025-08-20 23:04:18'),
(6, '2024-1', 'Activo', '2024-01-15', '2026-06-15', 1, 1, 1, 1, 1000, 200, 0, 0, 'Primer período 2024', NULL, 7, '2025-08-15 09:19:31', '2025-08-21 01:45:36'),
(7, '2024-2', 'Activo', '2024-07-15', '2026-12-15', 1, 1, 1, 1, 1000, 200, 3, 2, 'Segundo período 2024', NULL, 7, '2025-08-15 09:19:31', '2025-08-21 01:42:31'),
(10, '2024-122132131', 'Activo', '2024-01-15', '2026-06-15', 1, 1, 1, 1, 1000, 200, 0, 0, 'Primer período 2024', NULL, 7, '2025-08-15 09:19:31', '2025-08-21 01:45:43'),
(11, '2024-2', 'Activo', '2024-07-15', '2026-12-15', 1, 1, 1, 1, 1000, 200, 0, 0, 'Segundo período 2024', NULL, 7, '2025-08-15 09:19:31', '2025-08-21 01:45:07');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `respuestas_predefinidas`
--

CREATE TABLE `respuestas_predefinidas` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `categoria` varchar(50) NOT NULL,
  `contenido` text NOT NULL,
  `tags` varchar(255) DEFAULT NULL,
  `publica` tinyint(1) DEFAULT 1,
  `activa` tinyint(1) DEFAULT 1,
  `id_usuario` int(11) DEFAULT NULL,
  `fecha_creacion` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `respuestas_solicitudes_ayuda`
--

CREATE TABLE `respuestas_solicitudes_ayuda` (
  `id` int(11) NOT NULL,
  `solicitud_ayuda_id` int(11) NOT NULL,
  `respuesta` text NOT NULL,
  `fecha_respuesta` datetime DEFAULT current_timestamp(),
  `id_responsable` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `respuestas_solicitudes_ayuda`
--

INSERT INTO `respuestas_solicitudes_ayuda` (`id`, `solicitud_ayuda_id`, `respuesta`, `fecha_respuesta`, `id_responsable`) VALUES
(1, 22, 'Tu solicitud ha sido resuelta. Si tienes más preguntas...', '2025-08-20 19:37:29', 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `permisos` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`permisos`)),
  `estado` enum('Activo','Inactivo') DEFAULT 'Activo',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id`, `nombre`, `descripcion`, `permisos`, `estado`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'Acceso completo al sistema', NULL, 'Activo', '2025-08-21 04:42:14', '2025-08-21 04:42:14'),
(2, 'Admin Bienestar', 'Administrador del ßrea de bienestar', NULL, 'Activo', '2025-08-21 04:42:17', '2025-08-21 04:42:17'),
(3, 'Estudiante', 'Usuario estudiante', NULL, 'Activo', '2025-08-21 04:42:21', '2025-08-21 04:42:21'),
(4, 'Docente', 'Usuario docente', NULL, 'Activo', '2025-08-21 04:42:24', '2025-08-21 04:42:24');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitudes_ayuda`
--

CREATE TABLE `solicitudes_ayuda` (
  `id` int(10) UNSIGNED NOT NULL,
  `id_estudiante` int(10) UNSIGNED NOT NULL COMMENT 'ID del estudiante que solicita ayuda',
  `asunto` varchar(255) NOT NULL COMMENT 'Breve descripción del motivo de la solicitud',
  `categoria_id` int(11) DEFAULT NULL,
  `asunto_personalizado` text DEFAULT NULL,
  `descripcion` text NOT NULL COMMENT 'Descripción detallada de la solicitud de ayuda',
  `comentarios_resolucion` text DEFAULT NULL,
  `fecha_solicitud` datetime NOT NULL DEFAULT current_timestamp(),
  `estado` enum('Pendiente','En Proceso','Resuelta','Cerrada') NOT NULL DEFAULT 'Pendiente' COMMENT 'Estado actual de la solicitud',
  `prioridad` enum('Baja','Media','Alta','Urgente') NOT NULL DEFAULT 'Media' COMMENT 'Prioridad de la solicitud',
  `fecha_actualizacion` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `id_responsable` int(10) UNSIGNED DEFAULT NULL COMMENT 'ID del administrativo encargado de la solicitud',
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `solicitudes_ayuda`
--

INSERT INTO `solicitudes_ayuda` (`id`, `id_estudiante`, `asunto`, `categoria_id`, `asunto_personalizado`, `descripcion`, `comentarios_resolucion`, `fecha_solicitud`, `estado`, `prioridad`, `fecha_actualizacion`, `id_responsable`, `fecha_creacion`) VALUES
(2, 3, 'Apoyo psicológico', NULL, NULL, 'He estado pasando por momentos difíciles y necesito apoyo psicológico para continuar con mis estudios.', 'Prueba de respuesta rápida', '2024-10-05 11:00:00', 'Pendiente', 'Alta', '2025-08-20 14:03:26', 2, '2025-07-31 13:24:05'),
(3, 41, 'Orientación académica', NULL, NULL, 'Necesito orientación sobre mi carrera y opciones de especialización', NULL, '2024-08-05 14:30:00', 'Resuelta', 'Media', '2024-08-07 10:15:00', 44, '2025-07-31 13:24:05'),
(4, 42, 'Dificultades académicas', NULL, NULL, 'Tengo dificultades con matemáticas y necesito apoyo', NULL, '2024-08-15 16:45:00', 'Pendiente', 'Alta', '2024-08-15 16:45:00', NULL, '2025-07-31 13:24:05'),
(5, 43, 'Problemas económicos', NULL, NULL, 'Mi familia está pasando por dificultades económicas', NULL, '2024-08-10 12:20:00', 'En Proceso', 'Urgente', '2024-08-12 09:30:00', 44, '2025-07-31 13:24:05'),
(6, 3, 'Orientación académica', NULL, NULL, 'Necesito orientación sobre mi carrera y opciones de especialización', NULL, '2025-07-26 02:36:32', 'Resuelta', 'Media', '2025-07-28 02:36:32', 7, '2025-07-31 13:24:05'),
(8, 39, 'Problemas económicos', NULL, NULL, 'Mi familia está pasando por dificultades económicas', NULL, '2025-07-28 02:36:32', 'En Proceso', 'Urgente', '2025-07-29 02:36:32', 7, '2025-07-31 13:24:05'),
(10, 3, 'Problema con Beca AcadÚmica', NULL, NULL, 'No puedo acceder a mi solicitud de beca, aparece un error en el sistema', NULL, '2024-01-15 10:30:00', 'Pendiente', 'Alta', '2025-08-15 06:15:17', NULL, '2025-08-15 11:15:17'),
(11, 4, 'Consulta sobre Ficha Socioecon¾mica', NULL, NULL, 'Necesito ayuda para completar mi ficha socioecon¾mica, tengo dudas sobre algunos campos', NULL, '2024-01-16 14:20:00', 'En Proceso', 'Media', '2025-08-15 06:15:17', NULL, '2025-08-15 11:15:17'),
(12, 5, 'Error en Documentos', NULL, NULL, 'Los documentos que subÝ no aparecen en mi perfil', NULL, '2024-01-17 09:15:00', 'Pendiente', 'Urgente', '2025-08-15 06:15:17', NULL, '2025-08-15 11:15:17'),
(13, 6, 'Cambio de Carrera', NULL, NULL, 'Necesito actualizar mi informaci¾n de carrera en el sistema', NULL, '2024-01-14 16:45:00', 'Resuelta', 'Baja', '2025-08-15 06:15:17', NULL, '2025-08-15 11:15:17'),
(14, 7, 'Problema de Acceso', NULL, NULL, 'No puedo iniciar sesi¾n en el sistema, me dice que mi usuario no existe', NULL, '2024-01-18 11:00:00', 'En Proceso', 'Alta', '2025-08-15 06:15:17', NULL, '2025-08-15 11:15:17'),
(15, 8, 'Consulta sobre PerÝodos', NULL, NULL, 'Quiero saber cußndo abre el pr¾ximo perÝodo de solicitudes', NULL, '2024-01-13 13:30:00', 'Resuelta', 'Media', '2025-08-15 06:15:17', NULL, '2025-08-15 11:15:17'),
(16, 3, 'Actualizaci¾n de Datos', NULL, NULL, 'CambiÚ de direcci¾n y necesito actualizar mis datos personales', NULL, '2024-01-19 08:45:00', 'Pendiente', 'Baja', '2025-08-15 06:15:17', NULL, '2025-08-15 11:15:17'),
(17, 4, 'Problema con PDF', NULL, NULL, 'No puedo subir archivos PDF, me da error de formato', NULL, '2024-01-12 15:20:00', 'Cerrada', 'Media', '2025-08-15 06:15:17', NULL, '2025-08-15 11:15:17'),
(19, 40, 'ASDSADQWQE', 36, '', 'QWEWQEQWEWQE', NULL, '2025-08-20 18:24:20', 'Pendiente', 'Urgente', '2025-08-20 18:24:20', NULL, '2025-08-20 18:24:20'),
(20, 40, 'ASDASDSA', 41, '', 'DASDASDASDASDAS', NULL, '2025-08-20 18:24:35', 'Pendiente', 'Baja', '2025-08-20 18:24:35', NULL, '2025-08-20 18:24:35'),
(21, 40, 'SDSADAS', 39, '', 'DSADADSADASD', NULL, '2025-08-20 18:26:46', 'Pendiente', 'Urgente', '2025-08-20 18:26:46', NULL, '2025-08-20 18:26:46'),
(22, 40, 'SADSADASD', 42, 'ASDASDASDSA', 'DSADSADSADASD', 'Tu solicitud ha sido resuelta. Si tienes más preguntas...\n\nTiempo de respuesta: 1 horas', '2025-08-20 18:27:02', 'Resuelta', 'Urgente', '2025-08-20 20:24:15', 7, '2025-08-20 18:27:02'),
(24, 2, 'Necesito ayuda econ¾mica para materiales', 37, NULL, 'Mi situaci¾n econ¾mica es complicada y necesito ayuda para comprar libros y materiales de estudio para este semestre.', 'Para poder ayudarte mejor, necesito que proporciones información adicional: asdasdasdas', '2025-08-20 13:29:35', 'Pendiente', 'Media', '2025-08-20 19:15:17', 7, '2025-08-20 18:29:35'),
(25, 3, 'Problema con horario de clases', 36, NULL, 'Tengo un conflicto con el horario de mis clases de programaci¾n y necesito ayuda para reorganizarlo.', 'Para poder ayudarte mejor, necesito que proporciones información adicional: asdasdasdas', '2025-08-20 13:29:41', 'Pendiente', 'Alta', '2025-08-20 19:15:17', 7, '2025-08-20 18:29:41'),
(26, 3, 'Problema con horario de clases', 36, NULL, 'Tengo un conflicto con el horario de mis clases de programaci¾n y necesito ayuda para reorganizarlo.', 'Para poder ayudarte mejor, necesito que proporciones información adicional: asdasdasdas', '2025-08-20 13:31:53', 'Pendiente', 'Alta', '2025-08-20 19:15:17', 7, '2025-08-20 18:31:53'),
(27, 40, 'qwewqeqw', 37, '', 'eqweqwewewewqewqeqwewqeq', NULL, '2025-08-20 18:32:35', 'Cerrada', 'Media', '2025-08-20 19:44:56', NULL, '2025-08-20 18:32:35');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitudes_ayuda_mejorada`
--

CREATE TABLE `solicitudes_ayuda_mejorada` (
  `id` int(10) UNSIGNED NOT NULL,
  `estudiante_id` int(10) UNSIGNED NOT NULL,
  `tipo_solicitud` enum('Beca','Ficha','Documentos','General','Tecnico') NOT NULL DEFAULT 'General',
  `prioridad` enum('Baja','Media','Alta','Urgente') NOT NULL DEFAULT 'Media',
  `asunto` varchar(200) NOT NULL,
  `descripcion` text NOT NULL,
  `estado` enum('Abierta','En Proceso','Resuelta','Cerrada') NOT NULL DEFAULT 'Abierta',
  `asignado_a` int(10) UNSIGNED DEFAULT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp(),
  `fecha_asignacion` timestamp NULL DEFAULT NULL,
  `fecha_resolucion` timestamp NULL DEFAULT NULL,
  `tiempo_respuesta_hrs` int(10) UNSIGNED DEFAULT NULL,
  `satisfaccion_usuario` enum('1','2','3','4','5') DEFAULT NULL,
  `comentarios_resolucion` text DEFAULT NULL,
  `archivos_adjuntos` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`archivos_adjuntos`))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitudes_becas`
--

CREATE TABLE `solicitudes_becas` (
  `id` int(10) UNSIGNED NOT NULL,
  `estudiante_id` int(10) UNSIGNED NOT NULL,
  `beca_id` int(10) UNSIGNED NOT NULL,
  `periodo_id` int(10) UNSIGNED NOT NULL,
  `estado` enum('Postulada','En Revisión','Aprobada','Rechazada','Lista de Espera') NOT NULL DEFAULT 'Postulada',
  `observaciones` text DEFAULT NULL,
  `fecha_solicitud` timestamp NOT NULL DEFAULT current_timestamp(),
  `fecha_revision` timestamp NULL DEFAULT NULL COMMENT 'Fecha de revisi??n de la solicitud',
  `revisado_por` int(10) UNSIGNED DEFAULT NULL COMMENT 'ID del administrador que revis?? la solicitud',
  `motivo_rechazo` text DEFAULT NULL COMMENT 'Motivo del rechazo si es rechazada',
  `documentos_revisados` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `total_documentos` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `documento_actual_revision` int(10) UNSIGNED DEFAULT 1,
  `puede_solicitar_beca` tinyint(1) NOT NULL DEFAULT 0,
  `fecha_aprobacion` timestamp NULL DEFAULT NULL COMMENT 'Fecha de aprobaci??n de la beca',
  `fecha_rechazo` timestamp NULL DEFAULT NULL COMMENT 'Fecha de rechazo de la beca',
  `porcentaje_avance` decimal(5,2) DEFAULT 0.00 COMMENT 'Porcentaje de avance en la verificaci??n de documentos',
  `documento_actual_verificando` int(10) UNSIGNED DEFAULT NULL COMMENT 'ID del documento actual en verificaci??n',
  `fecha_actualizacion` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `actualizado_por` int(10) UNSIGNED DEFAULT NULL,
  `observaciones_admin` text DEFAULT NULL,
  `aprobado_por` int(10) UNSIGNED DEFAULT NULL,
  `rechazado_por` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `solicitudes_becas`
--

INSERT INTO `solicitudes_becas` (`id`, `estudiante_id`, `beca_id`, `periodo_id`, `estado`, `observaciones`, `fecha_solicitud`, `fecha_revision`, `revisado_por`, `motivo_rechazo`, `documentos_revisados`, `total_documentos`, `documento_actual_revision`, `puede_solicitar_beca`, `fecha_aprobacion`, `fecha_rechazo`, `porcentaje_avance`, `documento_actual_verificando`, `fecha_actualizacion`, `actualizado_por`, `observaciones_admin`, `aprobado_por`, `rechazado_por`) VALUES
(2, 3, 2, 2, 'En Revisión', 'Pendiente de revisión de documentos', '2024-09-20 19:15:00', NULL, NULL, NULL, 0, 0, 1, 0, NULL, NULL, 0.00, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 41, 1, 7, 'Aprobada', 'Beca aprobada por excelencia académica', '2024-08-10 15:00:00', NULL, NULL, NULL, 0, 0, 1, 0, NULL, NULL, 0.00, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 42, 2, 7, 'En Revisión', 'En proceso de revisión', '2024-08-12 16:20:00', NULL, NULL, NULL, 0, 0, 1, 0, NULL, NULL, 0.00, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 43, 3, 7, 'Aprobada', 'Beca deportiva aprobada', '2024-08-08 14:45:00', NULL, NULL, NULL, 0, 0, 1, 0, NULL, NULL, 0.00, NULL, NULL, NULL, NULL, NULL, NULL),
(6, 3, 1, 2, 'Aprobada', 'Beca aprobada por excelencia académica', '2025-07-28 07:36:32', NULL, NULL, NULL, 0, 0, 1, 0, NULL, NULL, 0.00, NULL, NULL, NULL, NULL, NULL, NULL),
(7, 40, 2, 2, 'En Revisión', 'En proceso de revisión', '2025-07-29 07:36:32', NULL, NULL, NULL, 0, 0, 1, 0, NULL, NULL, 0.00, NULL, NULL, NULL, NULL, NULL, NULL),
(8, 39, 3, 2, 'Aprobada', 'Beca deportiva aprobada', '2025-07-30 07:36:32', NULL, NULL, NULL, 0, 0, 1, 0, NULL, NULL, 0.00, NULL, NULL, NULL, NULL, NULL, NULL),
(9, 3, 1, 1, 'Postulada', 'Estudiante con excelente promedio acad??mico', '2025-08-14 03:42:43', NULL, NULL, NULL, 0, 0, 1, 0, NULL, NULL, 0.00, 1, NULL, NULL, NULL, NULL, NULL),
(10, 9, 2, 1, 'Postulada', 'Estudiante con necesidades econ??micas', '2025-08-14 03:42:43', NULL, NULL, NULL, 0, 0, 1, 0, NULL, NULL, 0.00, 1, NULL, NULL, NULL, NULL, NULL),
(11, 10, 3, 1, 'Postulada', 'Deportista destacado del instituto', '2025-08-14 03:42:43', NULL, NULL, NULL, 0, 0, 1, 0, NULL, NULL, 0.00, 1, NULL, NULL, NULL, NULL, NULL),
(12, 11, 1, 1, '', 'Documentos en proceso de verificaci??n', '2025-08-14 03:42:43', NULL, NULL, NULL, 0, 0, 1, 0, NULL, NULL, 33.33, 2, NULL, NULL, NULL, NULL, NULL),
(13, 12, 2, 1, '', 'Ficha socioecon??mica aprobada, verificando otros documentos', '2025-08-14 03:42:43', NULL, NULL, NULL, 0, 0, 1, 0, NULL, NULL, 66.67, 3, NULL, NULL, NULL, NULL, NULL),
(14, 13, 1, 1, 'Aprobada', 'Todos los documentos verificados y aprobados', '2025-08-14 03:42:43', NULL, NULL, NULL, 0, 0, 1, 0, NULL, NULL, 100.00, NULL, NULL, NULL, NULL, NULL, NULL),
(15, 14, 2, 1, 'Aprobada', 'Cumple todos los requisitos socioecon??micos', '2025-08-14 03:42:43', NULL, NULL, NULL, 0, 0, 1, 0, NULL, NULL, 100.00, NULL, NULL, NULL, NULL, NULL, NULL),
(16, 15, 1, 1, 'Rechazada', 'No cumple con el promedio m??nimo requerido', '2025-08-14 03:42:43', NULL, NULL, NULL, 0, 0, 1, 0, NULL, NULL, 0.00, NULL, NULL, NULL, NULL, NULL, NULL),
(17, 16, 3, 1, 'Rechazada', 'Documentos incompletos y fuera de plazo', '2025-08-14 03:42:43', NULL, NULL, NULL, 0, 0, 1, 0, NULL, NULL, 0.00, NULL, NULL, NULL, NULL, NULL, NULL),
(18, 17, 1, 1, 'Lista de Espera', 'Cumple requisitos pero cupos limitados', '2025-08-14 03:42:43', NULL, NULL, NULL, 0, 0, 1, 0, NULL, NULL, 100.00, NULL, NULL, NULL, NULL, NULL, NULL),
(19, 3, 1, 1, 'Lista de Espera', 'sadasdsd', '2025-08-14 03:43:28', '2025-08-14 04:34:17', 7, NULL, 0, 0, 1, 0, NULL, NULL, 0.00, 1, NULL, NULL, NULL, NULL, NULL),
(20, 9, 2, 1, 'Rechazada', 'Estudiante con necesidades econ??micas', '2025-08-14 03:43:28', NULL, 7, 'sadasd', 0, 0, 1, 0, NULL, '2025-08-14 04:34:11', 0.00, 1, NULL, NULL, NULL, NULL, NULL),
(21, 10, 3, 1, 'Aprobada', '', '2025-08-14 03:43:28', NULL, 7, NULL, 0, 0, 1, 0, '2025-08-14 04:34:05', NULL, 0.00, 1, NULL, NULL, NULL, NULL, NULL),
(22, 11, 1, 1, '', 'Documentos en proceso de verificaci??n', '2025-08-14 03:43:28', NULL, NULL, NULL, 0, 0, 1, 0, NULL, NULL, 33.33, 2, NULL, NULL, NULL, NULL, NULL),
(23, 12, 2, 1, '', 'Ficha socioecon??mica aprobada, verificando otros documentos', '2025-08-14 03:43:28', NULL, NULL, NULL, 0, 0, 1, 0, NULL, NULL, 66.67, 3, NULL, NULL, NULL, NULL, NULL),
(24, 13, 1, 1, 'Aprobada', 'Todos los documentos verificados y aprobados', '2025-08-14 03:43:28', NULL, NULL, NULL, 0, 0, 1, 0, NULL, NULL, 100.00, NULL, NULL, NULL, NULL, NULL, NULL),
(25, 14, 2, 1, 'Aprobada', 'Cumple todos los requisitos socioecon??micos', '2025-08-14 03:43:28', NULL, NULL, NULL, 0, 0, 1, 0, NULL, NULL, 100.00, NULL, NULL, NULL, NULL, NULL, NULL),
(26, 15, 1, 1, 'Rechazada', 'No cumple con el promedio m??nimo requerido', '2025-08-14 03:43:28', NULL, NULL, NULL, 0, 0, 1, 0, NULL, NULL, 0.00, NULL, NULL, NULL, NULL, NULL, NULL),
(27, 16, 3, 1, 'Rechazada', 'Documentos incompletos y fuera de plazo', '2025-08-14 03:43:28', NULL, NULL, NULL, 0, 0, 1, 0, NULL, NULL, 0.00, NULL, NULL, NULL, NULL, NULL, NULL),
(28, 17, 1, 1, 'Lista de Espera', 'Cumple requisitos pero cupos limitados', '2025-08-14 03:43:28', NULL, NULL, NULL, 0, 0, 1, 0, NULL, NULL, 100.00, NULL, NULL, NULL, NULL, NULL, NULL),
(29, 3, 1, 1, 'Postulada', 'Estudiante con excelente rendimiento acadÚmico', '2024-01-15 15:30:00', NULL, NULL, NULL, 0, 5, 1, 0, NULL, NULL, 0.00, NULL, NULL, NULL, NULL, NULL, NULL),
(30, 4, 2, 1, '', 'Solicitud por situaci¾n econ¾mica', '2024-01-16 19:20:00', NULL, NULL, NULL, 2, 5, 1, 0, NULL, NULL, 0.00, NULL, NULL, NULL, NULL, NULL, NULL),
(31, 5, 1, 2, 'Aprobada', 'Beca otorgada por mÚrito acadÚmico', '2024-01-17 14:15:00', NULL, NULL, NULL, 5, 5, 1, 0, NULL, NULL, 0.00, NULL, NULL, NULL, NULL, NULL, NULL),
(32, 6, 2, 2, 'Rechazada', 'Documentaci¾n incompleta', '2024-01-14 21:45:00', NULL, NULL, NULL, 3, 5, 1, 0, NULL, NULL, 0.00, NULL, NULL, NULL, NULL, NULL, NULL),
(33, 7, 1, 1, 'Lista de Espera', 'En espera de cupo disponible', '2024-01-18 16:00:00', NULL, NULL, NULL, 4, 5, 1, 0, NULL, NULL, 0.00, NULL, NULL, NULL, NULL, NULL, NULL),
(34, 8, 2, 1, 'Postulada', 'Nueva solicitud pendiente', '2024-01-13 18:30:00', NULL, NULL, NULL, 0, 5, 1, 0, NULL, NULL, 0.00, NULL, NULL, NULL, NULL, NULL, NULL),
(35, 3, 2, 2, '', 'Segunda solicitud del estudiante', '2024-01-19 13:45:00', NULL, NULL, NULL, 1, 5, 1, 0, NULL, NULL, 0.00, NULL, NULL, NULL, NULL, NULL, NULL),
(36, 4, 1, 2, 'Aprobada', 'Beca deportiva otorgada', '2024-01-12 20:20:00', NULL, NULL, NULL, 5, 5, 1, 0, NULL, NULL, 0.00, NULL, NULL, NULL, NULL, NULL, NULL),
(37, 40, 27, 5, 'Postulada', 'sadasd', '2025-08-21 05:03:13', NULL, NULL, NULL, 0, 0, 1, 1, NULL, NULL, 0.00, NULL, NULL, NULL, NULL, NULL, NULL),
(41, 40, 28, 2, 'Postulada', 'SADASDASDASDAS', '2025-08-21 05:57:04', NULL, NULL, NULL, 1, 5, 1, 1, NULL, NULL, 0.00, NULL, '2025-08-21 04:09:05', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitudes_becas_documentos`
--

CREATE TABLE `solicitudes_becas_documentos` (
  `id` int(10) UNSIGNED NOT NULL,
  `solicitud_beca_id` int(10) UNSIGNED NOT NULL COMMENT 'ID de la solicitud de beca',
  `documento_requisito_id` int(10) UNSIGNED NOT NULL COMMENT 'ID del documento requisito',
  `documento_subido_id` int(10) UNSIGNED DEFAULT NULL COMMENT 'ID del documento subido por el estudiante',
  `estado` enum('Pendiente','En Revisi??n','Aprobado','Rechazado') NOT NULL DEFAULT 'Pendiente' COMMENT 'Estado del documento',
  `fecha_revision` timestamp NULL DEFAULT NULL COMMENT 'Fecha de revisi??n del documento',
  `revisado_por` int(10) UNSIGNED DEFAULT NULL COMMENT 'ID del administrador que revis?? el documento',
  `observaciones` text DEFAULT NULL COMMENT 'Observaciones del administrador sobre el documento',
  `motivo_rechazo` text DEFAULT NULL COMMENT 'Motivo del rechazo si es rechazado',
  `orden_verificacion` int(10) UNSIGNED NOT NULL COMMENT 'Orden de verificaci??n del documento',
  `fecha_aprobacion` timestamp NULL DEFAULT NULL COMMENT 'Fecha de aprobaci??n del documento',
  `fecha_rechazo` timestamp NULL DEFAULT NULL COMMENT 'Fecha de rechazo del documento'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Seguimiento de documentos de solicitudes de becas';

--
-- Disparadores `solicitudes_becas_documentos`
--
DELIMITER $$
CREATE TRIGGER `actualizar_porcentaje_avance_beca` AFTER UPDATE ON `solicitudes_becas_documentos` FOR EACH ROW BEGIN
    DECLARE total_docs INT;
    DECLARE docs_aprobados INT;
    DECLARE nuevo_porcentaje DECIMAL(5,2);
    
    
    SELECT COUNT(*) INTO total_docs
    FROM solicitudes_becas_documentos 
    WHERE solicitud_beca_id = NEW.solicitud_beca_id;
    
    
    SELECT COUNT(*) INTO docs_aprobados
    FROM solicitudes_becas_documentos 
    WHERE solicitud_beca_id = NEW.solicitud_beca_id AND estado = 'Aprobado';
    
    
    SET nuevo_porcentaje = (docs_aprobados / total_docs) * 100;
    
    
    UPDATE solicitudes_becas 
    SET porcentaje_avance = nuevo_porcentaje
    WHERE id = NEW.solicitud_beca_id;
    
    
    IF docs_aprobados = total_docs THEN
        UPDATE solicitudes_becas 
        SET estado = 'En Revisi??n', 
            fecha_revision = CURRENT_TIMESTAMP
        WHERE id = NEW.solicitud_beca_id;
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(10) UNSIGNED NOT NULL,
  `rol_id` int(10) UNSIGNED NOT NULL,
  `carrera_id` int(10) UNSIGNED DEFAULT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `cedula` varchar(10) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `telefono` varchar(15) DEFAULT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `carrera` varchar(100) DEFAULT NULL,
  `semestre` varchar(50) DEFAULT NULL,
  `foto_perfil` varchar(255) DEFAULT NULL,
  `estado` enum('Activo','Inactivo','Suspendido') DEFAULT 'Activo',
  `ultimo_acceso` timestamp NULL DEFAULT NULL,
  `intentos_fallidos` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `bloqueado_hasta` timestamp NULL DEFAULT NULL,
  `configuraciones_usuario` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`configuraciones_usuario`)),
  `fecha_registro` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `rol_id`, `carrera_id`, `nombre`, `apellido`, `cedula`, `email`, `password_hash`, `telefono`, `direccion`, `carrera`, `semestre`, `foto_perfil`, `estado`, `ultimo_acceso`, `intentos_fallidos`, `bloqueado_hasta`, `configuraciones_usuario`, `fecha_registro`, `created_at`, `updated_at`) VALUES
(2, 2, NULL, 'Ana', 'Gomez', '0987654321', 'ana.gomez@email.com', '$2y$10$y5M8hH9E4N7U.d.kSg/Tle8N7d0Q.jA3VbE6vW6/c8uW9jW9.G6oK', '0999888777', NULL, NULL, NULL, NULL, 'Activo', NULL, 0, NULL, NULL, '2025-07-31 07:31:13', '2025-06-26 04:35:27', '2025-06-26 04:35:27'),
(3, 1, 2, 'ESTEBAN MAXIMILIANO', 'AULESTIA ANDRADE', '1005183395', 'adsadadas@fasfasf.com', '$2y$10$KgBGf8DjmRFOxd0VUM8E.u2iHNLYp6UcORsO56DxqLRQsLXhbsHIm', '0986145445', 'Miravalle - Los Olivos', 'Desarrollo de Software', '4', NULL, 'Activo', '2025-07-26 07:36:32', 0, NULL, NULL, '2025-07-31 07:31:13', '2025-06-26 05:16:51', '2025-07-31 07:36:32'),
(7, 2, NULL, 'admin', 'admin', '0001', 'test@mail.com', '$2y$10$MRTE6Ge0u6T5P.25IURdA.aBfzvtyoqZI9JtvAhLDJuHBhofPfKfG', NULL, NULL, NULL, NULL, 'user_7_1753949753.png', 'Activo', NULL, 0, NULL, NULL, '2025-07-31 07:31:13', '2025-07-07 13:22:37', '2025-07-31 08:15:53'),
(8, 4, NULL, 'superadmin', 'superAdminnnn', '0004', 'superadmin@gmail.com', '$2y$10$mAsMIO4J0aweUpPYekNi0OTmg0BqAr81mmAClzjPUhc6WYPD/wnPW', '00000333', 'lolool', 'lololol', '4', NULL, 'Activo', NULL, 0, NULL, NULL, '2025-07-31 07:31:13', '2025-07-30 01:44:09', '2025-07-30 08:37:31'),
(9, 1, NULL, 'estudiantedos', 'estudiante', '8485', 'estudiante@gmail.com', '$2y$10$TCcFZw3VprqC/4D7bhdfieVp3x9RoACmaNSPKwg0cNT8cJgtXFHqS', '12312233', 'inventado', 'inventado', '4', NULL, 'Activo', '2025-07-27 07:36:32', 0, NULL, NULL, '2025-07-31 07:31:13', '2025-07-30 03:50:50', '2025-07-31 07:36:32'),
(10, 1, NULL, 'estudiantetres', 'estudiante', '10001', 'estudiante3@example.com', '$2y$10$TCcFZw3VprqC/4D7bhdfieVp3x9RoACmaNSPKwg0cNT8cJgtXFHqS', '0980000003', 'Direccion Inventada 3', 'Carrera Inventada', '2', NULL, 'Activo', '2025-07-31 07:36:32', 0, NULL, NULL, '2025-07-31 07:31:13', '2025-07-30 03:52:33', '2025-07-31 07:36:32'),
(11, 1, NULL, 'estudiantedocuatro', 'estudiante', '10002', 'estudiante4@example.com', '$2y$10$TCcFZw3VprqC/4D7bhdfieVp3x9RoACmaNSPKwg0cNT8cJgtXFHqS', '0980000004', 'Direccion Inventada 4', 'Carrera Inventada', '1', NULL, 'Activo', '2025-07-30 07:36:32', 0, NULL, NULL, '2025-07-31 07:31:13', '2025-07-30 03:52:33', '2025-07-31 07:36:32'),
(12, 1, NULL, 'estudiantedocinco', 'estudiante', '10003', 'estudiante5@example.com', '$2y$10$TCcFZw3VprqC/4D7bhdfieVp3x9RoACmaNSPKwg0cNT8cJgtXFHqS', '0980000005', 'Direccion Inventada 5', 'Carrera Inventada', '5', NULL, 'Activo', '2025-07-25 07:36:32', 0, NULL, NULL, '2025-07-31 07:31:13', '2025-07-30 03:52:33', '2025-07-31 07:36:32'),
(13, 1, NULL, 'estudianteseis', 'estudiante', '10004', 'estudiante6@example.com', '$2y$10$TCcFZw3VprqC/4D7bhdfieVp3x9RoACmaNSPKwg0cNT8cJgtXFHqS', '0980000006', 'Direccion Inventada 6', 'Carrera Inventada', '3', NULL, 'Activo', '2025-07-31 07:36:32', 0, NULL, NULL, '2025-07-31 07:31:13', '2025-07-30 03:52:33', '2025-07-31 07:36:32'),
(14, 1, NULL, 'estudiantesiete', 'estudiante', '10005', 'estudiante7@example.com', '$2y$10$TCcFZw3VprqC/4D7bhdfieVp3x9RoACmaNSPKwg0cNT8cJgtXFHqS', '0980000007', 'Direccion Inventada 7', 'Carrera Inventada', '4', NULL, 'Activo', '2025-07-28 07:36:32', 0, NULL, NULL, '2025-07-31 07:31:13', '2025-07-30 03:52:33', '2025-07-31 07:36:32'),
(15, 1, NULL, 'estudianteocho', 'estudiante', '10006', 'estudiante8@example.com', '$2y$10$TCcFZw3VprqC/4D7bhdfieVp3x9RoACmaNSPKwg0cNT8cJgtXFHqS', '0980000008', 'Direccion Inventada 8', 'Carrera Inventada', '2', NULL, 'Activo', '2025-07-29 07:36:32', 0, NULL, NULL, '2025-07-31 07:31:13', '2025-07-30 03:52:33', '2025-07-31 07:36:32'),
(16, 1, NULL, 'estudiantenueve', 'estudiante', '10007', 'estudiante9@example.com', '$2y$10$TCcFZw3VprqC/4D7bhdfieVp3x9RoACmaNSPKwg0cNT8cJgtXFHqS', '0980000009', 'Direccion Inventada 9', 'Carrera Inventada', '1', NULL, 'Activo', '2025-07-28 07:36:32', 0, NULL, NULL, '2025-07-31 07:31:13', '2025-07-30 03:52:33', '2025-07-31 07:36:32'),
(17, 1, NULL, 'estudiantediez', 'estudiante', '10008', 'estudiante10@example.com', '$2y$10$TCcFZw3VprqC/4D7bhdfieVp3x9RoACmaNSPKwg0cNT8cJgtXFHqS', '0980000010', 'Direccion Inventada 10', 'Carrera Inventada', '6', NULL, 'Activo', '2025-07-31 07:36:32', 0, NULL, NULL, '2025-07-31 07:31:13', '2025-07-30 03:52:33', '2025-07-31 07:36:32'),
(18, 1, NULL, 'estudianteonce', 'estudiante', '10009', 'estudiante11@example.com', '$2y$10$TCcFZw3VprqC/4D7bhdfieVp3x9RoACmaNSPKwg0cNT8cJgtXFHqS', '0980000011', 'Direccion Inventada 11', 'Carrera Inventada', '5', NULL, 'Activo', '2025-07-30 07:36:32', 0, NULL, NULL, '2025-07-31 07:31:13', '2025-07-30 03:52:33', '2025-07-31 07:36:32'),
(19, 1, NULL, 'estudiantedoce', 'estudiante', '10010', 'estudiante12@example.com', '$2y$10$TCcFZw3VprqC/4D7bhdfieVp3x9RoACmaNSPKwg0cNT8cJgtXFHqS', '0980000012', 'Direccion Inventada 12', 'Carrera Inventada', '3', NULL, 'Activo', '2025-07-25 07:36:32', 0, NULL, NULL, '2025-07-31 07:31:13', '2025-07-30 03:52:33', '2025-07-31 07:36:32'),
(20, 1, NULL, 'estudiantetrece', 'estudiante', '10011', 'estudiante13@example.com', '$2y$10$TCcFZw3VprqC/4D7bhdfieVp3x9RoACmaNSPKwg0cNT8cJgtXFHqS', '0980000013', 'Direccion Inventada 13', 'Carrera Inventada', '4', NULL, 'Activo', '2025-07-31 07:36:32', 0, NULL, NULL, '2025-07-31 07:31:13', '2025-07-30 03:52:33', '2025-07-31 07:36:32'),
(21, 1, NULL, 'estudiantecatorce', 'estudiante', '10012', 'estudiante14@example.com', '$2y$10$TCcFZw3VprqC/4D7bhdfieVp3x9RoACmaNSPKwg0cNT8cJgtXFHqS', '0980000014', 'Direccion Inventada 14', 'Carrera Inventada', '2', NULL, 'Activo', NULL, 0, NULL, NULL, '2025-07-31 07:31:13', '2025-07-30 03:52:33', '2025-07-30 03:52:33'),
(22, 1, NULL, 'estudiantequince', 'estudiante', '10013', 'estudiante15@example.com', '$2y$10$TCcFZw3VprqC/4D7bhdfieVp3x9RoACmaNSPKwg0cNT8cJgtXFHqS', '0980000015', 'Direccion Inventada 15', 'Carrera Inventada', '1', NULL, 'Activo', NULL, 0, NULL, NULL, '2025-07-31 07:31:13', '2025-07-30 03:52:33', '2025-07-30 03:52:33'),
(23, 1, NULL, 'estudiantedieciseis', 'estudiante', '10014', 'estudiante16@example.com', '$2y$10$TCcFZw3VprqC/4D7bhdfieVp3x9RoACmaNSPKwg0cNT8cJgtXFHqS', '0980000016', 'Direccion Inventada 16', 'Carrera Inventada', '5', NULL, 'Activo', NULL, 0, NULL, NULL, '2025-07-31 07:31:13', '2025-07-30 03:52:33', '2025-07-30 03:52:33'),
(24, 1, NULL, 'estudiantediecisiete', 'estudiante', '10015', 'estudiante17@example.com', '$2y$10$TCcFZw3VprqC/4D7bhdfieVp3x9RoACmaNSPKwg0cNT8cJgtXFHqS', '0980000017', 'Direccion Inventada 17', 'Carrera Inventada', '3', NULL, 'Activo', NULL, 0, NULL, NULL, '2025-07-31 07:31:13', '2025-07-30 03:52:33', '2025-07-30 03:52:33'),
(25, 1, NULL, 'estudiantedieciocho', 'estudiante', '10016', 'estudiante18@example.com', '$2y$10$TCcFZw3VprqC/4D7bhdfieVp3x9RoACmaNSPKwg0cNT8cJgtXFHqS', '0980000018', 'Direccion Inventada 18', 'Carrera Inventada', '6', NULL, 'Activo', NULL, 0, NULL, NULL, '2025-07-31 07:31:13', '2025-07-30 03:52:33', '2025-07-30 03:52:33'),
(26, 1, NULL, 'estudiantediecinueve', 'estudiante', '10017', 'estudiante19@example.com', '$2y$10$TCcFZw3VprqC/4D7bhdfieVp3x9RoACmaNSPKwg0cNT8cJgtXFHqS', '0980000019', 'Direccion Inventada 19', 'Carrera Inventada', '4', NULL, 'Activo', NULL, 0, NULL, NULL, '2025-07-31 07:31:13', '2025-07-30 03:52:33', '2025-07-30 03:52:33'),
(27, 1, NULL, 'estudianteveinte', 'estudiante', '10018', 'estudiante20@example.com', '$2y$10$TCcFZw3VprqC/4D7bhdfieVp3x9RoACmaNSPKwg0cNT8cJgtXFHqS', '0980000020', 'Direccion Inventada 20', 'Carrera Inventada', '2', NULL, 'Activo', NULL, 0, NULL, NULL, '2025-07-31 07:31:13', '2025-07-30 03:52:33', '2025-07-30 03:52:33'),
(28, 1, NULL, 'estudianteveintiuno', 'estudiante', '10019', 'estudiante21@example.com', '$2y$10$TCcFZw3VprqC/4D7bhdfieVp3x9RoACmaNSPKwg0cNT8cJgtXFHqS', '0980000021', 'Direccion Inventada 21', 'Carrera Inventada', '1', NULL, 'Activo', NULL, 0, NULL, NULL, '2025-07-31 07:31:13', '2025-07-30 03:52:33', '2025-07-30 03:52:33'),
(29, 1, NULL, 'estudianteveintidos', 'estudiante', '10020', 'estudiante22@example.com', '$2y$10$TCcFZw3VprqC/4D7bhdfieVp3x9RoACmaNSPKwg0cNT8cJgtXFHqS', '0980000022', 'Direccion Inventada 22', 'Carrera Inventada', '5', NULL, 'Activo', NULL, 0, NULL, NULL, '2025-07-31 07:31:13', '2025-07-30 03:52:33', '2025-07-30 03:52:33'),
(30, 1, NULL, 'estudianteveintitres', 'estudiante', '10021', 'estudiante23@example.com', '$2y$10$TCcFZw3VprqC/4D7bhdfieVp3x9RoACmaNSPKwg0cNT8cJgtXFHqS', '0980000023', 'Direccion Inventada 23', 'Carrera Inventada', '3', NULL, 'Activo', NULL, 0, NULL, NULL, '2025-07-31 07:31:13', '2025-07-30 03:52:33', '2025-07-30 03:52:33'),
(31, 1, NULL, 'estudianteveinticuatro', 'estudiante', '10022', 'estudiante24@example.com', '$2y$10$TCcFZw3VprqC/4D7bhdfieVp3x9RoACmaNSPKwg0cNT8cJgtXFHqS', '0980000024', 'Direccion Inventada 24', 'Carrera Inventada', '4', NULL, 'Activo', NULL, 0, NULL, NULL, '2025-07-31 07:31:13', '2025-07-30 03:52:33', '2025-07-30 03:52:33'),
(32, 1, NULL, 'estudianteveinticinco', 'estudiante', '10023', 'estudiante25@example.com', '$2y$10$TCcFZw3VprqC/4D7bhdfieVp3x9RoACmaNSPKwg0cNT8cJgtXFHqS', '0980000025', 'Direccion Inventada 25', 'Carrera Inventada', '2', NULL, 'Activo', NULL, 0, NULL, NULL, '2025-07-31 07:31:13', '2025-07-30 03:52:33', '2025-07-30 03:52:33'),
(33, 1, NULL, 'estudianteveintiseis', 'estudiante', '10024', 'estudiante26@example.com', '$2y$10$TCcFZw3VprqC/4D7bhdfieVp3x9RoACmaNSPKwg0cNT8cJgtXFHqS', '0980000026', 'Direccion Inventada 26', 'Carrera Inventada', '1', NULL, 'Activo', NULL, 0, NULL, NULL, '2025-07-31 07:31:13', '2025-07-30 03:52:33', '2025-07-30 03:52:33'),
(34, 1, NULL, 'estudianteveintisiete', 'estudiante', '10025', 'estudiante27@example.com', '$2y$10$TCcFZw3VprqC/4D7bhdfieVp3x9RoACmaNSPKwg0cNT8cJgtXFHqS', '0980000027', 'Direccion Inventada 27', 'Carrera Inventada', '6', NULL, 'Activo', NULL, 0, NULL, NULL, '2025-07-31 07:31:13', '2025-07-30 03:52:33', '2025-07-30 03:52:33'),
(35, 1, NULL, 'estudianteveintiocho', 'estudiante', '10026', 'estudiante28@example.com', '$2y$10$TCcFZw3VprqC/4D7bhdfieVp3x9RoACmaNSPKwg0cNT8cJgtXFHqS', '0980000028', 'Direccion Inventada 28', 'Carrera Inventada', '5', NULL, 'Activo', NULL, 0, NULL, NULL, '2025-07-31 07:31:13', '2025-07-30 03:52:33', '2025-07-30 03:52:33'),
(37, 1, NULL, 'estudiantetreinta', 'estudiante', '10028', 'estudiante30@example.com', '$2y$10$TCcFZw3VprqC/4D7bhdfieVp3x9RoACmaNSPKwg0cNT8cJgtXFHqS', '0980000030', 'Direccion Inventada 30', 'Carrera Inventada', '4', NULL, 'Activo', NULL, 0, NULL, NULL, '2025-07-31 07:31:13', '2025-07-30 03:52:33', '2025-07-30 03:52:33'),
(38, 1, NULL, 'estudiantetreintayuno', 'estudiante', '10029', 'estudiante31@example.com', '$2y$10$TCcFZw3VprqC/4D7bhdfieVp3x9RoACmaNSPKwg0cNT8cJgtXFHqS', '0980000031', 'Direccion Inventada 31', 'Carrera Inventada', '2', NULL, 'Activo', NULL, 0, NULL, NULL, '2025-07-31 07:31:13', '2025-07-30 03:52:33', '2025-07-30 03:52:33'),
(39, 1, 2, 'estebansito', 'lolaso', '01023123', 'eareqwr@gmail.com', '$2y$10$Ht9z2A8ChR57hpHXjPtBDuK4PQ4YUawHzOv3RguKm6kHFjudlIZuG', '31241242', 'los lolos ', 'desarrollo', '4', NULL, 'Activo', NULL, 0, NULL, NULL, '2025-07-31 07:31:13', '2025-07-30 09:40:51', '2025-07-30 23:34:24'),
(40, 1, NULL, 'estudiante', 'estudiante', '0003', 'estudiante@testmail.com', '$2y$10$A2Dcln7NP57JTlzt/ZEkJuWn8mpizJMSmn6x7JgmUFN9nUIFT49Xm', '123124', 'ddsdasd', 'dsada', '3', 'user_40_1753940652.jpg', 'Activo', NULL, 0, NULL, NULL, '2025-07-31 07:31:13', '2025-07-30 04:44:38', '2025-07-31 05:44:12'),
(41, 1, 2, 'Juan', 'Pérez', '1005183396', 'juan.perez@estudiante.itsi.edu.ec', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '0986145446', 'Ibarra, Ecuador', 'Desarrollo de Software', '5', NULL, 'Activo', NULL, 0, NULL, NULL, '2025-07-31 07:31:13', '2024-01-15 15:30:00', '2025-07-31 07:04:46'),
(42, 1, 4, 'Ana', 'López', '1005183397', 'ana.lopez@estudiante.itsi.edu.ec', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '0986145447', 'Ibarra, Ecuador', 'Administración', '3', NULL, 'Activo', NULL, 0, NULL, NULL, '2025-07-31 07:31:13', '2024-02-20 16:15:00', '2025-07-31 07:04:46'),
(43, 1, 5, 'Carlos', 'Ruiz', '1005183398', 'carlos.ruiz@estudiante.itsi.edu.ec', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '0986145448', 'Ibarra, Ecuador', 'Marketing Digital y Comercio Electrónico', '7', NULL, 'Activo', NULL, 0, NULL, NULL, '2025-07-31 07:31:13', '2024-03-10 14:20:00', '2025-07-31 07:04:46'),
(44, 2, NULL, 'María', 'González', '1005183399', 'maria.gonzalez@itsi.edu.ec', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '0986145449', 'Ibarra, Ecuador', NULL, NULL, NULL, 'Activo', NULL, 0, NULL, NULL, '2025-07-31 07:31:13', '2024-01-01 13:00:00', '2025-07-31 07:04:46'),
(45, 2, NULL, 'Pedro', 'Martínez', '1005183400', 'pedro.martinez@itsi.edu.ec', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '0986145450', 'Ibarra, Ecuador', NULL, NULL, NULL, 'Activo', NULL, 0, NULL, NULL, '2025-07-31 07:31:13', '2024-01-05 13:30:00', '2025-07-31 07:04:46'),
(46, 1, 2, 'María', 'García', '1005183401', 'maria.garcia@estudiante.itsi.edu.ec', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '0986145451', 'Ibarra, Ecuador', 'Desarrollo de Software', '4', NULL, 'Activo', '2025-07-29 07:36:32', 0, NULL, NULL, '2025-07-16 07:36:32', '2025-07-31 07:36:32', '2025-07-31 07:36:32'),
(47, 1, 4, 'Luis', 'Rodríguez', '1005183402', 'luis.rodriguez@estudiante.itsi.edu.ec', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '0986145452', 'Ibarra, Ecuador', 'Administración', '6', NULL, 'Activo', '2025-07-30 07:36:32', 0, NULL, NULL, '2025-07-11 07:36:32', '2025-07-31 07:36:32', '2025-07-31 07:36:32'),
(48, 1, 5, 'Ana', 'Martínez', '1005183403', 'ana.martinez@estudiante.itsi.edu.ec', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '0986145453', 'Ibarra, Ecuador', 'Marketing Digital', '3', NULL, 'Activo', '2025-07-28 07:36:32', 0, NULL, NULL, '2025-07-06 07:36:32', '2025-07-31 07:36:32', '2025-07-31 07:36:32'),
(55, 1, 1, 'Ana', 'GarcÝa', '1234567890', 'ana.garcia@estudiante.test', 'password123', NULL, NULL, NULL, NULL, NULL, 'Activo', NULL, 0, NULL, NULL, '2025-08-20 15:54:37', '2025-08-20 15:54:37', '2025-08-20 15:54:37'),
(56, 1, 2, 'Luis', 'MartÝnez', '1234567891', 'luis.martinez@estudiante.test', 'password123', NULL, NULL, NULL, NULL, NULL, 'Activo', NULL, 0, NULL, NULL, '2025-08-20 15:54:42', '2025-08-20 15:54:42', '2025-08-20 15:54:42'),
(63, 1, 2, 'Luis', 'Martinez', '1234567801', 'luis.martinez2@estudiante.test', 'password123', NULL, NULL, NULL, NULL, NULL, 'Activo', NULL, 0, NULL, NULL, '2025-08-20 15:56:39', '2025-08-20 15:56:39', '2025-08-20 15:56:39'),
(64, 1, 3, 'Maria', 'Lopez', '1234567802', 'maria.lopez2@estudiante.test', 'password123', NULL, NULL, NULL, NULL, NULL, 'Activo', NULL, 0, NULL, NULL, '2025-08-20 15:56:39', '2025-08-20 15:56:39', '2025-08-20 15:56:39'),
(65, 1, 4, 'Pedro', 'Sanchez', '1234567803', 'pedro.sanchez2@estudiante.test', 'password123', NULL, NULL, NULL, NULL, NULL, 'Activo', NULL, 0, NULL, NULL, '2025-08-20 15:56:39', '2025-08-20 15:56:39', '2025-08-20 15:56:39'),
(66, 6, NULL, 'Super', 'Administrador', '1111111111', 'superadmin@test.com', '$2y$10$l0A/yIUJgis.QCWPX29bGei3iK9jH7E0jRHuas/bQ2VkcGiWxcZWG', NULL, NULL, NULL, NULL, NULL, 'Activo', NULL, 0, NULL, NULL, '2025-08-20 16:40:18', '2025-08-20 16:40:18', '2025-08-20 17:03:36'),
(67, 7, NULL, 'Admin', 'Talento Humano', '2222222222', 'adminth@test.com', '$2y$10$l0A/yIUJgis.QCWPX29bGei3iK9jH7E0jRHuas/bQ2VkcGiWxcZWG', NULL, NULL, NULL, NULL, NULL, 'Activo', NULL, 0, NULL, NULL, '2025-08-20 16:40:23', '2025-08-20 16:40:23', '2025-08-20 17:03:36'),
(69, 8, NULL, 'Juan', 'Pérez', '3333333333', 'docente@test.com', '$2y$10$FrJhGuYmRqJuvrerIilMweaouQcEHW5.eIUHnCQo1IfLm585sFWFu', NULL, NULL, NULL, NULL, NULL, 'Activo', NULL, 0, NULL, NULL, '2025-08-20 16:43:34', '2025-08-20 16:43:34', '2025-08-20 16:43:34'),
(70, 9, NULL, 'María', 'García', '4444444444', 'admin@test.com', '$2y$10$FrJhGuYmRqJuvrerIilMweaouQcEHW5.eIUHnCQo1IfLm585sFWFu', NULL, NULL, NULL, NULL, NULL, 'Activo', NULL, 0, NULL, NULL, '2025-08-20 16:43:34', '2025-08-20 16:43:34', '2025-08-20 16:43:34'),
(71, 10, NULL, 'Carlos', 'López', '5555555555', 'directivo@test.com', '$2y$10$FrJhGuYmRqJuvrerIilMweaouQcEHW5.eIUHnCQo1IfLm585sFWFu', NULL, NULL, NULL, NULL, NULL, 'Activo', NULL, 0, NULL, NULL, '2025-08-20 16:43:34', '2025-08-20 16:43:34', '2025-08-20 16:43:34'),
(72, 11, NULL, 'Ana', 'Martínez', '6666666666', 'auxiliar@test.com', '$2y$10$FrJhGuYmRqJuvrerIilMweaouQcEHW5.eIUHnCQo1IfLm585sFWFu', NULL, NULL, NULL, NULL, NULL, 'Activo', NULL, 0, NULL, NULL, '2025-08-20 16:43:34', '2025-08-20 16:43:34', '2025-08-20 16:43:34');

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `v_becas_completas`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `v_becas_completas` (
`id` int(10) unsigned
,`nombre` varchar(255)
,`descripcion` text
,`tipo_beca` enum('AcadÚmica','Econ¾mica','Deportiva','Cultural','Investigaci¾n','Otros')
,`monto_beca` decimal(10,2)
,`cupos_disponibles` int(10) unsigned
,`estado` enum('Activa','Inactiva','Cerrada')
,`activa` tinyint(1)
,`periodo_vigente` varchar(50)
,`fecha_inicio_vigencia` date
,`fecha_fin_vigencia` date
,`creado_por` varchar(201)
,`fecha_creacion` timestamp
,`total_solicitudes` bigint(21)
,`solicitudes_aprobadas` bigint(21)
,`solicitudes_rechazadas` bigint(21)
,`solicitudes_en_revision` bigint(21)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `v_dashboard_admin_bienestar`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `v_dashboard_admin_bienestar` (
`periodo_id` int(10) unsigned
,`periodo_nombre` varchar(50)
,`fecha_inicio` date
,`fecha_fin` date
,`limite_fichas` int(10) unsigned
,`limite_becas` int(10) unsigned
,`fichas_creadas` int(10) unsigned
,`becas_asignadas` int(10) unsigned
,`fichas_disponibles` bigint(11) unsigned
,`becas_disponibles` bigint(11) unsigned
,`estado_fichas` varchar(17)
,`estado_becas` varchar(17)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `v_estadisticas_sistema`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `v_estadisticas_sistema` (
`total_estudiantes` bigint(21)
,`total_admin_bienestar` bigint(21)
,`total_superadmin` bigint(21)
,`periodos_activos` bigint(21)
,`fichas_completadas` bigint(21)
,`becas_pendientes` bigint(21)
,`ayudas_pendientes` bigint(21)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `v_fichas_admin`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `v_fichas_admin` (
`id` int(10) unsigned
,`estado` enum('Borrador','Enviada','Revisada','Aprobada','Rechazada')
,`estudiante_id` int(10) unsigned
,`periodo_id` int(10) unsigned
,`estudiante_nombre` varchar(201)
,`nombre` varchar(100)
,`apellido` varchar(100)
,`cedula` varchar(10)
,`email` varchar(255)
,`carrera_nombre` varchar(100)
,`periodo_nombre` varchar(50)
,`fecha_creacion` timestamp
,`fecha_envio` datetime
,`json_data` longtext
,`observaciones_admin` text
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `v_fichas_socioeconomicas_completa`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `v_fichas_socioeconomicas_completa` (
`id` int(10) unsigned
,`estudiante_id` int(10) unsigned
,`periodo_id` int(10) unsigned
,`json_data` longtext
,`estado` enum('Borrador','Enviada','Revisada','Aprobada','Rechazada')
,`revisada_por_admin` tinyint(1)
,`fecha_revision_admin` datetime
,`observaciones_admin` text
,`fecha_creacion` timestamp
,`fecha_envio` datetime
,`fecha_revision` datetime
,`revisado_por` int(10) unsigned
,`puntaje_calculado` decimal(5,2)
,`estudiante_nombre` varchar(100)
,`estudiante_apellido` varchar(100)
,`estudiante_cedula` varchar(10)
,`estudiante_email` varchar(255)
,`estudiante_telefono` varchar(15)
,`carrera_nombre` varchar(100)
,`periodo_nombre` varchar(50)
,`periodo_inicio` date
,`periodo_fin` date
,`periodo_activo_fichas` tinyint(1)
,`estudiante_completo` varchar(201)
,`estado_class` varchar(9)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `v_solicitudes_becas_completas`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `v_solicitudes_becas_completas` (
`id` int(10) unsigned
,`estudiante_id` int(10) unsigned
,`nombre_estudiante` varchar(201)
,`cedula` varchar(10)
,`carrera` varchar(100)
,`nombre_beca` varchar(255)
,`tipo_beca` enum('AcadÚmica','Econ¾mica','Deportiva','Cultural','Investigaci¾n','Otros')
,`monto_beca` decimal(10,2)
,`periodo` varchar(50)
,`estado` enum('Postulada','En Revisión','Aprobada','Rechazada','Lista de Espera')
,`fecha_solicitud` timestamp
,`fecha_revision` timestamp
,`fecha_aprobacion` timestamp
,`fecha_rechazo` timestamp
,`porcentaje_avance` decimal(5,2)
,`documento_actual_verificando` int(10) unsigned
,`revisado_por` varchar(201)
,`observaciones` text
,`motivo_rechazo` text
,`total_documentos` bigint(21)
,`documentos_aprobados` bigint(21)
,`documentos_rechazados` bigint(21)
,`documentos_pendientes` bigint(21)
);

-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `v_solicitudes_becas_detallada`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `v_solicitudes_becas_detallada` (
`id` int(10) unsigned
,`estudiante_id` int(10) unsigned
,`beca_id` int(10) unsigned
,`periodo_id` int(10) unsigned
,`estado` enum('Postulada','En Revisión','Aprobada','Rechazada','Lista de Espera')
,`observaciones` text
,`fecha_solicitud` timestamp
,`fecha_revision` timestamp
,`revisado_por` int(10) unsigned
,`motivo_rechazo` text
,`documentos_revisados` int(10) unsigned
,`total_documentos` int(10) unsigned
,`estudiante_nombre` varchar(100)
,`estudiante_apellido` varchar(100)
,`estudiante_cedula` varchar(10)
,`carrera_id` int(10) unsigned
,`carrera_nombre` varchar(100)
,`beca_nombre` varchar(255)
,`tipo_beca` enum('AcadÚmica','Econ¾mica','Deportiva','Cultural','Investigaci¾n','Otros')
,`monto_beca` decimal(10,2)
,`periodo_nombre` varchar(50)
);

-- --------------------------------------------------------

--
-- Estructura para la vista `v_becas_completas`
--
DROP TABLE IF EXISTS `v_becas_completas`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_becas_completas`  AS SELECT `b`.`id` AS `id`, `b`.`nombre` AS `nombre`, `b`.`descripcion` AS `descripcion`, `b`.`tipo_beca` AS `tipo_beca`, `b`.`monto_beca` AS `monto_beca`, `b`.`cupos_disponibles` AS `cupos_disponibles`, `b`.`estado` AS `estado`, `b`.`activa` AS `activa`, `p`.`nombre` AS `periodo_vigente`, `b`.`fecha_inicio_vigencia` AS `fecha_inicio_vigencia`, `b`.`fecha_fin_vigencia` AS `fecha_fin_vigencia`, concat(`u`.`nombre`,' ',`u`.`apellido`) AS `creado_por`, `b`.`fecha_creacion` AS `fecha_creacion`, count(`sb`.`id`) AS `total_solicitudes`, count(case when `sb`.`estado` = 'Aprobada' then 1 end) AS `solicitudes_aprobadas`, count(case when `sb`.`estado` = 'Rechazada' then 1 end) AS `solicitudes_rechazadas`, count(case when `sb`.`estado` = 'En Revisi??n' then 1 end) AS `solicitudes_en_revision` FROM (((`becas` `b` left join `periodos_academicos` `p` on(`b`.`periodo_vigente_id` = `p`.`id`)) left join `usuarios` `u` on(`b`.`creado_por` = `u`.`id`)) left join `solicitudes_becas` `sb` on(`b`.`id` = `sb`.`beca_id`)) GROUP BY `b`.`id` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `v_dashboard_admin_bienestar`
--
DROP TABLE IF EXISTS `v_dashboard_admin_bienestar`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_dashboard_admin_bienestar`  AS SELECT `pa`.`id` AS `periodo_id`, `pa`.`nombre` AS `periodo_nombre`, `pa`.`fecha_inicio` AS `fecha_inicio`, `pa`.`fecha_fin` AS `fecha_fin`, `pa`.`limite_fichas` AS `limite_fichas`, `pa`.`limite_becas` AS `limite_becas`, `pa`.`fichas_creadas` AS `fichas_creadas`, `pa`.`becas_asignadas` AS `becas_asignadas`, `pa`.`limite_fichas`- `pa`.`fichas_creadas` AS `fichas_disponibles`, `pa`.`limite_becas`- `pa`.`becas_asignadas` AS `becas_disponibles`, CASE WHEN `pa`.`fichas_creadas` >= `pa`.`limite_fichas` THEN 'L??mite alcanzado' WHEN `pa`.`fichas_creadas` >= `pa`.`limite_fichas` * 0.8 THEN 'Casi lleno' ELSE 'Disponible' END AS `estado_fichas`, CASE WHEN `pa`.`becas_asignadas` >= `pa`.`limite_becas` THEN 'L??mite alcanzado' WHEN `pa`.`becas_asignadas` >= `pa`.`limite_becas` * 0.8 THEN 'Casi lleno' ELSE 'Disponible' END AS `estado_becas` FROM `periodos_academicos` AS `pa` WHERE `pa`.`activo` = 1 ORDER BY `pa`.`fecha_inicio` DESC ;

-- --------------------------------------------------------

--
-- Estructura para la vista `v_estadisticas_sistema`
--
DROP TABLE IF EXISTS `v_estadisticas_sistema`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_estadisticas_sistema`  AS SELECT (select count(0) from `usuarios` where `usuarios`.`rol_id` = 2) AS `total_estudiantes`, (select count(0) from `usuarios` where `usuarios`.`rol_id` = 3) AS `total_admin_bienestar`, (select count(0) from `usuarios` where `usuarios`.`rol_id` = 1) AS `total_superadmin`, (select count(0) from `periodos_academicos` where `periodos_academicos`.`activo` = 1) AS `periodos_activos`, (select count(0) from `fichas_socioeconomicas` where `fichas_socioeconomicas`.`estado` = 'Finalizada') AS `fichas_completadas`, (select count(0) from `solicitudes_becas` where `solicitudes_becas`.`estado` = 'Pendiente') AS `becas_pendientes`, (select count(0) from `solicitudes_ayuda_mejorada` where `solicitudes_ayuda_mejorada`.`estado` = 'Pendiente') AS `ayudas_pendientes` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `v_fichas_admin`
--
DROP TABLE IF EXISTS `v_fichas_admin`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_fichas_admin`  AS SELECT `fs`.`id` AS `id`, `fs`.`estado` AS `estado`, `fs`.`estudiante_id` AS `estudiante_id`, `fs`.`periodo_id` AS `periodo_id`, concat(`u`.`nombre`,' ',`u`.`apellido`) AS `estudiante_nombre`, `u`.`nombre` AS `nombre`, `u`.`apellido` AS `apellido`, `u`.`cedula` AS `cedula`, `u`.`email` AS `email`, coalesce(`c`.`nombre`,'Sin carrera') AS `carrera_nombre`, `p`.`nombre` AS `periodo_nombre`, `fs`.`fecha_creacion` AS `fecha_creacion`, `fs`.`fecha_envio` AS `fecha_envio`, `fs`.`json_data` AS `json_data`, `fs`.`observaciones_admin` AS `observaciones_admin` FROM (((`fichas_socioeconomicas` `fs` join `usuarios` `u` on(`u`.`id` = `fs`.`estudiante_id`)) left join `carreras` `c` on(`c`.`id` = `u`.`carrera_id`)) join `periodos_academicos` `p` on(`p`.`id` = `fs`.`periodo_id`)) WHERE `fs`.`estado` in ('Enviada','Revisada','Aprobada','Rechazada') ;

-- --------------------------------------------------------

--
-- Estructura para la vista `v_fichas_socioeconomicas_completa`
--
DROP TABLE IF EXISTS `v_fichas_socioeconomicas_completa`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_fichas_socioeconomicas_completa`  AS SELECT `fs`.`id` AS `id`, `fs`.`estudiante_id` AS `estudiante_id`, `fs`.`periodo_id` AS `periodo_id`, `fs`.`json_data` AS `json_data`, `fs`.`estado` AS `estado`, `fs`.`revisada_por_admin` AS `revisada_por_admin`, `fs`.`fecha_revision_admin` AS `fecha_revision_admin`, `fs`.`observaciones_admin` AS `observaciones_admin`, `fs`.`fecha_creacion` AS `fecha_creacion`, `fs`.`fecha_envio` AS `fecha_envio`, `fs`.`fecha_revision` AS `fecha_revision`, `fs`.`revisado_por` AS `revisado_por`, `fs`.`puntaje_calculado` AS `puntaje_calculado`, `u`.`nombre` AS `estudiante_nombre`, `u`.`apellido` AS `estudiante_apellido`, `u`.`cedula` AS `estudiante_cedula`, `u`.`email` AS `estudiante_email`, `u`.`telefono` AS `estudiante_telefono`, `c`.`nombre` AS `carrera_nombre`, `p`.`nombre` AS `periodo_nombre`, `p`.`fecha_inicio` AS `periodo_inicio`, `p`.`fecha_fin` AS `periodo_fin`, `p`.`activo_fichas` AS `periodo_activo_fichas`, concat(`u`.`nombre`,' ',`u`.`apellido`) AS `estudiante_completo`, CASE WHEN `fs`.`estado` = 'Borrador' THEN 'warning' WHEN `fs`.`estado` = 'Enviada' THEN 'info' WHEN `fs`.`estado` = 'Revisada' THEN 'primary' WHEN `fs`.`estado` = 'Aprobada' THEN 'success' WHEN `fs`.`estado` = 'Rechazada' THEN 'danger' ELSE 'secondary' END AS `estado_class` FROM (((`fichas_socioeconomicas` `fs` join `usuarios` `u` on(`u`.`id` = `fs`.`estudiante_id`)) left join `carreras` `c` on(`c`.`id` = `u`.`carrera_id`)) join `periodos_academicos` `p` on(`p`.`id` = `fs`.`periodo_id`)) ORDER BY `fs`.`fecha_creacion` DESC ;

-- --------------------------------------------------------

--
-- Estructura para la vista `v_solicitudes_becas_completas`
--
DROP TABLE IF EXISTS `v_solicitudes_becas_completas`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_solicitudes_becas_completas`  AS SELECT `sb`.`id` AS `id`, `sb`.`estudiante_id` AS `estudiante_id`, concat(`u`.`nombre`,' ',`u`.`apellido`) AS `nombre_estudiante`, `u`.`cedula` AS `cedula`, `c`.`nombre` AS `carrera`, `b`.`nombre` AS `nombre_beca`, `b`.`tipo_beca` AS `tipo_beca`, `b`.`monto_beca` AS `monto_beca`, `p`.`nombre` AS `periodo`, `sb`.`estado` AS `estado`, `sb`.`fecha_solicitud` AS `fecha_solicitud`, `sb`.`fecha_revision` AS `fecha_revision`, `sb`.`fecha_aprobacion` AS `fecha_aprobacion`, `sb`.`fecha_rechazo` AS `fecha_rechazo`, `sb`.`porcentaje_avance` AS `porcentaje_avance`, `sb`.`documento_actual_verificando` AS `documento_actual_verificando`, concat(`rev`.`nombre`,' ',`rev`.`apellido`) AS `revisado_por`, `sb`.`observaciones` AS `observaciones`, `sb`.`motivo_rechazo` AS `motivo_rechazo`, count(`sbd`.`id`) AS `total_documentos`, count(case when `sbd`.`estado` = 'Aprobado' then 1 end) AS `documentos_aprobados`, count(case when `sbd`.`estado` = 'Rechazado' then 1 end) AS `documentos_rechazados`, count(case when `sbd`.`estado` = 'Pendiente' then 1 end) AS `documentos_pendientes` FROM ((((((`solicitudes_becas` `sb` join `usuarios` `u` on(`sb`.`estudiante_id` = `u`.`id`)) join `carreras` `c` on(`u`.`carrera_id` = `c`.`id`)) join `becas` `b` on(`sb`.`beca_id` = `b`.`id`)) join `periodos_academicos` `p` on(`sb`.`periodo_id` = `p`.`id`)) left join `usuarios` `rev` on(`sb`.`revisado_por` = `rev`.`id`)) left join `solicitudes_becas_documentos` `sbd` on(`sb`.`id` = `sbd`.`solicitud_beca_id`)) GROUP BY `sb`.`id` ;

-- --------------------------------------------------------

--
-- Estructura para la vista `v_solicitudes_becas_detallada`
--
DROP TABLE IF EXISTS `v_solicitudes_becas_detallada`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_solicitudes_becas_detallada`  AS SELECT `sb`.`id` AS `id`, `sb`.`estudiante_id` AS `estudiante_id`, `sb`.`beca_id` AS `beca_id`, `sb`.`periodo_id` AS `periodo_id`, `sb`.`estado` AS `estado`, `sb`.`observaciones` AS `observaciones`, `sb`.`fecha_solicitud` AS `fecha_solicitud`, `sb`.`fecha_revision` AS `fecha_revision`, `sb`.`revisado_por` AS `revisado_por`, `sb`.`motivo_rechazo` AS `motivo_rechazo`, `sb`.`documentos_revisados` AS `documentos_revisados`, `sb`.`total_documentos` AS `total_documentos`, `u`.`nombre` AS `estudiante_nombre`, `u`.`apellido` AS `estudiante_apellido`, `u`.`cedula` AS `estudiante_cedula`, `u`.`carrera_id` AS `carrera_id`, `c`.`nombre` AS `carrera_nombre`, `b`.`nombre` AS `beca_nombre`, `b`.`tipo_beca` AS `tipo_beca`, `b`.`monto_beca` AS `monto_beca`, `pa`.`nombre` AS `periodo_nombre` FROM ((((`solicitudes_becas` `sb` join `usuarios` `u` on(`u`.`id` = `sb`.`estudiante_id`)) left join `carreras` `c` on(`c`.`id` = `u`.`carrera_id`)) join `becas` `b` on(`b`.`id` = `sb`.`beca_id`)) join `periodos_academicos` `pa` on(`pa`.`id` = `sb`.`periodo_id`)) ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `becas`
--
ALTER TABLE `becas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_becas_creado_por` (`creado_por`),
  ADD KEY `idx_becas_periodo_estado` (`periodo_vigente_id`,`estado`),
  ADD KEY `idx_becas_tipo_activa` (`tipo_beca`,`activa`);

--
-- Indices de la tabla `becas_documentos_requisitos`
--
ALTER TABLE `becas_documentos_requisitos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_beca_orden` (`beca_id`,`orden_verificacion`);

--
-- Indices de la tabla `carreras`
--
ALTER TABLE `carreras`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `codigo` (`codigo`);

--
-- Indices de la tabla `categorias_evaluacion`
--
ALTER TABLE `categorias_evaluacion`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `categorias_solicitud_ayuda`
--
ALTER TABLE `categorias_solicitud_ayuda`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `citas`
--
ALTER TABLE `citas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ticket_id` (`ticket_id`),
  ADD KEY `estudiante_id` (`estudiante_id`),
  ADD KEY `admin_id` (`admin_id`);

--
-- Indices de la tabla `competencias`
--
ALTER TABLE `competencias`
  ADD PRIMARY KEY (`id_competencia`);

--
-- Indices de la tabla `documentos`
--
ALTER TABLE `documentos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`),
  ADD KEY `ficha_id` (`ficha_id`),
  ADD KEY `solicitud_beca_id` (`solicitud_beca_id`);

--
-- Indices de la tabla `documentos_solicitud_becas`
--
ALTER TABLE `documentos_solicitud_becas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_solicitud_beca` (`solicitud_beca_id`),
  ADD KEY `idx_documento_requerido` (`documento_requerido_id`),
  ADD KEY `idx_estado` (`estado`),
  ADD KEY `idx_orden_revision` (`orden_revision`),
  ADD KEY `idx_revisado_por` (`revisado_por`),
  ADD KEY `idx_documentos_solicitud_beca_id` (`solicitud_beca_id`),
  ADD KEY `idx_documentos_estado` (`estado`);

--
-- Indices de la tabla `estudiantes_habilitacion_becas`
--
ALTER TABLE `estudiantes_habilitacion_becas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `idx_estudiante_periodo` (`estudiante_id`,`periodo_id`),
  ADD KEY `idx_puede_solicitar` (`puede_solicitar_becas`),
  ADD KEY `idx_ficha_completada` (`ficha_completada`),
  ADD KEY `idx_habilitado_por` (`habilitado_por`),
  ADD KEY `fk_hab_periodo` (`periodo_id`);

--
-- Indices de la tabla `fichas_becas_relacion`
--
ALTER TABLE `fichas_becas_relacion`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `ficha_id` (`ficha_id`),
  ADD KEY `solicitud_beca_id` (`solicitud_beca_id`),
  ADD KEY `idx_fichas_tipo_relacion` (`tipo_relacion`);

--
-- Indices de la tabla `fichas_socioeconomicas`
--
ALTER TABLE `fichas_socioeconomicas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `estudiante_id` (`estudiante_id`,`periodo_id`),
  ADD KEY `idx_fichas_estado` (`estado`),
  ADD KEY `idx_fichas_periodo` (`periodo_id`),
  ADD KEY `idx_fichas_estudiante` (`estudiante_id`),
  ADD KEY `idx_fichas_estado_periodo` (`estado`,`periodo_id`),
  ADD KEY `idx_fichas_estudiante_periodo` (`estudiante_id`,`periodo_id`);

--
-- Indices de la tabla `flujo_aprobacion_documentos`
--
ALTER TABLE `flujo_aprobacion_documentos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_solicitud_flujo` (`solicitud_beca_id`),
  ADD KEY `idx_documento_flujo` (`documento_id`),
  ADD KEY `idx_admin_flujo` (`admin_id`),
  ADD KEY `idx_fecha_accion` (`fecha_accion`);

--
-- Indices de la tabla `historial_estados_becas`
--
ALTER TABLE `historial_estados_becas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_solicitud_fecha` (`solicitud_beca_id`,`fecha_cambio`),
  ADD KEY `idx_cambiado_por` (`cambiado_por`);

--
-- Indices de la tabla `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `notificaciones_becas`
--
ALTER TABLE `notificaciones_becas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_usuario_leida` (`usuario_id`,`leida`),
  ADD KEY `idx_tipo_fecha` (`tipo_notificacion`,`fecha_creacion`),
  ADD KEY `fk_notificacion_solicitud` (`solicitud_beca_id`),
  ADD KEY `idx_notificaciones_usuario_tipo` (`usuario_id`,`tipo_notificacion`);

--
-- Indices de la tabla `observaciones_fichas`
--
ALTER TABLE `observaciones_fichas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_ficha_id` (`ficha_id`),
  ADD KEY `idx_admin_id` (`admin_id`),
  ADD KEY `idx_fecha_creacion` (`fecha_creacion`);

--
-- Indices de la tabla `pdf_codigos_verificacion`
--
ALTER TABLE `pdf_codigos_verificacion`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `codigo` (`codigo`),
  ADD KEY `idx_codigo` (`codigo`),
  ADD KEY `idx_tipo_documento` (`tipo_documento`),
  ADD KEY `idx_fecha_generacion` (`fecha_generacion`);

--
-- Indices de la tabla `periodos_academicos`
--
ALTER TABLE `periodos_academicos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_periodos_activo` (`activo`),
  ADD KEY `idx_periodos_fechas` (`fecha_inicio`,`fecha_fin`);

--
-- Indices de la tabla `respuestas_predefinidas`
--
ALTER TABLE `respuestas_predefinidas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `respuestas_solicitudes_ayuda`
--
ALTER TABLE `respuestas_solicitudes_ayuda`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `solicitudes_ayuda`
--
ALTER TABLE `solicitudes_ayuda`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_solicitud_estudiante` (`id_estudiante`),
  ADD KEY `fk_solicitud_responsable` (`id_responsable`),
  ADD KEY `categoria_id` (`categoria_id`);

--
-- Indices de la tabla `solicitudes_ayuda_mejorada`
--
ALTER TABLE `solicitudes_ayuda_mejorada`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_estudiante_ayuda` (`estudiante_id`),
  ADD KEY `idx_tipo_solicitud` (`tipo_solicitud`),
  ADD KEY `idx_estado_ayuda` (`estado`),
  ADD KEY `idx_prioridad` (`prioridad`),
  ADD KEY `idx_asignado_a` (`asignado_a`),
  ADD KEY `idx_fecha_creacion` (`fecha_creacion`);

--
-- Indices de la tabla `solicitudes_becas`
--
ALTER TABLE `solicitudes_becas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `estudiante_id` (`estudiante_id`),
  ADD KEY `beca_id` (`beca_id`),
  ADD KEY `periodo_id` (`periodo_id`),
  ADD KEY `fk_solicitud_revisado_por` (`revisado_por`),
  ADD KEY `idx_solicitudes_estudiante_periodo` (`estudiante_id`,`periodo_id`),
  ADD KEY `idx_solicitudes_estado_fecha` (`estado`,`fecha_solicitud`),
  ADD KEY `idx_solicitudes_becas_estudiante_periodo` (`estudiante_id`,`periodo_id`),
  ADD KEY `idx_solicitudes_becas_estado` (`estado`),
  ADD KEY `idx_solicitudes_becas_fecha` (`fecha_solicitud`);

--
-- Indices de la tabla `solicitudes_becas_documentos`
--
ALTER TABLE `solicitudes_becas_documentos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_solicitud_orden` (`solicitud_beca_id`,`orden_verificacion`),
  ADD KEY `idx_estado_documento` (`estado`,`documento_requisito_id`),
  ADD KEY `fk_solicitud_doc_requisito` (`documento_requisito_id`),
  ADD KEY `fk_solicitud_doc_subido` (`documento_subido_id`),
  ADD KEY `fk_solicitud_doc_revisado_por` (`revisado_por`),
  ADD KEY `idx_documentos_solicitud_orden` (`solicitud_beca_id`,`orden_verificacion`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cedula` (`cedula`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `rol_id` (`rol_id`),
  ADD KEY `idx_usuarios_carrera` (`carrera_id`),
  ADD KEY `idx_usuarios_nombre_apellido` (`nombre`,`apellido`),
  ADD KEY `idx_usuarios_cedula` (`cedula`),
  ADD KEY `idx_usuarios_estado` (`estado`),
  ADD KEY `idx_usuarios_ultimo_acceso` (`ultimo_acceso`),
  ADD KEY `idx_usuarios_fecha_registro` (`fecha_registro`),
  ADD KEY `idx_intentos_fallidos` (`intentos_fallidos`),
  ADD KEY `idx_bloqueado_hasta` (`bloqueado_hasta`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `becas`
--
ALTER TABLE `becas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de la tabla `becas_documentos_requisitos`
--
ALTER TABLE `becas_documentos_requisitos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT de la tabla `carreras`
--
ALTER TABLE `carreras`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `categorias_evaluacion`
--
ALTER TABLE `categorias_evaluacion`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `categorias_solicitud_ayuda`
--
ALTER TABLE `categorias_solicitud_ayuda`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT de la tabla `citas`
--
ALTER TABLE `citas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `competencias`
--
ALTER TABLE `competencias`
  MODIFY `id_competencia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `documentos`
--
ALTER TABLE `documentos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `documentos_solicitud_becas`
--
ALTER TABLE `documentos_solicitud_becas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `estudiantes_habilitacion_becas`
--
ALTER TABLE `estudiantes_habilitacion_becas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `fichas_becas_relacion`
--
ALTER TABLE `fichas_becas_relacion`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `fichas_socioeconomicas`
--
ALTER TABLE `fichas_socioeconomicas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de la tabla `flujo_aprobacion_documentos`
--
ALTER TABLE `flujo_aprobacion_documentos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `historial_estados_becas`
--
ALTER TABLE `historial_estados_becas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `notificaciones_becas`
--
ALTER TABLE `notificaciones_becas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `observaciones_fichas`
--
ALTER TABLE `observaciones_fichas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pdf_codigos_verificacion`
--
ALTER TABLE `pdf_codigos_verificacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `periodos_academicos`
--
ALTER TABLE `periodos_academicos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `respuestas_predefinidas`
--
ALTER TABLE `respuestas_predefinidas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `respuestas_solicitudes_ayuda`
--
ALTER TABLE `respuestas_solicitudes_ayuda`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `solicitudes_ayuda`
--
ALTER TABLE `solicitudes_ayuda`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de la tabla `solicitudes_ayuda_mejorada`
--
ALTER TABLE `solicitudes_ayuda_mejorada`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `solicitudes_becas`
--
ALTER TABLE `solicitudes_becas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT de la tabla `solicitudes_becas_documentos`
--
ALTER TABLE `solicitudes_becas_documentos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `becas`
--
ALTER TABLE `becas`
  ADD CONSTRAINT `fk_becas_creado_por` FOREIGN KEY (`creado_por`) REFERENCES `usuarios` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_becas_periodo` FOREIGN KEY (`periodo_vigente_id`) REFERENCES `periodos_academicos` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `becas_documentos_requisitos`
--
ALTER TABLE `becas_documentos_requisitos`
  ADD CONSTRAINT `fk_requisito_beca` FOREIGN KEY (`beca_id`) REFERENCES `becas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `documentos`
--
ALTER TABLE `documentos`
  ADD CONSTRAINT `documentos_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `documentos_ibfk_2` FOREIGN KEY (`ficha_id`) REFERENCES `fichas_socioeconomicas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `documentos_ibfk_3` FOREIGN KEY (`solicitud_beca_id`) REFERENCES `solicitudes_becas` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `documentos_solicitud_becas`
--
ALTER TABLE `documentos_solicitud_becas`
  ADD CONSTRAINT `fk_doc_requerido` FOREIGN KEY (`documento_requerido_id`) REFERENCES `becas_documentos_requisitos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_doc_revisado_por` FOREIGN KEY (`revisado_por`) REFERENCES `usuarios` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk_doc_solicitud_beca` FOREIGN KEY (`solicitud_beca_id`) REFERENCES `solicitudes_becas` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `estudiantes_habilitacion_becas`
--
ALTER TABLE `estudiantes_habilitacion_becas`
  ADD CONSTRAINT `fk_hab_estudiante` FOREIGN KEY (`estudiante_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_hab_habilitado_por` FOREIGN KEY (`habilitado_por`) REFERENCES `usuarios` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk_hab_periodo` FOREIGN KEY (`periodo_id`) REFERENCES `periodos_academicos` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `flujo_aprobacion_documentos`
--
ALTER TABLE `flujo_aprobacion_documentos`
  ADD CONSTRAINT `fk_flujo_admin` FOREIGN KEY (`admin_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_flujo_documento` FOREIGN KEY (`documento_id`) REFERENCES `documentos_solicitud_becas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_flujo_solicitud` FOREIGN KEY (`solicitud_beca_id`) REFERENCES `solicitudes_becas` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `historial_estados_becas`
--
ALTER TABLE `historial_estados_becas`
  ADD CONSTRAINT `fk_historial_cambiado_por` FOREIGN KEY (`cambiado_por`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_historial_solicitud` FOREIGN KEY (`solicitud_beca_id`) REFERENCES `solicitudes_becas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `notificaciones_becas`
--
ALTER TABLE `notificaciones_becas`
  ADD CONSTRAINT `fk_notificacion_solicitud` FOREIGN KEY (`solicitud_beca_id`) REFERENCES `solicitudes_becas` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_notificacion_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `observaciones_fichas`
--
ALTER TABLE `observaciones_fichas`
  ADD CONSTRAINT `observaciones_fichas_ibfk_1` FOREIGN KEY (`ficha_id`) REFERENCES `fichas_socioeconomicas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `observaciones_fichas_ibfk_2` FOREIGN KEY (`admin_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `solicitudes_ayuda`
--
ALTER TABLE `solicitudes_ayuda`
  ADD CONSTRAINT `solicitudes_ayuda_ibfk_1` FOREIGN KEY (`categoria_id`) REFERENCES `categorias_solicitud_ayuda` (`id`);

--
-- Filtros para la tabla `solicitudes_ayuda_mejorada`
--
ALTER TABLE `solicitudes_ayuda_mejorada`
  ADD CONSTRAINT `fk_ayuda_asignado` FOREIGN KEY (`asignado_a`) REFERENCES `usuarios` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk_ayuda_estudiante` FOREIGN KEY (`estudiante_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `solicitudes_becas`
--
ALTER TABLE `solicitudes_becas`
  ADD CONSTRAINT `fk_solicitud_revisado_por` FOREIGN KEY (`revisado_por`) REFERENCES `usuarios` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `solicitudes_becas_documentos`
--
ALTER TABLE `solicitudes_becas_documentos`
  ADD CONSTRAINT `fk_solicitud_doc_requisito` FOREIGN KEY (`documento_requisito_id`) REFERENCES `becas_documentos_requisitos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_solicitud_doc_revisado_por` FOREIGN KEY (`revisado_por`) REFERENCES `usuarios` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_solicitud_doc_solicitud` FOREIGN KEY (`solicitud_beca_id`) REFERENCES `solicitudes_becas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_solicitud_doc_subido` FOREIGN KEY (`documento_subido_id`) REFERENCES `documentos` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
