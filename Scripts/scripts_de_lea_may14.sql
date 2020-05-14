--Activos, salas y insumo imagenes mas grandes
ALTER TABLE `sipa_activos` CHANGE `sipa_activo_nombre_imagen` `sipa_activo_nombre_imagen` LONGTEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;
ALTER TABLE `sipa_salas` CHANGE `sipa_salas_nombre_img` `sipa_salas_nombre_img` LONGTEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL;
ALTER TABLE `sipa_activos` CHANGE `sipa_activos_nom_form` `sipa_activos_nom_form` LONGTEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL;


-- ESTE ES UN UNIQUE, ENTONCES SI TIENEN PERMISOS REPETIDOS LES VA A DAR ERROR. TIENEN QUE FIJARSE QUE NO TIENEN UN PERMISO QUE TENGA 
-- EL ROLE Y EL MODULO IGUAL, IGUAL SI LO CORREN EL VA A DECIR SI HAY ALGO MAL
ALTER TABLE `sipa_permisos_roles` ADD UNIQUE( `sipa_permisos_roles_role`, `sipa_permisos_roles_opciones_menu`);

-- CODIGO EN PERMISOS, ESTO ES DE LOS ROLES
ALTER TABLE `sipa_permisos_roles` ADD `sipa_permisos_roles_opcion_menu_codigo` VARCHAR(255) NULL AFTER `sipa_permisos_roles_opciones_menu`;