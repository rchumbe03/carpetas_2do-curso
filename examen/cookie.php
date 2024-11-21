<?php
include 'conexion.php';

// Generar una nueva id_cookie si no existe
if (!isset($_COOKIE['id_cookie'])) {
    // Crear un registro en la tabla Cookie y guardar id_cookie en una cookie
    $sql = "INSERT INTO Cookie (fecha) VALUES (?)";
    $stmt = $conn->prepare($sql);
    $fecha_actual = date('Y-m-d'); // Fecha actual
    $stmt->bind_param("s", $fecha_actual);

    if ($stmt->execute()) {
        // Recuperar el id_cookie generado
        $id_cookie = $stmt->insert_id;
        // Guardar id_cookie en una cookie con duración de 30 días
        setcookie('id_cookie', $id_cookie, time() + (30 * 24 * 60 * 60), "/");
    } else {
        die("Error al crear id_cookie: " . $stmt->error);
    }
    $stmt->close();
} else {
    // Usar la id_cookie existente de la cookie
    $id_cookie = $_COOKIE['id_cookie'];
}

// Verificar que se pasó el id_tnoticia
if (isset($_GET['id_tnoticia'])) {
    $id_tnoticia = intval($_GET['id_tnoticia']); // Asegurar que sea un entero

    // Registrar la interacción en la tabla Cookie con el id_tnoticia
    $sql = "UPDATE Cookie SET id_tnoticia = ? WHERE id_cookie = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $id_tnoticia, $id_cookie);

    if ($stmt->execute()) {
        echo "Noticia registrada correctamente para la cookie.";
    } else {
        echo "Error al registrar la noticia: " . $stmt->error;
    }
    $stmt->close();
}

$conn->close();
?>
