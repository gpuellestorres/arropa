<?php

	if($_GET["t"]!=null){
	
		$titulo = $_GET["t"];
		
		$con = new mysqli("localhost", "arropaor", "b0x724xBxV", "arropaor_bd");
		if (!$con) {
		  die('No se pudo conectar a la base de datos: ' . mysqli_error($con));
		}

		if (!$con->set_charset("utf8")) {
			printf("Error cargando el conjunto de caracteres utf8: %s\n", $mysqli->error);
		}
		
		$sql="SELECT * FROM noticias WHERE nombre='".$titulo."'";
						
		$result = mysqli_query($con,$sql);
		
		for ($i = 0; $i <$result->num_rows; $i++) {
			$result->data_seek($i);
			$fila = $result->fetch_assoc();	
			
			$texto=$fila["texto"];
			$fecha=$fila["fecha"];
			$imagen=$fila["imagen"];
			$bajada=$fila["bajada"];
		}
		
		mysqli_close($con);
	
	}
	else
	{
		header("location:noticias.php");
	}
?>

<!doctype html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1, scalable=yes" />

<link href='http://fonts.googleapis.com/css?family=Libre+Baskerville:400italic' rel='stylesheet' type='text/css'>

<link href='http://fonts.googleapis.com/css?family=News+Cycle:400,700' rel='stylesheet' type='text/css'>

<meta charset="UTF-8">
<title>ARROPA Chile</title>

<link href="jquery-ui.css" rel="stylesheet">

<style>
#enlaceNoticia:hover {
	text-decoration: underline;
	color:white
	!important
}
#enlaceNoticia{
	color: white; 
	text-decoration: none
}
.justifyText{
text-align : justify
}
</style>

<link href="images/favicon_arropa.png" rel="shortcut icon">
<link href="reset.css" rel="stylesheet" type="text/css">
<link href="estilos.css" rel="stylesheet" type="text/css">

<link href="meanmenu.css" rel="stylesheet" type="text/css">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js" type="text/javascript"></script>

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
        <div id="logo">
        <img class="margenlogo" src="images/logo.png" alt=""/></div>

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
    <div class="menudes"><ul><li><a href="index.html">INICIO</a></li>
        <li><a href="#caja_loquehacemos">QUIÉNES SOMOS</a></li>
        <li><a href="#caja_elestudio">PROCESO</a></li>
        <li><a href="#caja_portafolio">NOTICIAS</a></li>
        <li><a href="#caja_contacto">VOLUNTARIADO</a></li>
        <li><a href="#caja_portafolio">TIENDA</a></li>
        <li><a href="#caja_contacto">CONTACTO</a></li>
        <div class="marca"></div></ul>
       
    </ul></div></div>
  
  </nav>
  

  
