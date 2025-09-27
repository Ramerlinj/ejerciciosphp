<?php

if ($_POST) {
    //var_dump($_POST);
    $nombre = $_POST['txtNombre'];
    echo "Hola $nombre";
}
else{
    echo "No se ha enviado el formulario";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post</title>
</head>
<body>
    <form action="ejercicio2.php" method="post">
        <input type="text" name="txtNombre" placeholder="Nombre">
        <input type="submit" value="Enviar">
    </form>

</body>
</html>