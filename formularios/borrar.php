<?php
require 'bd_conect.php';
try {
    $del = "DELETE FROM usuarios WHERE codigo = :id";
    $stmt = $bd->prepare($del);

    $stmt->bindParam(':id', $_POST['id'], PDO::PARAM_INT);
    $resul = $stmt->execute();

    if($resul) {
        header('Location: form_borrar.html');
    } else {
        print_r($bd -> errorinfo());
    }    
} catch (PDOException $e) {
    echo 'Error con la base de datos: ' . $e->getMessage();
}
?>