-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 27-01-2023 a las 00:47:28
-- Versión del servidor: 8.0.30
-- Versión de PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `elcuji`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `casas`
--

CREATE TABLE `casas` (
  `id` bigint UNSIGNED NOT NULL,
  `casa_no` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `saldo` float(12,2) NOT NULL DEFAULT '0.00',
  `saldo_inicial` float(12,2) NOT NULL DEFAULT '0.00',
  `observacion` text COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `casas`
--

INSERT INTO `casas` (`id`, `casa_no`, `saldo`, `saldo_inicial`, `observacion`) VALUES
(1, '1', 161.84, 0.00, NULL),
(2, '2', 210.56, 0.00, NULL),
(3, '3', 210.56, 0.00, NULL),
(4, '4', 210.56, 0.00, NULL),
(5, '5', 210.56, 0.00, NULL),
(6, '6', 210.56, 0.00, NULL),
(7, '7', 210.56, 0.00, NULL),
(8, '8', 210.56, 0.00, NULL),
(9, '9', 210.56, 0.00, NULL),
(10, '10', 210.56, 12.50, NULL),
(11, '11', 210.56, 0.00, NULL),
(12, '12', 210.56, 0.00, NULL),
(13, '13', 210.56, 0.00, NULL),
(14, '14', 210.56, 25.25, NULL),
(15, '15', 210.56, 0.00, ''),
(16, '16', 195.56, 0.00, NULL),
(17, '17', 210.56, 0.00, NULL),
(18, '18', 210.56, 0.00, NULL),
(19, '19', 210.56, 0.00, NULL),
(20, '20', 182.20, 0.00, NULL),
(21, '21', 0.00, 10.00, NULL),
(22, '22', 182.20, 0.00, NULL),
(23, '23', 182.20, 0.00, NULL),
(24, '24', 182.20, 0.00, NULL),
(25, '25', 182.20, 0.00, NULL),
(26, '26', 182.20, 0.00, NULL),
(27, '27', 182.20, 0.00, NULL),
(28, '28', 182.20, 0.00, NULL),
(29, '29', 182.20, 0.00, NULL),
(30, '30', 182.20, 0.00, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalles`
--

CREATE TABLE `detalles` (
  `id` bigint UNSIGNED NOT NULL,
  `factura_id` bigint UNSIGNED NOT NULL,
  `gasto_id` bigint UNSIGNED NOT NULL,
  `monto` float(12,2) DEFAULT '0.00',
  `activo` tinyint DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `detalles`
--

INSERT INTO `detalles` (`id`, `factura_id`, `gasto_id`, `monto`, `activo`, `created_at`, `updated_at`) VALUES
(61, 29, 1, 30.00, 1, '2023-01-25 02:56:16', '2023-01-25 02:56:16'),
(62, 29, 2, 40.00, 1, '2023-01-25 02:56:18', '2023-01-25 02:56:18'),
(63, 29, 5, 50.00, 1, '2023-01-25 02:56:19', '2023-01-25 02:56:19'),
(64, 29, 6, 50.00, 1, '2023-01-25 02:56:23', '2023-01-25 02:56:23'),
(65, 29, 7, 60.00, 1, '2023-01-25 02:56:25', '2023-01-25 02:56:25'),
(66, 29, 3, 23.00, 1, '2023-01-25 02:56:27', '2023-01-25 02:56:27'),
(67, 29, 4, 25.00, 1, '2023-01-25 02:56:29', '2023-01-25 02:56:29'),
(68, 29, 8, 20.00, 1, '2023-01-25 02:56:31', '2023-01-25 02:56:31'),
(69, 30, 1, 35.00, 1, '2023-01-25 02:58:01', '2023-01-25 02:58:01'),
(70, 30, 2, 35.00, 1, '2023-01-25 02:58:02', '2023-01-25 02:58:02'),
(71, 30, 5, 60.00, 1, '2023-01-25 02:58:04', '2023-01-25 02:58:04'),
(72, 30, 6, 60.00, 1, '2023-01-25 02:58:05', '2023-01-25 02:58:05'),
(73, 30, 7, 60.00, 1, '2023-01-25 02:58:07', '2023-01-25 02:58:07'),
(74, 30, 3, 40.00, 1, '2023-01-25 02:58:08', '2023-01-25 02:58:08'),
(75, 30, 4, 30.00, 1, '2023-01-25 02:58:09', '2023-01-25 02:58:09'),
(76, 30, 8, 40.00, 1, '2023-01-25 02:58:10', '2023-01-25 02:58:10'),
(77, 31, 1, 40.00, 1, '2023-01-25 02:59:07', '2023-01-25 02:59:07'),
(78, 31, 2, 40.00, 1, '2023-01-25 02:59:09', '2023-01-25 02:59:09'),
(79, 31, 5, 60.00, 1, '2023-01-25 02:59:11', '2023-01-25 02:59:11'),
(80, 31, 6, 60.00, 1, '2023-01-25 02:59:12', '2023-01-25 02:59:12'),
(81, 31, 7, 60.00, 1, '2023-01-25 02:59:14', '2023-01-25 02:59:14'),
(82, 31, 3, 45.00, 1, '2023-01-25 02:59:15', '2023-01-25 02:59:15'),
(83, 31, 4, 45.00, 1, '2023-01-25 02:59:17', '2023-01-25 02:59:17'),
(84, 31, 8, 45.00, 1, '2023-01-25 02:59:19', '2023-01-25 02:59:19'),
(85, 32, 1, 40.00, 1, '2023-01-25 03:00:46', '2023-01-25 03:00:46'),
(86, 32, 2, 40.00, 1, '2023-01-25 03:00:49', '2023-01-25 03:00:49'),
(87, 32, 5, 65.00, 1, '2023-01-25 03:00:50', '2023-01-25 03:00:50'),
(88, 32, 6, 65.00, 1, '2023-01-25 03:00:51', '2023-01-25 03:00:51'),
(89, 32, 7, 70.00, 1, '2023-01-25 03:00:52', '2023-01-25 03:00:52'),
(90, 32, 3, 40.00, 1, '2023-01-25 03:00:54', '2023-01-25 03:00:54'),
(91, 32, 4, 40.00, 1, '2023-01-25 03:00:55', '2023-01-25 03:00:55'),
(92, 32, 8, 40.00, 1, '2023-01-25 03:00:56', '2023-01-25 03:00:56'),
(93, 33, 1, 50.00, 1, '2023-01-25 03:10:37', '2023-01-25 03:10:37'),
(94, 33, 2, 45.00, 1, '2023-01-25 03:10:39', '2023-01-25 03:10:39'),
(95, 33, 5, 70.00, 1, '2023-01-25 03:10:40', '2023-01-25 03:10:40'),
(96, 33, 6, 70.00, 1, '2023-01-25 03:10:41', '2023-01-25 03:10:41'),
(97, 33, 7, 70.00, 1, '2023-01-25 03:10:42', '2023-01-25 03:10:42'),
(98, 33, 3, 30.00, 1, '2023-01-25 03:10:44', '2023-01-25 03:10:44'),
(99, 33, 4, 40.00, 1, '2023-01-25 03:10:45', '2023-01-25 03:10:45'),
(100, 33, 8, 50.00, 1, '2023-01-25 03:10:46', '2023-01-25 03:10:46'),
(101, 34, 1, 60.00, 1, '2023-01-25 03:11:44', '2023-01-25 03:11:44'),
(102, 34, 2, 70.00, 1, '2023-01-25 03:11:45', '2023-01-25 03:11:45'),
(103, 34, 5, 70.00, 1, '2023-01-25 03:11:47', '2023-01-25 03:11:47'),
(104, 34, 6, 60.00, 1, '2023-01-25 03:11:48', '2023-01-25 03:11:48'),
(105, 34, 7, 70.00, 1, '2023-01-25 03:11:49', '2023-01-25 03:11:49'),
(106, 34, 3, 40.00, 1, '2023-01-25 03:11:50', '2023-01-25 03:11:50'),
(107, 34, 4, 60.00, 1, '2023-01-25 03:11:51', '2023-01-25 03:11:51'),
(108, 34, 8, 40.00, 1, '2023-01-25 03:11:53', '2023-01-25 03:11:53');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facturas`
--

CREATE TABLE `facturas` (
  `id` bigint UNSIGNED NOT NULL,
  `mes` int NOT NULL,
  `ano` int NOT NULL,
  `observacion` text,
  `fecha` datetime DEFAULT NULL,
  `monto` float(12,2) DEFAULT NULL,
  `dolar` float(12,2) DEFAULT NULL,
  `file_path` varchar(255) DEFAULT NULL,
  `publicado` tinyint DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `facturas`
--

INSERT INTO `facturas` (`id`, `mes`, `ano`, `observacion`, `fecha`, `monto`, `dolar`, `file_path`, `publicado`, `created_at`, `updated_at`) VALUES
(29, 6, 2022, '<p><strong>Formas de Pago:</strong></p><p><strong>Zelle:</strong> rosbeld.alvarez@gmail.com&nbsp;<br><strong>Transferencia: </strong>Cta. Cte. BANCO PROVINCIAL No 0108245700030170 a nombre de Karla Zambrano y/o &nbsp;Cta. Cte. BANCO PROVINCIAL No 01082413380100010013 a nombre de Gabriele Cardosi&nbsp;<br>&nbsp;</p>', '2022-06-01 22:57:12', 381.64, 20.52, 'storage/pdf/condominio/Junio-2022.pdf', 1, '2023-01-25 02:55:22', '2023-01-25 02:57:20'),
(30, 7, 2022, '<p><strong>Formas de Pago:</strong></p><p><strong>Zelle:</strong> rosbeld.alvarez@gmail.com&nbsp;<br><strong>Transferencia: </strong>Cta. Cte. BANCO PROVINCIAL No 0108245700030170 a nombre de Karla Zambrano y/o &nbsp;Cta. Cte. BANCO PROVINCIAL No 01082413380100010013 a nombre de Gabriele Cardosi&nbsp;<br>&nbsp;</p>', '2022-07-01 22:58:24', 454.80, 20.52, 'storage/pdf/condominio/Julio-2022.pdf', 1, '2023-01-25 02:57:20', '2023-01-25 02:58:28'),
(31, 8, 2022, '<p><strong>Formas de Pago:</strong></p><p><strong>Zelle:</strong> rosbeld.alvarez@gmail.com&nbsp;<br><strong>Transferencia: </strong>Cta. Cte. BANCO PROVINCIAL No 0108245700030170 a nombre de Karla Zambrano y/o &nbsp;Cta. Cte. BANCO PROVINCIAL No 01082413380100010013 a nombre de Gabriele Cardosi&nbsp;<br>&nbsp;</p>', '2022-08-01 22:59:33', 496.10, 20.52, 'storage/pdf/condominio/Agosto-2022.pdf', 1, '2023-01-25 02:58:28', '2023-01-25 02:59:36'),
(32, 9, 2022, '<p><strong>Formas de Pago:</strong></p><p><strong>Zelle:</strong> rosbeld.alvarez@gmail.com&nbsp;<br><strong>Transferencia: </strong>Cta. Cte. BANCO PROVINCIAL No 0108245700030170 a nombre de Karla Zambrano y/o &nbsp;Cta. Cte. BANCO PROVINCIAL No 01082413380100010013 a nombre de Gabriele Cardosi&nbsp;<br>&nbsp;</p>', '2022-09-01 23:01:27', 502.00, 20.52, 'storage/pdf/condominio/Septiembre-2022.pdf', 1, '2023-01-25 02:59:37', '2023-01-25 03:01:31'),
(33, 10, 2022, '<p><strong>Formas de Pago:</strong></p><p><strong>Zelle:</strong> rosbeld.alvarez@gmail.com&nbsp;<br><strong>Transferencia: </strong>Cta. Cte. BANCO PROVINCIAL No 0108245700030170 a nombre de Karla Zambrano y/o &nbsp;Cta. Cte. BANCO PROVINCIAL No 01082413380100010013 a nombre de Gabriele Cardosi&nbsp;<br>&nbsp;</p>', '2022-10-01 23:11:00', 531.50, 20.52, 'storage/pdf/condominio/Octubre-2022.pdf', 1, '2023-01-25 03:01:31', '2023-01-25 03:11:04'),
(34, 11, 2022, '<p><strong>Formas de Pago:</strong></p><p><strong>Zelle:</strong> rosbeld.alvarez@gmail.com&nbsp;<br><strong>Transferencia: </strong>Cta. Cte. BANCO PROVINCIAL No 0108245700030170 a nombre de Karla Zambrano y/o &nbsp;Cta. Cte. BANCO PROVINCIAL No 01082413380100010013 a nombre de Gabriele Cardosi&nbsp;<br>&nbsp;</p>', '2022-11-01 23:12:20', 584.60, 20.52, 'storage/pdf/condominio/Noviembre-2022.pdf', 1, '2023-01-25 03:11:05', '2023-01-25 03:12:24'),
(35, 12, 2022, '<p><strong>Formas de Pago:</strong></p><p><strong>Zelle:</strong> rosbeld.alvarez@gmail.com&nbsp;<br><strong>Transferencia: </strong>Cta. Cte. BANCO PROVINCIAL No 0108245700030170 a nombre de Karla Zambrano y/o &nbsp;Cta. Cte. BANCO PROVINCIAL No 01082413380100010013 a nombre de Gabriele Cardosi&nbsp;<br>&nbsp;</p>', NULL, NULL, NULL, NULL, 0, '2023-01-25 03:12:25', '2023-01-25 03:12:25');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fondos`
--

CREATE TABLE `fondos` (
  `id` bigint UNSIGNED NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `tipo` tinyint(1) DEFAULT '1',
  `activo` tinyint(1) DEFAULT '1',
  `monto` double(12,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `fondos`
--

INSERT INTO `fondos` (`id`, `descripcion`, `tipo`, `activo`, `monto`, `created_at`, `updated_at`) VALUES
(1, 'Fondo de Reserva', 1, 1, 10.00, '2023-01-03 00:20:18', '2023-01-03 00:56:06'),
(2, 'Fondo Complementario de Protección Económica', 1, 1, 8.00, '2023-01-03 00:55:53', '2023-01-03 00:55:53'),
(3, 'Fondo Navideño', 0, 1, 30.00, '2023-01-03 00:56:54', '2023-01-03 01:57:28');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fondo_detalles`
--

CREATE TABLE `fondo_detalles` (
  `id` bigint UNSIGNED NOT NULL,
  `factura_id` bigint UNSIGNED NOT NULL,
  `fondo_id` bigint UNSIGNED NOT NULL,
  `tarifa` float(12,2) DEFAULT NULL,
  `factor` tinyint DEFAULT NULL,
  `monto` float(12,2) DEFAULT NULL,
  `activo` tinyint DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `fondo_detalles`
--

INSERT INTO `fondo_detalles` (`id`, `factura_id`, `fondo_id`, `tarifa`, `factor`, `monto`, `activo`, `created_at`, `updated_at`) VALUES
(51, 29, 1, 10.00, 1, 29.80, 1, '2023-01-25 02:55:22', '2023-01-25 02:56:31'),
(52, 29, 2, 8.00, 1, 23.84, 1, '2023-01-25 02:55:22', '2023-01-25 02:56:31'),
(53, 29, 3, 30.00, 0, 30.00, 1, '2023-01-25 02:55:22', '2023-01-25 02:55:23'),
(54, 30, 1, 10.00, 1, 36.00, 1, '2023-01-25 02:57:20', '2023-01-25 02:58:10'),
(55, 30, 2, 8.00, 1, 28.80, 1, '2023-01-25 02:57:20', '2023-01-25 02:58:10'),
(56, 30, 3, 30.00, 0, 30.00, 1, '2023-01-25 02:57:20', '2023-01-25 02:57:21'),
(57, 31, 1, 10.00, 1, 39.50, 1, '2023-01-25 02:58:28', '2023-01-25 02:59:19'),
(58, 31, 2, 8.00, 1, 31.60, 1, '2023-01-25 02:58:28', '2023-01-25 02:59:19'),
(59, 31, 3, 30.00, 0, 30.00, 1, '2023-01-25 02:58:28', '2023-01-25 02:58:29'),
(60, 32, 1, 10.00, 1, 40.00, 1, '2023-01-25 02:59:38', '2023-01-25 03:00:56'),
(61, 32, 2, 8.00, 1, 32.00, 1, '2023-01-25 02:59:38', '2023-01-25 03:00:57'),
(62, 32, 3, 30.00, 0, 30.00, 1, '2023-01-25 02:59:38', '2023-01-25 02:59:38'),
(63, 33, 1, 10.00, 1, 42.50, 1, '2023-01-25 03:01:31', '2023-01-25 03:10:46'),
(64, 33, 2, 8.00, 1, 34.00, 1, '2023-01-25 03:01:31', '2023-01-25 03:10:46'),
(65, 33, 3, 30.00, 0, 30.00, 1, '2023-01-25 03:01:31', '2023-01-25 03:01:32'),
(66, 34, 1, 10.00, 1, 47.00, 1, '2023-01-25 03:11:05', '2023-01-25 03:11:53'),
(67, 34, 2, 8.00, 1, 37.60, 1, '2023-01-25 03:11:05', '2023-01-25 03:11:53'),
(68, 34, 3, 30.00, 0, 30.00, 1, '2023-01-25 03:11:05', '2023-01-25 03:11:06'),
(69, 35, 1, 10.00, 1, 0.00, 1, '2023-01-25 03:12:25', '2023-01-25 03:12:25'),
(70, 35, 2, 8.00, 1, 0.00, 1, '2023-01-25 03:12:25', '2023-01-25 03:12:26'),
(71, 35, 3, 30.00, 0, 30.00, 1, '2023-01-25 03:12:25', '2023-01-25 03:12:26');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `gastos`
--

CREATE TABLE `gastos` (
  `id` bigint UNSIGNED NOT NULL,
  `descripcion` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `monto` double(10,2) DEFAULT NULL,
  `fijo` tinyint(1) NOT NULL DEFAULT '0',
  `activo` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `gastos`
--

INSERT INTO `gastos` (`id`, `descripcion`, `monto`, `fijo`, `activo`, `created_at`, `updated_at`) VALUES
(1, 'Gasto Mantenimiento', NULL, 1, 1, '2022-12-22 20:48:56', '2022-12-22 20:48:56'),
(2, 'Limpieza de las áreas verdes del Conjunto Residensial', NULL, 1, 1, '2022-12-22 22:04:59', '2022-12-23 18:23:46'),
(3, 'Reparación del Cerco eléctrico', NULL, 0, 1, '2022-12-23 15:52:03', '2022-12-23 16:19:01'),
(4, 'Mantenimiento de áreas comunes, Pintura y MO Paredes Blancas  (Estacionamiento, Cancha, Cuarto de Basura, Parque y Bombas)', NULL, 0, 1, '2023-01-06 16:56:47', '2023-01-06 16:56:47'),
(5, 'CORPOELEC (Estimado)', NULL, 1, 1, '2023-01-11 00:22:53', '2023-01-11 00:22:53'),
(6, 'Servicio HIDROLARA (Estimado)', NULL, 1, 1, '2023-01-12 20:03:24', '2023-01-12 20:03:24'),
(7, 'Administración', NULL, 1, 1, '2023-01-12 20:04:09', '2023-01-12 20:04:09'),
(8, 'Recolección y eliminación de residuos vegetales y desechos domésticos, y Materiales e Insumos de mantenimiento', NULL, 0, 1, '2023-01-14 00:01:07', '2023-01-14 00:01:07');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2014_10_12_200000_add_two_factor_columns_to_users_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2022_12_09_125726_create_sessions_table', 1),
(7, '2022_12_13_193826_create_casas_table', 1),
(8, '2022_12_13_195050_create_user_casa_table', 1),
(9, '2022_12_22_125211_create_gastos_table', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagos`
--

CREATE TABLE `pagos` (
  `id` bigint UNSIGNED NOT NULL,
  `casa_id` bigint UNSIGNED NOT NULL,
  `fecha` datetime DEFAULT NULL,
  `concepto` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `forma_pago` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `referencia` varchar(255) DEFAULT NULL,
  `monto` float(12,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `pagos`
--

INSERT INTO `pagos` (`id`, `casa_id`, `fecha`, `concepto`, `forma_pago`, `referencia`, `monto`, `created_at`, `updated_at`) VALUES
(2, 21, '2022-06-22 00:00:00', 'Pago de Junio', '	Transferencia', '33220000', 12.72, '2023-01-23 00:51:05', '2023-01-23 00:51:05'),
(3, 21, '2022-07-25 00:00:00', 'Pago Julio', '	Transferencia', '54335435', 15.16, '2023-01-26 01:37:55', '2023-01-26 01:37:55'),
(4, 21, '2022-08-25 00:00:00', 'Pago Agosto', 'Zelle', 'dffd5454', 16.54, '2023-01-26 01:41:25', '2023-01-26 01:41:25'),
(5, 1, '2022-09-10 00:00:00', 'Pago Septiembre y Abono de otros meses de deuda', '	Transferencia', 'sdfsdfsd', 16.73, '2023-01-26 01:43:15', '2023-01-26 01:43:15'),
(7, 21, '2022-09-06 00:00:00', 'Pago Septiembre y Abono de otros Meses de Deuda y sigamos aumentando a ver', 'Zelle', 'dfgd44dfg5d', 16.73, '2023-01-26 01:52:54', '2023-01-26 01:52:54'),
(8, 1, '2022-10-10 00:00:00', 'Pago Octubre', 'Efectivo', '1234567', 17.72, '2023-01-26 01:54:07', '2023-01-26 01:54:07'),
(9, 21, '2022-10-10 00:00:00', 'Pago Octubre', 'Efectivo', '234543', 17.72, '2023-01-26 01:55:19', '2023-01-26 01:55:19'),
(11, 16, '2023-01-25 00:00:00', 'Porfin Pagó', 'Transferencia', '09876', 15.00, '2023-01-26 03:42:34', '2023-01-26 03:42:34');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('D0ZXIipSRSvErnymIh6b7aHcR6ICugsmNClpV2VA', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiUUJtU3hIbk91MGhGdzlsMHd4djRjZmRtc0ZhRG02RUkwM2k4dTZVMCI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjM3OiJodHRwOi8vZWxjdWppLnRlc3QvY29uZG9taW5pby9jYXNhLzIxIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1674780320),
('L2opNN2k6Mv7BT2weAQ6z91AndbOvRRGNwt3qiZB', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiT1dKN1U0SUdhblgyZkFZODh3YWE5TTlJY3d4enZYWFZIeUtycGg0OCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly9lbGN1amkudGVzdC9jb25kb21pbmlvL2Nhc2EvMjEiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', 1674754622),
('LPgzjlakP0jbFDISeuGzFy6MWTV3XxsDqHw5Ambv', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiMFZVc0lxRUtKeWJOVXJOS1RodG5VRGdiWkxiS3ozYzhkcW9MQmRiaiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHA6Ly9lbGN1amkudGVzdC9jb25kb21pbmlvL3BhZ29zIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTt9', 1674690502),
('sxJp9nd3BA1AwXOcCnHR4zYzgIqTPxrHlXMxHXOr', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/109.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiaVk1a2lVb1hGcmJFdTdSdDJIejlzMk12c1U5R3B4Q0ZlREc5eEk3eSI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozNzoiaHR0cDovL2VsY3VqaS50ZXN0L2NvbmRvbWluaW8vY2FzYS8yMSI7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjM3OiJodHRwOi8vZWxjdWppLnRlc3QvY29uZG9taW5pby9jYXNhLzIxIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1674766686);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `nombre` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apellido` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cedula` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefono` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fecha_nac` datetime DEFAULT NULL,
  `rol_id` bigint UNSIGNED NOT NULL DEFAULT '1',
  `propietario` tinyint(1) NOT NULL DEFAULT '1',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `profile_photo_path` varchar(2048) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `two_factor_secret` text COLLATE utf8mb4_unicode_ci,
  `two_factor_recovery_codes` text COLLATE utf8mb4_unicode_ci,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `nombre`, `apellido`, `cedula`, `email`, `password`, `telefono`, `fecha_nac`, `rol_id`, `propietario`, `status`, `profile_photo_path`, `email_verified_at`, `two_factor_secret`, `two_factor_recovery_codes`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Hely Antonio', 'Chirinos Herrera', '7222809', 'helychirinos@gmail.com', '$2y$10$F1Y/id.0zWreVIdwnn6pou9KBVXiEt8FaUeWh9QGejTznWbRzuI7S', '0414-5331332', '1963-12-07 00:00:00', 1, 1, 1, NULL, NULL, NULL, NULL, NULL, '2022-12-22 16:59:47', '2022-12-22 16:59:47'),
(2, 'Rafael Guillermo', 'Cabrera Perdomo', '11234567', 'rafacabrera@gmail.com', '$2y$10$OG.TVdSN.MVUu0u0AQjXF.BmoxuwX90u1pSG8d7o2cYoYHYN/5eMO', NULL, NULL, 1, 1, 1, NULL, NULL, NULL, NULL, NULL, '2022-12-22 16:59:47', '2022-12-22 16:59:47'),
(3, 'Gabriel', 'Cardosi', '3245623', 'gabicardosi@gmail.com', '$2y$10$hrO4/KqOBSJW7yqAQGRTf.MuNCPBMSV5uu2LDUnmEKswzD4sWRWBO', NULL, NULL, 1, 1, 1, NULL, NULL, NULL, NULL, NULL, '2022-12-22 16:59:47', '2022-12-22 16:59:47'),
(4, 'Nedo', 'Cardosi', '4433557', 'nedocardosi@gmail.com', '$2y$10$PjGqsgwdBQ58Fw57anSKEeGrmxfpPlHoD1ktEE6t0ZCQjwy3QQY22', NULL, NULL, 1, 1, 1, NULL, NULL, NULL, NULL, NULL, '2022-12-22 16:59:47', '2022-12-22 16:59:47'),
(5, 'Silvia', 'Pacheco', '3243242', 'silvis@gmail.com', '$2y$10$Kb.T5/QM.Kgd5ZrasX/Tle6XxpNk48689o2d1wj/qZVUgpukpy0Qu', NULL, NULL, 1, 1, 1, NULL, NULL, NULL, NULL, NULL, '2022-12-22 16:59:47', '2022-12-22 16:59:47'),
(6, 'Karla', 'Zambrano', '32223199', 'karlaz@gmail.com', '$2y$10$MG63/57OrEqWh7EiZcCmN.Yt6N1hh4SN7/4JRCB8dXglS2Gi8E6KS', NULL, NULL, 1, 1, 1, NULL, NULL, NULL, NULL, NULL, '2022-12-22 16:59:47', '2022-12-22 16:59:47'),
(7, 'Wilkys', 'Riera', '4334452', 'wilkysr@gmail.com', '$2y$10$kbd.H.Zj03talaH5O3k8F.cUpgbwMWupA.OhiZT.7fK3Ks0dYTV12', NULL, NULL, 1, 1, 1, NULL, NULL, NULL, NULL, NULL, '2022-12-22 16:59:47', '2022-12-22 16:59:47'),
(9, 'Helyana Del Valle', 'Chirinos Franco', '21333444', 'helyana28@hotmail.com', '$2y$10$AZjBY404ryEbrM7FXaVAkeBBsuMnuws6/MNfH/Mhr9oqekgSL4oPW', NULL, NULL, 1, 0, 1, NULL, NULL, NULL, NULL, NULL, '2022-12-22 16:59:47', '2022-12-22 16:59:47'),
(10, 'Luis', 'Franco Alfonzo', '7233445', 'amdvfa@gmail.com', '$2y$10$W3RBd/7/bQlMds248UmdUOKzuGxj6lpURqJ3wbZlRR9.86TXKq2yO', NULL, NULL, 1, 1, 1, NULL, NULL, NULL, NULL, NULL, '2022-12-22 16:59:47', '2022-12-22 16:59:47'),
(11, 'Raul', 'Escalona', '2999888', 'raulE@gmail.com', '$2y$10$yzDBLrzhXJkNKg4TiQF6..L47Z/ZJJF5ocz67qIL5gtEe9ucDstXC', '0416-288432', NULL, 1, 1, 1, NULL, NULL, NULL, NULL, NULL, '2022-12-22 16:59:47', '2022-12-22 16:59:47');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_casa`
--

CREATE TABLE `user_casa` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `casa_id` bigint UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `user_casa`
--

INSERT INTO `user_casa` (`id`, `user_id`, `casa_id`) VALUES
(1, 1, 21),
(2, 1, 30),
(3, 2, 14),
(4, 3, 20),
(5, 4, 19),
(6, 5, 14),
(7, 6, 10),
(8, 7, 10),
(9, 9, 21),
(10, 10, 28),
(11, 11, 15);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `casas`
--
ALTER TABLE `casas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `detalles`
--
ALTER TABLE `detalles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `factura_id` (`factura_id`),
  ADD KEY `Fk_gasto_id_gasto` (`gasto_id`);

--
-- Indices de la tabla `facturas`
--
ALTER TABLE `facturas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indices de la tabla `fondos`
--
ALTER TABLE `fondos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `fondo_detalles`
--
ALTER TABLE `fondo_detalles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_det_fondos_fact` (`factura_id`),
  ADD KEY `fk_det_fondos_fondos` (`fondo_id`);

--
-- Indices de la tabla `gastos`
--
ALTER TABLE `gastos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pagos`
--
ALTER TABLE `pagos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indices de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indices de la tabla `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_cedula_unique` (`cedula`);

--
-- Indices de la tabla `user_casa`
--
ALTER TABLE `user_casa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_owner_user` (`user_id`),
  ADD KEY `fk_owner_casa` (`casa_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `casas`
--
ALTER TABLE `casas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de la tabla `detalles`
--
ALTER TABLE `detalles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;

--
-- AUTO_INCREMENT de la tabla `facturas`
--
ALTER TABLE `facturas`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT de la tabla `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `fondos`
--
ALTER TABLE `fondos`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `fondo_detalles`
--
ALTER TABLE `fondo_detalles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT de la tabla `gastos`
--
ALTER TABLE `gastos`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `pagos`
--
ALTER TABLE `pagos`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `user_casa`
--
ALTER TABLE `user_casa`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detalles`
--
ALTER TABLE `detalles`
  ADD CONSTRAINT `fk_factura_id_fact` FOREIGN KEY (`factura_id`) REFERENCES `facturas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Fk_gasto_id_gasto` FOREIGN KEY (`gasto_id`) REFERENCES `gastos` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `fondo_detalles`
--
ALTER TABLE `fondo_detalles`
  ADD CONSTRAINT `fk_det_fondos_fact` FOREIGN KEY (`factura_id`) REFERENCES `facturas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_det_fondos_fondos` FOREIGN KEY (`fondo_id`) REFERENCES `fondos` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Filtros para la tabla `user_casa`
--
ALTER TABLE `user_casa`
  ADD CONSTRAINT `fk_owner_casa` FOREIGN KEY (`casa_id`) REFERENCES `casas` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_owner_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
