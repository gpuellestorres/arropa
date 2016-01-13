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
			<li><a href="/admin">Noticias</a></li>			<li><a href="/admin/productos">Productos</a></li>			<li><a href="/admin/categorias">Categorias</a></li>						<li><a href="/admin/ventas.php">Registro de ventas</a></li>			<li><a href="/admin/ubicaciones">Ubicaciones</a></li>			<li><a href="/admin/slider">Slider</a></li>
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
        <h2 class="text-center">Imágenes del slider</h2>
    </div>
	<div class="table-responsive">
			<table class="table table-hover table-striped">
				<thead>
					<tr>
						<th>Nombre</th>
						<th>Imagen</th>
						<th>Eliminar</th>
					</tr>
				</thead>
				<tbody>
					<?php
					//Se hace la conexion:
					$con = include $_SERVER['DOCUMENT_ROOT']."/admin/crearConexion.php";
					
					$sql="SELECT * FROM slider ORDER BY imagen DESC";
					
					$result = mysqli_query($con,$sql);
					
					for ($i = 0; $i <$result->num_rows; $i++) {
						$result->data_seek($i);
						$fila = $result->fetch_assoc();						
						
						echo '<tr>
							<td>'.$fila["imagen"].'</td>
							<td class="col-sm-2"><img src="/admin/slider/'.$fila["imagen"].'" alt="error de imagen" width="60%" class="img-rounded img-responsive"></td>
							<td><a href="#" data-toggle="modal" data-target="#myModal" onclick="funcionDelete(\''.$fila["imagen"].'\')">
									<span class="glyphicon glyphicon-remove-circle text-danger"></span>
								</a></td>
						</tr>';
					}
					mysqli_close($con);
					?>
				</tbody>
			</table>
			<div class="modal-footer">
				<a href="agregar.php" class="btn btn-lg btn-default"><span class="glyphicon glyphicon-plus text-primary"></span>&nbsp;Nueva Imagen</a>
			</div>
		</div>
	</div>


	<!-- Modal -->
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<h4 class="modal-title text-center" id="myModalLabel">¿Eliminar Imagen?</h4>
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
		$("#text-modal").append("¿Está seguro de que desea eliminar la imagen <strong>" + name + "</strong>?");
	}
</script>

</body>
</html>
