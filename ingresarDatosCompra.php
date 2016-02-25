<!doctype html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1, scalable=yes" />

<link href='http://fonts.googleapis.com/css?family=Libre+Baskerville:400italic' rel='stylesheet' type='text/css'>

<link href='http://fonts.googleapis.com/css?family=News+Cycle:400,700' rel='stylesheet' type='text/css'>

<meta charset="UTF-8">
<title>ARROPA - Tienda</title>


<link href="images/favicon_arropa.png" rel="shortcut icon">
<link href="reset.css" rel="stylesheet" type="text/css">
<link href="estilos.css" rel="stylesheet" type="text/css">
<link href="tabla.css" rel="stylesheet" type="text/css">

<link href="meanmenu.css" rel="stylesheet" type="text/css">

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js" type="text/javascript"></script>

</head>

<body>

<header> 
		
        <div class="wrap">
        <div id="logo">
        <img src="images/logo.png" alt=""/></div>

 		<div id="rs"> <h4>Síguenos:</h4>
        <a target="_blank" href="https://www.facebook.com/ArropaChile"><img src="images/rs_fb.png" alt=""/></a>
        <a target="_blank" href="http://instagram.com/arropachile"><img src="images/rs_ig.png" alt=""/></a> 
        <a target="_blank" href="https://twitter.com/ArropaChile"><img src="images/rs_tw.png" alt=""/></a>
        <a target="_blank" href="https://www.youtube.com/channel/UCrK6sYz-G66NnJLKHuiY_wA"><img src="images/rs_yt.png" alt=""/></a>
        
        <img src="images/carrito.png" class="carrito" alt=""/> <h4>Carrito </h4> </div>
		
  </div>
  
  </header>
 
<div class="clearfix"></div>
  
  <nav>
  	
    <div class="wrap">
    <div class="menudes"><ul><li><a href="index.php">INICIO</a></li>
        <li><a href="#caja_elestudio">PROCESO</a></li>
        <li><a href="quienessomos.html">QUIÉNES SOMOS</a></li>
        <li><a href="noticias.php">NOTICIAS</a></li>
        <li><a href="#caja_contacto">VOLUNTARIADO</a></li>
        <li><a href="tienda.php">TIENDA</a></li>
        <li><a href="#caja_contacto">CONTACTO</a></li>
        <div class="marca"></div></ul>
       
    </ul></div></div>
  
  </nav>

<div class="wrap">


