<!DOCTYPE html>
<html lang="es-CO">
<?php


require "./reportepdf/conexion.php";
include_once("./include/typeAdmin.php");

require __DIR__ . '/vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();



session_start();
$inspector = $_SESSION['usuarioId'];
$tipoUsuario = $_SESSION['tipoUsuario'];



?>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link href="./css/style.css" rel="stylesheet">
  <link href="./css/lista.css" rel="stylesheet">
  <link href="./css/responsive.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <script src="https://kit.fontawesome.com/2dd4f6d179.js" crossorigin="anonymous"></script>
  <title>Lista de inspecciones</title>
  <style>
      
       @media (min-width: 375px) and (max-width: 575.98px) {

}

@media (min-width: 576px) and (max-width: 767.98px) {





}

@media (min-width: 768px) and (max-width: 991.98px) {

.font-tbody {
    font-size:1.1vw;
}

}

@media (min-width: 992px) and (max-width: 1179px) {

.font-tbody {
    font-size:1.1vw;
}
}

@media (min-width: 1180px) and (max-width: 1399.98px) {

.font-tbody {
    font-size:1vw;
}

}

@media (min-width: 1500px) {


}

  </style>
</head>

<body>
  <?php include("./components/brand.php") ?>
  <?php
  $path_menu="";
  include("./components/navbar.php") ?>
  <?php include("./components/navbar-movil.php");

  ?>
  <div class="container">

    <div class="row">
      <div class="col-md-11">
        <form method="post" name="form_listado" id="form_listado" >
          <h2 class="text-center encabezado_listado fw-bolder mt-5 title-sm">Listado de inspecciones</h2>
          <hr class="hr_red mx-auto title-sm">
          <br>
          
          <div class="mb-3">
            <input type="hidden" name="idUsuario" id="idUsuario" value="<?php echo $inspector; ?>">
          </div>

          <div class="mb-3 ta-center-movil">
            <div class="radio-item">
              <input type="radio" id="ritema" name="selc" value=1>
              <label for="ritema"> Todas </label>
            </div>

            <div class="radio-item">
              <input type="radio" id="ritemb" name="selc" value=2>
              <label for="ritemb"> Usuario activo</label>
            </div>
          </div>

          <div>
            <label for="inputPassword5" class="form-label"> Periodo:</label>
          </div>
          <div id="dates" class="row">


            <div class="col-12 col-sm-6 col-md-4 text-center text-md-start">
              <label class="label-inspecciones my-2 my-md-0 one-hundred">
               <span class="title-sm"> De: </span><input class="one-hundred" type="date" name="FechaInicio" id="inicio">
              </label>
            </div>

            <div class="col-12 col-12 col-sm-6 col-md-4 text-center text-md-start">
              <label class="label-inspecciones my-2 my-md-0 one-hundred">
               <span class="title-sm"> Hasta: </span> <input class="one-hundred" type="date" name="FechaFinal" id="final">
              </label>
            </div>



            <div class="col-md-4">
              <button name="enviar" id="btnConsultar" class="btn-consultar  one-hundred   btn-consultar--size mt-2 mb-4 my-md-0      btn-consultar--border" type="submit" value="Consultar"> Consultar
              </button>


            </div>


          </div>




        </form>

      </div>

    </div>
    <div class="row title-sm">
      <div class="col-12 col-md-4 my-4">
        <input type="text" id="myInput" class="form-control " onkeyup="myFunction()" placeholder="Buscar por área.." title="Type in a name">
      </div>
    </div>

    <div class="row">

      <div class="col-md-12">

     

        <table id="myTableId" class="table table-fixed table-hover" style="box-shadow: 0 0 0 0  transparent;">
           
            
          <thead class="thead thead-display">
              <th class="col-1"></th> 
              <th class="col-1">Fecha</th>
              <th class="col-3">Actividad</th>
              <th class="col-2">Inspector</th>
              <th class="col-1">Locación</th>
              <th class="col-2">Área</th>
              <th class="col-1"># Hallazgos</th>
              <th class="col-1"></th>
          </thead>
  
          <tbody id="tbody-movil" class="font-tbody scroller">


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

   <script> const URL_ENV = "<?php echo $_ENV['URL'] ?>";</script> <!-- Variable Entorno Enlace  -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
  
        let tipoUsuario = Number("<?php echo $tipoUsuario; ?>");
        const administrador = 1;
        
        let data = 0;
  
      const contenedor = document.querySelector('#tbody-movil');
      const formListado = document.getElementById('form_listado');
      const idUsuario = document.getElementById('idUsuario');
     let btn = document.getElementById("btnConsultar");


      const modalDesviacion = new bootstrap.Modal(document.getElementById('modalArticulo'));
      let pictureContent = document.querySelector("#picture-content");


      let resultados = '';


      const mostrar = (inspecciones) => {
        inspecciones.forEach(inspeccion => {
        resultados += `<tr id="tr-movil">
        <td style='border-bottom:1px solid #adb5bd !important; width:100%'>
                        <div class='row'>
                        <div class='col-8 col-sm-8 col-md-1 float-start p-1' style='text-align:left'>
                          <span style='padding-left: 5vw;font-weight:bolder'>${inspeccion.FECHA}</span>
                        </div>

                        <div class='col-4 col-sm-4 float-start p-1 text-end'>
                            <span style='padding-right: 5vw'> <a style="text-decoration:none;${ inspeccion['IDINSPECTOR'] == idUsuario.value | tipoUsuario == administrador ? 'color:red' : 'color:gray'} ; font-weight:bolder;" ${ inspeccion['INSPECTOR'] == idUsuario.value ? "href" : " "}="https://controlope.sigpeconsultores.com.co/editarInspeccion.php?idInspeccion=${inspeccion["ID INSP"]}"> ${"COD" + " " + inspeccion["ID INSP"]} </a> </span>
                        </div>
                        </div>

                   <div class='row'>

                   <div class='col-10 col-sm-10 float-start p-1 text-start readmore'>
                   <span style='word-break: break-all;padding-left: 5vw;'> ${inspeccion["ACTIVIDAD"].slice(0,33) + " ..." } </span>
                   </div>

                   <div class='col-2 col-sm-2 float-start p-1'>
                     <a href='reportepdf/reporte_listado.php?lastInspeccion=${inspeccion['ID INSP']}' target='_blank' style='color: #E31937 !important; cursor:pointer; font-size:25px'> <i class='fa-solid fa-file-pdf'></i></a>
                   </div>

                   </div>

                   <div class='row'>

                   <div class='col-12 col-sm-12 float-start p-1 text-start'>
                   <span style='word-break: break-all;padding-left:5vw'> ${ "# De Hallazgos " + " " + inspeccion['# HALLAZGOS ASOCIADOS']} </span>
                   </div>


                   </div>

                       
                  </td> 
                  <td style='word-break:break-all; display:none'></td>
                  <td style='word-break:break-all; display:none'></td>
                  <td style='word-break:break-all; display:none'>${inspeccion["ACTIVIDAD"]}</td> 
                  </tr>
                        
                  <tr class='text-center' id='tr-desktop'>
                                    
                  <td class='td_id col-1'> ${"COD" + " " + inspeccion["ID INSP"]} </td>
                  <td class='td_fecha fs-td col-1' > ${inspeccion.FECHA} </td>
                  <td class='readmore col-3' style='word-break:break-all;'>${inspeccion["ACTIVIDAD"].slice(0,33).toLowerCase() + " ..." } </td>
                  <td style='word-break:break-all; display:none'>${inspeccion["ACTIVIDAD"]}</td>
                  <td class='col-2'>${inspeccion["INSPECTOR"]} </td>
                  <td class='col-1'>${inspeccion["LOCACIÓN"]} </td>
                  <td class='col-2'>${inspeccion["AREA"]} </td>
                  <td class='col-1'>${inspeccion['# HALLAZGOS ASOCIADOS']} </td>

                  ${ inspeccion['IDINSPECTOR'] == idUsuario.value | tipoUsuario == administrador  ? "<td class='col-1'>" + "<a style='color: #E31937 !important; cursor:pointer' href=" + `${URL_ENV}/editarInspeccion.php?idInspeccion=` + inspeccion['ID INSP'] + "> <span ><i class='fas fa-edit'></i></span></a>" + "<a style='color: #E31937 !important; cursor:pointer;padding-left:7px' href='reportepdf/reporte_listado.php?lastInspeccion=" + inspeccion['ID INSP'] + "' target='_blank' >" + "<i class='fa-solid fa-file-pdf'></i></a> <button class='btn btnBorrar p-0'><span><i class='fa-solid fa-trash-can icon_edit'></i></span></button> </td>"  : "<td class='col-1'>" + "<span><i class='fas fa-edit' style='padding-right:7px'></i></span>" + "<a style='color: #E31937 !important; cursor:pointer' href='reportepdf/reporte_listado.php?lastInspeccion=" + inspeccion['ID INSP'] + "' target='_blank' >" + "<i class='fa-solid fa-file-pdf'></i></a> </td>" }                 

                </tr>
                    `    
    })

    let tbody = document.querySelector("tbody"); 


    if( $(window).width() <= 419) {
      console.log($(window).width()+"px");
      tbody.style.height =$(window).width()+"px";
    }

    contenedor.innerHTML = resultados
    
}




      const allInspeccionFetch = async () => {
          
        const urlInspecciones = `${URL_ENV}/server/listar_inspecciones.php`;
        const response = await fetch(urlInspecciones, {
          method: 'POST',
          body: new FormData(formListado)
        });
        const data = await response.json();
        mostrar(data);
      }

 


      formListado.addEventListener('submit',(e)=>{
        setTimeout(function(){

          $(".readmore").click(function() {

            let descripcion = $(this).parents("tr").find("td")[3].innerHTML;
            pictureContent.elements['actividad'].value = descripcion;
            modalDesviacion.show()
          });
             
        }, 1200);



        e.preventDefault();
        allInspeccionFetch();
        
       
      });
      
       btn.addEventListener('click', (e) => {
    

        setTimeout(()=>{
          $(".btnBorrar").click(function() {
          let id = $(this).parents("tr").find("td")[0].innerHTML;

          let idInspeccion = id.slice(4).trim();
          const url_delete_inspeccion = `${URL_ENV}/server/deleteInspeccion.php`;

        console.log( idInspeccion , url_delete_inspeccion )
          Swal.fire({
            title: '¿ Estás seguro ?',
            text: "Esta accion no podra ser revertida",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#E31D38',
            cancelButtonColor: 'rgb(149,149,149)',
            cancelButtonText: 'No, Cancelar',
            confirmButtonText: 'Si, Eliminar'
          }).then((result) => {
            if (result.isConfirmed) {
           
              fetch(url_delete_inspeccion, {
                  method: 'DELETE',
                  headers: {
                    'Content-Type': 'application/json'
                  },
                  body: JSON.stringify({
                    idInspeccion: idInspeccion
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
                  }, 1000);

                })

            }
          })

        });
        },1000);
       

      
    });

  </script>
  <script>
  
   const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
   const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))
  
   function myFunction() {
      var input, filter, table, tr, td, i, txtValue;
      input = document.getElementById("myInput");
      filter = input.value.toUpperCase();
      table = document.getElementById("myTableId");
      tr = table.getElementsByTagName("tr");
      for (i = 0; i < tr.length; i++) {
          console.log(tr[i].getElementsByTagName("td")[7]);
        td = tr[i].getElementsByTagName("td")[5]; // Jorge, Aqui colocas la columna que tendra el filtro.
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