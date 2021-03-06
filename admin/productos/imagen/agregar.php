<?php 
	if($_COOKIE["agregado"]!="si"){
		header("location:/login");
		exit;
	}
	
	if($_GET["p"]!=null){
	
	$nombreProducto = $_GET["p"];
	
	$con = include $_SERVER['DOCUMENT_ROOT']."/admin/crearConexion.php";
	
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

	include $_SERVER['DOCUMENT_ROOT']."/admin/header.php";	
?>

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
