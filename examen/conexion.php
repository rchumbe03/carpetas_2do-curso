<?php
// Conexión a la base de datos
$servername = "127.0.0.1:3307";
$username = "root";
$password = "";
$dbname = "noticiero";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consulta para obtener las noticias
$sql = "SELECT n.Titulo, t.categoria 
        FROM Noticia n 
        JOIN Tnoticia t ON n.id_tnoticia = t.id_tnoticia";
$result = $conn->query($sql);
?>