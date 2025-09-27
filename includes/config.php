<?php
// Archivo auxiliar para demostrar include
echo "Este contenido viene del archivo config.php<br>";

$configuracion = [
    'sitio_nombre' => 'Mi Sitio Web',
    'version' => '1.2.0',
    'debug_activo' => true,
    'base_datos' => [
        'host' => 'localhost',
        'usuario' => 'root',
        'password' => '',
        'nombre_bd' => 'mi_sitio'
    ]
];

function obtenerConfiguracion($clave) {
    global $configuracion;
    return isset($configuracion[$clave]) ? $configuracion[$clave] : null;
}

echo "Configuración cargada exitosamente<br>";
?>