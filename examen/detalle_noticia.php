<?php
include 'conexion.php';

if (isset($_GET['noticia_id'])) {
    $noticia_id = $conn->real_escape_string($_GET['noticia_id']);
    
    $sql = "SELECT n.Titulo, n.contenido, t.categoria 
            FROM Noticia n 
            JOIN Tnoticia t ON n.id_tnoticia = t.id_tnoticia 
            WHERE n.noticia_id = '$noticia_id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo "<h1>" . htmlspecialchars($row['Titulo']) . "</h1>";
        echo "<p><strong>Categoría:</strong> " . htmlspecialchars($row['categoria']) . "</p>";
        echo "<p>" . nl2br(htmlspecialchars($row['contenido'])) . "</p>"; 
    } else {
        echo "<p>Noticia no encontrada.</p>";
    }
} else {
    echo "<p>ID de noticia no proporcionado.</p>";
}
?>

