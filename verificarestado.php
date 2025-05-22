<?php
if ($_SESSION["estado"]==0)
{
    echo "estado no autorizado";
    ?>
    <meta http-equiv="refresh" content="3;url=login.html">
    <?php
    die();
}
?>