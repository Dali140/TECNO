// Archivo: Logica.js

// Espera a que el contenido HTML del documento esté completamente cargado
document.addEventListener("DOMContentLoaded", () => {
    // Selecciona todas las imágenes de las secciones
    const salidaImages = document.querySelectorAll(".notas-salida img");
    const corazonImages = document.querySelectorAll(".notas-corazon img");
    const fondoImages = document.querySelectorAll(".notas-fondo img");

    // Selecciona las celdas de la tabla
    const salidaCell = document.getElementById("salida");
    const corazonCell = document.getElementById("corazon");
    const fondoCell = document.getElementById("fondo");

    // Crea un nuevo elemento div que funcionará como tooltip
    const tooltip = document.createElement("div");

    // Asigna la clase "tooltip" al div creado (para estilizarlo con CSS)
    tooltip.className = "tooltip";
 
    // Agrega el tooltip al final del body del documento
    document.body.appendChild(tooltip);

    // Función para manejar el clic en las imágenes
    const handleImageClick = (img, cell) => {
        const value = img.getAttribute("data-value");
        if (value) {
            cell.textContent = value; // Actualiza la celda con el valor
        }
    };

    // Función para manejar el tooltip
    const handleTooltip = (img, e) => {
        const message = img.getAttribute("data-tooltip");
        if (message) {
            tooltip.textContent = message;
            tooltip.style.display = "block";
            tooltip.style.left = `${e.pageX + 10}px`;// Desplaza el tooltip 10px a la derecha del cursor
            tooltip.style.top = `${e.pageY + 10}px`;// Desplaza el tooltip 10px hacia abajo del cursor
        }
    };

    // Función para ocultar el tooltip
    const hideTooltip = () => {
        tooltip.style.display = "none";
    };

    // Agrega eventos de clic y tooltip a las imágenes de "Notas de Salida"
    salidaImages.forEach((img) => {
        img.addEventListener("click", () => handleImageClick(img, salidaCell));
        img.addEventListener("mouseover", (e) => handleTooltip(img, e));
        img.addEventListener("mousemove", (e) => handleTooltip(img, e));
        img.addEventListener("mouseout", hideTooltip);
    });

    // Agrega eventos de clic y tooltip a las imágenes de "Notas de Corazón"
    corazonImages.forEach((img) => {
        img.addEventListener("click", () => handleImageClick(img, corazonCell));
        img.addEventListener("mouseover", (e) => handleTooltip(img, e));
        img.addEventListener("mousemove", (e) => handleTooltip(img, e));
        img.addEventListener("mouseout", hideTooltip);
    });

    // Agrega eventos de clic y tooltip a las imágenes de "Notas de Fondo"
    fondoImages.forEach((img) => {
        img.addEventListener("click", () => handleImageClick(img, fondoCell));
        img.addEventListener("mouseover", (e) => handleTooltip(img, e));
        img.addEventListener("mousemove", (e) => handleTooltip(img, e));
        img.addEventListener("mouseout", hideTooltip);
    });
});
 