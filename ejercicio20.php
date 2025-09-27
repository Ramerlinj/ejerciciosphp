<?php
/*
EJERCICIO 20 - FUNCIONES DE FECHAS EN PHP
==========================================

DOCUMENTACION:
- date(): Formatea una fecha/hora local
- time(): Devuelve el timestamp Unix actual
- strtotime(): Convierte descripción de fecha/hora en timestamp
- DateTime: Clase para manejo avanzado de fechas

FORMATOS COMUNES:
- Y: Año con 4 dígitos
- m: Mes con 2 dígitos (01-12)
- d: Día con 2 dígitos (01-31)
- H: Hora en formato 24h (00-23)
- i: Minutos (00-59)
- s: Segundos (00-59)
*/

echo "<h2>EJERCICIO 20 - FUNCIONES DE FECHAS</h2>";

// EJEMPLO 1: Funciones básicas de fecha
echo "<h3>Ejemplo 1: Funciones Básicas</h3>";

// Obtener fecha y hora actual
$fecha_actual = date('Y-m-d H:i:s');
echo "Fecha y hora actual: $fecha_actual<br>";

// Diferentes formatos de fecha
echo "Formato español: " . date('d/m/Y') . "<br>";
echo "Formato largo: " . date('l, F j, Y') . "<br>";
echo "Solo la hora: " . date('H:i:s') . "<br>";

// Timestamp actual
$timestamp = time();
echo "Timestamp actual: $timestamp<br>";

echo "<br>";

// EJEMPLO 2: Manipulación de fechas con strtotime
echo "<h3>Ejemplo 2: Manipulación con strtotime</h3>";

// Fecha específica
$mi_cumpleanos = strtotime('2024-12-25');
echo "Mi cumpleaños (timestamp): $mi_cumpleanos<br>";
echo "Mi cumpleaños (formato): " . date('Y-m-d', $mi_cumpleanos) . "<br>";

// Cálculos de fechas
$manana = strtotime('+1 day');
echo "Mañana será: " . date('Y-m-d', $manana) . "<br>";

$hace_semana = strtotime('-1 week');
echo "Hace una semana fue: " . date('Y-m-d', $hace_semana) . "<br>";

$proximo_mes = strtotime('+1 month');
echo "El próximo mes será: " . date('F Y', $proximo_mes) . "<br>";

// Diferencia de días
$hoy = time();
$navidad = strtotime('2024-12-25');
$diferencia = $navidad - $hoy;
$dias_restantes = floor($diferencia / (60 * 60 * 24));

if ($dias_restantes > 0) {
    echo "Faltan $dias_restantes días para Navidad<br>";
} else {
    echo "Ya pasó la Navidad de este año<br>";
}
?>