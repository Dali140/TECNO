//  This script handles the form submission for adding perfumes to the cart
         document.getElementById('perfumeForm').addEventListener('submit', function(event) {
            event.preventDefault();

            const form = document.getElementById('perfumeForm');
            const formData = new FormData(form);

            fetch('php/perfumes.php', {  //  Adjusted path to your PHP file
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                console.log(data);
                alert(data); //  Basic feedback (improve this!)

                //  Show the "Go to Cart" button
                document.getElementById('cartButtonContainer').style.display = 'block';
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Ocurrió un error al guardar.');
            });
        });