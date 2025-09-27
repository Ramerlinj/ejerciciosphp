<?php
/*
EJERCICIO 19 - BUCLES WHILE Y DO-WHILE
===================================

DOCUMENTACION:
- while: Ejecuta un bloque de código mientras una condición sea verdadera
- do-while: Ejecuta al menos una vez el bloque y luego evalúa la condición
- Diferencia principal: do-while garantiza al menos una ejecución

SINTAXIS:
while (condicion) {
    // código
}

do {
    // código
} while (condicion);
*/

echo "<h2>EJERCICIO 19 - BUCLES WHILE Y DO-WHILE</h2>";

// EJEMPLO 1: Bucle while - Contador del 1 al 5
echo "<h3>Ejemplo 1: Bucle While</h3>";
$contador = 1;
echo "Contando del 1 al 5 con while:<br>";

while ($contador <= 5) {
    echo "Número: $contador<br>";
    $contador++;
}

echo "<br>";

// EJEMPLO 2: Bucle do-while - Menú de opciones
echo "<h3>Ejemplo 2: Bucle Do-While</h3>";
$opcion = 0;
$intentos = 0;

echo "Simulando un menú con do-while:<br>";

do {
    $intentos++;
    echo "Intento #$intentos - ";
    
    if ($intentos == 1) {
        $opcion = 0; // Primera vez: opción inválida
        echo "Opción seleccionada: $opcion (inválida)<br>";
    } elseif ($intentos == 2) {
        $opcion = 2; // Segunda vez: opción válida
        echo "Opción seleccionada: $opcion (válida)<br>";
    }
    
    if ($opcion < 1 || $opcion > 3) {
        echo "Error: Seleccione una opción válida (1-3)<br>";
    }
    
} while ($opcion < 1 || $opcion > 3);

echo "Menú completado con éxito<br>";
?>