<?php
// Archivo crítico para demostrar require
class ConexionDB {
    private static $instancia = null;
    private $host = 'localhost';
    private $usuario = 'root';
    private $password = '';
    private $base_datos = 'test';
    
    private function __construct() {
        echo "Clase ConexionDB cargada (crítica para la aplicación)<br>";
    }
    
    public static function getInstance() {
        if (self::$instancia === null) {
            self::$instancia = new self();
        }
        return self::$instancia;
    }
    
    public function conectar() {
        return "Conectando a {$this->host}/{$this->base_datos}";
    }
}

// Variables críticas para el funcionamiento
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('APP_KEY', 'mi_clave_secreta_123');

echo "Archivo crítico database.php cargado exitosamente<br>";
?>