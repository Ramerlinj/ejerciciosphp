<?php
/*
EJERCICIO 37 - FUNCION REQUIRE
==============================

DOCUMENTACION:
- require: Incluye archivo y detiene ejecución si no existe
- require_once: Incluye solo una vez, detiene si no existe
- Si el archivo no existe, genera ERROR FATAL y detiene script
- Más estricto que include, usado para archivos críticos
- Diferencias: require (fatal) vs include (warning)

SINTAXIS:
require 'archivo.php';
require_once 'archivo.php';

DIFERENCIAS:
- include: Warning si falla, continúa ejecución
- require: Fatal error si falla, detiene ejecución
*/

echo "<h2>EJERCICIO 37 - FUNCION REQUIRE</h2>";

// EJEMPLO 1: Require para archivos críticos
echo "<h3>Ejemplo 1: Require de Archivos Críticos</h3>";

echo "Cargando archivo crítico de base de datos...<br>";

// Este archivo es crítico, la app no puede funcionar sin él
require 'includes/database.php';

echo "Archivo cargado exitosamente<br>";

// Usar clase crítica
$db = ConexionDB::getInstance();
echo $db->conectar() . "<br>";

echo "Constantes definidas:<br>";
echo "- DB_HOST: " . DB_HOST . "<br>";
echo "- DB_USER: " . DB_USER . "<br>";
echo "- APP_KEY: " . (substr(APP_KEY, 0, 5) . "...") . "<br>";

echo "<br>";

// EJEMPLO 2: Demostrar diferencia entre include y require
echo "<h3>Ejemplo 2: Include vs Require</h3>";

echo "Probando con include en archivo inexistente:<br>";
echo "Antes del include...<br>";
@include 'archivo_inexistente_include.php'; // @ para suprimir warning
echo "Después del include (el script continúa)<br>";

echo "<br>Probando con require en archivo inexistente:<br>";
echo "Antes del require...<br>";

// NOTA: El siguiente require causaría un error fatal
// Comentado para que el ejemplo pueda continuar
// require 'archivo_inexistente_require.php'; 
echo "Si descomentaras el require anterior, el script se detendría aquí<br>";

echo "<br>";

// EJEMPLO 3: Sistema de configuración con require
echo "<h3>Ejemplo 3: Sistema de Configuración</h3>";

// Crear archivo de configuración crítica
$archivo_config_critica = 'includes/config_critica.php';
if (!file_exists($archivo_config_critica)) {
    $contenido = '<?php
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
?>';
    
    file_put_contents($archivo_config_critica, $contenido);
}

// Requerir configuración crítica
require_once $archivo_config_critica;

// Validar configuración
validarConfiguracion();

echo "Aplicación: " . $config_critica['app_name'] . "<br>";
echo "Versión: " . $config_critica['app_version'] . "<br>";
echo "Entorno: " . $config_critica['environment'] . "<br>";

echo "<br>";

// EJEMPLO 4: Autoloader con require_once
echo "<h3>Ejemplo 4: Autoloader Simple</h3>";

function autoloaderSimple($nombre_clase) {
    $archivo = 'includes/' . strtolower($nombre_clase) . '.php';
    
    if (file_exists($archivo)) {
        require_once $archivo;
        echo "Clase $nombre_clase cargada automáticamente<br>";
        return true;
    }
    
    return false;
}

// Crear clases de ejemplo
$clases_ejemplo = [
    'usuario' => '<?php
class Usuario {
    public $nombre;
    public function __construct($nombre) {
        $this->nombre = $nombre;
        echo "Usuario creado: $nombre<br>";
    }
}',
    'producto' => '<?php
class Producto {
    public $nombre;
    public $precio;
    public function __construct($nombre, $precio) {
        $this->nombre = $nombre;
        $this->precio = $precio;
        echo "Producto creado: $nombre (€$precio)<br>";
    }
}'
];

foreach ($clases_ejemplo as $nombre => $contenido) {
    $archivo = 'includes/' . $nombre . '.php';
    if (!file_exists($archivo)) {
        file_put_contents($archivo, $contenido);
    }
}

