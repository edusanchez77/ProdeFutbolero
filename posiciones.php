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
<style type="text/css">
</style>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script src="js/query.js" type="text/javascript"></script>
<script src="js/main.js" type="text/javascript"></script>
<script src="js/posiciones.js" type="text/javascript"></script>
<script src="js/registro.js" type="text/javascript"></script>
<script src="js/cerrarSesion.js" type="text/javascript"></script>
<link href="css/header.css" rel="stylesheet" type="text/css">
<link href="css/proximospartidos.css" rel="stylesheet" type="text/css">
<link href="css/menu.css" rel="stylesheet" type="text/css">
<link href="css/posiciones.css" rel="stylesheet" type="text/css">
<link href="css/panellateral.css" rel="stylesheet" type="text/css">
<link href="css/footer.css" rel="stylesheet" type="text/css">
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
			<section id="posiciones">
				<ul class="titulo">
					<li><a href="#pos1">Posiciones generales</a></li>
					<li><a href="#pos2">En tu ciudad</a></li>
				</ul>
				<div class="general">
					<article id="pos1">
						<?php
							$query = "SELECT usr_nombre, usr_apellido, usr_ciudad, usr_puntaje FROM user ORDER BY usr_puntaje DESC, usr_nombre ASC";
							$result = mysqli_query ($conexion, $query);
						?>
						<table>
							<tr id="cabecera">
								<th scope="col" id='posicion'>POS.</th>
								<th scope="col">NOMBRE</th>
								<th scope="col">CIUDAD</th>
								<th scope="col" id='puntaje'>PUNTOS</th>
							</tr>
							<?php
								$posicion = 1;
								
								while($fila = mysqli_fetch_row($result)){
                                    if($posicion <= 1000){
                                        if (($fila[0] == $nombre_usuario) and ($fila[1] == $apellido_usuario)){
                                            echo "<tr class='yo'>";
                                            $posicion_general = $posicion;
                                        }else{
                                            echo "<tr>";
                                        }
                                        echo "<td id='posicion'>".$posicion."</td>";
                                        echo "<td id='usuario'>".$fila[0]." ".$fila[1]."</td>";
                                        echo "<td id='ciudad'>".$fila[2]."</td>";
                                        echo "<td id='puntaje'>".$fila[3]."</td></tr>";    
                                    }else{
                                        if (($fila[0] == $nombre_usuario) and ($fila[1] == $apellido_usuario)){
                                            echo "<tr class='yo'>";
                                            $posicion_general = $posicion;
                                            echo "<td id='posicion'>".$posicion."</td>";
                                            echo "<td id='usuario'>".$fila[0]." ".$fila[1]."</td>";
                                            echo "<td id='ciudad'>".$fila[2]."</td>";
                                            echo "<td id='puntaje'>".$fila[3]."</td></tr>";
                                        }
                                    }
									
									$posicion++;
								}
								if ($posicion_general > 1000) {
									echo "<tr class='yo'>";
									echo "<td id='posicion'>".$posicion_general."</td>";
									echo "<td>".$nombre_usuario." ".$apellido_usuario."</td>";
									echo "<td>".$ciudad_usuario."</td>";
									echo "<td id='puntaje'>".$puntos_usuario."</td></tr>";
								}
							?>
						</table>
					</article>
					<article id="pos2">
						<?php
							if(isset($_SESSION['dni'])){
								$dni = $_SESSION['dni'];
								$ciudad = $_SESSION['ciudad'];
								$consulta = "SELECT count(1) FROM user WHERE usr_ciudad = '$ciudad' AND usr_puntaje > (SELECT usr_puntaje FROM user WHERE usr_dni = '$dni')";
								$resultado = mysqli_query($conexion, $consulta);
								$puestos = mysqli_fetch_row($resultado);

								$posicion_ciudad = $puestos[0]+1;
							}

							$query = "SELECT usr_nombre, usr_apellido, usr_ciudad, usr_puntaje FROM user ORDER BY usr_puntaje DESC ";
							$result = mysqli_query ($conexion, $query);
						?>
						<table>
							<tr id="cabecera">
								<th scope="col" id='posicion'>POS.</th>
								<th scope="col">NOMBRE</th>
								<th scope="col">CIUDAD</th>
								<th scope="col" id='puntaje'>PUNTOS</th>
							</tr>
							<?php
								$ciudad = $_SESSION['ciudad'];
								$query = "SELECT usr_nombre, usr_apellido, usr_ciudad, usr_puntaje FROM user WHERE usr_ciudad = '$ciudad' ORDER BY usr_puntaje DESC, usr_nombre ASC";
								$result = mysqli_query ($conexion, $query);
								$posicion = 1;
								while($fila = mysqli_fetch_row($result)){
									if (($fila[0] == $nombre_usuario) and ($fila[1] == $apellido_usuario)){
										$posicion_ciudad = $posicion;
										echo "<tr class='yo'>";
									}else{
										echo "<tr>";
									}
									echo "<td id='posicion'>".$posicion."</td>";
									echo "<td>".$fila[0]." ".$fila[1]."</td>";
									echo "<td>".$fila[2]."</td>";
									echo "<td id='puntaje'>".$fila[3]."</td></tr>";
									$posicion++;
								}//while
							?>
						</table>
					</article>
				</div>
				<div class="panel-lateral">
					<div class="panel-cabecera">
						<div class="panel-cabecera-jugador">
							<p id="titulo">JUGADOR</p>
							<p><?php echo $_SESSION['usuario']." ".$_SESSION['apellido'] ?></p>
						</div>
					</div>
					<div class="panel-lateral-detalle">
						<?php
							$dni = $_SESSION['dni'];
							$consulta = "SELECT usr_puntaje FROM user WHERE usr_dni = '$dni'";
							$resultado = mysqli_query($conexion, $consulta);
							$puntos = mysqli_fetch_row($resultado);
						?>
						<div class="panel-detalle-puntaje">
							<p id="titulo">PUNTOS TOTALES</p>
							<p id="detalle"><?php echo $puntos[0] ?></p>
						</div>
						<div class="panel-detalle-posgral">
							<p id="titulo">POSICIÓN GENERAL</p>
							<p id="detalle"><?php echo $posicion_general ?></p>
						</div>
						<div class="panel-detalle-posciudad">
							<p id="titulo">POS. EN TU CIUDAD</p>
							<p id="detalle"><?php echo $posicion_ciudad ?></p>
						</div>
						<?php
							$consulta = "SELECT eq_bandera FROM equipo WHERE eq_nombre = (SELECT usr_campeon FROM user WHERE usr_dni = '$dni')";
							$resultado = mysqli_query($conexion, $consulta);
							$puesto = mysqli_fetch_row($resultado);
							$campeon = $puesto[0];
						?>
						<div class="panel-detalle-pronostico">
							<p class="titulocampeon" id="titulo">PRONÓSTICO CAMPEÓN</p>
							<p class="detallecampeon" id="detalle"><img src="<?php echo $campeon ?>"></p>
						</div>
					</div>
					<div class="panel-lateral-footer">
						<div class="panel-lateral-footer-cabecera">
							<p>DATOS PERSONALES</p>
						</div>
						<div class="panel-lateral-footer-detalle">
							<div class="panel-footer-datos"><p id="titulo">Nombre: </p><p id="detalle"><?php echo $_SESSION['usuario']; ?></p></div>
							<div class="panel-footer-datos"><p id="titulo">Apellido: </p><p id="detalle"><?php echo $_SESSION['apellido']; ?></p></div>
							<div class="panel-footer-datos"><p id="titulo">Ciudad: </p><p id="detalle"><?php echo $_SESSION['ciudad']; ?></p></div>
							<div class="panel-footer-datos"><p id="titulo">E-mail: </p><p id="detalle-email"><?php echo $_SESSION['email']; ?></p></div>
						</div>
						
					</div>
				</div>
			</section>
		</section>
	</section>

	<?php
		include('footer.html');
	}
	?>
</body>
</html>
