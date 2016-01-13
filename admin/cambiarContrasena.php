<?php 
	if($_COOKIE["agregado"]!="si"){
		header("location:/login");
		exit;
	}
	
	$usuario = $_COOKIE["usuario"];
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
			<li><a href="/admin">Noticias</a></li>			<li><a href="/admin/productos">Productos</a></li>			<li><a href="/admin/categorias">Categorias</a></li>						<li><a href="/admin/ventas.php">Registro de ventas</a></li>			<li><a href="/admin/ubicaciones">Ubicaciones</a></li>			<li><a href="/admin/slider">Slider</a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
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
		<h2 class="text-center">Cambiar mi Contraseña <small>Arropa Chile</small></h2>
	</div>
	<br class="hidden-xs">
	<?php
	if($_GET["e"]==1)echo '<div class="alert alert-danger alert-dismissable">
			<button type="button" class="close" data-dismiss="alert" 
				aria-hidden="true">
				&times;
			</button>
		   ¡Error! La contraseña actual ingresada no es correcta
		</div>';
	?>
	<br class="hidden-xs">
	<div id="contenido">
		<div class="rows">
			<div class="col-xs-12 col-sm-6 col-sm-offset-3">
				<form action="aplicarCambioContrasena.php" method="post" enctype="multipart/form-data">
						<div class="row">
							<div class="col-sm-12">
								<div class="form-group">
									<label for="descripcion" class="control-label">Nombre de Usuario</label>
									<input class="form-control" name="nombreUsuario" value="<?php echo $usuario;?>" readonly>
								</div>
							</div>	
							<div class="clearfix"></div>
							<div class="col-sm-12">
								<div class="form-group">
									<label for="descripcion" class="control-label">Contraseña actual</label>
									<input class="form-control" type="password" name="contrasenaActual" required>
								</div>
							</div>	
							<div class="clearfix"></div>
							<div class="col-sm-12">
								<div class="form-group">
									<label for="descripcion" class="control-label">Nueva Contraseña</label>
									<input class="form-control" type="password" name="nuevaContrasena" id="nuevaContrasena" required>
								</div>
							</div>	
							<div class="clearfix"></div>
							<div class="col-sm-12">
									<div id="divNombre" class="form-group">
									<label for="descripcion" class="control-label">Repita la Nueva Contraseña</label>
									<input class="form-control" type="password" name="nuevaContrasena2" id="nuevaContrasena2" required>
									<span id="spanInput" class="glyphicon form-control-feedback"></span>
									<div id="mensajeError" class="alert alert-danger hidden">
										<strong>Error: </strong> este valor debe ser igual al ingresado en "Nueva Contraseña"
									</div>
							</div>
						</div>
						<br />
						<br />
						<div class="modal-footer">
							<a href="/admin" class="btn btn-default btn-lg"><i class="glyphicon glyphicon-remove" aria-hidden="true"></i>&nbsp;Cancelar</a>
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
	function verificarContraseñas()
	{
		if($("#nuevaContrasena").val()!=$("#nuevaContrasena2").val())
		{
			$("#divNombre").addClass(" has-error");
			$("#divNombre").addClass(" has-feedback");
			$("#divNombre").removeClass(" has-success");
			$("#spanInput").addClass("glyphicon-remove");
			$("#spanInput").removeClass("glyphicon-ok");
			$("#botonAgregar").attr("disabled", "disabled");
			$("#mensajeError").removeClass("hidden");
		}
		else 
		{
			$("#divNombre").removeClass(" has-error");
			$("#divNombre").addClass(" has-feedback");
			$("#divNombre").addClass(" has-success");
			$("#spanInput").addClass("glyphicon-ok");
			$("#spanInput").removeClass("glyphicon-remove");
			$("#botonAgregar").removeAttr("disabled");
			$("#mensajeError").addClass("hidden");
		}
	}
	
	$("#nuevaContrasena").change(function () 
	{
		verificarContraseñas();
	});
	
	$("#nuevaContrasena2").change(function () 
	{
		verificarContraseñas();
	});
	
</script>

</body>
</html>
