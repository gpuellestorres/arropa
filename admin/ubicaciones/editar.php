<?php 
	if($_COOKIE["agregado"]!="si"){
		header("location:/login");
		exit;
	}
	
	
	if($_GET["t"]!=null){
	
	$nombre = $_GET["t"];
	
	$con = include $_SERVER['DOCUMENT_ROOT']."/admin/crearConexion.php";
	
	$sql="SELECT * FROM ubicaciones WHERE nombre='$nombre'";
					
	$result = mysqli_query($con,$sql);
	
	if($result->num_rows==0)
	{
		header("location:/admin/ubicaciones");
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
		<h2 class="text-center">Editar Ubicación <small>Arropa.org</small></h2>
	</div>
	<br class="hidden-xs">
	<br class="hidden-xs">
	<div id="contenido">
		<div class="rows">
		<div class="col-xs-12 col-sm-6 col-sm-offset-3">
				<form action="metodoEditar.php" method="post" enctype="multipart/form-data">
					<div class="row">
						<input name="nombreAnterior" id="nombreAnterior" value="<?php echo $nombre;?>" hidden>
						<div class="col-sm-12">
							<div class="form-group">
								<label for="nombrePrograma" class="control-label">Nombre Actual de Ubicación</label>
								<input type="text" class="form-control" <?php echo 'value="'.$nombre.'"' ?>
								maxlength="200" readonly>
							</div>
						</div>
						<div class="col-sm-12">
								<div id="divNombre" class="form-group">
									<label for="nombre" class="control-label">Nuevo Nombre de Ubicación</label>
									<input type="text" class="form-control" name="nombre" id="nombre" <?php echo 'value="'.$nombre.'"' ?>
									maxlength="200" placeholder="nombre de producto" required>
									<span id="spanInput" class="glyphicon form-control-feedback"></span>
									<div id="mensajeError" class="alert alert-danger hidden">
										<strong>Error: </strong> ya existe una Ubicación con este nombre en el sistema
									</div>
								</div>
							</div>
						<div class="clearfix"></div>
					</div>
					<br />
					<br />
					<div class="modal-footer">
						<a href="/admin/ubicaciones" class="btn btn-default btn-lg"><i class="glyphicon glyphicon-remove" aria-hidden="true"></i>&nbsp;Cancelar</a>
						<button class="btn btn-primary btn-lg"><i class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></i>&nbsp;Guardar</button>
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
	$("#nombre").change(function () {
		nombre=$("#nombre").val();
		nombreAnterior=$("#nombreAnterior").val();
		
		console.log("nombre: "+nombre + " - " + nombreAnterior);
		
		$.get( "verificarNombre.php", { nombre: nombre } )
			.done(function( data ) {
				console.log(data);
				if(data=="true" && nombre!=nombreAnterior)
				{
					$("#divNombre").addClass(" has-error");
					$("#divNombre").addClass(" has-feedback");
					$("#divNombre").removeClass(" has-success");
					$("#spanInput").addClass("glyphicon-remove");
					$("#spanInput").removeClass("glyphicon-ok");					
					$("#mensajeError").removeClass("hidden");
					
					$("#botonAgregar").attr("disabled", "disabled");
				}
				else 
				{
					$("#divNombre").removeClass(" has-error");
					$("#divNombre").addClass(" has-feedback");
					$("#divNombre").addClass(" has-success");
					$("#spanInput").addClass("glyphicon-ok");
					$("#spanInput").removeClass("glyphicon-remove");
					$("#mensajeError").addClass("hidden");
					
					$("#botonAgregar").removeAttr("disabled");
				}
				
			});
	});
</script>

</body>
</html>
