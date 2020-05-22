-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 22, 2020 at 02:17 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.27

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
(2, 'RESERVAR', 'RESERVAR', 'PERMISOS DEL MODULO DE RESERVAS DE SALAS', 1, NULL, NULL, NULL),
(3, 'RESERVAR_SALA', 'RESERVAR SALA', 'PERMISOS DEL MODULO DE RESERVAS DE SALAS', 1, NULL, NULL, NULL),
(4, 'RESERVAR_ACTIVO', 'RESERVAR ACTIVO', 'PERMISOS DEL MODULO DE RESERVAS DE ACTIVO', 1, NULL, NULL, NULL),
(9, 'HISTO', 'HISTORIAL', 'HISTORIAL', 1, NULL, NULL, NULL),
(10, 'HISTO_SALA', 'HISTORIAL DE SALAS', 'HISTORIAL DE RESERVA DE SALAS', 1, NULL, NULL, NULL),
(13, 'HISTO_ACTIVO', 'HISTORIAL DE ACTIVO', 'HISTORIAL DE RESERVA DE ACTIVO', 1, NULL, NULL, NULL),
(16, 'ENTREG', 'ENTREGA DE RESERVACIONES', 'ENTREGA DE RESERVAS', 1, NULL, NULL, NULL),
(17, 'ENTREG_ACTIVO', 'ENTREGA DE RESERVACIONES DE ACTIVO', 'ENTREGA DE RESERVAS DE ACTIVO', 1, NULL, NULL, NULL),
(18, 'ENTREG_SALA', 'ENTREGA DE RESERVACIONES DE SALAS', 'ENTREGA DE RESERVAS DE SALAS', 1, NULL, NULL, NULL),
(19, 'DEVOLU', 'DEVOLUCION DE RESERVACIONES', 'DEVOLUCION DE RESERVAS', 1, NULL, NULL, NULL),
(20, 'DEVOLU_ACTIVO', 'DEVOLUCION DE RESERVACIONES DE ACTIVO', 'DEVOLUCION DE RESERVAS DE ACTIVO', 1, NULL, NULL, NULL),
(21, 'DEVOLU_SALA', 'DEVOLUCION DE RESERVACIONES DE SALAS', 'DEVOLUCION DE RESERVAS DE SALAS', 1, NULL, NULL, NULL),
(22, 'INV', 'INVENTARIO DEL SISTEMA', 'INVENTARIO DEL SISTEMA', 1, NULL, NULL, NULL),
(23, 'INV_ACTIVO', 'INVENTARIO DE ACTIVO', 'INVENTARIO DE ACTIVO', 1, NULL, NULL, NULL),
(24, 'INV_SALA', 'INVENTARIO DE SALAS', 'INVENTARIO DE SALAS', 1, NULL, NULL, NULL),
(25, 'INV_INSUMO', 'INVENTARIO DE INSUMOS', 'INVENTARIO DE INSUMOS', 1, NULL, NULL, NULL),
(26, 'CONFIG', 'CONFIGURACIONES', 'CONFIGURACION DEL SISTEMA', 1, NULL, NULL, NULL),
(27, 'CONFIG_CORREOS', 'CONFIGURACION DE CORREOS', 'CONFIGURACION DE CORREOS', 1, NULL, NULL, NULL),
(28, 'CONFIG_TIPO_USUARIOS', 'CONFIGURACION DE USUARIOS', 'CONFIGURACION DE USUARIOS', 1, NULL, NULL, NULL),
(29, 'CONFIG_USUARIOS', 'CONFIGURACION DE TIPOS DE USUARIO', 'CONFIGURACION DE TIPOS DE USUARIO', 1, NULL, NULL, NULL),
(30, 'CONFIG_ROLES', 'CONFIGURACION DE ROLES', 'CONFIGURACION DE ROLES', 1, NULL, NULL, NULL),
(33, 'RESERVAS', 'RESERVAS', 'OPCIONES RELACIONADAS A RESERVAS (HISOTRIAL, ENTREGAS Y DEVOLUCIONES)', 1, NULL, NULL, NULL),
(34, 'MIS_RESERVAS', 'MIS_RESERVAS', 'OPCION PARA VER LAS RESERVAS DEL FUNCIONARIO', 1, NULL, NULL, NULL),
(35, 'MIS_RESERVAS_ACTIVO', 'MIS_RESERVAS_ACTIVO', 'OPCIONES PARA VER LAS RESERVAS DE ACTIVOS DEL FUNCIONARIO', 1, NULL, NULL, NULL),
(36, 'MIS_RESERVAS_SALA', 'MIS_RESERVAS_SALA', 'OPCIONES PARA VER LAS RESERVAS DE SALAS DEL FUNCIONARIO', 1, NULL, NULL, NULL),
(37, 'MI_INV', 'MI_INV', 'OPCION PARA VER INVENTARIO DEL FUNCIONARIO', 1, NULL, NULL, NULL),
(38, 'MI_INV_ACTIVO', 'MI_INV_ACTIVO', 'OPCION PARA VER INVENTARIO DE ACTIVOS DEL FUNCIONARIO', 1, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sipa_permisos_roles`
--

CREATE TABLE `sipa_permisos_roles` (
  `sipa_permisos_roles_id` bigint(20) UNSIGNED NOT NULL,
  `sipa_permisos_roles_role` int(11) NOT NULL,
  `sipa_permisos_roles_opciones_menu` bigint(20) UNSIGNED NOT NULL,
  `sipa_permisos_roles_opcion_menu_codigo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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

INSERT INTO `sipa_permisos_roles` (`sipa_permisos_roles_id`, `sipa_permisos_roles_role`, `sipa_permisos_roles_opciones_menu`, `sipa_permisos_roles_opcion_menu_codigo`, `sipa_permisos_roles_crear`, `sipa_permisos_roles_editar`, `sipa_permisos_roles_ver`, `sipa_permisos_roles_borrar`, `sipa_permisos_roles_exportar`, `sipa_permisos_roles_usuario_creador`, `sipa_permisos_roles_usuario_actualizacion`, `created_at`, `updated_at`) VALUES
(224, 17, 2, 'RESERVAR', 1, 1, 1, 1, 1, 3, NULL, '2020-05-22 06:10:45', '2020-05-22 06:10:45'),
(225, 17, 3, 'RESERVAR_SALA', 1, 1, 1, 1, 1, 3, NULL, '2020-05-22 06:10:45', '2020-05-22 06:10:45'),
(226, 17, 4, 'RESERVAR_ACTIVO', 1, 1, 1, 1, 1, 3, NULL, '2020-05-22 06:10:45', '2020-05-22 06:10:45'),
(227, 17, 34, 'MIS_RESERVAS', 1, 1, 1, 1, 1, 3, NULL, '2020-05-22 06:10:45', '2020-05-22 06:10:45'),
(228, 17, 36, 'MIS_RESERVAS_SALA', 1, 1, 1, 1, 1, 3, NULL, '2020-05-22 06:10:45', '2020-05-22 06:10:45'),
(229, 17, 35, 'MIS_RESERVAS_ACTIVO', 1, 1, 1, 1, 1, 3, NULL, '2020-05-22 06:10:45', '2020-05-22 06:10:45'),
(230, 17, 16, 'ENTREG', 1, 1, 1, 1, 1, 3, NULL, '2020-05-22 06:10:45', '2020-05-22 06:10:45'),
(231, 17, 18, 'ENTREG_SALA', 1, 1, 1, 1, 1, 3, NULL, '2020-05-22 06:10:45', '2020-05-22 06:10:45'),
(232, 17, 17, 'ENTREG_ACTIVO', 1, 1, 1, 1, 1, 3, NULL, '2020-05-22 06:10:45', '2020-05-22 06:10:45'),
(233, 17, 19, 'DEVOLU', 1, 1, 1, 1, 1, 3, NULL, '2020-05-22 06:10:45', '2020-05-22 06:10:45'),
(234, 17, 21, 'DEVOLU_SALA', 1, 1, 1, 1, 1, 3, NULL, '2020-05-22 06:10:45', '2020-05-22 06:10:45'),
(235, 17, 20, 'DEVOLU_ACTIVO', 1, 1, 1, 1, 1, 3, NULL, '2020-05-22 06:10:45', '2020-05-22 06:10:45'),
(236, 17, 22, 'INV', 1, 1, 1, 1, 1, 3, NULL, '2020-05-22 06:10:45', '2020-05-22 06:10:45'),
(237, 17, 24, 'INV_SALA', 1, 1, 1, 1, 1, 3, NULL, '2020-05-22 06:10:45', '2020-05-22 06:10:45'),
(238, 17, 23, 'INV_ACTIVO', 1, 1, 1, 1, 1, 3, NULL, '2020-05-22 06:10:45', '2020-05-22 06:10:45'),
(239, 17, 25, 'INV_INSUMO', 1, 1, 1, 1, 1, 3, NULL, '2020-05-22 06:10:45', '2020-05-22 06:10:45'),
(240, 17, 37, 'MI_INV', 0, 0, 0, 0, 0, 3, NULL, '2020-05-22 06:10:45', '2020-05-22 06:10:45'),
(241, 17, 38, 'MI_INV_ACTIVO', 0, 0, 0, 0, 0, 3, NULL, '2020-05-22 06:10:45', '2020-05-22 06:10:45'),
(242, 17, 9, 'HISTO', 1, 1, 1, 1, 1, 3, NULL, '2020-05-22 06:10:45', '2020-05-22 06:10:45'),
(243, 17, 10, 'HISTO_SALA', 1, 1, 1, 1, 1, 3, NULL, '2020-05-22 06:10:45', '2020-05-22 06:10:45'),
(244, 17, 13, 'HISTO_ACTIVO', 1, 1, 1, 1, 1, 3, NULL, '2020-05-22 06:10:45', '2020-05-22 06:10:45'),
(245, 17, 26, 'CONFIG', 1, 1, 1, 1, 1, 3, NULL, '2020-05-22 06:10:45', '2020-05-22 06:10:45'),
(246, 17, 27, 'CONFIG_CORREOS', 1, 1, 1, 1, 1, 3, NULL, '2020-05-22 06:10:45', '2020-05-22 06:10:45'),
(247, 17, 28, 'CONFIG_TIPO_USUARIOS', 1, 1, 1, 1, 1, 3, NULL, '2020-05-22 06:10:45', '2020-05-22 06:10:45'),
(248, 17, 29, 'CONFIG_USUARIOS', 1, 1, 1, 1, 1, 3, NULL, '2020-05-22 06:10:45', '2020-05-22 06:10:45'),
(249, 17, 30, 'CONFIG_ROLES', 1, 1, 1, 1, 1, 3, NULL, '2020-05-22 06:10:45', '2020-05-22 06:10:45');

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
(17, 'USUARIO TECNICO', 'USUARIO TECNICO', 'USUARIO TECNICO', 3, NULL, '2020-05-22 06:10:45', '2020-05-22 06:10:45');

-- --------------------------------------------------------

--
-- Table structure for table `sipa_usuarios`
--

CREATE TABLE `sipa_usuarios` (
  `sipa_usuarios_id` bigint(20) UNSIGNED NOT NULL,
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
-- Dumping data for table `sipa_usuarios`
--

INSERT INTO `sipa_usuarios` (`sipa_usuarios_id`, `sipa_usuarios_identificacion`, `sipa_usuarios_nombre`, `sipa_usuarios_telefono`, `sipa_usuarios_correo`, `sipa_usuarios_unidad`, `sipa_usuarios_edificio`, `sipa_usuarios_rol`, `sipa_usuarios_usuario_creador`, `sipa_usuarios_usuario_actulizacion`, `created_at`, `updated_at`) VALUES
(1, '207630059', 'FIORELLA SALGADO RODRIGUEZ', '84442868', 'bryangarroeduarte@gmail.com', NULL, NULL, 17, NULL, NULL, NULL, NULL),
(2, '123456789', 'EMMA PIZARRO SALGADO', '12345678', 'blabla@gmail.com', NULL, NULL, 17, 1, NULL, NULL, '2020-05-12 08:26:37'),
(3, 'puta', 'Bryan Garro Eduarte', '+506 8912-5443', 'eduarte@hotmail.com', NULL, NULL, 17, NULL, NULL, '2019-11-14 11:51:19', '2019-11-14 13:02:45'),
(7, '12345678', 'Bryan Garro Eduarte', '+506 8569-4126', 'eduarte@hotmail.com', NULL, NULL, 17, NULL, NULL, '2020-03-02 16:15:22', '2020-05-09 13:15:43'),
(8, '12345678', 'Bryan Garro Eduarte', '+506 8569-4126', 'eduarte@hotmail.com', NULL, NULL, NULL, NULL, NULL, '2020-03-02 16:21:31', '2020-03-02 16:21:31'),
(9, 'test', 'Bryan Garro Eduarte', '+506 5555-5555', 'eduarte@hotmail.com', NULL, NULL, 17, NULL, NULL, '2020-05-09 13:16:13', '2020-05-09 13:16:38');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sipa_opciones_menus`
--
ALTER TABLE `sipa_opciones_menus`
  ADD PRIMARY KEY (`sipa_opciones_menu_id`),
  ADD KEY `modulo_fk_usuarioActualizacion` (`sipa_opciones_menu_usuario_actualizacion`),
  ADD KEY `modulo_fk_usuarioCreador` (`sipa_opciones_menu_usuario_creador`);

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
-- Indexes for table `sipa_usuarios`
--
ALTER TABLE `sipa_usuarios`
  ADD PRIMARY KEY (`sipa_usuarios_id`),
  ADD KEY `usuario_fk_rol` (`sipa_usuarios_rol`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sipa_opciones_menus`
--
ALTER TABLE `sipa_opciones_menus`
  MODIFY `sipa_opciones_menu_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `sipa_permisos_roles`
--
ALTER TABLE `sipa_permisos_roles`
  MODIFY `sipa_permisos_roles_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=250;

--
-- AUTO_INCREMENT for table `sipa_roles`
--
ALTER TABLE `sipa_roles`
  MODIFY `sipa_roles_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `sipa_usuarios`
--
ALTER TABLE `sipa_usuarios`
  MODIFY `sipa_usuarios_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
