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
	
	$con = include $_SERVER['DOCUMENT_ROOT']."/admin/crearConexion.php";
	
	$sql="DELETE FROM slider WHERE imagen='".$nombre."'";
	$result = mysqli_query($con,$sql);

	unlink($nombre);
	
	mysqli_close($con);
	//redireccionar a productos
	header("location:/admin/slider");
}
?>
