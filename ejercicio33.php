<?php
/*
EJERCICIO 33 - FUNCION JSON DECODE
==================================

DOCUMENTACION:
- json_decode(): Convierte string JSON a variable PHP
- Parámetros: json_decode($json, $assoc, $depth, $options)
- $assoc = true: Devuelve array asociativo
- $assoc = false: Devuelve objeto stdClass (por defecto)
- JSON válido debe usar comillas dobles para strings

SINTAXIS:
$array = json_decode($json_string, true);  // Array
$objeto = json_decode($json_string, false); // Objeto
*/

echo "<h2>EJERCICIO 33 - JSON DECODE</h2>";

// EJEMPLO 1: Decodificar JSON básico
echo "<h3>Ejemplo 1: JSON Básico</h3>";

$json_usuario = '{
    "id": 1,
    "nombre": "Juan Pérez",
    "email": "juan@email.com",
    "edad": 28,
    "activo": true
}';

echo "JSON original:<br>";
echo "<pre>" . htmlspecialchars($json_usuario) . "</pre>";

// Decodificar como array asociativo
$usuario_array = json_decode($json_usuario, true);
echo "Decodificado como array:<br>";
echo "Nombre: " . $usuario_array['nombre'] . "<br>";
echo "Email: " . $usuario_array['email'] . "<br>";
echo "Edad: " . $usuario_array['edad'] . "<br>";
echo "Activo: " . ($usuario_array['activo'] ? 'Sí' : 'No') . "<br>";

// Decodificar como objeto
$usuario_objeto = json_decode($json_usuario, false);
echo "<br>Decodificado como objeto:<br>";
echo "Nombre: " . $usuario_objeto->nombre . "<br>";
echo "Email: " . $usuario_objeto->email . "<br>";
echo "ID: " . $usuario_objeto->id . "<br>";

echo "<br>";

// EJEMPLO 2: JSON complejo con arrays anidados
echo "<h3>Ejemplo 2: JSON Complejo</h3>";

$json_complejo = '{
    "empresa": {
        "nombre": "TechCorp",
        "fundada": 2020,
        "ubicacion": {
            "pais": "España",
            "ciudad": "Madrid",
            "direccion": "Calle Principal 123"
        }
    },
    "empleados": [
        {
            "id": 1,
            "nombre": "Ana García",
            "departamento": "Desarrollo",
            "salario": 45000,
            "habilidades": ["PHP", "JavaScript", "MySQL"]
        },
        {
            "id": 2,
            "nombre": "Carlos López",
            "departamento": "Marketing",
            "salario": 38000,
            "habilidades": ["SEO", "Analytics", "Social Media"]
        },
        {
            "id": 3,
            "nombre": "María Rodríguez",
            "departamento": "Desarrollo",
            "salario": 52000,
            "habilidades": ["Python", "React", "Docker"]
        }
    ],
    "configuracion": {
        "modo_debug": false,
        "version": "2.1.0",
        "features": ["usuarios", "reportes", "api"]
    }
}';

echo "JSON complejo:<br>";
echo "<pre style='background: #f5f5f5; padding: 10px; max-height: 200px; overflow-y: auto;'>" . 
     htmlspecialchars($json_complejo) . "</pre>";

$datos = json_decode($json_complejo, true);

