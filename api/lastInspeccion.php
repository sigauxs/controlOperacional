<?php

include("../connection/connection.php");
$pdo = new Conexion();


header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, OPTIONS");
header("Allow: GET, OPTIONS");

$method = $_SERVER['REQUEST_METHOD'];
if ($method == "OPTIONS") {
    die();
}

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

$idInspector = $_GET['idInspector'];

$sql = "CALL ultimaInspeccion(:idInspector)";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(":idInspector",$idInspector);
$stmt->execute();
$stmt->setFetchMode(PDO::FETCH_ASSOC);

header('HTTP/1.1 200 OK');
echo json_encode($stmt->fetchAll());

}


?>
