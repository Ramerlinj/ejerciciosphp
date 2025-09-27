<?php
/**
 * Ejercicio 17: Funciones Matemáticas en PHP
 * 
 * PHP incluye muchas funciones matemáticas predefinidas para realizar
 * cálculos complejos, operaciones trigonométricas, estadísticas,
 * redondeo, números aleatorios y más.
 */

echo "<h1>Ejercicio 17: Funciones Matemáticas</h1>";

// Ejemplo 1: Funciones básicas de redondeo
echo "<h2>Ejemplo 1: Funciones de Redondeo</h2>";

$numero = 15.7834;

echo "Número original: $numero<br>";
echo "round(): " . round($numero) . " (redondeo normal)<br>";
echo "round(2): " . round($numero, 2) . " (2 decimales)<br>";
echo "ceil(): " . ceil($numero) . " (redondeo hacia arriba)<br>";
echo "floor(): " . floor($numero) . " (redondeo hacia abajo)<br>";

$negativo = -15.7834;
echo "<br>Número negativo: $negativo<br>";
echo "ceil(): " . ceil($negativo) . "<br>";
echo "floor(): " . floor($negativo) . "<br>";

echo "<hr>";

// Ejemplo 2: Valor absoluto y signo
echo "<h2>Ejemplo 2: Valor Absoluto y Funciones de Signo</h2>";

$numeros = [15, -23, 0, -7.5, 42];

foreach ($numeros as $num) {
    echo "Número: $num<br>";
    echo "  abs(): " . abs($num) . " (valor absoluto)<br>";
    
    if ($num > 0) {
        echo "  Signo: Positivo<br>";
    } elseif ($num < 0) {
        echo "  Signo: Negativo<br>";
    } else {
        echo "  Signo: Cero<br>";
    }
    echo "<br>";
}

echo "<hr>";

?>