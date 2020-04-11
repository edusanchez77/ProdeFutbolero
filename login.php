<?php
	require_once("conexion.inc");

	$conexion = mysqli_connect($db_host, $db_user, $db_pass, $db_base);
	if (mysqli_connect_errno()){
		echo "Error al conectar a la base de datos";
		exit();
	}

	mysqli_set_charset($conexion, "utf8");

	$dni = $_POST['dni'];
	$pass = $_POST['pass'];

	session_start();

	$query = "SELECT usr_nombre, usr_apellido, usr_dni, usr_ciudad, usr_email, usr_sexo FROM user WHERE usr_dni = '$dni' and usr_password = '$pass'";
	$result = mysqli_query ($conexion, $query);
	$fila = mysqli_fetch_row($result);

	if(!$fila[0]){
		echo json_encode(array('error' => true));
	}else{
		$_SESSION['usuario'] = $fila[0];
		$_SESSION['apellido'] = $fila[1];
		$_SESSION['dni'] = $fila[2];
		$_SESSION['ciudad'] = $fila[3];
		$_SESSION['email'] = $fila[4];
		$_SESSION['sexo'] = $fila[5];
		$_SESSION['tiempo'] = time();

		if ($fila[5] == "M") {
			$mensaje = "Bienvenido";
		}else{
			$mensaje = "Bienvenida";
		}
		echo json_encode(array('error' => false, 'nombre' => $fila[0], 'mensaje' => $mensaje));
	}

?>