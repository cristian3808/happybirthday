-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-02-2025 a las 16:48:01
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
-- Base de datos: `cumpleaniostf`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `admin`
--

INSERT INTO `admin` (`id`, `usuario`, `password`) VALUES
(1, 'Admin', '$2y$10$6y3UnxJMY5POqmiHwjpNWOG43JNCRZF7n4Zq5b4dtJrYwVasDOK/C');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `fecha_nacimiento` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `apellido`, `email`, `fecha_nacimiento`) VALUES
(20, 'Manuel Antonio', 'Tibaquira Naranjo', 'manueltibaquira@tfauditores.com', '1959-03-29'),
(21, 'Clara Virginia', 'Forero Rojas ', 'claravirginiaforero@tfauditores.com', '1961-02-24'),
(22, 'Luis Carlos', 'Chavarro Palacios', 'luis.chavarro@tfauditores.com', '1950-10-03'),
(23, 'Hernan Mauricio', 'Carreno Beltran', 'hernan.carrenob@tfauditores.com', '1985-02-17'),
(24, 'Jairo Saul', 'Rincon Baez', 'jairo.rincon@tfauditores.com', '1965-11-14'),
(25, 'Luisa Fernanda', 'Riveros Fraile', 'luisa.riveros@tfauditores.com', '1989-02-13'),
(26, 'Victor Armando', 'Gonzalez Plata', 'victor.gonzalez@tfauditores.com', '1982-11-26'),
(27, 'Deisy', 'Mendivelso Torres', 'deisy.mendivelso@tfauditores.com', '1983-10-15'),
(28, 'Rosario', 'Romero', 'ROSARIO23.ROMERO@hotmail.com', '1973-08-23'),
(29, 'Herman', 'Villamarin Castaneda', 'herman.villamarin@tfauditores.com', '1973-11-21'),
(30, 'Yenny Yanibe', 'Lopez Morales', 'yenny.lopez@tfauditores.com', '1983-01-05'),
(31, 'Deisa', 'Cardenas Romero', 'recepcion@tfauditores.com', '1981-01-11'),
(32, 'Clara Yolanda', 'Chaparro Barrera', 'clara.chaparro@tfauditores.com', '1972-05-13'),
(33, 'Manuel Esteban', 'Tibaquira Forero', 'esteban.tibaquira@tfauditores.com', '1982-07-20'),
(34, 'Laura Cristina', 'Tibaquira Forero', 'laura.tibaquira@tfauditores.com', '1988-08-31'),
(35, 'Luis Antonio', 'Rojas Salcedo', 'luis.rojas@tfauditores.com', '1993-02-15'),
(36, 'Mario Rodolfo', 'Acosta Navarrete', 'mario.acosta@tfauditores.com', '1992-01-05'),
(37, 'Diana Marcela', 'Rubiano Sepulveda', 'diana.rubiano@tfauditores.com', '1981-11-27'),
(38, 'Jesica Dayana', 'Achury Quevedo', 'jesica.achury@tfauditores.com', '1992-11-10'),
(39, 'Jesus Eduardo', 'Plata Garcia', 'jesus.plata@tfauditores.com', '1989-05-02'),
(40, 'Edgar Alberto', 'Gaitan Fajardo', 'edgar.gaitan@tfauditores.com', '1972-03-30'),
(41, 'Adriana Patricia', 'Tibaquira Campos', 'adriana.tibaquira@tfauditores.com', '1983-05-29'),
(42, 'Raul Antonio', 'Ballen Hernandez', 'raul.ballen@tfauditores.com', '1982-01-16'),
(43, 'Juan Sebastian', 'Chia Montaña', 'hseq@tfauditores.com', '1992-01-12'),
(44, 'Andres David', 'Ortiz Valencia', 'seleccion@tfauditores.com', '1991-09-20'),
(45, 'Laura Daniela', 'Joya Oicatá', 'laura.joya@tfauditores.com', '2000-01-24'),
(46, 'Cristian Alejandro', 'Jiménez Mora', 'cristian.jimenez@tfauditores.net ', '2005-02-08'),
(47, 'Nesler Ricardo', 'Luna Ovalles', 'nesler.luna@gmail.com', '1987-03-30'),
(48, 'Andres Felipe', 'Arteaga Ballesteros', 'felipe.arteaga@tfauditores.com', '2000-08-28'),
(49, 'Liliana ', 'Sissa Pinzon ', 'liliana.sissa@tfauditores.net', '1985-08-17'),
(50, 'Francisco Josue ', 'Florez Torrado', 'francisco.florez@tfauditores.net', '1999-02-17'),
(51, 'Ivan Alberto ', 'Posada Ospina', 'IVAN.POSADA@tfauditores.net', '1985-04-23'),
(52, 'John Jair ', 'Castañeda Hernandez', 'jonh.castaneda@tfauditores.net', '1982-11-23'),
(53, 'Wilmer Leonel', 'Pinzon Rueda', 'wpinzonr@gmail.com', '1982-12-07');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
