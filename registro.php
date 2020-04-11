<?php
	require_once("conexion.inc");
	mysqli_set_charset($conexion, "utf8");

	$dni = $_POST['dni'];
	$password = $_POST['password'];
	$nombre = $_POST['nombre'];
	$apellido = $_POST['apellido'];
	$ciudad = $_POST['ciudad'];
	$mail = $_POST['mail'];
	$cumpleanios = $_POST['cumpleanios'];
	$sex = $_POST['sex'];
	$volver = $_POST['volver'];
	if ($volver == "Y") {
		session_start();
		$dni_usuario = $_SESSION['dni'];
	}

	//echo $dni." ".$password." ".$nombre." ".$apellido." ".$ciudad." ".$mail." ".$cumpleanios." ".$sex." ";

	

	
		if ($volver == "Y") {
			$query = "UPDATE user SET usr_nombre = '$nombre', usr_apellido = '$apellido', usr_ciudad = '$ciudad', usr_email = '$mail', usr_nacimiento = '$cumpleanios', usr_sexo = '$sex', usr_password = '$password' WHERE usr_dni = '$dni_usuario'";
			$result = mysqli_query($conexion, $query);

			$_SESSION['usuario'] = $nombre;
			$_SESSION['apellido'] = $apellido;
			$_SESSION['ciudad'] = $ciudad;
			$_SESSION['email'] = $mail;
			$_SESSION['sexo'] = $sex;

			//header('location: jugar.php');
			$url = "jugar.php";
			$mensaje = "Sus datos fueron modificados correctamente";
			echo json_encode(array('error' => false, 'url' => $url, 'mensaje' => $mensaje));
		}else{

			$query = "SELECT * FROM user WHERE usr_dni = '$dni'";
			$result = mysqli_query($conexion,$query);
			$fila = mysqli_fetch_row($result);

			if (!$fila[0]) {
				$query = "INSERT INTO user VALUES ('".$dni."','".$password."','".$nombre."','".$apellido."','".$ciudad."','".$sex."','".$cumpleanios."','".$mail."','','')";
				$result = mysqli_query ($conexion, $query);
				//header('location: index.html');
				$url = "index.html";
				$mensaje = "Usuario registrado correctamente";
				echo json_encode(array('error' => false, 'url' => $url, 'mensaje' => $mensaje));
			}else{
				$mensaje = "El nombre de usuario ya está en uso";
				echo json_encode(array('error' => true, 'mensaje' => $mensaje));
			}
		}

		
	

	
?>