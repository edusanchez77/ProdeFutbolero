<?php
	require_once("conexion.inc");
	require("class.phpmailer.php");

	session_start();

	$dni = $_SESSION['dni'];
	$idgrupo = $_GET['grupo'];
	$nombreUsuario = $_SESSION['usuario'];
	$apellidoUsuario = $_SESSION['apellido'];
	$emailUsuario = $_SESSION['email'];
	
	$query_grupo = "SELECT gru_usr_dni FROM grupos WHERE gru_id = '$idgrupo'";
	$result_grupo = mysqli_query($conexion, $query_grupo);
	$propietario_grupo = mysqli_fetch_row($result_grupo);
	$prop_grupo = $propietario_grupo[0];

	$query_mail = "SELECT usr_email FROM user WHERE usr_dni = '$prop_grupo'";
	$result_mail = mysqli_query($conexion, $query_mail);
	$mail_propietario = mysqli_fetch_row($result_mail);
	$email_propietario = $mail_propietario[0];

	//echo $idgrupo." ".$dni." ".$email_propietario;
	//$amigos = "edu_sanchez77@hotmail.com";
	//echo $grupo." ".$dni." ".$amigos;

	$query = "INSERT INTO invitaciones_grupos VALUES ('','".$idgrupo."','".$dni."','".$email_propietario."','P','SOLICITUD')";
	$result = mysqli_query ($conexion, $query);

	$message  = "<html><body>";
   
		$message = "<table border='1' bordercolor='black' border-collapse:'collapse'>
			<tr>
				<td>
					<table cellspacing='0' cellpadding='10' border='0' align='center' style='max-width:650px;'>
			<tr style='background:#114C1A;'>
				<td colspan='3' align='left'><img src='http://www.prodefutbolero.com.ar/android/logo.png' width='15%'></td>
			</tr>

			<tr align='left'>
				<td style='width:10%;'></td>
				<td style='font-family: Arial;'>
					<br>Estimado/a, <br>".$nombreUsuario." ".$apellidoUsuario." ha solicitado unirse a tu grupo.<br>
				</td>
				<td style='width:10%;'></td>
			</tr>
			<tr align='left'>
				<td style='width:10%;'></td>
				<td style='font-family: Arial;'>
					<br>Ingresá a <a href='www.prodefutbolero.com.ar'>www.prodefutbolero.com.ar</a> para responder a esta solicitud.<br><br>
				</td>
				<td style='width:10%;'></td>
			</tr>
			<tr align='right' style='background:#262626;'>
				<td style='color: #1A7628; font-family: Arial; font-size:0.6em;' colspan='3'>
					contacto@prodefutbolero.com.ar<br>www.prodefutbolero.com.ar
				</td>
			</tr>
		</table>
				</td>
			</tr>
		</table>";
   
	$message .= "</body></html>";


	$mail = new PHPMailer(); 


	$mail->IsSMTP(); 
	$mail->SMTPAuth = true; // True para que verifique autentificación de la cuenta o de lo contrario False
	$mail->Username = "contacto@prodefutbolero.com.ar"; // Tu cuenta de e-mail
	$mail->Password = "29851491"; // El Password de tu casilla de correos


	$mail->Host = "localhost"; 
	$mail->From = "contacto@prodefutbolero.com.ar";//$email_usuario; 
	$mail->FromName = "Prode Futbolero";//$nombre_usuario." ".$apellido_usuario; 
	$mail->Subject = "Solicitud de unirse a tu grupo"; 
	$mail->AddAddress($email_propietario, "Prode Futbolero"); 

	$mail->WordWrap = 50; 

	$mail->Body    = $message;
 	$mail->AltBody    = $message;
	$mail->CharSet = 'UTF-8';

	//$mail->Send(); 
	$mail->Send();

	header("location: grupo.php?id=0");
?>