<?php
// Funciones auxiliares para demostrar include
function saludar($nombre) {
    return "¡Hola, $nombre! Bienvenido a nuestro sitio.";
}

function calcularDescuento($precio, $porcentaje) {
    $descuento = $precio * ($porcentaje / 100);
    return $precio - $descuento;
}

function formatearFecha($fecha = null) {
    $fecha = $fecha ?: date('Y-m-d H:i:s');
    return date('d/m/Y H:i', strtotime($fecha));
}

class UtilHTML {
    public static function crearBoton($texto, $clase = 'btn') {
        return "<button class='$clase'>$texto</button>";
    }
    
    public static function crearEnlace($url, $texto) {
        return "<a href='$url'>$texto</a>";
    }
}

echo "Funciones auxiliares cargadas<br>";
?>