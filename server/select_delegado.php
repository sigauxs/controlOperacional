<?php 

include("../connection/connection.php");
$pdo = new Conexion();


header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, OPTIONS,POST");
header("Allow: GET, OPTIONS,POST");

$method = $_SERVER['REQUEST_METHOD'];
if($method == "OPTIONS") {
    die();
}


if($_SERVER['REQUEST_METHOD']=='GET'){

    $area = $_GET['area'];
    $locacion = $_GET['locacion'];
    $rol = $_GET['rol'];

 
    
  

  if($locacion != "" && $area != ""){
    $sql = "CALL delegado_Area(:area_id,:locacion_id);";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':area_id', $area);
    $stmt->bindValue(':locacion_id', $locacion);    
   }

   if($locacion != "" && $area != "" && $rol == '1'){

    $sql1 = "CALL pertenece_Area(:area_id,:locacion_id);";
    $stmt = $pdo->prepare($sql1);
    $stmt->bindValue(':area_id', $area);
    $stmt->bindValue(':locacion_id', $locacion);    
  
   }

   $stmt->execute();
   $stmt->setFetchMode(PDO::FETCH_ASSOC);
      
   header('HTTP/1.1 200 OK');
   echo json_encode($stmt->fetchAll());

}

$pdo = null;
?>