<?php
	if($_COOKIE["agregado"]!="si"){
		header("location:/login");
		exit;
	}

//Variables album

define ('SITE_ROOT', realpath(dirname(__FILE__)));

$path="/imagenes/";
	
if($_GET["i"]!=null && $_GET["p"]!=null){
	
	$imagen = $_GET["i"];
	$producto = $_GET["p"];
	
	$con = include $_SERVER['DOCUMENT_ROOT']."/admin/crearConexion.php";
	
	$sql="DELETE FROM imagen_producto WHERE nombreProducto='$producto' AND imagen='$imagen'";
					
	$result = mysqli_query($con,$sql);
	
	unlink($imagen);
	
	mysqli_close($con);
	//redireccionar a imagen de producto
	header("location:/admin/productos/imagen/index.php?p=$producto");
}
?>
