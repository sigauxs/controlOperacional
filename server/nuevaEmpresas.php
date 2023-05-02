<?php 

include("../connection/connection.php");
include("../include/typeAdmin.php");

$pdo = new Conexion();

session_start();

if (!isset($_SESSION['usuarioId'])) {
    header('location: index.php');
}


$nombre = input_data($_POST['nombre']);
$estado = input_data($_POST['estado']);


if($_SERVER['REQUEST_METHOD']=='POST'){
    
    
     $sql = "CALL nuevaEmpresa(:nombre,:estado)";

    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':nombre',$nombre);
    $stmt->bindValue(':estado',$estado);

    if($stmt->execute()){
     header("Location:http://controlope.sigpeconsultores.com.co/empresas/lista.php");
     exit();
    }else{
        header('HTTP/1.1 400 OK');
        echo json_encode("error");
    }
    

}else{
    echo json_encode("No hay datos para guardar");
}

								
function input_data($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}





?>