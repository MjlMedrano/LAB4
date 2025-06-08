<?php 
include('conexion.php');

$id = $_POST['id'];
$numero = $_POST['numero'];
$piso = $_POST['piso'];
$id_tipohabitacion = $_POST['tipoHabitacion'];
$sql = "UPDATE habitaciones SET numero='$numero', piso='$piso', id_tipohabitacion='$id_tipohabitacion' WHERE id=$id";
$con->query($sql);

?>