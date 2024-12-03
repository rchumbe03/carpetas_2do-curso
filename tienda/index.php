<?php
include 'funcion_php/conexion.php';
include 'funcion_php/get_product.php';

$searchTerm = isset($_GET['search']) ? $_GET['search'] : '';

if ($searchTerm) {
    $products = searchProducts($searchTerm);
} else {
    $firstFiveProducts = getProducts(0, 5);
    $nextFiveProducts = getProducts(5, 5);
}

// Obtener los datos JSON enviados
$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['product_id']) && isset($data['quantity'])) {
    $productId = $data['product_id'];
    $quantity = $data['quantity'];
    $userId = 1; // Cambia esto según tu lógica de autenticación

    // Verificar si el producto ya está en el carrito
    $sql = "SELECT * FROM Carrito WHERE id_usuario = $userId AND id_producto = $productId";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Actualizar la cantidad del producto en el carrito
        $sql = "UPDATE Carrito SET cantidad = cantidad + $quantity WHERE id_usuario = $userId AND id_producto = $productId";
    } else {
        // Insertar el producto en el carrito
        $sql = "INSERT INTO Carrito (id_usuario, id_producto, cantidad) VALUES ($userId, $productId, $quantity)";
    }

    if ($conn->query($sql) === TRUE) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => $conn->error, 'sql' => $sql]);
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
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
                <a href="carrito.php">Carrito</a>
                <a href="login.php">Login</a>
                <a href="registro.php">Registrate</a>
            </div>

            <!-- Barra de búsqueda -->
            <form class="search-bar" method="GET" action="index.php">
                <input type="text" name="search" placeholder="Buscar..." value="<?php echo htmlspecialchars($searchTerm); ?>">
            </form>
        </div>
    </header>
    
    <!-- Contenedor de frames -->
    <?php if ($searchTerm): ?>
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
                    <button class="add-button" data-product-id="<?php echo $product['id_producto']; ?>">Añadir</button>
                    <p class="price-text"><?php echo number_format($product['precio'], 2); ?>$</p>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <!-- 1er Contenedor con 5 frames -->
        <div class="frame-container">
            <?php foreach ($firstFiveProducts as $product): ?>
            <div class="frame">
                <div class="image-container">
                    <img src="<?php echo $product['imagen_url']; ?>" alt="<?php echo $product['nombre']; ?>" class="product-image">
                </div>
                <div class="text-frame">
                    <p class="small-text"><?php echo $product['categoria']; ?></p>
                    <p class="large-text"><?php echo $product['nombre']; ?></p>
                </div>
                <div class="price-button-frame">
                    <button class="add-button" data-product-id="<?php echo $product['id_producto']; ?>">Añadir</button>
                    <p class="price-text"><?php echo number_format($product['precio'], 2); ?>$</p>
                </div>
            </div>
            <?php endforeach; ?>
        </div>

        <!-- 2do Contenedor con 5 frames -->
        <div class="frame-container">
            <?php foreach ($nextFiveProducts as $product): ?>
            <div class="frame">
                <div class="image-container">
                    <img src="<?php echo $product['imagen_url']; ?>" alt="<?php echo $product['nombre']; ?>" class="product-image">
                </div>
                <div class="text-frame">
                    <p class="small-text"><?php echo $product['categoria']; ?></p>
                    <p class="large-text"><?php echo $product['nombre']; ?></p>
                </div>
                <div class="price-button-frame">
                    <button class="add-button" data-product-id="<?php echo $product['id_producto']; ?>">Añadir</button>
                    <p class="price-text"><?php echo number_format($product['precio'], 2); ?>$</p>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <!-- Contenedor global para el quantity-frame -->
    <div id="global-quantity-frame" style="display: none;">
        <div class="quantity-frame">
            <button class="quantity-button" onclick="decreaseQuantity()">-</button>
            <span id="quantity">1</span>
            <button class="quantity-button" onclick="increaseQuantity()">+</button>
        </div>
        <button class="confirm-button">Confirmar</button>
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