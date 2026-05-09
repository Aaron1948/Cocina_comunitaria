<?php
    if(session_status() === PHP_SESSION_NONE){
        session_start();
    }

    require_once __DIR__ . '/../../models/DB.php';
    require_once __DIR__ . '/../../models/noticia.php';

    $conexion = DB::connect();
    $noticiasModel = new Noticias($conexion);

    if(isset($_GET['idNoticia'])){
        $idNoticia = $_GET['idNoticia'];
        $noticia = $noticiasModel->obtenerNoticiaPorId($idNoticia);
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Noticia</title>
    <link rel="stylesheet" href="../../public/css/estilos.css">
</head>
<body class="editar-body">
    <div class="noticias_feedback">
        <?php if(isset($_SESSION['noticias_success'])): ?>
            <p class="exito"><?= htmlspecialchars($_SESSION['noticias_success']); ?></p>
            <?php unset($_SESSION['noticias_success']); ?>
        <?php endif; ?>

        <?php if(isset($_SESSION['noticias_error'])): ?>
            <p class="error"><?= nl2br(htmlspecialchars($_SESSION['noticias_error'])); ?></p>
            <?php unset($_SESSION['noticias_error']); ?>
        <?php endif; ?>
    </div>
    <h1 class="titulo2">Editar Noticia</h1>
    <fieldset class="f_noticia">
        <form class="f_form" action="../../controllers/c_adminEditar_noticia.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="idNoticia" value="<?= htmlspecialchars($noticia['idNoticia']); ?>">
            <label for="texto">Titulo:</label>
            <input type="text" name="titulo" id="texto" value="<?=  htmlspecialchars($noticia['titulo']); ?>">
            <label for="imagen">Imagen:</label>
            <input type="file" name="imagen" id="imagen">
            <label for="text">Texto:</label>
            <textarea name="texto" id="text" cols="50" rows="8"><?= htmlspecialchars($noticia['texto']); ?></textarea>
            <label for="fecha">Fecha:</label>
            <input type="date" name="fecha" id="fecha" value="<?= htmlspecialchars($noticia['fecha']); ?>">
            <button type="submit" name="editar">Guardar Cambios</button>
            <a class="a_citaciones" href="./noticias_administracion.php">Volver</a>
        </form>
    </fieldset>
    <canvas id="bgCanvas"></canvas>
    <script src="../../public/js/editar_cita.js"></script>
</body>
</html>