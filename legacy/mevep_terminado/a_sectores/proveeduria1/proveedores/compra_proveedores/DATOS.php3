<table width="258" border="0">
        <tr align="center" bordercolor="#FFFFFF" bgcolor="#006699">
          <th width="37" scope="col"><div align="center"><font color="#FFFFFF">N&ordm; </font></div></th>
          <th width="129" scope="col"><div align="center"><font color="#FFFFCC">Mercaderia</font></div></th>
          <th width="70" scope="col"><div align="center"><font color="#FFFFCC">Eliminar</font></div></th>
        </tr>
        <?
		if(isset($_REQUEST['Alta'])) {
	
	switch ($_REQUEST['Alta'])
	{
		case "OK":
				{
	



 $nro_os=$_REQUEST["nro_os"];
 $nro_laboratorio=$_REQUEST["nro_laboratorio"];
// $matricula=$_REQUEST["matricula"];
 $nro_afiliado=$_REQUEST["nro_afiliado"];
 $nro_orden=$_REQUEST["nro_orden"];
 $fecha=$_REQUEST["fecha"];
 $medico=$_REQUEST["medico"];
 $coseguro=$_REQUEST["coseguro"];
 $autorizacion=$_REQUEST["autorizacion"];
 $a&ntilde;o = date("Y");
 $cod_grabacion=$nro_os.$matricula.$nro_orden;

 $nro_practica=$_REQUEST["nro_practica"];


$cod_grabacion1=$nro_os.$matricula.$nro_orden.$nro_practica;

$mes=$_POST["mes"];
	





 

if ($nro_practica!="" ) {

if ($nro_os !="" ) {



if ($nro_orden !="" ) {

if ($fecha !="" ) {


include ("../../conexiones/config_gb.php");


$sql = "INSERT INTO `ordenes` ( `cod_grabacion` , `periodo` , `ano` , `nro_os` , `nro_laboratorio` ,`matricula` , `nro_afiliado` ,`nro_orden` , `fecha` ,`medico` , `coseguro` , `autorizacion` ) VALUES ( '$cod_grabacion' , '$mes' , '$a&ntilde;o' , '$nro_os' , '$nro_laboratorio' , '$matricula' , '$nro_afiliado' , '$nro_orden' , '$fecha' , '$medico' ,'$coseguro' , '$autorizacion' )";
mysql_query($sql);

$sql = "INSERT INTO `ordenes_historial` ( `cod_grabacion` , `periodo` , `ano` , `nro_os` , `nro_laboratorio` ,`matricula` , `nro_afiliado` ,`nro_orden` , `fecha` ,`medico` , `coseguro` , `autorizacion` ) VALUES ( '$cod_grabacion' , '$mes' , '$a&ntilde;o' , '$nro_os' , '$nro_laboratorio' , '$matricula' , '$nro_afiliado' , '$nro_orden' , '$fecha' , '$medico' ,'$coseguro' , '$autorizacion' )";
mysql_query($sql);

if ($autorizacion == "SI"){


 $sql = "INSERT INTO `detalle` ( `cod_grabacion` , `nro_os` , `nro_laboratorio` , `nro_orden` , `nro_practica` , `valor` , `periodo` , `ano` , `nro_factura` ) VALUES ('$cod_grabacion' , '$nro_os' , '$nro_laboratorio' , '$nro_orden' , '$nro_practica' , '$valor', '$mes' , '$a&ntilde;o' , '$nro_factura')";



mysql_query($sql);

$sql = "INSERT INTO `detalle_historial` ( `cod_grabacion` , `nro_os` , `nro_laboratorio` , `nro_orden` , `nro_practica` , `valor` , `periodo` , `ano` , `nro_factura` ) VALUES ('$cod_grabacion' , '$nro_os' , '$nro_laboratorio' , '$nro_orden' , '$nro_practica' , '$valor' ,'$mes' , '$a&ntilde;o' , '$nro_factura')";
mysql_query($sql);

}
ELSE
	{

ECHO "NECESITA CODIGO AUTORIZACION";
	}

$sql7="select * from detalle where cod_grabacion = '$cod_grabacion'";
$result7 = $db->Execute($sql7);

if (!$result7) die("fallo".$db->ErrorMsg());

 while (!$result7->EOF) {

$nro_practi=ucwords($result7->fields["nro_practica"]);

include ("../../conexiones/config_pr.php");
$sql8="select * from practica where cod_practica = '$nro_practi'";
$result8 = $db->Execute($sql8);
$practica=strtoupper($result8->fields["practica"]);

$practica = substr($practica,0,8);


if ($B == 1) {

?>
        <tr bordercolor="#FFFFFF" bgcolor="#FFFFFF">
          <?
$B = 0;
				}
	ELSE	{
	$B=1;
		 	
?>
        <tr bordercolor="#B5D0EE" bgcolor="#B5D0EE">
          <td><?print $nro_merca;?></td>
          <td><?print $nombre;?></td>
          <td bgcolor="#FFFFFF"><div align="center"><a href="borra.php?cod_grabacion=<?print("$cod_grabacion");?>
												  &nro_practica=<?print("$nro_practi");?>
												  &nro_os=<?print("$nro_os");?>
												 &nro_laboratorio=<?print("$nro_laboratorio");?>
												  &nro_orden=<?print("$nro_orden");?>
												  &nro_afiliado=<?print("$nro_afiliado");?>
												  &mes=<?print("$mes");?>
												  &fecha=<?print("$fecha");?>
   												   &matricula=<?print("$matricula");?>
	   												 &cod_grabacion1=<?print("$cod_grabacion1");?>
		">[OK]</a></div></td>
        </tr>
        <tr bordercolor="#B5D0EE" bgcolor="#B5D0EE">
          <?

			}


?>
          <td><div align="center"></div></td>
          <td><div align="left">NETO GRABADO </div></td>
          <td bgcolor="#FFFFFF"><div align="center"></div></td>
        </tr>
        <tr bordercolor="#B5D0EE" bgcolor="#B5D0EE">
          <td>&nbsp;</td>
          <td>IVA</td>
          <td bgcolor="#FFFFFF">&nbsp;</td>
        </tr>
        <tr bordercolor="#B5D0EE" bgcolor="#B5D0EE">
          <td>&nbsp;</td>
          <td>PERCEPCION</td>
          <td bgcolor="#FFFFFF">&nbsp;</td>
        </tr>
        <tr bordercolor="#B5D0EE" bgcolor="#B5D0EE">
          <td>&nbsp;</td>
          <td>TOTAL</td>
          <td bgcolor="#FFFFFF">&nbsp;</td>
        </tr>
        <?
//mandar dos variables en vez de una cod_grabacion mas nro_practica
$result7->MoveNext();

	}



}
}
}
				
}
break;
}
}
}
?>
      </table>