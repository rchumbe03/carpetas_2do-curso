-- Crear la base de datos
CREATE DATABASE carrito;

-- Usar la base de datos
USE carrito;

-- Crear la tabla Usuario
CREATE TABLE Usuario (
    id_usuario INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(15) NOT NULL,
    correo VARCHAR(255) NOT NULL,
    contrasena VARCHAR(255) NOT NULL
);

-- Crear la tabla Producto
CREATE TABLE Producto (
    id_producto INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    categoria VARCHAR(255) NOT NULL,
    precio DECIMAL(10,2) NOT NULL,
    imagen_url VARCHAR(255) NOT NULL,
    stock INT NOT NULL
);

-- Crear la tabla Carrito
CREATE TABLE Carrito (
    id_carrito INT AUTO_INCREMENT PRIMARY KEY,
    id_usuario INT NOT NULL,
    id_producto INT NOT NULL,
    cantidad INT NOT NULL,
    FOREIGN KEY (id_usuario) REFERENCES Usuario(id_usuario),
    FOREIGN KEY (id_producto) REFERENCES Producto(id_producto)
);

-- Insertar datos en la tabla Producto
INSERT INTO Producto (nombre, categoria, precio, imagen_url, stock) VALUES
('Auriculares', 'Electrónica', 29.99, 'img/producto/auriculares.png', 50),
('Camiseta', 'Ropa', 19.99, 'img/producto/camiseta.png', 100),
('Laptop', 'Electrónica', 999.99, 'img/producto/laptop.png', 30),
('Libro', 'Libros', 14.99, 'img/producto/libro.png', 200),
('Ratón', 'Electrónica', 24.99, 'img/producto/raton.png', 75),
('Silla', 'Muebles', 89.99, 'img/producto/silla.png', 20),
('Teclado', 'Electrónica', 49.99, 'img/producto/teclado.png', 60),
('Teléfono', 'Electrónica', 699.99, 'img/producto/telefono.png', 40),
('Televisor', 'Electrónica', 499.99, 'img/producto/televisor.png', 25),
('Zapatillas', 'Ropa', 59.99, 'img/producto/zapatillas.png', 80);