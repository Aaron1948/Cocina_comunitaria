
// Animacion de colores para el titulo.
document.addEventListener("DOMContentLoaded", ()=>{
    const titulo = document.getElementById("titulo");
    const colores = ["rgb(105, 103, 190)", 
    "rgb(150, 103, 190)", 
    "rgb(103, 150, 190)", 
    "rgba(25, 180, 28, 1)", 
    "rgb(240, 240, 240)",
    "#000000"];
    let i = 0;

    setInterval(()=>{
        titulo.style.color = colores[i];
        i = (i + 1) % colores.length;
    }, 1000);
});