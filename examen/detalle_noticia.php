<?php
// Asegúrate de tener una conexión a la base de datos
include 'conexion.php';

// Obtener los parámetros de la URL
$noticia_id = isset($_GET['noticia_id']) ? intval($_GET['noticia_id']) : 0;
$id_tnoticia = isset($_GET['id_tnoticia']) ? intval($_GET['id_tnoticia']) : 0;

// Verificar si los parámetros están presentes
if ($noticia_id > 0 && $id_tnoticia > 0) {
    // Obtener los detalles de la noticia
    $sql = "SELECT n.Titulo, n.Contenido, t.categoria 
            FROM Noticia n 
            JOIN Tnoticia t ON n.id_tnoticia = t.id_tnoticia 
            WHERE n.noticia_id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $noticia_id);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($titulo, $contenido, $categoria);
    $stmt->fetch();
    $stmt->close();
} else {
    // Si no se encuentra la noticia, redirigir o mostrar un error
    echo "Noticia no encontrada.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle de Noticia</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<!-- Header de la noticia -->
<header>
    <h1><?php echo htmlspecialchars($titulo); ?></h1>
    <div class="categoria">Categoría: <?php echo htmlspecialchars($categoria); ?></div>
</header>

<!-- Contenido de la noticia -->
<div class="contenido">
    <p><?php echo nl2br(htmlspecialchars($contenido)); ?></p>
</div>

<script>
// Función AJAX para enviar la visita a la noticia
function trackVisit(id_tnoticia, noticia_id) {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "track_cookie.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    // Datos a enviar al servidor
    var data = "id_tnoticia=" + id_tnoticia + "&noticia_id=" + noticia_id;

    // Enviar la solicitud
    xhr.send(data);

    // Manejar la respuesta del servidor
    xhr.onload = function() {
        if (xhr.status == 200) {
            console.log(xhr.responseText);  // Mostrar respuesta del servidor
        } else {
            console.error("Error: " + xhr.status);
        }
    };
}

// Llamar a la función cuando el usuario visita una noticia
// Pasar el id_tnoticia y noticia_id como parámetros
trackVisit(<?php echo $id_tnoticia; ?>, <?php echo $noticia_id; ?>);
</script>

</body>
</html>
