-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-06-2017 a las 00:09:10
-- Versión del servidor: 10.1.19-MariaDB
-- Versión de PHP: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `parkhour`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cocheras`
--

CREATE TABLE `cocheras` (
  `id` int(11) NOT NULL,
  `numero` int(11) DEFAULT NULL,
  `discapacitados` tinyint(1) DEFAULT NULL,
  `uso` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cocheras`
--

INSERT INTO `cocheras` (`id`, `numero`, `discapacitados`, `uso`) VALUES
(1, 100, 1, 0),
(2, 101, 1, 0),
(3, 102, 1, 0),
(4, 103, 0, 0),
(5, 104, 0, 0),
(6, 105, 0, 0),
(7, 106, 0, 0),
(8, 107, 0, 0),
(9, 108, 0, 0),
(10, 109, 0, 0),
(11, 200, 1, 0),
(12, 201, 1, 0),
(13, 202, 1, 0),
(14, 203, 0, 0),
(15, 204, 0, 0),
(16, 205, 0, 0),
(17, 206, 0, 0),
(18, 207, 0, 0),
(19, 208, 0, 0),
(20, 209, 0, 0),
(21, 300, 1, 0),
(22, 301, 1, 0),
(23, 302, 1, 0),
(24, 303, 0, 0),
(25, 304, 0, 0),
(26, 305, 0, 0),
(27, 306, 0, 0),
(28, 307, 0, 0),
(29, 308, 0, 0),
(30, 309, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `movimientos`
--

CREATE TABLE `movimientos` (
  `id` int(11) NOT NULL,
  `patente` varchar(15) DEFAULT NULL,
  `marca` varchar(20) DEFAULT NULL,
  `color` varchar(30) DEFAULT NULL,
  `idusuario` int(11) DEFAULT NULL,
  `idcochera` int(11) DEFAULT NULL,
  `ingresofechahora` date DEFAULT NULL,
  `egresofechahora` date DEFAULT NULL,
  `total` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `movimientos`
--

INSERT INTO `movimientos` (`id`, `patente`, `marca`, `color`, `idusuario`, `idcochera`, `ingresofechahora`, `egresofechahora`, `total`) VALUES
(1, 'DPX769', 'Renault', 'rojo', 1, 7, NULL, NULL, NULL),
(2, 'BNQ723', 'Renault', 'gris', 1, 4, NULL, NULL, NULL),
(3, 'OYA833', 'Ford', 'verde', 1, 1, NULL, NULL, NULL),
(4, 'QWE325', 'Maclaren', 'azul', 1, 8, NULL, NULL, NULL),
(5, 'RTY291', 'Mazda', 'bordo', 1, 5, NULL, NULL, NULL),
(6, 'YUI821', 'Fiat', 'negro', 1, 2, NULL, NULL, NULL),
(7, 'SDF179', 'Ferrary', 'blanco', 1, 9, NULL, NULL, NULL),
(8, 'FGH397', 'LandRover', 'blanco', 1, 6, NULL, NULL, NULL),
(9, 'GHJ369', 'RollsRoys', 'gris', 1, 3, NULL, NULL, NULL),
(10, 'HJK258', 'Peugueot', 'rojo', 1, 11, NULL, NULL, NULL),
(11, 'ZXC147', 'Citroen', 'verde', 1, 21, NULL, NULL, NULL),
(12, 'XCV741', 'Kia', 'gris', 1, 15, NULL, NULL, NULL),
(13, 'CVB852', 'Mazda', 'amarillo', 1, 17, NULL, NULL, NULL),
(14, 'VBN963', 'Renault', 'azul', 1, 18, NULL, NULL, NULL),
(15, 'BNM789', 'Peugueot', 'negro', 1, 19, NULL, NULL, NULL),
(16, 'AJF456', 'VolksWaguen', 'blanco', 1, 14, NULL, NULL, NULL),
(17, 'GFA123', 'Renault', 'gris', 1, 16, NULL, NULL, NULL),
(18, 'JLY228', 'Ford', 'bordo', 1, 13, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `legajo` int(11) DEFAULT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `fechalogin` date DEFAULT NULL,
  `categoria` enum('cajero','admin') NOT NULL DEFAULT 'cajero',
  `suspendido` tinyint(1) DEFAULT '0',
  `activo` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `legajo`, `nombre`, `fechalogin`, `categoria`, `suspendido`, `activo`) VALUES
(1, 31757094, 'Franco Guerendiain', NULL, 'cajero', 0, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cocheras`
--
ALTER TABLE `cocheras`
  ADD KEY `id` (`id`);

--
-- Indices de la tabla `movimientos`
--
ALTER TABLE `movimientos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idusuario` (`idusuario`),
  ADD KEY `idcochera` (`idcochera`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cocheras`
--
ALTER TABLE `cocheras`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT de la tabla `movimientos`
--
ALTER TABLE `movimientos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;
--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `movimientos`
--
ALTER TABLE `movimientos`
  ADD CONSTRAINT `movimientos_ibfk_1` FOREIGN KEY (`idusuario`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `movimientos_ibfk_2` FOREIGN KEY (`idcochera`) REFERENCES `cocheras` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
