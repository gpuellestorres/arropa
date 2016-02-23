<?php 
	if($_COOKIE["agregado"]!="si"){	
		header("location:/login");
		exit;
	}

	include $_SERVER['DOCUMENT_ROOT']."/admin/header.php";	
?>


	
<div class="container">
    <div class="page-header">
        <h2 class="text-center">Ventas del Sistema</h2>
    </div>
	<div class="table-responsive">
			<table class="table table-hover table-striped">
				<thead>
					<tr>
						<th>Nombre</th>
						<th>Apellido</th>
						<th>Dirección</th>
						<th>Ciudad</th>
						<th>Correo</th>
						<th>Notas</th>
						<th>Fecha</th>
						
					</tr>
				</thead>
				<tbody>
					<?php
					//Se hace la conexion:
					$con = include $_SERVER['DOCUMENT_ROOT']."/admin/crearConexion.php";
					
					$sql="SELECT * FROM usuarios ORDER BY fecha DESC";
					
					$result = mysqli_query($con,$sql);
					
					for ($i = 0; $i <$result->num_rows; $i++) {
						$result->data_seek($i);
						$fila = $result->fetch_assoc();						
						
						echo '<tr>
							<td>'.$fila["nombre"].'</td>
							<td>'.$fila["apellido"].'</td>
							<td>'.$fila["direccion"].'</td>
							<td>'.$fila["ciudad"].'</td>
							<td>'.$fila["correo"].'</td>														<td>'.$fila["notas"].'</td>														<td>'.$fila["fecha"].'</td>
							
						</tr>';
					}
					mysqli_close($con);
					?>
				</tbody>
			</table>
			
		</div>
	</div>


	
	
</div><!--body-->

<!-- jQuery -->
<script src="/js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="/js/bootstrap.min.js"></script>

<!-- Para el modal -->


</body>
</html>
