<?php

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL); 

    if(session_status() === PHP_SESSION_NONE){
        session_start();
    }
    if(empty($_SESSION['rol']) || $_SESSION['rol'] !== 'admin'){
    echo "Acceso denegado: no eres admin o la sesión está rota.";
    exit;
    }
    /*if(!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'admin'){
        header("Location: ../../index.php");
        exit;
    }*/

    require_once __DIR__ .'/usuarios_bbdd.php';
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
                        <a class="enlace active" href="./usuarios_administracion.php">Usuarios Administracion</a>
                        <a class="enlace" href="./citas_administracion.php">Citas Administracion</a>
                        <a class="enlace" href="./noticias_administracion.php">Noticias Administracion</a>
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
    <!-- Formulario Creacion de Usuario -->
    <div class="admin_container_form">
        <h2 class="h_usersAdmin">Crear Usuario y Rol</h2>
        <fieldset class="admin_fieldset">
            <form class="admin_form" action="../../controllers/c_admin_usuarios.php" method="POST">
                <label for="nombre">Nombre:</label>
                <input type="text" name="nombre" id="nombre">
                <label for="apellidos">Apellidos:</label>
                <input type="text" name="apellidos" id="apellidos">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email">
                <label for="telefono">Telefono:</label>
                <input type="text" name="telefono" id="telefono">
                <label for="fechaNac">Fecha Nacimiento:</label>
                <input type="date" name="fechaNac" id="fechaNac">
                <label for="direccion">Direccion:</label>
                <input type="text" name="direccion" id="direccion">
                <select name="sexo">
                    <option value="">-- Selecciona sexo --</option>
                    <option value="hombre">Masculino</option>
                    <option value="mujer">Femenino</option>
                    <option value="otro">Otro</option>
                </select>
                <label for="usuario">Usuario:</label>
                <input type="text" name="usuario" id="usuario">
                <label for="password">Password:</label>
                <input type="password" name="password" id="password">
                <label for="rol">Rol:</label>
                <select name="rol">
                    <option value="">-- Selecciona el Rol --</option>
                    <option value="user">User</option>
                    <option value="admin">Admin</option>
                </select>
                <button type="submit">Crear Usuario</button>
            </form>
        </fieldset>
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
    <div class="exito">
        <?php if(isset($_SESSION['exito_registro'])):?>
            <p class="usuario_nuevo"><?=  htmlspecialchars($_SESSION['exito_registro']); ?></p>
            <?php unset($_SESSION['exito_registro']);?>
        <?php endif;?>
    </div>
    <!-- Listado de la BBDD -->
    <div class="usuarios_bbdd">
        <h2 class="h_usersAdmin">Usuarios de la Base de Datos</h2>
        <?php if(!empty($usuarios)):?>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Apellidos</th>
                        <th>Email</th>
                        <th>Telefono</th>
                        <th>Fecha Nacimiento</th>
                        <th>Direccion</th>
                        <th>Sexo</th>
                        <th>Rol</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($usuarios as $usuario):?>
                        <tr>
                            <td><?= htmlspecialchars($usuario['idUser']) ?></td>
                            <td><?= htmlspecialchars($usuario['nombre']) ?></td>
                            <td><?= htmlspecialchars($usuario['apellidos']) ?></td>
                            <td><?= htmlspecialchars($usuario['email']) ?></td>
                            <td><?= htmlspecialchars($usuario['telefono']) ?></td>
                            <td><?= htmlspecialchars($usuario['fecha_nacimiento']) ?></td>
                            <td><?= htmlspecialchars($usuario['direccion']) ?></td>
                            <td><?= htmlspecialchars($usuario['sexo']) ?></td>
                            <td><?= htmlspecialchars($usuario['rol']) ?></td>
                            <td>
                        <!-- Boton Editar -->    
                            <form action="./editar_usuario.php" method="GET" style="display:inline">
                                <input type="hidden" name="idUser" value="<?= $usuario['idUser'] ?>">
                                <button type="submit" name="editar" value="Editar">Editar</button>
                            </form>
                        <!-- Boton Borrar -->
                            <form action="../../controllers/c_admin_borrar_usuario.php" method="POST" onsubmit="return confirm('¿Estás seguro de que quieres borrar este usuario?');">
                                <input type="hidden" name="idUser" value="<?= $usuario['idUser'] ?>">
                                <button type="submit" name="borrar" value="Borrar">Borrar</button>
                            </form>   
                        </td>
                        </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
        <div class=""></div>
        <?php else:?>
            <p>No hay usuarios registrados.</p>
        <?php endif;?>
    <!-- FOOTER -->
    <footer class="footer">
        <p>&copy; <?= date("Y"); ?> Cocina Comunitaria. Todos los derechos reservados.</p>
    </footer>
    <!-- Scripts -->
    
</body>
</html>