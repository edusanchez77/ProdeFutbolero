﻿<?php

require_once("conexion.inc");
//require("class.phpmailer.php"); //Importamos la función PHP class.phpmailer


	$mail = $_POST["email"];

	$query = "SELECT usr_dni, usr_nombre, usr_password FROM user WHERE usr_email = '$mail'";
	$result = mysqli_query($conexion, $query);
	$fila = mysqli_fetch_row($result);

	if (!$fila[0]) {
		echo json_encode(array('error' => true));
		//$data['existe'] = false;
		//echo "<script type=\"text/javascript\">alert(\"Fotos guardadas\");</script>";
		//echo "No se encuentra mail";
	} else{
		//$data['existe'] = true;
		echo json_encode(array('error' => false, 'dni' => $fila[0], 'nombre' => $fila[1], 'password' => $fila[2], 'email' => $mail));
	}
	
	/*$message  = "<html><body>";
   	$message = "<table border='1' bordercolor='black' border-collapse:'collapse'>
			<tr>
				<td>
					<table cellspacing='0' cellpadding='10' border='0' align='center' style='max-width:650px;'>
			<tr style='background:#114C1A;'>
				<td colspan='3' align='left'><img src='http://www.prodefutbolero.com.ar/android/logo.png' width='15%'></td>
			</tr>

			<tr align='center'>
				<td style='width:10%;'></td>
				<td>
					<br>Estimado/a, hemos recibido una solicitud para restablecer la contraseña de su cuenta en nuestro sitio.<br>
						Si realizó esta solicitud ingrese al siguiente vínculo, de lo contrario desestime este correo.<br><br><br>
						<button style='background: #114C1A; padding: 3%; border-radius:10px; color:white'>Restablecer contraseña</button><br><br>
				</td>
				<td style='width:10%;'></td>
			</tr>
			<tr align='left' style='background:#262626;'>
				<td style='color: white; font-family: Arial; font-size:0.8em;' colspan='3'>
					<br>* Si usted no solicitó el restablecimiento de cuenta por favor desestime este e-mail, el mismo puede ser eliminado. Disculpe las molestias.<br>* Por favor no reenvie este mail, el link de restablecimiento es privado.<br>* Por favor, no responda a este correo electrónico. El mismo es generado de manera automática. ¡Muchas gracias! 
				</td>
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
	$mail->From = $email; 
	$mail->FromName = "Prode Futbolero"; 
	$mail->Subject = $asunto; 
	$mail->AddAddress("contacto@prodefutbolero.com.ar","Eduardo"); 

	$mail->WordWrap = 50; 

	$mail->Body    = $message;
 	$mail->AltBody    = $message;
	$mail->CharSet = 'UTF-8';

	//$mail->Send(); 


	// Notificamos al usuario del estado del mensaje

	if(!$mail->Send()){ 
	echo "No se pudo enviar el Mensaje."; 
	}else{ 
	echo "Mensaje enviado"; 
	} */

?>