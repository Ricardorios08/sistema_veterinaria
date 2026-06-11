<body onUnload="window.opener.openedImprimir=0;" onLoad="window.print(); window.close();">

<?php
global $buscador_rapido;

if ($borrar != 1){
$buscador_rapido=$_POST["buscador_rapido"];
$palabra=$_POST["busca"];
}


$hoy = date("d/m/y");

 include("adodb.inc.php");
 $db = NewADOConnection('mysql');
 $db->Connect("localhost", "root", "", "proveeduria");

$B = 1;
 include("../../conexiones/config_grabacion.php");

$sql="select * from clientes where cuenta like '%$palabra%' or estado like '%$palabra%' or denominacion like '%$palabra%' or domicilio like '%$palabra%' order by localidad, denominacion, cuenta asc ";

	$result = $db_pro->Execute($sql);
?>
<table width="103%" border="0">
  <tr bordercolor="#FFFFCC" bgcolor="#E6E6E6">
    <td colspan="12"><div align="center"><font color="#FFFFFF" size="2"><font color="#000000" face="Arial, Helvetica, sans-serif">COMPARA CUENTAS EXTERNAS CON ASOCIADOS . Emitido el <?echo $hoy;?></font></font></div></td>
  </tr>
  <tr bordercolor="#FFFFCC" bgcolor="#000099">
    <td width="15%"><div align="center"><font color="#FFFFFF" size="2" face="Arial, Helvetica, sans-serif">CUENTA</font></div></td>
    <td width="46%"><div align="center"><font color="#FFFFFF" size="2" face="Arial, Helvetica, sans-serif">EXTERNO</font></div></td>
    <td width="39%"><div align="center"><font color="#FFFFFF" size="2" face="Arial, Helvetica, sans-serif">ASOCIADO</font></div></td>

  </tr>

 <?



 
  if (!$result) die("fallo".$db_pro->ErrorMsg());
  while (!$result->EOF) {

	
$cuenta=strtoupper($result->fields["cuenta"]);
$denominacion=strtoupper($result->fields["denominacion"]);
$estado=strtoupper($result->fields["estado"]);
$telefono=strtoupper($result->fields["telefono"]);
$localidad=strtoupper($result->fields["localidad"]);

 $sql1="select * from datos_laboratorio where nro_laboratorio = '$cuenta'";
$result1 = $db_bq->Execute($sql1);
$nombre_laboratorio=strtoupper($result1->fields["nombre_laboratorio"]);


switch ($estado)
						  {
	case "1": //activo
					{
$estad_o="ACTIVO";
				  }
		break;

			case "0": //activo
					{
$estad_o="ACTIVO";
				  }
		break;


	case "2": //suspendido
		  {
$estad_o="SUSPENDIDO";
		  }
break;

	case "3": //baja
		  {
$estad_o="BAJA";
		  }
break;

	case "4": //baja
		  {
$estad_o="BLOQUEADO";
		  }
break;
						  }


IF ($nombre_laboratorio != ""){

$cont = $cont + 1;
?>
  <tr bordercolor="#FFFFFF" bgcolor="#FFFFFF">
    <td bordercolor="#E8DCFC"><div align="center"><font size="2" face="Arial, Helvetica, sans-serif"><?print("$cuenta");?></font></div></td>
    <td bordercolor="#E8DCFC"><div align="left"><font size="2" face="Arial, Helvetica, sans-serif"><?print("$denominacion");?></font></div></td>
 
	<td><div align="left"><font size="2" face="Arial, Helvetica, sans-serif"><?print("$nombre_laboratorio");?></font></div></td>
  </tr>
 
<?
}



if ($cont == 29){
	$cont = 0;

?>
<table width="103%" border="0">
  <tr bordercolor="#FFFFCC" bgcolor="#E6E6E6">
    <td colspan="12"><div align="center"><font color="#FFFFFF" size="2"><font color="#000000" face="Arial, Helvetica, sans-serif">COMPARA CUENTAS EXTERNAS CON ASOCIADOS . Emitido el <?echo $hoy;?></font></font></div></td>
  </tr>
  <tr bordercolor="#FFFFCC" bgcolor="#000099">
    <td width="15%"><div align="center"><font color="#FFFFFF" size="2" face="Arial, Helvetica, sans-serif">CUENTA</font></div></td>
    <td width="46%"><div align="center"><font color="#FFFFFF" size="2" face="Arial, Helvetica, sans-serif">EXTERNO</font></div></td>
    <td width="39%"><div align="center"><font color="#FFFFFF" size="2" face="Arial, Helvetica, sans-serif">ASOCIADO</font></div></td>

  </tr>

 <?
}
$result->MoveNext();
	}

?>
</table>
