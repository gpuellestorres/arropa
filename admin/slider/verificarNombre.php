<?php
	if($_COOKIE["agregado"]!="si"){
		header("location:/login");
		exit;
	}
	
	$retorno="false";	
	$nombre=$_GET["imagen"];

	$path="/imgSlider/";

	$nombre = $path . $nombre;


	//Se hace la conexion:
	$con = include $_SERVER['DOCUMENT_ROOT']."/admin/crearConexion.php";
	
	$sql="SELECT imagen FROM slider WHERE imagen='$nombre'";
	
	$result = mysqli_query($con,$sql);
		
	for ($i = 0; $i <$result->num_rows; $i++) {
		$result->data_seek($i);
		$fila = $result->fetch_assoc();
		
		if($fila["imagen"]==$nombre && $nombre!="")
		{
			$retorno="true";
		}
	}
	mysqli_close($con);
	
	echo $retorno;
?>
