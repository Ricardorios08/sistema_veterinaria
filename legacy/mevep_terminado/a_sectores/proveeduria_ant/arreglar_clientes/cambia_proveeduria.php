<?
//echo "http://192.168.1.7/www/bioquimica/a_sectores/proveeduria/arreglar_clientes/cambia_proveeduria.php";
//echo "<br>";
//echo "<hr>";
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


$sql="select * from cambio_cuenta order by cuenta_nueva asc";

	$result = $db->Execute($sql);
?>

<table width="80%" border="0">
  <!--DWLayoutTable-->
  <tr bordercolor="#FFFFCC" bgcolor="#FFFFFF">
    <td height="26" colspan="3" valign="top"><div align="center"><font color="#FFFFFF" size="2"><font color="#000000" face="Arial, Helvetica, sans-serif">LISTADO DE CLIENTES EXTERNOS. Emitido el <?echo $hoy;?></font></font></div></td>
  </tr>    
  <tr bordercolor="#FFFFCC" bgcolor="#FFFFFF">
    <td height="22" colspan="3"><hr noshade></td>
  </tr>
  <tr bordercolor="#FFFFCC" bgcolor="#FFFFFF">
    <td width="446" height="20"><div align="center"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">RAZON SOCIAL O APELLIDO</font></div></td>

		<td width="80"><div align="center"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif"> ACTUAL</font></div></td>
    <td><div align="center"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">NUEVA</font></div></td>
    
  </tr>

    <tr bordercolor="#FFFFFF" bgcolor="#FFFFFF">
    <td height="22" colspan="3"><hr noshade></td>
    </tr>

  <?
 
  if (!$result) die("fallo".$db->ErrorMsg());
  while (!$result->EOF) {

 $cuenta_actual=strtoupper($result->fields["cuenta_actual"]);

 $cuenta_nueva=$result->fields["cuenta_nueva"];






if ($cuenta_actual != $cuenta_nueva){

$sql1="select * from clientes where cuenta = $cuenta_actual";
$result1 = $db->Execute($sql1);

$cuenta=$result1->fields["cuenta"];
$denominacion=strtoupper($result1->fields["denominacion"]);



if ($cuenta == $cuenta_nueva){
	$existe = "SI";
}else
	{
$existe = "NO";
	}



 $sql5 = "UPDATE `clientes` SET   `cuenta` = '$cuenta_nueva' where `cuenta` = '$cuenta_actual'";
$result5 = $db->Execute($sql5);

$sql5 = "UPDATE `condiciones_clientes` SET   `cuenta` = '$cuenta_nueva' where `cuenta` = '$cuenta_actual'";
$result5 = $db->Execute($sql5);

 $sql5 = "UPDATE `ventas_encabezado` SET   `nro_cliente` = '$cuenta_nueva' where `nro_cliente` = '$cuenta_actual'";
$result5 = $db->Execute($sql5);

 $sql5 = "UPDATE `stock` SET   `cuenta` = '$cuenta_nueva' where `cuenta` = '$cuenta_actual' and tipo_cuenta = 2";
$result5 = $db->Execute($sql5);

$sql5 = "UPDATE `composicion_saldos` SET   `cuenta` = '$cuenta_nueva' where `cuenta` = '$cuenta_actual' and tipo_cuenta = 2";
$result5 = $db->Execute($sql5);

 $sql5 = "UPDATE `resumen_cta_vta` SET   `cuenta` = '$cuenta_nueva' where `cuenta` = '$cuenta_actual' and tipo_cuenta = 2";
$result5 = $db->Execute($sql5);


$sql12="select * from clientes where cuenta = $cuenta_nueva";
//$result12 = $db->Execute($sql12);

$cont = $cont + 1;
?>





  <tr bordercolor="#FFFFFF" bgcolor="#FFFFFF">

	   <td width="446"><div align="left"><font size="2" face="Arial, Helvetica, sans-serif"><?echo $denominacion;?></font></div></td>
    <td width="80"><div align="center"><font size="2" face="Arial, Helvetica, sans-serif"><?echo $cuenta_actual;?></font></div></td>
	   <td width="78"><div align="center"><font size="2" face="Arial, Helvetica, sans-serif"><?echo $cuenta_nueva;?></font></div></td>
<div align="center"></div>
  </tr>
 
  <?
}

	

$result->MoveNext();
	}

?>

 <tr bordercolor="#FFFFFF" bgcolor="#FFFFFF">
    <td height="22" colspan="3"><hr noshade></td>
    </tr>
  <tr bordercolor="#FFFFFF" bgcolor="#FFFFFF">
    <td height="20" colspan="3"><div align="center"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">CANTIDAD DE CLIENTES EXTERNOS </font><font size="2" face="Arial, Helvetica, sans-serif"><?print("$cont");?></font></div></td>
    </tr>

</table>
