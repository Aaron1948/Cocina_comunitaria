<?php 
    if(session_status() === PHP_SESSION_NONE){
        session_start();
    }

    require_once __DIR__ . '/../models/DB.php';
    $conexion = DB::connect();
    $stmt = $conexion->prepare("SELECT 
    n.idNoticia, 
    n.titulo, 
    n.imagen, 
    n.texto, 
    n.fecha, 
    d.nombre AS nombre
    FROM noticias n
    JOIN users_data d ON n.idUser = d.idUser
    ORDER BY n.fecha DESC
    ");
    $stmt->execute();
    $noticias = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portada</title>
    <link rel="stylesheet" href="../public/css/estilos.css">
</head>
<body>
    <!-- HEADER -->
    <header>
        <!-- NAVBAR -->
        <nav class="navigationBar">
            <!-- Logo de la pagina -->
            <img src="../public/images/logo/logo-transparent-png.png" class="logo" width="500" height="506" alt="logo de la pagina">
            <h1 id="titulo">Cocina Comunitaria</h1>
            <ul class="navigationBarList">
                <li><a href="../index.php" class="enlace">Inicio</a></li>
                <li><a href="../views/noticias.php" class="enlace active">Noticias</a></li>
                <?php if(!isset($_SESSION['is_logged_in'])):?>
                    <!-- Opciones para Visitantes -->
                    <li><a href="./registro.php" class="enlace">Registro</a></li>
                    <li><a href="./login.php" class="enlace">Login</a></li>
                    <?php endif;?>
                <?php if(isset($_SESSION['usuario']) && $_SESSION['rol'] === 'user'):?>
                    <!-- Opciones Para Usuarios -->
                    <li><a href="../views/users/perfil.php" class="enlace">Perfil</a></li>
                    <li><a href="../views/users/citaciones.php" class="enlace">Citaciones</a></li>
                <?php endif;?>
                <?php if(isset($_SESSION['usuario']) && $_SESSION['rol'] === 'admin'):?>
                    <!-- Opciones Para Administradores -->
                    <li class="adminColumn">
                        <a href="./admin/usuarios_administracion.php" class="enlace">Usuarios Administración</a>
                        <a href="./admin/citas_administracion.php" class="enlace">Citas Administración</a>
                        <a href="./admin/noticias_administracion.php" class="enlace">Noticias Administración</a>
                        <a href="./admin/perfil.php" class="enlace">Perfil</a>
                    </li>
                    <?php endif;?> 
                <?php if(isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true):?>
                    <!-- Cerrar Sesion Cuando Admin o User entra en la pagina -->
                    <li><a href="./logout.php" class="enlace">Cerrar Sesion</a></li>
                <?php endif;?>
            </ul>
        </nav>
    </header>
    <!-- NOTICIAS -->
    <h2 class="titulo-seccion">Noticias</h2>
    <p class="p_section">Aqui podras encontrar todas las noticias y eventos de la web.</p>
    <div class="noticias">
        <?php foreach ($noticias as $noticia):?>
            <div class="noticia">
                <h2 class="titulo-seccion"><?= htmlspecialchars($noticia['titulo']) ?></h2>
                <p>Fecha:<em><?=  $noticia['fecha'] ?></em></p>
                <img src="../public/images/noticias_images/<?= htmlspecialchars($noticia['imagen']) ?>" 
                     alt="Imagen noticia"
                     class="noticia-img"
                     data-titulo="<?= htmlspecialchars($noticia['titulo']) ?>"
                     data-texto="<?= htmlspecialchars($noticia['texto']) ?>"
                     data-fecha="<?= htmlspecialchars($noticia['fecha']) ?>"
                     data-autor="<?= htmlspecialchars($noticia['nombre']) ?>">
                <p><?= htmlspecialchars($noticia['texto']) ?></p>
                <p>Por:<?= htmlspecialchars($noticia['nombre']) ?></p>
            </div>
        <?php endforeach;?>
    </div>
    <?php if(isset($_SESSION['login_ok'])):?>
        <p class="exito"><?= htmlspecialchars($_SESSION['login_ok']); ?></p>
        <?php unset($_SESSION['login_ok']);?>
        <?php endif;?>
    <!-- LIGHTBOX -->
    <div id="lightbox" class="lightbox">
        <div class="lightbox-content">
            <span class="close">&times;</span>
            <img id="lightbox-img" src="" alt="Imagen ampliada">
            <h3 id="lightbox-titulo"></h3>
            <p id="lightbox-texto"></p>
            <p><small id="lightbox-fecha"></small></p>
            <p><em id="lightbox-autor"></em></p>
        </div>
    </div>
    <!-- FOOTER -->
    <footer class="footer">
        <p>&copy; <?= date("Y"); ?> Cocina Comunitaria. Todos los derechos reservados.</p>
    </footer>
    <!-- Scripts -->
    <script src="./../public/js/titulo.js"></script>
    <script src="./../public/js/modal_oculto.js" defer></script>
</body>
</html>