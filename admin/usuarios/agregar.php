<?php 
	if($_COOKIE["agregado"]!="si"){	
		header("location:/login");
		exit;
	}

	include $_SERVER['DOCUMENT_ROOT']."/admin/header.php";	
?>


	
<div class="container">		
	<div class="page-header">
		<h2 class="text-center">Agregar Usuario <small>Arropa Chile</small></h2>
	</div>
	<br class="hidden-xs">
	<br class="hidden-xs">
	<div id="contenido">
		<div class="rows">
			<div class="col-xs-12 col-sm-6 col-sm-offset-3">
				<form action="subir.php" method="post" enctype="multipart/form-data">
						<div class="row">
							<div class="col-sm-12">
								<div id="divNombre" class="form-group">
									<label for="nombre" class="control-label">Nombre de Usuario</label>
									<input type="text" class="form-control" name="nombre" id="nombre" 
									maxlength="200" placeholder="nombre de usuario" required>
									<span id="spanInput" class="glyphicon form-control-feedback"></span>
									<div id="mensajeError" class="alert alert-danger hidden">
										<strong>Error: </strong> ya existe un usuario con ese nombre en el sistema
									</div>
								</div>
							</div>
							<div class="clearfix"></div>
							<div class="col-sm-12">
								<div class="form-group">
									<label for="nombre" class="control-label">Contraseña</label>
									<input type="password" class="form-control" name="password" id="password" 
									maxlength="200" placeholder="nombre de usuario" required>
								</div>
							</div>
							<div class="col-sm-12">
							<div id="divPass" class="form-group">
									<label for="nombre" class="control-label">Repita la Contraseña</label>
									<input type="password" class="form-control" name="password2" id="password2" 
									maxlength="200" placeholder="nombre de usuario" required>
									<span id="spanInputPass" class="glyphicon form-control-feedback"></span>
									<div id="mensajeErrorPass" class="alert alert-danger hidden">
										<strong>Error: </strong> debe ingresar el mismo valor que en "Contraseña"
									</div>
							</div>
						</div>
						<br />
						<br />
						<div class="modal-footer">
							<a href="/admin/usuarios" class="btn btn-default btn-lg"><i class="glyphicon glyphicon-remove" aria-hidden="true"></i>&nbsp;Cancelar</a>
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
		
		
	$("#nombre").change(function () {
		verificarContraseñas();
	});
	
	function verificarContraseñas()
	{
		habilitarBoton=true;
		
		if($("#password").val()!=$("#password2").val())
		{
			$("#divPass").addClass(" has-error");
			$("#divPass").addClass(" has-feedback");
			$("#divPass").removeClass(" has-success");
			$("#spanInputPass").addClass("glyphicon-remove");
			$("#spanInputPass").removeClass("glyphicon-ok");			
			$("#mensajeErrorPass").removeClass("hidden");
			
			habilitarBoton=false;
		}
		else if($("#password").val()!="") 
		{
			$("#divPass").removeClass(" has-error");
			$("#divPass").addClass(" has-feedback");
			$("#divPass").addClass(" has-success");
			$("#spanInputPass").addClass("glyphicon-ok");
			$("#spanInputPass").removeClass("glyphicon-remove");
			$("#mensajeErrorPass").addClass("hidden");
		}
		
		nombre=$("#nombre").val();
		
		console.log("nombre: "+nombre);
		
		$.get( "verificarNombre.php", { nombre: nombre } )
			.done(function( data ) {
				console.log(data);
				if(data=="true")
				{
					$("#divNombre").addClass(" has-error");
					$("#divNombre").addClass(" has-feedback");
					$("#divNombre").removeClass(" has-success");
					$("#spanInput").addClass("glyphicon-remove");
					$("#spanInput").removeClass("glyphicon-ok");					
					$("#mensajeError").removeClass("hidden");
					
					habilitarBoton=false;
				}
				else 
				{
					$("#divNombre").removeClass(" has-error");
					$("#divNombre").addClass(" has-feedback");
					$("#divNombre").addClass(" has-success");
					$("#spanInput").addClass("glyphicon-ok");
					$("#spanInput").removeClass("glyphicon-remove");
					$("#mensajeError").addClass("hidden");
				}
				
				if(habilitarBoton)
				{
					$("#botonAgregar").removeAttr("disabled");					
				}
				else
				{
					$("#botonAgregar").attr("disabled", "disabled");
				}
			});
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
