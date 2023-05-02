<nav class="navbar navbar-expand-lg navbar-dark bg-danger" id="navbar-movil">
    <div class="container-fluid">
        <a class="navbar-brand" id="name-brand">Control Operacional</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse fw-500" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="https://sigpeco.sigpeconsultores.com.co/menu.php">inicio</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="color: rgba(255,255,255,.85);">
                        Inspección
                    </a>
                    <ul class="dropdown-menu bg-danger fw-500" aria-labelledby="navbarDropdown" style="border:1px solid transparent">
                        <li><a class="dropdown-item nav-link-movil" href="https://sigpeco.sigpeconsultores.com.co/ListaInspecciones.php">Listar Inspección</a></li>
                        <li><a class="dropdown-item nav-link-movil" href="https://sigpeco.sigpeconsultores.com.co/inspeccion.php">Registrar Inspección</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a id="btn-report" class="nav-link nav-link-movil" data-bs-toggle="modal" data-bs-target="#reporteador">
               
               
                 Reporteador 
                   
                </a>
                </li>
                <li class="nav-item">
                    <a  class="nav-link nav-link-movil" href="https://sigpeco.sigpeconsultores.com.co/informe.php">
               
               Informe
                 
                   
                </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-link-movil" href="../client/logout.php">
                                Cerrar Sesión
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="modal fade" id="reporteador" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-modal text-white">
        <h5 class="modal-title " id="exampleModalLabel">Reporteador</h5>
        <button type="button" id="dismiss" class="btn-close dismiss" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      
      <form action="./reporteExcel.php" method="POST" id="reporte">
      <div class="modal-body">
          <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">De:</label>
    <input type="date" name="fechaInicio" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Hasta:</label>
    <input type="date" name="fechaFinal" class="form-control" id="exampleInputPassword1">
  </div>
      </div>
      <div class="modal-footer">
          <button type="submit" class="btn btn-save" data-bs-dismiss="modal">Consultar</button>
        <button type="button" class="btn  btn-file btn-cancel dismiss " data-bs-dismiss="modal">Cancelar</button>
        
      </div>
      </form>

    </div>
  </div>
</div>

<script defer>



        let name_brand = document.getElementById("name-brand");
        let btn_report = document.getElementById("btn-report");
        let btn_dismiss = document.getElementById("dismiss");
        let formReporte = document.getElementById("reporte");
        
        name_brand.innerHTML = document.title;
        
       
       $("#btn-report").click(function(){
                formReporte[0].value = "";
                formReporte[1].value = "";
        });
        
       
        
        $(".dismiss").click(function(){
                formReporte[0].value = "";
                formReporte[1].value = "";
        });
    
        
 
         
        
        
</script>