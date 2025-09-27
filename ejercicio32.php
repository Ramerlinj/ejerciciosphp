<?php
/*
EJERCICIO 32 - VALORES INPUT FILE Y UPLOAD DE ARCHIVOS
======================================================

DOCUMENTACION:
- $_FILES: Array superglobal para archivos subidos
- move_uploaded_file(): Mueve archivo subido a destino final
- Propiedades $_FILES: name, type, size, tmp_name, error
- Validaciones: tamaño, tipo, extensión
- enctype="multipart/form-data" necesario en el form

ESTRUCTURA $_FILES:
$_FILES['campo']['name']     - Nombre original
$_FILES['campo']['type']     - Tipo MIME
$_FILES['campo']['size']     - Tamaño en bytes
$_FILES['campo']['tmp_name'] - Ubicación temporal
$_FILES['campo']['error']    - Código de error
*/

echo "<h2>EJERCICIO 32 - UPLOAD DE ARCHIVOS</h2>";

// Crear directorio de uploads si no existe
$directorio_uploads = 'uploads/';
if (!file_exists($directorio_uploads)) {
    mkdir($directorio_uploads, 0777, true);
}

// EJEMPLO 1: Función para manejar uploads
function subirArchivo($campo_file, $directorio = 'uploads/') {
    // Verificar si se subió archivo
    if (!isset($_FILES[$campo_file]) || $_FILES[$campo_file]['error'] === UPLOAD_ERR_NO_FILE) {
        return ['exito' => false, 'mensaje' => 'No se seleccionó ningún archivo'];
    }
    
    $archivo = $_FILES[$campo_file];
    
    // Verificar errores de upload
    if ($archivo['error'] !== UPLOAD_ERR_OK) {
        $errores = [
            UPLOAD_ERR_INI_SIZE => 'El archivo excede el tamaño máximo permitido por PHP',
            UPLOAD_ERR_FORM_SIZE => 'El archivo excede el tamaño máximo del formulario',
            UPLOAD_ERR_PARTIAL => 'El archivo se subió parcialmente',
            UPLOAD_ERR_NO_TMP_DIR => 'Falta el directorio temporal',
            UPLOAD_ERR_CANT_WRITE => 'Error al escribir el archivo en disco'
        ];
        
        $mensaje_error = isset($errores[$archivo['error']]) ? 
                        $errores[$archivo['error']] : 'Error desconocido';
        
        return ['exito' => false, 'mensaje' => $mensaje_error];
    }
    
    // Validaciones de seguridad
    $nombre_original = basename($archivo['name']);
    $tamaño = $archivo['size'];
    $tipo_mime = $archivo['type'];
    $archivo_temporal = $archivo['tmp_name'];
    
    // Obtener extensión
    $info_archivo = pathinfo($nombre_original);
    $extension = strtolower($info_archivo['extension']);
    
    // Validar extensión (lista blanca)
    $extensiones_permitidas = ['jpg', 'jpeg', 'png', 'gif', 'pdf', 'txt', 'doc', 'docx'];
    if (!in_array($extension, $extensiones_permitidas)) {
        return ['exito' => false, 'mensaje' => 'Tipo de archivo no permitido. Permitidos: ' . implode(', ', $extensiones_permitidas)];
    }
    
    // Validar tamaño (máximo 5MB)
    $tamaño_maximo = 5 * 1024 * 1024; // 5MB en bytes
    if ($tamaño > $tamaño_maximo) {
        $mb = round($tamaño / (1024 * 1024), 2);
        return ['exito' => false, 'mensaje' => "Archivo muy grande ($mb MB). Máximo permitido: 5MB"];
    }
    
    // Generar nombre único para evitar sobrescritura
    $nombre_unico = uniqid() . '_' . time() . '.' . $extension;
    $ruta_destino = $directorio . $nombre_unico;
    
    // Mover archivo del directorio temporal al destino final
    if (move_uploaded_file($archivo_temporal, $ruta_destino)) {
        return [
            'exito' => true,
            'mensaje' => 'Archivo subido exitosamente',
            'datos' => [
                'nombre_original' => $nombre_original,
                'nombre_archivo' => $nombre_unico,
                'ruta' => $ruta_destino,
                'tamaño' => $tamaño,
                'tipo' => $tipo_mime,
                'extension' => $extension
            ]
        ];
    } else {
        return ['exito' => false, 'mensaje' => 'Error al mover el archivo al destino final'];
    }
}

// Procesar upload si se envió formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['subir_archivo'])) {
    echo "<h3>Resultado del Upload</h3>";
    
    $resultado = subirArchivo('archivo_usuario');
    
    if ($resultado['exito']) {
        echo "<span style='color: green;'>" . $resultado['mensaje'] . "</span><br><br>";
        echo "<strong>Información del archivo:</strong><br>";
        $datos = $resultado['datos'];
        echo "Nombre original: " . $datos['nombre_original'] . "<br>";
        echo "Nombre en servidor: " . $datos['nombre_archivo'] . "<br>";
        echo "Tamaño: " . number_format($datos['tamaño'] / 1024, 2) . " KB<br>";
        echo "Tipo MIME: " . $datos['tipo'] . "<br>";
        echo "Extensión: " . $datos['extension'] . "<br>";
        echo "Ruta completa: " . $datos['ruta'] . "<br>";
        
        // Mostrar imagen si es una imagen
        if (in_array($datos['extension'], ['jpg', 'jpeg', 'png', 'gif'])) {
            echo "<br><img src='" . $datos['ruta'] . "' alt='Imagen subida' style='max-width: 300px; max-height: 300px;'><br>";
        }
    } else {
        echo "<span style='color: red;'>Error: " . $resultado['mensaje'] . "</span><br>";
    }
    
    echo "<hr>";
}

