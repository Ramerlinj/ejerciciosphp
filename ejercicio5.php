<?php

if($_POST){
    $txtNombre = $_POST["txtNombre"];
    $txtApellido = $_POST["txtApellido"];
    echo"Hola ".$txtNombre." ".$txtApellido;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="ejercicio5.php" method="post">
        <input type="text" name="txtNombre" placeholder="Nombre">
        <input type="text" name="txtApellido" placeholder="Apellido">
        <input type="submit" value="Enviar">
    </form>
</body>