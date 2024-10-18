<?php
require 'bd_conect.php';
try {
    $ins = "INSERT INTO usuarios (nombre, clave, rol) VALUES (:nombre, :clave, :rol)";
    $stmt = $bd->prepare($ins);

    $stmt->bindParam(':nombre', $_POST['nombre']);
    $stmt->bindParam(':clave', $_POST['clave']);
    $stmt->bindParam(':rol', $_POST['rol']);

    $resul = $stmt->execute();

    if($resul) {
        header('Location: form_insertar.html');
    } else {
        print_r($bd -> errorinfo());
    }    
} catch (PDOException $e) {
    echo 'Error con la base de datos: ' . $e->getMessage();
}
?>