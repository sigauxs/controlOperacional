<?php
include("../../reportepdf/conexion.php");
						if(isset($_POST['parametros'])){
							$dpto = $_POST['parametros'];
							$sql2="Select id_Area, Nombre_Area from areas where Area_id_Dpto='$dpto'";
							$resultado2 = $mysqli->query($sql2);
							echo "<option value=0>Selecciona una área</option>";
							while($row = $resultado2 -> fetch_assoc()){
								//$cadena=$cadena."<option value=".$row['id_Peligro'].">".$row['Nombre_Peligro']."</option>";
								echo "<option value=".$row['id_Area'].">".$row['Nombre_Area']."</option>";
							}
						}
						else{
							echo "No se guardo valor en factor";
						}
						mysqli_close($mysqli);
?>