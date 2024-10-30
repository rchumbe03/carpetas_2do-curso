<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Fichero</title>
</head>
<body>
    <h1>Contenido del Fichero</h1>
    <form action="" method="post">
        <textarea name="contenido" rows="5" cols="80"><?php echo htmlspecialchars($contenido); ?></textarea><br>
        <button type="submit">Actualizar</button>
    </form>
</body>
</html>