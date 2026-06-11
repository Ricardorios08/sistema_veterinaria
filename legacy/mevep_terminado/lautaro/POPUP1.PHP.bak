</head >
<body >
<FORM name="formu" ACTION="<?php echo $_SERVER["PHP_SELF"];?>" METHOD = "POST">
<input type="text" name="buscar" id="buscar" size = '10' value=""/>

<input type="submit" name="Alta" id="datos" size = '10' value="OK">



<?
		if(isset($_REQUEST['Alta'])) {
	
	switch ($_REQUEST['Alta'])
	{
		case "OK":
				{
		 $buscar=$_REQUEST["buscar"];

include ("../conexiones/config_os.php");
$sql="select * from datos_os where nro_os = '$buscar'";
$result = $db->Execute($sql);
$sigla=strtoupper($result->fields["sigla"]);

?>
<form name="formulario" action="">
<input type="text" name="datos" id="datos" size = '10' value="<?echo $sigla;?>">
</form><?
?>
<a href="JavaScript:close();" title="pasar valor" onClick="window.opener.document.formulario.resultado.value = window.document.formu.datos.value;" >Pasar valor</a><?
break;
				}
	}
}


?>



<!-- <a href="JavaScript:close();" title="pasar valor" onClick="window.opener.document.formulario.resultado.value = window.document.formu.datos.value;" >Pasar valor a ventana padre</a> -->
</body>
</html>