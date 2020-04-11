<?php
	require_once("conexion.inc");
	require("class.phpmailer.php");

	session_start();

	$dni = $_SESSION['dni'];
	$nombreUsuario = $_SESSION['usuario'];
	$apellidoUsuario = $_SESSION['apellido'];
	$id_grupos = $_POST['grupo'];
	$nombre = $_POST['nombre'];
	$premio = $_POST['premio'];
	$amigos = $_POST['amigos'];
	$emails = explode(",", $amigos);
	$cantidad = count($emails);
	//echo $dni." ".$nombre." ".$premio." ".$amigos;

	$query = "UPDATE grupos SET gru_nombre = '$nombre', gru_premio = '$premio' WHERE gru_id = '$id_grupos'";
	$result = mysqli_query ($conexion, $query);
	
    if($amigos != "") {
	   for($i=0; $i<$cantidad; $i++){
		$query = "INSERT INTO invitaciones_grupos VALUES ('','".$id_grupos."','".$dni."','".$emails[$i]."','P','INVITACION')";
		$result = mysqli_query ($conexion, $query);

		//mail($emails[$i], "Invitación a Grupo", "Te han invitado a unirte al grupo");
		//echo $emails[$i];

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
					<br>Estimado/a, <br>".$nombreUsuario." ".$apellidoUsuario." te ha invitado a unirte a su grupo.<br>
				</td>
				<td style='width:10%;'></td>
			</tr>
			<tr align='left'>
				<td style='width:10%;'></td>
				<td style='font-family: Arial;'>
					<br>Ingresá a <a href='www.prodefutbolero.com.ar'>www.prodefutbolero.com.ar</a>, registrate y demostrale que sabes más que todos sobre fútbol.<br><br>
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
        $mail->Subject = "Invitación a unirte"; 
        $mail->AddAddress($emails[$i], "Prode Futbolero"); 

        $mail->WordWrap = 50; 

        $mail->Body    = $message;
        $mail->AltBody    = $message;
        $mail->CharSet = 'UTF-8';

        //$mail->Send(); 
        $mail->Send();

        }
    }


	echo "<meta http-equiv='refresh' content='1;url=http://www.prodefutbolero.com.ar/grupo.php?id=$id_grupos'>";
	//header('location: grupo.php?id=0');
?>