<?php
/*
EJERCICIO 35 - CONSUMIR UNA API CON PHP
=======================================

DOCUMENTACION:
- cURL: Librería para realizar peticiones HTTP
- file_get_contents(): Método simple para GET requests
- json_decode(): Para procesar respuestas JSON
- Headers: Configurar autenticación y tipo de contenido
- Métodos: GET, POST, PUT, DELETE

SINTAXIS cURL:
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
curl_close($ch);
*/

echo "<h2>EJERCICIO 35 - CONSUMIR API CON PHP</h2>";

// EJEMPLO 1: API simple con file_get_contents
echo "<h3>Ejemplo 1: Método Simple con file_get_contents</h3>";

function obtenerDatosSimple($url) {
    // Configurar contexto para la petición
    $contexto = stream_context_create([
        'http' => [
            'method' => 'GET',
            'header' => [
                'User-Agent: PHP API Client 1.0',
                'Accept: application/json'
            ],
            'timeout' => 10
        ]
    ]);
    
    // Realizar petición
    $respuesta = @file_get_contents($url, false, $contexto);
    
    if ($respuesta === false) {
        return ['error' => 'No se pudo conectar a la API'];
    }
    
    // Decodificar JSON
    $datos = json_decode($respuesta, true);
    
    if (json_last_error() === JSON_ERROR_NONE) {
        return ['exito' => true, 'datos' => $datos];
    } else {
        return ['error' => 'Respuesta JSON inválida: ' . json_last_error_msg()];
    }
}

// Usar API pública JSONPlaceholder (simulada)
echo "Simulando petición a API de usuarios:<br>";

// Simulación de respuesta API (en la realidad sería una URL real)
$respuesta_simulada = '[
    {"id": 1, "name": "Juan Pérez", "email": "juan@example.com", "city": "Madrid"},
    {"id": 2, "name": "María García", "email": "maria@example.com", "city": "Barcelona"},
    {"id": 3, "name": "Carlos López", "email": "carlos@example.com", "city": "Valencia"}
]';

$usuarios = json_decode($respuesta_simulada, true);

echo "Usuarios obtenidos de la API:<br>";
foreach ($usuarios as $usuario) {
    echo "• ID: " . $usuario['id'] . " - " . $usuario['name'] . 
         " (" . $usuario['email'] . ") - " . $usuario['city'] . "<br>";
}

echo "<br>";

// EJEMPLO 2: Cliente API completo con cURL
echo "<h3>Ejemplo 2: Cliente API Completo con cURL</h3>";

class ClienteAPI {
    private $base_url;
    private $headers;
    
    public function __construct($base_url, $headers = []) {
        $this->base_url = rtrim($base_url, '/');
        $this->headers = array_merge([
            'Content-Type: application/json',
            'User-Agent: PHP API Client 2.0'
        ], $headers);
    }
    
    private function realizarPeticion($endpoint, $metodo = 'GET', $datos = null) {
        $url = $this->base_url . '/' . ltrim($endpoint, '/');
        
        $curl = curl_init();
        
        // Configuración básica
        curl_setopt_array($curl, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTPHEADER => $this->headers,
            CURLOPT_SSL_VERIFYPEER => false, // Solo para desarrollo
            CURLOPT_FOLLOWLOCATION => true
        ]);
        
        // Configurar según método HTTP
        switch (strtoupper($metodo)) {
            case 'POST':
                curl_setopt($curl, CURLOPT_POST, true);
                if ($datos) {
                    curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($datos));
                }
                break;
                
            case 'PUT':
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'PUT');
                if ($datos) {
                    curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($datos));
                }
                break;
                
            case 'DELETE':
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'DELETE');
                break;
        }
        
        // Ejecutar petición
        $respuesta = curl_exec($curl);
        $codigo_http = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        $error = curl_error($curl);
        
        curl_close($curl);
        
        // Manejar errores de cURL
        if ($respuesta === false || !empty($error)) {
            return [
                'exito' => false,
                'error' => $error ?: 'Error desconocido en cURL',
                'codigo_http' => $codigo_http
            ];
        }
        
        // Decodificar respuesta JSON
        $datos_decodificados = json_decode($respuesta, true);
        
        return [
            'exito' => $codigo_http >= 200 && $codigo_http < 300,
            'codigo_http' => $codigo_http,
            'datos' => $datos_decodificados,
            'respuesta_raw' => $respuesta
        ];
    }
    
    public function obtener($endpoint) {
        return $this->realizarPeticion($endpoint, 'GET');
    }
    
    public function crear($endpoint, $datos) {
        return $this->realizarPeticion($endpoint, 'POST', $datos);
    }
    
    public function actualizar($endpoint, $datos) {
        return $this->realizarPeticion($endpoint, 'PUT', $datos);
    }
    
    public function eliminar($endpoint) {
        return $this->realizarPeticion($endpoint, 'DELETE');
    }
}

// Simular uso del cliente API
echo "Simulando cliente API:<br>";

