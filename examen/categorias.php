<?php
include 'conexion.php';

// Verifica si la conexión se ha realizado correctamente
if ($conn->connect_error) {
    die("Error en la conexión: " . $conn->connect_error);
}

$sql = "SELECT categoria FROM Tnoticia LIMIT 6";
$result = $conn->query($sql);

$categorias = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $categorias[] = $row['categoria'];
    }
} else {
    echo "No se encontraron categorías.";
}

$conn->close();
?>
