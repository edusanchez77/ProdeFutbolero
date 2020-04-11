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
        $grupos_parametro = $_GET['id'];
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
<script src="js/aceptarSolicitud.js" type="text/javascript"></script>
<script src="js/query.js" type="text/javascript"></script>
<script src="js/main.js" type="text/javascript"></script>
<script src="js/grupos.js" type="text/javascript"></script>
<script src="js/modificarGrupo.js" type="text/javascript"></script>
<script src="js/registro.js" type="text/javascript"></script>
<script src="js/cerrarSesion.js" type="text/javascript"></script>
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link href="css/header.css" rel="stylesheet" type="text/css">
<link href="css/proximospartidos.css" rel="stylesheet" type="text/css">
<link href="css/menu.css" rel="stylesheet" type="text/css">
<link href="css/grupos.css" rel="stylesheet" type="text/css">
<link href="css/panellateral.css" rel="stylesheet" type="text/css">
<link href="css/footer.css" rel="stylesheet" type="text/css">
<link href="css/posiciones.css" rel="stylesheet" type="text/css">
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
								<button class="busqueda-button" ><img src="Images/lupa.png"></button>
							</form>
						</div>
					</div>
					<div class="grupos-detalle">
						<form method="POST" action="crea_grupo.php" id="crea_grupo" onsubmit="crearGrupo()">
							<div class="item-form">
								<label>Nombre Grupo</label>
								<input id="nombregrupo" type="text" name="nombre" required="">
							</div>
							<div class="item-form">
								<label>Premio por el que compiten</label>
								<input type="text" name="premio" required="">
								<img src="Images/help.png">
								<span>El premio es definido por el grupo.</span>
							</div>
							<div class="item-form">
								<label>Invitar Amigos</label>
								<textarea id="textarea-form" name="amigos" rows="5"></textarea>
								<img src="Images/help.png">
								<span>Agregá los e-mails de tus amigos separados por coma (sin espacios) e invitalos a participar.</span>
							</div>
							<input type="submit" value="FINALIZAR">
						</form>

						<div class="grupos-pertenecientes">
							<?php
								$consulta = "SELECT inv_id_grupo, inv_usr_dni, inv_tipo, inv_id FROM invitaciones_grupos WHERE inv_email = '$email_usuario' AND inv_status = 'P'";
								$resultado = mysqli_query($conexion, $consulta);
								$grupo = mysqli_fetch_row($resultado);
								while (isset($grupo)) {
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
							<!-- INVITACIONES -->
							<div class="grupos-invitaciones">
								<div class="grupos-invitaciones-detalle">
									<p><?php echo $usuario_invita.$mensaje."<span>".$grupo_invitacion[0]."</span>" ?></p>
								</div>
								<div class="grupos-aceptar-cancelar">
									<a onclick="aceptarSolicitud('<?php echo $id_invitacion ?>','R')"><p id="rechazar">Rechazar</p></a>
									<a onclick="aceptarSolicitud('<?php echo $id_invitacion ?>','A')"><p id="aceptar">Aceptar</p></a>
								</div>
							</div>
							<?php
								$grupo = mysqli_fetch_row($resultado);
								}//WHILE linea 139
							?>
							<!-- FIN INVITACIONES -->

							<?php
								$query_grupos = "SELECT count(1) FROM grupos_miembros WHERE gmi_usr_dni = '$dni_usuario'";
								$resultado_grupos = mysqli_query($conexion,$query_grupos);
								$filas = mysqli_fetch_row($resultado_grupos);

								if ($filas[0] == 0) {
							?>
									<div class="ningun-grupo">
										<p>Todavía no pertenece a ningún grupo.</p>
										<p><br>Creá un grupo nuevo o unite a uno existente y divertite junto a tus amigos.</p>
									</div>
							<?php
								}else{
							?>

							<div class="grupos-pertenecientes-detalle">
								<?php
									if ($grupos_parametro == "0") {
										$consulta = "SELECT gru_nombre, gru_premio, gru_id, gru_usr_dni FROM grupos WHERE gru_usr_dni = '$dni_usuario' LIMIT 1";
										$resultado = mysqli_query($conexion, $consulta);
										$grupo = mysqli_fetch_row($resultado);

										if (!isset($grupo)) {
											$consulta = "SELECT gmi_gru_id FROM grupos_miembros WHERE gmi_usr_dni = '$dni_usuario'";
											$resultado = mysqli_query($conexion, $consulta);
											$id_grupo_miembro = mysqli_fetch_row($resultado);

											$consulta = "SELECT gru_nombre, gru_premio, gru_id, gru_usr_dni FROM grupos WHERE gru_id = '$id_grupo_miembro[0]'";
											$resultado = mysqli_query($conexion, $consulta);
											$grupo = mysqli_fetch_row($resultado);

											$idGrupoInvitacion = $id_grupo_miembro[0];
											$nombre_grupo = $grupo[0];
											$premio_grupo = $grupo[1];
											$id_grupo = $grupo[2];
											$dni_propietario_grupo = $grupo[3];
										}else{
											$nombre_grupo = $grupo[0];
											$premio_grupo = $grupo[1];
											$id_grupo = $grupo[2];
											$dni_propietario_grupo = $grupo[3];
											$idGrupoInvitacion = $grupo[2];
										}
									}else{
										$consulta = "SELECT gru_nombre, gru_premio, gru_id, gru_usr_dni FROM grupos WHERE gru_id = '$grupos_parametro'";
										$resultado = mysqli_query($conexion, $consulta);
										$grupo = mysqli_fetch_row($resultado);

										$nombre_grupo = $grupo[0];
										$premio_grupo = $grupo[1];
										$id_grupo = $grupo[2];
										$dni_propietario_grupo = $grupo[3];
										$idGrupoInvitacion = $grupos_parametro;
									}

									if ($dni_usuario == $dni_propietario_grupo) {
										$flag_propietario = 'Y';
									}else{
										$flag_propietario = 'N';
									}
								?>
								<p><?php echo $nombre_grupo ?></p>
							</div>
					
							
							<div class="cambiar-grupo">
								<select id="cambiar-grupo" name="cambiar-grupo" onChange="nav(this.value)">
									<option value="nothing" selected="selected">- CAMBIAR GRUPO -</option>
									<?php
										$consulta_grupos_miembro = "SELECT gmi_gru_id FROM grupos_miembros WHERE gmi_usr_dni = '$dni_usuario' ORDER BY gmi_gru_id ASC";
										$resultado_grupos_miembro = mysqli_query($conexion, $consulta_grupos_miembro);
										while ($grupos_miembro = mysqli_fetch_row($resultado_grupos_miembro)) 
											{
												$miembro_grupo_id = $grupos_miembro[0];
												$consulta_nombre_grupo = "SELECT gru_nombre FROM grupos WHERE gru_id = '$miembro_grupo_id'";
												$resultado_nombre_grupo = mysqli_query($conexion, $consulta_nombre_grupo);
												$nombre_grupos = mysqli_fetch_row($resultado_nombre_grupo);
									?>
									<option value="grupo.php?id=<?php echo $miembro_grupo_id ?>"><?php echo $nombre_grupos[0] ?></option>	
									<?php
											}//WHILE linea 208
									?>	
								</select>
							</div>

							<div class="grupos-posiciones">
								<div class="grupos-posiciones-cabecera">
									<p>Posiciones</p>
								</div>
								<div class="grupos-posiciones-detalle">
									<table>
										
								<?php
									$query_posiciones = "SELECT usr_dni, usr_nombre, usr_apellido, usr_ciudad, usr_puntaje FROM user WHERE usr_dni IN (SELECT gmi_usr_dni FROM grupos_miembros WHERE gmi_gru_id = '$id_grupo') ORDER BY usr_puntaje DESC, usr_nombre ASC";
									$result_posiciones = mysqli_query($conexion, $query_posiciones);
									$posiciones_grupo = mysqli_fetch_row($result_posiciones);
									$posicion = 1;
									while (isset($posiciones_grupo)) {

										if ($posiciones_grupo[0] == $dni_usuario) {
											?>
										<tr>
											<th id="puntos"><?php echo $posicion?></th>
											<th><?php echo "&nbsp;&nbsp;".$posiciones_grupo[1]." ".$posiciones_grupo[2]?></th>
											
											<th id="puntos"><?php echo $posiciones_grupo[4]." pts."?></th>
										</tr>								
								<?php
										}else{
								?>
										<tr>
											<td id="puntos"><?php echo $posicion?></td>
											<td><?php echo "&nbsp;&nbsp;".$posiciones_grupo[1]." ".$posiciones_grupo[2]?></td>
											
											<td id="puntos"><?php echo $posiciones_grupo[4]." pts."?></td>
										</tr>								
								<?php
										}
										$posicion++;
										$posiciones_grupo = mysqli_fetch_row($result_posiciones);
									}
								?>
									</table>
								</div>
							</div>
							
							<div class="grupos-invitar-premio">
								<div class="grupos-invitar">
									<input class="invitar" id="invitar-amigos" type="submit" value="INVITAR AMIGOS">
									<div class="grupos-invitar-form">
										<form method="POST" action="enviar_invitacion.php" onsubmit="invitarAmigos()">
											<p>Agregá los e-mails de tus amigos (separados por coma, sin espacios) e invitalos a participar.</p>
											<textarea rows="3" name="amigos" required=""></textarea>
											<input type="submit" value="Invitar">
											<input type=hidden name="grupo" value="<?php echo $idGrupoInvitacion ?>">
										</form>
									</div>
								</div>
								<div class="grupos-premio">
									<div class="grupos-premio-detalle">
										<p id="premio-titulo">PREMIO</p>
										<P>Este grupo compite<br>por <?php echo $premio_grupo; ?></P>
									</div>
									<div class="grupos-premio-imagen">
										<img src="Images/trofeo.png">
									</div>
									<?php
										if ($flag_propietario == "Y") {
									?>
									<button class="modificar-grupo">MODIFICAR</button>
									<?php
										}
									?>
									
									<button class="miembros">MIEMBROS</button>
								</div>
							</div>
							
							<div class="grupos-comentarios">
								<form id="form-comentarios" method="POST" action="insertar_comentario.php">
									<label>COMENTARIOS</label>
									<textarea rows="4" name="comentario" required=""></textarea>
									<input type=hidden name="grupo" value="<?php echo $id_grupo; ?>">
									<input type="submit" value="PUBLICAR COMENTARIO">
								</form>
							</div>
							<div class="grupos-aclaracion">
								<img src="Images/info.png">
								<p>Cada grupo tiene la posibilidad de estipular internamente un premio, comprometiéndose a entregarlo al finalizar el juego.</p>
							</div>
							
							<div class="grupos-mostrar-comentarios">
								<?php
									$query_comentarios = "SELECT * FROM comentarios_grupos WHERE com_gru_id = '$id_grupo' AND com_mostrar = 'Y' ORDER BY com_fecha DESC";
									$resultado_comentarios = mysqli_query($conexion, $query_comentarios);
									while ($comentarios = mysqli_fetch_row($resultado_comentarios))
									{
										$comentario_id = $comentarios[0];
										$newDate = date("d/m", strtotime($comentarios[3]));
										$newHour = date("H:i", strtotime($comentarios[3]));
										$fechapartido = date('d/m H:i',strtotime($comentarios[3]));

										$consulta_nombre = "SELECT usr_nombre, usr_apellido FROM user WHERE usr_dni = '$comentarios[2]'";
										$resultado_nombre = mysqli_query($conexion, $consulta_nombre);
										$comentario_nombre = mysqli_fetch_row($resultado_nombre);
                                        
                                        mysqli_set_charset($conexion, "utf8");
								?>
								<div class="comentario-contenido">
									<p id="comentario-usuario"><?php echo $comentario_nombre[0]." ".$comentario_nombre[1] ?></p>
									<p id="fecha"><?php echo $fechapartido; ?></p>
									<p id="comentario"><?php echo $comentarios[4] ?></p>
								</div>
								<div class="comentario-eliminar">
									<?php
										if ($flag_propietario == "Y") {
									?>
									<a onclick="confirmacion(<?php echo $comentario_id ?>)">
										<img src="Images/eliminar.png">
										<p>ELIMINAR</p>
									</a>
									<?php
										}
									?>
								</div>
								<?php
									} //WHILE linea 273
								?>
							</div>
							<?php
				}
				?>
						</div>

						<form method="POST" action="modificaGrupo.php" id="modifica_grupo" onsubmit="modificarGrupo()">

							<?php
								$query = "SELECT * FROM grupos WHERE gru_id = '$id_grupo'";
								$resultado_modificar = mysqli_query($conexion, $query);
								$modificar = mysqli_fetch_row($resultado_modificar);
							?>

							<div class="item-form">
								<label>MODIFICAR Grupo</label>
								<input id="nombregrupo" type="text" name="nombre" required="" value="<?php echo $modificar[2] ?>">
							</div>
							<div class="item-form">
								<label>Premio por el que compiten</label>
								<input type="text" name="premio" required="" value="<?php echo $modificar[3] ?>">
								<img src="Images/help.png">
								<span>El premio es definido por el grupo.</span>
							</div>
							<div class="item-form">
								<label>Invitar Amigos</label>
								<textarea id="textarea-form" name="amigos" rows="5"></textarea>
								<img src="Images/help.png">
								<span>Agregá los e-mails de tus amigos separados por coma (sin espacios) e invitalos a participar.</span>
							</div>
							<input type=hidden name="grupo" value="<?php echo $id_grupo; ?>">
							<input type="submit" value="FINALIZAR">
							<input type="button" value="VOLVER" class="modificarVolver">
						</form>

						<div class="grupos-miembros">
							<?php
								$query_cantidad = "SELECT count(1) FROM grupos_miembros WHERE gmi_gru_id = '$id_grupo'";
								$resultado_cantidad = mysqli_query($conexion, $query_cantidad);
								$cantidad = mysqli_fetch_row($resultado_cantidad);
								$cantidad_miembros = $cantidad[0];
							?>
							<div class="grupos-miembros-cabecera">
								<p id="titulo"><b>MIEMBROS DEL GRUPO</b></p>
								<P id="grupo">NOMBRE: <?php echo $nombre_grupo ?> - MIEMBROS: <?php echo $cantidad_miembros ?></P>
							</div>
							
							<?php

								$query_miembros = "SELECT usr_nombre, usr_apellido, usr_email, usr_dni FROM user WHERE usr_dni IN (SELECT gmi_usr_dni FROM grupos_miembros WHERE gmi_gru_id = '$id_grupo') ORDER BY usr_nombre ASC";
								$resultado_miembros = mysqli_query($conexion, $query_miembros);
								while ($miembros_dni = mysqli_fetch_row($resultado_miembros)) {
									?>
									<div class="grupos-miembros-detalle">
										<div class="grupos-miembros-nombres">
											<p id="miembros-nombres"><?php echo $miembros_dni[0]." ".$miembros_dni[1] ?></p>
											<p id="miembros-mail"><?php echo $miembros_dni[2] ?></p>
										</div>
									<?php
										if (($flag_propietario == "Y") and ($miembros_dni[3] != $dni_usuario)) {
									?>
										<a onclick="eliminarUsuario('<?php echo $id_grupo ?>','<?php echo $miembros_dni[0] ?>','<?php echo $miembros_dni[1] ?>','<?php echo $miembros_dni[3] ?>')">
											<div class="grupos-miembros-eliminar">
												<img src="Images/eliminar.png">
												<p>Eliminar</p>
											</div>
										</a>
									<?php
										}
									?>
									</div>
									<?php
								}
							?>
							<button class="miembros">VOLVER</button>
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
							$consulta = "SELECT usr_nombre, usr_apellido, usr_ciudad, usr_puntaje, usr_dni FROM user ORDER BY usr_puntaje DESC, usr_nombre ASC";
							$resultado = mysqli_query($conexion, $consulta);
							//$puesto = mysqli_fetch_row($resultado);
							$posicion = 1;
							while($fila = mysqli_fetch_row($resultado)){
								if ($fila[4] == $dni_usuario){
									$posicion_general = $posicion;
								}
								$posicion++;
							}

							//$posicion_general = $puesto[0]+1;
						?>
						<div class="panel-detalle-posgral">
							<p id="titulo">POSICIÓN GENERAL</p>
							<p id="detalle"><?php echo $posicion_general ?></p>
						</div>
						<?php
							$ciudad = $_SESSION['ciudad'];
							$consulta_ciudad = "SELECT usr_nombre, usr_apellido, usr_ciudad, usr_puntaje, usr_dni FROM user WHERE usr_ciudad = '$ciudad' ORDER BY usr_puntaje DESC, usr_nombre ASC";
							$resultado_ciudad = mysqli_query($conexion, $consulta_ciudad);
							//$puesto = mysqli_fetch_row($resultado);
							$posicion1 = 1;
							while($fila1 = mysqli_fetch_row($resultado_ciudad)){
								if ($fila1[4] == $dni_usuario){
									$posicion_ciudad = $posicion1;
								}
								$posicion1++;
							}

							//$posicion_ciudad = $posicion1;
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
