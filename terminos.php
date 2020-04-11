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
<script src="js/cerrarSesion.js" type="text/javascript"></script>
<link href="css/header.css" rel="stylesheet" type="text/css">
<link href="css/proximospartidos.css" rel="stylesheet" type="text/css">
<link href="css/menu.css" rel="stylesheet" type="text/css">
<link href="css/reglamento.css" rel="stylesheet" type="text/css">
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
			<div id="titulo">
				<h2>TÉRMINOS Y CONDICIONES</h2>
			</div>
			<div id="detalle">
				<div id="item">
					<p>Compañía organizadora</p>
				</div>
				<div id="descripcion">
					<p>El presente juego, denominado Prode Futbolero, fue diseñado por GAELA - Soluciones Gráficas - y desarrollado y organizado por CBA-ELECTRONICS.</p>
				</div>

				<div id="item">
					<p>Duración</p>
				</div>
				<div id="descripcion">
					<p>La fecha de comienzo de esta edición, Rusia 2018, será el día 14/06 a las 12h y finalizará el día 15/07 a las 18h.</p>
				</div>

				<div id="item">
					<p>Finalidad</p>
				</div>
				<div id="descripcion">
					<p>El sitio tiene como finalidad jugar durante toda la copa del mundo, acertar cómo saldrán los partidos y así competir con los demás participantes.</p>
				</div>

				<div id="item">
					<p>Requisitos para participar</p>
				</div>
				<div id="descripcion">
					<p>Podrán participar en el concurso personas físicas, mayores de 15 años.</p>
				</div>

				<div id="item">
					<p>Mecánica del concurso</p>
				</div>
				<div id="descripcion">
					<p>Para participar, se seguirán las siguientes instrucciones:<br>&nbsp;- Acceder al sitio “Prode Futbolero”, registrarse, aceptar los términos y condiciones y completar los pronósticos correspondientes a los partidos a disputarse.<br>&nbsp;- Elegir el país que consideran será campeón y en caso de acertar, esto otorgará puntos extras.<br><br> Cualquier contenido de mal gusto, que vaya en contra de un particular o del dueño del sitio, sea político, religioso, racista, xenófobo, sexista o cualquier tipo de contenido que no se consideren adecuado para su publicación podrá ser eliminado del sitio y el participante descalificado.</p>
				</div>

				<div id="item">
					<p>Selección de ganadores</p>
				</div>
				<div id="descripcion">
					<p>Los ganadores serán aquellos participantes que hayan obtenido la mayor cantidad de puntos al finalizar la copa del mundo.</p>
				</div>

				<div id="item">
					<p>Comunicación a los ganadores</p>
				</div>
				<div id="descripcion">
					<p>Se anunciará al ganador en la web oficial y se lo contactará a través de un correo electrónico.</p>
				</div>

				<div id="item">
					<p>Descripción y entrega del premio</p>
				</div>
				<div id="descripcion">
					<p>Corre por cuenta de cada grupo.</p>
				</div>

				<div id="item">
					<p>Uso de los datos de carácter personal</p>
				</div>
				<div id="descripcion">
					<p>De todos los participantes recopilamos y procesamos la siguiente información de carácter personal:<br>- Nombre y apellido<br>- Correo electrónico<br>- Fecha de nacimiento<br>- DNI<br>- Localidad<br>Todos los datos personales solicitados se utilizarán únicamente para comprobar los requisitos establecidos en las presentes bases. Estos datos se archivarán en una base de datos interna con fines administrativos y/o promocionales de esta aplicación. No vamos a vender, distribuir o ceder su información personal a terceros a menos que tengamos su permiso o estemos obligados por ley a hacerlo.  </p>
				</div>

				<div id="item">
					<p>Aceptación de las bases</p>
				</div>
				<div id="descripcion">
					<p>La participación en el juego supone la aceptación en su totalidad de las presentes bases.<br>&nbsp;&nbsp;&nbsp;&nbsp;Cualquier pregunta, comentario o queja en relación con el sitio deberá remitirse a contacto@prodefutbolero.com.ar </p>
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