<?php
/**
 * Ejercicio 15: Ciclo WHILE en PHP
 * 
 * El bucle WHILE ejecuta un bloque de código mientras una condición sea verdadera.
 * La condición se evalúa ANTES de cada iteración, por lo que puede que
 * el código nunca se ejecute si la condición es falsa desde el inicio.
 * 
 * Estructura: while (condición) { código }
 */

echo "<h1>Ejercicio 15: Ciclo WHILE</h1>";

// Ejemplo 1: Contador básico
echo "<h2>Ejemplo 1: Contador del 1 al 5</h2>";

$contador = 1;
echo "Contando del 1 al 5:<br>";

while ($contador <= 5) {
    echo "Contador: $contador<br>";
    $contador++; // Importante: incrementar para evitar bucle infinito
}

echo "Bucle terminado. Contador final: $contador<br>";

echo "<hr>";

?>