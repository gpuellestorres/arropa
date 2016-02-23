<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Administrador - Arropa.org</title>

    <link href="/css/bootstrap.min.css" rel="stylesheet">
		


    <!-- Custom CSS -->

    <link href="/css/modern-business.css" rel="stylesheet">



    <!-- Custom Fonts -->

    <link hrefce="/font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<script type="text/javascript" src="scripts/jquery-1.3.2.js"></script>

    <script type="text/javascript" src="scripts/jquery-ui-1.7.2.custom.min.js"></script>
    <link rel="Stylesheet" type="text/css" href="style/jqueryui/ui-lightness/jquery-ui-1.7.2.custom.css" />

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
</head>
<body style="background-color:#FAFAFA !important">
    <script type="text/javascript">    
        // You can do this to perform a global override of any of the "default" options
        // jHtmlArea.fn.defaultOptions.css = "jHtmlArea.Editor.css";

        $(function() {
            //$("textarea").htmlarea(); // Initialize all TextArea's as jHtmlArea's with default values

            $("#txtDefaultHtmlArea").htmlarea(); // Initialize jHtmlArea's with all default values

            $("#txtCustomHtmlArea").htmlarea({
                // Override/Specify the Toolbar buttons to show
                toolbar: [
                    ["bold", "italic", "underline", "|", "forecolor"],
                    ["p", "h1", "h2", "h3", "h4", "h5", "h6"],
                    ["link", "unlink", "|", "image"],                    
                    [{
                        // This is how to add a completely custom Toolbar Button
                        css: "custom_disk_button",
                        text: "Save",
                        action: function(btn) {
                            // 'this' = jHtmlArea object
                            // 'btn' = jQuery object that represents the <A> "anchor" tag for the Toolbar Button
                            alert('SAVE!\n\n' + this.toHtmlString());
                        }
                    }]
                ],

                // Override any of the toolbarText values - these are the Alt Text / Tooltips shown
                // when the user hovers the mouse over the Toolbar Buttons
                // Here are a couple translated to German, thanks to Google Translate.
                toolbarText: $.extend({}, jHtmlArea.defaultOptions.toolbarText, {
                        "bold": "fett",
                        "italic": "kursiv",
                        "underline": "unterstreichen"
                    }),

                // Specify a specific CSS file to use for the Editor
                css: "style//jHtmlArea.Editor.css",

                // Do something once the editor has finished loading
                loaded: function() {
                    //// 'this' is equal to the jHtmlArea object
                    //alert("jHtmlArea has loaded!");
                    //this.showHTMLView(); // show the HTML view once the editor has finished loading
                }
            });
        });
    </script>
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
				
				<li><a href="ventas.php">Registro de ventas</a></li>

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
