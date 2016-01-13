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
	
	$con = new mysqli("localhost", "arropaor", "b0x724xBxV", "arropaor_bd");
	if (!$con) {
	  die('No se pudo conectar a la base de datos: ' . mysqli_error($con));
	}

	if (!$con->set_charset("utf8")) {
		printf("Error cargando el conjunto de caracteres utf8: %s\n", $mysqli->error);
	}
	
	$sql="SELECT imagen FROM noticias WHERE nombre='".$nombre."'";
					
	$result = mysqli_query($con,$sql);
	
	for ($i = 0; $i <$result->num_rows; $i++) {
		$result->data_seek($i);
		$fila = $result->fetch_assoc();
		
		if($fila["imagen"]!="")
		{
			unlink($fila["imagen"]);
		}
	}

	$sql="DELETE FROM noticias WHERE nombre='".$nombre."'";
	$result = mysqli_query($con,$sql);
	mysqli_close($con);
	//redireccionar a programas
	header("location:/admin");
}
?>
