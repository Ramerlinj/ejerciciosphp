<?php

if($_POST){
    $valor1 = $_POST['valor1'];
    $valor2 = $_POST['valor2'];

    echo "Suma: ".($valor1 + $valor2)."<br/>";
    echo "Resta: ".($valor1 - $valor2)."<br/>";
    echo "Multiplicación: ".($valor1 * $valor2)."<br/>";
    echo "División: ".($valor1 / $valor2)."<br/>";
    echo "<br/>".($valor1 * $valor2)."";
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

<!--Operadores aritmeticos-->
    <form action="ejercicio8.php" method="post">
        <input type="number" name="valor1" placeholder="Numero 1">
        <input type="number" name="valor2" placeholder="Numero 2">
        <input type="submit" value="Enviar">
    </form>
</body>
</html>