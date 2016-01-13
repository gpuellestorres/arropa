<?php
	if($_COOKIE["agregado"]!="si"){
		header("location:/login");
		exit;
	}

	//Variables album
	$nombre = $_POST["nombre"];
	$nombreAnterior = $_POST["nombreAnterior"];

	//Se hace la conexion:
	$con = include $_SERVER['DOCUMENT_ROOT']."/admin/crearConexion.php";
		
	//Se actualizan los datos en la BD
	$resultado = $con->query("UPDATE ubicaciones set nombre='$nombre' WHERE nombre='$nombreAnterior'");
	$resultado = $con->query("UPDATE productos set ubicacion='$nombre' WHERE ubicacion='$nombreAnterior'");
	
	//redireccionar a programas
	header("location:/admin/ubicaciones");
?>
