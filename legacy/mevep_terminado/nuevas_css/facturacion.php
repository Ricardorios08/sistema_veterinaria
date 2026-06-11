<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<!-- DW6 -->
<head>
<!-- Copyright 2005 Macromedia, Inc. All rights reserved. -->
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Bienvenidos a Asociación Cooperadora Hospital Central</title>
<link rel="stylesheet" href="emx_nav_left.css" type="text/css" />
<script type="text/javascript">
<!--
var time = 3000;
var numofitems = 7;

//menu constructor
function menu(allitems,thisitem,startstate){ 
  callname= "gl"+thisitem;
  divname="subglobal"+thisitem;  
  this.numberofmenuitems = allitems;
  this.caller = document.getElementById(callname);
  this.thediv = document.getElementById(divname);
  this.thediv.style.visibility = startstate;
}

//menu methods
function ehandler(event,theobj){
  for (var i=1; i<= theobj.numberofmenuitems; i++){
    var shutdiv =eval( "menuitem"+i+".thediv");
    shutdiv.style.visibility="hidden";
  }
  theobj.thediv.style.visibility="visible";
}
				
function closesubnav(event){
  if ((event.clientY <48)||(event.clientY > 107)){
    for (var i=1; i<= numofitems; i++){
      var shutdiv =eval('menuitem'+i+'.thediv');
      shutdiv.style.visibility='hidden';
    }
  }
}
// -->
</script>
</head>
<body onmousemove="closesubnav(event);">

<?php 



$id = $_REQUEST['cat1_ID'];


if ($id == ""){
exit;
}

include ("../conexiones/config_usu.php");
 $sql= "select * from usuario where id = '$id'" ;
$result = $db->Execute($sql);

$rol=strtoupper($result->fields["rol"]);
$programa=strtoupper($result->fields["programa"]);
$usuario=strtoupper($result->fields["usuario"]);
$id=strtoupper($result->fields["id"]);


?>

		

<div id="masthead">
  <h1 id="siteName">ASOCIACION COOPERADORA HOSPITAL CENTRAL </h1>
  <div id="globalNav"> <img alt="" src="gblnav_left.gif" height="32" width="4" id="gnl" /> <img alt="" src="glbnav_right.gif" height="32" width="4" id="gnr" />
    <div id="globalLink"> 

	<a href="../validar/usuarios/agenda2.php" target = 'izquierda' id="gl1" class="glink" onmouseover="ehandler(event,menuitem1);">AGENDA</a>
		<a href='../a_sectores/contaduria/plan_cuentas.php' target = 'izquierda' id="gl5" class="glink" onmouseover="ehandler(event,menuitem5);">CUENTAS </a>
		<a href='../a_sectores/contaduria/plan_cuentas.php' target = 'izquierda' id="gl5" class="glink" onmouseover="ehandler(event,menuitem5);">SUB CUENTAS </a>
	<a href='../a_sectores/contaduria/asientos.php' target = 'izquierda' id="gl4" class="glink" onmouseover="ehandler(event,menuitem4);">ASIENTOS</a>
	<a href='../a_sectores/contaduria/caja.php' target = 'izquierda' id="gl7" class="glink" onmouseover="ehandler(event,menuitem7);">CAJA Y BANCOS</a>
	<a href='../a_sectores/contaduria/balance.php' target = 'izquierda' id="gl7" class="glink" onmouseover="ehandler(event,menuitem7);">BALANCES Y CIERRES</a>
	<a href='../a_sectores/contaduria/mayores.php' target = 'izquierda' id="gl7" class="glink" onmouseover="ehandler(event,menuitem7);">MAYORES</a>
	<a href='../a_sectores/contaduria/balances.php' target = 'izquierda' id="gl7" class="glink" onmouseover="ehandler(event,menuitem7);">DIARIO GENERAL</a>

	<!-- <a href='../a_sectores/contaduria/recibos.php' target = 'izquierda' id="gl6" class="glink" onmouseover="ehandler(event,menuitem6);">RECIBOS</a>
	<a href='../a_sectores/administracion.php' target = 'izquierda'id="gl7" class="glink" onmouseover="ehandler(event,menuitem7);">MAESTROS</a> -->
