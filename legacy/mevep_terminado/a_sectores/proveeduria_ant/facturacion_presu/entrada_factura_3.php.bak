<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">

<script language="javascript">
function on_load()
{
document.getElementById("cod_mercaderia").focus();
document.getElementById("cod_mercaderia").style.backgroundColor = "#CCFFCC";
}


function verif_caracter(obj,evt)
{

	evt = (evt) ? evt : event;
	var charCode = (evt.charCode) ? evt.charCode : ((evt.which) ? evt.which : evt.keyCode);
	if (charCode == 13) 

	{
		switch(obj.id)
		{
				case "forma_pago":

document.getElementById("cod_mercaderia").focus();
				break;

				case "cod_mercaderia":
document.getElementById("cod_mercaderia").style.backgroundColor = "#ffffff";	document.getElementById("cantidad").style.backgroundColor =  "#CCFFCC";
				document.getElementById("cantidad").focus();
				break;
				
				case "cantidad":
document.getElementById("cod_mercaderia").style.backgroundColor = "#CCFFFF";	document.getElementById("cantidad").style.backgroundColor =  "#CCFFFF";

				document.getElementById("OK").focus();
				break;
				
				
		}
		return false;
	}
	return true;
}
function abrirVentana() {
	var cod_detalle = <?echo $cod_detalle;?> 
    open("factura_papel.php?cod_detalle=<?print($cod_detalle);?>&&nro_factura=<?print($nro_factura);?>&&nro_cliente=<?print($nro_cliente);?>&&matriculae=<?print($matricula);?>&&forma_pago=<?print($forma_pago);?>&&dia=<?print($dia);?>&&mes=<?print($mes);?>&&anio=<?print($año);?>","MERCADERIA", "width=550,height=500,toolbar=no,directories=no,menubar=no,status=no");
}

function abrirVentan() {
	var cod_detalle = <?echo $cod_detalle;?> 
    open("buscador_rapido.php","miVentana", "width=300,height=200,toolbar=no,directories=no,menubar=no,status=no, top = 35");
}

