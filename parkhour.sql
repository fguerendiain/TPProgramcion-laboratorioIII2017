-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 05-06-2017 a las 16:41:05
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
  `idusuario` int(11) DEFAULT NULL,
  `idcochera` int(11) DEFAULT NULL,
  `ingresofechahora` date DEFAULT NULL,
  `egresofechahora` date DEFAULT NULL,
  `total` float DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idusuario` (`idusuario`),
  KEY `idcochera` (`idcochera`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=56 ;

--
-- Volcado de datos para la tabla `movimientos`
--

INSERT INTO `movimientos` (`id`, `patente`, `marca`, `idusuario`, `idcochera`, `ingresofechahora`, `egresofechahora`, `total`) VALUES
(38, 'DPX769', 'Renault', 1, 7, NULL, NULL, NULL),
(39, 'BNQ723', 'Renault', 1, 4, NULL, NULL, NULL),
(40, 'OYA833', 'Ford', 1, 1, NULL, NULL, NULL),
(41, 'QWE325', 'Maclaren', 1, 8, NULL, NULL, NULL),
(42, 'RTY291', 'Mazda', 1, 5, NULL, NULL, NULL),
(43, 'YUI821', 'Fiat', 1, 2, NULL, NULL, NULL),
(44, 'SDF179', 'Ferrary', 1, 9, NULL, NULL, NULL),
(45, 'FGH397', 'LandRover', 1, 6, NULL, NULL, NULL),
(46, 'GHJ369', 'RollsRoys', 1, 3, NULL, NULL, NULL),
(47, 'HJK258', 'Peugueot', 1, 11, NULL, NULL, NULL),
(48, 'ZXC147', 'Citroen', 1, 21, NULL, NULL, NULL),
(49, 'XCV741', 'Kia', 1, 15, NULL, NULL, NULL),
(50, 'CVB852', 'Mazda', 1, 17, NULL, NULL, NULL),
(51, 'VBN963', 'Renault', 1, 18, NULL, NULL, NULL),
(52, 'BNM789', 'Peugueot', 1, 19, NULL, NULL, NULL),
(53, 'AJF456', 'VolksWaguen', 1, 14, NULL, NULL, NULL),
(54, 'GFA123', 'Renault', 1, 16, NULL, NULL, NULL),
(55, 'JLY228', 'Ford', 1, 13, NULL, NULL, NULL);

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
