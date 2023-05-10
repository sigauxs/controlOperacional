<!DOCTYPE html>
<html lang="en">
<?php

$title = "Lista de empresas";
$styleOwnSelf = "../css/lista.css";

include("../components/header.php");


$url_count = strlen(__DIR__);
$url = substr(__DIR__,0,($url_count-9));
require  $url . '/vendor/autoload.php';


$dotenv = Dotenv\Dotenv::createImmutable($url);
$dotenv->load();

?>

<body>
    <?php

    $path = "../";
    include("../components/brand.php");

    $path_menu = "../";
    include("../components/navbar.php");
    
    include("../components/navbar-movil.php");

 

    ?>
    
    <div class="container">
    <div class="row">
        <div class="col-md-12 title-sm">
          <h2 class="text-center encabezado_listado fw-bolder mt-5">Listado de empresas</h2>
          <hr class="hr_red mx-auto">
          <br>
       </div>
        
        
        
            <div class="row">
      <div class="col-md-4" id="busquedas">
          <label for="myInput" class="ms-4 mb-3"> 
          <span class="ms-4" style="text-transform: capitalize; color: #878788; font-size: 12px;font-weight: 600;">Nombre</span>
        <input type="text" 
               id="myInput" 
               class="form-control ms-4 mb-3"
               onkeyup="myFunction()" 
               title="Ingresar numero de identificación"
               placeholder="&#xF002; Buscar por nombre....." 
               style="font-family:Arial, FontAwesome"
               >
               </label>
      </div>

    </div>
        
        
        
        
        <div class="col-md-12">
            <div class="container">
                <table class="table table-fixed table-hover table-striped" id="myTable">
                    <thead>
                        <tr>
                            <th class="col-md-3">ID</th>
                            <th class="col-md-5">NOMBRE</th>
                            <th class="col-md-2">ESTADO</th>
                            <th class="col-md-2"></th>
                        </tr>
                    </thead>
                    <tbody style="height:400px; font-size:10.5px" class="scroller">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
        <div class="row">
            <div class="col-md-2 text-center">
                <button id="btnCrear" style="color:white" class="btn-crear btn btn-register">Registrar empresa</button>
            </div>
        </div>
    </div>
   

    


    <div id="modalEmpresas" class="modal fade" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-modal text-white">
                    <h5 class="modal-title" id="exampleModalLabel">Editar empresa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="formEmpresas">
                        <div class="mb-3">
                             <input id="id" type="hidden" name="id">
                            <label for="nombre" class="col-form-label">Nombre:</label>
                            <input id="nombre" type="text" class="form-control" name="nombre" autofocus>
                        </div>
                        <div class="mb-3">
                            <label for="estado" class="col-form-label">Activo</label>
                            <input id="estado" style="accent-color:#e31937" name="estado" type="checkbox" class="" value="0">
                        </div>
                </div>
               <div class="modal-footer" style="display:block">
                    <div class="row">
                        <div class="col-6">
                             <button id="btnFormEmpresas" type="button" style="width:100%; margin:0" class="btn btn-save">Guardar</button>
                        </div>
                        <div class="col-6">
                            <button type="button" style="width:100%; margin:0" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        </div>
                        
                    </div>
                   
                    
                   
                </div>
                </form>
            </div>
        </div>
    </div>
    <script> const URL_ENV ="<?php echo $_ENV['URL'] ?>"; console.log(URL_ENV, "eSTA VARIABLE")</script> <!-- Variable Entorno Enlace  -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
    <script src="js/all.js"></script>
      <script>
    function myFunction() {
      var input, filter, table, tr, td, i, txtValue;
      input = document.getElementById("myInput");
      filter = input.value.toUpperCase();
      table = document.getElementById("myTable");
      tr = table.getElementsByTagName("tr");
      for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[1]; // Jorge, Aqui colocas la columna que tendra el filtro.
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