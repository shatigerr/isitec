-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:5001
-- Tiempo de generación: 02-02-2024 a las 09:46:09
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `isitec`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `iduser` int(11) NOT NULL,
  `mail` varchar(40) DEFAULT NULL,
  `username` varchar(16) DEFAULT NULL,
  `passHash` varchar(60) DEFAULT NULL,
  `userFirstName` varchar(60) DEFAULT NULL,
  `userLastName` varchar(120) DEFAULT NULL,
  `creationDate` datetime DEFAULT NULL,
  `removeDate` datetime DEFAULT NULL,
  `lastSignIn` datetime DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL,
  `activationDate` datetime DEFAULT NULL,
  `activationCode` char(64) DEFAULT NULL,
  `resetPassExpiry` datetime DEFAULT NULL,
  `resetPassCode` char(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`iduser`, `mail`, `username`, `passHash`, `userFirstName`, `userLastName`, `creationDate`, `removeDate`, `lastSignIn`, `active`, `activationDate`, `activationCode`, `resetPassExpiry`, `resetPassCode`) VALUES
(11, 'adria.martinezm@educem.net', 'adri', '$2y$10$gQifqqgK7ixgUYKG.LrlpevYpjZQXitUy.pw/40FWvQh9ox1uhSPS', '', '', '2024-02-02 09:44:18', NULL, NULL, 0, NULL, '55542a2d1e96a6c375edfe5e47826b665f86e7a19a6d7b778b19989361841570', NULL, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`iduser`),
  ADD UNIQUE KEY `mail` (`mail`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `iduser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
