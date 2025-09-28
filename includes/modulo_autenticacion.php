<?php
function login($usuario, $password) {
    return $usuario === "admin" && $password === "123456";
}

function logout() {
    return "Sesión cerrada exitosamente";
}

echo "Módulo de autenticdación cargado<br>";
?>