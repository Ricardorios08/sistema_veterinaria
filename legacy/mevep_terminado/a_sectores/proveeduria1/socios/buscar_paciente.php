<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>LISTADO DE PACIENTES</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

<link href="../../css/fondo.css" rel="stylesheet" type="text/css" />


<style type="text/css">
<!--
body,td,th {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
	color: #000000;
}
.Estilo2 {
	font-size: 12px;
	font-family: Arial, Helvetica, sans-serif;
}
.Estilo25 {color: #FFFFFF}
.Estilo26 {font-size: 10px; color: #FFFFFF; }
.Estilo27 {color: #FFFFFF; font-family: "Trebuchet MS"; }
.Estilo28 {font-family: "Trebuchet MS"}
.Estilo29 {font-size: 10px; color: #FFFFFF; font-family: "Trebuchet MS"; }
.Estilo31 {
	font-family: "Trebuchet MS";
	font-size: 24px;
	font-weight: bold;
}
.Estilo32 {font-size: 24px}
.Estilo40 {font-family: "Trebuchet MS"; font-size: 14px; font-weight: bold; }
-->
</style>



</head>









<?php 


 function CalculaEdad( $fecha ) {
    list($Y,$m,$d) = explode("-",$fecha);
    return( date("md") < $m.$d ? date("Y")-$Y-1 : date("Y")-$Y );
}

include("../../conexiones/config.inc.php");

if ($bande_nuevo != 1){
  $palabra = $_REQUEST['palabra'];
 $usuario = $_REQUEST['usuario'];

}

$band = 1;

$usuario;


   

list($ape,$nom) = explode("+",$palabra);

     $ape; // Imprime 12
     $nom; // Imprime 01
  





$sql="select * from datos_orden where id = $usuario";
$result = $db->Execute($sql);

$orden=strtoupper($result->fields["orden"]);

if ($palabra == ""){
 
include ("seleccionar_planilla.php");
exit;

}else
{
if (is_numeric($palabra) == false){

if (($ape != "") and ($nom != "")){
 $sql="select * from pacientes where  nombre like '$nom%' and  apellido like '$ape' order by nombre";
}elseif (($ape != "") and ($nom == "")){
$sql="select * from pacientes where  apellido like '$ape' order by nombre";
}elseif (($ape == "") and ($nom != "")){
$sql="select * from pacientes where  nombre like '%$nom%' order by nombre";
}

}else
{

$sql="select * from pacientes where nro_paciente like '$palabra'  or nro_documento like '%$palabra%' or  nro_afiliado like '%$palabra%'  order by nombre limit 1";
}
}
	
$result = $db->Execute($sql);

 if (!$result) die("fallo".$db->ErrorMsg());
  while (!$result->EOF) {

	
 $nro_paciente=$result->fields["nro_paciente"];
 $nombre=strtoupper($result->fields["nombre"]);
  $apellido=strtoupper($result->fields["apellido"]);

 $nro_os=$result->fields["nro_os"];
 $nro_documento=$result->fields["nro_documento"];

 $fecha_nacimiento=$result->fields["fecha_nacimiento"];





	  

IF ($fecha_nacimiento == "0000-00-00"){
$edad = "SIN CARGAR";
}ELSE{
$edad = calculaEdad($fecha_nacimiento);
}

$sql1="select * from datos_os where nro_os = '$nro_os'";
$result1 = $db->Execute($sql1);
$sigla=strtoupper($result1->fields["sigla"]);






?>
  <table width="800" border="0" cellspacing="0">
  <tr bgcolor="#CECECE">
    <td colspan="3"><div align="center"><img src="../../imagenes/titulo_personal.jpg"></div></td>
  </tr>
  <tr>
    <td colspan="2"><div align="center"></div></td>
    <td width="424" rowspan="6">     
     <a href="../grabacion/grabar_nuevo/grabacion_ordenes.php?nro_paciente=<?php print("$nro_paciente");?>&&nro_os=<?php print("$nro_os");?>&&usuario=<?php print("$usuario");?>" class="Estilo2"><img src="../../imagenes/bt_orden1.png" alt="INGRESAR NUEVA ORDEN MEDICA" border = "0"></a><a href="modificar.php?nro_paciente=<?php print("$nro_paciente");?>&&usuario=<?php print("$usuario");?>" target = "central"><img src="../../imagenes/bt_modificar.png" alt="Modificar" border = "0"></a><a href="borra_todo.php?nro_paciente=<?php print("$nro_paciente");?>" onClick="return confirm('&iquest;Est&aacute; seguro de Borrar el paciente con toda su historia Clinica?');"><img src="../../imagenes/bt_borrar.png" alt="Borrar" border = "0"></a><a href="ficha.php?nro_paciente=<?php print("$nro_paciente");?>&&usuario=<?php print("$usuario");?>"><img src="../../imagenes/bt_ficha.png" alt="Ficha" border = "0"></a></td>
  </tr>
  <tr>
    <td width="97" valign="middle"><div align="right"><a href="../grabacion/grabar_nuevo\grabacion_ordenes.php?nro_paciente=<?php print("$nro_paciente");?>&&nro_os=<?php print("$nro_os");?>&&usuario=<?php print("$usuario");?>"> </a>NOMBRE</div></td>
    <td width="273" colspan="-2" valign="middle"><span class="Estilo40"><?php echo $apellido;?> <?php echo $nombre;?> (<?php echo $nro_paciente;?>)</span></td>
  </tr>
 <tr>
   <td><div align="center">
     <div align="right">DOCUMENTO: </div></td>
   <td colspan="-2"><span class="Estilo40"><?php echo $nro_documento;?></span></td>
 </tr>
 <tr>
   <td><div align="right">EDAD: </div></td>
   <td colspan="-2"><span class="Estilo40"><?php echo $edad;?></span></td>
 </tr>
 <tr>
   <td><div align="right">OBRA SOCIAL</span>: </div></td>
   <td colspan="-2"><span class="Estilo40">(<?php echo $nro_os;?>)<?php echo $sigla;?></span></td>
 </tr>
 <tr>
   <td colspan="2"><div align="center"></div></td>
  </tr>
</table>


<?php IF ($orden == "SI"){


 $ordenes = "ordenes";
$detalle = "detalle";

 $sql3="select * from $ordenes where nro_paciente = $nro_paciente order by fecha_grabacion";
$result3 = $db->Execute($sql3);


 if (!$result3) die("fallo".$db->ErrorMsg());
  while (!$result3->EOF) {


$diagnostico=strtoupper($result3->fields["diagnostico"]);
$motivo=strtoupper($result3->fields["motivo"]);
$observaciones=strtoupper($result3->fields["observaciones"]);

if ($no_mostrar == ""){
if (($diagnostico != "") or ($motivo != "") or ($observaciones != "")){
	$no_mostrar = 1;
?><table width="800" border="0" cellspacing="0">

<tr bgcolor="#CECECE">
   <td colspan="6"><div align="center"><img src="../../imagenes/clinica.jpg" ></div></td>
  </tr>
 <tr bgcolor="#CECECE">
   <td colspan="2" valign="top" bgcolor="#666666"><div align="center" class="Estilo27">
     <div align="center">Fecha</div>
   </div></td>
   <td colspan="3" valign="top" bgcolor="#666666"><div align="center" class="Estilo28"><span class="Estilo25">Diagn&oacute;stico</span></div></td>
   <td valign="top" bgcolor="#666666"><div align="center" class="Estilo27">
     <div align="center">Observaciones</div>
   </div></td>
 </tr><?php 

}}




$fecha_grabacion=strtoupper($result3->fields["fecha_grabacion"]);

$dia = substr($fecha_grabacion,8,2);
$mes= substr($fecha_grabacion,5,2);
$anio = substr($fecha_grabacion,0,4);
$fecha_grabacion = $dia."-".$mes."-".$anio;



if (($diagnostico != "") or ($motivo != "") or ($observaciones != "")){
?>
  <tr>
   <td colspan="2" valign="top" bgcolor="#E0EDF3"><?php echo $fecha_grabacion;?></td>
   <td colspan="3" valign="top" bgcolor="#E0EDF3"><?php echo $diagnostico;?></td>
   <td valign="top" bgcolor="#E0EDF3"><?php echo $observaciones;?></td>
 </tr>
 

<?php 

}


$result3->MoveNext();
		}


?></table><?php
}


$ordenes = "ordenes";
$detalle = "detalle";

  $sql2="select * from $ordenes where nro_paciente = $nro_paciente order by cod_grabacion, fecha_grabacion";
$result2 = $db->Execute($sql2);

 if (!$result2) die("fallo".$db->ErrorMsg());
  while (!$result2->EOF) {

$nro_os=strtoupper($result2->fields["nro_os"]);
$nro_paciente=strtoupper($result2->fields["nro_paciente"]);
$periodo=strtoupper($result2->fields["periodo"]);
$marca=strtoupper($result2->fields["marca"]);
$lote=strtoupper($result2->fields["lote"]);
$cod_operacion=strtoupper($result2->fields["cod_operacion"]);
$modulo=strtoupper($result2->fields["modulo"]);



$año=strtoupper($result2->fields["ano"]);
$nro_afiliado=$result2->fields["nro_afiliado"];
$nro_orden=$result2->fields["nro_orden"];
$autorizacion=strtoupper($result2->fields["autorizacion"]);
$operador=strtoupper($result2->fields["operador"]);


$cod_grabacion=strtoupper($result2->fields["cod_grabacion"]);

$fecha_grabacion=strtoupper($result2->fields["fecha_grabacion"]);

$dia = substr($fecha_grabacion,8,2);
$mes= substr($fecha_grabacion,5,2);
$anio = substr($fecha_grabacion,0,4);
$fecha_grabacion = $dia."-".$mes."-".$anio;


$fecha=strtoupper($result2->fields["fecha"]);


$dia = substr($fecha,8,2);
$mes= substr($fecha,5,2);
$anio = substr($fecha,0,4);
$fecha = $dia."-".$mes."-".$anio;



$matricula=strtoupper($result2->fields["matricula"]);
$prescriptor=strtoupper($result2->fields["medico"]);
$confirmada=strtoupper($result2->fields["confirmada"]);


/*
require_once("../../nusoap/lib/nusoap.php");
$wsdl='http://coprofi.com.ar/sulb/nusoap/lib/servicio.php?wsdl';
$client=new nusoap_client($wsdl, 'wsdl');  
$param1=array('cod_grabacion'=>$cod_grabacion); 
 $response= $client->call('buscar_orden', $param1);

*/

 if ($response == $cod_grabacion){
$web = "WEB";
 }

if ($autorizacion == 0){
$autorizacion = "S/A";
}
 
 if ($band == 1){
 $band = 2;
 ?>
 




<table width="800" border="0" cellspacing="0">
  <!--DWLayoutTable-->

 <tr bgcolor="#CECECE">

   <td height="34" colspan="13" valign="top"><div align="center"><img src="../../imagenes/pedidos.jpg" ></div></td>
  </tr>
 <tr >
    <td width="41" bgcolor="#666666"><div align="center" class="Estilo27">
      <div align="center">ABM</div>
    </div></td>
    <td width="41" bgcolor="#666666"><div align="center" class="Estilo25">OS</div></td>
    <td width="42" bgcolor="#666666"><span class="Estilo25">Protocolo</span></td>
    <td width="59" bgcolor="#666666"><div align="center" class="Estilo27"> 
      <div align="center">Solicitada</div>
    </div></td>
    <td width="95" bgcolor="#666666"><div align="center" class="Estilo27"> 
      <div align="center">Análisis</div>
    </div></td>
    <td width="258" bgcolor="#666666"><div align="center" class="Estilo27">
      <div align="center">Pr&aacute;cticas Solicitadas </div>
    </div>      <div align="center" class="Estilo27"></div></td>
    <td width="65" bgcolor="#666666"><div align="center"><span class="Estilo26">COMPLETAR</span></div></td>
    <td width="54" bgcolor="#666666"><div align="center" class="Estilo28"><span class="Estilo26">DERIVAR</span></div></td>
    <td width="37" bgcolor="#666666"><div align="center" class="Estilo28"><span class="Estilo26">BORRAR</span></div></td>
    <td width="40" bgcolor="#666666"><div align="center" class="Estilo29">
      <div align="center">INFORME</div>
    </div></td>
    <td width="42" bgcolor="#666666"><div align="center"><span class="Estilo26">RECIBO</span></div></td>
	<td width="24" bgcolor="#666666"><div align="center"><span class="Estilo26">PLA</span></div></td>
    <td width="23" bgcolor="#666666"><div align="center"><span class="Estilo26">AUT</span></div></td>
 </tr>
  <?php }?>
 <tr bordercolor="#E0EDF3" bgcolor="#E0EDF3" style="cursor:hand" onMouseOver="this.style.background='#E1E1E1'; this.style.color='blue'" onMouseOut="this.style.background='#E0EDF3'; this.style.color='black'">
    <td bgcolor="#E0EDF3"><div align="center"><?php echo $autorizacion;?></div></td>
    <td bgcolor="#E0EDF3"><div align="center"><?php echo $nro_os;?></div></td>
    <td bgcolor="#E0EDF3"><div align="center"><?php echo $cod_grabacion;?> <?php echo $web;?></div></td>
    <td bgcolor="#E0EDF3"><div align="center"><?php echo $fecha_grabacion;?></div></td>
    <td bgcolor="#E0EDF3"><div align="center"><?php echo $fecha;?></div></td>
    <td bgcolor="#E0EDF3"><?php include ("practicas.php");?>
      <div align="center"><font size="1" face="Arial, Helvetica, sans-serif"></font></div></td>
    
	<td bgcolor="#E0EDF3"><div align="center"><font size="1" face="Arial, Helvetica, sans-serif"><a href="emision_mod.php?nro_paciente=<?php print("$nro_paciente");?>&&cod_grabacion=<?php print("$cod_grabacion");?>&&fecha_grabacion=<?php print("$fecha_grabacion");?>&&usuario=<?php print("$usuario");?>"><img src="../../imagenes/office//011.ico" alt="Ficha" border = "0"></a></font></div></td>
	<td bgcolor="#E0EDF3"><div align="center"><font size="1" face="Arial, Helvetica, sans-serif"><a href="practicas_imp.php?nro_paciente=<?php print("$nro_paciente");?>&&cod_grabacion=<?php print("$cod_grabacion");?>&&fecha_grabacion=<?php print("$fecha_grabacion");?>&&usuario=<?php print("$usuario");?>"><img src="../../imagenes/office//011.ico" alt="Ficha" border = "0"></a></font></div></td>



    <td bgcolor="#E0EDF3"><div align="center"><font size="1" face="Arial, Helvetica, sans-serif"><a href="borra_orden.php?cod_grabacion=<?php print("$cod_grabacion");?>&&usuario=<?php print("$usuario");?>&&nro_paciente=<?php print("$nro_paciente");?>" onclick="return confirm('¿Está seguro de Borrar la orden y sus RESULTADOS?');"><IMG SRC="../../imagenes/office//1047.ico" alt="Borrar" border = "0"></a></font></div></td>
    
	<td bgcolor="#E0EDF3"><div align="center"><font size="1" face="Arial, Helvetica, sans-serif"><a href="modelos/elegir_modelos.php?nro_paciente=<?php print("$nro_paciente");?>&&cod_grabacion=<?php print("$cod_grabacion");?>&&fecha_grabacion=<?php print("$fecha_grabacion");?>&&modulo=<?php print("$modulo");?>&&usuario=<?php print("$usuario");?>"><img src="../../imagenes/office//005.ico" alt="Informe" border = "0"></a></font></div></td>
    <td bgcolor="#E0EDF3"><div align="center"><font size="1" face="Arial, Helvetica, sans-serif"><a href="comprobante/comprobante.php?nro_paciente=<?php print("$nro_paciente");?>&&cod_grabacion=<?php print("$cod_grabacion");?>&&fecha_grabacion=<?php print("$fecha_grabacion");?>&&usuario=<?php print("$usuario");?>"><img src="../../imagenes/office//457.ico" alt="Informe" border = "0"></a></font></div></td>
	<td bgcolor="#E0EDF3"><div align="center"><font size="1" face="Arial, Helvetica, sans-serif"><a href="modelos_completar/elegir_modelos.php?nro_paciente=<?php print("$nro_paciente");?>&&cod_grabacion=<?php print("$cod_grabacion");?>&&fecha_grabacion=<?php print("$fecha_grabacion");?>&&modulo=<?php print("$modulo");?>&&usuario=<?php print("$usuario");?>"><img src="../../imagenes/office//789.ico" alt="Informe" border = "0"></a></font></div></td>
    <td bgcolor="#E0EDF3"><font size="1" face="Arial, Helvetica, sans-serif"><a href="autorizar.php?nro_paciente=<?php print("$nro_paciente");?>&&cod_grabacion=<?php print("$cod_grabacion");?>&&fecha_grabacion=<?php print("$fecha_grabacion");?>&&modulo=<?php print("$modulo");?>&&usuario=<?php print("$usuario");?>"><img src="../../imagenes/office//951.ico" alt="Informe" border = "0"></a></font></td>
 </tr>
<?php 


$result2->MoveNext();
		}

?></table>
<?php 

	$band = 1;
$result->MoveNext();
		}

		if (($nombre == "") and ($apellido == "")){?>
		
<table width="800">
  <tr>
<td height="8" colspan="12"><div align="center" class="Estilo31">NO EXISTE PACIENTE CON ESAS CARACTERISTICAS</div>  <div align="center" class="Estilo32"><span class="Estilo28"><a href="entrada_dato.php?nombre=<?php print("$palabra");?>" class="Estilo28">INGRESAR NUEVO PACIENTE</a></span></div></td>
</tr>
</table>
<?php }else{?>
  <tr>
    <td colspan="12"></td>
  </tr>
  <tr>
    <td colspan="12"><!--DWLayoutEmptyCell-->&nbsp;</td>
  </tr>
  <tr>
    <td colspan="12"></td>
  </tr>
  <tr>
    <td height="2"></td>
    <td width="21"></td>
    <td width="64"></td>
    <td></td>
    <td width="83"></td>
    <td width="1"></td>
    <td width="19"></td>
    <td width="58"></td>
    <td width="276"></td>
    <td></td>

    <td></td>
    <td></td>
  </tr>
<?php }?>
</table>

</body>
</html>
