<?php 
    if(session_status() === PHP_SESSION_NONE){
        session_start();
    }

    $receta = $_GET['receta'] ?? null;

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portada</title>
    <link rel="stylesheet" href="./../public/css/estilos.css">
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

                <li><a href="../index.php" class="enlace active">Inicio</a>
                <li><a href="../views/noticias.php" class="enlace">Noticias</a></li>

                <?php if(!isset($_SESSION['is_logged_in'])):?>
                    <!-- Opciones para Visitantes -->
                    <li><a href="registro.php" class="enlace">Registro</a></li>
                    <li><a href="login.php" class="enlace">Login</a></li>
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
    <!-- ELABORACION RECETAS -->
    <!-- Receta Pavo -->
    <?php if($receta === 'pavo'):?>
    <section class="receta_vista" id="receta_pavo">
        <div class="texto">
            <h2 class="titulo-seccion">Receta de Pavo al horno</h2>
            <h3 class="titulo-seccion">Ingredientes</h2>
            <ul class="ingredientes p_section">
                <li>1 pizca de sazonador</li>
                <li>1 pavo de 7 kilos</li>
                <li>2 limones</li>
                <li>2 tazas de cebolla triturada</li>
                <li>¼ taza de vinagre</li>
                <li>3 cucharadas soperas de aceite</li>
                <li>12 dientes de ajo</li>
                <li>4 cebollines picados</li>
                <li>1 ajoporro o puerro grande picadito</li>
                <li>2 hojas de laurel</li>
                <li>3 cucharadas soperas de sal</li>
                <li>3 cucharadas soperas de salsa inglesa Worcestershire</li>
                <li>1 cucharadita de pimienta molida</li>
                <li>2 ramas de tomillo</li>
                <li>3 hojas de salvia</li>
                <li>1 rama de perejil</li>
                <li>1 taza de vino blanco seco</li>
                <li>3 cucharaditas de coñac</li>
                <li>2 manzanas peladas y cortadas sin el corazón</li>
                <li>½ taza de agua (120 mililitros)</li>
                <li>1 cucharadita de azúcar</li>
                <li>0.8 cucharadita de pimienta molida</li>
            </ul>
            <p class="p_section">Utensilios:</p>
            <ul class="ingredientes p_section">
                <li>Bandeja Horno</li>
                <li>Olla</li>
            </ul>
        </div>
        <div class="imagen">
            <img src="../public/images/recetas/pavo_jugoso/pavo_al_horno_jugoso_21403_600.webp" alt="pavo al horno receta" width="600" height="399">
        </div>
        <div class="texto">
            <ul class="ingredientes_view">
                <li>Receta para 20 Comensales</li>
                <li>8 horas</li>
                <li>Plato Principal</li>
                <li>Dificultad Media</li>
            </ul>
        </div>
    </section>
    <section>
        <div class="texto">
            <h2 class="titulo-seccion">Como hacer el Pavo al horno Jugoso</h2>
            <p class="p_section"><strong>1.</strong>Para empezar con la receta de pavo horneado jugoso, primero corta la cabeza y <span>prepara el adobo para</span> el pavo horneado. Para ello,
            tritura la <span>cebolla con el vinagre, el aceite y los dientes de ajo</span> previamente pelados. Una vez integrados, coloca el aderezo en un envase apto para horno.
            <span>Truco:</span> después de hacer el pavo al horno jugoso, puedes usar la cabeza para hacer otra receta si lo deseas.</p>
        </div>
        <div class="elaboracion">
            <img src="../public/images/recetas/pavo_jugoso/elaboracion_1.webp" alt="cebolla picada">
        </div>
    </section>
    <section>
        <div class="texto">
            <p class="p_section"><strong>2.</strong>En ese mismo envase añade el cebollín, el ajoporro, la sal, los limones troceados, el laurel, la salsa inglesa, la pimienta,
            el tomillo, la salvia, el perejil, el vino y el coñac, y mézclalo todo bien (sin triturar) para acabar de hacer el <span>adobo del pavo</span> al horno casero. Luego, <span>incorpora
            el pavo y frótalo con el aderezo</span> por dentro y por fuera. Para introducir el líquido, puedes utilizar una jeringa sin aguja. Así es como se adoba el pavo fácilmente.</p>
        </div>
        <div class="elaboracion">
            <img src="../public/images/recetas/pavo_jugoso/elaboracion_2.webp" alt="bandeja con pavo">
        </div>
    </section>
    <section>
        <div class="texto">
            <p class="p_section"><strong>3.</strong><span>Deja el pavo en el frigorífico durante 3 o 4 horas</span> para que se empape de los aromas y dale la vuelta de vez en cuando. Precalienta
            el <span>horno a 175 ºC</span> y, pasado el tiempo, cubre la bandeja donde lo tengas con papel de aluminio y cocina el pavo asado al horno <span>durante 1 hora y media</span> aproximadamente, o hasta
            que esté dorado. Y si lo que deseas es preparar un relleno para el pavo, no te pierdas esta receta.</p>
        </div>
        <div class="elaboracion">
            <img src="../public/images/recetas/pavo_jugoso/elaboracion_3.webp" alt="bandeja con pavo en el horno">
        </div>
    </section>
    <section>
        <div class="texto">
            <p class="p_section"><strong>4.</strong>Retira el pavo horneado navideño, <span>dale la vuelta</span>, vuelve a cubrir el recipiente con papel de aluminio y hornéalo durante otros <span>30
            minutos más</span>. Repite esta misma operación una vez pasado ese tiempo. Deberás repetirla hasta que el pavo lleve en el horno un <span>total de 3 horas y media</span>.
            <span>Truco:</span> el tiempo que se debe hornear un pavo de 7 kilos es aproximadamente este pero puede variar según el horno de cada uno.</p>
        </div>
        <div class="elaboracion">
            <img src="../public/images/recetas/pavo_jugoso/elaboracion_4.webp" alt="pavo en el horno envuelto en papel de plata">
        </div>
    </section>
    <section>
        <div class="texto">
            <p class="p_section"><strong>5.</strong>Alcanzado ese tiempo, retira el pavo horneado jugoso, <span>saca las hierbas de la bandeja y cuela el jugo</span> que queda en el envase para elaborar
            otra salsa con los ingredientes restantes. Presiona los ingredientes sólidos contra las paredes del colador para obtener el máximo jugo posible. Reserva este líquido obtenido
            de la cocción del pavo al horno en un recipiente aparte.</p>
        </div>
        <div class="elaboracion">
            <img src="../public/images/recetas/pavo_jugoso/elaboracion_5.webp" alt="pavo horneado y especiado">
        </div>
    </section>
    <section>
        <div class="texto">
            <p class="p_section"><strong>6.</strong>Coge una olla y <span>añade la pulpa de las manzanas</span> troceada y la media taza de agua. Calienta a fuego medio y deja que hierva durante <span>10 minutos</span>
            hasta que estén blandas. ¿Qué te está pareciendo este pavo navideño?</p>
        </div>
        <div class="elaboracion">
            <img src="../public/images/recetas/pavo_jugoso/elaboracion_6.webp" alt="manzana troceada">
        </div>
    </section>
    <section>
        <div class="texto">
            <p class="p_section"><strong>7.</strong>Tritura las manzanas junto con el líquido que reservaste de la cocción del pavo asado al horno y pasa la mezcla a otra olla. Incorpora el <span>azúcar
            y la pimienta</span> y deja que hierva todo junto durante 3 minutos. Cuando esté lista, sirve esta <span>salsa para el pavo</span> horneado en un recipiente aparte para que se sirvan los comensales
            que deseen. También puedes preparar pavo al horno con patatas como acompañamiento. ¡Te encantará!</p>
        </div>
        <div class="elaboracion">
            <img src="../public/images/recetas/pavo_jugoso/elaboracion_7.webp" alt="pavo relleno, cuchara y salsa">
        </div>
    </section>
    <section>
        <div class="texto">
            <p class="p_section"><strong>8.</strong>¡Ahora ya sabes cómo preparar pavo al horno! Y, como bien sabes, cocinar pavo horneado jugoso es un proceso largo y laborioso
            pero <span>el resultado vale la pena</span>. Puedes decorar el plato con manzanas troceadas, frutos rojos, etc. Si deseas realizar un relleno para el pavo al horno fácil, no te pierdas
            esta receta en la que te explicamos los pasos para elaborar un pavo relleno navideño. Cuéntanos en los comentarios tu opinión y comparte con nosotros una fotografía
            del resultado final.</p>
        </div>
        <div class="elaboracion">
            <img src="../public/images/recetas/pavo_jugoso/elaboracion_8.webp" alt="plato con pavo decorado">
        </div>
    </section>
    <!-- Valor nutricional + enlace de vuelta -->
    <div class="texto">
        <h3 class="titulo-seccion">Valor nutricional(por comensal)</h2>
            <ul class="ingredientes p_section">
                <li>Calorías: 73 kcal</li>
                <li>Proteínas: 61 g</li>
                <li>Grasas: 39 g</li>
                <li>Carbohidratos: 16 g</li>
                <li>Fibra: 2 g</li>
            </ul>
    </div>
    <div class="inicio">
        <a href="../index.php">Inicio</a>
    </div>
    <?php endif;?>
    <!-- Receta Bocaditos de Arroz -->
    <?php if ($receta === 'arroz'):?>
    <section class="receta_vista" id="receta_arroz">
        <div class="texto">
            <h2 class="titulo-seccion">Receta de Bocaditos de arroz</h2>
            <h3 class="titulo-seccion">Ingredientes</h2>
            <ul class="ingredientes p_section">
                <li>1 taza de arroz cocido (175 gramos)</li>
                <li>1 huevo</li>
                <li>1 cucharada postre de harina o almidón de maíz</li>
                <li>½ cucharadita de polvo de hornear</li>
                <li>1 cucharada sopera de mostaza</li>
                <li> 1 rama de cebolla de verdeo</li>
            </ul>
            <p class="p_section">Caracteristicas:</p>
            <ul class="ingredientes p_section">
                <li>Coste Barato</li>
                <li>En sartén</li>
            </ul>
        </div>
        <div class="imagen">
            <img src="../public/images/recetas/boca_arroz/bocaditos_de_arroz_77915_600.webp" alt="plato de bocaditos de arroz" width="600" height="399">
        </div>
        <div class="texto">
            <ul class="ingredientes_view">
                <li>Receta para 2 Comensales</li>
                <li>45 min</li>
                <li>Acompañamiento</li>
                <li>Dificultad Baja</li>
            </ul>
        </div>
    </section>
    <section>
        <div class="texto">
            <h2 class="titulo-seccion">Cómo hacer Bocaditos de arroz:</h2>
            <p class="p_section"><strong>1.</strong>Si no tienes arroz cocido, <span>cocina</span> aproximadamente <span>media taza</span> de acuerdo a las indicaciones del envase.</p>
        </div>
        <div class="elaboracion">
            <img src="../public/images/recetas/boca_arroz/elaboracion_1.webp" alt="sarten con arroz blanco">
        </div>
    </section>
    <section>
        <div class="texto">
            <p class="p_section"><strong>2.</strong><span>Cuela el arroz y déjalo enfriar</span> para condimentarlo con la <span>cebolla de verdeo picada y la mostaza</span>. Recomendamos usar solo la parte verde de la cebolla.</p>
        </div>
        <div class="elaboracion">
            <img src="../public/images/recetas/boca_arroz/elaboracion_2.webp" alt="arroz blanco y salsa">
        </div>
    </section>
    <section>
        <div class="texto">
            <p class="p_section"><strong>3.</strong>Agrega el <span>huevo</span> e integra.</p>
        </div>
        <div class="elaboracion">
            <img src="../public/images/recetas/boca_arroz/elaboracion_3.webp" alt="arroz blanco y huevo">
        </div>
    </section>
    <section>
        <div class="texto">
            <p class="p_section"><strong>4.</strong>Agrega la <span>harina o almidón de maíz</span>, si deseas que esta preparación sea apta para celíacos. También añade el <span>polvo para hornear</span>. Estos ingredientes ayudarán a amalgamar y darle textura de tortita, pero puedes obviarlos.</p>
        </div>
        <div class="elaboracion">
            <img src="../public/images/recetas/boca_arroz/elaboracion_4.webp" alt="arroz blanco y harina">
        </div>
    </section>
    <section>
        <div class="texto">
            <p class="p_section"><strong>5.</strong><span>Calienta una sartén</span> untada con aceite y, cuando haya tomado temperatura, <span>agrega cucharadas de la preparación</span>, de acuerdo al tamaño que deseas tengan tus bocaditos de arroz. También puedes proporcionar forma con las manos húmedas.</p>
        </div>
        <div class="elaboracion">
            <img src="../public/images/recetas/boca_arroz/elaboracion_5.webp" alt="tortitas de arroz">
        </div>
    </section>
    <section>
        <div class="texto">
            <p class="p_section"><strong>6.</strong>Cuando estén <span>dorados, gíralos</span> para que también lo hagan del otro lado.</p>
        </div>
        <div class="elaboracion">
            <img src="../public/images/recetas/boca_arroz/elaboracion_6.webp" alt="tortitas de arroz en al sarten">
        </div>
    </section>
    <section>
        <div class="texto">
            <p class="p_section"><strong>7.</strong>Sirve con una salsa o dip para acompañarlos. <span>¡A comer!</span> Cuéntanos en los comentarios tu opinión y comparte con nosotros una fotografía del resultado final.</p>
        </div>
        <div class="elaboracion">
            <img src="../public/images/recetas/boca_arroz/elaboracion_7.webp" alt="tortitas de arroz fritas">
        </div>
    </section>
    <!-- Valor nutricional + enlace de vuelta -->
    <div class="texto">
        <h3 class="titulo-seccion">Valor nutricional(por comensal)</h2>
            <ul class="ingredientes p_section">
                <li>Calorías: 228,5 kcal</li>
                <li>Proteínas: 7,5 g</li>
                <li>Grasas: 5 g</li>
                <li>Carbohidratos: 39 g</li>
                <li>Fibra: 1 g</li>
            </ul>
    </div>
    <div class="inicio">
        <a href="../index.php">Inicio</a>
    </div>
    <?php endif;?>
    <!-- Receta Arroz y conejo Estilo andaluz-->
    <?php if ($receta === 'conejo'):?>
    <section class="receta_vista" id="receta_conejo">
        <div class="texto">
            <h2 class="titulo-seccion">Receta de Arroz con conejo estilo andaluz</h2>
            <h3 class="titulo-seccion">Ingredientes</h2>
            <ul class="ingredientes p_section">
                <li>1 conejo</li>
                <li>400 gramos de arroz</li>
                <li>1 cebolla</li>
                <li>1 pimiento verde</li>
                <li>1 pimiento rojo</li>
                <li>ajos</li>
                <li>2 tomates maduro</li>
                <li>1 litro de caldo de pollo</li>
                <li>1 cucharada postre de colorante</li>
                <li>tomillo</li>
                <li>aceite</li>
                <li>sal</li>
            </ul>
            <p class="p_section">Caracteristicas:</p>
            <ul class="ingredientes p_section">
                <li>Coste Medio</li>
            </ul>
        </div>
        <div class="imagen">
            <img src="../public/images/recetas/arroz_conejo/arroz_con_conejo_estilo_andaluz_76916_600.webp" alt="paella de arroz y conejo" width="600" height="399">
        </div>
        <div class="texto">
            <ul class="ingredientes_view">
                <li>Receta para 4 Comensales</li>
                <li>1h 30min</li>
                <li>Dificultad Media</li>
            </ul>
        </div>
    </section>
    <section>
        <div class="texto">
            <h2 class="titulo-seccion">Cómo hacer Arroz con conejo estilo andaluz:</h2>
            <p class="p_section"><strong>1.</strong>Para hacer el conejo con arroz casero primero <span>limpia el conejo</span> y trocéalo. A continuación, <span>lava las verduras</span>. También coloca una paella al fuego con un buen chorro de aceite de oliva. Añade un poco de <span>sal al conejo y pon a dorarlo</span> en la paella caliente.</p>
        </div>
        <div class="elaboracion">
            <img src="../public/images/recetas/arroz_conejo/elaboracion_1.webp" alt="conejo crudo en sarten">
        </div>
    </section>
    <section>
        <div class="texto">
            <p class="p_section"><strong>2.</strong><span>Pica las verduras</span>, la <span>cebolla</span>, el <span>pimiento rojo y verde</span>, pica todo bien pequeño. Cuando observes que el conejo está casi dorado por todos los lados, añade las verduras y deja se pochen.</p>
        </div>
        <div class="elaboracion">
            <img src="../public/images/recetas/arroz_conejo/elaboracion_2.webp" alt="conejo y verduras en sarten">
        </div>
    </section>
    <section>
        <div class="texto">
            <p class="p_section"><strong>3.</strong><span>Pica los dientes de ajo</span> y añade junto al conejo con cuidado que no se queme. Si observas que no queda aceite, añade un poco más.</p>
        </div>
        <div class="elaboracion">
            <img src="../public/images/recetas/arroz_conejo/elaboracion_3.webp" alt="conejo frito y verduras">
        </div>
    </section>
    <section>
        <div class="texto">
            <p class="p_section"><strong>4.</strong><span>Ralla los tomates</span> o lávalos y córtalos en trozos, incorpora a la cazuela antes de que se doren mucho los ajos. Pon un poco de sal y tomillo picado. Deja unos minutos que se cocine el tomate.</p>
        </div>
        <div class="elaboracion">
            <img src="../public/images/recetas/arroz_conejo/elaboracion_4.webp" alt="conejo frito y salsa de tomate">
        </div>
    </section>
    <section>
        <div class="texto">
            <p class="p_section"><strong>5.</strong><span>Añade el vino blanco</span> y deja unos minutos para que se evapore el alcohol.</p>
        </div>
        <div class="elaboracion">
            <img src="../public/images/recetas/arroz_conejo/elaboracion_5.webp" alt="añadiendo vino blanco al conejo">
        </div>
    </section>
    <section>
        <div class="texto">
            <p class="p_section"><strong>6.</strong><span>Añade</span> el arroz y remueve para que se mezclen los sabores.</p>
        </div>
        <div class="elaboracion">
            <img src="../public/images/recetas/arroz_conejo/elaboracion_6.webp" alt="conejo y arroz crudo en sarten">
        </div>
    </section>
    <section>
        <div class="texto">
            <p class="p_section"><strong>7.</strong><span>Añade el caldo de pollo</span> caliente y también un poco de azafrán o colorante. Prueba el caldo de sal
            y, si hace falta, rectifica. Deja que se cocine el arroz deconejo <span>15-17 minutos</span> hasta que esté al gusto.
            <span>Truco:</span> puedes utilizar el caldo de pollo o de verduras. Si no tienes bastante puedes completar con agua.</p>
        </div>
        <div class="elaboracion">
            <img src="../public/images/recetas/arroz_conejo/elaboracion_7.webp" alt="caldo con conejo en sarten">
        </div>
    </section>
    <section>
        <div class="texto">
            <p class="p_section"><strong>8.</strong>A mitad de la cocción, <span>prueba la paella de conejo y verduras</span> por si falta un poco más de sal o tomillo. Deja que se termine de cocinar el arroz.</p>
        </div>
        <div class="elaboracion">
            <img src="../public/images/recetas/arroz_conejo/elaboracion_8.webp" alt="paella cocinándose">
        </div>
    </section>
    <section>
        <div class="texto">
            <p class="p_section"><strong>9.</strong>Cuando esté lista la paella con conejo, apaga el fuego y deja que <span>repose unos 5 minutos</span>. ¡A comer el mejor arroz con conejo de España! Cuéntanos en los comentarios tu opinión y comparte con nosotros una fotografía del resultado final.</p>
        </div>
        <div class="elaboracion">
            <img src="../public/images/recetas/arroz_conejo/elaboracion_9.webp" alt="paella de conejo">
        </div>
    </section>
    <!-- Valor nutricional + enlace de vuelta -->
    <div class="texto">
        <h3 class="titulo-seccion">Valor nutricional(por comensal)</h2>
            <ul class="ingredientes p_section">
                <li>Calorías: 625 kcal</li>
                <li>Proteínas: 37,5 g</li>
                <li>Grasas: 2 g</li>
                <li>Carbohidratos: 75 g</li>
                <li>Fibra: 5 g</li>
            </ul>
    </div>
    <div class="inicio">
        <a href="../index.php">Inicio</a>
    </div>
    <?php endif;?>
    <!-- Receta de Quinoa con verduras -->
    <?php if ($receta === 'quinoa'):?>
    <section class="receta_vista" id="receta_quinoa">
        <div class="texto">
            <h2 class="titulo-seccion">Receta de Quinoa con verduras salteadas</h2>
            <h3 class="titulo-seccion">Ingredientes</h2>
            <ul class="ingredientes p_section">
                <li>1 taza de quinoa</li>
                <li>480 mililitros de agua (2 tazas)</li>
                <li>4 hojas de lechuga fresca</li>
                <li>200 gramos de pollo en milanesa o fajita</li>
                <li>1 zanahoria</li>
                <li>1 trozo de granos de elote</li>
                <li>1 taza de garbanzos cocidos</li>
                <li>½ taza de frijoles enteros cocidos</li>
                <li>80 gramos de queso rallado</li>
                <li>50 gramos de tiras de tortilla fritas</li>
            </ul>
            <p class="p_section">Caracteristicas:</p>
            <ul class="ingredientes p_section">
                <li>Coste Medio</li>
                <li>Plato Principal</li>
            </ul>
        </div>
        <div class="imagen">
            <img src="../public/images/recetas/quinoa/quinoa_con_verduras_salteadas_75785_600.webp" alt="quinoa con salteado de verduras" width="600" height="399">
        </div>
        <div class="texto">
            <ul class="ingredientes_view">
                <li>Receta para 2 Comensales</li>
                <li>30min</li>
                <li>Dificultad Baja</li>
            </ul>
        </div>
    </section>
    <section>
        <div class="texto">
            <h2 class="titulo-seccion">Cómo hacer Quinoa con verduras salteadas:</h2>
            <p class="p_section"><strong>1.</strong>¿Te preguntas cómo preparar quinoa con verduras? Pues bien, para empezar esta receta de quinoa
            con verduras salteadas primero <span>enjuaga la quinoa en un chorro de agua</span> para limpiarla bien. A continuación, <span>lleva a cocer con
            480 mililitros de aguas</span> (dos tazas de agua) aproximadamente 15 minutos o hasta que se haya consumido el agua. Luego, reserva y deja enfriar.</p>
        </div>
        <div class="elaboracion">
            <img src="../public/images/recetas/quinoa/elaboracion_1.webp" alt="sarten con agua y quinoa">
        </div>
    </section>
    <section>
        <div class="texto">
            <p class="p_section"><strong>2.</strong>En una sartén calienta un poco de aceite y <span>cocina el pollo sazonando</span> con sal y pimienta al gusto. Cuando esté listo, reserva.
            <span>Truco:</span> puedes utilizar pechuga en milanesa o en fajitas.</p>
        </div>
        <div class="elaboracion">
            <img src="../public/images/recetas/quinoa/elaboracion_2.webp" alt="pollo sazonado en sarten">
        </div>
    </section>
    <section>
        <div class="texto">
            <p class="p_section"><strong>3.</strong><span>Pica las verduras</span> que van en crudo y <span>trocea la lechuga y la zanahoria</span> en tiras delgadas o rallada.</p>
        </div>
        <div class="elaboracion">
            <img src="../public/images/recetas/quinoa/elaboracion_3.webp" alt="verduras picadas">
        </div>
    </section>
    <section>
        <div class="texto">
            <p class="p_section"><strong>4.</strong>Ya puedes empezar a montar el bol de quinoa con verduras salteadas. Para ello, primero <span>coloca una base de quinoa y lechuga</span>. Enseguida, <span>agrega los garbanzos y los frijoles</span> cocidos.</p>
        </div>
        <div class="elaboracion">
            <img src="../public/images/recetas/quinoa/elaboracion_4.webp" alt="garbanzos, quinoa y verduras">
        </div>
    </section>
    <section>
        <div class="texto">
            <p class="p_section"><strong>5.</strong><span>Agrega el elote, el pollo cocido, el queso, la zanahoria</span> y termina añadiendo algunas <span>tiras de tortilla</span> horneadas o fritas. ¡Ya puedes disfrutar de este bol de quinoa con verduras y soja! ¿Qué te ha parecido esta elaboración? Cuéntanos en los comentarios.</p>
        </div>
        <div class="elaboracion">
            <img src="../public/images/recetas/quinoa/elaboracion_5.webp" alt="quinoa con verduras y tortilla">
        </div>
    </section>
    <!-- Valor nutricional + enlace de vuelta -->
    <div class="texto">
        <h3 class="titulo-seccion">Valor nutricional(por comensal)</h2>
            <ul class="ingredientes p_section">
                <li>Calorías: 805 kcal</li>
                <li>Proteínas: 44,5 g</li>
                <li>Grasas: 26 g</li>
                <li>Carbohidratos: 99,5 g</li>
                <li>Fibra: 17 g</li>
            </ul>
    </div>
    <div class="inicio">
        <a href="../index.php">Inicio</a>
    </div>
    <?php endif;?>
    <!-- Receta de Tallarines rojos -->
    <?php if ($receta === 'tallarines'):?>
    <section class="receta_vista" id="receta_tallarines">
        <div class="texto">
            <h2 class="titulo-seccion">Receta de Tallarines rojos con atún</h2>
            <h3 class="titulo-seccion">Ingredientes</h2>
            <ul class="ingredientes p_section">
                <li>1 puñado de tallarines</li>
                <li>2 latas de atún</li>
                <li>1 cebolla finamente picada</li>
                <li>1 cucharada sopera de ajo molido o finamente picado</li>
                <li>4 tomates picados rústicamente</li>
                <li>2 cucharadas soperas de ají panca en pasta</li>
                <li>1 pizca de comino molido</li>
                <li>2 hojas de laurel</li>
                <li>1 pizca de pimienta negra molida</li>
                <li>sal al gusto</li>
            </ul>
            <p class="p_section">Caracteristicas:</p>
            <ul class="ingredientes p_section">
                <li>Coste Barato</li>
                <li>Receta Peruana</li>
            </ul>
        </div>
        <div class="imagen">
            <img src="../public/images/recetas/tallarines/tallarines_rojos_con_atun_78159_600.webp" alt="tallarines rojos con atun" width="600" height="399">
        </div>
        <div class="texto">
            <ul class="ingredientes_view">
                <li>Receta para 2 Comensales</li>
                <li>30min</li>
                <li>Dificultad Baja</li>
            </ul>
        </div>
    </section>
    <section>
        <div class="texto">
            <h2 class="titulo-seccion">Cómo hacer Tallarines rojos con atún:</h2>
            <p class="p_section"><strong>1.</strong>Empieza <span>sancochando la pasta</span> en abundante agua hirviendo con un buen puñado de sal. Deja que se cocine entre
            <span>8 a 10 minutos</span>, o prueba uno para asegurarte; debe sentirse firme, pero no crudo. Luego, <span>escúrrelos y resérvalos</span>.</p>
        </div>
        <div class="elaboracion">
            <img src="../public/images/recetas/tallarines/elaboracion_1.webp" alt="bol con agua y pasta">
        </div>
    </section>
    <section>
        <div class="texto">
            <p class="p_section"><strong>2.</strong>Aparte, en una <span>sartén vierte un buen chorro de aceite</span>. Cuando esté bien caliente, <span>coloca la cebolla</span> finamente picada y deja que se <span>sude</span>. Remueve esporádicamente para evitar que se queme.</p>
        </div>
        <div class="elaboracion">
            <img src="../public/images/recetas/tallarines/elaboracion_2.webp" alt="sarten con cebolla">
        </div>
    </section>
    <section>
        <div class="texto">
            <p class="p_section"><strong>3.</strong><span>Añade el ajo</span>, ya sea picado finamente, molido o rallado, según tu lo prefieras.</p>
        </div>
        <div class="elaboracion">
            <img src="../public/images/recetas/tallarines/elaboracion_3.webp" alt="rallado de ajo en sarten">
        </div>
    </section>
    <section>
        <div class="texto">
            <p class="p_section"><strong>4.</strong>Incorpora la pasta de <span>ají panca</span> junto con las especias: <span>comino</span> molido, <span>pimienta</span> negra molida y una cucharadita de <span>sal</span>. Cocina por unos minutos más para que se integren los sabores.</p>
        </div>
        <div class="elaboracion">
            <img src="../public/images/recetas/tallarines/elaboracion_4.webp" alt="añadiento pasta de aji">
        </div>
    </section>
    <section>
        <div class="texto">
            <p class="p_section"><strong>5.</strong><span>Licúa los tomates</span> con un poco de agua y agrégalos a la sartén junto con el aderezo.</p>
        </div>
        <div class="elaboracion">
            <img src="../public/images/recetas/tallarines/elaboracion_5.webp" alt="tomate licuado">
        </div>
    </section>
    <section>
        <div class="texto">
            <p class="p_section"><strong>6.</strong><span>Deja que hierva</span>, y si deseas, ponle unas hojas de <span>laurel</span> para darle aroma.</p>
        </div>
        <div class="elaboracion">
            <img src="../public/images/recetas/tallarines/elaboracion_6.webp" alt="sarten con caldo y atun">
        </div>
    </section>
    <section>
        <div class="texto">
            <p class="p_section"><strong>7.</strong>Después de unos 15 minutos de cocción, <span>añade el atún</span> previamente <span>escurrido</span> para evitar que el exceso de líquido disuelta la salsa.</p>
        </div>
        <div class="elaboracion">
            <img src="../public/images/recetas/tallarines/elaboracion_7.webp" alt="caldo pasta y atun en sarten">
        </div>
    </section>
    <section>
        <div class="texto">
            <p class="p_section"><strong>8.</strong>Remueve bien, <span>ajusta la sazón y finalmente incorpora los tallarines</span>. Mézclalos con cuidado para que la salsa se entrelace con la pasta. ¡Sirve los tallarines con atún en lata de inmediato y buen provecho! Cuéntanos en los comentarios tu opinión y comparte una fotografía del resultado final.</p>
        </div>
        <div class="elaboracion">
            <img src="../public/images/recetas/tallarines/elaboracion_8.webp" alt="tallarines con atun rojo">
        </div>
    </section>
    <!-- Valor nutricional + enlace de vuelta -->
    <div class="texto">
        <h3 class="titulo-seccion">Valor nutricional(por comensal)</h2>
            <ul class="ingredientes p_section">
                <li>Calorías: 51 kcal</li>
                <li>Proteínas: 4 g</li>
                <li>Grasas: 15 g</li>
                <li>Carbohidratos: 6 g</li>
                <li>Fibra: 17 g</li>
            </ul>
    </div>
    <div class="inicio">
        <a href="../index.php">Inicio</a>
    </div>
    <?php endif;?>
    <!-- FOOTER -->
    <footer class="footer">
        <p>&copy; <?= date("Y"); ?> Cocina Comunitaria. Todos los derechos reservados.</p>
    </footer>
    <!-- Scripts -->    
    <script src="./public/js/titulo.js"></script>
</body>
</html>