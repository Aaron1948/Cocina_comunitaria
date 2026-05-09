<?php
    require_once __DIR__ . '/../models/DB.php';

    class Citas{
        public static function insertar($conexion, $idUser, $fecha, $motivo){
        $sql = "INSERT INTO citas (idUser, fecha_cita, motivo_cita) VALUES (:idUser, :fecha_cita, :motivo_cita)";
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(":idUser", $idUser, PDO::PARAM_INT);
        $stmt->bindParam(":fecha_cita", $fecha);
        $stmt->bindParam(":motivo_cita", $motivo);
        return $stmt->execute();
    }

    public static function modificar($conexion, $idUser, $idCita, $fecha, $motivo){
        $sql = "UPDATE citas SET fecha_cita = :fecha, motivo_cita = :motivo WHERE idCita = :idCita AND idUser = :idUser";
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(":idUser", $idUser, PDO::PARAM_INT);
        $stmt->bindParam(":idCita", $idCita, PDO::PARAM_INT);
        $stmt->bindParam(":fecha", $fecha);
        $stmt->bindParam(":motivo", $motivo);
        return $stmt->execute();
    }   

    public static function borrar($conexion, $idCita, $idUser){
        $sql = "DELETE FROM citas WHERE idCita = :idCita AND idUser = :idUser";
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(":idCita", $idCita, PDO::PARAM_INT);
        $stmt->bindParam(":idUser", $idUser, PDO::PARAM_INT);
        if($stmt->execute()){
            return $stmt->rowCount() > 0;
        }
        return false;
    }

        
}
?>