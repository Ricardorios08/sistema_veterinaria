


   <?php 
$que=$_POST["buscador"];
	for ($i=0;$i<count($que);$i++)    
	{     
	$quebusca = $que[$i];    
	}

$orde=$_POST["orden"];
	for ($i=0;$i<count($orde);$i++)    
	{     
	$orden = $orde[$i];    
	}

$quebusca;
$palabra= $_REQUEST['busca'];

switch ($quebusca)
	{
		
		case "1": //cuentas
{$buscador = "FACTURANTE";
$a= 1;
include ("../a_sectores/secretaria/a_cuentas/laboratorio.php");

break;	}
	
		case "2": //CLIENTES
{require("../a_sectores/proveeduria/clientes/buscar_clientes3.php");
break;}
	
		case "3": //practicas
		
{include ("../a_sectores/auditoria/buscar_convenida2.php");
break;}

		case "4": //obras sociales
{include ("../a_sectores/secretaria/a_obras sociales/buscar_os.php");
break;}

		case "5": //bioquimicos
{include("../a_sectores/secretaria/a_bioquimicos/buscar_bioquimicos1.php");
break;}

		case "6": //PROVEED
{require("../a_sectores/proveeduria/proveedores/buscar_proveedores.php");
break;}

		case "7": //convenios
{require ("../a_sectores/gerencia/buscar_convenios.php");
break;}

		case "8": //buscar ordenes grabadas
{require ("../a_sectores/grabacion/buscar_grabadaa.php");
break;}

		case "9": //buscar boletas de ordenes presentadas
{require ("../a_sectores/recepcion/buscar_or.php");
break;}
			
		case "10": //buscar boletas de ordenes presentadas
{require ("../a_sectores/recepcion/buscar_or.php");
break;}

		case "11": //buscar boletas de ordenes presentadas
{require ("../a_sectores/recepcion/buscar_or.php");				break;}

case "12": //buscar boletas de ordenes presentadas
{require ("../a_sectores/estadistica/ordenes/buscar_or.php");				break;}

case "15": //buscar boletas de ordenes presentadas
{require ("../a_sectores/recepcion/detalle_fecha.php");				break;}

case "16": //buscar medicos prescriptores
{require ("../a_sectores/secretaria/a_obras sociales/buscar_prescriptores.php");				break;}

case "17": //buscar nomencladores
{require ("../a_sectores/nomencladores/buscar_nomencladores.php");				break;}

case "18": {//Facturante
$a=1;
$band_fac = 1;
include ("../a_sectores/secretaria/a_cuentas/buscar_cuenta.php");break;}



case "19": //buscar boletas de ordenes presentadas
{require ("../a_sectores/recepcion/consultas/buscar_mes.php");		
break;}

case "30": //buscar boletas de ordenes presentadas
		{
$a=1;
$band_fac = 2;
$buscador = "DATOS_AUSENTES";
include ("../a_sectores/secretaria/a_cuentas/buscar_cuenta.php");
break;}

		case "31": //comparar practicas
$buscador = "31";		
{include ("../a_sectores/auditoria/buscar_convenida2.php");
break;}

		case "32": //buscar agenda
$buscador = "32";		
$busqueda = "VARIOS";
{include ("../validar/usuarios/buscar_empleado.php");
break;}

case "33": //buscar agenda
$busqueda = "RAPIDA";
{include ("../a_sectores/grabacion/buscar_rapido.php");
break;}

case "34": {//Facturante
$a=1;
$band_fac = 1;
include ("../a_sectores/secretaria/a_cuentas/deposito.php");break;}


case "40": {//PRECIOS MEGA
$a=1;
$band_fac = 1;
include ("../a_sectores/mega/buscar_convenio_rapido.php");break;}

case "41": {//NOMENCLADOR MEGA
$a=1;
$band_fac = 1;
include ("../a_sectores/mega/buscar_practicas_rapido.php");break;}

case "42": {//FACTURADO MEGA
$a=1;
$band_fac = 1;
include ("../a_sectores/mega/buscar_facturas_rapido.php");break;}



case "43": {//SITUACION IVA
$a=1;
$band_fac = 1;
include ("../a_sectores/secretaria/a_cuentas/facturante_iva.php");break;}

case "44": {//CLIENTES EXTERNOS MEGA
$a=1;
$band_fac = 1;
include ("../a_sectores/secretaria/a_cuentas/deposito.php");break;}

case "45": {//FACTURADO MEGA
$a=1;
$band_fac = 1;
include ("../a_sectores/mega/buscar_periodo_rapido.php");break;}				


case "46": {//BANCO REGIONAL
$a=1;
$band_fac = 1;
include ("../a_sectores/secretaria/a_cuentas/banco_regional.php");break;}

case "50": {//BANCO REGIONAL
$a=1;
$band_fac = 1;
include ("../a_sectores/secretaria/a_cuentas/banco_regional_excel.php");break;}


case "47": {//conversion pami
$a=1;
$band_fac = 1;
include ("../a_sectores/auditoria/conversion_pami.php");break;}

case "48": {//BANCO ciyy y otros
$a=1;
$band_fac = 1;
include ("../a_sectores/secretaria/a_cuentas/banco_regional_city.php");break;}


case "49": {//Facturante
$a=1;
$band_fac = 1;
include ("../a_sectores/secretaria/a_cuentas/buscar_nofacturante.php");break;}

}
?>
  
  </tr>
</table>

</form>