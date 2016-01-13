<?php 
	if($_COOKIE["agregado"]!="si"){	
		header("location:/login");
		exit;
	}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Administrador - Arropa.org</title>
  <!-- Bootstrap Core CSS -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="/css/modern-business.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link hrefce="/font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
</head>
<body style="background-color:#FAFAFA !important">	
	
<nav role="navigation" class="navbar navbar-fixed-top navbar-inverse">
	<div class="container-fluid">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
			<button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a href="/admin" class="navbar-brand">Arropa.org</a>
		</div>
		<!-- Collection of nav links and other content for toggling -->
		<div id="navbarCollapse" class="collapse navbar-collapse">
			<ul class="nav navbar-nav">
			<li><a href="/admin">Noticias</a></li>
			<li><a href="/admin/productos">Productos</a></li>
			<li><a href="/admin/categorias">Categorias</a></li>						<li><a href="ventas.php">Registro de ventas</a></li>
			<li><a href="/admin/ubicaciones">Ubicaciones</a></li>
			<li><a href="/admin/slider">Slider</a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
			<?php
				if($_COOKIE["usuario"]=="arropa"){	
					echo '<li><a href="/admin/usuarios">Usuarios del sistema</a></li>';
				}
			?>
				<li class="dropdown">
					<a data-toggle="dropdown" class="dropdown-toggle" href="#">Mi Cuenta<b class="caret"></b></a>
					<ul role="menu" class="dropdown-menu">
						<li><a href="cambiarContrasena.php">Cambiar mi Contraseña</a></li>
						<li><a href="/login/index.php?close=1">Salir</a></li>
					</ul>
				</li>
			</ul>
		</div>
	</div>
</nav>
	
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