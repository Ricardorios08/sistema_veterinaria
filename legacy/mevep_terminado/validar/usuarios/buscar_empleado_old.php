<style type="text/css">
<!--
.Estilo5 {font-family: Arial, Helvetica, sans-serif; font-size: 12px; }
.Estilo6 {color: #FFFFFF}
.Estilo7 {font-family: Arial, Helvetica, sans-serif}
.Estilo8 {font-size: 10px}
.Estilo11 {font-family: Arial, Helvetica, sans-serif; font-size: 10px; }
-->
</style>

  
<?php 
$buscador_rapido=$_POST["buscador_rapido"];
$B= 1;
$busqued=$_POST["busqueda"];
	for ($i=0;$i<count($busqued);$i++)    
	{     
$busqueda = $busqued[$i];    
	}




$mod=$_POST["mod"];
$busca=$_POST["busca"];
$palabra = $busca;
switch ($busqueda){
	case "VARIOS":{


?>

<table width="111%" border="0">
  <tr bgcolor="#C9FADF">
    <td colspan="11" scope="col"><div align="center" class="Estilo7">Agenda de la Asociaci&oacute;n Bioqu&iacute;mica de Mendoza </div></td>
  </tr>
  <tr bgcolor="#000099">
    <td width="13%" scope="col"><div align="center" class="Estilo6"><span class="Estilo5">Apellido</span></div></td>
    <td width="15%" scope="col"><div align="center" class="Estilo6"><span class="Estilo5">Nombre</span></div></td>
    <!-- <td width="9%" scope="col"><div align="center"><span class="Estilo5">Direccion</span></div></td> -->
    <td width="6%" scope="col"><div align="center" class="Estilo6"><span class="Estilo5">Telefono</span></div></td>
    <td width="8%" scope="col"><div align="center" class="Estilo6"><span class="Estilo5">Celular</span></div></td>
    <td width="5%" scope="col"><div align="center" class="Estilo6"><span class="Estilo5">Interno</span></div></td>
    <td width="13%" scope="col"><div align="center" class="Estilo6"><span class="Estilo5">Sector</span></div></td>
    <td width="18%" scope="col"><div align="center" class="Estilo6"><span class="Estilo5">Puesto</span></div></td>
    <td width="7%" scope="col"><div align="center" class="Estilo6"><span class="Estilo5">Cumple</span></div></td>


<?php if ($mod == "SI"){?>
    <td width="5%" scope="col"><div align="center" class="Estilo6"><span class="Estilo5">Mod</span></div></td>
    <td width="5%" scope="col"><div align="center" class="Estilo6"><span class="Estilo5">Borrar</span></div></td>
	<?php }?>
	<td width="5%" scope="col"><div align="center" class="Estilo6"><span class="Estilo5">Ficha</span></div></td>
  </tr>
  	<?php 


if ($buscador_rapido == 2){
	include ("../../conexiones/config.inc.php");
}else{
	include ("../conexiones/config.inc.php");
}

if ($busca == ""){
 $sql = "SELECT * FROM `empleados` order by apellido";
}
else{
	$sql = "SELECT * FROM `empleados` where apellido like '$busca%' or nombre like '$busca%' or puesto like '$busca%' or sector like '$busca%' order by apellido";
}


$result = $db->Execute($sql);
 if (!$result) die("fallo".$db->ErrorMsg());
  while (!$result->EOF) {

$id=$result->fields["id"];
$nombre=strtoupper($result->fields["nombre"]);
$apellido=strtoupper($result->fields["apellido"]);
$direccion=strtoupper($result->fields["direccion"]);
$telefono=$result->fields["telefono"];
$celular =strtoupper($result->fields["celular"]);
$email=$result->fields["email"];
$interno=strtoupper($result->fields["interno"]);
$sector=strtoupper($result->fields["sector"]);
$puesto=strtoupper($result->fields["puesto"]);
$mes=strtoupper($result->fields["mes"]);
$anio=strtoupper($result->fields["anio"]);

?>
<tr bgcolor="#E1F2EF">
    <td height="34" bgcolor="#E1F2EF" class="Estilo5 Estilo8" scope="col"><span class="Estilo7"><?php echo $apellido;?></span>      <div align="center" class="Estilo7"></div></td>
    <td bgcolor="#E1F2EF" class="Estilo11" scope="col"><span class="Estilo7"><?php echo $nombre;?></span>
      <div align="center" class="Estilo7"></div></td>
   <!--  <td scope="col"><?php echo $direccion;?></td> -->
    <td bgcolor="#E1F2EF" class="Estilo5" scope="col"><div align="center" class="Estilo11"><?php echo $telefono;?></div></td>
    <td bgcolor="#E1F2EF" class="Estilo5" scope="col"><div align="center" class="Estilo11"><?php echo $celular;?></div></td>
    <td bgcolor="#E1F2EF" class="Estilo5" scope="col"><div align="center" class="Estilo11"><?php echo $interno;?></div></td>

    <td bgcolor="#E1F2EF" class="Estilo5" scope="col"><div align="center" class="Estilo11"><?php echo $sector;?></div></td>
	<td bgcolor="#E1F2EF" class="Estilo5" scope="col"><div align="center" class="Estilo11"><?php echo $puesto;?></div></td>
    <td bgcolor="#E1F2EF" class="Estilo5" scope="col"><div align="center" class="Estilo11"><?php echo $mes."/".$anio;?></div></td>
    

<?php if ($mod == "SI"){?>
    <td class="Estilo5" scope="col"><div align="center"><a href="entrada_empl_mod.php?id=<?php print("$id");?>" target="central"><IMG SRC="../../imagenes/office//027.ico" alt="Modificar" border = "0">
    </a></div></td>
    <td class="Estilo5" scope="col"><div align="center"><a href="borra.php?id=<?php print("$id");?>&&apellido=<?php print("$apellido");?>"><IMG SRC="../../imagenes/office//1047.ico" alt="Borrar" border = "0"></a> </div></td>
	<td class="Estilo5" scope="col"><div align="center"><a href="ficha.php?id=<?php print("$id");?>"><IMG SRC="../../imagenes/office//005.ico" alt="Ficha" border = "0"></a> </div></td>
<?php }else{?>
	<td class="Estilo5" scope="col"><div align="center"><a href="usuarios/ficha.php?id=<?php print("$id");?>"><IMG SRC="../imagenes/office//005.ico" alt="Ficha" border = "0"></a> </div></td>
<?php }?>

  </tr>

<?php 
$result->MoveNext();
	}

?>
</table>

<?php break;
	}
	
	case "OBRA":{
	include ("../../a_sectores/secretaria/a_obras sociales/os_agenda.php");
	BREAK;
	}

case "BIOQUIMICOS":{
	$no_borrar = "SI";
	include("../../a_sectores/secretaria/a_bioquimicos/buscar_bioquimicos1.php");
	BREAK;
	}

case "CUENTAS":{
		$no_borrar = "SI";
	include ("../../a_sectores/secretaria/a_cuentas/laboratorio_agenda.php");
	BREAK;
	}
	}?>