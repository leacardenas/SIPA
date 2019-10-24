-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 24, 2019 at 09:49 AM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sipa`
--

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_10_01_210150_create_sipa_opciones_menus_table', 1),
(5, '2019_10_01_210157_create_sipa_roles_table', 1),
(6, '2019_10_01_210314_create_sipa_permisos_roles_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sipa_activos`
--

CREATE TABLE `sipa_activos` (
  `sipa_activos_id` int(11) NOT NULL,
  `sipa_activos_codigo` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sipa_activos_nombre` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sipa_activos_descripcion` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sipa_activos_usuario_creador` bigint(20) UNSIGNED DEFAULT NULL,
  `sipa_activos_usuario_actualizacion` bigint(20) UNSIGNED DEFAULT NULL,
  `sipa_activos_precio` double DEFAULT NULL,
  `sipa_activos_estado` int(11) NOT NULL,
  `sipa_activos_foto` blob DEFAULT NULL,
  `tipo_imagen` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sipa_activos_edificio` int(11) NOT NULL,
  `sipa_activos_ubicacion` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sipa_activos_encargado` bigint(20) UNSIGNED NOT NULL,
  `sipa_activos_responsable` bigint(20) UNSIGNED NOT NULL,
  `sipa_activos_marca` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sipa_activos_modelo` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sipa_activos_serie` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `estado` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sipa_activos_disponible` tinyint(1) DEFAULT 1,
  `sipa_activos_motivo_baja` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT 'No se ha dado de baja',
  `sipa_activos_fomulario` longblob DEFAULT NULL,
  `tipo_form` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sipa_activos`
--

INSERT INTO `sipa_activos` (`sipa_activos_id`, `sipa_activos_codigo`, `sipa_activos_nombre`, `sipa_activos_descripcion`, `sipa_activos_usuario_creador`, `sipa_activos_usuario_actualizacion`, `sipa_activos_precio`, `sipa_activos_estado`, `sipa_activos_foto`, `tipo_imagen`, `sipa_activos_edificio`, `sipa_activos_ubicacion`, `sipa_activos_encargado`, `sipa_activos_responsable`, `sipa_activos_marca`, `sipa_activos_modelo`, `sipa_activos_serie`, `created_at`, `updated_at`, `estado`, `sipa_activos_disponible`, `sipa_activos_motivo_baja`, `sipa_activos_fomulario`, `tipo_form`) VALUES
(1, 'COMP-HP-PAVILION', 'Computadora HP Pavilion', 'Computadora HP Pavilion 2019', NULL, NULL, 400000, 0, NULL, NULL, 1, 'Ubicación', 0, 0, 'HP', 'Pavilion', '02174', '2019-10-24 06:00:00', NULL, '0', 1, 'No se ha dado de baja', NULL, NULL),
(2, 'COMP-LENOVO', 'Computadora Lenovo YOGA', 'Computadora Lenovo Yoga 2017', NULL, NULL, 392000, 0, NULL, NULL, 1, 'Ubicación', 0, 0, 'Lenovo', 'Yoga', '02175', '2019-10-24 06:00:00', NULL, '0', 1, 'No se ha dado de baja', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sipa_edificios`
--

CREATE TABLE `sipa_edificios` (
  `id` int(10) UNSIGNED NOT NULL,
  `sipa_edificios_nombre` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sipa_edificios_cantidad_pisos` int(10) UNSIGNED NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sipa_edificios`
--

INSERT INTO `sipa_edificios` (`id`, `sipa_edificios_nombre`, `sipa_edificios_cantidad_pisos`) VALUES
(1, 'Informatica', 2),
(2, 'Emprendimiento', 4);

-- --------------------------------------------------------

--
-- Table structure for table `sipa_edificios_unidades`
--

CREATE TABLE `sipa_edificios_unidades` (
  `sipa_edificios_unidades_id` int(10) UNSIGNED NOT NULL,
  `sipa_edificios_unidades_nombre` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sipa_edificios_unidades_edificio` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sipa_edificios_unidades`
--

INSERT INTO `sipa_edificios_unidades` (`sipa_edificios_unidades_id`, `sipa_edificios_unidades_nombre`, `sipa_edificios_unidades_edificio`) VALUES
(1, 'contabilidad', 1),
(2, 'secretariado', 1),
(3, 'investigacion', 2),
(4, 'auditorio', 2);

-- --------------------------------------------------------

--
-- Table structure for table `sipa_opciones_menus`
--

CREATE TABLE `sipa_opciones_menus` (
  `sipa_opciones_menu_id` bigint(20) UNSIGNED NOT NULL,
  `sipa_opciones_menu_codigo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sipa_opciones_menu_nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sipa_opciones_menu_descripcion` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `sipa_opciones_menu_usuario_creador` bigint(20) UNSIGNED NOT NULL,
  `sipa_opciones_menu_usuario_actualizacion` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sipa_opciones_menus`
--

INSERT INTO `sipa_opciones_menus` (`sipa_opciones_menu_id`, `sipa_opciones_menu_codigo`, `sipa_opciones_menu_nombre`, `sipa_opciones_menu_descripcion`, `sipa_opciones_menu_usuario_creador`, `sipa_opciones_menu_usuario_actualizacion`, `created_at`, `updated_at`) VALUES
(31, 'RESERVAR', 'RESERVAR', 'PERMISOS DEL MODULO DE RESERVAS DE SALAS', 0, NULL, NULL, NULL),
(32, 'RESERVAR_SALA', 'RESERVAR SALA', 'PERMISOS DEL MODULO DE RESERVAS DE SALAS', 0, NULL, NULL, NULL),
(33, 'RESERVAR_EQUIPO', 'RESERVAR EQUIPO', 'PERMISOS DEL MODULO DE RESERVAS DE EQUIPOS', 0, NULL, NULL, NULL),
(34, 'INV_USO', 'INVENTARIO EN USO', 'PERMISOS DEL MODULO DE INVENTARIOS EN USO', 0, NULL, NULL, NULL),
(35, 'INV_USO_EQUIPO', 'EQUIPO EN USO', 'PERMISOS DEL MODULO DE EQUIPO EN USO', 0, NULL, NULL, NULL),
(36, 'INV_USO_SALA', 'SALAS EN USO', 'PERMISOS DEL MODULO DE SALA EN USO', 0, NULL, NULL, NULL),
(37, 'INV_FORMULARIOS', 'FORMULARIOS', 'PERMISOS DEL MODULO DE FORMULARIOS', 0, NULL, NULL, NULL),
(38, 'HISTO', 'HISTORIAL', 'HISTORIAL', 0, NULL, NULL, NULL),
(39, 'HISTO_SALA', 'HISTORIAL DE SALAS', 'HISTORIAL DE RESERVA DE SALAS', 0, NULL, NULL, NULL),
(40, 'ENTREG_SALA_ANTICIPADA', 'HISTORIAL DE SALAS RESERVADAS ANTICIPADAS', 'HISTORIAL DE SALAS RESERVADAS ANTICIPADAMENTE', 0, NULL, NULL, NULL),
(41, 'ENTREG_SALA_RAPIDAS', 'HISTORIAL DE SALAS RESERVADAS EN EL MOMENTO', 'HISTORIAL DE SALAS RESERVADAS EN EL MOMENTO', 0, NULL, NULL, NULL),
(42, 'HISTO_EQUIPO', 'HISTORIAL DE SALAS', 'HISTORIAL DE RESERVA DE EQUIPOS', 0, NULL, NULL, NULL),
(43, 'ENTREG_EQUIPO_ANTICIPADA', 'HISTORIAL DE EQUIPOS RESERVADOS ANTICIPADAS', 'HISTORIAL DE EQUIPOS RESERVADOS ANTICIPADAMENTE', 0, NULL, NULL, NULL),
(44, 'ENTREG_EQUIPO_RAPIDAS', 'HISTORIAL DE EQUIPOS RESERVADOS EN EL MOMENTO', 'HISTORIAL DE EQUIPOS RESERVADOS EN EL MOMENTO', 0, NULL, NULL, NULL),
(45, 'ENTREG', 'ENTREGA DE RESERVACIONES', 'ENTREGA DE RESERVAS', 0, NULL, NULL, NULL),
(46, 'ENTREG_EQUIPO', 'ENTREGA DE RESERVACIONES DE EQUIPO', 'ENTREGA DE RESERVAS DE EQUIPO', 0, NULL, NULL, NULL),
(47, 'ENTREG_SALA', 'ENTREGA DE RESERVACIONES DE SALAS', 'ENTREGA DE RESERVAS DE SALAS', 0, NULL, NULL, NULL),
(48, 'DEVOLU', 'DEVOLUCION DE RESERVACIONES', 'DEVOLUCION DE RESERVAS', 0, NULL, NULL, NULL),
(49, 'DEVOLU_EQUIPO', 'DEVOLUCION DE RESERVACIONES DE EQUIPO', 'DEVOLUCION DE RESERVAS DE EQUIPO', 0, NULL, NULL, NULL),
(50, 'DEVOLU_SALA', 'DEVOLUCION DE RESERVACIONES DE SALAS', 'DEVOLUCION DE RESERVAS DE SALAS', 0, NULL, NULL, NULL),
(51, 'INV', 'INVENTARIO DEL SISTEMA', 'INVENTARIO DEL SISTEMA', 0, NULL, NULL, NULL),
(52, 'INV_EQUIPO', 'INVENTARIO DE EQUIPOS', 'INVENTARIO DE EQUIPOS', 0, NULL, NULL, NULL),
(53, 'INV_SALA', 'INVENTARIO DE SALAS', 'INVENTARIO DE SALAS', 0, NULL, NULL, NULL),
(54, 'INV_INSUMO', 'INVENTARIO DE INSUMOS', 'INVENTARIO DE INSUMOS', 0, NULL, NULL, NULL),
(55, 'CONFIG', 'CONFIGURACIONES', 'CONFIGURACION DEL SISTEMA', 0, NULL, NULL, NULL),
(56, 'CONFIG_CORREOS', 'CONFIGURACION DE CORREOS', 'CONFIGURACION DE CORREOS', 0, NULL, NULL, NULL),
(57, 'CONFIG_TIPO_USUARIOS', 'CONFIGURACION DE USUARIOS', 'CONFIGURACION DE USUARIOS', 0, NULL, NULL, NULL),
(58, 'CONFIG_USUARIOS', 'CONFIGURACION DE TIPOS DE USUARIO', 'CONFIGURACION DE TIPOS DE USUARIO', 0, NULL, NULL, NULL),
(59, 'CONFIG_ROLES', 'CONFIGURACION DE ROLES', 'CONFIGURACION DE ROLES', 0, NULL, NULL, NULL),
(60, 'INV_USO_ASIG', 'ASIGNACIONES EN USO', 'PERMISOS DEL MODULO DE ASIGNACIONES EN USO', 0, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sipa_permisos_roles`
--

CREATE TABLE `sipa_permisos_roles` (
  `sipa_permisos_roles_id` bigint(20) UNSIGNED NOT NULL,
  `sipa_permisos_roles_role` int(11) NOT NULL,
  `sipa_permisos_roles_opciones_menu` bigint(20) UNSIGNED NOT NULL,
  `sipa_permisos_roles_crear` tinyint(1) NOT NULL,
  `sipa_permisos_roles_editar` tinyint(1) NOT NULL,
  `sipa_permisos_roles_ver` tinyint(1) NOT NULL,
  `sipa_permisos_roles_borrar` bigint(20) NOT NULL,
  `sipa_permisos_roles_exportar` tinyint(1) NOT NULL,
  `sipa_permisos_roles_usuario_creador` bigint(20) UNSIGNED NOT NULL,
  `sipa_permisos_roles_usuario_actualizacion` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sipa_permisos_roles`
--

INSERT INTO `sipa_permisos_roles` (`sipa_permisos_roles_id`, `sipa_permisos_roles_role`, `sipa_permisos_roles_opciones_menu`, `sipa_permisos_roles_crear`, `sipa_permisos_roles_editar`, `sipa_permisos_roles_ver`, `sipa_permisos_roles_borrar`, `sipa_permisos_roles_exportar`, `sipa_permisos_roles_usuario_creador`, `sipa_permisos_roles_usuario_actualizacion`, `created_at`, `updated_at`) VALUES
(2, 13, 31, 1, 1, 1, 1, 1, 0, NULL, NULL, NULL),
(3, 13, 32, 1, 1, 1, 1, 1, 0, NULL, NULL, NULL),
(4, 13, 33, 1, 1, 1, 1, 1, 0, NULL, NULL, NULL),
(5, 13, 34, 1, 1, 1, 1, 1, 0, NULL, NULL, NULL),
(6, 13, 35, 1, 1, 1, 1, 1, 0, NULL, NULL, NULL),
(7, 13, 36, 1, 1, 1, 1, 1, 0, NULL, NULL, NULL),
(8, 13, 37, 1, 1, 1, 1, 1, 0, NULL, NULL, NULL),
(9, 13, 38, 1, 1, 1, 1, 1, 0, NULL, NULL, NULL),
(10, 13, 39, 1, 1, 1, 1, 1, 0, NULL, NULL, NULL),
(11, 13, 40, 1, 1, 1, 1, 1, 0, NULL, NULL, NULL),
(12, 13, 41, 1, 1, 1, 1, 1, 0, NULL, NULL, NULL),
(13, 13, 42, 1, 1, 1, 1, 1, 0, NULL, NULL, NULL),
(14, 13, 43, 1, 1, 1, 1, 1, 0, NULL, NULL, NULL),
(15, 13, 44, 1, 1, 1, 1, 1, 0, NULL, NULL, NULL),
(16, 13, 45, 1, 1, 1, 1, 1, 0, NULL, NULL, NULL),
(17, 13, 46, 1, 1, 1, 1, 1, 0, NULL, NULL, NULL),
(18, 13, 47, 1, 1, 1, 1, 1, 0, NULL, NULL, NULL),
(19, 13, 48, 1, 1, 1, 1, 1, 0, NULL, NULL, NULL),
(20, 13, 49, 1, 1, 1, 1, 1, 0, NULL, NULL, NULL),
(21, 13, 50, 1, 1, 1, 1, 1, 0, NULL, NULL, NULL),
(22, 13, 51, 1, 1, 1, 1, 1, 0, NULL, NULL, NULL),
(23, 13, 52, 1, 1, 1, 1, 1, 0, NULL, NULL, NULL),
(24, 13, 53, 1, 1, 1, 1, 1, 0, NULL, NULL, NULL),
(25, 13, 54, 1, 1, 1, 1, 1, 0, NULL, NULL, NULL),
(26, 13, 55, 1, 1, 1, 1, 1, 0, NULL, NULL, NULL),
(27, 13, 56, 1, 1, 1, 1, 1, 0, NULL, NULL, NULL),
(28, 13, 57, 1, 1, 1, 1, 1, 0, NULL, NULL, NULL),
(29, 13, 58, 1, 1, 1, 1, 1, 0, NULL, NULL, NULL),
(30, 13, 59, 1, 1, 1, 1, 1, 0, NULL, NULL, NULL),
(31, 10, 55, 1, 1, 1, 1, 1, 0, NULL, NULL, NULL),
(32, 10, 56, 1, 1, 1, 1, 1, 0, NULL, NULL, NULL),
(33, 10, 57, 1, 1, 1, 1, 1, 0, NULL, NULL, NULL),
(34, 10, 58, 1, 1, 1, 1, 1, 0, NULL, NULL, NULL),
(35, 10, 59, 1, 1, 1, 1, 1, 0, NULL, NULL, NULL),
(36, 11, 31, 1, 1, 1, 1, 1, 0, NULL, NULL, NULL),
(37, 11, 32, 1, 1, 1, 1, 1, 0, NULL, NULL, NULL),
(38, 11, 33, 1, 1, 1, 1, 1, 0, NULL, NULL, NULL),
(39, 11, 34, 1, 1, 1, 1, 1, 0, NULL, NULL, NULL),
(40, 11, 35, 1, 1, 1, 1, 1, 0, NULL, NULL, NULL),
(41, 11, 36, 1, 1, 1, 1, 1, 0, NULL, NULL, NULL),
(42, 11, 37, 1, 1, 1, 1, 1, 0, NULL, NULL, NULL),
(43, 11, 38, 1, 1, 1, 1, 1, 0, NULL, NULL, NULL),
(44, 11, 39, 1, 1, 1, 1, 1, 0, NULL, NULL, NULL),
(45, 11, 40, 1, 1, 1, 1, 1, 0, NULL, NULL, NULL),
(46, 11, 41, 1, 1, 1, 1, 1, 0, NULL, NULL, NULL),
(47, 11, 42, 1, 1, 1, 1, 1, 0, NULL, NULL, NULL),
(48, 11, 43, 1, 1, 1, 1, 1, 0, NULL, NULL, NULL),
(49, 11, 44, 1, 1, 1, 1, 1, 0, NULL, NULL, NULL),
(50, 11, 45, 1, 1, 1, 1, 1, 0, NULL, NULL, NULL),
(51, 11, 46, 1, 1, 1, 1, 1, 0, NULL, NULL, NULL),
(52, 11, 47, 1, 1, 1, 1, 1, 0, NULL, NULL, NULL),
(53, 11, 48, 1, 1, 1, 1, 1, 0, NULL, NULL, NULL),
(54, 11, 49, 1, 1, 1, 1, 1, 0, NULL, NULL, NULL),
(55, 11, 50, 1, 1, 1, 1, 1, 0, NULL, NULL, NULL),
(56, 11, 51, 1, 1, 1, 1, 1, 0, NULL, NULL, NULL),
(57, 11, 52, 1, 1, 1, 1, 1, 0, NULL, NULL, NULL),
(58, 11, 53, 1, 1, 1, 1, 1, 0, NULL, NULL, NULL),
(59, 11, 54, 1, 1, 1, 1, 1, 0, NULL, NULL, NULL),
(60, 12, 31, 1, 1, 1, 1, 1, 0, NULL, NULL, NULL),
(61, 12, 32, 1, 1, 1, 1, 1, 0, NULL, NULL, NULL),
(62, 12, 33, 1, 1, 1, 1, 1, 0, NULL, NULL, NULL),
(63, 12, 34, 1, 1, 1, 1, 1, 0, NULL, NULL, NULL),
(64, 12, 35, 1, 1, 1, 1, 1, 0, NULL, NULL, NULL),
(65, 12, 36, 1, 1, 1, 1, 1, 0, NULL, NULL, NULL),
(66, 12, 37, 1, 1, 1, 1, 1, 0, NULL, NULL, NULL),
(67, 12, 38, 1, 1, 1, 1, 1, 0, NULL, NULL, NULL),
(68, 12, 39, 1, 1, 1, 1, 1, 0, NULL, NULL, NULL),
(69, 12, 40, 1, 1, 1, 1, 1, 0, NULL, NULL, NULL),
(70, 12, 41, 1, 1, 1, 1, 1, 0, NULL, NULL, NULL),
(71, 12, 42, 1, 1, 1, 1, 1, 0, NULL, NULL, NULL),
(72, 12, 43, 1, 1, 1, 1, 1, 0, NULL, NULL, NULL),
(73, 12, 44, 1, 1, 1, 1, 1, 0, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sipa_roles`
--

CREATE TABLE `sipa_roles` (
  `sipa_roles_id` int(11) NOT NULL,
  `sipa_roles_codigo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sipa_roles_nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sipa_roles_descripcion` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `sipa_roles_usuario_creador` int(11) NOT NULL,
  `sipa_roles_usuario_actualizacion` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sipa_roles`
--

INSERT INTO `sipa_roles` (`sipa_roles_id`, `sipa_roles_codigo`, `sipa_roles_nombre`, `sipa_roles_descripcion`, `sipa_roles_usuario_creador`, `sipa_roles_usuario_actualizacion`, `created_at`, `updated_at`) VALUES
(10, 'SUPER_ADMINISTRADOR', 'SUPER ADMINISTRADOR', 'ROLE SUPER ADMINISTRADOR', 0, NULL, NULL, NULL),
(11, 'ADMINISTRADOR', 'ADMINISTRADOR', 'ROLE ADMINISTRADOR', 0, NULL, NULL, NULL),
(12, 'FUNCIONARIO', 'FUNCIONARIO', 'ROLE FUNCIONARIO', 0, NULL, NULL, NULL),
(13, 'TECNICO', 'TÉCNICO', 'ROLE DE TI', 0, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sipa_usuarios_identificacion` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sipa_usuarios_nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sipa_usuarios_telefono` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sipa_usuarios_correo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sipa_usuarios_unidad` int(11) DEFAULT NULL,
  `sipa_usuarios_edificio` int(11) DEFAULT NULL,
  `sipa_usuarios_rol` int(11) DEFAULT NULL,
  `sipa_usuarios_usuario_creador` int(11) DEFAULT NULL,
  `sipa_usuarios_usuario_actulizacion` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `sipa_usuarios_identificacion`, `sipa_usuarios_nombre`, `sipa_usuarios_telefono`, `sipa_usuarios_correo`, `sipa_usuarios_unidad`, `sipa_usuarios_edificio`, `sipa_usuarios_rol`, `sipa_usuarios_usuario_creador`, `sipa_usuarios_usuario_actulizacion`, `created_at`, `updated_at`) VALUES
(0, '116870078', 'Lea Cárdenas', '89125443', 'lea.cardenas14@gmail.com', NULL, NULL, 13, 0, NULL, '2019-10-24 06:00:00', NULL),
(2, '207630059', 'Fiorella Salgado', '84442868', 'fiorella5674@gmail.com', NULL, NULL, 10, NULL, NULL, '2019-10-23 06:00:00', NULL),
(3, '801030879', 'Rachel Basulto', '87038654', 'rbasulto1141@hotmail.com', NULL, NULL, 11, 0, NULL, '2019-10-24 06:00:00', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`(191));

--
-- Indexes for table `sipa_activos`
--
ALTER TABLE `sipa_activos`
  ADD PRIMARY KEY (`sipa_activos_id`),
  ADD KEY `sipa_activos_responsable_fk` (`sipa_activos_responsable`),
  ADD KEY `sipa_activos_encargado_fk` (`sipa_activos_encargado`);

--
-- Indexes for table `sipa_edificios`
--
ALTER TABLE `sipa_edificios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sipa_edificios_nombre_UNIQUE` (`sipa_edificios_nombre`);

--
-- Indexes for table `sipa_edificios_unidades`
--
ALTER TABLE `sipa_edificios_unidades`
  ADD PRIMARY KEY (`sipa_edificios_unidades_id`),
  ADD KEY `sipa_edificios_unidades_fk_idx` (`sipa_edificios_unidades_edificio`);

--
-- Indexes for table `sipa_opciones_menus`
--
ALTER TABLE `sipa_opciones_menus`
  ADD PRIMARY KEY (`sipa_opciones_menu_id`),
  ADD KEY `modulo_fk_usuarioCreador` (`sipa_opciones_menu_usuario_creador`),
  ADD KEY `modulo_fk_usuarioActualizacion` (`sipa_opciones_menu_usuario_actualizacion`);

--
-- Indexes for table `sipa_permisos_roles`
--
ALTER TABLE `sipa_permisos_roles`
  ADD PRIMARY KEY (`sipa_permisos_roles_id`),
  ADD KEY `permisos_fk_rol` (`sipa_permisos_roles_role`),
  ADD KEY `permisos_fk_modulo` (`sipa_permisos_roles_opciones_menu`),
  ADD KEY `permisos_fk_usuarioCreador` (`sipa_permisos_roles_usuario_creador`),
  ADD KEY `permisos_fk_usuarioActualizacion` (`sipa_permisos_roles_usuario_actualizacion`);

--
-- Indexes for table `sipa_roles`
--
ALTER TABLE `sipa_roles`
  ADD PRIMARY KEY (`sipa_roles_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_fk_rol` (`sipa_usuarios_rol`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sipa_activos`
--
ALTER TABLE `sipa_activos`
  MODIFY `sipa_activos_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sipa_edificios`
--
ALTER TABLE `sipa_edificios`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sipa_edificios_unidades`
--
ALTER TABLE `sipa_edificios_unidades`
  MODIFY `sipa_edificios_unidades_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sipa_opciones_menus`
--
ALTER TABLE `sipa_opciones_menus`
  MODIFY `sipa_opciones_menu_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `sipa_permisos_roles`
--
ALTER TABLE `sipa_permisos_roles`
  MODIFY `sipa_permisos_roles_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `sipa_roles`
--
ALTER TABLE `sipa_roles`
  MODIFY `sipa_roles_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `sipa_activos`
--
ALTER TABLE `sipa_activos`
  ADD CONSTRAINT `sipa_activos_encargado_fk` FOREIGN KEY (`sipa_activos_encargado`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sipa_edificios_unidades`
--
ALTER TABLE `sipa_edificios_unidades`
  ADD CONSTRAINT `sipa_edificios_unidades_fk` FOREIGN KEY (`sipa_edificios_unidades_edificio`) REFERENCES `sipa_edificios` (`id`);

--
-- Constraints for table `sipa_opciones_menus`
--
ALTER TABLE `sipa_opciones_menus`
  ADD CONSTRAINT `modulo_fk_usuarioActualizacion` FOREIGN KEY (`sipa_opciones_menu_usuario_actualizacion`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `modulo_fk_usuarioCreador` FOREIGN KEY (`sipa_opciones_menu_usuario_creador`) REFERENCES `users` (`id`);

--
-- Constraints for table `sipa_permisos_roles`
--
ALTER TABLE `sipa_permisos_roles`
  ADD CONSTRAINT `permisos_fk_modulo` FOREIGN KEY (`sipa_permisos_roles_opciones_menu`) REFERENCES `sipa_opciones_menus` (`sipa_opciones_menu_id`),
  ADD CONSTRAINT `permisos_fk_rol` FOREIGN KEY (`sipa_permisos_roles_role`) REFERENCES `sipa_roles` (`sipa_roles_id`),
  ADD CONSTRAINT `permisos_fk_usuarioActualizacion` FOREIGN KEY (`sipa_permisos_roles_usuario_actualizacion`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `permisos_fk_usuarioCreador` FOREIGN KEY (`sipa_permisos_roles_usuario_creador`) REFERENCES `users` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `usuario_fk_rol` FOREIGN KEY (`sipa_usuarios_rol`) REFERENCES `sipa_roles` (`sipa_roles_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
