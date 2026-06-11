<?$handle = printer_open("Brother HL-6050D/DN series");
printer_start_doc($handle, "Mi Documento");
printer_start_page($handle);
$font = printer_create_font("Arial",55,30,400,false,false, false,0);
printer_select_font($handle, $font);
$mostrar="ESTOY TRATANDO DE HACER FUNCIONAR ESTA COSA...";
$mostrar2= "Sigo intentando, pero en la otra linea";
printer_draw_text($handle,$mostrar,50,400);
printer_draw_text($handle,$mostrar2,50,900);
printer_delete_font($font);
printer_end_page($handle);
printer_end_doc($handle);
printer_close($handle);
?>