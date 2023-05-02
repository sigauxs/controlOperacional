<?php

include_once("./include/typeAdmin.php");
include("./connection/connection.php");

$pdo = new Conexion();

session_start();

if (!isset($_SESSION['usuarioId'])) {
  header('location: index.php');
}


$fullname = $_SESSION['primerNombre'] . " " . $_SESSION['segundoNombre'] . " " . $_SESSION['primerApellido'] . " " . $_SESSION['segundoApellido'];

$tipoUsuario = $_SESSION['tipoUsuario'];

if(isset($_GET['idInspeccion'])){

  $lastInspeccion = $_GET['idInspeccion'];

}else{

$sql = "CALL ultimaInspeccion(:idInspector)";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(":idInspector", $_SESSION['usuarioId']);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_NUM);

$_SESSION['lastIdInspeccion'] = $row[0];
$lastInspeccion = $_SESSION['lastIdInspeccion'];
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
  <link href="./css//hallazgos.css" rel="stylesheet">
  <script src="https://kit.fontawesome.com/2dd4f6d179.js" crossorigin="anonymous"></script>
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js" defer></script>


</head>

<body>

  <div class="container" id="container-accordion">

    <div class="row">
      <div class="col-12">
        <h2 class="text-center encabezado_listado fw-bolder mt-5"><b>Registrar hallazgos</b></h2>
        <hr class="hr_red mx-auto mb-3">
      </div>
    </div>

    <div class="row">
      <div class="col-md-8 offset-md-2 my-4">
         <label>Empresas</label>
        <select name="" id="empresas" ></select>
      </div>
    </div>
    <div class="row" id="accord">

      <div class="col-md-6 offset-md-3">
        <ul class="accordion" id="accord_lvl1">

        </ul>



        <button type="button" id="finalizar" class="btn btn-danger btn-login  btn-lg  fw-bolder my-5"> Finalizar</button>


      </div>






      <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>
      <script>

      
        $(document).ready(function() {
          $('#empresas').select2();
        });


        let idlastInspeccion = "<?php echo $lastInspeccion ?>";
        let fullname = "<?php echo $fullname ?>";
        console.log(idlastInspeccion);
        let finalizar = document.getElementById("finalizar");

        finalizar.addEventListener("click", () => {
          window.open(`reportepdf/reporte.php?lastInspeccion=${idlastInspeccion}&inspector=${fullname}`, '_blank');
          window.location.href = './menu.php';
        })
      </script>

      <script>
        const accordion = document.querySelector('.accordion');
        const factoresRiesgo = 1;
        const peligroRiesgo = 2;
        const controles = 3;
        const desviaciones = 4;



        const fetchDataHallazgo = async (factorRiesgo, peligroRiesgo, controles, desviaciones) => {

          const options = {
            method: "GET",
            headers: {
              "Content-Type": "application/json",
            },
          };

          var url = new URL("https://sigpeco.sigpeconsultores.com.co/api/hallazgo.php");
          var params = {
            factorRiesgo: factorRiesgo,
            peligroRiesgo: peligroRiesgo,
            controles: controles,
            desviaciones: desviaciones
          };
          url.search = new URLSearchParams(params).toString();

          const response = await fetch(url, options);
          const data = await response.json();
          return data;
        }


        const fechDataEmpresa = async () => {

          const options = {
            method: "GET",
            headers: {
              "Content-Type": "application/json",
            },
          };

          var url = new URL("https://sigpeco.sigpeconsultores.com.co/api/empresas.php");
          var params = {};
          url.search = new URLSearchParams(params).toString();

          const response = await fetch(url, options);
          const data = await response.json();
          return data;

        }

        let company = document.getElementById("empresas");

        fechDataEmpresa().then(empresas => {
          empresas.map((empresa) => {
            const newOption = document.createElement("option");
            let data = Object.values(empresa);
            newOption.value = data[0];
            newOption.text = data[1];
            company.appendChild(newOption);
          })
        })

        const LastInsertInspeccionUser = async (idInspector) => {
          const options = {
            method: "GET",
            headers: {
              "Content-Type": "application/json",
            },
          };

          var url = new URL("https://sigpeco.sigpeconsultores.com.co/api/lastInspeccion.php");
          var params = {
            idInspector: idInspector
          };
          url.search = new URLSearchParams(params).toString();

          const response = await fetch(url, options);
          const data = await response.json();
          return data;

        }






        fetchDataHallazgo(factoresRiesgo, "", "", "", "")
          .then(dataHallazgo => {

            dataHallazgo.map((factorRiesgo) => {


              let lilvl1 = document.createElement("li");
              let alvl1 = document.createElement("a");
              let ulSubLvl1 = document.createElement("ul");
              let ulSubLiLvl1 = document.createElement("li");

              function capitalize(word) {
                return word[0].toUpperCase() + word.substring(1).toLowerCase();
              }


              alvl1.classList.add("toggle", "lvl1");
              alvl1.setAttribute("href", "javascript:void(0);");
              alvl1.innerHTML = capitalize(factorRiesgo.NombreFactor) +
                "<span class='f-right'> <b>F</b></span>";



              let btnContainer = document.getElementById("accord");

              // Get all buttons with class="btn" inside the container
              let btns = btnContainer.getElementsByClassName("lvl1");

              btnsL = btns.length + 1;
              for (let i = 0; i < btns.length; i++) {
                btns[i].addEventListener("click", function() {
                  let current = document.getElementsByClassName("active");


                  if (current.length > 0) {
                    current[0].className = current[0].className.replace(" active", "");
                  }


                  this.className += " active";
                });
              }



              ulSubLvl1.classList.add("inner");
              ulSubLiLvl1.setAttribute("id", `${factorRiesgo.NombreFactor.split(' ').join('')}`)


              fetchDataHallazgo("", factorRiesgo.idFactor, "", "")
                .then(peligroRiesgoS => {
                  let ulSubLiLvl2M = document.querySelector(`#${factorRiesgo.NombreFactor.split(' ').join('')}`);
                  peligroRiesgoS.map((peligro) => {

                    let lilvl2 = document.createElement("li");
                    let alvl2 = document.createElement("a");
                    let ulSubLvl2 = document.createElement("ul");
                    let ulSubLiLvl2 = document.createElement("li");

                    let idCleanLvl2 = peligro.Nombre_Peligro.split(' ').join('');
                    idCleanLvl2.split(',').join('');

                    alvl2.classList.add("toggle");
                    alvl2.setAttribute("href", "javascript:void(0);");
                    alvl2.setAttribute("style", "background-color:  #B0B0B0 !important;color:white");
                    alvl2.classList.add("lvl2");



                    alvl2.innerHTML = peligro.Nombre_Peligro + "<span class='f-right'> <b>P</b></span>";

                    ulSubLvl2.classList.add("inner");
                    ulSubLiLvl2.setAttribute("id", `${idCleanLvl2.split(',').join('')}`);

                    fetchDataHallazgo("", "", peligro.id_Peligro, "").then(controles => {
                      let ulSubLiLvl3M = document.querySelector(`#${idCleanLvl2.split(',').join('')}`);

                      controles.map(control => {

                        let lilvl3 = document.createElement("li");
                        let alvl3 = document.createElement("a");
                        let ulSubLvl3 = document.createElement("ul");
                        let ulSubLiLvl3 = document.createElement("li");

                        let idCleanLvl3 = control.Descripcion_Control.split(' ').join('');
                        idCleanLvl3.split(',').join('');

                        ulSubLvl3.setAttribute("style", "padding-left:0");

                        alvl3.classList.add("toggle");
                        alvl3.setAttribute("style", "background-color: #D7D5D5 ")
                        alvl3.setAttribute("href", "javascript:void(0);");
                        alvl3.innerHTML = control.Descripcion_Control + "<span class='f-right'> <b>C</b></span>";



                        ulSubLvl3.classList.add("inner");

                        /*================  Create Modal  ===============================*/

                        let modalIdLvl3 = idCleanLvl3.replace(/[&\/\\#,+()$~%.'":*?<>{}]/g, '');
                        let buttonRegister = document.createElement("div");

                        /*buttonRegister.setAttribute("type", "button");*/
                        buttonRegister.classList.add("btn", "b-desviaciones", "btn-lg", "modalButton");
                        buttonRegister.setAttribute("data-name", `Clicked Modal ${idCleanLvl3}`);
                        buttonRegister.setAttribute("data-toggle", "modal");
                        buttonRegister.setAttribute("style", "margin-left:10px");
                        buttonRegister.innerHTML = `${control.Descripcion_Control}` + "<span class='f-right'> <b>D</b></span>";







                        /* ======================== End Modal ============================ */






                        let form = document.createElement("form");
                        form.setAttribute("id", "desviaciones");

                        let input_inspeccion = document.createElement("input");
                        input_inspeccion.setAttribute("name", "idInspeccion");
                        input_inspeccion.setAttribute("type", "hidden");

                        let input_empresas = document.createElement("input");
                        input_empresas.setAttribute("name", "idempresas");
                        input_empresas.setAttribute("type", "hidden");


                        let textarea = document.createElement("textarea");
                        textarea.classList.add("form-control", "mt-2");
                        textarea.setAttribute("id", "descripcionActividad");
                        textarea.setAttribute("name", "descripcion");
                        textarea.setAttribute("rows", "5");
                        textarea.setAttribute("cols", "40");

                        let select = document.createElement("select");
                        select.classList.add("form-select");
                        select.setAttribute("name", 'idDesviacion');
                        select.setAttribute("id", `${idCleanLvl3.split(',').join('')}03`);

                        let url_image = document.createElement("input");
                        url_image.setAttribute("accept","image/png,image/jpeg")
                        url_image.setAttribute("id", "urlImagen");
                        url_image.setAttribute("type", "file");
                        url_image.setAttribute("name", "picture");
                        url_image.setAttribute("placeholder", "Adjuntar evidencia");
                        url_image.setAttribute("style", " position: absolute; opacity: 0; display:none");

                        let label_url_image = document.createElement("label");
                        label_url_image.innerHTML = "Adjuntar evidencia" + " <i class='fa-solid fa-paperclip'></i>";
                        label_url_image.classList.add("my-3", "btn", "fw-bolder", "btn-file", "btn-file--border");
                        label_url_image.setAttribute("for", "urlImagen");
                        label_url_image.setAttribute("style", "display:inline-block;width:50%;");
                        
                        let lfile = document.createElement("label");
                        lfile.setAttribute("id", "lfile");
                        lfile.setAttribute("style","margin-bottom:2px");

                        ulSubLiLvl3.appendChild(buttonRegister);

                        $(document).ready(function(e) {


                          buttonRegister.addEventListener("click", (e) => {

                            /*let accord = document.getElementById("container-accordion");

                               
                               
                              let height_modal = 0;
                               if (accord.clientHeight <= 990){
                                 height_modal = 500;
                               }else if (accord.clientHeight <= 1050){
                                height_modal = 750;
                              }else if ( accord.clientHeight >= 1051){
                                height_modal = 850;
                              }*/




                            let divModal = document.createElement("div");
                            divModal.classList.add("modal-dialog", "modal-dialog-centered", "modal", "fade");
                            divModal.setAttribute("id", `${modalIdLvl3}`);
                            divModal.setAttribute("role", "dialog");
                            divModal.setAttribute("style", `margin: 0;position: absolute;top:140vh;left: 50%;transform: translate(-50%, -50%);`);




                            let divModalDialog = document.createElement("div");
                            divModalDialog.classList.add("modal-dialog");



                            let divModalContent = document.createElement("div");
                            divModalContent.classList.add("modal-content");



                            let divModalHeader = document.createElement("div");
                            divModalHeader.classList.add("model-header");

                            let buttonCloseX = document.createElement("button");
                            buttonCloseX.classList.add("btn", "btncloseX");
                            buttonCloseX.setAttribute("data-bs-dismiss", "modal");
                            buttonCloseX.textContent = "x";


                            let h4Header = document.createElement("h4");
                            h4Header.classList.add("modal-title");
                            h4Header.textContent = "Registro de Desviación";
                            h4Header.classList.add("text-center", "encabezado_listado");
                            h4Header.setAttribute("style", "font-size: 20px;font-weight: 600 !important;")

                            let hrHeader = document.createElement("hr");
                            hrHeader.classList.add("hr_red", "mx-auto")
                            hrHeader.setAttribute("style", "margin-top:5px; border-radius: 30px;heigth:4px;width:75px;")

                            let divModalBody = document.createElement("div");
                            divModalBody.classList.add("modal-body");

                            let pBody = document.createElement("p");
                            pBody.textContent = "Some text in the modal.";

                            let divModalFooter = document.createElement("div");
                            divModalFooter.classList.add("modal-footer");




                            ulSubLiLvl3.appendChild(divModal);
                            divModal.appendChild(divModalDialog);
                            divModalDialog.appendChild(divModalContent);
                            divModalContent.appendChild(divModalHeader);
                            divModalHeader.appendChild(buttonCloseX);
                            divModalHeader.appendChild(h4Header);
                            divModalHeader.appendChild(hrHeader);

                            divModalContent.appendChild(divModalBody);









                            fetchDataHallazgo("", "", "", control.idControl).then(desviaciones => {


                              desviaciones.map((desviacion) => {
                                const newOption = document.createElement("option");
                                let data = Object.values(desviacion);
                                newOption.value = data[0];
                                newOption.text = data[1];
                                select.appendChild(newOption);
                              })

                            })

                            $(`${modalIdLvl3}`).modal({
                              show: false,
                            });

                            let buttonClose = document.createElement("button");
                            buttonClose.classList.add("btn", "btn-file", "btn-cancel");
                            buttonClose.setAttribute("id", "close");
                            buttonClose.setAttribute("data-bs-dismiss", "modal");
                            buttonClose.textContent = "Cerrar";

                            let buttonSave = document.createElement("button");
                            buttonSave.classList.add("btn", "btn-save");
                            buttonSave.setAttribute("id", "save");
                            buttonSave.setAttribute("data-bs-dismiss", "modal");
                            buttonSave.setAttribute("type", "submit");
                            buttonSave.textContent = "Guardar";

                            setTimeout(function() {

                              let idEmpresas = document.getElementById("empresas").value;
                              input_empresas.value = idEmpresas;

                              LastInsertInspeccionUser(<?php echo $_SESSION['usuarioId'] ?>)
                                .then(resp => {

                                  input_inspeccion.value = resp[0]["ID ULTIMNA INSPECCION"];



                                });


                              form.appendChild(select);
                              form.appendChild(textarea);
                              form.appendChild(label_url_image);
                              form.appendChild(url_image);
                              form.appendChild(input_inspeccion);
                              form.appendChild(input_empresas);
                              form.appendChild(lfile);

                              let formDesviaciones = document.querySelector("#desviaciones");
                              if (form.elements['save'] == null) {

                                form.insertAdjacentElement("afterend",buttonClose );

                              }

                              if (form.elements['close'] == null) {

                                form.insertAdjacentElement("afterend", buttonSave );
                              }
                              
                              
                               $("#urlImagen").change(function() {
                                const picture = document.getElementById('urlImagen').files[0];
                                let lfile = document.getElementById('lfile').innerHTML = "<img style='width:20px; height:20px' src='assets/images/adjunto.png'>";
                              })




                            }, 550);


                            buttonSave.addEventListener("click", (e) => {

                              e.preventDefault();
                              const url_registro_hallazgo = "https://sigpeco.sigpeconsultores.com.co/api/desviaciones.php";

                              const RegistrarHallazgo = async () => {
                                let response = await fetch(url_registro_hallazgo, {
                                  method: 'POST',
                                  body: new FormData(form)
                                });
                                let result = await response.json();

                                console.log(result)
                              }

                              RegistrarHallazgo();

                              document.getElementById("desviaciones").reset();

                              $(`#${idCleanLvl3.split(',').join('')}03 option`).remove();

                              $(`#${modalIdLvl3}`).remove();

                            })




                            buttonClose.addEventListener("click", (e) => {
                              e.preventDefault();
                              document.getElementById("desviaciones").reset();

                              $(`#${idCleanLvl3.split(',').join('')}03 option`).remove();
                              $(`#${modalIdLvl3}`).remove();
                              window.scroll({
                                top: 100,
                                left: 100,
                                behavior: 'smooth'
                              });

                            })

                            buttonCloseX.addEventListener("click", (e) => {
                              e.preventDefault();

                              document.getElementById("desviaciones").reset();

                              $(`#${idCleanLvl3.split(',').join('')}03 option`).remove();
                              $(`#${modalIdLvl3}`).remove();
                              window.scroll({
                                top: 100,
                                left: 100,
                                behavior: 'smooth'
                              });

                            })




                            divModalBody.appendChild(form);

                            $(`#${modalIdLvl3}`).appendTo("body").modal("show");
                            console.log("este el modal")
                            setTimeout(() => {
                              divModal.scrollIntoView();
                            }, 500)


                          })

                        })

















                        /*lilvl3.setAttribute("id",`${idCleanLvl2.split(',').join('')}`);*/

                        ulSubLiLvl3M.appendChild(lilvl3);
                        lilvl3.appendChild(alvl3);
                        lilvl3.append(ulSubLvl3);
                        ulSubLvl3.appendChild(ulSubLiLvl3);



                      })
                    });

                    ulSubLiLvl2M.appendChild(lilvl2);
                    lilvl2.appendChild(alvl2);
                    lilvl2.append(ulSubLvl2);
                    ulSubLvl2.appendChild(ulSubLiLvl2);


                  })

                })
              accordion.appendChild(lilvl1);
              lilvl1.appendChild(alvl1);
              lilvl1.append(ulSubLvl1);
              ulSubLvl1.appendChild(ulSubLiLvl1);






            });


            /*  */





          })

        function renderSelect(values, selector) {

          const select = document.querySelector(selector);

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
        window.addEventListener('DOMContentLoaded', (event) => {
          setTimeout(function() {
            $('.toggle').click(function(e) {
              e.preventDefault();

              var $this = $(this);

              if ($this.next().hasClass('show')) {
                $this.next().removeClass('show');
                $this.next().slideUp(350);
              } else {
                $this.parent().parent().find('li .inner').removeClass('show');
                $this.parent().parent().find('li .inner').slideUp(350);
                $this.next().toggleClass('show');
                $this.next().slideToggle(350);
              }
            });


          }, 3500);

        })
      </script>



</html>