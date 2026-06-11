<?php

//trae variables de factura
$nro_factura= $_REQUEST['nro_factura'];
$fact =$_REQUEST['fact'];
$tipo_fact =$_REQUEST['tipo_fact'];
$cuit= $_REQUEST['cuit'];
$direccion= strtoupper($_REQUEST['direccion']);
$nro_factura_nuevo= $_REQUEST['nro_factura_nuevo'];
$fact_nuevo= strtoupper($_REQUEST['fact_nuevo']);


if (($nro_factura_nuevo != "") && ($fact_nuevo != "")) {$caso = 1;}
if (($nro_factura_nuevo != "") && ($fact_nuevo == "")) {$caso = 2;}
if (($nro_factura_nuevo == "") && ($fact_nuevo != "")) {$caso = 3;}
if (($nro_factura_nuevo == "") && ($fact_nuevo == "")) {$caso = 4;}

switch ($caso)      {
						case "1":{$fact = $fact_nuevo;$nro_factura = $nro_factura_nuevo;break;}
						case "2":{$nro_factura = $nro_factura_nuevo;break;}
						case "3":{$fact = $fact_nuevo;break;	}
						case "4":{break;}
					}


$empresa = "FRANCISCO M. LOPEZ";


// trae los datos del encabezado de la tabla temporal de encabezado
include("../../../conexiones/config_pro.php");
$sql2 = "SELECT * FROM `ventas1_encab_temp`  WHERE  `nro_factura` = $nro_factura and tipo_fact = '$fact'";
$result2 = $db->Execute($sql2);

$nro_cliente=strtoupper($result2->fields["nro_cliente"]);
$nro_cuenta=strtoupper($result2->fields["nro_cuenta"]);
$cod_operacion=strtoupper($result2->fields["cod_operacion"]);

$plan=strtoupper($result2->fields["plan"]);
$operador=strtoupper($result2->fields["operador"]);
$denominacion=strtoupper($result2->fields["denominacion"]);
$fecha=strtoupper($result2->fields["fecha"]);
$forma_pago=strtoupper($result2->fields["forma_pago"]);
$porc_dto=strtoupper($result2->fields["porc_dto"]);
$tipo_iva=strtoupper($result2->fields["tipo"]);


include ("lx300.php");

$err = IF_SERIAL("27-0163848-435"); // aca me da este error cuando pongo la serial

$port = IF_OPEN("COM2",9600);

  if ( $port == -1) {   echo "impresorass ocupada";   return;  }
$err = IF_WRITE("@PONEENCABEZADO|$nro_factura|FACTURA B");

  
// abre factura

 $err = IF_WRITE("@FACTABRE|F|S|C|2|F|10|M|F|juan perz|abogado|DNI|28172981|N|lAMADRID 564|CIUDAD MENDOZA|C");
   
  


switch ($tipo_iva){
	case "1":{
$tipo_fact = "Responsable Inscripto";
$fact = "A";
		break;
	}

	case "4":{
$tipo_fact = "Exento";
$fact = "B";
		break;
	}

		case "3":{
$tipo_fact = "Monotributo";
$fact = "B";
		break;
	}

		
}




if ($nro_cliente != 0){
$tipo_cuenta = "2"; //tipo 1 externo;
$leyenda1 = "";
$nro = $nro_cliente;
}
elseif ($nro_cuenta != 0){
$tipo_cuenta = "1"; //tipo 1 asociado;
$leyenda1 = "";
if ($forma_pago == 'CTA/CTE'){
$leyenda3 = "";
$leyenda4 = "";

}
$nro = $nro_cuenta;
}

switch ($tipo_precio){
case "1":{
$tipo_precio_ver = "EMPRESAS";
break;
}
case "2":{
$tipo_precio_ver = "REGALERIAS";
break;
}
case "3":{
$tipo_precio_ver = "POR MENOR";
break;
}
}

// trae los datos del detalle de la tabla temporal de detalle


$sql6 = "SELECT * FROM `ventas1_encab_temp`  WHERE  `nro_factura` = $nro_factura";
$result6 = $db->Execute($sql6);
$forma_pago=strtoupper($result6->fields["forma_pago"]);
$porc_dto=strtoupper($result6->fields["porc_dto"]);
$tipo_fact=strtoupper($result6->fields["tipo_fact"]);


