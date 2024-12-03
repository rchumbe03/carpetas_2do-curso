<?php
include 'conexion.php';

$userId = 1; // Cambia esto según tu lógica de autenticación

// Borrar todos los productos del carrito para el usuario actual
$sql = "DELETE FROM Carrito WHERE id_usuario = $userId";
if ($conn->query($sql) === TRUE) {
    // Redirigir a index.php con un mensaje de éxito
    header("Location: ../index.php?message=productos_comprados");
    exit();
} else {
    echo "Error al vaciar el carrito: " . $conn->error;
}
?>