// Procesar múltiples archivos si se enviaron
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['subir_multiples'])) {
    echo "<h3>Resultado de Upload Múltiple</h3>";
    
    $archivos_subidos = [];
    $errores = [];
    
    // $_FILES['archivos_multiples'] es un array cuando name="campo[]"
    if (isset($_FILES['archivos_multiples']['name']) && is_array($_FILES['archivos_multiples']['name'])) {
        $total_archivos = count($_FILES['archivos_multiples']['name']);
        
        for ($i = 0; $i < $total_archivos; $i++) {
            // Reconstruir estructura de archivo individual
            $archivo_individual = [
                'name' => $_FILES['archivos_multiples']['name'][$i],
                'type' => $_FILES['archivos_multiples']['type'][$i],
                'size' => $_FILES['archivos_multiples']['size'][$i],
                'tmp_name' => $_FILES['archivos_multiples']['tmp_name'][$i],
                'error' => $_FILES['archivos_multiples']['error'][$i]
            ];
            
            // Simular $_FILES para función existente
            $_FILES['temp_individual'] = $archivo_individual;
            $resultado = subirArchivo('temp_individual');
            
            if ($resultado['exito']) {
                $archivos_subidos[] = $resultado['datos'];
            } else {
                $errores[] = "Archivo " . ($i + 1) . ": " . $resultado['mensaje'];
            }
        }
    }
    
    if (!empty($archivos_subidos)) {
        echo "<span style='color: green;'>Archivos subidos exitosamente: " . count($archivos_subidos) . "</span><br>";
        foreach ($archivos_subidos as $archivo) {
            echo "- " . $archivo['nombre_original'] . " (" . number_format($archivo['tamaño'] / 1024, 2) . " KB)<br>";
        }
    }
    
    if (!empty($errores)) {
        echo "<br><span style='color: red;'>Errores encontrados:</span><br>";
        foreach ($errores as $error) {
            echo "- $error<br>";
        }
    }
    
    echo "<hr>";
}
?>

<!-- EJEMPLO 1: Upload de archivo único -->
<h3>Ejemplo 1: Subir Archivo Individual</h3>

<form method="POST" action="" enctype="multipart/form-data">
    <fieldset>
        <legend>Subir Archivo</legend>
        
        <label for="archivo_usuario">Selecciona un archivo:</label><br>
        <input type="file" id="archivo_usuario" name="archivo_usuario" 
               accept=".jpg,.jpeg,.png,.gif,.pdf,.txt,.doc,.docx"><br><br>
        
        <small>Tipos permitidos: JPG, PNG, GIF, PDF, TXT, DOC, DOCX (Máximo 5MB)</small><br><br>
        
        <button type="submit" name="subir_archivo">Subir Archivo</button>
    </fieldset>
</form>

<br>

<!-- EJEMPLO 2: Upload múltiple -->
<h3>Ejemplo 2: Subir Múltiples Archivos</h3>

<form method="POST" action="" enctype="multipart/form-data">
    <fieldset>
        <legend>Subir Varios Archivos</legend>
        
        <label for="archivos_multiples">Selecciona varios archivos:</label><br>
        <input type="file" id="archivos_multiples" name="archivos_multiples[]" 
               multiple accept=".jpg,.jpeg,.png,.gif,.pdf,.txt,.doc,.docx"><br><br>
        
        <small>Mantén presionado Ctrl (Cmd en Mac) para seleccionar múltiples archivos</small><br><br>
        
        <button type="submit" name="subir_multiples">Subir Archivos</button>
    </fieldset>
</form>

<?php
// Mostrar archivos en directorio uploads
echo "<h3>Archivos en el Servidor</h3>";

if (is_dir($directorio_uploads)) {
    $archivos = array_diff(scandir($directorio_uploads), ['.', '..']);
    
    if (!empty($archivos)) {
        echo "Archivos subidos anteriormente:<br>";
        echo "<ul>";
        foreach ($archivos as $archivo) {
            $ruta_completa = $directorio_uploads . $archivo;
            $tamaño = filesize($ruta_completa);
            $fecha = date('Y-m-d H:i:s', filemtime($ruta_completa));
            
            echo "<li>";
            echo "<strong>$archivo</strong> ";
            echo "(" . number_format($tamaño / 1024, 2) . " KB) ";
            echo "- Subido: $fecha ";
            
            // Enlace para descargar
            echo "<a href='$ruta_completa' target='_blank'>[Ver/Descargar]</a>";
            echo "</li>";
        }
        echo "</ul>";
    } else {
        echo "No hay archivos subidos aún.<br>";
    }
} else {
    echo "Directorio de uploads no existe.<br>";
}

// Información sobre configuración PHP
echo "<h4>Configuración del Servidor</h4>";
echo "Tamaño máximo de upload: " . ini_get('upload_max_filesize') . "<br>";
echo "Tamaño máximo POST: " . ini_get('post_max_size') . "<br>";
echo "Directorio temporal: " . sys_get_temp_dir() . "<br>";
?>