-- phpMyAdmin SQL Dump
-- version 3.5.8.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-03-2017 a las 22:19:45
-- Versión del servidor: 5.6.11-log
-- Versión de PHP: 5.4.14

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `c0300434_albumes`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `albumes`
--

CREATE TABLE IF NOT EXISTS `albumes` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(15) NOT NULL,
  `activo` int(1) NOT NULL,
  `idPortada` int(5) NOT NULL,
  `tipo` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `blog`
--

CREATE TABLE IF NOT EXISTS `blog` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(100) NOT NULL,
  `texto` text NOT NULL,
  `path` text,
  `fecha` date NOT NULL,
  `activo` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fotos`
--

CREATE TABLE IF NOT EXISTS `fotos` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `idAlbum` int(4) NOT NULL,
  `orden` int(2) NOT NULL,
  `titulo` varchar(15) NOT NULL,
  `bajada` text NOT NULL,
  `path` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `slider`
--

CREATE TABLE IF NOT EXISTS `slider` (
  `idFoto` int(2) NOT NULL,
  `orden` int(2) NOT NULL,
  PRIMARY KEY (`idFoto`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipos`
--

CREATE TABLE IF NOT EXISTS `tipos` (
  `id` int(1) NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipos`
--

INSERT INTO `tipos` (`id`, `descripcion`) VALUES
(1, 'Tipo Mosaico'),
(2, 'Tipo Pinterest'),
(3, 'Imagenes al 100% continuas'),
(4, 'Slide');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `username`, `password`, `nombre`, `email`) VALUES
(1, 'admin', '123456', 'Administrador', 'tanomartin05@gmail.com');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
