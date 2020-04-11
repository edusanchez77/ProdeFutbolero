<?php

$db_host = "localhost";
$db_user = "prodefut";
$db_pass = "8C862wunTo";
$db_base = "prodefut_Prode1";
$pass = "";
$json = array();

if (isset($_GET["dni"]) && isset($_GET["password"]) && isset($_GET["nombre"]) && isset($_GET["apellido"]) && isset($_GET["ciudad"]) && isset($_GET["mail"]) && isset($_GET["cumpleanios"]) && isset($_GET["sexo"])) {
	$dni = $_GET['dni'];
	$password = $_GET['password'];
	$nombre = $_GET['nombre'];
	$apellido = $_GET['apellido'];
	$ciudad = $_GET['ciudad'];
	$mail = $_GET['mail'];
	$cumpleanios = $_GET['cumpleanios'];
	$sexo = $_GET['sexo'];

	$conexion = mysqli_connect($db_host, $db_user, $db_pass, $db_base);

	$query = "INSERT INTO user VALUES ('{$dni}','{$password}','{$nombre}','{$apellido}','{$ciudad}','{$sexo}','{$cumpleanios}','{$mail}','','')";
	mysqli_set_charset($conexion, "utf8");
	$result = mysqli_query($conexion, $query);

	if ($result) {
		if ($reg = mysqli_fetch_array($result)) {
            
			$reg["Usuario"] = $dni;
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