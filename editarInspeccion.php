<?php

include("./include/typeAdmin.php");
require __DIR__ . '/vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();


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
    <title>Edita inspeccion</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link href="./css/responsive.css" rel="stylesheet">
    <link href="./css/style.css" rel="stylesheet">

    <script src="https://kit.fontawesome.com/2dd4f6d179.js" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>

    <?php include("./components/brand.php") ?>
    <?php include("./components/navbar-movil.php") ?>
    <?php include("./components/navbar.php") ?>

    <div class="container-fluid container-fluid-sm">

        <div class="row title-sm">
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
                                    <label for="fechaInspeccion" class="form-label">Fecha de inspección:</label>
                                    <input onblur="validarFecha()" type="date" name="fechaInspeccion" id="fechaInspeccion" class="form-control text-center" required>
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
                                        <option value="1">Dia</option>
                                        <option value="2">Noche</option>

                                    </select>
                                </div>


                            </div>




                            <div class="mb-3 row align-items-center">

                                <div class="col-sm-12 col-md-6">
                                    <label for="delegado" class="form-label"> Delegado del área / Acompañante </label>
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
                                    <label for="actividad" class="form-label"> Actividad </label>
                                    <textarea id="actividad" class="form-control" name="actividad" cols="30" rows="5" required></textarea>
                                </div>

                            </div>



                            <div class="mb-3 row">

                                <div class="d-grid gap-2 col-sm-12 col-md-4 offset-md-2 my-3">

                                    <button id="updateInspeccion" class="btn btn-danger btn-login  btn-lg  fw-bolder" type="button" style="border-radius: 10px;">Guardar</button>



                                </div>
                                <div class="d-grid gap-2 col-sm-12 col-md-4 my-3">
                                    <a href="./ListaInspecciones.php" id="Cancelar" class="btn  btn-lg  fw-bolder btn-consultar   btn-lg     btn-consultar--border" style="border-radius: 10px;">Cancelar</a>
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


   <script>


        function validarFecha() {
            let fechaInput     = document.getElementById("fechaInspeccion").value;
            let fechaActual    = new Date();
            let fechaIngresada = new Date(fechaInput);
            if (fechaIngresada > fechaActual) {
                alert("La fecha ingresada es posterior a la fecha actual, vuelva a ingresar una fecha valida");
                return false;
            }
            return true;

        }


       const fechDataArea = async () => {

            const options = {
                method: "GET",
                headers: {
                    "Content-Type": "application/json",
                },
            };

            var url = new URL(`${URL_ENV}/api/inspeccionUD.php`);
            var params = {
                opciones: 2
            };
            url.search = new URLSearchParams(params).toString();

            const response = await fetch(url, options);
            const data = await response.json();
            return data;

        }

        let area_i = document.getElementById("area");
        let formUpdateInspeccion_iu = document.querySelector("#formInspeccion");


        fechDataArea().then(areas => {
            areas.map((area) => {
                const newOption = document.createElement("option");
                let data = Object.values(area);
                newOption.value = data[0];
                newOption.text = data[1];
                area_i.appendChild(newOption);
            })
            
            
          if(areas != "" && areas != 0){
              
               

                     
          
          }

        })
        

        
        
        

        const fechDataVP = async () => {

            const options = {
                method: "GET",
                headers: {
                    "Content-Type": "application/json",
                },
            };

            var url = new URL(`${URL_ENV}/api/inspeccionUD.php`);
            var params = {
                opciones: 0
            };
            url.search = new URLSearchParams(params).toString();

            const response = await fetch(url, options);
            const data = await response.json();
            return data;

        }

        let vp_s = document.getElementById("vp_idSede");

        fechDataVP().then(vps => {
            vps.map((vp) => {
            
                const newOption = document.createElement("option");
                let data = Object.values(vp);
                newOption.value = data[0];
                newOption.text = data[1];
                vp_s.appendChild(newOption);
            })

        })
        
        
        const fechDataLocacion = async () => {

            const options = {
                method: "GET",
                headers: {
                    "Content-Type": "application/json",
                },
            };

            var url = new URL(`${URL_ENV}/api/inspeccionUD.php`);
            var params = {
                opciones: 3
            };
            url.search = new URLSearchParams(params).toString();

            const response = await fetch(url, options);
            const data = await response.json();
            return data;

        }

        let locacion_s = document.getElementById("locacion");

        fechDataLocacion().then(locaciones => {
            locaciones.map((locacion) => {
              
                const newOption = document.createElement("option");
                let data = Object.values(locacion);
                newOption.value = data[0];
                newOption.text = data[1];
                locacion_s.appendChild(newOption);
            })

        })
        
        
        const fechDataDpto = async () => {

            const options = {
                method: "GET",
                headers: {
                    "Content-Type": "application/json",
                },
            };

            var url = new URL(`${URL_ENV}/api/inspeccionUD.php`);
            var params = {
                opciones: 1
            };
            url.search = new URLSearchParams(params).toString();

            const response = await fetch(url, options);
            const data = await response.json();
            return data;

        }

        let dpto_s = document.getElementById("dpto");

        fechDataDpto().then(dptos => {
            dptos.map((dpto) => {
              
                const newOption = document.createElement("option");
                let data = Object.values(dpto);
                newOption.value = data[0];
                newOption.text = data[1];
                dpto_s.appendChild(newOption);
            })

        })
        
        
        const SelectDelegadoyPertenece_iu = async (area,locacion,rol,selector) => {
             const options = {
            method: "GET",
            headers: {
                 "Content-Type": "application/json",
    },
  };


  var url = new URL(`${URL_ENV}/server/select_delegado.php`);

  var params = { area: area, locacion:locacion, rol:rol };
  
  url.search = new URLSearchParams(params).toString();

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
        
        
   </script>

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
            
              if( delegado == ""){
                alert("Ingresar el delegado");
                return false;
             }
             
              if( responsable == ""){
                alert("Ingresar el responsable");
                return false;
             }
          
          
            
            console.table([idInspeccion,fechaInspeccion,area,turno,delegado,responsable,actividad]);

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



            let url_update_inspeccion = `${URL_ENV}/server/inspeccionUpdate.php`;
            let response = await fetch(url_update_inspeccion, options);
            let data = await response.json();
            console.log( data );
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


                var url = new URL(`${URL_ENV}/server/inspeccion-server.php`);

                var params = {
                    vp_idsede: vp_idsede,
                    dpto: dpto,
                    area: area,
                    locacion: locacion
                };

                url.search = new URLSearchParams(params).toString();
                
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
                   
                    let dpto = resp[0]['DEPARTAMENTO'];

                    fetchDataSelect("", "", dpto, "#area", "");

                    setTimeout(() => {
                        formEditarInspeccion.elements['fechaInspeccion'].value = resp[0]['FECHA'];
                        formEditarInspeccion.elements['sedes'].value = resp[0]['SEDE'];
                        formEditarInspeccion.elements['actividad'].value = resp[0]['ACTIVIDAD'];
                        formEditarInspeccion.elements['turno'].value = resp[0]['TURNO'];
                        formEditarInspeccion.elements['area'].value = resp[0]['AREA'];
                        formEditarInspeccion.elements['locacion'].value = resp[0]['LOCACION'];
                         formEditarInspeccion.elements['dpto'].value = resp[0]['DEPARTAMENTO'];
                                  formEditarInspeccion.elements['vp_idSede'].value = resp[0]['VICEPRESIDENCIA'];
                                  
                                 console.log(resp[0]['RESPONSABLE']);
                                 console.log(resp[0]['DELEGADO DEL AREA'])
                                 
                                 let responsable = resp[0]['RESPONSABLE'];
                                 let delegado = resp[0]['DELEGADO DEL AREA'];
                                 
                              if ( responsable != "" && delegado != ""){
                                   SelectDelegadoyPertenece(resp[0]['AREA'],resp[0]['LOCACION'],"","#delegado");
                                   SelectDelegadoyPertenece(resp[0]['AREA'],resp[0]['LOCACION'],1,"#responsable");
                                   
                                   setTimeout(() => {
                                       
                                      formEditarInspeccion.elements['responsable'].value = resp[0]['RESPONSABLE'];
                                      formEditarInspeccion.elements['delegado'].value = resp[0]['DELEGADO DEL AREA'];
                                       
                                   },370);
                              }    
                      
                    }, 350)
                    
        
                          /* let myPromise = new Promise(function(resolve, reject) {
                                 let responsable = resp[0]['RESPONSABLE'];
                                 let delegado = resp[0]['DELEGADO DEL AREA'];

//                                The producing code (this may take some time)

                                   if ( responsable != "" && delegado != "") {
                                       
                                       
                                       
                                    setTimeout(() => resolve([responsable,delegado]), 380);   
                               
                                   }
                                    });


                               myPromise.then(
                                   (value)=> {
                                       
                                       console.table(value)
                                      formEditarInspeccion.elements['responsable'].value = value[0];
                                      formEditarInspeccion.elements['delegado'].value = delegado;
                                    }
                               );*/

                  

                })
        })

        const getinspeccion = async (idInspeccion) => {
            const options = {
                method: "GET",
                headers: {
                    "Content-Type": "application/json",
                },
            };

            var url_get_inspeccion = new URL(`${URL_ENV}/server/getinspeccion.php`);
            var params = {
                idInspeccion: idInspeccion
            };

            url_get_inspeccion.search = new URLSearchParams(params).toString();
         

            let response = await fetch(url_get_inspeccion, options);
            let data = await response.json();
            return data;

        };
    </script>
    
    <script src="<?php echo $_ENV['URL'] ?>/js/services_select_edit.js"></script>
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