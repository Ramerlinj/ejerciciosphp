<?php
function login($usuario, $password) {
    // Simulación de login
    return $usuario === "admin" && $password === "123456";
}

function logout() {
    return "Sesión cerrada exitosamente";
}

echo "Módulo de autenticación cargado<br>";
?>