-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 19-12-2017 a las 08:58:43
-- Versión del servidor: 10.1.21-MariaDB
-- Versión de PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `smaqpes`
--
CREATE DATABASE IF NOT EXISTS `smaqpes` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `smaqpes`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `area`
--

CREATE TABLE `area` (
  `id_area` int(10) UNSIGNED NOT NULL,
  `id_area_padre` int(10) UNSIGNED DEFAULT NULL,
  `nombre` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado` tinyint(1) NOT NULL,
  `eliminado` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `area`
--

INSERT INTO `area` (`id_area`, `id_area_padre`, `nombre`, `descripcion`, `estado`, `eliminado`, `created_at`, `updated_at`) VALUES
(1, NULL, 'DIVISION RENTAL', 'AREA DE DIVISIÓN RENTAL', 1, 0, '2017-12-19 07:27:34', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `id_cliente` int(10) UNSIGNED NOT NULL,
  `id_persona` int(10) UNSIGNED NOT NULL,
  `ruc` varchar(11) COLLATE utf8mb4_unicode_ci NOT NULL,
  `razon_social` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombre_comercial` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `direccion_cliente` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado` char(1) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'A',
  `eliminado` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_horas_mantenimiento`
--

CREATE TABLE `detalle_horas_mantenimiento` (
  `id_detalle_horas_mantenimiento` int(10) UNSIGNED NOT NULL,
  `id_horas_mantenimiento` int(10) UNSIGNED NOT NULL,
  `id_material` int(10) UNSIGNED NOT NULL,
  `id_material_proveedor` int(10) UNSIGNED NOT NULL,
  `tipo_material` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cantidad` decimal(6,2) DEFAULT NULL,
  `litros` decimal(6,2) DEFAULT NULL,
  `galones` decimal(6,2) DEFAULT NULL,
  `estado` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_registro`
--

CREATE TABLE `detalle_registro` (
  `id_detalle_registro` int(10) UNSIGNED NOT NULL,
  `id_registro` int(10) UNSIGNED NOT NULL,
  `id_material` int(10) UNSIGNED NOT NULL,
  `id_material_proveedor` int(10) UNSIGNED NOT NULL,
  `tipo_material` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cantidad` decimal(6,2) DEFAULT NULL,
  `litros` decimal(6,2) DEFAULT NULL,
  `galones` decimal(6,2) DEFAULT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  `eliminado` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horas_mantenimiento`
--

CREATE TABLE `horas_mantenimiento` (
  `id_horas_mantenimiento` int(10) UNSIGNED NOT NULL,
  `id_maquinaria` int(10) UNSIGNED NOT NULL,
  `total_horas` decimal(6,2) NOT NULL,
  `estado` char(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `horas_mantenimiento`
--

INSERT INTO `horas_mantenimiento` (`id_horas_mantenimiento`, `id_maquinaria`, `total_horas`, `estado`, `created_at`, `updated_at`) VALUES
(1, 1, '250.00', 'A', '2017-12-19 07:50:14', '2017-12-19 07:53:01');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horas_trabajadas`
--

CREATE TABLE `horas_trabajadas` (
  `id_horas_trabajadas` int(10) UNSIGNED NOT NULL,
  `id_registro` int(10) UNSIGNED NOT NULL,
  `id_personal` int(10) UNSIGNED NOT NULL,
  `horas` decimal(6,2) NOT NULL,
  `descripcion` varchar(1024) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha` datetime NOT NULL,
  `hora_inicio` time NOT NULL,
  `hora_termino` time NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `horas_trabajadas_maquinaria`
--

CREATE TABLE `horas_trabajadas_maquinaria` (
  `id_horas_trabajadas_maquinaria` int(10) UNSIGNED NOT NULL,
  `id_maquinaria` int(10) UNSIGNED NOT NULL,
  `fecha_trabajo` datetime NOT NULL,
  `hora_inicio` time DEFAULT NULL,
  `hora_termino` time DEFAULT NULL,
  `horometro` decimal(8,4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `maquinaria`
--

CREATE TABLE `maquinaria` (
  `id_maquinaria` int(10) UNSIGNED NOT NULL,
  `id_tipo_maquinaria` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `anio_fabricacion` int(11) NOT NULL,
  `marca` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `modelo` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `serie_chasis` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `serie_motor` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha_adquisicion` date NOT NULL,
  `imagen` varchar(300) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado` char(1) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'A',
  `eliminado` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `maquinaria`
--

INSERT INTO `maquinaria` (`id_maquinaria`, `id_tipo_maquinaria`, `nombre`, `anio_fabricacion`, `marca`, `modelo`, `serie_chasis`, `serie_motor`, `fecha_adquisicion`, `imagen`, `estado`, `eliminado`, `created_at`, `updated_at`) VALUES
(1, 1, 'EXCAVADORA N°1', 2009, 'KOBELCO', 'SK350LC', 'YC08U2085', 'J08E-TM12879', '2009-12-19', 'http://127.0.0.1:8000/photos/excavadora sk 350.jpg', 'A', 0, '2017-12-19 07:44:46', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `material`
--

CREATE TABLE `material` (
  `id_material` int(10) UNSIGNED NOT NULL,
  `id_tipo_material` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(70) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `codigo_interno` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado` char(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  `eliminado` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `material_proveedor`
--

CREATE TABLE `material_proveedor` (
  `id_material_proveedor` int(10) UNSIGNED NOT NULL,
  `id_material` int(10) UNSIGNED NOT NULL,
  `codigo` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombre` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `descripcion` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `precio` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_100000_create_password_resets_table', 1),
(2, '2017_10_30_000000_create_tipo_documento_table', 1),
(3, '2017_10_30_000001_create_persona_table', 1),
(4, '2017_10_30_000002_create_rol_table', 1),
(5, '2017_10_30_000003_create_area_table', 1),
(6, '2017_10_30_000004_create_personal_table', 1),
(7, '2017_10_30_000006_create_cliente_table', 1),
(8, '2017_10_30_000007_create_tipo_material_table', 1),
(9, '2017_10_30_000008_create_material_table', 1),
(10, '2017_10_30_000009_create_tipo_registro_table', 1),
(11, '2017_10_30_000010_create_tipo_maquinaria', 1),
(12, '2017_10_30_000011_create_maquinaria_table', 1),
(13, '2017_10_30_000012_create_horas_matenimiento_table', 1),
(14, '2017_10_30_000013_create_detalle_horas_mantenimiento_table', 1),
(15, '2017_10_30_000014_create_registro_table', 1),
(16, '2017_10_30_000015_create_detalle_registro_table', 1),
(17, '2017_10_30_000016_create_horas_trabajadas_table', 1),
(18, '2017_10_30_000017_create_users_table', 1),
(19, '2017_11_06_142012_create_material_proveedor', 1),
(20, '2017_12_11_231323_create_horas_trabajadas_maquinaria_table', 1),
(21, '2017_12_11_235009_create_pagina_permiso_table', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagina_permiso`
--

CREATE TABLE `pagina_permiso` (
  `id_pagina_permiso` int(10) UNSIGNED NOT NULL,
  `id_pagina_permiso_padre` int(10) UNSIGNED DEFAULT NULL,
  `id_rol` int(10) UNSIGNED NOT NULL,
  `icono` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `text` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `pagina_permiso`
--

INSERT INTO `pagina_permiso` (`id_pagina_permiso`, `id_pagina_permiso_padre`, `id_rol`, `icono`, `text`, `url`, `estado`, `created_at`, `updated_at`) VALUES
(1, NULL, 1, 'glyphicon glyphicon-star-empty', 'SISTEMA', NULL, 1, NULL, NULL),
(2, 1, 1, 'glyphicon glyphicon-certificate', 'ROLES', 'roles', 1, NULL, NULL),
(3, 1, 1, 'glyphicon glyphicon-lock', 'USUARIOS', 'usuarios', 1, NULL, NULL),
(4, 1, 1, 'glyphicon glyphicon-list', 'PÁGINAS POR ROLES', 'paginas_rol', 1, NULL, NULL),
(5, NULL, 1, 'glyphicon glyphicon-cog', 'MANTENIMIENTO', NULL, 1, NULL, NULL),
(6, 5, 1, 'glyphicon glyphicon-list-alt', 'ÁREAS', 'areas', 1, NULL, NULL),
(7, 5, 1, 'glyphicon glyphicon-user', 'PERSONAL', 'personal', 1, NULL, NULL),
(8, 5, 1, 'glyphicon glyphicon-pushpin', 'MAQUINARIAS', 'maquinarias', 1, NULL, NULL),
(9, 5, 1, 'glyphicon glyphicon-th-list', 'MATERIALES', 'materiales', 1, NULL, NULL),
(10, NULL, 1, 'glyphicon glyphicon-barcode', 'SERVICIOS', NULL, 1, NULL, NULL),
(11, 10, 1, 'glyphicon glyphicon-briefcase', 'NUEVO CLIENTE', 'clientes/create', 1, NULL, NULL),
(12, 10, 1, 'glyphicon glyphicon-menu-hamburger', 'LISTA DE CLIENTES', 'clientes', 1, NULL, NULL),
(13, 10, 1, 'glyphicon glyphicon-plus', 'NUEVO SERVICIO', 'registros/create', 1, NULL, NULL),
(14, 10, 1, 'glyphicon glyphicon-list', 'LISTAS DE SERVICIO', 'registros', 1, NULL, NULL),
(15, NULL, 1, 'glyphicon glyphicon-option-vertical', 'REPORTES', NULL, 1, NULL, NULL),
(16, 15, 1, 'glyphicon glyphicon-object-align-bottom', 'REPORTE GASTOS', 'reporte/graphics/gastos', 1, NULL, NULL),
(17, NULL, 2, 'glyphicon glyphicon-list', 'SERVICIOS', 'registros/usuario', 1, NULL, NULL),
(18, 5, 1, 'glyphicon glyphicon-list-alt', 'HORAS MANTENIMIENTO', 'horasmantenimiento', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

CREATE TABLE `persona` (
  `id_persona` int(10) UNSIGNED NOT NULL,
  `id_tipo_documento` int(10) UNSIGNED NOT NULL,
  `numero_documento` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nombres` varchar(70) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apellidos` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `direccion` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fecha_nacimiento` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `persona`
--

INSERT INTO `persona` (`id_persona`, `id_tipo_documento`, `numero_documento`, `nombres`, `apellidos`, `direccion`, `email`, `fecha_nacimiento`, `created_at`, `updated_at`) VALUES
(1, 1, '32942027', 'ROGER IVAN', 'BEDON BERNUY', NULL, NULL, NULL, '2017-12-19 07:27:34', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal`
--

CREATE TABLE `personal` (
  `id_personal` int(10) UNSIGNED NOT NULL,
  `id_persona` int(10) UNSIGNED NOT NULL,
  `id_area` int(10) UNSIGNED NOT NULL,
  `cargo` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha_contrato` date DEFAULT NULL,
  `fecha_ingreso` date DEFAULT NULL,
  `sueldo_base` decimal(10,4) NOT NULL,
  `eliminado` tinyint(1) NOT NULL DEFAULT '0',
  `estado` char(1) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'A',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `personal`
--

INSERT INTO `personal` (`id_personal`, `id_persona`, `id_area`, `cargo`, `fecha_contrato`, `fecha_ingreso`, `sueldo_base`, `eliminado`, `estado`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'GERENTE DE OPERACIONES', NULL, NULL, '1535.0000', 0, 'A', '2017-12-19 07:27:35', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registro`
--

CREATE TABLE `registro` (
  `id_registro` int(10) UNSIGNED NOT NULL,
  `id_cliente` int(10) UNSIGNED NOT NULL,
  `id_maquinaria` int(10) UNSIGNED NOT NULL,
  `id_tipo_registro` int(10) UNSIGNED NOT NULL,
  `lugar` varchar(350) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fecha_emision` datetime NOT NULL,
  `hora_inicio_mantto` time DEFAULT NULL,
  `hora_termino_mantto` time DEFAULT NULL,
  `id_horas` int(10) UNSIGNED DEFAULT NULL,
  `total_horas` decimal(10,2) DEFAULT NULL,
  `hora_salida_viaje` time DEFAULT NULL,
  `hora_llegada_viaje` time DEFAULT NULL,
  `hora_salida_retorno` time DEFAULT NULL,
  `hora_llegada_retorno` time DEFAULT NULL,
  `horometro` decimal(10,4) NOT NULL,
  `kilometraje` decimal(10,4) DEFAULT NULL,
  `estado_maquinaria` char(1) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lugar_encontrado` varchar(350) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_operador` int(10) UNSIGNED DEFAULT NULL,
  `id_mecanico` int(10) UNSIGNED NOT NULL,
  `id_jefe_responsable` int(10) UNSIGNED NOT NULL,
  `observacion` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado` char(1) COLLATE utf8mb4_unicode_ci NOT NULL,
  `eliminado` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `id_rol` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`id_rol`, `nombre`, `descripcion`, `created_at`, `updated_at`) VALUES
(1, 'ADMINISTRADOR', 'ADMINISTRADOR DEL SISTEMA', '2017-12-19 07:27:34', NULL),
(2, 'TRABAJADOR', 'TRABAJADOR DEL GRUPO CAVENAGO', '2017-12-19 07:27:34', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_documento`
--

CREATE TABLE `tipo_documento` (
  `id_tipo_documento` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(80) COLLATE utf8mb4_unicode_ci NOT NULL,
  `siglas` char(5) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `valor` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tipo_documento`
--

INSERT INTO `tipo_documento` (`id_tipo_documento`, `nombre`, `siglas`, `descripcion`, `valor`, `created_at`, `updated_at`) VALUES
(1, 'DOCUMENTO NACIONAL DE IDENTIDAD', 'DNI', NULL, '8', '2017-12-19 07:27:34', NULL),
(2, 'REGISTRO UNICO DEL CONTRIBUYENTE', 'RUC', NULL, '11', '2017-12-19 07:27:34', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_maquinaria`
--

CREATE TABLE `tipo_maquinaria` (
  `id_tipo_maquinaria` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tipo_maquinaria`
--

INSERT INTO `tipo_maquinaria` (`id_tipo_maquinaria`, `nombre`, `created_at`, `updated_at`) VALUES
(1, 'EXCAVADORA', '2017-12-19 07:27:35', NULL),
(2, 'MOTONIVELADORA', '2017-12-19 07:27:35', NULL),
(3, 'CARGADOR FRONTAL', '2017-12-19 07:27:35', NULL),
(4, 'RODILLO VIBRATORIO', '2017-12-19 07:27:35', NULL),
(5, 'RETROEXCAVADORA', '2017-12-19 07:27:35', NULL),
(6, 'MINICARGADOR', '2017-12-19 07:27:35', NULL),
(7, 'VOLQUETE', '2017-12-19 07:27:35', NULL),
(8, 'CISTERNA', '2017-12-19 07:27:35', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_material`
--

CREATE TABLE `tipo_material` (
  `id_tipo_material` int(10) UNSIGNED NOT NULL,
  `id_tipo_material_padre` int(11) DEFAULT NULL,
  `nombre` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` varchar(350) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tipo_material`
--

INSERT INTO `tipo_material` (`id_tipo_material`, `id_tipo_material_padre`, `nombre`, `descripcion`, `created_at`, `updated_at`) VALUES
(1, NULL, 'FILTROS', NULL, '2017-12-19 07:27:36', NULL),
(2, NULL, 'ACEITES', NULL, '2017-12-19 07:27:36', NULL),
(3, NULL, 'REPUESTOS', NULL, '2017-12-19 07:27:36', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_registro`
--

CREATE TABLE `tipo_registro` (
  `id_tipo_registro` int(10) UNSIGNED NOT NULL,
  `nombre` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `tipo_registro`
--

INSERT INTO `tipo_registro` (`id_tipo_registro`, `nombre`, `descripcion`, `estado`, `created_at`, `updated_at`) VALUES
(1, 'MANTENIMIENTO PREVENTIVO', NULL, 1, '2017-12-19 07:27:36', NULL),
(2, 'MANTENIMIENTO CORRECTIVO', NULL, 1, '2017-12-19 07:27:36', NULL),
(3, 'MANTENIMIENTO PREDICTIVO', NULL, 1, '2017-12-19 07:27:36', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_rol` int(10) UNSIGNED DEFAULT NULL,
  `id_personal` int(10) UNSIGNED DEFAULT NULL,
  `estado` enum('ACTIVO','INACTIVO','BLOQUEADO') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'INACTIVO',
  `eliminado` tinyint(1) NOT NULL DEFAULT '0',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `name`, `email`, `password`, `id_rol`, `id_personal`, `estado`, `eliminado`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'ROGER IVAN', 'ROGER', '$2y$10$ajiEUC41KiR6GXm56dBuCemGIwrSpBS54vZxOTqMBClRxCNMYzyFy', 1, 1, 'ACTIVO', 0, NULL, '2017-12-19 07:27:35', NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `area`
--
ALTER TABLE `area`
  ADD PRIMARY KEY (`id_area`),
  ADD KEY `area_id_area_padre_foreign` (`id_area_padre`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id_cliente`),
  ADD KEY `cliente_id_persona_foreign` (`id_persona`);

--
-- Indices de la tabla `detalle_horas_mantenimiento`
--
ALTER TABLE `detalle_horas_mantenimiento`
  ADD PRIMARY KEY (`id_detalle_horas_mantenimiento`),
  ADD KEY `detalle_horas_mantenimiento_id_material_foreign` (`id_material`),
  ADD KEY `detalle_horas_mantenimiento_id_horas_mantenimiento_foreign` (`id_horas_mantenimiento`);

--
-- Indices de la tabla `detalle_registro`
--
ALTER TABLE `detalle_registro`
  ADD PRIMARY KEY (`id_detalle_registro`),
  ADD KEY `detalle_registro_id_registro_foreign` (`id_registro`),
  ADD KEY `detalle_registro_id_material_foreign` (`id_material`);

--
-- Indices de la tabla `horas_mantenimiento`
--
ALTER TABLE `horas_mantenimiento`
  ADD PRIMARY KEY (`id_horas_mantenimiento`),
  ADD KEY `horas_mantenimiento_id_maquinaria_foreign` (`id_maquinaria`);

--
-- Indices de la tabla `horas_trabajadas`
--
ALTER TABLE `horas_trabajadas`
  ADD PRIMARY KEY (`id_horas_trabajadas`),
  ADD KEY `horas_trabajadas_id_registro_foreign` (`id_registro`),
  ADD KEY `horas_trabajadas_id_personal_foreign` (`id_personal`);

--
-- Indices de la tabla `horas_trabajadas_maquinaria`
--
ALTER TABLE `horas_trabajadas_maquinaria`
  ADD PRIMARY KEY (`id_horas_trabajadas_maquinaria`),
  ADD KEY `horas_trabajadas_maquinaria_id_maquinaria_foreign` (`id_maquinaria`);

--
-- Indices de la tabla `maquinaria`
--
ALTER TABLE `maquinaria`
  ADD PRIMARY KEY (`id_maquinaria`),
  ADD KEY `maquinaria_id_tipo_maquinaria_foreign` (`id_tipo_maquinaria`);

--
-- Indices de la tabla `material`
--
ALTER TABLE `material`
  ADD PRIMARY KEY (`id_material`),
  ADD KEY `material_id_tipo_material_foreign` (`id_tipo_material`);

--
-- Indices de la tabla `material_proveedor`
--
ALTER TABLE `material_proveedor`
  ADD PRIMARY KEY (`id_material_proveedor`),
  ADD KEY `material_proveedor_id_material_foreign` (`id_material`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pagina_permiso`
--
ALTER TABLE `pagina_permiso`
  ADD PRIMARY KEY (`id_pagina_permiso`),
  ADD KEY `pagina_permiso_id_pagina_permiso_padre_foreign` (`id_pagina_permiso_padre`),
  ADD KEY `pagina_permiso_id_rol_foreign` (`id_rol`);

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indices de la tabla `persona`
--
ALTER TABLE `persona`
  ADD PRIMARY KEY (`id_persona`),
  ADD KEY `persona_id_tipo_documento_foreign` (`id_tipo_documento`);

--
-- Indices de la tabla `personal`
--
ALTER TABLE `personal`
  ADD PRIMARY KEY (`id_personal`),
  ADD KEY `personal_id_persona_foreign` (`id_persona`),
  ADD KEY `personal_id_area_foreign` (`id_area`);

--
-- Indices de la tabla `registro`
--
ALTER TABLE `registro`
  ADD PRIMARY KEY (`id_registro`),
  ADD KEY `registro_id_cliente_foreign` (`id_cliente`),
  ADD KEY `registro_id_maquinaria_foreign` (`id_maquinaria`),
  ADD KEY `registro_id_tipo_registro_foreign` (`id_tipo_registro`),
  ADD KEY `registro_id_horas_foreign` (`id_horas`),
  ADD KEY `registro_id_operador_foreign` (`id_operador`),
  ADD KEY `registro_id_mecanico_foreign` (`id_mecanico`),
  ADD KEY `registro_id_jefe_responsable_foreign` (`id_jefe_responsable`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`id_rol`);

--
-- Indices de la tabla `tipo_documento`
--
ALTER TABLE `tipo_documento`
  ADD PRIMARY KEY (`id_tipo_documento`);

--
-- Indices de la tabla `tipo_maquinaria`
--
ALTER TABLE `tipo_maquinaria`
  ADD PRIMARY KEY (`id_tipo_maquinaria`);

--
-- Indices de la tabla `tipo_material`
--
ALTER TABLE `tipo_material`
  ADD PRIMARY KEY (`id_tipo_material`);

--
-- Indices de la tabla `tipo_registro`
--
ALTER TABLE `tipo_registro`
  ADD PRIMARY KEY (`id_tipo_registro`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `usuario_email_unique` (`email`),
  ADD KEY `usuario_id_rol_foreign` (`id_rol`),
  ADD KEY `usuario_id_personal_foreign` (`id_personal`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `area`
--
ALTER TABLE `area`
  MODIFY `id_area` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id_cliente` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `detalle_horas_mantenimiento`
--
ALTER TABLE `detalle_horas_mantenimiento`
  MODIFY `id_detalle_horas_mantenimiento` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `detalle_registro`
--
ALTER TABLE `detalle_registro`
  MODIFY `id_detalle_registro` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `horas_mantenimiento`
--
ALTER TABLE `horas_mantenimiento`
  MODIFY `id_horas_mantenimiento` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `horas_trabajadas`
--
ALTER TABLE `horas_trabajadas`
  MODIFY `id_horas_trabajadas` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `horas_trabajadas_maquinaria`
--
ALTER TABLE `horas_trabajadas_maquinaria`
  MODIFY `id_horas_trabajadas_maquinaria` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `maquinaria`
--
ALTER TABLE `maquinaria`
  MODIFY `id_maquinaria` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `material`
--
ALTER TABLE `material`
  MODIFY `id_material` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `material_proveedor`
--
ALTER TABLE `material_proveedor`
  MODIFY `id_material_proveedor` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT de la tabla `pagina_permiso`
--
ALTER TABLE `pagina_permiso`
  MODIFY `id_pagina_permiso` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT de la tabla `persona`
--
ALTER TABLE `persona`
  MODIFY `id_persona` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `personal`
--
ALTER TABLE `personal`
  MODIFY `id_personal` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `registro`
--
ALTER TABLE `registro`
  MODIFY `id_registro` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `id_rol` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `tipo_documento`
--
ALTER TABLE `tipo_documento`
  MODIFY `id_tipo_documento` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `tipo_maquinaria`
--
ALTER TABLE `tipo_maquinaria`
  MODIFY `id_tipo_maquinaria` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT de la tabla `tipo_material`
--
ALTER TABLE `tipo_material`
  MODIFY `id_tipo_material` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `tipo_registro`
--
ALTER TABLE `tipo_registro`
  MODIFY `id_tipo_registro` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `area`
--
ALTER TABLE `area`
  ADD CONSTRAINT `area_id_area_padre_foreign` FOREIGN KEY (`id_area_padre`) REFERENCES `area` (`id_area`);

--
-- Filtros para la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD CONSTRAINT `cliente_id_persona_foreign` FOREIGN KEY (`id_persona`) REFERENCES `persona` (`id_persona`);

--
-- Filtros para la tabla `detalle_horas_mantenimiento`
--
ALTER TABLE `detalle_horas_mantenimiento`
  ADD CONSTRAINT `detalle_horas_mantenimiento_id_horas_mantenimiento_foreign` FOREIGN KEY (`id_horas_mantenimiento`) REFERENCES `horas_mantenimiento` (`id_horas_mantenimiento`),
  ADD CONSTRAINT `detalle_horas_mantenimiento_id_material_foreign` FOREIGN KEY (`id_material`) REFERENCES `material` (`id_material`);

--
-- Filtros para la tabla `detalle_registro`
--
ALTER TABLE `detalle_registro`
  ADD CONSTRAINT `detalle_registro_id_material_foreign` FOREIGN KEY (`id_material`) REFERENCES `material` (`id_material`),
  ADD CONSTRAINT `detalle_registro_id_registro_foreign` FOREIGN KEY (`id_registro`) REFERENCES `registro` (`id_registro`);

--
-- Filtros para la tabla `horas_mantenimiento`
--
ALTER TABLE `horas_mantenimiento`
  ADD CONSTRAINT `horas_mantenimiento_id_maquinaria_foreign` FOREIGN KEY (`id_maquinaria`) REFERENCES `maquinaria` (`id_maquinaria`);

--
-- Filtros para la tabla `horas_trabajadas`
--
ALTER TABLE `horas_trabajadas`
  ADD CONSTRAINT `horas_trabajadas_id_personal_foreign` FOREIGN KEY (`id_personal`) REFERENCES `personal` (`id_personal`),
  ADD CONSTRAINT `horas_trabajadas_id_registro_foreign` FOREIGN KEY (`id_registro`) REFERENCES `registro` (`id_registro`);

--
-- Filtros para la tabla `horas_trabajadas_maquinaria`
--
ALTER TABLE `horas_trabajadas_maquinaria`
  ADD CONSTRAINT `horas_trabajadas_maquinaria_id_maquinaria_foreign` FOREIGN KEY (`id_maquinaria`) REFERENCES `maquinaria` (`id_maquinaria`);

--
-- Filtros para la tabla `maquinaria`
--
ALTER TABLE `maquinaria`
  ADD CONSTRAINT `maquinaria_id_tipo_maquinaria_foreign` FOREIGN KEY (`id_tipo_maquinaria`) REFERENCES `tipo_maquinaria` (`id_tipo_maquinaria`);

--
-- Filtros para la tabla `material`
--
ALTER TABLE `material`
  ADD CONSTRAINT `material_id_tipo_material_foreign` FOREIGN KEY (`id_tipo_material`) REFERENCES `tipo_material` (`id_tipo_material`);

--
-- Filtros para la tabla `material_proveedor`
--
ALTER TABLE `material_proveedor`
  ADD CONSTRAINT `material_proveedor_id_material_foreign` FOREIGN KEY (`id_material`) REFERENCES `material` (`id_material`);

--
-- Filtros para la tabla `pagina_permiso`
--
ALTER TABLE `pagina_permiso`
  ADD CONSTRAINT `pagina_permiso_id_pagina_permiso_padre_foreign` FOREIGN KEY (`id_pagina_permiso_padre`) REFERENCES `pagina_permiso` (`id_pagina_permiso`),
  ADD CONSTRAINT `pagina_permiso_id_rol_foreign` FOREIGN KEY (`id_rol`) REFERENCES `rol` (`id_rol`);

--
-- Filtros para la tabla `persona`
--
ALTER TABLE `persona`
  ADD CONSTRAINT `persona_id_tipo_documento_foreign` FOREIGN KEY (`id_tipo_documento`) REFERENCES `tipo_documento` (`id_tipo_documento`);

--
-- Filtros para la tabla `personal`
--
ALTER TABLE `personal`
  ADD CONSTRAINT `personal_id_area_foreign` FOREIGN KEY (`id_area`) REFERENCES `area` (`id_area`),
  ADD CONSTRAINT `personal_id_persona_foreign` FOREIGN KEY (`id_persona`) REFERENCES `persona` (`id_persona`);

--
-- Filtros para la tabla `registro`
--
ALTER TABLE `registro`
  ADD CONSTRAINT `registro_id_cliente_foreign` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id_cliente`),
  ADD CONSTRAINT `registro_id_horas_foreign` FOREIGN KEY (`id_horas`) REFERENCES `horas_mantenimiento` (`id_horas_mantenimiento`),
  ADD CONSTRAINT `registro_id_jefe_responsable_foreign` FOREIGN KEY (`id_jefe_responsable`) REFERENCES `personal` (`id_personal`),
  ADD CONSTRAINT `registro_id_maquinaria_foreign` FOREIGN KEY (`id_maquinaria`) REFERENCES `maquinaria` (`id_maquinaria`),
  ADD CONSTRAINT `registro_id_mecanico_foreign` FOREIGN KEY (`id_mecanico`) REFERENCES `personal` (`id_personal`),
  ADD CONSTRAINT `registro_id_operador_foreign` FOREIGN KEY (`id_operador`) REFERENCES `personal` (`id_personal`),
  ADD CONSTRAINT `registro_id_tipo_registro_foreign` FOREIGN KEY (`id_tipo_registro`) REFERENCES `tipo_registro` (`id_tipo_registro`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_id_personal_foreign` FOREIGN KEY (`id_personal`) REFERENCES `personal` (`id_personal`),
  ADD CONSTRAINT `usuario_id_rol_foreign` FOREIGN KEY (`id_rol`) REFERENCES `rol` (`id_rol`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
