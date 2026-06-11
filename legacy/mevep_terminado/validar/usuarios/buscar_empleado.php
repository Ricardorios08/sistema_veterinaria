<style type="text/css">
<!--
.Estilo5 {font-family: Arial, Helvetica, sans-serif; font-size: 12px; }
.Estilo6 {color: #FFFFFF}
.Estilo7 {font-family: Arial, Helvetica, sans-serif}
.Estilo11 {font-family: Arial, Helvetica, sans-serif; font-size: 10px; }
.Estilo13 {font-family: Arial, Helvetica, sans-serif; font-size: 12px; color: #FFFFFF; }
.Estilo16 {font-family: Arial, Helvetica, sans-serif; color: #000000; }
-->
</style>
<link href="../../css/fondo.css" rel="stylesheet" type="text/css" />
  
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

$busqueda = "VARIOS";
switch ($busqueda){
	case "VARIOS":{


?>

<style type="text/css">
<!--
.Estilo18 {font-size: 12px}
.Estilo20 {font-size: 16px}
-->
</style>
<table width="850" border="0" cellspacing="0">
  <tr bgcolor="#C9FADF">
    <td colspan="11" scope="col"><div align="center" class="Estilo7"><img src="../../imagenes/agendas.jpg" width="846" height="35"></div></td>
  </tr>
  <tr bgcolor="#000099">
    <td width="17%" scope="col"><div align="center" class="Estilo6">Apellido</div></td>
    <td width="15%" scope="col"><div align="center" class="Estilo6">Nombre</div></td>
    <!-- <td width="9%" scope="col"><div align="center"><span class="Estilo5">Direccion</span></div></td> -->
    <td width="6%" scope="col"><div align="center" class="Estilo6">Telefono</div></td>
    <td width="6%" scope="col"><div align="center" class="Estilo6">Celular</div></td>
    <td width="7%" scope="col"><div align="center" class="Estilo6">Interno</div></td>
    <td width="12%" scope="col"><div align="center" class="Estilo6">Sector</div></td>
    <td width="12%" scope="col"><div align="center" class="Estilo6">Puesto</div></td>
    <td width="7%" scope="col"><div align="center" class="Estilo6">Cumple</div></td>


<?php if ($mod == "SI"){?>
    <td width="5%" scope="col"><div align="center" class="Estilo6">Mod</div></td>
    <td width="5%" scope="col"><div align="center" class="Estilo6">Borrar</div></td>
	<?php }?>
	<td width="5%" scope="col"><div align="center" class="Estilo6">Ficha</div></td>
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
	$sql = "SELECT * FROM `empleados` where apellido like '%$busca%' or nombre like '%$busca%' or puesto like '%$busca%' or sector like '%$busca%' or interno like '$busca%' order by apellido";
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
<tr>
    <td height="34" colspan="2" bordercolor="#E1F2EF" bgcolor="#FFFFFF" class="Estilo5 Estilo18" scope="col"><span class="Estilo7"><?php echo $apellido;?></span> <span class="Estilo7"><?php echo $nombre;?></span>
    <div align="center" class="Estilo7"></div></td>
    <!--  <td scope="col"><?php echo $direccion;?></td> -->
    <td bordercolor="#E1F2EF" bgcolor="#FFFFFF" class="Estilo5" scope="col"><div align="center" class="Estilo11 Estilo20"><strong><?php echo $telefono;?></strong></div></td>
    <td bordercolor="#E1F2EF" bgcolor="#FFFFFF" class="Estilo5" scope="col"><div align="center" class="Estilo5 Estilo18"><?php echo $celular;?></div></td>
    <td bordercolor="#E1F2EF" bgcolor="#FFFFFF" class="Estilo5" scope="col"><div align="center" class="Estilo11 Estilo18"><?php echo $interno;?></div></td>

    <td bordercolor="#E1F2EF" bgcolor="#FFFFFF" class="Estilo5" scope="col"><div align="center" class="Estilo11 Estilo18"><?php echo $sector;?></div></td>
	<td bordercolor="#E1F2EF" bgcolor="#FFFFFF" class="Estilo5" scope="col"><div align="center" class="Estilo11 Estilo18"><?php echo $puesto;?></div></td>
    <td bordercolor="#E1F2EF" bgcolor="#FFFFFF" class="Estilo5" scope="col"><div align="center" class="Estilo11 Estilo18"><?php echo $mes."/".$anio;?></div></td>
    

<?php if ($mod == "SI"){?>
    <td bordercolor="#E1F2EF" bgcolor="#FFFFFF" class="Estilo5" scope="col"><div align="center"><a href="entrada_empl_mod.php?id=<?php print("$id");?>" target="central"><IMG SRC="../../imagenes/office//027.ico" alt="Modificar" border = "0">
    </a></div></td>
    <td bordercolor="#E1F2EF" bgcolor="#FFFFFF" class="Estilo5" scope="col"><div align="center"><a href="borra.php?id=<?php print("$id");?>&&apellido=<?php print("$apellido");?>"><IMG SRC="../../imagenes/office//1047.ico" alt="Borrar" border = "0"></a> </div></td>
	<td bordercolor="#E1F2EF" bgcolor="#FFFFFF" class="Estilo5" scope="col"><div align="center"><a href="ficha.php?id=<?php print("$id");?>"><IMG SRC="../../imagenes/office//005.ico" alt="Ficha" border = "0"></a> </div></td>
<?php }else{?>
	<td width="3%" bgcolor="#FFFFFF" class="Estilo5" scope="col"><div align="center"><a href="usuarios/ficha.php?id=<?php print("$id");?>"><IMG SRC="../imagenes/office//005.ico" alt="Ficha" border = "0"></a> </div></td>
<?php }?>
  </tr>
<tr>
  <td height="21" colspan="5" bordercolor="#E1F2EF" bgcolor="#FFFFFF" class="Estilo13" scope="col"><div align="left"><span class="Estilo11"><span class="Estilo16"><?php echo $direccion;?></span></span></div></td>
  <td colspan="7" bordercolor="#E1F2EF" bgcolor="#FFFFFF" class="Estilo5" scope="col"><div align="left"><span class="Estilo11">
  
  <a href="mailto:<?php echo $email;?>?subject=Notificacion ABM">
<?php echo $email;?></a> 

</span></div></td>
  </tr>
<tr>
  <td height="21" colspan="12" class="Estilo13" scope="col"><hr noshade> </td>
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