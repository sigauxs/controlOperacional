<?php 

    require "./reportepdf/conexion.php";
    require __DIR__ . '/vendor/autoload.php';
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->load();



?>
<link rel="stylesheet" href="./css/lista.css">
<p class="head-listado">Listado de hallazgos: </p>
<style>
  .file-select {
  position: relative;
  display: inline-block;
}

.file-select::before {
  background-color: #5678EF;
  color: white;
  display: flex;
  justify-content: center;
  align-items: center;
  border-radius: 3px;
  content: 'Seleccionar'; /* testo por defecto */
  position: absolute;
  left: 0;
  right: 0;
  top: 0;
  bottom: 0;
}

.file-select input[type="file"] {
  opacity: 0;
  width: 200px;
  height: 32px;
  display: inline-block;
}

#src-file1::before {
  content: 'Seleccionar Archivo 1';
}

#src-file2::before {
  content: 'Seleccionar Archivo 2';
}



</style>



<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      
      <div class="modal-body div-center-modal-loader">
        <div class="loader"></div>
      </div>
      <div class="modal-footer div-center-modal-loader">
           <p>Espere mientras se comprime la imagen...</p>
      </div>
    </div>
  </div>
</div>



<input type="text" id="myInput" onkeyup="myFunction()" placeholder="Buscar por descripción.." class="form-control mb-3" title="Type in a name" style="width: 300px">
<?php
$idInspeccion = $_GET['idInspeccion'];
/*$sql2 = "Call listaHallazgo($idInspeccion)";
$resultado2 = $mysqli->query($sql2);*/
?>
<div id="thallazgo">
  <input type="hidden" value="<?php echo $idInspeccion ?>" id="idInspeccion">
  <table id="myTable" class="table table-fixed table-hover">

    <thead class="thead thead-display">
      <tr>
        <th class="col-md-1">Id Hallazgo</th>
        <th class="col-md-2">Descripción</th>
        <th class="col-md-2">Evidencia</th>
        <th class="col-md-1">Fecha </th>
        <th class="col-md-2">Factores de riesgos</th>
        <th class="col-md-2">Área</th>
        <th class="col-md-1">Estado     
          <i class="fa-solid fa-circle-info"
             data-bs-toggle="tooltip" 
             data-bs-placement="top" 
             data-bs-custom-class="custom-tooltip"
             data-bs-title="Los checkbox seleccionados, indica que fueron cerrados."></i></th>
        <th class="col-md-1"></th>
      </tr>
    </thead>

        <?php  ?>


    <tbody id="tbody" class="scroller" style="overflow-x:hidden! important">
      
        
    </tbody>

  </table>
</div>
<div class="div">
  <div class="row">
    <div class="col-12 col-md-6 my-3">
      <button id="btnCrear" type="button" class="btn btn-danger btn-login  btn-lg  fw-bolder one-hundred" data-bs-toggle="modal" data-bs-target="#modalArticulo">Nuevo hallazgo</button>
    </div>
    
    <div class="col-12 col-md-6 my-3 text-end">
      <button id="" type="button" class="btn btn-danger btn-login  btn-lg  fw-bolder one-hundred" >
          <a style="color:white; text-decoration:none" href="reportepdf/reporte_listado.php?lastInspeccion= <?php echo($idInspeccion);?>" target='_blank' ><i class='fa-solid fa-file-pdf'></i> Generar PDF</a>
      </button>
    </div>
    
  </div>
</div>


