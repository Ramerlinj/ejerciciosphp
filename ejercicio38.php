<?php
/*
EJERCICIO 38 - ABRIR UN ARCHIVO EN PHP
======================================

DOCUMENTACION:
- fopen(): Abre un archivo o URL
- Modos de apertura: r (lectura), w (escritura), a (agregar), x (crear)
- fread(): Lee contenido del archivo
- fclose(): Cierra el archivo abierto
- file_get_contents(): Método simple para leer todo el archivo

MODOS DE APERTURA:
- 'r': Solo lectura, puntero al inicio
- 'w': Solo escritura, trunca archivo, puntero al inicio  
- 'a': Solo escritura, puntero al final (append)
- 'x': Crear y abrir para escritura, falla si existe
- '+': Añadir a r, w, a para lectura y escritura
*/

echo "<h2>EJERCICIO 38 - ABRIR ARCHIVOS</h2>";

// Crear archivo de ejemplo si no existe
$archivo_ejemplo = 'datos/ejemplo.txt';
$directorio_datos = 'datos';

if (!file_exists($directorio_datos)) {
    mkdir($directorio_datos, 0777, true);
}

if (!file_exists($archivo_ejemplo)) {
    $contenido_inicial = "Esta es la línea 1 del archivo\n";
    $contenido_inicial .= "Esta es la línea 2 del archivo\n";
    $contenido_inicial .= "Esta es la línea 3 del archivo\n";
    $contenido_inicial .= "Archivo creado el: " . date('Y-m-d H:i:s') . "\n";
    
    file_put_contents($archivo_ejemplo, $contenido_inicial);
}

// EJEMPLO 1: Abrir archivo para lectura
echo "<h3>Ejemplo 1: Abrir Archivo para Lectura</h3>";

echo "Abriendo archivo '$archivo_ejemplo' para lectura:<br>";

// Método 1: fopen + fread + fclose
$archivo = fopen($archivo_ejemplo, 'r');

if ($archivo) {
    echo "✓ Archivo abierto exitosamente<br>";
    
    // Leer todo el contenido
    $tamaño = filesize($archivo_ejemplo);
    $contenido = fread($archivo, $tamaño);
    
    echo "Contenido del archivo ($tamaño bytes):<br>";
    echo "<pre style='background: #f5f5f5; padding: 10px;'>" . htmlspecialchars($contenido) . "</pre>";
    
    // Cerrar archivo
    fclose($archivo);
    echo "Archivo cerrado<br>";
} else {
    echo "✗ Error al abrir archivo<br>";
}

echo "<br>";

// Método 2: file_get_contents (más simple)
echo "Método alternativo con file_get_contents():<br>";
$contenido_simple = file_get_contents($archivo_ejemplo);
echo "Contenido: " . nl2br(htmlspecialchars($contenido_simple)) . "<br>";

echo "<br>";

// EJEMPLO 2: Diferentes modos de apertura
echo "<h3>Ejemplo 2: Diferentes Modos de Apertura</h3>";

function demostrarModoApertura($archivo, $modo, $descripcion) {
    echo "<strong>Modo '$modo' ($descripcion):</strong><br>";
    
    $handle = @fopen($archivo, $modo);
    
    if ($handle) {
        echo "✓ Archivo abierto correctamente<br>";
        
        // Mostrar información del archivo
        $stats = fstat($handle);
        echo "Tamaño: " . $stats['size'] . " bytes<br>";
        echo "Posición inicial del puntero: " . ftell($handle) . "<br>";
        
        fclose($handle);
    } else {
        echo "✗ No se pudo abrir el archivo en modo '$modo'<br>";
    }
    
    echo "<br>";
}

demostrarModoApertura($archivo_ejemplo, 'r', 'Solo lectura');
demostrarModoApertura($archivo_ejemplo, 'r+', 'Lectura y escritura');

// Para modos que modifican, usar archivo temporal
$archivo_temp = 'datos/temp_test.txt';

demostrarModoApertura($archivo_temp, 'w', 'Solo escritura, trunca archivo');
demostrarModoApertura($archivo_temp, 'a', 'Solo escritura, append al final');
demostrarModoApertura($archivo_temp, 'x', 'Crear nuevo, falla si existe');

// Limpiar archivo temporal si existe
if (file_exists($archivo_temp)) {
    unlink($archivo_temp);
}

// EJEMPLO 3: Lectura línea por línea
echo "<h3>Ejemplo 3: Lectura Línea por Línea</h3>";

$archivo = fopen($archivo_ejemplo, 'r');

if ($archivo) {
    echo "Leyendo archivo línea por línea:<br>";
    $numero_linea = 1;
    
    while (($linea = fgets($archivo)) !== false) {
        echo "Línea $numero_linea: " . htmlspecialchars(trim($linea)) . "<br>";
        $numero_linea++;
    }
    
    fclose($archivo);
} else {
    echo "Error al abrir archivo<br>";
}

echo "<br>";

// EJEMPLO 4: Funciones auxiliares para manejo de archivos
echo "<h3>Ejemplo 4: Funciones Auxiliares</h3>";

