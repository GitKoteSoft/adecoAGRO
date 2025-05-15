-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: sql105.infinityfree.com
-- Tiempo de generación: 15-05-2025 a las 11:28:26
-- Versión del servidor: 10.6.21-MariaDB
-- Versión de PHP: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `if0_38975599_adecoagro`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `iva_condiciones`
--

CREATE TABLE `iva_condiciones` (
  `id` int(11) NOT NULL,
  `descripcion` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish2_ci;

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

CREATE TABLE `orden_compra` (
  `id` int(10) UNSIGNED NOT NULL,
  `proveedor_id` int(10) UNSIGNED NOT NULL,
  `fecha_emision` date NOT NULL,
  `fecha_vencimiento` date DEFAULT NULL,
  `observaciones` text DEFAULT NULL,
  `forma_pago` varchar(50) NOT NULL,
  `forma_envio` varchar(50) NOT NULL,
  `moneda_id` int(10) UNSIGNED NOT NULL,
  `estado` enum('Aprobada','Anulada') DEFAULT 'Aprobada',
  `total_orden_compra` decimal(12,2) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `orden_compra`
--

INSERT INTO `orden_compra` (`id`, `proveedor_id`, `fecha_emision`, `fecha_vencimiento`, `observaciones`, `forma_pago`, `forma_envio`, `moneda_id`, `estado`, `total_orden_compra`, `created`, `modified`) VALUES
(1, 1, '2025-05-14', '2025-05-30', 'El pago del producto se realizará mediante transferencia bancaria en pesos argentinos, de acuerdo a facturación previamente enviada, por lo que se solicita factura \'A\' para realizar dicha transferencia a:\r\n\r\n- Razón Social: ADECO AGROPECUARIA S.A\r\n- CUIT: 30-61870567-2\r\n- Condición IVA: Responsable Inscripto.\r\n- Domicilio: Molino Mercedes Adeco, Mercedes, Corrientes.\r\n- Código Postal: 3470.\r\n\r\nAdemás, se solicitan datos bancarios para efectuar el pago por dichos productos.', 'Transferencia Bancaria', 'Correo Argentino', 1, 'Aprobada', '5212680.00', '2025-05-14 15:58:33', '2025-05-14 15:58:33'),
(2, 2, '2025-05-14', '2025-06-07', 'El pago del producto se realizará mediante transferencia bancaria en pesos argentinos, de acuerdo a facturación previamente enviada, por lo que se solicita factura \'A\' para realizar dicha transferencia a:\r\n\r\n- Razón Social: ADECO AGROPECUARIA S.A\r\n- CUIT: 30-61870567-2\r\n- Condición IVA: Responsable Inscripto.\r\n- Domicilio: Molino Mercedes Adeco, Mercedes, Corrientes.\r\n- Código Postal: 3470.\r\n\r\nAdemás, se solicitan datos bancarios para efectuar el pago por dichos productos.', 'Transferencia', 'Transporte Propio', 2, 'Aprobada', '578501.00', '2025-05-14 16:01:14', '2025-05-14 16:01:14'),
(3, 3, '2025-05-14', '2025-05-27', 'El pago del producto se realizará mediante transferencia bancaria en pesos argentinos, de acuerdo a facturación previamente enviada, por lo que se solicita factura \'A\' para realizar dicha transferencia a:\r\n\r\n- Razón Social: ADECO AGROPECUARIA S.A\r\n- CUIT: 30-61870567-2\r\n- Condición IVA: Responsable Inscripto.\r\n- Domicilio: Molino Mercedes Adeco, Mercedes, Corrientes.\r\n- Código Postal: 3470.\r\n\r\nAdemás, se solicitan datos bancarios para efectuar el pago por dichos productos.', 'Efectivo', 'Andreani', 2, 'Aprobada', '473715.00', '2025-05-14 16:02:40', '2025-05-14 16:02:40'),
(4, 4, '2025-05-14', '2025-06-03', 'El pago del producto se realizará mediante transferencia bancaria en pesos argentinos, de acuerdo a facturación previamente enviada, por lo que se solicita factura \'A\' para realizar dicha transferencia a:\r\n\r\n- Razón Social: ADECO AGROPECUARIA S.A\r\n- CUIT: 30-61870567-2\r\n- Condición IVA: Responsable Inscripto.\r\n- Domicilio: Molino Mercedes Adeco, Mercedes, Corrientes.\r\n- Código Postal: 3470.\r\n\r\nAdemás, se solicitan datos bancarios para efectuar el pago por dichos productos.', 'Transferencia SWIFT', 'DHL', 4, 'Aprobada', '1677483.50', '2025-05-14 16:05:20', '2025-05-14 16:05:20'),
(5, 5, '2025-05-14', '2025-05-28', 'El pago del producto se realizará mediante transferencia bancaria en pesos argentinos, de acuerdo a facturación previamente enviada, por lo que se solicita factura \'A\' para realizar dicha transferencia a:\r\n\r\n- Razón Social: ADECO AGROPECUARIA S.A\r\n- CUIT: 30-61870567-2\r\n- Condición IVA: Responsable Inscripto.\r\n- Domicilio: Molino Mercedes Adeco, Mercedes, Corrientes.\r\n- Código Postal: 3470.\r\n\r\nAdemás, se solicitan datos bancarios para efectuar el pago por dichos productos.', 'Efectivo', 'Logística AdecoAGRO', 1, 'Aprobada', '19408400.00', '2025-05-14 16:09:32', '2025-05-14 16:09:32'),
(6, 2, '2025-05-14', '2025-07-10', 'El pago del producto se realizará mediante transferencia bancaria en pesos argentinos, de acuerdo a facturación previamente enviada, por lo que se solicita factura \'A\' para realizar dicha transferencia a:\r\n\r\n- Razón Social: ADECO AGROPECUARIA S.A\r\n- CUIT: 30-61870567-2\r\n- Condición IVA: Responsable Inscripto.\r\n- Domicilio: Molino Mercedes Adeco, Mercedes, Corrientes.\r\n- Código Postal: 3470.\r\n\r\nAdemás, se solicitan datos bancarios para efectuar el pago por dichos productos.', 'Efectivo', 'OCA', 1, 'Anulada', '108900.00', '2025-05-14 20:26:27', '2025-05-14 20:26:38'),
(7, 1, '2025-05-15', '2025-05-31', 'El pago del producto se realizará mediante transferencia bancaria en pesos argentinos, de acuerdo a facturación previamente enviada, por lo que se solicita factura \'A\' para realizar dicha transferencia a:\r\n\r\n- Razón Social: ADECO AGROPECUARIA S.A\r\n- CUIT: 30-61870567-2\r\n- Condición IVA: Responsable Inscripto.\r\n- Domicilio: Molino Mercedes Adeco, Mercedes, Corrientes.\r\n- Código Postal: 3470.\r\n\r\nAdemás, se solicitan datos bancarios para efectuar el pago por dichos productos.', 'Efectivo', 'Andreani', 1, 'Anulada', '121.00', '2025-05-15 02:52:00', '2025-05-15 02:52:10');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `orden_detalles`
--

CREATE TABLE `orden_detalles` (
  `id` int(10) UNSIGNED NOT NULL,
  `orden_id` int(10) UNSIGNED NOT NULL,
  `descripcion_producto` varchar(255) NOT NULL,
  `cantidad` decimal(12,2) NOT NULL,
  `precio_unitario` decimal(12,2) NOT NULL,
  `bonificacion` decimal(5,2) NOT NULL DEFAULT 0.00,
  `subtotal_sin_iva` decimal(14,2) NOT NULL,
  `iva` decimal(5,2) NOT NULL DEFAULT 21.00,
  `subtotal_con_iva` decimal(14,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `orden_detalles`
--

INSERT INTO `orden_detalles` (`id`, `orden_id`, `descripcion_producto`, `cantidad`, `precio_unitario`, `bonificacion`, `subtotal_sin_iva`, `iva`, `subtotal_con_iva`) VALUES
(1, 1, 'Semilla Soja DM 53i3 IPRO - Cantidad: 15 toneladas.', '15.00', '180000.00', '12.00', '2376000.00', '21.00', '2874960.00'),
(2, 1, 'Semilla Maíz DK 72-10 - Cantidad: 10 ton', '10.00', '210000.00', '8.00', '1932000.00', '21.00', '2337720.00'),
(3, 2, 'Tractor 6250R', '2.00', '95000.00', '5.00', '180500.00', '21.00', '218405.00'),
(4, 2, 'Cosechadora S760', '1.00', '320000.00', '7.00', '297600.00', '21.00', '360096.00'),
(5, 3, 'Camión G410 CB6x4', '3.00', '145000.00', '10.00', '391500.00', '21.00', '473715.00'),
(6, 4, 'Urea granulada - Cantidad: 500 ton', '500.00', '3262.00', '15.00', '1386350.00', '21.00', '1677483.50'),
(7, 5, 'Alimento balanceado bovino - Cantidad: 200Kg', '200.00', '85000.00', '9.00', '15470000.00', '21.00', '18718700.00'),
(8, 5, 'Silo bolsa - Cantidad: 50u', '50.00', '12000.00', '5.00', '570000.00', '21.00', '689700.00'),
(9, 6, 'prueba', '100.00', '1000.00', '10.00', '90000.00', '21.00', '108900.00'),
(10, 7, 'Semillas', '1.00', '100.00', '0.00', '100.00', '21.00', '121.00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paises`
--

CREATE TABLE `paises` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish2_ci NOT NULL,
  `iso_alfa` char(2) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish2_ci NOT NULL,
  `iso_num` char(3) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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

CREATE TABLE `proveedores` (
  `id` int(10) UNSIGNED NOT NULL,
  `cuit` char(11) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish2_ci NOT NULL,
  `razon_social` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish2_ci NOT NULL,
  `iva_condicion_id` int(11) NOT NULL,
  `direccion` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish2_ci NOT NULL,
  `cp` char(10) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish2_ci NOT NULL,
  `localidad` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish2_ci NOT NULL,
  `provincia_id` int(10) UNSIGNED NOT NULL,
  `pais_id` int(10) UNSIGNED NOT NULL,
  `telefono` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish2_ci DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `proveedores`
--

INSERT INTO `proveedores` (`id`, `cuit`, `razon_social`, `iva_condicion_id`, `direccion`, `cp`, `localidad`, `provincia_id`, `pais_id`, `telefono`, `created`, `modified`) VALUES
(1, '30712345678', 'Don Mario Semillas S.A.', 2, 'Av. San Martín 2450', '1636', 'Marcos Juarez', 5, 1, '+54 11 4785-1234', '2025-05-14 15:43:52', '2025-05-14 15:43:52'),
(2, '30823456789', 'John Deere Argentina S.A.', 2, 'Ruta 9 Km 128', '5000', 'Cordoba Capital', 5, 1, '+54 351 496-7890', '2025-05-14 15:45:26', '2025-05-14 15:52:00'),
(3, '80123450001', 'Scania Paraguay S.A.', 5, 'Ruta 2 Km 12', '00123', 'Asunción', 32, 2, '+595 21 456-789', '2025-05-14 15:47:23', '2025-05-14 15:47:23'),
(4, '05678901234', 'Yara Brasil Fertilizantes Ltda', 2, 'Rodovia Anhanguera, Km 118', '13186', 'Campinas', 67, 3, '+55 11 9876-5432', '2025-05-14 15:48:53', '2025-05-14 15:48:53'),
(5, '30987654321', 'Cargill Agropecuaria S.A.', 2, 'Av. Corrientes 2222', '1043', 'Buenos Aires', 1, 1, '+54 11 4321-8765', '2025-05-14 15:50:55', '2025-05-14 15:50:55');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `provincias`
--

CREATE TABLE `provincias` (
  `id` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(100) CHARACTER SET utf8mb3 COLLATE utf8mb3_spanish2_ci NOT NULL,
  `pais_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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

CREATE TABLE `tipo_moneda` (
  `id` int(10) UNSIGNED NOT NULL,
  `codigo` char(3) NOT NULL,
  `divisa` varchar(50) NOT NULL,
  `simbolo` char(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

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

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `rol` varchar(50) DEFAULT 'user',
  `created` datetime DEFAULT current_timestamp(),
  `modified` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_spanish2_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `rol`, `created`, `modified`) VALUES
(1, 'admin', '$2y$10$ugq3geo9FdEqGzYYIuzdMeliVL2bxilwinkLRO3QWm7y5GkyjyFfa', 'Administrador', '2025-04-19 01:12:42', '2025-04-21 04:07:13'),
(5, 'Prueba1', '$2y$10$bPXwnqJv1zAQSfcwGtKKUeZzm6Xb0I/Mf/x4i2QToXxuhWqOX0LSq', 'Usuario', '2025-05-14 12:33:01', '2025-05-14 12:33:01');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `iva_condiciones`
--
ALTER TABLE `iva_condiciones`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `orden_compra`
--
ALTER TABLE `orden_compra`
  ADD PRIMARY KEY (`id`),
  ADD KEY `index_oc_proveedor` (`proveedor_id`),
  ADD KEY `index_oc_moneda` (`moneda_id`);

--
-- Indices de la tabla `orden_detalles`
--
ALTER TABLE `orden_detalles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `index_od_orden` (`orden_id`);

--
-- Indices de la tabla `paises`
--
ALTER TABLE `paises`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `iso_alfa` (`iso_alfa`),
  ADD UNIQUE KEY `iso_num` (`iso_num`);

--
-- Indices de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_provincia` (`provincia_id`),
  ADD KEY `idx_pais` (`pais_id`),
  ADD KEY `fk_proveedores_iva` (`iva_condicion_id`);

--
-- Indices de la tabla `provincias`
--
ALTER TABLE `provincias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pais_id` (`pais_id`);

--
-- Indices de la tabla `tipo_moneda`
--
ALTER TABLE `tipo_moneda`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `iva_condiciones`
--
ALTER TABLE `iva_condiciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `orden_compra`
--
ALTER TABLE `orden_compra`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `orden_detalles`
--
ALTER TABLE `orden_detalles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `paises`
--
ALTER TABLE `paises`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `provincias`
--
ALTER TABLE `provincias`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT de la tabla `tipo_moneda`
--
ALTER TABLE `tipo_moneda`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

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
