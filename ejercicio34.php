<?php
/*
EJERCICIO 34 - FUNCION JSON ENCODE
==================================

DOCUMENTACION:
- json_encode(): Convierte variables PHP a string JSON
- Parámetros: json_encode($value, $options, $depth)
- Opciones comunes: JSON_PRETTY_PRINT, JSON_UNESCAPED_UNICODE
- Convierte arrays, objetos, strings, números, booleanos
- null se convierte a "null", recursos no se pueden convertir

SINTAXIS:
$json = json_encode($array);
$json = json_encode($objeto, JSON_PRETTY_PRINT);
*/

echo "<h2>EJERCICIO 34 - JSON ENCODE</h2>";

// EJEMPLO 1: Convertir arrays y datos básicos
echo "<h3>Ejemplo 1: Arrays y Datos Básicos</h3>";

// Array simple
$frutas = ['manzana', 'banana', 'naranja', 'uva'];
$json_frutas = json_encode($frutas);
echo "Array simple:<br>";
echo "PHP: " . print_r($frutas, true) . "<br>";
echo "JSON: " . $json_frutas . "<br><br>";

// Array asociativo
$persona = [
    'nombre' => 'María García',
    'edad' => 32,
    'email' => 'maria@email.com',
    'activo' => true,
    'salario' => null
];

$json_persona = json_encode($persona);
echo "Array asociativo:<br>";
echo "JSON compacto: " . $json_persona . "<br>";

// JSON formateado (pretty print)
$json_formateado = json_encode($persona, JSON_PRETTY_PRINT);
echo "JSON formateado:<br>";
echo "<pre>" . $json_formateado . "</pre>";

echo "<br>";

// EJEMPLO 2: Estructuras complejas y objetos
echo "<h3>Ejemplo 2: Estructuras Complejas</h3>";

class Producto {
    public $id;
    public $nombre;
    public $precio;
    private $costo; // Propiedades privadas no se incluyen
    
    public function __construct($id, $nombre, $precio, $costo) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->precio = $precio;
        $this->costo = $costo;
    }
}

// Crear productos
$productos = [
    new Producto(1, "Laptop Gaming", 1299.99, 800.00),
    new Producto(2, "Mouse Inalámbrico", 29.99, 15.00),
    new Producto(3, "Teclado Mecánico", 89.99, 45.00)
];

// Datos complejos con objetos y arrays anidados
$tienda = [
    'nombre' => 'TechStore',
    'ubicacion' => [
        'pais' => 'España',
        'ciudad' => 'Madrid',
        'coordenadas' => [
            'lat' => 40.4168,
            'lng' => -3.7038
        ]
    ],
    'productos' => $productos,
    'estadisticas' => [
        'ventas_mes' => 15420.50,
        'clientes_registrados' => 1250,
        'productos_activos' => count($productos)
    ],
    'configuracion' => [
        'moneda' => 'EUR',
        'idioma' => 'es',
        'descuentos_activos' => true,
        'categorias' => ['Electrónicos', 'Accesorios', 'Software']
    ]
];