if (json_last_error() === JSON_ERROR_NONE) {
    echo "<strong>Información de la empresa:</strong><br>";
    echo "Nombre: " . $datos['empresa']['nombre'] . "<br>";
    echo "Fundada: " . $datos['empresa']['fundada'] . "<br>";
    echo "Ubicación: " . $datos['empresa']['ubicacion']['ciudad'] . ", " . 
         $datos['empresa']['ubicacion']['pais'] . "<br><br>";
    
    echo "<strong>Empleados:</strong><br>";
    foreach ($datos['empleados'] as $empleado) {
        echo "• " . $empleado['nombre'] . " (" . $empleado['departamento'] . ")<br>";
        echo "  Salario: €" . number_format($empleado['salario']) . "<br>";
        echo "  Habilidades: " . implode(', ', $empleado['habilidades']) . "<br><br>";
    }
    
    // Calcular estadísticas
    $total_empleados = count($datos['empleados']);
    $suma_salarios = array_sum(array_column($datos['empleados'], 'salario'));
    $salario_promedio = $suma_salarios / $total_empleados;
    
    echo "<strong>Estadísticas:</strong><br>";
    echo "Total empleados: $total_empleados<br>";
    echo "Salario promedio: €" . number_format($salario_promedio, 2) . "<br>";
    
    // Empleados por departamento
    $por_departamento = [];
    foreach ($datos['empleados'] as $empleado) {
        $dept = $empleado['departamento'];
        if (!isset($por_departamento[$dept])) {
            $por_departamento[$dept] = 0;
        }
        $por_departamento[$dept]++;
    }
    
    echo "Empleados por departamento:<br>";
    foreach ($por_departamento as $dept => $cantidad) {
        echo "- $dept: $cantidad<br>";
    }
    
} else {
    echo "Error decodificando JSON: " . json_last_error_msg();
}

echo "<br>";

// Función para manejar errores JSON
function decodificarJSONSeguro($json_string, $como_array = true) {
    $resultado = json_decode($json_string, $como_array);
    
    $errores = [
        JSON_ERROR_NONE => 'Sin errores',
        JSON_ERROR_DEPTH => 'Profundidad máxima excedida',
        JSON_ERROR_STATE_MISMATCH => 'JSON malformado o mal codificado',
        JSON_ERROR_CTRL_CHAR => 'Error de carácter de control',
        JSON_ERROR_SYNTAX => 'Error de sintaxis JSON',
        JSON_ERROR_UTF8 => 'Caracteres UTF-8 malformados'
    ];
    
    $codigo_error = json_last_error();
    
    if ($codigo_error === JSON_ERROR_NONE) {
        return ['exito' => true, 'datos' => $resultado];
    } else {
        $mensaje = isset($errores[$codigo_error]) ? 
                  $errores[$codigo_error] : 'Error desconocido';
        return ['exito' => false, 'error' => $mensaje, 'codigo' => $codigo_error];
    }
}

echo "<h3>Ejemplo 3: Manejo de Errores</h3>";

// JSON válido
$json_valido = '{"nombre": "Pedro", "edad": 30}';
$resultado1 = decodificarJSONSeguro($json_valido);

if ($resultado1['exito']) {
    echo "JSON válido decodificado:<br>";
    echo "Nombre: " . $resultado1['datos']['nombre'] . "<br>";
    echo "Edad: " . $resultado1['datos']['edad'] . "<br>";
} else {
    echo "Error: " . $resultado1['error'] . "<br>";
}

echo "<br>";

// JSON inválido (sintaxis incorrecta)
$json_invalido = '{"nombre": "Pedro", "edad": 30,}'; // Coma extra
$resultado2 = decodificarJSONSeguro($json_invalido);

if ($resultado2['exito']) {
    echo "JSON decodificado correctamente<br>";
} else {
    echo "Error con JSON inválido: " . $resultado2['error'] . "<br>";
    echo "Código de error: " . $resultado2['codigo'] . "<br>";
}

// Ejemplo de JSON desde archivo simulado
echo "<br><h4>Simulación de lectura desde archivo:</h4>";
$contenido_archivo = '{"config": {"debug": true, "version": "1.0"}, "users": ["admin", "guest"]}';
$config = decodificarJSONSeguro($contenido_archivo);

if ($config['exito']) {
    echo "Configuración cargada desde archivo:<br>";
    echo "Debug: " . ($config['datos']['config']['debug'] ? 'Activado' : 'Desactivado') . "<br>";
    echo "Versión: " . $config['datos']['config']['version'] . "<br>";
    echo "Usuarios: " . implode(', ', $config['datos']['users']) . "<br>";
}
?>