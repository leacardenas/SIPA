-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-10-2019 a las 20:49:13
-- Versión del servidor: 10.1.38-MariaDB
-- Versión de PHP: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sipa`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
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
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sipa_activos`
--

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
  `sipa_activos_foto` blob,
  `sipa_activos_edificio` int(11) NOT NULL,
  `sipa_activos_ubicacion` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sipa_activos_encargado` bigint(20) UNSIGNED NOT NULL,
  `sipa_activos_responsable` bigint(20) UNSIGNED NOT NULL,
  `sipa_activos_marca` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sipa_activos_modelo` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sipa_activos_serie` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sipa_edificios`
--

CREATE TABLE `sipa_edificios` (
  `id` int(10) UNSIGNED NOT NULL,
  `sipa_edificios_nombre` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sipa_edificios_cantidad_pisos` int(10) UNSIGNED NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `sipa_edificios`
--

INSERT INTO `sipa_edificios` (`id`, `sipa_edificios_nombre`, `sipa_edificios_cantidad_pisos`) VALUES
(1, 'Informatica', 2),
(2, 'Emprendimiento', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sipa_edificios_unidades`
--

CREATE TABLE `sipa_edificios_unidades` (
  `sipa_edificios_unidades_id` int(10) UNSIGNED NOT NULL,
  `sipa_edificios_unidades_nombre` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sipa_edificios_unidades_edificio` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `sipa_edificios_unidades`
--

INSERT INTO `sipa_edificios_unidades` (`sipa_edificios_unidades_id`, `sipa_edificios_unidades_nombre`, `sipa_edificios_unidades_edificio`) VALUES
(1, 'contabilidad', 1),
(3, 'secretariado', 1),
(4, 'investigacion', 2),
(5, 'auditorio', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sipa_opciones_menus`
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
-- Volcado de datos para la tabla `sipa_opciones_menus`
--

INSERT INTO `sipa_opciones_menus` (`sipa_opciones_menu_id`, `sipa_opciones_menu_codigo`, `sipa_opciones_menu_nombre`, `sipa_opciones_menu_descripcion`, `sipa_opciones_menu_usuario_creador`, `sipa_opciones_menu_usuario_actualizacion`, `created_at`, `updated_at`) VALUES
(1, 'ACTV', 'ACTIVO', 'Todo lo relacionado con Activos', 2, 2, '2019-10-31 08:12:13', '2019-10-31 12:10:03');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sipa_permisos_roles`
--

CREATE TABLE `sipa_permisos_roles` (
  `sipa_permisos_roles_id` bigint(20) UNSIGNED NOT NULL,
  `sipa_permisos_roles_role` int(11) NOT NULL,
  `sipa_permisos_roles_opciones_menu` bigint(20) UNSIGNED NOT NULL,
  `sipa_permisos_roles_crear` tinyint(1) NOT NULL,
  `sipa_permisos_roles_editar` tinyint(1) NOT NULL,
  `sipa_permisos_roles_ver` tinyint(1) NOT NULL,
  `sipa_permisos_roles_exportar` tinyint(1) NOT NULL,
  `sipa_permisos_roles_usuario_creador` bigint(20) UNSIGNED NOT NULL,
  `sipa_permisos_roles_usuario_actualizacion` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `sipa_permisos_roles`
--

INSERT INTO `sipa_permisos_roles` (`sipa_permisos_roles_id`, `sipa_permisos_roles_role`, `sipa_permisos_roles_opciones_menu`, `sipa_permisos_roles_crear`, `sipa_permisos_roles_editar`, `sipa_permisos_roles_ver`, `sipa_permisos_roles_exportar`, `sipa_permisos_roles_usuario_creador`, `sipa_permisos_roles_usuario_actualizacion`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 1, 1, 1, 2, 2, '2019-10-31 08:12:13', '2019-10-31 12:10:03');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sipa_roles`
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
-- Volcado de datos para la tabla `sipa_roles`
--

INSERT INTO `sipa_roles` (`sipa_roles_id`, `sipa_roles_codigo`, `sipa_roles_nombre`, `sipa_roles_descripcion`, `sipa_roles_usuario_creador`, `sipa_roles_usuario_actualizacion`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'Administrador', 'Administrador de toda la informacion general del sistema', 1, NULL, '2019-10-31 08:12:13', NULL),
(2, 'SAdmin', 'Super Administrador', 'Usuario que tiene acceso a todos los features del sistema', 1, NULL, '2019-10-31 08:12:13', NULL),
(3, 'ADM2', 'Administrador2', 'administra', 116570271, NULL, '2019-10-03 11:52:07', '2019-10-03 11:52:07'),
(4, 'func', 'funcionario', 'reserva', 116570271, NULL, '2019-10-03 12:02:59', '2019-10-03 12:02:59'),
(5, 'USUR1', 'usuario1', 'manejo activos', 116570271, NULL, '2019-10-05 04:37:12', '2019-10-05 04:37:12');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
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
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `sipa_usuarios_identificacion`, `sipa_usuarios_nombre`, `sipa_usuarios_telefono`, `sipa_usuarios_correo`, `sipa_usuarios_unidad`, `sipa_usuarios_edificio`, `sipa_usuarios_rol`, `sipa_usuarios_usuario_creador`, `sipa_usuarios_usuario_actulizacion`, `created_at`, `updated_at`) VALUES
(1, '123', 'Lea', NULL, 'lea.cardenas@toursys.net', NULL, NULL, 1, NULL, NULL, '2019-10-01 22:09:32', '2019-10-01 22:09:32'),
(2, '116570271', 'bryan', '85916085', 'bryangarroeduarte@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 'asdasd', 'asd', NULL, 'asda', NULL, NULL, NULL, NULL, NULL, '2019-10-04 01:39:15', '2019-10-04 01:39:15'),
(4, 'fiorella', 'Bryan Garro Eduarte', NULL, 'eduarte@hotmail.com', NULL, NULL, NULL, NULL, NULL, '2019-10-05 03:58:18', '2019-10-05 03:58:18'),
(5, '123456789', 'Bryan Garro Eduarte', '70235532', 'eduarte@hotmail.com', NULL, NULL, NULL, NULL, NULL, '2019-10-05 04:09:44', '2019-10-05 04:09:44'),
(6, 'adsasd', 'Bryan Garro Eduarte', NULL, 'eduarte@hotmail.com', NULL, NULL, NULL, NULL, NULL, '2019-10-16 01:35:04', '2019-10-16 01:35:04'),
(7, 'ssss', 'Bryan Garro Eduarte', NULL, 'eduarte@hotmail.com', NULL, NULL, NULL, NULL, NULL, '2019-10-19 06:28:41', '2019-10-19 06:28:41');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`(191));

--
-- Indices de la tabla `sipa_activos`
--
ALTER TABLE `sipa_activos`
  ADD PRIMARY KEY (`sipa_activos_id`),
  ADD KEY `sipa_activos_responsable_fk` (`sipa_activos_responsable`),
  ADD KEY `sipa_activos_encargado_fk` (`sipa_activos_encargado`);

--
-- Indices de la tabla `sipa_edificios`
--
ALTER TABLE `sipa_edificios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sipa_edificios_nombre_UNIQUE` (`sipa_edificios_nombre`);

--
-- Indices de la tabla `sipa_edificios_unidades`
--
ALTER TABLE `sipa_edificios_unidades`
  ADD PRIMARY KEY (`sipa_edificios_unidades_id`),
  ADD KEY `sipa_edificios_unidades_fk_idx` (`sipa_edificios_unidades_edificio`);

--
-- Indices de la tabla `sipa_opciones_menus`
--
ALTER TABLE `sipa_opciones_menus`
  ADD PRIMARY KEY (`sipa_opciones_menu_id`),
  ADD KEY `modulo_fk_usuarioCreador` (`sipa_opciones_menu_usuario_creador`),
  ADD KEY `modulo_fk_usuarioActualizacion` (`sipa_opciones_menu_usuario_actualizacion`);

--
-- Indices de la tabla `sipa_permisos_roles`
--
ALTER TABLE `sipa_permisos_roles`
  ADD PRIMARY KEY (`sipa_permisos_roles_id`),
  ADD KEY `permisos_fk_rol` (`sipa_permisos_roles_role`),
  ADD KEY `permisos_fk_modulo` (`sipa_permisos_roles_opciones_menu`),
  ADD KEY `permisos_fk_usuarioCreador` (`sipa_permisos_roles_usuario_creador`),
  ADD KEY `permisos_fk_usuarioActualizacion` (`sipa_permisos_roles_usuario_actualizacion`);

--
-- Indices de la tabla `sipa_roles`
--
ALTER TABLE `sipa_roles`
  ADD PRIMARY KEY (`sipa_roles_id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_fk_rol` (`sipa_usuarios_rol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `sipa_edificios`
--
ALTER TABLE `sipa_edificios`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `sipa_edificios_unidades`
--
ALTER TABLE `sipa_edificios_unidades`
  MODIFY `sipa_edificios_unidades_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `sipa_opciones_menus`
--
ALTER TABLE `sipa_opciones_menus`
  MODIFY `sipa_opciones_menu_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `sipa_permisos_roles`
--
ALTER TABLE `sipa_permisos_roles`
  MODIFY `sipa_permisos_roles_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `sipa_roles`
--
ALTER TABLE `sipa_roles`
  MODIFY `sipa_roles_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `sipa_activos`
--
ALTER TABLE `sipa_activos`
  ADD CONSTRAINT `sipa_activos_encargado_fk` FOREIGN KEY (`sipa_activos_encargado`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `sipa_edificios_unidades`
--
ALTER TABLE `sipa_edificios_unidades`
  ADD CONSTRAINT `sipa_edificios_unidades_fk` FOREIGN KEY (`sipa_edificios_unidades_edificio`) REFERENCES `sipa_edificios` (`id`);

--
-- Filtros para la tabla `sipa_opciones_menus`
--
ALTER TABLE `sipa_opciones_menus`
  ADD CONSTRAINT `modulo_fk_usuarioActualizacion` FOREIGN KEY (`sipa_opciones_menu_usuario_actualizacion`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `modulo_fk_usuarioCreador` FOREIGN KEY (`sipa_opciones_menu_usuario_creador`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `sipa_permisos_roles`
--
ALTER TABLE `sipa_permisos_roles`
  ADD CONSTRAINT `permisos_fk_modulo` FOREIGN KEY (`sipa_permisos_roles_opciones_menu`) REFERENCES `sipa_opciones_menus` (`sipa_opciones_menu_id`),
  ADD CONSTRAINT `permisos_fk_rol` FOREIGN KEY (`sipa_permisos_roles_role`) REFERENCES `sipa_roles` (`sipa_roles_id`),
  ADD CONSTRAINT `permisos_fk_usuarioActualizacion` FOREIGN KEY (`sipa_permisos_roles_usuario_actualizacion`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `permisos_fk_usuarioCreador` FOREIGN KEY (`sipa_permisos_roles_usuario_creador`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `usuario_fk_rol` FOREIGN KEY (`sipa_usuarios_rol`) REFERENCES `sipa_roles` (`sipa_roles_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
