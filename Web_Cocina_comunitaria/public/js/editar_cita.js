
const canvas = document.getElementById('bgCanvas');
const ctx = canvas.getContext('2d');

// Ajustamos tamaño al viewport
function resizeCanvas() {
  canvas.width = window.innerWidth;
  canvas.height = window.innerHeight;
}
resizeCanvas();
window.addEventListener('resize', resizeCanvas); // reajustar a la ventana

// Estilo para que quede de fondo 
canvas.style.position = 'fixed';
canvas.style.top = 0; 
canvas.style.left = 0; // Esquina superior Izq
canvas.style.zIndex = -1; // Lo coloco detras del contenido

// Definimos tipos de ingredientes
const ingredientes = [
  { color: "red", r: 8 },    // tomate
  { color: "green", r: 6 },  // hoja
  { color: "yellow", r: 7 }  // limón
];

// Creamos partículas/ingredientes
const items = Array.from({ length: 40 }, () => { // Creamos 40 particulas
  const ing = ingredientes[Math.floor(Math.random() * ingredientes.length)];
  return {
    x: Math.random() * canvas.width,
    y: Math.random() * canvas.height,
    r: ing.r,
    color: ing.color,
    dx: (Math.random() - 0.5) * 0.5,
    dy: (Math.random() - 0.5) * 0.5
  };
});

// Animación
function draw() {
  ctx.clearRect(0, 0, canvas.width, canvas.height);

  items.forEach(p => {
    ctx.fillStyle = p.color;
    ctx.beginPath();
    ctx.arc(p.x, p.y, p.r, 0, Math.PI * 2);
    ctx.fill();

    // movimiento
    p.x += p.dx;
    p.y += p.dy;

    // rebote en bordes
    if (p.x < 0 || p.x > canvas.width) p.dx *= -1;
    if (p.y < 0 || p.y > canvas.height) p.dy *= -1;
  });

  requestAnimationFrame(draw);
}
draw();