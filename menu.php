<?php

include_once("./include/typeAdmin.php");
require __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();


session_start();

if (!isset($_SESSION['usuarioId'])) {
    header('location: index.php');
}

$tipoUsuario = $_SESSION['tipoUsuario'];


?>


<!DOCTYPE html>
<html lang="es-CO">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Control Operacional</title>
    <link href="//cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link href="./css/responsive.css" rel="stylesheet">
    <link href="./css/style.css" rel="stylesheet">
    <script src="//kit.fontawesome.com/2dd4f6d179.js" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11" defer></script>
</head>

<body>



    <?php if (typeAdmin($tipoUsuario) || typeSafety($tipoUsuario)) { ?>
        <?php include("./components/navbar.php") ?>
        <?php include("./components/brand.php") ?>
    <?php } ?>
    <div class="container container-sm">
        <div class="row">
            <div class="col text-center">
                <h2 class="mt-5 head-menu">Menu principal</h2>
                <hr class="hr_red mx-auto mb-5" style="border-radius:15px">
            </div>
        </div>
        <div class="row animate__animated animate__fadeInDown animate__slow">

            <?php if (typeAdmin($tipoUsuario) || typeSafety($tipoUsuario)) { ?>
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

                <div class="col-sm-6 col-md-6 text-center">
                    <a id="btn-report" class="text-link text-link--mt" data-bs-toggle="modal" data-bs-target="#reporteador">
                        <img src="./assets/images/db.png" alt="iconos" class="img-menu mt-1 menu-img p-0">
                        <hr class="hr_red mx-auto mb-3" style="border-radius:15px; width:70px; margin-top:35px">
                        <p class="head-listado"> Reporteador </p>

                    </a>
                </div>
            <?php } ?>

            <?php if (typeAdmin($tipoUsuario) || typeSafety($tipoUsuario)) { ?>
                <div class="col-sm-6 col-md-6 text-center">
                    <a class="text-link text-link--mt" href="./informe.php" target="_blank">
                        <img src="./assets/images/indicador.png" alt="iconos" class="img-menu mt-1 menu-img alert p-0">
                        <hr class="hr_red mx-auto mb-3" style="border-radius:15px; width:70px; margin-top:35px">
                        <p class="head-listado"> Indicadores </p>

                    </a>
                </div>
            <?php } ?>


            <?php if (typeAdmin($tipoUsuario)) { ?>
                <div class="col-sm-6 col-md-6 text-center mt-2">
                    <a href="<?php echo $_ENV['URL'] ?>/empresas/lista.php" class="text-link text-link--mt">
                        <img src="./assets/images/empresas.png" alt="iconos" class="img-menu mt-1 menu-img p-0">
                        <hr class="hr_red mx-auto mb-3" style="border-radius:15px; width:70px; margin-top:35px">
                        <p class="head-listado"> Empresas </p>
                    </a>
                </div>



                <div class="col-sm-6 col-md-6 text-center mt-2">
                    <a href="<?php echo $_ENV['URL'] ?>/usuarios/lista.php" class="text-link text-link--mt">
                        <img src="./assets/images/usuario.png" alt="iconos" class="img-menu mt-1 menu-img p-0 alert">
                        <hr class="hr_red mx-auto mb-3" style="border-radius:15px; width:70px; margin-top:35px">
                        <p class="head-listado"> Usuarios </p>
                    </a>
                </div>

                <div class="col-sm-6 col-md-6 text-center mt-2">
                    <a href="./fpcd/lista.php" class="text-link text-link--mt">
                        <img src="./assets/images/fpcd.png" alt="iconos" class="img-menu mt-1 menu-img p-0 alert">
                        <hr class="hr_red mx-auto mb-3" style="border-radius:15px; width:70px; margin-top:35px">
                        <p class="head-listado"> Gestionar FPCD </p>
                    </a>
                </div>


            <?php } ?>

         
            <div class="col-sm-6 col-md-6 text-center mt-2">
                    <a href="./fpcd/lista.php" class="text-link text-link--mt" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        <img src="./assets/images/cambiarclave.png" alt="iconos" class="img-menu mt-1 menu-img p-0 alert">
                        <hr class="hr_red mx-auto mb-3" style="border-radius:15px; width:70px; margin-top:35px">
                        <p class="head-listado"> Cambiar Contraseña </p>
                    </a>
            </div>

        </div>
    </div>



    <!-- Cambio de contraseña -->

    <!-- Button trigger modal 
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Launch demo modal
    </button>

   -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content bg-modal text-white">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Cambiar Contraseña</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="">


                    <div class="modal-body bg-light">
                        <div class="mb-3">
                            <label for="cambiarClave" class="form-label">Ingresa una nueva contraseña:</label>
                            <input type="text" name="cambiarClave" class="form-control" id="cambiarClave">
                        </div>
                    </div>
                    <div class="modal-footer bg-light">
                        <div class="row">
                            <div class="col-6">
                                <button id="btnCambiarPassword" type="click" style="width:100%; margin:0 " class="btn btn-save one-hundred" data-bs-dismiss="modal">Cambiar</button>
                            </div>

                            <div class="col-6">
                                <button type="button" style="width:100%; margin:0 " class="btn  btn-file btn-cancel dismiss" data-bs-dismiss="modal">Cancelar</button>
                            </div>

                        </div>
                    </div>


                </form>

            </div>
        </div>
    </div>
    <!-- end -->

    <!-- Modal -->
    <div class="modal fade" id="reporteador" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-modal text-white">
                    <h5 class="modal-title " id="exampleModalLabel">Reporteador</h5>
                    <button type="button" class="btn-close dismiss" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form action="./reporteExcel.php" method="POST" id="reporte">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">De:</label>
                            <input type="date" name="fechaInicio" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Hasta:</label>
                            <input type="date" name="fechaFinal" class="form-control" id="exampleInputPassword1">
                        </div>
                    </div>
                    <div class="modal-footer" style="display:block">
                        <div class="row">
                            <div class="col-6">
                                <button type="submit" style="width:100%; margin:0 " class="btn btn-save one-hundred" data-bs-dismiss="modal">Descargar</button>
                            </div>

                            <div class="col-6">
                                <button type="button" style="width:100%; margin:0 " class="btn  btn-file btn-cancel dismiss" data-bs-dismiss="modal">Cancelar</button>
                            </div>

                        </div>



                    </div>
                </form>

            </div>
        </div>
    </div>





    <script>
        const URL_ENV_MENU = "<?php echo $_ENV['URL'] ?>";
    </script>
    <script src="//code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <script>
        const usuario = Number("<?php echo $_SESSION['usuarioId']; ?>");
        const clave = document.getElementById("cambiarClave");
        const btnCambiarPassword = document.getElementById("btnCambiarPassword");

        const actualizarClave = async (idUsuario, password) => {

            const options = {
                method: "PUT",
                headers: {
                    "Content-Type": "application/json",
                },
                "body": JSON.stringify({
                    idUsuario: idUsuario,
                    password: password
                })
            };


            let url = `${URL_ENV_MENU}/server/changepassword.php`;
            console.log(url)
            const response = await fetch(url, options);
            const respuesta = await response.json();

            return respuesta;
        }

        btnCambiarPassword.addEventListener("click", (e) => {
            e.preventDefault();

            if( clave.value == ""){
                alert("Ingresa una contraseña nueva");
                return;
            }

            Swal.fire({
                title: '¿Desea cambiar la contraseña?',
                text: "Esta accion no podra ser revertida, debera iniciar sesion nuevamente",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#E31D38',
                cancelButtonColor: 'rgb(149,149,149)',
                cancelButtonText: 'No',
                confirmButtonText: 'Si'
            }).then((result) => {
                if (result.isConfirmed) {
                    actualizarClave(usuario, clave.value).then(respuesta => {
                        clave.value = " ";
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'Contraseña cambiada exitosamente',
                            showConfirmButton: false,
                            timer: 1500
                        })
                        setTimeout(() => {
                            if (respuesta == "success") {

                                location.href = `${URL_ENV_MENU}/index.php`;
                            }
                        }, 1650)


                    })


                }
            });
        })



        let navbarFloat = document.getElementById("navbarFloat");
        navbarFloat.style.display = "none";

        $("#btn-report").click(function() {
            formReporte[0].value = "";
            formReporte[1].value = "";
        });

        let formReporte = document.getElementById("reporte");

        $(".dismiss").click(function() {
            formReporte[0].value = "";
            formReporte[1].value = "";
        });
    </script>
</body>

</html>