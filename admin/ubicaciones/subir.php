<?php
	if($_COOKIE["agregado"]!="si"){
		header("location:/login");
		exit;
	}

	//Variables album
	$nombre = $_POST["nombre"];

	//agregar los datos a la BD

	//Se hace la conexion:
	$con = include $_SERVER['DOCUMENT_ROOT']."/admin/crearConexion.php";
	
	//Se agregan los datos			
	$resultado = $con->query("INSERT INTO ubicaciones VALUES('$nombre')");

	//redireccionar a programas
	header("location:/admin/ubicaciones");
?>
