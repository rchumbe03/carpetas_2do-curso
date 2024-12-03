<?php
include 'conexion.php';

// Obtener los datos JSON enviados
$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['product_id']) && isset($data['quantity'])) {
    $productId = $data['product_id'];
    $quantity = $data['quantity'];
    $userId = 1; // Cambia esto según tu lógica de autenticación

    // Verificar la cantidad actual del producto en el carrito
    $sql = "SELECT cantidad FROM Carrito WHERE id_usuario = $userId AND id_producto = $productId";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $currentQuantity = $row['cantidad'];

        // Calcular la nueva cantidad
        $newQuantity = $currentQuantity - $quantity;

        if ($newQuantity > 0) {
            // Actualizar la cantidad del producto en el carrito
            $sql = "UPDATE Carrito SET cantidad = $newQuantity WHERE id_usuario = $userId AND id_producto = $productId";
        } else {
            // Eliminar el producto del carrito si la nueva cantidad es 0 o menor
            $sql = "DELETE FROM Carrito WHERE id_usuario = $userId AND id_producto = $productId";
        }

        if ($conn->query($sql) === TRUE) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => $conn->error]);
        }
    } else {
        echo json_encode(['success' => false, 'error' => 'Producto no encontrado en el carrito']);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'No product ID or quantity provided']);
}
?>