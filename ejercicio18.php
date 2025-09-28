<?php
/**
 * Ejercicio 18: Funciones para String en PHP
 * 
 * PHP ofrece una amplia variedad de funciones para manipular cadenas de texto:
 * longitud, búsqueda, reemplazo, conversión de mayúsculas/minúsculas,
 * división, concatenación, validación y formateo.
 */

echo "<h1>Ejercicio 18: Funciones para String</h1>";

// Ejemplo 1: Longitud y información básica de strings
echo "<h2>Ejemplo 1: Información Básica de Strings</h2>";

$texto = "Hola Mundo desde PHP";

echo "Texto: '$texto'<br>";
echo "strlen(): " . strlen($texto) . " caracteres<br>";
echo "str_word_count(): " . str_word_count($texto) . " palabras<br>";
echo "str_word_count(array): " . implode(", ", str_word_count($texto, 1)) . "<br>";

$textoEspacios = "  Texto con espacios  ";
echo "<br>Texto con espacios: '$textoEspacios'<br>";
echo "Longitud original: " . strlen($textoEspacios) . "<br>";
echo "trim(): '" . trim($textoEspacios) . "' (longitud: " . strlen(trim($textoEspacios)) . ")<br>";
echo "ltrim(): '" . ltrim($textoEspacios) . "'<br>";
echo "rtrim(): '" . rtrim($textoEspacios) . "'<br>";

echo "<hr>";

?>