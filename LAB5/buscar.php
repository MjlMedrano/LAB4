<?php
include("conexion.php");

if (isset($_POST['tipo'])) {
    $tipo = $_POST['tipo'];

    $sql = "SELECT 
            h.id AS id_habitacion,
            h.descripcion,
            h.numero,
            h.piso,
            th.nombre AS tipo_nombre,
            th.superficie,
            th.nrocamas,
            ih.imagen
        FROM habitaciones h
        INNER JOIN tipohabitacion th ON h.id_tipohabitacion = th.id
        LEFT JOIN imageneshabitaciones ih ON h.id_imagen = ih.id
        WHERE th.nombre = ? AND h.estado = 0
        ORDER BY ih.orden ASC";


    $stmt = $con->prepare($sql);
    $stmt->bind_param("s", $tipo);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        session_start();
       while ($fila = $resultado->fetch_assoc()) {
    echo '
    <div class="habitacion" style="border: 1px solid #ccc; margin: 15px; padding: 10px; border-radius: 8px; display: flex; flex-direction: column; max-width: 700px;">
        <div class="habitacion-imagen" style="text-align: center;">
            <img src="imagenes/' . htmlspecialchars($fila['imagen']) . '" alt="Habitación" style="max-width: 100%; height: auto; border-radius: 8px;">
        </div>

        <div class="habitacion-descripcion" style="padding: 10px 0;">
            <p>' . htmlspecialchars($fila['descripcion']) . '</p>
        </div>

        <div class="habitacion-detalle" style="display: flex; justify-content: space-between; gap: 20px; flex-wrap: wrap;">
            <div class="habitacion-info" style="flex: 1;">
                <p><strong>Tipo:</strong> ' . htmlspecialchars($fila['tipo_nombre']) . '</p>
                <p><strong>Piso:</strong> ' . htmlspecialchars($fila['piso']) . '</p>
                <p><strong>Número:</strong> ' . htmlspecialchars($fila['numero']) . '</p>
                <p><strong>Superficie:</strong> ' . htmlspecialchars($fila['superficie']) . ' m²</p>
                <p><strong>N° Camas:</strong> ' . htmlspecialchars($fila['nrocamas']) . '</p>
            </div>

            <div class="habitacion-reservar" style="display: flex; align-items: center;">';
            
            
            if (isset($_SESSION['id_usuario'])) {
                echo '<button onclick="abrirModalReserva(' . $fila['id_habitacion'] . ')" style="padding: 10px 15px;">Reservar</button>';
            } else {
                echo '<button onclick="abrirModal(\'login.html\')" style="padding: 10px 15px;">Iniciar sesión para reservar</button>';
            }

    echo '
            </div>
        </div>
    </div>';
}
    } else {
        echo "<p>No se encontraron habitaciones del tipo '$tipo'.</p>";
    }

    $stmt->close();
} else {
    echo "<p>Error: Tipo de habitación no recibido.</p>";
}
?>
