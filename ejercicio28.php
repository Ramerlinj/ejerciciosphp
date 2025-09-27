<?php
/*
EJERCICIO 28 - CONEXION PHP CON MYSQL
=====================================

DOCUMENTACION:
- PDO: PHP Data Objects - interfaz para acceso a bases de datos
- mysqli: Extensión mejorada de MySQL
- Conexión requiere: host, nombre BD, usuario, password
- Preparar consultas para evitar inyección SQL
- INSERT INTO para insertar datos

NOTA: Este ejemplo usa PDO. Para ejecutar necesitas:
1. Servidor MySQL activo (XAMPP)
2. Crear base de datos 'ejemplo_php'
3. Ajustar credenciales de conexión

SINTAXIS PDO:
$pdo = new PDO("mysql:host=host;dbname=database", $user, $pass);
$stmt = $pdo->prepare("INSERT INTO tabla (campo) VALUES (?)");
$stmt->execute([$valor]);
*/

echo "<h2>EJERCICIO 28 - CONEXION Y INSERCION MYSQL</h2>";

// EJEMPLO 1: Configuración y conexión PDO
echo "<h3>Ejemplo 1: Conexión a Base de Datos</h3>";

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
                echo "Conexión exitosa a la base de datos<br>";
            } catch (PDOException $e) {
                echo "Error de conexión: " . $e->getMessage() . "<br>";
                echo "Asegúrate de que MySQL esté activo y la base de datos 'ejemplo_php' exista<br>";
                return null;
            }
        }
        return self::$conexion;
    }
    
    public static function crearTablaUsuarios() {
        $sql = "CREATE TABLE IF NOT EXISTS usuarios (
            id INT AUTO_INCREMENT PRIMARY KEY,
            nombre VARCHAR(100) NOT NULL,
            email VARCHAR(100) UNIQUE NOT NULL,
            edad INT,
            fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )";
        
        try {
            $pdo = self::conectar();
            if ($pdo) {
                $pdo->exec($sql);
                echo "Tabla 'usuarios' creada/verificada exitosamente<br>";
            }
        } catch (PDOException $e) {
            echo "Error creando tabla: " . $e->getMessage() . "<br>";
        }
    }
}

// Establecer conexión y crear tabla
$conexion = ConexionDB::conectar();
ConexionDB::crearTablaUsuarios();

echo "<br>";

// EJEMPLO 2: Inserción de datos con preparación
echo "<h3>Ejemplo 2: Inserción de Usuarios</h3>";

class Usuario {
    private $pdo;
    
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    
    public function insertar($nombre, $email, $edad) {
        $sql = "INSERT INTO usuarios (nombre, email, edad) VALUES (?, ?, ?)";
        
        try {
            $stmt = $this->pdo->prepare($sql);
            $resultado = $stmt->execute([$nombre, $email, $edad]);
            
            if ($resultado) {
                $id = $this->pdo->lastInsertId();
                return "Usuario '$nombre' insertado exitosamente con ID: $id";
            } else {
                return "Error al insertar usuario";
            }
        } catch (PDOException $e) {
            if ($e->getCode() == 23000) {
                return "Error: El email '$email' ya existe en la base de datos";
            }
            return "Error en base de datos: " . $e->getMessage();
        }
    }
    
    public function insertarMultiples($usuarios_array) {
        $sql = "INSERT INTO usuarios (nombre, email, edad) VALUES (?, ?, ?)";
        $insertados = 0;
        $errores = [];
        
        try {
            $stmt = $this->pdo->prepare($sql);
            
            foreach ($usuarios_array as $usuario) {
                try {
                    $stmt->execute([$usuario['nombre'], $usuario['email'], $usuario['edad']]);
                    $insertados++;
                } catch (PDOException $e) {
                    $errores[] = "Error con {$usuario['nombre']}: " . $e->getMessage();
                }
            }
            
            $resultado = "Insertados: $insertados usuarios<br>";
            if (!empty($errores)) {
                $resultado .= "Errores:<br>" . implode("<br>", $errores);
            }
            return $resultado;
            
        } catch (PDOException $e) {
            return "Error preparando consulta: " . $e->getMessage();
        }
    }
    
    public function contarUsuarios() {
        try {
            $stmt = $this->pdo->query("SELECT COUNT(*) as total FROM usuarios");
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
            return $resultado['total'];
        } catch (PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }
}

if ($conexion) {
    $gestorUsuarios = new Usuario($conexion);
    
    // Insertar usuarios individuales
    echo $gestorUsuarios->insertar("Juan Pérez", "juan@email.com", 28) . "<br>";
    echo $gestorUsuarios->insertar("María García", "maria@email.com", 32) . "<br>";
    echo $gestorUsuarios->insertar("Carlos López", "carlos@email.com", 25) . "<br>";
    
    // Intentar insertar email duplicado
    echo $gestorUsuarios->insertar("Juan Duplicate", "juan@email.com", 30) . "<br>";
    
    echo "<br>";
    
    // Insertar múltiples usuarios
    $nuevos_usuarios = [
        ['nombre' => 'Ana Martínez', 'email' => 'ana@email.com', 'edad' => 29],
        ['nombre' => 'Pedro Ruiz', 'email' => 'pedro@email.com', 'edad' => 35],
        ['nombre' => 'Sofia Torres', 'email' => 'sofia@email.com', 'edad' => 26]
    ];
    
    echo "Inserción múltiple:<br>";
    echo $gestorUsuarios->insertarMultiples($nuevos_usuarios) . "<br>";
    
    echo "<br>Total de usuarios en la base de datos: " . $gestorUsuarios->contarUsuarios() . "<br>";
} else {
    echo "No se pudo establecer conexión con la base de datos<br>";
    echo "Verifica que MySQL esté ejecutándose y las credenciales sean correctas<br>";
}
?>