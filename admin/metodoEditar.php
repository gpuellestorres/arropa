<?php
	if($_COOKIE["agregado"]!="si"){
		header("location:/login");
		exit;
	}

	//Variables album
	$tituloAnterior = $_POST["tituloAnterior"];
	$titulo = $_POST["titulo"];
	$texto = $_POST["texto"];
	$bajada = $_POST["bajada"];

	define ('SITE_ROOT', realpath(dirname(__FILE__)));

	$path="/imagenes/";

	//agregar las imágenes que corresponden y eliminar las anteriores

	//Se hace la conexion:
	$con = include $_SERVER['DOCUMENT_ROOT']."/admin/crearConexion.php";

	$sql="SELECT imagen FROM noticias WHERE nombre='".$tituloAnterior."'";
						
	$result = mysqli_query($con,$sql);

	for ($i = 0; $i <$result->num_rows; $i++) {
		$result->data_seek($i);
		$fila = $result->fetch_assoc();
		
		$ruta1=$fila["imagen"];
		
		if($_FILES["imagen"]["name"]!="")
		{
			if($fila["imagen"]!="")
			{
				unlink($fila["imagen"]);
			}
			$nombreArchivo=str_replace(" ","_",$_FILES["imagen"]["name"]);
			move_uploaded_file($_FILES["imagen"]["tmp_name"], SITE_ROOT. $path .$titulo . $nombreArchivo);
			$ruta1="imagenes/" .$titulo . $nombreArchivo;
		}				
	}

	//agregar los datos a la BD
		
	//Se agregan los datos			
	$resultado = $con->query("UPDATE noticias set nombre='$titulo', texto='$texto', bajada='$bajada', imagen='$ruta1' WHERE nombre='$tituloAnterior'");
	
	//redireccionar a programas
	header("location:/admin");
?>
