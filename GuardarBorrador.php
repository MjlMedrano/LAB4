<?php
include("conexion.php");
session_start();

$id_remitente = $_SESSION['id_usuario'];
$mensaje = $_POST['mensaje'];
$estado = $_POST['estado']; // debería ser "borrador"
$asunto = "Sin asunto"; // si quieres también puedes pedir el asunto

$sql = "INSERT INTO mensajes (id_remitente, id_destinatario, descripcion, estado, asunto) VALUES (?, NULL, ?, ?, ?)";
$stmt = $con->prepare($sql);
$stmt->bind_param("isss", $id_remitente, $mensaje, $estado, $asunto);

if ($stmt->execute()) {
    echo "Mensaje guardado como borrador.";
} else {
    echo "Error al guardar el borrador.";
}
?>
