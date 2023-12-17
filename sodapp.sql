-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3307
-- Tiempo de generación: 14-12-2023 a las 00:02:05
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 8.0.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sodapp`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compras`
--

CREATE TABLE `compras` (
  `id` int(12) NOT NULL,
  `id_comprador` int(50) NOT NULL,
  `id_vendedor` int(50) NOT NULL,
  `monto` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `compras`
--

INSERT INTO `compras` (`id`, `id_comprador`, `id_vendedor`, `monto`) VALUES
(9, 4, 6, 2000),
(10, 5, 6, 2715),
(13, 5, 6, 1530),
(14, 5, 6, 1530),
(15, 5, 6, 1530),
(16, 5, 6, 1200),
(17, 5, 6, 415),
(18, 5, 6, 7500),
(19, 5, 6, 7500),
(20, 5, 6, 3000),
(21, 5, 6, 5000),
(22, 6, 3, 0),
(23, 6, 3, 1200),
(24, 6, 3, 1200),
(25, 6, 6, 45),
(26, 6, 3, 600),
(27, 6, 3, 600),
(28, 6, 3, 600),
(29, 4, 6, 500),
(30, 5, 6, 500),
(31, 5, 6, 2400),
(32, 5, 6, 5700),
(33, 12, 11, 2800),
(34, 12, 3, 2400),
(35, 12, 11, 1600),
(36, 12, 11, 300),
(37, 12, 11, 900),
(38, 12, 11, 400),
(39, 12, 11, 1200),
(40, 12, 11, 300),
(41, 12, 11, 300),
(42, 12, 11, 400),
(43, 12, 13, 3000),
(44, 12, 13, 20),
(45, 12, 6, 500),
(46, 12, 6, 500),
(47, 12, 6, 1500),
(48, 5, 13, 3000),
(49, 5, 13, 20),
(50, 5, 13, 1200),
(51, 12, 11, 400);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compras_agenda`
--

CREATE TABLE `compras_agenda` (
  `id` int(255) NOT NULL,
  `id_compra` int(255) NOT NULL,
  `dia` varchar(50) NOT NULL,
  `hora` varchar(50) NOT NULL,
  `d_id` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `compras_agenda`
--

INSERT INTO `compras_agenda` (`id`, `id_compra`, `dia`, `hora`, `d_id`) VALUES
(1, 40, 'Martes', '12:00', 3),
(2, 41, 'Martes', '13:00', 3),
(3, 42, 'Martes', '15:00', 3),
(4, 43, 'Miércoles', '16:00', 4),
(5, 44, 'Lunes', '00:00', 2),
(6, 46, 'Miércoles', '13:00', 4),
(7, 48, 'Miércoles', '12:00', 4),
(8, 49, 'Viernes', '12:00', 6),
(9, 50, 'Jueves', '10:00', 5),
(10, 51, 'Sábado', '3:00', 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compras_detalle`
--

CREATE TABLE `compras_detalle` (
  `id` int(50) NOT NULL,
  `id_producto` int(50) NOT NULL,
  `codigo_producto` varchar(50) NOT NULL,
  `precio` int(50) NOT NULL,
  `cantidad` int(50) NOT NULL,
  `id_comprador` int(50) NOT NULL,
  `id_vendedor` int(50) NOT NULL,
  `id_compra` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `compras_detalle`
--

INSERT INTO `compras_detalle` (`id`, `id_producto`, `codigo_producto`, `precio`, `cantidad`, `id_comprador`, `id_vendedor`, `id_compra`) VALUES
(1, 0, 'aa02', 30, 2, 5, 6, 0),
(2, 0, 'aa01', 1500, 1, 5, 6, 0),
(3, 0, 'aa02', 30, 2, 5, 6, 0),
(4, 0, 'aa01', 1500, 1, 5, 6, 0),
(5, 0, 'aa02', 30, 2, 5, 6, 15),
(6, 0, 'aa01', 1500, 1, 5, 6, 15),
(7, 1, 'aa00', 1000, 2, 5, 6, 16),
(8, 15, 'aa03', 200, 1, 5, 6, 16),
(9, 3, 'aa02', 15, 1, 5, 6, 17),
(10, 15, 'aa03', 400, 2, 5, 6, 17),
(11, 2, 'aa01', 7500, 5, 5, 6, 18),
(12, 2, 'aa01', 7500, 4, 5, 6, 19),
(13, 2, 'aa01', 3000, 1, 5, 6, 20),
(14, 15, 'aa03', 5000, 24, 5, 6, 21),
(15, 7, 'ba00', 1200, 1, 6, 3, 22),
(16, 7, 'ba00', 1200, 1, 6, 3, 23),
(17, 7, 'ba00', 1200, 1, 6, 3, 24),
(18, 3, 'aa02', 45, 2, 6, 6, 25),
(19, 7, 'ba00', 600, 0, 6, 3, 26),
(20, 7, 'ba00', 600, 1, 6, 3, 27),
(21, 7, 'ba00', 600, 1, 6, 3, 28),
(22, 1, 'aa00', 500, 1, 4, 6, 29),
(23, 1, 'aa00', 500, 1, 5, 6, 30),
(24, 2, 'aa01', 1500, 1, 5, 6, 31),
(25, 1, 'aa00', 500, 1, 5, 6, 31),
(26, 15, 'aa03', 400, 2, 5, 6, 31),
(27, 1, 'aa00', 2500, 5, 5, 6, 32),
(28, 2, 'aa01', 3000, 2, 5, 6, 32),
(29, 15, 'aa03', 200, 1, 5, 6, 32),
(30, 19, 'iv00', 1200, 1, 12, 11, 33),
(31, 20, 'iv01', 1600, 4, 12, 11, 33),
(32, 7, 'ba00', 2400, 4, 12, 3, 34),
(33, 20, 'iv01', 1600, 4, 12, 11, 35),
(34, 22, 'iv03', 300, 1, 12, 11, 36),
(35, 22, 'iv03', 900, 3, 12, 11, 37),
(36, 20, 'iv01', 400, 1, 12, 11, 38),
(37, 19, 'iv00', 1200, 1, 12, 11, 39),
(38, 21, 'iv02', 300, 1, 12, 11, 40),
(39, 22, 'iv03', 300, 1, 12, 11, 41),
(40, 20, 'iv01', 400, 1, 12, 11, 42),
(41, 29, 'ci00', 3000, 1, 12, 13, 43),
(42, 31, 'ci02', 20, 1, 12, 13, 44),
(43, 1, 'aa00', 500, 1, 12, 6, 45),
(44, 1, 'aa00', 500, 1, 12, 6, 46),
(45, 2, 'aa01', 1500, 1, 12, 6, 47),
(46, 29, 'ci00', 3000, 1, 5, 13, 48),
(47, 31, 'ci02', 20, 1, 5, 13, 49),
(48, 30, 'ci01', 1200, 3, 5, 13, 50),
(49, 20, 'iv01', 400, 1, 12, 11, 51);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(12) NOT NULL,
  `nombre` varchar(50) CHARACTER SET latin1 NOT NULL,
  `precio` int(50) NOT NULL,
  `codigo` varchar(50) CHARACTER SET latin1 NOT NULL,
  `cantidad` int(50) NOT NULL,
  `id_vendedor` int(50) NOT NULL,
  `imagen` varchar(100) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `precio`, `codigo`, `cantidad`, `id_vendedor`, `imagen`) VALUES
(1, 'Soda', 500, 'aa00', 11, 6, 'imagenes/productos/Sodaaa00.png'),
(2, 'Bidón De Agua', 1500, 'aa01', 9, 6, 'imagenes/productos/Bidón_De_Aguaaa01.png'),
(7, 'Coca-Cola', 600, 'ba00', 3, 3, 'imagenes\\productos\\coca.png'),
(15, 'Vaso De Agua', 200, 'aa03', 72, 6, 'imagenes/productos/Vaso_De_Aguaaa03.png'),
(19, 'Botellones De Agua Retornables IVESS', 1200, 'iv00', 49, 11, 'imagenes/productos/Botellones_De_Agua_Retornables_IVESS.png'),
(20, 'Sifones De Soda Retornables IVESS', 400, 'iv01', 89, 11, 'imagenes/productos/Sifones_De_Soda_Retornables_IVESS.png'),
(21, 'Botellas De Agua Sin Gas IVESS', 300, 'iv02', 299, 11, 'imagenes/productos/Botellas_De_Agua_Sin_Gas_IVESS.png'),
(22, 'Aguas Saborizadas Con Gas IVESS', 300, 'iv03', 395, 11, 'imagenes/productos/Aguas_Saborizadas_Con_Gas_IVESS.png'),
(23, 'Botellones De Agua Descartables IVESS', 2000, 'iv04', 150, 11, 'imagenes/productos/Botellones_De_Agua_Descartables_IVESS.png'),
(24, 'Sifones De Soda Descartables IVESS', 400, 'iv05', 500, 11, 'imagenes/productos/Sifones_De_Soda_Descartables_IVESS.png'),
(25, 'Aguas Saborizadas Sin Gas IVESS', 300, 'iv06', 400, 11, 'imagenes/productos/Aguas_Saborizadas_Sin_Gas_IVESSiv06.png'),
(26, 'Dispenser De Pie De Agua Frío Calor', 5000, 'iv07', 25, 11, 'imagenes/productos/Dispenser_De_Pie_De_Agua_Frío_Caloriv07.png'),
(27, 'Dispenser De Agua Con Heladera Frío Calor', 10000, 'iv08', 15, 11, 'imagenes/productos/Dispenser_De_Agua_Con_Heladera_Frío_Caloriv08.png'),
(28, 'Dispenser De Agua Para Mesada Frío Calor', 4500, 'iv09', 15, 11, 'imagenes/productos/Dispenser_De_Agua_Para_Mesada_Frío_Calor.png'),
(29, 'Agua En Botellón Retornable 12 Litros', 3000, 'ci00', 48, 13, 'imagenes/productos/Agua_En_Botellón_Retornable_12_Litros.png'),
(30, 'Soda En Sifones Retornables Litro Y Medio', 400, 'ci01', 197, 13, 'imagenes/productos/Soda_En_Sifones_Retornables_Litro_Y_Medioci01.png'),
(31, 'Sobres De Jugo', 20, 'ci02', -2, 13, 'imagenes/productos/Sobres_De_Jugo.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(10) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `contrasena` varchar(50) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `telefono` varchar(50) NOT NULL,
  `tipo` enum('ADMIN','CLIENTE','VENDEDOR') NOT NULL,
  `email` varchar(50) NOT NULL,
  `imagen` varchar(400) NOT NULL,
  `direccion` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `usuario`, `contrasena`, `nombre`, `apellido`, `telefono`, `tipo`, `email`, `imagen`, `direccion`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Admin', 'Sodapp', '12341234', 'ADMIN', 'admin@prueba.com', 'imagenes/perfil/profile.png', ''),
(3, 'vendedor', '0407e8c8285ab85509ac2884025dcf42', 'Vendedor', 'Prueba', '12341234', 'VENDEDOR', 'vendedor@prueba.com', 'imagenes/perfil/vendedor.jpg', 'Av. Gral. Indalecio Chenaut 1837'),
(4, 'cliente', '4983a0ab83ed86e0e7213c8783940193', 'Cliente', 'Prueba', '12341234', 'CLIENTE', 'cliente@prueba.com', 'imagenes/perfil/profile.png', 'República del Líbano 1581, B1870 Gerli, Provincia de Buenos Aires'),
(5, 'Oko1995', '202cb962ac59075b964b07152d234b70', 'Ivan', 'O Connell', '01139112467', 'CLIENTE', 'ia.oconnell@hotmail.com', 'imagenes/perfil/Oko1995.png', 'Comuna 11, Alfredo R. Bufano 1246, C1416AJB CABA'),
(6, 'franp', '5aba8499883efa1f9a9fb5100351b12d', 'Franco', 'Pozzetti', '64373456', 'VENDEDOR', 'franco.pozzetti@davinci.edu.ar', 'imagenes/perfil/franp.png', 'Muñiz 355, C1184 CABA'),
(9, 'Sodavinci', 'aea862aa22a0f5b829d5795882889c08', 'Leonardo', 'Da Vinci', '30930935', 'VENDEDOR', 'leo@davinci.edu.ar', 'imagenes/perfil/Sodavinci.png', 'Av. Corrientes 2037, C1001 CABA'),
(10, 'Prueba', 'fa5a02c9cc183b3ff1bfcd4c2243f85c', 'Prueba', 'Di Probando', '12341234', 'CLIENTE', 'prueba@prueba.com', 'imagenes/perfil/Prueba.png', 'Gral. Juan Lavalle 1262, B1638COL Vicente López, Provincia de Buenos Aires'),
(11, 'Ivess', '149218ee3f01de3ab0e958afd6f95d51', 'Ivess', 'S.A.', '42072428', 'VENDEDOR', 'ventas@ivess.com', 'imagenes/perfil/Ivess.png', 'Av. Belgrano 4056, C1210AAV CABA'),
(12, 'mabelv', 'c54fdf9dd28d984697251054720c50cf', 'Mabel', 'Vazquez', '45820454', 'CLIENTE', 'mabel.vazquez@gmail.com', 'imagenes/perfil/mabelv.png', 'Lucero 289, C1208 AAA, Buenos Aires'),
(13, 'Cimes', '791cdf6b92430f5e9f0576f3b2b1feb6', 'Cimes', 'S.A.', '12753512', 'VENDEDOR', 'ventas@cimes.com', 'imagenes/perfil/Cimes.png', 'Zapiola 2712, C1428CXR CABA');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `compras`
--
ALTER TABLE `compras`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `compras_agenda`
--
ALTER TABLE `compras_agenda`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `compras_detalle`
--
ALTER TABLE `compras_detalle`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `compras`
--
ALTER TABLE `compras`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT de la tabla `compras_agenda`
--
ALTER TABLE `compras_agenda`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `compras_detalle`
--
ALTER TABLE `compras_detalle`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
