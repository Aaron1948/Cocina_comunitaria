<?php
    require_once __DIR__ . '/../../models/DB.php';

    if(isset($_SESSION['idUser'])){

        $conexion = DB::connect();
        $idUser = $_SESSION['idUser'];

        $sqlCheck = "SELECT nombre, apellidos, email, telefono, fecha_nacimiento, 
        direccion, sexo FROM users_data WHERE idUser = :idUser";
        $stmtCheck = $conexion->prepare($sqlCheck);
        $stmtCheck->bindParam(":idUser", $idUser, PDO::PARAM_INT);
        $stmtCheck->execute();

        $datosUsuario = $stmtCheck->fetch(PDO::FETCH_ASSOC);
    }   
    


?>