-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 18, 2019 at 12:16 AM
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
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
