<?php

    $db_host = "localhost";
    $db_user = "prodefut";
    $db_pass = "8C862wunTo";
    $db_base = "prodefut_Prode1";
    $pass = "";
    $json = array();

    if (isset($_GET["grupo"])){
        $grupo = $_GET["grupo"];
        $dni = $_GET["dni"];
        
        $conexion = mysqli_connect($db_host, $db_user, $db_pass, $db_base);

        $query = "SELECT pa_dia, pa_eq_local, pa_eq_visitante, pa_sede, pa_id, pa_eq_grupo, CONCAT('R.drawable.', lower(pa_eq_local)) as pa_imagenlocal FROM partidos WHERE pa_eq_grupo = '{$grupo}'";
        mysqli_set_charset($conexion, "utf8");
        $result = mysqli_query($conexion, $query);

        if ($result) {
            while ($reg = mysqli_fetch_array($result)) {
                $idPartido = $reg["pa_id"];
                $query1 = "SELECT pro_local, pro_visitante, pro_pa_id FROM pronosticos WHERE pro_usr_dni = '$dni' and pro_pa_id = '$idPartido'";
                $result1 = mysqli_query ($conexion, $query1);
                
                if($reg1 = mysqli_fetch_array($result1)){
                    $reg["PronosticoLocal"] = $reg1["pro_local"];
                    $reg["PronosticoVisita"] = $reg1["pro_visitante"];    
                }
                
                $json['datos'][] = $reg;
            }
            mysqli_close($conexion);
            echo json_encode($json);
        }else{
            $results["id"] = '';
            $results["dia"] = '';
            $results["local"] = '';
            $results["visitante"] = '';
            $results["sede"] = '';
            $json['datos'][] = $results;
            echo json_encode($json);
        }
    }else{
        $results["id"] = '';
        $results["dia"] = '';
        $results["local"] = '';
        $results["visitante"] = '';
        $results["sede"] = '';
        $json['datos'][] = $results;
        echo json_encode($json);
    }

?>