-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-02-2025 a las 23:38:02
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `farmacia_san_francisco_javier2`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `almacen`
--

CREATE TABLE `almacen` (
  `IdPedido` int(11) DEFAULT NULL,
  `IdBodega` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `bodega`
--

CREATE TABLE `bodega` (
  `ID_Bodega` int(11) NOT NULL,
  `Cantidad_Med_Estante` int(11) DEFAULT NULL,
  `Cantidad_Med_Exhibicion` int(11) DEFAULT NULL,
  `Cantidad_Total_Bodega` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `ID_Categoria` int(11) NOT NULL,
  `Nombre_Categoria` varchar(150) DEFAULT NULL,
  `Descripcion` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`ID_Categoria`, `Nombre_Categoria`, `Descripcion`) VALUES
(1, 'Antibióticos', 'Medicamentos para tratar infecciones bacterianas'),
(2, 'Analgésicos', 'Medicamentos para aliviar el dolor'),
(3, 'Antiinflamatorios', 'Medicamentos para reducir la inflamación'),
(4, 'Antihistamínicos', 'Medicamentos para tratar alergias'),
(5, 'Antidiabéticos', 'Medicamentos para controlar la diabetes'),
(6, 'Vitaminas', 'Suplementos vitamínicos para diversas funciones del cuerpo'),
(7, 'Antipiréticos', 'Medicamentos para reducir la fiebre'),
(8, 'Antidepresivos', 'Medicamentos para tratar trastornos depresivos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `ID_Cliente` int(11) NOT NULL,
  `Nombre` varchar(25) DEFAULT NULL,
  `Apellido` varchar(25) DEFAULT NULL,
  `Genero` enum('Masculino','Femenino') DEFAULT 'Masculino',
  `Direccion` varchar(50) DEFAULT NULL,
  `Telefono` varchar(9) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`ID_Cliente`, `Nombre`, `Apellido`, `Genero`, `Direccion`, `Telefono`) VALUES
(53, 'Derek', 'Somoza', 'Masculino', 'Milagro', '561561156'),
(56, 'Enmanuel', 'Serrano', 'Masculino', 'Villa Venezuela\r\n', '561561561'),
(57, 'Brizayda', 'Somoza', 'Femenino', 'Villa flor', '56651561');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura_compra`
--

CREATE TABLE `factura_compra` (
  `ID_FacturaC` int(11) NOT NULL,
  `Descripcion_Compra` varchar(300) DEFAULT NULL,
  `Nombre_Proveedor` varchar(60) DEFAULT NULL,
  `Fecha_Emision` datetime DEFAULT NULL,
  `Estado_Pedido` varchar(100) DEFAULT NULL,
  `Subtotal_Fact_Comp` float DEFAULT NULL,
  `Iva_Fact_Comp` float DEFAULT NULL,
  `Precio_Lote` float DEFAULT NULL,
  `Total_Fact_Comp` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura_venta`
--

CREATE TABLE `factura_venta` (
  `ID_FacturaV` int(11) NOT NULL,
  `Descripcion` varchar(200) DEFAULT NULL,
  `Cantidad_Vendida` int(11) DEFAULT NULL,
  `Descuento` float DEFAULT NULL,
  `Precio_Por_Unidad` float DEFAULT NULL,
  `Precio_Sobre` float DEFAULT NULL,
  `Precio_Caja` float DEFAULT NULL,
  `Fecha` datetime DEFAULT NULL,
  `Subtotal` double DEFAULT NULL,
  `Iva` double DEFAULT NULL,
  `Total` double DEFAULT NULL,
  `IdCliente` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lote`
--

CREATE TABLE `lote` (
  `ID_Lote` int(11) NOT NULL,
  `Descripcion_Lote` varchar(250) DEFAULT NULL,
  `Estado_Lote` varchar(100) DEFAULT NULL,
  `Cantidad_Lote` int(11) DEFAULT NULL,
  `Fecha_Fabricacion_Lote` datetime DEFAULT NULL,
  `Fecha_Caducidad_Lote` datetime DEFAULT NULL,
  `Fecha_Emision_Lote` datetime DEFAULT NULL,
  `Fecha_Recibido_Lote` datetime DEFAULT NULL,
  `Prec_Unidad_Lote` float DEFAULT NULL,
  `Precio_Total_Lote` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lotefact`
--

CREATE TABLE `lotefact` (
  `IdLote` int(11) DEFAULT NULL,
  `IdFacturaC` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medicamento`
--

CREATE TABLE `medicamento` (
  `ID_Medicamento` int(11) NOT NULL,
  `Nombre_Medicamento` varchar(30) DEFAULT NULL,
  `Imagen` text DEFAULT NULL,
  `Descripcion_Medicamento` varchar(250) DEFAULT NULL,
  `N_Existencia` int(11) DEFAULT NULL,
  `Presentacion` varchar(100) DEFAULT NULL,
  `Dosis` varchar(100) DEFAULT NULL,
  `Fecha_Fabricacion` datetime DEFAULT NULL,
  `Fecha_Vencimiento` datetime DEFAULT NULL,
  `Precio_Actual` float DEFAULT NULL,
  `Precio_Unidad` float DEFAULT NULL,
  `Precio_Sobre` decimal(10,2) NOT NULL,
  `Precio_Caja` decimal(10,2) NOT NULL,
  `Precio_Con_Impuesto` float DEFAULT NULL,
  `Prescripcion_Medica` varchar(150) DEFAULT NULL,
  `IdCategoria` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `medicamento`
--

INSERT INTO `medicamento` (`ID_Medicamento`, `Nombre_Medicamento`, `Imagen`, `Descripcion_Medicamento`, `N_Existencia`, `Presentacion`, `Dosis`, `Fecha_Fabricacion`, `Fecha_Vencimiento`, `Precio_Actual`, `Precio_Unidad`, `Precio_Sobre`, `Precio_Caja`, `Precio_Con_Impuesto`, `Prescripcion_Medica`, `IdCategoria`) VALUES
(1, 'Amoxicilina', '', 'Antibiótico de amplio espectro.', 100, 'Capsulas', '500mg', '2023-06-01 00:00:00', '2025-06-01 00:00:00', 5, 0.2, 15.00, 100.00, 6, 'No requiere receta', 1),
(21, 'Eritromicina', 'eritromicina.jpg', 'Infeccion', 100, 'Capsula', '20mg', '2024-11-13 20:29:00', '2025-02-07 20:29:00', 10, 10, 100.00, 1000.00, 1000, 'Alergias', 2),
(24, 'Actimicina Bronquial', 'Actimicina Bronquial.webp', 'Para Gripe', 150, 'tableta', '30mg', '2024-10-09 09:46:00', '2025-03-13 09:46:00', NULL, 6, 30.00, 80.00, NULL, 'Gripe o Calentura', 4),
(27, 'Ibuprofeno', 'Ibuprofeno.webp', 'Medicamento que se usa para tratar la fiebre, la hinchazón, el dolor y el enrojecimiento', 60, 'tableta', '600mg', '2024-07-11 10:00:00', '2024-12-05 10:00:00', NULL, 4, 20.00, 100.00, NULL, 'En general, los adultos y niños mayores de 12 años pueden tomar el ibuprofeno de venta libre cada 4 a 6 horas', 5),
(28, 'Acetamenofen ', 'Acetaminofen.webp', 'Analgésico y antipirético, inhibidor de la síntesis de prostaglandinas periférica y central por acción sobre la ciclooxigenasa.', 100, 'tableta', '500mg', '2024-12-01 10:04:00', '2024-12-05 10:04:00', NULL, 4, 40.00, 400.00, NULL, 'El acetaminofeno se usa para aliviar el dolor leve o moderado de las cefaleas, dolores musculares, períodos menstruales, resfriados, y los dolores de ', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ofertalote`
--

CREATE TABLE `ofertalote` (
  `IdProveedor` int(11) DEFAULT NULL,
  `IdLote` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido`
--

CREATE TABLE `pedido` (
  `ID_Pedido` int(11) NOT NULL,
  `Descripcion_Pedido` varchar(100) DEFAULT NULL,
  `Fecha_Solicitud` datetime DEFAULT NULL,
  `Fecha_Recibo` datetime DEFAULT NULL,
  `Estado_Pedido` varchar(200) DEFAULT NULL,
  `IdVendedor` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido_fact`
--

CREATE TABLE `pedido_fact` (
  `IdPedido` int(11) DEFAULT NULL,
  `IdFacturaC` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE `proveedor` (
  `ID_Proveedor` int(11) NOT NULL,
  `Nombre` varchar(100) DEFAULT NULL,
  `Laboratorio` varchar(100) DEFAULT NULL,
  `Direccion` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `Telefono` varchar(8) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `Email` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `RUC` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `proveedor`
--

INSERT INTO `proveedor` (`ID_Proveedor`, `Nombre`, `Laboratorio`, `Direccion`, `Telefono`, `Email`, `RUC`) VALUES
(1, 'Derek', 'somoza', 'barrio milagro', '15415151', 'mcadavo@gamail', 3515645);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `provped`
--

CREATE TABLE `provped` (
  `IdPedido` int(11) DEFAULT NULL,
  `IdProveedor` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `ID_Rol` int(11) NOT NULL,
  `Nombre_Rol` varchar(50) DEFAULT NULL,
  `Descripcion_Rol` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`ID_Rol`, `Nombre_Rol`, `Descripcion_Rol`) VALUES
(1, 'Administrador', 'Todos los Accesos'),
(2, 'Empleado', 'Acceso limitado a funciones básicas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `suministro`
--

CREATE TABLE `suministro` (
  `IdMedicamento` int(11) DEFAULT NULL,
  `IdProveedor` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `ID_Usuario` int(11) NOT NULL,
  `Nombre_Usuario` varchar(50) DEFAULT NULL,
  `Imagen` text DEFAULT NULL,
  `Contraseña` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `Email` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `Telefono` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `ID_Vendedor` int(11) DEFAULT NULL,
  `IdRol` int(11) DEFAULT NULL,
  `estado_usuario` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`ID_Usuario`, `Nombre_Usuario`, `Imagen`, `Contraseña`, `Email`, `Telefono`, `ID_Vendedor`, `IdRol`, `estado_usuario`) VALUES
(1, 'Derek', '449310638_122108766050369563_655787570102137785_n.jpg', 'Djsomoza31', 'jamesonsomoza@gmail.com', '86018985', 1, 1, 1),
(2, 'Nestor Aguirre', 'images.PNG', 'Aguire25', 'NestorAguirre25@gmail.com', '54596235', NULL, 2, 1),
(3, 'Enmanuel', 'goku.jpg', 'Serrano13', 'EnmaRamos@gmail.com', '88688476', NULL, 1, 1),
(4, 'Maisho', 'images.jpg', 'Maishi10', 'maisho13@gmail.com', '88688476', NULL, 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vendedor`
--

CREATE TABLE `vendedor` (
  `ID_Vendedor` int(11) NOT NULL,
  `Nombre` varchar(70) DEFAULT NULL,
  `N_Cedula` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `Telefono` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `Direccion` varchar(200) DEFAULT NULL,
  `Sexo` char(1) DEFAULT NULL CHECK (`Sexo` in ('H','M'))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `vendedor`
--

INSERT INTO `vendedor` (`ID_Vendedor`, `Nombre`, `N_Cedula`, `Telefono`, `Direccion`, `Sexo`) VALUES
(1, 'Derek', '001-311001-1085U', '86018985', 'Milagro de Dios', 'H');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta_medicamento`
--

CREATE TABLE `venta_medicamento` (
  `IdFacturaV` int(11) DEFAULT NULL,
  `IdMedicamento` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `almacen`
--
ALTER TABLE `almacen`
  ADD KEY `IdPedido` (`IdPedido`),
  ADD KEY `IdBodega` (`IdBodega`);

--
-- Indices de la tabla `bodega`
--
ALTER TABLE `bodega`
  ADD PRIMARY KEY (`ID_Bodega`);

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`ID_Categoria`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`ID_Cliente`);

--
-- Indices de la tabla `factura_compra`
--
ALTER TABLE `factura_compra`
  ADD PRIMARY KEY (`ID_FacturaC`);

--
-- Indices de la tabla `factura_venta`
--
ALTER TABLE `factura_venta`
  ADD PRIMARY KEY (`ID_FacturaV`),
  ADD KEY `IdCliente` (`IdCliente`);

--
-- Indices de la tabla `lote`
--
ALTER TABLE `lote`
  ADD PRIMARY KEY (`ID_Lote`);

--
-- Indices de la tabla `lotefact`
--
ALTER TABLE `lotefact`
  ADD KEY `IdLote` (`IdLote`),
  ADD KEY `IdFacturaC` (`IdFacturaC`);

--
-- Indices de la tabla `medicamento`
--
ALTER TABLE `medicamento`
  ADD PRIMARY KEY (`ID_Medicamento`),
  ADD KEY `IdCategoria` (`IdCategoria`);

--
-- Indices de la tabla `ofertalote`
--
ALTER TABLE `ofertalote`
  ADD KEY `IdProveedor` (`IdProveedor`),
  ADD KEY `IdLote` (`IdLote`);

--
-- Indices de la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`ID_Pedido`),
  ADD KEY `IdVendedor` (`IdVendedor`);

--
-- Indices de la tabla `pedido_fact`
--
ALTER TABLE `pedido_fact`
  ADD KEY `IdPedido` (`IdPedido`),
  ADD KEY `IdFacturaC` (`IdFacturaC`);

--
-- Indices de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD PRIMARY KEY (`ID_Proveedor`);

--
-- Indices de la tabla `provped`
--
ALTER TABLE `provped`
  ADD KEY `IdPedido` (`IdPedido`),
  ADD KEY `IdProveedor` (`IdProveedor`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`ID_Rol`);

--
-- Indices de la tabla `suministro`
--
ALTER TABLE `suministro`
  ADD KEY `IdMedicamento` (`IdMedicamento`),
  ADD KEY `IdProveedor` (`IdProveedor`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`ID_Usuario`),
  ADD UNIQUE KEY `Nombre_Usuario` (`Nombre_Usuario`),
  ADD KEY `ID_Vendedor` (`ID_Vendedor`),
  ADD KEY `IdRol` (`IdRol`);

--
-- Indices de la tabla `vendedor`
--
ALTER TABLE `vendedor`
  ADD PRIMARY KEY (`ID_Vendedor`);

--
-- Indices de la tabla `venta_medicamento`
--
ALTER TABLE `venta_medicamento`
  ADD KEY `IdFacturaV` (`IdFacturaV`),
  ADD KEY `IdMedicamento` (`IdMedicamento`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `ID_Categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `ID_Cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT de la tabla `factura_compra`
--
ALTER TABLE `factura_compra`
  MODIFY `ID_FacturaC` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `factura_venta`
--
ALTER TABLE `factura_venta`
  MODIFY `ID_FacturaV` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `lote`
--
ALTER TABLE `lote`
  MODIFY `ID_Lote` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `medicamento`
--
ALTER TABLE `medicamento`
  MODIFY `ID_Medicamento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de la tabla `pedido`
--
ALTER TABLE `pedido`
  MODIFY `ID_Pedido` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  MODIFY `ID_Proveedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `ID_Rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `ID_Usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `vendedor`
--
ALTER TABLE `vendedor`
  MODIFY `ID_Vendedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `almacen`
--
ALTER TABLE `almacen`
  ADD CONSTRAINT `almacen_ibfk_1` FOREIGN KEY (`IdPedido`) REFERENCES `pedido` (`ID_Pedido`),
  ADD CONSTRAINT `almacen_ibfk_2` FOREIGN KEY (`IdBodega`) REFERENCES `bodega` (`ID_Bodega`);

--
-- Filtros para la tabla `factura_venta`
--
ALTER TABLE `factura_venta`
  ADD CONSTRAINT `factura_venta_ibfk_1` FOREIGN KEY (`IdCliente`) REFERENCES `clientes` (`ID_Cliente`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `lotefact`
--
ALTER TABLE `lotefact`
  ADD CONSTRAINT `lotefact_ibfk_1` FOREIGN KEY (`IdLote`) REFERENCES `lote` (`ID_Lote`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `lotefact_ibfk_2` FOREIGN KEY (`IdFacturaC`) REFERENCES `factura_compra` (`ID_FacturaC`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `medicamento`
--
ALTER TABLE `medicamento`
  ADD CONSTRAINT `medicamento_ibfk_1` FOREIGN KEY (`IdCategoria`) REFERENCES `categoria` (`ID_Categoria`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `ofertalote`
--
ALTER TABLE `ofertalote`
  ADD CONSTRAINT `ofertalote_ibfk_1` FOREIGN KEY (`IdLote`) REFERENCES `lote` (`ID_Lote`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ofertalote_ibfk_2` FOREIGN KEY (`IdProveedor`) REFERENCES `proveedor` (`ID_Proveedor`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `pedido_fact`
--
ALTER TABLE `pedido_fact`
  ADD CONSTRAINT `pedido_fact_ibfk_1` FOREIGN KEY (`IdPedido`) REFERENCES `pedido` (`ID_Pedido`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pedido_fact_ibfk_2` FOREIGN KEY (`IdFacturaC`) REFERENCES `factura_compra` (`ID_FacturaC`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `provped`
--
ALTER TABLE `provped`
  ADD CONSTRAINT `provped_ibfk_1` FOREIGN KEY (`IdPedido`) REFERENCES `pedido` (`ID_Pedido`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `provped_ibfk_2` FOREIGN KEY (`IdProveedor`) REFERENCES `proveedor` (`ID_Proveedor`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `suministro`
--
ALTER TABLE `suministro`
  ADD CONSTRAINT `suministro_ibfk_1` FOREIGN KEY (`IdMedicamento`) REFERENCES `medicamento` (`ID_Medicamento`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `suministro_ibfk_2` FOREIGN KEY (`IdProveedor`) REFERENCES `proveedor` (`ID_Proveedor`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
