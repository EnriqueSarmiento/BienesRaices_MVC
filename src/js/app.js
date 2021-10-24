document.addEventListener('DOMContentLoaded', function(){
    eventLisreners();

    darkMode();
});

function eventLisreners(){
    const mobileMenu = document.querySelector('.mobile-menu');

    mobileMenu.addEventListener('click', navegacionResponsive);

    //Muestra campos condicionales del formulario de ocntacto
    const metodoContacto = document.querySelectorAll('input[name="contacto[forma]"]');
    metodoContacto.forEach(input => input.addEventListener('click', mostrarMetodoContacto)); 
    
}

function navegacionResponsive(){
    const navegacion = document.querySelector('.navegacion');

    if(navegacion.classList.contains('mostrar')){
        navegacion.classList.remove('mostrar');
    } else{
        navegacion.classList.add('mostrar');
    }

    // navegacion.classList.toggle('mostrar'); esto hace lo mismo que el if 
}

function darkMode() {

    const prefiereDarkMode = window.matchMedia('(prefers-color-scheme: dark)');
    // console.log(prefiereDarkMode.matches);

    if(prefiereDarkMode.matches){
        document.body.classList.add('dark-mode');
    } else{
        document.body.classList.remove('dark-mode');
    };

    prefiereDarkMode.addEventListener('change', function(){
        if(prefiereDarkMode.matches){
            document.body.classList.add('dark-mode');
        } else{
            document.body.classList.remove('dark-mode');
        };
    });

    const botonDarkMode = document.querySelector('.dark-mode-boton');

    botonDarkMode.addEventListener('click', function () {
        
        document.body.classList.toggle('dark-mode');
    });
}

function mostrarMetodoContacto(e){
    const contactoDiv = document.querySelector('#contacto'); 

    if (e.target.value === 'telefono') {
        contactoDiv.innerHTML = `
            <label for="telefono">Numero Telefono</label>
            <input data-cy="input-telefono" type="tel" placeholder="Tu Telefono" id="telefono" name="contacto[telefono]">
            <p>Elija la fecha y hora para ser contactado</p>
            
            <label for="fecha">Fecha</label>
            <input data-cy="input-fecha" type="date" id="fecha" name="contacto[fecha]">

            <label for="hora">Hora</label>
            <input data-cy="input-hora" type="time" id="hora" min="09:00" max="18:00" name="contacto[hora]">
        `;

    } else if(e.target.value === 'email'){
        contactoDiv.innerHTML = `
            <label for="email">E-mail</label>
            <input data-cy="input-email" type="email" placeholder="Correo Electronico" id="email" name="contacto[email]" > 

        `;
    }
}