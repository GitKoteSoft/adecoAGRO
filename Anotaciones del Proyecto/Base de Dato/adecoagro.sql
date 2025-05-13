-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 13-05-2025 a las 22:43:16
-- Versión del servidor: 5.7.36
-- Versión de PHP: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `adecoagro`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `iva_condiciones`
--

DROP TABLE IF EXISTS `iva_condiciones`;
CREATE TABLE IF NOT EXISTS `iva_condiciones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `iva_condiciones`
--

INSERT INTO `iva_condiciones` (`id`, `descripcion`) VALUES
(1, 'No Define'),
(2, 'IVA Responsable Inscripto'),
(3, 'IVA Responsable No Inscripto'),
(4, 'IVA No Responsable'),
(5, 'IVA Sujeto Exento'),
(6, 'Consumidor Final'),
(7, 'Monotributista'),
(8, 'Sujeto No Categorizado'),
(9, 'Proveedor del Exterior'),
(10, 'IVA Liberado - Ley N° 19.640'),
(11, 'IVA Responsable Inscripto - Agente de Percepción'),
(12, 'Monotributista Social');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orden_compra`
--

DROP TABLE IF EXISTS `orden_compra`;
CREATE TABLE IF NOT EXISTS `orden_compra` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `proveedor_id` int(10) UNSIGNED NOT NULL,
  `fecha_emision` date NOT NULL,
  `fecha_vencimiento` date DEFAULT NULL,
  `observaciones` text COLLATE utf8mb4_spanish_ci,
  `forma_pago` varchar(50) COLLATE utf8mb4_spanish_ci NOT NULL,
  `forma_envio` varchar(50) COLLATE utf8mb4_spanish_ci NOT NULL,
  `moneda_id` int(10) UNSIGNED NOT NULL,
  `estado` enum('Aprobada','Anulada') COLLATE utf8mb4_spanish_ci DEFAULT 'Aprobada',
  `total_orden_compra` decimal(12,2) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `index_oc_proveedor` (`proveedor_id`),
  KEY `index_oc_moneda` (`moneda_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orden_detalles`
--

DROP TABLE IF EXISTS `orden_detalles`;
CREATE TABLE IF NOT EXISTS `orden_detalles` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `orden_id` int(10) UNSIGNED NOT NULL,
  `descripcion_producto` varchar(255) COLLATE utf8mb4_spanish_ci NOT NULL,
  `cantidad` decimal(12,2) NOT NULL,
  `precio_unitario` decimal(12,2) NOT NULL,
  `bonificacion` decimal(5,2) NOT NULL DEFAULT '0.00',
  `subtotal_sin_iva` decimal(14,2) NOT NULL,
  `iva` decimal(5,2) NOT NULL DEFAULT '21.00',
  `subtotal_con_iva` decimal(14,2) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `index_od_orden` (`orden_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paises`
--

DROP TABLE IF EXISTS `paises`;
CREATE TABLE IF NOT EXISTS `paises` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `iso_alfa` char(2) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `iso_num` char(3) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `iso_alfa` (`iso_alfa`),
  UNIQUE KEY `iso_num` (`iso_num`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `paises`
--

INSERT INTO `paises` (`id`, `nombre`, `iso_alfa`, `iso_num`) VALUES
(1, 'Argentina', 'AR', '32'),
(2, 'Paraguay', 'PY', '600'),
(3, 'Brasil', 'BR', '76');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

DROP TABLE IF EXISTS `proveedores`;
CREATE TABLE IF NOT EXISTS `proveedores` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `cuit` char(11) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `razon_social` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `iva_condicion_id` int(11) NOT NULL,
  `direccion` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `cp` char(10) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `localidad` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `provincia_id` int(10) UNSIGNED NOT NULL,
  `pais_id` int(10) UNSIGNED NOT NULL,
  `telefono` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish2_ci DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_provincia` (`provincia_id`),
  KEY `idx_pais` (`pais_id`),
  KEY `fk_proveedores_iva` (`iva_condicion_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `provincias`
--

DROP TABLE IF EXISTS `provincias`;
CREATE TABLE IF NOT EXISTS `provincias` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish2_ci NOT NULL,
  `pais_id` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `pais_id` (`pais_id`)
) ENGINE=InnoDB AUTO_INCREMENT=70 DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `provincias`
--

INSERT INTO `provincias` (`id`, `nombre`, `pais_id`) VALUES
(1, 'Buenos Aires', 1),
(2, 'Catamarca', 1),
(3, 'Chaco', 1),
(4, 'Chubut', 1),
(5, 'Córdoba', 1),
(6, 'Corrientes', 1),
(7, 'Entre Ríos', 1),
(8, 'Formosa', 1),
(9, 'Jujuy', 1),
(10, 'La Pampa', 1),
(11, 'La Rioja', 1),
(12, 'Mendoza', 1),
(13, 'Misiones', 1),
(14, 'Neuquén', 1),
(15, 'Río Negro', 1),
(16, 'Salta', 1),
(17, 'San Juan', 1),
(18, 'San Luis', 1),
(19, 'Santa Cruz', 1),
(20, 'Santa Fe', 1),
(21, 'Santiago del Estero', 1),
(22, 'Tierra del Fuego', 1),
(23, 'Tucumán', 1),
(24, 'Ciudad Autónoma de Buenos Aires', 1),
(25, 'Alto Paraguay', 2),
(26, 'Alto Paraná', 2),
(27, 'Amambay', 2),
(28, 'Boquerón', 2),
(29, 'Caaguazú', 2),
(30, 'Caazapá', 2),
(31, 'Canindeyú', 2),
(32, 'Central', 2),
(33, 'Concepción', 2),
(34, 'Cordillera', 2),
(35, 'Guairá', 2),
(36, 'Itapúa', 2),
(37, 'Misiones', 2),
(38, 'Ñeembucú', 2),
(39, 'Paraguarí', 2),
(40, 'Presidente Hayes', 2),
(41, 'San Pedro', 2),
(42, 'Asunción', 2),
(43, 'Acre', 3),
(44, 'Alagoas', 3),
(45, 'Amapá', 3),
(46, 'Amazonas', 3),
(47, 'Bahía', 3),
(48, 'Ceará', 3),
(49, 'Distrito Federal', 3),
(50, 'Espírito Santo', 3),
(51, 'Goiás', 3),
(52, 'Maranhão', 3),
(53, 'Mato Grosso', 3),
(54, 'Mato Grosso do Sul', 3),
(55, 'Minas Gerais', 3),
(56, 'Pará', 3),
(57, 'Paraíba', 3),
(58, 'Paraná', 3),
(59, 'Pernambuco', 3),
(60, 'Piauí', 3),
(61, 'Río de Janeiro', 3),
(62, 'Río Grande del Norte', 3),
(63, 'Río Grande del Sur', 3),
(64, 'Rondônia', 3),
(65, 'Roraima', 3),
(66, 'Santa Catarina', 3),
(67, 'São Paulo', 3),
(68, 'Sergipe', 3),
(69, 'Tocantins', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_moneda`
--

DROP TABLE IF EXISTS `tipo_moneda`;
CREATE TABLE IF NOT EXISTS `tipo_moneda` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `codigo` char(3) COLLATE utf8mb4_spanish_ci NOT NULL,
  `divisa` varchar(50) COLLATE utf8mb4_spanish_ci NOT NULL,
  `simbolo` char(3) COLLATE utf8mb4_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `tipo_moneda`
--

INSERT INTO `tipo_moneda` (`id`, `codigo`, `divisa`, `simbolo`) VALUES
(1, 'ARS', 'Peso Argentino', '$'),
(2, 'USD', 'Dólar Estadounidense', 'US$'),
(3, 'EUR', 'Euro', '€'),
(4, 'BRL', 'Real Brasileño', 'R$');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `rol` varchar(50) COLLATE utf8_spanish2_ci DEFAULT 'user',
  `created` datetime DEFAULT CURRENT_TIMESTAMP,
  `modified` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `rol`, `created`, `modified`) VALUES
(1, 'admin', '$2y$10$ugq3geo9FdEqGzYYIuzdMeliVL2bxilwinkLRO3QWm7y5GkyjyFfa', 'Administrador', '2025-04-19 01:12:42', '2025-04-21 04:07:13');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `orden_compra`
--
ALTER TABLE `orden_compra`
  ADD CONSTRAINT `fk_oc_moneda` FOREIGN KEY (`moneda_id`) REFERENCES `tipo_moneda` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_oc_proveedor` FOREIGN KEY (`proveedor_id`) REFERENCES `proveedores` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `orden_detalles`
--
ALTER TABLE `orden_detalles`
  ADD CONSTRAINT `fk_od_orden` FOREIGN KEY (`orden_id`) REFERENCES `orden_compra` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD CONSTRAINT `fk_proveedores_iva` FOREIGN KEY (`iva_condicion_id`) REFERENCES `iva_condiciones` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_proveedores_pais` FOREIGN KEY (`pais_id`) REFERENCES `paises` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_proveedores_provincia` FOREIGN KEY (`provincia_id`) REFERENCES `provincias` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `provincias`
--
ALTER TABLE `provincias`
  ADD CONSTRAINT `fk_prov_pais` FOREIGN KEY (`pais_id`) REFERENCES `paises` (`id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
