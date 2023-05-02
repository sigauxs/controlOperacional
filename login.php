<?php


include("/connection/connection.php");

$pdo = new Conexion();
$pdo_person = new Conexion();

session_start();

if(isset($_POST['loguear'])){

    if (isset($_POST[ 'email']) && isset($_POST['clave'])) {

        $email = $_POST['email'];
        $password = $_POST['clave'];
    
        $sql = "CALL Usuario_Registrado(:email,:password)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':password', $password);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_NUM);
        
      
    
        if ($row) {
            
            $idUsuario = $row[0];
            $idPerson = $row[1];
            $tipoUsuario = $row[2];
            $rol = $row[3];
    
            
            $_SESSION['rol'] = $rol;
            $_SESSION['usuarioId']  = $idUsuario;
            $_SESSION['personId'] = $idPerson;
            $_SESSION['tipoUsuario'] = $tipoUsuario;
                             
          
                
            $sql_person = "SELECT * FROM personas WHERE idPersona = :idPerson";
            $stmt_person = $pdo_person->prepare($sql_person);
            $stmt_person->bindValue(':idPerson', $idPerson);
            $stmt_person->execute();
            $row_person = $stmt_person->fetch(PDO::FETCH_NUM);
              
            $primer_nombre = $row_person[0];
            $segundo_nombre = $row_person[1];
            $primer_apellido = $row_person[2];
            $segundo_apellido = $row_person[3];
    
                
            $_SESSION['primerNombre'] = $primer_nombre;
            $_SESSION['segundoNombre']  = $segundo_nombre;
            $_SESSION['primerApellido'] = $primer_apellido;
            $_SESSION['segundoApellido'] = $segundo_apellido;
    
           
         
         header('location: menu.php');
         $pdo= null;
   
            
        } else {
            
           $SESSION['messages'] = true;
          header('location:index.php');
                $pdo=null;
                $pdo_person=null;
        }
    
        $pdo= null;
        $pdo_person=null;
    }
    


}



$_SESSION['data'] = true ;
$_SESSION['message'] = "";




/*  */
?>
