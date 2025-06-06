-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 12, 2025 at 11:43 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `findme_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `backup_usuario`
--

CREATE TABLE `backup_usuario` (
  `Id_usuario` int(11) DEFAULT NULL,
  `nombre_usuario` varchar(100) DEFAULT NULL,
  `apellido_usuario` varchar(100) DEFAULT NULL,
  `estado_usuario` varchar(100) DEFAULT NULL,
  `user_usuario` varchar(100) DEFAULT NULL,
  `contraseña_usuario` varchar(225) DEFAULT NULL,
  `Id_rol` int(11) DEFAULT NULL,
  `accion` varchar(10) DEFAULT NULL,
  `fecha_evento` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `backup_usuario`
--

INSERT INTO `backup_usuario` (`Id_usuario`, `nombre_usuario`, `apellido_usuario`, `estado_usuario`, `user_usuario`, `contraseña_usuario`, `Id_rol`, `accion`, `fecha_evento`) VALUES
(21, 'Alex', 'Monroe', 'Activo', 'Monrie_22', '160823_', 1, 'INSERT', '2025-05-12 14:44:54'),
(21, 'Alex', 'Monroe', 'Inactivo', 'Monrie_22', '160823_', 1, 'DELETE', '2025-05-12 14:47:19'),
(21, 'Alex', 'Monroe', 'Inactivo', 'Monrie_22', '160823_', 1, 'UPDATE', '2025-05-12 14:47:19'),
(22, '', '', 'Activo', '', '', NULL, 'INSERT', '2025-05-12 16:39:29');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
