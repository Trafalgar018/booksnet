-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 19-12-2017 a las 19:08:48
-- Versión del servidor: 10.1.28-MariaDB
-- Versión de PHP: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `booksnet`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `book`
--

CREATE TABLE `book` (
  `id` int(11) NOT NULL,
  `title` tinytext NOT NULL,
  `author` tinytext NOT NULL,
  `genre` tinytext NOT NULL,
  `publication` tinytext NOT NULL,
  `image` tinytext NOT NULL,
  `description` tinytext NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `book`
--

INSERT INTO `book` (`id`, `title`, `author`, `genre`, `publication`, `image`, `description`, `created_at`, `updated_at`) VALUES
(1, 'gdfgfdg', 'dfgdfg', 'dfgdfg', '2017-12-21', 'dfgdfg', 'dfgfdgdfg', '2017-12-15 18:57:13', '2017-12-15 18:57:13');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `invitacion`
--

CREATE TABLE `invitacion` (
  `id` int(11) NOT NULL,
  `email` tinytext NOT NULL,
  `used` int(11) NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `invitacion`
--

INSERT INTO `invitacion` (`id`, `email`, `used`, `created_at`, `updated_at`) VALUES
(1, 'sdkgjbsdg@gmail.com', 0, 2017, 2017),
(2, 'manolito@gmail.com', 0, 2017, 2017),
(3, '', 0, 2017, 2017),
(4, 'wwwww@gamail.com', 0, 2017, 2017),
(5, 'jdsfbosdgjnosgnosbn@gmail.com', 0, 2017, 2017);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `password`, `created_at`, `updated_at`) VALUES
(8, 'thinway', 'thinway@ymail.com', '$2y$10$ftG6n.AecTx55kb41WPNcOwzLI4TDpZccPFD8TlQ2dO.ist/DN9gm', '2017-12-05 22:06:44', '2017-12-05 22:06:44'),
(0, 'gdsfgsdfg', 'wwww@gmail.com', '$2y$10$OvcN2IjzzJNHreQY4HA7uOnGko.T.jmyOpt/D1r5U7QONVzewoZP.', '2017-12-15 19:44:04', '2017-12-15 19:44:04'),
(0, 'pepito', 'pepito@gmail.com', '$2y$10$yGPVuYmrXOfkdO2aEwnfWe2sxDuaExezlzb0PkaGIobwQLjiPXvNq', '2017-12-15 22:46:13', '2017-12-15 22:46:13'),
(0, 'joselito', 'pepe@gmail.com', '$2y$10$DcjS3Vq.3UNJ0zRFqU.eSONrJPwo6CLHKrRDQlziI1m.CYwL5pAUW', '2017-12-15 22:52:02', '2017-12-15 22:52:02');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `invitacion`
--
ALTER TABLE `invitacion`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `book`
--
ALTER TABLE `book`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `invitacion`
--
ALTER TABLE `invitacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
