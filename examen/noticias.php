<?php
include 'conexion.php';

// Verifica si la conexión se ha realizado correctamente
if ($conn->connect_error) {
    die("Error en la conexión: " . $conn->connect_error);
}

// Consulta de búsqueda y filtrado por categoría
$search_query = "";
$filter_categoria = "";

if (isset($_GET['search'])) {
    $search_query = $conn->real_escape_string($_GET['search']);
}

if (isset($_GET['categoria'])) {
    $filter_categoria = $conn->real_escape_string($_GET['categoria']);
}

// Construir la consulta SQL
$sql = "SELECT n.Titulo, t.categoria 
        FROM Noticia n 
        JOIN Tnoticia t ON n.id_tnoticia = t.id_tnoticia";

if ($search_query !== "") {
    $sql .= " WHERE n.Titulo LIKE '%$search_query%'";
}

if ($filter_categoria !== "") {
    $sql .= ($search_query !== "" ? " AND" : " WHERE") . " t.categoria = '$filter_categoria'";
}

$result = $conn->query($sql);
?>
