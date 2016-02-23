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
	
	$sql="SELECT * FROM imagen_producto WHERE nombreProducto='$nombreProducto'";
					
	$result = mysqli_query($con,$sql);
	
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
        <h2 class="text-center">Imágenes del producto "<?php echo $nombreProducto;?>"</h2>
    </div>
	<div class="table-responsive">
			<table class="table table-hover table-striped">
				<thead>
					<tr>
						<th>NombreProducto</th>
						<th>Imagen</th>
						<th>Eliminar</th>
					</tr>
				</thead>
				<tbody>
					<?php
					
					for ($i = 0; $i <$result->num_rows; $i++) {
						$result->data_seek($i);
						$fila = $result->fetch_assoc();						
						
						echo '<tr>
							<td>'.$fila["nombreProducto"].'</td>
							<td class="col-sm-2"><img src="/admin/productos/imagen/'.$fila["imagen"].'" alt="error de imagen" width="60%" class="img-rounded img-responsive"></td>
							<td><a href="#" data-toggle="modal" data-target="#myModal" onclick="funcionDelete(\''.$fila["imagen"].'\',\''.$fila["nombreProducto"].'\')">
									<span class="glyphicon glyphicon-remove-circle text-danger"></span>
								</a></td>
						</tr>';
					}
					?>
				</tbody>
			</table>
			<div class="modal-footer">
				<a href="agregar.php?p=<?php echo $nombreProducto;?>" class="btn btn-lg btn-default"><span class="glyphicon glyphicon-plus text-primary"></span>&nbsp;Nueva Imagen</a>
			</div>
		</div>
	</div>


	<!-- Modal -->
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<h4 class="modal-title text-center" id="myModalLabel">¿Eliminar Producto?</h4>
				</div>
				<div class="modal-body">
					<h5 class="text-center" id="text-modal"></h5>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal"><i class="glyphicon glyphicon-remove"></i>Cancelar</button>
					<a href="" type="button" id="btn_delete" class="btn btn-primary"><i class="glyphicon glyphicon-ok"></i>Eliminar</a>
				</div>
			</div>
		</div>
	</div>
	
</div><!--body-->

<!-- jQuery -->
<script src="/js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="/js/bootstrap.min.js"></script>

<!-- Para el modal -->
<script type="text/javascript">
	function funcionDelete(imagen, producto) {
		$("#text-modal").html("");
		var cadena = "eliminar.php?i=imagen&p=producto";
		cadena = cadena.replace("imagen",imagen);
		cadena = cadena.replace("producto",producto);
		$("#btn_delete").attr("href", cadena);
		$("#text-modal").append("¿Está seguro de que desea eliminar la imagen del producto <strong>" + producto + "</strong>?");
	}
</script>

</body>
</html>
