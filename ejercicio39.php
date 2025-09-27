<?php
/*
EJERCICIO 39 - ESCRITURA DE ARCHIVOS EN PHP
===========================================

DOCUMENTACION:
- fwrite(): Escribe datos en un archivo abierto
- file_put_contents(): Método simple para escribir todo el contenido
- fputs(): Alias de fwrite()
- Modos de escritura: 'w' (trunca), 'a' (append), 'x' (crear nuevo)
- LOCK_EX: Bloqueo exclusivo para evitar corrupción concurrente

SINTAXIS:
$handle = fopen('archivo.txt', 'w');
fwrite($handle, $contenido);
fclose($handle);

file_put_contents('archivo.txt', $contenido, LOCK_EX);
*/

echo "<h2>EJERCICIO 39 - ESCRITURA DE ARCHIVOS</h2>";

// Crear directorio si no existe
$directorio = 'archivos_escritura';
if (!file_exists($directorio)) {
    mkdir($directorio, 0777, true);
}

// EJEMPLO 1: Escritura básica con fwrite
echo "<h3>Ejemplo 1: Escritura Básica con fwrite</h3>";

$archivo_basico = "$directorio/archivo_basico.txt";
$contenido = "Este es el contenido inicial del archivo\n";
$contenido .= "Creado el: " . date('Y-m-d H:i:s') . "\n";
$contenido .= "Método usado: fwrite\n";

// Abrir archivo para escritura (trunca contenido existente)
$handle = fopen($archivo_basico, 'w');

if ($handle) {
    $bytes_escritos = fwrite($handle, $contenido);
    fclose($handle);
    
    echo "✓ Archivo creado exitosamente<br>";
    echo "Bytes escritos: $bytes_escritos<br>";
    echo "Contenido escrito:<br>";
    echo "<pre>" . htmlspecialchars($contenido) . "</pre>";
} else {
    echo "✗ Error al crear archivo<br>";
}

echo "<br>";

// EJEMPLO 2: Diferentes métodos de escritura
echo "<h3>Ejemplo 2: Diferentes Métodos de Escritura</h3>";

// Método 1: file_put_contents (más simple)
$archivo_simple = "$directorio/metodo_simple.txt";
$contenido_simple = "Contenido creado con file_put_contents\n";
$contenido_simple .= "Es más fácil para escribir todo de una vez\n";

$resultado = file_put_contents($archivo_simple, $contenido_simple);

if ($resultado !== false) {
    echo "✓ file_put_contents: $resultado bytes escritos<br>";
} else {
    echo "✗ Error con file_put_contents<br>";
}

// Método 2: Agregar contenido (append)
$contenido_extra = "Esta línea se agregó después\n";
$contenido_extra .= "Timestamp: " . time() . "\n";

$resultado_append = file_put_contents($archivo_simple, $contenido_extra, FILE_APPEND);

if ($resultado_append !== false) {
    echo "✓ Contenido agregado: $resultado_append bytes adicionales<br>";
} else {
    echo "✗ Error agregando contenido<br>";
}

// Mostrar contenido final
echo "Contenido final del archivo:<br>";
echo "<pre>" . htmlspecialchars(file_get_contents($archivo_simple)) . "</pre>";

echo "<br>";

// EJEMPLO 3: Escritura de logs y registros
echo "<h3>Ejemplo 3: Sistema de Logs</h3>";

class SistemaLogs {
    private $archivo_log;
    
    public function __construct($nombre_archivo = 'app.log') {
        $this->archivo_log = "archivos_escritura/$nombre_archivo";
    }
    
    public function escribirLog($nivel, $mensaje, $contexto = []) {
        $timestamp = date('Y-m-d H:i:s');
        $nivel = strtoupper($nivel);
        
        // Formatear entrada de log
        $entrada = "[$timestamp] [$nivel] $mensaje";
        
        if (!empty($contexto)) {
            $entrada .= " | Contexto: " . json_encode($contexto);
        }
        
        $entrada .= "\n";
        
        // Escribir con bloqueo para evitar problemas de concurrencia
        $resultado = file_put_contents($this->archivo_log, $entrada, FILE_APPEND | LOCK_EX);
        
        return $resultado !== false;
    }
    
    public function info($mensaje, $contexto = []) {
        return $this->escribirLog('INFO', $mensaje, $contexto);
    }
    
