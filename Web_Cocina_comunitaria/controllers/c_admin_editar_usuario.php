<?php

    if(session_status() === PHP_SESSION_NONE){
        session_start();
    }

    require_once __DIR__ . '/../models/DB.php';
    require_once __DIR__ . '/../models/validaciones.php';
    require_once __DIR__ . '/../models/usuario.php';

    $conexion = DB::connect();

    if($_SERVER['REQUEST_METHOD'] === "POST"){
        
        // Definir idUser al inicio
        $idUser = (int)$_POST['idUser'];
        $errores = Validaciones::adminUserValidacion();

        if(!empty($errores)){
            $_SESSION['errores'] = $errores;
            header("Location: ../views/admin/editar_usuario.php?idUser=" . $idUser);
            exit;
        }

        $nombre = trim($_POST['nombre']);
        $apellidos = trim($_POST['apellidos']);
        $email = trim($_POST['email']);
        $telefono = trim($_POST['telefono']);
        $fechaNac = trim($_POST['fechaNac']);
        $direccion = trim($_POST['direccion']);
        $sexo = $_POST['sexo'];

        $idUser = (int)$_POST['idUser'];
        $rol = $_POST['rol'];

        $usuarioActual = Usuario::obtenerUsuarioPorId($conexion, $idUser);
        $sinCambios = (
            $usuarioActual['nombre'] === $nombre &&
            $usuarioActual['apellidos'] === $apellidos &&
            $usuarioActual['email'] === $email &&
            $usuarioActual['telefono'] === $telefono &&
            $usuarioActual['fecha_nacimiento'] === $fechaNac &&
            $usuarioActual['direccion'] === $direccion &&
            $usuarioActual['sexo'] === $sexo
        );

        if($sinCambios){
            $_SESSION['info'] = "No se han aplicado cambios.";
            header("Location: ../views/admin/editar_usuario.php?idUser=" . $idUser);
            exit;
        }

        $ok = Usuario::actualizarUsuario($conexion,$idUser,$nombre,$apellidos,$email,$telefono,$fechaNac,
        $direccion,$sexo,$rol);

        if($ok){
            $_SESSION['exito_registro'] = "Usuario Modificado Correctamente.";
            header("Location: ../views/admin/usuarios_administracion.php");
            exit;
        }else{
            $_SESSION['errores'] = ["Error al modificar al usuario"];
            header("Location: ../views/admin/editar_usuario.php?idUser=".$idUser);
            exit;
        }
    }
?>