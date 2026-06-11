<style type="text/css">
<!--
.Estilo2 {font-family: "Trebuchet MS"; font-size: 12px; }
.Estilo3 {font-size: 10px}
.Estilo4 {font-family: "Trebuchet MS"}
-->
</style>
<TABLE width="850">
<!--DWLayoutTable-->
<TR>
	<TD width="116" bgcolor="#CCCCCC"><div align="center" class="Estilo2">COD ANIMAL</div></TD>
		<TD width="312" bgcolor="#CCCCCC"><div align="center" class="Estilo2">MASCOTA</div></TD>
		<TD width="312" bgcolor="#CCCCCC"><div align="center" class="Estilo2">BORRAR</div></TD>
		<TD width="80" bgcolor="#CCCCCC"><div align="center"><span class="Estilo2">COD SOCIO</span></div></TD>
	<TD width="314" bgcolor="#CCCCCC"><div align="center" class="Estilo2">SOCIO</div></TD>
</TR>

<?php
include("../../conexiones/config.inc.php");

$sql = "SELECT * FROM animal order by cod_animal";
$result1 = $db->Execute($sql);

if (!$result1) die("fallo".$db->ErrorMsg());
while (!$result1->EOF) {


$cod_socio=strtoupper($result1->fields["cod_socio"]);
$nombre_mascota=strtoupper($result1->fields["nombre"]);
$especie=strtoupper($result1->fields["especie"]);
$raza=strtoupper($result1->fields["raza"]);
$pelaje=strtoupper($result1->fields["pelaje"]);
$tamanio=strtoupper($result1->fields["tamanio"]);
$color=strtoupper($result1->fields["color"]);
$sexo_mascota=strtoupper($result1->fields["sexo"]);
$fecha_nac=strtoupper($result1->fields["fecha_nac"]);
$cod_animal=strtoupper($result1->fields["cod_animal"]);
$cod_animal1=strtoupper($result1->fields["cod_animal"]);


$dia_nac = substr($fecha_nac,8,2);
$mes_nac = substr($fecha_nac,5,2);
$anio_nac = substr($fecha_nac,0,4);


$sql="select * from socios where cod_socio = $cod_socio";
 $result = $db->Execute($sql);

	
$cod_socio=$result->fields["cod_socio"];
$apellido=strtoupper($result->fields["apellido"]);
$nombre=strtoupper($result->fields["nombre"]);


?>

<TR>
	<TD><div align="center" class="Estilo3"><span class="Estilo4"><?php echo $cod_animal;?></span></div></TD>
<TD><div align="left" class="Estilo3"><span class="Estilo4"><?php echo $nombre_mascota;?></span></div></TD>

<TD><div align="left" class="Estilo3"><span class="Estilo4"><a href="borrar_mascota.php?cod_socio=<?php print("$cod_socio");?>&&cod_animal=<?php print("$cod_animal");?>&&nombre_mascota=<?php print("$nombre_mascota");?>" onClick="return confirm('&iquest;Est&aacute; seguro de Borrar la mascota con toda su historia Clinica?');"><img src="../../imagenes/office//1047.ico" alt="Borrar" border = "0"></a> </span></div></TD>




	<TD><div align="center" class="Estilo3"><span class="Estilo4"><?php echo $cod_socio;?></span></div></TD>
	<TD><div align="left" class="Estilo3"><span class="Estilo4"><?php print("$apellido");?>, <?php print("$nombre");?></span></div></TD>
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
<?php 


