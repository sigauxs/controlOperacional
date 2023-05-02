<?php 

include("../connection/connection.php");
$pdo = new Conexion();

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    
     $idInspeccion = $_GET['idInspeccion'];
     $sql2 = "Call listaHallazgo($idInspeccion)";
     $stmt = $pdo->prepare($sql2);
     $stmt->execute();
     $stmt->setFetchMode(PDO::FETCH_ASSOC);

      header('HTTP/1.1 200 OK');
      echo json_encode($stmt->fetchAll());

      $pdo = null;
      
}


?>