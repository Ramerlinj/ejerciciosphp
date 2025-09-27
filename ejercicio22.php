<?php
/*
EJERCICIO 22 - ARREGLOS ASOCIATIVOS EN PHP
==========================================

DOCUMENTACION:
- Los arrays asociativos usan claves (keys) en lugar de índices numéricos
- Las claves pueden ser strings o números
- Muy útiles para representar datos estructurados
- Se accede con $array['clave'] o $array[$variable]

SINTAXIS:
$array = array('clave' => 'valor');
$array = ['clave' => 'valor'];
$array['clave'] = 'valor';
*/

echo "<h2>EJERCICIO 22 - ARREGLOS ASOCIATIVOS</h2>";

// EJEMPLO 1: Información personal
echo "<h3>Ejemplo 1: Datos de Persona</h3>";

// Crear array asociativo con datos personales
$persona = [
    'nombre' => 'Juan Pérez',
    'edad' => 28,
    'ciudad' => 'Madrid',
    'profesion' => 'Desarrollador',
    'email' => 'juan@email.com'
];

echo "Información personal:<br>";
echo "Nombre: " . $persona['nombre'] . "<br>";
echo "Edad: " . $persona['edad'] . " años<br>";
echo "Ciudad: " . $persona['ciudad'] . "<br>";
echo "Profesión: " . $persona['profesion'] . "<br>";
echo "Email: " . $persona['email'] . "<br>";

echo "<br>Recorriendo todos los datos:<br>";
foreach ($persona as $campo => $valor) {
    echo ucfirst($campo) . ": $valor<br>";
}

echo "<br>";

// EJEMPLO 2: Inventario de productos
echo "<h3>Ejemplo 2: Inventario de Tienda</h3>";

$productos = [
    'laptop' => ['precio' => 899.99, 'stock' => 15, 'categoria' => 'Electrónicos'],
    'mouse' => ['precio' => 25.50, 'stock' => 50, 'categoria' => 'Accesorios'],
    'teclado' => ['precio' => 45.00, 'stock' => 30, 'categoria' => 'Accesorios'],
    'monitor' => ['precio' => 299.99, 'stock' => 8, 'categoria' => 'Electrónicos']
];

echo "Inventario de productos:<br>";
foreach ($productos as $nombre => $detalles) {
    echo "<strong>" . ucfirst($nombre) . "</strong><br>";
    echo "  Precio: $" . number_format($detalles['precio'], 2) . "<br>";
    echo "  Stock: " . $detalles['stock'] . " unidades<br>";
    echo "  Categoría: " . $detalles['categoria'] . "<br>";
    
    // Verificar nivel de stock
    if ($detalles['stock'] < 10) {
        echo "  <em>⚠ Stock bajo</em><br>";
    }
    echo "<br>";
}

// Calcular valor total del inventario
$valor_total = 0;
foreach ($productos as $detalles) {
    $valor_total += $detalles['precio'] * $detalles['stock'];
}
echo "Valor total del inventario: $" . number_format($valor_total, 2) . "<br>";

// Productos por categoría
echo "<br>Productos por categoría:<br>";
$categorias = [];
foreach ($productos as $nombre => $detalles) {
    $cat = $detalles['categoria'];
    if (!isset($categorias[$cat])) {
        $categorias[$cat] = [];
    }
    $categorias[$cat][] = $nombre;
}

foreach ($categorias as $categoria => $items) {
    echo "$categoria: " . implode(', ', $items) . "<br>";
}
?>