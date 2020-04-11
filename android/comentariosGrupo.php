<?php

    $db_host = "localhost";
    $db_user = "prodefut";
    $db_pass = "8C862wunTo";
    $db_base = "prodefut_Prode1";
    $pass = "";
    $json = array();

    if (isset($_GET["grupo"])){
        $idGrupo = $_GET["grupo"];
        $contador = 0;

        $conexion = mysqli_connect($db_host, $db_user, $db_pass, $db_base);

        $query = "SELECT * FROM comentarios_grupos WHERE com_gru_id = '{$idGrupo}' AND com_mostrar = 'Y' ORDER BY com_fecha DESC";
        mysqli_set_charset($conexion, "utf8");
        $result = mysqli_query($conexion, $query);

        if (isset($result)) {
            while ($grupos_miembro = mysqli_fetch_row($result)) {
                $comentarioId = $grupos_miembro[0];
                $comentarioDni = $grupos_miembro[2];
                $comentarioFecha = $grupos_miembro[3];
                $comentario = $grupos_miembro[4];
                
				$consulta_nombre_grupo = "SELECT usr_nombre, usr_apellido FROM user WHERE usr_dni = '{$comentarioDni}'";
				$resultado_nombre_grupo = mysqli_query($conexion, $consulta_nombre_grupo);
                
				while($reg = mysqli_fetch_array($resultado_nombre_grupo)){
                    $reg["idComentario"] = $comentarioId;
                    $reg["fechaComentario"] = $comentarioFecha;
                    $reg["Comentario"] = $comentario;
                    $json['datos'][] = $reg;  
                    
                    $contador++;
                }
                
            }
            mysqli_close($conexion);
            if($contador > 0){
                echo json_encode($json);
            }
        }else{
            $results["Comentario"] = "No existen comentarios";
            $json['datos'][] = $results; 
            echo json_encode($json);
        }
        if($contador == 0){
            $results["Comentario"] = "No existen comentarios";
            $json['datos'][] = $results; 
            echo json_encode($json);
        }
    }else{
        $results["Comentario"] = "No existen comentarios";
        $json['datos'][] = $results;
        echo json_encode($json);
    }

?>