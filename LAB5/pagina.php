<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="script.js"></script>
    
    <link rel="stylesheet" href="pagina.css">
</head>
<body>
    <?php
    include("conexion.php");
    session_start();


    ?>


  <div class="navbar" style="display: flex; justify-content: space-between; align-items: center; padding: 10px; gap: 20px; flex-wrap: wrap;">

    <!-- Logo o nombre del sitio -->
    <div class="navbar-logo" style="flex: 1;">
        <h2><a href="pagina.php" style="text-decoration: none; color: black;">Mi Hotel</a></h2>
    </div>

    <!-- Barra de búsqueda de habitaciones -->
    <div class="navbar-busqueda" style="flex: 2;">
        <form onsubmit="buscarHabitaciones(event)" style="display: flex; gap: 10px; flex-wrap: wrap; align-items: center; justify-content: center;">
            <select name="tipo" id="tipo" required style="padding: 5px;">
                <option value="">Tipo</option>
                <option value="simple">Simple</option>
                <option value="doble">Doble</option>
                <option value="suite">Suite</option>
            </select>
            <button type="submit" style="padding: 6px 15px;">Buscar</button>
        </form>
    </div>

    <!-- Links y sesion -->
    <div class="navbar-links" style="flex: 1; display: flex; flex-direction: column; align-items: flex-end; gap: 5px;">

        <!-- Botones de navegación -->
        <div class="navbar-botones" style="display: flex; gap: 10px;">
            <a href="pagina.php">Inicio</a>
            <?php if (isset($_SESSION['id_usuario']) && $_SESSION['nivel'] == 0): ?>
                <a class="menu" href="javascript:cargarContenido('Uread.php')">Gestion Usuarios</a>
                <a class="menu" href="javascript:cargarContenido('Habitaciones.html')">Gestion Habitaciones</a>
            <?php endif; ?>
        </div>

        <!-- Sesion -->
        <div class="navbar-sesion">
            <?php if (isset($_SESSION['id_usuario'])): ?>
                <a class="menu" href="cerrar.php">Cerrar sesión</a>
                <!-- Imagen de perfil futura -->
                 
            <?php else: ?>
                <a href="javascript:abrirModal('login.html')">Iniciar sesión</a>
            <?php endif; ?>
        </div>
    </div>

</div>

<br><br>
     
<div id="contenido">


</div>









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


<!-- MODAL: CREAR USUARIO -->
<div id="myModalCreate" class="modal" style="display: none;">
    <div class="modal-content">
        <h2 id="tituloModalCreate"></h2>
        <div id="mensajeModalCreate"></div>
        <input type="hidden" id="idElemento">
        <button id="btnUltimos" style="display: none;">Últimos</button>
        <div style="text-align: right; margin-top: 10px;">
      <button onclick="cerrarModalPorId('myModalCreate')">Cerrar</button>
    </div>
    </div>
</div>

<!-- MODAL: EDITAR USUARIO -->
<div id="myModalUpdate" class="modal" style="display: none;">
    <div class="modal-content">
        
        <h2 id="tituloModalUpdate"></h2>
        <div id="mensajeModalUpdate"></div>
        <input type="hidden" id="idElemento">
        <button id="btnUltimos" style="display: none;">Últimos</button>
        <div style="text-align: right; margin-top: 10px;">
      <button onclick="cerrarModalPorId('myModalUpdate')">Cerrar</button>
    </div>
    </div>
</div>

<!-- MODAL: ELIMINAR USUARIO -->
<div id="myModalDelete" class="modal" style="display: none;">
    <div class="modal-content">
        <h2 id="tituloModalDelete"></h2>
        <div id="mensajeModalDelete"></div>
        <input type="hidden" id="idElemento">
        <button id="btnUltimos" style="display: none;">Últimos</button>
        <div style="text-align: right; margin-top: 10px;">
      <button onclick="cerrarModalPorId('myModalDelete')">Cerrar</button>
    </div>
    </div>
</div>





<!-- Modal para enviar mensaje individual -->
<div id="modalMensajeIndividual" class="modal" style="display:none;">
  <div class="modal-content">
    <h2>Enviar mensaje individual</h2>
    <form id="formMensajeIndividual">
      <label for="destinatario">Seleccionar usuario:</label><br>
      <select name="id_destinatario" id="destinatario" required></select><br><br>

      <label for="asunto">Asunto:</label><br>
      <input type="text" name="asunto" id="asunto" required><br><br>

      <label for="mensaje">Mensaje:</label><br>
      <textarea name="descripcion" id="mensaje" rows="5" required></textarea><br><br>

      <button type="submit">Enviar</button>
      <button type="button" onclick="guardarBorrador()">Guardar</button>
      <div style="text-align: right; margin-top: 10px;">
      <button type="button" formnovalidate onclick="cerrarModalPorId('modalMensajeIndividual')">Cerrar</button>
    </div>
    </form>
    <div id="respuestaEnvio"></div>
  </div>
</div>





<!-- Modal para ver mensaje en bandeja con boton ver -->
<div id="modalVerMensaje" class="modal" style="display: none;">
  <div class="modal-content">

    <h2 id="tituloModalMensaje"></h2>
    <p><strong>Asunto:</strong> <span id="asuntoMensaje"></span></p>
    <p><strong>Descripción:</strong> <span id="descripcionMensaje"></span></p>
    <p><strong>Estado:</strong> <span id="estadoMensaje"></span></p>
    
    <!-- Botón cerrar al final -->
    <div style="text-align: right; margin-top: 10px;">
      <button onclick="cerrarModalPorId('modalVerMensaje')">Cerrar</button>
    </div>
  </div>
</div>



<!-- Modal para ver mensaje en bandeja de borrador -->

<div id="modalEditarBorrador" style="display: none;" class="modal">
  <div class="modal-contenido">
    <h2>Editar Borrador</h2>
    <form id="formEditarBorrador">
      <input type="hidden" name="id" id="idBorrador">

      <label for="destinatarioBorrador">Destinatario:</label>
      <select name="id_destinatario" id="destinatarioBorrador" required></select>

      <label for="asuntoBorrador">Asunto:</label>
      <input type="text" name="asunto" id="asuntoBorrador" required>

      <label for="descripcionBorrador">Descripción:</label>
      <textarea name="descripcion" id="descripcionBorrador" required></textarea>

      <br>
      <button type="button" onclick="guardarBorrador()">Guardar</button>
      <button type="button" onclick="enviarBorrador()">Enviar</button>
      <button type="button" onclick="cerrarModalBorrador()">Cancelar</button>
    </form>
  </div>
</div>



<!-- Modal para el login -->

<div id="modal-global" class="modal" style="display:none;">
    <div class="modal-content" id="modal-body">

    </div>
</div>



</body>
</html>