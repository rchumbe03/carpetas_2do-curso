<?php
include 'conexion.php';

// Verificar si la cookie id_cookie ya está establecida
if (!isset($_COOKIE['id_cookie'])) {
    // Crear un id_cookie único si no existe
    $id_cookie = uniqid(); // Genera un ID único para el usuario
    setcookie('id_cookie', $id_cookie, time() + (86400 * 30), "/"); // Válido por 30 días
} else {
    // Recuperar el id_cookie desde las cookies si ya existe
    $id_cookie = $_COOKIE['id_cookie'];
}

// Obtener los datos enviados por AJAX
$id_tnoticia = isset($_POST['id_tnoticia']) ? intval($_POST['id_tnoticia']) : 0;
$noticia_id = isset($_POST['noticia_id']) ? intval($_POST['noticia_id']) : 0;

// Verificar si los datos son válidos
if ($id_tnoticia > 0 && $noticia_id > 0 && $id_cookie) {
    // Verificar si ya existe un registro de esa visita con el mismo id_cookie, id_tnoticia y noticia_id
    $sql_check = "SELECT * FROM Cookie WHERE id_cookie = ? AND id_tnoticia = ? AND noticia_id = ?";
    $stmt_check = $conn->prepare($sql_check);
    $stmt_check->bind_param("sii", $id_cookie, $id_tnoticia, $noticia_id);
    $stmt_check->execute();
    $stmt_check->store_result();

    // Si no hay un registro previo para esa visita, insertamos una nueva fila
    if ($stmt_check->num_rows == 0) {
        $stmt_check->close();

        // Insertar un nuevo registro de visita en la tabla Cookie
        $stmt_insert = $conn->prepare("INSERT INTO Cookie (id_cookie, id_tnoticia, fecha, noticia_id) VALUES (?, ?, ?, ?)");
        $fecha_actual = date('Y-m-d'); // Fecha actual
        $stmt_insert->bind_param("sisi", $id_cookie, $id_tnoticia, $fecha_actual, $noticia_id);

        // Ejecutar la inserción
        if ($stmt_insert->execute()) {
            echo "Visita registrada con éxito.";
        } else {
            echo "Error al registrar la visita: " . $stmt_insert->error;
        }

        $stmt_insert->close();
    } else {
        // Si ya existe, indicar que no se insertará el registro
        echo "Esta visita ya ha sido registrada previamente.";
    }
} else {
    echo "Error: Datos inválidos.";
}

// Cerrar la conexión
$conn->close();
?>
