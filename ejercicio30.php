<?php
/*
EJERCICIO 30 - VARIABLES DE SESSION PHP
=======================================

DOCUMENTACION:
- session_start(): Inicia una sesión o reanuda la existente
- $_SESSION: Array superglobal para almacenar datos de sesión
- Las sesiones persisten entre páginas durante la navegación
- session_destroy(): Destruye todos los datos de la sesión
- session_unset(): Libera todas las variables de sesión

SINTAXIS:
session_start();
$_SESSION['variable'] = 'valor';
echo $_SESSION['variable'];
session_destroy();
*/

// Iniciar sesión al comienzo del archivo
session_start();

echo "<h2>EJERCICIO 30 - VARIABLES DE SESSION</h2>";

// EJEMPLO 1: Manejo básico de sesiones
echo "<h3>Ejemplo 1: Sesión de Usuario</h3>";

// Simular login de usuario
if (!isset($_SESSION['usuario_logueado'])) {
    // Simulación de datos de login
    $_SESSION['usuario_logueado'] = true;
    $_SESSION['nombre_usuario'] = 'Juan Pérez';
    $_SESSION['rol'] = 'administrador';
    $_SESSION['tiempo_login'] = time();
    $_SESSION['paginas_visitadas'] = 0;
    
    echo "¡Bienvenido! Sesión iniciada para " . $_SESSION['nombre_usuario'] . "<br>";
} else {
    echo "Ya hay una sesión activa para: " . $_SESSION['nombre_usuario'] . "<br>";
}

// Incrementar contador de páginas visitadas
$_SESSION['paginas_visitadas']++;

echo "Información de la sesión actual:<br>";
echo "- Usuario: " . $_SESSION['nombre_usuario'] . "<br>";
echo "- Rol: " . $_SESSION['rol'] . "<br>";
echo "- Tiempo de login: " . date('Y-m-d H:i:s', $_SESSION['tiempo_login']) . "<br>";
echo "- Páginas visitadas: " . $_SESSION['paginas_visitadas'] . "<br>";
echo "- ID de sesión: " . session_id() . "<br>";

echo "<br>";

// EJEMPLO 2: Carrito de compras con sesiones
echo "<h3>Ejemplo 2: Carrito de Compras</h3>";

class CarritoCompras {
    
    public static function inicializar() {
        if (!isset($_SESSION['carrito'])) {
            $_SESSION['carrito'] = [];
            $_SESSION['total_carrito'] = 0;
        }
    }
    
    public static function agregarProducto($id, $nombre, $precio, $cantidad = 1) {
        self::inicializar();
        
        if (isset($_SESSION['carrito'][$id])) {
            // Si el producto ya existe, aumentar cantidad
            $_SESSION['carrito'][$id]['cantidad'] += $cantidad;
        } else {
            // Nuevo producto
            $_SESSION['carrito'][$id] = [
                'nombre' => $nombre,
                'precio' => $precio,
                'cantidad' => $cantidad
            ];
        }
        
        self::calcularTotal();
        return "Producto '$nombre' agregado al carrito";
    }
    
    public static function removerProducto($id) {
        if (isset($_SESSION['carrito'][$id])) {
            $nombre = $_SESSION['carrito'][$id]['nombre'];
            unset($_SESSION['carrito'][$id]);
            self::calcularTotal();
            return "Producto '$nombre' removido del carrito";
        }
        return "Producto no encontrado en el carrito";
    }
    
    public static function modificarCantidad($id, $nueva_cantidad) {
        if (isset($_SESSION['carrito'][$id])) {
            if ($nueva_cantidad <= 0) {
                return self::removerProducto($id);
            } else {
                $_SESSION['carrito'][$id]['cantidad'] = $nueva_cantidad;
                self::calcularTotal();
                return "Cantidad actualizada";
            }
        }
        return "Producto no encontrado";
    }
    
