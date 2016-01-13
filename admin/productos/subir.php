<?php
	if($_COOKIE["agregado"]!="si"){
		header("location:/login");
		exit;
	}

	//Variables album
	$nombre = $_POST["nombre"];
	$descripcion = $_POST["descripcion"];
	$cantidad = $_POST["cantidad"];
	$valor = $_POST["valor"];
	$categoria = $_POST["categoria"];
	$ubicacion = $_POST["ubicacion"];

	//agregar los datos a la BD

	//Se hace la conexion:
	$con = include $_SERVER['DOCUMENT_ROOT']."/admin/crearConexion.php";
	
	//Se agregan los datos			
	$resultado = $con->query("INSERT INTO productos VALUES('$nombre','$descripcion', '$cantidad', '$valor', '$categoria', '$ubicacion')");

	//redireccionar a programas
	header("location:/admin/productos");
?>
