/* Replace this file with actual dump of your database */

-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-11-2015 a las 18:50:55
-- Versión del servidor: 5.6.24
-- Versión de PHP: 5.5.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `trogue`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `accesorios`
--

CREATE TABLE IF NOT EXISTS `accesorios` (
  `id` int(10) unsigned NOT NULL,
  `serie` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `estado` tinyint(1) NOT NULL,
  `tipo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `proveedor_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `acopios`
--

CREATE TABLE IF NOT EXISTS `acopios` (
  `id` int(10) unsigned NOT NULL,
  `feha` date NOT NULL,
  `cantidad` decimal(8,2) NOT NULL,
  `cantidad_total` decimal(9,2) NOT NULL,
  `proveedor_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `anexos`
--

CREATE TABLE IF NOT EXISTS `anexos` (
  `id` int(10) unsigned NOT NULL,
  `descripcion` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `observacion` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ruta_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comprobante_adjunto`
--

CREATE TABLE IF NOT EXISTS `comprobante_adjunto` (
  `id` int(10) unsigned NOT NULL,
  `num_comprobante` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tipo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `monto` decimal(9,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_descuento_liquidacion`
--

CREATE TABLE IF NOT EXISTS `detalle_descuento_liquidacion` (
  `id` int(10) unsigned NOT NULL,
  `descripcion` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fecha` date NOT NULL,
  `monto` decimal(9,2) NOT NULL,
  `liquidacion_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_liquidaciones`
--

CREATE TABLE IF NOT EXISTS `detalle_liquidaciones` (
  `id` int(10) unsigned NOT NULL,
  `dia` date NOT NULL,
  `cantidad` decimal(9,2) NOT NULL,
  `liquidacion_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `insidencias`
--

CREATE TABLE IF NOT EXISTS `insidencias` (
  `id` int(10) unsigned NOT NULL,
  `cantidad` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tipo` enum('descuento','observacion') COLLATE utf8_unicode_ci NOT NULL,
  `observacion` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `acopio_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `letras`
--

CREATE TABLE IF NOT EXISTS `letras` (
  `id` int(10) unsigned NOT NULL,
  `cantidad` decimal(9,2) NOT NULL,
  `fecha_vencimiento` date NOT NULL,
  `observacion` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `estado` tinyint(1) NOT NULL,
  `prestamo_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `liquidaciones`
--

CREATE TABLE IF NOT EXISTS `liquidaciones` (
  `id` int(10) unsigned NOT NULL,
  `numero` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `precio_ref` decimal(8,2) NOT NULL,
  `solidos` int(11) NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date NOT NULL,
  `descuentos` decimal(8,2) NOT NULL,
  `litros` decimal(8,2) NOT NULL,
  `pago_neto` decimal(8,2) NOT NULL,
  `ruta_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pago_letras`
--

CREATE TABLE IF NOT EXISTS `pago_letras` (
  `id` int(10) unsigned NOT NULL,
  `fecha_pago` date NOT NULL,
  `pago_proveedor_id` int(10) unsigned NOT NULL,
  `letra_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pago_proveedor`
--

CREATE TABLE IF NOT EXISTS `pago_proveedor` (
  `id` int(10) unsigned NOT NULL,
  `fecha_inicio` date NOT NULL,
  `fecha_fin` date NOT NULL,
  `precio_litro` decimal(9,2) NOT NULL,
  `total_descontado` decimal(9,2) NOT NULL,
  `pago_total` decimal(9,2) NOT NULL,
  `liquidacion_id` int(10) unsigned NOT NULL,
  `proveedor_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `peso_balanza`
--

CREATE TABLE IF NOT EXISTS `peso_balanza` (
  `id` int(10) unsigned NOT NULL,
  `cantidad` decimal(9,2) NOT NULL,
  `fecha` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prestamos`
--

CREATE TABLE IF NOT EXISTS `prestamos` (
  `id` int(10) unsigned NOT NULL,
  `descripcion` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cantidad` decimal(9,2) NOT NULL,
  `prioridad` int(11) NOT NULL,
  `estado` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `proveedor_id` int(10) unsigned NOT NULL,
  `recurso_id` int(10) unsigned NOT NULL,
  `documento_adjunto_id` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE IF NOT EXISTS `proveedores` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `apellidoP` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `apellidoM` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `dni` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `celular` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `foto` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `estado` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `anexo_id` int(10) unsigned NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pruebas`
--

CREATE TABLE IF NOT EXISTS `pruebas` (
  `id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recursos`
--

CREATE TABLE IF NOT EXISTS `recursos` (
  `id` int(10) unsigned NOT NULL,
  `descripcion` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tipo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rutas`
--

CREATE TABLE IF NOT EXISTS `rutas` (
  `id` int(10) unsigned NOT NULL,
  `descripcion` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `observacion` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `accesorios`
--
ALTER TABLE `accesorios`
  ADD PRIMARY KEY (`id`), ADD KEY `accesorios_proveedor_id_index` (`proveedor_id`);

--
-- Indices de la tabla `acopios`
--
ALTER TABLE `acopios`
  ADD PRIMARY KEY (`id`), ADD KEY `acopios_proveedor_id_index` (`proveedor_id`);

--
-- Indices de la tabla `anexos`
--
ALTER TABLE `anexos`
  ADD PRIMARY KEY (`id`), ADD KEY `anexos_ruta_id_index` (`ruta_id`);

--
-- Indices de la tabla `comprobante_adjunto`
--
ALTER TABLE `comprobante_adjunto`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `detalle_descuento_liquidacion`
--
ALTER TABLE `detalle_descuento_liquidacion`
  ADD PRIMARY KEY (`id`), ADD KEY `detalle_descuento_liquidacion_liquidacion_id_index` (`liquidacion_id`);

--
-- Indices de la tabla `detalle_liquidaciones`
--
ALTER TABLE `detalle_liquidaciones`
  ADD PRIMARY KEY (`id`), ADD KEY `detalle_liquidaciones_liquidacion_id_index` (`liquidacion_id`);

--
-- Indices de la tabla `insidencias`
--
ALTER TABLE `insidencias`
  ADD PRIMARY KEY (`id`), ADD KEY `insidencias_acopio_id_index` (`acopio_id`);

--
-- Indices de la tabla `letras`
--
ALTER TABLE `letras`
  ADD PRIMARY KEY (`id`), ADD KEY `letras_prestamo_id_index` (`prestamo_id`);

--
-- Indices de la tabla `liquidaciones`
--
ALTER TABLE `liquidaciones`
  ADD PRIMARY KEY (`id`), ADD KEY `liquidaciones_ruta_id_index` (`ruta_id`);

--
-- Indices de la tabla `pago_letras`
--
ALTER TABLE `pago_letras`
  ADD PRIMARY KEY (`id`), ADD KEY `pago_letras_pago_proveedor_id_index` (`pago_proveedor_id`), ADD KEY `pago_letras_letra_id_index` (`letra_id`);

--
-- Indices de la tabla `pago_proveedor`
--
ALTER TABLE `pago_proveedor`
  ADD PRIMARY KEY (`id`), ADD KEY `pago_proveedor_liquidacion_id_index` (`liquidacion_id`), ADD KEY `pago_proveedor_proveedor_id_index` (`proveedor_id`);

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`), ADD KEY `password_resets_token_index` (`token`);

--
-- Indices de la tabla `peso_balanza`
--
ALTER TABLE `peso_balanza`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `prestamos`
--
ALTER TABLE `prestamos`
  ADD PRIMARY KEY (`id`), ADD KEY `prestamos_documento_adjunto_id_foreign` (`documento_adjunto_id`), ADD KEY `prestamos_proveedor_id_index` (`proveedor_id`), ADD KEY `prestamos_recurso_id_index` (`recurso_id`);

--
-- Indices de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD PRIMARY KEY (`id`), ADD KEY `proveedores_anexo_id_index` (`anexo_id`);

--
-- Indices de la tabla `pruebas`
--
ALTER TABLE `pruebas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `recursos`
--
ALTER TABLE `recursos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `rutas`
--
ALTER TABLE `rutas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `accesorios`
--
ALTER TABLE `accesorios`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `acopios`
--
ALTER TABLE `acopios`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT de la tabla `anexos`
--
ALTER TABLE `anexos`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `comprobante_adjunto`
--
ALTER TABLE `comprobante_adjunto`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `detalle_descuento_liquidacion`
--
ALTER TABLE `detalle_descuento_liquidacion`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `detalle_liquidaciones`
--
ALTER TABLE `detalle_liquidaciones`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `insidencias`
--
ALTER TABLE `insidencias`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `letras`
--
ALTER TABLE `letras`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `liquidaciones`
--
ALTER TABLE `liquidaciones`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `pago_letras`
--
ALTER TABLE `pago_letras`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `pago_proveedor`
--
ALTER TABLE `pago_proveedor`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `peso_balanza`
--
ALTER TABLE `peso_balanza`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `prestamos`
--
ALTER TABLE `prestamos`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `pruebas`
--
ALTER TABLE `pruebas`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `recursos`
--
ALTER TABLE `recursos`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `rutas`
--
ALTER TABLE `rutas`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `accesorios`
--
ALTER TABLE `accesorios`
ADD CONSTRAINT `accesorios_proveedor_id_foreign` FOREIGN KEY (`proveedor_id`) REFERENCES `proveedores` (`id`);

--
-- Filtros para la tabla `acopios`
--
ALTER TABLE `acopios`
ADD CONSTRAINT `acopios_proveedor_id_foreign` FOREIGN KEY (`proveedor_id`) REFERENCES `proveedores` (`id`);

--
-- Filtros para la tabla `anexos`
--
ALTER TABLE `anexos`
ADD CONSTRAINT `anexos_ruta_id_foreign` FOREIGN KEY (`ruta_id`) REFERENCES `rutas` (`id`);

--
-- Filtros para la tabla `detalle_descuento_liquidacion`
--
ALTER TABLE `detalle_descuento_liquidacion`
ADD CONSTRAINT `detalle_descuento_liquidacion_liquidacion_id_foreign` FOREIGN KEY (`liquidacion_id`) REFERENCES `liquidaciones` (`id`);

--
-- Filtros para la tabla `detalle_liquidaciones`
--
ALTER TABLE `detalle_liquidaciones`
ADD CONSTRAINT `detalle_liquidaciones_liquidacion_id_foreign` FOREIGN KEY (`liquidacion_id`) REFERENCES `liquidaciones` (`id`);

--
-- Filtros para la tabla `insidencias`
--
ALTER TABLE `insidencias`
ADD CONSTRAINT `insidencias_acopio_id_foreign` FOREIGN KEY (`acopio_id`) REFERENCES `acopios` (`id`);

--
-- Filtros para la tabla `letras`
--
ALTER TABLE `letras`
ADD CONSTRAINT `letras_prestamo_id_foreign` FOREIGN KEY (`prestamo_id`) REFERENCES `prestamos` (`id`);

--
-- Filtros para la tabla `liquidaciones`
--
ALTER TABLE `liquidaciones`
ADD CONSTRAINT `liquidaciones_ruta_id_foreign` FOREIGN KEY (`ruta_id`) REFERENCES `rutas` (`id`);

--
-- Filtros para la tabla `pago_letras`
--
ALTER TABLE `pago_letras`
ADD CONSTRAINT `pago_letras_letra_id_foreign` FOREIGN KEY (`letra_id`) REFERENCES `letras` (`id`),
ADD CONSTRAINT `pago_letras_pago_proveedor_id_foreign` FOREIGN KEY (`pago_proveedor_id`) REFERENCES `pago_proveedor` (`id`);

--
-- Filtros para la tabla `pago_proveedor`
--
ALTER TABLE `pago_proveedor`
ADD CONSTRAINT `pago_proveedor_liquidacion_id_foreign` FOREIGN KEY (`liquidacion_id`) REFERENCES `liquidaciones` (`id`),
ADD CONSTRAINT `pago_proveedor_proveedor_id_foreign` FOREIGN KEY (`proveedor_id`) REFERENCES `proveedores` (`id`);

--
-- Filtros para la tabla `prestamos`
--
ALTER TABLE `prestamos`
ADD CONSTRAINT `prestamos_documento_adjunto_id_foreign` FOREIGN KEY (`documento_adjunto_id`) REFERENCES `comprobante_adjunto` (`id`),
ADD CONSTRAINT `prestamos_proveedor_id_foreign` FOREIGN KEY (`proveedor_id`) REFERENCES `proveedores` (`id`),
ADD CONSTRAINT `prestamos_recurso_id_foreign` FOREIGN KEY (`recurso_id`) REFERENCES `recursos` (`id`);

--
-- Filtros para la tabla `proveedores`
--
ALTER TABLE `proveedores`
ADD CONSTRAINT `proveedores_anexo_id_foreign` FOREIGN KEY (`anexo_id`) REFERENCES `anexos` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
