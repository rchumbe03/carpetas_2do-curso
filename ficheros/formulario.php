<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Fichero</title>
</head>
<body>
    <h1>Contenido del Fichero</h1>
    <form action="" method="post">
        <textarea name="contenido" rows="5" cols="80"><?php echo ($_POST["contenido"]); ?></textarea>
        <br>
        <input type="submit" value="Actualizar">
    </form>
</body>
</html>