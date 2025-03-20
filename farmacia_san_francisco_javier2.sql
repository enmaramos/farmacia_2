-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-03-2025 a las 03:39:19
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

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `AgregarVendedorConUsuario` (IN `p_Nombre` VARCHAR(70), IN `p_Apellido` VARCHAR(50), IN `p_N_Cedula` VARCHAR(30), IN `p_Telefono` VARCHAR(10), IN `p_Email` VARCHAR(100), IN `p_Direccion` VARCHAR(200), IN `p_Sexo` CHAR(1), IN `p_Estado` TINYINT, IN `p_ID_Rol` INT, IN `p_Nombre_Usuario` VARCHAR(50), IN `p_Password` VARCHAR(100), IN `p_Imagen` TEXT)   BEGIN
    DECLARE v_ID_Vendedor INT;

    -- Insertar el vendedor en la tabla vendedor
    INSERT INTO vendedor (Nombre, Apellido, N_Cedula, Telefono, Email, Direccion, Sexo, Estado, ID_Rol)
    VALUES (p_Nombre, p_Apellido, p_N_Cedula, p_Telefono, p_Email, p_Direccion, p_Sexo, p_Estado, p_ID_Rol);

    -- Obtener el ID del vendedor recién insertado
    SET v_ID_Vendedor = LAST_INSERT_ID();

    -- Insertar el usuario en la tabla usuarios
    INSERT INTO usuarios (Nombre_Usuario, Imagen, Password, ID_Vendedor, estado_usuario)
    VALUES (p_Nombre_Usuario, p_Imagen, p_Password, v_ID_Vendedor, 1);
    
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `almacen`
--

CREATE TABLE `almacen` (
  `IdPedido` int(11) DEFAULT NULL,
  `IdBodega` int(11) NOT NULL,
  `ID_Medicamento` int(11) DEFAULT NULL
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
  `Total_Fact_Comp` float DEFAULT NULL,
  `ID_Proveedor` int(11) DEFAULT NULL,
  `ID_Medicamento` int(11) DEFAULT NULL
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
  `IdCliente` int(11) NOT NULL,
  `ID_Vendedor` int(11) DEFAULT NULL
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
  `Precio_Total_Lote` float DEFAULT NULL,
  `ID_Medicamento` int(11) DEFAULT NULL
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
  `IdVendedor` int(11) DEFAULT NULL,
  `IdFacturaV` int(11) DEFAULT NULL
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
  `Telefono` varchar(15) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `Email` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `RUC` varchar(15) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `Estado` tinyint(1) DEFAULT 1,
  `Fecha_Registro` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `proveedor`
--

INSERT INTO `proveedor` (`ID_Proveedor`, `Nombre`, `Laboratorio`, `Direccion`, `Telefono`, `Email`, `RUC`, `Estado`, `Fecha_Registro`) VALUES
(1, 'Derek', 'somoza', 'barrio milagro', '15415151', 'mcadavo@gamail', '3515645', 1, '2025-03-08 19:34:50');

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
  `Descripcion_Rol` varchar(200) DEFAULT NULL,
  `Estado` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`ID_Rol`, `Nombre_Rol`, `Descripcion_Rol`, `Estado`) VALUES
(1, 'Administrador', 'Todos los Accesos', 1),
(2, 'Empleado', 'Acceso limitado a funciones básicas', 1);

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
  `Password` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `ID_Vendedor` int(11) DEFAULT NULL,
  `estado_usuario` tinyint(1) DEFAULT 1,
  `Fecha_Creacion` timestamp NOT NULL DEFAULT current_timestamp(),
  `Ultimo_Acceso` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`ID_Usuario`, `Nombre_Usuario`, `Imagen`, `Password`, `ID_Vendedor`, `estado_usuario`, `Fecha_Creacion`, `Ultimo_Acceso`) VALUES
