<?php
			$nombre = $_POST["nombre"];
			$apellido = $_POST["apellido"];
			$direccion = $_POST["direccion"];
			$ciudad = $_POST["ciudad"];
			$correo = $_POST["correo"];
			$notas = $_POST["notas"];
			
			//agregar los datos a la BD



	//Se hace la conexion:

	$con = new mysqli("localhost", "arropaor", "b0x724xBxV", "arropaor_bd");

	//Se avisa si falla la conexion:

	if ($con->connect_errno) {

		echo "Falló la conexión con MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;

	}

	

	if (!$con->set_charset("utf8")) {

				printf("Error cargando el conjunto de caracteres utf8: %s\n", $mysqli->error);

			}							

	

	//Se agregan los datos			

	$resultado = $con->query("INSERT INTO usuarios VALUES('$nombre','$apellido','$direccion','$ciudad','$notas','$correo',now())");

			
/*			
			
			echo '<h3>Realizar Venta de los Siguientes Productos</h3>';
			
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
			/*
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
			//*/
			
	//		echo '<br><br><a href="carrito.php">Volver al Carro</a>' 
?>