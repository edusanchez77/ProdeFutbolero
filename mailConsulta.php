<?php
	require_once("conexion.inc");
	require("class.phpmailer.php"); //Importamos la función PHP class.phpmailer
	session_start();

	$dni_usuario = $_SESSION['dni'];
	$nombre_usuario = $_SESSION['usuario'];
	$apellido_usuario = $_SESSION['apellido'];
	$ciudad_usuario = $_SESSION['ciudad'];
	$email_usuario = $_SESSION['email'];

	$asunto = $_POST['asunto'];
	$consulta = $_POST['consulta'];


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
				<td>
					<br>".$nombre_usuario." ha realizado la siguiente consulta.<br>
				</td>
				<td style='width:10%;'></td>
			</tr>
			<tr align='left'>
				<td style='width:10%;'></td>
				<td>
					<br><b><u>Asunto</u>: </b>".$asunto.".<br>
						<b><u>Consulta</u>: </b>".$consulta."<br><br><br>
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
	$mail->From = $email_usuario; 
	$mail->FromName = $nombre_usuario." ".$apellido_usuario; 
	$mail->Subject = "Consulta vía web"; 
	$mail->AddAddress("contacto@prodefutbolero.com.ar", "Prode Futbolero"); 

	$mail->WordWrap = 50; 

	$mail->Body    = $message;
 	$mail->AltBody    = $message;
	$mail->CharSet = 'UTF-8';

	//$mail->Send(); 
	$mail->Send();

	echo "<meta http-equiv='refresh' content='1;url=http://www.prodefutbolero.com.ar/contacto.php'>";
	//header("location: http://www.prodefutbolero.com.ar");

	// Notificamos al usuario del estado del mensaje


?>