class ManejadorArchivos {
    
    public static function abrirSeguro($archivo, $modo = 'r') {
        if (!file_exists($archivo) && !in_array($modo, ['w', 'a', 'x', 'c'])) {
            return ['error' => "Archivo no existe: $archivo"];
        }
        
        $handle = @fopen($archivo, $modo);
        
        if ($handle === false) {
            return ['error' => "No se pudo abrir archivo en modo '$modo'"];
        }
        
        return ['handle' => $handle, 'modo' => $modo];
    }
    
    public static function leerArchivo($archivo) {
        $resultado = self::abrirSeguro($archivo, 'r');
        
        if (isset($resultado['error'])) {
            return $resultado;
        }
        
        $handle = $resultado['handle'];
        $contenido = '';
        
        while (($linea = fgets($handle)) !== false) {
            $contenido .= $linea;
        }
        
        fclose($handle);
        
        return [
            'contenido' => $contenido,
            'lineas' => substr_count($contenido, "\n"),
            'tamaño' => strlen($contenido)
        ];
    }
    
    public static function obtenerInformacionArchivo($archivo) {
        if (!file_exists($archivo)) {
            return ['error' => 'Archivo no existe'];
        }
        
        $info = [
            'nombre' => basename($archivo),
            'ruta' => realpath($archivo),
            'tamaño' => filesize($archivo),
            'tipo' => filetype($archivo),
            'permisos' => substr(sprintf('%o', fileperms($archivo)), -4),
            'creado' => date('Y-m-d H:i:s', filectime($archivo)),
            'modificado' => date('Y-m-d H:i:s', filemtime($archivo)),
            'accedido' => date('Y-m-d H:i:s', fileatime($archivo)),
            'legible' => is_readable($archivo),
            'escribible' => is_writable($archivo)
        ];
        
        return $info;
    }
}

// Usar funciones auxiliares
echo "Usando ManejadorArchivos:<br>";

$info = ManejadorArchivos::obtenerInformacionArchivo($archivo_ejemplo);
if (!isset($info['error'])) {
    echo "<strong>Información del archivo:</strong><br>";
    foreach ($info as $clave => $valor) {
        $valor_mostrar = is_bool($valor) ? ($valor ? 'Sí' : 'No') : $valor;
        echo "- " . ucfirst($clave) . ": $valor_mostrar<br>";
    }
} else {
    echo "Error: " . $info['error'] . "<br>";
}

echo "<br>";

$lectura = ManejadorArchivos::leerArchivo($archivo_ejemplo);
if (!isset($lectura['error'])) {
    echo "<strong>Contenido leído:</strong><br>";
    echo "Líneas: " . $lectura['lineas'] . "<br>";
    echo "Tamaño: " . $lectura['tamaño'] . " bytes<br>";
    echo "Primeros 100 caracteres:<br>";
    echo "<pre>" . htmlspecialchars(substr($lectura['contenido'], 0, 100)) . "...</pre>";
}

// EJEMPLO 5: Trabajar con archivos CSV
echo "<h3>Ejemplo 5: Leer Archivo CSV</h3>";

$archivo_csv = 'datos/productos.csv';

// Crear archivo CSV de ejemplo
if (!file_exists($archivo_csv)) {
    $datos_csv = [
        ['ID', 'Producto', 'Precio', 'Stock'],
        [1, 'Laptop Gaming', 1299.99, 15],
        [2, 'Mouse Inalámbrico', 29.99, 50],
        [3, 'Teclado Mecánico', 89.99, 30],
        [4, 'Monitor 4K', 399.99, 8]
    ];
    
    $csv = fopen($archivo_csv, 'w');
    foreach ($datos_csv as $fila) {
        fputcsv($csv, $fila);
    }
    fclose($csv);
}

echo "Leyendo archivo CSV '$archivo_csv':<br>";

$csv = fopen($archivo_csv, 'r');
if ($csv) {
    echo "<table border='1' cellpadding='5' cellspacing='0'>";
    
    $es_header = true;
    while (($fila = fgetcsv($csv)) !== false) {
        echo "<tr>";
        
        if ($es_header) {
            foreach ($fila as $celda) {
                echo "<th>" . htmlspecialchars($celda) . "</th>";
            }
            $es_header = false;
        } else {
            foreach ($fila as $celda) {
                echo "<td>" . htmlspecialchars($celda) . "</td>";
            }
        }
        
        echo "</tr>";
    }
    
    echo "</table>";
    fclose($csv);
} else {
    echo "Error al abrir archivo CSV<br>";
}

echo "<br>";

// Información sobre recursos del sistema
echo "<h4>Información del Sistema:</h4>";
echo "Directorio temporal: " . sys_get_temp_dir() . "<br>";
echo "Directorio actual: " . getcwd() . "<br>";
echo "Límite de memoria: " . ini_get('memory_limit') . "<br>";
echo "Tamaño máximo de archivo: " . ini_get('upload_max_filesize') . "<br>";
?>