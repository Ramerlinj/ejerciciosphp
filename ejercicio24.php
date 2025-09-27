<?php
/*
EJERCICIO 24 - CLASES EN PHP Y VISIBILIDAD DE DATOS
===================================================

DOCUMENTACION:
- class: Define una clase
- public: Accesible desde cualquier lugar
- private: Solo accesible dentro de la misma clase
- protected: Accesible en la clase y sus hijos
- $this: Referencia al objeto actual
- ->: Operador para acceder a propiedades y métodos

SINTAXIS:
class NombreClase {
    public $propiedad_publica;
    private $propiedad_privada;
    protected $propiedad_protegida;
    
    public function metodo() {
        return $this->propiedad_publica;
    }
}
*/

echo "<h2>EJERCICIO 24 - CLASES Y VISIBILIDAD</h2>";

// EJEMPLO 1: Clase básica con diferentes niveles de visibilidad
echo "<h3>Ejemplo 1: Clase Persona</h3>";

class Persona {
    public $nombre;           // Accesible desde cualquier lugar
    private $edad;           // Solo accesible dentro de esta clase
    protected $telefono;     // Accesible en esta clase y clases hijas
    
    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }
    
    public function setEdad($edad) {
        if ($edad > 0 && $edad < 150) {
            $this->edad = $edad;
        }
    }
    
    public function getEdad() {
        return $this->edad;
    }
    
    protected function setTelefono($telefono) {
        $this->telefono = $telefono;
    }
    
    public function mostrarInfo() {
        return "Nombre: $this->nombre, Edad: $this->edad";
    }
    
    private function validarDatos() {
        return !empty($this->nombre) && $this->edad > 0;
    }
    
    public function esValido() {
        return $this->validarDatos();
    }
}

$persona1 = new Persona();
$persona1->setNombre("Ana García");
$persona1->setEdad(25);

echo $persona1->mostrarInfo() . "<br>";
echo "Datos válidos: " . ($persona1->esValido() ? 'Sí' : 'No') . "<br>";

// Acceso directo a propiedad pública
$persona1->nombre = "Ana María García";
echo "Nombre modificado directamente: " . $persona1->nombre . "<br>";

echo "<br>";

// EJEMPLO 2: Clase Cuenta Bancaria con encapsulación
echo "<h3>Ejemplo 2: Cuenta Bancaria</h3>";

class CuentaBancaria {
    public $titular;
    private $saldo;
    private $numero_cuenta;
    protected $tipo_cuenta;
    
    public function __construct($titular, $saldo_inicial = 0) {
        $this->titular = $titular;
        $this->saldo = $saldo_inicial;
        $this->numero_cuenta = $this->generarNumeroCuenta();
        $this->tipo_cuenta = 'Ahorros';
    }
    
    public function depositar($cantidad) {
        if ($cantidad > 0) {
            $this->saldo += $cantidad;
            return "Depósito exitoso. Nuevo saldo: $" . number_format($this->saldo, 2);
        }
        return "Cantidad inválida para depósito";
    }
    
    public function retirar($cantidad) {
        if ($cantidad > 0 && $cantidad <= $this->saldo) {
            $this->saldo -= $cantidad;
            return "Retiro exitoso. Nuevo saldo: $" . number_format($this->saldo, 2);
        }
        return "Fondos insuficientes o cantidad inválida";
    }
    
    public function getSaldo() {
        return $this->saldo;
    }
    
    public function getNumeroCuenta() {
        return $this->numero_cuenta;
    }
    
    private function generarNumeroCuenta() {
        return 'CTA-' . rand(100000, 999999);
    }
    
    public function mostrarResumen() {
        return "Titular: $this->titular<br>" .
               "Número: $this->numero_cuenta<br>" .
               "Saldo: $" . number_format($this->saldo, 2) . "<br>" .
               "Tipo: $this->tipo_cuenta";
    }
}

$cuenta = new CuentaBancaria("Pedro López", 500.00);
echo $cuenta->mostrarResumen() . "<br><br>";

echo $cuenta->depositar(200) . "<br>";
echo $cuenta->retirar(150) . "<br>";
echo $cuenta->retirar(1000) . "<br>";

echo "<br>Saldo final: $" . number_format($cuenta->getSaldo(), 2) . "<br>";
?>