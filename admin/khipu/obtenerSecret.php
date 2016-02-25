<?php

	function obtenerSecret()
	{
		//Se hace la conexion:
		$con = include $_SERVER['DOCUMENT_ROOT']."/admin/crearConexion.php";
		
		$sql="SELECT * FROM datos_khipu WHERE ID='1'";
		
		$result = mysqli_query($con,$sql);
		
		for ($i = 0; $i <$result->num_rows; $i++) {
			$result->data_seek($i);
			$fila = $result->fetch_assoc();						
			
			$ID = $fila['secret'];
		}
		mysqli_close($con);

		return $ID;
	}

	return obtenerSecret();
?>