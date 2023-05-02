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

define("FACTOR_RIESGO", 1);



$factoresRiesgos = $_GET['factorRiesgo'];
$peligroRiesgos = $_GET['peligroRiesgo'];
$controles = $_GET['controles'];
$desviaciones = $_GET['desviaciones'];


if (isset($factoresRiesgos) && !empty($factoresRiesgos)) {
    if (FACTOR_RIESGO == $factoresRiesgos) {
        $sql = "SELECT * from factores_riesgo";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);

        header('HTTP/1.1 200 OK');
        echo json_encode($stmt->fetchAll());
    }
}

if (isset($peligroRiesgos) && !empty($peligroRiesgos)) {
  
        $sql = "SELECT * FROM peligro_riesgo where Factor_idFactor = :idfactor_peligro";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':idfactor_peligro',$peligroRiesgos);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);

        header('HTTP/1.1 200 OK');
        echo json_encode($stmt->fetchAll());
    
}

if (isset($controles) && !empty($controles)) {

        $sql = "SELECT * FROM controles where Peligro_idPeligro = :idPeligros";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':idPeligros',$controles);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);

        header('HTTP/1.1 200 OK');
        echo json_encode($stmt->fetchAll());

}

if (isset($desviaciones) && !empty($desviaciones)) {
    
        $sql = "SELECT * FROM desviaciones WHERE Control_idControl = :control_id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':control_id',$desviaciones);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);

        header('HTTP/1.1 200 OK');
        echo json_encode($stmt->fetchAll());
 
}
