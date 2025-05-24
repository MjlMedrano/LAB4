<?php
include('conexion.php');
$sql = "SELECT id, correo, password, nombre, nivel, estado FROM usuario";
$resultado = $con->query($sql);
?>
<div class="panel">
    <button onclick="mostrarModalCreate()">Crear Usuario</button><br><br>
    <button onclick="abrir_modal()">Enviar a todos</button><br><br>
<table>
    <tr>
        <td>ID</td>
        <td>Nombre</td>
        <td>Correo</td>
        <td>Contraseña</td>
        <td>Nivel</td>
        <td>Estado</td>
        <td>Editar</td>
        <td>Eliminar</td>
    </tr>
    <?php while($fila = $resultado->fetch_assoc()) { ?>
        <tr>
            <td><?= $fila['id'] ?></td>
            <td><?= $fila['nombre'] ?></td>
            <td><?= $fila['correo'] ?></td>
            <td><?= $fila['password'] ?></td>
            <td><?= $fila['nivel'] == '0' ? "Administrador" : "Usuario" ?></td>
            <td><a href="javascript:cambiarEstado(<?= $fila['id'] ?>)"><?= $fila['estado'] == '0' ? "Inactivo": "Activo" ?></a></td>
            <td><a href="javascript:mostrarModalUpdate(<?= $fila['id'] ?>)">Editar Usuario</a></td>
            <td><a style="background-color:rgb(238, 85, 85)" href="javascript:mostrarModalDelete(<?= $fila['id'] ?>)">Eliminar Usuario</a></td>
        </tr>
    <?php } ?>
</table>
</div>