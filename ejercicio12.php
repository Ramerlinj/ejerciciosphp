<?php
/**
 * Ejercicio 12: SWITCH en PHP
 * 
 * La estructura switch es útil cuando necesitas comparar una variable 
 * con múltiples valores específicos. Es más legible que múltiples if-elseif
 * cuando se trata de comparaciones de igualdad.
 */

echo "<h1>Ejercicio 12: SWITCH</h1>";

// Ejemplo: Días de la semana
echo "<h2>Ejemplo: Días de la Semana</h2>";

$dia = 3;
echo "Día número: $dia<br>";

switch ($dia) {
    case 1:
        echo "<strong>LUNES</strong> - Comienza la semana<br>";
        break;
    case 2:
        echo "<strong>MARTES</strong> - Segundo día laborable<br>";
        break;
    case 3:
        echo "<strong>MIÉRCOLES</strong> - Mitad de semana<br>";
        break;
    case 4:
        echo "<strong>JUEVES</strong> - Casi viernes<br>";
        break;
    case 5:
        echo "<strong>VIERNES</strong> - Por fin viernes<br>";
        break;
    case 6:
        echo "<strong>SÁBADO</strong> - Fin de semana<br>";
        break;
    case 7:
        echo "<strong>DOMINGO</strong> - Día de descanso<br>";
        break;
    default:
        echo "<strong>DÍA INVÁLIDO</strong> - Debe ser un número del 1 al 7<br>";
        break;
}

?>
