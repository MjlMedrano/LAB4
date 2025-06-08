<?php 
include('conexion.php');

$sql = "SELECT * FROM habitaciones";
$result = $con->query($sql); ?>

    <table border=1>
    <tr>
        <td>ID</td>
        <td>Numero</td>
        <td>Piso</td>
        <td>Tipo de Habitacion</td>
    </tr>
    <?php
    while ($fila = $result->fetch_assoc()) {
        ?>
        <tr>
            <td><?php echo $fila['id']; ?></td>
            <td><?php echo $fila['numero']; ?></td>
            <td><?php echo $fila['piso']; ?></td>
            <td><?php echo $fila['id_tipohabitacion']; ?></td>
            <td><button onclick="editar(<?php echo $fila['id']; ?>)">Editar</button></td>
            <td><button onclick="confirmarEliminacion(<?php echo $fila['id']; ?>)">Eliminar</button></td>
        </tr>
        <?php
    }
    ?>
</table>


