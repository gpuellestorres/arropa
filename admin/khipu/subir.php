<?php
	if($_COOKIE["agregado"]!="si" || $_COOKIE["usuario"]!="arropa"){
	//if($_COOKIE["agregado"]!="si"){
		header("location:/login");
		exit;
	}

	//Variables album
	$idUsuario = $_POST["idUsuario"];
	$secret = $_POST["secret"];

	//Se hace la conexion:
	$con = include $_SERVER['DOCUMENT_ROOT']."/admin/crearConexion.php";
		
	//Se actualizan los datos en la BD
	$sql = "UPDATE datos_khipu set idUsuario='$idUsuario', secret='$secret' WHERE ID='1'";
	$resultado = $con->query($sql);
	
	//redireccionar a programas
	header("location:/admin/khipu");
?>
