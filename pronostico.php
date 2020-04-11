<?php
	require_once("conexion.inc");

	mysqli_set_charset($conexion, "utf8");
	date_default_timezone_set('America/Argentina/Cordoba');
	putenv("TZ=America/Argentina/Cordoba");

	$fechasistema = strtotime(date("d-m-Y H:i:00",time()));
	
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

$fecha[] = $_POST['fecha1'];
$fecha[] = $_POST['fecha2'];
$fecha[] = $_POST['fecha3'];
$fecha[] = $_POST['fecha4'];
$fecha[] = $_POST['fecha5'];
$fecha[] = $_POST['fecha6'];
$fecha[] = $_POST['fecha7'];
$fecha[] = $_POST['fecha8'];

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
		NULL;
	}
	else{

		if($fechasistema >= $fecha[$i]){
			//echo "Partido ".$partido[$i]." , dia: ".$fecha[$i].", fecha sistema: ".$fechasistema;
		}else{
			//echo "Partido ".$partido[$i]." , dia: ".$fecha[$i].", fecha sistema: ".$fechasistema;
			$query = "SELECT * FROM pronosticos WHERE pro_usr_dni = '$dni' and pro_pa_id = '$partido[$i]'";
			$result = mysqli_query ($conexion, $query);	
			$fila = mysqli_fetch_row($result);

			if(isset($fila)){
				$query1 = "UPDATE pronosticos SET pro_local = '".$local[$i]."', pro_visitante = '".$visitante[$i]."' WHERE pro_usr_dni = '$dni' and pro_pa_id = $partido[$i]";
				$result1 = mysqli_query ($conexion, $query1); 
			}else{
				$query1 = "INSERT INTO pronosticos (pro_usr_dni, pro_pa_id, pro_local, pro_visitante) VALUES('".$dni."', '".$partido[$i]."', '".$local[$i]."', '".$visitante[$i]."')";
				$result1 = mysqli_query ($conexion, $query1);
			
			}		
		}
	}
}

if($boton == "GUARDAR"){
	if ($grupo == '8') {
		header("location:boletaOctavos.php");	
	}elseif ($grupo == '4') {
		header("location:boletaCuartos.php");	
	}elseif ($grupo == '2') {
		header("location:boletaSemifinal.php");	
	}elseif ($grupo == '3') {
		header("location:boletaTercerPuesto.php");	
	}elseif ($grupo == '1') {
		header("location:boletaFinal.php");	
	}else{
		header("location:boleta.php?grupo=$grupo");	
	}
}elseif ($boton == "GUARDAR Y SALIR") {
	header("location:jugar.php");	
}


?>