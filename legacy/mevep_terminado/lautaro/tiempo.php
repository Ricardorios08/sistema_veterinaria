<SCRIPT LANGUAGE="JavaScript">
<!--
var date = new Date("January 7, 2008");
var description = " el 2008";
var now = new Date();
var diff = date.getTime() - now.getTime();
var days = Math.floor(diff / (1000 * 60 * 60 * 24));
document.write("<center><h3>")
if (days > 1) {
document.write(days+1 + " dias para" + description);
}
else if (days == 1) {
document.write("Solo dos dias para" + description);
}
else if (days == 0) {
document.write("Mañana empieza " + description);
}
else {
document.write("Ya estamos en" + description + "!");
}
document.write("</h3></center>");
// End -->
</script>

<p><center>
<a href="http://www.webrecursos.com" target="_blank"><font size="2" face="Arial">WebRecursos.com</font></a>
</center><p>

<input type="button" value="Atrás" onclick="history.back()" style="font-family: Verdana; font-size: 8 pt">
<input type="button" value="Actualizar" onclick="window.location.reload()" style="font-family: Verdana; font-size: 8 pt">
<input type="button" value="Adelante" onclick="history.forward()" style="font-family: Verdana; font-size: 8 pt">