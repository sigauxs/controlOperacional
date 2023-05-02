<?php

include("../connection/connection.php");

$pdo = new Conexion();

$idDesviacion = input_data($_POST["idDesviacion"]);
$idInspeccion = input_data($_POST["idInspeccion"]);

$descripcion = input_data($_POST["descripcion"]);
$idEmpresas = input_data($_POST["idempresas"]);
$idHallazgo = input_data($_POST["idHallazgo"]);
$opcion = input_data($_POST["opcion"]);
$tipoH = input_data($_POST["tipoH"]);    


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   
   if (!empty($_FILES['picture']['name'])) {

        $result = 0;
        $uploadDir = "../hallazgo/";
        $fileName = time() . '_' . basename($_FILES['picture']['name']);
        $targetPath = $uploadDir . $fileName;    
       
      
       if (@move_uploaded_file($_FILES['picture']['tmp_name'], $targetPath)) {

            $sql = "CALL hallazgoUpdate(:idDesviacion,:descripcion,:idEmpresa,:idInspeccion,:rutaEvidencia,:idHallazgo,:opcion,:tipoH)";

            $stmt = $pdo->prepare($sql);

            $stmt->bindValue(':idDesviacion', $idDesviacion);
            $stmt->bindValue(':descripcion', $descripcion);
            $stmt->bindValue(':idEmpresa', $idEmpresas);
            $stmt->bindValue(':idInspeccion', $idInspeccion);
            $stmt->bindValue(':rutaEvidencia', $targetPath);  
            $stmt->bindValue(':idHallazgo', $idHallazgo);
            $stmt->bindValue(':opcion', $opcion);
            $stmt->bindValue(':tipoH', $tipoH);



            if ($stmt->execute()) {
                header("HTTP/1.1 201 ok");
                echo json_encode("success");
                exit;
            } else {
                header("HTTP/1.1 400 ok");
                echo json_encode("error");
                exit;
            }
        }else{
            echo json_encode("no hemos podido guardar la iamgen");
        }
    } else {
        
        $sql = "CALL hallazgoUpdate(:idDesviacion,:descripcion,:idEmpresa,:idInspeccion,:rutaEvidencia,:idHallazgo,:opcion,:tipoH)";
        $stmt = $pdo->prepare($sql);

        $stmt->bindValue(':idDesviacion', $idDesviacion);
        $stmt->bindValue(':descripcion', $descripcion);
        $stmt->bindValue(':idEmpresa', $idEmpresas);
        $stmt->bindValue(':idInspeccion', $idInspeccion);
        $stmt->bindValue(':rutaEvidencia', "");  
        $stmt->bindValue(':idHallazgo', $idHallazgo);
        $stmt->bindValue(':opcion', $opcion);
        $stmt->bindValue(':tipoH', $tipoH);

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
}



function input_data($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>