<?php

	if($_GET["p"]!=null){
	
		$producto = $_GET["p"];
		
		$con = new mysqli("localhost", "arropaor", "b0x724xBxV", "arropaor_bd");
		if (!$con) {
		  die('No se pudo conectar a la base de datos: ' . mysqli_error($con));
		}

		if (!$con->set_charset("utf8")) {
			printf("Error cargando el conjunto de caracteres utf8: %s\n", $mysqli->error);
		}
		
		//Se obtienen los datos del producto
		$sql="SELECT * FROM productos WHERE nombre='".$producto."'";
						
		$result = mysqli_query($con,$sql);
		
		if($result->num_rows==0){
			mysqli_close($con);
			header("location:tienda.php");
		}
		
		for ($i = 0; $i <$result->num_rows; $i++) {
			$result->data_seek($i);
			$fila = $result->fetch_assoc();	
			
			$descripcion=$fila["descripcion"];
			$cantidad=$fila["cantidad"];
			$valor=$fila["valor"];
			$categoria=$fila["categoria"];
		}
		mysqli_close($con);
		
		if($cantidad>0)
		{
			//Se obtiene la cantidad de productos actual			
			$cantidadProductos = (int)$_COOKIE["cantidad"];
			
			if($cantidadProductos!=null)
			{
				if($cantidadProductos>0)				
				{						
					$productoEncontrado = false;
					
					$cantidadPInt = (int)$cantidadProductos;
					
					for($i=0;$i<$cantidadPInt;$i++)
					{						
						$productoI=$_COOKIE["producto".($i+1)];
						
						if($productoI==$producto){
							$productoEncontrado = true;
							
							$nuevaCantidadProducto = $_COOKIE["cantidad".($i+1)];
							
							$nuevaCantidadProductoInt = (int)$nuevaCantidadProducto;
							$nuevaCantidadProductoInt = $nuevaCantidadProductoInt+1;
							
							if($nuevaCantidadProductoInt<=$cantidad){
								setcookie("cantidad".($i+1),(string)$nuevaCantidadProductoInt,time()+7200, '/', NULL, 0 );
							}
							else
							{
								setcookie("cantidad".($i+1),(string)$cantidad,time()+7200, '/', NULL, 0 );
							}
						}
					}
					
					if(!$productoEncontrado)
					{
						$nuevaCantidad = $cantidadProductos+1;
						setcookie("cantidad",$nuevaCantidad,time()+7200, '/', NULL, 0 );
						setcookie("producto".$nuevaCantidad,$producto,time()+7200, '/', NULL, 0 );
						setcookie("cantidad".$nuevaCantidad,1,time()+7200, '/', NULL, 0 );
					}
				}
			}
			else{
				//las cookies expiran en una hora:			
				setcookie("cantidad",1,time()+7200, '/', NULL, 0 );
				setcookie("producto1",$producto,time()+7200, '/', NULL, 0 );
				setcookie("cantidad1",1,time()+7200, '/', NULL, 0 );
			}
			
			header("location:carrito.php");
			exit;
		}
		else
		{
			header("location:productos.php?t=$titulo");
		}	
	}
	else
	{
		header("location:producto.php?t=");
	}

?>