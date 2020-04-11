<?php
	require_once("conexion.inc");
	session_start();

	$idGrupo = $_GET['id'];
	$dniUsuario = $_GET['dni'];
	
	//echo $idGrupo." ".$dniUsuario;

	$query = "DELETE FROM grupos_miembros WHERE gmi_gru_id = '$idGrupo' AND gmi_usr_dni = '$dniUsuario'";
	$result = mysqli_query($conexion, $query);

	header("location: grupo.php?id=$idGrupo");
?>