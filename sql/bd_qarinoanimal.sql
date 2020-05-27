-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-05-2020 a las 19:43:38
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

DELIMITER $$
--
-- Procedimientos
--
CREATE PROCEDURE `crearFormulario` (IN `v_idSolicitud` INT(7), IN `res1` TEXT CHARSET utf8, IN `res2` TEXT CHARSET utf8, IN `res3` TEXT CHARSET utf8, IN `res4` TEXT CHARSET utf8, IN `res5` TEXT CHARSET utf8, IN `res6` TEXT CHARSET utf8, IN `res7` TEXT CHARSET utf8, IN `res8` TEXT CHARSET utf8, IN `res9` TEXT CHARSET utf8, IN `res10` TEXT CHARSET utf8, IN `res11` TEXT CHARSET utf8, IN `res12` TEXT CHARSET utf8)  NO SQL
INSERT INTO respuestas (idSolicitud, idPregunta, respuesta)
VALUES (v_idSolicitud,1,res1),(v_idSolicitud,2,res2),(v_idSolicitud,3,res3),(v_idSolicitud,4,res4),(v_idSolicitud,5,res5),(v_idSolicitud,6,res6),(v_idSolicitud,7,res7),(v_idSolicitud,8,res8),(v_idSolicitud,9,res9),(v_idSolicitud,10,res10),(v_idSolicitud,11,res11),(v_idSolicitud,12,res12)$$

CREATE PROCEDURE `crearNuevaSolicitud` (IN `p_us` INT, IN `p_perro` INT, IN `r1` TEXT CHARSET utf8, IN `r2` TEXT CHARSET utf8, IN `r3` TEXT CHARSET utf8, IN `r4` TEXT CHARSET utf8, IN `r5` TEXT CHARSET utf8, IN `r6` TEXT CHARSET utf8, IN `r7` TEXT CHARSET utf8, IN `r8` TEXT CHARSET utf8, IN `r9` TEXT CHARSET utf8, IN `r10` TEXT CHARSET utf8, IN `r11` TEXT CHARSET utf8, IN `r12` TEXT CHARSET utf8)  NO SQL
BEGIN
INSERT INTO solicitud (idUsuario, idPerro, estadoFormulario, estadoEntrevista, estadoPago)
VALUES (p_us, p_perro, 3,3,3);
INSERT INTO respuestas (idSolicitud, idPregunta, respuesta)
VALUES 
((SELECT idSolicitud from solicitud ORDER BY idSolicitud DESC LIMIT 1),1,r1),
((SELECT idSolicitud from solicitud ORDER BY idSolicitud DESC LIMIT 1),2,r2),
((SELECT idSolicitud from solicitud ORDER BY idSolicitud DESC LIMIT 1),3,r3),
((SELECT idSolicitud from solicitud ORDER BY idSolicitud DESC LIMIT 1),4,r4),
((SELECT idSolicitud from solicitud ORDER BY idSolicitud DESC LIMIT 1),5,r5),
((SELECT idSolicitud from solicitud ORDER BY idSolicitud DESC LIMIT 1),6,r6),
((SELECT idSolicitud from solicitud ORDER BY idSolicitud DESC LIMIT 1),7,r7),
((SELECT idSolicitud from solicitud ORDER BY idSolicitud DESC LIMIT 1),8,r8),
((SELECT idSolicitud from solicitud ORDER BY idSolicitud DESC LIMIT 1),9,r9),
((SELECT idSolicitud from solicitud ORDER BY idSolicitud DESC LIMIT 1),10,r10),
((SELECT idSolicitud from solicitud ORDER BY idSolicitud DESC LIMIT 1),11,r11),
((SELECT idSolicitud from solicitud ORDER BY idSolicitud DESC LIMIT 1),12,r12);
END$$

