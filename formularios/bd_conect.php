<?php
$cadena_conexion = 'mysql:dbname=empresa;host=localhost;port=3307';
$usuario = 'root';
$clave = '';
try {
    $bd = new PDO($cadena_conexion, $usuario, $clave);
} catch (PDOException $e) {
    echo 'Error con la base de datos: ' . $e->getMessage();
} 