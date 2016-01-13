<?php
	if($_COOKIE["agregado"]!="si"){
		header("location:/login");
		exit;
	}

	//Variables album
	$nombre = $_POST["nombre"];
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
	$resultado = $con->query("UPDATE ubicaciones set nombre='$nombre' WHERE nombre='$nombreAnterior'");
	$resultado = $con->query("UPDATE productos set ubicacion='$nombre' WHERE ubicacion='$nombreAnterior'");
	
	//redireccionar a programas
	header("location:/admin/ubicaciones");
?>
