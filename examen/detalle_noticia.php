<?php
include 'conexion.php';

// Verificar si se proporcionó un ID de noticia
if (!isset($_GET['noticia_id']) || !isset($_GET['id_tnoticia'])) {
    die("No se especificó una noticia válida.");
}

$noticia_id = intval($_GET['noticia_id']);
$id_tnoticia = intval($_GET['id_tnoticia']);

// Obtener datos de la noticia
$sql = "SELECT n.Titulo, n.Contenido, t.categoria 
        FROM Noticia n 
        JOIN Tnoticia t ON n.id_tnoticia = t.id_tnoticia 
        WHERE n.noticia_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $noticia_id);
$stmt->execute();
$result = $stmt->get_result();
$noticia = $result->fetch_assoc();
$stmt->close();

if (!$noticia) {
    die("La noticia no existe.");
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($noticia['Titulo']); ?></title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <!-- Aquí puedes agregar el header si es necesario -->
    </header>

    <main>
        <div class="noticia-detalle">
            <h1><?php echo htmlspecialchars($noticia['Titulo']); ?></h1>
            <p class="categoria">Categoría: <?php echo htmlspecialchars($noticia['categoria']); ?></p>
            <div class="contenido">
                <?php echo nl2br(htmlspecialchars($noticia['Contenido'])); ?>
            </div>
        </div>
    </main>

    <script>
        // Código AJAX para registrar la visita
        document.addEventListener("DOMContentLoaded", () => {
            const idNoticia = <?php echo json_encode($noticia_id); ?>;
            const idTnoticia = <?php echo json_encode($id_tnoticia); ?>;
            const fecha = new Date().toISOString().split('T')[0]; // Fecha actual en formato YYYY-MM-DD

            const data = {
                id_noticia: idNoticia,
                id_tnoticia: idTnoticia,
                fecha: fecha
            };

            fetch('track_cookie.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data)
            })
            .then(response => response.json())
            .then(result => {
                if (result.status === "success") {
                    console.log("Visita registrada correctamente. ID Cookie:", result.id_cookie);
                } else if (result.status === "info") {
                    console.log(result.message);
                } else {
                    console.error("Error al registrar visita:", result.message);
                }
            })
            .catch(error => console.error("Error en la solicitud AJAX:", error));
        });
    </script>
</body>
</html>
