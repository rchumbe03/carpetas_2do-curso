<?php

require_once('bd_conect.php');
try {
    $upd = "UPDATE usuarios set rol=:rol where codigo=:id";
    $stmt = $bd->prepare($upd);

    $stmt->bindParam(':id', $_POST['id'], PDO::PARAM_INT);
    $stmt->bindParam(':rol', $_POST['rol'], PDO::PARAM_INT);

    $resul = $stmt->execute();

    if($resul) {
        header('Location: form_actualizar.html');
        echo "Actualización correcta";
    } else {
        print_r($bd -> errorinfo());
    }
} catch (PDOException $e) {
    echo 'Error con la base de datos: ' . $e->getMessage();
}