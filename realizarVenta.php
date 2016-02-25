<?php
			$nombre = $_POST["nombre"];
			$apellido = $_POST["apellido"];
			$direccion = $_POST["direccion"];
			$ciudad = $_POST["ciudad"];
			$correo = $_POST["correo"];
			$notas = $_POST["notas"];



			
/*			echo '<h3>Realizar Venta de los Siguientes Productos</h3>';
			
			//Se obtiene la cantidad de productos actual			
			$cantidadProductos = (int)$_COOKIE["cantidad"];
			
			if($cantidadProductos!=null)
			{
				if($cantidadProductos>0)				
				{					
					$cantidadPInt = (int)$cantidadProductos;
					
					for($i=0;$i<$cantidadPInt;$i++)
					{	
						if($_COOKIE["producto".($i+1)]!=null)
						{
							echo '<br><br>Producto: ' .$_COOKIE["producto".($i+1)]. '<br>Cantidad: '.$_COOKIE["cantidad".($i+1)];
						}
					}
				}
			}
			// unset cookies
			if (isset($_SERVER['HTTP_COOKIE'])) {
				$cookies = explode(';', $_SERVER['HTTP_COOKIE']);
				foreach($cookies as $cookie) {
					$parts = explode('=', $cookie);
					$name = trim($parts[0]);
					setcookie($name, '', time()-1000);
					setcookie($name, '', time()-1000, '/');
				}
			}
			
			echo '<br><br><a href="carrito.php">Volver al Carro</a>' 
			//*/


		
			//Se obtiene la cantidad de productos actual			
			$cantidadProductos = (int)$_COOKIE["cantidad"];
			
			if($cantidadProductos!=null)
			{
				if($cantidadProductos>0)				
				{
					$TotalVenta = 0;
					
					$cantidadPInt = (int)$cantidadProductos;
					//Generamos un número de ID de Venta Aleatorio:
					$idAleatorio = rand(1,1000);
					$idAleatorio = $idAleatorio *-1;


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
							
							if((int)$cantidad>0 && $cantidad>=(int)$_COOKIE["cantidad".($i+1)]){

									//Se inserta la compra en la BD:
									$conDetalle = include $_SERVER['DOCUMENT_ROOT']."/admin/crearConexion.php";
							
									//Se obtienen los datos del producto
									$sqlDetalle="INSERT INTO detalle_ventas(ventaID, producto, cantidad, precio) VALUES('$idAleatorio','".$_COOKIE["producto".($i+1)]."','".$_COOKIE["cantidad".($i+1)]."','$valor')";
													
									$resultDetalle = mysqli_query($conDetalle,$sqlDetalle);
									
									mysqli_close($conDetalle);
								
									$TotalVenta += (int)$_COOKIE["cantidad".($i+1)]*(int)$valor;
									$IVA = $TotalVenta * 0.19;
									$TOTAL = $TotalVenta + $IVA;
							}
						}
						
					}
					//Generamos una nueva venta con khipu

					$url_pago = "URL_DE_PAGO";
					$id_venta = "IDDEVENTA";

					//Registramos la venta en la BD y actualizamos los ID del detalle
					$con = include $_SERVER['DOCUMENT_ROOT']."/admin/crearConexion.php";
					
					//Se obtienen los datos del producto
					$sql="INSERT INTO ventas(url_pago, id_venta, total) VALUES('$url_pago', '$id_venta', '$TOTAL')";
									
					$result = mysqli_query($con,$sql);

					$nuevaIDVenta =  mysqli_insert_id($con);
					
					//Se actualizan los detalles de la venta:
					$sql="UPDATE detalle_ventas SET ventaID='$nuevaIDVenta' WHERE ventaID='$idAleatorio'";
									
					$result = mysqli_query($con,$sql);

					mysqli_close($con);//*/
				}
			}

			$con = include $_SERVER['DOCUMENT_ROOT']."/admin/crearConexion.php";	
			$resultado = $con->query("INSERT INTO usuarios(nombre, apellido, direccion, ciudad, notas, correo, ventaID) VALUES('$nombre','$apellido','$direccion','$ciudad','$notas','$correo', '$nuevaIDVenta')");
			mysqli_close($con);//*/

?>