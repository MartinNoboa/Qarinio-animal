-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-04-2020 a las 03:06:04
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
CREATE DATABASE IF NOT EXISTS `bd_qarinoanimal` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `bd_qarinoanimal`;

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

--
-- Volcado de datos para la tabla `condiciones_medicas`
--

INSERT INTO `condiciones_medicas` (`idCondicion`, `condicion`, `descripcion`) VALUES
(1, 'Discapacidad', 'Visual, auditiva, motriz'),
(2, 'Terminal', ''),
(3, 'Cronica', ''),
(4, 'TraumaFisico', ''),
(5, 'TraumaPsicologico', ''),
(6, 'Enfermedad', ''),
(7, 'Obesidad', ''),
(8, 'Desnutricion', '');

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
(1, 'adoptado', 1, 0),
(2, 'disponible', 1, 0),
(3, 'incompleto', 0, 1),
(4, 'en proceso', 0, 1),
(5, 'completo', 0, 1),
(6, 'no disponible', 1, 0),
(7, 'en recuperacion', 1, 0);

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
(1, 2),
(2, 2),
(3, 2),
(4, 2),
(5, 2),
(6, 2),
(7, 2),
(8, 2),
(9, 2),
(10, 2),
(11, 2),
(12, 2),
(13, 2),
(14, 2),
(15, 2),
(16, 2),
(17, 2),
(18, 2),
(19, 2),
(20, 2),
(21, 2),
(22, 2),
(23, 2),
(24, 2),
(25, 2),
(26, 2),
(27, 2),
(28, 2),
(29, 2),
(30, 2),
(31, 2),
(32, 2),
(33, 2),
(34, 2),
(35, 2),
(36, 2),
(37, 2),
(38, 2),
(39, 2),
(40, 2),
(41, 2),
(42, 2),
(43, 2),
(44, 2),
(45, 2),
(46, 2),
(47, 2),
(48, 2),
(49, 2),
(50, 2),
(51, 2),
(52, 2);

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
(1, 'Paul', 'mediano', 355, '2020-03-05', 'Male', 'POSNGypej'),
(2, 'Tades', 'pequenio', 9, '2019-05-12', 'Male', 'DKHZJqovx'),
(3, 'Shelley', 'pequenio', 228, '2019-11-14', 'Male', 'CVXUWciqh'),
(4, 'Granny', 'grande', 253, '2019-11-20', 'Male', 'YPUXLzpby'),
(5, 'Cassy', 'mediano', 148, '2019-10-01', 'Female', 'VIWUHlgjj'),
(6, 'Idalina', 'grande', 120, '2019-10-02', 'Female', 'PZUXOnxwr'),
(7, 'Pascal', 'mediano', 221, '2019-04-17', 'Male', 'STSZLlkzt'),
(8, 'Carr', 'pequenio', 308, '2020-01-29', 'Male', 'MOTNTtgfl'),
(9, 'Karly', 'grande', 56, '2019-07-12', 'Female', 'MLJXKletu'),
(10, 'Jethro', 'pequenio', 329, '2020-03-19', 'Male', 'JBACVarjc'),
(11, 'Bree', 'mediano', 326, '2019-06-14', 'Female', 'XGNPJdxri'),
(12, 'Verney', 'grande', 344, '2020-01-27', 'Male', 'GUBABezxd'),
(13, 'Rhona', 'pequenio', 203, '2020-03-17', 'Female', 'RRCAAfxob'),
(14, 'Mendy', 'pequenio', 316, '2019-09-22', 'Male', 'BMLUAhtdx'),
(15, 'Legra', 'mediano', 273, '2019-05-26', 'Female', 'AYKDJipau'),
(16, 'Ellyn', 'mediano', 328, '2020-04-07', 'Female', 'SINUUozcu'),
(17, 'Gerome', 'pequenio', 155, '2019-06-07', 'Male', 'XCGLCpnxj'),
(18, 'Debbi', 'mediano', 323, '2019-04-21', 'Female', 'GCCJTqdut'),
(19, 'Constancy', 'grande', 358, '2019-09-28', 'Female', 'ZHAQUwjww'),
(20, 'Candide', 'pequenio', 349, '2019-11-27', 'Female', 'ORCRNeiok'),
(21, 'Kai', 'mediano', 209, '2019-11-11', 'Female', 'MJJWYzgjv'),
(22, 'Muhammad', 'mediano', 146, '2020-01-10', 'Male', 'IOWQKjnqi'),
(23, 'Adria', 'mediano', 7, '2019-11-27', 'Female', 'RYPQHdjxi'),
(24, 'Hobey', 'grande', 165, '2019-08-26', 'Male', 'NVOBFjxgw'),
(25, 'Mollie', 'mediano', 9, '2019-07-21', 'Female', 'SEMQKfese'),
(26, 'Claudius', 'grande', 341, '2020-02-18', 'Male', 'VPYTUhcza'),
(27, 'Lorilyn', 'mediano', 308, '2019-07-17', 'Female', 'MNIGFifcf'),
(28, 'Adara', 'mediano', 210, '2019-11-15', 'Female', 'MVFARliks'),
(29, 'Lucais', 'pequenio', 287, '2020-01-08', 'Male', 'ALIMVwawp'),
(30, 'Norry', 'grande', 226, '2019-06-13', 'Male', 'HUAKPuppb'),
(31, 'Brooks', 'pequenio', 123, '2020-03-28', 'Female', 'XGDNRgsbz'),
(32, 'Sheridan', 'mediano', 317, '2019-05-27', 'Male', 'ICFGNwsnk'),
(33, 'Reynolds', 'pequenio', 16, '2020-03-17', 'Male', 'FNMZEfmyq'),
(34, 'Bonita', 'grande', 261, '2019-05-29', 'Female', 'RVTEEoueq'),
(35, 'Donia', 'grande', 300, '2019-11-08', 'Female', 'RBLXOwgdw'),
(36, 'Teddy', 'mediano', 173, '2019-11-08', 'Male', 'HUULLdula'),
(37, 'Wilmar', 'mediano', 344, '2019-10-11', 'Male', 'FSLPBpwat'),
(38, 'Bennie', 'pequenio', 268, '2019-05-01', 'Male', 'ZXJELiszn'),
(39, 'Edin', 'pequenio', 4, '2019-07-12', 'Female', 'KSFCQfufm'),
(40, 'Brinna', 'mediano', 161, '2020-03-01', 'Female', 'YTPFZzotn'),
(41, 'Jeth', 'mediano', 267, '2019-11-14', 'Male', 'JDDMOrhuc'),
(42, 'Arron', 'mediano', 134, '2019-09-15', 'Male', 'ZGYGFqjvi'),
(43, 'Jayson', 'mediano', 246, '2019-10-07', 'Male', 'YJKHGvmlf'),
(44, 'Skelly', 'grande', 318, '2019-10-09', 'Male', 'IILRUghpl'),
(45, 'Ban', 'mediano', 131, '2019-08-12', 'Male', 'DTIJGetjn'),
(46, 'Oona', 'pequenio', 287, '2019-10-16', 'Female', 'HVRNVvhix'),
(47, 'Carroll', 'mediano', 68, '2019-08-07', 'Male', 'UODGWlswj'),
(48, 'Kathrine', 'pequenio', 97, '2020-01-15', 'Female', 'APXHIkwyk'),
(49, 'Allie', 'mediano', 275, '2019-08-04', 'Male', 'XNCODjgzt'),
(50, 'Federico', 'pequenio', 7, '2019-10-22', 'Male', 'NVORAjbvl'),
(51, 'Homero', 'pequeño', 24, '2020-04-23', 'macho', 'Perro rescatado'),
(52, 'Homero', 'Mediano', 24, '2020-02-23', 'macho', 'Perro abandonado');

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
(1, 'ver', 'Usuario puede navegar la pagina '),
(2, 'adoptar', ''),
(3, 'registrar', ''),
(4, 'editar', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `privilegio_rol`
--

CREATE TABLE `privilegio_rol` (
  `idPrivilegio` int(2) NOT NULL,
  `idRol` int(2) NOT NULL,
  `fechaCreacion` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `privilegio_rol`
--

INSERT INTO `privilegio_rol` (`idPrivilegio`, `idRol`, `fechaCreacion`) VALUES
(1, 3, '2020-04-13 22:54:52'),
(2, 3, '2020-04-13 22:54:52'),
(3, 2, '2020-04-13 22:55:10'),
(4, 1, '2020-04-13 22:55:10');

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

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`idRol`, `rol`, `descripcion`) VALUES
(1, 'admin', 'Administrador de la pagina'),
(2, 'operador', 'Personas de servicio social/ voluntarios'),
(3, 'registrado', 'Usuario que ha creado cuenta');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitud`
--

CREATE TABLE `solicitud` (
  `idUsuario` int(5) NOT NULL,
  `idPerros` int(7) NOT NULL,
  `idRespuestas` int(7) NOT NULL,
  `fecha` datetime NOT NULL,
  `estadoFormulario` int(11) NOT NULL,
  `estadoEntrevista` int(11) NOT NULL,
  `estadoPago` int(11) NOT NULL,
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
(1, 'AgresivoP', 'Agresivo con otros perros'),
(2, 'Jugueton', ''),
(3, 'Tranquilo', ''),
(4, 'Sociable', ''),
(5, 'AgresivoPer', 'Agresivo con personas'),
(6, 'Compania', ''),
(7, 'Protector', ''),
(8, 'Independiente', 'Prefiere pasar tiempo solo'),
(9, 'JuguetonAgresivo', ''),
(10, 'Energetico', '');

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
(3, 'NoDeportivos', ''),
(4, 'Trabajadores', ''),
(5, 'Sabuesos', ''),
(6, 'Terriers', ''),
(7, 'Muestra', '');

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
(11, 'Shad', 'Aguirre', 'eget.metus.In@Maurismolestie.edu', '1513815410', '546-1936 In Carretera', '177-3356 Elit Carretera', 1296, 473, 35012, 'Juriquilla', 'Moroleon', 'Querataro', '1985-03-20', '6F5546E8-1EDD-D9E7-04C8-3C30AFDA713C'),
(12, 'Colette', 'Caldwell', 'nonummy@pellentesque.com', '2147483647', 'Apdo.:484-6906 Vitae, Calle', 'Apdo.:900-2554 Dui. Av.', 9267, 790, 13409, 'Tecnologico', 'Queretaro', 'Querataro', '1936-11-26', 'C2FB43D7-B01B-4F65-80BA-B2C0F5FF36C0'),
(13, 'Mohammad', 'Allen', 'luctus.et.ultrices@sapien.net', '2147483647', '929-2678 Vitae, Ctra.', '906-6350 Sed Carretera', 5193, 450, 10516, 'Juriquilla', 'Celayork', 'Guanajuato', '1908-11-13', '84861AEA-E77F-F8BE-D33C-BE1BE803D056'),
(14, 'Jermaine', 'Williamson', 'dignissim@nullaCraseu.net', '2147483647', 'Apdo.:842-5261 Non, C/', 'Apartado núm.: 556, 1749 Amet C.', 5698, 140, 41572, 'Juriquilla', 'Moroleon', 'Querataro', '1965-01-05', '16D59185-CDB1-5C20-5D68-4D7EF1C7646A'),
(15, 'Penelope', 'Riggs', 'mauris@enimmi.edu', '2147483647', 'Apdo.:763-281 Adipiscing C/', 'Apdo.:267-3108 Ridiculus Ctra.', 4781, 446, 65641, 'Juriquilla', 'Moroleon', 'Guanajuato', '1946-06-08', 'E5411332-18A1-1F83-EBF8-611BDF58ED25'),
(16, 'Taylor', 'Holcomb', 'Praesent.eu.dui@quisurna.ca', '2147483647', 'Apdo.:864-1446 Sem. Calle', '985-4971 Ultrices Carretera', 6639, 755, 59255, 'Tecnologico', 'Celayork', 'Querataro', '1971-02-03', '2E1E1785-D21C-6946-EFDF-F37F1AA0C0E3'),
(17, 'Zenaida', 'Vasquez', 'enim@nequesed.co.uk', '2147483647', '161-5502 Habitant C/', 'Apartado núm.: 130, 9549 Donec Avda.', 4823, 196, 31075, 'Juriquilla', 'Queretaro', 'Querataro', '1909-12-20', '23B68797-6508-BEB1-EDF3-E4124BE5AE2A'),
(18, 'Eugenia', 'Whitaker', 'lorem.ipsum@nec.co.uk', '2147483647', 'Apdo.:412-9296 Dictum C.', 'Apartado núm.: 679, 6269 Nunc Ctra.', 7523, 249, 59865, 'CentroSur', 'Celayork', 'Querataro', '1910-05-15', '379FE189-00A7-D087-2660-5BD9E9354926'),
(19, 'Kenneth', 'Avila', 'sem.Pellentesque@nullaInteger.co.uk', '2147483647', '137-7899 Lobortis C/', 'Apdo.:127-8987 Porttitor Carretera', 155, 664, 53296, 'CentroSur', 'Queretaro', 'Querataro', '1991-05-07', 'E36F5B5A-3845-02A7-97CA-BBECAED52AB7'),
(20, 'Connor', 'Valencia', 'ante.ipsum.primis@etmalesuadafames.edu', '2147483647', 'Apdo.:665-700 Ultrices, Avenida', 'Apartado núm.: 890, 6814 Augue. C/', 1721, 644, 48798, 'Tecnologico', 'Queretaro', 'Querataro', '1982-06-14', '95C8EBEA-011D-A612-0901-729288AAAC35'),
(21, 'Ian', 'Erickson', 'Morbi.accumsan.laoreet@lorem.edu', '2147483647', '335-9641 Sed Carretera', '710-3115 Ullamcorper. Av.', 9283, 797, 20437, 'CentroSur', 'Celayork', 'Guanajuato', '1905-08-26', '8B3D1950-B868-CA2B-A5B8-F289B2817302'),
(22, 'Lee', 'Orr', 'Phasellus.at@Aliquamfringillacursus.ca', '2147483647', '7653 Vulputate ', 'Apdo.:706-4611 Lacus. Carretera', 3025, 155, 53344, 'Juriquilla', 'Queretaro', 'Guanajuato', '1992-03-11', 'A855D564-D8BC-1679-04D1-FB7AFB8F7587'),
(23, 'Cruz', 'Guerra', 'a.dui@fringillapurus.edu', '2147483647', '7413 Magna Calle', 'Apartado núm.: 333, 8063 Ligula Avda.', 9647, 287, 89658, 'CentroSur', 'Celayork', 'Guanajuato', '1931-12-09', '8374ACCB-9116-BE08-B72D-59B8C58AE2D5'),
(24, 'Vera', 'Gibson', 'magnis.dis.parturient@neccursusa.ca', '2147483647', '904-7916 Turpis Calle', 'Apdo.:343-9801 Nullam Calle', 5390, 474, 52857, 'Tecnologico', 'Celayork', 'Guanajuato', '1976-01-24', '9D561D4C-1FCF-3E6C-655A-97C12BAC9F98'),
(25, 'Driscoll', 'Mercado', 'tellus@et.edu', '2147483647', 'Apdo.:740-5218 Nibh Avenida', 'Apdo.:860-4785 Facilisis Calle', 463, 592, 96218, 'CentroSur', 'Queretaro', 'Guanajuato', '1954-07-22', '1E0A71B8-6296-5D4F-2C07-0FBF72DE9FD2'),
(26, 'Courtney', 'Barry', 'odio@Cras.edu', '2147483647', 'Apartado núm.: 504, 7158 Nulla Calle', '835-278 Nonummy Carretera', 4894, 210, 21100, 'CentroSur', 'Queretaro', 'Querataro', '1980-11-28', '2C114673-4E31-7389-A284-5D6F86BB51D9'),
(27, 'Kirk', 'Camacho', 'lorem.ipsum@nulla.ca', '1930865904', 'Apartado núm.: 939, 5079 Neque. Ctra.', '2529 Varius Ctra.', 9768, 30, 74900, 'Juriquilla', 'Celayork', 'Querataro', '1998-07-22', '172CE4B8-4A82-F867-2569-4570D7171095'),
(28, 'Haviva', 'Clements', 'feugiat.nec.diam@orci.ca', '1444716351', 'Apartado núm.: 392, 199 Purus. Avenida', '114-3295 Fusce Carretera', 3803, 450, 47683, 'Tecnologico', 'Moroleon', 'Guanajuato', '1927-04-26', 'E587D138-9577-3D5B-BF2B-9E814E3A15C3'),
(29, 'Sonia', 'Clayton', 'ante.blandit.viverra@laoreetliberoet.ca', '2147483647', 'Apartado núm.: 226, 1104 Velit Calle', 'Apdo.:477-2847 Aliquam Avenida', 2425, 853, 79169, 'Tecnologico', 'Queretaro', 'Querataro', '2001-03-19', 'FBE0F9DE-2D6C-EEEA-72AB-B02A0613ED33'),
(30, 'Gretchen', 'Martinez', 'massa@dictum.net', '2147483647', '1844 Nisl. Av.', 'Apartado núm.: 432, 6407 Turpis C.', 8272, 204, 29758, 'Juriquilla', 'Celayork', 'Guanajuato', '1919-10-20', '2FE78516-292F-8258-DF3E-DBDD1879A6AC'),
(31, 'Amela', 'Horne', 'risus@Nullamutnisi.ca', '2147483647', 'Apdo.:850-5681 Eget, C.', '3199 Adipiscing Av.', 6869, 782, 90985, 'CentroSur', 'Queretaro', 'Guanajuato', '1941-05-13', '49DDFDCF-5F94-D3E4-C1AA-B7C1F23E22B5'),
(32, 'Sybill', 'Valenzuela', 'massa.Quisque.porttitor@erategettincidun', '2147483647', 'Apartado núm.: 372, 7682 Id Avenida', 'Apartado núm.: 593, 7964 Elit, Avda.', 8320, 518, 22145, 'Juriquilla', 'Queretaro', 'Querataro', '1916-08-15', '3C67D217-B50C-F639-8E53-6C4DBD217D35'),
(33, 'Vivian', 'Howe', 'tristique.ac@mauris.edu', '2147483647', 'Apdo.:785-9442 Quisque Calle', 'Apartado núm.: 934, 816 In, ', 7290, 263, 69395, 'CentroSur', 'Celayork', 'Guanajuato', '1936-06-09', '24F1A33C-45B4-22A7-1974-017DB495F7B1'),
(34, 'Willa', 'Glover', 'vel@VivamusnisiMauris.ca', '2147483647', 'Apartado núm.: 576, 1361 Vestibulum ', 'Apartado núm.: 936, 8175 Nulla Calle', 2274, 461, 92956, 'Juriquilla', 'Celayork', 'Querataro', '1932-09-10', 'D38D13F8-5EA9-B166-A992-69867C4FA055'),
(35, 'Camille', 'Chan', 'arcu.Curabitur.ut@aliquam.ca', '2147483647', 'Apdo.:722-4982 Vitae ', 'Apdo.:942-9348 Molestie Carretera', 5195, 256, 60234, 'Juriquilla', 'Moroleon', 'Guanajuato', '1952-07-29', '10F22A25-C0EC-5E73-EAA3-15DEE8B4FCF1'),
(36, 'Shaeleigh', 'Blackwell', 'sagittis@Donecfelisorci.edu', '2147483647', '852 Libero C/', 'Apdo.:800-7947 Malesuada Av.', 5201, 4, 58005, 'Juriquilla', 'Moroleon', 'Querataro', '1910-08-19', '418195F4-FD52-F5C6-AAC6-25E71445C745'),
(37, 'Leandra', 'Perry', 'dolor.sit@et.net', '2147483647', '3868 Nibh. Calle', 'Apdo.:625-1326 Cum C/', 1741, 482, 38069, 'Tecnologico', 'Celayork', 'Guanajuato', '1937-03-20', 'A9B42F41-99EF-5A65-0B8B-40E759A96B4A'),
(38, 'Cassady', 'Anderson', 'pede@nibhDonec.com', '2147483647', '1234 Aenean Ctra.', 'Apartado núm.: 205, 2796 Mauris, Carretera', 5151, 586, 36610, 'CentroSur', 'Moroleon', 'Querataro', '1998-10-21', '9096CC08-7C8F-71CF-6C66-9BDD3E2571AB'),
(39, 'Karyn', 'Buck', 'ac@lobortisultrices.ca', '2147483647', 'Apartado núm.: 548, 8678 Euismod Avda.', '637-9444 Nascetur Avda.', 2264, 667, 73989, 'Tecnologico', 'Celayork', 'Querataro', '1967-09-30', '3145881D-88D2-E50E-ED84-E38FBE73485D'),
(40, 'Upton', 'Houston', 'at.risus@Crasconvallisconvallis.edu', '2147483647', '6501 Ac Av.', 'Apartado núm.: 272, 7030 Nibh. Calle', 7436, 700, 44123, 'Juriquilla', 'Queretaro', 'Guanajuato', '1927-05-27', '366107A6-6F00-B1A3-30A2-59EDB57B83BE'),
(41, 'Hashim', 'Garcia', 'molestie.sodales@temporlorem.org', '1897175966', 'Apartado núm.: 591, 6813 Proin ', 'Apartado núm.: 503, 3147 Mollis Av.', 4662, 55, 50399, 'Tecnologico', 'Moroleon', 'Querataro', '1928-02-08', 'D2D014BF-4558-CF31-82D1-7E9DFFD445FE'),
(42, 'Heidi', 'Clarke', 'lectus@egestasrhoncus.org', '1810345023', 'Apdo.:293-6228 Massa Avenida', 'Apartado núm.: 850, 6204 Integer Avda.', 6539, 337, 22689, 'Tecnologico', 'Celayork', 'Guanajuato', '1991-02-02', '8774836E-15A2-5C76-1CE5-1D8C30BF5C31'),
(43, 'Herman', 'Aguirre', 'natoque.penatibus.et@sem.org', '2147483647', '406-3391 Mauris C.', '3802 Nisi. Carretera', 4312, 349, 99805, 'Juriquilla', 'Moroleon', 'Guanajuato', '1955-01-12', '47FB8C13-5E11-28F3-2D19-764F708828B4'),
(44, 'Zephania', 'Greene', 'libero@Namconsequatdolor.co.uk', '2147483647', 'Apdo.:108-1731 Pede, Carretera', 'Apartado núm.: 837, 8972 Duis Avda.', 1239, 871, 53299, 'Juriquilla', 'Queretaro', 'Guanajuato', '1924-10-05', '5557ABDF-576A-0C93-58B2-C3C39EF9CB98'),
(45, 'Tate', 'Schwartz', 'tellus@semper.edu', '2147483647', '285-4843 Dui Av.', '965-2941 Erat. Avda.', 6336, 1, 53476, 'CentroSur', 'Queretaro', 'Guanajuato', '1956-08-21', 'A906FA50-6569-FAD6-08F7-879E8C9543E9'),
(46, 'Gage', 'French', 'eros.nec@cursuspurus.net', '2147483647', 'Apartado núm.: 732, 3846 Proin ', 'Apdo.:265-1551 Pede Avda.', 1247, 705, 81933, 'CentroSur', 'Celayork', 'Guanajuato', '1994-01-10', 'ACB2A892-6B37-B580-9D2B-58E5B4F2D6EF'),
(47, 'Adena', 'Delacruz', 'ipsum.porta.elit@ligulaconsectetuer.com', '2147483647', 'Apdo.:689-5108 Tortor Carretera', '9426 Amet Avenida', 559, 896, 72007, 'Tecnologico', 'Queretaro', 'Querataro', '1927-03-30', '61E1EF6C-29E7-3B4E-BF16-48B9B07571B5'),
(48, 'May', 'Morrow', 'eget.mollis@miAliquamgravida.ca', '2147483647', 'Apdo.:876-992 Luctus Avda.', '2805 A Av.', 1633, 494, 77821, 'Juriquilla', 'Moroleon', 'Guanajuato', '1948-01-26', '3D678431-45BF-A26C-C60A-2CC5DEFFC237'),
(49, 'Bell', 'Roth', 'in@Nullam.co.uk', '2147483647', '7842 Ac C.', '1972 Et Av.', 9210, 623, 93965, 'Tecnologico', 'Celayork', 'Querataro', '1908-08-11', 'F0E5DEE2-4AF8-AB92-D94E-A28BCB12A9A7'),
(50, 'Penelope', 'Anderson', 'hendrerit@est.edu', '1470608969', 'Apartado núm.: 675, 6942 Feugiat ', '318-806 Auctor, C.', 9705, 443, 32629, 'Tecnologico', 'Queretaro', 'Querataro', '1904-09-30', 'B5B097B0-A7BE-4C09-F6E2-32FBA1AB1111'),
(51, 'Nerea', 'Huff', 'a.dui@urnaetarcu.net', '2147483647', '487-2687 Dolor Av.', '874-1463 Non, C.', 9859, 681, 79104, 'Juriquilla', 'Moroleon', 'Querataro', '1914-03-09', '97DD9AEC-1BDA-5A0A-143F-5C164385F101'),
(52, 'Uriah', 'Conrad', 'Vivamus.sit@acrisusMorbi.org', '2147483647', 'Apartado núm.: 364, 6049 Risus Avenida', 'Apartado núm.: 839, 2514 Duis Av.', 9876, 579, 60261, 'Tecnologico', 'Celayork', 'Guanajuato', '1906-03-11', '254CA149-2535-5B94-034B-BD0D8DB6F16B'),
(53, 'Indira', 'Stanton', 'amet.ornare@fringillamilacinia.org', '2147483647', 'Apdo.:300-6776 Dolor Carretera', 'Apartado núm.: 684, 5788 Nunc C.', 5072, 853, 78040, 'Juriquilla', 'Moroleon', 'Guanajuato', '1947-01-29', '9173F51B-0716-3629-5AF8-1945C3FF6BE1'),
(54, 'Ignatius', 'Duran', 'lobortis.quam@amet.co.uk', '2147483647', '300-1568 Magna. Av.', 'Apartado núm.: 194, 651 Sem Avenida', 6010, 207, 28575, 'Tecnologico', 'Celayork', 'Querataro', '1962-05-24', '5D57758E-A855-30B4-F91F-BA0F236251F6'),
(55, 'Chastity', 'Merritt', 'ipsum.primis@etultrices.ca', '2147483647', '3104 Cursus C/', 'Apartado núm.: 220, 6795 Pellentesque ', 2518, 117, 89567, 'Juriquilla', 'Celayork', 'Querataro', '1950-09-06', '9296AAF8-2047-95CF-EB1D-A37C8D9BC2B8'),
(56, 'Alexa', 'Hood', 'turpis.egestas@seddictumeleifend.edu', '1697253987', '5264 Duis C/', '2258 Nulla. Avenida', 7035, 97, 74170, 'Tecnologico', 'Queretaro', 'Guanajuato', '1976-08-26', '43E05CEF-96C2-E286-9BF3-D24866FF1F6F'),
(57, 'Sage', 'Oneill', 'ipsum.Phasellus@nisl.org', '2147483647', '4557 Nec Av.', 'Apartado núm.: 472, 3257 Morbi Calle', 2648, 205, 27007, 'Tecnologico', 'Moroleon', 'Querataro', '1908-06-15', '98AE2DB1-1D37-51B2-EC75-43640690ED8E'),
(58, 'Kenneth', 'Terry', 'ad@sociisnatoque.edu', '2147483647', '5255 Curae; Avda.', '3300 Mollis Carretera', 7546, 148, 32371, 'Juriquilla', 'Moroleon', 'Querataro', '1917-12-10', 'DE0B0DFC-6C20-B89F-15B0-EDBCE703D5A8'),
(59, 'Xenos', 'Chapman', 'mollis@purusmaurisa.ca', '2147483647', '4147 Dictum ', 'Apdo.:364-7584 At, Avenida', 7073, 738, 40910, 'Juriquilla', 'Queretaro', 'Guanajuato', '1945-09-30', '6820CD3B-916D-5187-DBDC-E55B29FDD165'),
(60, 'Armand', 'Aguilar', 'metus.In.nec@ullamcorperviverra.edu', '2147483647', 'Apdo.:648-7448 Sagittis Calle', 'Apartado núm.: 436, 4380 Etiam Avenida', 6606, 471, 26849, 'Juriquilla', 'Moroleon', 'Querataro', '1961-05-13', '387FC9A3-110F-9A87-009C-F0BC8A866F3B'),
(61, 'Prescott', 'Blake', 'justo@commodo.org', '2147483647', '362-6855 Et C.', '119-4673 Ornare Avenida', 4685, 533, 22808, 'Juriquilla', 'Queretaro', 'Guanajuato', '1941-11-24', '07DCE6F8-AB8D-2C2A-D441-B94C300EB4DA'),
(62, 'Barbara', 'Mcguire', 'mi.tempor.lorem@vestibulum.co.uk', '2147483647', 'Apartado núm.: 444, 883 Congue Ctra.', '2712 Donec Calle', 4653, 829, 72725, 'Juriquilla', 'Moroleon', 'Guanajuato', '1957-06-18', '89F50EDE-63BB-9B8D-8E55-ACECB75C1CE2'),
(63, 'Anastasia', 'Williamson', 'luctus.ipsum.leo@consectetuerrhoncusNull', '2147483647', 'Apartado núm.: 800, 4564 Et ', 'Apdo.:198-3987 Et Calle', 9588, 433, 79083, 'Tecnologico', 'Queretaro', 'Guanajuato', '1971-07-18', '95F02441-3587-AD62-56F1-709593944BE9'),
(64, 'Uta', 'Mcintosh', 'a@Maurisvel.org', '2115415746', '744-7513 Sed C.', '3752 Mi Avenida', 9391, 645, 16456, 'CentroSur', 'Celayork', 'Querataro', '1979-07-05', '971F362B-8414-67DF-B838-8875192CDD48'),
(65, 'Kareem', 'Greene', 'adipiscing@magnis.net', '1582772130', '5366 Eu Avenida', '699-9239 Et Ctra.', 9419, 866, 83974, 'Juriquilla', 'Queretaro', 'Querataro', '1934-05-02', '814122C2-EA18-AD9E-878A-3897C004722B'),
(66, 'Uriah', 'Leonard', 'ante.blandit.viverra@euismodurna.ca', '2147483647', '433-6784 Cursus ', '5554 Mauris. Ctra.', 2126, 960, 18601, 'Juriquilla', 'Celayork', 'Querataro', '1976-10-22', '8B888DF8-0950-9D7A-889F-A363025F44D3'),
(67, 'Orlando', 'Hess', 'Donec.elementum@Nullam.co.uk', '2147483647', 'Apartado núm.: 897, 5571 Nunc Avda.', '6390 Gravida C/', 3761, 324, 52459, 'CentroSur', 'Moroleon', 'Querataro', '1988-05-30', '7B82E04B-039C-78E9-32D5-81AEFA8E311E'),
(68, 'Oleg', 'Kirk', 'et.magnis@velfaucibusid.edu', '2147483647', '3708 Aliquet. Calle', '826-2153 Eleifend. Carretera', 1579, 179, 25288, 'Juriquilla', 'Moroleon', 'Querataro', '1925-06-02', 'B9E76104-6DE3-3B6E-0ED6-3D8A97FA13EE'),
(69, 'Eliana', 'Small', 'nunc.risus.varius@ategestas.org', '2147483647', '124-6277 Orci Carretera', 'Apartado núm.: 943, 9903 Libero. Carretera', 1711, 252, 95756, 'Tecnologico', 'Queretaro', 'Guanajuato', '2001-08-27', '65DD9488-2517-554A-EB25-76BF1481F7FD'),
(70, 'Melodie', 'Brewer', 'commodo.ipsum@nonummy.com', '2147483647', '171-5655 Vitae Avda.', 'Apdo.:278-5344 Mus. C.', 3452, 261, 30464, 'Tecnologico', 'Moroleon', 'Guanajuato', '1991-04-16', 'F6A33A3B-549C-F215-7909-53C08C6FFCFC'),
(71, 'Kevin', 'Austin', 'velit@dolor.com', '2147483647', '229-7941 Quis Ctra.', 'Apdo.:214-6509 Morbi Avenida', 1407, 93, 70464, 'Tecnologico', 'Moroleon', 'Guanajuato', '1904-01-24', 'C70143B7-FB57-ACDA-5D7D-81B83AEC1280'),
(72, 'Simon', 'Boyle', 'vestibulum.neque@Morbiaccumsanlaoreet.ed', '2147483647', 'Apartado núm.: 893, 943 Sit Av.', 'Apartado núm.: 878, 862 Tincidunt, Carretera', 5196, 886, 79887, 'CentroSur', 'Moroleon', 'Querataro', '1917-06-21', '1B04C510-6354-D5BD-E8F7-DD0C6AE4AF65'),
(73, 'Josiah', 'Gallagher', 'vulputate.nisi@egettincidunt.co.uk', '2147483647', 'Apdo.:548-7450 Nisi Avenida', '892-2091 Penatibus Calle', 7362, 825, 37920, 'Tecnologico', 'Queretaro', 'Guanajuato', '1976-10-02', 'EB230B10-8AC2-B53E-5A39-B8378C619491'),
(74, 'Ori', 'Clayton', 'rutrum@utdolor.net', '2147483647', 'Apartado núm.: 333, 7364 Ut, C.', '588-7668 Vel, Avenida', 7347, 241, 17762, 'Juriquilla', 'Queretaro', 'Guanajuato', '1977-10-11', '67176390-A66A-D2A5-386B-7A700C5D4689'),
(75, 'Tanner', 'Oneil', 'lorem@tempor.net', '2147483647', '202-4104 Tincidunt Ctra.', '452-7311 Ut, Calle', 9311, 721, 42758, 'Juriquilla', 'Moroleon', 'Querataro', '1924-06-17', '2690D529-74F4-7935-7C42-69FDC10D5F5D'),
(76, 'Eaton', 'Reed', 'sociis@tortorNunccommodo.net', '2147483647', 'Apdo.:125-9333 Sodales ', 'Apdo.:608-319 Cum Calle', 591, 61, 78751, 'Tecnologico', 'Queretaro', 'Querataro', '1996-10-09', 'AFC52A25-DF05-BF6E-C7AA-F3AC02F1AB4D'),
(77, 'Abdul', 'Oneil', 'sed@natoquepenatibus.edu', '2147483647', '7024 Vitae Avda.', 'Apdo.:295-7313 Rhoncus C.', 591, 91, 77106, 'CentroSur', 'Moroleon', 'Guanajuato', '1904-06-23', '40C1D75C-5AC5-A0FA-FE69-19AFBFDB3DD0'),
(78, 'Rose', 'Gomez', 'vulputate@malesuadafamesac.com', '2147483647', '516-2574 Nunc Avenida', 'Apartado núm.: 600, 6214 Neque ', 5623, 381, 88602, 'Tecnologico', 'Queretaro', 'Guanajuato', '1921-02-23', 'E1503B61-D7E0-44C8-5997-5D530B656A52'),
(79, 'Kirk', 'Cantrell', 'nulla.ante@pedenonummy.ca', '2147483647', '5526 Id Av.', 'Apartado núm.: 436, 9880 Et Carretera', 7606, 147, 47296, 'CentroSur', 'Moroleon', 'Querataro', '1917-10-12', 'CC638C08-7081-6C22-163B-2C4AE1130AD7'),
(80, 'Cassandra', 'Andrews', 'pede@eutempor.ca', '2147483647', 'Apartado núm.: 686, 9127 Semper Avda.', '6313 Sapien. Ctra.', 8847, 1, 18375, 'Juriquilla', 'Queretaro', 'Guanajuato', '1976-09-12', '27BFEED9-64BD-48EA-7B59-C096F06B4487'),
(81, 'Hop', 'Bryan', 'mi@esttemporbibendum.edu', '2147483647', 'Apdo.:282-7340 In Avenida', '669 Molestie Av.', 7776, 899, 36166, 'CentroSur', 'Celayork', 'Guanajuato', '1903-07-22', '417BC5B7-F231-A2BF-23F6-8F0A07360826'),
(82, 'Jared', 'Livingston', 'eu.ligula@duiSuspendisseac.com', '2147483647', 'Apartado núm.: 772, 282 Consectetuer C.', 'Apdo.:425-2376 Non, Av.', 7198, 322, 22923, 'Juriquilla', 'Moroleon', 'Querataro', '1953-03-29', '89CBC667-AAB4-1DD4-6B75-8D9860231DB3'),
(83, 'Victor', 'Rowe', 'In.scelerisque@auctornonfeugiat.ca', '2147483647', '464-4868 Phasellus Calle', '296-2324 Ante C.', 1892, 186, 82563, 'CentroSur', 'Moroleon', 'Guanajuato', '1909-07-03', '8614E3D5-9DB8-CED2-3A38-B01B955C6629'),
(84, 'Sydney', 'Mcclure', 'penatibus.et@molestiepharetranibh.com', '2147483647', 'Apdo.:558-5591 Integer C.', '839-7133 Eget, Avda.', 5514, 395, 73113, 'Juriquilla', 'Celayork', 'Guanajuato', '1915-01-06', '33B95E38-C35C-81B6-AC05-91F8A4DAE0B4'),
(85, 'Octavia', 'Bryant', 'orci.luctus@idblanditat.co.uk', '2147483647', '927-7141 Diam. Avenida', 'Apdo.:401-5955 Mauris Avda.', 3800, 48, 48187, 'Tecnologico', 'Moroleon', 'Guanajuato', '1950-01-08', '400472C1-3041-7CDE-80F6-A713F784D6A5'),
(86, 'Tanya', 'Joseph', 'faucibus@dictumultricies.org', '2147483647', '915-1454 Ornare, Calle', 'Apartado núm.: 348, 1310 Tempor C/', 9415, 125, 46722, 'Tecnologico', 'Celayork', 'Querataro', '1984-11-01', '9D7F92BF-41DF-93C3-57FA-39AC923970EA'),
(87, 'Judah', 'Todd', 'aliquet.metus@metussit.co.uk', '2147483647', 'Apdo.:738-8429 Diam Ctra.', '6397 Faucibus C.', 781, 285, 92507, 'CentroSur', 'Moroleon', 'Querataro', '1903-03-04', 'C60A32F6-D63A-5505-8A97-6F3919399B7A'),
(88, 'Alan', 'Mcknight', 'urna.Nullam@id.net', '2147483647', 'Apartado núm.: 967, 1173 Duis Avda.', 'Apdo.:902-8245 Elit. C.', 3514, 251, 63198, 'Tecnologico', 'Queretaro', 'Guanajuato', '1937-04-09', '84DE9531-A658-4916-0206-638E50E1EF01'),
(89, 'Brody', 'Jimenez', 'nunc.ullamcorper@egetvenenatis.com', '2147483647', 'Apartado núm.: 496, 1698 Ut Ctra.', 'Apdo.:563-1404 Arcu C/', 355, 720, 28322, 'Tecnologico', 'Queretaro', 'Guanajuato', '1906-04-20', '9D3EBE36-9D75-EBE4-5CC7-D882CFA266FC'),
(90, 'McKenzie', 'Oneill', 'aliquet@arcuCurabitur.org', '2147483647', 'Apartado núm.: 101, 3686 Nibh Ctra.', '217-6659 Pede Calle', 2875, 21, 90072, 'CentroSur', 'Moroleon', 'Guanajuato', '1914-06-28', '1D2517DA-30B8-A1CA-7AC8-C7B17073DB25'),
(91, 'Cullen', 'Hoffman', 'pede.Suspendisse.dui@mus.org', '2147483647', '9271 At Avda.', '1881 Erat Av.', 7929, 793, 18926, 'Tecnologico', 'Celayork', 'Querataro', '1993-02-08', '5845F24E-2BB6-B649-4CAE-AA753CEDFF87'),
(92, 'Emma', 'Adkins', 'lorem@nonegestasa.ca', '1137873833', 'Apdo.:257-1424 Et, Calle', '4027 Dignissim. C.', 634, 833, 88893, 'Juriquilla', 'Moroleon', 'Querataro', '1903-07-23', 'E4AFA5A6-DBCB-08A4-F61F-629DF21B0C2B'),
(93, 'Yvette', 'Baker', 'elit@eros.org', '2147483647', 'Apartado núm.: 684, 4587 Ut, Carretera', 'Apartado núm.: 261, 2701 Vel ', 8776, 954, 29813, 'Tecnologico', 'Celayork', 'Guanajuato', '2001-07-10', 'D8A22C5E-3CD3-6D77-A75D-AAAF6EC07D5D'),
(94, 'Hoyt', 'Sweet', 'arcu.Vestibulum.ante@nec.net', '2147483647', 'Apartado núm.: 313, 1572 Commodo Avda.', 'Apdo.:484-7987 Enim C/', 8504, 388, 98835, 'Tecnologico', 'Celayork', 'Querataro', '1947-08-31', '249CBCD5-8D03-9AC6-0739-36E5993BC147'),
(95, 'Oren', 'Mccormick', 'enim.Nunc@Uttinciduntorci.org', '2147483647', '5704 At, Carretera', '1435 Tempus ', 4438, 597, 33246, 'CentroSur', 'Queretaro', 'Guanajuato', '1933-03-12', '6F8D0590-3173-8F40-D692-032B9BF6BBBE'),
(96, 'Germaine', 'Sheppard', 'placerat.augue.Sed@mi.co.uk', '2147483647', 'Apartado núm.: 440, 7602 Sem C.', 'Apartado núm.: 331, 8335 Luctus. C.', 7471, 754, 56310, 'Tecnologico', 'Moroleon', 'Querataro', '1990-05-21', '19A9309D-7D59-101E-CD34-A327C23AF903'),
(97, 'Bianca', 'Owens', 'Proin.eget@porttitor.co.uk', '2147483647', '821-7439 Aliquam Calle', 'Apdo.:196-4919 Auctor C/', 5672, 706, 55892, 'Tecnologico', 'Celayork', 'Querataro', '1906-06-09', '5C5FB357-4786-A382-26E9-4E2C9F706138'),
(98, 'Zelda', 'Duffy', 'Quisque.fringilla.euismod@fermentum.com', '2147483647', '540-1982 Vulputate C/', 'Apdo.:377-6227 Tortor. ', 642, 688, 72065, 'Juriquilla', 'Queretaro', 'Querataro', '1995-03-15', '731A5F5B-984D-3319-C0B1-692D84E7B013'),
(99, 'Lars', 'Boyd', 'nunc@Phaselluslibero.com', '2147483647', 'Apartado núm.: 272, 6797 Phasellus Ctra.', 'Apdo.:294-5992 Libero. Av.', 2175, 714, 85331, 'Tecnologico', 'Moroleon', 'Guanajuato', '1991-10-19', '7A0513DD-9CB0-C598-116B-1B1222A39A19'),
(100, 'Dominic', 'Snider', 'Curabitur@uteros.org', '2147483647', 'Apdo.:517-2031 Libero Carretera', '7748 Faucibus Av.', 353, 410, 79972, 'Tecnologico', 'Queretaro', 'Guanajuato', '1909-03-16', '6BA94E0E-BBEA-669E-3966-5A40D570C251'),
(101, 'Patience', 'Clements', 'rutrum@utodio.org', '1794176062', '234-9889 Enim ', '986-6336 Nam Avenida', 193, 789, 95734, 'Juriquilla', 'Moroleon', 'Querataro', '1993-08-07', '0BB06F5B-563B-CF2A-F3DE-A4B73E145F60'),
(102, 'Alice', 'Patel', 'elit.elit.fermentum@Curabitursed.edu', '2147483647', 'Apdo.:753-3785 Nec, Calle', '168-6574 Facilisis C/', 9727, 476, 40865, 'CentroSur', 'Celayork', 'Guanajuato', '1963-04-16', '5826C589-C8C8-1ADE-3872-D171EF2403DC'),
(103, 'Chanda', 'Michael', 'est@massarutrum.com', '2147483647', 'Apdo.:502-6748 Purus Avda.', '7464 Urna C.', 9302, 823, 67714, 'CentroSur', 'Moroleon', 'Guanajuato', '1991-01-03', '0BB519EB-E85D-D235-D47E-8D7D1BB7A146'),
(104, 'Morgan', 'Black', 'adipiscing@nonvestibulum.co.uk', '2147483647', 'Apdo.:928-892 Luctus Carretera', '4205 Vitae ', 7950, 363, 66747, 'Juriquilla', 'Moroleon', 'Querataro', '1931-03-13', 'D9D879CF-9D36-73BD-4E4D-833E62E8CD69'),
(105, 'Maggy', 'Carroll', 'sed.dictum.eleifend@Phasellusin.net', '2147483647', '8718 Tincidunt Calle', 'Apdo.:231-3676 Duis C.', 7595, 401, 68135, 'Juriquilla', 'Queretaro', 'Guanajuato', '1903-07-03', 'E08E8CC0-CBA3-1ED3-13F9-13AFB0EE4A49'),
(106, 'Rogan', 'Mills', 'nulla.In@gravida.edu', '2147483647', '829-924 Aliquam Calle', '5910 Et, C/', 1398, 133, 50457, 'CentroSur', 'Queretaro', 'Querataro', '1925-02-21', '2207F383-F859-095C-48AC-E31D82970A10'),
(107, 'Arsenio', 'Hays', 'hymenaeos.Mauris.ut@duiSuspendisseac.net', '2147483647', '5446 Congue. Avda.', '273-2272 Iaculis Carretera', 1826, 577, 15033, 'CentroSur', 'Queretaro', 'Guanajuato', '1971-10-28', '088C6144-D3FF-DD7A-0566-845C37B2C164'),
(108, 'Wallace', 'Avery', 'dolor@incursuset.ca', '2147483647', '9698 Faucibus Av.', 'Apdo.:729-6152 Auctor. Calle', 7159, 217, 56311, 'Juriquilla', 'Queretaro', 'Querataro', '1937-08-29', '7D1AFAA1-AD8F-1F6D-2512-17564C22FD82'),
(109, 'Patricia', 'Raymond', 'habitant.morbi@feugiattellus.ca', '1817002188', '411-1303 Auctor. Av.', 'Apartado núm.: 154, 3816 Eu Carretera', 709, 233, 30295, 'CentroSur', 'Moroleon', 'Guanajuato', '1967-02-09', '739DB81A-DACC-5B9A-DCB0-10D44BC071B0'),
(110, 'Bert', 'Williams', 'eu@nullaIntegerurna.ca', '2147483647', '6385 Duis Avenida', 'Apartado núm.: 853, 3007 Eu Calle', 6439, 33, 61038, 'Juriquilla', 'Queretaro', 'Guanajuato', '1921-10-26', '1F12700F-9B7E-832C-E711-3D475D0944C8');

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
  ADD KEY `idRespuestas` (`idRespuestas`),
  ADD KEY `estadoFormulario` (`estadoFormulario`),
  ADD KEY `estadoEntrevista` (`estadoEntrevista`),
  ADD KEY `estadoPago` (`estadoPago`);

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
  ADD KEY `idUsuario` (`idUsuario`),
  ADD KEY `idRol` (`idRol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `condiciones_medicas`
--
ALTER TABLE `condiciones_medicas`
  MODIFY `idCondicion` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `estado`
--
ALTER TABLE `estado`
  MODIFY `idEstado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `perros`
--
ALTER TABLE `perros`
  MODIFY `idPerro` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT de la tabla `privilegios`
--
ALTER TABLE `privilegios`
  MODIFY `idPrivilegio` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `respuestas`
--
ALTER TABLE `respuestas`
  MODIFY `idRespuestas` int(7) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `idRol` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
  MODIFY `idPersonalidad` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `tipo_raza`
--
ALTER TABLE `tipo_raza`
  MODIFY `idRaza` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idUsuario` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;

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
  ADD CONSTRAINT `estado_perro_ibfk_2` FOREIGN KEY (`idPerro`) REFERENCES `perros` (`idPerro`) ON DELETE NO ACTION ON UPDATE NO ACTION;

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
  ADD CONSTRAINT `idUsuario` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`),
  ADD CONSTRAINT `solicitud_ibfk_1` FOREIGN KEY (`estadoFormulario`) REFERENCES `estado` (`idEstado`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `solicitud_ibfk_2` FOREIGN KEY (`estadoEntrevista`) REFERENCES `estado` (`idEstado`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `solicitud_ibfk_3` FOREIGN KEY (`estadoPago`) REFERENCES `estado` (`idEstado`) ON DELETE CASCADE ON UPDATE CASCADE;

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
