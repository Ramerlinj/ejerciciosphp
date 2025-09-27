<?php
/**
 * Ejercicio 11: IF ELSE en PHP
 * 
 * La estructura if-else permite ejecutar un bloque de código si una condición es verdadera
 * y otro bloque diferente si la condición es falsa.
 * También se puede usar elseif para múltiples condiciones.
 */

echo "<h1>Ejercicio 11: IF ELSE</h1>";

// Ejemplo 1: Estructura básica if-else
echo "<h2>Ejemplo 1: Verificación de Edad</h2>";

$edad = 17;
echo "Edad: $edad años<br>";

if ($edad >= 18) {
    echo "<strong>Eres mayor de edad</strong> - Puedes votar<br>";
} else {
    echo "<strong>Eres menor de edad</strong> - No puedes votar aún<br>";
}

echo "<hr>";

// Ejemplo 2: if-elseif-else para múltiples condiciones
echo "<h2>Ejemplo 2: Sistema de Calificaciones</h2>";

$calificacion = 75;
echo "Calificación: $calificacion<br>";

if ($calificacion >= 90) {
    echo "<strong>A - EXCELENTE</strong><br>";
} elseif ($calificacion >= 80) {
    echo "<strong>B - MUY BIEN</strong><br>";
} elseif ($calificacion >= 70) {
    echo "<strong>C - BIEN</strong><br>";
} elseif ($calificacion >= 60) {
    echo "<strong>D - SUFICIENTE</strong><br>";
} else {
    echo "<strong>F - REPROBADO</strong><br>";
}

echo "<hr>";

// Ejemplo 3: Verificación de número par o impar
echo "<h2>Ejemplo 3: Número Par o Impar</h2>";

$numero = 23;
echo "Número: $numero<br>";

if ($numero % 2 == 0) {
    echo "El número <strong>$numero es PAR</strong><br>";
} else {
    echo "El número <strong>$numero es IMPAR</strong><br>";
}

echo "<hr>";

// Ejemplo 4: Verificación de día de la semana
echo "<h2>Ejemplo 4: Tipo de Día</h2>";

$dia = "sábado";
echo "Día: $dia<br>";

if ($dia == "sábado" || $dia == "domingo") {
    echo "<strong>FIN DE SEMANA</strong> - ¡Tiempo de descansar!<br>";
} else {
    echo "<strong>DÍA LABORABLE</strong> - A trabajar<br>";
}

echo "<hr>";

// Ejemplo 5: Verificación de temperatura
echo "<h2>Ejemplo 5: Estado del Clima</h2>";

$temperatura = 25;
echo "Temperatura: {$temperatura}°C<br>";

if ($temperatura >= 30) {
    echo "<strong>CALUROSO</strong> - Usa ropa ligera y mantente hidratado<br>";
} elseif ($temperatura >= 20) {
    echo "<strong>AGRADABLE</strong> - Perfecto para salir<br>";
} elseif ($temperatura >= 10) {
    echo "<strong>FRESCO</strong> - Lleva una chaqueta<br>";
} else {
    echo "<strong>FRÍO</strong> - Abrígate bien<br>";
}

echo "<hr>";

// Ejemplo 6: Verificación de contraseña
echo "<h2>Ejemplo 6: Validación de Contraseña</h2>";

$password = "123456";
$longitudMinima = 8;

echo "Contraseña: " . str_repeat("*", strlen($password)) . "<br>";
echo "Longitud: " . strlen($password) . " caracteres<br>";

if (strlen($password) >= $longitudMinima) {
    echo "<strong>CONTRASEÑA VÁLIDA</strong> - Cumple con la longitud mínima<br>";
} else {
    echo "<strong>CONTRASEÑA INVÁLIDA</strong> - Debe tener al menos $longitudMinima caracteres<br>";
}

echo "<hr>";

// Ejemplo 7: Estado de usuario basado en puntos
echo "<h2>Ejemplo 7: Nivel de Usuario por Puntos</h2>";

$puntos = 2500;
echo "Puntos acumulados: $puntos<br>";

if ($puntos >= 5000) {
    echo "<strong>USUARIO VIP</strong> - Descuentos del 20%<br>";
} elseif ($puntos >= 1000) {
    echo "<strong>USUARIO PREMIUM</strong> - Descuentos del 10%<br>";
} elseif ($puntos >= 100) {
    echo "<strong>USUARIO REGULAR</strong> - Descuentos del 5%<br>";
} else {
    echo "<strong>USUARIO NUEVO</strong> - ¡Sigue acumulando puntos!<br>";
}

echo "<hr>";

// Ejemplo 8: Verificación de stock de producto
echo "<h2>Ejemplo 8: Estado de Inventario</h2>";

$stock = 3;
$stockMinimo = 5;

echo "Stock actual: $stock unidades<br>";
echo "Stock mínimo: $stockMinimo unidades<br>";

if ($stock <= 0) {
    echo "<strong>SIN STOCK</strong> - Producto agotado<br>";
} elseif ($stock < $stockMinimo) {
    echo "<strong>STOCK BAJO</strong> - Necesita reposición urgente<br>";
} else {
    echo "<strong>STOCK DISPONIBLE</strong> - Inventario suficiente<br>";
}

echo "<hr>";

// Ejemplo 9: Operador ternario (forma abreviada de if-else)
echo "<h2>Ejemplo 9: Operador Ternario</h2>";

$esEstudiante = true;
$precio = 100;

echo "Es estudiante: " . ($esEstudiante ? "Sí" : "No") . "<br>";

// Operador ternario simple
$precioFinal = $esEstudiante ? $precio * 0.5 : $precio;
echo "Precio original: $$precio<br>";
echo "Precio final: $$precioFinal<br>";

// Equivalente con if-else tradicional
if ($esEstudiante) {
    $descuento = "50% de descuento aplicado";
} else {
    $descuento = "Sin descuento";
}
echo "Estado: $descuento<br>";

?>