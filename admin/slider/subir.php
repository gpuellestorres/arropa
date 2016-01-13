<?php
	if($_COOKIE["agregado"]!="si"){
		header("location:/login");
		exit;
	}

	$ruta1="";
	define ('SITE_ROOT', realpath(dirname(__FILE__)));

	$path="imgSlider/";

	//agregar las imágenes que corresponden
	if($_FILES["imagen"]["name"]!="")
	{
		$nombreArchivo=str_replace(" ","_",$_FILES["imagen"]["name"]);
		move_uploaded_file($_FILES["imagen"]["tmp_name"], SITE_ROOT."/". $path . $nombreArchivo);
		$ruta1=$path . $nombreArchivo;
	}

	//agregar los datos a la BD

	//Se hace la conexion:
	$con = include $_SERVER['DOCUMENT_ROOT']."/admin/crearConexion.php";
	
	//Se agregan los datos			
	$resultado = $con->query("INSERT INTO slider VALUES('$ruta1')");

	//redireccionar a programas
	header("location:/admin/slider");
?>
