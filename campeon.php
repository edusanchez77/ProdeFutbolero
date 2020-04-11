<?php
	require_once("conexion.inc");

	session_start();

	$dni = $_SESSION['dni'];
	$campeon = $_GET['campeon'];

	//echo $campeon;

	$query = "SELECT eq_nombre FROM equipo WHERE eq_id = '$campeon'";
	$result = mysqli_query($conexion,$query);
	$fila = mysqli_fetch_row($result);

	$nombreEquipo = $fila[0];

	$query = "UPDATE user SET usr_campeon = '$nombreEquipo' WHERE usr_dni = '$dni'";
	$result = mysqli_query ($conexion, $query);

	header('location: pronostico_campeon.php')
?>