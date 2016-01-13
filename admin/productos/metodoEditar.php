<?php
	if($_COOKIE["agregado"]!="si"){
		header("location:/login");
		exit;
	}

	//Variables album
	$nombre = $_POST["nombre"];
	$cantidad = $_POST["cantidad"];
	$descripcion = $_POST["descripcion"];
	$valor = $_POST["valor"];
	$categoria = $_POST["categoria"];
	$ubicacion = $_POST["ubicacion"];	
	$nombreAnterior = $_POST["nombreAnterior"];

	//Se hace la conexion:
	$con = new mysqli("localhost", "arropaor", "b0x724xBxV", "arropaor_bd");
	//Se avisa si falla la conexion:
	if ($con->connect_errno) {
		echo "Falló la conexión con MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
	}

	if (!$con->set_charset("utf8")) {
		printf("Error cargando el conjunto de caracteres utf8: %s\n", $mysqli->error);
	}

		
	//Se actualizan los datos en la BD
	$resultado = $con->query("UPDATE productos set nombre='$nombre', descripcion='$descripcion', cantidad='$cantidad', valor='$valor', categoria='$categoria', ubicacion='$ubicacion' WHERE nombre='$nombreAnterior'");
	$resultado = $con->query("UPDATE imagen_producto set nombreProducto='$nombre' WHERE nombreProducto='$nombreAnterior'");
	
	//redireccionar a programas
	header("location:/admin/productos");
?>
