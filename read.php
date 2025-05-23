<?php session_start();

require("verificarsesion.php");
require("verificarnivel.php");

?>
<a href="cerrar.php">Cerrar Sesion</a>

<?php
include("conexion.php");



$sql="SELECT id,correo,nombre,nivel,estado  FROM usuario";
      

$resultado=$con->query($sql);



?>


<table style="border-collapse: collapse" border="1" >
    <thead>
        <tr>
            <th >Correo</th>
            <th >Nombre</th>
            <th >Nivel</th>
            <th >Estado</th>
            <th >Editar Estado</th>
        </tr>
    </thead>
    
 <?php 
 while($row=mysqli_fetch_array($resultado)){
    ?>
    <tr>
        <td><?php echo $row['correo'];?></td>
        <td><?php echo $row['nombre'];?></td>
        <td><?php echo $row['nivel'];?></td>
        <td><?php echo $row['estado'];?></td>
        <td><a href="javascript:editarestado('<?php echo $row['id'];?>')">Editar</a>  

        </td>
        
    </tr>
    <?php } ?>
 </table>
