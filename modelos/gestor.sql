-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-02-2020 a las 00:48:28
-- Versión del servidor: 10.1.38-MariaDB
-- Versión de PHP: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `gestor`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administrador`
--

CREATE TABLE `administrador` (
  `idadministrador` int(11) NOT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `mail` varchar(45) NOT NULL,
  `pass` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `administrador`
--

INSERT INTO `administrador` (`idadministrador`, `nombre`, `mail`, `pass`) VALUES
(1, NULL, '100@100.com', 'f899139df5e1059396431415e770c6dd');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estudiante`
--

CREATE TABLE `estudiante` (
  `idestudiante` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `codigo` varchar(45) NOT NULL,
  `mail` varchar(45) NOT NULL,
  `pass` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `estudiante`
--

INSERT INTO `estudiante` (`idestudiante`, `nombre`, `codigo`, `mail`, `pass`) VALUES
(1, 'Bart Simpson', '25252', '1@1.com', 'c4ca4238a0b923820dcc509a6f75849b'),
(2, 'Lisa Simpson', '5622', '2@2.com', 'c81e728d9d4c2f636f067f89cc14862c'),
(3, 'Rafa Gorgory', '6333', '3@3.com', 'eccbc87e4b5ce2fe28308fd9f2a7baf3');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estudiante_has_proyecto`
--

CREATE TABLE `estudiante_has_proyecto` (
  `estudiante_idestudiante` int(11) NOT NULL,
  `proyecto_idproyecto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `estudiante_has_proyecto`
--

INSERT INTO `estudiante_has_proyecto` (`estudiante_idestudiante`, `proyecto_idproyecto`) VALUES
(1, 2),
(1, 3),
(2, 1),
(2, 3),
(3, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `jurado`
--

CREATE TABLE `jurado` (
  `idjurado` int(11) NOT NULL,
  `profesor_idprofesor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `jurado`
--

INSERT INTO `jurado` (`idjurado`, `profesor_idprofesor`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profesor`
--

CREATE TABLE `profesor` (
  `idprofesor` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `mail` varchar(45) NOT NULL,
  `pass` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `profesor`
--

INSERT INTO `profesor` (`idprofesor`, `nombre`, `mail`, `pass`) VALUES
(1, 'Seymour Skinner', 's@s.com', '03c7c0ace395d80182db07ae2c30f034'),
(2, 'edna clavados', 'e@e.com', 'e1671797c52e15f763380b45e841ec32'),
(3, 'super nintendo charmer', 'sn@sn.com', 'afbe94cdbe69a93efabc9f1325fc7dff'),
(4, 'profesor begstrom', 'b@b.com', '92eb5ffee6ae2fec3ad71c777531578f'),
(5, 'Jairo Castillo', 'j@j.com', '363b122c528f54df4a0446b6bab05515');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyecto`
--

CREATE TABLE `proyecto` (
  `idproyecto` int(11) NOT NULL,
  `titulo` varchar(60) NOT NULL,
  `descripccion` varchar(200) NOT NULL,
  `pdf` varchar(45) NOT NULL,
  `estado` int(11) DEFAULT NULL,
  `tutor_idtutor` int(11) DEFAULT NULL,
  `jurado_idjurado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `proyecto`
--

INSERT INTO `proyecto` (`idproyecto`, `titulo`, `descripccion`, `pdf`, `estado`, `tutor_idtutor`, `jurado_idjurado`) VALUES
(1, 'Linguo', 'Linguo el robot gramatical es afopjgnais a aigohnaslnas lginsalnga soilgnagls  galinsgnagdla slasgkng aslnogliashnjgln as slignalsn asggklnaslkgn g aslksgaslkn salkgasn asgjgsagnmsa a s,msafssfjs safj', '1572638152187.pdf', 3, 2, 1),
(2, 'Jamster Volador', 'fao g saok a[sfodfks amsf mfsas; fmf saf ;f mofs m mosaf  fssa flm;mfsm sf fomssonm  ofm  fnwm fonfsnmikfs  sf gni  fpaoi k ngapgoi n gnsaf sa nopig npas fopaww ttopian ffs sfijkn as fikfaoip nga sfio', '1572904431747.pdf', 3, 2, 1),
(3, 'experimento', 'xdxdxdd', '1580074853275.pdf', 1, 2, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tutor`
--

CREATE TABLE `tutor` (
  `idtutor` int(11) NOT NULL,
  `profesor_idprofesor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tutor`
--

INSERT INTO `tutor` (`idtutor`, `profesor_idprofesor`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administrador`
--
ALTER TABLE `administrador`
  ADD PRIMARY KEY (`idadministrador`);

--
-- Indices de la tabla `estudiante`
--
ALTER TABLE `estudiante`
  ADD PRIMARY KEY (`idestudiante`);

--
-- Indices de la tabla `estudiante_has_proyecto`
--
ALTER TABLE `estudiante_has_proyecto`
  ADD PRIMARY KEY (`estudiante_idestudiante`,`proyecto_idproyecto`),
  ADD KEY `fk_estudiante_has_proyecto_proyecto1_idx` (`proyecto_idproyecto`),
  ADD KEY `fk_estudiante_has_proyecto_estudiante_idx` (`estudiante_idestudiante`);

--
-- Indices de la tabla `jurado`
--
ALTER TABLE `jurado`
  ADD PRIMARY KEY (`idjurado`),
  ADD KEY `fk_jurado_profesor1_idx` (`profesor_idprofesor`);

--
-- Indices de la tabla `profesor`
--
ALTER TABLE `profesor`
  ADD PRIMARY KEY (`idprofesor`);

--
-- Indices de la tabla `proyecto`
--
ALTER TABLE `proyecto`
  ADD PRIMARY KEY (`idproyecto`),
  ADD KEY `fk_proyecto_tutor1_idx` (`tutor_idtutor`),
  ADD KEY `fk_proyecto_jurado1_idx` (`jurado_idjurado`);

--
-- Indices de la tabla `tutor`
--
ALTER TABLE `tutor`
  ADD PRIMARY KEY (`idtutor`),
  ADD KEY `fk_tutor_profesor1_idx` (`profesor_idprofesor`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `administrador`
--
ALTER TABLE `administrador`
  MODIFY `idadministrador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `estudiante`
--
ALTER TABLE `estudiante`
  MODIFY `idestudiante` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `jurado`
--
ALTER TABLE `jurado`
  MODIFY `idjurado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `profesor`
--
ALTER TABLE `profesor`
  MODIFY `idprofesor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `proyecto`
--
ALTER TABLE `proyecto`
  MODIFY `idproyecto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tutor`
--
ALTER TABLE `tutor`
  MODIFY `idtutor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `estudiante_has_proyecto`
--
ALTER TABLE `estudiante_has_proyecto`
  ADD CONSTRAINT `fk_estudiante_has_proyecto_estudiante` FOREIGN KEY (`estudiante_idestudiante`) REFERENCES `estudiante` (`idestudiante`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_estudiante_has_proyecto_proyecto1` FOREIGN KEY (`proyecto_idproyecto`) REFERENCES `proyecto` (`idproyecto`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `jurado`
--
ALTER TABLE `jurado`
  ADD CONSTRAINT `fk_jurado_profesor1` FOREIGN KEY (`profesor_idprofesor`) REFERENCES `profesor` (`idprofesor`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `proyecto`
--
ALTER TABLE `proyecto`
  ADD CONSTRAINT `fk_proyecto_jurado1` FOREIGN KEY (`jurado_idjurado`) REFERENCES `jurado` (`idjurado`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_proyecto_tutor1` FOREIGN KEY (`tutor_idtutor`) REFERENCES `tutor` (`idtutor`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tutor`
--
ALTER TABLE `tutor`
  ADD CONSTRAINT `fk_tutor_profesor1` FOREIGN KEY (`profesor_idprofesor`) REFERENCES `profesor` (`idprofesor`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
