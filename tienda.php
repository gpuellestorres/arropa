<?php

	if($_GET["c"]!=null){
	
		$categoria = urldecode ($_GET["c"]);
		
		if($_GET["p"]!=null)
		{
			$pagina=$_GET["p"];
		}
		else $pagina=0;
		
		$con = include $_SERVER['DOCUMENT_ROOT']."/admin/crearConexion.php";
		
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
		

		
		$con = include $_SERVER['DOCUMENT_ROOT']."/admin/crearConexion.php";
		
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
		
		$con = include $_SERVER['DOCUMENT_ROOT']."/admin/crearConexion.php";
		
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

<link href="meanmenu.css" rel="stylesheet" type="text/css">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js" type="text/javascript"></script>
<?php include_once("analyticstracking.php") ?>
</head>

<body>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/es_LA/sdk.js#xfbml=1&version=v2.3&appId=134442489338";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<header> 
		
        <div class="wrap">
        <div id="logo"><a href="https://www.arropa.org/index.php"><img class="margenlogo" src="images/logo.png" alt=""/></a></div>

 		<div id="rs"> <span class="navtexto"><h4>Síguenos:</h4></span>
        <a target="_blank" href="https://www.facebook.com/ArropaChile"><img src="images/rs_fb.png" alt=""/></a>
        <a target="_blank" href="http://instagram.com/arropachile"><img src="images/rs_ig.png" alt=""/></a> 
        <a target="_blank" href="https://twitter.com/ArropaChile"><img src="images/rs_tw.png" alt=""/></a>
        <a target="_blank" href="https://www.youtube.com/channel/UCrK6sYz-G66NnJLKHuiY_wA"><img src="images/rs_yt.png" alt=""/></a>
        
        <img src="images/carrito.png" class="carrito" alt=""/> <span class="navtexto"><h4>Carrito </h4></span> </div>
		
  </div>
  
  </header>
  
<div class="clearfix"></div> 
  
  <nav>
  	
    <div class="wrap">
    <div class="menudes"><ul><li><a href="index.php">INICIO</a></li>
        <li><a href="somos.html">SOMOS</a></li>
        <li><a href="proceso.html">PROCESO</a></li>
        <li><a href="noticias.php">NOTICIAS</a></li>
        <li><a href="voluntariado.html">VOLUNTARIADO</a></li>
        <li><a href="tienda.php">TIENDA</a></li>
        <li><a href="contacto.html">CONTACTO</a></li>
        <div class="marca"></div></ul>
       
    </ul></div></div>
  
  </nav>
  <div class="clearfix"></div>


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
			
			$conB = include $_SERVER['DOCUMENT_ROOT']."/admin/crearConexion.php";
			
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
			
			$conB = include $_SERVER['DOCUMENT_ROOT']."/admin/crearConexion.php";
			
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
        
        	<div id="colfoot11">
        	<div id="colfootizq1">
            <a href="somos.html"><h3>SOMOS</h3></a> 
            <br>
    <h2>Qué es ARROPA<br>
    Misión y visión<br>
    Equipo</h2>
    
            </div>
       
            
            <div id="colfootizq2">
            <a href="proceso.html"><h3>PROCESO</h3></a><br>
    <h2>Cómo funciona<br>
    Dónde funciona</h2>
    
            </div>
                  
            <div id="colfootizq3">
                <a href="noticias.php"><h3>NOTICIAS</h3></a><br>
            </div>
            <div class="clearfix"></div>
            </div>
       
        
        <div class="clearfix"></div>
        <div id="colfoot12">
        	<div id="colfootizq1">
            <a href="voluntariado.html"><h3>VOLUNTARIADO</h3></a>
    
            </div>
       
            
            <div id="colfootizq2">
            <a href="tienda.php>.html"><h3>TIENDA</h3></a>
    
            </div>
                  
            <div id="colfootizq3">
                <a href="contacto.html"><h3>CONTACTO</h3></a>
            </div>
           
            </div>
            
            </div>
        

        <div class="activador"><div class="clearfix"></div></div>
       
        <div id="colfoot2">
        <h3>Comparte con nosotros en tus redes:</h3><br>
        <div id="colfoot21"><div class="fb-page" data-href="https://www.facebook.com/arropachile" data-width="200" data-height="300" data-hide-cover="false" data-show-facepile="true" data-show-posts="true"><div class="fb-xfbml-parse-ignore"><blockquote cite="https://www.facebook.com/arropachile"><a href="https://www.facebook.com/arropachile">Arropa Chile / La Tienda Social</a></blockquote></div></div></div>
        
      <div id="colfoot22"> <a class="twitter-timeline" width="200"
  height="300" href="https://twitter.com/ArropaChile" data-widget-id="593314699988574208">Tweets por el @ArropaChile.</a> <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script></div>
       
        </div>
        <div id="colfoot3">
    <h3>Colaboran:</h3><br><br> 
    <a href="http://www.laserena.cl" target="_blank"><img src="images/footer/logo_muni.png" alt=""/></a>
    <a href="http://www.jumpchile.com" target="_blank"><img src="images/footer/logo_jump.png" alt=""/></a>
    <a href="http://www.minvu.cl/opensite_20070212164909.aspx" target="_blank"><img src="images/footer/logo_qmb.png" alt=""/></a>
    <a href="http://www.evoluzion.org" target="_blank"><img src="images/footer/logo_evoluzion.png" alt=""/></a>
    <a href="http://www.la-provincia.cl" target="_blank"><img src="images/footer/logo_lp.png" alt=""/></a>
     
     
        
        
      <br><br></div>
        
        <div class="clearfix"></div>

    
        
        <h13>Sitio web desarrollado por <a href="http://www.la-provincia.cl" target="_blank">La Provincia</a> 2015</h13>
        <br>
  


	</div>

</footer>

<script src="jquery.meanmenu.js"></script> 

<script>
jQuery(document).ready(function () {
    jQuery('body nav').meanmenu({meanscreenwidth:1030,onePage: true});
});


</script>

  <script>
      $(document).ready(function(){
  $('.bxslider').bxSlider();
});
  </script>

</body>
</html>

