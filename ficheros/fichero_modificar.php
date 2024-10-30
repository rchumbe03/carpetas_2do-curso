<?php
// Ruta del fichero y modo de apertura
$fichero = "fichero.txt";

// Lee el contenido del fichero
$fich = fopen($fichero, "r");
$contenido = '';
if ($fich) {
    $contenido = fread($fich, filesize($fichero));
    fclose($fich);
}

// Actualizar el contenido del texto fichero.txt
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nuevoContenido = $_POST["contenido"];
    
    // Archivo modo escritura
    $fich = fopen($fichero, "w");
    if ($fich) {
        // Sobreescribir el contenido
        fwrite($fich, $nuevoContenido);
        fclose($fich);
        echo "El archivo ha sido actualizado con éxito.<br>";
    } else {
        echo "Error al actualizar el archivo.<br>";
    }
}

// formulario.php
include 'formulario.php';

?>