CREATE PROCEDURE `crearSolicitud` (IN `v_idUsuario` INT, IN `v_idPerro` INT)  NO SQL
INSERT INTO solicitud (idUsuario, idPerro, estadoFormulario, estadoEntrevista, estadoPago)
VALUES (v_idUsuario, v_idPerro, 3,3,3)$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cambio_contrasenia`
--

CREATE TABLE `cambio_contrasenia` (
  `uid` char(32) NOT NULL,
  `idUsuario` int(5) NOT NULL,
  `usada` tinyint(1) NOT NULL DEFAULT 0,
  `timestamp` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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

--
-- Volcado de datos para la tabla `caracteristicas`
--

INSERT INTO `caracteristicas` (`idPerro`, `idCondicion`, `idPersonalidad`, `idRaza`) VALUES
(1, 1, 6, 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `condiciones_medicas`
--

CREATE TABLE `condiciones_medicas` (
  `idCondicion` int(4) NOT NULL,
  `condicion` varchar(30) NOT NULL,
  `descripcion` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `condiciones_medicas`
--

INSERT INTO `condiciones_medicas` (`idCondicion`, `condicion`, `descripcion`) VALUES
(1, 'Ninguna', ''),
(2, 'Terminal', ''),
(3, 'Cronica', ''),
(4, 'Trauma Físico', ''),
(5, 'Trauma Psicológico', ''),
(6, 'Enfermedad', ''),
(7, 'Obesidad', ''),
(8, 'Desnutrición', ''),
(9, 'Discapacidad', 'Visual, auditiva, motriz');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `confirm_email`
--

CREATE TABLE `confirm_email` (
  `uid` char(32) NOT NULL,
  `idUsuario` int(5) NOT NULL,
  `confirmed` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
-- Estructura de tabla para la tabla `estado`
--

CREATE TABLE `estado` (
  `idEstado` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `perro` tinyint(1) NOT NULL,
  `proceso` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `estado`
--

INSERT INTO `estado` (`idEstado`, `nombre`, `perro`, `proceso`) VALUES
(1, 'Adoptado', 1, 0),
(2, 'Disponible', 1, 0),
(3, 'Incompleto', 0, 1),
(4, 'En proceso', 0, 1),
(5, 'Completo', 0, 1),
(6, 'No disponible', 1, 0),
(7, 'En recuperacion', 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_perro`
--

