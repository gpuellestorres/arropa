<?php

	if($_GET["p"]!=null){
	
		$producto = $_GET["p"];
		
		$con = include $_SERVER['DOCUMENT_ROOT']."/admin/crearConexion.php";
		
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
						$nuevaCantidadProductoInt = $nuevaCantidadProductoInt-1;
						
						if($nuevaCantidadProductoInt>0){
							setcookie("cantidad".($i+1),(string)$nuevaCantidadProductoInt,time()+7200, '/', NULL, 0 );
						}
						else
						{	
							setcookie("producto".($i+1),$producto,time()-3600, '/', NULL, 0 );
							setcookie("cantidad".($i+1),(string)$nuevaCantidadProductoInt,time()-3600, '/', NULL, 0 );
						}
					}
				}
			}
		}
		
		header("location:carrito.php");
		exit;
	}
	else
	{
		header("location:carrito.php");
	}

?>