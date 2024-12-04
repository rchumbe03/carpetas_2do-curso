<?php
include 'funcion_php/conexion.php';

$correo = $contrasena = "";
$correoErr = $contrasenaErr = $loginErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validar correo electrónico
    if (empty($_POST["correo"])) {
        $correoErr = "El correo electrónico es obligatorio";
    } else {
        $correo = test_input($_POST["correo"]);
        if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
            $correoErr = "Formato de correo electrónico inválido";
        }
    }

    // Validar contraseña
    if (empty($_POST["contrasena"])) {
        $contrasenaErr = "La contraseña es obligatoria";
    } else {
        $contrasena = test_input($_POST["contrasena"]);
    }

    // Si no hay errores, verificar en la base de datos
    if (empty($correoErr) && empty($contrasenaErr)) {
        $sql = "SELECT * FROM Usuario WHERE correo = '$correo'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if (password_verify($contrasena, $row['contrasena'])) {
                // Redirigir a index.php con un mensaje de éxito
                header("Location: index.php");
                exit();
            } else {
                $loginErr = "Correo electrónico o contraseña incorrectos";
            }
        } else {
            $loginErr = "Correo electrónico o contraseña incorrectos";
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
    <link rel="stylesheet" href="styles/styles_l.css">
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
                Iniciar sesión
            </div>
            <div class="container-content">
                <?php if (isset($_GET['message']) && $_GET['message'] == 'registro_exitoso'): ?>
                    <div class="success-message">
                        Registro realizado con éxito
                    </div>
                <?php endif; ?>
                <?php if (!empty($loginErr)): ?>
                    <div class="error-message">
                        <?php echo $loginErr; ?>
                    </div>
                <?php endif; ?>
                <form class="frame-container" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                    <div class="frame-label">
                        <div class="label-text">
                            Correo electrónico
                        </div>
                        <input type="text" class="input-text" name="correo" value="<?php echo $correo;?>">
                        <span class="error"><?php echo $correoErr;?></span>
                    </div>
                    <div class="frame-label">
                        <div class="label-text">
                            Contraseña
                        </div>
                        <input type="password" class="input-text" name="contrasena">
                        <span class="error"><?php echo $contrasenaErr;?></span>
                    </div>
                    <div class="text-box-right">
                        ¿Has olvidado la contraseña?
                    </div>
                    <button type="submit" class="submit-button">Iniciar sesión</button>
                </form>
                <div class="text-box-center">
                    <a href="registro.php">Crear una cuenta</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>