<?php

include("../connection/connection.php");

$pdo = new Conexion();

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: PUT, OPTIONS");
header("Allow:  OPTIONS, PUT ");

$method = $_SERVER['REQUEST_METHOD'];
if ($method == "OPTIONS") {
    die();
}

if ($_SERVER['REQUEST_METHOD'] == 'PUT') {

    
    $jsonClient = json_decode(file_get_contents("php://input"));

   
    if (!$jsonClient) {
        exit("No day datos para insertar");
    }

    

    $sql = "CALL actualizarInspecion(:fechaInspeccion,:actividad,:area,:delegado,:responsable,:turno,:idInspeccion)";
 
 

    $stmt = $pdo->prepare($sql);

    $stmt->bindValue(':idInspeccion', $jsonClient->idInspeccion);
    $stmt->bindValue(':fechaInspeccion', $jsonClient->fechaInspeccion);
    $stmt->bindValue(':actividad', $jsonClient->actividad);
    $stmt->bindValue(':area', $jsonClient->area);
    $stmt->bindValue(':delegado', $jsonClient->delegado);
    $stmt->bindValue(':responsable', $jsonClient->responsable);
    $stmt->bindValue(':turno', $jsonClient->turno);



    if ($stmt->execute()) {
    
        header('HTTP/1.1 201 OK');
        echo json_encode("success");
    } else {
        header('HTTP/1.1 400 OK');
        echo json_encode("error");
    }


} else {
    echo json_encode("No hay datos para guardar");
}




/*
include("../connection/connection.php");
include("../include/typeAdmin.php");

$pdo = new Conexion();

session_start();

if (!isset($_SESSION['usuarioId'])) {
    header('location: index.php');
}


function input_data($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

$idInspeccion = input_data($_POST['idInspeccion']);
$fecha_inspeccion = input_data($_POST['fechaInspeccion']);
$sede = input_data($_POST['sede']);
$vp = input_data($_POST['vp']);
$dpto = input_data($_POST['dpto']);
$area = input_data($_POST['area']);
$descripcionInspeccion =input_data($_POST['descripcion']);
$inspector = input_data($_POST['inspector']);
$turno = input_data($_POST['turno']);
$delegado = input_data($_POST['delegado']);
$responsable = input_data($_POST['responsable']);

if($_SERVER['REQUEST_METHOD']=='PUT'){
    
    $sql = "UPDATE inspecciones AS I
    SET I.Fecha_inspeccion = :fechaInspeccion, I.Actividad = :actividad, I.Area = :idArea, I.idDelegado_del_area = :idDelegado, I.Pertenece_idPertenece = :idPertenece, I.Turno = :turno
    WHERE I.idInspeccion = :idInspeccion";

    $stmt = $pdo->prepare($sql);

    $stmt->bindValue(':idInspeccion',$idInspeccion);
    $stmt->bindValue(':fechaInspeccion',$fecha_inspeccion);
    $stmt->bindValue(':actividad',$descripcionInspeccion);
    $stmt->bindValue(':idArea',$area);
    $stmt->bindValue(':idDelegado',$delegado);
    $stmt->bindValue(':idInspector',$inspector);
    $stmt->bindValue(':idPertenece',$responsable);
    $stmt->bindValue(':turno',$turno);

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




*/
