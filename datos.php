<?php
require "./reportepdf/conexion.php";
						if(isset($_POST['parametros_Factor'])){
							$factor = $_POST['parametros_Factor'];
							$sql2="Select id_Peligro, Nombre_Peligro from peligro_riesgo where Factor_idFactor='$factor'";
							$resultado2 = $mysqli->query($sql2);
							echo "<option value=0>Selecciona un peligro</option>";
							while($row = $resultado2 -> fetch_assoc()){
								//$cadena=$cadena."<option value=".$row['id_Peligro'].">".$row['Nombre_Peligro']."</option>";
								echo "<option value=".$row['id_Peligro'].">".$row['Nombre_Peligro']."</option>";
							}
						}
						else{
							echo "No se guardo valor en factor";
						}



						if(isset($_POST['parametros_Peligro'])){
							$peligro = $_POST['parametros_Peligro'];
							$sql3="Select idControl, Descripcion_control from controles where Peligro_idPeligro='$peligro'";
							$resultado3 = $mysqli->query($sql3);
							echo "<option value=0>Selecciona un control</option>";
							while($row = $resultado3 -> fetch_assoc()){
								//$cadena=$cadena."<option value=".$row['id_Peligro'].">".$row['Nombre_Peligro']."</option>";
								echo "<option value=".$row['idControl'].">".$row['Descripcion_control']."</option>";
							}
						}
						else{
							echo "No se guardo valor en control";
						}	
						if(isset($_POST['parametros_Control'])){
							$control = $_POST['parametros_Control'];
							$sql4="Select idDesviacion, Descripcion_Desviacion from desviaciones where Control_idControl='$control'";
							$resultado4 = $mysqli->query($sql4);
							echo "<option value=0>Selecciona una desviación</option>";
							while($row = $resultado4 -> fetch_assoc()){
								//$cadena=$cadena."<option value=".$row['id_Peligro'].">".$row['Nombre_Peligro']."</option>";
								echo "<option value=".$row['idDesviacion'].">".$row['Descripcion_Desviacion']."</option>";
							}
						}
						else{
							echo "No se guardo valor en control";
						}	
						mysqli_close($mysqli);
