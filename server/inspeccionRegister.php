<?php 

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

if($_SERVER['REQUEST_METHOD']=='POST'){

    $sql = "INSERT INTO inspecciones (Fecha_inspeccion, Actividad, Area, idDelegado_del_area, idInspector, Pertenece_idPertenece, Turno) VALUES (:fechaInspeccion,:actividad,:idArea, :idDelegado, :idInspector, :idPertenece,:turno)";
    $stmt = $pdo->prepare($sql);
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






?>