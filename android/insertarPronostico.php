<?php

$db_host = "localhost";
$db_user = "prodefut";
$db_pass = "8C862wunTo";
$db_base = "prodefut_Prode1";
$pass = "";
$json = array();

if (isset($_GET["partido"]) && isset($_GET["dni"]) && isset($_GET["local"]) && isset($_GET["visitante"]) ) {
	$dni = $_GET["dni"];  
    $idPartido = $_GET["partido"];
    $local = $_GET["local"];
    $visitante = $_GET["visitante"];

	$conexion = mysqli_connect($db_host, $db_user, $db_pass, $db_base);
    
    $query = "SELECT * FROM pronosticos WHERE pro_usr_dni = '{$dni}' and pro_pa_id = '{$idPartido}'";
    $result = mysqli_query ($conexion, $query);	
	$fila = mysqli_fetch_row($result);

	if(isset($fila)){
		$query1 = "UPDATE pronosticos SET pro_local = '{$local}', pro_visitante = '{$visitante}' WHERE pro_usr_dni = '{$dni}' and pro_pa_id = '{$idPartido}'";
		$result1 = mysqli_query ($conexion, $query1); 
	}else{
		$query1 = "INSERT INTO pronosticos (pro_usr_dni, pro_pa_id, pro_local, pro_visitante) VALUES('{$dni}', '{$idPartido}', '{$local}', '{$visitante}')";
		$result1 = mysqli_query ($conexion, $query1);
	}

	if ($result1) {
		if ($reg = mysqli_fetch_array($result1)) {
            $reg['partido'] = "OK";
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