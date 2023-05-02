<?php
include("../../reportepdf/conexion.php");
					if(isset($_POST['parametros'])){
							$vp = $_POST['parametros'];
							$sql2="Select id_Dpto, Nombre_Dpto from departamentos where Dpto_idVP='$vp'";
							$resultado2 = $mysqli->query($sql2);
							echo "<option value=0>Selecciona un departamento</option>";
							while($row = $resultado2 -> fetch_assoc()){
								//$cadena=$cadena."<option value=".$row['id_Peligro'].">".$row['Nombre_Peligro']."</option>";
								echo "<option value=".$row['id_Dpto'].">".$row['Nombre_Dpto']."</option>";
							}
						}
						else{
							echo "No se guardo valor en factor";
						}
						mysqli_close($mysqli);
?>