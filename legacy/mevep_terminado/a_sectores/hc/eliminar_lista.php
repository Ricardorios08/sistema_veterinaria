<?PHP
include ("../../conexiones/config.inc.php");
$cod_operacion=$_REQUEST["cod_operacion"];

$sql = "DELETE FROM lista_espera where cod_operacion = $cod_operacion";
mysql_query($sql);

include ("lista.php");