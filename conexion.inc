<?php

$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_base = "prode";

$conexion = mysqli_connect($db_host, $db_user, $db_pass, $db_base);
if (mysqli_connect_errno()){
	echo "Error al conectar a la base de datos";
	exit();
}

?>