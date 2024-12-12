-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-12-2024 a las 05:52:06
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
-- Base de datos: `blogbox`
--
CREATE DATABASE IF NOT EXISTS `blogbox` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `blogbox`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `comments`
--

INSERT INTO `comments` (`id`, `post_id`, `content`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 1, 'Muy interesante este post. quiero saber más del tema', 6, '2024-12-03 23:22:01', '2024-12-03 23:22:01'),
(2, 1, 'Esto es de mucha ayuda', 6, '2024-12-03 23:26:13', '2024-12-03 23:26:13'),
(3, 1, 'Esto es de mucha ayuda', 6, '2024-12-03 23:28:38', '2024-12-03 23:28:38'),
(4, 1, 'Esto es de mucha ayuda una vez más', 6, '2024-12-03 23:30:02', '2024-12-03 23:30:02');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `title` varchar(250) NOT NULL,
  `content` text NOT NULL,
  `author_id` int(11) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `posts`
--

INSERT INTO `posts` (`id`, `title`, `content`, `author_id`, `created_at`, `updated_at`) VALUES
(1, '¿Qué es Lorem Ipsum?', 'Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, cuando un impresor (N. del T. persona que se dedica a la imprenta) desconocido usó una galería de textos y los mezcló de tal manera que logró hacer un libro de textos especimen. No sólo sobrevivió 500 años, sino que tambien ingresó como texto de relleno en documentos electrónicos, quedando esencialmente igual al original. Fue popularizado en los 60s con la creación de las hojas Letraset, las cuales contenian pasajes de Lorem Ipsum, y más recientemente con software de autoedición, como por ejemplo Aldus PageMaker, el cual incluye versiones de Lorem Ipsum.', 6, '2024-12-02 23:22:16', '2024-12-02 23:22:16'),
(2, 'Lorem 1', 'Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, cuando un impresor (N. del T. persona que se dedica a la imprenta) desconocido usó una galería de textos y los mezcló de tal manera que logró hacer un libro de textos especimen. No sólo sobrevivió 500 años, sino que tambien ingresó como texto de relleno en documentos electrónicos, quedando esencialmente igual al original. Fue popularizado en los 60s con la creación de las hojas Letraset, las cuales contenian pasajes de Lorem Ipsum, y más recientemente con software de autoedición, como por ejemplo Aldus PageMaker, el cual incluye versiones de Lorem Ipsum.', 3, '2024-12-02 23:23:25', '2024-12-02 23:25:19'),
(3, 'Lorem Ipsum', 'Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, cuando un impresor (N. del T. persona que se dedica a la imprenta) desconocido usó una galería de textos y los mezcló de tal manera que logró hacer un libro de textos especimen. No sólo sobrevivió 500 años, sino que tambien ingresó como texto de relleno en documentos electrónicos, quedando esencialmente igual al original. Fue popularizado en los 60s con la creación de las hojas Letraset, las cuales contenian pasajes de Lorem Ipsum, y más recientemente con software de autoedición, como por ejemplo Aldus PageMaker, el cual incluye versiones de Lorem Ipsum.', 2, '2024-12-02 23:23:39', '2024-12-02 23:23:39'),
(4, 'Ipsum', 'Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, cuando un impresor (N. del T. persona que se dedica a la imprenta) desconocido usó una galería de textos y los mezcló de tal manera que logró hacer un libro de textos especimen. No sólo sobrevivió 500 años, sino que tambien ingresó como texto de relleno en documentos electrónicos, quedando esencialmente igual al original. Fue popularizado en los 60s con la creación de las hojas Letraset, las cuales contenian pasajes de Lorem Ipsum, y más recientemente con software de autoedición, como por ejemplo Aldus PageMaker, el cual incluye versiones de Lorem Ipsum.', 6, '2024-12-02 23:28:55', '2024-12-02 23:28:55');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','author') NOT NULL DEFAULT 'author',
  `timezone` varchar(50) DEFAULT 'UTC',
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `password`, `role`, `timezone`, `created_at`, `updated_at`) VALUES
(1, 'Author 1', 'admin@example.com', '1234567890', '$2y$10$QwUQm3lQOrwOSa1/7jB96u9F6X9C8gyTevMkF69xfHbMJeuPHUF5u', 'author', 'America/Bogota', '2024-11-30 23:26:03', '2024-12-02 23:23:01'),
(2, 'Author 2', 'operator1@example.com', '2345678901', '$2y$10$QwUQm3lQOrwOSa1/7jB96u9F6X9C8gyTevMkF69xfHbMJeuPHUF5u', 'author', 'America/Bogota', '2024-11-30 23:26:03', '2024-12-02 23:23:04'),
(3, 'Author 3', 'operator2@example.com', '3456789012', '$2y$10$QwUQm3lQOrwOSa1/7jB96u9F6X9C8gyTevMkF69xfHbMJeuPHUF5u', 'author', 'America/Bogota', '2024-11-30 23:26:03', '2024-12-02 23:23:07'),
(4, 'Author 4', 'user1@example.com', '4567890123', '$2y$10$QwUQm3lQOrwOSa1/7jB96u9F6X9C8gyTevMkF69xfHbMJeuPHUF5u', 'author', 'America/Bogota', '2024-11-30 23:26:03', '2024-12-02 23:23:10'),
(5, 'Author 5', 'user2@example.com', '5678901234', '$2y$10$QwUQm3lQOrwOSa1/7jB96u9F6X9C8gyTevMkF69xfHbMJeuPHUF5u', 'author', 'America/Bogota', '2024-11-30 23:26:03', '2024-12-02 23:23:14'),
(6, 'Eliezer Navarro Pérez', 'eneperezv@gmail.com', '3016545845', '$2y$10$rpMFEwZcLidRPgkFahqAnuuQhQRogy3rpmOFmYQ0EBqXO.q4MJqzO', 'admin', 'America/Bogota', '2024-12-01 18:25:54', '2024-12-01 18:35:14');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `votes`
--

CREATE TABLE `votes` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `option` enum('UP','DOWN') NOT NULL DEFAULT 'UP',
  `user_id` int(11) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `votes`
--

INSERT INTO `votes` (`id`, `post_id`, `option`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 1, 'UP', 6, '2024-12-03 23:20:35', '2024-12-03 23:20:35'),
(2, 1, 'DOWN', 6, '2024-12-03 23:22:34', '2024-12-03 23:22:34'),
(3, 1, 'DOWN', 6, '2024-12-03 23:25:48', '2024-12-03 23:25:48'),
(4, 1, 'UP', 6, '2024-12-03 23:25:55', '2024-12-03 23:25:55'),
(5, 1, 'UP', 6, '2024-12-03 23:25:57', '2024-12-03 23:25:57');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indices de la tabla `votes`
--
ALTER TABLE `votes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `votes`
--
ALTER TABLE `votes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
