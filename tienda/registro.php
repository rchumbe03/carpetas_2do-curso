<?php
include 'funcion_php/conexion.php';

$nombre = $correo = $contrasena = "";
$nombreErr = $correoErr = $contrasenaErr = "";
$contrasenaMinLengthErr = $contrasenaNumberErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validar nombre
    if (empty($_POST["nombre"])) {
        $nombreErr = "El nombre es obligatorio";
    } else {
        $nombre = test_input($_POST["nombre"]);
        if (strlen($nombre) > 15) {
            $nombreErr = "El nombre no puede tener más de 15 caracteres";
        }
    }

    // Validar correo electrónico
    if (empty($_POST["correo"])) {
        $correoErr = "El correo electrónico es obligatorio";
    } else {
        $correo = test_input($_POST["correo"]);
        if (!filter_var($correo, FILTER_VALIDATE_EMAIL) || (!str_ends_with($correo, "@gmail.com") && !str_ends_with($correo, "@hotmail.com"))) {
            $correoErr = "El correo electrónico debe ser @gmail.com o @hotmail.com";
        }
    }

    // Validar contraseña
    if (empty($_POST["contrasena"])) {
        $contrasenaErr = "La contraseña es obligatoria";
    } else {
        $contrasena = test_input($_POST["contrasena"]);
        if (strlen($contrasena) < 8) {
            $contrasenaMinLengthErr = "La contraseña debe tener al menos 8 caracteres";
        }
        if (!preg_match("/[1-9]/", $contrasena)) {
            $contrasenaNumberErr = "La contraseña debe contener al menos un número del 1 al 9";
        }
    }

    // Si no hay errores, insertar en la base de datos
    if (empty($nombreErr) && empty($correoErr) && empty($contrasenaErr) && empty($contrasenaMinLengthErr) && empty($contrasenaNumberErr)) {
        $contrasena = password_hash($contrasena, PASSWORD_DEFAULT); // Encriptar la contraseña
        $sql = "INSERT INTO Usuario (nombre, correo, contrasena) VALUES ('$nombre', '$correo', '$contrasena')";
        if ($conn->query($sql) === TRUE) {
            // Redirigir a login.php con un mensaje de éxito
            header("Location: login.php?message=registro_exitoso");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito</title>
    <link rel="stylesheet" href="styles/styles_r.css">
    <script src="script/validacion.js" defer></script>
</head>
<body>
    <header class="header">
        <!-- Logo -->
        <a href="login.php">
            <div class="header-logo">
                <img src="img/logo.png" alt="logo">
            </div>
        </a>
    </header>
    
    <div class="main-container">
        <div class="text-box">
            EMPIEZA TUS COMPRAS EN CARRITO
        </div>
        <div class="container-form">
            <div class="text-box-form">
                Crear una cuenta
            </div>
            <div class="container-content">
                <form class="frame-container" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                    <div class="frame-label">
                        <div class="label-text">
                            Nombre
                        </div>
                        <input type="text" class="input-text" name="nombre" value="<?php echo $nombre;?>">
                        <span class="error nombre-error"><?php echo $nombreErr;?></span>
                    </div>
                    <div class="frame-label">
                        <div class="label-text">
                            Correo electrónico
                        </div>
                        <input type="text" class="input-text" name="correo" value="<?php echo $correo;?>">
                        <span class="error correo-error"><?php echo $correoErr;?></span>
                    </div>
                    <div class="frame-label">
                        <div class="label-text">
                            Contraseña
                        </div>
                        <input type="password" class="input-text" name="contrasena">
                        <span class="error contrasena-error"><?php echo $contrasenaErr;?></span>
                    </div>
                    <div class="text-box-right <?php echo !empty($contrasenaMinLengthErr) ? 'error-text' : ''; ?>">
                        Al menos 8 caracteres
                    </div>
                    <div class="text-box-right <?php echo !empty($contrasenaNumberErr) ? 'error-text' : ''; ?>">
                        Al menos un número del 1 al 9
                    </div>
                    <button type="submit" class="submit-button">Registrarse</button>
                </form>
                <div class="text-box-center">
                    <a href="login.php">Inicia sesión</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>