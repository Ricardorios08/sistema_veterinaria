<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Documento sin t&iacute;tulo</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<style type="text/css">
<!--
.Estilo1 {color: #FFFFFF}
.Estilo37 {color: #000000; font-family: Arial, Helvetica, sans-serif; font-size: 10px; }
-->
</style>

<script language="javascript">
function on_load()
{
document.getElementById("cod_mercaderia").focus();
document.getElementById("cod_mercaderia").style.backgroundColor = "#CCFFCC";
}

	

</script>

</head>

<body onload = "on_load()">
<FORM name="form" ACTION="<?php echo $_SERVER["PHP_SELF"];?>" METHOD = "POST">
<table width="252" border="0">
  <tr bgcolor="#000099">
    <td width="70" scope="col"><div align="center" class="Estilo1">Cod.</div></td>
    <td scope="col"><div align="center" class="Estilo1">Descripcion</div></td>
  </tr>


<?
if(isset($_REQUEST['Alta'])) {
	
	switch ($_REQUEST['Alta'])
	{
		
case "OK":
				{


$cod_mercaderia = $_REQUEST['cod_mercaderia'];

include("../../../conexiones/config_pro.php");

if ($cod_mercaderia == ""){
$sql = "SELECT * FROM `mercaderia` order by nombre";
}
else
{
$sql = "SELECT * FROM `mercaderia`  WHERE  `cod_merca` = '$cod_mercaderia' OR descripcion like '$cod_mercaderia%' or nombre like '$cod_mercaderia%'";
}
$result = $db->Execute($sql);

if (!$result) die("fallo".$db->ErrorMsg());

 while (!$result->EOF) {

$descripcion=strtoupper($result->fields["descripcion"]);
$cod_merca=strtoupper($result->fields["cod_merca"]);

if ($descripcion == ""){

$result->MoveNext();
}
else
	 {



?>

  <tr bgcolor="#FFFFFF">
    <td scope="col"><span class="Estilo37"><?echo $cod_merca;?></span></td>
    <td scope="col"><span class="Estilo37"><?echo $descripcion;?></span></td>
  </tr>

<?
   $result->MoveNext();
				}
				}

 
break;
	}
	}
	}
	?>	

</table>

</form>
</body>

</html>