<div class="wrap">
<div class="h10class2"><h10>Noticias</h10></div><br>
<div class="bordesuperior"></div>
       
        <article>
       
         
          <h7><?php echo $titulo;?></h7><br>
          <h8><?php echo $bajada;?><br>
          <?php echo 'Fecha '.$fecha;?></h8><br><br>
          
          <div class="fotonoticia"><img <?php echo 'src="/admin/'.$imagen.'"'; ?> alt="" width="40%" /></div><br><br>
			<h6 class="justifyText"><?php echo $texto; ?><br>
			COMPARTIR N FACEBOOK / COMENTARIOS DE FACEBOOK</h6>
          
        </article>
        <div class="clearfix"></div>
            <div id="botonmas"><a href="noticias.php"><h5>Atrás</h5></a></div>
            <div class="clearfix"></div>
        <div class="bordesuperior"></div>
		
		<?php
	
			if($_GET["p"]!=null){	
				$posicion = $_GET["p"];
			}
			else{
				$posicion=0;
			}
			//Se hace la conexion:
			$con = new mysqli("localhost", "arropaor", "b0x724xBxV", "arropaor_bd");
			//Se avisa si falla la conexion:
			if ($con->connect_errno) {
				echo "Falló la conexión con MySQL: (" . $con->connect_errno . ") " . $con->connect_error;
			}
			
			if (!$con->set_charset("utf8")) {
				printf("Error cargando el conjunto de caracteres utf8: %s\n", $con->error);
			}
			//Se hace la consulta
			$sql="SELECT * FROM noticias WHERE nombre<>'".$titulo."' ORDER BY fecha DESC";	
			$result = mysqli_query($con,$sql);
			mysqli_close($con);
		?>
		
          <div id="cajacolumnas2">
           
		   <?php					
					for ($i = 0; $i <$result->num_rows && $i<3; $i++) {
						$result->data_seek($i);
						$fila = $result->fetch_assoc();
						
						$j=$i+1;
						
						echo '<div id="noticia'.$j.'"><img src="/admin/'.$fila["imagen"].'" width="100%"></div>';
					}
			?>
			
            <div class="clearfix"></div>
			
			<?php		
					
					for ($i = 0; $i<$result->num_rows && $i<3; $i++) {
						$result->data_seek($i);
						$fila = $result->fetch_assoc();
						
						$j=$i+1;
						
						echo '<div id="color'.$j.'">
						<div id="cajanoticiascolor" style="height:97px !important">
						<h2><a id="enlaceNoticia" href="noticia.php?t='.$fila["nombre"].'"><span class="margennoticias">'.$fila["nombre"].'</span></a></h2>
						<div class="margenfecha"><h14>Fecha '.$fila["fecha"].'<br>
						<div class="parrafonoticia justifyText">'.str_replace("\n","<br>",mb_substr($fila["texto"],0,200)).'...'.'</div>
						</h14>
						</div>
						</div>
						</div>';						
					}			
			?>
            <div class="clearfix"></div>
            <div id="botonmas"><a href="noticias.php"><h5>Ver más noticias</h5></a></div>
	<div class="clearfix"></div>
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
            <div class="clearfix"></div>
            </div>
            <div class="clearfix"></div>
            </div>
        

       
        <div id="colfoot2">
        <h3>Comparte con nosotros en tus redes:</h3><br>
        <div id="colfoot21"><div class="fb-page" data-href="https://www.facebook.com/arropachile" data-width="200" data-height="300" data-hide-cover="false" data-show-facepile="true" data-show-posts="true"><div class="fb-xfbml-parse-ignore"><blockquote cite="https://www.facebook.com/arropachile"><a href="https://www.facebook.com/arropachile">Arropa Chile / La Tienda Social</a></blockquote></div></div></div>
        
      <div id="colfoot22"> <a class="twitter-timeline" width="200"
  height="300" href="https://twitter.com/ArropaChile" data-widget-id="593314699988574208">Tweets por el @ArropaChile.</a> <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script></div>
       
        </div>
        
        <div class="clearfix"></div>

    <h2>Colaboran:</h2><br><br>
    <a href="http://www.la-provincia.cl" target="_blank"><img src="images/footer/logo_lp.png" alt=""/></a>
     <img src="images/footer/logo_evoluzion.png" alt=""/>
        
        <img src="images/footer/logo_muni.png" alt=""/>
        <img src="images/footer/logo_qmb.png" alt=""/>
        <img src="images/footer/logo_std.png" alt=""/>
        <img src="images/footer/logo_stic.png"alt=""/><br><br>
        
        <h13>Sitio web desarrollado por <a href="http://www.la-provincia.cl" target="_blank">La Provincia</a> 2015</h13>
        <br>
  


	</div>

</footer>


<script src="external/jquery/jquery.js"></script>
<script src="jquery-ui.js"></script>
<script>


$( "#tabs" ).tabs();




// Hover states on the static widgets
$( "#dialog-link, #icons li" ).hover(
	function() {
		$( this ).addClass( "ui-state-hover" );
	},
	function() {
		$( this ).removeClass( "ui-state-hover" );
	}
);
</script>
<script src="/js/jquery.js"></script>
<script src="js/jquery.meanmenu.js"></script> 

<script>
jQuery(document).ready(function () {
    jQuery('body nav').meanmenu({meanscreenwidth:1030,onePage: true});
});


</script>

</body>
</html>