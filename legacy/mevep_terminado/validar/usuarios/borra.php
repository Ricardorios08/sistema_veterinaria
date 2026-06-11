<?php 
$id = $_GET['id'];
$apellido = $_GET['apellido'];




?>

<FORM name="form" ACTION="<?php php echo $_SERVER["PHP_SELF"];?>" METHOD = "POST">

<?php $leyenda=  $apellido. " SE BORRARÁ DE LA AGENDA DEL SISTEMA";
$leyenda1=  "¿ESTA SEGURO DE ELIMINARLA?";
include ("../../alertas/campo_doble.php");
?>
<INPUT type ="hidden" value = "<?php echo $id;?>" name = "id">
<CENTER><INPUT type ="submit" value = "SI" name = "Alta">
<INPUT type ="submit" value = "NO" name = "Alta"></CENTER>


</form>


<?php 

if(isset($_REQUEST['Alta'])) {
	
	switch ($_REQUEST['Alta'])
	{
		case "SI":
				{
$id = $_REQUEST['id'];
include ("../../conexiones/config.inc.php");
$SQL="Delete From empleados where id = $id";
$db->Execute($SQL);
?><center><?php 
echo $leyenda=  "EL REGISTRO SE HA ELIMINADO DEL SISTEMA";
?></center><?php 
break;
				}


				case "NO":
				{
?><center><?php 
echo $leyenda=  "EL REGISTRO NO SE HA ELIMINADO DEL SISTEMA";
?></center><?php 
//include ("../../alertas/campo_vacio.php");
exit;
break;
				}
	}
}







?>