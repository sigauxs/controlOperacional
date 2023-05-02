<?php

include("../connection/connection.php");

$pdo = new Conexion();

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: DELETE, OPTIONS");
header("Allow:  OPTIONS, DELETE ");

$method = $_SERVER['REQUEST_METHOD'];

if ($method == "OPTIONS") {
    die();
}

if ($_SERVER['REQUEST_METHOD'] == "DELETE") {


 
    
    $jsonClient = json_decode(file_get_contents("php://input"));

   
    if (!$jsonClient) {
        exit("No hay identificador para eliminar una inspeccion");
    }


    $sql = "CALL Eliminar_inspeccion(:idInspeccion)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue('idInspeccion', $jsonClient->idInspeccion);

    if ($stmt->execute()) {
        header('HTTP/1.1 201 OK');
        echo json_encode("success");
    } else {
        header('HTTP/1.1 400 OK');
        echo json_encode("error");
    }

} else {
    echo json_encode("No id para eliminar Inspeccion");
}




