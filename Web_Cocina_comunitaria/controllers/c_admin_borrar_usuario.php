<?php 

    if(session_status() === PHP_SESSION_NONE){
    session_start();
    }

    require_once __DIR__ . '/../models/DB.php';
    require_once __DIR__ . '/../models/usuario.php';

    $conexion = DB::connect();
    
    if($_SERVER['REQUEST_METHOD'] === "POST" && isset($_POST['borrar'])){
        $idUser = (int)$_POST['idUser'];
        
        // Evitar que el admin logueado se borre a sí mismo
        if(isset($_SESSION['idUser']) && $_SESSION['idUser'] == $idUser){
            $_SESSION['errores'] = ["No puedes borrarte a ti mismo mientras estás logueado."];
            header("Location: ../views/admin/usuarios_administracion.php");
            exit;
        }

        $ok = Usuario::borrarUsuario($conexion, $idUser);

        if($ok){
            $_SESSION['exito_registro'] = "Usuario borrado correctamente.";
        }else{
            $_SESSION['errores'] = ["Error al borrar al usuario."];
        }

        header("Location: ../views/admin/usuarios_administracion.php");
        exit;
    }
?>