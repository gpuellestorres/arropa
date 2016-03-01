<?php 
	if($_COOKIE["agregado"]!="si"){
		header("location:/login");
		exit;
	}
	
	
	if($_GET["t"]!=null){
	
	$usuario = $_GET["t"];
	
	$con = include $_SERVER['DOCUMENT_ROOT']."/admin/crearConexion.php";
	
	$sql="SELECT * FROM admin WHERE user='".$usuario."'";
					
	$result = mysqli_query($con,$sql);
	
	if($result->num_rows==0)
	{
		header("location:/admin/usuarios");
	}
	
	mysqli_close($con);
}
else
{
	header("location:/admin");
}

	include $_SERVER['DOCUMENT_ROOT']."/admin/header.php";	
?>

	
<div class="container">		
	<div class="page-header">
		<h2 class="text-center">Editar Contraseña de Usuario <small>Arropa.org</small></h2>
	</div>
	<br class="hidden-xs">
	<br class="hidden-xs">
	<div id="contenido">
		<div class="rows">
		<div class="col-xs-12 col-sm-6 col-sm-offset-3">
				<form action="metodoEditar.php" method="post" enctype="multipart/form-data">
					<div class="row">
						<input name="nombre" value="<?php echo $usuario?>" hidden>
						<div class="col-sm-12">
							<div class="form-group">
								<label for="nombrePrograma" class="control-label">Nombre de Usuario</label>
								<input type="text" class="form-control" readonly <?php echo 'value="'.$usuario.'"' ?>
								maxlength="100" required>
							</div>
						</div>
						<div class="clearfix"></div>
						<div class="col-sm-12">
								<div class="form-group">
									<label for="nombre" class="control-label">Nueva Contraseña</label>
									<input type="password" class="form-control" name="password" id="password" 
									maxlength="200" required>
								</div>
						</div>
						<div class="col-sm-12">
							<div id="divPass" class="form-group">
									<label for="nombre" class="control-label">Repita la Nueva Contraseña</label>
									<input type="password" class="form-control" name="password2" id="password2" 
									maxlength="200" required>
									<span id="spanInputPass" class="glyphicon form-control-feedback"></span>
									<div id="mensajeErrorPass" class="alert alert-danger hidden">
										<strong>Error: </strong> debe ingresar el mismo valor que en "Nueva Contraseña"
									</div>
							</div>
						</div>
					</div>
					<br />
					<br />
					<div class="modal-footer">
						<a href="/admin/usuarios" class="btn btn-default btn-lg"><i class="glyphicon glyphicon-remove" aria-hidden="true"></i>&nbsp;Cancelar</a>
						<button class="btn btn-primary btn-lg"><i class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></i>&nbsp;Agregar</button>
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
		if($("#password").val()!=$("#password2").val())
		{
			$("#divPass").addClass(" has-error");
			$("#divPass").addClass(" has-feedback");
			$("#divPass").removeClass(" has-success");
			$("#spanInputPass").addClass("glyphicon-remove");
			$("#spanInputPass").removeClass("glyphicon-ok");			
			$("#mensajeErrorPass").removeClass("hidden");
			
			$("#botonAgregar").attr("disabled", "disabled");
		}
		else if($("#password").val()!="") 
		{
			$("#divPass").removeClass(" has-error");
			$("#divPass").addClass(" has-feedback");
			$("#divPass").addClass(" has-success");
			$("#spanInputPass").addClass("glyphicon-ok");
			$("#spanInputPass").removeClass("glyphicon-remove");
			$("#mensajeErrorPass").addClass("hidden");
			
			$("#botonAgregar").removeAttr("disabled");	
		}
	}
	
	$("#password").change(function () 
	{
		verificarContraseñas();
	});
	
	$("#password2").change(function () 
	{
		verificarContraseñas();
	});	
</script>

</body>
</html>
