<!DOCTYPE html>
<html lang="es-CO">
<?php


require "./reportepdf/conexion.php";
session_start();
$inspector = $_SESSION['usuarioId'];

?>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link href="./css/style.css" rel="stylesheet">
  <script src="https://kit.fontawesome.com/2dd4f6d179.js" crossorigin="anonymous"></script>
</head>

<body>
  <?php include("./components/brand.php") ?>
  <?php include("./components/navbar.php") ?>
  <div class="container">

    <div class="row">
      <div class="col-md-11">
        <form method="post" name="form_listado" id="form_listado" >
          <h2 class="text-center encabezado_listado fw-bolder mt-5">Listado de inspecciones</h2>
          <hr class="hr_red mx-auto">
          <br>

          <div class="mb-3">
            <div class="radio-item">
              <input type="radio" id="ritema" name="selc" value=1>
              <label for="ritema"> Todas </label>
            </div>

            <div class="radio-item">
              <input type="radio" id="ritemb" name="selc" value=2>
              <label for="ritemb"> Usuario Activo</label>
            </div>
          </div>

          <div>
            <label for="inputPassword5" class="form-label"> Periodo:</label>
          </div>
          <div id="dates" class="row">


            <div class="col-12 col-md-4 grid-center" style="justify-content:left">
              <label class="label-inspecciones">
                De:<input type="date" name="FechaInicio" id="inicio">
              </label>
            </div>

            <div class="col-12 col-md-4 grid-center">
              <label class="label-inspecciones">
                Hasta:<input type="date" name="FechaFinal" id="final">
              </label>
            </div>



            <div class="col-md-4">
              <button name="enviar" class="btn-consultar       btn-consultar--size      btn-consultar--border" type="submit" value="Consultar"> Consultar
              </button>


            </div>


          </div>




        </form>

      </div>

    </div>
    <div class="row">
      <div class="col-12 col-md-4 my-4">
        <input type="text" id="myInput" class="form-control" onkeyup="myFunction()" placeholder="Buscar por Área.." title="Type in a name">
      </div>
    </div>

    <div class="row">

      <div class="col-md-12">

     

        <table id="myTable" class="table table-hover">
           
            
          <thead class="thead">
            <th scope="col"></th>
            <th scope="col">Fecha</th>
            <th scope="col">Actividad</th>
            <th scope="col">Locación</th>
            <th scope="col">Vicepresidencia</th>
            <th scope="col">Departamento</th>
            <th scope="col">Área</th>
            <th scope="col"># Hallazgos</th>
            <th scope="col" colspan="2"></th>
          </thead>

          <tbody>


            <?php

if($_SERVER['REQUEST_METHOD']=='POST'){
            $fi = $_POST['FechaInicio'];
            $ff = $_POST['FechaFinal'];
            $slec = $_POST['selc'];

            if($fi == "" && $ff == "" && $slec == ""){
              echo "No hay datos";
            }else{
            if ($_REQUEST['selc'] == 1) {

              $sql2 = "Call Listado_Inspecciones('$fi', '$ff', '2','')";
            } else {

              $sql2 = "Call Listado_Inspecciones('$fi', '$ff','1','$inspector')";
            }

            $resultado2 = $mysqli->query($sql2);
         
            while ($row = $resultado2->fetch_assoc()) { 

             echo "<tr class='text-center'>";
             
             echo "<td class='td_id'>".$row['ID INSP']."</td>";
             echo "<td class='td_fecha fs-td' style='width:10%; '>".$row['FECHA']."</td>";
             echo "<td class='readmore' style='word-break:break-all;'>" . substr_replace($row['ACTIVIDAD'], "...", 30) . "</td>";
             echo "<td style='word-break:break-all; display:none'>" . $row['ACTIVIDAD'] . "</td>";
             echo "<td>".$row['LOCACIÓN']."</td>";
             echo "<td>".$row['VICEPRESIDENCIA']."</td>";
             echo "<td>".$row['DEPARTAMENTO']."</td>"; 
             echo "<td>".$row['AREA']."</td>"; 
             echo "<td style='width:10%;'>".$row['# HALLAZGOS ASOCIADOS']."</td>";
         
           
             if($row['INSPECTOR'] == $inspector){
              echo "<td>"."<a style='color: #E31937 !important;' href="."/editarInspeccion.php?idInspeccion=" . $row['ID INSP'] . "><span><i class='fas fa-edit'></i></span></a></td>";     
             }else{
              echo "<td>"."<span><i class='fas fa-edit' ></i></span></a></td>";     
             }
             
             echo "<td class='td_id'> <a style='color: #E31937 !important; cursor:pointer' href='reportepdf/reporte_listado.php?lastInspeccion=" . $row['ID INSP'] . "' target='_blank' >" . "<i class='fa-solid fa-file-pdf'></i></a></td>";
           
             echo "</tr>";               
            
            } 


          }
        
        }
           ?>

          </tbody>

        </table>



      </div>


    </div>

    <div class="row">

    </div>
    
    <div id="modalArticulo" class="modal fade" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header bg-modal text-white">
            <h5 class="modal-title" id="exampleModalLabel">Actividad</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form id="picture-content">

            <textarea id="actividad" cols="30" rows="10" class="form-control">

            </textarea>
            </form>
          </div>
        </div>
      </div>
    </div>
    
  </div>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
  
  <script>
  
  const modalDesviacion = new bootstrap.Modal(document.getElementById('modalArticulo'));
      let pictureContent = document.querySelector("#picture-content");


      $(".readmore").click(function() {

        let descripcion = $(this).parents("tr").find("td")[3].innerHTML;
        pictureContent.elements['actividad'].value = descripcion;
        modalDesviacion.show()
       
      });

  
  
  
    function myFunction() {
      var input, filter, table, tr, td, i, txtValue;
      input = document.getElementById("myInput");
      filter = input.value.toUpperCase();
      table = document.getElementById("myTable");
      tr = table.getElementsByTagName("tr");
      for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[6]; // Jorge, Aqui colocas la columna que tendra el filtro.
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


</body>

</html>