<?php
	require_once("conexion.inc");

	session_start();
	mysqli_set_charset($conexion, "utf8");
	$grupos_parametro = $_GET['grupo'];
	$dni = $_SESSION['dni'];
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Mi Prode</title>
<style type="text/css">
</style>
<script src="js/query.js" type="text/javascript"></script>
<script src="js/main.js" type="text/javascript"></script>
<script src="js/grupos.js" type="text/javascript"></script>
<script src="js/registro.js" type="text/javascript"></script>
<link href="css/grupos.css" rel="stylesheet" type="text/css">
<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
	<script type="text/javascript">
		function nav(value) {
			if (value != ""){ 
				location.href = value; 
			}
		}
	</script>
	<div class="error">
		<span>Datos de Ingreso no válidos, intentalo de nuevo por favor</span>
	</div>
	<header>
		
		<div id="subheader">
			<div id="logotipo">
				<img src="Images/Logo/LogoCopa.png" id="copa">
				<img src="Images/Logo/rusia 2018.png" id="rusia">
			</div>
			<div id="nombre">
				<p><a href="index.php">PRODE FUTBOLERO</a></p>
			</div>
			
			<div id="ingresar">
				<ul class="nav-right">
					<li class="dropdown">
						<?php
							if(isset($_SESSION['usuario'])){
								?>
									<p>Hola, <b><?php echo $_SESSION['usuario'] ?></b><img src="Images/menu.png"></p>
									<ul class="sub-menu">
										<li><a href="index.php">Jugar</a></li>
										<?php
											if ($_SESSION['dni'] == "29851491") {
												echo "<li id='sesion' class='sesion'><a href='index_resultados.php'>Resultados</a></li>";
											}
										?>
										<li><a href="posiciones.php">Posiciones</a></li>
										<li><a href="grupos.php">Grupos</a></li>
										<li id="sesion" class="sesion"><a href="cerrarsesion.php"><b>Cerrar sesión</b></a></li>
									</ul>
								<?php
							}else{
								?>
									<a href="#"><p>Ingresar</p></a>
									<ul class="sub-menu">
										<li id="sesion" class="sesion">
											<form action="" id="formlg">
												<div class="inputBox"> 
													<input type="text" name="dni" required="" placeholder="dni"> 
													<input type="password" name="pass" required="" placeholder="password"> 
												</div> 
												<input class="botonlg" type="submit" name="" value="INGRESAR">
								    		</form> 
										</li>
									</ul>
								
						
					</li>
					<li><a href="registro.html"><p> | Registrarme</p></a></li>
					<?php
						}
					?>
				</ul>
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
			<section id='grupos'>
				<div class="grupos">
					<div class="grupos-cabecera">
						<button class="crear" id="crear-grupo">CREAR GRUPO</button>
						<div class="busqueda">
							<form action="busqueda_grupo.php" method="POST">
								<input type="search" name="dato" class="busqueda-input" placeholder="Buscar Grupo">
								
								<button class="busqueda-button">&#128269;</button>
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
						<div class="grupos-pertenecientes">
							<?php

								if(!isset($_SESSION['dni'])){
									echo "<p>Tenés que iniciar sesión</p>";
									
								}else{ //1
								$email = $_SESSION['email']; 
								$consulta = "SELECT inv_id_grupo, inv_usr_dni, inv_tipo, inv_id FROM invitaciones_grupos WHERE inv_email = '$email' AND inv_status = 'P'";
								$resultado = mysqli_query($conexion, $consulta);
								$grupo = mysqli_fetch_row($resultado);

								while (isset($grupo)){//2
									$dni_invita = $grupo[1];
									$grupo_invita = $grupo[0];
									$tipo_solicitud = $grupo[2];
									$id_invitacion = $grupo[3];

									if ($tipo_solicitud == "INVITACION") {
										$mensaje = " te está invitando a unirte al grupo ";
									}
									elseif ($tipo_solicitud == "SOLICITUD") {
										$mensaje = " está solicitando unirse al grupo ";
									}

									$consulta_usuario = "SELECT usr_nombre, usr_apellido FROM user WHERE usr_dni = '$dni_invita'";
									$resultado_usuario = mysqli_query($conexion, $consulta_usuario);
									$nombre_usuario = mysqli_fetch_row($resultado_usuario);
									$usuario_invita = $nombre_usuario[0]." ".$nombre_usuario[1];

									$consulta_grupo = "SELECT gru_nombre FROM grupos WHERE gru_id = '$grupo_invita'";
									$resultado_grupo = mysqli_query($conexion, $consulta_grupo);
									$grupo_invitacion = mysqli_fetch_row($resultado_grupo);

									?>
										<div class="grupos-invitaciones">
											<div class="grupos-invitaciones-detalle">
												<p><?php echo $usuario_invita.$mensaje.$grupo_invitacion[0]; ?></p>	
											</div>
											<div class="grupos-aceptar-cancelar">
												<a href="aceptar_invitacion.php?invitacion=<?php echo $id_invitacion ?>&status=R" ><p id="rechazar">Rechazar</p></a>
												<a href="aceptar_invitacion.php?invitacion=<?php echo $id_invitacion ?>&status=A"><p id="aceptar">Aceptar</p></a>
											</div>
										</div>
									<?php
									$grupo = mysqli_fetch_row($resultado);
									}//2

									if ($grupos_parametro == "default") {									
										$consulta = "SELECT gru_nombre, gru_premio, gru_id FROM grupos WHERE gru_usr_dni = '$dni'";
										$resultado = mysqli_query($conexion, $consulta);
										$grupo = mysqli_fetch_row($resultado);

										if (isset($grupo)) {
											$grupo_nombre = $grupo[0];
											$grupo_id = $grupo[2];
											$flag_propietario = "Y";
										}else
										{
											$grupo_nombre = $grupos_parametro;
										}

									?>
									<div class="grupos-pertenecientes-detalle">
										<?php
											echo "<p>".($grupo_nombre)."</p>";
										?>
									</div>

									<div class="cambiar-grupo">
										<select id="cambiar-grupo" name="cambiar-grupo" onChange="nav(this.value)">
											<option value="nothing" selected="selected">- Cambiar Grupo -</option>
											<?php
											$consulta_miembro = "SELECT gmi_gru_id FROM grupos_miembros WHERE gmi_usr_dni = '$dni'";
											$resultado_miembro = mysqli_query($conexion, $consulta_miembro);
											while ($miembro = mysqli_fetch_row($resultado_miembro)) 
												{
													$miembro_grupo_id = $miembro[0];
													$consulta_nombre_grupo = "SELECT gru_nombre FROM grupos WHERE gru_id = '$miembro_grupo_id'";
													$resultado_nombre_grupo = mysqli_query($conexion, $consulta_nombre_grupo);
													$nombre_grupos = mysqli_fetch_row($resultado_nombre_grupo);
													?>
														<option value="grupos.php?grupo=<?php echo $nombre_grupos[0] ?>"><?php echo $nombre_grupos[0] ?></option>
													<?php
													}											?>
											}
												
										</select>
									</div>
									
									<div class="grupos-posiciones">
										<div class="grupos-posiciones-cabecera">
											<p>Posiciones</p>
										</div>
										<div class="grupos-posiciones-detalle">
											<p>Estas en el puesto XXX</p>
										</div>
									</div>

									<div class="grupos-invitar-premio">
										<div class="grupos-invitar">
											<input class="invitar" type="submit" value="INVITAR AMIGOS">
											<div class="grupos-invitar-form">
												<form method="POST" action="enviar_invitacion.php">
													<p>Agregá los e-mails de tus amigos (separados por coma, sin espacios) e invitalos a particpar.</p>
													<textarea rows="3" name="amigos"></textarea>
													<input type="submit" value="Invitar">
													<input type=hidden name="grupo" value="<?php echo $grupo_id; ?>">
												</form>
											</div>
										</div>
										<div class="grupos-premio">
											<div class="grupos-premio-detalle">
												<p id="premio-titulo">PREMIO</p>
												<P>Este grupo compite por<br> <?php echo$grupo[1]; ?></P>
											</div>
											<div class="grupos-premio-imagen">
												<img src="Images/trofeo.png">
											</div>
											<button class="modificar-grupo">MODIFICAR</button>
											<button class="miembros">MIEMBROS</button>
										</div>
									</div>

									<div class="grupos-comentarios">
										<form id="form-comentarios" method="POST" action="insertar_comentario.php">
											<label>COMENTARIOS</label>
											<textarea rows="4" name="comentario"></textarea>
											<input type=hidden name="grupo" value="<?php echo $grupo[2]; ?>">
											<input type="submit" value="PUBLICAR COMENTARIO">
										</form>
									</div>

									<div class="grupos-aclaracion">
										<img src="Images/info.png">
										<p>Cada grupo tiene la posibilidad de estipular internamente un premio, comprometiéndose a entregarlo al finalizar el juego.</p>
									</div>

									<div class="grupos-mostrar-comentarios">
									<?php
										$query = "SELECT * FROM comentarios_grupos WHERE com_gru_id = '$grupo_id' AND com_mostrar = 'Y' ORDER BY com_fecha DESC";
										$resultado = mysqli_query($conexion, $query);
										while ($comentarios = mysqli_fetch_row($resultado))
										{
											$comentario_id = $comentarios[0];
											$newDate = date("d/m", strtotime($comentarios[3]));
											$newHour = date("H:i", strtotime($comentarios[3]));
											$fechapartido = date('d/m H:i',strtotime($comentarios[3]));

											$consulta_nombre = "SELECT usr_nombre, usr_apellido FROM user WHERE usr_dni = '$comentarios[2]'";
											$resultado_nombre = mysqli_query($conexion, $consulta_nombre);
											$comentario_nombre = mysqli_fetch_row($resultado_nombre);
									?>
									
										<div class="comentario-contenido">
											<p id="comentario-usuario"><?php echo $comentario_nombre[0]." ".$comentario_nombre[1] ?></p>
											<p id="fecha"><?php echo $fechapartido; ?></p>
											<p id="comentario"><?php echo $comentarios[4] ?></p>
										</div>
										<?php
											if (($flag_propietario == "Y")) {
												?>
												<div class="comentario-eliminar">
													<a href="eliminar_comentario.php?id=<?php echo $comentario_id ?>">
														<img src="Images/eliminar.png">
														<p>ELIMINAR</p>
													</a>
												</div>
											<?php
											}
										}
									?>
									</div>
									<!--<div class="grupos-aclaracion">
										<img src="Images/info.png">
										<p>Cada grupo tiene la posibilidad de estipular internamente un premio, comprometiéndose a entregarlo al finalizar el juego.</p>
									</div>-->
											<?php
										}else{
											echo "<p>Todavía no perteneces a ningún grupo</p>";;
										}
									 }
									?>
						</div>
						<div class="grupos-miembros">
							<?php
								if (isset($grupo)) {
									$nombre_grupo = $grupo[0];
									$id_grupo = $grupo[2];
								}
								else{
									$id_grupo = $miembro[0];

									$consulta_gru = "SELECT gru_nombre, gru_premio, gru_id FROM grupos WHERE gru_id = '$grupo_id'";
									$resultado_gru = mysqli_query($conexion, $consulta_gru);
									$grupo_gru = mysqli_fetch_row($resultado_gru);
									$nombre_grupo = $grupo_gru[0];
								}

								
								$query_cantidad = "SELECT count(1) FROM grupos_miembros WHERE gmi_gru_id = '$id_grupo'";
								$resultado_cantidad = mysqli_query($conexion, $query_cantidad);
								$cantidad = mysqli_fetch_row($resultado_cantidad);
							?>
							<div class="grupos-miembros-cabecera">
								<p id="titulo"><b>MIEMBROS DEL GRUPO</b></p>
								<P id="grupo">NOMBRE: <?php echo $grupo[0] ?> - MIEMBROS: <?php echo $cantidad[0] ?></P>
							</div>
							<?php
								$query_miembros = "SELECT gru_usr_dni FROM grupos WHERE gru_id = '$id_grupo'";
								$resultado_miembros = mysqli_query($conexion, $query_miembros);
								$miembros_dni = mysqli_fetch_row($resultado_miembros);

								$user_dni = $miembros_dni[0];
								$query_miembros1 = "SELECT usr_nombre, usr_apellido, usr_email FROM user WHERE usr_dni = '$user_dni'";
								$resultado_miembros1 = mysqli_query($conexion, $query_miembros1);
								$miembros = mysqli_fetch_row($resultado_miembros1);
							?>
							

							<?php
								$query_miembros = "SELECT gmi_usr_dni FROM grupos_miembros WHERE gmi_gru_id = '$id_grupo'";
								$resultado_miembros = mysqli_query($conexion, $query_miembros);
								while ($miembros_dni = mysqli_fetch_row($resultado_miembros)) {
									$miembro_dni = $miembros_dni[0];

									if ($user_dni == $miembro_dni) {
										$flag_propietario = "N";
									}

									$query_miembros1 = "SELECT usr_nombre, usr_apellido, usr_email FROM user WHERE usr_dni = '$miembro_dni'";
									$resultado_miembros1 = mysqli_query($conexion, $query_miembros1);
									$miembros = mysqli_fetch_row($resultado_miembros1);

									?>
									<div class="grupos-miembros-detalle">
										<div class="grupos-miembros-nombres">
											<p id="miembros-nombres"><?php echo $miembros[0]." ".$miembros[1] ?></p>
											<p id="miembros-mail"><?php echo $miembros[2] ?></p>
										</div>
										<?php
											if ($flag_propietario == "Y") {
												?>
												<div class="grupos-miembros-eliminar">
													<img src="Images/eliminar.png">
													<p>Eliminar</p>
												</div>
												<?php
											}
										?>
									</div>
									<?php
								}
							?>
						
							<button class="miembros">Volver</button>
						</div>
					</div>
				</div>
				<div class="panel-lateral">
					<div class="panel-cabecera">
						<div class="panel-cabecera-jugador">
							<p id="titulo">JUGADOR</p>
							<p><?php echo $_SESSION['usuario']." ".$_SESSION['apellido'] ?></p>
						</div>
						<button onclick="window.location.href='cerrarsesion.php'">CERRAR SESIÓN</button>
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
							<p id="titulo">PRONÓSTICO CAMPEÓN</p>
							<p id="detalle"><img src="<?php echo $campeon ?>"></p>
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

	<footer>
		<nav>
			<ul>
				<div id="final">
					<li><a href="reglamento.php">REGLAMENTO</a></li>
					<li><a href="contacto.html">CONTACTO</a></li>
				</div>
			</ul>
		</nav>
	</footer>
</body>
</html>
