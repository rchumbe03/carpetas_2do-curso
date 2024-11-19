<?php
include 'conexion.php';

// Verifica si la conexión se ha realizado correctamente
if ($conn->connect_error) {
    die("Error en la conexión: " . $conn->connect_error);
}

// Consulta para mostrar las noticias
$sql = "SELECT n.noticia_id, n.Titulo, t.categoria 
        FROM Noticia n 
        JOIN Tnoticia t ON n.id_tnoticia = t.id_tnoticia";

// Consulta de búsqueda y filtrado por categoría
$search_query = ""; // Inicializa la búsqueda vacía
$filter_categoria = "";

if (isset($_GET['search'])) {
    $search_query = $conn->real_escape_string($_GET['search']);
}

if (isset($_GET['categoria'])) {
    $filter_categoria = $conn->real_escape_string($_GET['categoria']);
}

if ($search_query !== "") {
    $sql .= " WHERE n.Titulo LIKE '%$search_query%'"; // Filtrar por título que contenga el término de búsqueda
}

if ($filter_categoria !== "") {
    $sql .= ($search_query !== "" ? " AND" : " WHERE") . " t.categoria = '$filter_categoria'";
}

$sql .= " LIMIT 6"; // Limitar a 6 resultados

$result = $conn->query($sql);
?>