<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Formulario de contacto</title>
</head>

<body>
<?php
$nombre = $_POST['nombre'];
$email = $_POST['email'];
$mensaje = $_POST['mensaje'];
$para = 'contacto@arropa.org';
$titulo = 'ASUNTO DEL MENSAJE';
$header = 'From: ' . $email;
$msjCorreo = "Nombre: $nombre\n E-Mail: $email\n Mensaje:\n $mensaje";
  
if ($_POST['submit']) {
if (mail($para, $titulo, $msjCorreo, $header)) {
echo "<script language='javascript'>
alert('¡Muchas gracias! Te responderemos a la brevedad :)');
window.location.href = 'http://www.arropa.org';
</script>";
} else {
echo 'Falló el envio';
}
}
?>


</body>
</html>