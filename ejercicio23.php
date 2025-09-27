<?php
/*
EJERCICIO 23 - FUNCIONES PARA ARREGLOS EN PHP
=============================================

DOCUMENTACION:
- count(): Cuenta elementos de un array
- array_push(): Agrega elementos al final
- array_pop(): Elimina el último elemento
- sort(): Ordena arrays de forma ascendente
- in_array(): Verifica si un valor existe en el array
- array_merge(): Combina arrays
- array_keys(): Obtiene las claves del array
- array_values(): Obtiene los valores del array
*/

echo "<h2>EJERCICIO 23 - FUNCIONES PARA ARREGLOS</h2>";

// EJEMPLO 1: Funciones básicas de manipulación
echo "<h3>Ejemplo 1: Funciones Básicas</h3>";

$numeros = [5, 2, 8, 1, 9, 3];
echo "Array original: " . implode(', ', $numeros) . "<br>";
echo "Cantidad de elementos: " . count($numeros) . "<br>";

// Agregar elementos
array_push($numeros, 7, 4);
echo "Después de agregar 7 y 4: " . implode(', ', $numeros) . "<br>";

// Eliminar último elemento
$ultimo = array_pop($numeros);
echo "Elemento eliminado: $ultimo<br>";
echo "Array después de eliminar: " . implode(', ', $numeros) . "<br>";

// Verificar si existe un valor
$buscar = 8;
if (in_array($buscar, $numeros)) {
    echo "El número $buscar está en el array<br>";
} else {
    echo "El número $buscar no está en el array<br>";
}

// Ordenar array
sort($numeros);
echo "Array ordenado: " . implode(', ', $numeros) . "<br>";

echo "<br>";

// EJEMPLO 2: Trabajando con arrays asociativos
echo "<h3>Ejemplo 2: Arrays Asociativos y Funciones</h3>";

$estudiantes = [
    'ana' => 85,
    'carlos' => 92,
    'maria' => 78,
    'pedro' => 96
];

echo "Calificaciones de estudiantes:<br>";
foreach ($estudiantes as $nombre => $nota) {
    echo ucfirst($nombre) . ": $nota<br>";
}

// Obtener claves y valores
$nombres = array_keys($estudiantes);
$notas = array_values($estudiantes);

echo "<br>Estudiantes: " . implode(', ', $nombres) . "<br>";
echo "Notas: " . implode(', ', $notas) . "<br>";

// Estadísticas
echo "<br>Estadísticas:<br>";
echo "Nota promedio: " . number_format(array_sum($notas) / count($notas), 2) . "<br>";
echo "Nota más alta: " . max($notas) . "<br>";
echo "Nota más baja: " . min($notas) . "<br>";

// Agregar nuevo estudiante
$estudiantes['luis'] = 89;
echo "<br>Después de agregar a Luis: " . count($estudiantes) . " estudiantes<br>";

// Combinar con otro array
$nuevos_estudiantes = ['sofia' => 94, 'diego' => 87];
$todos_estudiantes = array_merge($estudiantes, $nuevos_estudiantes);
echo "Total después de agregar más estudiantes: " . count($todos_estudiantes) . "<br>";
?>