<?php 

include("../connection/connection.php");
$pdo = new Conexion();

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $fi = $_POST['FechaInicio'];
    $ff = $_POST['FechaFinal'];
    $slec = $_POST['selc'];
    $inspector = $_POST['idUsuario'];
  
    if ($fi == "" && $ff == "" && $slec == "") {
      echo "No hay datos";
    } else {
      if ($_REQUEST['selc'] == 1) {
  
        $sql2 = "Call Listado_Inspecciones('$fi', '$ff', '2','')";
      } else {
  
        $sql2 = "Call Listado_Inspecciones('$fi', '$ff','1','$inspector')";
      }

      $stmt = $pdo->prepare($sql2);
      $stmt->execute();
      $stmt->setFetchMode(PDO::FETCH_ASSOC);

      header('HTTP/1.1 200 OK');
      echo json_encode($stmt->fetchAll());

      $pdo = null;
  

    
    }
}


?>