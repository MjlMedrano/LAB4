
<?php
session_start();
include('conexion.php');

$id = $_GET['id'];
$sql = "SELECT * FROM habitaciones WHERE id = $id";
$result = $con->query($sql);

$fila = $result->fetch_assoc();
?>  
    <form id="formulario"  onsubmit="Hactualizar();" method="post">
        <input type="hidden" id="id" name="id" value="<?php echo $fila['id']; ?>">
        <label for="numero">Numero</label>
        <input type="number" id="numero" name="numero" value="<?php echo $fila['numero']; ?>"><br>
        <label for="piso">Piso</label>
        <input type="number" id="piso" name="piso" value="<?php echo $fila['piso']; ?>"><br>
        <label for="tipoHabitacion">Tipo de habitacion</label>
        <input type="number" id="tipoHabitacion" name="tipoHabitacion" value="<?php echo $fila['id_tipohabitacion']; ?>"><br>
        <input type="submit" value="Actualizar">
    </form>
