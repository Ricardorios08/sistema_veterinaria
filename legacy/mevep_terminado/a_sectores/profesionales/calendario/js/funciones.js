// JavaScript Document

/********************************************************************************************/
//OTRAS FUNCIONES DEL FORMULARIO
//<a href="javascript:document.FORM.CAJA.focus()">focus in the box</a> <!--MANDA EL FOCO A LA CAJA DE TEXTO-->
/********************************************************************************************/

/*
	//INCLUIR EL ARCHIVO EN TODO EL PROYECTO**********************************************
	<script language="javascript" src="funciones.js"></script>
	
	ALERTAS DEL SISTEMA 
	EJEMPLO DE USO:
	msj(this.form.texto.value)******************************************************************
*/
	function msj(cadena){
		alert(cadena);
	}
/*VALIDA SOLO NUMEROS SIN PUNTO DECIMAL**************************************************/
function solonumeros(e){
		var key;
			if(window.event) {
				// IE 
			 	key = e.keyCode;
 			}
  			else if(e.which){ 
				// Netscape/Firefox/Opera
				key = e.which;
 			}
		if(key==8){
			return true;
		}
		if (key < 48 || key > 57 ) {
    		//si es falso
			return false;
		}
}
 
/*VALUDA NUMEROS CON SOLO 1 PUNTO DECIMAL************************************************
	EJEMPLO DE USO:
		onKeypress="return NumCheck(event, this)"
*/
function NumCheck(e, field) {
  key = e.keyCode ? e.keyCode : e.which

  // backspace
  if (key == 8) return true
  
  // 0-9
  if (key > 47 && key < 58) {

    if (field.value == "") return true
    
    regexp ='/,[0-9]{2}$/';
    return !(regexp.test(field.value))
  }

  // .
  if (key == 46) {
  
    if (field.value == "") return false
    
    regexp = /^[0-9]+$/
    return regexp.test(field.value)
  }
  
  // other key
  return false

}

/*FORMATEANDO NUMERO CON COMAS PARA CANTIDADES *****************************************
	EJEMPLO DE USO: 
	 onblur="this.value=this.form.CAJA.value=commaSplit(this.form.CAJA.value)"
*/
function commaSplit(srcNumber) {
	var txtNumber = '' + srcNumber;
	if (isNaN(txtNumber) || txtNumber == "") {
		alert("Eso no parece ser un numero valido. Por favor, prueba de nuevo.");
			fieldName.select();
			fieldName.focus();
	}
	else {
		var rxSplit = new RegExp('([0-9])([0-9][0-9][0-9][,.])');
		var arrNumber = txtNumber.split('.');
			arrNumber[0] += '.';
	do {
		arrNumber[0] = arrNumber[0].replace(rxSplit, '$1,$2');
	} while (rxSplit.test(arrNumber[0]));
	if (arrNumber.length > 1) {
		return arrNumber.join('');
	}
	else {
		return arrNumber[0].split('.')[0];
		  }
	   }
}


/* ELIMINAR ESPACIOS DE UNA CADENA DE TEXTO *******************************************************
	EJEMPLO DE USO:
	onkeyup="this.value=ignoreSpaces(this.value);"
*/
function ignoreSpaces(string) {
	var temp = "";
	string = '' + string;
	splitstring = string.split(" ");
	for(i = 0; i < splitstring.length; i++)
		temp += splitstring[i];
	return temp;
}

/*CONVERSION DE CADENA A MAYUSCULAS***********************************************************/
/*ESTA FUNCION ESTA PROGRAMADA POR METODO PERO HAY OTRA OPCION
	EJEMPLO: 
		onkeyup="javascript:this.value=this.value.toUpperCase();"
*/
function pasarMayusculas(cadena) {
    	var result="";
	    var str = cadena.split('');
 		    for(i=0; i<=str.length-1; i++) {
        		str[i] = str[i].toUpperCase();
		        result+=str[i];
    		}	
		return(result);
		//alert(result);
}

