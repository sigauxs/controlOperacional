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

        $vp_idsede = $_GET['vp_idsede'];
        $dpto = $_GET['dpto'];
        $area = $_GET['area'];
        $locacion = $_GET['locacion'];


 

        if($locacion != ""){
            $sql = "CALL locacion(:idSede);";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':idSede',$locacion);
        }

        if($vp_idsede != ""){
            $sql = "SELECT idVP, NombreVP from vp where VP_idSede = :vp_idsede ORDER BY vp.NombreVP ASC";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':vp_idsede',$vp_idsede);
        }
        
        if($dpto != "" ){
            $sql = "SELECT id_Dpto, Nombre_Dpto, Dpto_idVP FROM departamentos WHERE Dpto_idVP = :dpto ORDER BY Nombre_Dpto ASC";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':dpto',$dpto);
        }

        if( $area != "" ){
            $sql = "SELECT id_Area, Nombre_Area, Area_id_Dpto FROM areas WHERE Area_id_Dpto = :area ORDER BY Nombre_Area ASC";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(':area',$area);
        }

        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        
        
        header('HTTP/1.1 200 OK');
        echo json_encode($stmt->fetchAll());
        
        $pdo = null;




}




?>