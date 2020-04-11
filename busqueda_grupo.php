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
<script src="js/cerrarSesion.js" type="text/javascript"></script>
<script src="js/crearGrupo.js" type="text/javascript"></script>
<script src="js/enviarInvitacion.js" type="text/javascript"></script>
<script src="js/query.js" type="text/javascript"></script>
<script src="js/main.js" type="text/javascript"></script>
<script src="js/buscar_grupos.js" type="text/javascript"></script>
<script src="js/registro.js" type="text/javascript"></script>
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link href="css/header.css" rel="stylesheet" type="text/css">
<link href="css/proximospartidos.css" rel="stylesheet" type="text/css">
<link href="css/menu.css" rel="stylesheet" type="text/css">
<link href="css/busquedagrupos.css" rel="stylesheet" type="text/css">
<link href="css/panellateral.css" rel="stylesheet" type="text/css">
<link href="css/footer.css" rel="stylesheet" type="text/css">
<link href="css/posiciones.css" rel="stylesheet" type="text/css">

<script>
function abrir() {
open('pagina.html','','top=300,left=300,width=300,height=300') ;
}
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
		
		<section id="contenido">
			<section id='grupos'>
				<div class="grupos">
					<div class="grupos-cabecera">
						<button class="crear" id="crear-grupo">CREAR GRUPO</button>
						<div class="busqueda">
							<form action="busqueda_grupo.php" method="POST">
								<input type="search" name="dato" class="busqueda-input" placeholder="Buscar Grupo">
								<button class="busqueda-button"><img src="Images/lupa.png"></button>
							</form>
						</div>
					</div>
					<div class="grupos-detalle">
						<form method="POST" action="crea_grupo.php" id="crea_grupo">
							<div class="item-form">
								<label>Nombre Grupo</label>
								<input id="nombregrupo" type="text" name="nombre" required="">
							</div>
							<div class="item-form">
								<label>Premio por el que compiten</label>
								<input type="text" name="premio">
								<img src="Images/help.png">
								<span>El premio es definido por el grupo.</span>
							</div>
							<div class="item-form">
								<label>Invitar Amigos</label>
								<textarea id="textarea-form" name="amigos" rows="5"></textarea>
								<img src="Images/help.png">
								<span>Agregá los e-mails de tus amigos separados por coma e invitalos a participar.</span>
							</div>
							<input type="submit" value="FINALIZAR">
						</form>
						<div class="grupos-busqueda">
							<?php
								$buscar = "";
								$buscar = $_POST['dato'];
								$query = "SELECT distinct(gru_nombre), gru_id FROM grupos WHERE gru_nombre LIKE '%$buscar%'";
								$result = mysqli_query($conexion, $query);
								while ($grupos = mysqli_fetch_row($result)) {
									$idGrupo = $grupos[1];

									$query_duenio = "SELECT 'Y' FROM grupos WHERE gru_id = '$idGrupo' AND gru_usr_dni = '$dni_usuario'";
									$result_duenio = mysqli_query($conexion, $query_duenio);
									$duenio = mysqli_fetch_row($result_duenio);

									if (isset($duenio)) {
										$flag_participante = 'YA ESTAS PARTICIPANDO';
									}else{
										$query_participante = "SELECT 'Y' FROM grupos_miembros WHERE gmi_gru_id = '$idGrupo' AND gmi_usr_dni = '$dni_usuario'";
										$result_participante = mysqli_query($conexion,$query_participante);
										$participante = mysqli_fetch_row($result_participante);								
										if (isset($participante)) {
											$flag_participante = 'YA ESTAS PARTICIPANDO';
										}else{
											$query_invitaciones = "SELECT * FROM invitaciones_grupos WHERE inv_status = 'P' and inv_usr_dni = '$dni_usuario' and inv_id_grupo = '$idGrupo'";
											$result_invitaciones = mysqli_query($conexion,$query_invitaciones);
											$filas_invitaciones = mysqli_fetch_row($result_invitaciones);

											if (isset($filas_invitaciones)) {
												$flag_participante = 'YA SOLICITASTE UNIRTE';
											}else{
												$query_invitaciones = "SELECT * FROM invitaciones_grupos WHERE inv_status = 'P' and inv_email = '$email_usuario' and inv_id_grupo = '$idGrupo'";
												$result_invitaciones = mysqli_query($conexion,$query_invitaciones);
												$filas_invitaciones = mysqli_fetch_row($result_invitaciones);												
												if (isset($filas_invitaciones)) {
													$flag_participante = 'TENES UNA INVITACIÓN PENDIENTE';
												}else{
													$flag_participante = 'SOLICITAR PARTICIPACIÓN';
												}
											}
										}
									}

									$query_cantidad = "SELECT count(1) FROM grupos_miembros WHERE gmi_gru_id = '$idGrupo'";
									$result_cantidad = mysqli_query($conexion,$query_cantidad);
									$cantidad = mysqli_fetch_row($result_cantidad);
									?>
									<div class="grupos-busqueda-resultados">
										<div class="grupos-busqueda-nombres">
											<p id="nombre-grupo"><?php echo $grupos[0] ?></p>	
											<p id="cantidad-miembros"><a onClick="javascript.abrir();"><?php echo $cantidad[0]." miembros" ?></a></p>
										</div>
										<div class="solicitar-ingreso">
											<?php
												if ($flag_participante == 'SOLICITAR PARTICIPACIÓN') {
											?>
											
											<a onclick="enviarInvitacion('<?php echo $idGrupo ?>')"><img src="Images/tests-icon.png"><p><?php echo $flag_participante ?></p></a>
											<?php	
												}else{
													?>
													<p style="margin-top: 10%"><?php echo $flag_participante ?></p>
													<?php
												}
											?>
											
										</div>
									</div>
									<?php
								}
							?>
							<button onclick="window.location.href='grupo.php?id=0';">VOLVER</button>
						</div>
					</div>
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
						<?php
							$consulta = "SELECT count(1) FROM user WHERE usr_puntaje > (SELECT usr_puntaje FROM user WHERE usr_dni = '$dni')";
							$resultado = mysqli_query($conexion, $consulta);
							$puesto = mysqli_fetch_row($resultado);

							$posicion_general = $puesto[0]+1;
						?>
						<div class="panel-detalle-posgral">
							<p id="titulo">POSICIÓN GENERAL</p>
							<p id="detalle"><?php echo $posicion_general ?></p>
						</div>
						<?php
							$ciudad = $_SESSION['ciudad'];
							$consulta = "SELECT count(1) FROM user WHERE usr_ciudad = '$ciudad' AND usr_puntaje > (SELECT usr_puntaje FROM user WHERE usr_dni = '$dni')";
							$resultado = mysqli_query($conexion, $consulta);
							$puesto = mysqli_fetch_row($resultado);

							$posicion_ciudad = $puesto[0]+1;
						?>
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
						<button>MODIFICAR</button>
					</div>
				</div>
			</section>
			</section>
		</section>
	</section>

	<?php
		include('footer.html');
	}
	?>
</body>
</html>
