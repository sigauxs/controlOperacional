<?php 


include("../../connection/connection.php");

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Allow: POST, OPTIONS");



$pdo = new Conexion();


$method = $_SERVER['REQUEST_METHOD'];
if ($method == "OPTIONS") {
    die();
}



if($method ==  "POST"){
    
    $jsonClient = json_decode(file_get_contents("php://input"));
        
        
    if (!$jsonClient) {
        exit("No day datos para ingresar");
    }

    //Gestionar control

    $sql = "CALL insertar_Desviaciones(:tipo,:descripcion,:idcontrol)";
    $stmt = $pdo->prepare($sql);

   
    $stmt->bindValue(':tipo', $jsonClient->tipo );
    $stmt->bindValue(':descripcion',   $jsonClient->descripcion );
    $stmt->bindValue(':idcontrol',   $jsonClient->idcontrol );

    if ($stmt->execute()) {
            header("HTTP/1.1 201 ok");
            echo json_encode("success");
            exit;
    } else {
        header("HTTP/1.1 400 ok");
        echo json_encode("error");
        exit;
    }
}



?>