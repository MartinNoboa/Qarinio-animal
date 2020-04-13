-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-04-2020 a las 00:40:43
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
-- Estructura de tabla para la tabla `donacion`
--

CREATE TABLE `donacion` (
  `numeroTransaccion` int(20) NOT NULL,
  `idDonacion` int(1) NOT NULL,
  `idUsuario` int(5) NOT NULL,
  `fechaDonacion` int(11) NOT NULL,
  `monto` float NOT NULL,
  `razon` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `maneja`
--

CREATE TABLE `maneja` (
  `idSucursal` int(1) NOT NULL,
  `idAdministrador` int(5) NOT NULL,
  `fechaAsignacion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perros`
--

CREATE TABLE `perros` (
  `idPerro` int(7) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `tamaino` varchar(20) NOT NULL,
  `edadEstimadaLlegada` int(2) DEFAULT NULL,
  `fechaLLegada` date NOT NULL,
  `sexo` varchar(10) NOT NULL,
  `historia` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `privilegios`
--

CREATE TABLE `privilegios` (
  `idPrivilegio` int(2) NOT NULL,
  `privilegio` varchar(30) NOT NULL,
  `descripcion` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `privilegio_rol`
--

CREATE TABLE `privilegio_rol` (
  `idPrivilegio` int(2) NOT NULL,
  `idRol` int(2) NOT NULL,
  `fechaCreacion` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `respuestas`
--

CREATE TABLE `respuestas` (
  `idRespuestas` int(7) NOT NULL,
  `noPregunta` int(2) NOT NULL,
  `respuesta` text NOT NULL,
  `fechaRespuesta` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `idRol` int(2) NOT NULL,
  `rol` varchar(30) NOT NULL,
  `descripcion` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitud`
--

CREATE TABLE `solicitud` (
  `idUsuario` int(5) NOT NULL,
  `idPerros` int(7) NOT NULL,
  `idRespuestas` int(7) NOT NULL,
  `fecha` datetime NOT NULL,
  `estadoFormulario` varchar(30) NOT NULL,
  `estadoEntrevista` varchar(30) NOT NULL,
  `estadoPago` varchar(30) NOT NULL,
  `fechaPago` datetime NOT NULL,
  `metodoPago` varchar(20) NOT NULL,
  `numTransaccion` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sucursal`
--

CREATE TABLE `sucursal` (
  `idSucursal` int(11) NOT NULL,
  `telefono` int(10) NOT NULL,
  `callePrincipal` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `calleSecundaria` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `numeroExterior` int(5) NOT NULL,
  `numeroInterior` int(4) NOT NULL,
  `codigoPostal` int(5) NOT NULL,
  `colonia` varchar(30) NOT NULL,
  `ciudad` varchar(30) NOT NULL,
  `estado` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_donacion`
--

CREATE TABLE `tipo_donacion` (
  `idDonacion` int(1) NOT NULL,
  `nombre` varchar(30) NOT NULL,
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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_rol`
--

CREATE TABLE `usuario_rol` (
  `idUsuario` int(5) NOT NULL,
  `idRol` int(2) NOT NULL,
  `fechaCreacion` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `donacion`
--
ALTER TABLE `donacion`
  ADD KEY `idDonacion_usuario` (`idDonacion`),
  ADD KEY `idUsuario_donacion` (`idUsuario`);

--
-- Indices de la tabla `maneja`
--
ALTER TABLE `maneja`
  ADD KEY `admin_sucursal` (`idAdministrador`),
  ADD KEY `sucursal_sucursal` (`idSucursal`);

--
-- Indices de la tabla `perros`
--
ALTER TABLE `perros`
  ADD PRIMARY KEY (`idPerro`),
  ADD KEY `idPerro` (`idPerro`);

--
-- Indices de la tabla `privilegios`
--
ALTER TABLE `privilegios`
  ADD PRIMARY KEY (`idPrivilegio`);

--
-- Indices de la tabla `privilegio_rol`
--
ALTER TABLE `privilegio_rol`
  ADD KEY `idPrivilegio` (`idPrivilegio`),
  ADD KEY `idRol` (`idRol`);

--
-- Indices de la tabla `respuestas`
--
ALTER TABLE `respuestas`
  ADD PRIMARY KEY (`idRespuestas`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`idRol`);

--
-- Indices de la tabla `solicitud`
--
ALTER TABLE `solicitud`
  ADD KEY `idUsuario` (`idUsuario`),
  ADD KEY `idPerros` (`idPerros`),
  ADD KEY `idRespuestas` (`idRespuestas`);

--
-- Indices de la tabla `sucursal`
--
ALTER TABLE `sucursal`
  ADD PRIMARY KEY (`idSucursal`);

--
-- Indices de la tabla `tipo_donacion`
--
ALTER TABLE `tipo_donacion`
  ADD PRIMARY KEY (`idDonacion`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idUsuario`);

--
-- Indices de la tabla `usuario_rol`
--
ALTER TABLE `usuario_rol`
  ADD KEY `idUsuario` (`idUsuario`),
  ADD KEY `idRol` (`idRol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `perros`
--
ALTER TABLE `perros`
  MODIFY `idPerro` int(7) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `privilegios`
--
ALTER TABLE `privilegios`
  MODIFY `idPrivilegio` int(2) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `respuestas`
--
ALTER TABLE `respuestas`
  MODIFY `idRespuestas` int(7) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `idRol` int(2) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `sucursal`
--
ALTER TABLE `sucursal`
  MODIFY `idSucursal` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tipo_donacion`
--
ALTER TABLE `tipo_donacion`
  MODIFY `idDonacion` int(1) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idUsuario` int(5) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `donacion`
--
ALTER TABLE `donacion`
  ADD CONSTRAINT `idDonacion_usuario` FOREIGN KEY (`idDonacion`) REFERENCES `tipo_donacion` (`idDonacion`),
  ADD CONSTRAINT `idUsuario_donacion` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`);

--
-- Filtros para la tabla `maneja`
--
ALTER TABLE `maneja`
  ADD CONSTRAINT `admin_sucursal` FOREIGN KEY (`idAdministrador`) REFERENCES `usuario` (`idUsuario`),
  ADD CONSTRAINT `sucursal_sucursal` FOREIGN KEY (`idSucursal`) REFERENCES `sucursal` (`idSucursal`);

--
-- Filtros para la tabla `privilegio_rol`
--
ALTER TABLE `privilegio_rol`
  ADD CONSTRAINT `idPrivilegio` FOREIGN KEY (`idPrivilegio`) REFERENCES `privilegios` (`idPrivilegio`),
  ADD CONSTRAINT `idRol` FOREIGN KEY (`idRol`) REFERENCES `rol` (`idRol`);

--
-- Filtros para la tabla `solicitud`
--
ALTER TABLE `solicitud`
  ADD CONSTRAINT `idPerros` FOREIGN KEY (`idPerros`) REFERENCES `perros` (`idPerro`),
  ADD CONSTRAINT `idRespuestas` FOREIGN KEY (`idRespuestas`) REFERENCES `respuestas` (`idRespuestas`),
  ADD CONSTRAINT `idUsuario` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`);

--
-- Filtros para la tabla `usuario_rol`
--
ALTER TABLE `usuario_rol`
  ADD CONSTRAINT `idRol_usuario` FOREIGN KEY (`idRol`) REFERENCES `rol` (`idRol`),
  ADD CONSTRAINT `idUsuario_rol` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
