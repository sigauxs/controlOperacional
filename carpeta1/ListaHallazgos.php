<?php require "./reportepdf/conexion.php"; ?>
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




<input type="text" id="myInput" onkeyup="myFunction()" placeholder="Buscar por descripción.." class="form-control mb-3" title="Type in a name" style="width: 300px">
<?php
$idInspeccion = $_GET['idInspeccion'];
$sql2 = "Call listaHallazgo($idInspeccion)";
$resultado2 = $mysqli->query($sql2);
?>
<table id="myTable" class="table table-hover">

  <thead class="thead">
    <tr>
      <th>Id Hallazgo</th>
      <th>Descripción</th>
      <th>Evidencia</th>
      <th>Fecha </th>
      <th>Factores de riesgos</th>
      <th>Area</th>
      <th></th>
    </tr>
  </thead>

       
       
  <tbody id="tbody">
    <tr>
      <?php while ($row = $resultado2->fetch_assoc()) { /*$idH = $idH + 1;*/ ?>

        <td class="numero"><?php echo ($row['ID HALL']); ?></td>
        <td class="d-none"><?php echo ($row['ID INSP']); ?></td>
        <td class="d-none"><?php echo ($row['ID DESVIACION']); ?></td>
        <td class="d-none"><?php echo ($row['empresa']); ?></td>
        <td><?php echo ($row['DESCRIPCION DEL HALLAZGO']); ?></td>
        <td class="d-none"> <?php echo "https://sigpeco.sigpeconsultores.com.co/" . substr($row['EVIDENCIA'], 2); ?></td>

        <td><a title="<?php echo ("Imagen del hallazgo #" . $row['ID HALL']); ?>" href="<?php echo "https://sigpeco.sigpeconsultores.com.co/" . substr($row['EVIDENCIA'], 2); ?>" target="_BLANK">
            <img id="myImg" width="100" height="100" src="<?php echo "https://sigpeco.sigpeconsultores.com.co/" . substr($row['EVIDENCIA'], 2); ?>"></a></td>
        <td><?php echo ($row['FECHA']); ?></td>
        <td><?php echo ($row['FACTORES DE RIESGO']); ?></td>
        <td><?php echo ($row['AREA']); ?></td>
        <td>
          <button class="btn btnEditar"> <span><i class="fa-solid fa-pen-to-square icon_edit me-2"></i></span></button>
          <button class="btn btnBorrar"><span><i class="fa-solid fa-trash-can icon_edit"></i></span></button>
        </td>
    </tr>
  <?php } ?>
  </tbody>

</table>

<div class="div">
  <div class="row">
    <div class="col-md-12 my-5">
      <button id="btnCrear" type="button" class="btn btn-danger btn-login  btn-lg  fw-bolder" data-bs-toggle="modal" data-bs-target="#modalArticulo">Nuevo Hallazgo</button>
    </div>
  </div>
</div>
<?php require "./reportepdf/conexion.php"; ?>
<div id="modalArticulo" class="modal fade" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-modal text-white">
        <h5 class="modal-title" id="exampleModalLabel">Hallazgo</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="formDesviacion">

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
            <option value=0>Selecciona un Peligro</option>
          </select>
          <br>
          <label>Control</label>
          <select id="lista3" name="lista3" class="form-select">
            <option value="0">Selecciona un Control</option>
          </select>
          <br>
          <label>Desviación</label>
          <select id="lista4" name="idDesviacion" class="form-select">
          <?php require "./reportepdf/conexion.php"; ?>
            <option value="0">Selecciona un Desviacion</option>
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






          <div class="modal-footer">

            <button class="btn btn-save" id="saveHallazgo" data-bs-dismiss="modal" type="button">Guardar</button>
            <button class="btn btn-file btn-cancel" id="close" data-bs-dismiss="modal">Cerrar</button>

          </div>
        </form>
      </div>
    </div>
  </div>














  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
  <script>
    const modalDesviacion = new bootstrap.Modal(document.getElementById('modalArticulo'))
    let btnCrear = document.getElementById("btnCrear");
    let formDesviacion = document.querySelector("#formDesviacion");
    let btnSaveHallazgo = document.getElementById("saveHallazgo");
    let opcion = "";
    let idHallazgo = "";

    btnCrear.addEventListener('click', () => {
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
      let lfile = document.getElementById('lfile').innerHTML = picture.name;
    })

    $(".btnEditar").click(function() {

      let idHallazgo = $(this).parents("tr").find("td")[0].innerHTML;
      let idInsp = $(this).parents("tr").find("td")[1].innerHTML;
      let idDes = $(this).parents("tr").find("td")[2].innerHTML;
      let empresa = $(this).parents("tr").find("td")[3].innerHTML;
      let descripcion = $(this).parents("tr").find("td")[4].innerHTML;
      let ruta = $(this).parents("tr").find("td")[5].innerHTML;

   
      formDesviacion.elements['idHallazgo'].value = idHallazgo;
      formDesviacion.elements['idInspeccion'].value = idInsp;
      formDesviacion.elements['empresas'].value = empresa;
      formDesviacion.elements['lista4'].value = idDes;
      formDesviacion.elements['descripcionActividad'].value = descripcion;
      
      modalDesviacion.show()
      opcion = 'editar';
 
    
        
     
    
    })

    btnSaveHallazgo.addEventListener('click', (e) => {
      e.preventDefault()
      if (opcion == 'crear') {
        const url_registro_hallazgo = "https://sigpeco.sigpeconsultores.com.co/api/desviaciones.php";

        const RegistrarHallazgo = async () => {
          let response = await fetch(url_registro_hallazgo, {
            method: 'POST',
            body: new FormData(formDesviacion)
          });
          let data = await response.json();

          console.log(data)
          return data;
        }

        RegistrarHallazgo().then( resp => {
          if(resp == "success"){
            console.log("hola");
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
       
        const url_update_hallazgo = "https://sigpeco.sigpeconsultores.com.co/api/hallazgoUpdate.php";
        
        const updateHallazgo = async () => {
          let response = await fetch(url_update_hallazgo, {
            method: 'POST',
            body: new FormData(formDesviacion)
          });
          let data = await response.json();
         
          console.log(data)
          return data;
        }

        updateHallazgo().then( resp => {
          if(resp == "success"){
            console.log("hola");
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


    $(document).ready(function() {
      $(".btnBorrar").click(function() {
          let id = $(this).parents("tr").find("td")[0].innerHTML;
          let url_delete_hallazgo = "https://sigpeco.sigpeconsultores.com.co/server/deleteHallazgo.php";

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
                  Swal.fire(
                    'Eliminado',
                    'Tu hallazgo ha sido eliminado',
                    'success'
                  )
                  res.json()
                })
                .then(() => {

                  setTimeout(() => {
                    location.reload()
                  }, 700);

                })


            }
          })


          /**/


        }



      );

    });
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
            console.log(lista2);
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
            $("#lista4").html(response);
            //alert("success")

          },
          error: function() {
            alert("error")
          }
        });
      })

    })
  </script>