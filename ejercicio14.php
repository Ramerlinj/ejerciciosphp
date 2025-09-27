<?php
/**
 * Ejercicio 14: Ciclo DO WHILE en PHP
 * 
 * El bucle DO-WHILE ejecuta el bloque de código AL MENOS UNA VEZ,
 * y luego verifica la condición. Es útil cuando necesitas que
 * el código se ejecute mínimo una vez, independientemente de la condición.
 * 
 * Estructura: do { código } while (condición);
 */

echo "<h1>Ejercicio 14: Ciclo DO WHILE</h1>";

// Ejemplo 1: Diferencia entre WHILE y DO-WHILE
echo "<h2>Ejemplo 1: Diferencia entre WHILE y DO-WHILE</h2>";

echo "<strong>Con WHILE (condición falsa desde el inicio):</strong><br>";
$contador1 = 5;
while ($contador1 < 3) {
    echo "Este mensaje NUNCA se mostrará<br>";
    $contador1++;
}
echo "WHILE no se ejecutó porque la condición era falsa<br><br>";

echo "<strong>Con DO-WHILE (misma condición falsa):</strong><br>";
$contador2 = 5;
do {
    echo "Este mensaje SÍ se muestra (contador: $contador2)<br>";
    $contador2++;
} while ($contador2 < 3);
echo "DO-WHILE se ejecutó al menos una vez<br>";

echo "<hr>";

// Ejemplo 2: Menú de opciones (simulado)
echo "<h2>Ejemplo 2: Simulación de Menú</h2>";

$opcion = 0;
$intentos = 0;

echo "Simulando un menú interactivo:<br>";

do {
    $intentos++;
    echo "<strong>Intento $intentos:</strong><br>";
    echo "1. Ver productos<br>";
    echo "2. Realizar compra<br>";
    echo "3. Ver carrito<br>";
    echo "4. Salir<br>";
    
    // Simulamos la selección del usuario
    $opcion = rand(1, 5); // Número aleatorio entre 1 y 5
    echo "Usuario selecciona opción: $opcion<br>";
    
    switch ($opcion) {
        case 1:
            echo "Mostrando productos...<br>";
            break;
        case 2:
            echo "Procesando compra...<br>";
            break;
        case 3:
            echo "Mostrando carrito...<br>";
            break;
        case 4:
            echo "¡Hasta luego!<br>";
            break;
        default:
            echo "Opción inválida. Intente nuevamente.<br>";
            break;
    }
    echo "<br>";
    
} while ($opcion != 4 && $intentos < 5); // Para hasta que elija salir o después de 5 intentos

echo "Menú terminado después de $intentos intentos<br>";

echo "<hr>";

// Ejemplo 3: Validación de entrada
echo "<h2>Ejemplo 3: Validación de Contraseña</h2>";

$passwordCorrecta = "123456";
$intentosPassword = 0;
$maxIntentos = 3;

echo "Simulando validación de contraseña:<br>";
echo "Contraseña correcta: $passwordCorrecta<br><br>";

do {
    $intentosPassword++;
    
    // Simulamos diferentes contraseñas que introduce el usuario
    $passwordsIntentadas = ["abc", "password", "123456", "qwerty"];
    $passwordIntentada = $passwordsIntentadas[($intentosPassword - 1) % count($passwordsIntentadas)];
    
    echo "<strong>Intento $intentosPassword:</strong><br>";
    echo "Contraseña ingresada: '$passwordIntentada'<br>";
    
    if ($passwordIntentada === $passwordCorrecta) {
        echo "<strong>¡ACCESO CONCEDIDO!</strong><br>";
        break;
    } else {
        echo "Contraseña incorrecta<br>";
        $intentosRestantes = $maxIntentos - $intentosPassword;
        
        if ($intentosRestantes > 0) {
            echo "Te quedan $intentosRestantes intentos<br>";
        }
    }
    echo "<br>";
    
} while ($passwordIntentada !== $passwordCorrecta && $intentosPassword < $maxIntentos);

if ($intentosPassword >= $maxIntentos && $passwordIntentada !== $passwordCorrecta) {
    echo "<strong>CUENTA BLOQUEADA</strong> - Demasiados intentos fallidos<br>";
}

echo "<hr>";

// Ejemplo 4: Juego de adivinanza
echo "<h2>Ejemplo 4: Juego de Adivinanza</h2>";

$numeroSecreto = rand(1, 10);
$intentosAdivinanza = 0;
$adivinado = false;

