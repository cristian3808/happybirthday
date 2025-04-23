-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 23-04-2025 a las 22:02:09
-- Versión del servidor: 10.11.10-MariaDB
-- Versión de PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `u498964512_cumpleaniostf`
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
-- Estructura de tabla para la tabla `envios_cumpleanos`
--

CREATE TABLE `envios_cumpleanos` (
  `id` int(11) NOT NULL,
  `usuario_email` varchar(255) NOT NULL,
  `fecha_envio` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `envios_cumpleanos`
--

INSERT INTO `envios_cumpleanos` (`id`, `usuario_email`, `fecha_envio`) VALUES
(1, 'correo@ejemplo.com', '2025-04-02'),
(2, 'correo@ejemplo.com', '2025-04-04'),
(3, 'correo@ejemplo.com', '2025-04-05'),
(4, 'correo@ejemplo.com', '2025-04-06'),
(5, 'correo@ejemplo.com', '2025-04-07'),
(7, 'correo@ejemplo.com', '2025-04-08'),
(8, 'correo@ejemplo.com', '2025-04-09'),
(9, 'correo@ejemplo.com', '2025-04-10'),
(10, 'correo@ejemplo.com', '2025-04-11'),
(11, 'correo@ejemplo.com', '2025-04-15'),
(12, 'correo@ejemplo.com', '2025-04-21'),
(13, 'correo@ejemplo.com', '2025-04-22'),
(14, 'correo@ejemplo.com', '2025-04-23');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `envios_dia_hombre`
--

CREATE TABLE `envios_dia_hombre` (
  `id` int(11) NOT NULL,
  `usuario_email` varchar(255) NOT NULL,
  `fecha_envio` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `envios_dia_hombre`
--

INSERT INTO `envios_dia_hombre` (`id`, `usuario_email`, `fecha_envio`) VALUES
(241, 'manueltibaquira@tfauditores.com', '2025-04-23'),
(242, 'luis.chavarro@tfauditores.com', '2025-04-23'),
(243, 'hernan.carrenob@tfauditores.com', '2025-04-23'),
(244, 'jairo.rincon@tfauditores.com', '2025-04-23'),
(245, 'victor.gonzalez@tfauditores.com', '2025-04-23'),
(246, 'herman.villamarin@tfauditores.com', '2025-04-23'),
(247, 'esteban.tibaquira@tfauditores.com', '2025-04-23'),
(248, 'luis.rojas@tfauditores.com', '2025-04-23'),
(249, 'mario.acosta@tfauditores.com', '2025-04-23'),
(250, 'jesus.plata@tfauditores.com', '2025-04-23'),
(251, 'edgar.gaitan@tfauditores.com', '2025-04-23'),
(252, 'raul.ballen@tfauditores.com', '2025-04-23'),
(253, 'hseq@tfauditores.com', '2025-04-23'),
(254, 'seleccion@tfauditores.com', '2025-04-23'),
(255, 'cristian.jimenez@tfauditores.net ', '2025-04-23'),
(256, 'nesler.luna@gmail.com', '2025-04-23'),
(257, 'felipe.arteaga@tfauditores.com', '2025-04-23'),
(258, 'francisco.florez@tfauditores.net', '2025-04-23'),
(259, 'IVAN.POSADA@tfauditores.net', '2025-04-23'),
(260, 'jonh.castaneda@tfauditores.net', '2025-04-23'),
(261, 'wpinzonr@gmail.com', '2025-04-23');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `envios_dia_mujer`
--

CREATE TABLE `envios_dia_mujer` (
  `id` int(11) NOT NULL,
  `usuario_email` varchar(50) NOT NULL,
  `fecha_envio` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `envios_dia_mujer`
--

INSERT INTO `envios_dia_mujer` (`id`, `usuario_email`, `fecha_envio`) VALUES
(43, 'claravirginiaforero@tfauditores.com', '2025-04-23'),
(44, 'luisa.riveros@tfauditores.com', '2025-04-23'),
(45, 'deisy.mendivelso@tfauditores.com', '2025-04-23'),
(46, 'ROSARIO23.ROMERO@hotmail.com', '2025-04-23'),
(47, 'yenny.lopez@tfauditores.com', '2025-04-23'),
(48, 'recepcion@tfauditores.com', '2025-04-23'),
(49, 'clara.chaparro@tfauditores.com', '2025-04-23'),
(50, 'laura.tibaquira@tfauditores.com', '2025-04-23'),
(51, 'diana.rubiano@tfauditores.com', '2025-04-23'),
(52, 'jesica.achury@tfauditores.com', '2025-04-23'),
(53, 'adriana.tibaquira@tfauditores.com', '2025-04-23'),
(54, 'laura.joya@tfauditores.com', '2025-04-23'),
(55, 'liliana.sissa@tfauditores.net', '2025-04-23'),
(56, 'cristianpro184@gmail.com', '2025-04-23');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `genero` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `fecha_nacimiento` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `apellido`, `genero`, `email`, `fecha_nacimiento`) VALUES
(20, 'Manuel Antonio', 'Tibaquira Naranjo', 'masculino', 'manueltibaquira@tfauditores.com', '1959-03-29'),
(21, 'Clara Virginia', 'Forero Rojas ', 'femenino', 'claravirginiaforero@tfauditores.com', '1961-02-24'),
(22, 'Luis Carlos', 'Chavarro Palacios', 'masculino', 'luis.chavarro@tfauditores.com', '1950-10-03'),
(23, 'Hernan Mauricio', 'Carreno Beltran', 'masculino', 'hernan.carrenob@tfauditores.com', '1985-02-17'),
(24, 'Jairo Saul', 'Rincon Baez', 'masculino', 'jairo.rincon@tfauditores.com', '1965-11-14'),
(25, 'Luisa Fernanda', 'Riveros Fraile', 'femenino', 'luisa.riveros@tfauditores.com', '1989-02-13'),
(26, 'Victor Armando', 'Gonzalez Plata', 'masculino', 'victor.gonzalez@tfauditores.com', '1982-11-26'),
(27, 'Deisy', 'Mendivelso Torres', 'femenino', 'deisy.mendivelso@tfauditores.com', '1983-10-15'),
(28, 'Rosario', 'Romero', 'femenino', 'ROSARIO23.ROMERO@hotmail.com', '1973-08-23'),
(29, 'Herman', 'Villamarin Castaneda', 'masculino', 'herman.villamarin@tfauditores.com', '1973-11-21'),
(30, 'Yenny Yanibe', 'Lopez Morales', 'femenino', 'yenny.lopez@tfauditores.com', '1983-01-05'),
(31, 'Deisa', 'Cardenas Romero', 'femenino', 'recepcion@tfauditores.com', '1981-01-11'),
(32, 'Clara Yolanda', 'Chaparro Barrera', 'femenino', 'clara.chaparro@tfauditores.com', '1972-05-13'),
(33, 'Manuel Esteban', 'Tibaquira Forero', 'masculino', 'esteban.tibaquira@tfauditores.com', '1982-07-20'),
(34, 'Laura Cristina', 'Tibaquira Forero', 'femenino', 'laura.tibaquira@tfauditores.com', '1988-08-31'),
(35, 'Luis Antonio', 'Rojas Salcedo', 'masculino', 'luis.rojas@tfauditores.com', '1993-02-15'),
(36, 'Mario Rodolfo', 'Acosta Navarrete', 'masculino', 'mario.acosta@tfauditores.com', '1992-01-05'),
(37, 'Diana Marcela', 'Rubiano Sepulveda', 'femenino', 'diana.rubiano@tfauditores.com', '1981-11-27'),
(38, 'Jesica Dayana', 'Achury Quevedo', 'femenino', 'jesica.achury@tfauditores.com', '1992-11-10'),
(39, 'Jesus Eduardo', 'Plata Garcia', 'masculino', 'jesus.plata@tfauditores.com', '1989-05-02'),
(40, 'Edgar Alberto', 'Gaitan Fajardo', 'masculino', 'edgar.gaitan@tfauditores.com', '1972-03-30'),
(41, 'Adriana Patricia', 'Tibaquira Campos', 'femenino', 'adriana.tibaquira@tfauditores.com', '1983-05-29'),
(42, 'Raul Antonio', 'Ballen Hernandez', 'masculino', 'raul.ballen@tfauditores.com', '1982-01-16'),
(43, 'Juan Sebastian', 'Chia Montaña', 'masculino', 'hseq@tfauditores.com', '1992-01-12'),
(44, 'Andres David', 'Ortiz Valencia', 'masculino', 'seleccion@tfauditores.com', '1991-09-20'),
(45, 'Laura Daniela', 'Joya Oicatá', 'femenino', 'laura.joya@tfauditores.com', '2000-01-24'),
(46, 'Cristian Alejandro', 'Jiménez Mora', 'masculino', 'cristian.jimenez@tfauditores.net ', '2005-02-08'),
(47, 'Nesler Ricardo', 'Luna Ovalles', 'masculino', 'nesler.luna@gmail.com', '1987-03-30'),
(48, 'Andres Felipe', 'Arteaga Ballesteros', 'masculino', 'felipe.arteaga@tfauditores.com', '2000-08-28'),
(49, 'Liliana ', 'Sissa Pinzon ', 'femenino', 'liliana.sissa@tfauditores.net', '1985-08-17'),
(50, 'Francisco Josue ', 'Florez Torrado', 'masculino', 'francisco.florez@tfauditores.net', '1999-02-17'),
(51, 'Ivan Alberto ', 'Posada Ospina', 'masculino', 'IVAN.POSADA@tfauditores.net', '1985-04-23'),
(52, 'John Jair ', 'Castañeda Hernandez', 'masculino', 'jonh.castaneda@tfauditores.net', '1982-11-23'),
(53, 'Wilmer Leonel', 'Pinzon Rueda', 'masculino', 'wpinzonr@gmail.com', '1982-12-07'),
(55, 'Yuly Andrea', 'Tibaquira Forero', 'femenino', 'cristianpro184@gmail.com', '2000-04-08');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `envios_cumpleanos`
--
ALTER TABLE `envios_cumpleanos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `envios_dia_hombre`
--
ALTER TABLE `envios_dia_hombre`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `envios_dia_mujer`
--
ALTER TABLE `envios_dia_mujer`
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
-- AUTO_INCREMENT de la tabla `envios_cumpleanos`
--
ALTER TABLE `envios_cumpleanos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `envios_dia_hombre`
--
ALTER TABLE `envios_dia_hombre`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=262;

--
-- AUTO_INCREMENT de la tabla `envios_dia_mujer`
--
ALTER TABLE `envios_dia_mujer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
