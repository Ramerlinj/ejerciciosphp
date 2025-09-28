<?php
/**
 * Ejercicio 16: Funciones en PHP
 * 
 * Las funciones son bloques de código reutilizable que realizan una tarea específica.
 * Pueden recibir parámetros, procesar datos y devolver resultados.
 * Ayudan a organizar el código, evitar repetición y hacer el programa más mantenible.
 */

echo "<h1>Ejercicio 16: Funciones en PHP</h1>";

// Ejemplo 1: Función básica sin parámetros
echo "<h2>Ejemplo 1: Función Sin Parámetros</h2>";

function saludar(): string {
    return "¡Hola! Bienvenido a PHP";
}

echo saludar() . "<br>";

// Función que no retorna valor (void)
function mostrarFecha(): void {
    echo "Fecha actual: " . date("Y-m-d H:i:s") . "<br>";
}

mostrarFecha();

echo "<hr>";

?>