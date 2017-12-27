<html>
<head>
	<link rel="STYLESHEET" type="text/css" href="complementos/estilos.css" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<?php
if ($_REQUEST["id"]=="") {
	echo '{"error":
			[
				"message": "No se ingresó un ID (id de muestra: 10215911327682909)"
			]}';
	die();
} else {
	$userID = $_REQUEST["id"];
}
?>
<script>
	//GRAPH Facebook
	window.fbAsyncInit = function() {
		FB.init({
			appId      : '2154473484570395',
			cookie     : true,
			xfbml      : true,
			version    : 'v2.11'
		});
		FB.getLoginStatus(function(response) {
			if (response.status === 'connected') {
				//Obtener datos si el usuario ya está logueado
				var uid = response.authResponse.userID;
				var accessToken = response.authResponse.accessToken;
				obtenerDatosPerfil(accessToken);
			} else {
				//Mostrar botón login (para evitar bloqueo de ventana emergente)
				$(".output").append('<a style="color: white; background: blue; float: left; padding: 10px; margin: 10px;" href="#" onclick="loginFB(event)">Login Facebook Token</a>');
			}
		}); 
	};
	(function(d, s, id){
		 var js, fjs = d.getElementsByTagName(s)[0];
		 if (d.getElementById(id)) {return;}
		 js = d.createElement(s); js.id = id;
		 js.src = "https://connect.facebook.net/en_US/sdk.js";
		 fjs.parentNode.insertBefore(js, fjs);
	 }(document, 'script', 'facebook-jssdk'));


	//Iniciar sesión en FB y obtener el token de acceso para funcionar
	function loginFB(e) {
		e.preventDefault();
		FB.login(function(response) {
			if (response.authResponse) {
				var accessToken = response.authResponse.accessToken;
				obtenerDatosPerfil(accessToken);
			} else {
				console.log('El usuario canceló la operación.');
			}
		});
	}


	//Obtener datos del perfil mediante el id recibido
	function obtenerDatosPerfil(access_token){
		$.ajax({
			url: "https://graph.facebook.com/<?php echo $userID; ?>", 
			data: "access_token="+access_token,
		    error: function(xhr){
		        console.log("Ocurrió un error: " + xhr.status + " " + xhr.statusText);
		    },
			success: function(result){
				console.log(result);
		        $("html").html(result);
		    },
		    dataType: "text"
		});
	}
</script>

<div class="output">
</div>

</body>
</html>