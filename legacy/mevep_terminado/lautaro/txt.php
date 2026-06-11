<?php
$nombre_archivo = 'prueba.txt';

include ("../conexiones/config_gb.php");

$sql="select * from confirmada";
$result = $db->Execute($sql);


 if (!$result) die("fallo".$db->ErrorMsg());
  while (!$result->EOF) {
$cod_grabacion=$result->fields["cod_grabacion"];

$sql1 = "SELECT * FROM `detalle`  WHERE `cod_grabacion` = cod_grabacion";
$result1 = $db->Execute($sql1);

 if (!$result1) die("fallo".$db->ErrorMsg());
  while (!$result1->EOF) {

$nro_laboratorio=$result1->fields["nro_laboratorio"];
$nro_orden=$result1->fields["nro_orden"];
$afiliado=$result1->fields["afiliado"];
$fecha=$result1->fields["fecha"];
$prescriptor=$result1->fields["prescriptor"];
$practica=$result1->fields["practica"];

$conte = $nro_laboratorio.",".$nro_orden.",".$afiliado.",".$fecha.",".$practica.",".$prescriptor;

$contenido = "$conte/n";

$sql = "INSERT INTO `para_cobol` ( `nro_laboratorio` , `nro_orden` , `afiliado` , `fecha` , `prescriptor` , `practica` ) VALUES ('$nro_laboratorio' , '$nro_orden' , '$afiliado' , '$fecha' , '$prescriptor' , '$practica')";
mysql_query($sql);



// Asegurarse primero de que el archivo existe y puede escribirse sobre el.
if (is_writable($nombre_archivo)) {

    // En nuestro ejemplo estamos abriendo $nombre_archivo en modo de adicion.
    // El apuntador de archivo se encuentra al final del archivo, asi que
    // alli es donde ira $contenido cuando llamemos fwrite().
    if (!$gestor = fopen($nombre_archivo, 'w')) {
         echo "No se puede abrir el archivo ($nombre_archivo)";
         exit;
    }

    // Escribir $contenido a nuestro arcivo abierto.
    if (fwrite($gestor, $contenido) === FALSE) {
        echo "No se puede escribir al archivo ($nombre_archivo)";
        exit;
    }
   
 echo "($contenido) al archivo ($nombre_archivo)";
   
    fclose($gestor);

} else {
    echo "No se puede escribir sobre el archivo $nombre_archivo";
}

$result1->MoveNext();
}


$result->MoveNext();
}

?> 