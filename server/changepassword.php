<?php 


include("../connection/connection.php");

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: PUT, OPTIONS");
header("Allow: PUT, OPTIONS");



$pdo = new Conexion();
$method = $_SERVER['REQUEST_METHOD'];

if ($method == "OPTIONS") {
    die();
}


if($method == 'PUT') {


$jsonClient = json_decode(file_get_contents("php://input"));


if (!$jsonClient) {
    exit("No day usuario y/o contraseña para actualizar");
}


$sql = "CALL Cambiar_password(:idUsuario,:password);";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':idUsuario', $jsonClient->idUsuario);
$stmt->bindValue(':password',  $jsonClient->password);

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