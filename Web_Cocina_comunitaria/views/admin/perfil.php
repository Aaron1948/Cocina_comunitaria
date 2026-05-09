<?php 
    if(session_status() === PHP_SESSION_NONE){
        session_start();
    }

    require_once __DIR__ . '/../../models/DB.php';

    $conexion = DB::connect();

        if(isset($_SESSION['rol']) && $_SESSION['rol'] === 'admin'){
        $sql = "SELECT d.nombre, d.apellidos, d.email, d.telefono, d.fecha_nacimiento, d.direccion, d.sexo, l.usuario, l.rol FROM users_data d JOIN users_login l ON d.idUser = l.idUser WHERE l.rol = 'admin'";
        $stmt = $conexion->prepare($sql);
        $stmt->execute();

        $datosAdmin = $stmt->fetch(PDO::FETCH_ASSOC);
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
                        <a class="enlace" href="./noticias_administracion.php">Noticias Administracion</a>
                        <a class="enlace active" href="./perfil.php">Perfil</a>
                    </li>
                    <?php endif;?> 
                <?php if(isset($_SESSION['is_logged_in'])):?>
                    <!-- Cerrar Sesion Cuando Admin o User entra en la pagina -->
                    <li><a href="../logout.php" class="enlace">Cerrar Sesion</a></li>
                <?php endif;?>
            </ul>
        </nav>
    </header>
    <!--  Perfil del Admin con sus datos -->
    <div class="datos_usuario">
        <h2 class="titulo-seccion">Datos Del Administrador</h2>
        <p class="p_section"><strong>Nombre:</strong><?= htmlspecialchars($datosAdmin['nombre']) ?></p>
        <p class="p_section"><strong>Apellidos:</strong><?= htmlspecialchars($datosAdmin['apellidos']) ?></p>
        <p class="p_section"><strong>Email:</strong><?= htmlspecialchars($datosAdmin['email']) ?></p>
        <p class="p_section"><strong>Telefono:</strong><?= htmlspecialchars($datosAdmin['telefono']) ?></p>
        <p class="p_section"><strong>Fecha de Nacimiento:</strong><?= htmlspecialchars($datosAdmin['fecha_nacimiento']) ?></p>
        <p class="p_section"><strong>Direccion:</strong><?= htmlspecialchars($datosAdmin['direccion']) ?></p>
        <p class="p_section"><strong>Sexo:</strong><?= htmlspecialchars($datosAdmin['sexo']) ?></p>
    </div>
    <?php if(isset($_SESSION['login_ok'])):?>
        <p class="exito"><?= htmlspecialchars($_SESSION['login_ok']); ?></p>
        <?php unset($_SESSION['login_ok']);?>
        <?php endif;?>
    <!-- FOOTER -->
        <footer class="footer">
            <p>&copy; <?= date("Y"); ?> Cocina Comunitaria. Todos los derechos reservados.</p>
        </footer>
</body>
</html>