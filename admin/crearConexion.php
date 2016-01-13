<?php 
	$con = new mysqli("localhost", "arropaor", "h0dFxwtrxBxVdW", "arropaor_bd");
		if (!$con) {
		  die('No se pudo conectar a la base de datos: ' . mysqli_error($con));
		}

		if (!$con->set_charset("utf8")) {
			printf("Error cargando el conjunto de caracteres utf8: %s\n", $mysqli->error);
		}


	return $con;
?>