    private static function calcularTotal() {
        $total = 0;
        foreach ($_SESSION['carrito'] as $producto) {
            $total += $producto['precio'] * $producto['cantidad'];
        }
        $_SESSION['total_carrito'] = $total;
    }
    
    public static function mostrarCarrito() {
        self::inicializar();
        
        if (empty($_SESSION['carrito'])) {
            return "El carrito está vacío";
        }
        
        $output = "Contenido del carrito:<br>";
        $output .= "<table border='1' cellpadding='5' cellspacing='0'>";
        $output .= "<tr><th>Producto</th><th>Precio</th><th>Cantidad</th><th>Subtotal</th></tr>";
        
        foreach ($_SESSION['carrito'] as $id => $producto) {
            $subtotal = $producto['precio'] * $producto['cantidad'];
            $output .= "<tr>";
            $output .= "<td>" . $producto['nombre'] . "</td>";
            $output .= "<td>$" . number_format($producto['precio'], 2) . "</td>";
            $output .= "<td>" . $producto['cantidad'] . "</td>";
            $output .= "<td>$" . number_format($subtotal, 2) . "</td>";
            $output .= "</tr>";
        }
        
        $output .= "<tr><td colspan='3'><strong>TOTAL</strong></td>";
        $output .= "<td><strong>$" . number_format($_SESSION['total_carrito'], 2) . "</strong></td></tr>";
        $output .= "</table>";
        
        return $output;
    }
    
    public static function vaciarCarrito() {
        $_SESSION['carrito'] = [];
        $_SESSION['total_carrito'] = 0;
        return "Carrito vaciado exitosamente";
    }
    
    public static function obtenerCantidadItems() {
        self::inicializar();
        $total_items = 0;
        foreach ($_SESSION['carrito'] as $producto) {
            $total_items += $producto['cantidad'];
        }
        return $total_items;
    }
}

// Simular agregar productos al carrito
echo CarritoCompras::agregarProducto(1, "Laptop Gaming", 1299.99, 1) . "<br>";
echo CarritoCompras::agregarProducto(2, "Mouse Inalámbrico", 29.99, 2) . "<br>";
echo CarritoCompras::agregarProducto(3, "Teclado Mecánico", 89.99, 1) . "<br>";
echo CarritoCompras::agregarProducto(1, "Laptop Gaming", 1299.99, 1) . "<br>"; // Duplicado

echo "<br>" . CarritoCompras::mostrarCarrito() . "<br>";

echo "Items en carrito: " . CarritoCompras::obtenerCantidadItems() . "<br>";

// Modificar cantidad
echo "<br>" . CarritoCompras::modificarCantidad(2, 3) . "<br>";
echo CarritoCompras::mostrarCarrito() . "<br>";

// Información adicional de la sesión
echo "<h3>Información de la Sesión</h3>";
echo "Tiempo de vida de la sesión: " . ini_get('session.gc_maxlifetime') . " segundos<br>";
echo "Nombre de la sesión: " . session_name() . "<br>";
echo "¿Sesión activa?: " . (session_status() == PHP_SESSION_ACTIVE ? 'Sí' : 'No') . "<br>";

// Botones simulados para destruir sesión
echo "<br><strong>Opciones de sesión:</strong><br>";
echo "- Para destruir solo el carrito: CarritoCompras::vaciarCarrito()<br>";
echo "- Para cerrar sesión completa: session_destroy()<br>";
echo "- Para eliminar variable específica: unset(\$_SESSION['variable'])<br>";

// Ejemplo de destrucción condicional
if (isset($_GET['accion'])) {
    if ($_GET['accion'] == 'vaciar_carrito') {
        echo "<br>" . CarritoCompras::vaciarCarrito() . "<br>";
    } elseif ($_GET['accion'] == 'logout') {
        session_destroy();
        echo "<br>Sesión destruida. Recarga la página para ver el efecto.<br>";
    }
}
?>