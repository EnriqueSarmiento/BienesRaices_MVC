/// <reference types="cypress" />

describe('Carga la pagina principal', () => {
    it('Prueba el Header de la Pagina Principal', () => {
        cy.visit('/');

        cy.get('[data-cy="heading-sitio"]').should('exist'); 
        cy.get('[data-cy="heading-sitio"]').invoke('text').should('equal', 'Venta de Casas y Departamentos Exclusivos de Lujo');
        cy.get('[data-cy="heading-sitio"]').invoke('text').should('not.equal', 'Bienes Raices'); 

    });

    it('Prueba el Bloque de iconos principales', () => {
        cy.visit('/');
        //selecciona el h2
        cy.get('[data-cy="heading-nosotros"]'). should('exist');
        cy.get('[data-cy="heading-nosotros"]').should('have.prop', 'tagName').should('equal', 'H2');
        //Selecciona los iconos
        cy.get('[data-cy="iconos-nosotros"]'). should('exist');
        cy.get('[data-cy="iconos-nosotros"]').find('.icono').should('have.length', 3);
        cy.get('[data-cy="iconos-nosotros"]').find('.icono').should('not.have.length', 4);

    });

    it('Prueba la Seccion de Propiedades', () =>{
        cy.visit('/');
        //Contenedor de propiedades
        cy.get('[data-cy="anuncio"]').should('have.length', 3); 
        cy.get('[data-cy="anuncio"]').should('not.have.length', 4); 

        //Prueba Botones de Propiedades
        cy.get('[data-cy="enlace-propiedad"]'). should('have.class', 'boton-amarillo-block');
        cy.get('[data-cy="enlace-propiedad"]').first().invoke('text').should('equal', 'Ver Propiedad');
        cy.get('[data-cy="enlace-propiedad"]').first().click();
        cy.wait(2000);
        cy.go('back');
    });

    it('Prueba Boton hacia todas las Propiedades', () => {
        cy.visit('/');
        //selecciona el boton y verificar url
        cy.get('[data-cy="ver-propiedades"]'). should('exist');
        cy.get('[data-cy="ver-propiedades"]'). should('have.class', 'boton-verde');
        cy.get('[data-cy="ver-propiedades"]').invoke('attr', 'href').should('equal', '/propiedades');
        //prueba que el href funcione
        cy.get('[data-cy="ver-propiedades"]').click()
        cy.get('[data-cy="heading-propiedades"]').should('exist');
        cy.get('[data-cy="heading-propiedades"]').invoke('text').should('equal', 'Casas y Departamentos en Venta');

        cy.wait(1000);
        cy.go('back');

    });

    it('Prueba el bloque de Contcatos', () => {
        cy.visit('/');
        //prueba el heading del bloque
        cy.get('[data-cy="imagen-contacto"]').should('exist'); 
        cy.get('[data-cy="imagen-contacto"]').find('h2').invoke('text').should('equal', 'Encuentra la Casa de tus Sueños');
        cy.get('[data-cy="imagen-contacto"]').find('p').invoke('text').should('equal', 'Llena el formulario de contacto y un asesor se pondra en contacto contigo a la brevedad');
        //probar el boton de contactos
        cy.get('[data-cy="imagen-contacto"]').find('a').invoke('attr', 'href')
            .then( href => {
                cy.visit(href)
            }); 
        cy.get('[data-cy="heading-contacto"]').should('exist');
        cy.wait(2000);
        cy.visit('/');
    });

    it('Probando Blog y Testimoniales', () => {
        cy.visit('/');
        //selecciona la seccion de blog
        cy.get('[data-cy="blog"]').should('exist');
        cy.get('[data-cy="blog"]').find('H3').invoke('text').should('equal', 'Nuestro Blog');
        cy.get('[data-cy="blog"]').find('H3').invoke('text').should('not.equal', 'Blog');
        cy.get('[data-cy="blog"]').find('img').should('have.length', 2);
         
        //seleciona la seccion de testimoniales
        cy.get('[data-cy="testimoniales"]').should('exist');
        cy.get('[data-cy="testimoniales"]').find('H3').invoke('text').should('equal', 'Testimoniales');
        cy.get('[data-cy="testimoniales"]').find('H3').invoke('text').should('not.equal', 'NuestroS Testimoniales');
    });
});