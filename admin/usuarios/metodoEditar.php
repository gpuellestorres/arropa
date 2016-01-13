<?php
	if($_COOKIE["agregado"]!="si"){
		header("location:/login");
		exit;
	}

	//Variables album
	$nombre = $_POST["nombre"];
	$password = $_POST["password"];

	//Se hace la conexion:
	$con = include $_SERVER['DOCUMENT_ROOT']."/admin/crearConexion.php";
		
	//Se actualizan los datos en la BD
	$resultado = $con->query("UPDATE admin set password='$password' WHERE user='$nombre'");
	
	//redireccionar a programas
	header("location:/admin/usuarios");
?>
