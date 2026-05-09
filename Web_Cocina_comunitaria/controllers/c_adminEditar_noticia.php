<?php

    if(session_status() === PHP_SESSION_NONE){
        session_start();
    }

    require_once __DIR__ . '/../models/DB.php';
    require_once __DIR__ . '/../models/noticia.php';

    $conexion = DB::connect();
    $noticiasModel = new Noticias($conexion);

    if($_SERVER['REQUEST_METHOD'] === "POST"){

        $idNoticia = (int)$_POST['idNoticia'];
        $titulo = trim(strip_tags(filter_input(INPUT_POST, "titulo", FILTER_UNSAFE_RAW)));
        $texto = trim(strip_tags(filter_input(INPUT_POST, "texto", FILTER_UNSAFE_RAW)));
        $fecha = trim($_POST['fecha']);

        if(empty($titulo) || empty($texto) || empty($fecha)){
            $_SESSION['noticias_error'] = "Los campos no pueden quedar vacios.";
            header("Location: ../views/admin/editar_noticia.php?idNoticia=$idNoticia");
            exit;
        }

        $cambios = false;
        $noticiaActual = $noticiasModel->obtenerNoticiaPorId($idNoticia);
        $imagen = $noticiaActual['imagen'];

        if($titulo !== $noticiaActual['titulo']){
            $cambios = true;
        }

        if($texto !== $noticiaActual['texto']){
            $cambios = true;
        }

        if($fecha !== $noticiaActual['fecha']){
            $cambios = true;
        }

        if(isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK){
            $cambios = true;
            $nombreImagen = time() . "-" . basename($_FILES['imagen']['name']);
            $rutaDestino = __DIR__ . '/../public/images/noticias_images/' . $nombreImagen;
            if(move_uploaded_file($_FILES['imagen']['tmp_name'], $rutaDestino)){
                // borra la anterior si existe
                $rutaAnterior = __DIR__ . '/../public/images/noticias_images/' . $imagen;
                if($imagen && file_exists($rutaAnterior)){
                    unlink($rutaAnterior);
                }

                $imagen = $nombreImagen;
            }
        }

        if(!$cambios){
            $_SESSION['noticias_error'] = "No se ha producido cambios en la noticia.";
            header("Location: ../views/admin/editar_noticia.php?idNoticia=$idNoticia");
            exit;
        }

        // Si hay cambios entonces hacemos el update
        $ok = $noticiasModel->modificarNoticia($titulo,$imagen, $texto, $fecha, $idNoticia);
        if($ok){
            $_SESSION['noticias_success'] = "La noticia se ha modificado con exito.";
        }else{
            $_SESSION['noticias_error'] = "Error al editar la noticia.";
        }

        header("Location: ../views/admin/noticias_administracion.php");
        exit;
    }
?>