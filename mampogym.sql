-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 01-03-2019 a las 09:36:53
-- Versión del servidor: 10.1.26-MariaDB
-- Versión de PHP: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `mampogym`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administrador`
--

CREATE TABLE `administrador` (
  `id` int(3) NOT NULL,
  `usuario` varchar(20) NOT NULL,
  `contrasenna` varchar(20) NOT NULL,
  `hash` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `administrador`
--

INSERT INTO `administrador` (`id`, `usuario`, `contrasenna`, `hash`) VALUES
(1, 'sandraxuxi', 'samantagolfo', '12345');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evento`
--

CREATE TABLE `evento` (
  `id` int(5) NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `lugar` varchar(30) NOT NULL,
  `fecha` varchar(11) NOT NULL,
  `precio` int(3) NOT NULL,
  `foto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `evento`
--

INSERT INTO `evento` (`id`, `nombre`, `lugar`, `fecha`, `precio`, `foto`) VALUES
(1, 'LA GRAN REVANCHA', 'Bec Bilbao', '29/02/2019', 30, 'img/eventos/cartel1.jpg'),
(13, 'LA GRAN REVANCHA', 'SAD', '29/02/2019', 0, 'img/eventos/_entrevista-joana-nany-k8ID-U502166501651sFF-624x385@El Correo.jpg'),
(16, 'AAAAA', 'Gasteiz', '29/02/2019', 0, 'img/eventos/_importante.png'),
(17, 'AAAAAAAAAAAAAAAAAAA', 'AAAAAAAAAAAAAAAAAAAAAAAAAAAA', '29/02/2019', 0, 'img/eventos/_importante.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `integrante`
--

CREATE TABLE `integrante` (
  `id` int(5) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `rango` varchar(20) NOT NULL,
  `premio` varchar(20) NOT NULL,
  `foto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `integrante`
--

INSERT INTO `integrante` (`id`, `nombre`, `rango`, `premio`, `foto`) VALUES
(1, 'KERMAN LEJARRAGA', 'PRO MAMPOGYM', 'CAMPEÓN IBF', 'img/equipo/integrante1.jpg'),
(4, 'KERMAN LEJARRAGA', 'PRO MAMPOGYM', 'CAMPEÓN IBF', 'img/equipo/integrante1.jpg'),
(6, 'JOANA', 'Fuerte', 'Alma', 'img/equipo/_entrevista-joana-nany-k8ID-U502166501651sFF-624x385@El Correo.jpg'),
(7, 'ffffffffffffffffffffffffffffff', 'fff', 'ff', 'img/equipo/_importante.png'),
(8, 'ffffffffffffffffffffffffffffff', 'fff', 'ff', 'img/equipo/_importante.png'),
(9, 'aaaaaaaaaaaaaaaaaaaaaaaaaaaa', 'aaaaaaa', 'XSDDDDDDDDDDDDD', 'img/equipo/_importante.png');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administrador`
--
ALTER TABLE `administrador`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `evento`
--
ALTER TABLE `evento`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `integrante`
--
ALTER TABLE `integrante`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `administrador`
--
ALTER TABLE `administrador`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `evento`
--
ALTER TABLE `evento`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `integrante`
--
ALTER TABLE `integrante`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
