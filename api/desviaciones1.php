<?php


include("../connection/connection.php");


header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, OPTIONS");
header("Allow: POST, OPTIONS");

$method = $_SERVER['REQUEST_METHOD'];
if ($method == "OPTIONS") {
    die();
}

$pdo = new Conexion();

function compressImage($source, $destination, $quality) { 
    // Obtenemos la información de la imagen
    $imgInfo = getimagesize($source); 
    $mime = $imgInfo['mime']; 
     
    // Creamos una imagen
    switch($mime){ 
        case 'image/jpeg': 
            $image = imagecreatefromjpeg($source); 
            break; 
        case 'image/png': 
            $image = imagecreatefrompng($source); 
            break; 
        case 'image/gif': 
            $image = imagecreatefromgif($source); 
            break; 
        default: 
            $image = imagecreatefromjpeg($source); 
    } 
     
    // Guardamos la imagen
    imagejpeg($image, $destination, $quality); 
     
    // Devolvemos la imagen comprimida
    return $destination; 
} 


if ($_SERVER['REQUEST_METHOD'] == 'POST') {


$idDesviacion = input_data($_POST["idDesviacion"]);
$descripcion = input_data($_POST["descripcion"]);
$idempresas = input_data($_POST["idempresas"]);
$idInspeccion = input_data($_POST["idInspeccion"]);
$Estado = input_data($_POST["estado"]);
$tipoH = input_data($_POST["tipoH"]);


// Ruta subida
$uploadPath = "../hallazgo/"; 
 


if(!empty($_FILES["picture"]["name"])) { 
    // File info 
    $fileName = time() . '_' . basename($_FILES['picture']['name']); 
    $imageUploadPath = $uploadPath . $fileName; 
    $fileType = pathinfo($imageUploadPath, PATHINFO_EXTENSION); 
     
    // Permitimos solo unas extensiones
    $allowTypes = array('jpg','png','jpeg','gif'); 
    if(in_array($fileType, $allowTypes)){ 
        // Image temp source 
        $imageTemp = $_FILES["picture"]["tmp_name"]; 
        
        $limitSize = 1600000;
        // Comprimos el fichero

     if(filesize($imageTemp) > $limitSize ){
        $compressedImage = compressImage($imageTemp, $imageUploadPath, 25); 
     }else{
        $compressedImage = @move_uploaded_file($_FILES['picture']['tmp_name'],$imageUploadPath);
     }
            
   

        
         
        if($compressedImage){ 
            $sql = "CALL insertarHallazgoAcc(:idDesviacion,:descripcion,:idempresas,:idInspeccion,:rutaEvidencia,:tipoH,:Estado)";
            $stmt = $pdo->prepare($sql);

            $stmt->bindValue(':idDesviacion', $idDesviacion);
            $stmt->bindValue(':descripcion', $descripcion);
            $stmt->bindValue(':idempresas', $idempresas);
            $stmt->bindValue(':idInspeccion', $idInspeccion);
            $stmt->bindValue(':rutaEvidencia', $imageUploadPath); 
            $stmt->bindValue(':tipoH',$tipoH);
            $stmt->bindValue(':Estado', $Estado); 
            

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
}else{ 
    $sql = "CALL insertarHallazgoAcc(:idDesviacion,:descripcion,:idempresas,:idInspeccion,:rutaEvidencia,:tipoH,:Estado)";
    $stmt = $pdo->prepare($sql);

    $stmt->bindValue(':idDesviacion', $idDesviacion);
    $stmt->bindValue(':descripcion', $descripcion);
    $stmt->bindValue(':idempresas', $idempresas);
    $stmt->bindValue(':idInspeccion', $idInspeccion);
    $stmt->bindValue(':rutaEvidencia','../assets/images/no-image.png'); 
    $stmt->bindValue(':tipoH',$tipoH);
    $stmt->bindValue(':Estado', $Estado);          

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
}else {
    header("HTTP/1.1 400 ok");
    echo json_encode("error");
    exit;
}



function input_data($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}



?>




