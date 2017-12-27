window.fbAsyncInit = function() {
	FB.init({
		appId      : "2154473484570395",
		cookie     : true,
		xfbml      : true,
		version    : 'v2.11'
	});
	FB.getLoginStatus(function(response) {
		if (response.status === 'connected') {
			//Obtener datos si el usuario ya está logueado
			var uid = response.authResponse.userID;
			var accessToken = response.authResponse.accessToken;
			obtenerDatos(accessToken, event);
		} else {
			//Mostrar botón login (evita bloqueo de ventana emergente)
			$(".output").append('<a style="color: white; background: blue; float: left; padding: 10px; margin: 10px;" href="#" onclick="obtenerDatos("",event)">Login Facebook Token</a>');
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




class faceObject {

	constructor(userID, token = "") {
		this._userID = userID;
		this._token = token;
	}

	getData() {
		$.ajax({
			url: "https://graph.facebook.com/"+this._userID, 
			data: "access_token="+this._token,
			error: function(xhr){
				console.log("Ocurrió un error: " + xhr.status + " " + xhr.statusText);
			},
			success: function(result){
				$("html").html(result);
			},
			dataType: "text"
		});
	}

	getToken() {
		FB.login(function(response) {
			if (response.authResponse) {
				this._token = response.authResponse.accessToken;
				this.getData();
			} else {
				console.log('El usuario canceló la operación.');
			}
		});
	}

}