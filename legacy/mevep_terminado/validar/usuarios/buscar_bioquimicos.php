<style type="text/css">
<!--
.Estilo5 {font-family: Arial, Helvetica, sans-serif; font-size: 12px; }
.Estilo6 {color: #FFFFFF}
.Estilo7 {font-family: Arial, Helvetica, sans-serif}
.Estilo8 {font-size: 10px}
.Estilo11 {font-family: Arial, Helvetica, sans-serif; font-size: 10px; }
.Estilo13 {font-family: Arial, Helvetica, sans-serif; font-size: 12px; color: #FFFFFF; }
.Estilo14 {font-size: 12px}
-->
</style>
<link href="../../css/fondo.css" rel="stylesheet" type="text/css" />

<style type="text/css">
<!--
.Estilo17 {color: #000000}
-->
</style>
<table width="850" border="0">
  <tr bgcolor="#C9FADF">
    <td colspan="4" scope="col"><div align="center" class="Estilo7"><img src="../../imagenes/agendas.jpg" width="846" height="35"></div></td>
  </tr>
  <tr bgcolor="#000099">
    <td scope="col"><div align="center" class="Estilo6">Apellido y Nombre / Laboratorio </div>      <div align="center" class="Estilo6"></div></td>
    <td width="33%" scope="col"><div align="center" class="Estilo6">Domicilio</div></td>
    <td width="19%" scope="col"><div align="center" class="Estilo6">Departamento</div></td>
    <td width="15%" scope="col"><div align="center" class="Estilo6">Tel&eacute;fono</div></td>



<?php


include ("../../conexiones/config.inc.php");


 $sql = "SELECT * FROM `datos_laboratorio` order by email desc, nro_laboratorio";
$result = $db->Execute($sql);


 if (!$result) die("fallo".$db->ErrorMsg());
  while (!$result->EOF) {



 $nombre_laboratorio=ucwords($result->fields["nombre_laboratorio"]);
$nombre_laboratorio." (".$nro_laboratorio.")";


 $domicilio=ucwords($result->fields["domicilio"]);
 $departamento=ucwords($result->fields["departamento"]);
 $telefono=ucwords($result->fields["telefono"]);
 $email=$result->fields["email"];

$sql2 = "SELECT * FROM datos_personales where matricula = $nro_laboratorio";
$result2 = $db->Execute($sql2);

$estado=ucwords($result2->fields["estado"]);

if ($estado != "fallecido"){

?>
<tr>
    <td height="34" bordercolor="#E1F2EF" class="Estilo5 Estilo8" scope="col"><span class="Estilo7"><?php echo $nombre_laboratorio;?></span>  </td>
    <!--  <td scope="col"><?php echo $direccion;?></td> -->
    <td bordercolor="#E1F2EF" class="Estilo5" scope="col"><div align="center" class="Estilo11 Estilo14"><strong><?php echo $domicilio;?></strong></div></td>
    <td bordercolor="#E1F2EF" class="Estilo5" scope="col"><div align="center" class="Estilo11"><?php echo $departamento;?></div></td>
    <td bordercolor="#E1F2EF" class="Estilo5" scope="col"><div align="center" class="Estilo11"><?php echo $telefono;?></div></td>
  </tr>
<tr>
  <td height="21" colspan="4" bordercolor="#E1F2EF" class="Estilo13" scope="col"><div align="left"><span class="Estilo11 Estilo17">Mail: <?php echo $email;?></a></span></div></td>
  <td width="1%" bordercolor="#E1F2EF" class="Estilo5" scope="col">&nbsp;</td>
  </tr>
<tr>
  <td height="21" colspan="5" class="Estilo13" scope="col"><hr noshade> </td>
  </tr>

<?php 
}

$result->MoveNext();
	}

?>
</table>

