<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito</title>
    <link rel="stylesheet" href="styles/styles_c.css">
</head>
<body>
    <header class="header">
        <div class="container">
            <!-- Logo -->
            <a href="index.php">
                <div class="header-logo">
                    <img src="img/logo.png" alt="logo">
                </div>
            </a>
    
            <div class="table">
                <a href="index.php">Inicio</a>
                <a href="carrito.php">Carrito</a>
                <a href="login.php">Login</a>
                <a href="registro.php">Registrate</a>
            </div>
    
            <!-- Barra de búsqueda -->
            <form class="search-bar" method="GET" action="carrito.php">
                <input type="text" name="search" placeholder="Buscar...">
            </form>
        </div>
    </header>

    <!-- Texto con las especificaciones dadas -->
    <div class="custom-text">
        Carrito de compras
    </div>

    <!-- Contenedor principal -->
    <div class="main-container">
        <!-- Contenedor con las especificaciones dadas -->
        <div class="custom-container">
            <div class="custom-frame">
                <div class="frame-img">
                    <img src="image.png" alt="Imagen">
                </div>
                <div class="content-frame">
                    <!-- Frame descripción dentro del frame contenido -->
                    <div class="description-frame">
                        <div class="small-text-box">Texto pequeño</div>
                        <div class="large-text-box">Texto grande</div>
                    </div>
                    <div class="icon-frame">
                        <div class="img-icon">
                            <img src="img/icon.png" alt="Icono">
                        </div>
                    </div>
                    <div class="additional-frame">
                        <div class="text-box-small">Texto pequeño adicional</div>
                        <div class="text-box-large">0,00$</div>
                    </div>
                </div>
            </div>
            <div class="line-main"></div>
            <div class="custom-frame">
                <div class="frame-img">
                    <img src="image.png" alt="Imagen">
                </div>
                <div class="content-frame">
                    <!-- Frame descripción dentro del frame contenido -->
                    <div class="description-frame">
                        <div class="small-text-box">Texto pequeño</div>
                        <div class="large-text-box">Texto grande</div>
                    </div>
                    <div class="icon-frame">
                        <div class="img-icon">
                            <img src="img/icon.png" alt="Icono">
                        </div>
                    </div>
                    <div class="additional-frame">
                        <div class="text-box-small">Texto pequeño adicional</div>
                        <div class="text-box-large">0,00$</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Nuevo contenedor a la derecha -->
        <div class="side-container">
            <div class="frame-button">
                <div class="text-box">Texto del botón</div>
                <button class="button">Botón</button>
            </div>
            <div class="line-side"></div>
            <div class="precio-frame">
                <div class="text-box-small">Texto pequeño adicional</div>
                <div class="text-box-large">0,00$</div>
            </div>
        </div>
    </div>
</body>
</html>