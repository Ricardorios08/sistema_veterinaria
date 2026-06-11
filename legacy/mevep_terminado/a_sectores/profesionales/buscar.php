<!-- <body onUnload="window.opener.openedImprimir=0;" onLoad="window.print(); window.close();"> -->

<?php

include ("../../conexiones/config.inc.php");


global $buscador_rapido;

if ($borrar != 1){
$buscador_rapido=$_POST["buscador_rapido"];
$palabra=$_POST["busca"];
}

$palabra=$_REQUEST["palabra"];


$hoy = date("d/m/y");

list($ape,$nom) = explode(" ",$palabra);

    $ape; // Imprime 12
    $nom; // Imprime 01
  

/*if ($palabra == "") {
$leyenda = "NO INGRESO BUSQUEDA";
include ("../../alertas/campo_informacion.php");
EXIT;

}*/

$B = 1;

/*if ($palabra == "") {
$mensaje = "NO INGRESO BUSQUEDA";
include ("../../alertas/campo_informacion.php");
EXIT;

}else{
  $sql="select * from socios where cod_socio like '$palabra' or documento like '$palabra' or apellido like '%$palabra%' or nombre like '$palabra%' or telefono like '$palabra%'  or domicilio like '%$palabra%'  order by  cod_socio asc ";
 $result = $db->Execute($sql);
}
	
*/

   $sql="select * from profesionales ";

 $result = $db->Execute($sql);



?>
<table width="800" border="0" cellspacing="0">
  <!--DWLayoutTable-->
  <tr bordercolor="#FFFFCC" bgcolor="#E6E6E6">
    <td colspan="6"><div align="center"><font color="#FFFFFF" size="2" face="Trebuchet MS"><font color="#000000">LISTADO DE PROFESIONALES. Emitido el <?php echo $hoy;?></font></font></div></td>
  </tr>
  <tr bordercolor="#FFFFCC" bgcolor="#CCCCCC">
  
    <td width="154"><div align="center"><strong><font color="#000000" size="2" face="Trebuchet MS">N°</font></strong></div></td>
    <td width="265"><div align="center"><strong><font color="#000000" size="2" face="Trebuchet MS"> APELLIDO Y NOMBRE </font></strong></div></td>
    <td width="100"><div align="center"><strong><font color="#000000" size="2" face="Trebuchet MS">ESPECIALIDAD</font></strong></div></td>
    <td width="29"><strong><font color="#000000" size="2" face="Trebuchet MS">BORRAR</font></strong></td>
    <?php 




 
  if (!$result) die("fallo".$db->ErrorMsg());
  while (!$result->EOF) {

	
$nro_profesional=strtoupper($result->fields["nro_profesional"]);
$apellido=strtoupper($result->fields["apellido"]);
$nombre=strtoupper($result->fields["nombre"]);
$especialidad=strtoupper($result->fields["especialidad"]);






    ?>  
  <tr bordercolor="#FFFFFF" bgcolor="#FFFFCC">
	<td bordercolor="#E8DCFC" bgcolor="#FFFF99"><div align="center"><strong><font size="2" face="Trebuchet MS"><?php print("$nro_profesional");?></font></strong></div></td>
    <td bordercolor="#E8DCFC" bgcolor="#FFFF99"><div align="center"><strong><font size="2" face="Trebuchet MS"><a href="modificar_profesional.php?nro_profesional=<?php print("$nro_profesional");?>"><?php print("$apellido");?>, <?php print("$nombre");?></a></font></strong></div></td>
    <td bordercolor="#E8DCFC" bgcolor="#FFFF99"><div align="center"><strong><font size="2" face="Trebuchet MS"> <?php echo $especialidad;?></font></strong></div></td>
   
   


    <td bordercolor="#E8DCFC" bgcolor="#FFFF99"><div align="center"><strong><font size="2" face="Trebuchet MS"><a href="borrar_profesional.php?nro_profesional=<?php print("$nro_profesional");?>" onClick="return confirm('&iquest;Est&aacute; seguro de Borrar el Profesional?');"><img src="../../imagenes/office//1047.ico" alt="Borrar" border = "0"></a></font></strong></div></td>
  </tr>
    

 <?php



$result->MoveNext();
	}

?>
</table>
