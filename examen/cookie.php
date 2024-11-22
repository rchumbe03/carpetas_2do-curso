<?php
include 'conexion.php';

// Función para obtener o crear una id_cookie
function getOrCreateCookieId($conn) {
    // Verificar si la cookie 'id_cookie' ya está establecida
    if (isset($_COOKIE['id_cookie'])) {
        return $_COOKIE['id_cookie'];
    }

    // Si no existe, crear una nueva id_cookie
    $fecha_actual = date('Y-m-d'); // Fecha actual
    $sql = "INSERT INTO Cookie (fecha) VALUES (?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $fecha_actual);

    if ($stmt->execute()) {
        $id_cookie = $stmt->insert_id;
        // Guardar id_cookie en la cookie con duración de 30 días
        setcookie('id_cookie', $id_cookie, time() + (30 * 24 * 60 * 60), "/");
        $stmt->close();
        return $id_cookie;
    }

    // En caso de error, mostrar mensaje y finalizar
    die("Error al crear id_cookie: " . $stmt->error);
}

// Obtener o crear la id_cookie
$id_cookie = getOrCreateCookieId($conn);

// Verificar que se pasó el parámetro id_tnoticia
if (isset($_GET['id_tnoticia'])) {
    $id_tnoticia = (int)$_GET['id_tnoticia']; // Convertir el valor a entero para evitar inyecciones SQL

    // Registrar la interacción en la tabla Cookie solo si el id_tnoticia es válido
    $sql = "INSERT INTO Cookie (id_tnoticia, id_cookie, fecha) VALUES (?, ?, ?)
            ON DUPLICATE KEY UPDATE id_tnoticia = VALUES(id_tnoticia)";
    $stmt = $conn->prepare($sql);
    $fecha_actual = date('Y-m-d'); // Fecha actual
    $stmt->bind_param("iis", $id_tnoticia, $id_cookie, $fecha_actual);

    if ($stmt->execute()) {
        echo "Interacción registrada correctamente.";
    } else {
        echo "Error al registrar la interacción: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
