-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 20-12-2017 a las 02:02:08
-- Versión del servidor: 5.5.24-log
-- Versión de PHP: 5.4.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `prode`
--
CREATE DATABASE `prode` DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci;
USE `prode`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipo`
--

CREATE TABLE IF NOT EXISTS `equipo` (
  `eq_id` int(11) NOT NULL AUTO_INCREMENT,
  `eq_nombre` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `eq_bandera` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `eq_grupo` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`eq_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=33 ;

--
-- Volcado de datos para la tabla `equipo`
--

INSERT INTO `equipo` (`eq_id`, `eq_nombre`, `eq_bandera`, `eq_grupo`) VALUES
(1, 'Rusia', 'Images/Banderas/GrupoA/rusia2.jpg', 'A'),
(2, 'A. Saudita', 'Images/Banderas/GrupoA/arabia2.jpg', 'A'),
(3, 'Egipto', 'Images/Banderas/GrupoA/egipto2.jpg', 'A'),
(4, 'Uruguay', 'Images/Banderas/GrupoA/uruguay2.jpg', 'A'),
(5, 'Portugal', 'Images/Banderas/GrupoB/portugal2.jpg', 'B'),
(6, 'España', 'Images/Banderas/GrupoB/españa2.jpg', 'B'),
(7, 'Marruecos', 'Images/Banderas/GrupoB/marruecos2.jpg', 'B'),
(8, 'Irán', 'Images/Banderas/GrupoB/iran2.jpg', 'B'),
(9, 'Francia', 'Images/Banderas/GrupoC/francia2.jpg', 'C'),
(10, 'Australia', 'Images/Banderas/GrupoC/australia2.jpg', 'C'),
(11, 'Perú', 'Images/Banderas/GrupoC/peru2.jpg', 'C'),
(12, 'Dinamarca', 'Images/Banderas/GrupoC/dinamarca2.jpg', 'C'),
(13, 'Argentina', 'Images/Banderas/GrupoD/argentina2.jpg', 'D'),
(14, 'Islandia', 'Images/Banderas/GrupoD/islandia2.jpg', 'D'),
(15, 'Croacia', 'Images/Banderas/GrupoD/croacia2.jpg', 'D'),
(16, 'Nigeria', 'Images/Banderas/GrupoD/nigeria2.jpg', 'D'),
(17, 'Brasil', 'Images/Banderas/GrupoE/brasil.jpg', 'E'),
(18, 'Suiza', 'Images/Banderas/GrupoE/suiza.jpg', 'E'),
(19, 'Costa Rica', 'Images/Banderas/GrupoE/costarica.jpg', 'E'),
(20, 'Serbia', 'Images/Banderas/GrupoE/serbia.jpg', 'E'),
(21, 'Alemania', 'Images/Banderas/GrupoF/alemania.jpg', 'F'),
(22, 'México', 'Images/Banderas/GrupoF/mexico.jpg', 'F'),
(23, 'Suecia', 'Images/Banderas/GrupoF/suecia.jpg', 'F'),
(24, 'R. de Corea', 'Images/Banderas/GrupoF/corea.jpg', 'F'),
(25, 'Bélgica', 'Images/Banderas/GrupoG/belgica.jpg', 'G'),
(26, 'Panamá', 'Images/Banderas/GrupoG/panama.jpg', 'G'),
(27, 'Túnez', 'Images/Banderas/GrupoG/tunez.png', 'G'),
(28, 'Inglaterra', 'Images/Banderas/GrupoG/inglaterra.jpg', 'G'),
(29, 'Polonia', 'Images/Banderas/GrupoH/polonia.jpg', 'H'),
(30, 'Senegal', 'Images/Banderas/GrupoH/senegal.jpg', 'H'),
(31, 'Colombia', 'Images/Banderas/GrupoH/colombia.jpg', 'H'),
(32, 'Japón', 'Images/Banderas/GrupoH/japon.jpg', 'H');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `partidos`
--

