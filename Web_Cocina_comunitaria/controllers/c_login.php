<?php 
    // Asegurar que hay una sesion activa.
    if(session_status() === PHP_SESSION_NONE){
        session_start();
    }

    // Archivo de conexion con la base de datos
    require_once __DIR__ . '/../models/DB.php';
    require_once __DIR__ . '/../models/validaciones.php';
    require_once __DIR__ . '/../models/usuario.php';
    /*// Array de errores
    $errores = [];

    // Saneamiento de los campos
    $nombre = filter_input(INPUT_POST, "usuario", FILTER_UNSAFE_RAW);
    $nombre = trim(strip_tags($nombre));
    $password = trim(filter_input(INPUT_POST, "password", FILTER_UNSAFE_RAW));

    // Conectamos con la bbdd
    $conexion = DB::connect();

    // Validamos los input
    if(empty($nombre)){
        $errores[] = "El campo de nombre no debe estar vacio.";
    }

    if(empty($password)){
        $errores[] = "Debes introducir tu contraseña.";
    }

    if(!empty($errores)){
        $_SESSION['errores_login'] = $errores;
        header("Location: ../views/login.php");
        exit;
    }

    // Realizamos la consulta para verificar que el usuario existe a traves del correo.
    $sqlCheck = "SELECT idUser, usuario, password, rol FROM users_login WHERE usuario = :usuario";
    $sqlCheck = $conexion->prepare($sqlCheck);
    $sqlCheck->bindParam(":usuario", $nombre);
    $sqlCheck->execute();

    // Guardamos el valor en una variable.
    $usuario = $sqlCheck->fetch(PDO::FETCH_ASSOC);

    if($usuario && password_verify($password,$usuario['password'])){
        $_SESSION['login_ok'] = "Usuario Logeado Correctamente.";
        $_SESSION['idUser'] = $usuario['idUser'];
        $_SESSION['usuario'] = $usuario['usuario'];
        $_SESSION['rol'] = $usuario['rol'];
        $_SESSION['is_logged_in'] = true;
        header("Location: ../index.php");
        exit;
    }else{
        $_SESSION['errores_login'] = ["Usuario o Contraseña Incorrectos."];
        header("Location: ../views/login.php");
        exit;
    }*/
    if($_SERVER['REQUEST_METHOD'] === "POST"){

        // Primero recoge los datos por post
        $usuario = trim($_POST['usuario']);
        $password = trim($_POST['password']);

        // Valida los campos con la funcion de usuarios.
        $errores = Validaciones::validarLogin($usuario, $password);

        if(!empty($errores)){
            $_SESSION['errores_login'] = $errores;
            header("Location: ../views/login.php");
            exit;
        }

        // Si no hay errores llamamos al modelo.
        $login = Usuario::loginUsuario($conexion, $usuario, $password);

        // Si el login es correcto guardamos en sesion el usuario como el rol.
        if($login){
            $_SESSION['login_ok'] = "Usuario logeado correctamente.";
            $_SESSION['is_logged_in'] = true;
            $_SESSION['usuario'] = $login['usuario'];
            $_SESSION['idUser'] = $login['idUser'];
            $_SESSION['rol'] = $login['rol'];
            header("Location: ../index.php");
            exit;
        }else{
            $_SESSION['errores_login'] = ["Usuario o contraseña incorrectos."];
            header("Location: ../views/login.php");
            exit;
        }

    }

?>