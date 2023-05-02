<?php

include_once("./include/typeAdmin.php");

session_start();
/*
if (!isset($_SESSION['usuarioId'])) {
    header('location: index.php');
}

$tipoUsuario = $_SESSION['tipoUsuario'];*/


?>


<!DOCTYPE html>
<html lang="es-CO">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Control Operacional</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link href="./css/responsive.css" rel="stylesheet">
    <link href="./css/style.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/2dd4f6d179.js" crossorigin="anonymous"></script>
</head>

<body>
<?php include("./components/navbar.php") ?>
<?php include("./components/brand.php") ?>
    <div class="container container-sm">
        <div class="row">
            <div class="col text-center">
                <h2 class="mt-5 head-menu">Menu principal</h2>
                <hr class="hr_red mx-auto mb-5" style="border-radius:15px">
            </div>
        </div>
        <div class="row animate__animated animate__fadeInDown animate__slow">

        <div class="col-sm-6 col-md-6 text-center">
                <a href="./inspeccion.php" class="text-link text-link--mt">
                    <img src="./assets/images/add.png" alt="iconos" class="img-menu mt-1 menu-img">
                    <hr class="hr_red mx-auto mb-3" style="border-radius:15px; width:70px; margin-top:35px">
                    <p class="head-listado"> Nueva inspección </p>
                   
                </a>
            </div>
        
            <div class="col-sm-6 col-md-6 text-center">
                <a href="./ListaInspecciones.php" class="text-link text-link--mt">
                    <img src="./assets/images/lista.png" alt="iconos" class="img-menu mt-1 menu-img">
                    <hr class="hr_red mx-auto mb-3" style="border-radius:15px;  width:70px; margin-top:35px">
                    <p class="head-listado"> Listado de inspecciones </p>
                   
                </a>
            </div>
           
           
        
        </div>
    </div>




    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
</body>

</html>