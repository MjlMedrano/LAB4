<?php
session_start();
include("conexion.php");
require("verificarsesion.php");
require("verificarnivel.php");

$id = $_POST['id'];
$estado = $_POST['estado'];

$stmt = $con->prepare("UPDATE usuario SET estado=? WHERE id=?");

$stmt->bind_param("ii", $estado, $id);
if ($stmt->execute()) {
    echo "Estado actualizado correctamente";
} else {
    echo "Error al actualizar el estado: " . $stmt->error;
}
$con->close();
?>