// Registrar autoloader
spl_autoload_register('autoloaderSimple');

// Usar clases que se cargarán automáticamente
echo "Creando objetos (clases se cargan automáticamente):<br>";
$usuario1 = new Usuario('Ana García');
$producto1 = new Producto('Laptop', 999.99);

echo "<br>";

// EJEMPLO 5: Sistema de módulos con require
echo "<h3>Ejemplo 5: Sistema de Módulos</h3>";

class SistemaModulos {
    private static $modulos_cargados = [];
    
    public static function cargarModulo($nombre_modulo) {
        if (in_array($nombre_modulo, self::$modulos_cargados)) {
            echo "Módulo '$nombre_modulo' ya está cargado<br>";
            return true;
        }
        
        $archivo_modulo = "includes/modulo_$nombre_modulo.php";
        
        // Crear módulo si no existe
        if (!file_exists($archivo_modulo)) {
            $contenido_modulo = self::generarModulo($nombre_modulo);
            file_put_contents($archivo_modulo, $contenido_modulo);
        }
        
        try {
            require_once $archivo_modulo;
            self::$modulos_cargados[] = $nombre_modulo;
            echo "Módulo '$nombre_modulo' cargado exitosamente<br>";
            return true;
        } catch (Error $e) {
            echo "Error cargando módulo '$nombre_modulo': " . $e->getMessage() . "<br>";
            return false;
        }
    }
    
    private static function generarModulo($nombre) {
        switch ($nombre) {
            case 'autenticacion':
                return '<?php
function login($usuario, $password) {
    // Simulación de login
    return $usuario === "admin" && $password === "123456";
}

function logout() {
    return "Sesión cerrada exitosamente";
}

echo "Módulo de autenticación cargado<br>";
?>';
            
            case 'reportes':
                return '<?php
function generarReporte($tipo) {
    $reportes = [
        "ventas" => "Reporte de ventas generado",
        "usuarios" => "Reporte de usuarios generado",
        "productos" => "Reporte de productos generado"
    ];
    
    return $reportes[$tipo] ?? "Tipo de reporte no válido";
}

echo "Módulo de reportes cargado<br>";
?>';
            
            default:
                return "<?php echo 'Módulo genérico $nombre cargado<br>'; ?>";
        }
    }
    
    public static function obtenerModulosCargados() {
        return self::$modulos_cargados;
    }
}

// Cargar módulos del sistema
echo "Cargando módulos del sistema:<br>";
SistemaModulos::cargarModulo('autenticacion');
SistemaModulos::cargarModulo('reportes');

// Usar funciones de los módulos
echo "<br>Probando funcionalidades:<br>";
$login_exitoso = login('admin', '123456');
echo "Login admin: " . ($login_exitoso ? 'Exitoso' : 'Fallido') . "<br>";

echo generarReporte('ventas') . "<br>";
echo logout() . "<br>";

// Intentar cargar módulo de nuevo (require_once evita recarga)
echo "<br>Intentando recargar módulo:<br>";
SistemaModulos::cargarModulo('autenticacion');

echo "<br>Módulos cargados: " . implode(', ', SistemaModulos::obtenerModulosCargados()) . "<br>";

echo "<br>";

// Comparación final include vs require
echo "<h4>Resumen de Diferencias:</h4>";
echo "<table border='1' cellpadding='5' cellspacing='0'>";
echo "<tr><th>Aspecto</th><th>include</th><th>require</th></tr>";
echo "<tr><td>Error si archivo no existe</td><td>Warning (continúa)</td><td>Fatal Error (detiene)</td></tr>";
echo "<tr><td>Uso recomendado</td><td>Archivos opcionales</td><td>Archivos críticos</td></tr>";
echo "<tr><td>Control de flujo</td><td>Flexible</td><td>Estricto</td></tr>";
echo "<tr><td>Performance</td><td>Igual</td><td>Igual</td></tr>";
echo "</table><br>";

echo "Usa require/require_once para archivos críticos (configuración, clases base)<br>";
echo "Usa include/include_once para archivos opcionales (plantillas, módulos extra)";
?>