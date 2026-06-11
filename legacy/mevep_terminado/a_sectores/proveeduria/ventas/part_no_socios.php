<script language="javascript">
function on_load()
{
document.getElementById("denominacion").focus();
document.getElementById("denominacion").style.backgroundColor = "#CCFFCC";
}

function verif_caracter(obj,evt)
{

	evt = (evt) ? evt : event;
	var charCode = (evt.charCode) ? evt.charCode : ((evt.which) ? evt.which : evt.keyCode);
	if (charCode == 13) 

	{
		switch(obj.id)
		{
				

				case "denominacion":
				document.getElementById("domicilio").focus();
				document.getElementById("denominacion").style.backgroundColor = "#ffffff";
				document.getElementById("domicilio").style.backgroundColor = "#CCFFCC";
				break;

				case "domicilio":
				document.getElementById("puerta").focus();
				document.getElementById("domicilio").style.backgroundColor = "#ffffff";
				document.getElementById("puerta").style.backgroundColor = "#CCFFCC";
				break;
				case "puerta":
				document.getElementById("localidad").focus();
				document.getElementById("puerta").style.backgroundColor = "#ffffff";
				document.getElementById("localidad").style.backgroundColor = "#CCFFCC";
				break;
				
				case "localidad":
				document.getElementById("caracteristica_1").focus();
				document.getElementById("localidad").style.backgroundColor = "#ffffff";
				document.getElementById("caracteristica_1").style.backgroundColor = "#CCFFCC";
				break;

				case "caracteristica_1":
				document.getElementById("telefono_1").focus();			
				document.getElementById("caracteristica_1").style.backgroundColor = "#ffffff";
				document.getElementById("telefono_1").style.backgroundColor = "#CCFFCC";
				break;
				case "telefono_1":
				document.getElementById("caracteristica_3").focus();
				document.getElementById("telefono_1").style.backgroundColor = "#ffffff";
				document.getElementById("caracteristica_3").style.backgroundColor = "#CCFFCC";
				break;

				
				case "caracteristica_3":
				document.getElementById("telefono_3").focus();
				document.getElementById("caracteristica_3").style.backgroundColor = "#ffffff";
				document.getElementById("telefono_3").style.backgroundColor = "#CCFFCC";
				break;
				case "telefono_3":
				document.getElementById("email").focus();
				document.getElementById("telefono_3").style.backgroundColor = "#ffffff";
				document.getElementById("email").style.backgroundColor = "#CCFFCC";
				break;

				case "email":
				document.getElementById("cuit").focus();
				document.getElementById("email").style.backgroundColor = "#ffffff";
				document.getElementById("cuit").style.backgroundColor = "#CCFFCC";
				break;

				case "cuit":
				document.getElementById("iva").focus();
				document.getElementById("cuit").style.backgroundColor = "#ffffff";
				document.getElementById("iva").style.backgroundColor = "#CCFFCC";
				break;

				


				case "plan":
				document.getElementById("guardar").focus();
				document.getElementById("plan").style.backgroundColor = "#ffffff";
				break;
		}
		return false;
	}
	return true;
}


</script>


<?php

$hoy = date("d/m/Y");
include ("../../../conexiones/config.inc.php");

 $id=$_REQUEST["id"];
  $descuento=$_REQUEST["descuento"];

 ECHO"--".$guardar=$_REQUEST["guardar"];

