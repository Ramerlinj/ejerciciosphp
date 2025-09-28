<?php
/**
 * Ejercicio 10: IF ANIDADO en PHP
 * 
 * Los if anidados permiten crear múltiples condiciones dentro de otras condiciones.
 * Es útil cuando necesitas verificar varias condiciones dependientes.
 */

echo "<h1>Ejercicio 10: IF Anidado</h1>";

// Ejemplo 1: Sistema de calificaciones con múltiples criterios
echo "<h2>Ejemplo 1: Sistema de Calificaciones</h2>";

$nota = 85;
$asistencia = 90;

echo "Nota: $nota<br>";
echo "Asistencia: $asistencia%<br>";

if ($nota >= 60) {
    echo "Nota aprobatoria<br>";
    
    if ($asistencia >= 80) {
        echo "Asistencia suficiente<br>";
        
        if ($nota >= 90) {
            echo "<strong>EXCELENTE - Matrícula de Honor</strong><br>";
        } elseif ($nota >= 80) {
            echo "<strong>MUY BIEN - Aprobado con Distinción</strong><br>";
        } else {
            echo "<strong>BIEN - Aprobado</strong><br>";
        }
    } else {
        echo "Asistencia insuficiente - Revisar con coordinación<br>";
    }
} else {
    echo "<strong>REPROBADO</strong> - Nota insuficiente<br>";
}

echo "<hr>";

?>