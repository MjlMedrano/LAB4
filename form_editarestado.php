<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="script.js"></script>
</head>
<body>
    <?php
    session_start();
    include("conexion.php");
    require("verificarsesion.php");
    require("verificarnivel.php");
    
    $id=$_GET['id'];
    $sql="SELECT id,nombre,estado,correo FROM usuario WHERE id=$id";
    $resultado=$con->query($sql);
    $row = $resultado->fetch_assoc();
    ?>
    <form action="javascript:guardarEditar()" id="form-edit" method="post" >

        <input type="hidden" name="id" value="<?php echo $row['id'];?>">
        <label for="nombre">Nombre:</label>
        <?php echo $row['nombre'];?>
        <br>
        <label for="estado">Estado:</label>
        <select name="estado">
            <option value="1" <?php if($row['estado'] == 1) echo 'selected'; ?>>Activo</option>
            <option value="0" <?php if($row['estado'] == 0) echo 'selected'; ?>>Inactivo</option>
        </select>
        <br>
        <input type="submit" value="Actualizar">

    </form>
</body>
</html>