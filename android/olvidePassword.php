<?php

    require("class.phpmailer.php");

    $db_host = "localhost";
    $db_user = "prodefut";
    $db_pass = "8C862wunTo";
    $db_base = "prodefut_Prode1";
    $pass = "";
    $json = array();

        $conexion = mysqli_connect($db_host, $db_user, $db_pass, $db_base);
        $email_usuario = $_GET["email"];

        $query = "SELECT usr_dni, usr_nombre, usr_password FROM user WHERE usr_email = '{$email_usuario}'";
        mysqli_set_charset($conexion, "utf8");
        $result = mysqli_query($conexion, $query);

        if ($result) {
            while ($reg = mysqli_fetch_array($result)) {
                $nombre = $reg["usr_nombre"];
                $dni = $reg["usr_dni"];
                $pass = $reg["usr_password"];
                
                //Envio de mail
                $message = "<html><body><table border='1' bordercolor='black' border-collapse:'collapse'>
                        <tr>
                            <td>
                                <table cellspacing='0' cellpadding='10' border='0' align='center' style='max-width:650px;'>
                        <tr style='background:#72A26D;'>
                            <td colspan='3' align='left'><img src='http://www.prodefutbolero.com.ar/android/logo.png' width='15%'></td>
                        </tr>

                        <tr align='center'>
                            <td style='width:10%;'></td>
                            <td>
                                <br>{$nombre}, hemos recibido una solicitud para recuperar la contraseña de su cuenta en nuestro sitio.<br><br>
                                    Estos son sus datos de ingreso:
                                    <br>
                                    <b><u>DNI</u>:</b> {$dni}<br>
                                    <b><u>Password</u>:</b> {$pass}
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
                            <td style='color: #72A26D; font-family: Arial; font-size:0.6em;' colspan='3'>
                                contacto@prodefutbolero.com.ar<br>www.prodefutbolero.com.ar
                            </td>
                        </tr>
                    </table>
                            </td>
                        </tr>
                    </table></body></html>";


                $mail = new PHPMailer(); 
                $mail->IsSMTP(); 
                $mail->SMTPAuth = true; // True para que verifique autentificación de la cuenta o de lo contrario False
                $mail->Username = "contacto@prodefutbolero.com.ar"; // Tu cuenta de e-mail
                $mail->Password = "29851491"; // El Password de tu casilla de correos

                $mail->Host = "localhost"; 
                $mail->From = "contacto@prodefutbolero.com.ar"; 
                $mail->FromName = "Prode Futbolero"; 
                $mail->Subject = "Restablecer contraseña"; 
                $mail->AddAddress($email_usuario, $nombre); 

                $mail->WordWrap = 50; 

                $mail->Body    = $message;
                $mail->AltBody    = $message;
                $mail->CharSet = 'UTF-8';

                //$mail->Send(); 
                $mail->Send();
                
                //Fin de envio de mail
                
                $json['datos'][] = $reg;
            }
            mysqli_close($conexion);
            echo json_encode($json);
        }else{
            $results["nombre"] = '';
            $results["apellido"] = '';
            $results["ciudad"] = '';
            $results["puntaje"] = '';
            $json['datos'][] = $results;
            echo json_encode($json);
        }


?>