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

ALTER TABLE `sipa_edificios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sipa_edificios_nombre_UNIQUE` (`sipa_edificios_nombre`);

--
-- Indices de la tabla `sipa_edificios_unidades`
--
ALTER TABLE `sipa_edificios_unidades`
  ADD PRIMARY KEY (`sipa_edificios_unidades_id`),
  ADD KEY `sipa_edificios_unidades_fk_idx` (`sipa_edificios_unidades_edificio`);
  
  ALTER TABLE `sipa_edificios`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `sipa_edificios_unidades`
--
ALTER TABLE `sipa_edificios_unidades`
  MODIFY `sipa_edificios_unidades_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
  
  ALTER TABLE `sipa_edificios_unidades`
  ADD CONSTRAINT `sipa_edificios_unidades_fk` FOREIGN KEY (`sipa_edificios_unidades_edificio`) REFERENCES `sipa_edificios` (`id`);
COMMIT