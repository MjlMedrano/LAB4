<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
     <script src="script.js"></script>
</head>
<body>
     <?php session_start();
          include("conexion.php");
        require("verificarsesion.php");
        require("verificarestado.php");
        
     ?>
   
        <a href="cerrar.php">Cerrar sesión</a>


        <a href="#">redactar</a><br>
        <a href="">panel administrador</a><br>
        <a href="#">bandeja de entrada</a><br>
        <a href="#">bandeja de salida</a><br>
        <a href="#">borradores</a><br>
        <br>
        <br>
        <br>
        <?php if ($_SESSION['nivel'] ==0) { ?>
        <a href="javascript:cargarContenido('read.php')">Habilitar suspender</a><br>
        <?php } ?>

        <div id="contenido">


        </div>


</body>
</html>