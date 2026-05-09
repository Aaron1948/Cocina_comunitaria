<?php

    if(session_status() === PHP_SESSION_NONE){
        session_start();
    }

    require_once __DIR__ . '/../models/DB.php';
    require_once __DIR__ . '/../models/noticia.php';

    $conexion = DB::connect();
    $noticiaModel = new Noticias($conexion);

    if($_SERVER['REQUEST_METHOD'] === "POST"){

        $errores = [];

        $titulo = trim(strip_tags(filter_input(INPUT_POST, "titulo", FILTER_UNSAFE_RAW)));
        $texto = trim(strip_tags(filter_input(INPUT_POST, "texto", FILTER_UNSAFE_RAW)));
        $fecha = trim(strip_tags(filter_input(INPUT_POST, "fecha", FILTER_UNSAFE_RAW)));
        $idUser = $_SESSION['idUser'] ?? null;
        $nombreImagen = null;

        if(empty($titulo)){
            $errores[] = "Tienes que escribir un titulo.";
        }
        if(empty($texto)){
            $errores[] = "Tienes que escribir un texto.";
        }
        if(empty($fecha)){
            $errores[] = "Tienes que poner una fecha.";
        }

        // Validar la imagen
        if($_FILES['imagen']['error'] === UPLOAD_ERR_OK){
            $nombreImagen = basename($_FILES['imagen']['name']);
            $rutaDestino = __DIR__ . '/../public/images/noticias_images/' . $nombreImagen;

            $tipo = mime_content_type($_FILES['imagen']['tmp_name']);
            if(!in_array($tipo, ['image/jpeg', 'image/png'])){
                $errores[] = "La imagen debe ser JPG o PNG";
            }else{
                move_uploaded_file($_FILES['imagen']['tmp_name'], $rutaDestino);
            }

        }else{
            $errores[] = "Debes subir una imagen.";
        }

        if(!empty($errores)){
            $_SESSION['noticias_error'] = implode("\n", $errores);
            header("Location: ../views/admin/noticias_administracion.php");
            exit;
        }

        $ok = $noticiaModel->crearNoticia($titulo, $nombreImagen,$texto, $fecha,$idUser);

        if($ok){
            $_SESSION['noticias_success'] = "Noticia creada correctamente.";
        }else{
            $_SESSION['noticias_error'] = "Error al crear la noticia.";
        }

        header("Location: ../views/admin/noticias_administracion.php");
        exit;
    }
?>