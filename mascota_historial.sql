-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 13-05-2025 a las 20:30:52
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `findme_db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mascota_historial`
--

CREATE TABLE `mascota_historial` (
  `Id_Historial` int(11) NOT NULL,
  `Id_Mascota` int(11) DEFAULT NULL,
  `Id_Publicacion` int(11) DEFAULT NULL,
  `Id_Usuario` int(11) DEFAULT NULL,
  `Nombre_Mascota` varchar(255) DEFAULT NULL,
  `Fecha_Mascota` date DEFAULT NULL,
  `Estado_Mascota` int(11) DEFAULT NULL,
  `Fecha_Creacion` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `mascota_historial`
--

INSERT INTO `mascota_historial` (`Id_Historial`, `Id_Mascota`, `Id_Publicacion`, `Id_Usuario`, `Nombre_Mascota`, `Fecha_Mascota`, `Estado_Mascota`, `Fecha_Creacion`) VALUES
(1, 1, 1, 1, 'jullian', '0000-00-00', 0, '2025-05-12 21:31:49'),
(2, 1, 1, 1, 'Max', '2024-05-10', 1, '2025-05-12 21:35:46'),
(3, 1, 1, 1, 'Bella', '2024-06-15', 2, '2025-05-12 21:36:18'),
(4, 1, 1, 1, 'Luna', '2025-01-20', 2, '2025-05-12 21:39:13'),
(6, 1, 1, 1, 'Toby', '2025-03-05', 1, '2025-05-12 21:41:31');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `mascota_historial`
--
ALTER TABLE `mascota_historial`
  ADD PRIMARY KEY (`Id_Historial`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `mascota_historial`
--
ALTER TABLE `mascota_historial`
  MODIFY `Id_Historial` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
