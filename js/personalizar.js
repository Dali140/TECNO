// js/personalizar.js
document.getElementById('perfumeForm').addEventListener('submit', function(event) {
    event.preventDefault();

    const form = document.getElementById('perfumeForm');
    const formData = new FormData(form);

    fetch('php/personalizar.php', { // Ruta correcta
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        console.log(data);
        alert(data);
        document.getElementById('cartButtonContainer').style.display = 'block';
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Ocurrió un error al guardar.');
    });
});
