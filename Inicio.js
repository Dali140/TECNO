document.addEventListener('DOMContentLoaded', function() {
    // Funciones para scroll suave
    function scrollToComoFunciona() {
        const headerHeight = document.querySelector('header').offsetHeight;
        const section = document.getElementById('como-funciona');
        const sectionPosition = section.offsetTop - headerHeight;
        
        window.scrollTo({
            top: sectionPosition,
            behavior: 'smooth'
        });
    }

    function scrollToConoceMas() {
        const headerHeight = document.querySelector('header').offsetHeight;
        const section = document.getElementById('conoce-mas');
        const sectionPosition = section.offsetTop - headerHeight;
        
        window.scrollTo({
            top: sectionPosition,
            behavior: 'smooth'
        });
    }

    // Asignar eventos a los botones
    const btnComoFunciona = document.querySelector('.btn_como_funciona');
    const btnConoceMas = document.querySelector('.btn_conoce_mas');
    
    if(btnComoFunciona) {
        btnComoFunciona.addEventListener('click', scrollToComoFunciona);
    }
    
    if(btnConoceMas) {
        btnConoceMas.addEventListener('click', scrollToConoceMas);
    }

    // Header dinámico al hacer scroll (opcional)
    let lastScroll = 0;
    const header = document.querySelector('header');
    
    if(header) {
        window.addEventListener('scroll', () => {
            const currentScroll = window.pageYOffset;
            
            if (currentScroll > lastScroll && currentScroll > 100) {
                header.style.transform = 'translateY(-100%)';
            } else {
                header.style.transform = 'translateY(0)';
            }
            
            lastScroll = currentScroll;
        });
    }

    // Ajustar padding del body
    function updateBodyPadding() {
        const headerHeight = document.querySelector('header').offsetHeight;
        document.body.style.paddingTop = `${headerHeight}px`;
    }

    window.addEventListener('load', updateBodyPadding);
    window.addEventListener('resize', updateBodyPadding);
});