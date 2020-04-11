<?php

$db_host = "localhost";
$db_user = "prodefut";
$db_pass = "8C862wunTo";
$db_base = "prodefut_Prode1";
$pass = "";
$json = array();

if (isset($_GET["dni"]) && isset($_GET["pass"])) {
	$dni = $_GET["dni"];
	$pass = $_GET["pass"];

	$conexion = mysqli_connect($db_host, $db_user, $db_pass, $db_base);

	$query = "SELECT usr_nombre, usr_apellido, usr_email, usr_ciudad, usr_dni FROM user WHERE usr_dni = '{$dni}' AND usr_password = '{$pass}'";
	mysqli_set_charset($conexion, "utf8");
	$result = mysqli_query($conexion, $query);

	if ($result) {
		if ($reg = mysqli_fetch_array($result)) {
			$json['datos'][] = $reg;
		}
		mysqli_close($conexion);
		echo json_encode($json);
	}else{
		$results["nombre"] = '';
		$results["apellido"] = '';
		$json['datos'][] = $results;
		echo json_encode($json);
	}
}else{
	$results["nombre"] = '';
	$results["apellido"] = '';
	$json['datos'][] = $results;
	echo json_encode($json);
}

?>