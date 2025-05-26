// Muestra el último perfume guardado al cargar la página
window.addEventListener('DOMContentLoaded', function () {
  const perfumeGuardado = localStorage.getItem('miPerfume');
  if (perfumeGuardado) {
    try {
      const datos = JSON.parse(perfumeGuardado);
      if (datos.salida) document.getElementById('salida').value = datos.salida;
      if (datos.corazon) document.getElementById('corazon').value = datos.corazon;
      if (datos.fondo) document.getElementById('fondo').value = datos.fondo;
      if (datos.nombre) document.getElementById('nombre').value = datos.nombre;
    } catch (e) {
      localStorage.removeItem('miPerfume');
    }
  }
});

// Guardar perfume al enviar el formulario
document.getElementById('perfumeForm').addEventListener('submit', function (event) {
  event.preventDefault();

  const form = document.getElementById('perfumeForm');
  const perfume = {
    nombre: form.nombre.value,
    salida: form.salida.value,
    corazon: form.corazon.value,
    fondo: form.fondo.value,
    precio: 50000 // Puedes hacer esto dinámico si quieres
  };

  // Guardar como último perfume
  localStorage.setItem('miPerfume', JSON.stringify(perfume));

  // Guardar en el array de perfumes personalizados
  const perfumes = JSON.parse(localStorage.getItem('perfumesPersonalizados')) || [];
  perfumes.push(perfume);
  localStorage.setItem('perfumesPersonalizados', JSON.stringify(perfumes));

  // Enviar al backend si es necesario
  const formData = new FormData(form);
  fetch('php/personalizar.php', {
    method: 'POST',
    body: formData
  })
    .then(response => response.text())
    .then(data => {
      alert(data);
      document.getElementById('cartButtonContainer').style.display = 'block';
    })
    .catch(error => {
      alert('Ocurrió un error al guardar.');
    });

  document.getElementById('cartButtonContainer').style.display = 'block';
});
