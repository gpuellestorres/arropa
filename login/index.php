<?php
	if($_GET["close"]==1)
	{
		setcookie("agregado","si",time()-3600, '/', NULL, 0 );
		setcookie("usuario",$_POST["usuario"],time()-3600, '/', NULL, 0 );
		header("location:/login");
		exit;
	}
	else if($_COOKIE["agregado"]=="si"){
		header("location:/admin");
		exit;
	}
	else if($_POST["usuario"]!=null){
		
		$usuarioIngresado = $_POST["usuario"];
		
		$con = new mysqli("localhost", "arropaor", "b0x724xBxV", "arropaor_bd");
		if (!$con) {
		  die('No se pudo conectar a la base de datos: ' . mysqli_error($con));
		}

		if (!$con->set_charset("utf8")) {
			printf("Error cargando el conjunto de caracteres utf8: %s\n", $mysqli->error);
		}
		
		$sql="SELECT password FROM admin WHERE user = '" . $usuarioIngresado . "'";
		
		$result = mysqli_query($con,$sql);
		
		for ($i = 0; $i <$result->num_rows; $i++) {
			$result->data_seek($i);
			$fila = $result->fetch_assoc();
			
			if($fila["password"]==$_POST["password"])
			{
				//las cookies expiran en una hora:			
				setcookie("agregado","si",time()+3600, '/', NULL, 0 );
				setcookie("usuario",$_POST["usuario"],time()+3600, '/', NULL, 0 );
				
				header("location:/admin");
				exit;
			}
		}
	}
?>


<!DOCTYPE html>
<html lang="es">
<script src="cargaContenidosMenu.js"></script>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - Arropa.org</title>
  <!-- Bootstrap Core CSS -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="/css/modern-business.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="/font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
</head>
<body style="background-color:#FAFAFA !important">	
<div class="container show-top-margin separate-rows tall-rows">	
	<br class="hidden-xs">
	<br class="hidden-xs">
	<?php
	if($_GET["m"]==1)echo '<div class="alert alert-success alert-dismissable">
			<button type="button" class="close" data-dismiss="alert" 
				aria-hidden="true">
				&times;
			</button>
		   La contraseña ha sido modificada. Por favor, vuelva a ingresar
		</div>';
	?>
	<br class="hidden-xs">
	<br class="hidden-xs">
	<div id="contenido">				
		<div class="row">
			<div class="col-xs-12 col-sm-4">
			</div>
			<div class="col-xs-12 col-sm-4">
				<form role="form" action="index.php" method="post">
					<div class="form-group">
						<label>Usuario</label>
						<input type="text" class="form-control" id="usuario" name="usuario"
						   placeholder="Introduce tu nombre de usuario" required>
					</div>
					<div class="form-group">
						<label>Contraseña</label>
						<input type="password" class="form-control" id="password" name="password"
						   placeholder="Contraseña" required>
					</div>					
					<button type="submit" class="btn btn-primary btn-block btn-lg"><span class="glyphicon glyphicon-chevron-right"></span>&nbsp;Ingresar</button>
					<br>
					<br>
				</form>
			</div>
			<div class="col-xs-12 col-sm-4">				
			</div>
		</div>		
	</div>	
</div>
<!-- jQuery -->
<script src="js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="/js/bootstrap.min.js"></script>
</body>
</html>
