<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">

<script language="javascript">
function on_load()
{
document.getElementById("cod_mercaderia").focus();
document.getElementById("cod_mercaderia").style.backgroundColor =  "#CCFFCC";
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
document.getElementById("cod_mercaderia").style.backgroundColor =  "#CCFFCC";
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

function abrirVentan() {
	var cod_detalle = <?echo $cod_detalle;?> 
    open("buscador_rapido.php","miVentana", "width=300,height=600,toolbar=no,directories=no,menubar=no,status=no, scrollbars=01, location = 01, top = 35");
}

</script>


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
.Estilo16 {font-family: Arial, Helvetica, sans-serif}
.Estilo21 {font-size: 10px; color: #006633; }
.Estilo22 {color: #006633; font-size: 10px; font-weight: bold; font-family: Arial, Helvetica, sans-serif; }
.Estilo26 {
	color: #000000;
	font-family: Arial, Helvetica, sans-serif;
	font-size: 10px;
}
-->


<!--
.Estilo67 {color: #FFFFFF; font-size: 12px; font-family: Arial, Helvetica, sans-serif;}
.Estilo70 {color: #FFFFFF}
.Estilo71 {font-size: 10px}
.Estilo72 {font-size: 12px; color: #FFFFFF; }
-->

<!--
.Estilo78 {font-family: Arial, Helvetica, sans-serif; color: #000000;}
-->



</style>
</head>

<?

$nro_factura= $_REQUEST['nro_factura'];
$fact= $_REQUEST['tipo_fact'];


$dia= $_REQUEST['dia'];
$mes= $_REQUEST['mes'];
$anio= $_REQUEST['anio'];

$fecha= $anio.$mes.$dia;
$producto= $_REQUEST['producto'];
$cod_merquita= $_REQUEST['cod_merquita'];
$operador= $_REQUEST['operador'];
$cantidad_existente= $_REQUEST['cantidad_existente'];
$porc_dto= $_REQUEST['porc_dto'];
$forma_pag=$_REQUEST["forma_pago"];
	for ($i=0;$i<count($forma_pag);$i++)    
	{     
	$forma_pago = $forma_pag[$i];    
	}



if ($for_pago != 1){

}

/*if ($opera == 1){
include("../../../conexiones/config_pro.php");
 $sql = "SELECT * FROM `ventas_encabezado`  WHERE  `nro_factura` = $nro_factura";
$result = $db->Execute($sql);
 $forma_pago=strtoupper($result->fields["forma_pago"]);
}
else
{
$forma_pag=$_REQUEST["forma_pago"];
	for ($i=0;$i<count($forma_pag);$i++)    
	{     
	$forma_pago = $forma_pag[$i];    
	}
}

*/
//if (($operador != 101) && ($operador != 201)){
//	$leyenda = "OPERADOR INEXISTENTE";
//	include ("../../../alertas/campo_vacio.php");
//	EXIT;
//}
//ELSE{


Switch ($operador){
	case "101":{
		$nombre_operador = "Sergio Zavala";
		break;
	}

	case "201":{
$nombre_operador = "Juan Tomas";
break;
	}
}

//}




/*if ($opera = 1){
include("../../../conexiones/config_pro.php");
 $sql = "SELECT * FROM `ventas1_encab_temp`  WHERE  `nro_factura` = $nro_factura";
$result = $db->Execute($sql);
 $operador=strtoupper($result->fields["operador"]);
}
else{
if ($operador == ""){
	$leyenda = "No Ingreso Operador";
	include ("../../../alertas/campo_vacio.php");
	EXIT;
}
}

*/


$cod_cliente= $_REQUEST['cod_cliente'];
 $cod_laboratorio= $_REQUEST['cod_laboratorio'];

$pasada= $_REQUEST['pasada'];
//$nro_cliente= $_REQUEST['nro_cliente'];
//$matricula= $_REQUEST['matricula'];

if (($cod_cliente == "") && ($cod_laboratorio == "")){

if ($pasada != 1){

$matricul=$_REQUEST["matricula"];
	for ($i=0;$i<count($matricul);$i++)    
	{     
	$matricula = $matricul[$i];    
	}


$nro_client=$_REQUEST["nro_cliente"];
	for ($i=0;$i<count($nro_client);$i++)    
	{     
	$nro_cliente = $nro_client[$i];    
	}

}else
{
$nro_cliente= $_REQUEST['nro_cliente'];
$matricula= $_REQUEST['matricula'];
}


}

else{


$nro_cliente = $cod_cliente;
$matricula= $cod_laboratorio;


}


if ($forma_pago == ""){
$forma_pago = "CTA/CTE";
}


if (($nro_cliente ==0 and $matricula==0)){
$leyenda = "Debe Ingresar o un cliente o un laboratorio";
include ("../../../alertas/campo_vacio.php");
exit;
}

elseif ($nro_cliente!=0){
 include("../../../conexiones/config_pro.php");
$sql="select * from clientes where cuenta like '$nro_cliente'";
$result = $db->Execute($sql);
$denominacion=strtoupper($result->fields["denominacion"]);


if ($denominacion == ""){
$leyenda = "No existe ese Cliente de la Proveeduria";
include ("../../../alertas/campo_vacio.php");
exit;
}


$domicilio=$result->fields["domicilio"];
$puerta=$result->fields["puerta"];
$localidad=$result->fields["localidad"];
$direccion = $domicilio." ".$puerta." - ".$localidad;
$cuit=$result->fields["cuit"];


$sql7="select * from condiciones_clientes where cuenta like '$nro_cliente'";
$result7 = $db->Execute($sql7);
$plan=strtoupper($result7->fields["plan"]);
$tipo_fact=strtoupper($result7->fields["iva"]);  // letras
$tipo_iva=strtoupper($result7->fields["iva"]); // numero
$iva =$result7->fields["iva"];


if ($tipo_iva == ""){
$leyenda = "DATOS INCOMPLETOS EN LEGAJO POR FAVOR COMUNIQUESE CON SECRETARIA";
include ("../../../alertas/campo_vacio.php");
exit;
}

if ($tipo_iva == "0"){
$leyenda = "DATOS INCOMPLETOS EN LEGAJO POR FAVOR COMUNIQUESE CON SECRETARIA";
include ("../../../alertas/campo_vacio.php");
exit;
}

switch ($tipo_iva){
	case "1":{
$tipo_fact = "Responsable Inscripto";
$fact = "A";
		break;
	}

	case "4":{
$tipo_fact = "Exento";
$fact = "B";
		break;
	}

		case "3":{
$tipo_fact = "Monotributo";
$fact = "B";
		break;
	}

		case "5":{
$tipo_fact = "Consumidor Final";
$fact = "B";
$leyenda = "Irregular situación AFIP";
include ("../../../alertas/campo_vacio.php");
exit;
		break;
	}

	case "2":{
$tipo_fact = "RNI";
$fact = "B";
$leyenda = "NO EXISTE ESA CATEGORIA EN AFIP, REGULARICE SU SITUACION";
include ("../../../alertas/campo_vacio.php");
exit;
		break;
	}


}

$todo1= $denominacion;
$todo = $denominacion." (".$nro_cliente.")";
$band = "cliente";
}
elseif ($matricula!=""){ 
 include("../../../conexiones/config.inc.php");
$sql="select * from datos_laboratorio where nro_laboratorio like '$matricula'";
$result=$db->Execute($sql);

$nombre_laboratorio=strtoupper($result->fields["nombre_laboratorio"]);

if ($nombre_laboratorio == ""){
$leyenda = "No existe ese Laboratorio en la base de datos de ABM";
include ("../../../alertas/campo_vacio.php");
exit;
}

$matricula1=$result->fields["nro_laboratorio"];
$domicilio=$result->fields["domicilio"];
$nro_domicilio=$result->fields["nro_domicilio"];
$departamento=$result->fields["departamento"];


$direccion = $domicilio." ".$nro_domicilio." - ".$departamento;



$sql1="select * from datos_personales where matricula like '$matricula1'";
$result1 = $db->Execute($sql1);

$nombre=strtoupper($result1->fields["nombre"]);
$apellido=strtoupper($result1->fields["apellido"]);

$sql2="select * from afip where nro_laboratorio like '$matricula1'";
$result2 = $db->Execute($sql2);
$cuit=strtoupper($result2->fields["nro_afip"]);
$tipo_fact=strtoupper($result2->fields["sit_iva"]); //letras
$tipo_iva=strtoupper($result2->fields["sit_iva"]); //numero


if ($tipo_iva == ""){
$leyenda = "DATOS INCOMPLETOS EN LEGAJO POR FAVOR COMUNIQUESE CON SECRETARIA";
include ("../../../alertas/campo_vacio.php");
exit;
}

if ($tipo_iva == "0"){
$leyenda = "DATOS INCOMPLETOS EN LEGAJO POR FAVOR COMUNIQUESE CON SECRETARIA";
include ("../../../alertas/campo_vacio.php");
exit;
}

 include("../../../conexiones/config_pro.php");
$sql7="select * from condiciones_socios where cuenta like '$matricula1'";
$result7 = $db->Execute($sql7);
$plan=strtoupper($result7->fields["plan"]);


switch ($tipo_iva){
	case "RESPONSABLE INSCRIPTO":{
$tipo_fact = "1";
$fact = "A";
$tipo_iva = 1;
		break;
	}

		case "1":{
$tipo_fact = "1";
$fact = "A";
$tipo_iva = 1;
		break;
	}



	case "EXENTO":{
$tipo_fact = "4";
$fact = "B";
$tipo_iva = 4;
		break;
	}

		case "4":{
$tipo_fact = "4";
$fact = "B";
$tipo_iva = 4;
		break;
	}


		case "MONOTRIBUTISTA":{
$tipo_fact = "3";
$tipo_iva = 3;
$fact = "B";
		break;
	}

		case "3":{
$tipo_fact = "3";
$tipo_iva = 3;
$fact = "B";
		break;
	}


			case "CONS. FINAL":{
$tipo_fact = "5";
$fact = "B";
$tipo_iva = 5;
$leyenda = "Irregular situación AFIP";
include ("../../../alertas/campo_vacio.php");
EXIT;
		break;
	}

	
			case "5":{
$tipo_fact = "5";
$fact = "B";
$tipo_iva = 5;
$leyenda = "Irregular situación AFIP";
include ("../../../alertas/campo_vacio.php");
EXIT;
		break;
	}


}

$todo1 = $nombre_laboratorio;
$todo="Lab. ".$nombre_laboratorio." (".$matricula1.")";
$band = "cuenta";
}

if ($fact == ""){
	$fact = "B";
}

 $sql="select * from ventas_encabezado_pc2 where tipo_fact = '$fact' GROUP BY nro_factura ORDER BY nro_factura DESC";
$result = $db->Execute($sql);

 $nro_factura_anterior = $result->fields["nro_factura"];

 if ($nro_factura_anterior == ""){
	 $nro_factura_anterior= "No Existen Facturas en el Sistema";
$nro_factura= 1;

 }else{
 $nro_factura=($result->fields["nro_factura"] + 1);
 }




if ($plan == 0){
$plan = 1;
}
include("../../../conexiones/config_pro.php");

$sql = "INSERT INTO `ventas1_encab_temp_pc2` ( `tipo_fact` , `nro_factura` , `cod_operacion` , `tipo` , `nro_cliente` , `nro_cuenta` , `plan` , `operador` , `denominacion` , `fecha` , `forma_pago` , `porc_dto`) VALUES ( '$fact'  , '$nro_factura' , '$cod_operacion' , '$tipo_iva' , '$nro_cliente' , '$matricula1' , '$plan' , '$operador' , '$todo1' , '$fecha' , '$forma_pago' , '$porc_dto' )";
mysql_query($sql);


?>

<script>

function abrirVentana() {
	var cod_detalle = <?echo $cod_detalle;?> 
    open("factura_papel.php?cod_detalle=<?print($cod_detalle);?>&&nro_factura=<?print($nro_factura);?>&&nro_cliente=<?print($nro_cliente);?>&&matriculae=<?print($matricula);?>&&forma_pago=<?print($forma_pago);?>&&dia=<?print($dia);?>&&mes=<?print($mes);?>&&anio=<?print($anio);?>&&todo=<?print($todo);?>&&direccion=<?print($direccion);?>&&cuit=<?print($cuit);?>&&tipo_fact=<?print($tipo_fact);?>","MERCADERIA", "width=1000,height=1000,toolbar=no,directories=no,menubar=no,status=no");
} 
</script>

<body onload = "on_load ()">
<FORM name="form" ACTION="<?php echo $_SERVER["PHP_SELF"];?>" METHOD = "POST">
<?include("../../../conexiones/config_pro.php");
$sql8 = "SELECT * FROM `ventas1_encab_temp` where nro_factura = $nro_factura";
$result8 = $db->Execute($sql8);
$plan=strtoupper($result8->fields["plan"]);?>
<table width="103%" border="0">
          <!--DWLayoutTable-->
          <tr bgcolor="#000099">
            <td height="31" colspan="5" bordercolor="#000000" class="Estilo67"><div align="left"><span class="Estilo26"><span class="Estilo70"><span class="Estilo4 Estilo6  Estilo16 Estilo70"><span class="Estilo4 Estilo16  Estilo6"><span class="Estilo71"><span class="Estilo72">LAB: <?echo $todo;?>&nbsp;&nbsp;&nbsp;              &nbsp;&nbsp;&nbsp;&nbsp;</span></span></span></span></span>  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span class="Estilo72"> N&ordm; FACTURA:</span> <span class="Estilo72"><?echo $fact;?> - <?echo $nro_factura;?> &nbsp;&nbsp;&nbsp;</span><span class="Estilo26">&nbsp;&nbsp;&nbsp;&nbsp;</span><span class="Estilo72">FECHA: <?echo $dia;?> / <?echo $mes;?> / <?echo $anio?></span><span class="Estilo26"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><span class="Estilo72">&nbsp;&nbsp;</span></span></span>Op:</span> <span class="Estilo72"><?echo $operador;?></strong> <span class="Estilo26">&nbsp;&nbsp;&nbsp;&nbsp;</span><span class="Estilo4 Estilo6 Estilo16"><span class="Estilo21"><span class="Estilo22"><span class="Estilo26">  </span></span></span></span></span></div>              </td>
          </tr>
          <tr bgcolor="#000099">
            <td height="31" colspan="5" bordercolor="#000000" class="Estilo67"><span class="Estilo26"><span class="Estilo70"><span class="Estilo4 Estilo6  Estilo16 Estilo70"><span class="Estilo4 Estilo16  Estilo6"><span class="Estilo71"><span class="Estilo72">TIPO IVA: <?echo strtoupper($tipo_fact);?> &nbsp;&nbsp;&nbsp;&nbsp; FORMA DE PAGO: <?echo strtoupper($forma_pago);?>
                          <!-- <select name="forma_pago[]" class="Estilo21" id="select2"  onkeypress="return verif_caracter(this,event)">
                            <optgroup label="Selección">
                            <option value selected= "<?"$forma_pago";?>"> <?print("$forma_pago");?></option>
                            </optgroup>
                            <optgroup label="Cambiar por:">
                            <option value = "CONTADO"><strong>CONTADO</strong></option>
                            <option value = "CTA/CTE"><strong>CTA/CTE</strong></option>
                            </optgroup>
                          </select> -->

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;PLAN: <?echo strtoupper($plan);?>

<?/*include ("../../../conexiones/config_pro.php");
$sql = "SELECT * FROM `tasas_planes` where cod_plan < 90 order by cod_plan";
$result = $db->Execute($sql);

echo "<select name=plan[] size=1 id =plan class='Estilo21' onKeyPress='return verif_caracter(this,event)' disabled>";*/

?>
<!-- <option value selected= "<?"$plan";?>"> <?print("$plan");?></option>
<optgroup label="Elegir:"> -->
<?
/*
if (!$result) die("fallo".$db->ErrorMsg());
while (!$result->EOF) {
$cuenta=$result->fields["cuenta"];
$a1=strtoupper($result->fields["cod_plan"]);

echo"<option value=$a1>$a1</option>";
$result->MoveNext();
	}*/
?>
<?
//echo"</select>";
?>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Descuento: <?echo $porc_dto;?> % <span class="Estilo4 Estilo6 Estilo16"><span class="Estilo21"><span class="Estilo22">
<!-- <input name="porc_dto2" type="text" class="Estilo22" id="porc_dto2" value="<?echo $porc_dto;?>" size = "5"> -->
</span></span></span></span></span></span></span></span></span></td>
          </tr>
          <tr bgcolor="#C4D7E6">
            <td height="26" colspan="5" bgcolor="#E8DCFC"><div align="left"><span class="Estilo4 Estilo6 Estilo16"><span class="Estilo21"><span class="Estilo22"><span class="Estilo26"> PRODUCTO: 
                      </span></span></span></span><span class="Estilo4 Estilo6 Estilo16"><span class="Estilo21"><span class="Estilo22"></span></span></span>
              <input name="cod_mercaderia" type="text" class="Estilo22" id="cod_mercaderia" onKeyPress="return verif_caracter(this,event)" value="<?php if (isset($_REQUEST['cod_merca']))   echo $_REQUEST['cod_merca'];?>" size = "5">
                      <span class="Estilo4 Estilo6 Estilo16"><span class="Estilo21"><span class="Estilo22"><span class="Estilo26">
                      CANTIDAD </span></span></span></span><span class="Estilo4 Estilo6 Estilo16"><span class="Estilo21"><span class="Estilo22"><span class="Estilo26">
                      <input name="cantidad" type="text" class="Estilo22" id="cantidad" size = "5">
                      </span></span></span></span><span class="Estilo4 Estilo6 Estilo16"><span class="Estilo21"><span class="Estilo22"><span class="Estilo26">
                      <input name="Alta" type="submit" value= "OK" id = "Alta">
                      </span></span></span></span> <strong><span class="Estilo44"><span class="Estilo43"><? $cod_merquita; ?></span></span></strong><strong><span class="Estilo44"><span class="Estilo43"><?  $producto; ?> <? $cantidad_existente;?><span class="Estilo62"><strong><span class="Estilo4 Estilo6 Estilo16"><span class="Estilo21"><span class="Estilo22"><span class="Estilo26">
					  
					                      <input name="matricula" type="hidden" value ="<?echo $matricula;?>">
                      <input name="nro_cliente" type="hidden" value ="<?echo $nro_cliente;?>">
                      <input name="dia" type="hidden" value ="<?echo $dia;?>">
                      <input name="mes" type="hidden" value ="<?echo $mes;?>">
                      <input name="anio" type="hidden" value ="<?echo $anio;?>">
                      <input name="nro_factura" type="hidden" value ="<?echo $nro_factura;?>">
                      <input name="tipo_iva" type="hidden" value ="<?echo $tipo_iva;?>">
                      <input name="producto" type="hidden" value ="<?echo $producto;?>">
                      <input name="denominacion" type="hidden" value ="<?echo $denominacion;?>">
                      <input name="operador" type="hidden" value ="<?echo $operador;?>">
					  <input name="porc_dto" type="hidden" value ="<?echo $porc_dto;?>">
					   <input name="bandera_tipo" type="hidden" value ="<?echo $bandera_tipo;?>">
                      <input name="pasada" type="hidden" value ="1">


                      <span class="Estilo4 Estilo6 Estilo16"><span class="Estilo21"><span class="Estilo22">
                      <input name="Alta" type="image" value= "BUSCAR" src="../../../imagenes/botones/btn_buscar.gif" id = "Alta7">                       </span></span></span>
                      
					  
                     &nbsp;&nbsp;&nbsp;&nbsp; Habilitar Lote Vencido
            <input name="hab_lote" type="radio" value="SI">
SI
<input name="hab_lote" type="radio" value="NO" checked>
NO &nbsp;
<input name="Alta" type="image" value= "VENCIDOS" src="../../../imagenes/office/464.ico" id = "Alta8"> Vencidos
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><a href="control_nro_factura.php?&&nro_factura=<?print("$nro_factura");?>&&fact=<?print("$fact");?>&&tipo_fact=<?print("$tipo_fact");?>&&direccion=<?print("$direccion");?>&&cuit=<?print("$cuit");?>"><img src="../../../imagenes/office/1049.ico" alt="Confirmar" border = "0"> CONFIRMAR VENTA</a><span class="Estilo26"></span></div></td>
    </tr>

<?
		


		

		if(isset($_REQUEST['Alta'])) {
	
	switch ($_REQUEST['Alta'])
	{
		case "OK":
				{

?>
       
	  
	 <tr>
       <th height="20" colspan="5" valign="top" scope="row"><div align="left">
	   <?
$bandera_tipo= $_REQUEST['bandera_tipo'];

	 
$tipo_fact = $_REQUEST['fact'];
$porc_dto= $_REQUEST['porc_dto'];
	
	 include ("refrescar.php");
	
	 ?>

       </div></th>

  </tr>
  <?
			break;
				}


		case "BUSCAR":
				{

			$busca = "SI";
$no_hacer_nada="OK";
?>
 
 <tr>
    <th height="21" colspan="5" valign="top" scope="row"><div align="left"> <?include ("refrescar1.php");?>
    </div></th>
    </tr>
 <tr>
   <td width="7%" height="3"></td>
   <td width="52%"></td>
   <td width="18%"></td>
   <td width="23%" colspan="2"></td>
 </tr>



  <?
			break;
				}

	case "VENCIDOS":{

			$busca = "SI";
$no_hacer_nada="OK";
?>
 
 <tr>
    <th height="21" colspan="5" valign="top" scope="row"><div align="left"> <?include ("refrescar_vencido.php");?>
    </div></th>
    </tr>
 <tr>
   <td height="3"></td>
   <td width="52%"></td>
   <td></td>
   <td colspan="2"></td>
 </tr>



  <?
			break;
				}



	}
 }
?>
  </table>
</form>

