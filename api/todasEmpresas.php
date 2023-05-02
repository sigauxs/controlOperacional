<?php 

include("../connection/connection.php");


header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, OPTIONS");
header("Allow: POST, OPTIONS");

$method = $_SERVER['REQUEST_METHOD'];

if ($method == "OPTIONS") {
    die();
}

$pdo = new Conexion();

if ($method == 'GET') {

    $sql = "SELECT * FROM empresas";
    $stmt = $pdo->prepare($sql);

    if ($stmt->execute()) {
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        header('HTTP/1.1 200 OK');
        echo json_encode($stmt->fetchAll());
    }  

}



?>