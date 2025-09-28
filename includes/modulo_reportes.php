<?php
function generarReporte($tipo) {
    $reportes = [
        "ventas" => "Reporte de ventas generado",
        "usuarios" => "Reporte de usuarios generado",
        "productos" => "Reporte de productos generado"
    ];
    
    return $reportes[$tipo] ?? "Tipo de reporte no válido";
}

echo "Módulo de reportes cargado<br>";
?>