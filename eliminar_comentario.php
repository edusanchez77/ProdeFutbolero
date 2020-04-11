<?php
	require_once("conexion.inc");
	session_start();

	$id_comentario = $_GET['id'];
	
	$query_grupo = "SELECT com_gru_id FROM comentarios_grupos WHERE com_id = '$id_comentario'";
	$resultado_grupo = mysqli_query($conexion, $query_grupo);
	$fila = mysqli_fetch_row($resultado_grupo);
	$id_grupo = $fila[0];

	$query_grupo = "SELECT gru_nombre FROM grupos WHERE gru_id = '$id_grupo'";
	$resultado_grupo = mysqli_query($conexion, $query_grupo);
	$fila = mysqli_fetch_row($resultado_grupo);
	$nombre_grupo = $fila[0];	

	$query = "UPDATE comentarios_grupos SET com_mostrar = 'N' WHERE com_id = $id_comentario";	
	$result = mysqli_query($conexion, $query);

	header("location: grupo.php?id=$id_grupo");
?>