<!DOCTYPE html>
<html lang="es-CO">

<?php

$title = "registrar usuario";
$styleOwnSelf = "../css/form.css";
include("../components/header.php");


?>




<body>

<?php $path = "../";  include("../components/brand.php"); ?>
<?php include("../components/navbar.php") ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h2 class="text-center encabezado_listado fw-bolder mt-5">Actualizar usuario</h2>
                <hr class="hr_red mx-auto mt-3" style="border-radius:15px">
            </div>
        </div>
        <div class="row">
            <div class="offset-md-1 col-md-10">
                <div class="card mt-responsive mt-5 mx-auto div--center-border mb-3" style="z-index: 1; border:inherit">
                    <div class="card-body bg-transparent">
                        <form 
                        autocomplete="on" method="post" 
                        action="./data/RegistroPUP.php" id="formRegistroUsuario" >

                        <div class="mb-3 row align-items-center">
                                    <div class="col-sm-12 col-md-4">
                                         <label for="pnombre" class="form-label"> Nombres: </label>
                                         <input type="text" name="pnombre" class="form-control" id="pnombre" />
                                    </div>

                                    <div class="col-sm-12 col-md-4">
                                        <label for="papellido" class="form-label"> Primer apellido: </label>
                                        <input type="text" name="papellido" class="form-control" id="papellido" />
                                    </div>

                                    <div class="col-sm-12 col-md-4">
                                        
                                        <label for="sapellido" class="form-label"> Segundo apellido: </label>
                                        <input type="text" name="sapellido" class="form-control" id="sapellido"/>
                            
                                    </div>
    
                        </div>


                        <div class="mb-3 row align-items-center">

                            <div class="col-sm-12 col-md-4">
                                <label for="tpdocumento" class="form-label"> Tipo de documento </label>
                                <select name="tpdocumento" id="tpdocumento" class="form-select">
                                    <option value=0>Selecciona el tipo de documento</option>
                                    <?php 
                                            include("../reportepdf/conexion.php");
                                            
			                                $sql2="Select idTipo, NombreTipo from tipo_identificacion";
                                            $resultado2 = $mysqli->query($sql2);
			                                while($row = $resultado2 -> fetch_assoc()){
				                            echo "<option value=".$row['idTipo'].">".$row['NombreTipo']."</option>";
			                                }
			                                mysqli_close($mysqli);
                                         ?>
                                </select>
                            </div>

                            <div class="col-sm-12 col-md-4">
                                <label for="ndocumento" class="form-label"> # Documento: </label>
                                <input type="text" name="ndocumento" class="form-control" id="ndocumento" />
                            </div>

                            <div class="col-sm-12 col-md-4" >
                                <label for="email" class="form-label">Correo electrónico:</label>
                                <input type="text" name="email" class="form-control" id="email" />
                             </div>

                        </div>

                        <div class="mb-3 row align-items-center">
                            <div class="col-sm-12 col-md-6">
                                <label class="form-label" for="pass"> Contraseña: </label>
                                <input type="text" name="pass" class="form-control" id="pass"/>
                            </div>
                            <div class="col-sm-12 col-md-6">
                               <label class="form-label" for="passConfirmation"> Confirmar contraseña: </label>
                               <input type="text" name="confpass" class="form-control" id="passConfirmation"/>
                            </div>
        
                        </div>

                        <div class="mb-3 row align-items-center">
                            <div class="col-sm-12 col-md-4">
                                <label class="form-label" for="cargo"> Cargo: </label>
                                    <select name="cargo" id="cargo" class="form-select">
                                     <option value=0>Selecciona el cargo</option>
                                            <?php
                                             
                                            include("../reportepdf/conexion.php");
                                            $sql2="Select idCargo, NombreCargo from cargos";
			                                $resultado2 = $mysqli->query($sql2);
			                                while($row = $resultado2 -> fetch_assoc()){
				                                echo "<option value=".$row['idCargo'].">".$row['NombreCargo']."</option>";
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
			                                    $sql2="Select idTipoUsuario, NombreTipoUsuario from tipo_usuario";
			                                    $resultado2 = $mysqli->query($sql2);
			                                    while($row = $resultado2 -> fetch_assoc()){
				                                    echo "<option value=".$row['idTipoUsuario'].">".$row['NombreTipoUsuario']."</option>";
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
			                        $sql2="Select idRol, NombreRol from roles";
			                        $resultado2 = $mysqli->query($sql2);
			                        while($row = $resultado2 -> fetch_assoc()){
				                        echo "<option value=".$row['idRol'].">".$row['NombreRol']."</option>";
			                        }
			                        mysqli_close($mysqli);
                                ?>
                             </select>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <div class="col-md-4 col-sm-12">
                                 <label class="form-label" for="sede"> Sede: </label>
                                 <select name="sede" id="sede" class="form-select">
                                    <option value="0"> Selecciona una sede </option>
                                    <option value="1"> Mina</option>
                                    <option value="2"> Puerto</option>
                                 </select>
                            </div>



                            <div class="col-md-2 col-sm-6 d-flex align-items-center">
                                <label class="mt-4">
                                    <input  style="accent-color:#e31937" 
                                            type="checkbox" 
                                            name="locacion[]" id="cbox1" 
                                            disabled=true value="1" 
                                            > Pribbenow
                                </label>
                            </div>

                            <div class="col-md-2 col-sm-6 d-flex align-items-center">
                                <label class="mt-4">
                                    <input style="accent-color:#e31937" 
                                     type="checkbox" 
                                     name="locacion[]" id="cbox2" 
                                     disabled=true value="2" 
                                     > El descanso 
                                </label>
                            </div>

                            <div class="col-md-2 d-flex col-sm-6 align-items-center"> 
                                <label class="mt-4">
                                    <input style="accent-color:#e31937" 
                                    type="checkbox" 
                                    name="locacion[]" id="cbox3" 
                                    disabled=true value="3" 
                                    > El corozo 
                                </label>
                            </div>
                            <div class="col-md-2 d-flex col-sm-6 align-items-center">
                                <label class="mt-4">
                                    <input style="accent-color:#e31937" 
                                    type="checkbox" 
                                    name="locacion[]" id="cbox4" 
                                    disabled=true value="4" 
                                    > Puerto 
                                </label>
                            </div>
                        </div>



                            

                           
                        <div class="mb-3 row">

          

                            <div class="col-md-4 col-sm-12">
                                    <label for="dpto" class="form-label"> Vicepresidencia: </label>
                                    <select name="vp" id="vp" class="form-select">
                                    </select>
                            </div>

                            <div class="col-md-4 col-sm-12">
                                    <label for="dpto" class="form-label"> Departamento: </label>
                                    <select name="dpto" id="dpto" class="form-select">
                                    </select>
                            </div>

                            <div class="col-md-4 col-sm-12">
                                    <label for="area" class="form-label"> Área: </label>
                                    <select name="area" id="area" class="form-select">
                                    </select>
                            </div>
                        </div>



                        <br><br>
                                    

                        <div class="my-3 row">
                              
                              <div class="d-grid gap-2 col-sm-12 col-md-4 offset-md-2">

                                  <button 
                                  id="registrarInspeccion" 
                                  class="btn btn-danger btn-login  btn-lg  fw-bolder" 
                                  type="submit" 
                                  style="border-radius: 10px;"
                                  name="Registrar">Registrar</button>
                                 


                              </div>
                              <div class="d-grid gap-2 col-sm-12 col-md-4">
                                    <a href="../menu.php" id="Cancelar" class="btn  btn-lg  fw-bolder btn-consultar   btn-lg     btn-consultar--border" style="border-radius: 10px;">Cancelar</a>
                              </div>

                  
                      </div>

                           

                            

                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script>
	$(document).ready(function(e){
		$("#sede").change(function(){

            let sede = document.getElementById("sede");

            let cbox4 = document.getElementById("cbox4");

            document.getElementById("cbox4").disabled=false;

cbox4.addEventListener("click",()=>{
    console.log("Hola mundo");
})
            console.log( sede );
			var parametros = $("#sede").val();
				// Validando los checkbox acorde a la seleccion de la sede
				if (parametros == 2) {
					document.getElementById("cbox4").disabled=false;
					document.getElementById("cbox1").disabled=true;
					document.getElementById("cbox2").disabled=true;
					document.getElementById("cbox3").disabled=true;
					
					document.getElementById("cbox4").checked=true;
					document.getElementById("cbox1").checked=false;
					document.getElementById("cbox2").checked=false;
					document.getElementById("cbox3").checked=false;
					}
				else if(parametros == 1){
					document.getElementById("cbox4").disabled=true;
					document.getElementById("cbox1").disabled=false;
					document.getElementById("cbox2").disabled=false;
					document.getElementById("cbox3").disabled=false;
					
					document.getElementById("cbox4").checked=false;
				}
				else {
					document.getElementById("cbox4").disabled=true;
					document.getElementById("cbox1").disabled=true;
					document.getElementById("cbox2").disabled=true;
					document.getElementById("cbox3").disabled=true;
					
					document.getElementById("cbox1").checked=false;
					document.getElementById("cbox2").checked=false;
					document.getElementById("cbox3").checked=false;
					document.getElementById("cbox4").checked=false;
				}
				// Fin de la validando los checkbox acorde a la seleccion de la sede
			$.ajax({
				data: {parametros},
				url: './data/vp.php',
				type: 'post',
				beforeSend: function(){
					//alert(parametros)
				},
				success: function(response){
					$("#vp").html(response);
					//alert("success")
					console.log(vp);
				},
				error:function(){
					alert("error")
				}
			});			
		})
		
		$("#vp").change(function(){
			var parametros = $("#vp").val();
			$.ajax({
				data: {parametros},
				url: './data/dpto.php',
				type: 'post',
				beforeSend: function(){
					//alert(parametros)
				},
				success: function(response){
					$("#dpto").html(response);
					//alert("success")
					
				},
				error:function(){
					alert("error")
				}
			});
		})
		
		$("#dpto").change(function(){
			var parametros = $("#dpto").val();
			$.ajax({
				data: {parametros},
				url: './data/area.php',
				type: 'post',
				beforeSend: function(){
					//alert(parametros)
				},
				success: function(response){
					$("#area").html(response);
					//alert("success")
					
				},
				error:function(){
					alert("error")
				}
			});
		})
		
	})
</script>

</body>

</html>