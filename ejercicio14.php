<?php
/**
 * Ejercicio 14: Ciclo DO WHILE en PHP
 * 
 * El bucle DO-WHILE ejecuta el bloque de código AL MENOS UNA VEZ,
 * y luego verifica la condición. Es útil cuando necesitas que
 * el código se ejecute mínimo una vez, independientemente de la condición.
 * 
 * Estructura: do { código } while (condición);
 */

echo "<h1>Ejercicio 14: Ciclo DO WHILE</h1>";

// Ejemplo 1: Diferencia entre WHILE y DO-WHILE
echo "<h2>Ejemplo 1: Diferencia entre WHILE y DO-WHILE</h2>";

echo "<strong>Con WHILE (condición falsa desde el inicio):</strong><br>";
$contador1 = 5;
while ($contador1 < 3) {
    echo "Este mensaje NUNCA se mostrará<br>";
    $contador1++;
}
echo "WHILE no se ejecutó porque la condición era falsa<br><br>";

echo "<strong>Con DO-WHILE (misma condición falsa):</strong><br>";
$contador2 = 5;
do {
    echo "Este mensaje SÍ se muestra (contador: $contador2)<br>";
    $contador2++;
} while ($contador2 < 3);
echo "DO-WHILE se ejecutó al menos una vez<br>";

echo "<hr>";
?>