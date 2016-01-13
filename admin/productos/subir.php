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
	$con = new mysqli("localhost", "arropaor", "b0x724xBxV", "arropaor_bd");
	//Se avisa si falla la conexion:
	if ($con->connect_errno) {
		echo "Falló la conexión con MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
	}
	
	if (!$con->set_charset("utf8")) {
				printf("Error cargando el conjunto de caracteres utf8: %s\n", $mysqli->error);
			}							
	
	//Se agregan los datos			
	$resultado = $con->query("INSERT INTO productos VALUES('$nombre','$descripcion', '$cantidad', '$valor', '$categoria', '$ubicacion')");

	//redireccionar a programas
	header("location:/admin/productos");
?>
