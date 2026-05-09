<?php
    if(session_status() === PHP_SESSION_NONE){
        session_start();
    }
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
                <li><a href="./noticias.php" class="enlace">Noticias</a></li>
                <li><a href="./registro.php" class="enlace">Registro</a></li>
                <li><a href="./login.php" class="enlace active">Login</a></li>
                <?php if(isset($_SESSION['idUser'])):?>
                    <li><a href="#" class="enlace">Perfil</a></li>
                    <li><a href="#" class="enlace">Citaciones</a></li>
                <?php endif;?>
            </ul>
        </nav>
    </header>

    <div class="registro_container">
        <h2 class="titulo-seccion">Ingresa en la Web</h2>
        <fieldset class="admin_fieldset">
            <form class="form" action="../controllers/c_login.php" method="POST">
                <label for="usuario">Usuario:</label>
                <input type="text" name="usuario" id="usuario">
                <label for="password">Contraseña:</label>
                <input type="password" name="password" id="password">
                <input type="submit" value="Enviar">
            </form>
        </fieldset>
        <p class="p_section">¿Necesitas Registrarte?, pulsa...<a href="../views/registro.php">aqui</a></p>
    </div>
    <!-- Mensaje de éxito tras registro -->
    <div class="mensajes">
        <?php if(isset($_SESSION['exito_registro'])): ?>
            <p class="exito"><?= htmlspecialchars($_SESSION['exito_registro']) ?></p>
            <?php unset($_SESSION['exito_registro']); ?>
        <?php endif; ?>
    </div>
    <div class="login_ok">
        <?php if(isset($_SESSION['login_ok'])):?>
            <?= $_SESSION['login_ok'];?>
            <?php unset($_SESSION['login_ok']);?>
        <?php endif;?>
    </div>
    <div class="errores">
        <?php if(isset($_SESSION['errores_login'])):?>
            <ul class="error">
                <?php foreach($_SESSION['errores_login'] as $error):?>
                    <li><?=  htmlspecialchars($error) ?></li>
                    <?php endforeach;?>
                    <?php unset($_SESSION['errores_login']);?>
            </ul>
        <?php endif;?>
    </div>
    <!-- FOOTER -->
    <footer class="footer">
        <p>&copy; <?= date("Y"); ?> Cocina Comunitaria. Todos los derechos reservados.</p>
    </footer>
    <!-- Scripts -->
</body>
</html>