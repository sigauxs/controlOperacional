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
		$idIns = $row3['ID INSP'];
		$fecha = $row3['FECHA'];
		$area = $row3['AREA'];
		$inspector = $row3['INSPECTOR'];
		$delegado = $row3['DELEGADO'];
		
	}




//$pdf -> Output();

$pdf -> Output('F', 'DocumentosPDF/'.'ID-'.$lastInspeccion.'-Inspeccion.pdf');
$rutaPDF = 'DocumentosPDF/ID-'.$lastInspeccion.'-Inspeccion.pdf';

echo "<script>
	  let para =  '$correoDA';
      let copia = '$correoINP';
      let link =  'https://sigpeco.sigpeconsultores.com.co/reportepdf/$rutaPDF';
      let idIns = '$idIns';
      let fecha = '$fecha';
      const area = '$area';
      const inspector = '$inspector';
      const delegado = '$delegado';

      const fetchSenEmail = async (to,cc,link,idIns,area,fecha,inspector,delegado) => {

     let _datos = {
        to: to,
        cc: cc, 
        link:link,
        idIns:idIns,
        area:area,
        fecha:fecha,
        inspector:inspector,
        delegado:delegado
}
const options = {
  method: 'POST',
  headers: {
              'Content-Type': 'application/json',
            },
            body:JSON.stringify(_datos)
};

var url = `https://sigpesendmail.herokuapp.com/api/send-email`;

console.log(url);
const response = await fetch(url, options);
const data = await response.json();

return data;

}

fetchSenEmail(para,copia,link,idIns,area,fecha,inspector,delegado).then(
resp => {
 if(resp == 'success'){
     window.location.href = 'https://sigpeco.sigpeconsultores.com.co/reportepdf/$rutaPDF';	
 }     
} 
)
	

</script>";


//$pdf -> Output();
$pdf -> Close();

?>



	