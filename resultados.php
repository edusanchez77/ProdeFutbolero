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
<script src="js/resultados.js"></script>
<script src="js/cerrarSesion.js" type="text/javascript"></script>
<link href="css/header.css" rel="stylesheet" type="text/css">
<link href="css/proximospartidos.css" rel="stylesheet" type="text/css">
<link href="css/menu.css" rel="stylesheet" type="text/css">
<link href="css/resultados.css" rel="stylesheet" type="text/css">
<link href="css/footer.css" rel="stylesheet" type="text/css">
</head>
<body>
	<?php
		include('header.html');
	?>

	<section id="main">
		
		<?php
		mysqli_set_charset($conexion, "utf8");
		include('proximosPartidos.php');
		include('menu.html');
		?>
		
		<section id="contenido">
			<div id="grupo">
				<p>RESULTADOS</p>
			</div>
			<div id="partidos">
				<form method="post" action="">
					<div id="fecha">
						<p><br></p>
					</div>
					<?php
						$dia = getdate(time());
						$fecha = $dia['mday']."/".$dia['mon']." ".$dia["hours"].":".$dia["minutes"];
						$fechasistema = date('m/d H:i',strtotime($fecha));
						//echo $fechasistema;
						//Obtengo Partido
						$queryResultados = "SELECT res_pa_id, res_eq_local, res_eq_visitante, res_ganador FROM resultados ORDER BY res_id DESC";
						$resultResultados = mysqli_query($conexion, $queryResultados);
						$Resultados = mysqli_fetch_row($resultResultados);
						if (!isset($Resultados)) {
							echo "<div id='partido'><div id='noHayPartido'>";
							echo "Todavía no se ha disputado ningún partido";
							echo "</div></div>";
						}else{
						while (isset($Resultados)) {

							$queryPartidos = "SELECT pa_dia, pa_eq_local, pa_eq_visitante, pa_sede, pa_nro_fecha, pa_eq_grupo FROM partidos WHERE pa_id = '$Resultados[0]'";
							$resultPartidos = mysqli_query($conexion, $queryPartidos);
							$Partidos = mysqli_fetch_row($resultPartidos);

							$newDate = date("d/m", strtotime($Partidos[0]));
							$newHour = date("H:i", strtotime($Partidos[0]));

							$query_bandera_L = "SELECT eq_bandera FROM equipo WHERE eq_nombre = '$Partidos[1]'";
							$result_bandera_L = mysqli_query ($conexion, $query_bandera_L);

							$query_bandera_V = "SELECT eq_bandera FROM equipo WHERE eq_nombre = '$Partidos[2]'";
							$result_bandera_V = mysqli_query ($conexion, $query_bandera_V);

							$bandera_local = mysqli_fetch_row($result_bandera_L);
							$bandera_visitante = mysqli_fetch_row($result_bandera_V);

							$queryPuntos = "SELECT pde_puntos FROM puntajes_detalle WHERE pde_pa_id = '$Resultados[0]' and pde_usr_dni = '$dni_usuario'";
							$resultPuntos = mysqli_query($conexion, $queryPuntos);
							$Puntos = mysqli_fetch_row($resultPuntos);

							if (isset($Puntos[0])) {
								$Puntaje = $Puntos[0]." puntos";
								if ($Puntos[0] > 0 ){
									$Imagen = "Images/ok.png";
								}else{
									$Imagen = "Images/error.png";
								}
							}else{
								$Puntaje = "0 puntos";
								$Imagen = "Images/error.png";
							}
                            
                            if($Partidos[5] == '8'){
                                $grupo = "Octavos de Final";
                            }else if($Partidos[5] == '4'){
                                $grupo = "Cuartos de Final";
                            }else if($Partidos[5] == '2'){
                                $grupo = "Semifinal";
                            }else if($Partidos[5] == '3'){
                                $grupo = "Tercer Puesto";
                            }else if($Partidos[5] == '1'){
                                $grupo = "Final";
                            }else if($Partidos[5] == '0'){
                                $grupo = "Campeón";
                            }else{
                                $grupo = "Grupo ".$Partidos[5];
                            }
					?>
						<div id="partido" disabled>
							<div id="dia"><?php echo $grupo ?> </div>
							<div id="banderalocal"><img src=<?php echo $bandera_local[0] ?> > </div>
							<div id="equipolocal"><p><?php echo mb_strtoupper($Partidos[1],'utf-8') ?></p></div>
							<div id="local" <?php if($Partidos[5] == '0'){?>style="display:none" <?php } ?> ><input name="local1" value="<?php echo $Resultados[1] ?>" disabled /></div>
							<div id="separador" <?php if($Partidos[5] == '0'){?>style="display:none" <?php } ?>>-</div>
							<div id="visitante" <?php if($Partidos[5] == '0'){?>style="display:none" <?php } ?>><input name="visitante1" value="<?php echo $Resultados[2] ?>"  disabled /></div>
							<div id="equipovisitante" <?php if($Partidos[5] == '0'){?>style="display:none" <?php } ?>><p><?php echo mb_strtoupper($Partidos[2],'utf-8') ?></p></div>
							<div id="banderavisitante" <?php if($Partidos[5] == '0'){?>style="display:none" <?php } ?>><img src=<?php echo $bandera_visitante[0] ?> > </div>
							<div id="sede">
								<img class="puntos" src="<?php echo $Imagen ?>">
								<div class="PuntosDetalle"><?php echo $Puntaje ?></div>
							</div>
						</div>
					<?php
						$Resultados = mysqli_fetch_row($resultResultados);
						}
						}
					?>
					<br><br><br><br>
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

