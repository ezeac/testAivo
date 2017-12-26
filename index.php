<html>
<head>
	<link rel="STYLESHEET" type="text/css" href="complementos/estilos.css" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<?php
require_once("face.php");

if ($_REQUEST["id"]=="") {
	echo '{
		"message": "No se ingresó un ID (id de muestra: 10215911327682909)"
	}';
} else {
	$userID = $_REQUEST["id"];
	$appID = "2154473484570395";
	$fbData = new loginFB($userID,$appID);
}
?>
<script>
	console.log("ID: <?php echo $userID; ?>");
	window.fbAsyncInit = function() {
		FB.init({
			appId      : '2154473484570395',
			cookie     : true,
			xfbml      : true,
			version    : 'v2.11'
		});

		FB.getLoginStatus(function(response) {
			if (response.status === 'connected') {
				var uid = response.authResponse.userID;
				var accessToken = response.authResponse.accessToken;
				statusChangeCallback(accessToken);
			} else {
				mostrarBotonLogin();
			}
			console.log("Estado Usuario >> ");
			console.log(response);
		}); 
			
	};

	(function(d, s, id){
		 var js, fjs = d.getElementsByTagName(s)[0];
		 if (d.getElementById(id)) {return;}
		 js = d.createElement(s); js.id = id;
		 js.src = "https://connect.facebook.net/en_US/sdk.js";
		 fjs.parentNode.insertBefore(js, fjs);
	 }(document, 'script', 'facebook-jssdk'));

	
	function statusChangeCallback(access_token){
		//CONSULTA AJAX
		$.ajax({
			url: "https://graph.facebook.com/<?php echo $userID; ?>", 
			data: "access_token="+access_token,
		    error: function(xhr){
		        console.log("Ocurrió un error: " + xhr.status + " " + xhr.statusText);
		    },
			success: function(result){
		        console.log("result2:");
		        console.log(result);
		        $(".central").html(result);
		    }
		});
	}

	function loginFB(e) {
		e.preventDefault();
		FB.login(function(response) {
			if (response.authResponse) {
				statusChangeCallback(response.authResponse.accessToken);
			} else {
				console.log('User cancelled login or did not fully authorize.');
			}
		});
	}

	function mostrarBotonLogin(){
		$(".central").append('<a href="#" onclick="loginFB(event)">Login Facebook Token</a>');
	} 
</script>

<div class="central">
</div>

</div>

<?php
require_once("complementos/footer.php");
?>
</body>
</html>