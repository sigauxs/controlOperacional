<?php 


include("../../connection/connection.php");

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, OPTIONS");
header("Allow: GET, OPTIONS");



$pdo = new Conexion();


$method = $_SERVER['REQUEST_METHOD'];
if ($method == "OPTIONS") {
    die();
}



if($method == "GET"){

    $tipo = (int)$_GET['tipo'];
       
    $sql = "CALL Seleccionar_FPCD(:tipo)";
    $stmt = $pdo->prepare($sql);

    $stmt->bindValue(':tipo', $tipo);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);

    header('HTTP/1.1 200 OK');
    echo json_encode($stmt->fetchAll());     

}else{
    echo "Esto no esta funcinando";
} 



?>