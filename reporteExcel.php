<?php

require "./reportepdf/conexion.php";

$fi = $_POST['fechaInicio'];
$ff = $_POST['fechaFinal'];

//$sql2 = "Call ReporteGeneral('$fi', '$ff')";
$sql2 = "Call ReporteGeneral('$fi','$ff')";
header("Content-type: application/vnd.ms-excel; charset=iso-8859-1");
header("Content-Disposition: attachment; filename=Inspecciones-CO.xls");
?>
<table border="1">
    
    <tr>
        <th>ID INSPECCION</th>
        <th>ID HALLAZGO</th>
        <th>FECHA INSPECCION</th>
        <th>EMPRESA</th>
        <th>SEDE</th>
        <th>LOCACION</th>
        <th>VICEPRESIDENCIA</th>
        <th>DEPARTAMENTO</th>
        <th>AREA</th>
        <th>DELEGADO POR EL AREA</th>
        <th>TURNO</th>
        <th>INSPECTOR</th>
        <th>FACTOR</th>
        <th>RIESGO O PELIGRO</th>
        <th>CONTROL</th>
        <th>JERARQUIA DEL CONTROL</th>
        <th>DESVIACION</th>
        <th>TIPO DE HALLAZGO</th>
        <th>ESTADO</th>
        <th>ACTIVIDAD</th>
        <th>DESCRIPCION</th>
    </tr>
    <?php $resultado2 = $mysqli->query($sql2);

    while ($row = $resultado2->fetch_assoc()) {  ?>
    <tr>
        <td><?php echo $row['ID INSPECCION']; ?></td>
        <td><?php echo $row['ID HALLAZGO']; ?></td>
        <td><?php echo $row['FECHA INSPECCION']; ?></td>
        <td><?php echo utf8_decode($row['EMPRESA']); ?></td>
        <td><?php echo utf8_decode($row['SEDE']); ?></td>
        <td><?php echo utf8_decode($row['LOCACION']); ?></td>
        <td><?php echo utf8_decode($row['VICEPRESIDENCIA']); ?></td>
        <td><?php echo utf8_decode($row['DEPARTAMENTO']); ?></td>
        <td><?php echo utf8_decode($row['AREA']); ?></td>
        <td><?php echo utf8_decode($row['DELEGADO POR EL AREA']); ?></td>
        <td><?php echo utf8_decode($row['TURNO']); ?></td>
        <td><?php echo utf8_decode($row['INSPECTOR']); ?></td>
        <td><?php echo utf8_decode($row['FACTOR']); ?></td>
        <td><?php echo utf8_decode($row['RIESGO O PELIGRO']); ?></td>
        <td><?php echo utf8_decode($row['CONTROL']); ?></td>
        <td><?php echo utf8_decode($row['JERARQUIA']); ?></td>
        <td><?php echo utf8_decode($row['DESVIACION']); ?></td>
        <td><?php echo utf8_decode($row['TIPO DE HALLAZGO']); ?></td>
        <td><?php 
                if(utf8_decode($row['TIPO DE HALLAZGO'])=="Positivo"){
                    echo 'No aplica para hallazgos positivos';
                }else{
                    echo utf8_decode($row['ESTADO']); 
                }
            ?>
        </td>
        <td><?php echo utf8_decode($row['ACTIVIDAD']); ?></td>
        <td><?php echo utf8_decode($row['DESCRIPCION']); ?></td>
    </tr>
    
    <?php } // cerrar conexion ?>
   
</table>
