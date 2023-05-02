<?php

$lastInspeccion = $_GET['lastInspeccion'];
$inspector = $_GET['inspector'];
$hallazgop = $_GET['hallazgop'];

require "./fpdf/fpdf.php";
require "./cabeceraypie.php";
require "conexion.php";


$sql = "Call ReporteHallazgos($lastInspeccion)";
$resultado = $mysqli->query($sql);

/*
$AltoCelda = 10;
$Ejex = 0;
$Ejey = 0;
$NumeroHallazgo = 0;
*/

$pdf = new PDF("P", "mm", "Legal");
$pdf -> AliasNbPages();
$pdf -> AddPage();
/*
$pdf -> AddFont('Tahoma', '', 'tahoma.php');
$pdf -> SetFont("Tahoma", "", 11);
*/

$pdf -> SetTextColor(61, 61, 60);
$pdf -> DatosH($sql, $resultado);

mysqli_close($mysqli);

require "conexion.php";
	$sql3 = "Call DatosInspeccionEncabezado2($lastInspeccion)";
	$resultado3 = $mysqli->query($sql3);
	while($row3 = $resultado3 -> fetch_assoc()){
		
		$correoRA = $row3['CORREO RA'];
		$correoDA = $row3['CORREO DELEGADO'];
		$correoINP = $row3['CORREO INSP'];
		
	}




$pdf -> Output();
$pdf -> Close();
$pdf -> Output('F', 'DocumentosPDF/'.'ID-'.$lastInspeccion.'-Inspeccion.pdf');
$rutaPDF = 'DocumentosPDF/ID-'.$lastInspeccion.'-Inspeccion.pdf';
unlink($rutaPDF);



?>