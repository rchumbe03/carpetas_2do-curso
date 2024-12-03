<?php
include 'conexion.php';

if (isset($_GET['product_id'])) {
    $productId = $_GET['product_id'];
    $userId = 1; // Cambia esto según tu lógica de autenticación

    $sql = "DELETE FROM Carrito WHERE id_usuario = $userId AND id_producto = $productId";
    if ($conn->query($sql) === TRUE) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => $conn->error]);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'No product ID provided']);
}
?>