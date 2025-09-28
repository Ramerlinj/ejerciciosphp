<?php
/**
 * Ejercicio 11: IF ELSE en PHP
 * 
 * La estructura if-else permite ejecutar un bloque de código si una condición es verdadera
 * y otro bloque diferente si la condición es falsa.
 * También se puede usar elseif para múltiples condiciones.
 */

echo "<h1>Ejercicio 11: IF ELSE</h1>";

// Ejemplo 1: Estructura básica if-else
echo "<h2>Ejemplo 1: Verificación de Edad</h2>";

$edad = 17;
echo "Edad: $edad años<br>";

if ($edad >= 18) {
    echo "<strong>Eres mayor de edad</strong> - Puedes votar<br>";
} else {
    echo "<strong>Eres menor de edad</strong> - No puedes votar aún<br>";
}

echo "<hr>";


?>