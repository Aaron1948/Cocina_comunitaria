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
                <li><a href="#" class="enlace">Noticias</a></li>
                <li><a href="./registro.php" class="enlace active">Registro</a></li>
                <li><a href="../views/login.php" class="enlace">Login</a></li>
            </ul>
        </nav>
    </header>
    <!-- Formulario de Registro -->
    <div class="registro_container">
        <h2 class="titulo-seccion">Formulario de Registro</h2>
        <fieldset class="admin_fieldset">
            <form class="form" action="../controllers/c_registro.php" method="POST">
                <input type="text" name="nombre" placeholder="Nombre"> 
                <input type="text" name="apellidos" placeholder="Apellidos">
                <input type="email" name="email" placeholder="Email">
                <input type="text" name="telefono" placeholder="Teléfono">
                <input type="date" name="fechaNac">
                <input type="text" name="direccion" placeholder="Dirección">
                <select name="sexo">
                    <option value="">-- Selecciona sexo --</option>
                    <option value="hombre">Masculino</option>
                    <option value="mujer">Femenino</option>
                    <option value="otro">Otro</option>
                </select>
                <input type="text" name="usuario" placeholder="Usuario">
                <input type="password" name="password" id="password" placeholder="Contraseña">
                <label for="mostrar">Mostrar Contraseña:</label>
                <input type="checkbox" name="mostrar" id="mostrar">
                <input type="hidden" name="rol" value="user">
                <button type="submit">Registrarse</button>
            </form>
        </fieldset>
        <p class="p_section">¿Ya tienes cuenta?, inicia sesion <a class="inicio" href="../views/login.php">aqui</a></p>
    </div>
    <div class="errores">
        <?php if(isset($_SESSION['errores'])):?>
            <ul class="error">
                <?php foreach($_SESSION['errores'] as $error):?>
                    <li><?=  htmlspecialchars($error) ?></li>
                    <?php endforeach;?>
                    <?php unset($_SESSION['errores']);?>
            </ul>
        <?php endif;?>
    </div>
    <!-- FOOTER -->
    <footer class="footer">
        <p>&copy; <?= date("Y"); ?> Cocina Comunitaria. Todos los derechos reservados.</p>
    </footer>
    <!-- Scripts -->
    <script src="../public/js/mostrar_pass.js"></script>
</body>
</html>