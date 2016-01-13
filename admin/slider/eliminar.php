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
	
	$con = new mysqli("localhost", "arropaor", "b0x724xBxV", "arropaor_bd");
	if (!$con) {
	  die('No se pudo conectar a la base de datos: ' . mysqli_error($con));
	}

	if (!$con->set_charset("utf8")) {
		printf("Error cargando el conjunto de caracteres utf8: %s\n", $mysqli->error);
	}
	
	$sql="DELETE FROM slider WHERE imagen='".$nombre."'";
	$result = mysqli_query($con,$sql);

	unlink($nombre);
	
	mysqli_close($con);
	//redireccionar a productos
	header("location:/admin/slider");
}
?>
