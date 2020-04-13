-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-04-2020 a las 00:56:03
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

--
-- Volcado de datos para la tabla `privilegios`
--

INSERT INTO `privilegios` (`idPrivilegio`, `privilegio`, `descripcion`) VALUES
(1, 'ver', 'Usuario puede navegar la pagina '),
(2, 'adoptar', ''),
(3, 'registrar', ''),
(4, 'editar', '');

--
-- Volcado de datos para la tabla `privilegio_rol`
--

INSERT INTO `privilegio_rol` (`idPrivilegio`, `idRol`, `fechaCreacion`) VALUES
(1, 3, '2020-04-13 22:54:52'),
(2, 3, '2020-04-13 22:54:52'),
(3, 2, '2020-04-13 22:55:10'),
(4, 1, '2020-04-13 22:55:10');

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`idRol`, `rol`, `descripcion`) VALUES
(1, 'admin', 'Administrador de la pagina'),
(2, 'operador', 'Personas de servicio social/ voluntarios'),
(3, 'registrado', 'Usuario que ha creado cuenta');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
