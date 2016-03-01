<?php 
	if($_COOKIE["agregado"]!="si"){	
		header("location:/login");
		exit;
	}

	if($_GET["Inicio"]!=null){
		$Inicio = $_GET["Inicio"];
		$Inicio = explode("-", $Inicio);
		$INICIO = $Inicio[0] . '/' . $Inicio[1] .'/' . $Inicio[2];
		$Inicio = new DateTime($Inicio[2] . '-' . $Inicio[1] .'-' . $Inicio[0] . ' 00:00:00');
		$Inicio = $Inicio->format('Y-m-d H:i:s');
	}
	else
	{
		$Inicio = new DateTime('now');
		$Inicio->sub( new DateInterval('P1D') )->format('Y-m-d');
		$Inicio = $Inicio->format('Y-m-d H:i:s');

		$Inicio = explode(" ", $Inicio);
		$Inicio = explode("-", $Inicio[0]);
		$INICIO = $Inicio[2] . '/' . $Inicio[1] .'/' . $Inicio[0];
		$Inicio = new DateTime($Inicio[2] . '-' . $Inicio[1] .'-' . $Inicio[0] . ' 00:00:00');
		$Inicio = $Inicio->format('Y-m-d H:i:s');
	}

	if($_GET["Termino"]!=null){
		$Termino = $_GET["Termino"];
		$Termino = explode("-", $Termino);
		$TERMINO = $Termino[0] . '/' . $Termino[1] .'/' . $Termino[2];
		$Termino = new DateTime($Termino[2] . '-' . $Termino[1] .'-' . $Termino[0] . ' 00:00:00');
		$Termino = $Termino->format('Y-m-d H:i:s');
	}
	else
	{
		$Termino = new DateTime('now');
		$Termino->add(new DateInterval('P10D'))->format('Y-m-d');
		$Termino = $Termino->format('Y-m-d H:i:s');

		$Termino = explode(" ", $Termino);
		$Termino = explode("-", $Termino[0]);
		$TERMINO = $Termino[2] . '/' . $Termino[1] .'/' . $Termino[0];

		$Termino = new DateTime($Termino[2] . '-' . $Termino[1] .'-' . $Termino[0] . ' 00:00:00');
		$Termino = $Termino->format('Y-m-d H:i:s');
	}


	include $_SERVER['DOCUMENT_ROOT']."/admin/header.php";	
?>


	
<div class="container">
    <div class="page-header">
        <h2 class="text-center">Ventas del Sistema</h2>
    </div>
    <div class="col-sm-12">
		<div class="col-sm-3">
			<h4>Filtros:</h4>
		</div>
		<div class="col-sm-3">
			<label class="control-label">Inicio:</label>
			<input class="form-control fecha" id="inicio" name="inicio"
               data-val-date="Ingrese por favor una fecha." data-val-required="El campo fecha es obligatorio."
               data-date-format="DD/MM/YYYY" pattern="[0-9][0-9]/[0-9][0-9]/[0-9][0-9][0-9][0-9]"
               type="text" value="<?php echo $INICIO;?>" required>
		</div>
		<div class="col-sm-3">
			<label class="control-label">Término:</label>
			<input class="form-control fecha" id="termino" name="termino"
               data-val-date="Ingrese por favor una fecha." data-val-required="El campo fecha es obligatorio."
               data-date-format="DD/MM/YYYY" pattern="[0-9][0-9]/[0-9][0-9]/[0-9][0-9][0-9][0-9]"
               type="text" value="<?php echo $TERMINO;?>" required>
		</div>
		<div class="col-sm-3">
			<br class="hidden-xs">
			<button id="buscar" class="btn btn-default btn-lg btn-block">Buscar</button>
		</div>
	</div>
	<div class="clearfix"></div>
	<div class="table-responsive">
			<table class="table table-hover table-striped">
				<thead>
					<tr>
						<th>Fecha</th>
						<th>Total</th>
						<th>Pagado</th>
						<th>Ver Detalles</th>						
					</tr>
				</thead>
				<tbody>
					<?php
					//Se hace la conexion:
					$con = include $_SERVER['DOCUMENT_ROOT']."/admin/crearConexion.php";
					
					$sql="SELECT * FROM ventas WHERE fecha<='$Termino' AND fecha>='$Inicio' ORDER BY fecha ASC";
					
					$result = mysqli_query($con,$sql);
					
					for ($i = 0; $i <$result->num_rows; $i++) {
						$result->data_seek($i);
						$fila = $result->fetch_assoc();						
						
						echo '<tr>
							<td>'.$fila["fecha"].'</td>
							<td>'.$fila["total"].'</td>
							<td>'.$fila["pagado"].'</td>
							<td><a href="verDetalles.php?t='.$fila["ID"].'"><span class="glyphicon glyphicon-list-alt text-primary"></span></a></td>
						</tr>';
					}
					mysqli_close($con);
					?>
				</tbody>
			</table>
			
		</div>
	</div>


	
	
</div><!--body-->

<script type="text/javascript">    

	// A $( document ).ready() block.
	$( document ).ready(function() {
	    console.log( "ready!" );

	    $(".fecha").datetimepicker({
                    viewMode: 'days',
                    format: 'DD/MM/YYYY'
                });
	    $(".hora").datetimepicker({
                    viewMode: 'days',
                    format: 'h:mm a'
                });

	    $("#buscar").click(function()
	    	{
	    		window.location = "index.php?Inicio="+$("#inicio").val().replace("/","-").replace("/","-")+"&Termino="+$("#termino").val().replace("/","-").replace("/","-");
	    	});

	});
</script>


</body>
</html>
