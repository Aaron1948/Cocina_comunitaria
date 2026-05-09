<?php

    if(session_status() === PHP_SESSION_NONE){
            session_start();
        }

        require_once __DIR__ . '/../models/DB.php';
        require_once __DIR__ . '/../models/citas.php';
        require_once __DIR__ . '/../models/validaciones.php';

        $conexion=  DB::connect();

        // Metodo para BORRAR las citas.
    if($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['borrar'])){

        if(!isset($_POST['idCita'])){
            $_SESSION['cita_error'] = "No se especificó la cita a borrar.";
            header("Location: ../views/users/citaciones.php");
            exit;
        }

        $idCita = (int)$_POST['idCita'];
        
        if(Citas::borrar($conexion, $idCita, $_SESSION['idUser'])){
            $_SESSION['cita_success'] = "Cita borrada correctamente.";
            header("Location: ../views/users/citaciones.php");
            exit;
        }else{
            $_SESSION['cita_error'] = "Error al borrar la cita.";
        }

        header("Location: ../views/users/citaciones.php");
        exit;
    }
?>