(1, 'Derek', '449310638_122108766050369563_655787570102137785_n.jpg', 'Djsomoza31', 1, 1, '2025-03-08 19:22:06', NULL),
(2, 'Nestor Aguirre', 'images.PNG', 'Aguire25', NULL, 1, '2025-03-08 19:22:06', NULL),
(4, 'Maisho', 'images.jpg', 'Maishi10', NULL, 0, '2025-03-08 19:22:06', NULL),
(5, 'Nestor', NULL, '123456', 2, 1, '2025-03-08 20:08:10', NULL),
(21, 'Emmanuel Serrano', NULL, '123456', 28, 1, '2025-03-08 22:49:51', NULL),
(22, 'Francisco Perez', NULL, '123456', 29, 1, '2025-03-11 01:08:45', NULL),
(23, 'Gerson Sanchez', NULL, '123456', 33, 1, '2025-03-11 02:24:37', NULL),
(24, 'juanperez', NULL, 'miClave123', 34, 1, '2025-03-12 22:14:24', NULL),
(25, 'Luis Chavez', NULL, '123456', 36, 1, '2025-03-12 22:52:57', NULL),
(26, 'Marcos Ramos', NULL, '123456', 37, 1, '2025-03-12 23:01:52', NULL),
(29, 'kenny Solis', NULL, '123456', 44, 1, '2025-03-20 00:24:18', NULL),
(30, 'Franklin Jiron', NULL, '123456', 45, 1, '2025-03-20 01:57:18', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vendedor`
--

CREATE TABLE `vendedor` (
  `ID_Vendedor` int(11) NOT NULL,
  `Nombre` varchar(70) DEFAULT NULL,
  `N_Cedula` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Telefono` varchar(10) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Direccion` varchar(200) DEFAULT NULL,
  `Sexo` char(1) DEFAULT NULL CHECK (`Sexo` in ('H','M')),
  `Estado` tinyint(1) DEFAULT 1,
  `ID_Rol` int(11) DEFAULT NULL,
  `Apellido` varchar(50) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `vendedor`
--

INSERT INTO `vendedor` (`ID_Vendedor`, `Nombre`, `N_Cedula`, `Telefono`, `Email`, `Direccion`, `Sexo`, `Estado`, `ID_Rol`, `Apellido`) VALUES
(1, 'Derek Jameson', '001-311001-1085U', '8601-8985', 'Djsomoza@gmail.com', 'Milagro de Dios', 'H', 1, 1, 'Somoza'),
(2, 'Nestor Gabriel', '001-233525-1211V', '1236-5487', 'AguirreCanales@gmail.com', 'Villa el carmen ', 'H', 1, 2, 'Aguirre Canales'),
(28, 'Emmanuel', '001-130901-1010W', '8868-8476', 'mcdavo1309@gmail.com', 'Vi.Venezuela Colegio Hispano Americano 1/2 C.O Casa #1993-94', 'H', 1, 2, 'Serrano Ramos'),
(29, 'Francisco jose', '001-122410-2541P', '1224-5876', 'franciscoperez@gmail.com', 'Masaya', 'H', 1, 2, 'Perez'),
(33, 'Gerson Ezequiel', '025-200504-2055X', '7523-6542', 'gersonsanchez@gmail.com', 'Cuidad Sandino', 'H', 1, 2, 'Sanchez Hernadez'),
(34, 'Juan', '001-220598-0001A', '8888-9999', 'juan@example.com', 'Calle 123, Ciudad X', 'H', 1, 2, 'Pérez'),
(36, 'Luis Eduardo', '001-563290-2045N', '8623-5412', 'LuisChavez@gmail.com', 'Cuidad Sandino', 'H', 1, 1, 'Chavez Mairena'),
(37, 'Marcos Orlando', '001-236292-6451S', '8856-2341', 'MarcoRamos21@gmail.com', 'Managua', 'H', 1, 2, 'Ramos Vado'),
(44, 'kenny Ivania', '001-958612-3526J', '8569-4512', 'kennysolis@gmail.com', 'Cristo Rey', 'M', 1, 2, 'Solis Ampie'),
(45, 'Franklin Randal', '001-365941-5623F', '5623-5412', 'FranklinJiron@gmail.com', 'managua', 'H', 1, 2, 'Jiron');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta_medicamento`
--

CREATE TABLE `venta_medicamento` (
  `ID_Medicamento` int(11) DEFAULT NULL,
  `ID_FacturaV` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `almacen`
--
ALTER TABLE `almacen`
  ADD KEY `IdPedido` (`IdPedido`),
  ADD KEY `IdBodega` (`IdBodega`),
  ADD KEY `fk_almacen_medicamento` (`ID_Medicamento`);

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
  ADD PRIMARY KEY (`ID_FacturaC`),
  ADD KEY `fk_factura_compra_proveedor` (`ID_Proveedor`),
  ADD KEY `fk_factura_compra_medicamento` (`ID_Medicamento`);

--
-- Indices de la tabla `factura_venta`
--
ALTER TABLE `factura_venta`
  ADD PRIMARY KEY (`ID_FacturaV`),
  ADD KEY `IdCliente` (`IdCliente`),
  ADD KEY `fk_factura_venta_vendedor` (`ID_Vendedor`);

--
-- Indices de la tabla `lote`
--
ALTER TABLE `lote`
  ADD PRIMARY KEY (`ID_Lote`),
  ADD KEY `fk_lote_medicamento` (`ID_Medicamento`);

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
  ADD KEY `IdVendedor` (`IdVendedor`),
  ADD KEY `fk_pedido_factura` (`IdFacturaV`);

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
  ADD UNIQUE KEY `unique_vendedor` (`ID_Vendedor`),
  ADD KEY `ID_Vendedor` (`ID_Vendedor`);

--
-- Indices de la tabla `vendedor`
--
ALTER TABLE `vendedor`
  ADD PRIMARY KEY (`ID_Vendedor`),
  ADD UNIQUE KEY `Email` (`Email`),
  ADD UNIQUE KEY `N_Cedula` (`N_Cedula`),
  ADD KEY `fk_rol` (`ID_Rol`);

--
-- Indices de la tabla `venta_medicamento`
--
ALTER TABLE `venta_medicamento`
  ADD KEY `IdMedicamento` (`ID_Medicamento`),
  ADD KEY `fk_venta_medicamento_factura` (`ID_FacturaV`);

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
  MODIFY `ID_Usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `vendedor`
--
ALTER TABLE `vendedor`
  MODIFY `ID_Vendedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `almacen`
--
ALTER TABLE `almacen`
  ADD CONSTRAINT `almacen_ibfk_1` FOREIGN KEY (`IdPedido`) REFERENCES `pedido` (`ID_Pedido`),
  ADD CONSTRAINT `almacen_ibfk_2` FOREIGN KEY (`IdBodega`) REFERENCES `bodega` (`ID_Bodega`),
  ADD CONSTRAINT `fk_almacen_bodega` FOREIGN KEY (`IdBodega`) REFERENCES `bodega` (`ID_Bodega`),
  ADD CONSTRAINT `fk_almacen_medicamento` FOREIGN KEY (`ID_Medicamento`) REFERENCES `medicamento` (`ID_Medicamento`);

--
-- Filtros para la tabla `factura_compra`
--
ALTER TABLE `factura_compra`
  ADD CONSTRAINT `fk_factura_compra_medicamento` FOREIGN KEY (`ID_Medicamento`) REFERENCES `medicamento` (`ID_Medicamento`),
  ADD CONSTRAINT `fk_factura_compra_proveedor` FOREIGN KEY (`ID_Proveedor`) REFERENCES `proveedor` (`ID_Proveedor`);

--
-- Filtros para la tabla `factura_venta`
--
ALTER TABLE `factura_venta`
  ADD CONSTRAINT `fk_factura_venta_cliente` FOREIGN KEY (`IdCliente`) REFERENCES `clientes` (`ID_Cliente`),
  ADD CONSTRAINT `fk_factura_venta_vendedor` FOREIGN KEY (`ID_Vendedor`) REFERENCES `usuarios` (`ID_Usuario`);

--
-- Filtros para la tabla `lote`
--
ALTER TABLE `lote`
  ADD CONSTRAINT `fk_lote_medicamento` FOREIGN KEY (`ID_Medicamento`) REFERENCES `medicamento` (`ID_Medicamento`);

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
-- Filtros para la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD CONSTRAINT `fk_pedido_factura` FOREIGN KEY (`IdFacturaV`) REFERENCES `factura_venta` (`ID_FacturaV`);

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
  ADD CONSTRAINT `fk_suministro_proveedor` FOREIGN KEY (`IdProveedor`) REFERENCES `proveedor` (`ID_Proveedor`),
  ADD CONSTRAINT `suministro_ibfk_1` FOREIGN KEY (`IdMedicamento`) REFERENCES `medicamento` (`ID_Medicamento`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `suministro_ibfk_2` FOREIGN KEY (`IdProveedor`) REFERENCES `proveedor` (`ID_Proveedor`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `fk_usuarios_vendedor` FOREIGN KEY (`ID_Vendedor`) REFERENCES `vendedor` (`ID_Vendedor`);

--
-- Filtros para la tabla `vendedor`
--
ALTER TABLE `vendedor`
  ADD CONSTRAINT `fk_rol` FOREIGN KEY (`ID_Rol`) REFERENCES `roles` (`ID_Rol`);

--
-- Filtros para la tabla `venta_medicamento`
--
ALTER TABLE `venta_medicamento`
  ADD CONSTRAINT `fk_venta_medicamento` FOREIGN KEY (`ID_Medicamento`) REFERENCES `medicamento` (`ID_Medicamento`),
  ADD CONSTRAINT `fk_venta_medicamento_factura` FOREIGN KEY (`ID_FacturaV`) REFERENCES `factura_venta` (`ID_FacturaV`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
