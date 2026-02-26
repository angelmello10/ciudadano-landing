-- =============================================
--  Script para crear la tabla en Hostinger MySQL
--  Cópialo y pégalo en phpMyAdmin > SQL
-- =============================================

/* CREATE TABLE IF NOT EXISTS `incidencias` (
    `id`               INT UNSIGNED     NOT NULL AUTO_INCREMENT,
    `nombre_ciudadano` VARCHAR(255)              DEFAULT NULL,
    `email`            VARCHAR(255)              DEFAULT NULL,
    `direccion`        VARCHAR(500)              DEFAULT NULL,
    `latitud`          DECIMAL(10, 7)            DEFAULT NULL,
    `longitud`         DECIMAL(10, 7)            DEFAULT NULL,
    `tipo_incidencia`  VARCHAR(100)              DEFAULT NULL,
    `descripcion`      TEXT                      DEFAULT NULL,
    `estatus`          VARCHAR(50)      NOT NULL DEFAULT 'pendiente',
    `foto`             VARCHAR(500)              DEFAULT NULL,
    `created_at`       DATETIME         NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at`       DATETIME         NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci; */
