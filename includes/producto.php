<?php
class Producto {
    public $nombre;
    public $precio;
    public function __construct($nombre, $precio) {
        $this->nombre = $nombre;
        $this->precio = $precio;
        echo "Producto creado: $nombre (€$precio)<br>";
    }
}