<style type="text/css">
<!--
.Estilo16 {font-family: Arial, Helvetica, sans-serif}
.Estilo26 {
	color: #000000;
	font-family: Arial, Helvetica, sans-serif;
	font-size: 10px;
}
-->


<!--
.Estilo67 {color: #FFFFFF; font-size: 12px; font-family: Arial, Helvetica, sans-serif;}
.Estilo69 {font-size: 12px}
-->

<!--
.Estilo79 {color: #000099}
.Estilo80 {color: #000099; font-size: 12px; }
-->



</style>


<table width="103%" border="0">
  <tr bgcolor="#E6E6E6">
    <td width="10%" scope="col"><div align="center" class="Estilo1 Estilo39 Estilo42 Estilo45 Estilo16 Estilo60 Estilo67 Estilo69 Estilo79">Cod.</div></td>
    <td width="28%" scope="col"><div align="center" class="Estilo1 Estilo45 Estilo39 Estilo42 Estilo16 Estilo60 Estilo67 Estilo69 Estilo79">Descripcion</div></td>
    <td width="19%" scope="col"><div align="center" class="Estilo1 Estilo45 Estilo39 Estilo42 Estilo16 Estilo60 Estilo67 Estilo69 Estilo79">Presentaci&oacute;n</div></td>
    <td width="11%" scope="col"><div align="center" class="Estilo80"><span class="Estilo1 Estilo45 Estilo39 Estilo42 Estilo60  Estilo16">Lote</span></div></td>
    <td width="12%" scope="col"><div align="center" class="Estilo80"><span class="Estilo1 Estilo45 Estilo39 Estilo42 Estilo60  Estilo16">Vencimiento</span></div></td>
    <td width="9%" scope="col"><div align="center" class="Estilo80"><span class="Estilo1 Estilo45 Estilo39 Estilo42 Estilo60  Estilo16">Cantidad</span></div></td>
    <td width="11%" scope="col"><div align="center" class="Estilo80"><span class="Estilo1 Estilo45 Estilo39 Estilo42 Estilo60  Estilo16">Precio</span></div></td>
	   <td width="11%" scope="col"><div align="center" class="Estilo80"><span class="Estilo1 Estilo45 Estilo39 Estilo42 Estilo60  Estilo16">Prov.</span></div></td>
  </tr>

<?
	


$cod_mercaderia = $_REQUEST['cod_mercaderia'];
$matricula= $_REQUEST['matricula'];
$nro_cliente= $_REQUEST['nro_cliente'];
$operador= $_REQUEST['operador'];




$busca == "SI";

include("../../../conexiones/config_pro.php");

if ($cod_mercaderia == ""){
$sql = "SELECT * FROM `mercaderia` order by nombre";
}
else
{
 $sql = "SELECT * FROM `mercaderia`  WHERE  `cod_merca` like '$cod_mercaderia%' OR descripcion like '$cod_mercaderia%' or nombre like '$cod_mercaderia%'";
}
$result = $db->Execute($sql);

if (!$result) die("fallo".$db->ErrorMsg());

 while (!$result->EOF) {

$descripcion=strtoupper($result->fields["descripcion"]);
$cod_merca=strtoupper($result->fields["cod_merca"]);
$precio_actualizado=strtoupper($result->fields["precio_actualizado"]);
$proveedor=strtoupper($result->fields["proveedor"]);


$sql1="select * from existencias where cod_mercaderia like '$cod_merca' order by cod_mercaderia, rand()";
$result1 = $db->Execute($sql1);


 $cod_merquita=strtoupper($result1->fields["cod_mercaderia"]);

$sql18 = "SELECT SUM(cantidad_ingresada) as cant FROM existencias  WHERE  `cod_mercaderia` = '$cod_merquita' ";
$result18 = $db->Execute($sql18);
$cantidad_ingresada=strtoupper($result18->fields["cant"]);

$sql18 = "SELECT SUM(cantidad_salida) as salid FROM existencias  WHERE  `cod_mercaderia` = '$cod_merquita' ";
$result18 = $db->Execute($sql18);
$cantidad_salida=strtoupper($result18->fields["salid"]);


$lote=strtoupper($result1->fields["lote"]);

$mes_lote=strtoupper($result1->fields["mes_lote"]);
$anio_lote=strtoupper($result1->fields["anio_lote"]);
$vto_lote=$mes_lote."/".$anio_lote;

$nombre=strtoupper($result->fields["nombre"]);
$presentacion=strtoupper($result->fields["presentacion"]);



$cantidad_existente = $cantidad_ingresada - $cantidad_salida;

$precio_actualizado = number_format($precio_actualizado,2);
$contar = $contar + 1;
if ($contr == 20){
echo "dfsf".$contar=0;
?>
    <td width="10%" scope="col"><div align="center" class="Estilo1 Estilo39 Estilo42 Estilo45 Estilo16 Estilo60">Cod.</div></td>
    <td width="28%" scope="col"><div align="center" class="Estilo1 Estilo45 Estilo39 Estilo42 Estilo16 Estilo60">Descripción</div></td>
    <td width="19%" scope="col"><div align="center" class="Estilo1 Estilo45 Estilo39 Estilo42 Estilo16 Estilo60">Presentaci&oacute;n</div></td>
    <td width="11%" scope="col"><div align="center"><span class="Estilo1 Estilo45 Estilo39 Estilo42 Estilo16 Estilo60">Lote</span></div></td>
    <td width="12%" scope="col"><div align="center"><span class="Estilo1 Estilo45 Estilo39 Estilo42 Estilo16 Estilo60">Vencimiento</span></div></td>
    <td width="9%" scope="col"><div align="center"><span class="Estilo1 Estilo45 Estilo39 Estilo42 Estilo16 Estilo60">Cantidad</span></div></td>
    <td width="11%" scope="col"><div align="center"><span class="Estilo1 Estilo45 Estilo39 Estilo42 Estilo16 Estilo60">Precio</span></div></td>
	  <td width="11%" scope="col"><div align="center"><span class="Estilo1 Estilo45 Estilo39 Estilo42 Estilo16 Estilo60">Proveedor</span></div></td>
<?

}


if ($cod_merquita == ""){
$result->MoveNext();
}
else {
if ($descripcion == ""){

$result->MoveNext();
}
else
	 {
 if ($B == 1) {

?>
  <tr bordercolor="#FFFFFF" bgcolor="#CCFFCC" class="Estilo26" >
    <?
$B = 0;
				}
	ELSE	{
	$B=1;
		 	
?>
  <tr bordercolor="#FFFFCC" bgcolor="#E1F2EF" class="Estilo26">
    <?

			}





			?>
    <td height="20" class="Estilo61" scope="col"><div align="center"><a href="entrada_factura_2.php?nro_cliente=<?print("$nro_cliente");?>&&operador=<?print("$operador");?>&&matricula=<?print("$matricula");?>&&matricula1=<?print("$matricula");?>&&nro_factura=<?print("$nro_factura");?>&&dia=<?print("$dia");?>&&mes=<?print("$mes");?>&&anio=<?print("$anio");?>&&producto=<?print("$descripcion");?>&&cod_merquita=<?print("$cod_merquita");?>&&cantidad_existente=<?print("$cantidad_existente");?>&&cod_merca=<?print("$cod_merca");?>&&pasada=1&&no_hacer_nada=<?print("$no_hacer_nada");?>"><?print("$cod_merca");?>
    
	</a></span>
</div>
      </div></td>
    <td scope="col"><span class="Estilo60"><?echo $descripcion;?></span></td>
    <td scope="col"><div align="center" class="Estilo60"><?echo $presentacion;?></div></td>
    <td scope="col"><div align="center" class="Estilo60"><?echo $lote;?>
</div>
      <div align="center" class="Estilo60"></div></td>
    <td scope="col"><div align="center" class="Estilo60"><?echo $vto_lote;?>
</div>
      <div align="center" class="Estilo60"></div></td>
    <td scope="col"><div align="center" class="Estilo60"><?echo $cantidad_existente;?>
</div>
      <div align="center" class="Estilo60"></div></td>
    <td scope="col"><div align="center"><span class="Estilo60">$ <?echo $precio_actualizado;?></span></div></td>
	    <td scope="col"><div align="center" class="Estilo60"><?echo $proveedor;?>
  </tr>

<?
   $result->MoveNext();
				}
				}

 
 }
	?>	
</table>

