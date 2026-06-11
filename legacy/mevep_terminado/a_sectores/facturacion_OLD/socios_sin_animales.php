<style type="text/css">
<!--
.Estilo2 {font-family: "Trebuchet MS"; font-size: 12px; }
.Estilo3 {font-size: 10px}
.Estilo4 {font-family: "Trebuchet MS"}
-->
</style>
<TABLE width="850">
<TR>
	<TD width="83" bgcolor="#CCCCCC"><div align="center" class="Estilo2">COD SOCIO</div></TD>
	<TD width="363" bgcolor="#CCCCCC"><div align="center"><span class="Estilo2">NOMBRE</span></div></TD>
	<TD width="88" bgcolor="#CCCCCC"><div align="center" class="Estilo2">COD ANIMAL</div></TD>
	<TD width="296" bgcolor="#CCCCCC"><div align="center" class="Estilo2">NOMBRE MASCOTA</div></TD>
</TR>

<?php
include("../../conexiones/config.inc.php");



$sql="select * from socios order by cod_socio";
 $result1 = $db->Execute($sql);




if (!$result1) die("fallo".$db->ErrorMsg());
while (!$result1->EOF) {

$cod_socio=$result1->fields["cod_socio"];
$apellido=strtoupper($result1->fields["apellido"]);
$nombre=strtoupper($result1->fields["nombre"]);





$dia_nac = substr($fecha_nac,8,2);
$mes_nac = substr($fecha_nac,5,2);
$anio_nac = substr($fecha_nac,0,4);


$sql = "SELECT * FROM animal where cod_socio = $cod_socio";
$result = $db->Execute($sql);
	
$cod_socio=strtoupper($result->fields["cod_socio"]);
$nombre_mascota=strtoupper($result->fields["nombre"]);
$cod_animal=strtoupper($result->fields["cod_animal"]);


?>

<TR>
	<TD><div align="center" class="Estilo3"><span class="Estilo4"><?php echo $cod_socio;?></span></div></TD>
	<TD><div align="left" class="Estilo3"><span class="Estilo4"><?php print("$apellido");?>, <?php print("$nombre");?></span></div></TD>
	<TD><div align="center" class="Estilo3"><span class="Estilo4"><?php echo $cod_animal;?></span></div></TD>
<TD><div align="left" class="Estilo3"><span class="Estilo4"><?php echo $nombre_mascota;?></span></div></TD>
	
</TR>



<?php 

	$cot = $cot + 1;
$result1->MoveNext();

	}


?>
<TR>

<TD colspan="4" valign="top"><div align="left" class="Estilo3"><span class="Estilo4"><hr></span></div></TD>
</TR>

<TR>
	<TD colspan="3"><div align="center" class="Estilo3">
	  <div align="right"><span class="Estilo4">Cantidad de Registros: </span></div>
	</div>	  <div align="center" class="Estilo3">
	  <div align="right"><span class="Estilo4"></span></div>
	</div>	  <div align="center" class="Estilo3">
	  <div align="right"><span class="Estilo4"></span></div>
	</div></TD>
	<TD><div align="left" class="Estilo3"><span class="Estilo4"><?php echo $cot;?></span></div></TD>
</TR>
</TABLE>