<?php
include 'conexion.php';

function getProducts() {
    global $conn;
    $sql = "SELECT * FROM Producto LIMIT 5";
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