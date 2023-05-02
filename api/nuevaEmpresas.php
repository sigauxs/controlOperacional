<?php

include("../connection/connection.php");
$pdo = new Conexion();

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");


$method = $_SERVER['REQUEST_METHOD'];
if($method == "OPTIONS") {
    die();
}





if($method == 'POST'){

    $jsonClient = json_decode(file_get_contents("php://input"));


    if(!$jsonClient){
        exit("No day datos para insertar");
    }
    
    
    $sql = "CALL nuevaEmpresa(:nombre,:estado)";

    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':nombre',$jsonClient->nombre);
    $stmt->bindValue(':estado',$jsonClient->estado);

    if ($stmt->execute()) {
        header("HTTP/1.1 201 ok");
        echo json_encode("success");
        exit;
    } else {
        header("HTTP/1.1 400 ok");
        echo json_encode("error");
        exit;
    }
   

}



?>