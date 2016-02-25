<?php 
	if($_COOKIE["agregado"]!="si" || $_COOKIE["usuario"]!="arropa"){
	//if($_COOKIE["agregado"]!="si"){
		header("location:/login");
		exit;
	}

	include $_SERVER['DOCUMENT_ROOT']."/admin/header.php";	
?>

<div class="container">
    <div class="page-header">
        <h2 class="text-center">Datos de KHIPU</h2>
    </div>
    <br class="hidden-xs">
	<br class="hidden-xs">
	<div id="container">
		<div class="col-xs-12 col-sm-8 col-sm-offset-2">
			<form action="subir.php" method="post" enctype="multipart/form-data">
					<div class="col-sm-8 col-sm-offset-2">
						<div class="col-sm-12">
							<div class="form-group">
								<label for="nombre" class="control-label">Número de Usuario</label>
								<input class="form-control numero" type="text" name="idUsuario" id="idUsuario" value = "<?php echo include $_SERVER['DOCUMENT_ROOT']."/admin/khipu/obtenerID.php";?>"required>
							</div>
						</div>
						<div class="col-sm-12">
							<div class="form-group">
								<label for="nombre" class="control-label">Secret/Key</label>
								<input class="form-control numero" type="text" name="secret" id="secret" value = "<?php echo include $_SERVER['DOCUMENT_ROOT']."/admin/khipu/obtenerSecret.php";?>" required>
							</div>
						</div>
						<div class="clearfix"></div>
						<div class="modal-footer">
							<a href="/admin" class="btn btn-default btn-lg"><i class="glyphicon glyphicon-remove" aria-hidden="true"></i>&nbsp;Cancelar</a>
							<button id="botonAgregar" class="btn btn-primary btn-lg"><i class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></i>&nbsp;Guardar</button>
						</div>
					</div>
				</form>
		</div>
	</div>	
	
</div><!--body-->

<!-- jQuery -->
<script src="/js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="/js/bootstrap.min.js"></script>

<!-- Para el modal -->
<script type="text/javascript">
	function funcionDelete(name) {
		$("#text-modal").html("");
		var cadena = "eliminar.php?t=name";
		cadena = cadena.replace("name",name);
		$("#btn_delete").attr("href", cadena);
		$("#text-modal").append("¿Está seguro de que desea eliminar el producto <strong>" + name + "</strong>?");
	}
</script>

</body>
</html>
