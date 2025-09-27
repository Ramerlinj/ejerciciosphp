<?php
/**
 * Ejercicio 15: Ciclo WHILE en PHP
 * 
 * El bucle WHILE ejecuta un bloque de código mientras una condición sea verdadera.
 * La condición se evalúa ANTES de cada iteración, por lo que puede que
 * el código nunca se ejecute si la condición es falsa desde el inicio.
 * 
 * Estructura: while (condición) { código }
 */

echo "<h1>Ejercicio 15: Ciclo WHILE</h1>";

// Ejemplo 1: Contador básico
echo "<h2>Ejemplo 1: Contador del 1 al 5</h2>";

$contador = 1;
echo "Contando del 1 al 5:<br>";

while ($contador <= 5) {
    echo "Contador: $contador<br>";
    $contador++; // Importante: incrementar para evitar bucle infinito
}

echo "Bucle terminado. Contador final: $contador<br>";

echo "<hr>";

// Ejemplo 2: Suma acumulativa
echo "<h2>Ejemplo 2: Suma Acumulativa</h2>";

$numero = 1;
$suma = 0;
$limite = 10;

echo "Sumando números del 1 al $limite:<br>";

while ($numero <= $limite) {
    $suma += $numero;
    echo "Número: $numero, Suma acumulada: $suma<br>";
    $numero++;
}

echo "<strong>Suma total: $suma</strong><br>";

echo "<hr>";

// Ejemplo 3: Recorrer un array
echo "<h2>Ejemplo 3: Recorriendo un Array</h2>";

$frutas = ["Manzana", "Banana", "Naranja", "Mango"];
$indice = 0;

echo "Lista de frutas:<br>";

while ($indice < count($frutas)) {
    echo ($indice + 1) . ". " . $frutas[$indice] . "<br>";
    $indice++;
}

echo "<hr>";

// Ejemplo 4: Buscar elemento en array
echo "<h2>Ejemplo 4: Buscar Elemento en Array</h2>";

$numeros = [15, 23, 8, 42, 16, 4, 35];
$buscar = 42;
$posicion = 0;
$encontrado = false;

echo "Array: " . implode(", ", $numeros) . "<br>";
echo "Buscando el número: $buscar<br><br>";

while ($posicion < count($numeros) && !$encontrado) {
    echo "Verificando posición $posicion: " . $numeros[$posicion] . "<br>";
    
    if ($numeros[$posicion] == $buscar) {
        echo "<strong>¡Encontrado!</strong> El número $buscar está en la posición $posicion<br>";
        $encontrado = true;
    }
    $posicion++;
}

if (!$encontrado) {
    echo "El número $buscar no se encontró en el array<br>";
}

echo "<hr>";

// Ejemplo 5: Generar tabla de multiplicar
echo "<h2>Ejemplo 5: Tabla de Multiplicar</h2>";

$tabla = 6;
$multiplicador = 1;

echo "<strong>Tabla del $tabla:</strong><br>";

while ($multiplicador <= 10) {
    $resultado = $tabla * $multiplicador;
    echo "$tabla × $multiplicador = $resultado<br>";
    $multiplicador++;
}

echo "<hr>";

// Ejemplo 6: Validación de entrada (simulada)
echo "<h2>Ejemplo 6: Validación de Entrada</h2>";

$intentos = 0;
$maxIntentos = 5;
$valorValido = false;
$valoresIntentados = [25, 15, 8, 12, 10]; // Simulamos entradas del usuario

echo "Validando entrada (debe ser un número entre 10 y 20):<br>";
echo "Valores a intentar: " . implode(", ", $valoresIntentados) . "<br><br>";

while ($intentos < $maxIntentos && !$valorValido) {
    $valor = $valoresIntentados[$intentos];
    echo "Intento " . ($intentos + 1) . ": $valor<br>";
    
    if ($valor >= 10 && $valor <= 20) {
        echo "<strong>Valor válido!</strong> $valor está entre 10 y 20<br>";
        $valorValido = true;
    } else {
        echo "Valor inválido. Debe estar entre 10 y 20<br>";
    }
    
    $intentos++;
    echo "<br>";
}

if (!$valorValido) {
    echo "Se agotaron los intentos sin encontrar un valor válido<br>";
}

echo "<hr>";

// Ejemplo 7: Calcular factorial
echo "<h2>Ejemplo 7: Cálculo de Factorial</h2>";

$numeroFactorial = 5;
$factorial = 1;
$i = 1;

echo "Calculando factorial de $numeroFactorial:<br>";

while ($i <= $numeroFactorial) {
    $factorial *= $i;
    echo "Paso $i: $factorial<br>";
    $i++;
}

