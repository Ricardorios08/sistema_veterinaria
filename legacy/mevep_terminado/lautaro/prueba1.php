<!--www.lawebdelprogramador.com-->
<script language="javascript">
var RelojID24 = null
var RelojEjecutandose24 = false

function DetenerReloj24 (){
	if(RelojEjecutandose24)
		clearTimeout(RelojID24)
	RelojEjecutandose24 = false
}

function MostrarHora24 () {
	var ahora = new Date()
	var horas = ahora.getHours()
	var minutos = ahora.getMinutes()
	var segundos = ahora.getSeconds()
	var ValorHora

	//establece las horas
	if (horas < 10)
		ValorHora = "0" + horas
	else
		ValorHora = "" + horas

	//establece los minutos
	if (minutos < 10)
		ValorHora += ":0" + minutos
	else
		ValorHora += ":" + minutos

	//establece los segundos
	if (segundos < 10)
		ValorHora += ":0" + segundos
	else
		ValorHora += ":" + segundos

	document.reloj24.digitos.value = ValorHora
	//si se desea tener el reloj en la barra de estado, reemplazar la anterior por esta
	//window.status = ValorHora

	RelojID24 = setTimeout("MostrarHora24()",1000)
	RelojEjecutandose24 = true
}

function IniciarReloj24 () {
	DetenerReloj24()
	MostrarHora24()
}
</script>

<body onLoad="IniciarReloj24()">
<form name="reloj24">
<input type="text" size="8" name="digitos" value=" ">
</form> 
</body>