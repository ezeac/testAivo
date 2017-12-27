<?php
	if (!isset($_REQUEST["id"])) {
		$respuesta = '{"error":"No se ingresó un ID para mostrar. Llamada correcta: "localhost/buscar/{idPerfil}" (id de muestra: 10215911327682909)"}';
		echo $respuesta;
		die();
	}

	require_once __DIR__ . '/vendor/autoload.php';

	$fb = new Facebook\Facebook([
		'app_id' => '2154473484570395',
		'app_secret' => '6bc8e87316022dd5f9c4dc3a063310be',
		'default_graph_version' => 'v2.2',
	]);

	$helper = $fb->getJavaScriptHelper();

	try {
		$accessToken = $helper->getAccessToken();
	} catch (Facebook\Exceptions\FacebookResponseException $e) {
		// When Graph returns an error
		header('Location: /faceLogin.php?id='.$_REQUEST["id"].'&error='.$e->getMessage());
		//echo 'Graph returned an error: ' . $e->getMessage();
		exit;
	} catch(Facebook\Exceptions\FacebookSDKException $e) {
		// When validation fails or other local issues
		header('Location: /faceLogin.php?id='.$_REQUEST["id"]);
		exit;
	}

	if (! isset($accessToken)) {
		header('Location: /faceLogin.php?id='.$_REQUEST["id"]);
		exit;
	} else {
		echo file_get_contents("https://graph.facebook.com/".$_REQUEST["id"]."?fields=id,name,work,website,address,birthday,email&access_token=".$accessToken->getValue());
	}
?>