<div id="cajacolumnas2">

	<aside class="tiendacol_izq">
	<div class="tiendacol_izq1">
    <h9><ul>
	<li ><a href="tienda.php">Novedades</a></li>
    <?php
	
		$conCategorias = include $_SERVER['DOCUMENT_ROOT']."/admin/crearConexion.php";
		
		//Se obtienen las categorías de productos
		$sqlCategorias="SELECT nombre FROM categorias ORDER BY nombre ASC";
						
		$resultCategorias = mysqli_query($conCategorias,$sqlCategorias);
		
		if($resultCategorias->num_rows==0){
			mysqli_close($conCategorias);
			header("location:tienda.php");
		}
		
		for ($i = 0 ; $i <$resultCategorias->num_rows; $i++) {
			$resultCategorias->data_seek($i);
			$fila = $resultCategorias->fetch_assoc();	
			
			if($i<($resultCategorias->num_rows-1)){
				echo '<div class="separadorcatalogo"></div>
				  <li ><a href="tienda.php?c='.urlencode($fila["nombre"]).'">'.$fila["nombre"].'</a></li>';
			}
			else{
				echo '<div class="separadorcatalogo"></div>
				  <li ><a href="tienda.php?c='.urlencode($fila["nombre"]).'">'.$fila["nombre"].'</a></li>';
			}
		}
		
		mysqli_close($conCategorias);
	
	?>
    </ul>
	</h9>
    </div>
	<aside class="tiendacol_izq2"><img src="images/webpay.png" alt=""></aside>
    </aside>
    
    
    
    <div id="tiendacol_der">
    <div class="h10class"><h10>Productos en su Carrito</h10></div>
    
    <div id="parrafotienda">
  	<h11>Usted está a punto de confirmar la compra de los siguientes productos. </h11> 
    <br><br><br>
    <div class="CSSTableGenerator" >
                <table >
                    <tr>
                        <td>Producto</td>
                        <td>Precio unidad</td>
                        <td>Cantidad</td>
                        <td>Total</td>                   
                    </tr>
			<?php
			//Se obtiene la cantidad de productos actual			
			$cantidadProductos = (int)$_COOKIE["cantidad"];
			
			if($cantidadProductos!=null)
			{
				if($cantidadProductos>0)				
				{
					$TotalVenta = 0;
					
					$cantidadPInt = (int)$cantidadProductos;					
					for($i=0;$i<$cantidadPInt;$i++){
						
						if($_COOKIE["producto".($i+1)]!=null){
							$con = include $_SERVER['DOCUMENT_ROOT']."/admin/crearConexion.php";
							
							//Se obtienen los datos del producto
							$sql="SELECT * FROM productos WHERE nombre='".$_COOKIE["producto".($i+1)]."'";
											
							$result = mysqli_query($con,$sql);
							
							if($result->num_rows==0){
								mysqli_close($con);
								exit;
							}
							
							for ($j = 0; $j <$result->num_rows; $j++) {
								$result->data_seek($j);
								$fila = $result->fetch_assoc();
								$cantidad=$fila["cantidad"];
								$valor=$fila["valor"];
							}
							
							mysqli_close($con);
							
							if((int)$cantidad>0 && $cantidad>(int)$_COOKIE["cantidad".($i+1)]){
								echo '<tr>
									<td>'.$_COOKIE["producto".($i+1)].'</td>
									<td>'.$valor.'</td>
									<td>'.$_COOKIE["cantidad".($i+1)].'</td>
									<td>'.(int)$_COOKIE["cantidad".($i+1)]*(int)$valor.'</td>
								</tr>';
								
								$TotalVenta += (int)$_COOKIE["cantidad".($i+1)]*(int)$valor;
							}
							else
							{
								echo '<tr>
									<td>'.$_COOKIE["producto".($i+1)].'</td>
									<td>$'.$valor.'</td>
									<td>'.$_COOKIE["cantidad".($i+1)].'</td>
									<td>$'.(int)$_COOKIE["cantidad".($i+1)]*(int)$valor.'</td>
								</tr>';
								
								$TotalVenta += (int)$_COOKIE["cantidad".($i+1)]*(int)$valor;
							}
						}
						
					}
				}
			}
			?>
                    <tr>
						<td colspan="2"></td>
                        <td><span class="bold"> Total s/IVA</span></td>
                        <td>$<?php echo $TotalVenta; ?></td>
                        </tr>
                        
						<?php 
						$IVA = $TotalVenta * 0.19;
						
						?>
						<td colspan="2"></td>
                        <td ><span class="bold">IVA</span></td>
                        <td >$<?php echo $IVA; ?></td>
                        </tr>
                        
						<td colspan="2"></td>
                        <td ><span class="bold">Total</span></td>
                        <td >$<?php echo ($TotalVenta + $IVA); ?></td>
                        </tr>
                
                </table><br>
                
            </div>
    <a href="tienda.php"><img src="images/carrito.png" class="carrito" alt=""/></a>
    <h4>Seguir comprando</h4>
  </div>

    
    <form action="realizarVenta.php" method="post">
    	<label>Nombre:</label>
    	<input name="nombre" id="nombre" type="text" required />
    	<br>
    	<label>Apellido:</label>
    	<input name="apellido" id="apellido" type="text" required />
    	<br>
    	<label>Dirección:</label>
    	<input name="direccion" id="direccion" type="text" required />
    	<br>
    	<label>Ciudad:</label>
    	<input name="ciudad" id="ciudad" type="text" required />
    	<br>
    	<label>Correo:</label>
    	<input name="correo" id="correo" type="text" required />
    	<br>
    	<label>Notas sobre la compra:</label>
    	<textarea name="notas" id="notas"rows="4"></textarea>
    	<br>
	    <?php
		if($TotalVenta>0)
		{
			echo '<button type="submit">Confirmar Compra</button>';
		}
		?>
	</form>
    <div class="clearfix"></div> 
  

  
  </div>

	


</div>
</div>
            
<div class="clearfix"></div>


<footer>
	<div class="wrap">
     	<div id="colfoot1">
        
        	<div id="colfootizq1">
            <h3>QUIENES SOMOS</h3> <br>
    <h2>Qué es ARROPA<br>
    Misión y visión<br>
    Equipo</h2><br><br>
    <h3>VOLUNTARIADO</h3>
            </div>
            
            <div id="colfootizq2">
            <h3>PROCESO</h3><br>
    <h2>Cómo funciona<br>
    Dónde funciona</h2><br><br><br>
    <h3>TIENDA</h3>
            </div>
            
            <div id="colfootizq3">
                <h3>NOTICIAS <br>
    <br><br><br><br><br><br>
    
    CONTACTO</h3><br>
   
            </div>
            <br><br>
           
        
        </div>
        
       
        <div id="colfoot2">
        <h3>Comparte con nosotros en tus redes:</h3>
        
        </div>
        
        <div class="clearfix"></div>
    
    
    
    

    <h2>Colaboran:</h2><br><br>
      <img src="images/footer/logo_evoluzion.png" alt=""/>
        
        <img src="images/footer/logo_muni.png" alt=""/>
        <img src="images/footer/logo_qmb.png" alt=""/>
        <img src="images/footer/logo_std.png" alt=""/>
        <img src="images/footer/logo_stic.png"alt=""/>
        <img src="images/footer/logo_lp.png" alt=""/>
    
    
    


	</div>

</footer>

<script src="/js/jquery.js"></script>
<script src="js/jquery.meanmenu.js"></script> 

<script>
jQuery(document).ready(function () {
    jQuery('body nav').meanmenu({meanscreenwidth:890,onePage: true});
});


</script>

</body>
</html>
