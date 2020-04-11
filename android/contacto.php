<?php
	require_once("conexion.inc");

	session_start();
	mysqli_set_charset($conexion, "utf8");

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
<title>Mi Prode</title>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/javascript" src="js/consulta.js"></script>
<link href="css/header.css" rel="stylesheet" type="text/css">
<link href="css/proximospartidos.css" rel="stylesheet" type="text/css">
<link href="css/menu.css" rel="stylesheet" type="text/css">
<link href="css/contacto.css" rel="stylesheet" type="text/css">
<link href="css/footer.css" rel="stylesheet" type="text/css">
</style>
</head>
<body>

	<header>
		<div id="subheader">
			<div id="logotipo">
				<img src="Images/Logo/rusia 2018.png" id="rusia">
				<img src="Images/Logo/LogoCopa.png" id="copa">
			</div>
			<div id="nombre">
				<img src="Images/Logo/logoHeader.png">
			</div>
		</div>
	</header>

	<section id="main">
		<section id="proximospartidos">
			<div class="proximospartidos">
			<p>ÚLTIMOS RESULTADOS</p>
			<ul>
				
				<?php
					$contador = 1;

					$query_resultados = "SELECT * FROM resultados ORDER BY res_id DESC LIMIT 8";
					$resultado_resultados = mysqli_query($conexion, $query_resultados);
					while ($resultado = mysqli_fetch_row($resultado_resultados))
					{
						$query = "SELECT * FROM partidos WHERE pa_id = '$resultado[1]'";
						$result = mysqli_query($conexion, $query);
						$equipos = mysqli_fetch_row($result);

						$query = "SELECT eq_bandera FROM equipo WHERE eq_nombre = '$equipos[2]'";
						$result = mysqli_query($conexion, $query);
						$bandera_local = mysqli_fetch_row($result);

						$query = "SELECT eq_bandera FROM equipo WHERE eq_nombre = '$equipos[3]'";
						$result = mysqli_query($conexion, $query);
						$bandera_visitante = mysqli_fetch_row($result);

						if ($contador == 1) {
			echo "<li><div class='partido primerpartido'>";
						}else if ($contador == 4) {
			echo "<div class='partido ultimopartido'>";
						}else{
			echo "<div class='partido'>";
						}
				?>
					<div class="equipo">
						<img src="<?php echo $bandera_local[0] ?>">
						<p><?php echo strtoupper($equipos[2]); ?></p>
						<input type="text" disabled="" value="<?php echo $resultado[2] ?>">
					</div>
					<div class="equipo">
						<img src="<?php echo $bandera_visitante[0] ?>">
						<p><?php echo strtoupper($equipos[3]); ?></p>
						<input type="text" disabled="" value="<?php echo $resultado[3] ?>">
					</div>
				</div>
				
				<?php
					if ($contador == 4) {
						echo "</li>";
						$contador = 0;
					}
					$contador++;
				}
				?>
			</ul>
			</div>
		</section>

		<section id="menu">
			<div class="menu">
				<ul>
					<li><a class="amenu" href="jugar.php">JUGAR</a></li>
					<li><a class="amenu" href="posiciones.php">POSICIONES</a></li>
					<li><a class="amenu" href="grupo.php?id=0">GRUPOS</a></li>
					<li class="usuario"><a class="cerrarsesion" href="cerrarsesion.php"><img src="Images/salir.png" title="Cerrar Sesión"></a><p>HOLA, <?php echo $nombre_usuario." ".$apellido_usuario ?></p></li>
					<?php
					if ($dni_usuario == '29851491') {
					?>
					<li class="menuespecial"><a class="menua" href="jugar_resultados.php">CARGAR RESULTADOS</a></li>
					<?php
					}
					?>
				</ul>
			</div>
		</section>

		<section id="contenido">
			<div id="titulo">
				<h2>CONTACTO</h2>
			</div>
			<div id="formulario">
				<form method="POST" action="" onsubmit="return enviarConsulta()">
					<div>
						<input type="text" placeholder="Asunto" name="asunto">
					</div>
					<div>
						<textarea rows="5" placeholder="Consulta" name="consulta"></textarea>
					</div>
					<input type="submit" value="ENVIAR">
				</form>
			</div>
		</section>
	</section>

	<footer>
		<nav>
			<ul>
				<div id="redes">
					<li><p>SEGUINOS EN</p></li>
					<li><a href="reglamento.php"><img src="Images/facebook.png"></a></li>
					<li><a href="contacto.html"><img src="Images/twitter.png"></a></li>
					<li><a href="contacto.html"><img src="Images/instagram.png"></a></li>
				</div>
			</ul>
			<ul>
				<div id="final">
					<li><a href="reglamento.html">TÉRMINOS Y CONDICIONES</a></li>
					<li><a href="reglamento.php">REGLAMENTO</a></li>
					<li><a href="contacto.php">CONTACTO</a></li>
				</div>
			</ul>
		</nav>
	</footer>
</body>
</html>
