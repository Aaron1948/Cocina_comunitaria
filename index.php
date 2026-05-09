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
    <link rel="stylesheet" href="./public/css/estilos.css">
</head>
<body>
    <!-- HEADER -->
    <header>
        <!-- NAVBAR -->
        <nav class="navigationBar">
            <!-- Logo de la pagina -->
            <img src="./public/images/logo/logo-transparent-png.png" class="logo" width="500" height="506" alt="logo de la pagina">
            <h1 id="titulo">Cocina Comunitaria</h1>
            <ul class="navigationBarList">
                <a href="./index.php" class="enlace active">Inicio</a>  
                <a href="./views/noticias.php" class="enlace">Noticias</a></li>

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
                        <a href="./views/admin/usuarios_administracion.php" class="enlace">Usuarios Administración</a>
                        <a href="./views/admin/citas_administracion.php" class="enlace">Citas Administración</a>
                        <a href="./views/admin/noticias_administracion.php" class="enlace">Noticias Administración</a>
                        <a href="./views/admin/perfil.php" class="enlace">Perfil</a>
                    </li>
                <?php endif;?> 

                <?php if(isset($_SESSION['is_logged_in'])):?>
                    <!-- Cerrar Sesion Cuando Admin o User entra en la pagina -->
                    <li><a href="./views/logout.php" class="enlace">Cerrar Sesion</a></li>
                <?php endif;?>
            </ul>
        </nav>
    </header>
    <?php if(isset($_SESSION['login_ok'])):?>
        <p class="exito"><?= htmlspecialchars($_SESSION['login_ok']); ?></p>
        <?php unset($_SESSION['login_ok']);?>
        <?php endif;?>
    <!-- MENSAJE DE BIENVENIDA -->
    <section class="intro">
        <h2 class="titulo-seccion">Bienvenido a Cocina Comunitaria</h2>
        <p class="p_section">
            Este es un espacio donde compartimos recetas, noticias y organizamos citas o eventos para disfrutar juntos de la cocina. 
            Regístrate para participar, consulta las últimas noticias o pide tu cita en la comunidad.
            Podeis resolver vuestras dudas a través del formulario de citas y poneros en contacto con un administrador.
            La finalidad de esta web es simple, facilitar diferentes tipos de recetas culinarias y que todo el mundo
            pueda disfrutar de ellas para poder realizarlas paso a paso.
            Esperamos que la visita a nuestro sitio os sea de agrado, al mismo tiempo, podeis colaborar en el desarrollo compartiendo
            vuestro tiempo y vuestros dotes de cocina.
            Disfrutar de ésta es uno de los pasatiempos mas saludables en los que podemos invertir nuestro tiempo, muchas gracias de antemano
            por el aporte brindado y por pasaros por aqui, gracias!!
        </p>
    </section>
    <!-- Recetas de Cocina -->
    <section>
        <h2 class="titulo-seccion">Recetas de cocina</h2>
        <p class="p_section">Aqui podras encontrar una pequeña seleccion de diferentes recetas para elaborar fácilmente,
        muchas de ellas estan valoradas por los usuarios de nuestra comunidad y cada una tiene su nivel de dificultad. Existen diferentes niveles, dependiendo del tiempo y la destreza
        de chef o su experiencia, ya solo queda que te pongas manos a la obra...</p>
    </section>
    <section class="receta" id="receta_pavo">
        <div class="texto">
            <h2 class="titulo-seccion">Receta de Pavo al horno jugoso</h2>
            <p class="p_section">Deliciosa receta de pavo horneado jugoso para Navidad o celebrar el Día de Acción de Gracias, fácil de hacer y con la que obtendrás un pavo al horno muy jugoso.
            Sin lugar a dudas, este es uno de los platos más tradicionales y populares en la mayoría de países del mundo durante los días de Navidad, y en Estados Unidos y Canadá
            para celebrar el Día de Acción de Gracias. En función de la región acostumbran a cocinar el pavo al horno, asado, relleno, con guarnición, etc., todas ellas recetas deliciosas
            e ideales para estas festividades. En esta receta de CocinaComunitaria queremos enseñarte a preparar un exquisito pavo al horno jugoso y tierno, así que sigue leyendo y descubre los pasos
            de esta increíble receta de pavo al horno jugoso y sabroso.</p>
        </div>
        <div class="imagen">
            <img src="./public/images/recetas/pavo_jugoso/pavo_al_horno_jugoso_21403_600.webp" alt="pavo al horno receta" width="600" height="399">
        </div>
    </section>
    <section class="receta" id="receta_arroz">
        <div class="texto">
            <h2 class="titulo-seccion">Receta de Bocaditos de arroz</h2>
            <p class="p_section">Si te ha sobrado arroz o quieres armar una picada con amigos o familia, esta receta
                de bocaditos es para ti. Con arroz, mostaza y un toque de verdeo, haremos unos deliciosos bocaditos,
                ideales para reciclar arroz cocido de una forma divertida o para completar una botana. Al final,
                te proporcionaremos varias ideas para que los adaptes a tu gusto.
                En CocinaComunitaria te enseñamos cómo hacer bocaditos de arroz. ¡A cocinar!</p>
        </div>
        <div class="imagen">
            <img src="./public/images/recetas/boca_arroz/bocaditos_de_arroz_77915_600.webp" alt="bocaditos de arroz" width="600" height="499">
        </div>
    </section>
    <section class="receta" id="receta_conejo">
        <div class="texto">
            <h2 class="titulo-seccion">Receta de Arroz con conejo estilo andaluz</h2>
            <p class="p_section">El arroz con conejo tradicional estilo andaluz es un plato muy rico, ya que el conejo aporta
                muy buen sabor al arroz. Además, si dispones de un buen conejo de campo, el sabor es mucho más bueno.
                También puedes añadir más especias a este plato, según las zonas se añade comino, orégano o pimentón
                al arroz. El caldo que se incorpora es de carne o de pollo, pero se puede añadir de verduras o agua si
                no dispones, aunque actualmente lo puedes comprar ya preparado o hacerlo en un momento, un buen caldo ayudará a que el sabor del plato sea mucho más bueno.
                Asimismo, en CocinaComunitaria te enseñamos cómo hacer arroz con conejo estilo andaluz. ¡Vamos allá!</p>
        </div>
        <div class="imagen">
            <img src="./public/images/recetas/arroz_conejo/arroz_con_conejo_estilo_andaluz_76916_600.webp" alt="arroz con conejo" width="600" height="398">
        </div>
    </section>
    <section class="receta" id="receta_quinoa">
        <div class="texto">
            <h2 class="titulo-seccion">Receta de Quinoa con verduras salteadas</h2>
            <p class="p_section">La quinoa o quinua es uno de los alimentos superfoods que cada vez se consume más gracias a los nutrientes
                y a la versatilidad de la receta. Además, esta elaboración es una muy buena opción para llevar en un tupper a la escuela
                o al trabajo, ya que se puede disfrutar también en frío siempre y cuando se elija una proteína que se pueda comer sin calentar,
                como por ejemplo el pollo, que una vez cocido funciona también en recetas frías.
                ¿Has probado alguna vez los bowls de quinoa? En CocinaComunitaria te enseñamos cómo hacer quinoa con verduras salteadas. No te pierdas
                esta receta y prepara esta elaboración con pollo y verduras. ¡A cocinar!</p>
        </div>
        <div class="imagen">
            <img src="./public/images/recetas/quinoa/quinoa_con_verduras_salteadas_75785_600.webp" alt="quinoa con verduras" width="600" height="337">
        </div>
    </section>
    <section class="receta" id="receta_tallarines">
        <div class="texto">
            <h2 class="titulo-seccion">Receta de Tallarines rojos con atún</h2>
            <p class="p_section">Los tallarines rojos con atún son una versión práctica de uno de los platos más representativos de la gastronomía peruana. Esta preparación
                no solo resuelve el almuerzo con sencillez, sino que también guarda el sabor de casa.
                En CocinaComunitaria queremos enseñarte cómo preparar tallarines rojos con atún. ¡A la cocina!!</p>
        </div>
        <div class="imagen">
            <img src="./public/images/recetas/tallarines/tallarines_rojos_con_atun_78159_600.webp" alt="tallarines con atun" width="600" height="450">
        </div>
    </section>   
    <!-- FOOTER -->
    <footer class="footer">
        <p>&copy; <?= date("Y"); ?> Cocina Comunitaria. Todos los derechos reservados.</p>
    </footer>
    <!-- Scripts -->    
    <script src="./public/js/titulo.js"></script>
    <script src="./public/js/recetas_links.js"></script>
</body>
</html>