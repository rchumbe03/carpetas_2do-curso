<?php
require 'vendor/autoload.php';

function actualizarUsuario($nuevoNombre = null, $nuevaClave = null, $nuevoSaldo = null) {
    try {
        
        $cliente = new MongoDB\Client("mongodb://localhost:27017");
        $bd = $cliente->libroservidor;

        // Array de cambios a aplicar
        $cambios = [];
        if ($nuevoNombre) $cambios['nombre'] = $nuevoNombre;
        if ($nuevaClave) $cambios['clave'] = $nuevaClave;
        if ($nuevoSaldo) $cambios['saldo'] = $nuevoSaldo;

        if (!empty($cambios)) {
            $updateResult = $bd->usuarios->updateOne(
                ['nombre' => 'Luis'],
                ['$set' => $cambios]
            );
            
            echo "Documentos actualizados: " . $updateResult->getModifiedCount() . "<br>";
        } else {
            echo "No hay cambios especificados para actualizar.<br>";
        }

    } catch (Exception $e) {
        echo "Error al actualizar usuario: " . $e->getMessage();
    }
}

// Ejemplo de uso: actualizar el saldo y la clave del usuario
actualizarUsuario(null, '1234', 1000);