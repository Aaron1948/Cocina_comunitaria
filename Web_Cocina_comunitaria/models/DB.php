<?php
    //require_once '../config/.env.php';
    require_once __DIR__ . '/../config/.env.php';
    class DB{
        public static function connect(){

            try{
                $dsn = "mysql:host=" . HOST . ";dbname=" . BBDD . ";port=" . PUERTO . ";charset=utf8mb4";
                $conexion = new PDO($dsn, USUARIO, PASSWORD);
                $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                return $conexion;
            }catch(PDOException $e){
                error_log("Error de Conexion: " . $e->getMessage());
                return false;
            }
        }
    }
?>