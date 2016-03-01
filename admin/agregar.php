<?php 

	if($_COOKIE["agregado"]!="si"){	

		header("location:/login");

		exit;

	}

include $_SERVER['DOCUMENT_ROOT']."/admin/header.php";	

?>

<div class="container">		

	<div class="page-header">

		<h2 class="text-center">Agregar Noticia <small>Arropa Chile</small></h2>

	</div>

	<br class="hidden-xs">

	<br class="hidden-xs">

	<div id="contenido">

		<div class="rows">

			<div class="col-xs-12 col-sm-12 col-md-10 col-md-offset-1">

				<form action="subir.php" method="post" enctype="multipart/form-data">

						<div class="row">

							<div class="col-sm-6">

								<div id="divNombre" class="form-group">

									<label for="nombre" class="control-label">Nombre de la Noticia</label>

									<input type="text" class="form-control" name="nombre" id="nombre" 

									maxlength="200" placeholder="nombre de noticia" required>

									<span id="spanInput" class="glyphicon form-control-feedback"></span>

									<div id="mensajeError" class="alert alert-danger hidden">

										<strong>Error: </strong> ya existe una noticia con ese nombre en el sistema

									</div>

								</div>

							</div>

							<div class="clearfix"></div>

							<div class="col-sm-12">

								<div class="form-group">

									<label for="descripcion" class="control-label">Bajada de título</label>

									<input type="text" placeholder="Bajada de título" class="form-control" 

									name="bajada" id="bajada" maxlength="100" required>

								</div>

							</div>	
							
							<div class="col-sm-12">

								<div class="form-group">

									<label for="descripcion" class="control-label">Texto</label>    
    <textarea id="txtDefaultHtmlArea" name="texto" cols="100" rows="15"><p><h3>Prueba H3</h3>Este texto es de <b>prueba</b>.</p></textarea>
	
								</div>

							</div>							

							<div class="col-sm-4">

								<div class="form-group">

									<label for="imagen1" class="control-label">Imagen</label>

									<input type="file" class="form-control" name="imagen" required>

								</div>

							</div>

						</div>

						<br />

						<br />

						<div class="modal-footer">

							<a href="/admin" class="btn btn-default btn-lg"><i class="glyphicon glyphicon-remove" aria-hidden="true"></i>&nbsp;Cancelar</a>

							<button id="botonAgregar" class="btn btn-primary btn-lg"><i class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></i>&nbsp;Agregar</button>

						</div>

					</form>

			</div>

		</div>		

	</div>	

</div> 
<!-- Bootstrap Core JavaScript -->

<script src="/js/bootstrap.min.js"></script>

<script type="text/javascript">    

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

<!-- Bootstrap filestyle -->

<script src="/js/bootstrap-filestyle.min.js"></script>

<script>

	$(":file").filestyle({

		buttonText: "Agregar imagen",

		input:false

		});

		

		

	$("#nombre").change(function () {

		nombre=$("#nombre").val();

		

		console.log("nombre: "+nombre);

		

		$.get( "verificarNombre.php", { nombre: nombre } )

			.done(function( data ) {

				console.log(data);

				if(data=="true")

				{

					$("#divNombre").addClass(" has-error");

					$("#divNombre").addClass(" has-feedback");

					$("#divNombre").removeClass(" has-success");

					$("#spanInput").addClass("glyphicon-remove");

					$("#spanInput").removeClass("glyphicon-ok");

					$("#botonAgregar").attr("disabled", "disabled");

					$("#mensajeError").removeClass("hidden");

				}

				else 

				{

					$("#divNombre").removeClass(" has-error");

					$("#divNombre").addClass(" has-feedback");

					$("#divNombre").addClass(" has-success");

					$("#spanInput").addClass("glyphicon-ok");

					$("#spanInput").removeClass("glyphicon-remove");

					$("#botonAgregar").removeAttr("disabled");

					$("#mensajeError").addClass("hidden");

				}

			});		

	});
</script>
	
</body>
</html>
