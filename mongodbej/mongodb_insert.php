<?php
require 'vendor/autoload.php';

function insertarUsuario($nombre, $clave, $saldo) {
    try {
        
        $cliente = new MongoDB\Client("mongodb://localhost:27017");
        $bd = $cliente->libroservidor;

        // Inserción del nuevo usuario
        $resultado = $bd->usuarios->insertOne([
            'nombre' => $nombre,
            'clave' => $clave,
            'saldo' => $saldo
        ]);

        echo "Usuario insertado con ID: " . $resultado->getInsertedId() . "<br>";
    } catch (Exception $e) {
        echo "Error al insertar usuario: " . $e->getMessage();
    }
}

// Ejemplo de uso
insertarUsuario('Luis', 'abcd1234', 500);