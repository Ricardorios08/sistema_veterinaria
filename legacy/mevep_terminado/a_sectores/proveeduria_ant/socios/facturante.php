<? 
$hoy=date("d/m/y");?>
<table width="104%">
<tr bgcolor="#000066">
  <td height="44" colspan="7"><div align="center"><font color="#FFFFFF" size="5">Listado de Cuentas / Laboratorios. Emitido el <?echo $hoy;?> </font></div></td>
  </tr>
<tr bgcolor="#DAFAFC"><td width="34%"><div align="center"><font color="#000000" size="1" face="Arial, Helvetica, sans-serif">CUENTA / LABORATORIO</font></div>  </td>
<td width="36%"><div align="center"><font color="#000000" size="1" face="Arial, Helvetica, sans-serif">DOMICILIO</font></div></td>
<td width="8%"><div align="center"><font color="#000000" size="1" face="Arial, Helvetica, sans-serif">LOCALIDAD</font></div></td>
<td width="4%"><div align="center"><font color="#000000" size="1" face="Arial, Helvetica, sans-serif">TEL.</font></div></td>
<?if ($a != 1){?>
<td width="5%"><div align="center"><font color="#006633" size="1" face="Arial, Helvetica, sans-serif">MOD.</font></div></td>
<?}?>
<td width="8%"><div align="center"><font color="#006633" size="1" face="Arial, Helvetica, sans-serif">FICHA</font></div></td>

</tr>	
<?

 include("adodb.inc.php");
 $db = NewADOConnection('mysql');
 $db->Connect("localhost", "root", "", "bioquimica");
$palabra;
if ($palabra=="")
{
$sql= "SELECT bioquimica.datos_laboratorio.nro_laboratorio, bioquimica.datos_laboratorio.domicilio, bioquimica.datos_laboratorio.departamento, bioquimica.datos_laboratorio.nombre_laboratorio, bioquimica.datos_laboratorio.domicilio, bioquimica.datos_laboratorio.telefono, bioquimica.facturante.facturante FROM bioquimica.datos_laboratorio INNER JOIN bioquimica.facturante ON bioquimica.datos_laboratorio.nro_laboratorio = bioquimica.facturante.nro_laboratorio WHERE bioquimica.facturante.facturante = 'SI'  ORDER BY bioquimica.datos_laboratorio.departamento,bioquimica.datos_laboratorio.nombre_laboratorio,bioquimica.datos_laboratorio.domicilio";
}else{
$sql="select * from datos_laboratorio where nro_laboratorio like '%$palabra%' or nombre_laboratorio like '%$palabra%' or matricula like '%$palabra%' ";
}

$result = $db->Execute($sql);
 
  if (!$result) die("fallo".$db->ErrorMsg());
  while (!$result->EOF) {

	

$nro_laboratorio=$result->fields["nro_laboratorio"];

$sql2="select * from datos_laboratorio where nro_laboratorio = '$nro_laboratorio'";
	$result2 = $db->Execute($sql2);

$nombre_lab=strtoupper($result2->fields["nombre_laboratorio"]);
$nombre_lab=substr($nombre_lab,0,22);
$domicilio_lab=strtoupper($result2->fields["domicilio"]);
$nro_dom_lab=$result2->fields["nro_domicilio"];
$direccion = $domicilio_lab."  ".$nro_dom_lab;
$localidad_lab=strtoupper($result2->fields["departamento"]);


$telefono=$result2->fields["telefono"];
/*if (strlen($telefono) == 7){
$telefono = "4".$telefono;
}
*/
if (strlen($telefono) == 6){
$telefono = "4".$telefono;
}



if ($telefono == 0){$telefono = "-";}



	
	if ($B == 1) {

?><tr bordercolor="#FFFFCC" bgcolor="#E6E6E6"> <?

			}




		?>
		     <td height="20"><font size="1" face="Arial, Helvetica, sans-serif">(<?print("$nro_laboratorio");?>) <?print("$nombre_lab");?></font></td>
     <td><font size="1" face="Arial, Helvetica, sans-serif"><?print("$direccion");?></font></td>
     <td><font size="1" face="Arial, Helvetica, sans-serif"><?print("$localidad_lab");?></font></td>
    <td><font size="1" face="Arial, Helvetica, sans-serif"><?print("$telefono");?></font></td>
<?if ($a != 1){?>
	<td> <div align="center"><font size="1" face="Arial, Helvetica, sans-serif"><a href="socios/modificar.php?id=<?print("$nro_laboratorio");?>" target="central"><IMG SRC="../../imagenes/office//027.ico" alt="Modificar" border = "0">
    </a> </font></div></td>
		<?}?>

<?if ($a != 1){?>
		<td><div align="center"><font size="1" face="Arial, Helvetica, sans-serif"><a href="../secretaria/a_cuentas/ficha.php?id=<?print("$nro_laboratorio");?>"><IMG SRC="../../imagenes/office//005.ico" alt="Ficha" border = "0"></a></font></div></td>
		

					<?}else{?>
		<td><div align="center"><font size="1" face="Arial, Helvetica, sans-serif"><a href="../a_sectores/secretaria/a_cuentas/ficha.php?id=<?print("$nro_laboratorio");?>"><IMG SRC="../imagenes/office//005.ico" alt="Ficha" border = "0"></a></font></div></td>
		
	<?	}?>	
  </tr>
<?

$result->MoveNext();
	}

?>
</table>
