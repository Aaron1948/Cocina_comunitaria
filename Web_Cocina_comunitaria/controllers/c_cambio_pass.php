<?php

    if(session_status() === PHP_SESSION_NONE){
        session_start();
    }

    require_once __DIR__ . '/../models/DB.php';
    require_once __DIR__ . '/../models/validaciones.php';
    require_once __DIR__ . '/../models/usuario.php';

    $conexion = DB::connect();

    if($_SERVER['REQUEST_METHOD'] === "POST"){

        $passActual = trim($_POST['actual']);
        $passNueva = trim($_POST['password']);
        $passConfirmacion = trim($_POST['confirmar']);
        $idUser = $_SESSION['idUser'];
        
        $errores = Validaciones::validarCambioPass($passActual, $passNueva, $passConfirmacion);

        if(!empty($errores)){
            $_SESSION['errores_pass'] = implode("", $errores);
            header("Location: ../views/users/perfil.php");
            exit;
        }
        
        $cambio = Usuario::cambiarPass($conexion, $idUser, $passActual, $passNueva);

        if($cambio){
            $_SESSION['contraseña_nueva'] = "La contraseña se cambio correctamente.";
        }else{
            $_SESSION['mensaje_error'] = "La contraseña no es correcta o no se pudo actualizar.";
        }

        header("Location: ../views/users/perfil.php");
        exit;
    }
?>