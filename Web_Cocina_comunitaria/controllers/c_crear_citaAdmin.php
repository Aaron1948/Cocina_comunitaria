<?php
    if(session_status() === PHP_SESSION_NONE){
        session_start();
    }

    require_once __DIR__ . '/../models/DB.php';
    require_once __DIR__ . '/../models/citas.php';

    $conexion = DB::connect();

    if($_SERVER['REQUEST_METHOD'] === "POST"){
        $errores = [];

        $idUser = filter_input(INPUT_POST,"idUser",FILTER_VALIDATE_INT);
        $fecha = filter_input(INPUT_POST, "fecha", FILTER_UNSAFE_RAW);
        $motivo = trim(strip_tags(filter_input(INPUT_POST,"motivo", FILTER_UNSAFE_RAW)));
        $hoy = date('Y-m-d');

        if(!$idUser){
        $errores[] = "Usuario inválido.";
        }
        
        if(empty($fecha)){
            $errores[] = "La fecha no puede quedar vacia.";
        }elseif(strtotime($fecha) <= strtotime($hoy)){
            $errores[] = "La fecha no puede ser la misma o inferior a hoy.";
        }

        if(empty($motivo)){
            $errores[] = "Escribe tu motivo porfavor.";
        }

        if(!empty($errores)){
            $_SESSION['errores'] = implode("<br>", $errores);
            header("Location: ../views/admin/citas_administracion.php?idUser=" .$idUser);
            exit;
        }

        $ok = Citas::insertar($conexion, $idUser,$fecha,$motivo);
        if($ok){
            $_SESSION['cita_success'] = "Cita Creada satisfactoriamente.";
            header("Location: ../views/admin/citas_administracion.php");
            exit;
        }else{
            $_SESSION['cita_error'] = "Error al crear la cita.";
            header("Location: ../views/admin/citas_administracion.php?idUser=" . $idUser);
            exit;
        }
    }

?>