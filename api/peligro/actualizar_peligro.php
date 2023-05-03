<?php 


include("../../connection/connection.php");

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, OPTIONS");
header("Allow: GET, OPTIONS");



$pdo = new Conexion();
$method = $_SERVER['REQUEST_METHOD'];

if ($method == "OPTIONS") {
    die();
}


if($method == 'PUT') {


$jsonClient = json_decode(file_get_contents("php://input"));


if (!$jsonClient) {
    exit("No day datos para actualizar");
}


$sql = "CALL Editar_peligro(:id,:nombre)";
$stmt = $pdo->prepare($sql);

$stmt->bindValue(':id',    $jsonClient->idpeligro);
$stmt->bindValue(':nombre',$jsonClient->nombre);

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