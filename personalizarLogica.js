 // Menú Hamburguesa
 const hamburger = document.querySelector('.hamburger');
 const mobileMenu = document.querySelector('.mobile-menu');
 const navLinks = document.querySelectorAll('.mobile-menu .nav-link');

 // Función para alternar menú
 function toggleMenu() {
     hamburger.classList.toggle('active');
     mobileMenu.classList.toggle('active');
     
     // Animación a X
     hamburger.children[0].style.transform = hamburger.classList.contains('active') 
         ? 'rotate(45deg) translate(5px, 5px)' 
         : 'none';
         
     hamburger.children[1].style.opacity = hamburger.classList.contains('active') 
         ? '0' 
         : '1';
         
     hamburger.children[2].style.transform = hamburger.classList.contains('active') 
         ? 'rotate(-45deg) translate(7px, -6px)' 
         : 'none';
 }

 // Event listeners
 hamburger.addEventListener('click', toggleMenu);

 // Cerrar menú al hacer click en enlace (pero mantener la X)
 navLinks.forEach(link => {
     link.addEventListener('click', () => {
         mobileMenu.classList.remove('active');
         // No removemos la clase 'active' del hamburger para mantener la X
     });
 });

 // Ajustar padding del body
 function updateBodyPadding() {
     const headerHeight = document.querySelector('header').offsetHeight;
     document.body.style.paddingTop = `${headerHeight}px`;
 }

 window.addEventListener('load', updateBodyPadding);
 window.addEventListener('resize', updateBodyPadding);