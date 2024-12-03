<?php
include 'conexion.php';
include 'get_product.php';
$products = getProducts();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito</title>
    <link rel="stylesheet" href="styles/styles.css">
    <script src="script/producto.js" defer></script>
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
                <a href="carrito.html">Carrito</a>
                <a href="login.html">Login</a>
                <a href="registro.html">Registrate</a>
            </div>

            <!-- Barra de búsqueda -->
            <form class="search-bar" method="GET" action="index.php">
                <input type="text" name="search" placeholder="Buscar...">
            </form>
        </div>
    </header>
    
    <!-- 1er Contenedor con 5 frames -->
    <div class="frame-container">
        <?php foreach ($products as $product): ?>
        <div class="frame">
            <div class="image-container">
                <img src="<?php echo $product['imagen_url']; ?>" alt="<?php echo $product['nombre']; ?>" class="product-image">
            </div>
            <div class="text-frame">
                <p class="small-text"><?php echo $product['categoria']; ?></p>
                <p class="large-text"><?php echo $product['nombre']; ?></p>
            </div>
            <div class="price-button-frame">
                <button class="add-button">Añadir</button>
                <p class="price-text"><?php echo number_format($product['precio'], 2); ?>$</p>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    <!-- 2do Contenedor con 5 frames -->
    <div class="frame-container">
        <div class="frame">
            <div class="image-container"></div>
            <div class="text-frame">
                <p class="small-text">Texto pequeño</p>
                <p class="large-text">Texto grande</p>
            </div>
            <div class="price-button-frame">
                <button class="add-button">Añadir</button>
                <p class="price-text">0,00$</p>
            </div>
        </div>
        <div class="frame">
            <div class="image-container"></div>
            <div class="text-frame">
                <p class="small-text">Texto pequeño</p>
                <p class="large-text">Texto grande</p>
            </div>
            <div class="price-button-frame">
                <button class="add-button">Añadir</button>
                <p class="price-text">0,00$</p>
            </div>
        </div>
        <div class="frame">
            <div class="image-container"></div>
            <div class="text-frame">
                <p class="small-text">Texto pequeño</p>
                <p class="large-text">Texto grande</p>
            </div>
            <div class="price-button-frame">
                <button class="add-button">Añadir</button>
                <p class="price-text">0,00$</p>
            </div>
        </div>
        <div class="frame">
            <div class="image-container"></div>
            <div class="text-frame">
                <p class="small-text">Texto pequeño</p>
                <p class="large-text">Texto grande</p>
            </div>
            <div class="price-button-frame">
                <button class="add-button">Añadir</button>
                <p class="price-text">0,00$</p>
            </div>
        </div>
        <div class="frame">
            <div class="image-container"></div>
            <div class="text-frame">
                <p class="small-text">Texto pequeño</p>
                <p class="large-text">Texto grande</p>
            </div>
            <div class="price-button-frame">
                <button class="add-button">Añadir</button>
                <p class="price-text">0,00$</p>
            </div>
        </div>
    </div>
    <!-- 3er Contenedor con 5 frames -->
    <div class="frame-container">
        <div class="frame">
            <div class="image-container"></div>
            <div class="text-frame">
                <p class="small-text">Texto pequeño</p>
                <p class="large-text">Texto grande</p>
            </div>
            <div class="price-button-frame">
                <button class="add-button">Añadir</button>
                <p class="price-text">0,00$</p>
            </div>
        </div>
        <div class="frame">
            <div class="image-container"></div>
            <div class="text-frame">
                <p class="small-text">Texto pequeño</p>
                <p class="large-text">Texto grande</p>
            </div>
            <div class="price-button-frame">
                <button class="add-button">Añadir</button>
                <p class="price-text">0,00$</p>
            </div>
        </div>
        <div class="frame">
            <div class="image-container"></div>
            <div class="text-frame">
                <p class="small-text">Texto pequeño</p>
                <p class="large-text">Texto grande</p>
            </div>
            <div class="price-button-frame">
                <button class="add-button">Añadir</button>
                <p class="price-text">0,00$</p>
            </div>
        </div>
        <div class="frame">
            <div class="image-container"></div>
            <div class="text-frame">
                <p class="small-text">Texto pequeño</p>
                <p class="large-text">Texto grande</p>
            </div>
            <div class="price-button-frame">
                <button class="add-button">Añadir</button>
                <p class="price-text">0,00$</p>
            </div>
        </div>
        <div class="frame">
            <div class="image-container"></div>
            <div class="text-frame">
                <p class="small-text">Texto pequeño</p>
                <p class="large-text">Texto grande</p>
            </div>
            <div class="price-button-frame">
                <button class="add-button">Añadir</button>
                <p class="price-text">0,00$</p>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-logo">
            <img src="img/logo_footer.png" alt="logo">
        </div>
        <div class="footer-text-frame">
            <p class="footer-text">Sobre nosotros</p>
            <p class="footer-text">Nuestra visión</p>
            <p class="footer-text">Blogs</p>
            <p class="footer-text">Politica</p>
        </div>
        <div class="footer-text-frame">
            <p class="footer-text">Facebook</p>
            <p class="footer-text">Twitter</p>
            <p class="footer-text">Instagram</p>
            <p class="footer-text">Youtube</p>
        </div>
    </footer>
</body>
</html>