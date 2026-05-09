<?php 
    if(session_status() === PHP_SESSION_NONE){
        session_start();
    }

    require_once __DIR__ . '/../../models/DB.php';
    require_once __DIR__ . '/../../models/noticia.php';

    $conexion = DB::connect();
    $noticiaModel = new Noticias($conexion);
    $noticias = $noticiaModel->listarNoticias(); // método que devuelve todas las noticias
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portada</title>
    <link rel="stylesheet" href="../../public/css/estilos.css">
</head>
<body class="admin_usuarios">
    <!-- HEADER -->
    <header>
        <!-- NAVBAR -->
        <nav class="navigationBar">
            <!-- Logo de la pagina -->
            <img src="../../public/images/logo/logo-transparent-png.png" class="logo" width="500" height="506" alt="logo de la pagina">
            <h1 id="titulo">Cocina Comunitaria</h1>
            <ul class="navigationBarList">
                <li><a href="../../index.php" class="enlace">Inicio</a></li>
                <li><a href="../noticias.php" class="enlace">Noticias</a></li>
                <?php if(!isset($_SESSION['is_logged_in'])):?>
                    <!-- Opciones para Visitantes -->
                    <li><a href="./views/registro.php" class="enlace">Registro</a></li>
                    <li><a href="./views/login.php" class="enlace">Login</a></li>
                    <?php endif;?>
                <?php if(isset($_SESSION['usuario']) && $_SESSION['rol'] === 'user'):?>
                    <!-- Opciones Para Usuarios -->
                    <li><a href="./views/users/perfil.php" class="enlace">Perfil</a></li>
                    <li><a href="./views/users/citaciones.php" class="enlace">Citaciones</a></li>
                <?php endif;?>
                <?php if(isset($_SESSION['usuario']) && $_SESSION['rol'] === 'admin'):?>
                    <!-- Opciones Para Administradores -->
                        <li class="adminColumn">
                            <a class="enlace" href="./usuarios_administracion.php">Usuarios Administracion</a>
                            <a class="enlace" href="./citas_administracion.php">Citas Administracion</a>
                            <a class="enlace active" href="./noticias_administracion.php">Noticias Administracion</a>
                            <a class="enlace" href="./perfil.php">Perfil</a>
                        </li>
                    <?php endif;?> 
                <?php if(isset($_SESSION['is_logged_in'])):?>
                    <!-- Cerrar Sesion Cuando Admin o User entra en la pagina -->
                    <li><a href="../logout.php" class="enlace">Cerrar Sesion</a></li>
                <?php endif;?>
            </ul>
        </nav>
    </header>
    <h1 class="titulo-seccion">Administrador De Noticias</h1>
    <p class="p_section">Desde este formulario podras crear nuevas noticias en el servidor.</p>
    <fieldset class="f_noticia">
        <form class="f_form" action="../../controllers/c_adminCrear_noticia.php" method="POST" enctype="multipart/form-data">
            <label for="texto">Titulo:</label>
            <input type="text" name="titulo" id="texto">
            <label for="imagen">Imagen:</label>
            <input type="file" name="imagen" id="imagen">
            <label for="text">Texto:</label>
            <textarea name="texto" id="text" cols="50" rows="8"></textarea>
            <label for="fecha">Fecha:</label>
            <input type="date" name="fecha" id="fecha">
            <button type="submit" name="crear">Crear Noticia</button>
        </form>
    </fieldset>
    <?php if(isset($_SESSION['login_ok'])):?>
        <p class="exito"><?= htmlspecialchars($_SESSION['login_ok']); ?></p>
        <?php unset($_SESSION['login_ok']);?>
        <?php endif;?>
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
    <h2 class="titulo-seccion">Noticias existentes</h2>
    <div class="grid-noticias">
        <?php foreach($noticias as $noticia): ?>
            <div class="card-noticia">
                <img src="../../public/images/noticias_images/<?= htmlspecialchars($noticia['imagen']); ?>" alt="Imagen noticia">
                <h3><?= htmlspecialchars($noticia['titulo']); ?></h3>
                <p><?= htmlspecialchars($noticia['texto']); ?></p>
                <p>Fecha: <?= htmlspecialchars($noticia['fecha']); ?></p>
                <p>creado por: <?= htmlspecialchars($noticia['autor']); ?></p>
                
                <div class="acciones">
                    <form action="./editar_noticia.php" method="GET" style="display:inline">
                        <input type="hidden" name="idNoticia" value="<?= $noticia['idNoticia']; ?>">
                        <button type="submit">Editar</button>
                    </form>
                    <form action="../../controllers/c_adminBorrar_noticia.php" method="POST" style="display:inline;" 
                        onsubmit="return confirm('¿Seguro que quieres borrar esta noticia?');">
                        <input type="hidden" name="idNoticia" value="<?= $noticia['idNoticia']; ?>">
                        <button type="submit" name="borrar">Borrar</button>
                    </form>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <!-- FOOTER -->
    <footer class="footer">
        <p>&copy; <?= date("Y"); ?> Cocina Comunitaria. Todos los derechos reservados.</p>
    </footer>
    <!-- Scripts -->
 
</body>
</html>