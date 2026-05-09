<?php 
    if(session_status() === PHP_SESSION_NONE){
        session_start();
    }

    require_once __DIR__ . '/../../models/DB.php';
    $conexion = DB::connect();
    // Ver citas del usuario
    $sqlSelect = "SELECT * FROM citas WHERE idUser = :idUser";
    $sqlSelect = $conexion->prepare($sqlSelect);
    $sqlSelect->bindParam(":idUser", $_SESSION['idUser'], PDO::PARAM_INT);
    $sqlSelect->execute();

    $citas = $sqlSelect->fetchAll(PDO::FETCH_ASSOC);
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
                <li><a href="../../views/noticias.php" class="enlace">Noticias</a></li>
                <?php if(!isset($_SESSION['is_logged_in'])):?>
                    <!-- Opciones para Visitantes -->
                    <li><a href="#" class="enlace">Registro</a></li>
                    <li><a href="#" class="enlace">Login</a></li>
                    <?php endif;?>
                <?php if(isset($_SESSION['usuario']) && $_SESSION['rol'] === 'user'):?>
                    <!-- Opciones Para Usuarios -->
                    <li><a href="./perfil.php" class="enlace">Perfil</a></li>
                    <li><a href="./citaciones.php" class="enlace active">Citaciones</a></li>
                <?php endif;?>
                <?php if(isset($_SESSION['usuario']) && $_SESSION['rol'] === 'admin'):?>
                    <!-- Opciones Para Administradores -->
                    <li><a href="#" class="enlace">Usuarios Administracion</a></li> 
                    <li><a href="#" class="enlace">Noticias Administracios</a></li> 
                    <li><a href="#" class="enlace">Perfil</a></li>
                    <?php endif;?> 
                <?php if(isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true):?>
                    <!-- Cerrar Sesion Cuando Admin o User entra en la pagina -->
                    <li><a href="../logout.php" class="enlace">Cerrar Sesion</a></li>
                <?php endif;?>
            </ul>
        </nav>
    </header>
    <!-- CITAS DEL USUARIO -->
    <div class="usuarios_bbdd">
        <h2 class="titulo-seccion">Citas</h2>
        <p class="p_section">Desde aquí podras insertar tus citas, además de poder modificarlas por si no las creaste correctamente.
            Recuerda que la fecha de las citas debe ser siempre superior o igual al dia de hoy.
        </p>
        <?php if(!empty($citas)):?>
            <table>
                <tr>
                    <th>Fecha</th>
                    <th>Motivo</th>
                </tr>
                <?php foreach($citas as $cita):?>
                    <tr>
                        <td><?= htmlspecialchars($cita['fecha_cita']) ?></td>
                        <td><?= htmlspecialchars($cita['motivo_cita']) ?></td>
                        <td>
                        <!-- Boton Editar -->    
                            <form action="../users/editar_cita.php" method="GET" style="display:inline">
                                <input type="hidden" name="idCita" value="<?= $cita['idCita'] ?>">
                                <input type="submit" name="editar" value="Editar">
                            </form>
                        <!-- Boton Borrar -->
                            <form action="../../controllers/c_borrar_cita.php" method="POST" onsubmit="return confirm('¿Seguro que quieres borrar esta cita?');">
                                <input type="hidden" name="idCita" value="<?= $cita['idCita'] ?>">
                                <input type="submit" name="borrar" value="Borrar">
                            </form>   
                        </td>
                    </tr>
                
                <?php endforeach;?>
            </table>
        <?php else:?>
            <p class="citas">No tienes Citas Registradas</p>
        <?php endif;?>
    </div>
    <!-- Login Ok -->
    <?php if(isset($_SESSION['login_ok'])):?>
        <p class="exito"><?= htmlspecialchars($_SESSION['login_ok']); ?></p>
        <?php unset($_SESSION['login_ok']);?>
        <?php endif;?>
    <div>
        <!-- Formulario para Insertar una cita -->
        <fieldset class="citas_f">
            <form class="form" action="../../controllers/c_insertar_cita.php" method="POST">
                <label for="fecha">Fecha:</label>
                <input type="date" name="fecha" id="fecha">
                <label for="motivo">Motivo:</label>
                <textarea rows="8" cols="5" name="motivo" id="motivo"></textarea>
                <input type="submit" name="Insertar" value="Insertar">
            </form>
        </fieldset>
    </div>
    <div class="mensajes_citaciones">
        <?php if(isset($_SESSION['cita_success'])):?>
            <p style="color:green"><?= htmlspecialchars($_SESSION['cita_success']); ?></p>
            <?php unset($_SESSION['cita_success']);?>
        <?php endif;?>
        <?php if(isset($_SESSION['cita_error'])):?>
            <p style="color:red"><?= $_SESSION['cita_error']; ?></p>
            <?php unset($_SESSION['cita_error']);?>
        <?php endif;?>
    </div>
    <!-- FOOTER -->
    <footer class="footer">
        <p>&copy; <?= date("Y"); ?> Cocina Comunitaria. Todos los derechos reservados.</p>
    </footer>
    <!-- Scripts -->
</body>
</html>