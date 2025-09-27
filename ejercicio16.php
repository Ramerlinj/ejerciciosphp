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
    return "¡Hola! Bienvenido a PHP 👋";
}

echo saludar() . "<br>";

// Función que no retorna valor (void)
function mostrarFecha(): void {
    echo "Fecha actual: " . date("Y-m-d H:i:s") . "<br>";
}

mostrarFecha();

echo "<hr>";

// Ejemplo 2: Funciones con parámetros
echo "<h2>Ejemplo 2: Funciones con Parámetros</h2>";

function saludarPersona($nombre) {
    return "¡Hola, $nombre! 😊";
}

function sumar($a, $b) {
    $resultado = $a + $b;
    return "$a + $b = $resultado";
}

echo saludarPersona("María") . "<br>";
echo saludar("Carlos") . "<br>";
echo sumar(15, 25) . "<br>";

echo "<hr>";

// Ejemplo 3: Función con múltiples parámetros
echo "<h2>Ejemplo 3: Función con Múltiples Parámetros</h2>";

function calcularAreaRectangulo($largo, $ancho) {
    $area = $largo * $ancho;
    return $area;
}

function presentarPersona($nombre, $edad, $profesion) {
    return "👤 $nombre tiene $edad años y es $profesion";
}

$largo = 10;
$ancho = 5;
$area = calcularAreaRectangulo($largo, $ancho);

echo "Área del rectángulo ($largo × $ancho): $area cm²<br>";
echo presentarPersona("Ana", 28, "desarrolladora") . "<br>";
echo presentarPersona("Luis", 35, "diseñador") . "<br>";

echo "<hr>";

// Ejemplo 4: Parámetros con valores por defecto
echo "<h2>Ejemplo 4: Parámetros por Defecto</h2>";

function crearSaludo($nombre, $tratamiento = "Sr/Sra", $idioma = "español") {
    if ($idioma == "español") {
        return "Estimado/a $tratamiento $nombre";
    } elseif ($idioma == "inglés") {
        return "Dear $tratamiento $nombre";
    } else {
        return "Hello $nombre";
    }
}

// Diferentes formas de llamar la función
echo crearSaludo("González") . "<br>";
echo crearSaludo("Martínez", "Dr.") . "<br>";
echo crearSaludo("Smith", "Mr.", "inglés") . "<br>";
echo crearSaludo("Johnson", "Ms.", "otro") . "<br>";

echo "<hr>";

// Ejemplo 5: Función que procesa arrays
echo "<h2>Ejemplo 5: Funciones con Arrays</h2>";

function encontrarMayor($numeros) {
    if (empty($numeros)) {
        return "Array vacío";
    }
    
    $mayor = $numeros[0];
    foreach ($numeros as $numero) {
        if ($numero > $mayor) {
            $mayor = $numero;
        }
    }
    return $mayor;
}

function calcularPromedio($calificaciones) {
    if (empty($calificaciones)) {
        return 0;
    }
    
    $suma = array_sum($calificaciones);
    $cantidad = count($calificaciones);
    return round($suma / $cantidad, precision: 2);
}

$numeros = [45, 23, 67, 12, 89, 34];
$calificaciones = [85, 92, 78, 96, 88];

echo "Números: " . implode(", ", $numeros) . "<br>";
echo "El número mayor es: " . encontrarMayor($numeros) . "<br><br>";

echo "Calificaciones: " . implode(", ", $calificaciones) . "<br>";
echo "Promedio: " . calcularPromedio($calificaciones) . "<br>";

echo "<hr>";

// Ejemplo 6: Función recursiva (factorial)
echo "<h2>Ejemplo 6: Función Recursiva</h2>";

function factorial($n) {
    // Caso base
    if ($n <= 1) {
        return 1;
    }
    // Caso recursivo
    return $n * factorial($n - 1);
}

function fibonaci($n) {
    if ($n <= 1) {
        return $n;
    }
    return fibonaci($n - 1) + fibonaci($n - 2);
}

$numero = 5;
echo "Factorial de $numero = " . factorial($numero) . "<br>";

echo "Secuencia Fibonacci (primeros 8 números):<br>";
for ($i = 0; $i < 8; $i++) {
    echo fibonaci($i) . " ";
}
echo "<br>";

echo "<hr>";

// Ejemplo 7: Función que modifica variables por referencia
echo "<h2>Ejemplo 7: Paso por Referencia</h2>";

function incrementar($numero) {
    $numero++;
    return $numero;
}

function incrementarReferencia(&$numero) {
    $numero++;
}

$valor = 10;

echo "Valor original: $valor<br>";
echo "Con función normal: " . incrementar($valor) . "<br>";
echo "Valor después de función normal: $valor<br>";

