<?php
	require_once("conexion.inc");
	session_start();

	$buscar = $_POST['dato'];

	header('location: busqueda_grupo.php');
?>