class APISimulada {
    public static function simularRespuesta($metodo, $endpoint, $datos = null) {
        // Simular diferentes respuestas según el endpoint
        switch ($endpoint) {
            case '/productos':
                if ($metodo === 'GET') {
                    return [
                        'exito' => true,
                        'codigo_http' => 200,
                        'datos' => [
                            ['id' => 1, 'nombre' => 'Laptop', 'precio' => 999.99],
                            ['id' => 2, 'nombre' => 'Mouse', 'precio' => 29.99],
                            ['id' => 3, 'nombre' => 'Teclado', 'precio' => 79.99]
                        ]
                    ];
                } elseif ($metodo === 'POST') {
                    return [
                        'exito' => true,
                        'codigo_http' => 201,
                        'datos' => ['id' => 4, 'mensaje' => 'Producto creado exitosamente']
                    ];
                }
                break;
                
            case '/productos/1':
                if ($metodo === 'PUT') {
                    return [
                        'exito' => true,
                        'codigo_http' => 200,
                        'datos' => ['mensaje' => 'Producto actualizado exitosamente']
                    ];
                } elseif ($metodo === 'DELETE') {
                    return [
                        'exito' => true,
                        'codigo_http' => 200,
                        'datos' => ['mensaje' => 'Producto eliminado exitosamente']
                    ];
                }
                break;
                
            case '/clima/madrid':
                return [
                    'exito' => true,
                    'codigo_http' => 200,
                    'datos' => [
                        'ciudad' => 'Madrid',
                        'temperatura' => 22,
                        'descripcion' => 'Soleado',
                        'humedad' => 65,
                        'viento' => 10
                    ]
                ];
        }
        
        return [
            'exito' => false,
            'codigo_http' => 404,
            'datos' => ['error' => 'Endpoint no encontrado']
        ];
    }
}

// Demostrar diferentes tipos de peticiones
echo "<strong>1. GET - Obtener productos:</strong><br>";
$respuesta = APISimulada::simularRespuesta('GET', '/productos');
if ($respuesta['exito']) {
    foreach ($respuesta['datos'] as $producto) {
        echo "• " . $producto['nombre'] . " - €" . $producto['precio'] . "<br>";
    }
} else {
    echo "Error: " . $respuesta['datos']['error'] . "<br>";
}

echo "<br><strong>2. POST - Crear producto:</strong><br>";
$nuevo_producto = ['nombre' => 'Monitor 4K', 'precio' => 399.99, 'categoria' => 'Monitores'];
$respuesta = APISimulada::simularRespuesta('POST', '/productos', $nuevo_producto);
echo "Código HTTP: " . $respuesta['codigo_http'] . "<br>";
echo "Respuesta: " . $respuesta['datos']['mensaje'] . "<br>";

echo "<br><strong>3. GET - Obtener clima:</strong><br>";
$respuesta = APISimulada::simularRespuesta('GET', '/clima/madrid');
if ($respuesta['exito']) {
    $clima = $respuesta['datos'];
    echo "Ciudad: " . $clima['ciudad'] . "<br>";
    echo "Temperatura: " . $clima['temperatura'] . "°C<br>";
    echo "Condiciones: " . $clima['descripcion'] . "<br>";
    echo "Humedad: " . $clima['humedad'] . "%<br>";
    echo "Viento: " . $clima['viento'] . " km/h<br>";
}

echo "<br>";

// Función para manejar múltiples APIs
function consumirMultiplesAPIs($endpoints) {
    $resultados = [];
    
    foreach ($endpoints as $nombre => $config) {
        echo "Consultando $nombre...<br>";
        
        // Simular respuesta según el tipo
        switch ($nombre) {
            case 'usuarios':
                $resultados[$nombre] = [
                    'total' => 150,
                    'activos' => 120,
                    'nuevos_hoy' => 5
                ];
                break;
                
            case 'ventas':
                $resultados[$nombre] = [
                    'total_mes' => 45230.50,
                    'ordenes_hoy' => 23,
                    'producto_mas_vendido' => 'Laptop Gaming'
                ];
                break;
                
            case 'sistema':
                $resultados[$nombre] = [
                    'status' => 'operativo',
                    'uptime' => '99.9%',
                    'ultimo_backup' => '2024-01-15 02:00:00'
                ];
                break;
        }
    }
    
    return $resultados;
}

echo "<h4>Dashboard con Múltiples APIs:</h4>";
$apis = [
    'usuarios' => ['url' => 'https://api.ejemplo.com/usuarios'],
    'ventas' => ['url' => 'https://api.ejemplo.com/ventas'],
    'sistema' => ['url' => 'https://api.ejemplo.com/sistema']
];

$dashboard = consumirMultiplesAPIs($apis);

foreach ($dashboard as $api => $datos) {
    echo "<strong>" . ucfirst($api) . ":</strong><br>";
    foreach ($datos as $clave => $valor) {
        echo "  " . str_replace('_', ' ', ucfirst($clave)) . ": $valor<br>";
    }
    echo "<br>";
}

// Ejemplo de manejo de errores y reintentos
function peticionConReintentos($url, $max_intentos = 3) {
    for ($intento = 1; $intento <= $max_intentos; $intento++) {
        echo "Intento $intento de $max_intentos...<br>";
        
        // Simular éxito aleatorio
        if (rand(1, 3) === 1) {
            return [
                'exito' => true,
                'datos' => ['mensaje' => 'Conexión exitosa en intento ' . $intento],
                'intentos' => $intento
            ];
        }
        
        if ($intento < $max_intentos) {
            sleep(1); // Esperar antes del siguiente intento
        }
    }
    
    return [
        'exito' => false,
        'error' => 'Todos los intentos fallaron',
        'intentos' => $max_intentos
    ];
}

echo "<h4>Ejemplo con Reintentos:</h4>";
$resultado_reintentos = peticionConReintentos('https://api.inestable.com');
if ($resultado_reintentos['exito']) {
    echo "✓ " . $resultado_reintentos['datos']['mensaje'] . "<br>";
} else {
    echo "✗ " . $resultado_reintentos['error'] . " (intentos: " . $resultado_reintentos['intentos'] . ")<br>";
}
?>