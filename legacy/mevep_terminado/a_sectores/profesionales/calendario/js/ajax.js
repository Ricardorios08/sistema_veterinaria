function objetoAjax(){
	var xmlhttp=false;
	try {
		xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
	} catch (e) {
		try {
		   xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		} catch (E) {
			xmlhttp = false;
  		}
	}

	if (!xmlhttp && typeof XMLHttpRequest!='undefined') {
		xmlhttp = new XMLHttpRequest();
	}
	return xmlhttp;
}

function enviarDatosEmpleado(){
	//donde se mostrará lo resultados
	divFormulario 	=	document.getElementById('mensaje');
	
	//valores de los inputs
	idmensaje				=	document.frmmensaje.idmensaje.value;
	
	//instanciamos el objetoAjax
	ajax=objetoAjax();
	//usando del medoto POST
	//CARGAMOS LA IMAGENS QUE MOSTRARA MIENTRAS RESPONDE EL SERVIDOR.
	divFormulario.innerHTML = '<center><img src="images/cargando.gif"></center><br />';
	//archivo que realizará la operacion
	//actualizacion.php
	ajax.open("POST", "actualizacion.php",true);
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			//mostrar los nuevos registros en esta capa
			//divResultado.innerHTML = ajax.responseText
			//mostrar un mensaje de actualizacion correcta
			//alert("Actualizado correctamente");
			//divFormulario.innerHTML = "<center><p style=\"border:1px solid red; width:400px;\">Ahora, puede seleccionar articulo...</p></center>";
			divFormulario.style.display="none"; 
		}
	}
	//muy importante este encabezado ya que hacemos uso de un formulario
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("idmensaje="+idmensaje);
}

function pedirDatosSalida(idmensaje,idorigen){
	//donde se mostrarán los datos
	divFormulario = document.getElementById('mensaje');
	
	//instanciamos el objetoAjax
	ajax=objetoAjax();
	//CARGAMOS LA IMAGENS QUE MOSTRARA MIENTRAS RESPONDE EL SERVIDOR.
	divFormulario.innerHTML = '<center><img src="images/cargando.gif"></center><br />';
	//uso del medotod GET
	ajax.open("POST", "consulta_por_id2.php");
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			//mostrar resultados en esta capa
			divFormulario.innerHTML = ajax.responseText
			//mostrar el formulario
			divFormulario.style.display="block";
		}
	}
	//como hacemos uso del metodo GET
	//colocamos null
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("idmensaje="+idmensaje+"&idorigen="+idorigen)
}

function pedirDatos(idmensaje){
	//donde se mostrarán los datos
	divFormulario = document.getElementById('mensaje');
	
	//instanciamos el objetoAjax
	ajax=objetoAjax();
	//CARGAMOS LA IMAGENS QUE MOSTRARA MIENTRAS RESPONDE EL SERVIDOR.
	divFormulario.innerHTML = '<center><img src="images/cargando.gif"></center><br />';
	//uso del medotod GET
	ajax.open("POST", "consulta_por_id.php");
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			//mostrar resultados en esta capa
			divFormulario.innerHTML = ajax.responseText
			//mostrar el formulario
			divFormulario.style.display="block";
		}
	}
	//como hacemos uso del metodo GET
	//colocamos null
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("idmensaje="+idmensaje);
}

function borrarmensaje(idmensaje,idotromensaje,tipo){
	//donde se mostrarán los datos
	divFormulario = document.getElementById('mensaje');
	
	//instanciamos el objetoAjax
	ajax=objetoAjax();
	//CARGAMOS LA IMAGENS QUE MOSTRARA MIENTRAS RESPONDE EL SERVIDOR.
	divFormulario.innerHTML = '<center><img src="images/eliminando.gif"></center><br />';
	//uso del medotod GET
	ajax.open("POST", "consulta_por_id3.php");
	ajax.onreadystatechange=function() {
		if (ajax.readyState==4) {
			//mostrar resultados en esta capa
			divFormulario.innerHTML = ajax.responseText
			//mostrar el formulario
			divFormulario.style.display="block";
		}
	}
	//como hacemos uso del metodo GET
	//colocamos null
	ajax.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	//enviando los valores
	ajax.send("idmensaje="+idmensaje+"&idotromensaje="+idotromensaje+"&tipo="+tipo);
}