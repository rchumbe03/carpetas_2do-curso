<?php
include 'conexion.php';

// Obtener los datos JSON enviados
$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['product_id']) && isset($data['quantity'])) {
    $productId = $data['product_id'];
    $quantity = $data['quantity'];
    $userId = 1; // Cambia esto según tu lógica de autenticación

    // Verificar si el producto ya está en el carrito
    $sql = "SELECT * FROM Carrito WHERE id_usuario = $userId AND id_producto = $productId";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Actualizar la cantidad del producto en el carrito
        $sql = "UPDATE Carrito SET cantidad = cantidad + $quantity WHERE id_usuario = $userId AND id_producto = $productId";
    } else {
        // Insertar el producto en el carrito
        $sql = "INSERT INTO Carrito (id_usuario, id_producto, cantidad) VALUES ($userId, $productId, $quantity)";
    }

    if ($conn->query($sql) === TRUE) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => $conn->error, 'sql' => $sql]);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'No product ID or quantity provided']);
}
?>