<?php

    $db_host = "localhost";
    $db_user = "prodefut";
    $db_pass = "8C862wunTo";
    $db_base = "prodefut_Prode1";
    $pass = "";
    $json = array();

        $conexion = mysqli_connect($db_host, $db_user, $db_pass, $db_base);

        $query = "SELECT usr_nombre, usr_apellido, usr_ciudad, usr_puntaje FROM user ORDER BY usr_puntaje DESC, usr_nombre ASC";
        mysqli_set_charset($conexion, "utf8");
        $result = mysqli_query($conexion, $query);

        $posicion = 1;

        if ($result) {
            while ($reg = mysqli_fetch_array($result)) {
                $reg["posicion"] = $posicion;
                $json['datos'][] = $reg;
                $posicion++;
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