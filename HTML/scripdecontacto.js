
// Captura el evento de envío del formulario
document.getElementById('contactForm').addEventListener('submit', function (event) {
    event.preventDefault(); // Evita el envío real del formulario
    const confirmationMessage = document.getElementById('confirmationMessage'); // Selecciona el mensaje de confirmación
    confirmationMessage.style.display = 'block'; // Muestra el mensaje de confirmación
    setTimeout(() => {
        confirmationMessage.style.display = 'none'; // Oculta el mensaje después de 5 segundos
    }, 5000);
    this.reset(); // Limpia los campos del formulario
});
