-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 12, 2025 at 11:41 PM
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

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `actualizar_mascota` (IN `p_Id_Mascota` INT, IN `p_Id_Publicacion` INT, IN `p_Id_Usuario` INT, IN `p_Nombre_Mascota` VARCHAR(100), IN `p_Fecha_Mascota` DATE, IN `p_Estado_Mascota` INT)   BEGIN
    UPDATE mascota
    SET Id_Publicacion = p_Id_Publicacion,
        Id_Usuario = p_Id_Usuario,
        Nombre_Mascota = p_Nombre_Mascota,
        Fecha_Mascota = p_Fecha_Mascota,
        Estado_Mascota = p_Estado_Mascota
    WHERE Id_Mascota = p_Id_Mascota;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `actualizar_publicacion` (IN `p_Id_Publicacion` INT, IN `p_Id_Usuario` INT, IN `p_NombreUser_Publicacion` VARCHAR(100), IN `p_Nombre_Publicacion` VARCHAR(100), IN `p_Fecha_Publicacion` DATE)   BEGIN
    UPDATE publicacion
    SET Id_Usuario = p_Id_Usuario,
        NombreUser_Publicacion = p_NombreUser_Publicacion,
        Nombre_Publicacion = p_Nombre_Publicacion,
        Fecha_Publicacion = p_Fecha_Publicacion
    WHERE Id_Publicacion = p_Id_Publicacion;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `actualizar_rol` (IN `p_Id_Rol` INT, IN `p_Nombre_Rol` VARCHAR(100), IN `p_Descripcion_Rol` VARCHAR(225))   BEGIN
    UPDATE rol
    SET Nombre_Rol = p_Nombre_Rol,
        Descripcion_Rol = p_Descripcion_Rol
    WHERE Id_Rol = p_Id_Rol;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `actualizar_usuario` (IN `p_Id_usuario` INT, IN `p_nombre_usuario` VARCHAR(100), IN `p_apellido_usuario` VARCHAR(100), IN `p_estado_usuario` VARCHAR(100), IN `p_user_usuario` VARCHAR(100), IN `p_contrasena_usuario` VARCHAR(225), IN `p_Id_Rol` INT)   BEGIN
    UPDATE usuario
    SET nombre_usuario = p_nombre_usuario,
        apellido_usuario = p_apellido_usuario,
        estado_usuario = p_estado_usuario,
        user_usuario = p_user_usuario,
        contraseña_usuario = p_contrasena_usuario,
        Id_Rol = p_Id_Rol
    WHERE Id_usuario = p_Id_usuario;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `eliminar_mascota` (IN `p_Id_Mascota` INT)   BEGIN
    DELETE FROM mascota WHERE Id_Mascota = p_Id_Mascota;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `eliminar_publicacion` (IN `p_Id_Publicacion` INT)   BEGIN
    DELETE FROM publicacion WHERE Id_Publicacion = p_Id_Publicacion;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `eliminar_rol` (IN `p_Id_Rol` INT)   BEGIN
    DELETE FROM rol WHERE Id_Rol = p_Id_Rol;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `eliminar_usuario` (IN `p_Id_usuario` INT)   BEGIN
    DELETE FROM usuario WHERE Id_usuario = p_Id_usuario;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertar_mascota` (IN `p_Id_Publicacion` INT, IN `p_Id_Usuario` INT, IN `p_Nombre_Mascota` VARCHAR(100), IN `p_Fecha_Mascota` DATE, IN `p_Estado_Mascota` INT)   BEGIN
    INSERT INTO mascota (
        Id_Publicacion, Id_Usuario, Nombre_Mascota, Fecha_Mascota, Estado_Mascota
    ) VALUES (
        p_Id_Publicacion, p_Id_Usuario, p_Nombre_Mascota, p_Fecha_Mascota, p_Estado_Mascota
    );
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertar_publicacion` (IN `p_Id_Usuario` INT, IN `p_NombreUser_Publicacion` VARCHAR(100), IN `p_Nombre_Publicacion` VARCHAR(100), IN `p_Fecha_Publicacion` DATE)   BEGIN
    INSERT INTO publicacion (
        Id_Usuario, NombreUser_Publicacion, Nombre_Publicacion, Fecha_Publicacion
    ) VALUES (
        p_Id_Usuario, p_NombreUser_Publicacion, p_Nombre_Publicacion, p_Fecha_Publicacion
    );
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertar_rol` (IN `p_Nombre_Rol` VARCHAR(100), IN `p_Descripcion_Rol` VARCHAR(225))   BEGIN
    INSERT INTO rol (Nombre_Rol, Descripcion_Rol)
    VALUES (p_Nombre_Rol, p_Descripcion_Rol);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `insertar_usuario` (IN `p_nombre_usuario` VARCHAR(100), IN `p_apellido_usuario` VARCHAR(100), IN `p_estado_usuario` VARCHAR(100), IN `p_user_usuario` VARCHAR(100), IN `p_contrasena_usuario` VARCHAR(225), IN `p_Id_Rol` INT)   BEGIN
    INSERT INTO usuario (
        nombre_usuario, apellido_usuario, estado_usuario,
        user_usuario, contraseña_usuario, Id_Rol
    ) VALUES (
        p_nombre_usuario, p_apellido_usuario, p_estado_usuario,
        p_user_usuario, p_contrasena_usuario, p_Id_Rol
    );
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Stand-in structure for view `administradores`
-- (See below for the actual view)
--
CREATE TABLE `administradores` (
`Id_usuario` int(11)
,`nombre_usuario` varchar(100)
,`user_usuario` varchar(100)
,`rol` varchar(100)
);

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

-- --------------------------------------------------------

--
-- Stand-in structure for view `dueño`
-- (See below for the actual view)
--
CREATE TABLE `dueño` (
`Id_usuario` int(11)
,`user_usuario` varchar(100)
,`nombre_usuario` varchar(100)
,`Id_Rol` int(11)
,`rol` varchar(100)
);

-- --------------------------------------------------------

--
-- Table structure for table `mascota`
--

CREATE TABLE `mascota` (
  `Id_Mascota` int(11) NOT NULL,
  `Id_Publicacion` int(11) NOT NULL,
  `Id_Usuario` int(11) NOT NULL,
  `Nombre_Mascota` varchar(100) NOT NULL,
  `Fecha_Mascota` date NOT NULL,
  `Estado_Mascota` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Stand-in structure for view `mascota_encontrada`
-- (See below for the actual view)
--
CREATE TABLE `mascota_encontrada` (
`Id_Mascota` int(11)
,`Nombre_Mascota` varchar(100)
,`usuario` int(11)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `mascota_perdida`
-- (See below for the actual view)
--
CREATE TABLE `mascota_perdida` (
`Id_Mascota` int(11)
,`Nombre_Mascota` varchar(100)
,`usuario` int(11)
);

-- --------------------------------------------------------

--
-- Table structure for table `publicacion`
--

CREATE TABLE `publicacion` (
  `Id_Publicacion` int(11) NOT NULL,
  `Id_Usuario` int(11) NOT NULL,
  `NombreUser_Publicacion` varchar(100) NOT NULL,
  `Nombre_Publicacion` varchar(100) NOT NULL,
  `Fecha_Publicacion` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rol`
