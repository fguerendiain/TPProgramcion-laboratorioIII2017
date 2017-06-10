-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 10-06-2017 a las 17:56:35
-- Versión del servidor: 5.5.55-0ubuntu0.14.04.1
-- Versión de PHP: 5.5.9-1ubuntu4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `parkhour`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cocheras`
--

CREATE TABLE IF NOT EXISTS `cocheras` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `numero` int(11) DEFAULT NULL,
  `discapacitados` tinyint(1) DEFAULT NULL,
  `uso` int(11) DEFAULT '0',
  KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=31 ;

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

CREATE TABLE IF NOT EXISTS `movimientos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `patente` varchar(15) DEFAULT NULL,
  `marca` varchar(20) DEFAULT NULL,
  `color` varchar(30) CHARACTER SET utf8 COLLATE utf8_spanish2_ci DEFAULT NULL,
  `idusuario` int(11) DEFAULT NULL,
  `idcochera` int(11) DEFAULT NULL,
  `ingresofechahora` double DEFAULT NULL,
  `egresofechahora` double DEFAULT NULL,
  `total` float DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idusuario` (`idusuario`),
  KEY `idcochera` (`idcochera`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Volcado de datos para la tabla `movimientos`
--

INSERT INTO `movimientos` (`id`, `patente`, `marca`, `color`, `idusuario`, `idcochera`, `ingresofechahora`, `egresofechahora`, `total`) VALUES
(1, 'DPX769', 'Renault', 'rojo', 1, 7, 201706081604, NULL, NULL),
(2, 'BNQ723', 'Renault', 'verde', 1, 4, 201706081704, NULL, NULL),
(3, 'OYA833', 'Ford', 'azul', 1, 1, 201706082050, NULL, NULL),
(4, 'QWE325', 'Maclaren', 'amarillo', 1, 8, 201706082115, NULL, NULL),
(5, 'RTY291', 'Mazda', 'bordo', 1, 5, 201706090723, NULL, NULL),
(6, 'YUI821', 'Fiat', 'gris', 1, 2, 201706090812, NULL, NULL),
(7, 'SDF179', 'Ferrary', 'negro', 1, 9, 201706091132, NULL, NULL),
(8, 'FGH397', 'LandRover', 'blanco', 1, 6, 201706091640, NULL, NULL),
(9, 'GHJ369', 'RollsRoys', 'rojo', 1, 3, 201706091820, NULL, NULL),
(10, 'HJK258', 'Peugueot', 'gris', 1, 11, 201706091843, NULL, NULL),
(11, 'ZXC147', 'Citroen', 'gris', 1, 21, 201706092110, NULL, NULL),
(12, 'XCV741', 'Kia', 'negro', 1, 15, 201706100120, NULL, NULL),
(13, 'CVB852', 'Mazda', 'blanco', 1, 17, 201706100315, NULL, NULL),
(14, 'VBN963', 'Renault', 'blanco', 1, 18, 201706100815, NULL, NULL),
(15, 'BNM789', 'Peugueot', 'azul', 1, 19, 201706100930, NULL, NULL),
(16, 'AJF456', 'VolksWaguen', 'bordo', 1, 14, 201706100940, NULL, NULL),
(17, 'GFA123', 'Renault', 'gris', 1, 16, 201706101015, NULL, NULL),
(18, 'JLY228', 'Ford', 'rojo', 1, 13, 201706101140, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `legajo` int(11) DEFAULT NULL,
  `nombre` varchar(50) DEFAULT NULL,
  `fechalogin` date DEFAULT NULL,
  `categoria` enum('cajero','admin') NOT NULL DEFAULT 'cajero',
  `suspendido` tinyint(1) DEFAULT '0',
  `activo` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `legajo`, `nombre`, `fechalogin`, `categoria`, `suspendido`, `activo`) VALUES
(1, 31757094, 'Franco Guerendiain', NULL, 'cajero', 0, 1);

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
