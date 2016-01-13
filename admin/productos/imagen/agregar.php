<?php 
	if($_COOKIE["agregado"]!="si"){
		header("location:/login");
		exit;
	}
	
	if($_GET["p"]!=null){
	
	$nombreProducto = $_GET["p"];
	
	$con = new mysqli("localhost", "arropaor", "b0x724xBxV", "arropaor_bd");
	if (!$con) {
	  die('No se pudo conectar a la base de datos: ' . mysqli_error($con));
	}

	if (!$con->set_charset("utf8")) {
		printf("Error cargando el conjunto de caracteres utf8: %s\n", $mysqli->error);
	}
	
	$sql="SELECT * FROM productos WHERE nombre='$nombreProducto'";
					
	$result = mysqli_query($con,$sql);
	
	if($result->num_rows==0)
	{
		header("location:/admin/productos");
	}
	
	mysqli_close($con);
}
else
{
	header("location:/admin/productos");
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Administrador - Arropa.</title>
  <!-- Bootstrap Core CSS -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="/css/modern-business.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link hrefce="/font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
</head>
<body style="background-color:#FAFAFA !important">

<nav role="navigation" class="navbar navbar-fixed-top navbar-inverse">
	<div class="container-fluid">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
			<button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a href="/admin" class="navbar-brand">Arropa.org</a>
		</div>
		<!-- Collection of nav links and other content for toggling -->
		<div id="navbarCollapse" class="collapse navbar-collapse">
			<ul class="nav navbar-nav">
			<li><a href="/admin">Noticias</a></li>
			<li><a href="/admin/productos">Productos</a></li>
			<li><a href="/admin/categorias">Categorias</a></li>
			<li><a href="/admin/ubicaciones">Ubicaciones</a></li>
			<li><a href="/admin/slider">Slider</a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<?php
					if($_COOKIE["usuario"]=="arropa"){	
						echo '<li><a href="/admin/usuarios">Usuarios del sistema</a></li>';
					}
				?>
				<li class="dropdown">
					<a data-toggle="dropdown" class="dropdown-toggle" href="#">Mi Cuenta<b class="caret"></b></a>
					<ul role="menu" class="dropdown-menu">
						<li><a href="cambiarContrasena.php">Cambiar mi Contraseña</a></li>
						<li><a href="/login/index.php?close=1">Salir</a></li>
					</ul>
				</li>
			</ul>
		</div>
	</div>
</nav>
	
<div class="container">		
	<div class="page-header">
		<h2 class="text-center">Agregar Imagen <small>Arropa Chile</small></h2>
	</div>
	<br class="hidden-xs">
	<br class="hidden-xs">
	<div id="contenido">
		<div class="rows">
			<div class="col-xs-12 col-sm-6 col-sm-offset-3">
				<form action="subir.php" method="post" enctype="multipart/form-data">
						<div class="row">
							<div class="col-sm-12">
								<div class="form-group">
									<label for="nombre" class="control-label">Nombre de Producto</label>
									<input type="text" class="form-control" name="nombre" id="nombre" value="<?php echo $nombreProducto;?>"
									maxlength="200" placeholder="nombre de producto" required readonly>
								</div>
							</div>
							<div class="clearfix"></div>
							<div class="col-sm-12">
								<div class="form-group">
									<label for="nombre" class="control-label">Imagen</label>
									<input type="file" class="form-control" name="imagen" id="imagen"
									 required>
								</div>
							</div>
						</div>
						<br />
						<br />
						<div class="modal-footer">
							<a href="/admin/productos/imagen/index.php?p=<?php echo $nombreProducto; ?>" class="btn btn-default btn-lg"><i class="glyphicon glyphicon-remove" aria-hidden="true"></i>&nbsp;Cancelar</a>
							<button id="botonAgregar" class="btn btn-primary btn-lg"><i class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></i>&nbsp;Agregar</button>
						</div>
					</form>
			</div>
		</div>		
	</div>	
</div> 

<!-- jQuery -->
<script src="/js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="/js/bootstrap.min.js"></script>

<!-- Bootstrap filestyle -->
<script src="/js/bootstrap-filestyle.min.js"></script>

<script>
	$(":file").filestyle({
		buttonText: "Agregar imagen",
		input:false
		});	
</script>

</body>
</html>
