var UltFec;

function objetoAjax(){
	var xmlhttp=false;
	try{
		xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
	}catch(e){
		try{
		   xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		}catch(E){
			xmlhttp = false;
  		}
	}

	if(!xmlhttp && typeof XMLHttpRequest!='undefined'){
		xmlhttp = new XMLHttpRequest();
	}
	return xmlhttp;
}

function enviarMensaje(){
	usu=document.nuevo_empleado.usuario.value;
	men=document.nuevo_empleado.mensaje.value;
	ajax=objetoAjax();
	ajax.open("POST", "registro.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			consultaMensajes();
			document.nuevo_empleado.mensaje.value="";
			document.nuevo_empleado.mensaje.focus();
		}
	}
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	ajax.send("usuario="+usu+"&mensaje="+men)
}



function consultaMensajes(){
	divResultado = document.getElementById('pagina');
	ajax=objetoAjax();
	ajax.open("GET", "consulta.php?ultfec="+UltFec,true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			//divResultado.innerHTML=ajax.responseText;
			var datos=ajax.responseXML.documentElement;
			for (i = 0; i < datos.getElementsByTagName('elemento').length; i++){
				var item = datos.getElementsByTagName('elemento')[i];
				var fec = item.getElementsByTagName('fecha')[0].firstChild.data;
				var usu = item.getElementsByTagName('usuario')[0].firstChild.data;
				var men = item.getElementsByTagName('mensaje')[0].firstChild.data;

				var linea='<div class="c_fecha">'+fec+'</div><div class="c_usuario">'+usu+'</div><div class="c_mensaje">'+men+'</div>';
				CrearCaja(linea);
			} 
			//si ultima fecha esta definida se usará
			//caso contrario se dejara con su valor anterior
			if(typeof fec!='undefined'){
				UltFec=fec;
			}
		}
		
	}
	ajax.send(null)
	//cada 3 segundos consulta por nuevos mensajes
	setTimeout('consultaMensajes();',3000);
}

window.onload = function (){
	consultaMensajes();
}