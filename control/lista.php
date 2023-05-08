<!DOCTYPE html>
<html lang="en">
<?php

$title = "Gestionar factores";
$styleOwnSelf = "../css/lista.css";

include("../components/header.php");

require "../connection/connection.php";
$url_count = strlen(__DIR__);
$url = substr(__DIR__, 0, ($url_count - 7));
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
                <h2 class="text-center encabezado_listado fw-bolder mt-5">Gestionar Control</h2>
                <hr class="hr_red mx-auto">
                <br>
            </div>

            <div class="accordion" id="accordionExample">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            Crear Control
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                        <form>
                                <div class="mb-3">
                                    <label for="factor" class="form-label">Seleccionar un factor </label>
                                    <select class="form-select factor" 
                                    aria-label="Default select example " 
                                    id="factor_crearControl">
                                                                              
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="peligro_crearControl" class="form-label">Selecciona un peligro</label>
                                    <select 
                                    class="form-select factor" 
                                    aria-label="Default select example" 
                                    id="peligro_crearControl">
                                                                              
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="jerarquia" class="form-label">Selecciona una Jerarquia</label>
                                    <select 
                                    class="form-select factor" 
                                    aria-label="Default select example" 
                                    id="jerarquia">                                  
                                    </select>
                                </div>


                                <div class="mb-3">
                                    <label for="nombreControl" class="form-label">Ingresa un Control</label>
                                    <input type="text" class="form-control" id="nombreControl">
                                </div>


                                <button id   ="btnCrear"
                                        type ="button" 
                                        class="btn btn-primary">Crear</button>
                            </form>
                        </div>
                    </div>
                </div>

                
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            Actualizar Control
                        </button>
                    </h2>
                    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                        <form>
                                <div class="mb-3">
                                    <label for="factor" class="form-label">Seleccionar un factor </label>
                                    <select class="form-select factor" 
                                    aria-label="Default select example " 
                                    id="factor_actualizarControl">
                                                                              
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="peligro_actualizarControl" class="form-label">Selecciona un peligro</label>
                                    <select 
                                    class="form-select factor" 
                                    aria-label="Default select example" 
                                    id="peligro_actualizarControl">
                                                                              
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="control" class="form-label">Selecciona una control</label>
                                    <select 
                                    class="form-select factor" 
                                    aria-label="Default select example" 
                                    id="control">                                  
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="jerarquiaId" class="form-label">Selecciona una Jerarquia</label>
                                    <select 
                                    class="form-select factor" 
                                    aria-label="Default select example" 
                                    id="jerarquiaId">                                  
                                    </select>
                                </div>

                             


                                <div class="mb-3">
                                    <label for="nombreControlActualizar"
                                           class="form-label"
                                           style="cursor:pointer"
                                           onclick="sameName()" title="Usar el mismo nombre">Ingresa un Control</label>
                                    
                                    <input type="text" class="form-control" id="nombreControlActualizar">
                                </div>


                                <button id   ="btnActualizar"
                                        type ="button" 
                                        class="btn btn-primary">Actualizar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-md-12">
                <div class="container">
                    <form id="formDesviacion">


                    </form>
                </div>
            </div>
        </div>
        <div class="row mt-5 justify-content-center">
        <div class="col-md-3 text-center">
               <a href="../fpcd/lista.php" style="color:white" class="btn-crear btn btn-register">Gestionar Factor</a>
            </div>

            <div class="col-md-3 text-center">
                <a href="../peligro/lista.php" style="color:white" class="btn-crear btn btn-register">Gestionar Peligro</a>
            </div>

            <div class="col-md-3 text-center">
                <a href="../control/lista.php" style="color:white" class="btn-crear btn btn-register">Gestionar Control</a>
            </div>

            <div class="col-md-3 text-center">
                <a href="../desviaciones/lista.php" style="color:white" class="btn-crear btn btn-register">Gestionar Desviaciones</a>
            </div>
        </div>
    </div>






     <!-- Variable Entorno Enlace  -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script>
        const URL_ENV = "<?php echo $_ENV['URL'] ?>";
       
        $(document).ready(function() {
          $('#peligro_actualizar').select2();
        });
    </script>
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