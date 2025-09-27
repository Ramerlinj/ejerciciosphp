<?php
/**
 * Ejercicio 13: Ciclo FOR en PHP
 * 
 * El bucle FOR es ideal cuando conoces exactamente cuántas veces
 * quieres repetir un bloque de código. Tiene tres partes:
 * - Inicialización: se ejecuta una vez al inicio
 * - Condición: se evalúa antes de cada iteración
 * - Incremento: se ejecuta después de cada iteración
 */

echo "<h1>Ejercicio 13: Ciclo FOR</h1>";

// Ejemplo 1: Bucle básico - contar del 1 al 10
echo "<h2>Ejemplo 1: Contador Básico</h2>";

echo "Contando del 1 al 10:<br>";
for ($i = 1; $i <= 10; $i++) {
    echo "Número: $i<br>";
}

echo "<hr>";

// Ejemplo 2: Tabla de multiplicar
echo "<h2>Ejemplo 2: Tabla de Multiplicar</h2>";

$numero = 7;
echo "<strong>Tabla del $numero:</strong><br>";

for ($i = 1; $i <= 10; $i++) {
    $resultado = $numero * $i;
    echo "$numero × $i = $resultado<br>";
}

echo "<hr>";

// Ejemplo 3: Números pares del 2 al 20
echo "<h2>Ejemplo 3: Números Pares</h2>";

echo "Números pares del 2 al 20:<br>";
for ($i = 2; $i <= 20; $i += 2) {
    echo "$i ";
}
echo "<br>";

echo "<hr>";

// Ejemplo 4: Countdown (cuenta regresiva)
echo "<h2>Ejemplo 4: Cuenta Regresiva</h2>";

echo "Cuenta regresiva desde 10:<br>";
for ($i = 10; $i >= 1; $i--) {
    echo "$i ";
}
echo "¡TIEMPO!<br>";

echo "<hr>";

// Ejemplo 5: Recorrer un array con for
echo "<h2>Ejemplo 5: Recorriendo un Array</h2>";

$frutas = ["Manzana", "Banana", "Naranja", "Uvas", "Fresa"];
echo "Lista de frutas:<br>";

for ($i = 0; $i < count($frutas); $i++) {
    echo ($i + 1) . ". " . $frutas[$i] . "<br>";
}

echo "<hr>";

// Ejemplo 6: Generar una tabla HTML
echo "<h2>Ejemplo 6: Tabla HTML con FOR</h2>";

echo "<table border='1' cellpadding='5'>";
echo "<tr><th>Número</th><th>Cuadrado</th><th>Cubo</th></tr>";

for ($i = 1; $i <= 5; $i++) {
    $cuadrado = $i * $i;
    $cubo = $i * $i * $i;
    echo "<tr>";
    echo "<td>$i</td>";
    echo "<td>$cuadrado</td>";
    echo "<td>$cubo</td>";
    echo "</tr>";
}

echo "</table>";

echo "<hr>";

// Ejemplo 7: Patrón de asteriscos
echo "<h2>Ejemplo 7: Patrón de Asteriscos</h2>";

echo "Triángulo de asteriscos:<br>";
for ($i = 1; $i <= 5; $i++) {
    for ($j = 1; $j <= $i; $j++) {
        echo "*";
    }
    echo "<br>";
}

echo "<hr>";

// Ejemplo 8: Factorial de un número
echo "<h2>Ejemplo 8: Cálculo de Factorial</h2>";

$numero = 5;
$factorial = 1;

echo "Calculando factorial de $numero:<br>";
for ($i = 1; $i <= $numero; $i++) {
    $factorial *= $i;
    echo "$factorial (multiplicado por $i)<br>";
}

echo "<strong>Factorial de $numero = $factorial</strong><br>";

echo "<hr>";

// Ejemplo 9: Suma de números
echo "<h2>Ejemplo 9: Suma de Números</h2>";

$suma = 0;
$limite = 10;

echo "Sumando números del 1 al $limite:<br>";
for ($i = 1; $i <= $limite; $i++) {
    $suma += $i;
    echo "Suma parcial: $suma (+ $i)<br>";
}

echo "<strong>Suma total: $suma</strong><br>";

echo "<hr>";

// Ejemplo 10: Bucle anidado - tabla de multiplicar completa
echo "<h2>Ejemplo 10: Tablas de Multiplicar (Bucles Anidados)</h2>";

echo "<table border='1' cellpadding='3'>";
echo "<tr><th>×</th>";

// Encabezados de columnas
for ($j = 1; $j <= 5; $j++) {
    echo "<th>$j</th>";
}
echo "</tr>";

// Filas de la tabla
for ($i = 1; $i <= 5; $i++) {
    echo "<tr>";
    echo "<th>$i</th>"; // Encabezado de fila
    
    for ($j = 1; $j <= 5; $j++) {
        $producto = $i * $j;
        echo "<td>$producto</td>";
    }
    echo "</tr>";
}

echo "</table>";

echo "<hr>";

// Ejemplo 11: For con break y continue
echo "<h2>Ejemplo 11: FOR con BREAK y CONTINUE</h2>";

echo "<strong>Números del 1 al 10, saltando el 5 y parando en el 8:</strong><br>";

for ($i = 1; $i <= 10; $i++) {
    if ($i == 5) {
        echo "Saltando el número $i<br>";
        continue; // Salta esta iteración
    }
    
    if ($i == 8) {
        echo "Parando en el número $i<br>";
        break; // Sale del bucle completamente
    }
    
    echo "Número: $i<br>";
}

echo "<hr>";

// Ejemplo 12: Generador de contraseñas simples
echo "<h2>Ejemplo 12: Generador de Contraseña</h2>";

$caracteres = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
$longitud = 8;
$password = "";

echo "Generando contraseña de $longitud caracteres:<br>";

for ($i = 0; $i < $longitud; $i++) {
    $indiceAleatorio = rand(0, strlen($caracteres) - 1);
    $caracter = $caracteres[$indiceAleatorio];
    $password .= $caracter;
    echo "Paso " . ($i + 1) . ": $caracter<br>";
}

echo "<strong>Contraseña generada: $password</strong><br>";

echo "<hr>";

// Ejemplo 13: For con paso personalizado
echo "<h2>Ejemplo 13: FOR con Diferentes Pasos</h2>";

echo "<strong>Contando de 5 en 5:</strong><br>";
for ($i = 5; $i <= 50; $i += 5) {
    echo "$i ";
}
echo "<br><br>";

echo "<strong>Contando hacia atrás de 3 en 3:</strong><br>";
for ($i = 30; $i >= 0; $i -= 3) {
    echo "$i ";
}
echo "<br>";

?>