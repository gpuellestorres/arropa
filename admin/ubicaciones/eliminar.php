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
	
	$sql="DELETE FROM ubicaciones WHERE nombre='".$nombre."'";
	$result = mysqli_query($con,$sql);
	
	$sql="UPDATE productos set ubicacion='Sin Datos' WHERE ubicacion='".$nombre."'";
	$result = mysqli_query($con,$sql);
	
	mysqli_close($con);
	//redireccionar a productos
	header("location:/admin/categorias");
}
?>
