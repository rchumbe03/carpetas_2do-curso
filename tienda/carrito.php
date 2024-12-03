<?php
include 'funcion_php/conexion.php';
include 'funcion_php/get_product.php';

// Obtener los productos del carrito para el usuario actual (suponiendo que el usuario está autenticado y su ID es 1)
$userId = 1; // Cambia esto según tu lógica de autenticación
$searchTerm = isset($_GET['search']) ? $_GET['search'] : '';

if ($searchTerm) {
    $cartProducts = searchCartProducts($userId, $searchTerm);
} else {
    $cartProducts = getCartProducts($userId);
}

// Calcular el total de todos los productos en el carrito
$total = 0;
foreach ($cartProducts as $product) {
    $total += $product['precio'] * $product['cantidad'];
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito</title>
    <link rel="stylesheet" href="styles/styles_c.css">
    <script src="script/carrito.js" defer></script>
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
                <input type="text" name="search" placeholder="Buscar..." value="<?php echo htmlspecialchars($searchTerm); ?>">
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
            <?php if (count($cartProducts) > 0): ?>
                <?php foreach ($cartProducts as $product): ?>
                <div class="custom-frame">
                    <div class="frame-img">
                        <img src="<?php echo $product['imagen_url']; ?>" alt="<?php echo $product['nombre']; ?>" class="product-image">
                    </div>
                    <div class="content-frame">
                        <!-- Frame descripción dentro del frame contenido -->
                        <div class="description-frame">
                            <div class="small-text-box"><?php echo $product['categoria']; ?></div>
                            <div class="large-text-box"><?php echo $product['nombre']; ?></div>
                        </div>
                        <div class="icon-frame">
                            <img src="img/icon.png" alt="Eliminar" class="remove-button" data-product-id="<?php echo $product['id_producto']; ?>">
                        </div>
                        <div class="additional-frame">
                            <div class="text-box-small">Cantidad: <?php echo $product['cantidad']; ?></div>
                            <div class="text-box-large"><?php echo number_format($product['precio'] * $product['cantidad'], 2); ?>$</div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Tu carrito está vacío.</p>
            <?php endif; ?>
        </div>

        <!-- Nuevo contenedor a la derecha -->
        <div class="side-container">
            <div class="frame-button">
                <div class="text-box">Resumen</div>
                <form action="funcion_php/comprar.php" method="POST">
                    <button class="button">Comprar</button>
                </form>
            </div>
            <div class="line-side"></div>
            <div class="precio-frame">
                <div class="text-box-small">Total :</div>
                <div class="text-box-large"><?php echo number_format($total, 2); ?>$</div>
            </div>
        </div>
    </div>

    <!-- Contenedor global para el quantity-frame -->
    <div id="global-quantity-frame" style="display: none;">
        <div class="quantity-frame">
            <button class="quantity-button" onclick="decreaseQuantity()">-</button>
            <span id="quantity">1</span>
            <button class="quantity-button" onclick="increaseQuantity()">+</button>
        </div>
        <button class="confirm-button">Confirmar</button>
    </div>
</body>
</html>