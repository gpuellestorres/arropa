<?php

	if($_GET["c"]!=null){
	
		$categoria = urldecode ($_GET["c"]);
		
		if($_GET["p"]!=null)
		{
			$pagina=$_GET["p"];
		}
		else $pagina=0;
		
		$con = new mysqli("localhost", "arropaor", "b0x724xBxV", "arropaor_bd");
		if (!$con) {
		  die('No se pudo conectar a la base de datos: ' . mysqli_error($con));
		}

		if (!$con->set_charset("utf8")) {
			printf("Error cargando el conjunto de caracteres utf8: %s\n", $mysqli->error);
		}
		
		//Se obtienen los datos del producto
		$sql="SELECT * FROM categorias WHERE nombre='".$categoria."'";
						
		$result = mysqli_query($con,$sql);
		
		if($result->num_rows==0){
			mysqli_close($con);
			header("location:tienda.php");
		}
		
		$result->data_seek(0);
		$fila = $result->fetch_assoc();	
		$categoria = $fila["nombre"];
		
		mysqli_close($con);
		

		
		$con = new mysqli("localhost", "arropaor", "b0x724xBxV", "arropaor_bd");
		if (!$con) {
		  die('No se pudo conectar a la base de datos: ' . mysqli_error($con));
		}

		if (!$con->set_charset("utf8")) {
			printf("Error cargando el conjunto de caracteres utf8: %s\n", $mysqli->error);
		}
		
		//Se obtienen los datos del producto
		$sql="SELECT * FROM productos WHERE categoria='".$categoria."'";
						
		$result = mysqli_query($con,$sql);
	}
	else
	{
		if($_GET["p"]!=null)
		{
			$pagina=$_GET["p"];
		}
		else $pagina=0;
		
		$con = new mysqli("localhost", "arropaor", "b0x724xBxV", "arropaor_bd");
		if (!$con) {
		  die('No se pudo conectar a la base de datos: ' . mysqli_error($con));
		}

		if (!$con->set_charset("utf8")) {
			printf("Error cargando el conjunto de caracteres utf8: %s\n", $mysqli->error);
		}
		
		//Se obtienen los datos del producto
		$sql="SELECT * FROM productos";
						
		$result = mysqli_query($con,$sql);
	}
?>

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
        <li><a href="quienessomos.html">QUIÉNES SOMOS</a></li>
        <li><a href="#caja_elestudio">PROCESO</a></li>
        <li><a href="noticias.php">NOTICIAS</a></li>
        <li><a href="#caja_contacto">VOLUNTARIADO</a></li>
        <li><a href="tienda.html">TIENDA</a></li>
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
	
		$conCategorias = new mysqli("localhost", "arropaor", "b0x724xBxV", "arropaor_bd");
		if (!$conCategorias) {
		  die('No se pudo conectar a la base de datos: ' . mysqli_error($conCategorias));
		}

		if (!$conCategorias->set_charset("utf8")) {
			printf("Error cargando el conjunto de caracteres utf8: %s\n", $mysqli->error);
		}
		
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
	<?php
		if($categoria!=null)
		{
			echo '<div class="h10class"><h10>'.$categoria.'</h10></div><br>';
		}	
		else{
			echo '<div class="h10class"><h10>Novedades</h10></div><br>';
		}
	?>
    
    
	<?php
				
		for ($i = (0 + $pagina*6); $i <$result->num_rows && $i<(3 + $pagina * 6); $i++) {
			$result->data_seek($i);
			$fila = $result->fetch_assoc();	
			
			$conB = new mysqli("localhost", "arropaor", "b0x724xBxV", "arropaor_bd");
			if (!$conB) {
			  die('No se pudo conectar a la base de datos: ' . mysqli_error($conB));
			}

			if (!$conB->set_charset("utf8")) {
				printf("Error cargando el conjunto de caracteres utf8: %s\n", $mysqli->error);
			}
			
			//Se obtiene la primera imagen del producto
			$sqlB="SELECT * FROM imagen_producto WHERE nombreProducto='".$fila['nombre']."' LIMIT 1";
							
			$resultB = mysqli_query($conB,$sqlB);
			
			for ($j = 0; $j <$resultB->num_rows; $j++) {
				$resultB->data_seek($j);
				$filaB = $resultB->fetch_assoc();
				
				$imagen = $filaB["imagen"];
			}
			
			mysqli_close($conB);
			
			$numero = $i%3+1;
			
			 echo '<div id="producto'.($numero).'">
				<img class="fotocatalogoresponsive" src="/admin/productos/imagen/'.$imagen.'" alt=""/><br>
				<H6 class="h6class"><a href="producto.php?t='.$fila["nombre"].'">'.$fila["nombre"].'</a></H6>
				<H11>Valor: $'.$fila["valor"].' CLP</H11>
			</div>';
		}
	
	?>
    
    <div class="clearfix"></div>

	<?php
				
		for ($i = (3 + $pagina*6); $i <$result->num_rows && $i<(6 + $pagina * 6); $i++) {
			$result->data_seek($i);
			$fila = $result->fetch_assoc();	
			
			$conB = new mysqli("localhost", "arropaor", "b0x724xBxV", "arropaor_bd");
			if (!$conB) {
			  die('No se pudo conectar a la base de datos: ' . mysqli_error($conB));
			}

			if (!$conB->set_charset("utf8")) {
				printf("Error cargando el conjunto de caracteres utf8: %s\n", $mysqli->error);
			}
			
			//Se obtiene la primera imagen del producto
			$sqlB="SELECT * FROM imagen_producto WHERE nombreProducto='".$fila['nombre']."' LIMIT 1";
							
			$resultB = mysqli_query($conB,$sqlB);
			
			for ($j = 0; $j <$resultB->num_rows; $j++) {
				$resultB->data_seek($j);
				$filaB = $resultB->fetch_assoc();
				
				$imagen = $filaB["imagen"];
			}
			
			mysqli_close($conB);
			
			$numero = $i%3+1;
			
			 echo '<div id="producto'.($numero).'">
				<img class="fotocatalogoresponsive" src="/admin/productos/imagen/'.$imagen.'" alt=""/><br>
				<H6 class="h6class"><a href="producto.php?t='.$fila["nombre"].'">'.$fila["nombre"].'</a></H6>
				<H11>Valor: $'.$fila["valor"].' CLP</H11>
			</div>';
		}
	
	?>    
	
	<div class="clearfix"></div>
	
	<?php 
	
	if($pagina>0){
		if($categoria==null){
			echo '<div id="botonmas"><h5>| <a href="tienda.php?p='.($pagina-1).'"><< Anterior</a></h5></div>';
		}		
		else
		{
			echo '<div id="botonmas"><h5>| <a href="tienda.php?c='.urlencode($categoria).'&p='.($pagina-1).'"><< Anterior</a></h5></div>';
		}
	}
	if(($pagina*6 + 6)<$result->num_rows){
		if($categoria==null){
			echo '<div id="botonmas"><h5>| <a href="tienda.php?p='.($pagina+1).'">Siguiente >></a></h5></div>';
		}
		else{
			echo '<div id="botonmas"><h5>| <a href="tienda.php?c='.urlencode($categoria).'&p='.($pagina+1).'">Siguiente >></a></h5></div>';
		}		
	}
	
	mysqli_close($con); 	
	?>
    
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

</body>
</html>
