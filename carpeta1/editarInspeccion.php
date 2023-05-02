<?php

include("./include/typeAdmin.php");

session_start();

if (!isset($_SESSION['usuarioId'])) {
    header('location: index.php');
}

$idInspeccion = $_GET['idInspeccion'];

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
    <title>Control Operacional</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link href="./css/responsive.css" rel="stylesheet">
    <link href="./css/style.css" rel="stylesheet">

    <script src="https://kit.fontawesome.com/2dd4f6d179.js" crossorigin="anonymous"></script>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>

    <?php include("./components/brand.php") ?>
    <?php include("./components/navbar-movil.php") ?>
    <?php include("./components/navbar.php") ?>

    <div class="container-fluid container-fluid-sm">

        <div class="row">
            <div class="col-12">
                <h2 class="text-center encabezado_listado fw-bolder mt-5">Editar inspección</h2>
                <hr class="hr_red mx-auto" style="border-radius:15px">
            </div>
        </div>

        <div class="row">
            <div class="offset-md-1 col-md-10">

                <div class="card mt-responsive mt-5 mx-auto div--center-border mb-3" style="z-index: 1;">


                    <div class="card-body bg-transparent">

                        <form id="formInspeccion" action="" method="POST" class="needs-validation" novalidate>

                            <div class="row">
                                <input type="hidden" name="idInspeccion" value="<?php echo $idInspeccion; ?>">
                            </div>

                            <div class="mb-3 row align-items-center ">
                                <div class="col-sm-12 col-md-4">
                                    <label for="fechaInspeccion" class="form-label">Fecha inspección:</label>
                                    <input type="date" name="fechaInspeccion" id="fechaInspeccion" class="form-control text-center" required>
                                </div>

                                <div class="col-sm-12 col-md-4">
                                    <label for="sedes" class="form-label"> Sede: </label>
                                    <select class="form-select" name="sede" id="sedes" aria-label="Default select example" required>
                                        <option value="" selected>Escoger un Sede</option>
                                        <option value="1">Mina</option>
                                        <option value="2">Puertos</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        Selecciona una Sede
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-4">
                                    <label for="locacion" class="form-label"> locación: </label>
                                    <select class="form-select" name="locacion" id="locacion" aria-label="Default select example" required>
                                        <option value="" selected>Escoger un locación</option>
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
                                        <option value="" selected>Escoger un Vicepresidencia</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        Selecciona una vicepresidencia
                                    </div>
                                </div>


                                <div class="col-sm-12 col-md-4">
                                    <label for="dpto" class="form-label"> Departamento :</label>
                                    <select class="form-select" id="dpto" name="dpto" name="departamento" aria-label="Default select example" required>
                                        <option value="" selected>Escoger un Departamento</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        Selecciona un Departamento
                                    </div>
                                </div>

                                <div class="col-sm-12 col-md-4 ">
                                    <label for="area" class="form-label"> Área : </label>
                                    <select class="form-select" name="area" id="area" aria-label="Default select example" required>
                                        <option value="" selected>Escoger un área</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        Selecciona un Area
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
                                        <option selected value="">Escoger un Turno</option>
                                        <option value="1">Dia</option>
                                        <option value="2">Noche</option>

                                    </select>
                                </div>


                            </div>




                            <div class="mb-3 row align-items-center">

                                <div class="col-sm-12 col-md-6">
                                    <label for="delegado" class="form-label"> Delegado del Área </label>
                                    <select class="form-select" id="delegado" name="delegado" aria-label="Default select example" required>
                                        <option value="" selected>Escoger un delegado de área</option>
                                    </select>
                                </div>

                                <div class="col-sm-12 col-md-6">
                                    <label for="responsable" class="form-label"> Responsable del Área </label>
                                    <select class="form-select" id="responsable" name="responsable" aria-label="Default select example" required>
                                        <option value="" selected>Escoger un responsable de área</option>
                                    </select>
                                </div>


                            </div>



                            <div class="mb-3 row">

                                <div class="col-sm-12 col-md-12 mb-3">
                                    <label for="actividad" class="form-label"> Actividad </label>
                                    <textarea id="actividad" class="form-control" name="actividad" cols="30" rows="5" required></textarea>
                                </div>

                            </div>



                            <div class="mb-3 row">

                                <div class="d-grid gap-2 col-sm-12 col-md-4 offset-md-2">

                                    <button id="updateInspeccion" class="btn btn-danger btn-login  btn-lg  fw-bolder" type="button" style="border-radius: 10px;">Guardar</button>



                                </div>
                                <div class="d-grid gap-2 col-sm-12 col-md-4">
                                    <a href="menu.php" id="Cancelar" class="btn  btn-lg  fw-bolder btn-consultar   btn-lg     btn-consultar--border" style="border-radius: 10px;">Cancelar</a>
                                </div>


                            </div>

                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-1"></div>
        </div>



        <div class="row">
            <div class="container">
                <div class="row">
                    <div class="col-md-1"></div>
                    <div class="col-md-10">
                  
                        <?php 
                    
                        include("./ListaHallazgos.php") 
                        
                        ?>
                    </div>
                    <div class="col-md-2"></div>
                </div>
            </div>

        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>


    <script>
        let updateInspeccion = document.getElementById("updateInspeccion");
        let formUpdateInspeccion = document.querySelector("#formInspeccion");



        updateInspeccion.addEventListener("click", () => {

            let idInspeccion = formUpdateInspeccion.elements['idInspeccion'].value;
            let fechaInspeccion = formUpdateInspeccion.elements['fechaInspeccion'].value;
            let area = formUpdateInspeccion.elements['area'].value;
            let turno = formUpdateInspeccion.elements['turno'].value;
            let delegado = formUpdateInspeccion.elements['delegado'].value;
            let responsable = formUpdateInspeccion.elements['responsable'].value;
            let actividad = formUpdateInspeccion.elements['actividad'].value;

            updateInspeccionFetch(idInspeccion, fechaInspeccion, area, turno, delegado, responsable, actividad)
                .then(response => {
                    if (response == "success") {
                        Swal.fire({
                            position: 'top',
                            icon: 'success',
                            title: 'Inspección actualizada',
                            showConfirmButton: false,
                            timer: 1500
                        })
                    }
                });



        })





        const updateInspeccionFetch = async (idInspeccion, fechaInspeccion, area, turno, delegado, responsable, actividad) => {

            const options = {
                method: "PUT",
                headers: {
                    "Content-Type": "application/json",
                },
                body: JSON.stringify({
                    idInspeccion: idInspeccion,
                    fechaInspeccion: fechaInspeccion,
                    area: area,
                    turno: turno,
                    delegado: delegado,
                    responsable: responsable,
                    actividad: actividad
                })
            };

            let url_update_inspeccion = "https://sigpeco.sigpeconsultores.com.co/server/inspeccionUpdate.php";
            let response = await fetch(url_update_inspeccion, options);
            let data = await response.json();

            return data;

        };


        document.addEventListener("DOMContentLoaded", () => {
            let idInspeccion = <?php echo $idInspeccion ?>;
            let formEditarInspeccion = document.querySelector("#formInspeccion");


            const fetchDataSelect = async (vp_idsede, dpto, area, selector, locacion) => {
                const options = {
                    method: "GET",
                    headers: {
                        "Content-Type": "application/json",
                    },
                };


                var url = new URL("https://sigpeco.sigpeconsultores.com.co/server/inspeccion-server.php");

                var params = {
                    vp_idsede: vp_idsede,
                    dpto: dpto,
                    area: area,
                    locacion: locacion
                };

                url.search = new URLSearchParams(params).toString();
                console.log(url);
                const sedes = await fetch(url, options)
                    .then((response) => response.json())
                    .then((data) => renderSelect(data, selector));

            };

            function renderSelect(values, selector) {

                const select = document.querySelector(selector);
                const textSelect = select.children[0].text


                $(`${selector} option`).remove();

                let defaultOption = document.createElement("option");
                defaultOption.value = "";
                defaultOption.text = textSelect;
                defaultOption.selected = true;
                select.appendChild(defaultOption);

                for (option of values) {
                    const newOption = document.createElement("option");
                    let data = Object.values(option);
                    newOption.value = data[0];
                    newOption.text = data[1];
                    select.appendChild(newOption);
                }
            }


            getinspeccion(idInspeccion)
                .then(resp => {
                    console.log(resp);
                    let dpto = resp[0]['DEPARTAMENTO'];

                    fetchDataSelect("", "", dpto, "#area", "");

                    setTimeout(() => {
                        formEditarInspeccion.elements['fechaInspeccion'].value = resp[0]['FECHA'];
                        formEditarInspeccion.elements['sedes'].value = resp[0]['SEDE'];
                        formEditarInspeccion.elements['actividad'].value = resp[0]['ACTIVIDAD'];
                        formEditarInspeccion.elements['turno'].value = resp[0]['TURNO'];
                        formEditarInspeccion.elements['area'].value = resp[0]['AREA'];
                    }, 350)

                  

                })
        })

        const getinspeccion = async (idInspeccion) => {
            const options = {
                method: "GET",
                headers: {
                    "Content-Type": "application/json",
                },
            };

            var url_get_inspeccion = new URL("https://sigpeco.sigpeconsultores.com.co/server/getinspeccion.php");
            var params = {
                idInspeccion: idInspeccion
            };

            url_get_inspeccion.search = new URLSearchParams(params).toString();
            console.log(url_get_inspeccion);

            let response = await fetch(url_get_inspeccion, options);
            let data = await response.json();
            return data;

        };
    </script>
    <script src="./js/services_select_edit.js"></script>
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