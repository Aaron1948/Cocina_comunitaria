document.querySelectorAll('.noticia-img').forEach(img => {
  img.addEventListener('click', () => {
    document.getElementById('lightbox-img').src = img.src;
    document.getElementById('lightbox-titulo').textContent = img.dataset.titulo;
    document.getElementById('lightbox-texto').textContent = img.dataset.texto;
    document.getElementById('lightbox-fecha').textContent = "Fecha: " + img.dataset.fecha;
    document.getElementById('lightbox-autor').textContent = "Por: " + img.dataset.autor;
    document.getElementById('lightbox').style.display = 'block';
  });
});

document.querySelector('.close').addEventListener('click', () => {
  document.getElementById('lightbox').style.display = 'none';
});

window.addEventListener('click', e => {
  if (e.target.id === 'lightbox') {
    document.getElementById('lightbox').style.display = 'none';
  }
});