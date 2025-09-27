<?php
/*
EJERCICIO 36 - FUNCION INCLUDE
==============================

DOCUMENTACION:
- include: Incluye y evalúa un archivo
- include_once: Incluye solo si no ha sido incluido antes
- Si el archivo no existe, genera WARNING pero continúa ejecución
- El archivo incluido hereda el ámbito de variables donde se incluye
- Útil para reutilizar código, configuraciones, plantillas

SINTAXIS:
include 'archivo.php';
include_once 'archivo.php';
include $variable_archivo;
*/

echo "<h2>EJERCICIO 36 - FUNCION INCLUDE</h2>";

// EJEMPLO 1: Include básico de configuración
echo "<h3>Ejemplo 1: Include de Configuración</h3>";

echo "Antes de incluir config.php<br>";

// Incluir archivo de configuración
include 'includes/config.php';

echo "Después de incluir config.php<br>";

// Usar variables del archivo incluido
echo "Nombre del sitio: " . $configuracion['sitio_nombre'] . "<br>";
echo "Versión: " . $configuracion['version'] . "<br>";
echo "Debug activo: " . ($configuracion['debug_activo'] ? 'Sí' : 'No') . "<br>";

// Usar función del archivo incluido
echo "Config de host: " . obtenerConfiguracion('base_datos')['host'] . "<br>";

echo "<br>";

// EJEMPLO 2: Include de funciones auxiliares
echo "<h3>Ejemplo 2: Include de Funciones</h3>";

echo "Incluyendo archivo de funciones...<br>";
include 'includes/funciones.php';

// Usar funciones incluidas
echo saludar('María') . "<br>";

$precio_original = 100;
$precio_con_descuento = calcularDescuento($precio_original, 15);
echo "Precio original: €$precio_original<br>";
echo "Precio con 15% descuento: €$precio_con_descuento<br>";

echo "Fecha formateada: " . formatearFecha() . "<br>";

// Usar clase incluida
echo "Botón HTML: " . UtilHTML::crearBoton('Comprar Ahora', 'btn-primary') . "<br>";
echo "Enlace HTML: " . UtilHTML::crearEnlace('#', 'Ver más detalles') . "<br>";

echo "<br>";

// EJEMPLO 3: Include condicional
echo "<h3>Ejemplo 3: Include Condicional</h3>";

$idioma = 'es'; // Simular selección de idioma
$archivo_idioma = "includes/idioma_$idioma.php";

echo "Intentando cargar idioma: $idioma<br>";

// Crear archivo de idioma si no existe
if (!file_exists($archivo_idioma)) {
    $contenido_idioma = '<?php
$textos = [
    "bienvenida" => "Bienvenido",
    "productos" => "Productos",
    "contacto" => "Contacto",
    "salir" => "Salir"
];
echo "Idioma español cargado<br>";
?>';
    
    file_put_contents($archivo_idioma, $contenido_idioma);
}

// Include condicional
if (file_exists($archivo_idioma)) {
    include $archivo_idioma;
    
    echo "Textos disponibles:<br>";
    foreach ($textos as $clave => $texto) {
        echo "- $clave: $texto<br>";
    }
} else {
    echo "No se pudo cargar el archivo de idioma<br>";
}

echo "<br>";

// Demostrar diferencia entre include e include_once
echo "<h3>Ejemplo 4: Include vs Include_once</h3>";

echo "Primera inclusión con include:<br>";
include 'includes/funciones.php';

echo "<br>Segunda inclusión con include (se ejecuta de nuevo):<br>";
include 'includes/funciones.php';

echo "<br>Tercera inclusión con include_once (no se ejecuta):<br>";
include_once 'includes/funciones.php';

echo "<br>";

// Función para incluir plantillas
function incluirPlantilla($nombre_plantilla, $variables = []) {
    // Extraer variables para que estén disponibles en la plantilla
    extract($variables);
    
    $archivo_plantilla = "includes/plantilla_$nombre_plantilla.php";
    
    // Crear plantilla si no existe
    if (!file_exists($archivo_plantilla)) {
        $contenido_plantilla = '';
        
        switch ($nombre_plantilla) {
            case 'header':
                $contenido_plantilla = '<?php
echo "<header style=\"background: #333; color: white; padding: 10px;\">";
echo "<h1>" . ($titulo ?? "Sitio Web") . "</h1>";
echo "<nav>";
echo "<a href=\"#\" style=\"color: white; margin-right: 10px;\">Inicio</a>";
echo "<a href=\"#\" style=\"color: white; margin-right: 10px;\">Productos</a>";
echo "<a href=\"#\" style=\"color: white;\">Contacto</a>";
echo "</nav>";
echo "</header>";
?>';
                break;
                
            case 'footer':
                $contenido_plantilla = '<?php
echo "<footer style=\"background: #666; color: white; padding: 10px; margin-top: 20px;\">";
echo "<p>&copy; " . date("Y") . " " . ($empresa ?? "Mi Empresa") . ". Todos los derechos reservados.</p>";
echo "</footer>";
?>';
                break;
        }
        
        file_put_contents($archivo_plantilla, $contenido_plantilla);
    }
    
    if (file_exists($archivo_plantilla)) {
        include $archivo_plantilla;
        return true;
    }
    
    return false;
}

echo "<h4>Sistema de Plantillas con Include:</h4>";

// Incluir header
incluirPlantilla('header', ['titulo' => 'Mi Tienda Online']);

echo "<main style='padding: 20px;'>";
echo "<p>Este es el contenido principal de la página.</p>";
echo "<p>Las plantillas se cargan dinámicamente usando include.</p>";
echo "</main>";

// Incluir footer
incluirPlantilla('footer', ['empresa' => 'TechStore']);

echo "<br><br>";

// Manejo de errores con include
echo "<h4>Manejo de Errores:</h4>";

echo "Intentando incluir archivo que no existe:<br>";
$archivo_inexistente = 'archivo_que_no_existe.php';

// Include genera warning pero continúa
@include $archivo_inexistente; // @ suprime el warning
echo "El script continúa ejecutándose después del include fallido<br>";

// Función para include seguro
function includeSafe($archivo, $required = false) {
    if (file_exists($archivo)) {
        include $archivo;
        return true;
    } else {
        $mensaje = "Archivo no encontrado: $archivo";
        if ($required) {
            die("ERROR CRÍTICO: $mensaje");
        } else {
            echo "ADVERTENCIA: $mensaje<br>";
            return false;
        }
    }
}

echo "<br>Usando función de include seguro:<br>";
includeSafe('includes/funciones.php'); // Existe
includeSafe('archivo_opcional.php', false); // No existe, opcional
// includeSafe('archivo_requerido.php', true); // Esto detendría la ejecución

echo "<br>Include permite reutilizar código de forma flexible y modular.";
?>