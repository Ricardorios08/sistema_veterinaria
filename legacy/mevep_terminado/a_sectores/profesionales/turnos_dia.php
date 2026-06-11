


<script language="javascript">
function on_load()
{
document.getElementById("apellido").focus();
}


function verif_caracter(obj,evt)
{

	evt = (evt) ? evt : event;
	var charCode = (evt.charCode) ? evt.charCode : ((evt.which) ? evt.which : evt.keyCode);
	if (charCode == 13) 

	{
		switch(obj.id)
		{
				case "nro_paciente":
				document.getElementById("nro_afiliado").focus();
				break;
				case "nro_afiliado":
				document.getElementById("apellido").focus();
				break;
					case "apellido":
				document.getElementById("nombre").focus();
				break;

				case "nombre":
				document.getElementById("nro_documento").focus();
				break;
				case "nro_documento":
				document.getElementById("domicilio").focus();
				break;
			

				case "domicilio":
				document.getElementById("telefono").focus();
				break;
				case "telefono":
				document.getElementById("celular").focus();
				break;
				case "celular":
				document.getElementById("dia").focus();
				break;
				case "dia":
				document.getElementById("mes").focus();
				break;
				case "mes":
				document.getElementById("anio").focus();
				break;
				case "anio":
				document.getElementById("GUARDAR").focus();
				break;

				


				
		}
		return false;
	}
	return true;
}


</script>

<style type="text/css">
<!--
.Estilo25 {font-family: "Trebuchet MS"}
.Estilo46 {font-family: "Trebuchet MS"; font-size: 12px; }
-->
</style>
<BODY onload = "on_load()">


<?php
 

include ("../../conexiones/config.inc.php");


  $sql2="select * from profesionales where nro_profesional = '$profesionales'";
$result2 = $db->Execute($sql2);

$apellido=$result2->fields["apellido"];
$nombre=$result2->fields["nombre"];
$especialidad=$result2->fields["especialidad"];
$sexo=$result2->fields["sexo"];
$fecha_nacimiento=$result2->fields["fecha_nacimiento"];
$domicilio=$result2->fields["domicilio"];
$localidad=$result2->fields["localidad"];
$telefono=$result2->fields["telefono"];
$celular=$result2->fields["celular"];
$mail=$result2->fields["mail"];
$lunes=$result2->fields["lunes"];
$martes=$result2->fields["martes"];
$miercoles=$result2->fields["miercoles"];
$jueves=$result2->fields["jueves"];
$viernes=$result2->fields["viernes"];
$sabado=$result2->fields["sabado"];
$duracion_consulta=$result2->fields["duracion_consulta"];
$espacio_entre_turnos=$result2->fields["espacio_entre_turnos"];
$cantidad_turnos_diarios=$result2->fields["cantidad_turnos_diarios"]+1;
$turno=$result2->fields["turno"];
 $horario_turno_manana=$result2->fields["horario_turno_manana"];
$horario_turno_tarde=$result2->fields["horario_turno_tarde"];



$horaInicial=$result2->fields["horario_turno_manana"];
$segundos_horaInicial=strtotime($horaInicial);
$horaInicial=date("h:i",$segundos_horaInicial);
$minutoAnadir=$result2->fields["duracion_consulta"];

$segundos_minutoAnadir=$minutoAnadir*60;
 $nuevaHora=date("h:i",$segundos_horaInicial+$segundos_minutoAnadir);


$hora=date("h:i",$hora);

?>

<form action="guardar_turno.php" method="post">


	
	
<table width="840" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="103" bgcolor="#B8B8B8"><div align="center" class="Estilo46"><span class="Estilo25">TURNO</span></div></td>
    <td width="103" bgcolor="#B8B8B8"><div align="center" class="Estilo46"><span class="Estilo25">HORA:</span></div></td>
    <td width="318" bgcolor="#B8B8B8"><div align="center" class="Estilo46">
      <div align="center"><span class="Estilo25">MASCOTA</span></div>
    </div></td>
    <td width="209" bgcolor="#B8B8B8"><div align="center" class="Estilo46">
      <div align="center">SOCIO</div>
    </div></td>
    <td width="104" bgcolor="#B8B8B8"><div align="center"><span class="Estilo46">PARTICULAR</span></div></td>
    <td width="104" bgcolor="#B8B8B8"><div align="center"><span class="Estilo46">RAZA</span></div></td>
    <td width="104" bgcolor="#B8B8B8"><div align="center"><span class="Estilo46">OBSERVACIONES</span></div></td>
  </tr>




	
<?php
for($j = 1 ;$j < $cantidad_turnos_diarios ;$j++){

$titulo = "turno_".$j;
$col1 = "col1_".$j;
$col2 = "col2_".$j;
$col3 = "col3_".$j;
$col4 = "col4_".$j;
$col5 = "col5_".$j;
$col6 = "col6_".$j;
$col7 = "col7_".$j;
$col8 = "col8_".$j;
$col9 = "col9_".$j;




  $sql2="select * from turno where nro_profesional = '$profesionales' and fecha_turno = '$feca' and nro_turno = $j";
$result2 = $db->Execute($sql2);

$nro=$result2->fields["nro_turno"];
$val1=$result2->fields["col1"];
$val2=$result2->fields["col2"];
$val3=$result2->fields["col3"];
$val4=$result2->fields["col4"];
$val5=$result2->fields["col5"];
$val6=$result2->fields["col6"];




  ?><tr bgcolor="#BFE7F2">
  
    <td><?php echo $j;?></td>
    <td><?php echo $val1;?></td>
   <td><?php echo $val2;?></td>
<td><?php echo $val3;?></td>
   <td><?php echo $val4;?></td>
<td><?php echo $val5;?></td>
<td><?php echo $val6;?></td>
  </tr>

<?php
}
?>
</table>
 
</form>
