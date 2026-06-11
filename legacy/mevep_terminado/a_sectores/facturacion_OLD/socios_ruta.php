<style type="text/css">
<!--
.Estilo2 {font-family: "Trebuchet MS"; font-size: 12px; }
.Estilo3 {font-size: 10px}
.Estilo4 {font-family: "Trebuchet MS"}
-->
</style>
<TABLE width="850">
<TR>
	<TD width="45" bgcolor="#CCCCCC"><div align="center" class="Estilo2">RUTA</div></TD>
	<TD width="76" bgcolor="#CCCCCC"><div align="center"><span class="Estilo2">COD SOCIO</span></div></TD>
	<TD width="284" bgcolor="#CCCCCC"><div align="center" class="Estilo2">SOCIO</div>	  <div align="center" class="Estilo2"></div></TD>
	<TD width="225" bgcolor="#CCCCCC"><div align="center" class="Estilo2">DOMICILIO</div></TD>
			<TD width="88" bgcolor="#CCCCCC"><div align="center" class="Estilo2">DEPARTAMENTO</div></TD>
						<TD width="104" bgcolor="#CCCCCC"><div align="center" class="Estilo2">TELEFONO</div></TD>
</TR>

<?php
include("../../conexiones/config.inc.php");

$sql = "SELECT * FROM `socios` WHERE no_imprimir = 'FALSO' order by ruta";
$result2 = $db->Execute($sql);

if (!$result2) die("fallo".$db->ErrorMsg());
while (!$result2->EOF) {


$cod_socio=$result2->fields["cod_socio"];
$apellido=strtoupper($result2->fields["apellido"]);
$nombre=strtoupper($result2->fields["nombre"]);
$tipo_doc=strtoupper($result2->fields["tipo_doc"]);
$documento=strtoupper($result2->fields["documento"]);
$telefono=strtoupper($result2->fields["telefono"]);
$domicilio=strtoupper($result2->fields["domicilio"]);
$departamento=strtoupper($result2->fields["departamento"]);

$importe_deuda=strtoupper($result2->fields["importe_deuda"]);
$importe_cuota=strtoupper($result2->fields["importe_cuota"]);
$ruta=strtoupper($result2->fields["ruta"]);



?>

<TR>
	<TD><div align="center" class="Estilo3"><span class="Estilo4"><?php echo $ruta;?></span></div></TD>
	<TD><div align="center" class="Estilo3"><span class="Estilo4"><?php echo $cod_socio;?></span></div></TD>
	<TD><div align="left" class="Estilo3"><span class="Estilo4"><a href="../socios/acomodar_rut.php?cod_socio=<?php print("$cod_socio");?>" class="Estilo3"><?php print("$apellido");?>, <?php print("$nombre");?></a>
	
	
	</span></div></TD>
	<TD><div align="left" class="Estilo3"><span class="Estilo4"><?php echo $domicilio;?></span></div></TD>
	<TD><div align="left" class="Estilo3"><span class="Estilo4"><?php echo $departamento;?></span></div></TD>
	<TD><div align="center" class="Estilo3"><span class="Estilo4"><?php echo $telefono;?></span></div></TD>
</TR>



<?php 
$result2->MoveNext();

	}


?></TABLE>
<?php 


?>