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
            //echo "<script type='text/javascript'>myFn();</script>";            
            //echo "<meta http-equiv='refresh' content='1;url=http://www.prodefutbolero.com.ar'>";
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
<style type="text/css">
</style>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="http://code.jquery.com/jquery-latest.js"></script>
<script src="js/cerrarSesion.js" type="text/javascript"></script>
<link href="css/header.css" rel="stylesheet" type="text/css">
<link href="css/proximospartidos.css" rel="stylesheet" type="text/css">
<link href="css/menu.css" rel="stylesheet" type="text/css">
<link href="css/jugar.css" rel="stylesheet" type="text/css">
<link href="css/footer.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="css/fontello.css" type="text/css">

<script>
	function myFn(){
        swal({
		    title: 'Tu sesión ha expirado',
		    text: 'Iniciá sesión nuevamente para seguir jugando',
		    button: false
		});
		setTimeout(function(){
		   	location.href='index.html';
		}, 2000);
}
</script>
</script>

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
        <section id="menuCelular">
            <input type="checkbox" id="btn-menu">
            <label for="btn-menu" class="icon-menu"></label>
            <nav class="menuCelular">
                <ul>
                    <li><a href="#">JUGAR</a></li>
                    <li><a href="#">RESULTADOS</a></li>
                    <li><a href="#">POSICIONES</a></li>
                    <li><a href="#">GRUPOS</a></li>
                    <li><a href="#">CERRAR SESION</a></li>
                </ul>
            </nav>    
        </section>
        
		<section id="contenido">				
			<div id="grupos">
				<div id="grupo">
					<div id="NombreGrupo"><p>GRUPO A</p></div>
					<div id="equipos">
						<a href="boleta.php?grupo=A" class="equipogrupo">
							<div id="bandera"><img src="Images/Banderas/GrupoA/rusia2.jpg"></div><div id="equipo"><p>RUSIA</p></div>
							<div id="bandera"><img src="Images/Banderas/GrupoA/arabia2.jpg"></div><div id="equipo"><p>A. SAUDITA</p></div>
							<div id="bandera"><img src="Images/Banderas/GrupoA/egipto2.jpg"></div><div id="equipo"><p>EGIPTO</p></div>
							<div id="bandera"><img src="Images/Banderas/GrupoA/uruguay2.jpg"></div><div id="equipo"><p>URUGUAY</p></div>
						</a>
					</div>
				</div>
				<div id="grupo">
					<div id="NombreGrupo"><p>GRUPO B</p></div>
					<div id="equipos">
						<a href="boleta.php?grupo=B">
							<div id="bandera"><img src="Images/Banderas/GrupoB/portugal2.jpg"></div><div id="equipo"><p>PORTUGAL</p></div>
							<div id="bandera"><img src="Images/Banderas/GrupoB/españa2.jpg"></div><div id="equipo"><p>ESPAÑA</p></div>
							<div id="bandera"><img src="Images/Banderas/GrupoB/marruecos2.jpg"></div><div id="equipo"><p>MARRUECOS</p></div>
							<div id="bandera"><img src="Images/Banderas/GrupoB/iran2.jpg"></div><div id="equipo"><p>IRÁN</p></div>
						</a>
					</div>
				</div>
				<div id="grupo">
					<div id="NombreGrupo"><p>GRUPO C</p></div>
					<div id="equipos">
						<a href="boleta.php?grupo=C">
							<div id="bandera"><img src="Images/Banderas/GrupoC/francia2.jpg"></div><div id="equipo"><p>FRANCIA</p></div>
							<div id="bandera"><img src="Images/Banderas/GrupoC/australia2.jpg"></div><div id="equipo"><p>AUSTRALIA</p></div>
							<div id="bandera"><img src="Images/Banderas/GrupoC/peru2.jpg"></div><div id="equipo"><p>PERÚ</p></div>
							<div id="bandera"><img src="Images/Banderas/GrupoC/dinamarca2.jpg"></div><div id="equipo"><p>DINAMARCA</p></div>
						</a>
					</div>
				</div>
				<div id="grupo">
					<div id="NombreGrupo"><p>GRUPO D</p></div>
					<div id="equipos">
						<a href="boleta.php?grupo=D">
							<div id="bandera"><img src="Images/Banderas/GrupoD/argentina2.jpg"></div><div id="equipo"><p>ARGENTINA</p></div>
							<div id="bandera"><img src="Images/Banderas/GrupoD/islandia2.jpg"></div><div id="equipo"><p>ISLANDIA</p></div>
							<div id="bandera"><img src="Images/Banderas/GrupoD/croacia2.jpg"></div><div id="equipo"><p>CROACIA</p></div>
							<div id="bandera"><img src="Images/Banderas/GrupoD/nigeria2.jpg"></div><div id="equipo"><p>NIGERIA</p></div>
						</a>
					</div>
				</div>
			</div>
			<div id="grupos">
				<div id="grupo">
					<div id="NombreGrupo"><p>GRUPO E</p></div>
					<div id="equipos">
						<a href="boleta.php?grupo=E">
							<div id="bandera"><img src="Images/Banderas/GrupoE/brasil.jpg"></div><div id="equipo"><p>BRASIL</p></div>
							<div id="bandera"><img src="Images/Banderas/GrupoE/suiza.jpg"></div><div id="equipo"><p>SUIZA</p></div>
							<div id="bandera"><img src="Images/Banderas/GrupoE/costarica.jpg"></div><div id="equipo"><p>COSTA RICA</p></div>
							<div id="bandera"><img src="Images/Banderas/GrupoE/serbia.jpg"></div><div id="equipo"><p>SERBIA</p></div>
						</a>
					</div>
				</div>
				<div id="grupo">
					<div id="NombreGrupo"><p>GRUPO F</p></div>
					<div id="equipos">
						<a href="boleta.php?grupo=F">
							<div id="bandera"><img src="Images/Banderas/GrupoF/alemania.jpg"></div><div id="equipo"><p>ALEMANIA</p></div>
							<div id="bandera"><img src="Images/Banderas/GrupoF/mexico.jpg"></div><div id="equipo"><p>MÉXICO</p></div>
							<div id="bandera"><img src="Images/Banderas/GrupoF/suecia.jpg"></div><div id="equipo"><p>SUECIA</p></div>
							<div id="bandera"><img src="Images/Banderas/GrupoF/corea.jpg"></div><div id="equipo"><p>R. DE COREA</p></div>
						</a>
					</div>
				</div>
				<div id="grupo">
					<div id="NombreGrupo"><p>GRUPO G</p></div>
					<div id="equipos">
						<a href="boleta.php?grupo=G">
							<div id="bandera"><img src="Images/Banderas/GrupoG/belgica.jpg"></div><div id="equipo"><p>BÉLGICA</p></div>
							<div id="bandera"><img src="Images/Banderas/GrupoG/panama.jpg"></div><div id="equipo"><p>PANAMÁ</p></div>
							<div id="bandera"><img src="Images/Banderas/GrupoG/tunez.png"></div><div id="equipo"><p>TÚNEZ</p></div>
							<div id="bandera"><img src="Images/Banderas/GrupoG/inglaterra.jpg"></div><div id="equipo"><p>INGLATERRA</p></div>
						</a>
					</div>
				</div>
				<div id="grupo">
					<div id="NombreGrupo"><p>GRUPO H</p></div>
					<div id="equipos">
						<a href="boleta.php?grupo=H">
							<div id="bandera"><img src="Images/Banderas/GrupoH/polonia.jpg"></div><div id="equipo"><p>POLONIA</p></div>
							<div id="bandera"><img src="Images/Banderas/GrupoH/senegal.jpg"></div><div id="equipo"><p>SENEGAL</p></div>
							<div id="bandera"><img src="Images/Banderas/GrupoH/colombia.jpg"></div><div id="equipo"><p>COLOMBIA</p></div>
							<div id="bandera"><img src="Images/Banderas/GrupoH/japon.jpg"></div><div id="equipo"><p>JAPÓN</p></div>
						</a>
					</div>
				</div>
			</div>
			
			<section id="playoff">
				<div id="fase"><p><a href="boletaOctavos.php">OCTAVOS DE FINAL</a></p></div>
				<div id="fase"><p><a href="boletaCuartos.php">CUARTOS DE FINAL</a></p></div>
				<div id="fase"><p><a href="boletaSemifinal.php">SEMIFINAL</a></p></div>
				<div id="fase"><p><a href="boletaTercerPuesto.php">TERCER PUESTO</a></p></div>
				<div id="fase"><p><a href="boletaFinal.php">FINAL</a></p></div>
			</section>
		</section>
	</section>

	<?php
		include('footer.html');
		}
	?>
</body>
</html>