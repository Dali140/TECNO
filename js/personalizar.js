// Muestra valores guardados en localStorage al cargar la página
window.addEventListener('DOMContentLoaded', function() {
    const perfumeGuardado = localStorage.getItem('miPerfume');
    if (perfumeGuardado) {
        try {
            const datos = JSON.parse(perfumeGuardado);
            if (datos.salida) document.getElementById('salida').value = datos.salida;
            if (datos.corazon) document.getElementById('corazon').value = datos.corazon;
            if (datos.fondo) document.getElementById('fondo').value = datos.fondo;
            if (datos.nombre) document.getElementById('nombre').value = datos.nombre;
        } catch(e) {
            localStorage.removeItem('miPerfume');
        }
    }
});

document.getElementById('perfumeForm').addEventListener('submit', function(event) {
    event.preventDefault();

    const form = document.getElementById('perfumeForm');
    const formData = new FormData(form);

    // Guarda en localStorage para previsualizar
    const perfumeLocal = {
        nombre: form.nombre.value,
        salida: form.salida.value,
        corazon: form.corazon.value,
        fondo: form.fondo.value
    };
    localStorage.setItem('miPerfume', JSON.stringify(perfumeLocal));

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
