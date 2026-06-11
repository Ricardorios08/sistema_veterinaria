 <?php 

 function CalculaEdad( $fecha ) {
    list($Y,$m,$d) = explode("-",$fecha);
    return( date("md") < $m.$d ? date("Y")-$Y-1 : date("Y")-$Y );
}

include("../../conexiones/config.inc.php");


$sql="select * from pacientes where nro_paciente like '$palabra'  or nro_documento like '%$palabra%' or  nro_afiliado like '%$palabra%'  order by nombre limit 1";
$result = $db->Execute($sql);

 if (!$result) die("fallo".$db->ErrorMsg());
  while (!$result->EOF) {

	
  $nombre=strtoupper($result->fields["nombre"]);
 


$result->MoveNext();
		}

