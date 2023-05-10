<?php

include("../connection/connection.php");

$pdo = new Conexion();


$jsonClient = json_decode(file_get_contents("php://input"));


if (!$jsonClient) {
    exit("No day datos para actualizar");
}


if($_SERVER['REQUEST_METHOD']=='PUT'){
    
    
    $sql  = "CALL actualizarEmpresa(:idEmpresa,:nombre,:estado)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':nombre',    $jsonClient->nombre);
    $stmt->bindValue(':estado',    $jsonClient->estado);
    $stmt->bindValue(':idEmpresa', $jsonClient->idEmpresa);

    if($stmt->execute()){
        header('HTTP/1.1 201 OK');
        echo json_encode("success");
    }else{
        header('HTTP/1.1 400 OK');
        echo json_encode("error");
    }
    

}else{
    echo json_encode("No hay datos para guardar");
}

/*include("../connection/connection.php");


$pdo = new Conexion();


$jsonClient = json_decode(file_get_contents("php://input"));


if($_SERVER['REQUEST_METHOD']=='PUT'){
    
    
    $sql  = "CALL actualizarEmpresa(:idEmpresa,:nombre,:estado)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':nombre',    $jsonClient->nombre);
    $stmt->bindValue(':estado',    $jsonClient->estado);
    $stmt->bindValue(':idEmpresa', $jsonClient->id);

    if($stmt->execute()){
        header('HTTP/1.1 201 OK');
        echo json_encode("success");
    }else{
        header('HTTP/1.1 400 OK');
        echo json_encode("error");
    }
    

}else{
    echo json_encode("No hay datos para guardar");
}*/

							





?>
