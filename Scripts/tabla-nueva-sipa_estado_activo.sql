ALTER TABLE `sipa_activos` CHANGE `sipa_activos_estado` `sipa_activos_estado` BIGINT(20) UNSIGNED NOT NULL;

CREATE TABLE `sipa_estado_activo` (
  `sipa_estado_activo_id` BIGINT(20) NOT NULL,
  `sipa_estado_activo_nombre` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

ALTER TABLE `sipa_estado_activo`
  ADD PRIMARY KEY (`sipa_estado_activo_id`);
  
  ALTER TABLE `sipa_estado_activo`
  MODIFY `sipa_estado_activo_id` int(11) NOT NULL AUTO_INCREMENT;

delete from sipa_activos;

ALTER TABLE `sipa_activos` ADD CONSTRAINT `sipa_activos_estado_fk` FOREIGN KEY (`sipa_activos_estado`) REFERENCES `sipa_estado_activo`(`sipa_estado_activo_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;