<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Administrador - Arropa.org</title>

    <link href="/css/bootstrap.min.css" rel="stylesheet">
		
    <script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js" integrity="sha512-K1qjQ+NcF2TYO/eI3M6v8EiNYZfA95pQumfvcVrTHtwQVDG+aHRqLi/ETn2uB+1JqwYqVG3LIvdm9lj6imS/pQ==" crossorigin="anonymous"></script>

    <!-- Custom CSS -->

    <link href="/css/modern-business.css" rel="stylesheet">

    <!-- Custom Fonts -->

    <link href="/font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <script type="text/javascript" src="scripts/jHtmlArea-0.8.js"></script>
    <link rel="Stylesheet" type="text/css" href="style/jHtmlArea.css" />
        
    <style type="text/css">
        /* body { background: #ccc;} */
        div.jHtmlArea .ToolBar ul li a.custom_disk_button 
        {
            background: url(images/disk.png) no-repeat;
            background-position: 0 0;
        }
        
        div.jHtmlArea { border: solid 1px #ccc; }
    </style>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>

    <script type="text/javascript" src="https://cdn.jsdelivr.net/bootstrap.filestyle/1.1.0/js/bootstrap-filestyle.min.js"> </script>

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

			<li><a href="/admin/categorias">Categorias</a></li>

			<li><a href="/admin/ubicaciones">Ubicaciones</a></li>

			<li><a href="/admin/slider">Slider</a></li>

			</ul>

			<ul class="nav navbar-nav navbar-right">
				
				<li><a href="/admin/ventas">Registro de ventas</a></li>

				<?php
					if($_COOKIE["usuario"]=="arropa" || $_COOKIE["usuario"]=="Arropa"){	
						echo '<li><a href="/admin/usuarios">Usuarios del sistema</a></li>';
                        echo '<li><a href="/admin/khipu">Datos KHIPU</a></li>';
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
