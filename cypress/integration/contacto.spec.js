/// <reference types="cypress" />

describe('Prueba la pagina de Contacto y llenado del formulario', () => {
    it('Prueba la pagina de contactos y envio de email', () => {
        cy.visit('/contacto');
        
        cy.get('[data-cy="heading-contacto"]').should('exist')
        cy.get('[data-cy="heading-contacto"]').find('H1').invoke('text').should('equal', 'Contacto');
        
        cy.get('[data-cy="heading-formulario"]').invoke('text').should('equal', 'Llene el Formulario de Contacto');
        
        cy.get('[daya-cy="formulario-contacto"]').should('exist');
    });

    it('Prueba Llenado del formulario', () => {
        cy.get('[data-cy="input-nombre"]').type('Enrique Prueba-Cypress');
        cy.get('[data-cy="input-mensaje"]').type('Prueba-Cypress: Deseo comprar una casa en si portal');
        cy.get('[data-cy="input-mensaje"]').type('Prueba-Cypress: Deseo comprar una casa en si portal');
        cy.get('[data-cy="input-opciones"]').select('Compra');
        cy.get('[data-cy="input-presupuesto"]').type('12000000');
        //selecciona email o telefono
        cy.get('[data-cy="input-radio"]').eq(1).check();
        cy.wait(1000);
        cy.get('[data-cy="input-radio"]').eq(0).check();
        cy.get('[data-cy="input-telefono"]').type('1234567890');
        cy.get('[data-cy="input-fecha"]').type('2021-06-26');
        cy.get('[data-cy="input-hora"]').type('02:30');

        cy.get('[daya-cy="formulario-contacto"]').submit();
        cy.get('[data-cy="mensaje-formulario"]').should('exist');
        cy.get('[data-cy="mensaje-formulario"]').invoke('text').should('equal', 'Mensaje Enviado Correctamente');
        cy.get('[data-cy="mensaje-formulario"]').should('have.class', 'alerta').and('have.class', 'exito').and('not.have.class', 'error');

    });
});
