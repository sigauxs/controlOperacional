<?php

include("./include/typeAdmin.php");
require __DIR__ . '/vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

session_start();

if (!isset($_SESSION['usuarioId'])) {
    header('location: index.php');
}

$fullname = $_SESSION['primerNombre'] . " " . $_SESSION['segundoNombre'] . " " . $_SESSION['primerApellido'] . " " . $_SESSION['segundoApellido'];
$_SESSION['fullname'] = $fullname;

$tipoUsuario = $_SESSION['tipoUsuario'];

?>


<!DOCTYPE html>
<html lang="es-CO">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar inspección</title>
    <link href="//cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link href="./css/responsive.css" rel="stylesheet">
    <link href="./css/style.css" rel="stylesheet">

    <script src="//kit.fontawesome.com/2dd4f6d179.js" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <?php include("./components/brand.php") ?>
    <?php include("./components/navbar.php") ?>
    <?php include("./components/navbar-movil.php") ?>
    <div class="container-fluid container-fluid-sm">
        <div class="row title-sm">
            <div class="col-12">
                <h2 class="text-center encabezado_listado fw-bolder mt-5">Registrar inspección</h2>
                <hr class="hr_red mx-auto mt-3" style="border-radius:15px">
            </div>
        </div>
        <div class="row">
            <div class="offset-md-1 col-md-10">

                <div class="card mt-responsive mt-5 mx-auto div--center-border mb-3" style="z-index: 1;">


                    <div class="card-body bg-transparent">

                        <form id="formInspeccion" action="" method="POST" class="needs-validation" novalidate>

                            <div class="mb-3 row align-items-center ">
                                <div class="col-sm-12 col-md-4">
                                    <label for="fechaInspeccion" class="form-label">Fecha de inspección:</label>
                                    <input onchange="validarFecha()" type="date" name="fechaInspeccion" id="fechaInspeccion" class="form-control text-center" required>
                                </div>

                                <div class="col-sm-12 col-md-4">
                                    <label for="sedes" class="form-label"> Sede: </label>
                                    <select class="form-select" name="sede" id="sedes" aria-label="Default select example" required>
                                        <option value="" selected>Escoger una sede</option>
                                        <option value="1">Mina</option>
                                        <option value="2">Puerto</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        Selecciona una sede
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-4">
                                    <label for="locacion" class="form-label"> Locación: </label>
                                    <select class="form-select" name="locacion" id="locacion" aria-label="Default select example" required>
                                        <option value="" selected>Escoger una locación</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        Selecciona una locación
                                    </div>
                                </div>

                            </div>




                            <div class="mb-3 row align-items-center">
                                <div class="col-sm-12 col-md-4">
                                    <label for="vp_idSede" class="form-label"> Vicepresidencia: </label>
                                    <select class="form-select" name="vp" id="vp_idSede" name="vicepresidencia" aria-label="Default select example" required>
                                        <option value="" selected>Escoger una vicepresidencia</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        Selecciona una vicepresidencia
                                    </div>
                                </div>


                                <div class="col-sm-12 col-md-4">
                                    <label for="dpto" class="form-label"> Departamento :</label>
                                    <select class="form-select" id="dpto" name="dpto" name="departamento" aria-label="Default select example" required>
                                        <option value="" selected>Escoger un departamento</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        Selecciona un departamento
                                    </div>
                                </div>

                                <div class="col-sm-12 col-md-4 ">
                                    <label for="area" class="form-label"> Área : </label>
                                    <select class="form-select" name="area" id="area" aria-label="Default select example" required>
                                        <option value="" selected>Escoger un área</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        Selecciona un área
                                    </div>
                                </div>


                            </div>


                            <div class="mb-3 row align-items-center">

                                <div class="col-sm-12 col-md-6">
                                    <label for="inspector" class="form-label"> Inspector :</label>
                                    <select id="inspector" class="form-select" name="inspector" aria-label="Default select example" required>
                                        <option <?php echo "value='" . $_SESSION['usuarioId']; ?> <?php echo "'" ?> selected><?php echo $fullname ?></option>
                                    </select>
                                </div>


                                <div class="col-sm-12 col-md-6">
                                    <label for="turno" class="form-label"> Turno :</label>
                                    <select value="" class="form-select" id="turno" name="turno" aria-label="Default select example" required>
                                        <option selected value="">Escoger un turno</option>
                                        <option value="1">Día</option>
                                        <option value="2">Noche</option>

                                    </select>
                                </div>


                            </div>




                            <div class="mb-3 row align-items-center">

                                <div class="col-sm-12 col-md-6">
                                    <label for="delegado" class="form-label"> Delegado del área </label>
                                    <select class="form-select" id="delegado" name="delegado" aria-label="Default select example" required>
                                        <option value="" selected>Escoger un delegado de área</option>
                                    </select>
                                </div>

                                <div class="col-sm-12 col-md-6">
                                    <label for="responsable" class="form-label"> Responsable del área </label>
                                    <select class="form-select" id="responsable" name="responsable" aria-label="Default select example" required>
                                        <option value="" selected>Escoger un responsable de área</option>
                                    </select>
                                </div>


                            </div>



                            <div class="mb-3 row">

                                <div class="col-sm-12 col-md-12 mb-3">
                                    <label for="description_inspeccion" class="form-label"> Actividad </label>
                                    <textarea id="description_inspeccion" class="form-control" name="descripcion" id="descripcionInspeccion" cols="30" rows="5" maxlength="300" required></textarea>
                                </div>

                            </div>



                            <div class="mb-3 row">

                                <div class="d-grid gap-2 col-sm-12 col-md-4 offset-md-2 my-3">

                                    <button id="registrarInspeccion" class="btn btn-danger btn-login  btn-lg  fw-bolder" type="submit" style="border-radius: 10px;">Registrar</button>



                                </div>
                                <div class="d-grid gap-2 col-sm-12 col-md-4 my-3">
                                    <a href="menu.php" id="Cancelar" class="btn  btn-lg  fw-bolder btn-consultar   btn-lg     btn-consultar--border" style="border-radius: 10px;">Cancelar</a>
                                </div>


                            </div>

                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-1"></div>
        </div>
    </div>
    <script>
        const URL_ENV = "<?php echo $_ENV['URL'] ?>";
    </script> <!-- Variable Entorno Enlace  -->
    <script src="//code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <script src="./js/defaultValue.js"></script>
    <script src="./js/services_select.js"></script>
    <script>
            
        function validarFecha( ) {
            let fechaInput     = document.getElementById("fechaInspeccion");  
            let fechaActual    = new Date();
            let fechaIngresada = new Date(fechaInput.value);
            if (fechaIngresada > fechaActual) {
                alert("La fecha ingresada es posterior a la fecha actual, vuelva a ingresar una fecha valida");
                
                $("#fechaInspeccion").val("");
              
                return false;
            }
            return true;

        }


        document.addEventListener("DOMContentLoaded", () => {
            $('#registrarInspeccion').attr('disabled', true);
        })

        let rgInspeccion = document.querySelector("#formInspeccion");
        rgInspeccion.addEventListener("change", (e) => {

            let fecha = rgInspeccion.elements['fechaInspeccion'].value;
            let area = rgInspeccion.elements['area'].value;
            let sedes = rgInspeccion.elements['sedes'].value;
            let locacion = rgInspeccion.elements['locacion'].value;
            let turno = rgInspeccion.elements['turno'].value;
            let delegado = rgInspeccion.elements['delegado'].value;
            let responsable = rgInspeccion.elements['responsable'].value;
            let descripcion = rgInspeccion.elements['description_inspeccion'].value;

            if (fecha != "" && area != "" && sedes != "" && locacion != "" && turno != "" && delegado != "" && responsable != "" && descripcion != "") {
                console.log("llenaste los campos")
                $('#registrarInspeccion').attr('disabled', false);
            }

        })



        let formInspeccion = document.getElementById("formInspeccion");
        const url_registro_inspeccion = `${URL_ENV}/server/inspeccionRegister.php`;

        //"http://controlope.sigpeconsultores.com.co/server/inspeccionRegister.php"

        const RegistrarHallazgo = async () => {
            let response = await fetch(url_registro_inspeccion, {
                method: 'POST',
                body: new FormData(formInspeccion)
            });
            let data = await response.json();
            return data;
        }

        let btnregistrar = document.getElementById("registrarInspeccion");

        btnregistrar.addEventListener("click", (e) => {

            let fecha = rgInspeccion.elements['fechaInspeccion'].value;
            let descripcion = rgInspeccion.elements['description_inspeccion'].value;

            if (fecha == "" | undefined) {
                alert('Ingrese una fecha valida');
                return false;
            }

            if (descripcion == "" | undefined) {
                alert('Ingresa una actividad');
                return false;
            }

            e.preventDefault();
            RegistrarHallazgo().then(response => {
                if (response == "success") {
                    Swal.fire({
                        title: 'Inspeccion registrada',
                        text: "Deseas ingresar hallazgo a la inspección registrada.",
                        icon: 'success',
                        showCancelButton: true,
                        cancelButtonText: 'No',
                        confirmButtonColor: '#E31D38',
                        cancelButtonColor: 'rgb(149,149,149)',
                        confirmButtonText: 'Si'
                    }).then((result) => {
                        if (!result.isConfirmed) {
                            location.href = `${URL_ENV}/menu.php`;
                        } else {
                            location.href = `${URL_ENV}/hallazgo2.php`;
                        }
                    })
                }
            })


        })
    </script>
    <script>
        (function() {
            'use strict'

            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.querySelectorAll('.needs-validation')

            // Loop over them and prevent submission
            Array.prototype.slice.call(forms)
                .forEach(function(form) {
                    form.addEventListener('submit', function(event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }

                        form.classList.add('was-validated')
                    }, false)
                })
        })()
    </script>
</body>

</html>