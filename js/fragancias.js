document.addEventListener("DOMContentLoaded", () => {
    // Selecciona todas las imágenes de cada sección
    const salidaImages = document.querySelectorAll(".notas-salida img");
    const corazonImages = document.querySelectorAll(".notas-corazon img");
    const fondoImages = document.querySelectorAll(".notas-fondo img");

    // Selecciona las celdas de la tabla
    const salidaCell = document.getElementById("salida");
    const corazonCell = document.getElementById("corazon");
    const fondoCell = document.getElementById("fondo");

    // Tooltip
    const tooltip = document.createElement("div");
    tooltip.className = "tooltip";
    document.body.appendChild(tooltip);

    // Función para manejar el click en imágenes
    const handleImageClick = (img, cell) => {
        const value = img.getAttribute("data-value");
        if (value) {
            cell.textContent = value;
        }
    };

    // Función para mostrar el tooltip
    const handleTooltip = (img, e) => {
        const message = img.getAttribute("data-tooltip");
        if (message) {
            tooltip.textContent = message;
            tooltip.style.display = "block";
            tooltip.style.left = `${e.pageX + 10}px`;
            tooltip.style.top = `${e.pageY + 10}px`;
        }
    };

    // Ocultar tooltip
    const hideTooltip = () => {
        tooltip.style.display = "none";
    };

    // Añade eventos a imágenes de notas de salida
    salidaImages.forEach((img) => {
        img.addEventListener("click", () => handleImageClick(img, salidaCell));
        img.addEventListener("mouseover", (e) => handleTooltip(img, e));
        img.addEventListener("mousemove", (e) => handleTooltip(img, e));
        img.addEventListener("mouseout", hideTooltip);
    });

    // Añade eventos a imágenes de notas de corazón
    corazonImages.forEach((img) => {
        img.addEventListener("click", () => handleImageClick(img, corazonCell));
        img.addEventListener("mouseover", (e) => handleTooltip(img, e));
        img.addEventListener("mousemove", (e) => handleTooltip(img, e));
        img.addEventListener("mouseout", hideTooltip);
    });

    // Añade eventos a imágenes de notas de fondo
    fondoImages.forEach((img) => {
        img.addEventListener("click", () => handleImageClick(img, fondoCell));
        img.addEventListener("mouseover", (e) => handleTooltip(img, e));
        img.addEventListener("mousemove", (e) => handleTooltip(img, e));
        img.addEventListener("mouseout", hideTooltip);
    });

    // Guardar las notas elegidas al hacer clic en el botón
    document.getElementById('guardarPerfume').addEventListener('click', function() {
        const notaSalida = salidaCell.textContent.trim();
        const notaCorazon = corazonCell.textContent.trim();
        const notaFondo = fondoCell.textContent.trim();

        if(!notaSalida || !notaCorazon || !notaFondo){
            alert("Debes seleccionar una nota de salida, corazón y fondo.");
            return;
        }

        const formData = new FormData();
        formData.append('salida', notaSalida);
        formData.append('corazon', notaCorazon);
        formData.append('fondo', notaFondo);

        fetch('php/perfumes.php', { method: 'POST', body: formData })

        .then(response => response.text())
        .then(resultado => {
            alert(resultado); // mensaje desde PHP
        })
        .catch(error => {
            alert('Error al guardar el perfume: ' + error);
        });
    });
});
