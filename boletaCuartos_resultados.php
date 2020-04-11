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
        $grupo = $_GET['grupo'];
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
<script src="js/boleta.js"></script>
<script src="js/cerrarSesion.js" type="text/javascript"></script>
<link href="css/header.css" rel="stylesheet" type="text/css">
<link href="css/proximospartidos.css" rel="stylesheet" type="text/css">
<link href="css/menu.css" rel="stylesheet" type="text/css">
<link href="css/boletaOctavos.css" rel="stylesheet" type="text/css">
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
			<div id="grupo">
				<p>CUARTOS DE FINAL</p>
			</div>
			<div id="partidos">
				<form method="post" action="insertarResultados.php?grupo=4">
					<div id="fecha">
						<p><br></p>
					</div>
					<?php
						$dia = getdate(time());
						$fecha = $dia['mday']."/".$dia['mon']." ".$dia["hours"].":".$dia["minutes"];
						$fechasistema = strtotime(date("d-m-Y H:i:00",time()));
						//$fechasistema = date('m/d H:i',strtotime($fecha));
						//echo $fechasistema;
						//Obtengo Partido
						$query = "SELECT pa_dia, pa_eq_local, pa_eq_visitante, pa_sede, pa_nro_fecha, pa_id FROM partidos WHERE pa_eq_grupo = '4' and pa_nro_fecha = '1'";
						$result = mysqli_query ($conexion, $query);
						$partido1 = mysqli_fetch_row($result);
						$newDate = date("d/m", strtotime($partido1[0]));
						$newHour = date("H:i", strtotime($partido1[0]));
						$fechapartido = strtotime($partido1[0]);
						//$fechapartido = date('d/m H:i',strtotime($partido1[0]));
						//Obtengo Bandera
						$query_bandera_L = "SELECT eq_bandera FROM equipo WHERE eq_nombre = '$partido1[1]'";
						$result_bandera_L = mysqli_query ($conexion, $query_bandera_L);

						$query_bandera_V = "SELECT eq_bandera FROM equipo WHERE eq_nombre = '$partido1[2]'";
						$result_bandera_V = mysqli_query ($conexion, $query_bandera_V);

						$bandera_local = mysqli_fetch_row($result_bandera_L);
						$bandera_visitante = mysqli_fetch_row($result_bandera_V);

						//Obtengo Pronosticos
						if(isset($_SESSION['dni'])){
						  $dni = $_SESSION['dni'];
						  $query1 = "SELECT res_eq_local, res_eq_visitante, res_pa_id FROM resultados WHERE res_pa_id = '$partido1[5]'";
						  $result1 = mysqli_query ($conexion, $query1);
						  $pronostico1 = mysqli_fetch_row($result1);
						}
					?>
					<div id="partido">
						<div id="dia"><?php if($fechasistema >= $fechapartido){ echo 'Partido disputado'; }else{echo $newDate."&nbsp&nbsp&nbsp".$newHour;} ?></div>
						<div id="banderalocal"><img src=<?php echo $bandera_local[0] ?> ></div>
						<div id="equipolocal"><p><?php echo mb_strtoupper($partido1[1],'utf-8') ?></p></div>
						<div id="local"><input name="local1" value="<?php if(isset($dni)){if($pronostico1[2]==$partido1[5]){echo $pronostico1[0];}} ?>"/></div>
						<div id="separador">-</div>
						<div id="visitante"><input name="visitante1" value="<?php if(isset($_SESSION['dni'])){if($pronostico1[2]==$partido1[5]){echo $pronostico1[1];}}?>"/></div>
						<div id="equipovisitante"><p><?php echo mb_strtoupper($partido1[2],'utf-8') ?></p></div>
						<div id="banderavisitante"><img src=<?php echo $bandera_visitante[0] ?>></div>
						<div id="sede"><?php echo $partido1[3] ?></div>
						<input type=hidden name="partido1" value="<?php echo $partido1[5] ?>">
					</div>

					<?php
						//Obtengo Partido
						$partido2 = mysqli_fetch_row($result);

						$newDate = date("d/m", strtotime($partido2[0]));
						$newHour = date("H:i", strtotime($partido2[0]));
                        $fechapartido = strtotime($partido2[0]);
						//Obtengo Bandera
						$query_bandera_L = "SELECT eq_bandera FROM equipo WHERE eq_nombre = '$partido2[1]'";
						$result_bandera_L = mysqli_query ($conexion, $query_bandera_L);

						$query_bandera_V = "SELECT eq_bandera FROM equipo WHERE eq_nombre = '$partido2[2]'";
						$result_bandera_V = mysqli_query ($conexion, $query_bandera_V);

						$bandera_local = mysqli_fetch_row($result_bandera_L);
						$bandera_visitante = mysqli_fetch_row($result_bandera_V);

						//Obtengo Pronosticos
						if(isset($_SESSION['dni'])){
						  $dni = $_SESSION['dni'];
						  $query1 = "SELECT res_eq_local, res_eq_visitante, res_pa_id FROM resultados WHERE res_pa_id = '$partido2[5]'";
						  $result1 = mysqli_query ($conexion, $query1);
						  $pronostico2 = mysqli_fetch_row($result1);
						}
					?>

					<div id="partido">
						<div id="dia"><?php if($fechasistema >= $fechapartido){ echo 'Partido disputado'; }else{echo $newDate."&nbsp&nbsp&nbsp".$newHour;} ?></div>
						<div id="banderalocal"><img src=<?php echo $bandera_local[0] ?> ></div>
						<div id="equipolocal"><p><?php echo mb_strtoupper($partido2[1],'utf-8') ?></p></div>
						<div id="local"><input name="local2" value="<?php if(isset($dni)){if($pronostico2[2]==$partido2[5]){echo $pronostico2[0];}}?>" /></div>
						<div id="separador">-</div>
						<div id="visitante"><input name="visitante2" value="<?php if(isset($_SESSION['dni'])){if($pronostico2[2]==$partido2[5]){echo $pronostico2[1];}}?>" /></div>
						<div id="equipovisitante"><p><?php echo mb_strtoupper($partido2[2],'utf-8') ?></p></div>
						<div id="banderavisitante"><img src=<?php echo $bandera_visitante[0] ?>></div>
						<div id="sede"><?php echo $partido2[3] ?></div>
						<input type=hidden name="partido2" value="<?php echo $partido2[5] ?>">
					</div>

					<?php
						//Obtengo Partido
						$partido3 = mysqli_fetch_row($result);

						$newDate = date("d/m", strtotime($partido3[0]));
						$newHour = date("H:i", strtotime($partido3[0]));
                        $fechapartido = strtotime($partido1[0]);
						//Obtengo Bandera
						$query_bandera_L = "SELECT eq_bandera FROM equipo WHERE eq_nombre = '$partido2[1]'";
						$result_bandera_L = mysqli_query ($conexion, $query_bandera_L);

						$query_bandera_V = "SELECT eq_bandera FROM equipo WHERE eq_nombre = '$partido2[2]'";
						$result_bandera_V = mysqli_query ($conexion, $query_bandera_V);

						$bandera_local = mysqli_fetch_row($result_bandera_L);
						$bandera_visitante = mysqli_fetch_row($result_bandera_V);

						//Obtengo Pronosticos
						if(isset($_SESSION['dni'])){
						  $dni = $_SESSION['dni'];
						  $query1 = "SELECT res_eq_local, res_eq_visitante, res_pa_id FROM resultados WHERE res_pa_id = '$partido3[5]'";
						  $result1 = mysqli_query ($conexion, $query1);
						  $pronostico3 = mysqli_fetch_row($result1);
						}
					?>

					<div id="partido">
						<div id="dia"><?php if($fechasistema >= $fechapartido){ echo 'Partido disputado'; }else{echo $newDate."&nbsp&nbsp&nbsp".$newHour;} ?></div>
						<div id="banderalocal"><img src=<?php echo $bandera_local[0] ?> ></div>
						<div id="equipolocal"><p><?php echo mb_strtoupper($partido3[1],'utf-8') ?></p></div>
						<div id="local"><input name="local3" value="<?php if(isset($dni)){if($pronostico3[2]==$partido3[5]){echo $pronostico3[0];}}?>" /></div>
						<div id="separador">-</div>
						<div id="visitante"><input name="visitante3" value="<?php if(isset($_SESSION['dni'])){if($pronostico3[2]==$partido3[5]){echo $pronostico3[1];}}?>" /></div>
						<div id="equipovisitante"><p><?php echo mb_strtoupper($partido3[2],'utf-8') ?></p></div>
						<div id="banderavisitante"><img src=<?php echo $bandera_visitante[0] ?>></div>
						<div id="sede"><?php echo $partido3[3] ?></div>
						<input type=hidden name="partido3" value="<?php echo $partido3[5] ?>">
					</div>

					<?php
						//Obtengo Partido
						$partido4 = mysqli_fetch_row($result);

						$newDate = date("d/m", strtotime($partido4[0]));
						$newHour = date("H:i", strtotime($partido4[0]));
                        $fechapartido = strtotime($partido1[0]);
						//Obtengo Bandera
						$query_bandera_L = "SELECT eq_bandera FROM equipo WHERE eq_nombre = '$partido4[1]'";
						$result_bandera_L = mysqli_query ($conexion, $query_bandera_L);

						$query_bandera_V = "SELECT eq_bandera FROM equipo WHERE eq_nombre = '$partido4[2]'";
						$result_bandera_V = mysqli_query ($conexion, $query_bandera_V);

						$bandera_local = mysqli_fetch_row($result_bandera_L);
						$bandera_visitante = mysqli_fetch_row($result_bandera_V);

						//Obtengo Pronosticos
						if(isset($_SESSION['dni'])){
						  $dni = $_SESSION['dni'];
						  $query1 = "SELECT res_eq_local, res_eq_visitante, res_pa_id FROM resultados WHERE res_pa_id = '$partido4[5]'";
						  $result1 = mysqli_query ($conexion, $query1);
						  $pronostico4 = mysqli_fetch_row($result1);
						}
					?>

					<div id="partido">
						<div id="dia"><?php if($fechasistema >= $fechapartido){ echo 'Partido disputado'; }else{echo $newDate."&nbsp&nbsp&nbsp".$newHour;} ?></div>
						<div id="banderalocal"><img src=<?php echo $bandera_local[0] ?> ></div>
						<div id="equipolocal"><p><?php echo mb_strtoupper($partido4[1],'utf-8') ?></p></div>
						<div id="local"><input name="local4" value="<?php if(isset($dni)){if($pronostico4[2]==$partido4[5]){echo $pronostico4[0];}}?>" /></div>
						<div id="separador">-</div>
						<div id="visitante"><input name="visitante4" value="<?php if(isset($_SESSION['dni'])){if($pronostico4[2]==$partido4[5]){echo $pronostico4[1];}}?>" /></div>
						<div id="equipovisitante"><p><?php echo mb_strtoupper($partido4[2],'utf-8') ?></p></div>
						<div id="banderavisitante"><img src=<?php echo $bandera_visitante[0] ?>></div>
						<div id="sede"><?php echo $partido4[3] ?></div>
						<input type=hidden name="partido4" value="<?php echo $partido4[5] ?>">
					</div>
										
					<div class="botones">
						<input type="button" name="" value="SALIR" onclick="confirmacion()">
						<input type="submit" name="boton" value="GUARDAR Y SALIR" onclick="guardar()">
						<input type="submit" name="boton" value="GUARDAR" onclick="guardar()">
					</div>
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