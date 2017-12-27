<html>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script>
		//CONSULTA AJAX
		$.ajax({
			url: "/index.php?id=10215911327682909",
		    error: function(xhr){
		        console.log("Ocurrió un error: " + xhr.status + " " + xhr.statusText);
		    },
			success: function(result){
		        console.log(result);
		    }
		});
	</script>
</html>