CREATE DATABASE  IF NOT EXISTS `sipa_bd` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */;
USE `sipa_bd`;
-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: localhost    Database: sipa_bd
-- ------------------------------------------------------
-- Server version	8.0.15

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `sipa_activos`
--

DROP TABLE IF EXISTS `sipa_activos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sipa_activos` (
  `sipa_activos_id` int(11) NOT NULL AUTO_INCREMENT,
  `sipa_activos_codigo` varchar(50) NOT NULL,
  `sipa_activos_nombre` varchar(50) NOT NULL,
  `sipa_activos_descripcion` varchar(200) NOT NULL,
  `sipa_activos_fecha_creacion` timestamp NULL DEFAULT NULL,
  `sipa_activos_usuario_creador` int(11) DEFAULT NULL,
  `sipa_activos_fecha_actualizacion` timestamp NULL DEFAULT NULL,
  `sipa_activos_usuario_actualizacion` int(11) DEFAULT NULL,
  `sipa_activos_cantidad` int(11) NOT NULL,
  `sipa_activos_precio` double DEFAULT NULL,
  `sipa_activos_estado` int(11) NOT NULL,
  `sipa_activos_foto` blob,
  `sipa_activos_edificio` int(11) NOT NULL,
  `sipa_activos_ubicacion` varchar(200) NOT NULL,
  `sipa_activos_encargado` int(11) NOT NULL,
  `sipa_activos_duenio` int(11) NOT NULL,
  PRIMARY KEY (`sipa_activos_id`),
  KEY `fk_activos_creacion_idx` (`sipa_activos_usuario_creador`),
  KEY `fk_activos_actualizacion_idx` (`sipa_activos_usuario_actualizacion`),
  KEY `fk_activos_duenio_idx` (`sipa_activos_duenio`),
  KEY `fk_activos_encargado_idx` (`sipa_activos_encargado`),
  KEY `fk_activos_edificio_idx` (`sipa_activos_edificio`),
  CONSTRAINT `fk_activos_actualizacion` FOREIGN KEY (`sipa_activos_usuario_actualizacion`) REFERENCES `sipa_usuarios` (`sipa_usuarios_id`),
  CONSTRAINT `fk_activos_creacion` FOREIGN KEY (`sipa_activos_usuario_creador`) REFERENCES `sipa_usuarios` (`sipa_usuarios_id`),
  CONSTRAINT `fk_activos_duenio` FOREIGN KEY (`sipa_activos_duenio`) REFERENCES `sipa_usuarios` (`sipa_usuarios_id`),
  CONSTRAINT `fk_activos_edificio` FOREIGN KEY (`sipa_activos_edificio`) REFERENCES `sipa_edificios` (`sipa_edificios_id`),
  CONSTRAINT `fk_activos_encargado` FOREIGN KEY (`sipa_activos_encargado`) REFERENCES `sipa_usuarios` (`sipa_usuarios_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sipa_activos`
--

LOCK TABLES `sipa_activos` WRITE;
/*!40000 ALTER TABLE `sipa_activos` DISABLE KEYS */;
/*!40000 ALTER TABLE `sipa_activos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sipa_edificios`
--

DROP TABLE IF EXISTS `sipa_edificios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sipa_edificios` (
  `sipa_edificios_id` int(11) NOT NULL AUTO_INCREMENT,
  `sipa_edificios_codigo` varchar(50) NOT NULL,
  `sipa_edificios_nombre` varchar(50) NOT NULL,
  `sipa_edificios_descripcion` varchar(200) NOT NULL,
  `sipa_edificios_cantidad_pisos` int(11) NOT NULL,
  `sipa_edificios_fecha_creador` timestamp NULL DEFAULT NULL,
  `sipa_edificios_usuario_creacion` int(11) DEFAULT NULL,
  `sipa_edificios_fecha_actualizacion` timestamp NULL DEFAULT NULL,
  `sipa_edificios_usuario_actualizacion` int(11) DEFAULT NULL,
  PRIMARY KEY (`sipa_edificios_id`),
  KEY `fk_edificios_creacion_idx` (`sipa_edificios_usuario_creacion`),
  KEY `fk_edificios_actualizacion_idx` (`sipa_edificios_usuario_actualizacion`),
  CONSTRAINT `fk_edificios_actualizacion` FOREIGN KEY (`sipa_edificios_usuario_actualizacion`) REFERENCES `sipa_usuarios` (`sipa_usuarios_id`),
  CONSTRAINT `fk_edificios_creacion` FOREIGN KEY (`sipa_edificios_usuario_creacion`) REFERENCES `sipa_usuarios` (`sipa_usuarios_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sipa_edificios`
--

LOCK TABLES `sipa_edificios` WRITE;
/*!40000 ALTER TABLE `sipa_edificios` DISABLE KEYS */;
/*!40000 ALTER TABLE `sipa_edificios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sipa_historial_activos`
--

DROP TABLE IF EXISTS `sipa_historial_activos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sipa_historial_activos` (
  `sipa_historial_activo` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`sipa_historial_activo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sipa_historial_activos`
--

LOCK TABLES `sipa_historial_activos` WRITE;
/*!40000 ALTER TABLE `sipa_historial_activos` DISABLE KEYS */;
/*!40000 ALTER TABLE `sipa_historial_activos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sipa_historial_inventarios`
--

DROP TABLE IF EXISTS `sipa_historial_inventarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sipa_historial_inventarios` (
  `sipa_historial_inventario_id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`sipa_historial_inventario_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sipa_historial_inventarios`
--

LOCK TABLES `sipa_historial_inventarios` WRITE;
/*!40000 ALTER TABLE `sipa_historial_inventarios` DISABLE KEYS */;
/*!40000 ALTER TABLE `sipa_historial_inventarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sipa_historial_salas`
--

DROP TABLE IF EXISTS `sipa_historial_salas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sipa_historial_salas` (
  `sipa_historial_sala_id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`sipa_historial_sala_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sipa_historial_salas`
--

LOCK TABLES `sipa_historial_salas` WRITE;
/*!40000 ALTER TABLE `sipa_historial_salas` DISABLE KEYS */;
/*!40000 ALTER TABLE `sipa_historial_salas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sipa_insumos`
--

DROP TABLE IF EXISTS `sipa_insumos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sipa_insumos` (
  `sipa_insumos_id` int(11) NOT NULL AUTO_INCREMENT,
  `sipa_insumos_nombre` varchar(50) NOT NULL,
  `sipa_insumos_codigo` varchar(50) NOT NULL,
  `sipa_insumos_descripcion` varchar(200) NOT NULL,
  `sipa_insumos_usuario_creador` int(11) DEFAULT NULL,
  `sipa_insumos_fecha_creacion` timestamp NULL DEFAULT NULL,
  `sipa_insumos_fecha_actualizacion` timestamp NULL DEFAULT NULL,
  `sipa_insumos_usuario_actualizacion` int(11) DEFAULT NULL,
  `sipa_insumos_cantidad` int(11) NOT NULL,
  `sipa_insumos_periocidad` int(11) DEFAULT NULL,
  `sipa_insumos_tipo_periocidad` int(11) DEFAULT NULL,
  `sipa_insumos_estado` int(11) DEFAULT NULL,
  `sipa_insumos_ubicacion` varchar(200) DEFAULT NULL,
  `sipa_insumos_edificio` int(11) DEFAULT NULL,
  `sipa_insumos_foto` blob,
  `sipa_insumos_usuario_encargado` int(11) DEFAULT NULL,
  `sipa_insumos_precio` double DEFAULT NULL,
  PRIMARY KEY (`sipa_insumos_id`,`sipa_insumos_nombre`,`sipa_insumos_codigo`,`sipa_insumos_descripcion`),
  KEY `fk_insumos_creacion_idx` (`sipa_insumos_usuario_creador`),
  KEY `fk_insumos_actualizacion_idx` (`sipa_insumos_usuario_actualizacion`),
  CONSTRAINT `fk_insumos_actualizacion` FOREIGN KEY (`sipa_insumos_usuario_actualizacion`) REFERENCES `sipa_usuarios` (`sipa_usuarios_id`),
  CONSTRAINT `fk_insumos_creacion` FOREIGN KEY (`sipa_insumos_usuario_creador`) REFERENCES `sipa_usuarios` (`sipa_usuarios_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sipa_insumos`
--

LOCK TABLES `sipa_insumos` WRITE;
/*!40000 ALTER TABLE `sipa_insumos` DISABLE KEYS */;
/*!40000 ALTER TABLE `sipa_insumos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sipa_opciones_menu`
--

DROP TABLE IF EXISTS `sipa_opciones_menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sipa_opciones_menu` (
  `sipa_opciones_menu_id` int(11) NOT NULL AUTO_INCREMENT,
  `sipa_opciones_menu_codigo` varchar(50) NOT NULL,
  `sipa_opciones_menu_nombre` varchar(50) NOT NULL,
  `sipa_opciones_menu_descripcion` varchar(200) NOT NULL,
  `sipa_opciones_menu_fecha_creacion` timestamp NULL DEFAULT NULL,
  `sipa_opciones_menu_usuario_creador` int(11) DEFAULT NULL,
  `sipa_opciones_menu_fecha_actualizacion` timestamp NULL DEFAULT NULL,
  `sipa_opciones_menu_usuario_actualizacion` int(11) DEFAULT NULL,
  PRIMARY KEY (`sipa_opciones_menu_id`),
  KEY `fk_opciones_menu_creacion_idx` (`sipa_opciones_menu_usuario_creador`),
  KEY `fk_opciones_menu_actualizacion_idx` (`sipa_opciones_menu_usuario_actualizacion`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sipa_opciones_menu`
--

LOCK TABLES `sipa_opciones_menu` WRITE;
/*!40000 ALTER TABLE `sipa_opciones_menu` DISABLE KEYS */;
/*!40000 ALTER TABLE `sipa_opciones_menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sipa_permisos_roles`
--

DROP TABLE IF EXISTS `sipa_permisos_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sipa_permisos_roles` (
  `sipa_permisos_roles_id` int(11) NOT NULL AUTO_INCREMENT,
  `sipa_permisos_roles_role` int(11) NOT NULL,
  `sipa_permisos_roles_opciones_menu` int(11) NOT NULL,
  `sipa_permisos_roles_crear` tinyint(1) DEFAULT NULL,
  `sipa_permisos_roles_editar` tinyint(1) DEFAULT NULL,
  `sipa_permisos_roles_ver` tinyint(1) DEFAULT NULL,
  `sipa_permisos_roles_exportar` tinyint(1) DEFAULT NULL,
  `sipa_permisos_roles_fecha_creacion` timestamp NULL DEFAULT NULL,
  `sipa_permisos_roles_usuario_creador` int(11) DEFAULT NULL,
  `sipa_permisos_roles_fecha_actualizacion` timestamp NULL DEFAULT NULL,
  `sipa_permisos_roles_usuario_actualizacion` int(11) DEFAULT NULL,
  PRIMARY KEY (`sipa_permisos_roles_id`),
  KEY `fk_permisos_roles_idx` (`sipa_permisos_roles_usuario_creador`),
  KEY `fk_permisos_roles_actualizacion_idx` (`sipa_permisos_roles_usuario_actualizacion`),
  CONSTRAINT `fk_permisos_roles_actualizacion` FOREIGN KEY (`sipa_permisos_roles_usuario_actualizacion`) REFERENCES `sipa_usuarios` (`sipa_usuarios_id`),
  CONSTRAINT `fk_permisos_roles_creacion` FOREIGN KEY (`sipa_permisos_roles_usuario_creador`) REFERENCES `sipa_usuarios` (`sipa_usuarios_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sipa_permisos_roles`
--

LOCK TABLES `sipa_permisos_roles` WRITE;
/*!40000 ALTER TABLE `sipa_permisos_roles` DISABLE KEYS */;
/*!40000 ALTER TABLE `sipa_permisos_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sipa_reserva_activos`
--

DROP TABLE IF EXISTS `sipa_reserva_activos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sipa_reserva_activos` (
  `sipa_reserva_activo_id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`sipa_reserva_activo_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sipa_reserva_activos`
--

LOCK TABLES `sipa_reserva_activos` WRITE;
/*!40000 ALTER TABLE `sipa_reserva_activos` DISABLE KEYS */;
/*!40000 ALTER TABLE `sipa_reserva_activos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sipa_reserva_salas`
--

DROP TABLE IF EXISTS `sipa_reserva_salas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sipa_reserva_salas` (
  `sipa_reserva_sala_id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`sipa_reserva_sala_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sipa_reserva_salas`
--

LOCK TABLES `sipa_reserva_salas` WRITE;
/*!40000 ALTER TABLE `sipa_reserva_salas` DISABLE KEYS */;
/*!40000 ALTER TABLE `sipa_reserva_salas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sipa_roles`
--

DROP TABLE IF EXISTS `sipa_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sipa_roles` (
  `sipa_roles_id` int(11) NOT NULL AUTO_INCREMENT,
  `sipa_roles_codigo` varchar(50) NOT NULL,
  `sipa_roles_nombre` varchar(50) NOT NULL,
  `sipa_roles_descripcion` varchar(200) NOT NULL,
  `sipa_roles_fecha_creacion` timestamp NULL DEFAULT NULL,
  `sipa_roles_usuario_creador` int(11) DEFAULT NULL,
  `sipa_roles_fecha_actualizacion` timestamp NULL DEFAULT NULL,
  `sipa_roles_usuario_actualizacion` int(11) DEFAULT NULL,
  PRIMARY KEY (`sipa_roles_id`),
  KEY `id_roles_creacion_idx` (`sipa_roles_usuario_creador`),
  KEY `id_roles_actualizacion_idx` (`sipa_roles_usuario_actualizacion`),
  CONSTRAINT `id_roles_actualizacion` FOREIGN KEY (`sipa_roles_usuario_actualizacion`) REFERENCES `sipa_usuarios` (`sipa_usuarios_id`),
  CONSTRAINT `id_roles_creacion` FOREIGN KEY (`sipa_roles_usuario_creador`) REFERENCES `sipa_usuarios` (`sipa_usuarios_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sipa_roles`
--

LOCK TABLES `sipa_roles` WRITE;
/*!40000 ALTER TABLE `sipa_roles` DISABLE KEYS */;
/*!40000 ALTER TABLE `sipa_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sipa_salas`
--

DROP TABLE IF EXISTS `sipa_salas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sipa_salas` (
  `sipa_sala_id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`sipa_sala_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sipa_salas`
--

LOCK TABLES `sipa_salas` WRITE;
/*!40000 ALTER TABLE `sipa_salas` DISABLE KEYS */;
/*!40000 ALTER TABLE `sipa_salas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sipa_unidades`
--

DROP TABLE IF EXISTS `sipa_unidades`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sipa_unidades` (
  `sipa_unidades_id` int(11) NOT NULL AUTO_INCREMENT,
  `sipa_unidades_codigo` varchar(50) NOT NULL,
  `sipa_unidades_nombre` varchar(50) NOT NULL,
  `sipa_unidades_descripcion` varchar(200) NOT NULL,
  `sipa_unidades_fecha_creacion` timestamp NULL DEFAULT NULL,
  `sipa_unidades_usuario_creador` int(11) DEFAULT NULL,
  `sipa_unidades_usuario_actualizacion` int(11) DEFAULT NULL,
  `sipa_unidades_fecha_actualizacion` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`sipa_unidades_id`),
  KEY `fk_unidades_creacion_idx` (`sipa_unidades_usuario_creador`),
  KEY `fk_unidades_edicion_idx` (`sipa_unidades_usuario_actualizacion`),
  CONSTRAINT `fk_unidades_actualizacion` FOREIGN KEY (`sipa_unidades_usuario_actualizacion`) REFERENCES `sipa_usuarios` (`sipa_usuarios_id`),
  CONSTRAINT `fk_unidades_creacion` FOREIGN KEY (`sipa_unidades_usuario_creador`) REFERENCES `sipa_usuarios` (`sipa_usuarios_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sipa_unidades`
--

LOCK TABLES `sipa_unidades` WRITE;
/*!40000 ALTER TABLE `sipa_unidades` DISABLE KEYS */;
/*!40000 ALTER TABLE `sipa_unidades` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sipa_usuarios`
--

DROP TABLE IF EXISTS `sipa_usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sipa_usuarios` (
  `sipa_usuarios_id` int(11) NOT NULL AUTO_INCREMENT,
  `sipa_usuarios_identificacion` varchar(50) NOT NULL,
  `sipa_usuarios_nombre` varchar(50) DEFAULT NULL,
  `sipa_usuarios_apellidos` varchar(50) DEFAULT NULL,
  `sipa_usuarios_telefono` varchar(50) DEFAULT NULL,
  `sipa_usuarios_correo` varchar(50) DEFAULT NULL,
  `sipa_usuarios_unidad` int(11) DEFAULT NULL,
  `sipa_usuarios_edificio` int(11) DEFAULT NULL,
  `sipa_usuarios_rol` int(11) NOT NULL,
  `sipa_usuarios_fecha_creacion` timestamp NULL DEFAULT NULL,
  `sipa_usuarios_usuario_creador` int(11) DEFAULT NULL,
  `sipa_usuarios_fecha_actualizacion` timestamp NULL DEFAULT NULL,
  `sipa_usuarios_usuario_actulizacion` int(11) DEFAULT NULL,
  PRIMARY KEY (`sipa_usuarios_id`),
  KEY `fk_usuarios_creacion_idx` (`sipa_usuarios_usuario_creador`),
  KEY `fk_usuarios_edicion_idx` (`sipa_usuarios_usuario_actulizacion`),
  CONSTRAINT `fk_usuarios_actualizacion` FOREIGN KEY (`sipa_usuarios_usuario_actulizacion`) REFERENCES `sipa_usuarios` (`sipa_usuarios_id`),
  CONSTRAINT `fk_usuarios_creacion` FOREIGN KEY (`sipa_usuarios_usuario_creador`) REFERENCES `sipa_usuarios` (`sipa_usuarios_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sipa_usuarios`
--

LOCK TABLES `sipa_usuarios` WRITE;
/*!40000 ALTER TABLE `sipa_usuarios` DISABLE KEYS */;
/*!40000 ALTER TABLE `sipa_usuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'sipa_bd'
--

--
-- Dumping routines for database 'sipa_bd'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-09-21 10:48:16
