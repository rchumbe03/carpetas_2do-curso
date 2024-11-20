<?php
include 'conexion.php';
include 'cookie.php';
include 'noticias.php';
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
    <header class="header">
        <div class="container">
            <!-- Barra de búsqueda -->
            <form class="search-bar" method="GET" action="formulario.php">
                <input type="text" name="search" placeholder="Buscar...">
            </form>

            <!-- Logo -->
            <a href="formulario.php">
                <div>
                    <img src="img/logo.png" alt="logo">
                </div>
            </a>

            <!-- Iconos -->
            <div class="icons">
                <div class="icon">
                    <img src="img/icons/icon1.png" alt="Icono 1">
                </div>
                <div class="icon">
                    <img src="img/icons/icon2.png" alt="Icono 2">
                </div>
                <div class="icon">
                    <img src="img/icons/icon3.png" alt="Icono 3">
                </div>
                <div class="icon">
                    <img src="img/icons/icon4.png" alt="Icono 4">
                </div>
            </div>
        </div>
    </header>
    
    <?php include 'categorias.php'; ?>

    <!-- Contenedor de categorías -->
    <div class="contenedor-categorias">
        <div class="cuadro-categorias">
            <?php
            foreach ($categorias as $categoria) {
                echo "<a href='formulario.php?categoria=" . urlencode($categoria) . "' class='categoria-texto'>" . htmlspecialchars($categoria) . "</a>";
            }
            ?>
        </div>
    </div>

    <?php include 'noticias.php'; ?>

    <!-- Mostrar las noticias -->
    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            // Obtener id_tnoticia directamente de la consulta
            $id_tnoticia = $row['id_tnoticia'];

            // Generar el enlace dinámico para la noticia
            echo "<a href='detalle_noticia.php?noticia_id=" . $row['noticia_id'] . "&id_tnoticia=" . $id_tnoticia . "' class='enlace-noticia'>";
            echo "<div class='noticia'>";
            echo "<div class='titulo'>" . htmlspecialchars($row['Titulo']) . "</div>";
            echo "<div class='categoria'>Categoría: " . htmlspecialchars($row['categoria']) . "</div>";
            echo "</div>";
            echo "</a>";
        }
    } else {
        echo "<p>No se encontraron noticias.</p>";
    }
    ?>
</body>
</html>