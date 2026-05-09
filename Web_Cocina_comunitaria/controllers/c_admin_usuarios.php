<?php
    if(session_status() === PHP_SESSION_NONE){
        session_start();
    }

    require_once __DIR__ . '/../models/DB.php';
    require_once __DIR__ . '/../models/validaciones.php';
    require_once __DIR__ . '/../models/usuario.php';

    $conexion = DB::connect();

    if($_SERVER['REQUEST_METHOD'] === "POST"){

        $errores = array_merge(Validaciones::validarRegistro(),Validaciones::validarRol($_POST['rol']));

        if(!empty($errores)){
            $_SESSION['errores'] = $errores;
            header("Location: ../views/admin/usuarios_administracion.php");
            exit;
        }

        $nombre = trim($_POST['nombre']);
        $apellidos = trim($_POST['apellidos']);
        $email = trim($_POST['email']);
        $telefono  = trim($_POST['telefono']);
        $fechaNac = trim($_POST['fechaNac']);
        $direccion = trim($_POST['direccion']);
        $sexo = $_POST['sexo'];
        $usuario = trim($_POST['usuario']);
        $password = trim($_POST['password']);
        $rol = $_POST['rol'];

        $hash = password_hash($password, PASSWORD_BCRYPT);

        $ok = Usuario::insertarUsuario($conexion,$nombre,$apellidos,$email,$telefono,
        $fechaNac,$direccion,$sexo, $usuario,$hash,$rol);

        if($ok){
            $_SESSION['exito_registro'] = "Usuario Insertado Correctamente.";
        }else{
            $_SESSION['errores'][] = "Error al insertar al usuario.";
        }

        header("Location: ../views/admin/usuarios_administracion.php");
        exit;
    }
?>