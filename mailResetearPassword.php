<?php

require_once("conexion.inc");
require("class.phpmailer.php"); //Importamos la función PHP class.phpmailer

	$nombre = $_GET["nombre"];
	$apellido = $_GET["apellido"];
	$pass = $_GET["password"];
	$email = $_GET["mail"];
	$dni = $_GET["dni"];

	$query = "INSERT INTO recuperar_password VALUES(sysdate(),'$dni')";
	$result = mysqli_query($conexion, $query);

	$message  = "<html><body>";
   
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
					<br>".$nombre.", hemos recibido una solicitud para recuperar la contraseña de su cuenta en nuestro sitio.<br><br>
						Estos son sus datos de ingreso:
						<br>
						<b><u>Nombre de usuario</u>:</b> ".$dni."<br>
						<b><u>Password</u>:</b> ".$pass."
						<br><br>
				</td>
				<td style='width:10%;'></td>
			</tr>
			<tr align='left' style='background:#262626;'>
				<td style='color: white; font-family: Arial; font-size:0.8em;' colspan='3'>
					<br>* Si usted no solicitó el restablecimiento de contraseña, por favor desestime este e-mail. Disculpe las molestias.<br>* No reenvíe este mail, el link de restablecimiento es privado.<br>* No responda a este correo electrónico. Éste es generado de manera automática. ¡Muchas gracias! 
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
	$mail->From = "contacto@prodefutbolero.com.ar"; 
	$mail->FromName = "Prode Futbolero"; 
	$mail->Subject = "Restablecer contraseña"; 
	$mail->AddAddress($email, $nombre); 

	$mail->WordWrap = 50; 

	$mail->Body    = $message;
 	$mail->AltBody    = $message;
	$mail->CharSet = 'UTF-8';

	//$mail->Send(); 
	$mail->Send();
	echo "<meta http-equiv='refresh' content='1;url=http://www.prodefutbolero.com.ar'>";
	//header("location: http://www.prodefutbolero.com.ar");

	// Notificamos al usuario del estado del mensaje


?>