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

        $identification = $_GET['identification'];

        $sql = "SELECT Primer_Nombre as 'nombre', Segundo_Nombre as 'snombre' , Primer_Apellido as 'papellido', Segundo_Apellido as 'sapellido' FROM personas WHERE idPersona = :identification; ";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':identification',$identification);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);

        header('HTTP/1.1 200 OK');
        echo json_encode($stmt->fetchAll());
}


if($method ==  "PUT"){
    
    $jsonClient = json_decode(file_get_contents("php://input"));
        
        
    if (!$jsonClient) {
        exit("No day datos para actualizar");
    }


    $sql = "UPDATE personas SET Primer_Nombre= :pnombre , Segundo_Nombre = :snombre , Primer_Apellido = :papellido , Segundo_Apellido = :sapellido WHERE idPersona = :identificacion";
    $stmt = $pdo->prepare($sql);

    $stmt->bindValue(':pnombre', $jsonClient->pnombre );
    $stmt->bindValue(':snombre', $jsonClient->snombre );
    $stmt->bindValue(':papellido', $jsonClient->papellido);
    $stmt->bindValue(':sapellido', $jsonClient->sapellido);
    $stmt->bindValue(':identificacion',$jsonClient->identificacion);

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