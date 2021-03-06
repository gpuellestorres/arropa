<?php 
	if($_COOKIE["agregado"]!="si"){
		header("location:/login");
		exit;
	}
	
	$usuario = $_COOKIE["usuario"];

	include $_SERVER['DOCUMENT_ROOT']."/admin/header.php";	
?>
	
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
