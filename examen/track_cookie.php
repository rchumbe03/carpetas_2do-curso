<?php
include 'conexion.php';

// Recuperar datos enviados mediante AJAX
$data = json_decode(file_get_contents("php://input"), true);

if (isset($data['id_noticia'], $data['id_tnoticia'], $data['fecha'])) {
    $id_noticia = intval($data['id_noticia']);
    $id_tnoticia = intval($data['id_tnoticia']);
    $fecha = $conn->real_escape_string($data['fecha']);

    // Verificar si existe una cookie
    if (!isset($_COOKIE['id_cookie'])) {
        // Crear nueva cookie
        $stmt = $conn->prepare("INSERT INTO Cookie (id_tnoticia, fecha) VALUES (?, ?)");
        $stmt->bind_param("is", $id_tnoticia, $fecha);
        $stmt->execute();

        // Obtener el ID generado
        $id_cookie = $conn->insert_id;
        setcookie("id_cookie", $id_cookie, time() + (86400 * 30), "/"); // Duración 30 días
        $stmt->close();
    } else {
        // Recuperar cookie existente
        $id_cookie = intval($_COOKIE['id_cookie']);
    }

    // Verificar si ya existe la combinación de id_cookie, id_tnoticia y fecha
    $stmt = $conn->prepare("SELECT COUNT(*) FROM Cookie WHERE id_cookie = ? AND id_tnoticia = ? AND fecha = ?");
    $stmt->bind_param("iis", $id_cookie, $id_tnoticia, $fecha);
    $stmt->execute();
    $stmt->bind_result($count);
    $stmt->fetch();
    $stmt->close();

    if ($count == 0) {
        // Si no existe, insertar una nueva fila
        $stmt = $conn->prepare("INSERT INTO Cookie (id_cookie, id_tnoticia, fecha) VALUES (?, ?, ?)");
        $stmt->bind_param("iis", $id_cookie, $id_tnoticia, $fecha);
        if ($stmt->execute()) {
            echo json_encode(["status" => "success", "id_cookie" => $id_cookie]);
        } else {
            echo json_encode(["status" => "error", "message" => "Error al registrar visita"]);
        }
        $stmt->close();
    } else {
        echo json_encode(["status" => "info", "message" => "Visita ya registrada anteriormente"]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Datos incompletos"]);
}
?>
