-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 01-10-2021 a las 05:22:31
-- Versión del servidor: 10.4.14-MariaDB
-- Versión de PHP: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `hospital`
--
CREATE DATABASE IF NOT EXISTS `hospital` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `hospital`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cama`
--

CREATE TABLE `cama` (
  `IdCama` int(11) NOT NULL,
  `Disponibilidad` bit(1) DEFAULT NULL,
  `Costo` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `doctor`
--

CREATE TABLE `doctor` (
  `IdDoctor` int(11) NOT NULL,
  `NomDoctor` varchar(50) DEFAULT NULL,
  `ApellDoctor` varchar(50) DEFAULT NULL,
  `IdEspecialidad` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `especialidad`
--

CREATE TABLE `especialidad` (
  `IdEspecialidad` int(11) NOT NULL,
  `Nombre` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paciente`
--

CREATE TABLE `paciente` (
  `IdPaciente` int(11) NOT NULL,
  `NomPaciente` varchar(50) DEFAULT NULL,
  `ApellPaciente` varchar(50) DEFAULT NULL,
  `IdSeguro` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfil`
--

CREATE TABLE `perfil` (
  `IdPerfil` int(11) NOT NULL,
  `Nombre` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registro`
--

CREATE TABLE `registro` (
  `IdRegistro` int(11) NOT NULL,
  `IdPaciente` int(11) DEFAULT NULL,
  `IdDoctor` int(11) DEFAULT NULL,
  `IdCama` int(11) DEFAULT NULL,
  `FechaIngreso` date DEFAULT NULL,
  `FechaSalida` date DEFAULT NULL,
  `Costo` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `seguro`
--

CREATE TABLE `seguro` (
  `IdSeguro` int(11) NOT NULL,
  `Nombre` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `telefonodoctor`
--

CREATE TABLE `telefonodoctor` (
  `IdDoctor` int(11) NOT NULL,
  `Telefono` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `telefonopaciente`
--

CREATE TABLE `telefonopaciente` (
  `IdPaciente` int(11) NOT NULL,
  `Telefono` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tratamiento`
--

CREATE TABLE `tratamiento` (
  `IdTratamiento` int(11) NOT NULL,
  `Nombre` varchar(50) DEFAULT NULL,
  `Costo` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tratamientodoctor`
--

CREATE TABLE `tratamientodoctor` (
  `IdTratamiento` int(11) NOT NULL,
  `IdDoctor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tratamientoregistro`
--

CREATE TABLE `tratamientoregistro` (
  `IdTratamiento` int(11) NOT NULL,
  `IdRegistro` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `IdUsuario` int(11) NOT NULL,
  `NomUsuario` varchar(30) DEFAULT NULL,
  `Correo` varchar(50) DEFAULT NULL,
  `Contra` varchar(350) DEFAULT NULL,
  `IdPerfil` int(11) DEFAULT NULL,
  `Token` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cama`
--
ALTER TABLE `cama`
  ADD PRIMARY KEY (`IdCama`);

--
-- Indices de la tabla `doctor`
--
ALTER TABLE `doctor`
  ADD PRIMARY KEY (`IdDoctor`),
  ADD KEY `IdEspecialidad` (`IdEspecialidad`);

--
-- Indices de la tabla `especialidad`
--
ALTER TABLE `especialidad`
  ADD PRIMARY KEY (`IdEspecialidad`);

--
-- Indices de la tabla `paciente`
--
ALTER TABLE `paciente`
  ADD PRIMARY KEY (`IdPaciente`),
  ADD KEY `IdSeguro` (`IdSeguro`);

--
-- Indices de la tabla `perfil`
--
ALTER TABLE `perfil`
  ADD PRIMARY KEY (`IdPerfil`);

--
-- Indices de la tabla `registro`
--
ALTER TABLE `registro`
  ADD PRIMARY KEY (`IdRegistro`),
  ADD KEY `IdPaciente` (`IdPaciente`),
  ADD KEY `IdDoctor` (`IdDoctor`),
  ADD KEY `IdCama` (`IdCama`);

--
-- Indices de la tabla `seguro`
--
ALTER TABLE `seguro`
  ADD PRIMARY KEY (`IdSeguro`);

--
-- Indices de la tabla `telefonodoctor`
--
ALTER TABLE `telefonodoctor`
  ADD PRIMARY KEY (`IdDoctor`,`Telefono`);

--
-- Indices de la tabla `telefonopaciente`
--
ALTER TABLE `telefonopaciente`
  ADD PRIMARY KEY (`IdPaciente`,`Telefono`);

--
-- Indices de la tabla `tratamiento`
--
ALTER TABLE `tratamiento`
  ADD PRIMARY KEY (`IdTratamiento`);

--
-- Indices de la tabla `tratamientodoctor`
--
ALTER TABLE `tratamientodoctor`
  ADD PRIMARY KEY (`IdTratamiento`,`IdDoctor`),
  ADD KEY `IdDoctor` (`IdDoctor`);

--
-- Indices de la tabla `tratamientoregistro`
--
ALTER TABLE `tratamientoregistro`
  ADD PRIMARY KEY (`IdTratamiento`,`IdRegistro`),
  ADD KEY `IdRegistro` (`IdRegistro`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`IdUsuario`),
  ADD KEY `IdPerfil` (`IdPerfil`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cama`
--
ALTER TABLE `cama`
  MODIFY `IdCama` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `doctor`
--
ALTER TABLE `doctor`
  MODIFY `IdDoctor` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `especialidad`
--
ALTER TABLE `especialidad`
  MODIFY `IdEspecialidad` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `paciente`
--
ALTER TABLE `paciente`
  MODIFY `IdPaciente` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `perfil`
--
ALTER TABLE `perfil`
  MODIFY `IdPerfil` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `registro`
--
ALTER TABLE `registro`
  MODIFY `IdRegistro` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `seguro`
--
ALTER TABLE `seguro`
  MODIFY `IdSeguro` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tratamiento`
--
ALTER TABLE `tratamiento`
  MODIFY `IdTratamiento` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `IdUsuario` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `doctor`
--
ALTER TABLE `doctor`
  ADD CONSTRAINT `doctor_ibfk_1` FOREIGN KEY (`IdEspecialidad`) REFERENCES `especialidad` (`IdEspecialidad`);

--
-- Filtros para la tabla `paciente`
--
ALTER TABLE `paciente`
  ADD CONSTRAINT `paciente_ibfk_1` FOREIGN KEY (`IdSeguro`) REFERENCES `seguro` (`IdSeguro`);

--
-- Filtros para la tabla `registro`
--
ALTER TABLE `registro`
  ADD CONSTRAINT `registro_ibfk_1` FOREIGN KEY (`IdPaciente`) REFERENCES `paciente` (`IdPaciente`),
  ADD CONSTRAINT `registro_ibfk_2` FOREIGN KEY (`IdDoctor`) REFERENCES `doctor` (`IdDoctor`),
  ADD CONSTRAINT `registro_ibfk_3` FOREIGN KEY (`IdCama`) REFERENCES `cama` (`IdCama`);

--
-- Filtros para la tabla `telefonodoctor`
--
ALTER TABLE `telefonodoctor`
  ADD CONSTRAINT `telefonodoctor_ibfk_1` FOREIGN KEY (`IdDoctor`) REFERENCES `doctor` (`IdDoctor`);

--
-- Filtros para la tabla `telefonopaciente`
--
ALTER TABLE `telefonopaciente`
  ADD CONSTRAINT `telefonopaciente_ibfk_1` FOREIGN KEY (`IdPaciente`) REFERENCES `paciente` (`IdPaciente`);

--
-- Filtros para la tabla `tratamientodoctor`
--
ALTER TABLE `tratamientodoctor`
  ADD CONSTRAINT `tratamientodoctor_ibfk_1` FOREIGN KEY (`IdTratamiento`) REFERENCES `tratamiento` (`IdTratamiento`),
  ADD CONSTRAINT `tratamientodoctor_ibfk_2` FOREIGN KEY (`IdDoctor`) REFERENCES `doctor` (`IdDoctor`);

--
-- Filtros para la tabla `tratamientoregistro`
--
ALTER TABLE `tratamientoregistro`
  ADD CONSTRAINT `tratamientoregistro_ibfk_1` FOREIGN KEY (`IdTratamiento`) REFERENCES `tratamiento` (`IdTratamiento`),
  ADD CONSTRAINT `tratamientoregistro_ibfk_2` FOREIGN KEY (`IdRegistro`) REFERENCES `registro` (`IdRegistro`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`IdPerfil`) REFERENCES `perfil` (`IdPerfil`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

INSERT INTO `doctor`(`NomDoctor`, `ApellDoctor`, `IdEspecialidad`) VALUES ('Juan','Díaz',1);
INSERT INTO `doctor`(`NomDoctor`, `ApellDoctor`, `IdEspecialidad`) VALUES ('Felipe','Torres',1);
INSERT INTO `doctor`(`NomDoctor`, `ApellDoctor`, `IdEspecialidad`) VALUES ('Enrique','Calderon',1);
INSERT INTO `doctor`(`NomDoctor`, `ApellDoctor`, `IdEspecialidad`) VALUES ('Laura','Fernandez',1);
INSERT INTO `doctor`(`NomDoctor`, `ApellDoctor`, `IdEspecialidad`) VALUES ('Luisa','Castellanos',1);
INSERT INTO `doctor`(`NomDoctor`, `ApellDoctor`, `IdEspecialidad`) VALUES ('Ofelio','Restrepo',1);
INSERT INTO `doctor`(`NomDoctor`, `ApellDoctor`, `IdEspecialidad`) VALUES ('Miller','Cardenales',1);
INSERT INTO `doctor`(`NomDoctor`, `ApellDoctor`, `IdEspecialidad`) VALUES ('Esteban','Contreras',1);
