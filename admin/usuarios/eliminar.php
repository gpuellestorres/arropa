<?php
	if($_COOKIE["agregado"]!="si"){
		header("location:/login");
		exit;
	}

//Variables album

define ('SITE_ROOT', realpath(dirname(__FILE__)));

$path="/imagenes/";
	
if($_GET["t"]!=null){
	
	$nombre = $_GET["t"];
	if($nombre=="arropa")
	{
		header("location:/admin/usuarios");
	}
	
	$con = new mysqli("localhost", "arropaor", "b0x724xBxV", "arropaor_bd");
	if (!$con) {
	  die('No se pudo conectar a la base de datos: ' . mysqli_error($con));
	}

	if (!$con->set_charset("utf8")) {
		printf("Error cargando el conjunto de caracteres utf8: %s\n", $mysqli->error);
	}
	
	$sql="DELETE FROM admin WHERE user='".$nombre."'";
	$result = mysqli_query($con,$sql);
	mysqli_close($con);
	//redireccionar a programas
	header("location:/admin/usuarios");
}
?>
