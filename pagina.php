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
    include("conexion.php");
    session_start();
    if (!isset($_SESSION['id_usuario'])) {
    echo json_encode(["status" => "error", "msg" => "No hay sesión"]);
    exit;
}
    echo `Bienvenido ` . $_SESSION['id_usuario'] . "<br>";
    ?>
<a href="cerrar.php">Cerrar sesión</a>


<a href="#" onclick="abrir_modal()">Redactar</a>
<a href="redirigir_pagina()">panel administrador</a>
<a href="#">bandeja de entrada</a>
<a href="#">bandeja de salida</a>
<a href="#">borradores</a>
<div>tabla</div>



<div id="modalRedactar" style="display:none">
  <div class="modal-contenido">
    <h3>Redactar Mensaje</h3>
    <form id="formRedactar">
      <label>Asunto:</label><br>
      <input type="text" name="asunto" required><br><br>

      <label>Mensaje:</label><br>
      <textarea name="descripcion" rows="5" required></textarea><br><br>

      <button type="submit">Enviar a todos</button>
      <button type="button" onclick="cerrar_modal()">Cancelar</button>
    </form>
  </div>
</div>


<div id="modalResultado" style="display:none; background:#00000088; position:fixed; top:0; left:0; width:100%; height:100%;">
  <div style="background:white; padding:20px; width:40%; margin:20% auto; text-align:center;">
    <p id="mensaje_resultado"></p>
    <button onclick="cerrar_modal_resultado()">Aceptar</button>
  </div>
</div>




</body>
</html>