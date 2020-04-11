<?php

    $db_host = "localhost";
    $db_user = "prodefut";
    $db_pass = "8C862wunTo";
    $db_base = "prodefut_Prode1";
    $pass = "";
    $json = array();

    if (isset($_GET["dni"])){
        $dni = $_GET["dni"];

        $conexion = mysqli_connect($db_host, $db_user, $db_pass, $db_base);

        $query = "SELECT gmi_gru_id FROM grupos_miembros WHERE gmi_usr_dni = {$dni}";
        mysqli_set_charset($conexion, "utf8");
        $result = mysqli_query($conexion, $query);

        if ($result) {
            while ($grupos_miembro = mysqli_fetch_row($result)) {
                $miembro_grupo_id = $grupos_miembro[0];
				$consulta_nombre_grupo = "SELECT gru_id, gru_usr_dni, gru_nombre, gru_premio FROM grupos WHERE gru_id = '$miembro_grupo_id'";
				$resultado_nombre_grupo = mysqli_query($conexion, $consulta_nombre_grupo);
                
				while($reg = mysqli_fetch_array($resultado_nombre_grupo)){
                    $json['datos'][] = $reg;    
                }
                
            }
            mysqli_close($conexion);
            echo json_encode($json);
        }else{
            $results["id"] = '';
            $results["grupo"] = '';
            $json['datos'][] = $results;
            echo json_encode($json);
        }
    }else{
        $results["id"] = '';
        $results["grupo"] = '';
        $json['datos'][] = $results;
        echo json_encode($json);
    }

?>