<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL); 
    
    if(session_status() === PHP_SESSION_NONE){
        session_start();
    }

    require_once 'datos_usuario.php';
    require_once __DIR__ . '/../../models/validaciones.php';

    if(!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'user'){
        header("Location: ../../index.php");
        exit;
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portada</title>
    <link rel="stylesheet" href="../../public/css/estilos.css">
</head>
<body>
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
                    <li><a href="#" class="enlace">Registro</a></li>
                    <li><a href="#" class="enlace">Login</a></li>
                    <?php endif;?>
                <?php if(isset($_SESSION['usuario']) && $_SESSION['rol'] === 'user'):?>
                    <!-- Opciones Para Usuarios -->
                    <li><a href="./perfil.php" class="enlace active">Perfil</a></li>
                    <li><a href="./citaciones.php" class="enlace">Citaciones</a></li>
                <?php endif;?> 
                <?php if(isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true):?>
                    <!-- Cerrar Sesion Cuando Admin o User entra en la pagina -->
                    <li><a href="../logout.php" class="enlace">Cerrar Sesion</a></li>
                <?php endif;?>
            </ul>
        </nav>
    </header>
    <?php if(isset($_SESSION['login_ok'])):?>
        <p class="exito"><?= htmlspecialchars($_SESSION['login_ok']); ?></p>
        <?php unset($_SESSION['login_ok']);?>
        <?php endif;?>
    <!--  Perfil del Usuario con sus datos -->
    <div class="datos_usuario">
        <h2 class="titulo-seccion">Datos Del usuario</h2>
        <p class="p_section"><strong>Nombre:</strong><?= htmlspecialchars($datosUsuario['nombre']) ?></p>
        <p class="p_section"><strong>Apellidos:</strong><?= htmlspecialchars($datosUsuario['apellidos']) ?></p>
        <p class="p_section"><strong>Email:</strong><?= htmlspecialchars($datosUsuario['email']) ?></p>
        <p class="p_section"><strong>Telefono:</strong><?= htmlspecialchars($datosUsuario['telefono']) ?></p>
        <p class="p_section"><strong>Fecha de Nacimiento:</strong><?= htmlspecialchars($datosUsuario['fecha_nacimiento']) ?></p>
        <p class="p_section"><strong>Direccion:</strong><?= htmlspecialchars($datosUsuario['direccion']) ?></p>
        <p class="p_section"><strong>Sexo:</strong><?= htmlspecialchars($datosUsuario['sexo']) ?></p>
    </div>
    <hr class="perfil">
    <div class="registro_container">
        <h3 class="titulo-seccion">CAMBIAR LA PASSWORD</h3>
        <fieldset class="citas_f">
            <form class="form" action="../../controllers/c_cambio_pass.php" method="POST">
                <label for="actual">Contraseña Actual:</label>
                <input type="password" name="actual" id="actual">
                <label for="password">Nueva Contraseña:</label>
                <input type="password" name="password" id="password">
                <label for="confirmar">Confirmar Contraseña:</label>
                <input type="password" name="confirmar" id="confirmar">
                <input type="submit" name="Actualizar" value="Actualizar">
            </form>
        </fieldset>
    </div>
    <hr class="perfil">
    <div class="mensajes_contraseña">
        <?php if(isset($_SESSION['contraseña_nueva'])):?>
            <p style="color:green"><?= htmlspecialchars($_SESSION['contraseña_nueva']); ?></p>
            <?php unset($_SESSION['contraseña_nueva']);?>
        <?php endif;?>
        <?php if(isset($_SESSION['errores_pass'])):?>
            <p style="color:red"><?= htmlspecialchars($_SESSION['errores_pass']); ?></p>
            <?php unset($_SESSION['errores_pass']);?>
            <?php endif;?>
        <?php if(isset($_SESSION['mensaje_error'])):?>
            <p style="color:red"><?= htmlspecialchars($_SESSION['mensaje_error']); ?></p>
            <?php unset($_SESSION['mensaje_error']);?>
        <?php endif;?>
    </div>
    <!-- FOOTER -->
    <footer class="footer">
        <p>&copy; <?= date("Y"); ?> Cocina Comunitaria. Todos los derechos reservados.</p>
    </footer>
    <!-- Scripts -->
</body>
</html>