    public function error($mensaje, $contexto = []) {
        return $this->escribirLog('ERROR', $mensaje, $contexto);
    }
    
    public function warning($mensaje, $contexto = []) {
        return $this->escribirLog('WARNING', $mensaje, $contexto);
    }
    
    public function leerLogs($ultimas_lineas = 10) {
        if (!file_exists($this->archivo_log)) {
            return "No hay logs disponibles";
        }
        
        $lineas = file($this->archivo_log, FILE_IGNORE_NEW_LINES);
        $total_lineas = count($lineas);
        
        if ($total_lineas <= $ultimas_lineas) {
            return implode("\n", $lineas);
        }
        
        return implode("\n", array_slice($lineas, -$ultimas_lineas));
    }
    
    public function limpiarLogs() {
        return file_put_contents($this->archivo_log, '') !== false;
    }
}

// Usar sistema de logs
$logger = new SistemaLogs('mi_aplicacion.log');

echo "Escribiendo entradas de log:<br>";
$logger->info('Aplicación iniciada');
$logger->info('Usuario logueado', ['usuario' => 'admin', 'ip' => '192.168.1.1']);
$logger->warning('Intento de acceso a página restringida', ['url' => '/admin/config']);
$logger->error('Error de conexión a base de datos', ['host' => 'localhost', 'error' => 'Connection refused']);
$logger->info('Operación completada exitosamente');

echo "✓ Logs escritos exitosamente<br>";
echo "Últimas 5 entradas del log:<br>";
echo "<pre style='background: #f0f0f0; padding: 10px;'>" . 
     htmlspecialchars($logger->leerLogs(5)) . "</pre>";

echo "<br>";

// EJEMPLO 4: Escritura de archivos CSV y JSON
echo "<h3>Ejemplo 4: Exportar Datos a CSV y JSON</h3>";

class ExportadorDatos {
    
    public static function exportarCSV($datos, $archivo, $headers = true) {
        $handle = fopen($archivo, 'w');
        
        if (!$handle) {
            return false;
        }
        
        // Escribir headers si se especifica
        if ($headers && !empty($datos)) {
            $primer_elemento = reset($datos);
            if (is_array($primer_elemento)) {
                fputcsv($handle, array_keys($primer_elemento));
            }
        }
        
        // Escribir datos
        foreach ($datos as $fila) {
            fputcsv($handle, $fila);
        }
        
        fclose($handle);
        return true;
    }
    
    public static function exportarJSON($datos, $archivo, $formato_legible = true) {
        $opciones = $formato_legible ? JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE : 0;
        $json = json_encode($datos, $opciones);
        
        if ($json === false) {
            return false;
        }
        
        return file_put_contents($archivo, $json, LOCK_EX) !== false;
    }
    
    public static function exportarXML($datos, $archivo, $elemento_raiz = 'datos') {
        $xml = new SimpleXMLElement("<$elemento_raiz></$elemento_raiz>");
        
        foreach ($datos as $indice => $elemento) {
            $item = $xml->addChild('item');
            
            if (is_array($elemento)) {
                foreach ($elemento as $clave => $valor) {
                    $item->addChild($clave, htmlspecialchars($valor));
                }
            } else {
                $item->addChild('valor', htmlspecialchars($elemento));
            }
        }
        
        return $xml->asXML($archivo) !== false;
    }
}

// Datos de ejemplo
$productos = [
    ['id' => 1, 'nombre' => 'Laptop Gaming', 'precio' => 1299.99, 'stock' => 15],
    ['id' => 2, 'nombre' => 'Mouse Inalámbrico', 'precio' => 29.99, 'stock' => 50],
    ['id' => 3, 'nombre' => 'Teclado Mecánico', 'precio' => 89.99, 'stock' => 30],
    ['id' => 4, 'nombre' => 'Monitor 4K', 'precio' => 399.99, 'stock' => 8]
];

// Exportar a diferentes formatos
echo "Exportando datos a diferentes formatos:<br>";

$archivo_csv = "$directorio/productos_export.csv";
$archivo_json = "$directorio/productos_export.json";
$archivo_xml = "$directorio/productos_export.xml";

if (ExportadorDatos::exportarCSV($productos, $archivo_csv)) {
    echo "✓ CSV exportado exitosamente<br>";
}

