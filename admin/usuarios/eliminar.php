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
	
	$con = include $_SERVER['DOCUMENT_ROOT']."/admin/crearConexion.php";
	
	$sql="DELETE FROM admin WHERE user='".$nombre."'";
	$result = mysqli_query($con,$sql);
	mysqli_close($con);
	//redireccionar a programas
	header("location:/admin/usuarios");
}
?>
