<?php

    if(session_status() === PHP_SESSION_NONE){
        session_start();
    }

    require_once __DIR__ . '/../models/DB.php';
    require_once __DIR__ . '/../models/citas.php';
    require_once __DIR__ . '/../models/validaciones.php';

    $conexion = DB::connect();
    // Formulario para MODIFICAR las citas.
    if($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['Modificar'])){
        $errores = [];

        $idCita = (int)$_POST['idCita'];
        $fecha = filter_input(INPUT_POST, "fecha", FILTER_UNSAFE_RAW);
        $motivo = filter_input(INPUT_POST, "motivo", FILTER_SANITIZE_SPECIAL_CHARS);
        $motivo = trim(strip_tags($motivo));

        $hoy = date('Y-m-d');

        if(empty($fecha)){
            $errores[] = "La fecha no puede quedar vacia.";
        }elseif(strtotime($fecha) <= strtotime($hoy)){
            $errores[] = "La fecha no puede ser la misma o inferior a hoy.";
        }

        if(empty($motivo)){
            $errores[] = "Escribe tu motivo porfavor.";
        }

        if(!empty($errores)){
            $_SESSION['cita_error'] = implode("<br>", $errores);
            header("Location: ../views/users/editar_cita.php?idCita=$idCita");
            exit;
        }

        $stmt = $conexion->prepare("SELECT fecha_cita, motivo_cita FROM citas WHERE idCita
        = :idCita AND idUser = :idUser");
        $stmt->bindParam(":idCita", $idCita, PDO::PARAM_INT);
        $stmt->bindParam(":idUser", $_SESSION['idUser'], PDO::PARAM_INT);
        $stmt->execute();

        $citaOriginal = $stmt->fetch(PDO::FETCH_ASSOC);

        if($citaOriginal && $citaOriginal['fecha_cita'] === $fecha && $citaOriginal['motivo_cita'] === $motivo){
            $_SESSION['cita_error'] = "No se realizaron cambios en la cita.";
            header("Location: ../views/users/editar_cita.php?idCita=$idCita");
            exit;
        }

        if(Citas::modificar($conexion, $_SESSION['idUser'], $idCita, $fecha, $motivo)){
            $_SESSION['cita_success'] = "Cita Modificada correctamente.";
        }else{
            $_SESSION['cita_error'] = "Error al modificar la cita.";
        }

        header("Location: ../views/users/citaciones.php");
        exit;
    }
?>