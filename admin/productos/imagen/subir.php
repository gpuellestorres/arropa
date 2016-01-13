<?php
	if($_COOKIE["agregado"]!="si"){
		header("location:/login");
		exit;
	}


	//Variables album
	$nombre = $_POST["nombre"];
	$nombreFile = str_replace(" ","_",$nombre);
	$nombreFile = str_replace("/","_",$nombreFile);

	define ('SITE_ROOT', realpath(dirname(__FILE__)));

	$ruta1="";

	$path="/imagenes/";

	//agregar las imágenes que corresponden
	if($_FILES["imagen"]["name"]!="")
	{
		$nombreArchivo=str_replace(" ","_",$_FILES["imagen"]["name"]);
		move_uploaded_file($_FILES["imagen"]["tmp_name"], SITE_ROOT. $path .$nombreFile . $nombreArchivo);
		$ruta1="imagenes/" .$nombreFile . $nombreArchivo;
	}

	//agregar los datos a la BD

	//Se hace la conexion:
	$con = include $_SERVER['DOCUMENT_ROOT']."/admin/crearConexion.php";
	
	//Se agregan los datos			
	$resultado = $con->query("INSERT INTO imagen_producto VALUES('$nombre','$ruta1')");

	//redireccionar a programas
	header("location:/admin/productos/imagen/index.php?p=$nombre");
?>
