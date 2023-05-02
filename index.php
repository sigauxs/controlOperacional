<?php

include("./connection/connection.php");

$pdo = new Conexion();
$pdo_person = new Conexion();

session_start();

$_SESSION['data'] = true;
$_SESSION['message'] = "";

if (isset($_POST['email']) && isset($_POST['clave'])) {

    $email = $_POST['email'];
    $password = $_POST['clave'];

    $sql = "CALL Usuario_Registrado(:email,:password);";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':email', $email);
    $stmt->bindValue(':password', $password);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_NUM);

    echo var_dump($row);

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
        $pdo = null;
    } else {

        $SESSION['messages'] = true;

        $pdo = null;

        $pdo_person = null;
    }

    $pdo = null;
    $pdo_person = null;
}

?>



<!DOCTYPE html>
<html lang="es-CO">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Control Operacional</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="./css/responsive.css" rel="stylesheet">
    <link href="./css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <script src="https://kit.fontawesome.com/2dd4f6d179.js" crossorigin="anonymous"></script>
    <style>
        #lleft {
            width: 100%;
            height: 100%;
            display: block;
            position: relative;
            background-color: rgba(227, 25, 55, 0.78);
            
        }

        #lleft::after {
            content: "";
            background-image: url("assets/images/lleft.png");
            opacity: 0.5;
            top: 0;
            left: 0;
            bottom: 0;
            right: 0;
            position: absolute;
            z-index: -1;
            background-position: center; /* Center the image */
            background-repeat: no-repeat; /* Do not repeat the image */
            background-size: cover; 
            
        }
        #lleft p {
            font-size: 3.2vw;
            font-weight: bolder;
            line-height: 1.2;
        }

        #lleft div {
            margin: 0;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }
        #lleft div img {
            width: 12.5vw;
        }

        #lleft div hr {
            margin-bottom: 10px;
            height: 4px;
            color: white;
            opacity: 1;
        }

        #right {
          
        }


    </style>
</head>

<body>

    <div class="container-fluid ps-0 vh-100" id="login">
        <div class="row vh-100">
            <div class="col-md-6">
                <div id="lleft">
                    <div>
                        <img src="assets/images/sigpe_1.png"  alt="logo">
                        <hr>
                        <p class="mb-0 text-white">CONTROL</p>
                        <p class="mb-0 text-white">OPERACIONAL</p>
                        <hr>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="animate__animated animate__fadeIn animate__slower" id="right" style="z-index:-1">

                    <div class="div--center-images w-card mx-auto" style="position: relative">
                        <div style="width:200px; height:200px; background-color:transparent" class="mx-auto">

                        </div>
                    </div>
                    <div class="card mt-responsive mx-auto div--center-border  card-login mb-3">

                        <div class="card-body r-20">



                            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" id="login" class="needs-validation" novalidate>
                                <div class="mb-3 mt-100 row">
                                    <div class="col-sm-12 mb-3">
                                        <input type="email" id="email" name="email" class="useFontAwesomeFamily form-control" placeholder="&#xf406;   Usuario" required>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <div class="col-sm-12 mb-3">
                                        <input type="password" id="password" name="clave" class="useFontAwesomeFamily form-control" placeholder="&#xf084;   Clave" required>
                                        <div class="invalid-feedback">
                                            Ingrese un usuario o contraseña valida.
                                        </div>
                                    </div>

                                </div>



                                <div class="mb-3 row">
                                    <div class="col-sm-12 mb-2">
                                        <div class="d-grid gap-2">

                                            <button class="btn btn-danger btn-login rounded-pill fw-bolder" type="submit" name="loguear">Ingresar</button>





                                        </div>
                                    </div>
                                </div>

                            </form>


                            <form method="" action="" id="">

                                <div class="mb-3 row">
                                    <div class="col-sm-4 mb-3">
                                        <label for="recuerdame" class="remember-text">
                                            <input type="checkbox" id="recuerdame" name="recuerdame" class="remember-text" placeholder="" style="accent-color:#e31937; position:relative; top:2.5px">
                                            Recuerdame</label>
                                    </div>


                                    <div class="col-sm-8 mb-3 text-center">
                                        <a href="#" class="forgot">¿Olvidaste tu contraseña? </a>
                                    </div>

                                </div>

                            </form>

                        </div>
                        <div class="card-footer card-footer-t">
                            <hr class="mx-auto">
                        </div>
                    </div>
                </div>

            </div>
        </div>


        <div class="row">

        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <script src="./js/validate.js"></script>
    <script>
        let login = document.getElementById("login");

        setTimeout(() => {
            let img_banner = document.getElementById("img_banner");
            img_banner.classList.add("animate__animated", "animate__fadeOut", "animate__slow");

        }, 3000)
        setTimeout(() => {
            let img_banner = document.getElementById("img_banner");
            img_banner.setAttribute("style", "width:0");
        }, 4500)
    </script>




</body>

</html>

<?php


/*
if (isset($_POST['loguear'])) {

    echo  "<div style='width:325px' class='alert alert-danger alert-dismissible fade show mx-auto mb-2' role='alert'>

              Usuario y/o contraseña incorrecta.

             <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>

            </div>";
}*/



?>