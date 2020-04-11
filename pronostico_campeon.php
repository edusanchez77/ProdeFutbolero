<?php
	require_once("conexion.inc");

	session_start();
	mysqli_set_charset($conexion, "utf8");

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
<style type="text/css">
</style>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="js/campeon.js" type="text/javascript"></script>
<script src="js/query.js" type="text/javascript"></script>
<script src="js/main.js" type="text/javascript"></script>
<script src="js/registro.js" type="text/javascript"></script>
<script src="js/login.js" type="text/javascript"></script>
<script src="js/cerrarSesion.js" type="text/javascript"></script>

<script src="//netdna.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link href="css/header.css" rel="stylesheet" type="text/css">
<link href="css/proximospartidos.css" rel="stylesheet" type="text/css">
<link href="css/menu.css" rel="stylesheet" type="text/css">
<link href="css/pronostico_campeon.css" rel="stylesheet" type="text/css">
<link href="css/footer.css" rel="stylesheet" type="text/css">
</head>
<body>
	<script type="text/javascript">
		function confirmacion(pronostico, id){
			swal({
				title: "Has elegido como campeón a "+pronostico,
				text: "Recordá que tenés tiempo de modificar esta decisión hasta que comiencen los Octavos de Final",
				buttons: ["Cancelar", "Aceptar"],
				dangerMode: false,
			})
			.then((willDelete) => {
				if (willDelete) {
			    	swal(pronostico, {
			      		icon: "success",
			    	});
			    	window.location.href="campeon.php?campeon="+id;
			  	} 
			});
		}
	</script>
	<?php
		include('header.html');
	?>

		<section id="main">
			
		<?php
		include('proximosPartidos.php');
		include('menu.html');
		?>

			<section id="contenido">
				<div id="grupoequipos">
					<div id="titulo">
						<h2>ELEGÍ TU CAMPEÓN</h2>
					</div>
					<div class="banderas">
						<div id="banderas">
							<img src="Images/Banderas/GrupoA/rusia2.jpg" onclick="confirmacion('Rusia','1')">
							<div id="equipocampeon">RUSIA</div>
						</div>
						<div id="banderas">
							<img src="Images/Banderas/GrupoA/arabia2.jpg" onclick="confirmacion('A. Saudita','2')">
							<div id="equipocampeon">A. SAUDITA</div>
						</div>
						<div id="banderas">
							<img src="Images/Banderas/GrupoA/egipto2.jpg" onclick="confirmacion('Egipto','3')">
							<div id="equipocampeon">EGIPTO</div>
						</div>
						<div id="banderas">
							<img src="Images/Banderas/GrupoA/uruguay2.jpg" onclick="confirmacion('Uruguay','4')">
							<div id="equipocampeon">URUGUAY</div>
						</div>

						<div id="banderas">
							<img src="Images/Banderas/GrupoB/portugal2.jpg" onclick="confirmacion('Portugal','5')">
							<div id="equipocampeon">PORTUGAL</div>
						</div>
						<div id="banderas">
							<img src="Images/Banderas/GrupoB/españa2.jpg" onclick="confirmacion('España','6')">
							<div id="equipocampeon">ESPAÑA</div>
						</div>
						<div id="banderas">
							<img src="Images/Banderas/GrupoB/marruecos2.jpg" onclick="confirmacion('Marruecos','7')">
							<div id="equipocampeon">MARRUECOS</div>
						</div>
						<div id="banderas">
							<img src="Images/Banderas/GrupoB/iran2.jpg" onclick="confirmacion('Irán','8')">
							<div id="equipocampeon">IRÁN</div>
						</div>

						<div id="banderas">
							<img src="Images/Banderas/GrupoC/francia2.jpg" onclick="confirmacion('Francia','9')">
							<div id="equipocampeon">FRANCIA</div>
						</div>
						<div id="banderas">
							<img src="Images/Banderas/GrupoC/australia2.jpg" onclick="confirmacion('Australia','10')">
							<div id="equipocampeon">AUSTRALIA</div>
						</div>
						<div id="banderas">
							<img src="Images/Banderas/GrupoC/peru2.jpg" onclick="confirmacion('Perú','11')">
							<div id="equipocampeon">PERÚ</div>
						</div>
						<div id="banderas">
							<img src="Images/Banderas/GrupoC/dinamarca2.jpg" onclick="confirmacion('Dinamarca','12')">
							<div id="equipocampeon">DINAMARCA</div>
						</div>

						<div id="banderas">
							<img src="Images/Banderas/GrupoD/argentina2.jpg" onclick="confirmacion('Argentina','13')">
							<div id="equipocampeon">ARGENTINA</div>
						</div>
						<div id="banderas">
							<img src="Images/Banderas/GrupoD/islandia2.jpg" onclick="confirmacion('Islandia','14')">
							<div id="equipocampeon">ISLANDIA</div>
						</div>
						<div id="banderas">
							<img src="Images/Banderas/GrupoD/croacia2.jpg" onclick="confirmacion('Croacia','15')">
							<div id="equipocampeon">CROACIA</div>
						</div>
						<div id="banderas">
							<img src="Images/Banderas/GrupoD/nigeria2.jpg" onclick="confirmacion('Nigeria','16')">
							<div id="equipocampeon">NIGERIA</div>
						</div>

						<div id="banderas">
							<img src="Images/Banderas/GrupoE/brasil.jpg" onclick="confirmacion('Brasil','17')">
							<div id="equipocampeon">BRASIL</div>
						</div>
						<div id="banderas">
							<img src="Images/Banderas/GrupoE/suiza.jpg" onclick="confirmacion('Suiza','18')">
							<div id="equipocampeon">SUIZA</div>
						</div>
						<div id="banderas">
							<img src="Images/Banderas/GrupoE/costarica.jpg" onclick="confirmacion('Costa Rica','19')">
							<div id="equipocampeon">COSTA RICA</div>
						</div>
						<div id="banderas">
							<img src="Images/Banderas/GrupoE/serbia.jpg" onclick="confirmacion('Serbia','20')">
							<div id="equipocampeon">SERBIA</div>
						</div>

						<div id="banderas">
							<img src="Images/Banderas/GrupoF/alemania.jpg" onclick="confirmacion('Alemania','21')">
							<div id="equipocampeon">ALEMANIA</div>
						</div>
						<div id="banderas">
							<img src="Images/Banderas/GrupoF/mexico.jpg" onclick="confirmacion('México','22')">
							<div id="equipocampeon">MÉXICO</div>
						</div>
						<div id="banderas">
							<img src="Images/Banderas/GrupoF/suecia.jpg" onclick="confirmacion('Suecia','23')">
							<div id="equipocampeon">SUECIA</div>
						</div>
						<div id="banderas">
							<img src="Images/Banderas/GrupoF/corea.jpg" onclick="confirmacion('R. de Corea','24')">
							<div id="equipocampeon">R. DE COREA</div>
						</div>

						<div id="banderas">
							<img src="Images/Banderas/GrupoG/belgica.jpg" onclick="confirmacion('Bélgica','25')">
							<div id="equipocampeon">BÉLGICA</div>
						</div>
						<div id="banderas">
							<img src="Images/Banderas/GrupoG/panama.jpg" onclick="confirmacion('Panamá','26')">
							<div id="equipocampeon">PANAMÁ</div>
						</div>
						<div id="banderas">
							<img src="Images/Banderas/GrupoG/tunez.png" onclick="confirmacion('Túnez','27')">
							<div id="equipocampeon">TÚNEZ</div>
						</div>
						<div id="banderas">
							<img src="Images/Banderas/GrupoG/inglaterra.jpg" onclick="confirmacion('Inglaterra','28')">
							<div id="equipocampeon">INGLATERRA</div>
						</div>

						<div id="banderas">
							<img src="Images/Banderas/GrupoH/polonia.jpg" onclick="confirmacion('Polonia','29')">
							<div id="equipocampeon">POLONIA</div>
						</div>
						<div id="banderas">
							<img src="Images/Banderas/GrupoH/senegal.jpg" onclick="confirmacion('Senegal','30')">
							<div id="equipocampeon">SENEGAL</div>
						</div>
						<div id="banderas">
							<img src="Images/Banderas/GrupoH/colombia.jpg" onclick="confirmacion('Colombia','31')">
							<div id="equipocampeon">COLOMBIA</div>
						</div>
						<div id="banderas">
							<img src="Images/Banderas/GrupoH/japon.jpg" onclick="confirmacion('Japón','32')">
							<div id="equipocampeon">JAPÓN</div>
						</div>
					</div>
				</div>
			</section>
		</section>

	<?php
		include('footer.html');
	}
	?>
</body>
</html>