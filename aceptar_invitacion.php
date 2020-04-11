<?php
	require_once("conexion.inc");

	session_start();

	$id_invitacion = $_GET['invitacion'];
	$status = $_GET['status'];

	//Selecciono idGrupo y dni usuario que manda la invitación
	$query = "SELECT inv_id_grupo, inv_email, inv_usr_dni, inv_tipo FROM invitaciones_grupos WHERE inv_id = '$id_invitacion'";
	$result = mysqli_query($conexion, $query);
	$grupo = mysqli_fetch_row($result);

	$id_grupo = $grupo[0]; 
	$email = $grupo[1];
	$dni_solicitud = $grupo[2];
    $tipo = $grupo[3];

    if($tipo == "INVITACION"){
        //Selecciono dni del invitado
        $query = "SELECT usr_dni FROM user WHERE usr_email = '$email'";
        $result = mysqli_query($conexion, $query);
        $result_dni = mysqli_fetch_row($result);    
        $dni = $result_dni[0]; //dni usuario invitado
    }
    if($tipo == "SOLICITUD"){
        $dni = $dni_solicitud;
    }
    
	$query = "SELECT gru_nombre, gru_premio FROM grupos WHERE gru_id = '$id_grupo'";
	$result = mysqli_query($conexion, $query);
	$grupo = mysqli_fetch_row($result);

	$nombre_grupo = $grupo[0];
	$premio_grupo = $grupo[1];

	//$amigos = "edu_sanchez77@hotmail.com";
	//echo $grupo." ".$dni." ".$amigos;

	$query = "UPDATE invitaciones_grupos SET inv_status = '$status' WHERE inv_id = '$id_invitacion'";
	$result = mysqli_query ($conexion, $query);

	if ($status == "A") {
		$query = "INSERT INTO grupos_miembros VALUES ('','".$id_grupo."','".$dni."')";
		$result = mysqli_query ($conexion, $query);
	}

	header("location: grupo.php?id=0");
?>