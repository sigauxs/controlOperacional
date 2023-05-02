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

if ($method == 'GET') {

        $identification = $_GET['identification'];

        $sql = "SELECT Email as 'email', Password as 'clave', Cargo_idCargo as 'cargo' , Estado as 'estado' , Tipo_Usuario_idTipo as 'tipoUsuario' , Rol_De_Usuario as 'rol' FROM usuarios WHERE Persona_idPersona = :identification";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':identification',$identification);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);

        header('HTTP/1.1 200 OK');
        echo json_encode($stmt->fetchAll());

}
        

if ($method == 'PUT') {


            $jsonClient = json_decode(file_get_contents("php://input"));
        
        
            if (!$jsonClient) {
                exit("No day datos para actualizar");
            }
        
        
            $sql = "UPDATE usuarios SET Email = :email , Password = :password, Cargo_idCargo = :cargo , Tipo_Usuario_idTipo = :tipousuario , Rol_De_Usuario = :rol , Estado = :estado  WHERE Persona_idPersona = :identificacion";
            $stmt = $pdo->prepare($sql);

            $stmt->bindValue(':email', $jsonClient->email);
            $stmt->bindValue(':password', $jsonClient->password);
            $stmt->bindValue(':cargo', $jsonClient->cargo);
            $stmt->bindValue(':tipousuario', $jsonClient->tipousuario);
            $stmt->bindValue(':rol', $jsonClient->rol);
            $stmt->bindValue(':estado',$jsonClient->estado);
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
