<?php
include("../../reportepdf/conexion.php");
						if(isset($_POST['parametros'])){
							$sede = $_POST['parametros'];
							$sql2="Select idVP, NombreVP from vp where VP_idsede='$sede'";
							$resultado2 = $mysqli->query($sql2);
							echo "<option value=0>Selecciona una vicepresidencia</option>";
							while($row = $resultado2 -> fetch_assoc()){
								//$cadena=$cadena."<option value=".$row['id_Peligro'].">".$row['Nombre_Peligro']."</option>";
								echo "<option value=".$row['idVP'].">".$row['NombreVP']."</option>";
							}
						}
						else{
							echo "No se guardo valor en factor";
						}
						mysqli_close($mysqli);
?>