<?php
/*
EJERCICIO 26 - CONSTRUCTOR EN PHP
=================================

DOCUMENTACION:
- __construct(): Método especial que se ejecuta al crear un objeto
- Se llama automáticamente con 'new'
- Permite inicializar propiedades del objeto
- Puede recibir parámetros
- Es útil para configurar el estado inicial del objeto

SINTAXIS:
class MiClase {
    public function __construct($parametro1, $parametro2) {
        $this->propiedad1 = $parametro1;
        $this->propiedad2 = $parametro2;
    }
}
*/

echo "<h2>EJERCICIO 26 - CONSTRUCTOR EN PHP</h2>";

// EJEMPLO 1: Clase Producto con constructor
echo "<h3>Ejemplo 1: Clase Producto</h3>";

class Producto {
    private $nombre;
    private $precio;
    private $categoria;
    private $fecha_creacion;
    
    public function __construct($nombre, $precio, $categoria = 'General') {
        $this->nombre = $nombre;
        $this->precio = $precio;
        $this->categoria = $categoria;
        $this->fecha_creacion = date('Y-m-d H:i:s');
        
        echo "Producto '$nombre' creado exitosamente<br>";
    }
    
    public function mostrarInfo() {
        return "Producto: $this->nombre<br>" .
               "Precio: $" . number_format($this->precio, 2) . "<br>" .
               "Categoría: $this->categoria<br>" .
               "Creado: $this->fecha_creacion";
    }
    
    public function aplicarDescuento($porcentaje) {
        $descuento = $this->precio * ($porcentaje / 100);
        $this->precio -= $descuento;
        return "Descuento del $porcentaje% aplicado. Nuevo precio: $" . 
               number_format($this->precio, 2);
    }
    
    public function getPrecio() {
        return $this->precio;
    }
}

// Crear productos usando el constructor
$laptop = new Producto("Laptop Gaming", 1299.99, "Electrónicos");
$libro = new Producto("Libro PHP", 45.00, "Libros");
$accesorio = new Producto("Mouse Inalámbrico", 29.99); // Usa categoría por defecto

echo "<br>";
echo $laptop->mostrarInfo() . "<br><br>";
echo $libro->mostrarInfo() . "<br><br>";
echo $accesorio->mostrarInfo() . "<br><br>";

echo $laptop->aplicarDescuento(15) . "<br>";

echo "<br>";

// EJEMPLO 2: Clase Usuario con validaciones en constructor
echo "<h3>Ejemplo 2: Clase Usuario con Validaciones</h3>";

class Usuario {
    private $nombre_usuario;
    private $email;
    private $fecha_registro;
    private $activo;
    private $intentos_login;
    
    public function __construct($nombre_usuario, $email) {
        // Validar nombre de usuario
        if (strlen($nombre_usuario) < 3) {
            throw new Exception("El nombre de usuario debe tener al menos 3 caracteres");
        }
        
        // Validar email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("El email no es válido");
        }
        
        $this->nombre_usuario = $nombre_usuario;
        $this->email = $email;
        $this->fecha_registro = date('Y-m-d');
        $this->activo = true;
        $this->intentos_login = 0;
        
        $this->enviarEmailBienvenida();
    }
    
    private function enviarEmailBienvenida() {
        echo "Email de bienvenida enviado a: $this->email<br>";
    }
    
    public function login($password) {
        // Simulación de login
        $password_correcto = "123456"; // En la realidad sería hasheado
        
        if ($password === $password_correcto) {
            $this->intentos_login = 0;
            return "Login exitoso para $this->nombre_usuario";
        } else {
            $this->intentos_login++;
            if ($this->intentos_login >= 3) {
                $this->activo = false;
                return "Cuenta bloqueada por múltiples intentos fallidos";
            }
            return "Password incorrecto. Intento {$this->intentos_login} de 3";
        }
    }
    
    public function mostrarPerfil() {
        $estado = $this->activo ? 'Activo' : 'Bloqueado';
        return "Usuario: $this->nombre_usuario<br>" .
               "Email: $this->email<br>" .
               "Registrado: $this->fecha_registro<br>" .
               "Estado: $estado<br>" .
               "Intentos de login fallidos: $this->intentos_login";
    }
}

try {
    $usuario1 = new Usuario("juanperez", "juan@email.com");
    echo $usuario1->mostrarPerfil() . "<br><br>";
    
    echo $usuario1->login("password_incorrecto") . "<br>";
    echo $usuario1->login("password_incorrecto") . "<br>";
    echo $usuario1->login("123456") . "<br><br>";
    
    // Intentar crear usuario con datos inválidos
    $usuario2 = new Usuario("ab", "email_invalido");
    
} catch (Exception $e) {
    echo "Error al crear usuario: " . $e->getMessage() . "<br>";
}

echo "<br>Los constructores son fundamentales para inicializar objetos correctamente.";
?>