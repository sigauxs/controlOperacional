<?php

//Cambiar PDO , si no nos vamos antes.



include("../../connection/connection.php");
$connect = new Conexion();

require __DIR__ . '/vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

if(isset($_POST['Registrar'])){
if (isset($_POST['pnombre'], $_POST['papellido'], $_POST['tpdocumento'], $_POST['ndocumento'], $_POST['email'], $_POST['pass'], $_POST['cargo'], $_POST['tusuario'], $_POST['rol'], $_POST['area']) and $_POST['pnombre'] != '' and $_POST['papellido'] != '' and $_POST['tpdocumento'] != '' and $_POST['ndocumento'] != '' and $_POST['email'] != '' and $_POST['pass'] != '' and $_POST['cargo'] != '' and $_POST['tusuario'] != '' and $_POST['rol'] != '' and $_POST['area']) {

	$pnombre = $_POST['pnombre'];
	$papellido = $_POST['papellido'];
	$sapellido = $_POST['sapellido'];
	$tpdocumento = $_POST['tpdocumento'];
	$ndocumento = $_POST['ndocumento'];
	$email = $_POST['email'];
	$pass = $_POST['pass'];
	$cargo = $_POST['cargo'];
	$tusuario = $_POST['tusuario'];
	$rol = $_POST['rol'];
	$area = $_POST['area'];

	$snombre = " ";


	$sql = "SELECT * FROM usuarios WHERE Persona_idPersona = '$ndocumento' or Email = '$email'";
	$query = $connect->prepare($sql);
	$query->execute();
	$results = $query->fetchAll(PDO::FETCH_OBJ);

	if ($query->rowCount() <= 0) {

		$guardarPersona = "Call GuardarPersona(:primerNombre,'$snombre',:primerApellido,:segundoApellido,:tipoDocumento,:numeroDocumento)";
		$queryGuardarPersona = $connect->prepare($guardarPersona);

		$queryGuardarPersona->bindValue(':primerNombre', $pnombre);
		$queryGuardarPersona->bindValue(':primerApellido', $papellido);
		$queryGuardarPersona->bindValue(':segundoApellido', $sapellido);
		$queryGuardarPersona->bindValue(':tipoDocumento', $tpdocumento);
		$queryGuardarPersona->bindValue(':numeroDocumento', $ndocumento);

		if ($queryGuardarPersona->execute()) {

			$guardarUsuario = "Call GuardarUsuario(:email,:password,:cargo,:numeroDocumento,:tusuario,:rol)";
			$queryGuardarUsuario = $connect->prepare($guardarUsuario);

			$queryGuardarUsuario->bindValue(':email', $email);
			$queryGuardarUsuario->bindValue(':password', $pass);
			$queryGuardarUsuario->bindValue(':cargo', $cargo);
			$queryGuardarUsuario->bindValue(':numeroDocumento', $ndocumento);
			$queryGuardarUsuario->bindValue(':tusuario', $tusuario);
			$queryGuardarUsuario->bindValue(':rol', $rol);

			if ($queryGuardarUsuario->execute()) {

				$buscarUsuario = "SELECT idUsuario FROM usuarios WHERE Persona_idPersona = '$ndocumento'";
				$queryBuscarUsuario = $connect->prepare($buscarUsuario);
				$queryBuscarUsuario->execute();
				$resultadoBuscarUsuario = $queryBuscarUsuario->fetchAll(PDO::FETCH_ASSOC);

				foreach ($resultadoBuscarUsuario as $row) {
					$idUsuario = $row['idUsuario'];
				}
				// Pregunto si se tiene el id del usuario
				if ($idUsuario > 0) {
					// Valido si se selecciono una locacion en el formulario
					if (!empty($_POST['locacion'])) {
						// Recorro los checkbox de locacion que esten seleccionados y registro cada usuario en la locacion seleccionada
						foreach ($_POST['locacion'] as $seleccion) {
							$guardarPertenece = "Call GuardarPertenece('$idUsuario','$seleccion','$area')";
							$queryGuardarPertenece = $connect->prepare($guardarPertenece);
							$queryGuardarPertenece->execute();

							echo "<script type='text/javascript'> alert('Tarea Guardada'); window.location.href='" .$_ENV["URL"]. "/usuarios/lista.php'; 
								</script>";
						}
					}
				}
			}
		}

		$connect = null;
	} else {
		echo "El usuario existe";
	}
}
}

?>