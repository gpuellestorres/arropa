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
	
	$sql="DELETE FROM productos WHERE nombre='".$nombre."'";
	$result = mysqli_query($con,$sql);
	
	//Eliminar imagenes
	$sql="SELECT * FROM imagen_producto WHERE nombreProducto='".$nombre."'";
	$result = mysqli_query($con,$sql);
	
	for ($i = 0; $i <$result->num_rows; $i++) {
		$result->data_seek($i);
		$fila = $result->fetch_assoc();
		
		if($fila["imagen"]!="")
		{
			unlink("imagen/".$fila["imagen"]);
		}
	}
	
	//Se eliminan las tuplas en imagen_producto
	$sql="DELETE FROM imagen_producto WHERE nombreProducto='".$nombre."'";
	$result = mysqli_query($con,$sql);
	
	mysqli_close($con);
	//redireccionar a productos
	header("location:/admin/productos");
}
?>
