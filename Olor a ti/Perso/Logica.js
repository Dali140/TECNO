// Archivo: Logica.js


// Espera a que el contenido HTML del documento esté completamente cargado
document.addEventListener("DOMContentLoaded", () => {
    
    // Selecciona todas las imágenes que estén dentro de elementos con clase "notas-salida"
    const images = document.querySelectorAll(".notas-salida img");
    
    // Crea un nuevo elemento div que funcionará como tooltip
    const tooltip = document.createElement("div");
    
    // Asigna la clase "tooltip" al div creado (para estilizarlo con CSS)
    tooltip.className = "tooltip";
    
    // Agrega el tooltip al final del body del documento
    document.body.appendChild(tooltip);

    // Para cada imagen encontrada...
    images.forEach((img) => {
        
        // Agrega un evento que se dispara cuando el mouse pasa sobre la imagen
        img.addEventListener("mouseover", (e) => {
            // Obtiene el mensaje del tooltip del atributo data-tooltip de la imagen
            const message = img.getAttribute("data-tooltip");
            
            // Establece el texto del tooltip
            tooltip.textContent = message;
            
            // Hace visible el tooltip
            tooltip.style.display = "block";
            
            // Posiciona el tooltip 10px a la derecha del cursor
            tooltip.style.left = `${e.pageX + 10}px`;
            
            // Posiciona el tooltip 10px debajo del cursor
            tooltip.style.top = `${e.pageY + 10}px`;
        });

        // Agrega un evento que se dispara cuando el mouse se mueve sobre la imagen
        img.addEventListener("mousemove", (e) => {
            // Actualiza la posición del tooltip mientras el mouse se mueve
            tooltip.style.left = `${e.pageX + 10}px`;
            tooltip.style.top = `${e.pageY + 10}px`;
        });

        // Agrega un evento que se dispara cuando el mouse sale de la imagen
        img.addEventListener("mouseout", () => {
            // Oculta el tooltip
            tooltip.style.display = "none";
        });
    });
});

