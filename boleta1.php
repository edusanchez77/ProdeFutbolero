<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Mi Prode</title>
<style type="text/css">
</style>
<link href="css/boleta.css" rel="stylesheet" type="text/css">
</head>
<body>

	<header>
		<div id="subheader">
			<div id="logotipo">
				<img src="Images/Logo/LogoCopa.png">
			</div>
			<div id="nombre">
				<p><a href="index.html">PRODE FUTBOLERO</a></p>
				<div id="fifa">
					<img src="Images/Logo/FifaWorldCup.png">
				</div>
			</div>
			<div id="ingresar">
				<p><a href="#">INGRESAR</a></p>
			</div>
		</div>
	</header>

	<section id="wrap">
		<section id="main">
			<section id="bienvenidos">
				<article>
					<p>Bienvenido a MI PRODE, un portal donde podrás jugar junto a tus amigos al tradicional prode.<br>
					   MI PRODE es ni más ni menos un espacio online para compartir tu pasión por el fútbol y
					   las estadísticas. Demostrá que sabes más que tus amigos y divertite sin costo alguno.</p>
				</article>
			</section>
			<nav>
				<ul>
					<div id="menu">
						<li><a href="#">JUGAR</a></li>
						<li><a href="#">POSICIONES</a></li>
						<li><a href="#">GRUPOS</a></li>
					</div>
				</ul>
			</nav>
			<section id="contenido">

				<?php
					$db_host = "localhost";
					$db_user = "root";
					$db_pass = "";
					$db_base = "Prode";

					$conexion = mysqli_connect($db_host, $db_user, $db_pass, $db_base);
					if (mysqli_connect_errno()){
						echo "Error al conectar a la base de datos";
						exit();
					}

					mysqli_set_charset($conexion, "utf8");
					
					//Obtengo Partido
					$query = "SELECT * FROM partidos WHERE pa_grupo = 'A'";
					$result = mysqli_query ($conexion, $query);
				?>

				<div id="grupo">
					<p>GRUPO A</p>
				</div>
				<div id="partidos">
					<div id='fecha'>
						<p>Fecha 1</p>
					</div>
					<?php
						while ($fila = mysqli_fetch_row($result)) {

							//Obtengo Bandera
							$query_bandera_L = "SELECT eq_bandera FROM equipo WHERE eq_nombre = '$fila[1]'";
							$result_bandera_L = mysqli_query ($conexion, $query_bandera_L);

							$query_bandera_V = "SELECT eq_bandera FROM equipo WHERE eq_nombre = '$fila[2]'";
							$result_bandera_V = mysqli_query ($conexion, $query_bandera_V);

							$bandera_local = mysqli_fetch_row($result_bandera_L);
							$bandera_visitante = mysqli_fetch_row($result_bandera_V);

							//if ($fila[4] == 1) {
								echo "
									<div id='partido'>
									<div id='dia'>".$fila[0]."</div>
									<div id='bandera'><img src='".$bandera_local[0]."''></div>
									<div id='equipo'>".$fila[1]."</div>
									<div id='local'><input/></div>
									<div id='separador'>-</div>
									<div id='visitante'><input/></div>
									<div id='equipo'>".$fila[2]."</div>
									<div id='bandera'><img src='".$bandera_visitante[0]."''></div>
									<div id='sede'>".$fila[3]."</div>
								</div>
								";	
							//}
						}
					?>
					
				</div>
				<nav id="guardar">
					<ul>
						<div id="guardado">
							<li><a href="#">SALIR</a></li>
							<li><a href="#">GUARDAR Y SALIR</a></li>
							<li><a href="#">GUARDAR</a></li>
						</div>
					</ul>
				</nav>
			</section>
		</section>
	</section>

	<footer>
		<nav>
			<ul>
				<div id="final">
					<li><a href="reglamento.html">REGLAMENTO</a></li>
					<li><a href="contacto.html">CONTACTO</a></li>
				</div>
			</ul>
		</nav>
	</footer>
</body>
</html>