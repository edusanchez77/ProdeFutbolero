<?php

    $db_host = "localhost";
    $db_user = "prodefut";
    $db_pass = "8C862wunTo";
    $db_base = "prodefut_Prode1";
    $pass = "";
    $json = array();

        $conexion = mysqli_connect($db_host, $db_user, $db_pass, $db_base);
        $email_usuario = $_GET["email"];

        $query = "SELECT inv_id_grupo, inv_usr_dni, inv_tipo, inv_id FROM invitaciones_grupos WHERE inv_email = '{$email_usuario}' AND inv_status = 'P'";
        mysqli_set_charset($conexion, "utf8");
        $result = mysqli_query($conexion, $query);

        if ($result) {
            while ($reg = mysqli_fetch_array($result)) {
                $dni_invita = $reg["inv_usr_dni"];
                $grupo_invita = $reg["inv_id_grupo"];
				$tipo_solicitud = $reg["inv_tipo"];
				$id_invitacion = $reg["inv_id"];

				if ($tipo_solicitud == "INVITACION") {
					$mensaje = "Te está invitando a unirte al grupo ";
				}
				elseif ($tipo_solicitud == "SOLICITUD") {
					$mensaje = "Está solicitando unirse al grupo ";
				}
									
				$consulta_usuario = "SELECT usr_nombre, usr_apellido FROM user WHERE usr_dni = '$dni_invita'";
				$resultado_usuario = mysqli_query($conexion, $consulta_usuario);
				$nombre_usuario = mysqli_fetch_row($resultado_usuario);
				$usuario_invita = $nombre_usuario[0]." ".$nombre_usuario[1];

				$consulta_grupo = "SELECT gru_nombre FROM grupos WHERE gru_id = '$grupo_invita'";
				$resultado_grupo = mysqli_query($conexion, $consulta_grupo);
				$grupo_invitacion = mysqli_fetch_row($resultado_grupo);
                
                
                
                $reg["usuarioInvita"] = $usuario_invita;
                $reg["mensaje"] = $mensaje;
                $reg["grupo"] = $grupo_invitacion[0];
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