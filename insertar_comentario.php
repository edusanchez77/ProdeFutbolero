<?php
	require_once("conexion.inc");
    mysqli_set_charset($conexion, "utf8");

	session_start();

	$dni = $_SESSION['dni'];
	$nombre = $_SESSION['usuario'];
	$apellido = $_SESSION['apellido'];
	$grupo = $_POST['grupo'];
	$comentario = $_POST['comentario'];
	$dia = getdate(time());
	$fecha = $dia['mday']."/".$dia['mon']."/".$dia['year']." ".$dia["hours"].":".$dia["minutes"].":".$dia["seconds"];
	$fechasistema = date('Y/m/d H:i:s');


	//echo $nombre." ".$apellido." ".$grupo." ".$comentario." ".$fechasistema;

	$query = "INSERT INTO comentarios_grupos VALUES ('','".$grupo."','".$dni."','".$fechasistema."','".$comentario."','Y')";
	$result = mysqli_query ($conexion, $query);

	header("location: grupo.php?id=$grupo");
?>