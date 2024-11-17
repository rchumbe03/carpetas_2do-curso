<?php
include 'conexion.php';

// Verifica si la conexión se ha realizado correctamente
if ($conn->connect_error) {
    die("Error en la conexión: " . $conn->connect_error);
}

// Consulta para obtener las categorías
$sql = "SELECT DISTINCT categoria FROM Tnoticia";
$result = $conn->query($sql);

$categorias = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $categorias[] = $row['categoria'];
    }
}

// Cerrar conexión
$conn->close();
?>
