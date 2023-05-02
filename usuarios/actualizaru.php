<!DOCTYPE html>
<html lang="es-CO">

<?php

$title = "registrar usuario";
$styleOwnSelf = "../css/form.css";
include("../components/header.php");

require __DIR__ . '/vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

?>




<body>

  <?php $path = "../";
  include("../components/brand.php"); ?>

  <?php $path_menu = "../";
  include("../components/navbar.php") ?>
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <h2 class="text-center encabezado_listado fw-bolder mt-5">Actualizar usuario</h2>
        <hr class="hr_red mx-auto mt-3" style="border-radius:15px">
      </div>
    </div>
    <div class="row">

      <div class="offset-md-3 col-md-6">
        <div class="card mt-responsive mt-5 mx-auto div--center-border mb-3" style="z-index: 1; border:inherit">
          <div class="card-body bg-transparent">
            <div class="accordion" id="accordionExample">
              <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne">
                  <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    Editar Datos personales
                  </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                  <div class="accordion-body">
                    <input type="hidden" id="areaH" value="<?php echo $_GET['area'] ?>">
                    <input type="hidden" id="locacionH" value="<?php echo $_GET['locacion'] ?>">

                    <input type="hidden" id="numeradorH" value="<?php echo $_GET['numerador'] ?>">
                    <input type="hidden" id="estadoH" value="<?php echo $_GET['estado'] ?>">
                    <input type="hidden" id="idH" value="<?php echo $_GET['id'] ?>">
                    <input type="hidden" id="idUsuario" value="<?php echo $_GET['idUsuario'] ?>">


                    <form id="formUpdatePersona">



                      <div class="mb-3 row align-items-center">
                        <div class="col-sm-12 col-md-6 mb-2">
                          <label for="pnombre" class="form-label"> Primer nombre: </label>
                          <input type="text" name="pnombre" class="form-control" id="pnombre" />
                        </div>

                        <div class="col-sm-12 col-md-6 mb-2">
                          <label for="snombre" class="form-label"> Segundo nombre: </label>
                          <input type="text" name="snombre" class="form-control" id="snombre" />
                        </div>

                        <div class="col-sm-12 col-md-6 mb-2">
                          <label for="papellido" class="form-label"> Primer apellido: </label>
                          <input type="text" name="papellido" class="form-control" id="papellido" />
                        </div>

                        <div class="col-sm-12 col-md-6 mb-2">
                          <label for="sapellido" class="form-label"> Segundo apellido: </label>
                          <input type="text" name="sapellido" class="form-control" id="sapellido" />

                        </div>

                      </div>
                      <div class="mb-3 row align-items-center">

                        <div class="d-grid gap-2 col-sm-12 col-md-4 offset-md-8">
                          <button id="actualizarPersonal" 
                                  class="btn btn-danger btn-login  btn-lg  fw-bolder" 
                                  type="button" 
                                  style="border-radius: 10px;">
                                  Actualizar
                          </button>
                        </div>

                      </div>



                    </form>

                  </div>
                </div>
              </div>
              <div class="accordion-item">
                <h2 class="accordion-header" id="headingTwo">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    Editar usuarios
                  </button>
                </h2>
                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                  <div class="accordion-body">
                    <form  id="formUpdateUsuario">

                      <div class="mb-3 row align-items-center">

                        <div class="col-sm-12 col-md-4">
                          <label for="email" class="form-label">Correo electrónico:</label>
                          <span class="invalid-document" id="invalid-email" style="display:none">*Ya existe este correo en la BD</span>
                          <input type="text" name="email" class="form-control validar-usuario" id="email" value=""/>
                        </div>

                        <div class="col-sm-12 col-md-4">
                          <label class="form-label" for="pass"> Contraseña: </label>
                          <input type="text" name="pass" class="form-control" id="pass" />
                        </div>

                        <div class="col-sm-12 col-md-4">
                          <label class="form-label" for="estados"> Estados: </label>
                          <select name="estados" id="estados" class="form-select">
                            <option value="">Selecciona el cargo</option>
                            <option value="1">Activo</option>
                            <option value="0">Inactivo</option>
                          </select>
                        </div>


                      </div>

                      <div class="mb-3 row align-items-center">

                        <div class="col-sm-12 col-md-4">
                          <label class="form-label" for="cargo"> Cargo: </label>
                          <select name="cargo" id="cargo" class="form-select">
                            <option value=0>Selecciona el cargo</option>
                            <?php

                            include("../reportepdf/conexion.php");
                            $sql2 = "Select idCargo, NombreCargo from cargos";
                            $resultado2 = $mysqli->query($sql2);
                            while ($row = $resultado2->fetch_assoc()) {
                              echo "<option value=" . $row['idCargo'] . ">" . $row['NombreCargo'] . "</option>";
                            }
                            mysqli_close($mysqli);
                            ?>
                          </select>
                        </div>

                        <div class="col-sm-12 col-md-4">
                          <label class="form-label" for="tusuario"> Tipo de usuario: </label>
                          <select name="tusuario" id="tusuario" class="form-select">
                            <option value=0>Selecciona el tipo de usuario</option>
                            <?php
                            include("../reportepdf/conexion.php");
                            $sql2 = "Select idTipoUsuario, NombreTipoUsuario from tipo_usuario";
                            $resultado2 = $mysqli->query($sql2);
                            while ($row = $resultado2->fetch_assoc()) {
                              echo "<option value=" . $row['idTipoUsuario'] . ">" . $row['NombreTipoUsuario'] . "</option>";
                            }
                            mysqli_close($mysqli);
                            ?>
                          </select>
                        </div>


                        <div class="col-sm-12 col-md-4">
                          <label class="form-label" for="rol"> Rol de usuario: </label>
                          <select name="rol" id="rol" class="form-select">
                            <option value=0>Selecciona el rol</option>
                            <?php

                            include("../reportepdf/conexion.php");
                            $sql2 = "Select idRol, NombreRol from roles";
                            $resultado2 = $mysqli->query($sql2);
                            while ($row = $resultado2->fetch_assoc()) {
                              echo "<option value=" . $row['idRol'] . ">" . $row['NombreRol'] . "</option>";
                            }
                            mysqli_close($mysqli);
                            ?>
                          </select>
                        </div>

                      </div>

                  </div>




                  <div class="mb-3 row align-items-center">

                    <div class="d-grid gap-2 col-sm-12 col-md-4 offset-md-8">
                      <button id="actualizarUsuario" class="btn btn-danger btn-login  btn-lg  fw-bolder" type="button" style="border-radius: 10px;" >Actualizar</button>
                    </div>

                  </div>



                  </form>
                </div>
              </div>
            </div>
            <div class="accordion-item">
              <h2 class="accordion-header" id="headingThree">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                  Editar Pertenece
                </button>
              </h2>
              <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                <div class="accordion-body">


                  <form id="formUpdatePertence">






                    <div class="mb-3 row">
                      <div class="col-md-4 col-sm-12">
                        <label class="form-label" for="sede"> Sede: </label>
                        <select name="sede" id="sede" class="form-select">
                          <option value="0"> Selecciona una sede </option>
                          <option value="1"> Mina</option>
                          <option value="2"> Puerto</option>
                        </select>
                      </div>

                      <div class="col-md-4 col-sm-12">
                        <label class="form-label" for="locacion"> Locación: </label>
                        <select name="locacion" id="locacion" class="form-select">
                          <option value="0"> Selecciona una locación </option>
                          <option value="1"> Pribbenow</option>
                          <option value="2"> El descanso</option>
                          <option value="3"> El corozo</option>
                          <option value="4"> Puerto</option>
                        </select>
                      </div>

                      <div class="col-sm-12 col-md-4">
                        <label class="form-label" for="estados"> Estados: </label>
                        <select name="estado_pertence" id="estado_pertenece" class="form-select">
                          <option value="">Selecciona el cargo</option>
                          <option value="1">Activo</option>
                          <option value="0">Inactivo</option>
                        </select>
                      </div>
                    </div>






                    <div class="mb-3 row">



                      <div class="col-md-4 col-sm-12">
                        <label for="dpto" class="form-label"> Vicepresidencia: </label>
                        <select name="vp" id="vp" class="form-select">
                          <option value="" selected>Escoger una vicepresidencia</option>
                        </select>
                      </div>

                      <div class="col-md-4 col-sm-12">
                        <label for="dpto" class="form-label"> Departamento: </label>
                        <select name="dpto" id="dpto" class="form-select">
                          <option value="" selected>Escoger un departamento</option>
                        </select>
                      </div>

                      <div class="col-md-4 col-sm-12">
                        <label for="area" class="form-label"> Área: </label>
                        <select name="area" id="area" class="form-select">
                          <option value="" selected>Escoger un área</option>
                        </select>
                      </div>
                    </div>


                    <div class="my-3 row">
                        
                        
                      <div class="d-grid gap-2 col-sm-12 col-md-4">
                        <button style="font-size:15px" id="crearPertenece" class="my-4 btn btn-danger btn-login  btn-lg  fw-bolder" type="button" style="border-radius: 10px;" name="registrarLocacion">Agregar a nueva área</button>
                      </div>

                      <div class="d-grid gap-2 col-sm-12 col-md-4 offset-md-4">
                        <button style="font-size:15px" id="actualizarPertenece" class="my-4 btn btn-danger btn-login  btn-lg  fw-bolder" type="button" style="border-radius: 10px;" name="Registrar">Actualizar</button>
                      </div>



                    </div>





                  </form>
                  
                  <!-- Seccion de modal locación y área -->
                  
                          <div id="modalPertenece" class="modal fade" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header bg-modal text-white">
                          <h5 class="modal-title" id="exampleModalLabel">Locación & área</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">

                          <form id="formRegistrarPertence" class="needs-validation" novalidate>

                        
                            <div class="mb-3 row">
                              <div class="col-md-4 col-sm-12">
                                <label class="form-label" for="sede"> Sede: </label>
                                <select name="sede" id="rsede" class="form-select">
                                  <option value=""> Selecciona una sede </option>
                                  <option value="1"> Mina</option>
                                  <option value="2"> Puerto</option>
                                </select>
                              </div>

                              <div class="col-md-4 col-sm-12">
                                <label class="form-label" for="locacion"> Locación: </label>
                                <select name="locacion" id="rlocacion" class="form-select" required>
                                  <option value=""> Selecciona una locación </option>
                                  <option value="1"> Pribbenow</option>
                                  <option value="2"> El descanso</option>
                                  <option value="3"> El corozo</option>
                                  <option value="4"> Puerto</option>
                                </select>
                                <div class="invalid-feedback">
                                  Please provide a valid city.
                                </div>
                              </div>

                              <div class="col-sm-12 col-md-4">
                                <label class="form-label" for="estados"> Estados: </label>
                                <select name="estado_pertence" id="restado_pertenece" class="form-select">
                                <option value="">Selecciona el estado</option>
                                  <option value="1">Activo</option>
                                  <option value="0">Inactivo</option>
                                </select>
                              </div>
                            </div>






                            <div class="mb-3 row">

                              <div class="col-md-4 col-sm-12">
                                <label for="dpto" class="form-label"> Vicepresidencia: </label>
                                <select name="vp" id="rvp" class="form-select">
                                  <option value="0" selected>Escoger una vicepresidencia</option>
                                </select>
                              </div>

                              <div class="col-md-4 col-sm-12">
                                <label for="dpto" class="form-label"> Departamento: </label>
                                <select name="dpto" id="rdpto" class="form-select">
                                  <option value="0" selected>Escoger un departamento</option>
                                </select>
                              </div>

                              <div class="col-md-4 col-sm-12">
                                <label for="area" class="form-label"> Área: </label>
                                <select name="area" id="rarea" class="form-select">
                                  <option value="0" selected>Escoger un área</option>
                                </select>
                              </div>
                            </div>

                            <br><br>

                            <div class="my-3 row">
                              <div class="d-grid gap-2 col-sm-12 col-md-4">
                                <button 
                                id="registrarPertenceModal" 
                                class="btn btn-danger btn-login btn-lg fw-bolder" 
                                type="button" 
                                style="border-radius: 10px;" 
                                name="registrarPertenceModal">
                                  Guardar
                                </button>
                              </div>

                              <div class="d-grid gap-2 col-sm-12 offset-md-4 col-md-4">
                            
                                <button 
                                id="btnCancelarLocacion" 
                                class="btn  btn-lg  fw-bolder btn-consultar   btn-lg     btn-consultar--border" 
                                type="button" 
                                style="border-radius: 10px;" 
                                name="l"
                                data-bs-dismiss="modal">
                                   Cancelar
                                </button>
                              </div>
                            </div>





                          </form>

                        </div>
                      </div>
                    </div>

                  </div>

                  
                  
                  <!-- final de seccion modal -->

                </div>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
    <div class="row">
    <div class="text-center">
       <a href="./lista.php" id="Cancelar" class="btn  btn-lg  fw-bolder btn-consultar   btn-lg     btn-consultar--border" style="border-radius: 10px;">Finalizar</a>
    </div>
    </div>
  </div>

  </div>

  <script> const URL_ENV = "<?php echo $_ENV['URL'] ?>";</script> <!-- Variable Entorno Enlace  -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="./js/seccionPertences.js"></script>
  <script src="./js/seccionUsuario.js"></script>
  <script src="./js/seccionPersona.js"></script>

  <script>
    let registrar = document.getElementById("registrarInspeccion");
    let msgDocument = document.getElementById("invalid-numero");
    let msgEmail = document.getElementById("invalid-email");
    let INPUT_OUTLINE = document.querySelectorAll(".validar-usuario");




    $("#ndocumento").change(function() {

      validarUsuarioExistente(this.value, "").then(resp => {
        let existe = 1
        if (resp == existe) {
          INPUT_OUTLINE[0].classList.add("outline-border");
          msgDocument.removeAttribute("style");
          registrar.setAttribute("disabled", "true");
          INPUT_OUTLINE[0].value = "";
        } else {
          INPUT_OUTLINE[0].classList.remove("outline-border");
          msgDocument.setAttribute("style", "display:none");
          registrar.removeAttribute("disabled");
        }
      });

    });

    $("#email").change(function() {

      validarUsuarioExistente("", this.value).then(resp => {
        let existe = 1
        if (resp == existe) {
          INPUT_OUTLINE[1].classList.add("outline-border");
          msgEmail.removeAttribute("style");
          registrar.setAttribute("disabled", "true");
          INPUT_OUTLINE[1].value = "";
        } else {
          INPUT_OUTLINE[1].classList.remove("outline-border");
          msgEmail.setAttribute("style", "display:none");
          registrar.removeAttribute("disabled");

        }
      });

    });


    const validarUsuarioExistente = async (numero, email) => {
      const options = {
        method: "GET",
        headers: {
          "Content-Type": "application/json",
        },
      };


      var url = new URL(`${URL_ENV}/usuarios/data/vu.php`);

      var params = {
        numero: numero,
        email: email
      };

      url.search = new URLSearchParams(params).toString();

      const response = await fetch(url, options);
      const data = await response.json();
      return data;

    }
  </script>
  <script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
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
  <script>
    $(document).ready(function(e) {
      $("#sede").change(function() {

        let sede = document.getElementById("sede");

        /*let cbox4 = document.getElementById("cbox4");*/

        /*document.getElementById("cbox4").disabled=false;*/


        console.log(sede);
        var parametros = $("#sede").val();

        $.ajax({
          data: {
            parametros
          },
          url: './data/vp.php',
          type: 'post',
          beforeSend: function() {
            //alert(parametros)
          },
          success: function(response) {
            $("#vp").html(response);
            //alert("success")
            console.log(vp);
          },
          error: function() {
            alert("error")
          }
        });
      })

      $("#vp").change(function() {
        var parametros = $("#vp").val();
        $.ajax({
          data: {
            parametros
          },
          url: './data/dpto.php',
          type: 'post',
          beforeSend: function() {
            //alert(parametros)
          },
          success: function(response) {
            $("#dpto").html(response);
            //alert("success")

          },
          error: function() {
            alert("error")
          }
        });
      })

      $("#dpto").change(function() {
        var parametros = $("#dpto").val();
        $.ajax({
          data: {
            parametros
          },
          url: './data/area.php',
          type: 'post',
          beforeSend: function() {
            //alert(parametros)
          },
          success: function(response) {
            $("#area").html(response);
            //alert("success")

          },
          error: function() {
            alert("error")
          }
        });
      })

    })
  </script>

</body>

</html>