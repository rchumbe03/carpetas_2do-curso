<?php
// Incluir el archivo de conexión
include 'conexion.php';

// Consulta para obtener las 6 categorías de la tabla Tnoticia
$sql = "SELECT categoria FROM Tnoticia LIMIT 6";
$result = $conn->query($sql);

// Arreglo para almacenar las categorías
$categorias = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $categorias[] = $row['categoria'];
    }
}

// Cerrar conexión
$conn->close();
?>
