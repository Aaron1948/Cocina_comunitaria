<?php

    if(session_status() === PHP_SESSION_NONE){
        session_start();
    }

    if($_SESSION['rol'] !== 'admin'){
        header("Location: ../../index.php");
        exit;
    }

    require_once __DIR__ .'/../../models/DB.php';
    require_once __DIR__ .'/../../models/Usuario.php';

    $conexion = DB::connect();
    $idUser = (int)$_GET['idUser'];
    $usuario = Usuario::obtenerUsuarioPorId($conexion, $idUser);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuario por Admin</title>
    <link rel="stylesheet" href="../../public/css/estilos.css">
</head>
<body>
    <header>
        <nav>
            <h1 class="titulo2">Editar Usuario</h1>
        </nav>
    </header>
    <div class="info">
        <?php if(isset($_SESSION['info'])): ?>
            <p class="mensaje_info"><?= htmlspecialchars($_SESSION['info']); ?></p>
            <?php unset($_SESSION['info']); ?>
        <?php endif; ?>
    </div>
    <div class="admin_container_form">
        <fieldset class="admin_fieldset">
            <form action="../../controllers/c_admin_editar_usuario.php" method="POST" class="admin_form">
                <input type="hidden" name="idUser" value="<?= $usuario['idUser'] ?>">
                <label for="nombre">Nombre:</label>
                <input type="text" name="nombre" id="nombre" value="<?= htmlspecialchars($usuario['nombre']) ?>">
                <label for="apellidos">Apellidos:</label>
                <input type="text" name="apellidos" id="apellidos" value="<?= htmlspecialchars($usuario['apellidos']) ?>">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" value="<?= htmlspecialchars($usuario['email']) ?>">
                <label for="telefono">Teléfono:</label>
                <input type="text" name="telefono" id="telefono" value="<?= htmlspecialchars($usuario['telefono']) ?>">
                <label for="fechaNac">Fecha Nacimiento:</label>
                <input type="date" name="fechaNac" id="fechaNac" value="<?=  htmlspecialchars($usuario['fecha_nacimiento']) ?>">
                <label for="direccion">Dirección:</label>
                <input type="text" name="direccion" id="direccion" value="<?= htmlspecialchars($usuario['direccion']) ?>">
                <label for="sexo">Sexo:</label>
                <select name="sexo" id="sexo">
                    <option value="hombre" <?=  $usuario['sexo']==='hombre'?'selected':'' ?>>Hombre</option>
                    <option value="mujer" <?=  $usuario['sexo']==='mujer'?'selected':'' ?>>Mujer</option>
                    <option value="otro" <?=  $usuario['sexo']==='otro'?'selected':'' ?>>Otro</option>
                </select>
                <label for="rol">Rol:</label>
                <select name="rol" id="rol">
                    <option value="user" <?= $usuario['rol']==='user'?'selected':'' ?>>User</option>
                    <option value="admin" <?= $usuario['rol']==='admin'?'selected':'' ?>>Admin</option>
                </select>
                <button type="submit">Guardar cambios</button>
                <a class= "a_citaciones" href="./usuarios_administracion.php">Volver</a>
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
    
    <!-- scripts -->
    <canvas id="bgCanvas"></canvas>
    <script src="../../public/js/editar_cita.js"></script>   
</body>
</html>
