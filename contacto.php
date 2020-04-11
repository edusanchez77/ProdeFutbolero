<?php
	require_once("conexion.inc");

	session_start();
	mysqli_set_charset($conexion, "utf8");

	if(isset($_SESSION['tiempo']) ) {

    //Tiempo en segundos para dar vida a la sesión.
    $inactivo = 1200;//20min en este caso.

    //Calculamos tiempo de vida inactivo.
    $vida_session = time() - $_SESSION['tiempo'];

        //Compraración para redirigir página, si la vida de sesión sea mayor a el tiempo insertado en inactivo.
        if($vida_session > $inactivo)
        {
            //Removemos sesión.
            session_unset();
            //Destruimos sesión.
            session_destroy();              
            //Redirigimos pagina.
            
            header("Location: index.html");

            exit();
        } else {  // si no ha caducado la sesion, actualizamos
            $_SESSION['tiempo'] = time();
        }


} else {
    //Activamos sesion tiempo.
    $_SESSION['tiempo'] = time();
}

	if (!isset($_SESSION['dni'])) {
		header('location:index.html');
	}else{
		$dni_usuario = $_SESSION['dni'];
		$nombre_usuario = $_SESSION['usuario'];
		$apellido_usuario = $_SESSION['apellido'];
		$ciudad_usuario = $_SESSION['ciudad'];
		$email_usuario = $_SESSION['email'];
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Prode Futbolero | Edición Rusia 2018</title>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/javascript" src="js/consulta.js"></script>
<script src="js/cerrarSesion.js" type="text/javascript"></script>
<link href="css/header.css" rel="stylesheet" type="text/css">
<link href="css/proximospartidos.css" rel="stylesheet" type="text/css">
<link href="css/menu.css" rel="stylesheet" type="text/css">
<link href="css/contacto.css" rel="stylesheet" type="text/css">
<link href="css/footer.css" rel="stylesheet" type="text/css">
</style>
</head>
<body>

	<?php
		include('header.html');
	?>

	<section id="main">
		
		<?php
		include('proximosPartidos.php');
		include('menu.html');
		?>

		<section id="contenido">
			<div id="titulo">
				<h2>CONTACTO</h2>
			</div>
			<div id="formulario">
				<form method="POST" action="mailConsulta.php" onsubmit="return enviarConsulta()">
					<div>
						<input type="text" placeholder="Asunto" name="asunto" required="">
					</div>
					<div>
						<textarea rows="5" placeholder="Consulta" name="consulta" required=""></textarea>
					</div>
					<input type="submit" value="ENVIAR">
				</form>
			</div>
		</section>
	</section>

	<?php
		include('footer.html');
	}
	?>
</body>
</html>