if (ExportadorDatos::exportarJSON($productos, $archivo_json)) {
    echo "✓ JSON exportado exitosamente<br>";
}

if (ExportadorDatos::exportarXML($productos, $archivo_xml)) {
    echo "✓ XML exportado exitosamente<br>";
}

// Mostrar contenido JSON exportado
echo "<br>Contenido del archivo JSON:<br>";
echo "<pre style='background: #f5f5f5; padding: 10px; max-height: 200px; overflow-y: auto;'>" . 
     htmlspecialchars(file_get_contents($archivo_json)) . "</pre>";

echo "<br>";

// EJEMPLO 5: Escritura segura y manejo de errores
echo "<h3>Ejemplo 5: Escritura Segura</h3>";

class EscritorSeguro {
    
    public static function escribirSeguro($archivo, $contenido, $modo = 'w') {
        // Verificar directorio padre
        $directorio = dirname($archivo);
        if (!is_dir($directorio)) {
            if (!mkdir($directorio, 0777, true)) {
                return ['error' => 'No se pudo crear directorio padre'];
            }
        }
        
        // Verificar permisos
        if (file_exists($archivo) && !is_writable($archivo)) {
            return ['error' => 'Archivo no tiene permisos de escritura'];
        }
        
        if (!is_writable($directorio)) {
            return ['error' => 'Directorio no tiene permisos de escritura'];
        }
        
        // Crear archivo temporal para escritura atómica
        $archivo_temp = $archivo . '.tmp.' . uniqid();
        
        try {
            $handle = fopen($archivo_temp, 'w');
            
            if (!$handle) {
                return ['error' => 'No se pudo crear archivo temporal'];
            }
            
            $bytes_escritos = fwrite($handle, $contenido);
            fclose($handle);
            
            if ($bytes_escritos === false) {
                unlink($archivo_temp);
                return ['error' => 'Error escribiendo contenido'];
            }
            
            // Mover archivo temporal al destino final (operación atómica)
            if (!rename($archivo_temp, $archivo)) {
                unlink($archivo_temp);
                return ['error' => 'No se pudo mover archivo temporal'];
            }
            
            return [
                'exito' => true,
                'bytes' => $bytes_escritos,
                'archivo' => $archivo
            ];
            
        } catch (Exception $e) {
            if (file_exists($archivo_temp)) {
                unlink($archivo_temp);
            }
            return ['error' => 'Excepción: ' . $e->getMessage()];
        }
    }
    
    public static function crearBackup($archivo) {
        if (!file_exists($archivo)) {
            return ['error' => 'Archivo original no existe'];
        }
        
        $backup = $archivo . '.backup.' . date('Y-m-d_H-i-s');
        
        if (copy($archivo, $backup)) {
            return ['exito' => true, 'backup' => $backup];
        } else {
            return ['error' => 'No se pudo crear backup'];
        }
    }
}

// Probar escritura segura
echo "Probando escritura segura:<br>";

$contenido_importante = "Datos importantes que no pueden perderse\n";
$contenido_importante .= "Creado con escritura atómica\n";
$contenido_importante .= "Fecha: " . date('Y-m-d H:i:s') . "\n";

$resultado = EscritorSeguro::escribirSeguro("$directorio/datos_importantes.txt", $contenido_importante);

if (isset($resultado['exito'])) {
    echo "✓ Escritura segura completada<br>";
    echo "Bytes escritos: " . $resultado['bytes'] . "<br>";
    echo "Archivo: " . $resultado['archivo'] . "<br>";
} else {
    echo "✗ Error en escritura segura: " . $resultado['error'] . "<br>";
}

// Crear backup del archivo
$backup = EscritorSeguro::crearBackup("$directorio/datos_importantes.txt");
if (isset($backup['exito'])) {
    echo "✓ Backup creado: " . basename($backup['backup']) . "<br>";
}

echo "<br>";

// Estadísticas finales
echo "<h4>Archivos Creados en Esta Sesión:</h4>";
$archivos_creados = glob("$directorio/*");
echo "<ul>";
foreach ($archivos_creados as $archivo) {
    $tamaño = filesize($archivo);
    echo "<li>" . basename($archivo) . " ($tamaño bytes)</li>";
}
echo "</ul>";

echo "Total de archivos creados: " . count($archivos_creados) . "<br>";
echo "Directorio de trabajo: " . realpath($directorio) . "<br>";
?>