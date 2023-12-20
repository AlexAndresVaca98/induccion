<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2023-12-08 03:26:25 --> Severity: Notice --> Undefined variable: clientes C:\laragon\www\facturas\application\views\ordenes\gestionar.php 17
ERROR - 2023-12-08 04:22:39 --> Severity: Notice --> Undefined property: DetallesOrdenes::$producto C:\laragon\www\facturas\application\controllers\DetallesOrdenes.php 30
ERROR - 2023-12-08 04:22:39 --> Severity: error --> Exception: Call to a member function find() on null C:\laragon\www\facturas\application\controllers\DetallesOrdenes.php 30
ERROR - 2023-12-08 04:23:14 --> Severity: Notice --> Undefined property: DetallesOrdenes::$producto C:\laragon\www\facturas\application\controllers\DetallesOrdenes.php 30
ERROR - 2023-12-08 04:23:14 --> Severity: error --> Exception: Call to a member function find() on null C:\laragon\www\facturas\application\controllers\DetallesOrdenes.php 30
ERROR - 2023-12-08 04:23:48 --> Severity: Notice --> Trying to get property 'valor' of non-object C:\laragon\www\facturas\application\controllers\DetallesOrdenes.php 32
ERROR - 2023-12-08 04:23:48 --> Query error: Column 'producto_id' cannot be null - Invalid query: INSERT INTO `detalle_orden` (`orden_id`, `producto_id`, `cantidad`, `total`) VALUES ('23', NULL, '1', 0)
ERROR - 2023-12-08 04:33:32 --> Severity: Notice --> Undefined property: DetallesOrdenes::$obtenerPorOrden C:\laragon\www\facturas\application\controllers\DetallesOrdenes.php 51
ERROR - 2023-12-08 04:33:32 --> Severity: error --> Exception: Call to a member function get() on null C:\laragon\www\facturas\application\controllers\DetallesOrdenes.php 51
ERROR - 2023-12-08 04:34:11 --> Query error: Unknown column 'producto.detalle' in 'field list' - Invalid query: SELECT `detalle_orden`.*, `producto`.`detalle`
FROM `detalle_orden`
JOIN `productos` ON `detalle_orden`.`producto_id` = `producto`.`id`
WHERE `detalle_orden`.`producto_id` = '23'
ERROR - 2023-12-08 04:34:46 --> Query error: Unknown column 'producto.id' in 'on clause' - Invalid query: SELECT `detalle_orden`.*, `productos`.`detalle`
FROM `detalle_orden`
JOIN `productos` ON `detalle_orden`.`producto_id` = `producto`.`id`
WHERE `detalle_orden`.`producto_id` = '23'
