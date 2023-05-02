<?php 

include("../../connection/connection.php");

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Allow: GET, POST, OPTIONS");



$pdo = new Conexion();


$method = $_SERVER['REQUEST_METHOD'];
if ($method == "OPTIONS") {
    die();
}


if ($method == 'GET') {


        $area = $_GET['area'];
        $usuario = $_GET['usuario'];
        $locacion = $_GET['locacion'];
        
    

        $sql = "SELECT * FROM pertenece WHERE Usuarios_idUsuario = :usuario AND locacion_idLocacion = :locacion AND Area_idArea = :area";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':area',$area);
        $stmt->bindValue(':locacion',$locacion);
        $stmt->bindValue(':usuario',$usuario);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
   
        $result = $stmt->fetchAll();
        
        header('HTTP/1.1 200 OK');
        echo json_encode(count($result));

}

if ($method == 'POST') {

    $jsonClient = json_decode(file_get_contents("php://input"));


    if(!$jsonClient){
        exit("No day datos para insertar");
    }
    
    $sql = "INSERT INTO pertenece(Usuarios_idUsuario, Locacion_idLocacion, Area_idArea,estado) VALUES (:usuario,:locacion,:area,:estado)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':area',$jsonClient->area);
    $stmt->bindValue(':locacion',$jsonClient->locacion);
    $stmt->bindValue(':usuario',$jsonClient->usuario);
    $stmt->bindValue(':estado',$jsonClient->estado);

    if($stmt->execute()){
        header('HTTP/1.1 201 OK');
        echo json_encode("success");
    }else{
        header('HTTP/1.1 400 OK');
        echo json_encode("error");
    }


}



?>