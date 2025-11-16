-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-11-2025 a las 00:09:39
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
-- Base de datos: `appdewebdl`
--
CREATE DATABASE IF NOT EXISTS `appdewebdl` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `appdewebdl`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) DEFAULT '',
  `correo` varchar(150) NOT NULL,
  `estado` enum('PENDIENTE','ACTIVO','INACTIVO') DEFAULT 'PENDIENTE',
  `fecha_de_actualizacion` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `perfil` enum('ADMIN','USUARIO') DEFAULT 'USUARIO',
  `contrasena` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `apellido`, `correo`, `estado`, `fecha_de_actualizacion`, `perfil`, `contrasena`) VALUES
(2, 'Andres', 'Iza', 'admin@admin.com1', 'ACTIVO', '2025-11-16 19:05:07', 'USUARIO', '$2y$10$tX3rO2pydOfop98JXO77MuNONnz1gnUQIk/RKtuQx3TtopU4FobxO'),
(3, 'Diego', 'Limaico', 'admin@admin.com', 'ACTIVO', '2025-11-16 19:25:51', 'ADMIN', '$2y$10$byUr/ix1qLw2Qem5n8vu8ufPAt4H1ThtT86jrx7Pa/zLPlgY/v2Pa'),
(4, 'Camila', 'Torres', 'camila@admin.com', 'PENDIENTE', '2025-11-16 20:49:56', 'USUARIO', '$2y$10$ubglY8TjFG79bwZiYpc/wuKttL7VKXc5WNDUHhbDgslv4xo1Bwmqq'),
(5, 'Cristian', 'Rojas', 'crojas@admin.com', 'PENDIENTE', '2025-11-16 20:50:38', 'USUARIO', '$2y$10$ua5/Q5ke2g9GrosltF48hefR7FBANZjjb5ZeFmz29eiF4LJYG6M6a'),
(6, 'Andres', 'Iza', 'aiza@admin.com', 'PENDIENTE', '2025-11-16 20:53:15', 'USUARIO', '$2y$10$3MWu54RM/Gf9390lz3M2QO/hjVUtLNpkm51NDB1KpYiyxZXpgfbxm'),
(7, 'Andres', 'Iza', 'admin12@admin.com', 'PENDIENTE', '2025-11-16 23:00:01', 'USUARIO', '$2y$10$h5raObe2q1nFOrS6PuxXMOyMk8jE91rJxhvlun3XB2vFPV9qlTFkG');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `correo` (`correo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
