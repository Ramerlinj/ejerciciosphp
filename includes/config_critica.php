<?php
// Configuración crítica para la aplicación
$config_critica = [
    "app_name" => "Sistema de Gestión",
    "app_version" => "2.1.0", 
    "environment" => "production",
    "security_key" => "sk_" . uniqid(),
    "database" => [
        "driver" => "mysql",
        "host" => "localhost",
        "port" => 3306,
        "charset" => "utf8mb4"
    ]
];

function validarConfiguracion() {
    global $config_critica;
    
    $campos_requeridos = ["app_name", "app_version", "security_key"];
    
    foreach ($campos_requeridos as $campo) {
        if (empty($config_critica[$campo])) {
            die("ERROR CRÍTICO: Configuración incompleta - falta $campo");
        }
    }
    
    return true;
}

echo "Configuración crítica cargada<br>";
?>