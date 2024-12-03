<?php
include 'conexion.php';

function getProducts($offset = 0, $limit = 5) {
    global $conn;
    $sql = "SELECT * FROM Producto LIMIT $offset, $limit";
    $result = $conn->query($sql);
    $products = [];

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $products[] = $row;
        }
    }
    return $products;
}

function searchProducts($searchTerm) {
    global $conn;
    $searchTerm = $conn->real_escape_string($searchTerm);
    $sql = "SELECT * FROM Producto WHERE nombre LIKE '%$searchTerm%' OR categoria LIKE '%$searchTerm%'";
    $result = $conn->query($sql);
    $products = [];

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $products[] = $row;
        }
    }
    return $products;
}

function getCartProducts($userId) {
    global $conn;
    $sql = "SELECT p.id_producto, p.nombre, p.categoria, p.precio, p.imagen_url, p.stock, c.cantidad 
            FROM Carrito c 
            JOIN Producto p ON c.id_producto = p.id_producto 
            WHERE c.id_usuario = $userId";
    $result = $conn->query($sql);
    $products = [];

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $products[] = $row;
        }
    }
    return $products;
}
?>