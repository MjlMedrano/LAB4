<?php
include('conexion.php');

$sql = "SELECT id, nombre, correo, password, nivel, estado FROM usuario";
$resultado = $con->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
        <form action="javascript:MInsertar()" method="post" id="FormCreate">
            <label>Nombre</label>
            <input type="text" name="nombre"><br>
            <label>Correo</label>
            <input type="email" name="correo"><br>
            <label>Contraseña</label>
            <input type="password" name="password"><br>
            <label>Nivel</label>
            <input type="number" name="nivel"><br>
            <label>Estado</label>
            <input type="number" name="estado"><br>
            <input type="submit" value="Insertar">
        </form>
</body>
</html>