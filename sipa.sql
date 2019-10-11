-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-10-2019 a las 05:53:17
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

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `sipa_edificios_unidades`
--
ALTER TABLE `sipa_edificios_unidades`
  ADD PRIMARY KEY (`sipa_edificios_unidades_id`),
  ADD KEY `sipa_edificios_unidades_fk_idx` (`sipa_edificios_unidades_edificio`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `sipa_edificios_unidades`
--
ALTER TABLE `sipa_edificios_unidades`
  MODIFY `sipa_edificios_unidades_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `sipa_edificios_unidades`
--
ALTER TABLE `sipa_edificios_unidades`
  ADD CONSTRAINT `sipa_edificios_unidades_fk` FOREIGN KEY (`sipa_edificios_unidades_edificio`) REFERENCES `sipa_edificios` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