<?php require "./reportepdf/conexion.php"; ?>
<div id="modalArticulo" class="modal fade" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-modal text-white">
        <h5 class="modal-title" id="hallazgoModalLabel">Hallazgo</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="formDesviacion">
            
            <!-- Seccion de tipo de hallazgo -->
              <div class="row" id="typeDiscovery">
              <div class="col-12 text-center">
                <label>
                  Tipo de hallazgo
                </label>
              </div>
              <div class="col-6 col-md-6 text-center my-2">
                <label>
                  Positivo
                  <input type="radio" class="thallazgo" name="tipoH" id="" value="1" >
                </label>
              </div>
              <div class="col-6 col-md-6 text-center my-2">
                <label>
                  Negativo
                  <input type="radio" class="thallazgo" name="tipoH" id="" value="0" checked>
                </label>
              </div>
            </div>
        <!-- Seccion de tipo de hallazgo-->
        
        
        <input type="hidden" name="opcion" value="" id="opcion">
        <input type="hidden" name="idHallazgo" value="" id="idHallazgo">
          <input type="hidden" name="idInspeccion" value="<?php echo $idInspeccion ?>" id="idInspeccion">
          <label>Empresas</label>
          <select name="idempresas" id="empresas" class="empresas form-control">
            <option value="">Selecciona una empresa</option>
          </select>
          <br>
          <label>Factor</label>
          <select name="lista1" id="lista1" class="form-select">
            <option value=0>Selecciona un factor</option>
            <?php
            $sql1 = "Select idFactor, NombreFactor from factores_riesgo";
            $resultado1 = $mysqli->query($sql1);
            while ($row1 = $resultado1->fetch_assoc()) {
              //echo "<option value=".$row1['idFactor'].">".$row1['NombreFactor']."</option>";

            ?>

              <option value="<?php echo $row1['idFactor'] ?>"><?php echo $row1['NombreFactor'] ?></option>
            <?php
            }
            mysqli_close($mysqli);
            ?>

          </select>


          <br>
          <label>Peligro</label>
          <select id="lista2" name="lista2" class="form-select">
            <option value=0>Selecciona un peligro</option>
          </select>
          <br>
          <label>Control</label>
          <select id="lista3" name="lista3" class="form-select">
            <option value="0">Selecciona un control</option>
          </select>
          <br>
          <label for="lista4" id="labelLista4">Desviación</label>
          <select id="lista4" name="idDesviacion" class="form-select">
          <?php require "./reportepdf/conexion.php"; ?>
            <option value="0">Selecciona una desviación</option>
            <?php
            $sql2 = "SELECT idDesviacion , Descripcion_Desviacion FROM desviaciones";
            $resultado2 = $mysqli->query($sql2);
            while ($row2 = $resultado2->fetch_assoc()) {
              //echo "<option value=".$row1['idFactor'].">".$row1['NombreFactor']."</option>";

            ?>

              <option value="<?php echo $row2['idDesviacion'] ?>"><?php echo $row2['Descripcion_Desviacion'] ?></option>
            <?php
            }
            mysqli_close($mysqli);
            ?>
          </select>

          <label for="descripcionActividad">Actividad</label>
          <textarea class="form-control mt-2" id="descripcionActividad" name="descripcion" rows="5" cols="40"></textarea>
          
          <label id="urlImagenLabel" style="display:inline-block; margin-right:10px" class="my-3 btn fw-bolder btn-file btn-file--border" for="urlImagen" style="display:block;width:50%;">Adjuntar evidencia <i class="fa-solid fa-paperclip"></i></label><label id="lfile"></label>
          <input id="urlImagen" accept="image/png,image/jpeg" type="file" name="picture" placeholder="Adjuntar evidencia" style="display:none" required>






          <div class="modal-footer" style="display:block">

           <div class="row">
               <div class="col-6">
                   <button class="btn btn-save one-hundred mx-0" id="saveHallazgo" data-bs-dismiss="modal" type="button">Guardar</button>
               </div>
               <div class="col-6">
                   <button class="btn btn-file btn-cancel one-hundred mx-0" id="close" data-bs-dismiss="modal">Cancelar</button>
               </div>
               
           </div>
            
           

          </div>
        </form>
      </div>
    </div>
  </div>













  <script> const URL_ENV = "<?php echo $_ENV['URL'] ?>";</script> <!-- Variable Entorno Enlace  -->
  <script src="//code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="//cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
    <script>
    
       
        const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
        const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));
        
        /* New code*/
         const idInspeccion = document.getElementById('idInspeccion');
         const contenedor = document.querySelector('#tbody');
         let resultados = '';
         
         
    const allHallazgosFetch = async () => {

      const options = {
        method: "GET",
        headers: {
          "Content-Type": "application/json",
        },
      };

      var url = new URL(`${URL_ENV}/server/listar_hallazgos.php`);
      var params = {
        idInspeccion: idInspeccion.value,
      };
      url.search = new URLSearchParams(params).toString();


      const response = await fetch(url, options);
      const data = await response.json();
      console.log(data);
      console.log("Hola")
      mostrar(data);

    }
    

        const mostrar = (hallazgos) => {

      hallazgos.forEach(hallazgo => {
        resultados += `


        <tr>
                <td class="numero col-4  td-movil">${ hallazgo["ID HALL"] }</td>
                <td class="col-8 td-movil">${ hallazgo["AREA"] }</td>
                <td style="text-align: left;" class="col-10 td-movil"> ${ hallazgo["DESCRIPCION DEL HALLAZGO"].slice(0,33) } </td>
                <td class="col-2 td-movil desplegar"> <span> <i class="fa-solid fa-caret-down"></i> </span> </td>
                <td class="col-12 td-movil options"> 
                  <div class="row" >
                     <div class="col-4" style="justify-content: center;display: grid;align-items: center;">
                     <input style="accent-color:#e31937;width:25px;" class="estadoCheckbox estadoClase" 
                            type="checkbox" name="estadoHallazgo" 
                            id="esH${ hallazgo["ID HALL"] }" value="${ hallazgo["estado"] }>" ${ hallazgo['estado'] == 1 ? 'checked' : "" } />
                     </div>
                     <div class="col-4"><button class="btn btnEditar showModal p-0" data-content="editar" style="font-size:25px"> <span><i class="fa-solid fa-pen-to-square icon_edit"></i></span></button> </div>
                     <div class="col-4"><button class="btn btnBorrar p-0" style="font-size:25px"><span><i class="fa-solid fa-trash-can icon_edit"></i></span></button></div>
                  </div>
                </td>
            
    



           <td class="col-md-1 td-desktop"> ${ hallazgo["ID HALL"] }</td>
           <td class="col-md-2 td-desktop"> ${ hallazgo["DESCRIPCION DEL HALLAZGO"].slice(0,33) } </td>
           <td class="col-md-2 td-desktop"> <img id="myImg" class="showModal" data-content="img" width="25" height="25" src="${URL_ENV}${ hallazgo['EVIDENCIA'].slice(2)}"> </td>
           <td class="col-md-1 td-desktop"> ${ hallazgo["FECHA"] } </td>
           <td class="col-md-2 td-desktop"> ${ hallazgo["FACTORES DE RIESGO"]}</td>
           <td class="col-md-2 td-desktop"> ${ hallazgo["AREA"] } </td>
           <td class="col-md-1 td-desktop"> 
            <div class="col-12 td-desktop"> <input style="accent-color:#e31937; width:20px; height:20px" class="estadoCheckbox estadoClase" type="checkbox" name="estadoHallazgo" id="esH${ hallazgo["ID HALL"] }" value=" ${ hallazgo['estado'] }" ${ hallazgo['estado'] == 1 ? 'checked' : " " } /> </div>  
           </td>
           <td class="col-md-1 td-desktop"> 
            <div class="row">  
              <div class="col-6"> <button class="btn btnEditar showModal p-0" data-content="editar"> <span><i class="fa-solid fa-pen-to-square icon_edit me-2"></i></span></button> </div>
              <div class="col-6"> <button class="btn btnBorrar p-0"><span><i class="fa-solid fa-trash-can icon_edit"></i></span></button> </div>
            </div>
           </td>    
           
           
        
           
          
           
        </tr>





                    `
      })

      contenedor.innerHTML = resultados;""
      $(".options").hide();

      $(".desplegar").on("click", function(){

       console.log("despegar")
      
        $(this).closest('td').next('td').toggle(700);
     
      });   

    }


    allHallazgosFetch();
    
    /*Validacion de extension de imagenes y alerta*/
    
    let url_image = document.getElementById("urlImagen");

    url_image.addEventListener("change", () => {

      let allowedExtensions = /(.jpg|.jpeg|.png|.gif)$/i;
      let filePath = url_image.value;
      let labelfile = document.getElementById("lfile");
      let size      = url_image.files[0].size;
      const sizekiloByte = parseInt(size / 1024);

    
      if( sizekiloByte > 1024 ){
        Swal.fire({
          position: 'center',
          icon: 'error',
          title: 'Esta imagen excede el tamaño permitido (max: 1mb - 1024kb)',
          html:
         'Para reducir tamaño,<a href="./reducir.php" target="_blank" style="text-decoration:none; color:#e31937"><b> click aqui</b></a> ',
    
        showConfirmButton: true,
        confirmButtonColor: '#E31D38',
        confirmButtonText:'Cerrar'

        })
                url_image.value = '';
        return false;
      }

     
      

      if (!allowedExtensions.exec(filePath)) {  
        Swal.fire({ 
           position: 'center',     
           icon: 'error',
          title: 'Tipo de archivo no admitido',
          showConfirmButton: false,
          timer: 2000
        })

        setTimeout(() => {
          labelfile.innerHTML = "";
        }, 200)

        url_image.value = '';
        return false;
      }
    })
        
    </script>

  
  
  
  
  
  <script>
  
  
    const modalDesviacion = new bootstrap.Modal(document.getElementById('modalArticulo'));
    const modalLoading = new bootstrap.Modal(document.getElementById('staticBackdrop'));
    
    
    let btnCrear = document.getElementById("btnCrear");
    let formDesviacion = document.querySelector("#formDesviacion");
    let btnSaveHallazgo = document.getElementById("saveHallazgo");
    let opcion = "";
    let idHallazgo = "";
    
     

    btnCrear.addEventListener('click', () => {
        
    
       const tituloModal = document.getElementById("hallazgoModalLabel");
        tituloModal.innerText = "Nuevo";

        const divTypeDiscovery = document.getElementById("typeDiscovery");
        divTypeDiscovery.style.display = "";
        
      formDesviacion.elements['empresas'].value = "";
      formDesviacion.elements['lista1'].value = 0;
      formDesviacion.elements['lista2'].value = 0;
      formDesviacion.elements['lista3'].value = 0;
      formDesviacion.elements['lista4'].value = 0;
      formDesviacion.elements['descripcionActividad'].value = "";
      formDesviacion.elements['urlImagen'] = "";
      modalDesviacion.show()
      opcion = 'crear';
      console.log(opcion);
    })

    $("#urlImagen").change(function() {
      const picture = document.getElementById('urlImagen').files[0];
      if( picture ){
        let   lfile = document.getElementById('lfile').innerHTML = picture.name;
      }
      
    })
    
    setTimeout(() => {

    $(".btnEditar").click(function() {
        
        let input_radio_tHallazgo = document.querySelectorAll(".thallazgo");
        const tituloModal = document.getElementById("hallazgoModalLabel");
        tituloModal.innerText = "Editar";
        const divTypeDiscovery = document.getElementById("typeDiscovery");
        divTypeDiscovery.style.display = "none";

      let idHallazgo = $(this).parents("tr").find("td")[0].innerHTML;
      
       const obtenerHallazgoFetch = async (idHallazgo) => {
            const options = {
              method: "GET",
              headers: {
                "Content-Type": "application/json",
              },
            };

            var url = new URL(`${URL_ENV}/server/obtener_hallazgo.php`);
            var params = {
              idHallazgo: idHallazgo,
            };
            url.search = new URLSearchParams(params).toString();


            const response = await fetch(url, options);
            const data = await response.json();

            return data;

          };
          
        obtenerHallazgoFetch(idHallazgo).then(
            (hallazgo) => {

              formDesviacion.elements['empresas'].value = hallazgo[0].idEmpresa;
              formDesviacion.elements['lista4'].value = hallazgo[0].idDesviacion;
              formDesviacion.elements['descripcionActividad'].value = hallazgo[0].descripcion;
              formDesviacion.elements['idHallazgo'].value = hallazgo[0].idHallazgo;
              formDesviacion.elements['idInspeccion'].value = hallazgo[0].idInspeccion;

              if (hallazgo[0].tipoHallazgo == 1) {
                input_radio_tHallazgo[0].setAttribute("checked", "true");
                input_radio_tHallazgo[1].removeAttribute("checked");
              } else if (hallazgo[0].tipoHallazgo == 0) {
                input_radio_tHallazgo[1].setAttribute("checked", "true");
                input_radio_tHallazgo[0].removeAttribute("checked");
              }

            }
          );










        

          modalDesviacion.show()
          opcion = 'editar';
          
 
    
        
     
    
    })

    },1300)



    btnSaveHallazgo.addEventListener('click', (e) => {
      e.preventDefault()
      if (opcion == 'crear') {
        const url_registro_hallazgo = `${URL_ENV}/api/desviaciones.php`;
         modalLoading.show();
        const RegistrarHallazgo = async () => {
          let response = await fetch(url_registro_hallazgo, {
            method: 'POST',
            body: new FormData(formDesviacion)
          });
          let data = await response.json();

          
          return data;
        }

        RegistrarHallazgo().then( resp => {
          if(resp == "success"){
            modalLoading.hide();
            window.location.reload();
          }
        });



        console.log('OPCION CREAR')
      }
      if (opcion == 'editar') {


  
        const picture = document.getElementById('urlImagen').files[0];
        

        if(picture != "" && picture != undefined){
          formDesviacion.elements['opcion'].value = 1;
        }else{
          formDesviacion.elements['opcion'].value = 2;
        }
       
        const url_update_hallazgo = `${URL_ENV}/api/hallazgoUpdate.php`;
        
        const updateHallazgo = async () => {
          let response = await fetch(url_update_hallazgo, {
            method: 'POST',
            body: new FormData(formDesviacion)
          });
          let data = await response.json();
         
       
          return data;
        }

        updateHallazgo().then( resp => {
          if(resp == "success"){
            
            window.location.reload();
          }
        });;
      }
      modalDesviacion.hide()
    })


    

    const fechDataEmpresa = async () => {

      const options = {
        method: "GET",
        headers: {
          "Content-Type": "application/json",
        },
      };

      var url = new URL(`${URL_ENV}/api/empresas.php`);
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
    
    
    


    $(document).ready(function() {
        
         setTimeout(() => {
            
            $(".btnBorrar").click(function() {
          let id = $(this).parents("tr").find("td")[0].innerHTML;
          let url_delete_hallazgo = `${URL_ENV}/server/deleteHallazgo.php`;

          Swal.fire({
            title: '¿Estas seguro?',
            text: "Esta accion no podra ser revertido",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#E31D38',
            cancelButtonColor: 'rgb(149,149,149)',
            cancelButtonText: 'No, Cancelar',
            confirmButtonText: 'Si, Eliminar'
          }).then((result) => {
            if (result.isConfirmed) {

              fetch(url_delete_hallazgo, {
                  method: 'DELETE',
                  headers: {
                    'Content-Type': 'application/json'
                  },
                  body: JSON.stringify({
                    idHallazgo: id
                  })
                })
                .then(res => {
               Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'Eliminado exitosamente',
                showConfirmButton: false,
                timer: 1500
                })
                  res.json()
                })
                .then(() => {

                  setTimeout(() => {
                    location.reload()
                  }, 700);

                })


            }
          }) 
                
            });
            
         },500); 

    });
  </script>
      <script>
      let estadoHallazgoCheckBox = document.getElementById("estadoHallazgo");




