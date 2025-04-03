-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 03-04-2025 a las 22:50:03
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
(8, 'Antidepresivos', 'Medicamentos para tratar trastornos depresivos'),
(9, 'Higiene', 'Cuidado del bienestar y la salud de todas las personas.');

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
  `Telefono` varchar(9) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `Fecha_Nacimiento` date DEFAULT NULL,
  `Fecha_Registro` datetime DEFAULT current_timestamp(),
  `Cedula` varchar(20) DEFAULT NULL,
  `Estado` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`ID_Cliente`, `Nombre`, `Apellido`, `Genero`, `Direccion`, `Telefono`, `Email`, `Fecha_Nacimiento`, `Fecha_Registro`, `Cedula`, `Estado`) VALUES
(62, 'Juan', 'Perez', 'Masculino', 'Calle 1, No. 23', '12345678', 'juan.perez@email.com', '1985-07-15', '2025-03-31 18:36:54', '001-123625-1010W', 1),
(63, 'Maria', 'Lopez', 'Femenino', 'Calle 2, No. 10', '23456789', 'maria.lopez@email.com', '1990-03-22', '2025-03-31 18:36:54', '001-234567-1020X', 1),
(64, 'Carlos', 'Martinez', 'Masculino', 'Calle 3, No. 34', '34567890', 'carlos.martinez@email.com', '1982-11-10', '2025-03-31 18:36:54', '001-345678-1030Y', 1),
(65, 'Ana', 'Gonzalez', 'Femenino', 'Calle 4, No. 45', '45678901', 'ana.gonzalez@email.com', '1995-05-30', '2025-03-31 18:36:54', '001-456789-1040Z', 1),
(66, 'Luis', 'Rodriguez', 'Masculino', 'Calle 5, No. 50', '56789012', 'luis.rodriguez@email.com', '1988-02-19', '2025-03-31 18:36:54', '001-567890-1050W', 1),
(67, 'Sofia', 'Perez', 'Femenino', 'Calle 6, No. 60', '67890123', 'sofia.perez@email.com', '1993-09-09', '2025-03-31 18:36:54', '001-678901-1060X', 1),
(68, 'Andres', 'Martinez', 'Masculino', 'Calle 7, No. 70', '78901234', 'andres.martinez@email.com', '1980-12-05', '2025-03-31 18:36:54', '001-789012-1070Y', 1),
(69, 'Lucia', 'Hernandez', 'Femenino', 'Calle 8, No. 80', '89012345', 'lucia.hernandez@email.com', '1992-06-18', '2025-03-31 18:36:54', '001-890123-1080Z', 1),
(70, 'Ricardo', 'Lopez', 'Masculino', 'Calle 9, No. 90', '90123456', 'ricardo.lopez@email.com', '1987-01-30', '2025-03-31 18:36:54', '001-901234-1090W', 1),
(71, 'Valentina', 'Garcia', 'Femenino', 'Calle 10, No. 100', '11223344', 'valentina.garcia@email.com', '2000-04-25', '2025-03-31 18:36:54', '001-112233-1100X', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura_compra`
--

CREATE TABLE `factura_compra` (
  `ID_FacturaC` int(11) NOT NULL,
  `Descripcion_Compra` varchar(300) DEFAULT NULL,
  `Fecha_Emision` datetime DEFAULT NULL,
  `Estado_Pedido` varchar(100) DEFAULT NULL,
  `Subtotal_Fact_Comp` float DEFAULT NULL,
  `Iva_Fact_Comp` float DEFAULT NULL,
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
  `ID_Medicamento` int(11) DEFAULT NULL,
  `Stock_Minimo_Lote` int(11) NOT NULL DEFAULT 0,
  `Stock_Maximo_Lote` int(11) NOT NULL DEFAULT 0,
  `ID_Presentacion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `lote`
--

INSERT INTO `lote` (`ID_Lote`, `Descripcion_Lote`, `Estado_Lote`, `Cantidad_Lote`, `Fecha_Fabricacion_Lote`, `Fecha_Caducidad_Lote`, `Fecha_Emision_Lote`, `Fecha_Recibido_Lote`, `Prec_Unidad_Lote`, `Precio_Total_Lote`, `ID_Medicamento`, `Stock_Minimo_Lote`, `Stock_Maximo_Lote`, `ID_Presentacion`) VALUES
(1, '	Amoxicilina Caja', 'Activo', 50, '2024-01-12 00:00:00', '2026-02-01 00:00:00', NULL, NULL, NULL, NULL, 1, 10, 100, 1),
(2, '	Amoxicilina Sobre', 'Activo', 100, '2024-01-12 00:00:00', '2026-02-01 00:00:00', NULL, NULL, NULL, NULL, 1, 20, 200, 2),
(3, 'Amoxicilina Unidad', 'Activo', 500, '2024-01-12 00:00:00', '2026-02-01 00:00:00', NULL, NULL, NULL, NULL, 1, 50, 1000, 3),
(4, 'Pampers Bolsa', 'Activo', 200, '2024-05-15 00:00:00', '2027-03-06 00:00:00', NULL, NULL, NULL, NULL, 30, 5, 200, 4),
(5, 'Pampers Unidad', 'Activo', 3000, '2024-05-15 00:00:00', '2027-03-06 00:00:00', NULL, NULL, NULL, NULL, 30, 75, 3000, 5);

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
-- Estructura de tabla para la tabla `lote_presentacion`
--

CREATE TABLE `lote_presentacion` (
  `ID_Lote_Presentacion` int(11) NOT NULL,
  `ID_Lote` int(11) NOT NULL,
  `ID_Presentacion` int(11) NOT NULL,
  `Cantidad_Presentacion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `lote_presentacion`
--

INSERT INTO `lote_presentacion` (`ID_Lote_Presentacion`, `ID_Lote`, `ID_Presentacion`, `Cantidad_Presentacion`) VALUES
(1, 1, 1, 0),
(2, 2, 2, 0),
(3, 3, 3, 0),
(6, 4, 4, 0),
(7, 5, 5, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medicamento`
--

CREATE TABLE `medicamento` (
  `ID_Medicamento` int(11) NOT NULL,
  `Nombre_Medicamento` varchar(30) DEFAULT NULL,
  `LAB_o_MARCA` varchar(100) NOT NULL,
  `Imagen` varchar(255) DEFAULT NULL,
  `Descripcion_Medicamento` varchar(250) DEFAULT NULL,
  `Prescripcion_Medica` varchar(150) DEFAULT NULL,
  `IdCategoria` int(11) DEFAULT NULL,
  `Estado` tinyint(1) DEFAULT 1,
  `Requiere_Receta` tinyint(1) DEFAULT 0,
  `Id_Proveedor` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `medicamento`
--

INSERT INTO `medicamento` (`ID_Medicamento`, `Nombre_Medicamento`, `LAB_o_MARCA`, `Imagen`, `Descripcion_Medicamento`, `Prescripcion_Medica`, `IdCategoria`, `Estado`, `Requiere_Receta`, `Id_Proveedor`) VALUES
(1, 'Amoxicilina', 'Lab-Ramos', 'amoxicilina.jpg', 'Antibiótico de amplio espectro.', 'No requiere receta', 1, 1, 0, 1),
(21, 'Eritromicina', 'Lab-Ramos', 'eritromicina.jpg', 'Infeccion', 'Alergias', 2, 1, 0, 1),
(24, 'Actimicina Bronquial', 'Bayer', 'ActimicinaBronquial.jpg', 'Para Gripe', 'Gripe o Calentura', 4, 1, 0, 1),
(27, 'Ibuprofeno', 'Bayer', 'Ibuprofeno.jpg', 'Medicamento que se usa para tratar la fiebre, la hinchazón, el dolor y el enrojecimiento', 'En general, los adultos y niños mayores de 12 años pueden tomar el ibuprofeno de venta libre cada 4 a 6 horas', 5, 1, 0, 1),
(28, 'Acetamenofen ', 'Lab-Ramos', 'acetamenofen.jpg', 'Analgésico y antipirético, inhibidor de la síntesis de prostaglandinas periférica y central por acción sobre la ciclooxigenasa.', 'El acetaminofeno se usa para aliviar el dolor leve o moderado de las cefaleas, dolores musculares, períodos menstruales, resfriados, y los dolores de ', 5, 1, 0, 1),
(30, 'Pampers', 'Previal', 'pampers previal.jpg', 'Pañales para abulto', NULL, 8, 1, 0, 1),
(33, 'Diclofenac Sodico', 'COFARCA', 'Diclofenac Sodico.jpg', 'para aliviar el dolor y la inflamación en diversos procesos', 'Tratamiento del dolor agudo moderado a severo', 3, 1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medicamento_dosis`
--

CREATE TABLE `medicamento_dosis` (
  `ID_Dosis` int(11) NOT NULL,
  `ID_Medicamento` int(11) NOT NULL,
  `Dosis` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `medicamento_dosis`
--

INSERT INTO `medicamento_dosis` (`ID_Dosis`, `ID_Medicamento`, `Dosis`) VALUES
(1, 1, '20gm'),
(2, 1, '50gm'),
(3, 1, '80gm'),
(4, 21, '30gm'),
(5, 21, '80gm'),
(6, 27, '200mg'),
(7, 27, '600mg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medicamento_forma_farmaceutica`
--

CREATE TABLE `medicamento_forma_farmaceutica` (
  `ID_Forma_Farmaceutica` int(11) NOT NULL,
  `ID_Medicamento` int(11) NOT NULL,
  `Forma_Farmaceutica` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `medicamento_forma_farmaceutica`
--

INSERT INTO `medicamento_forma_farmaceutica` (`ID_Forma_Farmaceutica`, `ID_Medicamento`, `Forma_Farmaceutica`) VALUES
(1, 1, 'tableta'),
(2, 1, 'capsula'),
(3, 30, 'Talla M'),
(5, 30, 'Talla S'),
(6, 21, 'Capsula'),
(7, 27, 'tableta'),
(8, 28, 'tableta'),
(9, 24, 'tableta');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medicamento_presentacion`
--

CREATE TABLE `medicamento_presentacion` (
  `ID_Presentacion` int(11) NOT NULL,
  `ID_Medicamento` int(11) NOT NULL,
  `Tipo_Presentacion` varchar(50) NOT NULL,
  `Total_Presentacion` int(11) NOT NULL,
  `Precio` decimal(10,2) NOT NULL,
  `Total_Unidades` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `medicamento_presentacion`
--

INSERT INTO `medicamento_presentacion` (`ID_Presentacion`, `ID_Medicamento`, `Tipo_Presentacion`, `Total_Presentacion`, `Precio`, `Total_Unidades`) VALUES
(1, 1, 'Sobre', 10, 70.00, 0),
(2, 1, 'Unida', 1, 7.00, 0),
(3, 1, 'Caja', 15, 1050.00, 0),
(4, 30, 'Bolsa', 15, 500.00, 0),
(5, 30, 'Unidad', 1, 40.00, 0),
(6, 21, 'sobre', 12, 48.00, 0),
(7, 21, 'caja', 18, 864.00, 0),
(8, 21, 'unidad', 1, 8.00, 0),
(9, 24, 'Unidad', 1, 10.00, 0),
(10, 24, 'Sobre', 10, 90.00, 0),
(11, 24, 'Caja', 100, 850.00, 0),
(12, 27, 'Unidad', 1, 12.50, 0),
(13, 27, 'Sobre', 10, 115.00, 0),
(14, 27, 'Caja', 100, 1050.00, 0),
(15, 28, 'Unidad', 1, 15.00, 0),
(16, 28, 'Sobre', 10, 135.00, 0),
(17, 28, 'Caja', 100, 1250.00, 0);

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
  ADD KEY `fk_lote_medicamento` (`ID_Medicamento`),
  ADD KEY `fk_lote_presentacion` (`ID_Presentacion`);

--
-- Indices de la tabla `lotefact`
--
ALTER TABLE `lotefact`
  ADD KEY `IdLote` (`IdLote`),
  ADD KEY `IdFacturaC` (`IdFacturaC`);

--
-- Indices de la tabla `lote_presentacion`
--
ALTER TABLE `lote_presentacion`
  ADD PRIMARY KEY (`ID_Lote_Presentacion`),
  ADD KEY `ID_Lote` (`ID_Lote`),
  ADD KEY `ID_Presentacion` (`ID_Presentacion`);

--
-- Indices de la tabla `medicamento`
--
ALTER TABLE `medicamento`
  ADD PRIMARY KEY (`ID_Medicamento`),
  ADD KEY `IdCategoria` (`IdCategoria`),
  ADD KEY `fk_proveedor` (`Id_Proveedor`);

--
-- Indices de la tabla `medicamento_dosis`
--
ALTER TABLE `medicamento_dosis`
  ADD PRIMARY KEY (`ID_Dosis`),
  ADD KEY `ID_Medicamento` (`ID_Medicamento`);

--
-- Indices de la tabla `medicamento_forma_farmaceutica`
--
ALTER TABLE `medicamento_forma_farmaceutica`
  ADD PRIMARY KEY (`ID_Forma_Farmaceutica`),
  ADD KEY `ID_Medicamento` (`ID_Medicamento`);

--
-- Indices de la tabla `medicamento_presentacion`
--
ALTER TABLE `medicamento_presentacion`
  ADD PRIMARY KEY (`ID_Presentacion`),
  ADD KEY `ID_Medicamento` (`ID_Medicamento`);

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
  MODIFY `ID_Categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `ID_Cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

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
  MODIFY `ID_Lote` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `lote_presentacion`
--
ALTER TABLE `lote_presentacion`
  MODIFY `ID_Lote_Presentacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `medicamento`
--
ALTER TABLE `medicamento`
  MODIFY `ID_Medicamento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de la tabla `medicamento_dosis`
--
ALTER TABLE `medicamento_dosis`
  MODIFY `ID_Dosis` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `medicamento_forma_farmaceutica`
--
ALTER TABLE `medicamento_forma_farmaceutica`
  MODIFY `ID_Forma_Farmaceutica` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `medicamento_presentacion`
--
ALTER TABLE `medicamento_presentacion`
  MODIFY `ID_Presentacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

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
  ADD CONSTRAINT `fk_lote_medicamento` FOREIGN KEY (`ID_Medicamento`) REFERENCES `medicamento` (`ID_Medicamento`),
  ADD CONSTRAINT `fk_lote_presentacion` FOREIGN KEY (`ID_Presentacion`) REFERENCES `medicamento_presentacion` (`ID_Presentacion`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `lotefact`
--
ALTER TABLE `lotefact`
  ADD CONSTRAINT `lotefact_ibfk_1` FOREIGN KEY (`IdLote`) REFERENCES `lote` (`ID_Lote`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `lotefact_ibfk_2` FOREIGN KEY (`IdFacturaC`) REFERENCES `factura_compra` (`ID_FacturaC`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `lote_presentacion`
--
ALTER TABLE `lote_presentacion`
  ADD CONSTRAINT `lote_presentacion_ibfk_1` FOREIGN KEY (`ID_Lote`) REFERENCES `lote` (`ID_Lote`) ON DELETE CASCADE,
  ADD CONSTRAINT `lote_presentacion_ibfk_2` FOREIGN KEY (`ID_Presentacion`) REFERENCES `medicamento_presentacion` (`ID_Presentacion`) ON DELETE CASCADE;

--
-- Filtros para la tabla `medicamento`
--
ALTER TABLE `medicamento`
  ADD CONSTRAINT `fk_proveedor` FOREIGN KEY (`Id_Proveedor`) REFERENCES `proveedor` (`ID_Proveedor`),
  ADD CONSTRAINT `medicamento_ibfk_1` FOREIGN KEY (`IdCategoria`) REFERENCES `categoria` (`ID_Categoria`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Filtros para la tabla `medicamento_dosis`
--
ALTER TABLE `medicamento_dosis`
  ADD CONSTRAINT `medicamento_dosis_ibfk_1` FOREIGN KEY (`ID_Medicamento`) REFERENCES `medicamento` (`ID_Medicamento`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `medicamento_forma_farmaceutica`
--
ALTER TABLE `medicamento_forma_farmaceutica`
  ADD CONSTRAINT `medicamento_forma_farmaceutica_ibfk_1` FOREIGN KEY (`ID_Medicamento`) REFERENCES `medicamento` (`ID_Medicamento`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `medicamento_presentacion`
--
ALTER TABLE `medicamento_presentacion`
  ADD CONSTRAINT `medicamento_presentacion_ibfk_1` FOREIGN KEY (`ID_Medicamento`) REFERENCES `medicamento` (`ID_Medicamento`) ON DELETE CASCADE ON UPDATE CASCADE;

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
