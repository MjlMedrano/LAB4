<?php
include('conexion.php');

$id = $_GET['id'];

$sql = "DELETE FROM usuario WHERE id=$id";
$resultado = $con->query($sql);

if($resultado)
{
    ?>
    <span>Registro eliminado correctamente</span>
    <?php
} else {
    echo "Erro al eliminar";
}