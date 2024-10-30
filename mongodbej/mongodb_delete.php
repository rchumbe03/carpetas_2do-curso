<?php
require 'vendor/autoload.php';

try {
    
    $cliente = new MongoDB\Client("mongodb://localhost:27017");
    $bd = $cliente->libroservidor;

    
    $deleteResult = $bd->usuarios->deleteOne(['nombre' => 'Luis']);

    // Mostrar el número de documentos eliminados
    echo "Documentos eliminados: " . $deleteResult->getDeletedCount() . "<br>";

    // Mostrar el número de documentos restantes en la colección
    $count = $bd->usuarios->countDocuments();
    echo "Documentos restantes después de borrar: " . $count . "<br>";

} catch (Exception $e) {
    echo "Error al borrar usuario: " . $e->getMessage();
}