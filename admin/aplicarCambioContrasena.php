<?php
	if($_COOKIE["agregado"]!="si"){
		header("location:/login");
		exit;
	}

	//Variables album
	$usuario = $_COOKIE["usuario"];
	$actual = $_POST["contrasenaActual"];
	$nueva = $_POST["nuevaContrasena"];
	$nueva2 = $_POST["nuevaContrasena2"];

	define ('SITE_ROOT', realpath(dirname(__FILE__)));

	$path="/imagenes/";

	//agregar las imágenes que corresponden y eliminar las anteriores

	//Se hace la conexion:
	$con = new mysqli("localhost", "arropaor", "b0x724xBxV", "arropaor_bd");
	//Se avisa si falla la conexion:
	if ($con->connect_errno) {
		echo "Falló la conexión con MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
	}

	if (!$con->set_charset("utf8")) {
		printf("Error cargando el conjunto de caracteres utf8: %s\n", $mysqli->error);
	}

	$sql="SELECT password FROM admin WHERE user = '" . $usuario . "'";
		
	$result = mysqli_query($con,$sql);
	
	$cambiarContrasena=false;
	
	for ($i = 0; $i < 1; $i++) {
		$result->data_seek($i);
		$fila = $result->fetch_assoc();
		
		if($fila["password"]==$actual)
		{
			$cambiarContrasena=true;
		}
	}
	
	if($cambiarContrasena)
	{
		$sql="UPDATE admin SET password='".$nueva."' WHERE user = '" . $usuario . "'";
		
		$result = mysqli_query($con,$sql);
		
		setcookie("agregado","si",time()-3600, '/', NULL, 0 );
		setcookie("usuario",$_POST["usuario"],time()-3600, '/', NULL, 0 );
		//redireccionar a login (contraseña cambiada correctamente)
		header("location:/login/index.php?m=1");
	}
	else
	{
		//redireccionar a login (error de contraseña)
		header("location:/admin/cambiarContrasena.php?e=1");
	}	
?>
