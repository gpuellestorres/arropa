<?php 
	if($_COOKIE["agregado"]!="si"){	
		header("location:/login");
		exit;
	}
	if($_GET["t"]!=null){
	
		$ID = $_GET["t"];

		//Se hace la conexion:
		$con = include $_SERVER['DOCUMENT_ROOT']."/admin/crearConexion.php";
		
		$sql="SELECT * FROM ventas WHERE ID='$ID'";
		
		$result = mysqli_query($con,$sql);
		
		for ($i = 0; $i <$result->num_rows; $i++) {
			$result->data_seek($i);
			$fila = $result->fetch_assoc();						
			
			$fecha = $fila['fecha'];
			$url_pago = $fila['url_pago'];
			$id_venta = $fila['id_venta'];
			$pagado = $fila['pagado'];
			$total = $fila['total'];
		}
		mysqli_close($con);
	}
	else 
	{
		exit;
	}

	include $_SERVER['DOCUMENT_ROOT']."/admin/header.php";	
?>

<div class="container">

	<div class="col-sm-4">
		<div class="page-header">
			<h3>Datos de la Venta</h3>
		</div>
		<label>Fecha</label>
		<p><?php echo $fecha; ?></p>
		<label>URL de Pago KHIPU</label>
		<p><a target="_blank" href="<?php echo $url_pago; ?>"><?php echo $url_pago; ?></a></p>
		<label>ID de Venta KHIPU</label>
		<p><?php echo $id_venta; ?></p>
		<label>Pagado</label>
		<p><?php echo $pagado; ?></p>
		<label>Total (IVA incluido)</label>
		<p><?php echo $total; ?></p>
	</div>



<?php 


	//Se hace la conexion:
	$con = include $_SERVER['DOCUMENT_ROOT']."/admin/crearConexion.php";
	
	$sql="SELECT * FROM usuarios WHERE ventaID='$ID'";
	
	$result = mysqli_query($con,$sql);
	
	for ($i = 0; $i <$result->num_rows; $i++) {
		$result->data_seek($i);
		$fila = $result->fetch_assoc();						
		
		$nombre = $fila['nombre'];
		$apellido = $fila['apellido'];
		$direccion = $fila['direccion'];
		$ciudad = $fila['ciudad'];
		$notas = $fila['notas'];
		$correo = $fila['correo'];
	}
	mysqli_close($con);
?>

	<div class="col-sm-4">
		<div class="page-header">
			<h3>Datos del comprador</h3>
		</div>
		<label>Nombre</label>
		<p><?php echo $nombre . " " . $apellido; ?></p>
		<label>Dirección</label>
		<p><?php echo $direccion; ?></p>
		<label>Ciudad</label>
		<p><?php echo $ciudad; ?></p>
		<label>Correo</label>
		<p><?php echo $correo; ?></p>
		<label>Notas</label>
		<p><?php echo $notas; ?></p>
	</div>

	<div class="col-sm-4">
		<div class="page-header">
			<h3>Detalle de Venta</h3>
		</div>
		<div class="table-responsive">
			<table class="table table-striped table-hover table-bordered">
			    <thead>
			      <tr>
			        <th>Producto</th>
			        <th>Cantidad</th>
			        <th>Precio</th>
			        <th>Total</th>
			      </tr>
			    </thead>
			    <tbody>

<?php 


	//Se hace la conexion:
	$con = include $_SERVER['DOCUMENT_ROOT']."/admin/crearConexion.php";
	
	$sql="SELECT * FROM detalle_ventas WHERE ventaID='$ID'";
	
	$result = mysqli_query($con,$sql);
	
	$neto = 0;
	for ($i = 0; $i <$result->num_rows; $i++) {
		$result->data_seek($i);
		$fila = $result->fetch_assoc();						
		
		$producto = $fila['producto'];
		$cantidad = $fila['cantidad'];
		$precio = $fila['precio'];

		$totalProducto = (int)$cantidad * (int)$precio;
		$neto+=$totalProducto;

		echo "<tr>
        <td>$producto</td>
        <td>$cantidad</td>
        <td>$precio</td>
        <td>$totalProducto</td>
      </tr>";
	}
	$IVA = $neto * 0.19;
	$TOTAL = $neto + $IVA;
	mysqli_close($con);
?>
				<tr>					
					<td colspan="2"></td>
					<td>Total Neto</td>
					<td><?php echo $neto; ?></td>
				</tr>
				<tr>
					<td colspan="2"></td>
					<td>IVA</td>
					<td><?php echo $IVA; ?></td>
				</tr>
				<tr>
					<td colspan="2"></td>
					<td>Total</td>
					<td><?php echo $TOTAL; ?></td>
				</tr>
				</tbody>
		  	</table>
		</div>
	</div>
</div>