ALTER TABLE sipa.sipa_edificios_unidades DROP FOREIGN KEY sipa_edificios_unidades_fk;
ALTER TABLE sipa.sipa_activos_traslado_ubicacion DROP FOREIGN KEY sipa_nueva_unidad_fk;
ALTER TABLE `sipa_edificios` CHANGE `id` `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT;

ALTER TABLE `sipa_edificios_unidades` CHANGE `sipa_edificios_unidades_id` `sipa_edificios_unidades_id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT;

ALTER TABLE `sipa_activos_traslado_ubicacion` CHANGE `sipa_nueva_unidad` `sipa_nueva_unidad` BIGINT(20) UNSIGNED NULL DEFAULT NULL;
ALTER TABLE `sipa_activos_traslado_ubicacion` ADD CONSTRAINT `sipa_nueva_unidad_fk` FOREIGN KEY (`sipa_nueva_unidad`) REFERENCES `sipa_edificios_unidades`(`sipa_edificios_unidades_id`) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE `sipa_edificios_unidades` CHANGE `sipa_edificios_unidades_edificio` `sipa_edificios_unidades_edificio` BIGINT(20) UNSIGNED NOT NULL;
ALTER TABLE `sipa_edificios_unidades` ADD CONSTRAINT `sipa_edificios_unidades_fk` FOREIGN KEY (`sipa_edificios_unidades_edificio`) REFERENCES `sipa_edificios`(`id`) ON DELETE CASCADE ON UPDATE CASCADE;


-- Drop FKs que van hacia user
ALTER TABLE sipa.sipa_opciones_menus DROP FOREIGN KEY modulo_fk_usuarioActualizacion;
ALTER TABLE sipa.sipa_opciones_menus DROP FOREIGN KEY modulo_fk_usuarioCreador;

ALTER TABLE sipa.sipa_permisos_roles DROP FOREIGN KEY permisos_fk_usuarioActualizacion;
ALTER TABLE sipa.sipa_permisos_roles DROP FOREIGN KEY permisos_fk_usuarioCreador;

ALTER TABLE sipa.sipa_activos DROP FOREIGN KEY sipa_activos_actualiza_fk;

ALTER TABLE sipa.sipa_activos_baja DROP FOREIGN KEY sipa_usuario_baja_fk;

-- AC
ALTER TABLE `users` CHANGE `id` `id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT;
-- Cambio nombre
ALTER TABLE `sipa_usuarios` CHANGE `id` `sipa_usuarios_id` BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT;

-- Crear FKs que van hacia usuario
ALTER TABLE `sipa_opciones_menus` ADD CONSTRAINT `modulo_fk_usuarioActualizacion` FOREIGN KEY (`sipa_opciones_menu_usuario_actualizacion`) REFERENCES `sipa_usuarios`(`sipa_usuarios_id`) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE `sipa_opciones_menus` ADD CONSTRAINT `modulo_fk_usuarioCreador` FOREIGN KEY (`sipa_opciones_menu_usuario_creador`) REFERENCES `sipa_usuarios`(`sipa_usuarios_id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `sipa_permisos_roles` ADD CONSTRAINT `permisos_fk_usuarioActualizacion` FOREIGN KEY (`sipa_permisos_roles_usuario_actualizacion`) REFERENCES `sipa_usuarios`(`sipa_usuarios_id`) ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE `sipa_permisos_roles` ADD CONSTRAINT `permisos_fk_usuarioCreador` FOREIGN KEY (`sipa_permisos_roles_usuario_creador`) REFERENCES `sipa_usuarios`(`sipa_usuarios_id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `sipa_activos` ADD CONSTRAINT `sipa_activos_actualiza_fk` FOREIGN KEY (`sipa_activos_usuario_actualizacion`) REFERENCES `sipa_usuarios`(`sipa_usuarios_id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `sipa_activos_baja` ADD CONSTRAINT `sipa_usuario_baja_fk` FOREIGN KEY (`sipa_usuario_baja`) REFERENCES `sipa_usuarios`(`sipa_usuarios_id`) ON DELETE CASCADE ON UPDATE CASCADE;