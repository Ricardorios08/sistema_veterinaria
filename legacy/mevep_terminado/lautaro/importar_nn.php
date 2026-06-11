<?php 


$archivo = $_REQUEST['textfile'];
$nro_os= $_REQUEST['nro_os'];


//if(!

$path = "C:/utiles/easyphp1-7/www/archivos/nomencladores/febrero08";

$archivo = dirname($path)."/".$archivo; // $file toma el valor "/etc"

copy ($archivo, "c:/utiles/easyphp1-7/mysql/data/practicas/"."nomenclador.txt")

/*{

echo "error al copiar el archivo";
}
else
{
	*/
?>

<?php 

	//break;
//}

//$sql2 = 'LOAD DATA INFILE \'pami_ordenes.txt\' REPLACE INTO TABLE `pami_ordenes` '
  //    . ' FIELDS TERMINATED BY \',\''
    //  . ' ENCLOSED BY \'"\'';


include ("../conexiones/config_pr.php");
$sql = "SELECT * FROM `convenio_practica` WHERE `nro_os` LIKE '$nro_os'";
	$result = $db->Execute($sql);

$nro_os_1=strtoupper($result->fields["nro_os"]);

if ($nro_os_1 == ""){
	include ("../conexiones/config_pr.php");
echo $sql2 = "LOAD DATA INFILE 'nomenclador.txt' INTO TABLE `convenio_practica` FIELDS TERMINATED BY ';'";
mysql_query($sql2);
?><table width="103%" border="0">
  <tr>
    <td width="100%" height="40" colspan="3" bgcolor="#C4D7E6"><div align="center">NOMENCLADORES</div></td>
  </tr>
  <tr>
    <td height="28" colspan="3"><div align="center">El Archivo<?php echo $archivo." ";?> fue cargado con exito al sistema" </div></td>
  </tr>
</table><?php 
}else{
	$leyenda = "DEBE BORRAR EL NOMENCLADOR ACTUAL PARA PODER CARGAR UNO NUEVO";
	include ("alerta_borrar_nn.php");
	
}






//include ("ordenes.php");	
//include ("detalle.php");	

?>