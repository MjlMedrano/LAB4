<?php
if ($_SESSION["estado"]==0)
{
    echo "estado no autorizado";
    ?>
    <?php
    die();
}
?>