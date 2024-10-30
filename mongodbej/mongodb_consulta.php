<?php
require 'vendor/autoload.php';

try {
    $cliente = new MongoDB\Client("mongodb://localhost:27017");
    $bd = $cliente->libroservidor;

    echo "<h2>Lista de todos los usuarios:</h2>";
    $usuarios = $bd->usuarios->find();

    foreach ($usuarios as $usuario) {
        echo "ID: " . $usuario['_id'] . "<br>";
        echo "Nombre: " . $usuario['nombre'] . "<br>";
        echo "Clave: " . $usuario['clave'] . "<br>";
        echo "Saldo: " . $usuario['saldo'] . "<br>";
        echo "<hr>";
    }

    echo "<h2>Usuarios con nombre 'Ana':</h2>";
    $usuariosAna = $bd->usuarios->find(['nombre' => 'Ana']);

    foreach ($usuariosAna as $usuario) {
        echo "ID: " . $usuario['_id'] . "<br>";
        echo "Nombre: " . $usuario['nombre'] . "<br>";
        echo "Clave: " . $usuario['clave'] . "<br>";
        echo "Saldo: " . $usuario['saldo'] . "<br>";
        echo "<hr>";
    }

    echo "<h2>Primer usuario con nombre 'Ana':</h2>";
    $primerAna = $bd->usuarios->findOne(['nombre' => 'Ana']);
    if ($primerAna) {
        echo "ID: " . $primerAna['_id'] . "<br>";
        echo "Nombre: " . $primerAna['nombre'] . "<br>";
        echo "Clave: " . $primerAna['clave'] . "<br>";
        echo "Saldo: " . $primerAna['saldo'] . "<br>";
    } else {
        echo "No se encontró ningún usuario con el nombre 'Ana'.<br>";
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}