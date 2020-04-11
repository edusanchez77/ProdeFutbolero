<?php
	require_once("conexion.inc");

	session_start();

	$campeon = $_GET['campeon'];

	//echo $campeon;

	$query = "INSERT INTO resultados VALUES('','65', '0', '0','L')";
	$result = mysqli_query($conexion,$query);
	$fila = mysqli_fetch_row($result);

	$queryUser = "SELECT usr_dni, usr_puntaje FROM user WHERE usr_campeon = 'Francia'";
	$resultUser = mysqli_query($conexion,$queryUser);
	while ($filaUser = mysqli_fetch_row($resultUser)) {
		$queryPuntos = "UPDATE user SET usr_puntaje = $filaUser[1] + 15 WHERE usr_dni = $filaUser[0]";
		$resultPuntos = mysqli_query($conexion,$queryPuntos);

		$query_puntaje = "INSERT INTO puntajes_detalle VALUES ('','".$filaUser[0]."','65','15')";
		$result_puntaje = mysqli_query($conexion, $query_puntaje);
	}

	header('location: jugar.php')
?>