</script>
<html>
<head>
<title>Documento sin t&iacute;tulo</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<style type="text/css">
<!--
.Estilo4 {
	color: #006633;
	font-size: 10px;
	font-weight: bold;
}
.Estilo6 {font-size: 12}
.Estilo28 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 10px;
}
.Estilo21 {font-size: 10px; color: #006633; }
.Estilo22 {color: #006633; font-size: 10px; font-weight: bold; font-family: Arial, Helvetica, sans-serif; }
.Estilo26 {	color: #000000;
	font-family: Arial, Helvetica, sans-serif;
	font-size: 10px;
}
.Estilo30 {color: #FFFFFF}
.Estilo31 {font-family: Arial, Helvetica, sans-serif; font-size: 10px; color: #FFFFFF; }
.Estilo32 {
	font-size: 12px;
	font-family: Arial, Helvetica, sans-serif;
	font-style: normal;
	line-height: normal;
	font-weight: normal;
	color: #000000;
	background-color: #E8DCFC;
	cursor: crosshair;
	text-align: center;
}
.Estilo33 {font-size: 10px; font-family: Arial, Helvetica, sans-serif; color: #006633;}
.Estilo34 {font-family: Arial, Helvetica, sans-serif}
.Estilo35 {font-size: 10px}
-->
</style>
</head>

<?

$nro_factura= $_REQUEST['nro_factura'];
$dia= $_REQUEST['dia'];
$mes= $_REQUEST['mes'];
$año= $_REQUEST['anio'];
$nro_cliente= $_REQUEST['nro_cliente'];
$matricula= $_REQUEST['matricula'];
$pasada= $_REQUEST['pasada'];
$forma_pago= $_REQUEST['forma_pago'];




	if (($nro_cliente !="" and $matricula!="")){

	echo "No Puede ingresar Nº de Cliente y Matricula a la vez";
	?>
	<a href="entrada_factura.php" target = "central"> [Volver]</a>
	<?
}
elseif ($nro_cliente!=""){
 include("../../../conexiones/config_pro.php");
$sql="select * from clientes where cuenta like '$nro_cliente'";
$result = $db->Execute($sql);
$denominacion=strtoupper($result->fields["denominacion"]);
$todo = $denominacion." (".$nro_cliente.")";
$band = "cliente";
}
elseif ($matricula!=""){ 
 include("../../../conexiones/config.inc.php");
$sql="select * from datos_laboratorio where nro_laboratorio like '$matricula'";
$result=$db->Execute($sql);

$nombre_laboratorio=strtoupper($result->fields["nombre_laboratorio"]);
$matricula1=$result->fields["matricula"];

$sql1="select * from datos_personales where matricula like '$matricula1'";
$result1 = $db->Execute($sql1);

$nombre=strtoupper($result1->fields["nombre"]);
$apellido=strtoupper($result1->fields["apellido"]);
$nombre_responsable=$apellido.", ".$nombre." (".$matricula.")";

$todo="Lab. ".$nombre_laboratorio." / Resp. ".$nombre_responsable;
$band = "cuenta";
}



?>

<body onload = "on_load ()">
<FORM name="form" ACTION="entrada_factura_3.php"" METHOD = "POST">
<table width="103%" border="0">
  <tr bgcolor="#E1F2EF">
    <td width="53%" bgcolor="#000099"><div align="left" class="Estilo28 Estilo30">
      <div align="right"><strong>pag3 N&ordm; FACTURA: <?echo $nro_factura;?></strong></div>
    </div></td>
    <td width="47%" bgcolor="#000099"><div align="right" class="Estilo31">FECHA   <?echo $dia;?> / <?echo $mes;?> / <?echo $año;?> </div></td>
  </tr>
  <tr bgcolor="#E1F2EF">
    <td colspan="2"><span class="Estilo28">Nombre o Raz&oacute;n Social: <?echo $todo;?></span> </td>
  </tr>
  <tr bgcolor="#E6E6E6">

	<td height="26" colspan="2">
	 <span class="Estilo32">
	 <input name="forma_pago" type="text" class="Estilo32" id="forma_pago" onKeyPress="return verif_caracter(this,event)" value = "<?echo $forma_pago;?>" size = "1">
     </span>
	 <?if ($band == "cuenta"){?>
	  1-Contado
  / 2-Liquidaci&oacute;n <?}?>
  
<?if ($band == "cliente"){?>

  1-Contado / 2-Cuenta Corriente<?}?>


  </td>
  </tr>
  <tr bgcolor="#E6E6E6">
    <td height="26"><span class="Estilo4 Estilo6 Estilo16"><span class="Estilo21"><span class="Estilo22"><span class="Estilo26">
        Producto
                <input name="cod_mercaderia" type="text" id="cod_mercaderia" size = "5" onKeyPress="return verif_caracter(this,event)"><!-- <a href="javascript:abrirVentan()">BUSCAR</a> -->
                Cantidad
                <input name="cantidad" type="text" id="cantidad" size = "2" onKeyPress="return verif_caracter(this,event)">
  
        <input name="matricula" type="hidden" value ="<?echo $matricula;?>">
        <input name="nro_cliente" type="hidden" value ="<?echo $nro_cliente;?>">
        <input name="dia" type="hidden" value ="<?echo $dia;?>">
        <input name="mes" type="hidden" value ="<?echo $mes;?>">
        <input name="anio" type="hidden" value ="<?echo $año;?>">
        <input name="nro_factura" type="hidden" value ="<?echo $nro_factura;?>">
        <input name="band" type="hidden" value ="<?echo $band;?>">
		      <input name="cod_merca" type="hidden" value ="<?echo $cod_mercaderia;?>">
  

              <input name="Alta" type="submit" value= "OK" id = "OK" >
			      <input name="Alta" type="submit" value= "BUSCAR" id = "BUSCAR" ONCLICK="javascript:abrirVentan()">
    </span></span></span></span>                <span class="Estilo4 Estilo16  Estilo6"><span class="Estilo21"><span class="Estilo33"><span class="Estilo32"></span></span></span></span> </td>
    <td height="26"><div align="center"><span class="Estilo4 Estilo6 Estilo16"><span class="Estilo21"><span class="Estilo22"><span class="Estilo26"><a href="javascript:abrirVentana()"><IMG SRC="../../../imagenes/botones/btn_imprimir.gif" alt="Imprimir" border = "0"></a>
       <!--  <input name="Alta" type="submit" value= "FACTURAR" id = "Alta" target = "_blank" > -->
    </span></span></span></span></div></td>
  </tr>
</table>
</form>



<?		if(isset($_REQUEST['Alta'])) {

	switch ($_REQUEST['Alta'])
					{
			case "OK":
						{


?><script language="javascript">
function abrirVentana() {
	var cod_detalle = <?echo $cod_detalle;?> 
    open("factura_papel.php?cod_detalle=<?print($cod_detalle);?>&&nro_factura=<?print($nro_factura);?>&&nro_cliente=<?print($nro_cliente);?>&&matriculae=<?print($matricula);?>&&forma_pago=<?print($forma_pago);?>&&dia=<?print($dia);?>&&mes=<?print($mes);?>&&anio=<?print($año);?>","miVentana", "width=550,height=500,toolbar=no,directories=no,menubar=no,status=no, scrolling=YES");
}


</script>
<?

$nro_factura= $_REQUEST['nro_factura'];
$dia= $_REQUEST['dia'];
$mes= $_REQUEST['mes'];
$año= $_REQUEST['anio'];
$nro_cliente= $_REQUEST['nro_cliente'];
$matricula= $_REQUEST['matricula'];
$forma_pago= $_REQUEST['forma_pago'];
$cantidad= $_REQUEST['cantidad'];
$cod_mercaderia= $_REQUEST['cod_mercaderia'];
$band= $_REQUEST['band'];

include("../../../conexiones/config_pro.php");
$sql = "SELECT * FROM `mercaderia`  WHERE  `cod_merca` = $cod_mercaderia";
$result = $db->Execute($sql);
$descripcion=strtoupper($result->fields["descripcion"]);
$precio_unitario=strtoupper($result->fields["margendif"]);

if ($cantidad == ""){
ECHO "NO INGRESO CANTIDAD";
	
}

if ($cod_mercaderia== ""){
ECHO "NO INGRESO MERCADERIA";

}

if ($descripcion == ""){
	ECHO "PRODUCTO INEXISTENTE";
	
}

$total = $cantidad * $precio_unitario;
 $sql = "INSERT INTO `deta_fact` ( `nro_factura` , `cod_detalle` , `cod_mercaderia` , `cantidad` , `precio_unitario` , `total` )  VALUES ('$nro_factura' , '' ,'$cod_mercaderia' , '$cantidad' , '$precio_unitario' , '$total')";
mysql_query($sql);

include ("refrescar.php");
break;
						}

	case "BUSCAR":
							
						{


?><script language="javascript">
function abrirVentan() {
	var cod_detalle = <?echo $cod_detalle;?> 
    open("buscador_rapido.php","miVentana", "width=300,height=200,toolbar=no,directories=no,menubar=no,status=no, top = 35");
}
</script>
<?

BREAK;
						}
					}
			   }
			   ?>
</html>