CREATE TABLE IF NOT EXISTS `partidos` (
  `pa_dia` datetime NOT NULL,
  `pa_local` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `pa_visitante` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `pa_sede` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `pa_fecha` int(11) NOT NULL,
  `pa_grupo` varchar(1) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `partidos`
--

INSERT INTO `partidos` (`pa_dia`, `pa_local`, `pa_visitante`, `pa_sede`, `pa_fecha`, `pa_grupo`) VALUES
('2018-06-14 12:00:00', 'Rusia', 'A. Saudita', 'Moscú', 1, 'A'),
('2018-06-15 09:00:00', 'Egipto', 'Uruguay', 'Ekaterimburgo', 1, 'A'),
('2018-06-19 15:00:00', 'Rusia', 'Egipto', 'San Petesburgo', 2, 'A'),
('2018-06-20 12:00:00', 'Uruguay', 'A. Saudita', 'Rostov del Don', 2, 'A'),
('2018-06-25 11:00:00', 'Uruguay', 'Rusia', 'Samara', 3, 'A'),
('2018-06-25 11:00:00', 'A. Saudita', 'Egipto', 'Volgogrado', 3, 'A'),
('2018-06-15 12:00:00', 'Marruecos', 'Irán', 'San Petesburgo', 1, 'B'),
('2018-06-15 15:00:00', 'Portugal', 'España', 'Sochi', 1, 'B'),
('2018-06-20 09:00:00', 'Portugal', 'Marruecos', 'Moscú', 2, 'B'),
('2018-06-20 15:00:00', 'Irán', 'España', 'Kazán', 2, 'B'),
('2018-06-25 15:00:00', 'Irán', 'Portugal', 'Saransk', 3, 'B'),
('2018-06-25 15:00:00', 'España', 'Marruecos', 'Kaliningrado', 3, 'B'),
('2018-06-16 07:00:00', 'Francia', 'Australia', 'Kazán', 1, 'C'),
('2018-06-16 13:00:00', 'Perú', 'Dinamarca', 'Saransk', 1, 'C'),
('2018-06-21 09:00:00', 'Francia', 'Perú', 'Ekaterimburgo', 2, 'C'),
('2018-06-21 12:00:00', 'Dinamarca', 'Australia', 'Samara', 2, 'C'),
('2018-06-26 11:00:00', 'Dinamarca', 'Francia', 'Moscú', 3, 'C'),
('2018-06-26 11:00:00', 'Australia', 'Perú', 'Sochi', 3, 'C'),
('2018-06-16 10:00:00', 'Argentina', 'Islandia', 'Moscú', 1, 'D'),
('2018-06-16 16:00:00', 'Croacia', 'Nigeria', 'Kaliningrado', 1, 'D'),
('2018-06-21 15:00:00', 'Argentina', 'Croacia', 'Nizhni Nóvgorod', 2, 'D'),
('2018-06-22 12:00:00', 'Nigeria', 'Islandia', 'Volgogrado', 2, 'D'),
('2018-06-26 15:00:00', 'Nigeria', 'Argentina', 'San Petesburgo', 3, 'D'),
('2018-06-26 15:00:00', 'Islandia', 'Croacia', 'Rostov del Don', 3, 'D'),
('2018-06-17 09:00:00', 'Costa Rica', 'Serbia', 'Samara', 1, 'E'),
('2018-06-17 15:00:00', 'Brasil', 'Suiza', 'Rostov del Don', 1, 'E'),
('2018-06-22 09:00:00', 'Brasil', 'Costa Rica', 'San Petesburgo', 2, 'E'),
('2018-06-22 15:00:00', 'Serbia', 'Suiza', 'Kaliningrado', 2, 'E'),
('2018-06-27 15:00:00', 'Serbia', 'Brasil', 'Moscú', 3, 'E'),
('2018-06-27 15:00:00', 'Suiza', 'Costa Rica', 'Nizhni Nóvgorod', 3, 'E'),
('2018-06-17 12:00:00', 'Alemania', 'México', 'Moscú', 1, 'F'),
('2018-06-18 09:00:00', 'Suecia', 'R. de Corea', 'Nizhni Nóvgorod', 1, 'F'),
('2018-06-23 12:00:00', 'Alemania', 'Suecia', 'Sochi', 2, 'F'),
('2018-06-23 15:00:00', 'R. de Corea', 'México', 'Rostov del Don', 2, 'F'),
('2018-06-27 11:00:00', 'R. de Corea', 'Alemania', 'Kazán', 3, 'F'),
('2018-06-27 11:00:00', 'México', 'Suecia', 'Ekaterimburgo', 3, 'F'),
('2018-06-18 12:00:00', 'Bélgica', 'Panamá', 'Sochi', 1, 'G'),
('2018-06-18 15:00:00', 'Túnez', 'Inglaterra', 'Volgogrado', 1, 'G'),
('2018-06-23 09:00:00', 'Bélgica', 'Túnez', 'Moscú', 2, 'G'),
('2018-06-24 09:00:00', 'Inglaterra', 'Panamá', 'Nizhni Nóvgorod', 2, 'G'),
('2018-06-28 15:00:00', 'Inglaterra', 'Bélgica', 'Kaliningrado', 3, 'G'),
('2018-06-28 15:00:00', 'Panamá', 'Túnez', 'Saransk', 3, 'G'),
('2018-06-19 09:00:00', 'Polonia', 'Senegal', 'Moscú', 1, 'H'),
('2018-06-19 12:00:00', 'Colombia', 'Japón', 'Saransk', 1, 'H'),
('2018-06-24 12:00:00', 'Polonia', 'Colombia', 'Kazán', 2, 'H'),
('2018-06-24 15:00:00', 'Japón', 'Senegal', 'Ekaterimburgo', 2, 'H'),
('2018-06-28 11:00:00', 'Japón', 'Polonia', 'Volgogrado', 3, 'H'),
('2018-06-28 11:00:00', 'Senegal', 'Colombia', 'Samara', 3, 'H');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
