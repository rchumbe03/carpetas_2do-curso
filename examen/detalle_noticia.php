<?php
include 'conexion.php';

if (isset($_GET['noticia_id'])) {
    $noticia_id = $conn->real_escape_string($_GET['noticia_id']);
    
    $sql = "SELECT n.Titulo, t.categoria, n.id_tnoticia 
            FROM Noticia n 
            JOIN Tnoticia t ON n.id_tnoticia = t.id_tnoticia 
            WHERE n.noticia_id = '$noticia_id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo "<h1>" . htmlspecialchars($row['Titulo']) . "</h1>";
        echo "<p>Categoría: " . htmlspecialchars($row['categoria']) . "</p>";
        // Agrega más detalles si es necesario
    } else {
        echo "<p>Noticia no encontrada.</p>";
    }
} else {
    echo "<p>ID de noticia no proporcionado.</p>";
}
?>
