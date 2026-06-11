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
.Estilo30 {font-family: Arial, Helvetica, sans-serif; color: #FFFFFF; }
.Estilo67 {color: #FFFFFF; font-size: 12px; font-family: Arial, Helvetica, sans-serif;}
.Estilo69 {font-size: 12px}
.Estilo70 {color: #FFFFFF}
.Estilo71 {font-size: 10px}
.Estilo72 {font-size: 12px; color: #FFFFFF; }
.Estilo73 {font-family: Arial, Helvetica, sans-serif; font-size: 12px; }
-->

<!--
.Estilo76 {font-family: Arial, Helvetica, sans-serif}
-->



</style>
<table width="750" border="0">
  <tr bgcolor="#E6E6E6">
    <td scope="col">&nbsp;</td>
    <td scope="col"><div align="center">MERCADERIA VENCIDA </div></td>
    <td scope="col">&nbsp;</td>
    <td scope="col">&nbsp;</td>
    <td scope="col">&nbsp;</td>
  </tr>
  <tr bgcolor="#E6E6E6">
    <td width="12%" scope="col"><div align="center" class="Estilo1 Estilo39 Estilo42 Estilo45 Estilo16 Estilo60">Cod.</div></td>
    <td width="36%" scope="col"><div align="center" class="Estilo1 Estilo45 Estilo39 Estilo42 Estilo16 Estilo60">Descripcion</div></td>
    <td width="11%" scope="col"><div align="center"><span class="Estilo1 Estilo45 Estilo39 Estilo42 Estilo16 Estilo60">Lote</span></div></td>
    <td width="16%" scope="col"><div align="center"><span class="Estilo1 Estilo45 Estilo39 Estilo42 Estilo16 Estilo60">Vencimiento</span></div></td>
    <td width="25%" scope="col"><div align="center"><span class="Estilo1 Estilo45 Estilo39 Estilo42 Estilo16 Estilo60">Cantidad</span></div></td>
  </tr>

<?
	


$cod_mercaderia = $_REQUEST['cod_mercaderia'];
$matricula= $_REQUEST['matricula'];
$nro_cliente= $_REQUEST['nro_cliente'];
$operador= $_REQUEST['operador'];
$anio_actual = date("y");
$mes_actual = date("m");


$busca == "SI";

include("../../../../conexiones/config_pro.php");

if ($cod_mercaderia == ""){
$sql1 = "SELECT * FROM existencias  WHERE  (anio_lote < '$anio_actual' AND anio_lote <> '00' AND mes_lote <> '00') or (anio_lote < '$anio_actual' and mes_lote < '$mes_actual' AND anio_lote <> '00' AND mes_lote <> '00') order by anio_lote, mes_lote";
}
else
{
$sql1 = "SELECT * FROM existencias  WHERE  (`cod_mercaderia` = '$cod_mercaderia' and anio_lote < '$anio_actual' AND anio_lote <> '00' AND mes_lote <> '00') or (`cod_mercaderia` = '$cod_mercaderia' and anio_lote < '$anio_actual' and mes_lote < '$mes_actual' AND anio_lote <> '00' AND mes_lote <> '00') order by anio_lote, mes_lote";
}
$result1 = $db->Execute($sql1);

if (!$result1) die("fallo".$db->ErrorMsg());

 while (!$result1->EOF) {

$cod_merquita=strtoupper($result1->fields["cod_mercaderia"]);

$sql = "SELECT * FROM `mercaderia`  WHERE  `cod_merca` like '$cod_merquita'";
$result = $db->Execute($sql);
$descripcion=strtoupper($result->fields["descripcion"]);
$cod_merca=strtoupper($result->fields["cod_merca"]);


 

$cantidad_ingresada=strtoupper($result1->fields["cantidad_ingresada"]);


$cantidad_salida=strtoupper($result1->fields["cantidad_salida"]);
$lote=strtoupper($result1->fields["lote"]);

$mes_lote=strtoupper($result1->fields["mes_lote"]);
$anio_lote=strtoupper($result1->fields["anio_lote"]);
$vto_lote=$mes_lote."/".$anio_lote;

$nombre=strtoupper($result->fields["nombre"]);
$presentacion=strtoupper($result->fields["presentacion"]);



$cantidad_existente = $cantidad_ingresada - $cantidad_salida;


 if ($B == 1) {

?>
  <tr bordercolor="#FFFFFF" bgcolor="#FFFFCC" class="Estilo26" >
    <?
$B = 0;
				}
	ELSE	{
	$B=1;
		 	
?>
  <tr bordercolor="#FFFFCC" bgcolor="#FFFFCC" class="Estilo26">
    <?

			}

			?>
    <td height="20" bgcolor="#FFFFCC" class="Estilo61" scope="col"><div align="center"><a href="entrada_factura_2.php?nro_cliente=<?print("$nro_cliente");?>&&operador=<?print("$operador");?>&&matricula=<?print("$matricula");?>&&matricula1=<?print("$matricula");?>&&nro_factura=<?print("$nro_factura");?>&&dia=<?print("$dia");?>&&mes=<?print("$mes");?>&&anio=<?print("$anio");?>&&producto=<?print("$descripcion");?>&&cod_merca=<?print("$cod_merca");?>&&pasada=1&&no_hacer_nada=<?print("$no_hacer_nada");?>"><?print("$cod_merca");?>
    
	</a></span>
	  </div>
    </div></td>
    <td scope="col"><span class="Estilo63"><?echo $descripcion;?></span></td>
    <td scope="col"><div align="center" class="Estilo63"><?echo $lote;?>
      </div>
    <div align="center" class="Estilo63"></div></td>
    <td scope="col"><div align="center" class="Estilo63"><?echo $vto_lote;?>
      </div>
    <div align="center" class="Estilo63"></div></td>
    <td scope="col"><div align="center" class="Estilo63"><?echo $cantidad_existente;?>
      </div>
    <div align="center" class="Estilo63"></div></td>
  </tr>

<?
   $result1->MoveNext();
				}
				

 
 
	?>	
</table>

