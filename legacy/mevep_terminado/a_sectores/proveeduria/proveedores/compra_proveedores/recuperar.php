<BODY background="pescar.bmp"><CENTER><TABLE WIDTH="90%" BORDER=0><TR><TD>  

<?php
include ("../../../../conexiones/config_pro.php");


$nro_proveedor=$_POST["nro_proveedor"];
$fecha=$_POST["fecha"];
$factura=$_POST["factura"];
$porcentaje_boni=$_POST["porcentaje_boni"];
$porcentaje_dto=$_POST["porcentaje_dto"];
$cod_merca=$_POST["cod_merca"];
$cantidad=$_POST["cantidad"];


if(isset($_POST['Alta'])) {
	
	switch ($_POST['Alta'])
	{
		case "OK":
				{
	


			if ($nro_proveedor!="" ) {
				if ($fecha !="" ) {
					if ($factura !="" ) {
						if ($porcentaje_boni !="" ) {
							if ($porcentaje_dto !="" ) {
								if ($cod_merca !="" ) {
									if ($cantidad !="" ) {





echo $sql = "INSERT INTO `compras_proveeduria` ( `nro_proveedor` , `fecha` , `factura` , `porcentaje_boni` , `porcentaje_dto` , `cod_merca` , `cantidad`)VALUES ('$nro_proveedor' ,'$fecha' , '$factura', '$porcentaje_boni', '$porcentaje_dto', '$cod_merca' , '$cantidad' )";

mysql_query($sql);


									}
								}
							}
						}
					}
				}
			}
				}
	}
}
 include ("../../../proveeduria/proveedores/compra_proveedores/vtas_pro.php");

?>
 <a href="imprimir.php?cod_grabacion=<?print("$cod_grabacion");?>  && cod_merca=<?print("$cod_merca");?> && presentacion=<?print("$presentacion");?>&& lote=<?print("$lote");?> && vto_lote=<?print("$vto_lote");?>&& cantidad=<?print("$cantidad");?>&& precio=<?print("$precio");?>">IMPRIMIR</a> </div>
		