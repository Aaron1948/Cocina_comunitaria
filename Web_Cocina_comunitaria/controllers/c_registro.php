<?php
    session_start();

    require_once __DIR__ . '/../models/DB.php';
    require_once __DIR__ . '/../models/usuario.php';
    require_once __DIR__ . '/../models/validaciones.php';
    
    // Conexion BDD
    $conexion = DB::connect();

    if($_SERVER['REQUEST_METHOD'] === "POST"){

        // Ejecutar Validaciones.
        $errores = Validaciones::validarRegistro();

        if(!empty($errores)){
        $_SESSION['errores'] = $errores;
        header("Location: ../views/registro.php");
        exit;
    }
        // Recoger datos ya saneados
        $nombre     = trim($_POST['nombre']);
        $apellidos  = trim($_POST['apellidos']);
        $email      = trim($_POST['email']);
        $telefono   = trim($_POST['telefono']);
        $fechaNac   = trim($_POST['fechaNac']);
        $direccion  = trim($_POST['direccion']);
        $sexo       = trim($_POST['sexo']);
        $usuario    = trim($_POST['usuario']);
        $password   = $_POST['password'];

        // Hashear contraseña
        $hash = password_hash($password, PASSWORD_BCRYPT);

        // Insertar en BD usando el modelo
        $ok = Usuario::insertarUsuario(
        $conexion,
        $nombre, $apellidos, $email, $telefono,
        $fechaNac, $direccion, $sexo,
        $usuario, $hash,
        'user');

        if($ok){
            $_SESSION['exito_registro'] = "Registro Completado. Ahora puedes iniciar sesion.";
            header("Location: ../views/login.php");
            exit;
        }else{
            //if(empty($_SESSION['errores']) || !is_array($_SESSION['errores'])){
            //    $_SESSION['errores'] = [];
            //}
            //$_SESSION['errores'][] = "No se pudo completar el registro.";
            header("Location: ../views/registro.php");
            exit;
        }
    }
    
?>