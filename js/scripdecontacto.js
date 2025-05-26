// scripdecontacto.js

document.getElementById('contactForm').addEventListener('submit', function (event) {
    event.preventDefault();

    // Recolectar datos del formulario
    const formData = new FormData(this);

    // Enviar datos por AJAX
    fetch('php/guardar_contacto.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        const confirmationMessage = document.getElementById('confirmationMessage');
        confirmationMessage.textContent = data; // Muestra respuesta del PHP
        confirmationMessage.style.display = 'block';
        setTimeout(() => {
            confirmationMessage.style.display = 'none';
        }, 5000);
        if (data.includes("correctamente")) {
            document.getElementById('contactForm').reset();
        }
    })
    .catch(error => {
        const confirmationMessage = document.getElementById('confirmationMessage');
        confirmationMessage.textContent = 'Error al enviar el mensaje.';
        confirmationMessage.style.display = 'block';
    });
});
