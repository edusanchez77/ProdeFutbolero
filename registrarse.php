<?php
	require_once("conexion.inc");

	mysqli_set_charset($conexion, "utf8");
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Prode Futbolero | Edición Rusia 2018</title>
<style type="text/css">
</style>
<script src="js/query.js" type="text/javascript"></script>
<script src="js/main.js" type="text/javascript"></script>
<script src="js/posiciones.js" type="text/javascript"></script>
<script src="js/registro.js" type="text/javascript"></script>
<link href="css/header.css" rel="stylesheet" type="text/css">
<link href="css/proximospartidos.css" rel="stylesheet" type="text/css">
<link href="css/menu.css" rel="stylesheet" type="text/css">
<link href="css/registrarse.css" rel="stylesheet" type="text/css">
<link href="css/panellateral.css" rel="stylesheet" type="text/css">
<link href="css/footer.css" rel="stylesheet" type="text/css">
</head>
<body>

    
<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '{your-app-id}',
      cookie     : true,
      xfbml      : true,
      version    : '{latest-api-version}'
    });
      
    FB.AppEvents.logPageView();   
      
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "https://connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
</script>
    
    

	<div class="main">
		<div class="logo">
			<img src="Images/Logo/logo.png" alt="">
		</div>
		<div class="detalle">
			<h1>¡Bienvenido al PRODE FUTBOLERO!</h1>
			<p>Un portal donde podrás jugar junto<br>a tus amigos al tradicional prode.<br>Es ni más ni menos un espacio online para compartir<br>tu pasión por el fútbol y las estadísticas.<br>Demostrá que sabés más que tus amigos<br>y divertite sin costo alguno.</p>
		</div>
		<div class="form">
			<form action="" id="formlg">
				<input type="text" name="dni" required="" placeholder="dni"> 
				<input type="password" name="pass" required="" placeholder="password"> 
				<input class="botonlg" type="submit" name="" value="INGRESAR">
				<a href="#" id="password">¿Olvidaste tu password?</a>
			</form>
			<p>¿No tenés cuenta? Registrate <a href="registrarse.php">acá</a></p>
		</div>
	</div>
	<footer>
		<nav>
			<ul>
				<div id="redes">
					<li><p>SEGUINOS EN</p></li>
					<li><a href="https://www.facebook.com/ProdeFutbolero" target="_blank"><img src="Images/facebook.png"></a></li>
					<li><a href="https://twitter.com/ProdeFutbolOk" target="_blank"><img src="Images/twitter.png"></a></li>
					<li><a href="https://www.instagram.com/prodefutbolero/" target="_blank"><img src="Images/instagram.png"></a></li>
				</div>
			</ul>
			<ul>
				<div id="final">
					<li><a href="terminos.php">TÉRMINOS Y CONDICIONES</a></li>
					<li><a href="reglamento.php">REGLAMENTO</a></li>
					<li><a href="contacto.php">CONTACTO</a></li>
				</div>
			</ul>
		</nav>
	</footer>
</body>
</html>