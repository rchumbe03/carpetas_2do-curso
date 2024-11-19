<?php
include 'conexion.php';

// Verificar si ya existe una cookie en el navegador
if (isset($_COOKIE['user_cookie'])) {
    // Recuperar la cookie existente
    $id_cookie = $_COOKIE['user_cookie'];

    // Comprobar si la cookie existe en la base de datos
    $sql = "SELECT * FROM Cookie WHERE id_cookie = '$id_cookie'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // La cookie ya está registrada, no hacemos nada
        $cookie_data = $result->fetch_assoc();
    } else {
        // Si la cookie no existe en la base de datos, se genera una nueva
        createNewCookie();
    }
} else {
    // Si no hay cookie en el navegador, se genera una nueva
    createNewCookie();
}

// Función para crear una nueva cookie
function createNewCookie() {
    global $conn;
    $id_cookie = uniqid(); // Generar un ID único para la cookie
    $fecha = date("Y-m-d"); // Fecha actual

    // Insertar la nueva cookie en la base de datos con id_tnoticia como NULL
    $sql = "INSERT INTO Cookie (id_cookie, id_tnoticia, fecha) VALUES ('$id_cookie', NULL, '$fecha')";

    if ($conn->query($sql) === TRUE) {
        // Guardar la cookie en el navegador, válida por 30 días
        setcookie('user_cookie', $id_cookie, time() + (30 * 24 * 60 * 60), "/");
    } else {
        die("Error al insertar cookie: " . $conn->error);
    }
}
?>