$sql3 = "SELECT * FROM `ventas1_deta_temp`  WHERE  `nro_factura` = $nro_factura order by cod_detalle desc";
$result3 = $db->Execute($sql3);
?>
<table width="700" border="0">
  <tr bgcolor="#FFFFFF" class="Estilo26">
    <td scope="col">&nbsp;</td>
    <td scope="col">&nbsp;</td>
    <td scope="col">&nbsp;</td>
    <td scope="col">&nbsp;</td>
    <td scope="col">&nbsp;</td>
  </tr>
  <tr bgcolor="#FFFFFF" class="Estilo26">
    <td width="5%" scope="col"><div align="center" class="Estilo2 Estilo1 Estilo77 Estilo16">N&ordm;</div></td>
    <td width="48%" scope="col"><div align="center" class="Estilo2 Estilo1 Estilo77 Estilo16"></div>      <div align="center" class="Estilo3 Estilo77 Estilo16"><span class="Estilo46">Descripcion / Mercaderia</span></div></td>
   
    <td width="6%" scope="col"><div align="center" class="Estilo2 Estilo1 Estilo77 Estilo16"><span class="Estilo46">Cant.</span></div></td>
    <td width="9%" scope="col"><div align="center" class="Estilo16"><span class="Estilo2 Estilo1 Estilo77"><span class="Estilo46">Unit</span></span></div></td>
    <td width="10%" scope="col"><div align="center" class="Estilo2 Estilo1 Estilo77 Estilo16"><span class="Estilo46">Total</span></div></td>
    
  </tr><?

if (!$result3) die("fallo".$db->ErrorMsg());

 while (!$result3->EOF) {
$renglon = $renglon + 1;

$cod_mercaderia=strtoupper($result3->fields["cod_mercaderia"]);
$cantidad=strtoupper($result3->fields["cantidad"]);
$descripcion=strtoupper($result3->fields["descripcion"]);
$cod_detalle=$result3->fields["cod_detalle"];
$precio_unitario=$result3->fields["precio_unitario"];
$precio_sin_iva = $precio_unitario;
$iva=$result3->fields["lote"];
$tasa_iva=$result3->fields["presentacion"];


///calcula precio por renglon + iva
$iva_renglon =  round(($precio_unitario * $tasa_iva/100),3);
$precio_unitario = $precio_unitario + $iva_renglon;
$total = round($precio_unitario * $cantidad,3);
$total_a = round($precio_sin_iva * $cantidad,3);

$acu_iva = $iva_renglon * $cantidad;
$total_iva = $total_iva + $acu_iva;



$suma_total = $suma_total + $total_a;
$desc_factura = round(($suma_total * $porc_dto)/100,2);
$subtotal = $suma_total - $desc_factura; // neto gravado
$total_factura = $subtotal + $total_iva;

$suma_total_b = $suma_total_b + $total;
$desc_factura_b = ($suma_total_b * $porc_dto)/100;
$subtotal_b = $suma_total_b - $desc_factura_b; // neto gravado
$total_factura_b = $subtotal_b;


$producto = $cod_mercaderia." ".$descripcion;
$cont = $cont + 1;

$tasa = ($tasa_iva / 100);


///Envia renglon a impresora fiscal
    $err = IF_WRITE("@FACTITEM|$producto|$cantidad|$precio_sin_iva|$tasa|M|1|0||||0.0000|0");



	 $result3->MoveNext();
				}

  //**   HAGO UN DESCUENTO
  $err = IF_WRITE("@FACTPAGO|DESCUENTO $porc_dto|$desc_factura_b|D");
  $err = IF_WRITE("@FACTPAGO|PAGO|total_factura_b|T");
  $err = IF_WRITE("@FACTCIERRA|F|A|FINAL");
  

 //** si hay error cancelar la factura
 $nfactura =  IF_READ(3);
 $err =IF_CLOSE();


$sumatoria = $cont;
$cont = 0;

$sumatoria = 0;


$total_factura = 0;
$neto = 0;
$iva = 0;
$sumatoria = $cont;
$cont = 0;
$sumatoria = 0;
?>


   