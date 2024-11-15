<?php
// Incluir el archivo de conexión
include 'conexion.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Noticias</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Lista de Noticias</h1>

    <?php
    if ($result->num_rows > 0) {
        // Mostrar cada fila de resultados
        while($row = $result->fetch_assoc()) {
            echo "<div class='noticia'>";
            echo "<div class='titulo'>" . htmlspecialchars($row['Titulo']) . "</div>";
            echo "<div class='categoria'>Categoría: " . htmlspecialchars($row['categoria']) . "</div>";
            echo "</div>";
        }
    } else {
        echo "<p>No se encontraron noticias.</p>";
    }

    // Cerrar conexión
    $conn->close();
    ?>
</body>
</html>