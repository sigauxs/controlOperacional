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

$options = $_GET['opciones'];

switch ($options) {
    case 0:
        $sql = "SELECT idVP, NombreVP from vp";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        header('HTTP/1.1 200 OK');
        echo json_encode($stmt->fetchAll());
        break;
    case 1:
        $sql = "SELECT id_Dpto, Nombre_Dpto, Dpto_idVP FROM departamentos";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        header('HTTP/1.1 200 OK');
        echo json_encode($stmt->fetchAll());
        break;
    case 2:
        $sql = "SELECT id_Area, Nombre_Area, Area_id_Dpto FROM areas";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        header('HTTP/1.1 200 OK');
        echo json_encode($stmt->fetchAll());
        break;
    case 3:
        $sql = "SELECT idLocacion, NombreLocacion FROM locacion";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        header('HTTP/1.1 200 OK');
        echo json_encode($stmt->fetchAll());
        break;
}




$pdo = null;
