<style type="text/css">
<!--

.Estilo6 {color: #FF0000}
-->
H1.SaltoDePagina
{
PAGE-BREAK-AFTER: always
}
.Estilo27 {color: #000000}
.Estilo41 {font-family: Arial, Helvetica, sans-serif}
.Estilo14 {font-size: 12px}
.Estilo15 {font-family: Arial, Helvetica, sans-serif; font-size: 12px; }
.Estilo18 {color: #000000; font-family: Arial, Helvetica, sans-serif; font-size: 12px; }
.Estilo47 {font-size: 10px}
.Estilo52 {color: #000000; font-weight: bold; }
.Estilo53 {font-weight: bold; font-family: Arial, Helvetica, sans-serif;}
.Estilo54 {font-family: Arial, Helvetica, sans-serif; font-size: 14px;}
.Estilo55 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 10px;
	font-style: italic;
}
.Estilo61 {color: #000000; font-size: 12px;}
</STYLE>

<?


include ("../../../conexiones/config_pro.php");
$nro_factura=$_REQUEST["nro_factura"];
$tipo_fact=$_REQUEST["tipo_fact"];
$fact=$_REQUEST["tipo_fact"];



if ($tipo_fact == "A"){
	include ("factura_papel_A.php");
	}else{

include ("factura_papel_B.php");
	}

