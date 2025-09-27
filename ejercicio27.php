<?php
/*
EJERCICIO 27 - METODOS ESTATICOS EN PHP
=======================================

DOCUMENTACION:
- static: Palabra clave para métodos y propiedades estáticas
- Se acceden con :: (operador de resolución de ámbito)
- No necesitan instancia de la clase para ser llamados
- self:: referencia a la clase actual
- No pueden acceder a $this (no hay instancia)
- Útiles para funciones utilitarias y constantes

SINTAXIS:
class MiClase {
    public static $propiedad_estatica;
    
    public static function metodo_estatico() {
        return self::$propiedad_estatica;
    }
}
*/

echo "<h2>EJERCICIO 27 - METODOS ESTATICOS</h2>";

// EJEMPLO 1: Clase utilitaria con métodos estáticos
echo "<h3>Ejemplo 1: Utilidades Matemáticas</h3>";

class Matematicas {
    public static $pi = 3.14159;
    public static $version = "1.0";
    
    public static function sumar($a, $b) {
        return $a + $b;
    }
    
    public static function calcularAreaCirculo($radio) {
        return self::$pi * $radio * $radio;
    }
    
    public static function calcularFactorial($n) {
        if ($n <= 1) {
            return 1;
        }
        return $n * self::calcularFactorial($n - 1);
    }
    
    public static function esPrimo($numero) {
        if ($numero < 2) return false;
        
        for ($i = 2; $i <= sqrt($numero); $i++) {
            if ($numero % $i == 0) {
                return false;
            }
        }
        return true;
    }
    
    public static function obtenerVersion() {
        return "Matemáticas v" . self::$version;
    }
}

// Usar métodos estáticos sin crear instancia
echo "Suma de 15 + 25: " . Matematicas::sumar(15, 25) . "<br>";
echo "Área de círculo (radio 5): " . number_format(Matematicas::calcularAreaCirculo(5), 2) . "<br>";
echo "Factorial de 5: " . Matematicas::calcularFactorial(5) . "<br>";

$numero = 17;
echo "¿Es $numero primo?: " . (Matematicas::esPrimo($numero) ? 'Sí' : 'No') . "<br>";
echo "Valor de PI: " . Matematicas::$pi . "<br>";
echo Matematicas::obtenerVersion() . "<br>";

echo "<br>";

// EJEMPLO 2: Contador estático y configuración
echo "<h3>Ejemplo 2: Configuración y Contadores</h3>";

class Configuracion {
    private static $configuraciones = [
        'app_nombre' => 'Mi Aplicación PHP',
        'version' => '2.1.0',
        'debug' => true,
        'max_usuarios' => 1000
    ];
    
    private static $contador_accesos = 0;
    private static $log_eventos = [];
    
    public static function obtener($clave) {
        self::$contador_accesos++;
        self::registrarEvento("Acceso a configuración: $clave");
        
        return isset(self::$configuraciones[$clave]) ? 
               self::$configuraciones[$clave] : null;
    }
    
    public static function establecer($clave, $valor) {
        self::$configuraciones[$clave] = $valor;
        self::registrarEvento("Configuración actualizada: $clave = $valor");
    }
    
    private static function registrarEvento($evento) {
        self::$log_eventos[] = date('Y-m-d H:i:s') . " - " . $evento;
    }
    
    public static function obtenerEstadisticas() {
        return [
            'accesos_totales' => self::$contador_accesos,
            'configuraciones_activas' => count(self::$configuraciones),
            'ultimo_evento' => end(self::$log_eventos)
        ];
    }
    
    public static function mostrarTodasConfiguraciones() {
        echo "Configuraciones actuales:<br>";
        foreach (self::$configuraciones as $clave => $valor) {
            $valor_mostrar = is_bool($valor) ? ($valor ? 'true' : 'false') : $valor;
            echo "- $clave: $valor_mostrar<br>";
        }
    }
    
    public static function esProduccion() {
        return !self::obtener('debug');
    }
}

// Usar configuración estática
echo "Nombre de la app: " . Configuracion::obtener('app_nombre') . "<br>";
echo "Versión: " . Configuracion::obtener('version') . "<br>";
echo "Modo debug: " . (Configuracion::obtener('debug') ? 'Activado' : 'Desactivado') . "<br>";

Configuracion::establecer('idioma', 'es');
Configuracion::establecer('tema', 'oscuro');

echo "<br>";
Configuracion::mostrarTodasConfiguraciones();

echo "<br>¿Es producción?: " . (Configuracion::esProduccion() ? 'Sí' : 'No') . "<br>";

$stats = Configuracion::obtenerEstadisticas();
echo "<br>Estadísticas:<br>";
echo "- Accesos totales: " . $stats['accesos_totales'] . "<br>";
echo "- Configuraciones: " . $stats['configuraciones_activas'] . "<br>";
echo "- Último evento: " . $stats['ultimo_evento'] . "<br>";
?>