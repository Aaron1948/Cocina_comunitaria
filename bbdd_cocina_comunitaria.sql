-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3307
-- Tiempo de generación: 02-12-2025 a las 18:49:32
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
-- Base de datos: `web_proyecto`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `citas`
--

CREATE TABLE `citas` (
  `idCita` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `fecha_cita` date NOT NULL,
  `motivo_cita` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `citas`
--

INSERT INTO `citas` (`idCita`, `idUser`, `fecha_cita`, `motivo_cita`) VALUES
(22, 27, '2025-12-03', 'Me gustaria ponerme en contacto con un administrador para solucionar un problema que tengo con la entrada de una noticia, muchas gracias.'),
(23, 33, '2025-12-23', 'Quiero saber cuando habrá nuevos eventos gastronómicos en Alicante.'),
(24, 13, '2025-12-03', 'Este usuario debe de cambiar sus datos personales.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `noticias`
--

CREATE TABLE `noticias` (
  `idNoticia` int(11) NOT NULL,
  `titulo` varchar(150) NOT NULL,
  `imagen` varchar(255) NOT NULL,
  `texto` text NOT NULL,
  `fecha` date NOT NULL,
  `idUser` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `noticias`
--

INSERT INTO `noticias` (`idNoticia`, `titulo`, `imagen`, `texto`, `fecha`, `idUser`) VALUES
(1, 'Inauguracion del nuevo comedor', 'comedor.jpg', 'Hoy se ha inaugurado el nuevo comedor comunitario en el centro social. El objetivo es ofrecer un espacio mas amplio y accesible para todos los vecinos.', '2025-11-26', 31),
(5, 'la revolucion de la cocina vegetal', 'verduras.png', 'Cada vez más restaurantes apuestan por menús 100% vegetales, con platos creativos que sorprenden incluso a los más carnívoros.', '2025-12-02', 31),
(6, 'El pan artesanal vuelve a ser protagonista', 'pan.jpg', 'Panaderías locales recuperan técnicas tradicionales de fermentación lenta, ofreciendo panes con más sabor y mejor digestión.', '2025-12-03', 31),
(7, 'La cocina mediterránea conquista el mundo', 'dieta_mediterranea.jpg', 'El aceite de oliva, las legumbres y el pescado fresco se consolidan como pilares de una dieta saludable reconocida internacionalmente.', '2025-12-02', 31),
(8, 'Postres con menos azúcar, más creatividad', 'tarta.jpg', 'Pastelerías innovan con endulzantes naturales y frutas frescas para crear postres más saludables sin perder sabor.', '2025-12-04', 31),
(9, 'El auge de la cerveza artesanal', 'cerveza.jpg', 'Microcervecerías locales experimentan con sabores únicos, desde notas cítricas hasta toques de café y chocolate.', '2025-12-02', 31),
(10, 'La cocina fusión sorprende en Alicante', 'fusion.jpg', 'Restaurantes locales mezclan técnicas asiáticas con productos mediterráneos, creando platos originales que atraen a turistas y vecinos.', '2025-12-02', 31),
(11, 'El retorno de las recetas de la abuela', 'Recetas-de-la-abuela-2.jpeg', 'Cocineros jóvenes rescatan guisos y platos tradicionales, dándoles un toque moderno sin perder la esencia.', '2025-12-02', 31),
(12, 'El chocolate artesanal gana terreno', 'chocolate.jpg', 'Chocolateros locales elaboran tabletas con cacao de origen único, ofreciendo experiencias de sabor más intensas.', '2025-12-02', 31),
(13, 'La sostenibilidad llega a la cocina', 'mercado2.jpg', 'Restaurantes apuestan por ingredientes de proximidad y técnicas que reducen el desperdicio alimentario.', '2025-12-02', 31);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users_data`
--

CREATE TABLE `users_data` (
  `idUser` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellidos` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `fecha_nacimiento` date NOT NULL,
  `direccion` text DEFAULT NULL,
  `sexo` enum('hombre','mujer','otro') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `users_data`
--

INSERT INTO `users_data` (`idUser`, `nombre`, `apellidos`, `email`, `telefono`, `fecha_nacimiento`, `direccion`, `sexo`) VALUES
(13, 'amaya', 'chaves', 'amaya@gmail.com', '666666666', '1988-02-20', 'algaboora 43', 'mujer'),
(27, 'Carmen', 'Garcia', 'carmen@gmail.com', '666666666', '1989-05-17', 'Miguel de Cervantes n42', 'mujer'),
(31, 'Aaron', 'Chaves Alfonso', 'aaron@gmail.com', '722573640', '1982-06-20', 'Calle Miguel de Cervantes n32', 'hombre'),
(33, 'Carmen', 'García Sanz', 'carmenentrecueros@gmail.com', '638269324', '1989-05-17', 'Calle Enrique Madrid nº42 3º C', 'mujer'),
(34, 'Cesar', 'Fabian Escribano', 'cesar@hotmail.com', '659874521', '1985-11-15', 'Calle Solar nº4 3ºizq', 'hombre');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users_login`
--

CREATE TABLE `users_login` (
  `idLogin` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `rol` enum('admin','user') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `users_login`
--

INSERT INTO `users_login` (`idLogin`, `idUser`, `usuario`, `password`, `rol`) VALUES
(21, 27, 'Carmen', '$2y$10$uUp4N18vXOmomhkQhd/ZI.CBtZq8mD7YPRd2N7DotblYnrIYIGECC', 'user'),
(25, 31, 'Aaron', '$2y$10$3OlogZtiBLmdlTdhxPHswul9JMNvrSAgdELAUAIPs25gY6S6XGjvS', 'admin'),
(27, 33, 'Carmengesa', '$2y$10$Pq/ixGVmX2Z2OCTaK2WkEeMp07t3vW3KNZrHlQJJVf.1KM.m5Z4GG', 'user'),
(28, 34, 'Cesar', '$2y$10$zXVbzamJMFC6oq6iiqmX3OwR1flM10TRV7rWEKG3WlEnWKnzOayne', 'admin');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `citas`
--
ALTER TABLE `citas`
  ADD PRIMARY KEY (`idCita`),
  ADD KEY `idUser` (`idUser`);

--
-- Indices de la tabla `noticias`
--
ALTER TABLE `noticias`
  ADD PRIMARY KEY (`idNoticia`),
  ADD UNIQUE KEY `titulo` (`titulo`),
  ADD KEY `idUser` (`idUser`);

--
-- Indices de la tabla `users_data`
--
ALTER TABLE `users_data`
  ADD PRIMARY KEY (`idUser`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indices de la tabla `users_login`
--
ALTER TABLE `users_login`
  ADD PRIMARY KEY (`idLogin`),
  ADD UNIQUE KEY `idUser` (`idUser`),
  ADD UNIQUE KEY `usuario` (`usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `citas`
--
ALTER TABLE `citas`
  MODIFY `idCita` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `noticias`
--
ALTER TABLE `noticias`
  MODIFY `idNoticia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `users_data`
--
ALTER TABLE `users_data`
  MODIFY `idUser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT de la tabla `users_login`
--
ALTER TABLE `users_login`
  MODIFY `idLogin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `citas`
--
ALTER TABLE `citas`
  ADD CONSTRAINT `citas_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `users_data` (`idUser`) ON DELETE CASCADE;

--
-- Filtros para la tabla `noticias`
--
ALTER TABLE `noticias`
  ADD CONSTRAINT `noticias_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `users_data` (`idUser`) ON DELETE CASCADE;

--
-- Filtros para la tabla `users_login`
--
ALTER TABLE `users_login`
  ADD CONSTRAINT `users_login_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `users_data` (`idUser`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