CREATE TABLE `estado_perro` (
  `idPerro` int(5) NOT NULL,
  `idEstado` int(7) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `estado_perro`
--

INSERT INTO `estado_perro` (`idPerro`, `idEstado`) VALUES
(1, 2);

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
  `tamanio` varchar(20) NOT NULL,
  `edadEstimadaLlegada` int(3) DEFAULT NULL,
  `fechaLLegada` date NOT NULL,
  `sexo` varchar(10) NOT NULL,
  `historia` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `perros`
--

INSERT INTO `perros` (`idPerro`, `nombre`, `tamanio`, `edadEstimadaLlegada`, `fechaLLegada`, `sexo`, `historia`) VALUES
(1, 'Gandalf', 'Pequeño', 12, '2020-02-02', 'macho', 'advakjdn');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `preguntas`
--

CREATE TABLE `preguntas` (
  `idPregunta` int(3) NOT NULL,
  `pregunta` text DEFAULT NULL,
  `tipo` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `preguntas`
--

INSERT INTO `preguntas` (`idPregunta`, `pregunta`, `tipo`) VALUES
(1, '¿Has tenido mascotas antes?', 'radio'),
(2, '¿Tienes otros animales en casa?', 'radio'),
(3, '¿Por qué desea adoptar al perrito?', 'textarea'),
(4, '¿En donde vivirá y dormirá el perrito?', 'textarea'),
(5, '¿Cuántas personas viven contigo?', 'numeric'),
(6, '¿Están de acuerdo en la adopción del perrito?', 'radio'),
(7, '¿Vive en casa o departamento?', 'radio'),
(8, '¿Tiene jardín o patio?', 'radio'),
(9, 'En caso de ser su vivienda rentada, ¿está de acuerdo su casero en que tenga mascotas?', 'radio'),
(10, 'Menciona los cuidados básicos de una mascota', 'textarea'),
(11, '¿Qué opinas de la esterilización?', 'textarea'),
(12, '¿Nos permitirías dar seguimiento al perrito, dejándonos visitarlo o pidiendo fotos del mismo para monitorear que está en buenas condiciones?', 'radio');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `privilegios`
--

CREATE TABLE `privilegios` (
  `idPrivilegio` int(2) NOT NULL,
  `privilegio` varchar(30) NOT NULL,
  `descripcion` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `privilegios`
--

INSERT INTO `privilegios` (`idPrivilegio`, `privilegio`, `descripcion`) VALUES
(1, 'ver-catalogo', 'Usuario puede navegar la pagina '),
(2, 'adoptar', ''),
(3, 'registrar', ''),
(4, 'editar-perro', ''),
(5, 'eliminar-perro', 'permite eliminar perros'),
(6, 'ver-todas-solicitudes', 'Ver todas las solicitudes de todos los usuarios'),
(7, 'editar-faq', ''),
(8, 'editar-info-contacto', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `privilegio_rol`
--

CREATE TABLE `privilegio_rol` (
  `idRol` int(2) NOT NULL,
  `idPrivilegio` int(2) NOT NULL,
  `fechaCreacion` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `privilegio_rol`
--

INSERT INTO `privilegio_rol` (`idRol`, `idPrivilegio`, `fechaCreacion`) VALUES
(1, 1, '2020-04-28 18:41:57'),
(3, 1, '2020-04-13 22:54:52'),
(4, 1, '2020-05-18 01:05:56'),
(1, 2, '2020-04-28 18:35:30'),
(3, 2, '2020-04-13 22:54:52'),
(1, 3, '2020-04-28 18:35:30'),
(2, 3, '2020-04-13 22:55:10'),
(1, 4, '2020-04-28 18:35:30'),
(2, 4, '2020-04-28 18:47:42'),
(1, 5, '2020-04-28 18:35:30'),
(2, 5, '2020-04-28 18:47:42'),
(1, 6, '2020-05-15 19:29:56'),
(1, 7, '2020-05-17 22:29:59'),
(1, 8, '2020-05-17 22:29:59'),
(4, 8, '2020-05-18 01:05:56');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `respuestas`
--

CREATE TABLE `respuestas` (
  `idSolicitud` int(7) NOT NULL,
  `idPregunta` int(3) NOT NULL,
  `respuesta` text NOT NULL,
  `fechaRespuesta` datetime NOT NULL DEFAULT current_timestamp()
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

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`idRol`, `rol`, `descripcion`) VALUES
(1, 'admin', 'Administrador de la pagina'),
(2, 'operador', 'Personas de servicio social/ voluntarios'),
(3, 'registrado', 'Usuario que ha creado cuenta'),
(4, 'registrado-no-verificado', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitud`
--

CREATE TABLE `solicitud` (
  `idSolicitud` int(7) NOT NULL,
  `idUsuario` int(5) NOT NULL,
  `idPerro` int(7) NOT NULL,
  `fechaCreacion` datetime NOT NULL DEFAULT current_timestamp(),
  `estadoFormulario` int(11) NOT NULL,
  `estadoEntrevista` int(11) NOT NULL,
  `estadoPago` int(11) NOT NULL,
  `fechaPago` datetime DEFAULT NULL,
  `metodoPago` varchar(20) DEFAULT NULL,
  `noTransaccion` int(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sucursal`
--

CREATE TABLE `sucursal` (
  `idSucursal` int(11) NOT NULL,
  `telefono` varchar(10) NOT NULL,
  `callePrincipal` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `calleSecundaria` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `numeroExterior` int(5) NOT NULL,
  `numeroInterior` int(4) DEFAULT NULL,
  `codigoPostal` int(5) NOT NULL,
  `colonia` varchar(30) NOT NULL,
  `ciudad` varchar(30) NOT NULL,
  `estado` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `sucursal`
--

INSERT INTO `sucursal` (`idSucursal`, `telefono`, `callePrincipal`, `calleSecundaria`, `numeroExterior`, `numeroInterior`, `codigoPostal`, `colonia`, `ciudad`, `estado`) VALUES
(1, '4421231234', 'Av Ferrocarril', '', 63, 0, 76800, 'La Cañada', 'Queretaro', 'Queretaro');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_donacion`
--

CREATE TABLE `tipo_donacion` (
  `idDonacion` int(1) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `descripcion` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tipo_donacion`
--

INSERT INTO `tipo_donacion` (`idDonacion`, `nombre`, `descripcion`) VALUES
(1, 'enEspecie', 'Comida, juguetes , materiales'),
(2, 'Monetaria', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_personalidad`
--

CREATE TABLE `tipo_personalidad` (
  `idPersonalidad` int(2) NOT NULL,
  `personalidad` varchar(30) NOT NULL,
  `descripcion` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tipo_personalidad`
--

INSERT INTO `tipo_personalidad` (`idPersonalidad`, `personalidad`, `descripcion`) VALUES
(1, 'Poco sociable con otros perros', 'Poco sociable con otros perros'),
(2, 'Juguetón', ''),
(3, 'Tranquilo', ''),
(4, 'Sociable', ''),
(5, 'Poco sociable con personas', 'Poco sociable con personas'),
(6, 'Compañía', ''),
(7, 'Protector', ''),
(8, 'Independiente', 'Prefiere pasar tiempo solo'),
(9, 'Energético', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_raza`
--

CREATE TABLE `tipo_raza` (
  `idRaza` int(3) NOT NULL,
  `raza` varchar(30) NOT NULL,
  `descripcion` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tipo_raza`
--

INSERT INTO `tipo_raza` (`idRaza`, `raza`, `descripcion`) VALUES
(1, 'Pastoreo', ''),
(2, 'Deportivos', ''),
(3, 'No Deportivos', ''),
(4, 'Trabajadores', ''),
(5, 'Sabuesos', ''),
(6, 'Mestizo', ''),
(7, 'Compañía', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idUsuario` int(5) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `apellido` varchar(30) NOT NULL,
  `email` varchar(40) NOT NULL,
  `telefono` varchar(10) NOT NULL,
  `callePrincipal` varchar(50) NOT NULL,
  `calleSecundaria` varchar(50) DEFAULT NULL,
  `NumeroExterior` int(5) NOT NULL,
  `NumeroInterior` int(4) DEFAULT NULL,
  `CodigoPostal` int(5) NOT NULL,
  `Colonia` varchar(30) NOT NULL,
  `Ciudad` varchar(30) NOT NULL,
  `Estado` varchar(30) NOT NULL,
  `fechaNacimiento` date NOT NULL,
  `Contrasenia` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idUsuario`, `nombre`, `apellido`, `email`, `telefono`, `callePrincipal`, `calleSecundaria`, `NumeroExterior`, `NumeroInterior`, `CodigoPostal`, `Colonia`, `Ciudad`, `Estado`, `fechaNacimiento`, `Contrasenia`) VALUES
(1, 'admin', 'admin', 'admin@admin.co', '1234567890', 'asdf', 'asdfg', 123, 42, 12345, 'asdf', 'Queretaro', 'Queretaro', '1999-10-02', '$2y$10$ifhAK.S6RMReYR.lZyqzeen6SU8GbY6p6UPI6qhzm58VviXTYHoqq'),
(2, 'Patricia', 'Raymond', 'habitant.morbi@feugiattellus.ca', '1817002188', '411-1303 Auctor. Av.', 'Apartado núm.: 154, 3816 Eu Carretera', 709, 233, 30295, 'CentroSur', 'Moroleon', 'Guanajuato', '1967-02-09', '$2y$10$PPZAldTP5/kKqVYMyBdJb..Y2B4SVHiKwO41E7M/GasnPx/XgIR3C'),
(3, 'Mauricio', 'Alvarez', 'maualvm@gmail.com', '4424670629', 'San Bernardo', 'a', 37, 0, 76230, 'Juriquilla', 'Querétaro', 'Querétaro', '1999-08-30', '$2y$10$RP0cXuM.8yIk2uiSbWYsWu55A6DZKymWglZ.ppolUl3LDFbBfdpSa'),
(4, 'Bert', 'Williams', 'eu@nullaIntegerurna.ca', '2147483647', '6385 Duis Avenida', 'Apartado núm.: 853, 3007 Eu Calle', 6439, 33, 61038, 'Juriquilla', 'Queretaro', 'Guanajuato', '1921-10-26', '$2y$10$PPZAldTP5/kKqVYMyBdJb..Y2B4SVHiKwO41E7M/GasnPx/XgIR3C');

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
-- Volcado de datos para la tabla `usuario_rol`
--

INSERT INTO `usuario_rol` (`idUsuario`, `idRol`, `fechaCreacion`) VALUES
(1, 1, '2020-04-28 19:00:53'),
(2, 2, '2020-04-28 19:12:40'),
(3, 3, '2020-04-29 13:54:17'),
(4, 3, '2020-04-28 19:12:40');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cambio_contrasenia`
--
ALTER TABLE `cambio_contrasenia`
  ADD PRIMARY KEY (`uid`),
  ADD KEY `idUsuario` (`idUsuario`);

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
-- Indices de la tabla `confirm_email`
--
ALTER TABLE `confirm_email`
  ADD PRIMARY KEY (`uid`),
  ADD KEY `idUsuario` (`idUsuario`);

--
-- Indices de la tabla `donacion`
--
ALTER TABLE `donacion`
  ADD KEY `idDonacion_usuario` (`idDonacion`),
  ADD KEY `idUsuario_donacion` (`idUsuario`);

--
-- Indices de la tabla `estado`
--
ALTER TABLE `estado`
  ADD PRIMARY KEY (`idEstado`);

--
-- Indices de la tabla `estado_perro`
--
ALTER TABLE `estado_perro`
  ADD KEY `idPerro` (`idPerro`),
  ADD KEY `idEstado` (`idEstado`);

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
-- Indices de la tabla `preguntas`
--
ALTER TABLE `preguntas`
  ADD PRIMARY KEY (`idPregunta`);

--
-- Indices de la tabla `privilegios`
--
ALTER TABLE `privilegios`
  ADD PRIMARY KEY (`idPrivilegio`);

--
-- Indices de la tabla `privilegio_rol`
--
ALTER TABLE `privilegio_rol`
  ADD PRIMARY KEY (`idPrivilegio`,`idRol`),
  ADD KEY `idRol` (`idRol`);

--
-- Indices de la tabla `respuestas`
--
ALTER TABLE `respuestas`
  ADD PRIMARY KEY (`idSolicitud`,`idPregunta`),
  ADD KEY `idPregunta` (`idPregunta`),
  ADD KEY `idSolicitud` (`idSolicitud`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`idRol`);

--
-- Indices de la tabla `solicitud`
--
ALTER TABLE `solicitud`
  ADD PRIMARY KEY (`idSolicitud`),
  ADD KEY `idPerro` (`idPerro`),
  ADD KEY `estadoFormulatio` (`estadoFormulario`,`estadoEntrevista`,`estadoPago`),
  ADD KEY `estadoEntrevista` (`estadoEntrevista`),
  ADD KEY `estadoPago` (`estadoPago`),
  ADD KEY `idUsuario` (`idUsuario`);

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
-- Indices de la tabla `usuario_rol`
--
ALTER TABLE `usuario_rol`
  ADD PRIMARY KEY (`idUsuario`,`idRol`),
  ADD KEY `idRol_usuario` (`idRol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `condiciones_medicas`
--
ALTER TABLE `condiciones_medicas`
  MODIFY `idCondicion` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `estado`
--
ALTER TABLE `estado`
  MODIFY `idEstado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `perros`
--
ALTER TABLE `perros`
  MODIFY `idPerro` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `preguntas`
--
ALTER TABLE `preguntas`
  MODIFY `idPregunta` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `privilegios`
--
ALTER TABLE `privilegios`
  MODIFY `idPrivilegio` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `idRol` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `solicitud`
--
ALTER TABLE `solicitud`
  MODIFY `idSolicitud` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT de la tabla `sucursal`
--
ALTER TABLE `sucursal`
  MODIFY `idSucursal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tipo_donacion`
--
ALTER TABLE `tipo_donacion`
  MODIFY `idDonacion` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tipo_personalidad`
--
ALTER TABLE `tipo_personalidad`
  MODIFY `idPersonalidad` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `tipo_raza`
--
ALTER TABLE `tipo_raza`
  MODIFY `idRaza` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idUsuario` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cambio_contrasenia`
--
ALTER TABLE `cambio_contrasenia`
  ADD CONSTRAINT `cambio_contrasenia_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `caracteristicas`
--
ALTER TABLE `caracteristicas`
  ADD CONSTRAINT `caracteristicas_ibfk_1` FOREIGN KEY (`idPerro`) REFERENCES `perros` (`idPerro`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `caracteristicas_ibfk_2` FOREIGN KEY (`idCondicion`) REFERENCES `condiciones_medicas` (`idCondicion`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `caracteristicas_ibfk_3` FOREIGN KEY (`idPersonalidad`) REFERENCES `tipo_personalidad` (`idPersonalidad`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `caracteristicas_ibfk_4` FOREIGN KEY (`idRaza`) REFERENCES `tipo_raza` (`idRaza`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `confirm_email`
--
ALTER TABLE `confirm_email`
  ADD CONSTRAINT `confirm_email_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `donacion`
--
ALTER TABLE `donacion`
  ADD CONSTRAINT `idDonacion_usuario` FOREIGN KEY (`idDonacion`) REFERENCES `tipo_donacion` (`idDonacion`),
  ADD CONSTRAINT `idUsuario_donacion` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`);

--
-- Filtros para la tabla `estado_perro`
--
ALTER TABLE `estado_perro`
  ADD CONSTRAINT `estado_perro_ibfk_1` FOREIGN KEY (`idEstado`) REFERENCES `estado` (`idEstado`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `estado_perro_ibfk_2` FOREIGN KEY (`idPerro`) REFERENCES `perros` (`idPerro`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `idRol` FOREIGN KEY (`idRol`) REFERENCES `rol` (`idRol`),
  ADD CONSTRAINT `privilegio_rol_ibfk_1` FOREIGN KEY (`idRol`) REFERENCES `rol` (`idRol`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `respuestas`
--
ALTER TABLE `respuestas`
  ADD CONSTRAINT `respuestas_ibfk_1` FOREIGN KEY (`idPregunta`) REFERENCES `preguntas` (`idPregunta`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `respuestas_ibfk_2` FOREIGN KEY (`idSolicitud`) REFERENCES `solicitud` (`idSolicitud`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `solicitud`
--
ALTER TABLE `solicitud`
  ADD CONSTRAINT `solicitud_ibfk_2` FOREIGN KEY (`idPerro`) REFERENCES `perros` (`idPerro`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `solicitud_ibfk_3` FOREIGN KEY (`estadoFormulario`) REFERENCES `estado` (`idEstado`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `solicitud_ibfk_4` FOREIGN KEY (`estadoEntrevista`) REFERENCES `estado` (`idEstado`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `solicitud_ibfk_5` FOREIGN KEY (`estadoPago`) REFERENCES `estado` (`idEstado`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `solicitud_ibfk_6` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuario_rol`
--
ALTER TABLE `usuario_rol`
  ADD CONSTRAINT `idRol_usuario` FOREIGN KEY (`idRol`) REFERENCES `rol` (`idRol`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `idUsuario_rol` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
