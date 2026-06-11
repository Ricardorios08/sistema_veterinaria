<style type="text/css">
<!--
.Estilo2 {font-family: "Trebuchet MS"; font-size: 12px; }
.Estilo3 {font-size: 10px}
.Estilo4 {font-family: "Trebuchet MS"}
.Estilo5 {font-size: 12px}
-->
</style>
<TABLE width="938">
<TR>
	<TD width="41" bgcolor="#CCCCCC"><div align="center" class="Estilo2">RUTA</div></TD>
	<TD width="67" bgcolor="#CCCCCC"><div align="center"><span class="Estilo2">COD SOCIO</span></div></TD>
	<TD width="199" bgcolor="#CCCCCC"><div align="center" class="Estilo2">SOCIO</div>	  <div align="center" class="Estilo2"></div></TD>
	<TD width="205" bgcolor="#CCCCCC"><div align="center" class="Estilo2">DOMICILIO</div></TD>
			<TD width="108" bgcolor="#CCCCCC"><div align="center" class="Estilo2">DEPARTAMENTO</div></TD>
						<TD width="182" bgcolor="#CCCCCC"><div align="center" class="Estilo2">DOMICILIO</div></TD>
                        <TD width="104" bgcolor="#CCCCCC"><div align="center"><span class="Estilo2">DEPARTAMENTO</span></div></TD>
                        <TD width="104" bgcolor="#CCCCCC"><div align="center"><span class="Estilo2">COD SOCIO </span></div></TD>
                        <TD width="104" bgcolor="#CCCCCC"><div align="center" class="Estilo4 Estilo5">DISTINTO</div></TD>
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

 $sql3 = "SELECT * FROM `socion_v2` WHERE cod_socio = $cod_socio";
$result3 = $db->Execute($sql3);

$domicilio1=strtoupper($result3->fields["domicilio"]);
$departamento1=strtoupper($result3->fields["departamento"]);


if ($domicilio != $domicilio1){	$distinto = "x";$cod_socio1 = $cod_socio;


?>

<TR>
	<TD><div align="center" class="Estilo3"><span class="Estilo4"><?php echo $ruta;?></span></div></TD>
	<TD><div align="center" class="Estilo3"><span class="Estilo4"><?php echo $cod_socio;?></span></div></TD>
	<TD><div align="left" class="Estilo3"><span class="Estilo4"><a href="../socios/modificar_socio.php?cod_socio=<?php print("$cod_socio");?>" class="Estilo3"><?php print("$apellido");?>, <?php print("$nombre");?></a>
	
	
	</span></div></TD>
	<TD><div align="left" class="Estilo3"><span class="Estilo4"><?php echo $domicilio;?></span></div></TD>
	<TD><div align="left" class="Estilo3"><span class="Estilo4"><?php echo $departamento;?></span></div></TD>
	<TD><div align="center" class="Estilo3">
	  <div align="left"><span class="Estilo4"><?php echo $domicilio1;?></span></div>
	</div></TD>
    <TD><div align="left"><span class="Estilo3"><span class="Estilo4"><?php echo $departamento1;?></span></span></div></TD>
    <TD><div align="center"><span class="Estilo3"><span class="Estilo4"><?php echo $cod_socio;?></span></span></div></TD>
    <TD><div align="center"><span class="Estilo3"><span class="Estilo4"><BLINK><?php echo $distinto;?> </BLINK></span></span></div></TD>
</TR>
<?
	
}

if ($departamento!= $domicilio1){	$distinto1 = "x";$cod_socio1 = $cod_socio;

?>

<TR>
	<TD><div align="center" class="Estilo3"><span class="Estilo4"><?php echo $ruta;?></span></div></TD>
	<TD><div align="center" class="Estilo3"><span class="Estilo4"><?php echo $cod_socio;?></span></div></TD>
	<TD><div align="left" class="Estilo3"><span class="Estilo4"><a href="../socios/modificar_socio.php?cod_socio=<?php print("$cod_socio");?>" class="Estilo3"><?php print("$apellido");?>, <?php print("$nombre");?></a>
	
	
	</span></div></TD>
	<TD><div align="left" class="Estilo3"><span class="Estilo4"><?php echo $domicilio;?></span></div></TD>
	<TD><div align="left" class="Estilo3"><span class="Estilo4"><?php echo $departamento;?></span></div></TD>
	<TD><div align="center" class="Estilo3">
	  <div align="left"><span class="Estilo4"><?php echo $domicilio1;?></span></div>
	</div></TD>
    <TD><div align="left"><span class="Estilo3"><span class="Estilo4"><?php echo $departamento1;?></span></span></div></TD>
    <TD><div align="center"><span class="Estilo3"><span class="Estilo4"><?php echo $cod_socio;?></span></span></div></TD>
    <TD><div align="center"><span class="Estilo3"><span class="Estilo4"><BLINK><?php echo $distinto;?> </BLINK></span></span></div></TD>
</TR>

<?
}


	$distinto = "";
	$distinto1 = "";
	$cod_socio1= "";

$result2->MoveNext();

	}


?></TABLE>
<?php 


?>