echo "<strong>Factorial de $numeroFactorial = $factorial</strong><br>";

echo "<hr>";

// Ejemplo 8: Procesar cadena carácter por carácter
echo "<h2>Ejemplo 8: Procesar Cadena</h2>";

$texto = "HOLA PHP";
$posicionChar = 0;
$contadorVocales = 0;
$vocales = ['A', 'E', 'I', 'O', 'U'];

echo "Texto: '$texto'<br>";
echo "Analizando carácter por carácter:<br>";

while ($posicionChar < strlen($texto)) {
    $caracter = $texto[$posicionChar];
    echo "Posición $posicionChar: '$caracter'";
    
    if (in_array(strtoupper($caracter), $vocales)) {
        echo " → Es vocal<br>";
        $contadorVocales++;
    } else {
        echo " → No es vocal<br>";
    }
    
    $posicionChar++;
}

echo "<strong>Total de vocales encontradas: $contadorVocales</strong><br>";

echo "<hr>";

// Ejemplo 9: Generar números pares
echo "<h2>Ejemplo 9: Generar Números Pares</h2>";

$numeroActual = 2;
$limite = 20;
$contador = 0;

echo "Números pares hasta $limite:<br>";

while ($numeroActual <= $limite) {
    echo "$numeroActual ";
    $numeroActual += 2; // Incrementar de 2 en 2 para obtener solo pares
    $contador++;
}

echo "<br>Total de números pares: $contador<br>";

echo "<hr>";

// Ejemplo 10: Simulación de carrito de compras
echo "<h2>Ejemplo 10: Procesamiento de Carrito</h2>";

$productos = [
    ["nombre" => "Laptop", "precio" => 800],
    ["nombre" => "Mouse", "precio" => 25],
    ["nombre" => "Teclado", "precio" => 50],
    ["nombre" => "Monitor", "precio" => 300]
];

$indiceProducto = 0;
$totalCarrito = 0;
$presupuesto = 1000;

echo "Presupuesto disponible: $$presupuesto<br>";
echo "Productos en carrito:<br><br>";

while ($indiceProducto < count($productos) && $totalCarrito < $presupuesto) {
    $producto = $productos[$indiceProducto];
    $nuevoTotal = $totalCarrito + $producto["precio"];
    
    echo "Producto: " . $producto["nombre"] . " - $" . $producto["precio"] . "<br>";
    
    if ($nuevoTotal <= $presupuesto) {
        $totalCarrito = $nuevoTotal;
        echo "Agregado al carrito. Total: $$totalCarrito<br>";
    } else {
        echo "Excede el presupuesto. No se puede agregar<br>";
        break;
    }
    
    $indiceProducto++;
    echo "<br>";
}

echo "<strong>Total final del carrito: $$totalCarrito</strong><br>";
echo "<strong>Presupuesto restante: $" . ($presupuesto - $totalCarrito) . "</strong><br>";

echo "<hr>";

// Ejemplo 11: Números aleatorios hasta condición específica
echo "<h2>Ejemplo 11: Números Aleatorios Hasta Condición</h2>";

$intentos = 0;
$maxIntentos = 10;
$numeroObjetivo = 7;
$numeroGenerado = 0;

echo "Generando números aleatorios hasta obtener el número $numeroObjetivo:<br>";

while ($numeroGenerado != $numeroObjetivo && $intentos < $maxIntentos) {
    $numeroGenerado = rand(1, 10);
    $intentos++;
    
    echo "Intento $intentos: $numeroGenerado";
    
    if ($numeroGenerado == $numeroObjetivo) {
        echo " <strong>¡ENCONTRADO!</strong><br>";
    } else {
        echo "<br>";
    }
}

if ($numeroGenerado == $numeroObjetivo) {
    echo "Objetivo alcanzado en $intentos intentos<br>";
} else {
    echo "No se encontró el número en $maxIntentos intentos<br>";
}

echo "<hr>";

// Ejemplo 12: Eliminación de elementos de array
echo "<h2>Ejemplo 12: Procesar y Filtrar Array</h2>";

$numeros = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];
$numerosFiltrados = [];
$indiceFilter = 0;

echo "Array original: " . implode(", ", $numeros) . "<br>";
echo "Filtrando solo números pares:<br>";

while ($indiceFilter < count($numeros)) {
    $numero = $numeros[$indiceFilter];
    
    if ($numero % 2 == 0) {
        $numerosFiltrados[] = $numero;
        echo "$numero es par, se agrega al filtro<br>";
    } else {
        echo "$numero es impar, se omite<br>";
    }
    
    $indiceFilter++;
}

echo "<strong>Array filtrado: " . implode(", ", $numerosFiltrados) . "</strong><br>";

?>