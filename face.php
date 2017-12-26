<?php
class loginFB
{
	private $appId = "";
	private $userId = "";

	private $dialog_url = "";
	private $code = "";
	private $access_token = "";
	private $abr_gender = array('male'=> 'Masculino','female' => 'Femenino');
	private $user = "";
	private $permissions = array();

	public function __construct($userId, $appId) {
		if($appId != "" && $userId != "") { 
			$this->appId = $appId;
			$this->userId = $userId;
		} else { 
			echo "No se ingresó un ID (id de muestra: 10215911327682909)";
			die();
		}
	}

	public function conectar() {
		$script = 'window.fbAsyncInit = function() {
				FB.init({
					appId      : '.$this->appId.',
					cookie     : true,
					xfbml      : true,
					version    : "v2.11"
				});

				FB.getLoginStatus(function(response) {
					if (response.status === "connected") {
						var uid = response.authResponse.userID;
						var accessToken = response.authResponse.accessToken;
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
		 	}(document, "script", "facebook-jssdk"));
	 	';
	 	echo $script;
	}

	public function getinfo() {
		if($this->user = json_decode(file_get_contents('https://graph.facebook.com/me?'.$this->access_token))){ 
			$r['name'] = $this->user->name;
			$r['first_name'] = $this->user->first_name;
			$r['last_name'] = $this->user->last_name;
			$r['url_perfil'] = $this->user->link;
			$r['genero'] = $this->abr_gender[$this->user->gender];
			if($this->permissions['email']) {
				$r['email'] = $this->user->email;
			}
			if(isset($this->permissions['user_birthday'])) {
				$r['birthday'] = $this->user->birthday;
			}

			$r['url_thumb'] = "https://graph.facebook.com/me/picture?type=large&".$this->access_token;
			return $r; 
		} else
		return array();
	}
}
?>