<?php
	require_once("conexion.inc");

	mysqli_set_charset($conexion, "utf8");
	
session_start();

$dni = $_SESSION['dni'];
$grupo = $_GET['grupo'];
/*$partido = $_POST['partido'];
$local = $_POST['local'];
$visitante = $_POST['visitante'];*/

$partido[] = $_POST['partido1'];
$partido[] = $_POST['partido2'];
$partido[] = $_POST['partido3'];
$partido[] = $_POST['partido4'];
$partido[] = $_POST['partido5'];
$partido[] = $_POST['partido6'];
$partido[] = $_POST['partido7'];
$partido[] = $_POST['partido8'];

$local[] = $_POST['local1'];
$local[] = $_POST['local2'];
$local[] = $_POST['local3'];
$local[] = $_POST['local4'];
$local[] = $_POST['local5'];
$local[] = $_POST['local6'];
$local[] = $_POST['local7'];
$local[] = $_POST['local8'];

$visitante[] = $_POST['visitante1'];
$visitante[] = $_POST['visitante2'];
$visitante[] = $_POST['visitante3'];
$visitante[] = $_POST['visitante4'];
$visitante[] = $_POST['visitante5'];
$visitante[] = $_POST['visitante6'];
$visitante[] = $_POST['visitante7'];
$visitante[] = $_POST['visitante8'];

$boton = $_POST['boton'];

for($i=0; $i<8; $i++){
	if($local[$i] == NULL){
		//echo "Partido ".$partido[$i].", No hace nada porque es Nulo<br>";
	}
	else{
		if ($local[$i] > $visitante[$i]) {
			$ganador = "L";
		}
		elseif ($local[$i] < $visitante[$i]) {
			$ganador = "V";
		}
		elseif ($local[$i] == $visitante[$i]) {
			$ganador = "E";
		}

		$query_resultado = "SELECT * FROM resultados WHERE res_pa_id = '$partido[$i]'";
		$result_resultado = mysqli_query($conexion,$query_resultado);
		$fila_resultado = mysqli_fetch_row($result_resultado);

		if (isset($fila_resultado)) {
			
		}else{
		
			$query1 = "INSERT INTO resultados VALUES('','".$partido[$i]."', '".$local[$i]."', '".$visitante[$i]."','".$ganador."')";
			$result1 = mysqli_query ($conexion, $query1);


			$query_pronosticos = "SELECT pro_usr_dni, pro_local, pro_visitante, pro_ganador FROM pronosticos WHERE pro_pa_id = '$partido[$i]'";
			$result_pronosticos = mysqli_query($conexion, $query_pronosticos);
			while ($pronosticos = mysqli_fetch_row($result_pronosticos)){
				if (($local[$i] == $pronosticos[1]) and ($visitante[$i] == $pronosticos[2])) {
					$puntos = 10;
				}
				elseif (($local[$i] == $pronosticos[1]) and ($visitante[$i] != $pronosticos[2])) {
					if ($ganador == $pronosticos[3]) {
						$puntos = 4;
					}else{
						$puntos = 3;	
					}
				}
				elseif (($local[$i] != $pronosticos[1]) and ($visitante[$i] == $pronosticos[2])) {
					if ($ganador == $pronosticos[3]) {
						$puntos = 4;
					}else{
						$puntos = 3;	
					}
				}
				elseif (($local[$i] != $pronosticos[1]) and ($visitante[$i] != $pronosticos[2])) {
					if ($ganador == $pronosticos[3]) {
						$puntos = 1;
					}else{
						$puntos = 0;	
					}
				}

				$query_puntaje = "INSERT INTO puntajes_detalle VALUES ('','".$pronosticos[0]."','".$partido[$i]."','".$puntos."')";
				$result_puntaje = mysqli_query($conexion, $query_puntaje);


				$query_puntos = "UPDATE user SET usr_puntaje = usr_puntaje+".$puntos." WHERE usr_dni = '".$pronosticos[0]."'";
				$result_puntos = mysqli_query($conexion, $query_puntos);

			}
		}
	}
}

if($boton == "GUARDAR"){
	header("location:jugar.php");
}elseif ($boton == "GUARDAR Y SALIR") {
	header("location:jugar.php");	
}



?>