setTimeout(() => {


$('.estadoCheckbox').change(function(){
    
    
      let idH = this.id.toString().slice(3);;
      let checkValue = "";
      var id = this.id;
      
      console.log(this.checked)
      if(this.checked){
          
         
          console.log(this.value +  " " +  id)
          this.value = 1;
          checkValue = this.value;
      }else{
           
          
           console.log(this.value +  " " +  idH)
          this.value = 0;
          checkValue = this.value;
      }
      
      
     
              const actualizarEstado = async () => {

              
                let url = `${URL_ENV}/api/updateStatusHallazgo.php`;
                console.log(idH + checkValue)
                const options = {
                  method: "PUT",
                  headers: {
                    "Content-Type": "application/json",
                  },
                  body: JSON.stringify({
                    idHallazgo: idH,
                    estado: checkValue,
                  })
                };
                const response = await fetch(url, options);
                const data = await response.json();
                return data;

              }

              actualizarEstado()
                .then(
                  respuesta => {
                    if (respuesta == "success") {
                      Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Guardando estado por espere!!!!',
                        showConfirmButton: false,
                        timer: 1700
                      })
                      setTimeout(() => {
                        window.location.reload();
                      }, 1800)

                    }
                  }
                )
      
      
   })}, 500);













    

  </script>
  <script>
    function myFunction() {
      var input, filter, table, tr, td, i, txtValue;
      input = document.getElementById("myInput");
      filter = input.value.toUpperCase();
      table = document.getElementById("myTable");
      tr = table.getElementsByTagName("tr");
      for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[4]; // Jorge, Aqui colocas la columna que tendra el filtro.
        if (td) {
          txtValue = td.textContent || td.innerText;
          if (txtValue.toUpperCase().indexOf(filter) > -1) {
            tr[i].style.display = "";
          } else {
            tr[i].style.display = "none";
          }
        }
      }
    }
  </script>
  <script>
    $(document).ready(function(e) {
      $("#lista1").change(function() {
        //$('#lista1').val(1);	
        //var parametros= "id="+$("#lista1").val();
        var parametros_Factor = $("#lista1").val();
        $.ajax({
          data: {
            parametros_Factor
          },
          //url: './datos.php',
          //dataType: 'post',
          url: 'datos.php',
          type: 'post',
          beforeSend: function() {
            //alert(parametros)
          },
          success: function(response) {
            $("#lista2").html(response);
            //alert("success")
           
          },
          error: function() {
            alert("error")
          }
        });
      })

      $("#lista2").change(function() {
        //$('#lista1').val(1);	
        //var parametros= "id="+$("#lista1").val();
        var parametros_Peligro = $("#lista2").val();
        $.ajax({
          data: {
            parametros_Peligro
          },
          //url: 'datos1.php',
          //dataType: 'post',
          url: 'datos.php',
          type: 'post',
          beforeSend: function() {
            //alert(parametros)
          },
          success: function(response) {
            $("#lista3").html(response);
            //alert("success")

          },
          error: function() {
            alert("error")
          }
        });
      })

      $("#lista3").change(function() {
        //$('#lista1').val(1);	
        //var parametros= "id="+$("#lista1").val();
        var parametros_Control = $("#lista3").val();
        $.ajax({
          data: {
            parametros_Control
          },
          //url: 'datos1.php',
          //dataType: 'post',
          url: 'datos.php',
          type: 'post',
          beforeSend: function() {
            //alert(parametros)
          },
          success: function(response) {
              
            let select_4 = document.getElementById("lista4");
            let input_radio_tHallazgo = document.querySelectorAll(".thallazgo");
            let ultimoValor = select_4.lastChild.value;
            let primerValor = select_4.firstChild.value;

            const positivo = input_radio_tHallazgo[0].checked;
            const negativo = input_radio_tHallazgo[1].checked;

            $("#lista4").html(response);

            if (positivo) {

              $(`#lista4`).each(function() {

                $(this).children("option").each(function() {
                  $(this).addClass("d-display-none");
                });
                select_4.lastChild.style.display = "block";
              });
              select_4.value = ultimoValor;

            };

            if (negativo) {

         
              $(`#lista4`).each(function() {

                $(this).children("option").each(function() {
                  $(this).removeClass("d-display-none");
                });
                select_4.lastChild.style.display = "none";
              });
              select_4.value = primerValor;
           
            }
            

          },
          error: function() {
            alert("error")
          }
        });
      })

    });
    
    $(".thallazgo").change(function(){ 
      let select_4 = document.getElementById("lista4");
      let labelLista4 = document.getElementById("labelLista4");
      let posicionUltimoValor = select_4.lastChild.childNodes.length - 1;
      let primerValor = select_4.childNodes[2].value;
      let ultimoValor = select_4.childNodes[posicionUltimoValor].value;
      
       if(this.value == 1){


        labelLista4.innerHTML = "Hallazgo positivo";
        $(`#lista4`).each(function() {
        $(this).children("option").each(function() {
        $(this).addClass("d-display-none");
        });
        select_4.lastChild.style.display = "block";
        });
        select_4.value = "";

      }else if(this.value == 0){
        labelLista4.innerHTML = "Desviación";
        select_4.value = "";
        select_4.lastChild.style.display="none";
        $(`#lista4`).each(function() {
        $(this).children("option").each(function() {
        $(this).removeClass("d-display-none");
        });
        });
        }
        select_4.value = "";
    
    });
  </script>