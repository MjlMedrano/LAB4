<?php session_start();
include("conexion.php");
$correo = $_POST['correo'];
$password = sha1($_POST['password']);
$stmt = $con->prepare('SELECT correo,nombre,nivel,estado FROM usuario WHERE correo=? AND password=?');

$stmt->bind_param("ss", $correo, $password);
$stmt->execute();

$result = $stmt->get_result();
if ($result->num_rows > 0) {
   $row = $result->fetch_assoc(); // ← UNA sola vez
    $_SESSION['correo'] = $correo;
    $_SESSION['nivel'] = $row['nivel'];
    $_SESSION['estado'] = $row['estado'];
    header("Location:pagina.php");

} else {
    echo "Error datos de autenticación incorrectos";
    ?>
    <meta http-equiv="refresh" content="3;url=login.html">
    <?php
}

?>