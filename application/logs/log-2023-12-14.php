<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2023-12-14 08:27:56 --> 404 Page Not Found: Metricas/cdn.datatables.net
ERROR - 2023-12-14 08:27:56 --> 404 Page Not Found: Metricas/cdn.datatables.net
ERROR - 2023-12-14 08:56:27 --> Severity: Notice --> Undefined variable: labels C:\laragon\www\facturas\application\views\metricas\ordenes.php 74
ERROR - 2023-12-14 08:56:29 --> Severity: Notice --> Undefined variable: labels C:\laragon\www\facturas\application\views\metricas\ordenes.php 74
ERROR - 2023-12-14 10:09:57 --> Severity: Notice --> Array to string conversion C:\laragon\www\facturas\application\controllers\Metricas.php 19
ERROR - 2023-12-14 10:18:43 --> Query error: In aggregated query without GROUP BY, expression #2 of SELECT list contains nonaggregated column 'facturas.clientes.nombre'; this is incompatible with sql_mode=only_full_group_by - Invalid query: SELECT SUM(total) as total, `clientes`.`nombre`, `clientes`.`apellido`
FROM `ordenes`
JOIN `clientes` ON `clientes`.`id` = `ordenes`.`cliente_id`
ERROR - 2023-12-14 10:26:47 --> Query error: Unknown column 'cantidad' in 'field list' - Invalid query: SELECT SUM(cantidad) as cantidad, SUM(valor) as valor, `producto`.`detalle`
FROM `ordenes`
JOIN `productos` ON `productos`.`id` = `ordenes`.`producto_id`
GROUP BY `productos`.`id`
ORDER BY `cantidad`
ERROR - 2023-12-14 10:27:04 --> Query error: Unknown column 'cantidad' in 'field list' - Invalid query: SELECT SUM(cantidad) as cantidad, SUM(valor) as valor, `producto`.`detalle`
FROM `ordenes`
JOIN `productos` ON `productos`.`id` = `ordenes`.`producto_id`
GROUP BY `productos`.`id`
ERROR - 2023-12-14 10:27:05 --> Query error: Unknown column 'cantidad' in 'field list' - Invalid query: SELECT SUM(cantidad) as cantidad, SUM(valor) as valor, `producto`.`detalle`
FROM `ordenes`
JOIN `productos` ON `productos`.`id` = `ordenes`.`producto_id`
GROUP BY `productos`.`id`
ERROR - 2023-12-14 10:28:19 --> Query error: Unknown column 'producto.detalle' in 'field list' - Invalid query: SELECT SUM(cantidad) as cantidad, SUM(valor) as valor, `producto`.`detalle`
FROM `ordenes`
JOIN `detalle_orden` ON `orden`.`id` = `detalle_orden`.`orden_id`
JOIN `productos` ON `productos`.`id` = `detalle_orden`.`producto_id`
GROUP BY `productos`.`id`
ORDER BY `cantidad`
ERROR - 2023-12-14 10:28:26 --> Query error: Unknown column 'orden.id' in 'on clause' - Invalid query: SELECT SUM(cantidad) as cantidad, SUM(valor) as valor, `productos`.`detalle`
FROM `ordenes`
JOIN `detalle_orden` ON `orden`.`id` = `detalle_orden`.`orden_id`
JOIN `productos` ON `productos`.`id` = `detalle_orden`.`producto_id`
GROUP BY `productos`.`id`
ORDER BY `cantidad`
