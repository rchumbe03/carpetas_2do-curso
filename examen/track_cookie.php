<?php
include 'conexion.php';

// Verificar o generar un id_cookie único
if (!isset($_COOKIE['id_cookie'])) {
    // Generar un id_cookie único
    $id_cookie = uniqid(); // ID único para el usuario
    setcookie('id_cookie', $id_cookie, time() + (30 * 86400), "/"); // Cookie válida por 30 días
} else {
    // Recuperar el id_cookie existente
    $id_cookie = $_COOKIE['id_cookie'];
}

// Obtener los datos enviados por AJAX
$id_tnoticia = filter_input(INPUT_POST, 'id_tnoticia', FILTER_VALIDATE_INT);
$noticia_id = filter_input(INPUT_POST, 'noticia_id', FILTER_VALIDATE_INT);

// Validar los datos
if ($id_tnoticia && $noticia_id) {
    // Verificar si ya existe un registro de visita
    $sql_check = "SELECT 1 FROM Cookie WHERE id_cookie = ? AND id_tnoticia = ? AND noticia_id = ?";
    $stmt_check = $conn->prepare($sql_check);
    $stmt_check->bind_param("sii", $id_cookie, $id_tnoticia, $noticia_id);
    $stmt_check->execute();
    $stmt_check->store_result();

    if ($stmt_check->num_rows === 0) {
        // No existe registro previo, insertar uno nuevo
        $stmt_check->close();

        $sql_insert = "INSERT INTO Cookie (id_cookie, id_tnoticia, fecha, noticia_id) VALUES (?, ?, ?, ?)";
        $stmt_insert = $conn->prepare($sql_insert);
        $fecha_actual = date('Y-m-d'); // Fecha actual
        $stmt_insert->bind_param("sisi", $id_cookie, $id_tnoticia, $fecha_actual, $noticia_id);

        if ($stmt_insert->execute()) {
            echo "Visita registrada con éxito.";
        } else {
            echo "Error al registrar la visita: " . $stmt_insert->error;
        }

        $stmt_insert->close();
    } else {
        echo "Esta visita ya ha sido registrada previamente.";
        $stmt_check->close();
    }
} else {
    echo "Error: Datos inválidos.";
}

// Cerrar la conexión
$conn->close();
?>
