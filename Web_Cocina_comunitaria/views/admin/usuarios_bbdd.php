<?php
    if(session_status() === PHP_SESSION_NONE){
        session_start();
    }
    
    require_once __DIR__ .'/../../models/DB.php';

    $usuarios = [];

    if(isset($_SESSION['rol']) && $_SESSION['rol'] === 'admin'){
        $conexion = DB::connect();

        $sqlCheck = "SELECT d.idUser, d.nombre, d.apellidos, d.email, d.telefono, d.fecha_nacimiento,
                 d.direccion, d.sexo, l.rol 
                 FROM users_data d 
                 INNER JOIN users_login l ON d.idUser = l.idUser";
        $sqlCheck = $conexion->prepare($sqlCheck);
        $sqlCheck->execute();

        $usuarios = $sqlCheck->fetchAll(PDO::FETCH_ASSOC);
    }
?>