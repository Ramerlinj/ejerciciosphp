<?php
/**
 * Ejercicio 10: IF ANIDADO en PHP
 * 
 * Los if anidados permiten crear múltiples condiciones dentro de otras condiciones.
 * Es útil cuando necesitas verificar varias condiciones dependientes.
 */

echo "<h1>Ejercicio 10: IF Anidado</h1>";

// Ejemplo 1: Sistema de calificaciones con múltiples criterios
echo "<h2>Ejemplo 1: Sistema de Calificaciones</h2>";

$nota = 85;
$asistencia = 90;

echo "Nota: $nota<br>";
echo "Asistencia: $asistencia%<br>";

if ($nota >= 60) {
    echo "Nota aprobatoria<br>";
    
    if ($asistencia >= 80) {
        echo "Asistencia suficiente<br>";
        
        if ($nota >= 90) {
            echo "<strong>EXCELENTE - Matrícula de Honor</strong><br>";
        } elseif ($nota >= 80) {
            echo "<strong>MUY BIEN - Aprobado con Distinción</strong><br>";
        } else {
            echo "<strong>BIEN - Aprobado</strong><br>";
        }
    } else {
        echo "Asistencia insuficiente - Revisar con coordinación<br>";
    }
} else {
    echo "<strong>REPROBADO</strong> - Nota insuficiente<br>";
}

echo "<hr>";

// Ejemplo 2: Sistema de acceso por edad y documentación
echo "<h2>Ejemplo 2: Control de Acceso</h2>";

$edad = 25;
$tieneDocumento = true;
$esEstudiante = false;

echo "Edad: $edad años<br>";
echo "Tiene documento: " . ($tieneDocumento ? "Sí" : "No") . "<br>";
echo "Es estudiante: " . ($esEstudiante ? "Sí" : "No") . "<br>";

if ($edad >= 18) {
    echo "Mayor de edad<br>";
    
    if ($tieneDocumento) {
        echo "Documentación válida<br>";
        
        if ($edad >= 65) {
            echo "<strong>ACCESO GRATUITO</strong> - Tercera edad<br>";
        } elseif ($esEstudiante) {
            echo "<strong>DESCUENTO 50%</strong> - Estudiante<br>";
        } else {
            echo "<strong>TARIFA NORMAL</strong><br>";
        }
    } else {
        echo "No puede ingresar - Falta documentación<br>";
    }
} else {
    echo "Menor de edad<br>";
    
    if ($edad >= 12) {
        echo "<strong>TARIFA REDUCIDA</strong> - Adolescente<br>";
    } else {
        echo "<strong>ENTRADA GRATUITA</strong> - Niño<br>";
    }
}

echo "<hr>";

// Ejemplo 3: Validación de datos de usuario
echo "<h2>Ejemplo 3: Validación de Registro de Usuario</h2>";

$email = "usuario@ejemplo.com";
$password = "MiPassword123!";
$confirmPassword = "MiPassword123!";
$terminosAceptados = true;

echo "Email: $email<br>";
echo "Términos aceptados: " . ($terminosAceptados ? "Sí" : "No") . "<br>";

// Validar email
if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "Email válido<br>";
    
    // Validar contraseña
    if (strlen($password) >= 8) {
        echo "Contraseña tiene longitud mínima<br>";
        
        // Verificar que coincidan las contraseñas
        if ($password === $confirmPassword) {
            echo "Contraseñas coinciden<br>";
            
            // Verificar términos y condiciones
            if ($terminosAceptados) {
                echo "Términos aceptados<br>";
                echo "<strong>REGISTRO EXITOSO</strong><br>";
            } else {
                echo "Debe aceptar los términos y condiciones<br>";
            }
        } else {
            echo "Las contraseñas no coinciden<br>";
        }
    } else {
        echo "La contraseña debe tener al menos 8 caracteres<br>";
    }
} else {
    echo "Email no válido<br>";
}

echo "<hr>";

// Ejemplo 4: Clasificación de productos por categoría y precio
echo "<h2>Ejemplo 4: Clasificación de Productos</h2>";

$categoria = "electrónica";
$precio = 150;
$stock = 5;

echo "Categoría: $categoria<br>";
echo "Precio: $$precio<br>";
echo "Stock: $stock unidades<br>";

if ($stock > 0) {
    echo "Producto disponible<br>";
    
    if ($categoria == "electrónica") {
        echo "Categoría: Electrónica<br>";
        
        if ($precio >= 500) {
            echo "<strong>GAMA ALTA</strong> - Garantía extendida incluida<br>";
        } elseif ($precio >= 100) {
            echo "<strong>GAMA MEDIA</strong> - Garantía estándar<br>";
        } else {
            echo "<strong>GAMA BÁSICA</strong> - Ideal para principiantes<br>";
        }
    } elseif ($categoria == "ropa") {
        echo "Categoría: Ropa<br>";
        
        if ($precio >= 100) {
            echo "<strong>MARCA PREMIUM</strong><br>";
        } else {
            echo "<strong>PRECIO ACCESIBLE</strong><br>";
        }
    } else {
        echo "Categoría: General<br>";
    }
} else {
    echo "<strong>SIN STOCK</strong> - Producto no disponible<br>";
}

?>