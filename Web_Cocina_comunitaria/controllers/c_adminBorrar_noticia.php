<?php
    if(session_status() === PHP_SESSION_NONE){
        session_start();
    }

    require_once __DIR__ . '/../models/DB.php';
    require_once __DIR__ . '/../models/noticia.php';

    $conexion = DB::connect();

    $noticiaModel = new Noticias($conexion);

    if($_SERVER['REQUEST_METHOD'] === "POST"){

        $idNoticia = $_POST['idNoticia'];

        // Obtener la imagen antes de borrar
        $sqlSelect = "SELECT imagen FROM noticias WHERE idNoticia = :idNoticia";
        $stmtSelect = $conexion->prepare($sqlSelect);
        $stmtSelect->bindParam(":idNoticia", $idNoticia, PDO::PARAM_INT);
        $stmtSelect->execute();
        $imagen = $stmtSelect->fetchColumn();

        $ok = $noticiaModel->borrarNoticia($idNoticia);

        // Si se borro, borramos tambien la imagen.
        if($ok && $imagen){
            $rutaImagen = __DIR__ . '/../public/images/noticias_images/' . $imagen;
            if(file_exists($rutaImagen)){
                unlink($rutaImagen);
            }

            $_SESSION['noticias_success'] = "Noticia Borrada Correctamente.";
        }else{
            $_SESSION['noticias_error'] = "Error al borrar la noticia.";
        }

        header("Location: ../views/admin/noticias_administracion.php");
        exit;


    }
?>