--

CREATE TABLE `rol` (
  `Id_Rol` int(11) NOT NULL,
  `Nombre_Rol` varchar(100) NOT NULL,
  `Descripcion_Rol` varchar(225) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rol`
--

INSERT INTO `rol` (`Id_Rol`, `Nombre_Rol`, `Descripcion_Rol`) VALUES
(1, 'Administrador', ' El usuario administrador tendrá control total sobre la gestión de usuarios (registrar, consultar, modificar, inactivar) mientras que el cliente sólo podrá consultar y modificar sus propios datos, así como realizar el registr'),
(2, 'Buscador', 'El usuario buscador es aquel que se encargara de visualizar las publicaciones, buscar y dar pistas sobre las mascotas'),
(3, 'DueñoMascotaPerdida', 'El usuario dueño de mascota perdida see encargara de registrar su mascota en el sistema, y crear las publicaciones que seras visualizadas');

-- --------------------------------------------------------

--
-- Table structure for table `usuario`
--

CREATE TABLE `usuario` (
  `Id_usuario` int(11) NOT NULL,
  `nombre_usuario` varchar(100) NOT NULL,
  `apellido_usuario` varchar(100) NOT NULL,
  `estado_usuario` varchar(100) NOT NULL,
  `user_usuario` varchar(100) NOT NULL,
  `contraseña_usuario` varchar(225) NOT NULL,
  `Id_Rol` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `usuario`
--

INSERT INTO `usuario` (`Id_usuario`, `nombre_usuario`, `apellido_usuario`, `estado_usuario`, `user_usuario`, `contraseña_usuario`, `Id_Rol`) VALUES
(21, 'Alex', 'Monroe', 'Inactivo', 'Monrie_22', '160823_', 1),
(22, '', '', 'Activo', '', '', NULL);

--
-- Triggers `usuario`
--
DELIMITER $$
CREATE TRIGGER `trg_auditar_contrasena_usuario` AFTER UPDATE ON `usuario` FOR EACH ROW BEGIN
    IF OLD.contraseña_usuario != NEW.contraseña_usuario THEN
        INSERT INTO backup_usuario
        (Id_usuario, nombre_usuario, apellido_usuario, estado_usuario, user_usuario, contraseña_usuario, Id_Rol, accion, fecha_evento)
        VALUES
        (NEW.Id_usuario, NEW.nombre_usuario, NEW.apellido_usuario, NEW.estado_usuario, NEW.user_usuario, NEW.contraseña_usuario, NEW.Id_Rol, 'PASS_CHANGE', NOW());
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `trg_backup_usuario_delete` BEFORE UPDATE ON `usuario` FOR EACH ROW BEGIN
	INSERT INTO backup_usuario
    (`Id_usuario`,`nombre_usuario`,`apellido_usuario`,`estado_usuario`,`user_usuario`,`contraseña_usuario`,`Id_rol`,`accion`,`fecha_evento`)
    VALUES
    (NEW.Id_usuario,NEW.nombre_usuario,NEW.apellido_usuario,NEW.estado_usuario,NEW.user_usuario,NEW.contraseña_usuario,NEW.Id_rol, 'DELETE', NOW());
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `trg_backup_usuario_insert` AFTER INSERT ON `usuario` FOR EACH ROW BEGIN
	INSERT INTO backup_usuario
    (`Id_usuario`,`nombre_usuario`,`apellido_usuario`,`estado_usuario`,`user_usuario`,`contraseña_usuario`,`Id_rol`,`accion`,`fecha_evento`)
    VALUES
    (NEW.Id_usuario,NEW.nombre_usuario,NEW.apellido_usuario,NEW.estado_usuario,NEW.user_usuario,NEW.contraseña_usuario,NEW.Id_rol, 'INSERT', NOW());
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `trg_backup_usuario_update` AFTER UPDATE ON `usuario` FOR EACH ROW BEGIN
	INSERT INTO backup_usuario
    (`Id_usuario`,`nombre_usuario`,`apellido_usuario`,`estado_usuario`,`user_usuario`,`contraseña_usuario`,`Id_rol`,`accion`,`fecha_evento`)
    VALUES
    (NEW.Id_usuario,NEW.nombre_usuario,NEW.apellido_usuario,NEW.estado_usuario,NEW.user_usuario,NEW.contraseña_usuario,NEW.Id_rol, 'UPDATE', NOW());
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `trg_estado_usuario_default` BEFORE INSERT ON `usuario` FOR EACH ROW BEGIN
	IF NEW.estado_usuario IS NULL OR NEW.estado_usuario = '' THEN
    	SET NEW.estado_usuario = 'Activo';
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `trg_validar_usuario_unico` BEFORE INSERT ON `usuario` FOR EACH ROW BEGIN
	IF EXISTS (
        SELECT 1 FROM usuario WHERE user_usuario = NEW.user_usuario
    ) THEN
    	SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'El nombre de usuario ya existe';
	END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Structure for view `administradores`
--
DROP TABLE IF EXISTS `administradores`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `administradores`  AS SELECT `usuario`.`Id_usuario` AS `Id_usuario`, `usuario`.`nombre_usuario` AS `nombre_usuario`, `usuario`.`user_usuario` AS `user_usuario`, `rol`.`Nombre_Rol` AS `rol` FROM (`usuario` left join `rol` on(`usuario`.`Id_Rol` = `rol`.`Id_Rol`)) WHERE `usuario`.`Id_Rol` = 1 GROUP BY `usuario`.`Id_Rol` ;

-- --------------------------------------------------------

--
-- Structure for view `dueño`
--
DROP TABLE IF EXISTS `dueño`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `dueño`  AS SELECT `usuario`.`Id_usuario` AS `Id_usuario`, `usuario`.`user_usuario` AS `user_usuario`, `usuario`.`nombre_usuario` AS `nombre_usuario`, `usuario`.`Id_Rol` AS `Id_Rol`, `rol`.`Nombre_Rol` AS `rol` FROM (`usuario` left join `rol` on(`usuario`.`Id_Rol` = `rol`.`Id_Rol`)) WHERE `usuario`.`Id_Rol` = 3 GROUP BY `usuario`.`Id_Rol` ;

-- --------------------------------------------------------

--
-- Structure for view `mascota_encontrada`
--
DROP TABLE IF EXISTS `mascota_encontrada`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `mascota_encontrada`  AS SELECT `mascota`.`Id_Mascota` AS `Id_Mascota`, `mascota`.`Nombre_Mascota` AS `Nombre_Mascota`, `mascota`.`Estado_Mascota` AS `usuario` FROM (`mascota` left join `usuario` on(`mascota`.`Id_Usuario` = `usuario`.`Id_usuario`)) WHERE `mascota`.`Estado_Mascota` = 2 GROUP BY `mascota`.`Id_Usuario` ;

-- --------------------------------------------------------

--
-- Structure for view `mascota_perdida`
--
DROP TABLE IF EXISTS `mascota_perdida`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `mascota_perdida`  AS SELECT `mascota`.`Id_Mascota` AS `Id_Mascota`, `mascota`.`Nombre_Mascota` AS `Nombre_Mascota`, `mascota`.`Estado_Mascota` AS `usuario` FROM (`mascota` left join `usuario` on(`mascota`.`Id_Usuario` = `usuario`.`Id_usuario`)) WHERE `mascota`.`Estado_Mascota` = 1 GROUP BY `mascota`.`Id_Usuario` ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `mascota`
--
ALTER TABLE `mascota`
  ADD PRIMARY KEY (`Id_Mascota`),
  ADD KEY `fk_mascota_usuario` (`Id_Usuario`),
  ADD KEY `fk_mascota_publicacion` (`Id_Publicacion`);

--
-- Indexes for table `publicacion`
--
ALTER TABLE `publicacion`
  ADD PRIMARY KEY (`Id_Publicacion`),
  ADD KEY `fk_publicacion_usuario` (`Id_Usuario`);

--
-- Indexes for table `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`Id_Rol`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`Id_usuario`),
  ADD KEY `fk_usuario_rol` (`Id_Rol`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `Id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `mascota`
--
ALTER TABLE `mascota`
  ADD CONSTRAINT `fk_mascota_publicacion` FOREIGN KEY (`Id_Publicacion`) REFERENCES `publicacion` (`Id_Publicacion`),
  ADD CONSTRAINT `fk_mascota_usuario` FOREIGN KEY (`Id_Usuario`) REFERENCES `usuario` (`Id_usuario`);

--
-- Constraints for table `publicacion`
--
ALTER TABLE `publicacion`
  ADD CONSTRAINT `fk_publicacion_usuario` FOREIGN KEY (`Id_Usuario`) REFERENCES `usuario` (`Id_usuario`);

--
-- Constraints for table `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `fk_usuario_rol` FOREIGN KEY (`Id_Rol`) REFERENCES `rol` (`Id_Rol`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
