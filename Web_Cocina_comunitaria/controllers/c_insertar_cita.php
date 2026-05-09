<?php

    if(session_status() === PHP_SESSION_NONE){
        session_start();
    }

    require_once __DIR__ . '/../models/DB.php';
    require_once __DIR__ . '/../models/citas.php';
    require_once __DIR__ . '/../models/validaciones.php';

    $conexion = DB::connect();
    // Variable de errores.
    
    // Validaciones y saneamiento
    if($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['Insertar'])){

        $errores = [];
        
        $fecha = filter_input(INPUT_POST, "fecha", FILTER_UNSAFE_RAW);
        $motivo = filter_input(INPUT_POST, "motivo", FILTER_SANITIZE_SPECIAL_CHARS);
        $motivo = trim(strip_tags($motivo));

        // Validacion de Fecha.
        $hoy = date('Y-m-d');

        if(empty($fecha)){
            $errores[] = "La fecha no puede quedar vacia.";
        }elseif(strtotime($fecha) <= strtotime($hoy)){
            $errores[] = "La fecha no puede ser la misma o inferior a hoy.";
        }

        if(empty($motivo)){
            $errores[] = "Por favor escribe tu motivo.";
        }

        // Si hay errores redirigimos.
        if(!empty($errores)){
            $_SESSION['cita_error'] = implode("<br>", $errores);
            header("Location: ../views/users/citaciones.php");
            exit;
        }

        // Llamamos al metodo insert
        if(Citas::insertar($conexion, $_SESSION['idUser'], $fecha, $motivo)){
            $_SESSION['cita_success'] = "Cita Insertada Correctamente.";
        }else{
            $_SESSION['cita_error'] = "Error al insertar la cita.";
        }

        header("Location: ../views/users/citaciones.php");
        exit;
    }

?>