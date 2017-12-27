<?php
if ($_REQUEST["id"]=="") {
	echo '{"error":
		[
			"message": "No se ingresó un ID (id de muestra: 10215911327682909)"
		]
	}';
	die();
} else {
	$userID = $_REQUEST["id"];
}
?>
<html>
<head>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="face.js"></script>
</head>
<body>
<script>
	var userID = "<?php echo $userID; ?>";

	function obtenerDatos(token, e){
		e.preventDefault();

		fbObject = new faceObject("<?php echo $userID; ?>",token);
		
		if (token == "") {
			fbObject.getToken();
		} else {
			fbObject.getData();
		}
	}

</script>

<div class="output">
</div>

</body>
</html>