</div>
	<!-- <a href='../a_sectores/contaduria/compras.php' target = 'izquierda' id="gl2" class="glink" onmouseover="ehandler(event,menuitem2);">COMPRAS</a>
	<a href='../a_sectores/contaduria/ventas.php' target = 'izquierda' id="gl3" class="glink" onmouseover="ehandler(event,menuitem3);">VENTAS</a>
 -->





    <!--end globalLinks-->
    <form id="search" action="">
      <input name="searchFor" type="text" size="10" />
      <a href="">Buscar</a>
    </form>
  </div>
  <!-- end globalNav -->
  <!-- <div id="subglobal1" class="subglobalNav"> <a href="#">subglobal1 link</a> | <a href="#">subglobal1 link</a> | <a href="#">subglobal1 link</a> | <a href="#">subglobal1 link</a> | <a href="#">subglobal1 link</a> | <a href="#">subglobal1 link</a> | <a href="#">subglobal1 link</a> </div>
  <div id="subglobal2" class="subglobalNav"> <a href="#">subglobal2 link</a> | <a href="#">subglobal2 link</a> | <a href="#">subglobal2 link</a> | <a href="#">subglobal2 link</a> | <a href="#">subglobal2 link</a> | <a href="#">subglobal2 link</a> | <a href="#">subglobal2 link</a> </div>
  <div id="subglobal3" class="subglobalNav"> <a href="#">subglobal3 link</a> | <a href="#">subglobal3 link</a> | <a href="#">subglobal3 link</a> | <a href="#">subglobal3 link</a> | <a href="#">subglobal3 link</a> | <a href="#">subglobal3 link</a> | <a href="#">subglobal3 link</a> </div>
  <div id="subglobal4" class="subglobalNav"> <a href="#">subglobal4 link</a> | <a href="#">subglobal4 link</a> | <a href="#">subglobal4 link</a> | <a href="#">subglobal4 link</a> | <a href="#">subglobal4 link</a> | <a href="#">subglobal4 link</a> | <a href="#">subglobal4 link</a> </div>
  <div id="subglobal5" class="subglobalNav"> <a href="#">subglobal5 link</a> | <a href="#">subglobal5 link</a> | <a href="#">subglobal5 link</a> | <a href="#">subglobal5 link</a> | <a href="#">subglobal5 link</a> | <a href="#">subglobal5 link</a> | <a href="#">subglobal5 link</a> </div>
  <div id="subglobal6" class="subglobalNav"> <a href="#">subglobal6 link</a> | <a href="#">subglobal6 link</a> | <a href="#">subglobal6 link</a> | <a href="#">subglobal6 link</a> | <a href="#">subglobal6 link</a> | <a href="#">subglobal6 link</a> | <a href="#">subglobal6 link</a> </div>
  <div id="subglobal7" class="subglobalNav"> <a href="#">subglobal7 link</a> | <a href="#">subglobal7 link</a> | <a href="#">subglobal7 link</a> | <a href="#">subglobal7 link</a> | <a href="#">subglobal7 link</a> | <a href="#">subglobal7 link</a> | <a href="#">subglobal7 link</a> </div>
  <div id="subglobal8" class="subglobalNav"> <a href="#">subglobal8 link</a> | <a href="#">subglobal8 link</a> | <a href="#">subglobal8 link</a> | <a href="#">subglobal8 link</a> | <a href="#">subglobal8 link</a> | <a href="#">subglobal8 link</a> | <a href="#">subglobal8 link</a> </div>
</div> -->
<!-- end masthead -->
<!--end pagecell1-->

  <div id="siteInfo"> <img src="" alt="" width="44" height="22" /> Usuario: <?php echo $usuario;?>  | Sector <?php echo $rol;?>  </div>
  



</div>

<br>


<div id="pagecell1"> 
<iframe src="marcos.php?palabra=<?php print("$palabra");?>&&variable=<?php print("$variable");?>" width="100%" height = "800"  frameborder="0"> </iframe>
</div>

  <div id="otro"> <img src="" alt="" width="44" height="22" />   &copy;2013 Ricardo Rios Sistemas</div>
  
<script type="text/javascript">
    <!--
      var menuitem1 = new menu(7,1,"hidden");
			var menuitem2 = new menu(7,2,"hidden");
			var menuitem3 = new menu(7,3,"hidden");
			var menuitem4 = new menu(7,4,"hidden");
			var menuitem5 = new menu(7,5,"hidden");
			var menuitem6 = new menu(7,6,"hidden");
			var menuitem7 = new menu(7,7,"hidden");
    // -->
    </script>
</body>
</html>
