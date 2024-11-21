<?php
include 'conexion.php';

// Verifica si la conexión se ha realizado correctamente
if ($conn->connect_error) {
    die("Error en la conexión: " . $conn->connect_error);
}

// Obtener el id_cookie de la cookie (debería estar establecido previamente)
if (!isset($_COOKIE['id_cookie'])) {
    echo "No se ha detectado una cookie válida.";
    exit;
} else {
    $id_cookie = $_COOKIE['id_cookie'];
}

// Verificar cuántas noticias ha visitado el usuario para cada id_tnoticia
$sql_check_visited = "
    SELECT id_tnoticia, COUNT(*) as visit_count
    FROM Cookie
    WHERE id_cookie = ? 
    GROUP BY id_tnoticia
";
$stmt_check = $conn->prepare($sql_check_visited);
$stmt_check->bind_param("s", $id_cookie);
$stmt_check->execute();
$result_check = $stmt_check->get_result();

// Almacenar los id_tnoticia visitados y su cantidad de visitas
$visited_tnoticias = [];
while ($row = $result_check->fetch_assoc()) {
    $visited_tnoticias[$row['id_tnoticia']] = $row['visit_count'];
}

// Obtener los id_tnoticia de los que se ha visitado más de 5 veces
$tnoticias_to_return = [];
foreach ($visited_tnoticias as $id_tnoticia => $visit_count) {
    if ($visit_count >= 5) {
        $tnoticias_to_return[] = $id_tnoticia;
    }
}

// Consulta para mostrar las noticias
$sql = "SELECT n.noticia_id, n.Titulo, t.categoria, n.id_tnoticia 
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

// Construcción de las condiciones
$conditions = [];

// Agregar condición para el término de búsqueda
if ($search_query !== "") {
    $conditions[] = "n.Titulo LIKE '%$search_query%'";
}

// Agregar condición para el filtro por categoría
if ($filter_categoria !== "") {
    $conditions[] = "t.categoria = '$filter_categoria'";
}

// Agregar condición para priorizar noticias con 3 visitas
if (count($tnoticias_to_return) > 0 && $filter_categoria === "") {
    $tnoticias_to_return_str = implode(',', $tnoticias_to_return);
    $conditions[] = "n.id_tnoticia IN ($tnoticias_to_return_str)";
}

// Combinar todas las condiciones
if (count($conditions) > 0) {
    $sql .= " WHERE " . implode(" AND ", $conditions);
}

// Limitar a 6 resultados
$sql .= " LIMIT 6";

// Ejecutar la consulta
$result = $conn->query($sql);

if (!$result) {
    die("Error en la consulta: " . $conn->error);
}
?>
