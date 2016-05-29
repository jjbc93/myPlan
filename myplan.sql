-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 29-05-2016 a las 11:15:52
-- Versión del servidor: 5.6.17
-- Versión de PHP: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `myplan`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE IF NOT EXISTS `categoria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id`, `descripcion`) VALUES
(1, 'Espectáculos'),
(2, 'Deporte'),
(3, 'Cultural'),
(4, 'Restuarantes');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `eventos`
--

CREATE TABLE IF NOT EXISTS `eventos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `descripcion` varchar(50) NOT NULL,
  `horario` varchar(25) NOT NULL,
  `fecha` varchar(25) NOT NULL,
  `Organizadores` varchar(100) NOT NULL,
  `lugar` varchar(50) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `eventos`
--

INSERT INTO `eventos` (`id`, `nombre`, `descripcion`, `horario`, `fecha`, `Organizadores`, `lugar`, `direccion`) VALUES
(1, 'Estopa', 'Vuelven los hermanos Muñoz', '20:45 a 24:00', '28-05-2016', 'Estrella Levante', 'Murcia', 'Plaza de Toros'),
(2, 'ExpoManga', 'Salón del Manga', '10:00 a 16:00', '29-05-2016', 'Ifepa, Ankama', 'Auditorio Murcia', 'C/Victor Villegas'),
(3, 'Runner', 'Maraton', '9:00 a 11:00', '30-05-2016', 'Carrefour', 'Cartagena', 'La cortina'),
(4, 'Comilona', 'Feria Comida', '10:00 a 16:00', '31-05-2016', 'Comilona, Casa Paco, El pozo', 'Polideportivo Cartagena', 'C/Juan Fernandez');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `event_categoria`
--

CREATE TABLE IF NOT EXISTS `event_categoria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_evento` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_evento` (`id_evento`),
  KEY `id_categoria` (`id_categoria`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Volcado de datos para la tabla `event_categoria`
--

INSERT INTO `event_categoria` (`id`, `id_evento`, `id_categoria`) VALUES
(4, 1, 1),
(5, 1, 3),
(6, 2, 1),
(7, 2, 4),
(8, 2, 3),
(9, 3, 2),
(10, 4, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `event_usuario`
--

CREATE TABLE IF NOT EXISTS `event_usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) NOT NULL,
  `id_evento` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_usuario` (`id_usuario`),
  KEY `id_evento` (`id_evento`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Volcado de datos para la tabla `event_usuario`
--

INSERT INTO `event_usuario` (`id`, `id_usuario`, `id_evento`) VALUES
(1, 1, 1),
(4, 1, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nick` varchar(50) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellidos` varchar(50) NOT NULL,
  `correo` varchar(120) NOT NULL,
  `clave` varchar(50) NOT NULL,
  `rol` varchar(50) NOT NULL,
  `imagen` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nick`, `nombre`, `apellidos`, `correo`, `clave`, `rol`, `imagen`) VALUES
(1, 'jjbc', 'juanjo', 'br', 'juanjo@gmail.com', 'alumno', 'user', ''),
(2, 'admi', 'administrador', 'ABM', 'admin@gmail.com', 'adminAlumno', 'admin', '');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `event_categoria`
--
ALTER TABLE `event_categoria`
  ADD CONSTRAINT `event_categoria_ibfk_1` FOREIGN KEY (`id_evento`) REFERENCES `eventos` (`id`),
  ADD CONSTRAINT `event_categoria_ibfk_2` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id`);

--
-- Filtros para la tabla `event_usuario`
--
ALTER TABLE `event_usuario`
  ADD CONSTRAINT `event_usuario_ibfk_1` FOREIGN KEY (`id_evento`) REFERENCES `eventos` (`id`),
  ADD CONSTRAINT `event_usuario_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
