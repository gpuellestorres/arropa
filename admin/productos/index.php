<?php 
	if($_COOKIE["agregado"]!="si"){	
		header("location:/login");
		exit;
	}
	include $_SERVER['DOCUMENT_ROOT']."/admin/header.php";	
?>

<div class="container">
    <div class="page-header">
        <h2 class="text-center">Productos del Sistema</h2>
    </div>
	<div class="table-responsive">
			<table class="table table-hover table-striped">
				<thead>
					<tr>
						<th>Nombre</th>
						<th>Cantidad</th>
						<th>Valor</th>
						<th>Categoría</th>
						<th>Ubicación</th>
						<th>Asignar Imágenes</th>
						<th>Editar</th>
						<th>Eliminar</th>
					</tr>
				</thead>
				<tbody>
					<?php
					//Se hace la conexion:
					$con = include $_SERVER['DOCUMENT_ROOT']."/admin/crearConexion.php";							
					
					$sql="SELECT * FROM productos ORDER BY nombre ASC";
					
					$result = mysqli_query($con,$sql);
					
					for ($i = 0; $i <$result->num_rows; $i++) {
						$result->data_seek($i);
						$fila = $result->fetch_assoc();						
						
						$nombreCod =  urlencode($fila["nombre"]);
						$nombreCod =  str_replace(" + ", " %2B ",$nombreCod);

						echo '<tr>
							<td>'.$fila["nombre"].'</td>
							<td>'.$fila["cantidad"].'</td>
							<td>'.$fila["valor"].'</td>
							<td>'.$fila["categoria"].'</td>
							<td>'.$fila["ubicacion"].'</td>
							<td><a href="imagen/index.php?p='.$fila["nombre"].'"><span class="glyphicon glyphicon-picture text-primary"></span></a></td>
							<td><a href="editar.php?t='.$nombreCod.'"><span class="glyphicon glyphicon-edit text-primary"></span></a></td>
							<td><a href="#" data-toggle="modal" data-target="#myModal" onclick="funcionDelete(\''.$nombreCod.'\')">
									<span class="glyphicon glyphicon-remove-circle text-danger"></span>
								</a></td>
						</tr>';
					}
					mysqli_close($con);
					?>
				</tbody>
			</table>
			<div class="modal-footer">
				<a href="agregar.php" class="btn btn-lg btn-default"><span class="glyphicon glyphicon-plus text-primary"></span>&nbsp;Nuevo Producto</a>
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
