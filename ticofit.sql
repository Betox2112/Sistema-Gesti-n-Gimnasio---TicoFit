-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-09-2025 a las 05:35:39
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
-- Base de datos: `ticofit`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `admin`
--

CREATE TABLE `admin` (
  `adminId` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `permisos` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `admin`
--

INSERT INTO `admin` (`adminId`, `idUsuario`, `permisos`) VALUES
(1, 3, 'Administrar usuarios y reportes');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asistencia`
--

CREATE TABLE `asistencia` (
  `id` int(11) NOT NULL,
  `cliente_id` int(11) NOT NULL,
  `fecha_hora` datetime NOT NULL,
  `estado` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `asistencia`
--

INSERT INTO `asistencia` (`id`, `cliente_id`, `fecha_hora`, `estado`) VALUES
(7, 7, '2025-08-01 08:00:00', 'Presente'),
(8, 10, '2025-08-01 08:30:00', 'Presente'),
(9, 7, '2025-08-02 09:00:00', 'Ausente'),
(10, 7, '2025-08-02 09:30:00', 'Presente'),
(11, 7, '2025-08-03 10:00:00', 'Presente'),
(12, 8, '2025-08-03 10:30:00', 'Ausente'),
(13, 8, '2025-08-04 07:00:00', 'Presente'),
(14, 9, '2025-08-04 07:30:00', 'Presente'),
(15, 9, '2025-08-05 08:00:00', 'Ausente'),
(16, 10, '2025-08-05 08:30:00', 'Presente'),
(17, 10, '2025-08-06 09:00:00', 'Presente'),
(18, 7, '2025-08-06 09:30:00', 'Ausente'),
(19, 7, '2025-08-07 10:00:00', 'Presente'),
(20, 8, '2025-08-07 10:30:00', 'Presente'),
(21, 7, '2025-08-08 07:00:00', 'Ausente'),
(22, 9, '2025-08-08 07:30:00', 'Presente'),
(23, 8, '2025-08-09 08:00:00', 'Presente'),
(24, 10, '2025-08-09 08:30:00', 'Ausente'),
(25, 9, '2025-08-10 09:00:00', 'Presente'),
(26, 7, '2025-08-10 09:30:00', 'Presente'),
(27, 7, '2025-08-13 08:00:00', 'Presente'),
(28, 8, '2025-08-13 08:30:00', 'Ausente'),
(29, 9, '2025-08-13 09:00:00', 'Presente'),
(30, 10, '2025-08-13 09:30:00', 'Presente'),
(31, 7, '2025-08-14 07:00:00', 'Ausente'),
(32, 8, '2025-08-14 07:30:00', 'Presente'),
(33, 9, '2025-08-14 08:00:00', 'Presente'),
(34, 10, '2025-08-14 08:30:00', 'Ausente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clase`
--

CREATE TABLE `clase` (
  `claseId` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `capacidadMaxima` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `clase`
--

INSERT INTO `clase` (`claseId`, `nombre`, `descripcion`, `capacidadMaxima`) VALUES
(1, 'Yoga Matutino', 'Clase de yoga para todos los niveles', 20),
(2, 'Entrenamiento de Fuerza', 'Sesión enfocada en levantamiento de pesas', 15),
(3, 'Cardio Intensivo', 'Clase de cardio para mejorar resistencia', 25),
(4, 'Pilates Avanzado', 'Sesión de Pilates para mejorar fuerza y flexibilidad', 18),
(5, 'Zumba Fitness', 'Clase de baile con ritmos latinos para quemar calorías', 30),
(6, 'Spinning Nocturno', 'Entrenamiento intensivo en bicicleta estática', 20),
(7, 'Boxeo Funcional', 'Clase de boxeo combinada con ejercicios funcionales', 15),
(8, 'CrossFit Básico', 'Entrenamiento de alta intensidad para principiantes', 12),
(9, 'Yoga Restaurativo', 'Sesión de yoga enfocada en relajación y estiramientos', 22),
(10, 'HIIT Extremo', 'Entrenamiento por intervalos de alta intensidad', 25);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `clienteId` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `preferencias` text DEFAULT NULL,
  `celular` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`clienteId`, `idUsuario`, `preferencias`, `celular`) VALUES
(7, 4, 'Prefiere entrenamiento de resistencia', '1234567890'),
(8, 5, 'Prefiere HIIT', '0987654321'),
(9, 6, 'Prefiere yoga', '5551234567'),
(10, 7, 'Prefiere musculación', '4449876543'),
(11, 8, 'bajar_peso', '12345678'),
(14, 11, 'bajar_peso', '12345678'),
(15, 12, 'subir_masa', '12345678'),
(16, 13, 'bajar_peso', '12345678');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ejercicio`
--

CREATE TABLE `ejercicio` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `grupoMuscular` varchar(50) DEFAULT NULL,
  `descripcion` text DEFAULT NULL,
  `tipo` varchar(50) NOT NULL,
  `rutinaId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ejercicio`
--

INSERT INTO `ejercicio` (`id`, `nombre`, `grupoMuscular`, `descripcion`, `tipo`, `rutinaId`) VALUES
(1, 'Sentadillas', 'Piernas', 'Fortalecimiento de piernas y glúteos', 'Fuerza', 1),
(2, 'Flexiones', 'Pecho', 'Ejercicio para el tren superior', 'Fuerza', 1),
(3, 'Plancha', 'Core', 'Fortalecimiento del core', 'Flexibilidad', 2),
(4, 'Mountain Climbers', 'Core', 'Cardio y fortalecimiento del core', 'Cardio', 2),
(5, 'Peso Muerto', 'Espalda', 'Ejercicio para espalda y piernas', 'Fuerza', 3),
(6, 'Press de Banca', 'Pecho', 'Fortalecimiento de pecho y tríceps', 'Fuerza', 3),
(7, 'Correr en Cinta', 'Cardio', 'Cardio para mejorar resistencia', 'Cardio', 4),
(8, 'Bicicleta Estática', 'Cardio', 'Cardio de bajo impacto', 'Cardio', 4),
(9, 'Burpees', 'Full Body', 'Ejercicio funcional de alta intensidad', 'Cardio', 5),
(10, 'Kettlebell Swing', 'Full Body', 'Ejercicio para potencia y cardio', 'Cardio', 5),
(11, 'Saltos en Caja', 'Piernas', 'Ejercicio pliométrico para potencia', 'Cardio', 6),
(12, 'Dominadas', 'Espalda', 'Fortalecimiento de espalda y brazos', 'Fuerza', 6),
(13, 'Lunges', 'Piernas', 'Ejercicio para piernas y equilibrio', 'Fuerza', 7),
(14, 'Farmer’s Carry', 'Full Body', 'Fortalecimiento funcional', 'Fuerza', 7),
(15, 'Estiramiento de Isquiotibiales', 'Piernas', 'Mejora la flexibilidad de piernas', 'Flexibilidad', 8),
(16, 'Cat-Cow Stretch', 'Espalda', 'Estiramiento para columna y flexibilidad', 'Flexibilidad', 8),
(17, 'Sentadillas', 'Piernas', 'Fortalecimiento de piernas y glúteos', 'Fuerza', 1),
(18, 'Flexiones', 'Pecho', 'Ejercicio para el tren superior', 'Fuerza', 1),
(19, 'Plancha', 'Core', 'Fortalecimiento del core', 'Flexibilidad', 2),
(20, 'Mountain Climbers', 'Core', 'Cardio y fortalecimiento del core', 'Cardio', 2),
(21, 'Peso Muerto', 'Espalda', 'Ejercicio para espalda y piernas', 'Fuerza', 3),
(22, 'Press de Banca', 'Pecho', 'Fortalecimiento de pecho y tríceps', 'Fuerza', 3),
(23, 'Correr en Cinta', 'Cardio', 'Cardio para mejorar resistencia', 'Cardio', 4),
(24, 'Bicicleta Estática', 'Cardio', 'Cardio de bajo impacto', 'Cardio', 4),
(25, 'Burpees', 'Full Body', 'Ejercicio funcional de alta intensidad', 'Cardio', 5),
(26, 'Kettlebell Swing', 'Full Body', 'Ejercicio para potencia y cardio', 'Cardio', 5),
(27, 'Saltos en Caja', 'Piernas', 'Ejercicio pliométrico para potencia', 'Cardio', 6),
(28, 'Dominadas', 'Espalda', 'Fortalecimiento de espalda y brazos', 'Fuerza', 6),
(29, 'Lunges', 'Piernas', 'Ejercicio para piernas y equilibrio', 'Fuerza', 7),
(30, 'Farmer’s Carry', 'Full Body', 'Fortalecimiento funcional', 'Fuerza', 7),
(31, 'Estiramiento de Isquiotibiales', 'Piernas', 'Mejora la flexibilidad de piernas', 'Flexibilidad', 8),
(32, 'Cat-Cow Stretch', 'Espalda', 'Estiramiento para columna y flexibilidad', 'Flexibilidad', 8);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `entrenadores`
--

CREATE TABLE `entrenadores` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `especialidad` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `entrenadores`
--

INSERT INTO `entrenadores` (`id`, `nombre`, `especialidad`, `email`) VALUES
(1, 'Carlos López', 'Fuerza y resistencia', 'carlos.lopez@example.com'),
(2, 'Ana Martínez', 'Cardio y yoga', 'ana.martinez@example.com'),
(3, 'Valeria Torres', 'Pilates y movilidad', 'valeria.torres@example.com'),
(4, 'Mateo Vargas', 'CrossFit y entrenamiento funcional', 'mateo.vargas@example.com'),
(5, 'Camila Rojas', 'Zumba y baile fitness', 'camila.rojas@example.com'),
(6, 'Sebastián Castro', 'Boxeo y artes marciales', 'sebastian.castro@example.com'),
(7, 'Isabela Morales', 'Nutrición y entrenamiento personalizado', 'isabela.morales@example.com'),
(8, 'Gabriel Sánchez', 'Spinning y cardio intensivo', 'gabriel.sanchez@example.com');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inventario`
--

CREATE TABLE `inventario` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `cantidad` int(11) NOT NULL,
  `estado` enum('disponible','en_mantenimiento','roto') DEFAULT 'disponible',
  `fecha_adquisicion` date DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `inventario`
--

INSERT INTO `inventario` (`id`, `nombre`, `descripcion`, `cantidad`, `estado`, `fecha_adquisicion`) VALUES
(1, 'Pesas Libres', 'Set de pesas libres de 2 a 50 kg para entrenamiento de fuerza', 20, 'disponible', '2025-01-15'),
(2, 'Barras Olímpicas', 'Barras estándar para levantamiento de pesas', 10, 'disponible', '2025-02-10'),
(3, 'Máquina de Remo', 'Máquina de remo para cardio y fortalecimiento de espalda', 5, 'disponible', '2025-03-05'),
(4, 'Cinta de Correr', 'Cinta para correr con ajustes de velocidad y inclinación', 8, 'disponible', '2025-04-20'),
(5, 'Bicicleta Estática', 'Bicicleta fija para cardio de bajo impacto', 6, 'disponible', '2025-05-12'),
(6, 'Máquina de Prensa de Piernas', 'Máquina para fortalecer piernas y glúteos', 4, 'disponible', '2025-06-08'),
(7, 'Mats de Yoga', 'Colchonetas para clases de yoga y estiramientos', 30, 'disponible', '2025-07-25'),
(8, 'Bolas de Medicina', 'Bolas de diferentes pesos para ejercicios funcionales', 15, 'disponible', '2025-08-03'),
(9, 'Banco de Pesas', 'Banco ajustable para ejercicios con pesas', 12, 'disponible', '2025-08-15'),
(10, 'Máquina de Cable', 'Máquina multifuncional para ejercicios de polea', 3, 'disponible', '2025-08-20'),
(11, 'Kettlebells', 'Pesas rusas de 4 a 32 kg para entrenamiento dinámico', 20, 'disponible', '2025-08-21'),
(12, 'Barras de Pull-up', 'Barras para dominadas y ejercicios de espalda', 5, 'disponible', '2025-08-21'),
(13, 'Pesas para Tobillos', 'Pesas ajustables para entrenamiento de piernas', 10, 'disponible', '2025-08-21'),
(14, 'Rueda Abdominal', 'Rueda para ejercicios de core y abdomen', 15, 'disponible', '2025-08-21'),
(15, 'Elíptica', 'Máquina elíptica para cardio full body', 6, 'disponible', '2025-08-21'),
(16, 'Máquina de Leg Curl', 'Máquina para fortalecer isquiotibiales', 4, 'disponible', '2025-08-21'),
(17, 'Bancos Inclinados', 'Bancos ajustables para ejercicios de pecho', 8, 'disponible', '2025-08-21'),
(18, 'Cuerdas de Batalla', 'Cuerdas para entrenamiento de alta intensidad', 5, 'disponible', '2025-08-21'),
(19, 'Box para Saltos', 'Cajas de diferentes alturas para pliométricos', 10, 'disponible', '2025-08-21'),
(20, 'Máquina de Escaleras', 'Escaladora para cardio y resistencia', 3, 'disponible', '2025-08-21'),
(21, 'Pesas Libres', 'Set de pesas libres de 2 a 50 kg para entrenamiento de fuerza', 10, 'disponible', '2025-08-21'),
(22, 'Pesas Libres', 'Set de pesas libres de 2 a 50 kg para entrenamiento de fuerza', 10, 'disponible', '2025-08-21'),
(23, 'Máquina de Escaleras', 'Escaladora para cardio y resistencia', 10, 'disponible', '2025-08-21');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `membresias`
--

CREATE TABLE `membresias` (
  `membresiaId` int(11) NOT NULL,
  `tipoMembresia` varchar(255) NOT NULL,
  `costo` decimal(10,2) NOT NULL,
  `fechaInicio` date DEFAULT NULL,
  `fechaFin` date DEFAULT NULL,
  `descripcion` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `membresias`
--

INSERT INTO `membresias` (`membresiaId`, `tipoMembresia`, `costo`, `fechaInicio`, `fechaFin`, `descripcion`) VALUES
(1, 'Básica', 15444.85, '2025-08-11', '2025-09-11', 'Acceso ilimitado a clases de yoga y cardio, 1 sesión de entrenamiento personalizado al mes.'),
(2, 'Premium', 25744.85, '2025-08-11', '2025-11-11', 'Acceso ilimitado a todas las clases, 3 sesiones de entrenamiento personalizado al mes, asesoramiento nutricional.'),
(3, 'Estándar', 20594.85, '2025-08-15', '2025-10-15', 'Acceso a clases de fuerza, cardio y yoga, 2 sesiones de entrenamiento personalizado al mes.'),
(4, 'Familiar', 41194.85, '2025-08-20', '2026-02-20', 'Acceso ilimitado para hasta 4 familiares, incluye todas las clases y 4 sesiones de entrenamiento personalizado al mes.'),
(5, 'Estudiantil', 10294.85, '2025-09-01', '2025-12-01', 'Acceso a clases seleccionadas (yoga, cardio, Zumba) con descuento para estudiantes, 1 sesión de entrenamiento personalizado al mes.'),
(6, 'Anual', 154494.85, '2025-07-01', '2026-07-01', 'Acceso ilimitado a todas las clases por un año, 6 sesiones de entrenamiento personalizado al mes, asesoramiento nutricional y plan de entrenamiento exclusivo.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagos`
--

CREATE TABLE `pagos` (
  `id` int(11) NOT NULL,
  `usuarioId` int(11) NOT NULL,
  `membresiaId` int(11) NOT NULL,
  `monto` decimal(10,2) NOT NULL,
  `metodoPago` varchar(50) NOT NULL,
  `fechaPago` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pagos`
--

INSERT INTO `pagos` (`id`, `usuarioId`, `membresiaId`, `monto`, `metodoPago`, `fechaPago`) VALUES
(1, 1, 1, 15444.85, 'efectivo', '2025-08-20 20:47:37'),
(2, 1, 1, 15424.85, 'efectivo', '2025-08-20 20:58:51'),
(3, 2, 6, 154494.85, 'transferencia', '2025-08-20 20:59:41'),
(4, 3, 2, 25744.85, 'transferencia', '2025-08-20 21:26:56'),
(5, 8, 6, 154494.85, 'tarjeta', '2025-08-21 01:51:17'),
(6, 1, 3, 20594.85, 'efectivo', '2025-08-21 15:36:58'),
(7, 4, 1, 15444.85, 'efectivo', '2025-08-21 15:37:24'),
(8, 11, 1, 15444.85, 'efectivo', '2025-08-21 21:00:11'),
(9, 12, 1, 15444.85, 'tarjeta', '2025-08-21 21:06:22'),
(10, 1, 1, 15444.85, 'efectivo', '2025-08-21 21:13:21'),
(11, 13, 3, 20594.85, 'efectivo', '2025-08-21 21:43:33'),
(12, 1, 2, 25744.85, 'transferencia', '2025-08-21 21:49:25'),
(13, 1, 2, 25744.85, 'tarjeta', '2025-09-03 00:19:11');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `plan_entrenamiento`
--

CREATE TABLE `plan_entrenamiento` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `descripcion` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `plan_entrenamiento`
--

INSERT INTO `plan_entrenamiento` (`id`, `nombre`, `descripcion`) VALUES
(1, 'Plan Básico', 'Entrenamiento básico - Prueba'),
(2, 'Plan Intermedio', 'Rutina moderada'),
(3, 'Plan Avanzado', 'Entrenamiento intensivo para usuarios avanzados'),
(4, 'Plan Funcional', 'Enfoque en movimientos funcionales y movilidad'),
(5, 'Plan Militar', 'Fuerza');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rutina`
--

CREATE TABLE `rutina` (
  `rutinaId` int(11) NOT NULL,
  `planId` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `duracion` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `rutina`
--

INSERT INTO `rutina` (`rutinaId`, `planId`, `nombre`, `descripcion`, `duracion`) VALUES
(1, 1, 'Rutina Matutina Básica', 'Sesión ligera para empezar el día', 45),
(2, 1, 'Rutina de Core', 'Fortalecimiento del abdomen y espalda baja', 30),
(3, 2, 'Rutina de Fuerza', 'Enfoque en levantamiento de pesas', 60),
(4, 2, 'Rutina Cardio Moderada', 'Cardio para mejorar resistencia', 50),
(5, 3, 'Rutina HIIT Avanzada', 'Intervalos de alta intensidad', 40),
(6, 3, 'Rutina de Potencia', 'Ejercicios pliométricos y de fuerza', 55),
(7, 4, 'Rutina Funcional Completa', 'Movimientos funcionales para todo el cuerpo', 60),
(8, 4, 'Rutina de Movilidad', 'Estiramientos y ejercicios de flexibilidad', 35);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitudes_registro`
--

CREATE TABLE `solicitudes_registro` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `apellido` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `preferencias` text DEFAULT NULL,
  `tipoMembresia` varchar(255) NOT NULL,
  `fechaSolicitud` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `apellido` varchar(255) NOT NULL,
  `contraseña` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `registroFecha` datetime DEFAULT NULL,
  `rol` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `nombre`, `apellido`, `contraseña`, `email`, `registroFecha`, `rol`) VALUES
(1, 'Juan', 'Pérez', 'Cliente1234', 'juan@example.com', '2025-08-11 15:24:00', 'cliente'),
(2, 'María', 'Gómez', 'Entre123', 'maria@example.com', '2025-08-11 15:24:00', 'entrenador'),
(3, 'Carlos', 'López', 'Admin1234', 'carlos@example.com', '2025-08-11 15:24:00', 'admin'),
(4, 'Sofía', 'Ramírez', 'Cliente1234', 'sofia@example.com', '2025-08-12 10:00:00', 'cliente'),
(5, 'Diego', 'Fernández', 'Cliente1234', 'diego@example.com', '2025-08-12 11:00:00', 'cliente'),
(6, 'Laura', 'Vega', 'Cliente1234', 'laura@example.com', '2025-08-12 12:00:00', 'cliente'),
(7, 'Andrés', 'Moreno', 'Cliente1234', 'andres@example.com', '2025-08-12 13:00:00', 'cliente'),
(8, 'Damaris', 'Solano', 'Cliente1234', 'damaris@example.com', '2025-08-21 01:42:05', 'cliente'),
(11, 'Lucas', 'Chaves', 'Lucas123', 'lucas@gmail.com', '2025-08-21 20:59:47', 'cliente'),
(12, 'Luis', 'Solano', 'Luis1234', 'luis@gmail.com', '2025-08-21 21:02:17', 'cliente'),
(13, 'Lorena', 'Chaves', 'Lorena1234', 'lorena@gmail.com', '2025-08-21 21:41:30', 'cliente');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`adminId`),
  ADD KEY `admin_ibfk_1` (`idUsuario`);

--
-- Indices de la tabla `asistencia`
--
ALTER TABLE `asistencia`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cliente_id` (`cliente_id`);

--
-- Indices de la tabla `clase`
--
ALTER TABLE `clase`
  ADD PRIMARY KEY (`claseId`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`clienteId`),
  ADD KEY `cliente_ibfk_1` (`idUsuario`);

--
-- Indices de la tabla `ejercicio`
--
ALTER TABLE `ejercicio`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rutinaId` (`rutinaId`);

--
-- Indices de la tabla `entrenadores`
--
ALTER TABLE `entrenadores`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `inventario`
--
ALTER TABLE `inventario`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `membresias`
--
ALTER TABLE `membresias`
  ADD PRIMARY KEY (`membresiaId`);

--
-- Indices de la tabla `pagos`
--
ALTER TABLE `pagos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuarioId` (`usuarioId`),
  ADD KEY `membresiaId` (`membresiaId`);

--
-- Indices de la tabla `plan_entrenamiento`
--
ALTER TABLE `plan_entrenamiento`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `rutina`
--
ALTER TABLE `rutina`
  ADD PRIMARY KEY (`rutinaId`),
  ADD KEY `planId` (`planId`);

--
-- Indices de la tabla `solicitudes_registro`
--
ALTER TABLE `solicitudes_registro`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `admin`
--
ALTER TABLE `admin`
  MODIFY `adminId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `asistencia`
--
ALTER TABLE `asistencia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT de la tabla `clase`
--
ALTER TABLE `clase`
  MODIFY `claseId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `clienteId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `ejercicio`
--
ALTER TABLE `ejercicio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de la tabla `entrenadores`
--
ALTER TABLE `entrenadores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `inventario`
--
ALTER TABLE `inventario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `membresias`
--
ALTER TABLE `membresias`
  MODIFY `membresiaId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `pagos`
--
ALTER TABLE `pagos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `plan_entrenamiento`
--
ALTER TABLE `plan_entrenamiento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `rutina`
--
ALTER TABLE `rutina`
  MODIFY `rutinaId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `solicitudes_registro`
--
ALTER TABLE `solicitudes_registro`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `admin_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `asistencia`
--
ALTER TABLE `asistencia`
  ADD CONSTRAINT `asistencia_ibfk_1` FOREIGN KEY (`cliente_id`) REFERENCES `cliente` (`clienteId`) ON DELETE CASCADE;

--
-- Filtros para la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD CONSTRAINT `cliente_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `ejercicio`
--
ALTER TABLE `ejercicio`
  ADD CONSTRAINT `ejercicio_ibfk_1` FOREIGN KEY (`rutinaId`) REFERENCES `rutina` (`rutinaId`) ON DELETE CASCADE;

--
-- Filtros para la tabla `pagos`
--
ALTER TABLE `pagos`
  ADD CONSTRAINT `pagos_ibfk_1` FOREIGN KEY (`usuarioId`) REFERENCES `usuario` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pagos_ibfk_2` FOREIGN KEY (`membresiaId`) REFERENCES `membresias` (`membresiaId`) ON DELETE CASCADE;

--
-- Filtros para la tabla `rutina`
--
ALTER TABLE `rutina`
  ADD CONSTRAINT `rutina_ibfk_1` FOREIGN KEY (`planId`) REFERENCES `plan_entrenamiento` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
