<?php 


include("../../connection/connection.php");

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, PUT, OPTIONS");
header("Allow: GET,PUT, OPTIONS");



$pdo = new Conexion();


$method = $_SERVER['REQUEST_METHOD'];
if ($method == "OPTIONS") {
    die();
}


if ($method == 'GET') {

        $area = $_GET['area'];

        $sql = "SELECT sedes.idSede AS 'SEDE', vp.idVP AS 'VP', departamentos.id_Dpto AS 'DPTO', areas.id_Area AS 'AREA' FROM areas INNER JOIN departamentos ON (areas.Area_id_Dpto = departamentos.id_Dpto) INNER JOIN vp ON (vp.idVP = departamentos.Dpto_idVP) INNER JOIN sedes ON (vp.VP_idSede = sedes.idSede) WHERE areas.id_Area = :area";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':area',$area);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);

        header('HTTP/1.1 200 OK');
        echo json_encode($stmt->fetchAll());

}

/* actulizar seccion pertenece de actulizar datos de usuario */

   if ($method == 'PUT') {


            $jsonClient = json_decode(file_get_contents("php://input"));
        
        
            if (!$jsonClient) {
                exit("No day datos para actualizar");
            }
        
        
        
            $sql = "UPDATE pertenece SET Locacion_idLocacion = :locacion , Area_idArea = :area, estado = :estado WHERE Numerador = :numerador";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':locacion', $jsonClient->locacion);
            $stmt->bindValue(':estado', $jsonClient->estado);
            $stmt->bindValue(':area', $jsonClient->area);
            $stmt->bindValue(':numerador', $jsonClient->numerador);
        
            if ($stmt->execute()) {

                $sql_2 = "SELECT Numerador as 'numerador', Locacion_idLocacion as 'locacion' , Area_idArea as 'area', estado as 'estado' FROM pertenece";
                $stmt_2 = $pdo->prepare($sql_2);
            
                if ($stmt_2->execute()) {
                    $result = $stmt_2->setFetchMode(PDO::FETCH_ASSOC);
                    $result =  $stmt_2->fetchAll();
                    $result['status'] = "success";
                    header("HTTP/1.1 201 ok");
                    echo json_encode($result);
                    exit;
                }  
                
            } else {
                header("HTTP/1.1 400 ok");
                echo json_encode("error");
                exit;
            }
 }
        

 


?>