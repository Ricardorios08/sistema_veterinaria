<?php
include ("../../../conexiones/config_pro.php");

// tabla usuario
$usuario = $_POST["usuario"];
$contrasena = $_POST["contrasena"];
$rol = $_POST["rol"];
$nombre = $_POST["nombre"];

$sql = "INSERT INTO `usuario` (`usuario`, `contrasena`, `rol`, `nombre`) VALUES ('$usuario', '$contrasena', '$rol', '$nombre')";

// Assuming you are still using mysql_query, which is deprecated.
// You should consider switching to mysqli or PDO for modern PHP development.
$result = mysql_query($sql);

if ($result) {
    // If the query was successful, display an alert
    echo "<script type='text/javascript'>alert('Guardado correctamente');</script>";
} else {
    // Optionally, you can display an error alert if the query failed
    echo "<script type='text/javascript'>alert('Error al guardar: " . mysql_error() . "');</script>";
}


// Redirect to a success page or display a message
// For example, you might want to show the form again or a list of users.
// For now, let's just include a generic "entrada_dato.php" if it's meant to display something after saving.
// You might need to adjust this path based on your actual file structure for user management.
include ("../../usuarios/entrada_dato.php");

?>