<!DOCTYPE html>
<html lang="es-CO">

<?php
$title = "Lista de usuarios";
$styleOwnSelf = "../css/lista.css";
include("../components/header.php");

session_start();

if (!isset($_SESSION['usuarioId'])) {
    header('location: index.php');
}
?>

<body>
 
  <?php 
  $path="../";
  include("../components/brand.php")
  ?>
  <?php 
    $path_menu="../";
  include("../components/navbar.php") ?>

  <div class="container">
    <div class="row">
      <div class="col-md-12 text-center">
        <h3 class="text-center encabezado_listado fw-bolder mt-5" onclick="">Lista de usuarios </h3>
        <hr class="hr_red mx-auto">
        <br>
      </div>
    </div>
    <div class="row">
      <div class="col-md-4" id="busquedas">
        <input type="text" 
               id="myInput"
               style="width:90%" 
               class="form-control ms-4 mb-3"
               onkeyup="myFunction()" 
               title="Ingresar numero de identificación"
               placeholder="&#xF002; Buscar por numero de identificación....." 
               style="font-family:Arial, FontAwesome"
               >
      </div>
         <div class="col-md-4" id="busquedas">
        <input type="text" 
               id="myarea" 
               style="width:90%" 
               class="form-control ms-4 mb-3"
               onkeyup="area()" 
               title="Ingresar area."
               placeholder="&#xF002; Buscar por area....." 
               style="font-family:Arial, FontAwesome"
               >
      </div>
            <div class="col-md-4" id="busquedas">
        <input type="text" 
               id="myusuario" 
               style="width:90%" 
               class="form-control ms-4 mb-3"
               onkeyup="usuario()" 
               title="Ingresar usuario."
               placeholder="&#xF002; Buscar por nombres....." 
               style="font-family:Arial, FontAwesome"
               >
      </div>

    </div>

    <div class="row">
      <div>
        <div class="container">
          <table id="myTable" class="table table-fixed table-hover table-striped">
          <?php
		        require "../reportepdf/conexion.php";
		        $sql2 = "SELECT pertenece.Usuarios_idUsuario as 'idUsuario', pertenece.estado as 'ESTADO', pertenece.Numerador AS 'ID', (SELECT locacion.NombreLocacion FROM locacion WHERE locacion.idLocacion = pertenece.Locacion_idLocacion) AS 'LOCACIÓN',(SELECT locacion.idLocacion FROM locacion WHERE locacion.idLocacion = pertenece.Locacion_idLocacion) AS 'IDLOCACION' ,(SELECT areas.Nombre_Area FROM areas WHERE areas.id_Area = pertenece.Area_idArea) AS 'ÁREA',(SELECT areas.id_Area FROM areas WHERE areas.id_Area = pertenece.Area_idArea) AS 'IDAREA' , (SELECT concat(P.Primer_Nombre,' ',P.Primer_Apellido) FROM usuarios AS U INNER JOIN personas AS P ON (P.idPersona = U.Persona_idPersona) WHERE pertenece.Usuarios_idUsuario = U.idUsuario) AS 'USUARIO', (SELECT P.idPersona FROM usuarios AS U INNER JOIN personas AS P ON (P.idPersona = U.Persona_idPersona) WHERE pertenece.Usuarios_idUsuario = U.idUsuario) AS 'NUMERO DOCUMENTO' FROM pertenece";
		        $resultado2 = $mysqli->query($sql2)
          ?>
            <thead>
              <tr>
                <th class="col-md-1">ID</th>
                <th class="col-md-3">USUARIO</th>
                <th class="col-md-2">NUMERO DOCUMENTO</th>
                <th class="col-md-2">LOCACIÓN</th>
                <th class="col-md-3">ÁREA</th>
                <th class="col-md-1">ACCIONES</th>
              </tr>
            </thead>
            <tbody class="scroller">
              <tr>
                    <?php while($row = $resultado2 -> fetch_assoc()){ ?>
				            <td class="col-md-1" style="font-size:10.5px"><?php echo ($row['ID']); ?></td>
				            <td class="col-md-3" style="font-size:10.3px"><?php echo ($row['USUARIO']); ?></td>
				            <td class="col-md-2" style="font-size:10.5px"><?php echo ($row['NUMERO DOCUMENTO']); ?></td>
				            <td class="col-md-2" style="font-size:10.5px"><?php echo ($row['LOCACIÓN']); ?></td>
				            <td class="col-md-3" style="font-size:10.5px"><?php echo ($row['ÁREA']); ?></td>
                    <td class="col-md-1"  style="font-size:10.5px">
                         <a href="./actualizaru.php?area=<?php echo ($row['IDAREA']); ?>&locacion=<?php echo ($row['IDLOCACION']); ?>&estado=<?php echo ($row['ESTADO'])?>&numerador=<?php echo ($row['ID'])?>&id=<?php echo ($row['NUMERO DOCUMENTO'])?>&idUsuario=<?php echo($row['idUsuario'])?>">
                             <i class='fas fa-edit'></i>
                         </a>
                    </td>
			        </tr>
			             <?php } mysqli_close($mysqli); ?>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    
    <div class="row">
        <div class="col-md-4">
            <a href="./registro.php" id="registrarUsuario" class="btn btn-danger btn-login  btn-lg  fw-bolder ms-4" style="border-radius: 10px;">Registrar Usuario</a>
        </div>
    </div>
  </div>

  <script>
    function myFunction() {
      var input, filter, table, tr, td, i, txtValue;
      input = document.getElementById("myInput");
      filter = input.value.toUpperCase();
      table = document.getElementById("myTable");
      tr = table.getElementsByTagName("tr");
      for (i = 0; i < tr.length; i++) {
        td = tr[i].getElementsByTagName("td")[2]; // Jorge, Aqui colocas la columna que tendra el filtro.
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
    
    function usuario() {
      var input, filter, table, tr, td, i, txtValue;
      input = document.getElementById("myusuario");
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
  <script>
    function area() {
      var input, filter, table, tr, td, i, txtValue;
      input = document.getElementById("myarea");
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
</body>

</html>