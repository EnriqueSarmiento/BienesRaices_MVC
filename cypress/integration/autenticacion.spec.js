/// <reference types="cypress" />

describe('Probar la Autenticacion', () => {
    it('Prueba la Autenticacion de /login', () => {
        cy.visit('/login');

        cy.get('[data-cy="heading-login"]').should('exist');
        cy.get('[data-cy="heading-login"]').should('have.prop', 'tagName').should('equal', 'H1');
        cy.get('[data-cy="heading-login"]').invoke('text').should('equal', 'Iniciar Sesion');
        //selecciona el formulario
        cy.get('[data-cy="formulario-login"]').should('exist');
        //ambos campos obligatorios
        cy.get('[data-cy="formulario-login"]').submit();
        cy.get('[data-cy="alerta-login"]').should('exist');
        cy.get('[data-cy="alerta-login"]').eq(0).should('have.class', 'alerta').and('have.class', 'error');
        cy.get('[data-cy="alerta-login"]').eq(0).invoke('text').should('equal', 'Es necesario un correo electronico');
        
        cy.get('[data-cy="alerta-login"]').eq(1).should('have.class', 'alerta').and('have.class', 'error');
        cy.get('[data-cy="alerta-login"]').eq(1).invoke('text').should('equal', 'Es necesario una contrasena');
        //el usuario existe

        //password es correcto

    });
});