incrementarReferencia($valor);
echo "Valor después de función por referencia: $valor<br>";

echo "<hr>";

// Ejemplo 8: Función con número variable de parámetros
echo "<h2>Ejemplo 8: Número Variable de Parámetros</h2>";

function sumarTodos(...$numeros) {
    $suma = 0;
    foreach ($numeros as $numero) {
        $suma += $numero;
    }
    return $suma;
}

function concatenarPalabras($separador, ...$palabras) {
    return implode($separador, $palabras);
}

echo "Suma de 5, 10, 15: " . sumarTodos(5, 10, 15) . "<br>";
echo "Suma de 1, 2, 3, 4, 5: " . sumarTodos(1, 2, 3, 4, 5) . "<br>";

echo concatenarPalabras(" ", "Hola", "mundo", "desde", "PHP") . "<br>";
echo concatenarPalabras(" - ", "Manzana", "Banana", "Naranja") . "<br>";

echo "<hr>";

// Ejemplo 9: Funciones para validación
echo "<h2>Ejemplo 9: Funciones de Validación</h2>";

function validarEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

function validarEdad($edad) {
    return is_numeric($edad) && $edad >= 0 && $edad <= 120;
}

function validarPassword($password) {
    $longitud = strlen($password) >= 8;
    $tieneNumero = preg_match('/[0-9]/', $password);
    $tieneMayuscula = preg_match('/[A-Z]/', $password);
    
    return $longitud && $tieneNumero && $tieneMayuscula;
}

// Pruebas de validación
$emails = ["usuario@ejemplo.com", "email_inválido", "test@test.org"];
$edades = [25, -5, 150, "30"];
$passwords = ["123", "MiPassword123", "password"];

echo "<strong>Validación de Emails:</strong><br>";
foreach ($emails as $email) {
    $resultado = validarEmail($email) ? "✅ Válido" : "❌ Inválido";
    echo "$email → $resultado<br>";
}

echo "<br><strong>Validación de Edades:</strong><br>";
foreach ($edades as $edad) {
    $resultado = validarEdad($edad) ? "✅ Válida" : "❌ Inválida";
    echo "$edad → $resultado<br>";
}

echo "<br><strong>Validación de Contraseñas:</strong><br>";
foreach ($passwords as $password) {
    $resultado = validarPassword($password) ? "✅ Segura" : "❌ Insegura";
    echo "$password → $resultado<br>";
}

echo "<hr>";

// Ejemplo 10: Función que devuelve múltiples valores
echo "<h2>Ejemplo 10: Devolver Múltiples Valores</h2>";

function analizarTexto($texto) {
    $longitud = strlen($texto);
    $palabras = str_word_count($texto);
    $caracteresSinEspacios = strlen(str_replace(' ', '', $texto));
    
    return [
        'longitud' => $longitud,
        'palabras' => $palabras,
        'sin_espacios' => $caracteresSinEspacios,
        'mayusculas' => strtoupper($texto),
        'minusculas' => strtolower($texto)
    ];
}

function calcularCirculo($radio) {
    $area = pi() * pow($radio, 2);
    $circunferencia = 2 * pi() * $radio;
    $diametro = 2 * $radio;
    
    return [$area, $circunferencia, $diametro];
}

$texto = "Hola Mundo desde PHP";
$analisis = analizarTexto($texto);

echo "Texto: '$texto'<br>";
echo "Longitud: " . $analisis['longitud'] . " caracteres<br>";
echo "Palabras: " . $analisis['palabras'] . "<br>";
echo "Sin espacios: " . $analisis['sin_espacios'] . " caracteres<br>";
echo "Mayúsculas: " . $analisis['mayusculas'] . "<br>";

echo "<br>";

$radio = 5;
[$area, $circunferencia, $diametro] = calcularCirculo($radio);

echo "Círculo con radio $radio:<br>";
echo "Área: " . round($area, 2) . "<br>";
echo "Circunferencia: " . round($circunferencia, 2) . "<br>";
echo "Diámetro: $diametro<br>";

echo "<hr>";

// Ejemplo 11: Funciones anónimas (closures)
echo "<h2>Ejemplo 11: Funciones Anónimas</h2>";

$multiplicar = function($a, $b) {
    return $a * $b;
};

$cuadrado = function($x) {
    return $x * $x;
};

echo "5 × 8 = " . $multiplicar(5, 8) . "<br>";
echo "7² = " . $cuadrado(7) . "<br>";

// Array de números para procesar
$numeros = [1, 2, 3, 4, 5];

// Usar array_map con función anónima
$cuadrados = array_map(function($n) {
    return $n * $n;
}, $numeros);

echo "Números: " . implode(", ", $numeros) . "<br>";
echo "Cuadrados: " . implode(", ", $cuadrados) . "<br>";

?>