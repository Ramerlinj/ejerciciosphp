<?php

if($_POST){
    $valor1 = $_POST["valor1"];
    $valor2 = $_POST["valor2"];

    if($valor1 == $valor2){
        echo "Los valores son iguales";
    }else{
        echo "Los valores son diferentes";
    }
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

<!--Operadores comparacion-->
    <form action="ejercicio9.php" method="post">
        <input type="number" name="valor1" placeholder="Numero 1">
        <input type="number" name="valor2" placeholder="Numero 2">
        <input type="submit" value="Enviar">
    </form>
</body>
</html>