echo "Estructura compleja de tienda:<br>";
$json_tienda = json_encode($tienda, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
echo "<pre style='background: #f5f5f5; padding: 10px; max-height: 300px; overflow-y: auto;'>" . 
     $json_tienda . "</pre>";

// Función para generar respuestas API
function generarRespuestaAPI($datos, $exito = true, $mensaje = '') {
    $respuesta = [
        'timestamp' => date('Y-m-d H:i:s'),
        'exito' => $exito,
        'mensaje' => $mensaje,
        'datos' => $datos
    ];
    
    return json_encode($respuesta, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
}

echo "<br><h4>Ejemplo de respuesta API:</h4>";

// Simulación de respuesta exitosa
$usuarios_activos = [
    ['id' => 1, 'nombre' => 'Ana', 'ultimo_acceso' => '2024-01-15 10:30:00'],
    ['id' => 2, 'nombre' => 'Carlos', 'ultimo_acceso' => '2024-01-15 11:45:00']
];

$respuesta_exitosa = generarRespuestaAPI($usuarios_activos, true, 'Usuarios obtenidos correctamente');
echo "Respuesta exitosa:<br>";
echo "<pre>" . $respuesta_exitosa . "</pre>";

// Simulación de respuesta con error
$respuesta_error = generarRespuestaAPI(null, false, 'Usuario no encontrado');
echo "Respuesta con error:<br>";
echo "<pre>" . $respuesta_error . "</pre>";

echo "<br>";

// EJEMPLO 3: Opciones de codificación y manejo de errores
echo "<h3>Ejemplo 3: Opciones y Manejo de Errores</h3>";

$datos_especiales = [
    'texto_unicode' => 'Niño, año, ñoño',
    'caracteres_especiales' => 'Symbols: © ® ™ €',
    'numeros' => [1, 2.5, -10, 0],
    'booleanos' => [true, false],
    'nulo' => null,
    'array_vacio' => [],
    'objeto_vacio' => new stdClass()
];

// Diferentes opciones de codificación
echo "Opciones de codificación:<br>";

echo "1. Por defecto:<br>";
echo json_encode($datos_especiales) . "<br><br>";

echo "2. Con formato legible:<br>";
echo "<pre>" . json_encode($datos_especiales, JSON_PRETTY_PRINT) . "</pre>";

echo "3. Sin escapar Unicode:<br>";
echo json_encode($datos_especiales, JSON_UNESCAPED_UNICODE) . "<br><br>";

echo "4. Sin escapar barras:<br>";
$datos_con_urls = ['sitio' => 'https://example.com/path', 'path' => '/home/user'];
echo "Con escapes: " . json_encode($datos_con_urls) . "<br>";
echo "Sin escapes: " . json_encode($datos_con_urls, JSON_UNESCAPED_SLASHES) . "<br><br>";

// Función segura para encoding
function codificarJSONSeguro($datos, $opciones = 0) {
    $json = json_encode($datos, $opciones);
    
    if (json_last_error() === JSON_ERROR_NONE) {
        return ['exito' => true, 'json' => $json];
    } else {
        return [
            'exito' => false,
            'error' => json_last_error_msg(),
            'codigo' => json_last_error()
        ];
    }
}

// Probar con datos válidos
$resultado_valido = codificarJSONSeguro($tienda, JSON_PRETTY_PRINT);
if ($resultado_valido['exito']) {
    echo "✓ Codificación exitosa (datos válidos)<br>";
} else {
    echo "✗ Error: " . $resultado_valido['error'] . "<br>";
}

// Simular error con recursión infinita
$a = ['referencia' => null];
$b = ['referencia' => &$a];
$a['referencia'] = &$b; // Referencia circular

$resultado_error = codificarJSONSeguro($a);
if ($resultado_error['exito']) {
    echo "Codificación exitosa<br>";
} else {
    echo "✗ Error detectado: " . $resultado_error['error'] . "<br>";
}

// Casos de uso comunes
echo "<br><h4>Casos de Uso Comunes:</h4>";

// 1. Configuración para JavaScript
$config_js = [
    'api_url' => 'https://api.misite.com',
    'debug_mode' => false,
    'user_preferences' => [
        'theme' => 'dark',
        'language' => 'es'
    ]
];

echo "Configuración para JavaScript:<br>";
echo "<code>const CONFIG = " . json_encode($config_js, JSON_PRETTY_PRINT) . ";</code><br><br>";

// 2. Log de eventos
$evento_log = [
    'timestamp' => time(),
    'nivel' => 'INFO',
    'mensaje' => 'Usuario logueado exitosamente',
    'contexto' => [
        'usuario_id' => 123,
        'ip' => '192.168.1.1',
        'user_agent' => 'Mozilla/5.0...'
    ]
];

echo "Entrada de log:<br>";
echo json_encode($evento_log, JSON_UNESCAPED_SLASHES) . "<br>";
?>