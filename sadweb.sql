-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-01-2019 a las 17:59:22
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
-- Base de datos: `sadweb`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `archive`
--

CREATE TABLE `archive` (
  `id` int(11) NOT NULL,
  `url` varchar(99) NOT NULL,
  `idPost` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `commentary`
--

CREATE TABLE `commentary` (
  `id` int(11) NOT NULL,
  `raw_data` varchar(255) NOT NULL,
  `dateA` varchar(20) NOT NULL,
  `id_profile` int(11) NOT NULL,
  `id_commentary` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `favourite`
--

CREATE TABLE `favourite` (
  `id_profile` int(11) NOT NULL,
  `id_post` int(11) DEFAULT NULL,
  `type` varchar(1) NOT NULL,
  `id_commentary` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `follow`
--

CREATE TABLE `follow` (
  `idFollower` int(11) DEFAULT NULL,
  `idFollowed` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `follow`
--

INSERT INTO `follow` (`idFollower`, `idFollowed`) VALUES
(4, 5),
(11, 2),
(2, 8),
(13, 2),
(18, 2),
(2, 7),
(2, 17),
(2, 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `post`
--

CREATE TABLE `post` (
  `id` int(11) NOT NULL,
  `title` varchar(30) NOT NULL,
  `rawData` varchar(500) NOT NULL,
  `datePost` varchar(20) NOT NULL,
  `idProfile` int(11) NOT NULL,
  `idCategory` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profile`
--

CREATE TABLE `profile` (
  `id` int(11) NOT NULL,
  `photo` varchar(30) NOT NULL,
  `nickname` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `profile`
--

INSERT INTO `profile` (`id`, `photo`, `nickname`, `password`) VALUES
(2, 'img/userImgs/admin.jpeg', 'admin', 'admin'),
(3, 'img/userImgs/user.png', 'user', 'user'),
(4, '', 'admino', 'admino'),
(5, '', 'ey', 'ey'),
(6, 'img/userImgs/user2.png', 'user2', 'user'),
(7, 'test', 'prueba', 'prueba'),
(8, 'test', 'alexsandro', 'alexsandro'),
(9, 'test', 'eyyyyy', 'ey'),
(10, 'test', 'mamawebo', 'gsgs'),
(11, 'test', 'klk', 'klk'),
(12, 'test', 'alexxx', 'alexxx'),
(13, 'test', 'eskere', 'eskere'),
(15, 'test', 'afasf', 'fsds'),
(17, 'test', 'asda', 'adsdds'),
(18, 'test', 'vista', 'vista'),
(19, 'test', 'aburro', 'aburro');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `archive`
--
ALTER TABLE `archive`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_archive_question` (`idPost`);

--
-- Indices de la tabla `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `commentary`
--
ALTER TABLE `commentary`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_answer_profile` (`id_profile`),
  ADD KEY `fk_answer_question` (`id_commentary`);

--
-- Indices de la tabla `favourite`
--
ALTER TABLE `favourite`
  ADD KEY `fk_profile_favourite` (`id_profile`),
  ADD KEY `fk_question_favourite` (`id_post`),
  ADD KEY `fk_answer_favourite` (`id_commentary`);

--
-- Indices de la tabla `follow`
--
ALTER TABLE `follow`
  ADD KEY `fk_pro_follower` (`idFollower`),
  ADD KEY `fk_pro_followed` (`idFollowed`);

--
-- Indices de la tabla `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_profile_question` (`idProfile`),
  ADD KEY `fk_category_question` (`idCategory`);

--
-- Indices de la tabla `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `archive`
--
ALTER TABLE `archive`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `commentary`
--
ALTER TABLE `commentary`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `post`
--
ALTER TABLE `post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `profile`
--
ALTER TABLE `profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `archive`
--
ALTER TABLE `archive`
  ADD CONSTRAINT `fk_archive_question` FOREIGN KEY (`idPost`) REFERENCES `post` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `commentary`
--
ALTER TABLE `commentary`
  ADD CONSTRAINT `fk_answer_profile` FOREIGN KEY (`id_profile`) REFERENCES `profile` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_answer_question` FOREIGN KEY (`id_commentary`) REFERENCES `post` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `favourite`
--
ALTER TABLE `favourite`
  ADD CONSTRAINT `fk_answer_favourite` FOREIGN KEY (`id_commentary`) REFERENCES `commentary` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_profile_favourite` FOREIGN KEY (`id_profile`) REFERENCES `profile` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_question_favourite` FOREIGN KEY (`id_post`) REFERENCES `post` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `follow`
--
ALTER TABLE `follow`
  ADD CONSTRAINT `fk_pro_followed` FOREIGN KEY (`idFollowed`) REFERENCES `profile` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_pro_follower` FOREIGN KEY (`idFollower`) REFERENCES `profile` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `fk_category_question` FOREIGN KEY (`idCategory`) REFERENCES `category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_profile_question` FOREIGN KEY (`idProfile`) REFERENCES `profile` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
