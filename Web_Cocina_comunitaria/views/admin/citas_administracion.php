<?php 
    if(session_status() === PHP_SESSION_NONE){
        session_start();
    }

    require_once __DIR__ . '/../../models/DB.php';

    $conexion = DB::connect();

    $sql = "SELECT idUser, nombre, apellidos, email FROM users_data";
    $stmt = $conexion->prepare($sql);
    $stmt->execute();

    $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if(isset($_GET['idUser'])){
        $idUser = (int)$_GET['idUser']; // Sanearlo
        $sqlCita = "SELECT idCita, idUser, fecha_cita, motivo_cita FROM citas WHERE idUser = :idUser ORDER BY fecha_cita ASC";
        $stmtCita = $conexion->prepare($sqlCita);
        $stmtCita->bindParam(":idUser", $idUser,PDO::PARAM_INT);
        $stmtCita->execute();
        $citas = $stmtCita->fetchAll(PDO::FETCH_ASSOC);
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
<body class="citas_administracion">
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
                            <a class="enlace active" href="./citas_administracion.php">Citas Administracion</a>
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
    <h1 class="titulo-seccion">Gestion De Citas</h1>
    <table id="c_adminCrear">
        <tr>
            <th>Nombre</th>
            <th>Apellidos</th>
            <th>Email</th>
            <th>Acciones</th>
        </tr>
        <?php foreach ($usuarios as $usuario):?>
            <tr>
                <td><?= htmlspecialchars($usuario['nombre']) ?></td>
                <td><?= htmlspecialchars($usuario['apellidos']) ?></td>
                <td><?= htmlspecialchars($usuario['email']) ?></td>
                <td><a href="citas_administracion.php?idUser=<?=  $usuario['idUser'] ?>">Gestionar Citas</a></td>
            </tr>
        <?php endforeach;?>
    </table>
<?php if(isset($citas)):?>
    <h2 class="titulo-seccion">Citas del Usuario Seleccionado</h2>
    <?php if(count($citas) > 0):?>
        <table id="c_adminCrear">
            <tr><th>Fecha</th><th>Motivo</th></tr>
            <?php foreach ($citas as $cita):?>
                <tr>
                    <td><?= htmlspecialchars($cita['fecha_cita']) ?></td>
                    <td><?= htmlspecialchars($cita['motivo_cita']) ?></td>
                    <td><a href="./editar_citaAdmin.php?idCita=<?= $cita['idCita'] ?>&idUser=<?= $idUser ?>">Editar</a>
                        <form action="../../controllers/c_borrar_citaAdmin.php" method="POST" style="display:inline;" onsubmit="return confirm('¿Estás seguro de que quieres borrar esta cita?');">
                            <input type="hidden" name="idCita" value="<?= $cita['idCita'] ?>">
                            <input type="hidden" name="idUser" value="<?= $idUser ?>">
                            <button type="submit" name="borrar">Borrar</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach;?>
        </table>
    <?php else:?>
        <p class="p_section">Este usuario no tiene citas asignadas.</p>
    <?php endif;?>
<?php endif;?>
<!-- Form para crear la citas -->
<?php if (isset($idUser)): ?>
  <h3 class="titulo-seccion">CREAR NUEVA CITA</h3>
  <form class="c_form" method="POST" action="../../controllers/c_crear_citaAdmin.php">
    <!-- Campo oculto para saber a qué usuario pertenece -->
    <input type="hidden" name="idUser" value="<?= $idUser ?>">

    <label for="fecha">Fecha:</label>
    <input type="date" id="fecha" name="fecha" required>

    <label for="motivo">Motivo:</label>
    <textarea name="motivo" id="motivo" cols="5" rows="8"></textarea>

    <button type="submit">Crear cita</button>
  </form>
    <?php if(isset($_SESSION['errores'])): ?>
        <p class="error"><?= htmlspecialchars($_SESSION['errores']); ?></p>
        <?php unset($_SESSION['errores']); ?>
    <?php endif; ?>  
<?php endif; ?>
    <?php if(isset($_SESSION['login_ok'])):?>
        <p class="exito"><?= htmlspecialchars($_SESSION['login_ok']); ?></p>
        <?php unset($_SESSION['login_ok']);?>
        <?php endif;?>
<div class="mensajes_citaciones">
            <?php if(isset($_SESSION['cita_success'])):?>
                <p style="color:green"><?= htmlspecialchars($_SESSION['cita_success']); ?></p>
                <?php unset($_SESSION['cita_success']);?>
            <?php endif;?>
            <?php if(isset($_SESSION['cita_error'])): ?>
            <p style="color:red"><?= htmlspecialchars($_SESSION['cita_error']); ?></p>
                <?php unset($_SESSION['cita_error']); ?>
            <?php endif; ?>
        </div>
    <!-- FOOTER -->
    <footer class="footer">
        <p>&copy; <?= date("Y"); ?> Cocina Comunitaria. Todos los derechos reservados.</p>
    </footer>
    <!-- Scripts -->

</body>
</html>