/*COMPARANDO FECHAS - CUAL ES MAYOR Y CUAL ES MENOR ***********************************************
	EJEMPLO PARA USARLO:
	
		fecha1=this.document.getElementById("finicio").value;
		fecha2=this.document.getElementById("ffin").value;
		if (compare_dates(fecha1, fecha2)){  
		  alert("La fecha de inicio de publucacion es mayor a la fecha de termino de la publicacion \n por favor verifique estos datos antes de continuar");  
		  return false;
		}else{  
			return true;
		}  
*/
function compare_dates(fecha, fecha2) {  
		var xMonth=fecha.substring(3, 5);  
		var xDay=fecha.substring(0, 2);  
		var xYear=fecha.substring(6,10);  
		var yMonth=fecha2.substring(3, 5);  
		var yDay=fecha2.substring(0, 2);  
		var yYear=fecha2.substring(6,10);  
		if (xYear> yYear)  
		{  
			return(true)  
		}  
		else  
		{  
		  if (xYear == yYear)  
		  {   
			if (xMonth> yMonth)  
			{  
				return(true)  
			}  
			else  
			{   
			  if (xMonth == yMonth)  
			  {  
				if (xDay> yDay)  
				  return(true);  
				else  
				  return(false);  
			  }  
			  else  
				return(false);  
			}  
		  }  
		  else  
			return(false);  
		}  
}  

/*ABRIENDO LAS PANTALLAS DEL SISTEMA CON JAVASCRIPT PARA EVITAR MENUS Y BARRAS DE DESPLAZAMIENTO ademas de evitar el bloqueo del explorador*/
function abrir(direccion, pantallacompleta, herramientas, direcciones, estado, barramenu, barrascroll, cambiatamano, ancho, alto, izquierda, arriba, sustituir){ 
 	   var opciones = "fullscreen=" + pantallacompleta + 
                 ",toolbar=" + herramientas + 
                 ",location=" + direcciones + 
                 ",status=" + estado + 
                 ",menubar=" + barramenu + 
                 ",scrollbars=" + barrascroll + 
                 ",resizable=" + cambiatamano + 
                 ",width=" + ancho + 
                 ",height=" + alto + 
                 ",left=" + izquierda + 
                 ",top=" + arriba; 
     var ventana = window.open(direccion,"ventanasolutek",opciones,sustituir); 
}

function otraventana(direccion, pantallacompleta, herramientas, direcciones, estado, barramenu, barrascroll, cambiatamano, ancho, alto, izquierda, arriba, sustituir){ 
 	   var opciones = "fullscreen=" + pantallacompleta + 
                 ",toolbar=" + herramientas + 
                 ",location=" + direcciones + 
                 ",status=" + estado + 
                 ",menubar=" + barramenu + 
                 ",scrollbars=" + barrascroll + 
                 ",resizable=" + cambiatamano + 
                 ",width=" + ancho + 
                 ",height=" + alto + 
                 ",left=" + izquierda + 
                 ",top=" + arriba; 
     var ventana = window.open(direccion,"ventanarefacciones",opciones,sustituir); 
}

// JavaScript Document
//INSERCION SQL
function alfanumerico(evt){
	    var key;
		if(window.event) {
			// VALIDAMOS SI ES IE 
		 	key = evt.keyCode;
 		}
  		else if(evt.which){ 
			//SI NO QUIERE DECIR QUE ES -> Netscape/Firefox/Opera
			key = evt.which;
 		}
		
		if(key==8 || key==32 || key==241 || key==209){
				//key=8 -> backspace
				//jey=32 espacio
				//key=241 &ntilde; 
				//key=209 &Ntilde;
				//VALIDAMOS EL RETROCESO O BACKSPACE Y ESPACIOS
			return true;
		}
		
		if(key>41 && key<44 || key==231 || key==199 || key==94){
			return false;
		}
		
		if(key>64&&key<91 || key>96 && key<123 || key>47 && key<58){
			//VALIDAMOS LETRAS MAYUSCULAS >64 Y <91
			//VALIDAMOS LETRAS MINUSCULAS >96 Y <123
			//VALIDAMOS LOS NUMEROS DEL 0 AL 9 >47<58
			return true;
		}
		else{
		    return false;
		}
}
/*BLOQUEA LA TECLA CONTROL
	EJEMPLO DE USO:
	<body onselectstart="return false" oncontextmenu="return false"  onKeyDown="checkKey(event);" >
*/
function checkKey(evt) {
	if (evt.ctrlKey){
		alert(" \t Accion no permitida. \n \t Gracias..");
		return false;
	}
} 

/*BLOQUEA LA TECLA SHIFT
	EJEMPLO DE USO:
	onkeyup="javascript: return shif(event);"
*/
function shif(e){
	if(!e){
		e = window.event; 
	}
	if(e.shiftKey){
		alert(' \t Accion no permitida. \n \t Gracias..'); 
		return false;
	}
}

/*funcion right left*/
function Left(str, n){
if (n <= 0)
return "";
else if (n > String(str).length)
return str;
else
return String(str).substring(0,n);
}
function Right(str, n){
if (n <= 0)
return "";
else if (n > String(str).length)
return str;
else {
var iLen = String(str).length;
return String(str).substring(iLen, iLen - n);
}
}