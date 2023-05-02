<?php

include("../connection/connection.php");
$pdo = new Conexion();

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, OPTIONS");
header("Allow:  OPTIONS, GET ");

$method = $_SERVER['REQUEST_METHOD'];

if ($method == "OPTIONS") {
    die();
}

function input_data($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}


$idInspeccion = input_data($_GET['idInspeccion']);

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if(!empty($idInspeccion)){
        $sql = "CALL Inspeccion_Seleccionada(:idInspeccion)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':idInspeccion', $idInspeccion);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        header('HTTP/1.1 200 OK');
        echo json_encode($stmt->fetchAll());
    }else{
        header('HTTP/1.1 400 error');
        echo json_encode("error");
    }
}
    
 