<?php
/*
EJERCICIO 29 - LEER DATOS DE MYSQL CON PHP
==========================================

DOCUMENTACION:
- SELECT: Consulta para leer datos de la base de datos
- fetch(): Obtiene una fila del resultado
- fetchAll(): Obtiene todas las filas
- PDO::FETCH_ASSOC: Devuelve array asociativo
- WHERE: Filtrar resultados con condiciones

SINTAXIS:
$stmt = $pdo->prepare("SELECT * FROM tabla WHERE condicion = ?");
$stmt->execute([$valor]);
$resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
*/

echo "<h2>EJERCICIO 29 - LEER DATOS DE MYSQL</h2>";

// Reutilizar la clase de conexión del ejercicio anterior
class ConexionDB {
    private static $host = 'localhost';
    private static $dbname = 'ejemplo_php';
    private static $username = 'root';
    private static $password = '';
    private static $conexion = null;
    
    public static function conectar() {
        if (self::$conexion === null) {
            try {
                $dsn = "mysql:host=" . self::$host . ";dbname=" . self::$dbname . ";charset=utf8";
                self::$conexion = new PDO($dsn, self::$username, self::$password);
                self::$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                echo "Error de conexión: " . $e->getMessage() . "<br>";
                return null;
            }
        }
        return self::$conexion;
    }
}

// EJEMPLO 1: Lectura básica de usuarios
echo "<h3>Ejemplo 1: Listar Todos los Usuarios</h3>";

class LectorUsuarios {
    private $pdo;
    
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    
    public function obtenerTodos() {
        try {
            $sql = "SELECT * FROM usuarios ORDER BY fecha_registro DESC";
            $stmt = $this->pdo->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error al obtener usuarios: " . $e->getMessage();
            return [];
        }
    }
    
    public function buscarPorEmail($email) {
        try {
            $sql = "SELECT * FROM usuarios WHERE email = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$email]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error en búsqueda: " . $e->getMessage();
            return false;
        }
    }
    
    public function obtenerPorEdad($edad_minima, $edad_maxima) {
        try {
            $sql = "SELECT * FROM usuarios WHERE edad BETWEEN ? AND ? ORDER BY edad";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$edad_minima, $edad_maxima]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error en filtro por edad: " . $e->getMessage();
            return [];
        }
    }
    
    public function obtenerEstadisticas() {
        try {
            $sql = "SELECT 
                        COUNT(*) as total_usuarios,
                        AVG(edad) as edad_promedio,
                        MIN(edad) as edad_minima,
                        MAX(edad) as edad_maxima
                    FROM usuarios";
            $stmt = $this->pdo->query($sql);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error obteniendo estadísticas: " . $e->getMessage();
            return [];
        }
    }
}

$conexion = ConexionDB::conectar();

if ($conexion) {
    $lector = new LectorUsuarios($conexion);
    
    // Obtener todos los usuarios
    $usuarios = $lector->obtenerTodos();
    
    if (!empty($usuarios)) {
        echo "Lista de usuarios registrados:<br>";
        echo "<table border='1' cellpadding='5' cellspacing='0'>";
        echo "<tr><th>ID</th><th>Nombre</th><th>Email</th><th>Edad</th><th>Fecha Registro</th></tr>";
        
        foreach ($usuarios as $usuario) {
            echo "<tr>";
            echo "<td>" . $usuario['id'] . "</td>";
            echo "<td>" . $usuario['nombre'] . "</td>";
            echo "<td>" . $usuario['email'] . "</td>";
            echo "<td>" . $usuario['edad'] . "</td>";
            echo "<td>" . $usuario['fecha_registro'] . "</td>";
            echo "</tr>";
        }
        echo "</table><br>";
    } else {
        echo "No hay usuarios registrados en la base de datos<br><br>";
    }
    
    echo "<br>";
    
    // EJEMPLO 2: Búsquedas y filtros específicos
    echo "<h3>Ejemplo 2: Búsquedas Específicas</h3>";
    
    // Buscar usuario por email
    $email_buscar = "maria@email.com";
    $usuario_encontrado = $lector->buscarPorEmail($email_buscar);
    
    if ($usuario_encontrado) {
        echo "Usuario encontrado con email '$email_buscar':<br>";
        echo "Nombre: " . $usuario_encontrado['nombre'] . "<br>";
        echo "Edad: " . $usuario_encontrado['edad'] . " años<br>";
        echo "Registro: " . $usuario_encontrado['fecha_registro'] . "<br>";
    } else {
        echo "No se encontró usuario con email '$email_buscar'<br>";
    }
    
    echo "<br>";
    
    // Filtrar por rango de edad
    $usuarios_jovenes = $lector->obtenerPorEdad(20, 30);
    echo "Usuarios entre 20 y 30 años:<br>";
    
    if (!empty($usuarios_jovenes)) {
        foreach ($usuarios_jovenes as $usuario) {
            echo "- " . $usuario['nombre'] . " (" . $usuario['edad'] . " años)<br>";
        }
    } else {
        echo "No hay usuarios en ese rango de edad<br>";
    }
    
    echo "<br>";
    
    // Mostrar estadísticas
    $estadisticas = $lector->obtenerEstadisticas();
    if (!empty($estadisticas)) {
        echo "Estadísticas de usuarios:<br>";
        echo "Total de usuarios: " . $estadisticas['total_usuarios'] . "<br>";
        echo "Edad promedio: " . number_format($estadisticas['edad_promedio'], 1) . " años<br>";
        echo "Edad mínima: " . $estadisticas['edad_minima'] . " años<br>";
        echo "Edad máxima: " . $estadisticas['edad_maxima'] . " años<br>";
    }
    
} else {
    echo "No se pudo conectar a la base de datos<br>";
    echo "Asegúrate de que MySQL esté activo y ejecuta primero el ejercicio28.php<br>";
}
?>