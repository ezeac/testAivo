<html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<body>
<?php if(isset($_REQUEST['error'])) { echo $_REQUEST['error']; } ?>
<br>Por favor ingrese para gener un token:<br>
<p id="button"><a href="#" onClick="logInWithFacebook()">Obtener Token Facebook</a></p>
<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId: '2154473484570395',
      cookie: true,
      version: 'v2.2'
    });
  };

  logInWithFacebook = function() {
    FB.login(function(response) {
      if (response.authResponse) {
        $("#button").html('<a style="color: darkgreen;" href="/index.php?id=<?php if (isset($_REQUEST["id"])) { echo $_REQUEST["id"]; }?>">CLICK PARA OBTENER DATOS</a> (o ingresar a: localhost/buscar/<?php if (isset($_REQUEST["id"])) { echo $_REQUEST["id"]; }?>)');
      } else {
        alert('Login cancelado.');
      }
    });
    return false;
  };

  (function(d, s, id){
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) {return;}
    js = d.createElement(s); js.id = id;
    js.src = "https://connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));
</script>
</body>
</html>