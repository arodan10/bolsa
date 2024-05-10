-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-05-2024 a las 18:00:11
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bd_bolsa`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresas`
--

CREATE TABLE `empresas` (
  `id` int(11) NOT NULL,
  `razon_social` varchar(255) NOT NULL,
  `ruc` varchar(11) NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `correo` varchar(100) NOT NULL,
  `id_rol` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `empresas`
--

INSERT INTO `empresas` (`id`, `razon_social`, `ruc`, `direccion`, `telefono`, `correo`, `id_rol`, `id_usuario`) VALUES
(1, 'UPeU', '34634634', 'los campos 300', '5685685685', 'asd@gmail.com', 0, 1),
(6, 'Union', '56757567', 'aviacion 500', '457457', 'asdasd@gmail.com', 0, 2),
(7, 'Cocacola', '123456789', 'Avenida Siempre Viva 456', '123456789', 'contacto@empresax.com', 0, 3),
(8, 'Inca kola', '23456789012', 'Plaza Central 789', '987654321', 'servicio@companiaz.com', 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `oferta_laboral`
--

CREATE TABLE `oferta_laboral` (
  `id` int(11) NOT NULL,
  `id_empresa` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `descripcion` text NOT NULL,
  `fecha_publicacion` date NOT NULL,
  `fecha_cierre` date NOT NULL,
  `remuneracion` decimal(10,2) DEFAULT NULL,
  `ubicacion` varchar(255) NOT NULL,
  `tipo` enum('presencial','remoto') NOT NULL,
  `limite_postulante` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `oferta_laboral`
--

INSERT INTO `oferta_laboral` (`id`, `id_empresa`, `titulo`, `descripcion`, `fecha_publicacion`, `fecha_cierre`, `remuneracion`, `ubicacion`, `tipo`, `limite_postulante`) VALUES
(2, 1, 'asdasdasdasdqwe', 'asddddddddd', '2024-04-25', '2024-04-26', 123123.00, 'lejos', 'presencial', 2),
(4, 1, 'asd', 'asd', '2024-05-02', '2024-05-10', 0.00, 'asd', 'presencial', 123),
(5, 6, 'asd', 'asdasdasd', '2024-05-02', '2024-05-17', 123123.00, 'Juliaca', 'remoto', 12);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `postulaciones`
--

CREATE TABLE `postulaciones` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_oferta` int(11) NOT NULL,
  `fecha_hora_postulante` timestamp NOT NULL DEFAULT current_timestamp(),
  `estado_actual` enum('pendiente','aceptado','rechazado') NOT NULL DEFAULT 'pendiente',
  `usuario_seleccionado` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `postulaciones`
--

INSERT INTO `postulaciones` (`id`, `id_usuario`, `id_oferta`, `fecha_hora_postulante`, `estado_actual`, `usuario_seleccionado`) VALUES
(1, 1, 4, '2024-05-02 18:52:57', 'pendiente', NULL),
(16, 3, 2, '2024-05-03 02:01:27', 'pendiente', NULL),
(18, 3, 5, '2024-05-06 23:56:26', 'pendiente', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombres` varchar(255) NOT NULL,
  `apellidos` varchar(255) NOT NULL,
  `dni` varchar(8) NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `usuario` varchar(50) NOT NULL,
  `contrasenia` varchar(255) NOT NULL,
  `id_rol` int(11) NOT NULL,
  `ruta_foto` varchar(255) DEFAULT NULL,
  `ruta_cv` varchar(255) DEFAULT NULL,
  `asignacion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombres`, `apellidos`, `dni`, `direccion`, `telefono`, `usuario`, `contrasenia`, `id_rol`, `ruta_foto`, `ruta_cv`, `asignacion`) VALUES
(1, 'Daniel', 'Aro', '1234567', 'asdasd', '987654321', 'admin', '123456', 1, NULL, NULL, 1),
(2, 'Jhamil', 'Apaza', '56457457', 'Miraflores', '123123', 'empresa', '123456', 2, NULL, NULL, 1),
(3, 'Morelia', 'Oblitas', '345345', 'Villa Maria', '567567567', 'postulante', '123456', 3, NULL, '', 1),
(8, 'user', 'user', '12345678', 'lejos', '987123456', 'user', '123456', 0, NULL, '../cvs/3bf9b387675e244828c5bdc8c88759f1.pdf', 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `empresas`
--
ALTER TABLE `empresas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `oferta_laboral`
--
ALTER TABLE `oferta_laboral`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_empresa` (`id_empresa`);

--
-- Indices de la tabla `postulaciones`
--
ALTER TABLE `postulaciones`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_oferta` (`id_oferta`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_rol` (`id_rol`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `empresas`
--
ALTER TABLE `empresas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `oferta_laboral`
--
ALTER TABLE `oferta_laboral`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `postulaciones`
--
ALTER TABLE `postulaciones`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
