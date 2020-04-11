<?php

require("class.phpmailer.php"); //Importamos la función PHP class.phpmailer

	/*$nombre = $_GET["nombre"];
	$apellido = $_GET["apellido"];
	$pass = $_GET["password"];
	$email = $_GET["mail"];
	$dni = $_GET["dni"];*/
	$nombre = "Eduardo";
	$email = "edu_sanchez77@hotmail.com";

	$message  = "<html><body><img src='http://www.prodefutbolero.com.ar/Images/bannerPronosticos.jpg'></body></html>";

	$mail = new PHPMailer(); 


	$mail->IsSMTP(); 
	$mail->SMTPAuth = true; // True para que verifique autentificación de la cuenta o de lo contrario False
	$mail->Username = "contacto@prodefutbolero.com.ar"; // Tu cuenta de e-mail
	$mail->Password = "29851491"; // El Password de tu casilla de correos


	$mail->Host = "localhost"; 
	$mail->From = "contacto@prodefutbolero.com.ar"; 
	$mail->FromName = "Prode Futbolero"; 
	$mail->Subject = "Cuenta Regresiva"; 
	$mail->AddAddress($email, $nombre); 

	$mail->WordWrap = 50; 

	$mail->Body    = $message;
 	$mail->AltBody    = $message;
	$mail->CharSet = 'UTF-8';

	//$mail->Send(); 
	$mail->Send();
	//echo "<meta http-equiv='refresh' content='1;url=http://www.prodefutbolero.com.ar'>";
	//header("location: http://www.prodefutbolero.com.ar");

	// Notificamos al usuario del estado del mensaje


?>