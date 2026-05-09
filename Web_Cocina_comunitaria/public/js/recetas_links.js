// Selecciona el bloque de la receta
// Receta Pavo
const recetaPavo = document.getElementById("receta_pavo");

// Al hacer click, redirige a otra vista.
recetaPavo.addEventListener('click', ()=>{
    window.location.href = './views/recetas_cocina.php?receta=pavo';
});

// Receta bocaditos de arroz
const recetaArroz = document.getElementById("receta_arroz");

recetaArroz.addEventListener('click', ()=>{
    window.location.href = './views/recetas_cocina.php?receta=arroz';
});

// Receta bocaditos de arroz
const recetaArrozConejo = document.getElementById("receta_conejo");

recetaArrozConejo.addEventListener('click', ()=>{
    window.location.href = './views/recetas_cocina.php?receta=conejo';
});

// Receta bocaditos de arroz
const recetaQuinoa = document.getElementById("receta_quinoa");

recetaQuinoa.addEventListener('click', ()=>{
    window.location.href = './views/recetas_cocina.php?receta=quinoa';
});

// Receta bocaditos de arroz
const recetaTallarines = document.getElementById("receta_tallarines");

recetaTallarines.addEventListener('click', ()=>{
    window.location.href = './views/recetas_cocina.php?receta=tallarines';
});