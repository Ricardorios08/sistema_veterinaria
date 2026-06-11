<script language="javascript">
function on_load()
{
document.getElementById("busca").focus();
}

function salta()
{
document.getElementById("busca").focus();
}

}





</script>

<script LANGUAGE="JavaScript">
function multicarga(documento1,documento2)
{
parent.izquierda.location.href=documento1;
parent.central.location.href=documento2;
}
</script>
<head>


<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<style type="text/css">
<!--
.Estilo3 {font-family: Arial, Helvetica, sans-serif; font-size: 10px; }
.Estilo5 {font-family: Arial, Helvetica, sans-serif; font-size: 10px; color: #0000FF; }
body {
	background-color: #FFFFCC;
	background-repeat: no-repeat;
	background-image: url(../../imagenes/fondo_arriba.gif);
}
body,td,th {
	font-family: Arial, Helvetica, sans-serif;
	font-size: 12px;
}
.Estilo6 {font-weight: bold}
.Estilo31 {
	font-size: 18px;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	color: #0000FF;
}
.Estilo32 {
	font-size: 16px;
	font-weight: bold;
}
.Estilo33 {color: #FF0000}
-->
</style>
</head>

<?php  $mes= date("m");?>
<?php $anio= date("y");


include ("../../conexiones/config.inc.php");

$sql="select * from datos_principales";
$result = $db->Execute($sql);
$nombre_laboratorio=strtoupper($result->fields["nombre_laboratorio"]);


$sql = "SELECT * FROM archivos";
$result = $db->Execute($sql);
$id=$result->fields["id"];



?>
<!-- <BODY onload = "on_load()" background="../../../../IMAGENES/ladrillos.jpg"> -->
<BODY onload = "on_load()">
<form action="../../validar/buscador.php" method="post" target ="central">
<table width="1010" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="18"><div align="center" class="Estilo31">
      
      </div></td>
    <td width="830" height="85">    <div align="left"></div>      <table width="671" border="0" cellpadding="0" cellspacing="0">
      <tr>
          <th width="87" scope="row">&nbsp;</th>
          <th width="101" rowspan="2" scope="row"><div align="center"><span class="Estilo3"><span class="Estilo1 Estilo2"><a href="../../a_sectores/pacientes.php" target = "izquierda"><img src="../../imagenes/botones/barra/consultas.jpg" alt="Consul. Bioq." width="50" height="50" border = "0" title="Consultas Varias"></a></span></span></div></th>
        <th width="104" rowspan="2" scope="row"><div align="center"><span class="Estilo3"><span class="Estilo1 Estilo2"><a href="../../a_sectores/auditoria/menu_practicas.php" target = "izquierda"><img src="../../imagenes/botones/barra/auditoria.jpg" alt="Auditoria" width="50" height="50" border = "0" title="Altas de Practicas, metodos, Debitos, etc"></a></span></span></div></th>
        <th width="86" rowspan="2" scope="row"><div align="center" class="Estilo3">
            <div align="center"><a href="../../a_sectores/secretaria/secretaria.php" target = "izquierda"><img src="../../imagenes/botones/barra/estadistica.jpg" alt="Estadisticas" width="50" height="50" border = "0" title="Diferentes estadisticas, Ordenes, Recepcion, etc"></a></div>
        </div></th>
        <td width="116" rowspan="2"><div align="center" class="Estilo3">
            <div align="center"><a href="../../a_sectores/facturacion/facturacion.php" target = "izquierda"><img src="../../imagenes/botones/barra/facturacion.jpg" alt="Facturaci&oacute;n" width="50" height="50" border = "0"  title="Sistema para facturas Obras Sociales, Pre-Facturacion, Consultas"></a></div>
        </div></td>
        <td width="109" rowspan="2"><div align="center" class="Estilo3">
            <div align="center"><a href="../../a_sectores/gerencia/gerencia.php" target = "izquierda"><img src="../../imagenes/botones/barra/gerencia.jpg" alt="Gerencia" width="50" height="50" border = "0" title="Convenios, Consultas de Convenios, Definir Practicas, convertir nomencladores"></a></div>
        </div></td>
        <td width="68" rowspan="2"><div align="center"><span class="Estilo3"><a href="../../validar/usuarios/agenda.php" target="izquierda"><img src="../../imagenes/botones/barra/secretaria.jpg" alt="Secretaria" width="50" height="50" border = "0" title="Alta de Socios, Obras Sociales, Bioquimicos. Consultas, listados para imprimir, etc"></a></span></div></td>
      </tr>
      <tr>
        <th scope="row">&nbsp;</th>
      </tr>
      <tr>
        <th width="87" scope="row">&nbsp;</th>
        <th scope="row"><span class="Estilo5">&nbsp;</span></th>
        <th scope="row"><span class="Estilo5">&nbsp;</span></th>
        <th scope="row"><span class="Estilo5">&nbsp;  </span></th>
        <th><span class="Estilo5">&nbsp;</span></th>
        <th><span class="Estilo5">&nbsp;</span></th>
        <th><span class="Estilo3 Estilo6">&nbsp;<span class="Estilo5"></span></span></th>
      </tr>
    </table>      </td>
    <td width="162"><div align="center"><?php echo "<img src=\"../../a_sectores/gerencia/imagen/ver.php?id=".$id."\" width='160' height='90'>";?></div></td>
  </tr>
</table>
<font color="#000000"></font>

</form>
</body>
</html> 


