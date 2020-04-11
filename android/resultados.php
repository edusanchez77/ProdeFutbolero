<?php

    $db_host = "localhost";
    $db_user = "prodefut";
    $db_pass = "8C862wunTo";
    $db_base = "prodefut_Prode1";
    $pass = "";
    $json = array();

    
        $dni = $_GET["dni"];
        
        $conexion = mysqli_connect($db_host, $db_user, $db_pass, $db_base);

        $query = "SELECT res_pa_id, res_eq_local, res_eq_visitante, res_ganador FROM resultados ORDER BY res_id DESC";
        mysqli_set_charset($conexion, "utf8");
        $result = mysqli_query($conexion, $query);

        if ($result) {
            while ($reg = mysqli_fetch_array($result)) {
                $idPartido = $reg["res_pa_id"];
                
                $queryPartidos = "SELECT pa_dia, pa_eq_local, pa_eq_visitante, pa_sede, pa_nro_fecha, pa_eq_grupo FROM partidos WHERE pa_id = '{$idPartido}'";
				$resultPartidos = mysqli_query($conexion, $queryPartidos);
                if($reg1 = mysqli_fetch_array($resultPartidos)){
                    $reg["EquipoLocal"] = $reg1["pa_eq_local"];
                    $reg["EquipoVisita"] = $reg1["pa_eq_visitante"];    
                    
                }
                
                $queryPuntos = "SELECT pde_puntos FROM puntajes_detalle WHERE pde_pa_id = '{$idPartido}' and pde_usr_dni = '{$dni}'";
				$resultPuntos = mysqli_query($conexion, $queryPuntos);
				if($Puntos = mysqli_fetch_array($resultPuntos)){
                    $reg["Puntos"] = $Puntos["pde_puntos"];
                }
                
                $json['datos'][] = $reg;
            }
            mysqli_close($conexion);
            echo json_encode($json);
        }else{
            $results["Puntos"] = 'No hay partidos disputados';
            $json['datos'][] = $results;
            echo json_encode($json);
        }
   

?>