echo "Adivina el número entre 1 y 10<br>";
echo "Número secreto: $numeroSecreto (normalmente esto estaría oculto)<br><br>";

do {
    $intentosAdivinanza++;
    $numeroIntentado = rand(1, 10); // Simulamos el número que introduce el usuario
    
    echo "<strong>Intento $intentosAdivinanza:</strong><br>";
    echo "Número ingresado: $numeroIntentado<br>";
    
    if ($numeroIntentado === $numeroSecreto) {
        echo "<strong>¡CORRECTO!</strong> Adivinaste en $intentosAdivinanza intentos<br>";
        $adivinado = true;
    } elseif ($numeroIntentado < $numeroSecreto) {
        echo "El número es más ALTO<br>";
    } else {
        echo "El número es más BAJO<br>";
    }
    echo "<br>";
    
} while (!$adivinado && $intentosAdivinanza < 5);

if (!$adivinado) {
    echo "Se acabaron los intentos. El número era: $numeroSecreto<br>";
}

echo "<hr>";

// Ejemplo 5: Procesamiento de datos hasta condición
echo "<h2>Ejemplo 5: Procesamiento de Lista</h2>";

$numeros = [2, 4, 6, 8, 3, 10, 12];
$indice = 0;
$sumaTotal = 0;

echo "Procesando números hasta encontrar un impar:<br>";
echo "Lista: " . implode(", ", $numeros) . "<br><br>";

do {
    $numeroActual = $numeros[$indice];
    echo "Procesando número en posición $indice: $numeroActual<br>";
    
    if ($numeroActual % 2 == 0) {
        echo "Es par, lo sumamos<br>";
        $sumaTotal += $numeroActual;
        echo "Suma actual: $sumaTotal<br>";
    } else {
        echo "Es impar, detenemos el proceso<br>";
        break;
    }
    
    $indice++;
    echo "<br>";
    
} while ($indice < count($numeros) && $numeroActual % 2 == 0);

echo "<strong>Suma final de números pares: $sumaTotal</strong><br>";

echo "<hr>";

// Ejemplo 6: Contador con incremento variable
echo "<h2>Ejemplo 6: Contador con Incremento Variable</h2>";

$valor = 1;
$incremento = 1;

echo "Contador que se incrementa de forma creciente:<br>";

do {
    echo "Valor actual: $valor (incremento: +$incremento)<br>";
    $valor += $incremento;
    $incremento++; // El incremento aumenta cada vez
    
} while ($valor < 20);

echo "Proceso terminado cuando el valor alcanzó: $valor<br>";

echo "<hr>";

// Ejemplo 7: Generación de números aleatorios hasta condición
echo "<h2>Ejemplo 7: Números Aleatorios Hasta Múltiplo de 7</h2>";

$intentosRandom = 0;
$numeroGenerado = 0;

echo "Generando números aleatorios hasta obtener un múltiplo de 7:<br>";

do {
    $intentosRandom++;
    $numeroGenerado = rand(1, 50);
    
    echo "Intento $intentosRandom: $numeroGenerado";
    
    if ($numeroGenerado % 7 == 0) {
        echo " <strong>¡ES MÚLTIPLO DE 7!</strong><br>";
    } else {
        echo " No es múltiplo de 7<br>";
    }
    
} while ($numeroGenerado % 7 != 0 && $intentosRandom < 10);

if ($numeroGenerado % 7 == 0) {
    echo "Encontrado en $intentosRandom intentos<br>";
} else {
    echo "No se encontró múltiplo de 7 en 10 intentos<br>";
}

echo "<hr>";

// Ejemplo 8: Lectura de array hasta elemento específico
echo "<h2>Ejemplo 8: Buscar Elemento en Array</h2>";

$palabras = ["casa", "carro", "gato", "STOP", "perro", "avión"];
$indiceArray = 0;
$encontrado = false;

echo "Palabras: " . implode(", ", $palabras) . "<br>";
echo "Buscando hasta encontrar 'STOP':<br><br>";

do {
    $palabraActual = $palabras[$indiceArray];
    echo "Palabra $indiceArray: '$palabraActual'<br>";
    
    if ($palabraActual === "STOP") {
        echo "<strong>Encontrado STOP!</strong><br>";
        $encontrado = true;
    } else {
        echo "Continuando búsqueda...<br>";
    }
    
    $indiceArray++;
    echo "<br>";
    
} while (!$encontrado && $indiceArray < count($palabras));

if (!$encontrado) {
    echo "No se encontró 'STOP' en el array<br>";
}

?>