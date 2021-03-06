<?php 
	if($_COOKIE["agregado"]!="si"){
		header("location:/login");
		exit;
	}
	
	
	if($_GET["t"]!=null){
	
	$nombre = $_GET["t"];
	
	$con = include $_SERVER['DOCUMENT_ROOT']."/admin/crearConexion.php";
	
	$sql="SELECT * FROM productos WHERE nombre='$nombre'";
					
	$result = mysqli_query($con,$sql);
	
	if($result->num_rows==0)
	{
		header("location:/admin/productos");
	}
	
	for ($i = 0; $i <$result->num_rows; $i++) {
		$result->data_seek($i);
		$fila = $result->fetch_assoc();
		
		$descripcion=$fila["descripcion"];
		$cantidad=$fila["cantidad"];
		$valor=$fila["valor"];
		$categoria=$fila["categoria"];
		$ubicacion=$fila["ubicacion"];
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
		<h2 class="text-center">Editar Producto <small>Arropa.org</small></h2>
	</div>
	<br class="hidden-xs">
	<br class="hidden-xs">
	<div id="contenido">
		<div class="rows">
		<div class="col-xs-12 col-sm-8 col-sm-offset-2">
				<form action="metodoEditar.php" method="post" enctype="multipart/form-data">
					<div class="row">
						<input name="nombreAnterior" id="nombreAnterior" value="<?php echo $nombre;?>" hidden>
						<div class="col-sm-12">
							<div class="form-group">
								<label for="nombrePrograma" class="control-label">Nombre Actual de Producto</label>
								<input type="text" class="form-control" <?php echo 'value="'.$nombre.'"' ?>
								maxlength="200" readonly>
							</div>
						</div>
						<div class="col-sm-12">
								<div id="divNombre" class="form-group">
									<label for="nombre" class="control-label">Nombre de Producto</label>
									<input type="text" class="form-control" name="nombre" id="nombre" <?php echo 'value="'.$nombre.'"' ?>
									maxlength="200" placeholder="nombre de producto" required>
									<span id="spanInput" class="glyphicon form-control-feedback"></span>
									<div id="mensajeError" class="alert alert-danger hidden">
										<strong>Error: </strong> ya existe un producto con ese nombre en el sistema
									</div>
								</div>
							</div>
						<div class="clearfix"></div>
						<div class="col-sm-12">
								<div class="form-group">
									<label for="nombre" class="control-label">Descripción</label>
									<textarea class="form-control" name="descripcion" id="descripcion" 
									maxlength="5000" placeholder="descripción del producto" required><?php echo $descripcion;?></textarea>
								</div>
							</div>
						<div class="col-sm-12">
								<div class="form-group">
									<label for="nombre" class="control-label">Cantidad</label>
									<input type="number" class="form-control" name="cantidad" id="cantidad" 
									value="<?php echo $cantidad;?>" maxlength="200" required>
								</div>
						</div>
						<div class="col-sm-12">
								<div class="form-group">
									<label for="nombre" class="control-label">Valor</label>
									<input type="number" class="form-control" name="valor" id="valor" 
									value="<?php echo $valor;?>" maxlength="200" required>
								</div>
						</div>
						<div class="col-sm-12">
							<div class="form-group">
								<label for="nombre" class="control-label">Categoría</label>
								<select class="form-control" name="categoria" id="categoria">
									<option value="seleccione">Seleccione una opción</option>
									<?php
										
										$con = include $_SERVER['DOCUMENT_ROOT']."/admin/crearConexion.php";
										
										$sql="SELECT * FROM categorias";
														
										$result = mysqli_query($con,$sql);
										
										for ($i = 0; $i <$result->num_rows; $i++) {
											$result->data_seek($i);
											$fila = $result->fetch_assoc();
											
											if($categoria==$fila["nombre"]){
												echo '<option value="'.$fila["nombre"].'" selected>'.$fila["nombre"].'</option>';
											}
											else
											{
												echo '<option value="'.$fila["nombre"].'">'.$fila["nombre"].'</option>';
											}
										}
										
										mysqli_close($con);
										
									?>
								</select>
							</div>
						</div>
						<div class="col-sm-12">
							<div class="form-group">
								<label for="nombre" class="control-label">Ubicación</label>
								<select class="form-control" name="ubicacion" id="ubicacion">
									<option value="seleccione">Seleccione una opción</option>
									<?php 
										$con = include $_SERVER['DOCUMENT_ROOT']."/admin/crearConexion.php";
										
										$sql="SELECT * FROM ubicaciones";
														
										$result = mysqli_query($con,$sql);
										
										for ($i = 0; $i <$result->num_rows; $i++) {
											$result->data_seek($i);
											$fila = $result->fetch_assoc();
											
											if($ubicacion==$fila["nombre"]){
												echo '<option value="'.$fila["nombre"].'" selected>'.$fila["nombre"].'</option>';
											}
											else
											{
												echo '<option value="'.$fila["nombre"].'">'.$fila["nombre"].'</option>';
											}
										}
										
										mysqli_close($con);
										
									?>
								</select>
							</div>
						</div>
					</div>
					<br />
					<br />
					<div class="modal-footer">
						<a href="/admin/productos" class="btn btn-default btn-lg"><i class="glyphicon glyphicon-remove" aria-hidden="true"></i>&nbsp;Cancelar</a>
						<button class="btn btn-primary btn-lg" id="botonAgregar" <?php if($categoria=="Sin Categoria") echo 'disabled'; ?>><i class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></i>&nbsp;Guardar</button>
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
	
	function verificarCampos(){
		
		habilitarBoton=true;
		
		ubicacion=$("#ubicacion").val();
		if(ubicacion=="seleccione")
		{
			habilitarBoton=false;
		}
		
		categoria=$("#categoria").val();
		if(categoria=="seleccione")
		{
			habilitarBoton=false;
		}
		
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

	$("#nombre").change(function () {
		verificarCampos();
	});
	
	$("#categoria").change(function () {
		verificarCampos();
	});
	
	$("#ubicacion").change(function () {
		verificarCampos();
	});
</script>

</body>
</html>
