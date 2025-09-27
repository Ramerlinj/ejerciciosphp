<?php
/*
EJERCICIO 25 - HERENCIA EN PHP
==============================

DOCUMENTACION:
- extends: Palabra clave para heredar de otra clase
- parent::: Accede a métodos de la clase padre
- Herencia permite reutilizar código y crear jerarquías
- Las clases hijas pueden sobrescribir métodos del padre
- protected: Permite acceso desde clases hijas

SINTAXIS:
class ClaseHija extends ClasePadre {
    // Nuevos métodos y propiedades
    // Puede sobrescribir métodos del padre
}
*/

echo "<h2>EJERCICIO 25 - HERENCIA EN PHP</h2>";

// EJEMPLO 1: Jerarquía de Vehículos
echo "<h3>Ejemplo 1: Jerarquía de Vehículos</h3>";

class Vehiculo {
    protected $marca;
    protected $modelo;
    protected $año;
    
    public function __construct($marca, $modelo, $año) {
        $this->marca = $marca;
        $this->modelo = $modelo;
        $this->año = $año;
    }
    
    public function mostrarInfo() {
        return "Vehículo: $this->marca $this->modelo ($this->año)";
    }
    
    public function arrancar() {
        return "El vehículo está arrancando...";
    }
    
    protected function validarAño() {
        return $this->año >= 1900 && $this->año <= date('Y');
    }
}

class Automovil extends Vehiculo {
    private $num_puertas;
    private $combustible;
    
    public function __construct($marca, $modelo, $año, $num_puertas, $combustible) {
        parent::__construct($marca, $modelo, $año);
        $this->num_puertas = $num_puertas;
        $this->combustible = $combustible;
    }
    
    public function mostrarInfo() {
        $info_base = parent::mostrarInfo();
        return "$info_base<br>Puertas: $this->num_puertas, Combustible: $this->combustible";
    }
    
    public function arrancar() {
        return "El automóvil $this->marca está encendiendo el motor...";
    }
    
    public function abrirPuertas() {
        return "Abriendo las $this->num_puertas puertas del automóvil";
    }
}

class Motocicleta extends Vehiculo {
    private $cilindrada;
    private $tipo;
    
    public function __construct($marca, $modelo, $año, $cilindrada, $tipo) {
        parent::__construct($marca, $modelo, $año);
        $this->cilindrada = $cilindrada;
        $this->tipo = $tipo;
    }
    
    public function mostrarInfo() {
        $info_base = parent::mostrarInfo();
        return "$info_base<br>Cilindrada: {$this->cilindrada}cc, Tipo: $this->tipo";
    }
    
    public function arrancar() {
        return "La motocicleta $this->marca está arrancando con un rugido...";
    }
    
    public function hacerCaballito() {
        return "La motocicleta está haciendo un caballito";
    }
}

// Crear objetos
$auto = new Automovil("Toyota", "Corolla", 2022, 4, "Gasolina");
$moto = new Motocicleta("Honda", "CBR600", 2021, 600, "Deportiva");

echo $auto->mostrarInfo() . "<br>";
echo $auto->arrancar() . "<br>";
echo $auto->abrirPuertas() . "<br><br>";

echo $moto->mostrarInfo() . "<br>";
echo $moto->arrancar() . "<br>";
echo $moto->hacerCaballito() . "<br>";

echo "<br>";

// EJEMPLO 2: Sistema de Empleados
echo "<h3>Ejemplo 2: Sistema de Empleados</h3>";

class Empleado {
    protected $nombre;
    protected $salario_base;
    protected $departamento;
    
    public function __construct($nombre, $salario_base, $departamento) {
        $this->nombre = $nombre;
        $this->salario_base = $salario_base;
        $this->departamento = $departamento;
    }
    
    public function calcularSalario() {
        return $this->salario_base;
    }
    
    public function mostrarInfo() {
        return "Empleado: $this->nombre<br>Departamento: $this->departamento<br>Salario: $" . 
               number_format($this->calcularSalario(), 2);
    }
}

class Gerente extends Empleado {
    private $bono_gerencial;
    
    public function __construct($nombre, $salario_base, $departamento, $bono_gerencial) {
        parent::__construct($nombre, $salario_base, $departamento);
        $this->bono_gerencial = $bono_gerencial;
    }
    
    public function calcularSalario() {
        return parent::calcularSalario() + $this->bono_gerencial;
    }
    
    public function mostrarInfo() {
        return "GERENTE<br>" . parent::mostrarInfo() . 
               "<br>Bono gerencial: $" . number_format($this->bono_gerencial, 2);
    }
}

class Vendedor extends Empleado {
    private $comision_ventas;
    private $ventas_mes;
    
    public function __construct($nombre, $salario_base, $departamento, $comision_ventas) {
        parent::__construct($nombre, $salario_base, $departamento);
        $this->comision_ventas = $comision_ventas;
        $this->ventas_mes = 0;
    }
    
    public function registrarVentas($monto) {
        $this->ventas_mes = $monto;
    }
    
    public function calcularSalario() {
        $comision = $this->ventas_mes * $this->comision_ventas / 100;
        return parent::calcularSalario() + $comision;
    }
    
    public function mostrarInfo() {
        return "VENDEDOR<br>" . parent::mostrarInfo() . 
               "<br>Ventas del mes: $" . number_format($this->ventas_mes, 2) . 
               "<br>Comisión: " . $this->comision_ventas . "%";
    }
}

$gerente = new Gerente("María González", 5000, "Administración", 1500);
$vendedor = new Vendedor("Carlos Ruiz", 2000, "Ventas", 5);
$vendedor->registrarVentas(10000);

echo $gerente->mostrarInfo() . "<br><br>";
echo $vendedor->mostrarInfo() . "<br>";
?>