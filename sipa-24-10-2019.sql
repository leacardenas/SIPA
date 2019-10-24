-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 24, 2019 at 12:10 PM
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

--
-- Indexes for dumped tables
--

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sipa_permisos_roles`
--
ALTER TABLE `sipa_permisos_roles`
  MODIFY `sipa_permisos_roles_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `sipa_permisos_roles`
--
ALTER TABLE `sipa_permisos_roles`
  ADD CONSTRAINT `permisos_fk_modulo` FOREIGN KEY (`sipa_permisos_roles_opciones_menu`) REFERENCES `sipa_opciones_menus` (`sipa_opciones_menu_id`),
  ADD CONSTRAINT `permisos_fk_rol` FOREIGN KEY (`sipa_permisos_roles_role`) REFERENCES `sipa_roles` (`sipa_roles_id`),
  ADD CONSTRAINT `permisos_fk_usuarioActualizacion` FOREIGN KEY (`sipa_permisos_roles_usuario_actualizacion`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `permisos_fk_usuarioCreador` FOREIGN KEY (`sipa_permisos_roles_usuario_creador`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
