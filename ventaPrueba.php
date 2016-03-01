<?php

	// Debemos conocer el $receiverId y el $secretKey de ante mano.
	//$receiver_id = include $_SERVER['DOCUMENT_ROOT']."/admin/khipu/obtenerID.php";
	//$secret = include $_SERVER['DOCUMENT_ROOT']."/admin/khipu/obtenerSecret.php";

	$receiverId = 43182;
	$secretKey = "7b32f743f795ac77cd9e7b99c1ccece20d1921cb";

	//Generamos una nueva venta con khipu

	require  $_SERVER['DOCUMENT_ROOT']. '/vendor/autoload.php';

	$configuration = new Khipu\Configuration();
	$configuration->setReceiverId($receiverId);
	$configuration->setSecret($secretKey);
	$configuration->setDebug(false);

	$client = new Khipu\ApiClient($configuration);
	$payments = new Khipu\Client\PaymentsApi($client);

	try 
	{
	    $response = $payments->paymentsPost("Cualquier cosa"
			        , 'CLP'
			        , 1000
			        , "Cobro por Venta de Productos - arropa.org"
			        , null
			        , null, null
			        , "http://arropa.org/retornoCompra.php"//Página de Retorno
			        , null
			        , "http://arropa.org/images/logo.png"
			        , null, null, null
			        , true
			        , "Guillermo"
			        , "gpuellestorres@gmail.com"
			        , true
			    );

	    $respuesta = json_decode($response);

		$id_venta = $respuesta->payment_id; 
		$url_pago = $respuesta->payment_url;

		//redireccionar al pago
		header("location:$url_pago");
	}
	catch (Exception $e) {
	    echo $e->getMessage();
	}

?>