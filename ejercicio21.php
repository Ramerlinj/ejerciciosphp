<?php
/*
EJERCICIO 21 - ARREGLOS DE INDICE NUMERICO
===========================================

DOCUMENTACION:
- Los arrays numéricos usan índices enteros (0, 1, 2, etc.)
- Se pueden crear con array() o con corchetes []
- Los índices se asignan automáticamente o manualmente
- Se pueden recorrer con for, foreach, while

SINTAXIS:
$array = array(valor1, valor2, valor3);
$array = [valor1, valor2, valor3];
$array[0] = valor1;
*/

echo "<h2>EJERCICIO 21 - ARREGLOS DE INDICE NUMERICO</h2>";

// EJEMPLO 1: Creación y manipulación básica
echo "<h3>Ejemplo 1: Creación y Manipulación</h3>";

// Diferentes formas de crear arrays
$frutas = array('manzana', 'banana', 'naranja');
$numeros = [10, 20, 30, 40, 50];
$colores = [];
$colores[0] = 'rojo';
$colores[1] = 'verde';
$colores[2] = 'azul';

echo "Frutas disponibles:<br>";
for ($i = 0; $i < count($frutas); $i++) {
    echo "[$i] $frutas[$i]<br>";
}

echo "<br>Números en el array:<br>";
foreach ($numeros as $indice => $valor) {
    echo "Posición $indice: $valor<br>";
}

echo "<br>Colores:<br>";
foreach ($colores as $color) {
    echo "- $color<br>";
}

echo "<br>";

// EJEMPLO 2: Operaciones con arrays
echo "<h3>Ejemplo 2: Operaciones</h3>";

// Array de calificaciones
$calificaciones = [85, 92, 78, 96, 88];
echo "Calificaciones originales: " . implode(', ', $calificaciones) . "<br>";

// Agregar nueva calificación
$calificaciones[] = 91;
echo "Después de agregar 91: " . implode(', ', $calificaciones) . "<br>";

// Calcular promedio
$suma = 0;
foreach ($calificaciones as $nota) {
    $suma += $nota;
}
$promedio = $suma / count($calificaciones);
echo "Promedio: " . number_format($promedio, 2) . "<br>";

// Encontrar la nota más alta y más baja
$nota_max = max($calificaciones);
$nota_min = min($calificaciones);
echo "Nota más alta: $nota_max<br>";
echo "Nota más baja: $nota_min<br>";

// Contar aprobados (>= 80)
$aprobados = 0;
foreach ($calificaciones as $nota) {
    if ($nota >= 80) {
        $aprobados++;
    }
}
echo "Estudiantes aprobados: $aprobados de " . count($calificaciones) . "<br>";
?>