if ($guardar == "FACTURAR NO SOCIOS-NO PARTICULARES"){

exit;
}
if ($guardar == "AGREGAR"){

  $producto=$_REQUEST["producto"];
    $precio=$_REQUEST["precio"];

if (($producto != "") and ($precio != "")){
 $sql = "INSERT INTO `ventas1_deta_temp` ( `nro_factura` , `cod_detalle` , `cod_mercaderia` , `descripcion` , `presentacion` , `lote` , `mes_lote` , `anio_lote` , `cantidad` , `precio_unitario` , `total` , `tipo_fact` , `iva_renglon`)  VALUES ('$id' , '' ,'$cod_merca' , '$producto', 'CREADO' , '$lote' , '$mes_lote' , '$anio_lote' , '1' , '$precio' , '$precio' , '' ,  '$tasa')";
mysql_query($sql);
}
else{

$leyenda = "NO INGRESO PRODUCTO O PRECIO NUEVO";
include ("../../../alertas/campo_informacion.php");
}

include ("mostrar_detalle.php");
EXIT;
}ELSE{



 
   $sql="select * from `ventas1_deta_temp` where nro_factura = '$id'  order by cod_mercaderia";
  $result = $db->Execute($sql);



?><body background="../imagenes/logito.png" onload = "on_load ()"> 




<FORM name="form" ACTION="guardar_factura.php" METHOD = "POST">
<table width="832" height="159" border="0" cellspacing="0">
  
  
  
  <tr bordercolor="#FFFFFF" bgcolor="#A0A7F5">
    <td height="14" colspan="4" bgcolor="#666666"><div align="center"><strong><font color="#FFFFFF" face="Arial, Helvetica, sans-serif">DATOS FACTURA </font></strong></div></td>
    <td height="14" colspan="2" bgcolor="#666666"><div align="center"><a href="../ventas/mostrar_detalle.php?id=<?php print("$id");?>"><font color="#FFFFFF" face="Trebuchet MS">Atras</font></a></div></td>
  </tr>
  <tr bordercolor="#FFFFFF" bgcolor="#A0A7F5">
 


    <td width="6%" height="14"><div align="center"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">CODIGO</font></div></td>
    <td width="40%"><div align="center"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">PRODUCTO</font> / <font color="#000000" size="2" face="Arial, Helvetica, sans-serif">DESCRIPCION</font></div></td>
    <td width="15%"><div align="center"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">DESCRIPCION</font></div></td>
    <td width="13%"><div align="center"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">CANTIDAD</font></div></td>
    <td width="8%"><div align="center"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">PARTICULAR.</font></div></td>
 
  <td width="9%"><div align="center"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">SOCIO</font></div></td> 
  </tr>
 
 
 <?php 

 
  if (!$result) die("fallo".$db->ErrorMsg());
  while (!$result->EOF) {

$cod_merc = $cod_mercaderia;
$cod_mercaderia=$result->fields["cod_mercaderia"];
$descripcion=strtoupper($result->fields["descripcion"]);
$presentacion=strtoupper($result->fields["presentacion"]);
$cantidad=strtoupper($result->fields["cantidad"]);
$precio_unitario=strtoupper($result->fields["precio_unitario"]);
$total2=strtoupper($result->fields["total"]);
$iva_renglon=strtoupper($result->fields["iva_renglon"]);
$cod_detalle=strtoupper($result->fields["cod_detalle"]);



 $sql1="select * from mercaderia where cod_merca = '$cod_mercaderia'";
 $result1 = $db->Execute($sql1);

$precio_actualizado=strtoupper($result1->fields["precio_actualizado"]);
$proveedor=strtoupper($result1->fields["proveedor"]);
$cod_tasa=strtoupper($result1->fields["cod_tasa"]);
  
  
    $sql2="select * from tasas where cod_tasa = $cod_tasa";
 $result2 = $db->Execute($sql2);

   $tasa_socio=$result2->fields["iva_normal"];
  $tasa_particulares=strtoupper($result2->fields["iva_recargo"]);



$sql2="select * from marca1 where cod_marca = $cod_marca";
$result2 = $db->Execute($sql2);
$marca=$result2->fields["marca"];

$sql2="select * from categoria where cod_categoria = $cod_categoria";
$result2 = $db->Execute($sql2);
$categoria=$result2->fields["categoria"];


$precio_particular = round(($precio_actualizado * $tasa_particulares)/100,2) + $precio_actualizado;
 $precio_socio =round(($precio_particular * $tasa_socio/100),2);

 $precio_socio1 = $precio_particular - $precio_socio;




$desc = $precio_particular * $descuento /100;
$precio_particular = $precio_particular - $desc;

$desc = $precio_socio1 * $descuento /100;
$precio_socio1 = $precio_socio1 - $desc;



/*
 $sql1="select sum(cantidad) as cantidad, sum(total) as total from `ventas1_deta_temp` where nro_factura = '$id' and cod_mercaderia = $cod_mercaderia";
 $result1 = $db->Execute($sql1);
$cantidad=strtoupper($result1->fields["cantidad"]);
$total=strtoupper($result1->fields["total"]);

$total_particular = ROUND($precio_particular * $cantidad,2);
$total_socio = ROUND($precio_socio1 * $cantidad,2);


$total_soc = $total_soc + $total_socio;
$total_par = $total_par + $total_particular;

*/

if ($presentacion == "CREADO"){
$precio_particular = $total2;
$precio_socio1 = $total2;
}

$total_soc = $total_soc + $precio_socio1;
$total_par = $total_par + $precio_particular;

?>
    <tr><td height="20" bgcolor="#9FE1BB"><div align="left"><font size="2" face="Arial, Helvetica, sans-serif"><?php print("$cod_mercaderia");?></font></div></td>
    <td bgcolor="#9FE1BB"><div align="left"><font size="2" face="Arial, Helvetica, sans-serif"><?php ECHO $descripcion;?></font>/   <font size="2" face="Arial, Helvetica, sans-serif"><?php ECHO $nombre;?></font></div></td>


    <td bgcolor="#9FE1BB"><div align="center"><font size="2" face="Arial, Helvetica, sans-serif"><?php ECHO $presentacion;?></font></div></td>
    <td bgcolor="#9FE1BB"><div align="center"><font size="2" face="Arial, Helvetica, sans-serif"><?php ECHO $cantidad;?></font></div></td>
    <td bgcolor="#9FE1BB"><div align="right"><font size="2" face="Arial, Helvetica, sans-serif"><?php ECHO $precio_particular;?></font></div></td>

   <td bordercolor="#E8DCFC" bgcolor="#9FE1BB"><div align="right"><font size="2" face="Arial, Helvetica, sans-serif"><?php echo $precio_socio1;?></font></div></td> 
   </tr>
    
   
    
<?PHP 


$cont = $cont + 1;

$result->MoveNext();
	}

?>
<tr>
  <td height="20" colspan="2" bgcolor="#CCCCCC">&nbsp;</td>
  <td height="20" bgcolor="#CCCCCC">&nbsp;</td>
  <td height="20" bgcolor="#CCCCCC">&nbsp;</td>
  <td height="20" bgcolor="#CCCCCC"><div align="right"><font color="#0000FF" size="3" face="Arial, Helvetica, sans-serif"><strong><?php echo number_format($total_par,2);?></strong></font></div></td>
  <td height="20" bgcolor="#CCCCCC"><div align="right"><font color="#0000FF" size="3" face="Arial, Helvetica, sans-serif"><strong><?php echo number_format($total_soc,2);?></strong></font></div></td>
  </tr>
<tr>
  <td height="20" colspan="2" bgcolor="#CCCCCC"><div align="right"><font color="#006600" size="4" face="Arial, Helvetica, sans-serif"><strong>DESCUENTO:</strong></font></div></td>
  <td height="20" bgcolor="#CCCCCC"><div align="center"><font color="#FFFFFF" size="4" face="Arial, Helvetica, sans-serif">
  </font><font color="#006600" size="4" face="Arial, Helvetica, sans-serif"><strong><?php echo $descuento;?></strong></font><font color="#FFFFFF" size="4" face="Arial, Helvetica, sans-serif">  </font><font color="#006600" size="4" face="Arial, Helvetica, sans-serif"><strong>%</strong></font></div></td>
  <td height="20" colspan="3" bgcolor="#CCCCCC">&nbsp;</td>
</tr>
<tr>
  <td height="20" colspan="2" bgcolor="#CCCCCC"><div align="center"><font color="#0000FF" size="5" face="Arial, Helvetica, sans-serif"><strong> PARTICULAR: $ <?php echo number_format($total_par,2);?></strong></font></div></td>
  <td height="20" bgcolor="#CCCCCC">&nbsp;</td>
  <td height="20" colspan="3" bgcolor="#CCCCCC"><div align="center"><font color="#0000FF" size="5" face="Arial, Helvetica, sans-serif"><strong> SOCIO: $ <?php echo number_format($total_soc,2);?></strong></font></div></td>
</tr>
</table>

<table width="830" border="0" cellspacing="0">
  <!--DWLayoutTable-->
  <tr align="center" bordercolor="#FFFFFF" bgcolor="#666666">
    <td align="center"><div align="right"><strong><font color="#FFFFFF" face="Arial, Helvetica, sans-serif">N&deg; SOCIO: </font><font size="2" face="Arial, Helvetica, sans-serif">
      </font></strong></div></td>
    <td colspan="2" align="center"><div align="left"><strong><font size="2" face="Arial, Helvetica, sans-serif">
        <input type="text" name="cod_socio" id="cod_socio" size="10" onKeyPress="return verif_caracter(this,event)">
    </font></strong></div></td>
    <td width="80" align="center" valign="top"><strong><font color="#FFFFFF" size="6" face="Arial, Helvetica, sans-serif">
      <input name="tipo_fact" type="radio" value="B">
B
</font></strong></td>
    <td width="268"><div align="left"><strong><font color="#FFFFFF" size="6" face="Arial, Helvetica, sans-serif">
        <input name="tipo_fact" type="radio" value="A">
  A <font size="2">CUIT</font></font><font size="2" face="Arial, Helvetica, sans-serif"><strong>
      <input type="text" size ="15" name="cuit_socio" id="cuit22" onKeyPress="return verif_caracter(this,event)">
    </strong></font></strong></div></td>
  </tr>
  <tr valign="top" bordercolor="#FFFFFF" bgcolor="#666666">
    <td><div align="right"><font size="2" face="Arial, Helvetica, sans-serif"><strong><font size="3" face="Arial, Helvetica, sans-serif"><strong><font color="#FFFFFF">PARTICULAR</font></strong></font><font color="#FFFFFF" size="3"></font><font color="#FFFFFF">: </font></strong> </font></div></td>
    <td colspan="2" valign="top"><font size="2" face="Arial, Helvetica, sans-serif">
      <input name="denominacion_particular" type="text" id="denominacion_particular" onKeyPress="return verif_caracter(this,event)" value="CONSUMIDOR FINAL"  size="50">
    </font></td>
    <td valign="top"><div align="center"><strong><font color="#FFFFFF" size="6" face="Arial, Helvetica, sans-serif">
      <input name="tipo_fact" type="radio" value="BB" checked>
      B
      </font></strong></div></td>
    <td valign="top"><strong><font color="#FFFFFF" size="6" face="Arial, Helvetica, sans-serif">
       <input name="tipo_fact" type="radio" value="AA">
A</font></strong></td>
  </tr>
  <tr bordercolor="#FFFFFF" bgcolor="#EEEEEE">
    <td width="129" bgcolor="#A0A7F5"><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Denominacion</font> </div></td>
    <td colspan="4" bgcolor="#9FE1BB"><font size="2" face="Arial, Helvetica, sans-serif">
      <input type="text" name="denominacion_particular_A" id="denominacion_particular_A"  size="50" onKeyPress="return verif_caracter(this,event)">
      (Raz&oacute;n social o Apellido y Nombre) </font></td>
  </tr>
  <tr bordercolor="#FFFFFF" bgcolor="#FFFFCC">
    <td bgcolor="#A0A7F5"><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Domicilio</font></div></td>
    <td colspan="4" bgcolor="#9FE1BB"><font size="2" face="Arial, Helvetica, sans-serif">
      <input type="text" name="domicilio_particular"  id="domicilio_particular"  size="80" onKeyPress="return verif_caracter(this,event)">
    </font></td>
  </tr>
  <tr bordercolor="#FFFFFF">
    <td bgcolor="#A0A7F5"><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">Localidad</font></div></td>
    <td colspan="4" bgcolor="#9FE1BB"><font size="2" face="Arial, Helvetica, sans-serif">
      <input type="text" name="localidad_particular"  id="localidad_particular"  size="50" onKeyPress="return verif_caracter(this,event)">
    </font></td>
  </tr>
  <tr bordercolor="#FFFFFF" bgcolor="#FFFFCC">
    <td bgcolor="#A0A7F5"><div align="right"><font color="#000000" size="2" face="Arial, Helvetica, sans-serif">CUIT</font><font size="2" face="Arial, Helvetica, sans-serif"><strong></strong></font></div></td>
    <td colspan="4" bgcolor="#9FE1BB"><font size="2" face="Arial, Helvetica, sans-serif"><strong>
     </strong></font><font size="2" face="Arial, Helvetica, sans-serif"><strong>
     <input type="text" size ="15" name="cuit_particular" id="cuit_particular" onKeyPress="return verif_caracter(this,event)"> SIN GUIONES EJ: 30281729811
        </strong></font></td>
  </tr>
  <tr bordercolor="#FFFFFF" bgcolor="#FFFFCC">
    <td colspan="5" bgcolor="#666666"><div align="center"><font size="2" face="Arial, Helvetica, sans-serif">
       <input type="hidden" name="id"   value="<?php echo $id;?>">

	    <input type="hidden" name="descuento"   value="<?php echo $descuento;?>">


	  <input type="Submit" name="guardar" id= "guardar" value="FACTURAR" target = "arriba">
    </font></div></td>
  </tr>
  <tr>
    <td></td>
    <td width="299"></td>
    <td width="74"></td>
    <td colspan="2"></td>
  </tr>
</table>

</form>

<?PHP } ?>