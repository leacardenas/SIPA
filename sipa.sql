-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 18, 2019 at 12:51 AM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.1.32

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

DROP TABLE IF EXISTS `failed_jobs`;
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

DROP TABLE IF EXISTS `migrations`;
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

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sipa_activos`
--

DROP TABLE IF EXISTS `sipa_activos`;
CREATE TABLE `sipa_activos` (
  `sipa_activos_id` int(11) NOT NULL,
  `sipa_activos_codigo` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sipa_activos_nombre` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sipa_activos_descripcion` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sipa_activos_fecha_creacion` timestamp NULL DEFAULT NULL,
  `sipa_activos_usuario_creador` int(11) DEFAULT NULL,
  `sipa_activos_fecha_actualizacion` timestamp NULL DEFAULT NULL,
  `sipa_activos_usuario_actualizacion` int(11) DEFAULT NULL,
  `sipa_activos_precio` double DEFAULT NULL,
  `sipa_activos_estado` int(11) NOT NULL,
  `sipa_activos_foto` blob DEFAULT NULL,
  `sipa_activos_edificio` int(11) NOT NULL,
  `sipa_activos_ubicacion` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sipa_activos_encargado` int(11) NOT NULL,
  `sipa_activos_duenio` int(11) NOT NULL,
  `sipa_activos_marca` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sipa_activos_modelo` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sipa_activos_serie` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sipa_edificios`
--

DROP TABLE IF EXISTS `sipa_edificios`;
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

DROP TABLE IF EXISTS `sipa_edificios_unidades`;
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
(3, 'secretariado', 1),
(4, 'investigacion', 2),
(5, 'auditorio', 2);

-- --------------------------------------------------------

--
-- Table structure for table `sipa_opciones_menus`
--

DROP TABLE IF EXISTS `sipa_opciones_menus`;
CREATE TABLE `sipa_opciones_menus` (
  `sipa_opciones_menu_id` bigint(20) UNSIGNED NOT NULL,
  `sipa_opciones_menu_codigo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sipa_opciones_menu_nombre` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sipa_opciones_menu_descripcion` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `sipa_opciones_menu_usuario_creador` int(11) NOT NULL,
  `sipa_opciones_menu_usuario_actualizacion` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sipa_permisos_roles`
--

DROP TABLE IF EXISTS `sipa_permisos_roles`;
CREATE TABLE `sipa_permisos_roles` (
  `sipa_permisos_roles_id` bigint(20) UNSIGNED NOT NULL,
  `sipa_permisos_roles_role` int(11) NOT NULL,
  `sipa_permisos_roles_opciones_menu` int(11) NOT NULL,
  `sipa_permisos_roles_crear` tinyint(1) NOT NULL,
  `sipa_permisos_roles_editar` tinyint(1) NOT NULL,
  `sipa_permisos_roles_ver` tinyint(1) NOT NULL,
  `sipa_permisos_roles_exportar` tinyint(1) NOT NULL,
  `sipa_permisos_roles_usuario_creador` int(11) NOT NULL,
  `sipa_permisos_roles_usuario_actualizacion` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sipa_roles`
--

DROP TABLE IF EXISTS `sipa_roles`;
CREATE TABLE `sipa_roles` (
  `sipa_roles_id` bigint(20) NOT NULL,
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
(1, 'Admin', 'Administrador', 'Administrador de toda la informacion general del sistema', 1, NULL, '2019-10-31 08:12:13', NULL),
(2, 'SAdmin', 'Super Administrador', 'Usuario que tiene acceso a todos los features del sistema', 1, NULL, '2019-10-31 08:12:13', NULL),
(3, 'ADM2', 'Administrador2', 'administra', 116570271, NULL, '2019-10-03 11:52:07', '2019-10-03 11:52:07'),
(4, 'func', 'funcionario', 'reserva', 116570271, NULL, '2019-10-03 12:02:59', '2019-10-03 12:02:59'),
(5, 'USUR1', 'usuario1', 'manejo activos', 116570271, NULL, '2019-10-05 04:37:12', '2019-10-05 04:37:12');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sipa_usuarios_identificacion` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sipa_usuarios_apellidos` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sipa_usuarios_telefono` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sipa_usuarios_unidad` int(11) DEFAULT NULL,
  `sipa_usuarios_edificio` int(11) DEFAULT NULL,
  `sipa_usuarios_rol` int(11) DEFAULT NULL,
  `sipa_usuarios_usuario_creador` int(11) DEFAULT NULL,
  `sipa_usuarios_usuario_actulizacion` int(11) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `sipa_usuarios_identificacion`, `name`, `sipa_usuarios_apellidos`, `sipa_usuarios_telefono`, `email`, `sipa_usuarios_unidad`, `sipa_usuarios_edificio`, `sipa_usuarios_rol`, `sipa_usuarios_usuario_creador`, `sipa_usuarios_usuario_actulizacion`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, '123', 'Lea', NULL, NULL, 'lea.cardenas@toursys.net', NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$EsYzUVD1NB24m5qL3tQ8pOpUlH26czL3leNtHD1PQms0OJYM.xMla', NULL, '2019-10-01 22:09:32', '2019-10-01 22:09:32'),
(2, '116570271', 'bryan', 'garro eduarte', '85916085', 'bryangarroeduarte@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, '2510', NULL, NULL, NULL),
(3, 'asdasd', 'asd', NULL, NULL, 'asda', NULL, NULL, NULL, NULL, NULL, NULL, 'asdasd', NULL, '2019-10-04 01:39:15', '2019-10-04 01:39:15'),
(4, 'fiorella', 'Bryan Garro Eduarte', NULL, NULL, 'eduarte@hotmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 'not neccesary', NULL, '2019-10-05 03:58:18', '2019-10-05 03:58:18'),
(5, '123456789', 'Bryan Garro Eduarte', NULL, '70235532', 'eduarte@hotmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 'not neccesary', NULL, '2019-10-05 04:09:44', '2019-10-05 04:09:44'),
(6, 'adsasd', 'Bryan Garro Eduarte', NULL, NULL, 'eduarte@hotmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 'not neccesary', NULL, '2019-10-16 01:35:04', '2019-10-16 01:35:04');

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
  ADD PRIMARY KEY (`sipa_activos_id`);

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
  ADD PRIMARY KEY (`sipa_opciones_menu_id`);

--
-- Indexes for table `sipa_permisos_roles`
--
ALTER TABLE `sipa_permisos_roles`
  ADD PRIMARY KEY (`sipa_permisos_roles_id`);

--
-- Indexes for table `sipa_roles`
--
ALTER TABLE `sipa_roles`
  ADD PRIMARY KEY (`sipa_roles_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sipa_activos`
--
ALTER TABLE `sipa_activos`
  MODIFY `sipa_activos_id` int(11) NOT NULL AUTO_INCREMENT;

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
  MODIFY `sipa_opciones_menu_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sipa_permisos_roles`
--
ALTER TABLE `sipa_permisos_roles`
  MODIFY `sipa_permisos_roles_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sipa_roles`
--
ALTER TABLE `sipa_roles`
  MODIFY `sipa_roles_id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `sipa_edificios_unidades`
--
ALTER TABLE `sipa_edificios_unidades`
  ADD CONSTRAINT `sipa_edificios_unidades_fk` FOREIGN KEY (`sipa_edificios_unidades_edificio`) REFERENCES `sipa_edificios` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
