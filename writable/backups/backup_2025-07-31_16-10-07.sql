-- MariaDB dump 10.19  Distrib 10.4.32-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: bienestar_estudiantil_db
-- ------------------------------------------------------
-- Server version	10.4.32-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `becas`
--

DROP TABLE IF EXISTS `becas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `becas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `requisitos` text DEFAULT NULL COMMENT 'Descripción de los requisitos generales',
  `puntaje_minimo_requerido` decimal(5,2) DEFAULT NULL COMMENT 'Ejemplo de requisito verificable por el sistema',
  `activa` tinyint(1) DEFAULT 1,
  `nombre_beca` varchar(255) GENERATED ALWAYS AS (`nombre`) STORED,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `becas`
--

LOCK TABLES `becas` WRITE;
/*!40000 ALTER TABLE `becas` DISABLE KEYS */;
INSERT INTO `becas` VALUES (1,'Beca Excelencia Académica','Beca para estudiantes con excelente rendimiento académico','Promedio mínimo de 9.0, sin materias reprobadas',9.00,1,'Beca Excelencia Académica'),(2,'Beca Socioeconómica','Beca para estudiantes con necesidades económicas','Ficha socioeconómica aprobada, promedio mínimo de 7.5',7.50,1,'Beca Socioeconómica'),(3,'Beca Deportiva','Beca para deportistas destacados','Participación activa en equipos deportivos, promedio mínimo de 7.0',7.00,1,'Beca Deportiva'),(4,'Beca Cultural','Beca para estudiantes con talentos culturales','Participación en actividades culturales, promedio mínimo de 7.0',7.00,1,'Beca Cultural');
/*!40000 ALTER TABLE `becas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `carreras`
--

DROP TABLE IF EXISTS `carreras`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `carreras` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `codigo` varchar(50) NOT NULL,
  `semestres` int(2) NOT NULL DEFAULT 5,
  `activa` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `codigo` (`codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `carreras`
--

LOCK TABLES `carreras` WRITE;
/*!40000 ALTER TABLE `carreras` DISABLE KEYS */;
INSERT INTO `carreras` VALUES (1,'Atención Integral Adultos Mayores','atencion-integral-adultos-mayores',5,1,'2025-07-30 23:34:24'),(2,'Desarrollo de Software','desarrollo-de-software',5,1,'2025-07-30 23:34:24'),(3,'Diseño Gráfico','diseno-grafico',5,1,'2025-07-30 23:34:24'),(4,'Administración','administracion',5,1,'2025-07-30 23:34:24'),(5,'Marketing Digital y Comercio Electrónico','marketing-digital-comercio-electronico',5,1,'2025-07-30 23:34:24'),(6,'Redes y Telecomunicaciones','redes-telecomunicaciones',5,1,'2025-07-30 23:34:24'),(7,'Desarrollo y Análisis de Software (Virtual)','desarrollo-analisis-software-virtual',5,1,'2025-07-30 23:34:24'),(8,'Ingeniería Informática','ingenieria-informatica',5,1,'2025-07-31 06:59:52'),(9,'Ingeniería Industrial','ingenieria-industrial',5,1,'2025-07-31 06:59:52'),(10,'Contabilidad','contabilidad',5,1,'2025-07-31 06:59:52'),(11,'Marketing','marketing',5,1,'2025-07-31 06:59:52');
/*!40000 ALTER TABLE `carreras` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `citas`
--

DROP TABLE IF EXISTS `citas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `citas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ticket_id` int(10) unsigned DEFAULT NULL,
  `estudiante_id` int(10) unsigned NOT NULL,
  `admin_id` int(10) unsigned NOT NULL,
  `asunto` varchar(255) NOT NULL,
  `fecha_hora` datetime NOT NULL,
  `lugar_o_enlace` varchar(255) NOT NULL,
  `estado` enum('Programada','Completada','Cancelada') NOT NULL DEFAULT 'Programada',
  PRIMARY KEY (`id`),
  KEY `ticket_id` (`ticket_id`),
  KEY `estudiante_id` (`estudiante_id`),
  KEY `admin_id` (`admin_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `citas`
--

LOCK TABLES `citas` WRITE;
/*!40000 ALTER TABLE `citas` DISABLE KEYS */;
INSERT INTO `citas` VALUES (2,2,3,2,'Asesoría sobre ficha socioeconómica','2024-10-17 14:00:00','Oficina de Bienestar - Sala 1','Programada');
/*!40000 ALTER TABLE `citas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `configuracion_sistema`
--

DROP TABLE IF EXISTS `configuracion_sistema`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `configuracion_sistema` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `clave` varchar(100) NOT NULL,
  `valor` text NOT NULL,
  `descripcion` text DEFAULT NULL,
  `tipo` enum('string','integer','boolean','json') DEFAULT 'string',
  `categoria` varchar(50) DEFAULT 'general',
  `fecha_actualizacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `clave` (`clave`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `configuracion_sistema`
--

LOCK TABLES `configuracion_sistema` WRITE;
/*!40000 ALTER TABLE `configuracion_sistema` DISABLE KEYS */;
INSERT INTO `configuracion_sistema` VALUES (1,'sistema_nombre','Sistema de Bienestar Estudiantil','Nombre del sistema','string','general','2025-07-31 07:31:13'),(2,'sistema_version','1.0.0','Versión del sistema','string','general','2025-07-31 07:31:13'),(3,'backup_automatico','true','Habilitar respaldos automáticos','boolean','backup','2025-07-31 07:31:13'),(4,'backup_frecuencia','daily','Frecuencia de respaldos automáticos','string','backup','2025-07-31 07:31:13'),(5,'backup_retener_dias','30','Días a retener respaldos','integer','backup','2025-07-31 07:31:13'),(6,'logs_retener_dias','90','Días a retener logs','integer','logs','2025-07-31 07:31:13'),(7,'usuarios_activos_dias','30','Días para considerar usuario activo','integer','usuarios','2025-07-31 07:31:13');
/*!40000 ALTER TABLE `configuracion_sistema` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `documentos`
--

DROP TABLE IF EXISTS `documentos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `documentos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `usuario_id` int(10) unsigned NOT NULL COMMENT 'El usuario que sube el documento',
  `ficha_id` int(10) unsigned DEFAULT NULL COMMENT 'Asociado a una ficha socioeconómica',
  `solicitud_beca_id` int(10) unsigned DEFAULT NULL COMMENT 'Asociado a una solicitud de beca',
  `tipo_documento` varchar(255) DEFAULT NULL COMMENT 'Describe el requisito. Ej: Cédula, Certificado de Notas.',
  `nombre_archivo` varchar(255) NOT NULL,
  `path_archivo` varchar(255) NOT NULL,
  `tipo_mime` varchar(100) NOT NULL,
  `tamano_kb` int(10) unsigned NOT NULL,
  `fecha_subida` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `usuario_id` (`usuario_id`),
  KEY `ficha_id` (`ficha_id`),
  KEY `solicitud_beca_id` (`solicitud_beca_id`),
  CONSTRAINT `documentos_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE,
  CONSTRAINT `documentos_ibfk_2` FOREIGN KEY (`ficha_id`) REFERENCES `fichas_socioeconomicas` (`id`) ON DELETE CASCADE,
  CONSTRAINT `documentos_ibfk_3` FOREIGN KEY (`solicitud_beca_id`) REFERENCES `solicitudes_becas` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `documentos`
--

LOCK TABLES `documentos` WRITE;
/*!40000 ALTER TABLE `documentos` DISABLE KEYS */;
INSERT INTO `documentos` VALUES (3,3,2,NULL,'Cédula de Identidad','cedula_ana_martinez.pdf','uploads/documentos/cedula_ana_martinez.pdf','application/pdf',230,'2024-09-20 19:00:00');
/*!40000 ALTER TABLE `documentos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fichas_becas_relacion`
--

DROP TABLE IF EXISTS `fichas_becas_relacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fichas_becas_relacion` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ficha_id` int(10) unsigned NOT NULL,
  `solicitud_beca_id` int(10) unsigned DEFAULT NULL,
  `tipo_relacion` enum('Solicitando','Becado','Sin_Beca') NOT NULL DEFAULT 'Sin_Beca',
  `observaciones` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `ficha_id` (`ficha_id`),
  KEY `solicitud_beca_id` (`solicitud_beca_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fichas_becas_relacion`
--

LOCK TABLES `fichas_becas_relacion` WRITE;
/*!40000 ALTER TABLE `fichas_becas_relacion` DISABLE KEYS */;
INSERT INTO `fichas_becas_relacion` VALUES (1,2,2,'Solicitando',NULL,'2025-07-30 23:34:24'),(2,3,NULL,'Sin_Beca',NULL,'2025-07-30 23:34:24'),(3,4,NULL,'Sin_Beca',NULL,'2025-07-30 23:34:24');
/*!40000 ALTER TABLE `fichas_becas_relacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fichas_socioeconomicas`
--

DROP TABLE IF EXISTS `fichas_socioeconomicas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fichas_socioeconomicas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `estudiante_id` int(10) unsigned NOT NULL,
  `periodo_id` int(10) unsigned NOT NULL,
  `json_data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL COMMENT 'Campo flexible para almacenar toda la data de la ficha en formato JSON' CHECK (json_valid(`json_data`)),
  `estado` enum('Borrador','Enviada','Revisada','Aprobada','Rechazada') NOT NULL DEFAULT 'Borrador',
  `revisada_por_admin` tinyint(1) DEFAULT 0,
  `fecha_revision_admin` datetime DEFAULT NULL,
  `observaciones_admin` text DEFAULT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp(),
  `fecha_envio` datetime DEFAULT NULL,
  `fecha_revision` datetime DEFAULT NULL,
  `revisado_por` int(10) unsigned DEFAULT NULL COMMENT 'ID del admin que revisó la ficha',
  PRIMARY KEY (`id`),
  UNIQUE KEY `estudiante_id` (`estudiante_id`,`periodo_id`),
  KEY `idx_fichas_estado` (`estado`),
  KEY `idx_fichas_periodo` (`periodo_id`),
  KEY `idx_fichas_estudiante` (`estudiante_id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fichas_socioeconomicas`
--

LOCK TABLES `fichas_socioeconomicas` WRITE;
/*!40000 ALTER TABLE `fichas_socioeconomicas` DISABLE KEYS */;
INSERT INTO `fichas_socioeconomicas` VALUES (2,3,2,'{\"ingresos_familiares\": 800, \"miembros_familia\": 6, \"vivienda\": \"alquilada\", \"estudios_padres\": \"primaria\"}','Aprobada',1,'2025-07-31 15:47:48','','2024-09-15 15:00:00','2024-09-20 14:00:00',NULL,NULL),(3,40,1,'{\"test\":\"Ficha de prueba\",\"fecha_creacion\":\"2025-07-30 20:06:56\"}','Rechazada',1,'2025-07-31 15:38:58','','2025-07-31 01:06:56','2025-07-30 22:14:28',NULL,NULL),(4,40,2,'{\"apellidos_nombres\":\"estudiante estudiante\",\"nacionalidad\":\"Ecuatoriana\",\"cedula\":\"0003\",\"lugar_nacimiento\":\"Otavalo 11\\/09\\/2002\",\"edad\":[\"3\",\"3\"],\"estado_civil\":[\"Soltero\\/a\",\"Soltero\\/a\"],\"ciudad\":\"Otavalo\",\"barrio\":\"Miravallle\",\"calle_principal\":\"miravalle\",\"calle_secundaria\":\"los olivos\",\"etnia\":\"Blanco\",\"trabaja\":\"NO\",\"telefono_domicilio\":\"2134324\",\"celular\":\"123124\",\"email\":\"estudiante@testmail.com\",\"vive_con\":\"Solo Mama\",\"padres_separados\":\"SI\",\"nombre_apellido\":[\"ewrwerr\",\"qweqweq\"],\"parentesco\":[\"rewrwe\",\"ewqeqweqwe\"],\"ocupacion\":[\"wrewrwer\",\"ewqeqw\"],\"institucion\":[\"rewrw\",\"ewqewq\"],\"ingresos\":[\"3333\",\"2121212\"],\"observaciones\":[\"sdfdsfsdf\",\"sdasdasdsa\"],\"total_ingresos_familiares\":\"1000\",\"total_gastos_familiares\":\"500\",\"diferencia_ingresos_egresos\":\"500.00\",\"tipo_vivienda\":\"Propia\",\"condicion_vivienda\":\"Excelente\",\"numero_habitaciones\":\"2\",\"registra_prestamos\":\"NO\",\"monto_prestamos\":\"\",\"institucion_prestamista\":\"\",\"enfermedad_grave\":\"NO\",\"familiar_emigrante\":\"SI\",\"tipo_enfermedad\":\"\",\"familiar_afectado\":\"\",\"quien_emigrante\":[\"Padre\",\"Madre\",\"Hermano\",\"Otro\"],\"pais_destino\":\"veneco\",\"comentarios_estudiante\":\"12aerasdfas\",\"datos_familia\":[{\"nombre_apellido\":\"ewrwerr\",\"parentesco\":\"rewrwe\",\"edad\":\"3\",\"estado_civil\":\"Soltero\\/a\",\"ocupacion\":\"wrewrwer\",\"institucion\":\"rewrw\",\"ingresos\":\"3333\",\"observaciones\":\"sdfdsfsdf\"},{\"nombre_apellido\":\"qweqweq\",\"parentesco\":\"ewqeqweqwe\",\"edad\":\"3\",\"estado_civil\":\"Soltero\\/a\",\"ocupacion\":\"ewqeqw\",\"institucion\":\"ewqewq\",\"ingresos\":\"2121212\",\"observaciones\":\"sdasdasdsa\"}],\"servicios_basicos\":[],\"tipo_cuentas\":[]}','Aprobada',1,'2025-07-30 18:34:24',NULL,'2025-07-31 03:20:09','2025-07-30 23:02:26',NULL,NULL),(15,40,4,'{\"apellidos_nombres\":\"estudiante estudiante\",\"nacionalidad\":\"Ecuatoriana\",\"cedula\":\"0003\",\"lugar_nacimiento\":\"Otavalo 11\\/09\\/2002\",\"edad\":\"123\",\"estado_civil\":\"Soltero\\/a\",\"ciudad\":\"Otavalo\",\"barrio\":\"Miravallle\",\"calle_principal\":\"miravalle\",\"calle_secundaria\":\"los olivos\",\"etnia\":\"Blanco\",\"trabaja\":\"NO\",\"lugar_trabajo\":\"sadasdas\",\"sueldo_mensual\":\"223\",\"tiempo_servicios\":\"\",\"cargo\":\"\",\"telefono_domicilio\":\"2134324\",\"telefono_trabajo\":\"1231231\",\"celular\":\"123124\",\"email\":\"estudiante@testmail.com\",\"vive_con\":\"Solo Papa\",\"padres_separados\":\"SI\",\"colegio_graduacion\":\"asdasdas\",\"ciudad_colegio\":\"Otavalo\",\"provincia_colegio\":\"imbabura\",\"tipo_colegio\":\"Fiscal\",\"anio_grado\":\"2020\",\"carrera\":\"dsada\",\"nivel_ingresa\":\"cuarto\",\"modalidad\":\"presencial\",\"estudia_otra_carrera\":\"NO\",\"institucion_otra_carrera\":\"\",\"forma_pago\":\"Al Contado\",\"especificar_pago\":\"\",\"toma_ingles\":\"SI\",\"modalidad_ingles\":\"virtual\",\"nivel_ingles\":\"A2\",\"apellidos_nombres_dependiente\":\"sadsadasdas\",\"cedula_dependiente\":\"123213\",\"parentesco\":\"madre\",\"ciudad_dependiente\":\"Otavalo\",\"barrio_dependiente\":\"miravalle\",\"parroquia_dependiente\":\"jordaan\",\"calle_principal_dependiente\":\"sldaso\",\"calle_secundaria_dependiente\":\"qwewqe\",\"profesion_dependiente\":\"judicatura\",\"trabaja_dependiente\":\"NO\",\"lugar_trabajo_dependiente\":\"\",\"direccion_trabajo_dependiente\":\"\",\"tiempo_servicios_dependiente\":\"\",\"sueldo_mensual_dependiente\":\"\",\"telefono_domicilio_dependiente\":\"12334123\",\"telefono_trabajo_dependiente\":\"\",\"celular_dependiente\":\"12 3123\",\"email_dependiente\":\"sdasdasdas@gmail.com\",\"lugar_negocio_propio\":\"3213123\",\"actividad_dependiente\":\"sdasdsd\",\"ingreso_estimado_dependiente\":\"3000\",\"total_ingresos_familiares\":\"3000\",\"total_gastos_familiares\":\"100\",\"diferencia_ingresos_egresos\":\"3900\",\"tipo_vivienda\":\"Propia\",\"costo_arriendo\":\"\",\"especificar_cedida_compartida\":\"dsa\",\"tipo_construccion\":\"Casa\",\"especificar_tipo_vivienda\":\"dasd\",\"material_construccion\":\"Hormig\\u00f3n\",\"servicios_basicos\":[\"Agua Potable\",\"Alcantarillado\",\"Luz El\\u00e9ctrica\",\"Tel\\u00e9fono\",\"Internet\",\"TV Cable\"],\"vehiculo_propio\":\"SI\",\"marca_ano_vehiculo\":\"chevrolet 2023\",\"uso_vehiculo\":\"Herramienta de Trabajo\",\"especificar_uso_vehiculo\":\"asd\",\"otras_propiedades\":\"SI\",\"especificar_propiedades\":\"asdas\",\"tipo_cuentas\":[\"Ahorro\"],\"registra_prestamos\":\"NO\",\"valor_deuda_actual\":\"\",\"valor_pago_mensual_deuda\":\"\",\"motivo_deuda\":\"\",\"enfermedad_grave\":\"NO\",\"especificar_enfermedad\":\"\",\"anio_inicio_tratamiento\":\"\",\"discapacidad\":\"NO\",\"especificar_discapacidad\":\"\",\"carnet_conadis\":\"NO\",\"porcentaje_discapacidad\":\"\",\"familiar_emigrante\":\"NO\",\"especificar_otros_emigrante\":\"\",\"lugar_emigrante\":\"\",\"tiempo_permanencia_emigrante\":\"\",\"comentarios_estudiante\":\"gracias \",\"datos_familia\":[],\"quien_emigrante\":[]}','Revisada',1,'2025-07-31 15:38:50','','2025-07-31 09:26:15','2025-07-31 04:27:12',NULL,NULL),(16,41,7,'{\"nombre\":\"Juan Pérez\",\"carrera\":\"Desarrollo de Software\",\"semestre\":\"5to\",\"promedio\":\"8.5\",\"trabaja\":\"No\",\"ingresos_familia\":1200}','Aprobada',1,'2024-08-25 09:15:00','Ficha aprobada correctamente','2024-08-15 15:30:00','2024-08-20 14:20:00','2024-08-25 09:15:00',NULL),(17,42,7,'{\"nombre\":\"Ana López\",\"carrera\":\"Administración\",\"semestre\":\"3ro\",\"promedio\":\"8.2\",\"trabaja\":\"Sí\",\"ingresos_familia\":1500}','Enviada',0,NULL,NULL,'2024-08-18 16:45:00','2024-08-22 16:30:00',NULL,NULL),(18,43,7,'{\"nombre\":\"Carlos Ruiz\",\"carrera\":\"Marketing Digital\",\"semestre\":\"7mo\",\"promedio\":\"9.1\",\"trabaja\":\"No\",\"ingresos_familia\":800}','',0,NULL,NULL,'2024-08-20 14:15:00',NULL,NULL,NULL),(19,39,2,'{\"nombre\":\"Estebansito\",\"carrera\":\"Desarrollo\",\"semestre\":\"4to\",\"promedio\":\"9.1\",\"trabaja\":\"No\",\"ingresos_familia\":800}','Borrador',0,NULL,NULL,'2025-07-30 07:36:32',NULL,NULL,NULL);
/*!40000 ALTER TABLE `fichas_socioeconomicas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `logs`
--

DROP TABLE IF EXISTS `logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `logs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `usuario_id` int(10) unsigned DEFAULT NULL,
  `nivel` enum('ERROR','WARNING','INFO','DEBUG') NOT NULL DEFAULT 'INFO',
  `accion` varchar(255) NOT NULL,
  `mensaje` text NOT NULL,
  `ip` varchar(45) DEFAULT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `usuario_id` (`usuario_id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `logs`
--

LOCK TABLES `logs` WRITE;
/*!40000 ALTER TABLE `logs` DISABLE KEYS */;
INSERT INTO `logs` VALUES (1,8,'INFO','Login exitoso','Usuario superadmin inició sesión correctamente','192.168.1.1','2025-01-31 23:00:00'),(2,41,'INFO','Ficha creada','Ficha socioeconómica creada para período 2024-2','192.168.1.2','2024-08-15 15:30:00'),(3,42,'WARNING','Intento de acceso','Intento de login fallido para usuario estudiante1','192.168.1.3','2024-08-18 16:45:00'),(4,44,'INFO','Beca aprobada','Beca de excelencia académica aprobada para Juan Pérez','192.168.1.4','2024-08-15 19:30:00'),(5,8,'ERROR','Error de base de datos','Error de conexión a la base de datos','localhost','2024-08-20 14:15:00'),(10,8,'INFO','Login exitoso','Usuario superadmin inició sesión correctamente','192.168.1.1','2025-01-31 23:00:00'),(14,8,'ERROR','Error de base de datos','Error de conexión a la base de datos','localhost','2024-08-20 14:15:00'),(15,8,'INFO','Login exitoso','Usuario superadmin inició sesión correctamente','192.168.1.1','2025-07-31 06:31:13'),(16,8,'INFO','Respaldo creado','Respaldo manual creado exitosamente','192.168.1.1','2025-07-31 05:31:13'),(17,7,'INFO','Usuario creado','Nuevo usuario estudiante registrado','192.168.1.2','2025-07-31 04:31:13'),(18,8,'WARNING','Intento de acceso','Intento de login fallido para usuario inexistente','192.168.1.3','2025-07-31 03:31:13'),(19,8,'INFO','Configuración actualizada','Configuración de respaldos actualizada','192.168.1.1','2025-07-31 02:31:13'),(20,7,'INFO','Ficha aprobada','Ficha socioeconómica aprobada por admin','192.168.1.4','2025-07-31 01:31:13'),(21,8,'ERROR','Error de conexión','Error temporal de conexión a la base de datos','localhost','2025-07-31 00:31:13'),(22,8,'INFO','Logs exportados','Exportación de logs completada','192.168.1.1','2025-07-30 23:31:13'),(23,8,'INFO','Dashboard accedido','SuperAdmin accedió al dashboard','192.168.1.1','2025-07-30 22:31:13'),(24,7,'INFO','Beca aprobada','Beca de excelencia académica aprobada','192.168.1.4','2025-07-30 21:31:13'),(25,8,'INFO','Login exitoso','Usuario superadmin inició sesión correctamente','192.168.1.1','2025-07-31 06:36:32'),(26,8,'INFO','Respaldo creado','Respaldo manual creado exitosamente','192.168.1.1','2025-07-31 05:36:32'),(27,7,'INFO','Usuario creado','Nuevo usuario estudiante registrado','192.168.1.2','2025-07-31 04:36:32'),(28,8,'WARNING','Intento de acceso','Intento de login fallido para usuario inexistente','192.168.1.3','2025-07-31 03:36:32'),(29,8,'INFO','Configuración actualizada','Configuración de respaldos actualizada','192.168.1.1','2025-07-31 02:36:32'),(30,7,'INFO','Ficha aprobada','Ficha socioeconómica aprobada por admin','192.168.1.4','2025-07-31 01:36:32'),(31,8,'ERROR','Error de conexión','Error temporal de conexión a la base de datos','localhost','2025-07-31 00:36:32'),(32,8,'INFO','Logs exportados','Exportación de logs completada','192.168.1.1','2025-07-30 23:36:32'),(33,8,'INFO','Dashboard accedido','SuperAdmin accedió al dashboard','192.168.1.1','2025-07-30 22:36:32'),(34,7,'INFO','Beca aprobada','Beca de excelencia académica aprobada','192.168.1.4','2025-07-30 21:36:32');
/*!40000 ALTER TABLE `logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `periodos_academicos`
--

DROP TABLE IF EXISTS `periodos_academicos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `periodos_academicos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL COMMENT 'Ej: 2025-2026 Semestre I',
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date NOT NULL,
  `activo_fichas` tinyint(1) DEFAULT 0 COMMENT 'Indica si el período está activo para subir fichas',
  `activo_becas` tinyint(1) DEFAULT 0 COMMENT 'Indica si el período está activo para solicitar becas',
  `activo` tinyint(1) DEFAULT 1 COMMENT 'Campo de compatibilidad para mantener activo el período',
  `vigente_estudiantes` tinyint(1) DEFAULT 0 COMMENT 'Indica si el período es visible para estudiantes',
  `limite_fichas` int(10) unsigned DEFAULT NULL COMMENT 'Límite de fichas socioeconómicas para este período',
  `limite_becas` int(10) unsigned DEFAULT NULL COMMENT 'Límite de becas para este período',
  `fichas_creadas` int(10) unsigned DEFAULT 0 COMMENT 'Contador de fichas creadas en este período',
  `becas_asignadas` int(10) unsigned DEFAULT 0 COMMENT 'Contador de becas asignadas en este período',
  `descripcion` text DEFAULT NULL COMMENT 'Descripción adicional del período',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `periodos_academicos`
--

LOCK TABLES `periodos_academicos` WRITE;
/*!40000 ALTER TABLE `periodos_academicos` DISABLE KEYS */;
INSERT INTO `periodos_academicos` VALUES (1,'2024-1','2024-03-01','2024-08-31',0,0,1,1,3000,3000,1,0,''),(2,'2024-2','2024-09-01','2025-01-31',1,1,1,1,100,50,2,1,NULL),(3,'2025-1','2025-02-01','2025-08-31',1,1,1,1,3000,3000,0,0,''),(4,'PERIODO 2026','2025-07-30','2026-07-31',1,1,1,1,3000,274,1,0,'funcionando'),(5,'PERIODO 2025','2024-07-01','2024-07-31',0,0,1,1,3000,3000,0,0,''),(6,'2024-1','2024-01-15','2024-06-15',0,0,1,0,1000,200,0,0,'Primer período 2024'),(7,'2024-2','2024-07-15','2024-12-15',1,1,1,1,1000,200,3,2,'Segundo período 2024'),(10,'2024-1','2024-01-15','2024-06-15',0,0,1,0,1000,200,0,0,'Primer período 2024'),(11,'2024-2','2024-07-15','2024-12-15',1,1,1,1,1000,200,0,0,'Segundo período 2024');
/*!40000 ALTER TABLE `periodos_academicos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `respaldos`
--

DROP TABLE IF EXISTS `respaldos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `respaldos` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre_archivo` varchar(255) NOT NULL,
  `ruta_archivo` varchar(500) NOT NULL,
  `tamaño_bytes` bigint(20) unsigned NOT NULL,
  `tipo` enum('Manual','Automático','Programado') DEFAULT 'Manual',
  `estado` enum('Completado','En Proceso','Fallido') DEFAULT 'Completado',
  `descripcion` text DEFAULT NULL,
  `creado_por` int(10) unsigned DEFAULT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `creado_por` (`creado_por`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `respaldos`
--

LOCK TABLES `respaldos` WRITE;
/*!40000 ALTER TABLE `respaldos` DISABLE KEYS */;
INSERT INTO `respaldos` VALUES (1,'backup_2025-01-31_18-00-00.sql','writable/backups/backup_2025-01-31_18-00-00.sql',2621440,'Automático','Completado','Respaldo automático diario',8,'2025-07-31 07:31:13'),(2,'backup_2025-01-30_18-00-00.sql','writable/backups/backup_2025-01-30_18-00-00.sql',2580480,'Automático','Completado','Respaldo automático diario',8,'2025-07-31 07:31:13'),(3,'backup_2025-01-29_18-00-00.sql','writable/backups/backup_2025-01-29_18-00-00.sql',2555904,'Automático','Completado','Respaldo automático diario',8,'2025-07-31 07:31:13'),(4,'backup_2025-01-31_18-00-00.sql','writable/backups/backup_2025-01-31_18-00-00.sql',2621440,'Automático','Completado','Respaldo automático diario',8,'2025-07-31 07:36:32'),(5,'backup_2025-01-30_18-00-00.sql','writable/backups/backup_2025-01-30_18-00-00.sql',2580480,'Automático','Completado','Respaldo automático diario',8,'2025-07-31 07:36:32'),(6,'backup_2025-01-29_18-00-00.sql','writable/backups/backup_2025-01-29_18-00-00.sql',2555904,'Automático','Completado','Respaldo automático diario',8,'2025-07-31 07:36:32'),(7,'backup_2025-07-31_14-12-53.sql','C:\\xampp\\htdocs\\ITSI\\writable\\backups/backup_2025-07-31_14-12-53.sql',51134,'Manual','Completado','Respaldo manual creado por SuperAdmin',8,'2025-07-31 14:12:53'),(8,'backup_2025-07-31_15-49-31.sql','C:\\xampp\\htdocs\\ITSI\\writable\\backups/backup_2025-07-31_15-49-31.sql',51402,'Manual','Completado','Respaldo manual creado por SuperAdmin',8,'2025-07-31 15:49:31');
/*!40000 ALTER TABLE `respaldos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `respuestas_solicitudes`
--

DROP TABLE IF EXISTS `respuestas_solicitudes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `respuestas_solicitudes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `solicitud_id` int(10) unsigned NOT NULL,
  `usuario_id` int(10) unsigned NOT NULL,
  `mensaje` text NOT NULL,
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `solicitud_id` (`solicitud_id`),
  KEY `usuario_id` (`usuario_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `respuestas_solicitudes`
--

LOCK TABLES `respuestas_solicitudes` WRITE;
/*!40000 ALTER TABLE `respuestas_solicitudes` DISABLE KEYS */;
/*!40000 ALTER TABLE `respuestas_solicitudes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre_rol` varchar(50) NOT NULL COMMENT 'Ej: Estudiante, Administrativo Bienestar, Admin Vinculación',
  PRIMARY KEY (`id`),
  UNIQUE KEY `nombre_rol` (`nombre_rol`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (2,'Administrativo Bienestar'),(1,'Estudiante'),(5,'profesor'),(4,'Super Administrador');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `solicitudes_ayuda`
--

DROP TABLE IF EXISTS `solicitudes_ayuda`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `solicitudes_ayuda` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_estudiante` int(10) unsigned NOT NULL COMMENT 'ID del estudiante que solicita ayuda',
  `asunto` varchar(255) NOT NULL COMMENT 'Breve descripción del motivo de la solicitud',
  `descripcion` text NOT NULL COMMENT 'Descripción detallada de la solicitud de ayuda',
  `fecha_solicitud` datetime NOT NULL DEFAULT current_timestamp(),
  `estado` enum('Pendiente','En Proceso','Resuelta','Cerrada') NOT NULL DEFAULT 'Pendiente' COMMENT 'Estado actual de la solicitud',
  `prioridad` enum('Baja','Media','Alta','Urgente') NOT NULL DEFAULT 'Media' COMMENT 'Prioridad de la solicitud',
  `fecha_actualizacion` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `id_responsable` int(10) unsigned DEFAULT NULL COMMENT 'ID del administrativo encargado de la solicitud',
  `fecha_creacion` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `fk_solicitud_estudiante` (`id_estudiante`),
  KEY `fk_solicitud_responsable` (`id_responsable`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `solicitudes_ayuda`
--

LOCK TABLES `solicitudes_ayuda` WRITE;
/*!40000 ALTER TABLE `solicitudes_ayuda` DISABLE KEYS */;
INSERT INTO `solicitudes_ayuda` VALUES (2,3,'Apoyo psicológico','He estado pasando por momentos difíciles y necesito apoyo psicológico para continuar con mis estudios.','2024-10-05 11:00:00','Pendiente','Alta','2024-10-05 11:00:00',NULL,'2025-07-31 13:24:05'),(3,41,'Orientación académica','Necesito orientación sobre mi carrera y opciones de especialización','2024-08-05 14:30:00','Resuelta','Media','2024-08-07 10:15:00',44,'2025-07-31 13:24:05'),(4,42,'Dificultades académicas','Tengo dificultades con matemáticas y necesito apoyo','2024-08-15 16:45:00','Pendiente','Alta','2024-08-15 16:45:00',NULL,'2025-07-31 13:24:05'),(5,43,'Problemas económicos','Mi familia está pasando por dificultades económicas','2024-08-10 12:20:00','En Proceso','Urgente','2024-08-12 09:30:00',44,'2025-07-31 13:24:05'),(6,3,'Orientación académica','Necesito orientación sobre mi carrera y opciones de especialización','2025-07-26 02:36:32','Resuelta','Media','2025-07-28 02:36:32',7,'2025-07-31 13:24:05'),(7,40,'Dificultades académicas','Tengo dificultades con matemáticas y necesito apoyo','2025-07-27 02:36:32','Pendiente','Alta','2025-07-27 02:36:32',NULL,'2025-07-31 13:24:05'),(8,39,'Problemas económicos','Mi familia está pasando por dificultades económicas','2025-07-28 02:36:32','En Proceso','Urgente','2025-07-29 02:36:32',7,'2025-07-31 13:24:05');
/*!40000 ALTER TABLE `solicitudes_ayuda` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `solicitudes_becas`
--

DROP TABLE IF EXISTS `solicitudes_becas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `solicitudes_becas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `estudiante_id` int(10) unsigned NOT NULL,
  `beca_id` int(10) unsigned NOT NULL,
  `periodo_id` int(10) unsigned NOT NULL,
  `estado` enum('Postulada','En Revisión','Aprobada','Rechazada','Lista de Espera') NOT NULL DEFAULT 'Postulada',
  `observaciones` text DEFAULT NULL,
  `fecha_solicitud` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `estudiante_id` (`estudiante_id`),
  KEY `beca_id` (`beca_id`),
  KEY `periodo_id` (`periodo_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `solicitudes_becas`
--

LOCK TABLES `solicitudes_becas` WRITE;
/*!40000 ALTER TABLE `solicitudes_becas` DISABLE KEYS */;
INSERT INTO `solicitudes_becas` VALUES (2,3,2,2,'En Revisión','Pendiente de revisión de documentos','2024-09-20 19:15:00'),(3,41,1,7,'Aprobada','Beca aprobada por excelencia académica','2024-08-10 15:00:00'),(4,42,2,7,'En Revisión','En proceso de revisión','2024-08-12 16:20:00'),(5,43,3,7,'Aprobada','Beca deportiva aprobada','2024-08-08 14:45:00'),(6,3,1,2,'Aprobada','Beca aprobada por excelencia académica','2025-07-28 07:36:32'),(7,40,2,2,'En Revisión','En proceso de revisión','2025-07-29 07:36:32'),(8,39,3,2,'Aprobada','Beca deportiva aprobada','2025-07-30 07:36:32');
/*!40000 ALTER TABLE `solicitudes_becas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuarios` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `rol_id` int(10) unsigned NOT NULL,
  `carrera_id` int(10) unsigned DEFAULT NULL,
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
  `fecha_registro` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `cedula` (`cedula`),
  UNIQUE KEY `email` (`email`),
  KEY `rol_id` (`rol_id`),
  KEY `idx_usuarios_carrera` (`carrera_id`),
  KEY `idx_usuarios_nombre_apellido` (`nombre`,`apellido`),
  KEY `idx_usuarios_cedula` (`cedula`),
  KEY `idx_usuarios_estado` (`estado`),
  KEY `idx_usuarios_ultimo_acceso` (`ultimo_acceso`),
  KEY `idx_usuarios_fecha_registro` (`fecha_registro`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (2,2,NULL,'Ana','Gomez','0987654321','ana.gomez@email.com','$2y$10$y5M8hH9E4N7U.d.kSg/Tle8N7d0Q.jA3VbE6vW6/c8uW9jW9.G6oK','0999888777',NULL,NULL,NULL,NULL,'Activo',NULL,'2025-07-31 07:31:13','2025-06-26 04:35:27','2025-06-26 04:35:27'),(3,1,2,'ESTEBAN MAXIMILIANO','AULESTIA ANDRADE','1005183395','adsadadas@fasfasf.com','$2y$10$KgBGf8DjmRFOxd0VUM8E.u2iHNLYp6UcORsO56DxqLRQsLXhbsHIm','0986145445','Miravalle - Los Olivos','Desarrollo de Software','4',NULL,'Activo','2025-07-26 07:36:32','2025-07-31 07:31:13','2025-06-26 05:16:51','2025-07-31 07:36:32'),(7,2,NULL,'admin','admin','0001','test@mail.com','$2y$10$MRTE6Ge0u6T5P.25IURdA.aBfzvtyoqZI9JtvAhLDJuHBhofPfKfG',NULL,NULL,NULL,NULL,'user_7_1753949753.png','Activo',NULL,'2025-07-31 07:31:13','2025-07-07 13:22:37','2025-07-31 08:15:53'),(8,4,NULL,'superadmin','superAdminnnn','0004','superadmin@gmail.com','$2y$10$mAsMIO4J0aweUpPYekNi0OTmg0BqAr81mmAClzjPUhc6WYPD/wnPW','00000333','lolool','lololol','4',NULL,'Activo',NULL,'2025-07-31 07:31:13','2025-07-30 01:44:09','2025-07-30 08:37:31'),(9,1,NULL,'estudiantedos','estudiante','8485','estudiante@gmail.com','$2y$10$TCcFZw3VprqC/4D7bhdfieVp3x9RoACmaNSPKwg0cNT8cJgtXFHqS','12312233','inventado','inventado','4',NULL,'Activo','2025-07-27 07:36:32','2025-07-31 07:31:13','2025-07-30 03:50:50','2025-07-31 07:36:32'),(10,1,NULL,'estudiantetres','estudiante','10001','estudiante3@example.com','$2y$10$TCcFZw3VprqC/4D7bhdfieVp3x9RoACmaNSPKwg0cNT8cJgtXFHqS','0980000003','Direccion Inventada 3','Carrera Inventada','2',NULL,'Activo','2025-07-31 07:36:32','2025-07-31 07:31:13','2025-07-30 03:52:33','2025-07-31 07:36:32'),(11,1,NULL,'estudiantedocuatro','estudiante','10002','estudiante4@example.com','$2y$10$TCcFZw3VprqC/4D7bhdfieVp3x9RoACmaNSPKwg0cNT8cJgtXFHqS','0980000004','Direccion Inventada 4','Carrera Inventada','1',NULL,'Activo','2025-07-30 07:36:32','2025-07-31 07:31:13','2025-07-30 03:52:33','2025-07-31 07:36:32'),(12,1,NULL,'estudiantedocinco','estudiante','10003','estudiante5@example.com','$2y$10$TCcFZw3VprqC/4D7bhdfieVp3x9RoACmaNSPKwg0cNT8cJgtXFHqS','0980000005','Direccion Inventada 5','Carrera Inventada','5',NULL,'Activo','2025-07-25 07:36:32','2025-07-31 07:31:13','2025-07-30 03:52:33','2025-07-31 07:36:32'),(13,1,NULL,'estudianteseis','estudiante','10004','estudiante6@example.com','$2y$10$TCcFZw3VprqC/4D7bhdfieVp3x9RoACmaNSPKwg0cNT8cJgtXFHqS','0980000006','Direccion Inventada 6','Carrera Inventada','3',NULL,'Activo','2025-07-31 07:36:32','2025-07-31 07:31:13','2025-07-30 03:52:33','2025-07-31 07:36:32'),(14,1,NULL,'estudiantesiete','estudiante','10005','estudiante7@example.com','$2y$10$TCcFZw3VprqC/4D7bhdfieVp3x9RoACmaNSPKwg0cNT8cJgtXFHqS','0980000007','Direccion Inventada 7','Carrera Inventada','4',NULL,'Activo','2025-07-28 07:36:32','2025-07-31 07:31:13','2025-07-30 03:52:33','2025-07-31 07:36:32'),(15,1,NULL,'estudianteocho','estudiante','10006','estudiante8@example.com','$2y$10$TCcFZw3VprqC/4D7bhdfieVp3x9RoACmaNSPKwg0cNT8cJgtXFHqS','0980000008','Direccion Inventada 8','Carrera Inventada','2',NULL,'Activo','2025-07-29 07:36:32','2025-07-31 07:31:13','2025-07-30 03:52:33','2025-07-31 07:36:32'),(16,1,NULL,'estudiantenueve','estudiante','10007','estudiante9@example.com','$2y$10$TCcFZw3VprqC/4D7bhdfieVp3x9RoACmaNSPKwg0cNT8cJgtXFHqS','0980000009','Direccion Inventada 9','Carrera Inventada','1',NULL,'Activo','2025-07-28 07:36:32','2025-07-31 07:31:13','2025-07-30 03:52:33','2025-07-31 07:36:32'),(17,1,NULL,'estudiantediez','estudiante','10008','estudiante10@example.com','$2y$10$TCcFZw3VprqC/4D7bhdfieVp3x9RoACmaNSPKwg0cNT8cJgtXFHqS','0980000010','Direccion Inventada 10','Carrera Inventada','6',NULL,'Activo','2025-07-31 07:36:32','2025-07-31 07:31:13','2025-07-30 03:52:33','2025-07-31 07:36:32'),(18,1,NULL,'estudianteonce','estudiante','10009','estudiante11@example.com','$2y$10$TCcFZw3VprqC/4D7bhdfieVp3x9RoACmaNSPKwg0cNT8cJgtXFHqS','0980000011','Direccion Inventada 11','Carrera Inventada','5',NULL,'Activo','2025-07-30 07:36:32','2025-07-31 07:31:13','2025-07-30 03:52:33','2025-07-31 07:36:32'),(19,1,NULL,'estudiantedoce','estudiante','10010','estudiante12@example.com','$2y$10$TCcFZw3VprqC/4D7bhdfieVp3x9RoACmaNSPKwg0cNT8cJgtXFHqS','0980000012','Direccion Inventada 12','Carrera Inventada','3',NULL,'Activo','2025-07-25 07:36:32','2025-07-31 07:31:13','2025-07-30 03:52:33','2025-07-31 07:36:32'),(20,1,NULL,'estudiantetrece','estudiante','10011','estudiante13@example.com','$2y$10$TCcFZw3VprqC/4D7bhdfieVp3x9RoACmaNSPKwg0cNT8cJgtXFHqS','0980000013','Direccion Inventada 13','Carrera Inventada','4',NULL,'Activo','2025-07-31 07:36:32','2025-07-31 07:31:13','2025-07-30 03:52:33','2025-07-31 07:36:32'),(21,1,NULL,'estudiantecatorce','estudiante','10012','estudiante14@example.com','$2y$10$TCcFZw3VprqC/4D7bhdfieVp3x9RoACmaNSPKwg0cNT8cJgtXFHqS','0980000014','Direccion Inventada 14','Carrera Inventada','2',NULL,'Activo',NULL,'2025-07-31 07:31:13','2025-07-30 03:52:33','2025-07-30 03:52:33'),(22,1,NULL,'estudiantequince','estudiante','10013','estudiante15@example.com','$2y$10$TCcFZw3VprqC/4D7bhdfieVp3x9RoACmaNSPKwg0cNT8cJgtXFHqS','0980000015','Direccion Inventada 15','Carrera Inventada','1',NULL,'Activo',NULL,'2025-07-31 07:31:13','2025-07-30 03:52:33','2025-07-30 03:52:33'),(23,1,NULL,'estudiantedieciseis','estudiante','10014','estudiante16@example.com','$2y$10$TCcFZw3VprqC/4D7bhdfieVp3x9RoACmaNSPKwg0cNT8cJgtXFHqS','0980000016','Direccion Inventada 16','Carrera Inventada','5',NULL,'Activo',NULL,'2025-07-31 07:31:13','2025-07-30 03:52:33','2025-07-30 03:52:33'),(24,1,NULL,'estudiantediecisiete','estudiante','10015','estudiante17@example.com','$2y$10$TCcFZw3VprqC/4D7bhdfieVp3x9RoACmaNSPKwg0cNT8cJgtXFHqS','0980000017','Direccion Inventada 17','Carrera Inventada','3',NULL,'Activo',NULL,'2025-07-31 07:31:13','2025-07-30 03:52:33','2025-07-30 03:52:33'),(25,1,NULL,'estudiantedieciocho','estudiante','10016','estudiante18@example.com','$2y$10$TCcFZw3VprqC/4D7bhdfieVp3x9RoACmaNSPKwg0cNT8cJgtXFHqS','0980000018','Direccion Inventada 18','Carrera Inventada','6',NULL,'Activo',NULL,'2025-07-31 07:31:13','2025-07-30 03:52:33','2025-07-30 03:52:33'),(26,1,NULL,'estudiantediecinueve','estudiante','10017','estudiante19@example.com','$2y$10$TCcFZw3VprqC/4D7bhdfieVp3x9RoACmaNSPKwg0cNT8cJgtXFHqS','0980000019','Direccion Inventada 19','Carrera Inventada','4',NULL,'Activo',NULL,'2025-07-31 07:31:13','2025-07-30 03:52:33','2025-07-30 03:52:33'),(27,1,NULL,'estudianteveinte','estudiante','10018','estudiante20@example.com','$2y$10$TCcFZw3VprqC/4D7bhdfieVp3x9RoACmaNSPKwg0cNT8cJgtXFHqS','0980000020','Direccion Inventada 20','Carrera Inventada','2',NULL,'Activo',NULL,'2025-07-31 07:31:13','2025-07-30 03:52:33','2025-07-30 03:52:33'),(28,1,NULL,'estudianteveintiuno','estudiante','10019','estudiante21@example.com','$2y$10$TCcFZw3VprqC/4D7bhdfieVp3x9RoACmaNSPKwg0cNT8cJgtXFHqS','0980000021','Direccion Inventada 21','Carrera Inventada','1',NULL,'Activo',NULL,'2025-07-31 07:31:13','2025-07-30 03:52:33','2025-07-30 03:52:33'),(29,1,NULL,'estudianteveintidos','estudiante','10020','estudiante22@example.com','$2y$10$TCcFZw3VprqC/4D7bhdfieVp3x9RoACmaNSPKwg0cNT8cJgtXFHqS','0980000022','Direccion Inventada 22','Carrera Inventada','5',NULL,'Activo',NULL,'2025-07-31 07:31:13','2025-07-30 03:52:33','2025-07-30 03:52:33'),(30,1,NULL,'estudianteveintitres','estudiante','10021','estudiante23@example.com','$2y$10$TCcFZw3VprqC/4D7bhdfieVp3x9RoACmaNSPKwg0cNT8cJgtXFHqS','0980000023','Direccion Inventada 23','Carrera Inventada','3',NULL,'Activo',NULL,'2025-07-31 07:31:13','2025-07-30 03:52:33','2025-07-30 03:52:33'),(31,1,NULL,'estudianteveinticuatro','estudiante','10022','estudiante24@example.com','$2y$10$TCcFZw3VprqC/4D7bhdfieVp3x9RoACmaNSPKwg0cNT8cJgtXFHqS','0980000024','Direccion Inventada 24','Carrera Inventada','4',NULL,'Activo',NULL,'2025-07-31 07:31:13','2025-07-30 03:52:33','2025-07-30 03:52:33'),(32,1,NULL,'estudianteveinticinco','estudiante','10023','estudiante25@example.com','$2y$10$TCcFZw3VprqC/4D7bhdfieVp3x9RoACmaNSPKwg0cNT8cJgtXFHqS','0980000025','Direccion Inventada 25','Carrera Inventada','2',NULL,'Activo',NULL,'2025-07-31 07:31:13','2025-07-30 03:52:33','2025-07-30 03:52:33'),(33,1,NULL,'estudianteveintiseis','estudiante','10024','estudiante26@example.com','$2y$10$TCcFZw3VprqC/4D7bhdfieVp3x9RoACmaNSPKwg0cNT8cJgtXFHqS','0980000026','Direccion Inventada 26','Carrera Inventada','1',NULL,'Activo',NULL,'2025-07-31 07:31:13','2025-07-30 03:52:33','2025-07-30 03:52:33'),(34,1,NULL,'estudianteveintisiete','estudiante','10025','estudiante27@example.com','$2y$10$TCcFZw3VprqC/4D7bhdfieVp3x9RoACmaNSPKwg0cNT8cJgtXFHqS','0980000027','Direccion Inventada 27','Carrera Inventada','6',NULL,'Activo',NULL,'2025-07-31 07:31:13','2025-07-30 03:52:33','2025-07-30 03:52:33'),(35,1,NULL,'estudianteveintiocho','estudiante','10026','estudiante28@example.com','$2y$10$TCcFZw3VprqC/4D7bhdfieVp3x9RoACmaNSPKwg0cNT8cJgtXFHqS','0980000028','Direccion Inventada 28','Carrera Inventada','5',NULL,'Activo',NULL,'2025-07-31 07:31:13','2025-07-30 03:52:33','2025-07-30 03:52:33'),(37,1,NULL,'estudiantetreinta','estudiante','10028','estudiante30@example.com','$2y$10$TCcFZw3VprqC/4D7bhdfieVp3x9RoACmaNSPKwg0cNT8cJgtXFHqS','0980000030','Direccion Inventada 30','Carrera Inventada','4',NULL,'Activo',NULL,'2025-07-31 07:31:13','2025-07-30 03:52:33','2025-07-30 03:52:33'),(38,1,NULL,'estudiantetreintayuno','estudiante','10029','estudiante31@example.com','$2y$10$TCcFZw3VprqC/4D7bhdfieVp3x9RoACmaNSPKwg0cNT8cJgtXFHqS','0980000031','Direccion Inventada 31','Carrera Inventada','2',NULL,'Activo',NULL,'2025-07-31 07:31:13','2025-07-30 03:52:33','2025-07-30 03:52:33'),(39,1,2,'estebansito','lolaso','01023123','eareqwr@gmail.com','$2y$10$Ht9z2A8ChR57hpHXjPtBDuK4PQ4YUawHzOv3RguKm6kHFjudlIZuG','31241242','los lolos ','desarrollo','4',NULL,'Activo',NULL,'2025-07-31 07:31:13','2025-07-30 09:40:51','2025-07-30 23:34:24'),(40,1,NULL,'estudiante','estudiante','0003','estudiante@testmail.com','$2y$10$A2Dcln7NP57JTlzt/ZEkJuWn8mpizJMSmn6x7JgmUFN9nUIFT49Xm','123124','ddsdasd','dsada','3','user_40_1753978098.jpeg','Activo',NULL,'2025-07-31 07:31:13','2025-07-30 04:44:38','2025-07-31 16:08:18'),(41,1,2,'Juan','Pérez','1005183396','juan.perez@estudiante.itsi.edu.ec','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','0986145446','Ibarra, Ecuador','Desarrollo de Software','5',NULL,'Activo',NULL,'2025-07-31 07:31:13','2024-01-15 15:30:00','2025-07-31 07:04:46'),(42,1,4,'Ana','López','1005183397','ana.lopez@estudiante.itsi.edu.ec','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','0986145447','Ibarra, Ecuador','Administración','3',NULL,'Activo',NULL,'2025-07-31 07:31:13','2024-02-20 16:15:00','2025-07-31 07:04:46'),(43,1,5,'Carlos','Ruiz','1005183398','carlos.ruiz@estudiante.itsi.edu.ec','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','0986145448','Ibarra, Ecuador','Marketing Digital y Comercio Electrónico','7',NULL,'Activo',NULL,'2025-07-31 07:31:13','2024-03-10 14:20:00','2025-07-31 07:04:46'),(44,2,NULL,'María','González','1005183399','maria.gonzalez@itsi.edu.ec','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','0986145449','Ibarra, Ecuador',NULL,NULL,NULL,'Activo',NULL,'2025-07-31 07:31:13','2024-01-01 13:00:00','2025-07-31 07:04:46'),(45,2,NULL,'Pedro','Martínez','1005183400','pedro.martinez@itsi.edu.ec','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','0986145450','Ibarra, Ecuador',NULL,NULL,NULL,'Activo',NULL,'2025-07-31 07:31:13','2024-01-05 13:30:00','2025-07-31 07:04:46'),(46,1,2,'María','García','1005183401','maria.garcia@estudiante.itsi.edu.ec','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','0986145451','Ibarra, Ecuador','Desarrollo de Software','4',NULL,'Activo','2025-07-29 07:36:32','2025-07-16 07:36:32','2025-07-31 07:36:32','2025-07-31 07:36:32'),(47,1,4,'Luis','Rodríguez','1005183402','luis.rodriguez@estudiante.itsi.edu.ec','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','0986145452','Ibarra, Ecuador','Administración','6',NULL,'Activo','2025-07-30 07:36:32','2025-07-11 07:36:32','2025-07-31 07:36:32','2025-07-31 07:36:32'),(48,1,5,'Ana','Martínez','1005183403','ana.martinez@estudiante.itsi.edu.ec','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi','0986145453','Ibarra, Ecuador','Marketing Digital','3',NULL,'Activo','2025-07-28 07:36:32','2025-07-06 07:36:32','2025-07-31 07:36:32','2025-07-31 07:36:32');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-07-31 11:10:08
