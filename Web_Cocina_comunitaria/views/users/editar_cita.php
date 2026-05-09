<?php
    if(session_status() === PHP_SESSION_NONE){
        session_start();
    }

    require_once __DIR__ . '/../../models/DB.php';
    $conexion = DB::connect();

    if(!isset($_GET['idCita'])){
        header("Location: citaciones.php");
        exit;
    }

    $idCita = (int)$_GET['idCita'];
    $stmt = $conexion->prepare("SELECT * FROM citas WHERE idCita = :idCita AND idUser = :idUser");
    $stmt->bindParam(":idCita", $idCita, PDO::PARAM_INT);
    $stmt->bindParam(":idUser", $_SESSION['idUser'], PDO::PARAM_INT);
    $stmt->execute();

    $cita = $stmt->fetch(PDO::FETCH_ASSOC);

    if(!$cita){
        $_SESSION['cita_error'] = "No se encontró la cita.";
        header("Location: citaciones.php");
        exit;
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Edicion de Cita</title>
    <link rel="stylesheet" href="../../public/css/estilos.css">
</head>
<body class="editar-body">
    <header>
        <nav>
            <h1 class="titulo2">Cambia tu Cita</h1>
        </nav>
    </header>
    <div>
        <fieldset class="citas_f">
            <form class= "form" action="../../controllers/c_modificar_cita.php" method="POST">
                <input type="hidden" name="idCita" value="<?= $cita['idCita'] ?>">
                <label for="fecha">Fecha:</label>
                <input type="date" name="fecha" value="<?= htmlspecialchars($cita['fecha_cita']) ?>">
                <label for="motivo">Motivo:</label>
                <textarea name="motivo" cols="5" rows="10"><?= htmlspecialchars($cita['motivo_cita']) ?></textarea>
                <input type="submit" name="Modificar" value="Guardar cambios">
                <a class= "a_citaciones" href="./citaciones.php">Volver a Citaciones</a>
            </form>
        </fieldset>
        <div class="mensajes_citaciones">
            <?php if(isset($_SESSION['cita_success'])):?>
                <p style="color:green"><?= htmlspecialchars($_SESSION['cita_success']); ?></p>
                <?php unset($_SESSION['cita_success']);?>
            <?php endif;?>
        </div>
        <div class="errores">
            <?php if(isset($_SESSION['cita_error'])):?>
                <p style="color:red"><?= htmlspecialchars($_SESSION['cita_error']) ?></p>
                <?php unset($_SESSION['cita_error']);?>
            <?php endif;?>
        </div>
    </div>
    <canvas id="bgCanvas"></canvas>
    <script src="../../public/js/editar_cita.js"></script>
</body>
</html>

