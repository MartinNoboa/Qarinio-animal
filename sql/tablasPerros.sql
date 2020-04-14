-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-04-2020 a las 04:03:15
-- Versión del servidor: 10.4.11-MariaDB
-- Versión de PHP: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bd_qarinoanimal`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `caracteristicas`
--

CREATE TABLE `caracteristicas` (
  `idPerro` int(7) NOT NULL,
  `idCondicion` int(2) NOT NULL,
  `idPersonalidad` int(2) NOT NULL,
  `idRaza` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `condiciones_medicas`
--

CREATE TABLE `condiciones_medicas` (
  `idCondicion` int(4) NOT NULL,
  `condicion` varchar(30) NOT NULL,
  `descripcion` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_personalidad`
--

CREATE TABLE `tipo_personalidad` (
  `idPersonalidad` int(2) NOT NULL,
  `personalidad` varchar(30) NOT NULL,
  `descripcion` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_raza`
--

CREATE TABLE `tipo_raza` (
  `idRaza` int(3) NOT NULL,
  `raza` varchar(30) NOT NULL,
  `descripcion` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idUsuario` int(5) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `apellido` varchar(30) NOT NULL,
  `email` varchar(40) NOT NULL,
  `telefono` int(10) NOT NULL,
  `callePrincipal` varchar(50) NOT NULL,
  `calleSecundaria` varchar(50) DEFAULT NULL,
  `NumeroExterior` int(5) NOT NULL,
  `NumeroInterior` int(4) DEFAULT NULL,
  `CodigoPostal` int(5) NOT NULL,
  `Colonia` varchar(30) NOT NULL,
  `Ciudad` varchar(30) NOT NULL,
  `Estado` varchar(30) NOT NULL,
  `fechaNacimiento` date NOT NULL,
  `Contrasenia` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `caracteristicas`
--
ALTER TABLE `caracteristicas`
  ADD KEY `idPerro_perro` (`idPerro`),
  ADD KEY `condicion_perro` (`idCondicion`),
  ADD KEY `raza_perro` (`idRaza`),
  ADD KEY `personalidad_perro` (`idPersonalidad`);

--
-- Indices de la tabla `condiciones_medicas`
--
ALTER TABLE `condiciones_medicas`
  ADD PRIMARY KEY (`idCondicion`);

--
-- Indices de la tabla `tipo_personalidad`
--
ALTER TABLE `tipo_personalidad`
  ADD PRIMARY KEY (`idPersonalidad`);

--
-- Indices de la tabla `tipo_raza`
--
ALTER TABLE `tipo_raza`
  ADD PRIMARY KEY (`idRaza`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idUsuario`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `condiciones_medicas`
--
ALTER TABLE `condiciones_medicas`
  MODIFY `idCondicion` int(4) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tipo_personalidad`
--
ALTER TABLE `tipo_personalidad`
  MODIFY `idPersonalidad` int(2) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tipo_raza`
--
ALTER TABLE `tipo_raza`
  MODIFY `idRaza` int(3) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idUsuario` int(5) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `caracteristicas`
--
ALTER TABLE `caracteristicas`
  ADD CONSTRAINT `condicion_perro` FOREIGN KEY (`idCondicion`) REFERENCES `condiciones_medicas` (`idCondicion`),
  ADD CONSTRAINT `idPerro_perro` FOREIGN KEY (`idPerro`) REFERENCES `perros` (`idPerro`),
  ADD CONSTRAINT `personalidad_perro` FOREIGN KEY (`idPersonalidad`) REFERENCES `tipo_personalidad` (`idPersonalidad`),
  ADD CONSTRAINT `raza_perro` FOREIGN KEY (`idRaza`) REFERENCES `tipo_raza` (`idRaza`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
