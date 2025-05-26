// Al cargar la página, mostrar el último perfume guardado en el formulario
window.addEventListener('DOMContentLoaded', function () {
  const perfumeGuardado = localStorage.getItem('miPerfume');
  if (perfumeGuardado) {
    try {
      const datos = JSON.parse(perfumeGuardado);
      if (datos.salida) document.getElementById('salida').value = datos.salida;
      if (datos.corazon) document.getElementById('corazon').value = datos.corazon;
      if (datos.fondo) document.getElementById('fondo').value = datos.fondo;
      if (datos.nombre) document.getElementById('nombre').value = datos.nombre;
      document.getElementById('cartButtonContainer').style.display = 'block';
    } catch (e) {
      console.warn("Error al leer 'miPerfume':", e);
      localStorage.removeItem('miPerfume');
    }
  }
});

// Guardar perfume al enviar el formulario
document.getElementById('perfumeForm').addEventListener('submit', function (event) {
  event.preventDefault();

  const form = document.getElementById('perfumeForm');
  const perfume = {
    nombre: form.nombre.value.trim(),
    salida: form.salida.value,
    corazon: form.corazon.value,
    fondo: form.fondo.value,
    precio: 50000
  };

  // Guardar como último perfume
  localStorage.setItem('miPerfume', JSON.stringify(perfume));

  // Obtener el array actual de perfumes personalizados
  let perfumes = JSON.parse(localStorage.getItem('perfumesPersonalizados')) || [];

  // Verificar si ya existe ese perfume exactamente
  const yaExiste = perfumes.some(p =>
    p.nombre === perfume.nombre &&
    p.salida === perfume.salida &&
    p.corazon === perfume.corazon &&
    p.fondo === perfume.fondo
  );

  if (!yaExiste) {
    perfumes.push(perfume);
    localStorage.setItem('perfumesPersonalizados', JSON.stringify(perfumes));
  }

  // Mostrar el botón de ir al carrito
  document.getElementById('cartButtonContainer').style.display = 'block';

  // Enviar al backend si es necesario (opcional)
  const formData = new FormData(form);
  fetch('php/personalizar.php', {
    method: 'POST',
    body: formData
  })
    .then(response => response.text())
    .then(data => {
      console.log("Servidor:", data);
    })
    .catch(error => {
      console.error('Error al enviar al backend:', error);
    });
});

// Ir al carrito (evita duplicados al hacer clic)
document.getElementById('cartButtonContainer').addEventListener('click', function () {
  window.location.href = 'carrito.html';
});
