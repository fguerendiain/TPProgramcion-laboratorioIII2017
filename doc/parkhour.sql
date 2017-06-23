-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 23-06-2017 a las 14:31:22
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
-- Estructura de tabla para la tabla `parking`
--

CREATE TABLE IF NOT EXISTS `parking` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `place` int(11) NOT NULL,
  `vehicle` int(11) NOT NULL,
  `inuser` int(11) NOT NULL,
  `outuser` int(11) DEFAULT NULL,
  `intime` bigint(20) NOT NULL,
  `outtime` bigint(20) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `place` (`place`),
  KEY `vehicle` (`vehicle`),
  KEY `inuser` (`inuser`),
  KEY `outuser` (`outuser`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Volcado de datos para la tabla `parking`
--

INSERT INTO `parking` (`id`, `place`, `vehicle`, `inuser`, `outuser`, `intime`, `outtime`, `price`) VALUES
(10, 11, 22, 2, 2, 1498071971, 1498140192, 16000),
(11, 9, 9, 2, NULL, 1498072005, NULL, NULL),
(12, 9, 9, 2, 2, 1498072080, 1498139766, 16000),
(13, 9, 9, 2, NULL, 1498072081, NULL, NULL),
(14, 9, 9, 2, NULL, 1498072084, NULL, NULL),
(15, 10, 18, 2, NULL, 1498072169, NULL, NULL),
(16, 10, 19, 2, NULL, 1498076075, NULL, NULL),
(17, 11, 2, 2, NULL, 1498076132, NULL, NULL),
(18, 11, 20, 2, NULL, 1498076142, NULL, NULL),
(19, 11, 20, 2, NULL, 1498076179, NULL, NULL),
(20, 12, 2, 2, NULL, 1498076204, NULL, NULL),
(21, 15, 23, 2, 2, 1498077440, 1498077497, 57),
(22, 9, 9, 2, NULL, 1498222535, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `place`
--

CREATE TABLE IF NOT EXISTS `place` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  `floor` int(11) NOT NULL DEFAULT '1',
  `handicap` tinyint(1) NOT NULL DEFAULT '0',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Volcado de datos para la tabla `place`
--

INSERT INTO `place` (`id`, `name`, `floor`, `handicap`, `active`, `deleted`) VALUES
(1, '001', 1, 0, 1, 0),
(2, '002', 1, 0, 1, 0),
(3, '003', 1, 0, 1, 1),
(4, '004', 1, 0, 1, 0),
(5, '005', 1, 1, 0, 0),
(6, '006', 1, 0, 1, 0),
(7, '007', 1, 0, 1, 0),
(8, '008', 1, 0, 1, 0),
(9, '009', 1, 0, 1, 0),
(10, '010', 1, 0, 1, 0),
(11, '001', 2, 0, 1, 0),
(12, '002', 2, 0, 1, 0),
(13, '003', 2, 0, 1, 0),
(14, '004', 2, 0, 1, 0),
(15, '005', 2, 0, 1, 0),
(16, '120', 10, 0, 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `session`
--

CREATE TABLE IF NOT EXISTS `session` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` char(36) NOT NULL,
  `owner` int(11) NOT NULL,
  `intime` bigint(20) NOT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `owner` (`owner`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

--
-- Volcado de datos para la tabla `session`
--

INSERT INTO `session` (`id`, `token`, `owner`, `intime`, `deleted`) VALUES
(1, 'lkajsdhklajshasñjkhñ', 1, 1498059980, 0),
(2, 'lkajsdhklajshasñjkhñ', 1, 1498059993, 0),
(4, 'sdfsadfñ', 2, 1498060012, 0),
(5, 'sdfsadfñfg', 2, 1498229940, 0),
(6, 'sdfsadf', 2, 1498229948, 0),
(7, 'sdfsadfd', 2, 1498230129, 0),
(8, 'sdfsadfdasd', 1, 1498231349, 0),
(9, 'sdfsadfdasdg', 1, 1498231535, 0),
(12, 'ñjkdnasjdhoi3201u3e9ejhka', 7, 1498233564, 0),
(13, 'ñjkdnasjdhoi3201u3e9ejhkaw', 8, 1498233618, 0),
(15, 'token1', 9, 1498233673, 0),
(18, 'token2', 1, 1498233850, 0),
(23, 'token4', 1, 1498237548, 0),
(27, 'token7', 10, 1498238395, 0),
(28, 'token8', 11, 1498238412, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `googleid` varchar(256) NOT NULL,
  `email` varchar(128) NOT NULL,
  `displayname` varchar(256) NOT NULL,
  `avatar` varchar(256) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `admin` tinyint(1) NOT NULL DEFAULT '0',
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `googleid`, `email`, `displayname`, `avatar`, `active`, `admin`, `deleted`) VALUES
(1, 'otrocoso', 'root@gmail.com', 'Admin Root', '/src/userAvatar/adminroot2017.jpg', 1, 1, 0),
(2, 'saraza2', 'lala@gmail.com', 'Master Of Universe', '/src/userAvatar/masterofuniverse2017.jpg', 1, 1, 0),
(3, 'pandeayer', 'loco@mail.com', 'Ernesto Cuevas', 'dibujoloco.jpg', 0, 0, 0),
(7, 'pandeayer1', 'loco@mail.com1', 'Ernesto Cuevas', 'dibujoloco.jpg', 0, 0, 0),
(8, 'pandeayer1', 'loco@mail.com2', 'Ernesto Cuevas', 'dibujoloco.jpg', 0, 0, 0),
(9, 'usuario1', 'mail1', 'Ernesto Cuevas', 'dibujoloco.jpg', 0, 0, 0),
(10, 'usuario2', 'mail2', 'Ernesto Cuevas', 'dibujoloco.jpg', 0, 0, 0),
(11, 'usuario3', 'mail3', 'Ever Lopez', 'dibujoloco.jpg', 0, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vehicle`
--

CREATE TABLE IF NOT EXISTS `vehicle` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `license` varchar(16) NOT NULL,
  `alien` tinyint(1) NOT NULL DEFAULT '0',
  `colour` varchar(16) NOT NULL,
  `model` varchar(32) NOT NULL,
  `brand` varchar(32) NOT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

--
-- Volcado de datos para la tabla `vehicle`
--

INSERT INTO `vehicle` (`id`, `license`, `alien`, `colour`, `model`, `brand`, `deleted`) VALUES
(1, 'DPX769', 0, 'gris', 'Meganne', 'Renault', 0),
(2, 'JLY228', 0, 'azul', 'Ecosport', 'Ford', 0),
(3, 'BNQ769', 0, 'rojo', '19', 'Renault', 0),
(4, 'OYA284', 0, 'blanco', 'Ecosport', 'Ford', 0),
(5, 'RTX124', 0, 'verde', '147', 'Fiat', 0),
(6, 'DAJ220', 0, 'blanco', 'Duna', 'Fiat', 0),
(7, 'PAQ124', 0, 'amarillo', 'Fiesta', 'Ford', 0),
(8, 'LMT214', 0, 'negro', 'Bora', 'VolksWaguen', 0),
(9, 'KDO876', 0, 'negro', 'Agile', 'Chevrolet', 0),
(10, 'RCA456', 0, 'marron', 'Senda', 'VolksWaguen', 0),
(11, 'LTM456', 0, 'bordo', 'Sentra', 'Nisan', 0),
(14, 'PDO154', 0, 'gris', 'Gol Trend', 'VolksWaguen', 0),
(15, 'NDZ454', 0, 'blanco', 'QQ', 'Chery', 0),
(16, 'RPT164', 0, 'blanco', 'Neon', 'Chraisler', 0),
(17, 'CDZ975', 0, 'negro', 'Palio', 'Fiat', 0),
(18, 'KTX312', 0, 'blanco', 'Fox', 'VolksWaguen', 0),
(19, 'HQ9123', 0, 'azul', 'Corola', 'Toyota', 0),
(20, 'NTZ456', 0, 'verde', 'Uno', 'Fiat', 0),
(21, 'OPQ456', 0, 'naranja', 'Punto', 'Fiat', 0),
(22, 'ZTE456', 0, 'azul', 'Pasat', 'VolksWaguen', 0),
(23, 'NDT735', 0, 'negro', 'Ka', 'Ford', 0);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `parking`
--
ALTER TABLE `parking`
  ADD CONSTRAINT `parking_ibfk_1` FOREIGN KEY (`place`) REFERENCES `place` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `parking_ibfk_2` FOREIGN KEY (`vehicle`) REFERENCES `vehicle` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `parking_ibfk_3` FOREIGN KEY (`inuser`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `parking_ibfk_4` FOREIGN KEY (`outuser`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `session`
--
ALTER TABLE `session`
  ADD CONSTRAINT `session_ibfk_1` FOREIGN KEY (`owner`) REFERENCES `users` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
