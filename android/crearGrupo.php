<?php

$db_host = "localhost";
$db_user = "prodefut";
$db_pass = "8C862wunTo";
$db_base = "prodefut_Prode1";
$pass = "";
$json = array();

if (isset($_GET["grupo"]) && isset($_GET["dni"]) && isset($_GET["premio"])) {
	$nombreGrupo = $_GET["grupo"];
	$dni = $_GET["dni"];
    $premio = $_GET["premio"];

	$conexion = mysqli_connect($db_host, $db_user, $db_pass, $db_base);

	$query = "INSERT INTO grupos VALUES ('','{$dni}','{$nombreGrupo}','{$premio}','Y')";
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