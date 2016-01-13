<?php
	if($_COOKIE["agregado"]!="si"){
		header("location:/login");
		exit;
	}
	
	$retorno="false";	
	$nombre=$_GET["nombre"];
	
	//Se hace la conexion:
	$con = include $_SERVER['DOCUMENT_ROOT']."/admin/crearConexion.php";
	
	$sql="SELECT nombre FROM ubicaciones WHERE nombre='$nombre'";
	
	$result = mysqli_query($con,$sql);
		
	for ($i = 0; $i <$result->num_rows; $i++) {
		$result->data_seek($i);
		$fila = $result->fetch_assoc();
		
		if($fila["nombre"]==$nombre && $nombre!="")
		{
			$retorno="true";
		}
	}
	mysqli_close($con);
	
	echo $retorno;
?>