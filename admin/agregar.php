<?php 

	if($_COOKIE["agregado"]!="si"){	

		header("location:/login");

		exit;

	}

include $_SERVER['DOCUMENT_ROOT']."/admin/header.php";	

?>

<div class="container">		

	<div class="page-header">

		<h2 class="text-center">Agregar Noticia <small>Arropa Chile</small></h2>

	</div>

	<br class="hidden-xs">

	<br class="hidden-xs">

	<div id="contenido">

		<div class="rows">

			<div class="col-xs-12 col-sm-12 col-md-10 col-md-offset-1">

				<form action="subir.php" method="post" enctype="multipart/form-data">

						<div class="row">

							<div class="col-sm-6">

								<div id="divNombre" class="form-group">

									<label for="nombre" class="control-label">Nombre de la Noticia</label>

									<input type="text" class="form-control" name="nombre" id="nombre" 

									maxlength="200" placeholder="nombre de noticia" required>

									<span id="spanInput" class="glyphicon form-control-feedback"></span>

									<div id="mensajeError" class="alert alert-danger hidden">

										<strong>Error: </strong> ya existe una noticia con ese nombre en el sistema

									</div>

								</div>

							</div>

							<div class="clearfix"></div>

							<div class="col-sm-12">

								<div class="form-group">

									<label for="descripcion" class="control-label">Bajada de título</label>

									<input type="text"" placeholder="Bajada de título" class="form-control" 

									name="bajada" id="bajada" maxlength="100" required>

								</div>

							</div>	
							
							<div class="col-sm-12">

								<div class="form-group">

									<label for="descripcion" class="control-label">Texto</label>    
    <textarea id="txtDefaultHtmlArea" name="texto" cols="100" rows="15"><p><h3>Prueba H3</h3>Este texto es de <b>prueba</b>.</p></textarea>
	
								</div>

							</div>							

							<div class="col-sm-4">

								<div class="form-group">

									<label for="imagen1" class="control-label">Imagen</label>

									<input type="file" class="form-control" name="imagen" required>

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

			});		

	});
</script>
	
</body>
</html>
