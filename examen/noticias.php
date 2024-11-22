<?php
include 'conexion.php';

// Verificar si la conexión fue exitosa
if ($conn->connect_error) {
    die("Error en la conexión: " . $conn->connect_error);
}

// Obtener el id_cookie desde la cookie
$id_cookie = $_COOKIE['id_cookie'] ?? null;

if (!$id_cookie) {
    echo "No se ha detectado una cookie válida.";
    exit;
}

// Verificar cuántas noticias ha visitado el usuario por categoría
$sql_check_visited = "
    SELECT id_tnoticia, COUNT(*) AS visit_count
    FROM Cookie
    WHERE id_cookie = ? 
    GROUP BY id_tnoticia
";
$stmt_check = $conn->prepare($sql_check_visited);
$stmt_check->bind_param("s", $id_cookie);
$stmt_check->execute();
$result_check = $stmt_check->get_result();

// Crear un array con categorías visitadas más de 5 veces
$tnoticias_to_return = [];
while ($row = $result_check->fetch_assoc()) {
    if ($row['visit_count'] >= 5) {
        $tnoticias_to_return[] = $row['id_tnoticia'];
    }
}
$stmt_check->close();

// Inicializar la consulta de noticias
$sql = "
    SELECT 
        n.noticia_id, 
        n.Titulo, 
        t.categoria, 
        n.id_tnoticia 
    FROM Noticia n 
    JOIN Tnoticia t ON n.id_tnoticia = t.id_tnoticia
";

// Manejo de filtros: búsqueda, categoría y categorías visitadas
$conditions = [];
$params = [];
$types = "";

// Filtro por búsqueda
if (!empty($_GET['search'])) {
    $search_query = "%" . $_GET['search'] . "%";
    $conditions[] = "n.Titulo LIKE ?";
    $params[] = $search_query;
    $types .= "s";
}

// Filtro por categoría
if (!empty($_GET['categoria'])) {
    $filter_categoria = $_GET['categoria'];
    $conditions[] = "t.categoria = ?";
    $params[] = $filter_categoria;
    $types .= "s";
}

// Priorizar categorías visitadas más de 5 veces (si no hay filtro de categoría explícito)
if (!empty($tnoticias_to_return) && empty($_GET['categoria'])) {
    $placeholders = implode(",", array_fill(0, count($tnoticias_to_return), "?"));
    $conditions[] = "n.id_tnoticia IN ($placeholders)";
    $params = array_merge($params, $tnoticias_to_return);
    $types .= str_repeat("i", count($tnoticias_to_return));
}

// Combinar condiciones
if (!empty($conditions)) {
    $sql .= " WHERE " . implode(" AND ", $conditions);
}

// Limitar resultados
$sql .= " LIMIT 8";

// Preparar y ejecutar la consulta
$stmt = $conn->prepare($sql);
if ($stmt === false) {
    die("Error al preparar la consulta: " . $conn->error);
}

if (!empty($params)) {
    $stmt->bind_param($types, ...$params);
}

$stmt->execute();
$result = $stmt->get_result();

if (!$result) {
    die("Error en la consulta: " . $stmt->error);
}

// Cerrar la conexión
$stmt->close();
$conn->close();
?>
