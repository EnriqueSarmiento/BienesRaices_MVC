/// <reference types="cypress" /> 

describe('Prueba la Navegacion y Routing del Header y Footer', () => {
    it('Prueba la Navegacion del Header', () => {
        cy.visit('/');
        cy.get('[data-cy="navegacion-header"]').should('exist');
        cy.get('[data-cy="navegacion-header"]').should('have.class', 'navegacion');
        cy.get('[data-cy="navegacion-header"]').find('a').should('have.length', 4); 
        
        //prueba los enlaces
        cy.get('[data-cy="navegacion-header"]').find('a').eq(0).invoke('text').should('equal', 'Nosotros');  
        cy.get('[data-cy="navegacion-header"]').find('a').eq(0).invoke('attr', 'href').should('equal', '/nosotros');
        cy.get('[data-cy="navegacion-header"]').find('a').eq(0).click()
        cy.get('[data-cy="heading-nosotros"]').find('H1').invoke('text').should('equal', 'Conoce Sobre Nosotros');
        cy.get('[data-cy="heading-iconos"]').find('H2').invoke('text').should('equal', 'Mas Sobre Nosotros');
        cy.wait(1000);
        cy.go('back');
        cy.get('[data-cy="navegacion-header"]').find('a').eq(1).invoke('text').should('equal', 'Propiedades');  
        cy.get('[data-cy="navegacion-header"]').find('a').eq(1).invoke('attr', 'href').should('equal', '/propiedades');
        cy.get('[data-cy="navegacion-header"]').find('a').eq(1).click()
        cy.get('[data-cy="heading-propiedades"]').find('H1').invoke('text').should('equal', 'Casas y Departamentos en Venta');
        cy.wait(1000);
        cy.go('back');
        cy.get('[data-cy="navegacion-header"]').find('a').eq(2).invoke('text').should('equal', 'Blog');  
        cy.get('[data-cy="navegacion-header"]').find('a').eq(2).invoke('attr', 'href').should('equal', '/blog');
        cy.get('[data-cy="navegacion-header"]').find('a').eq(2).click()
        cy.get('[data-cy="heading-blog"]').find('H1').invoke('text').should('equal', 'Nuestro Blog');
        cy.wait(1000);
        cy.go('back');
        cy.get('[data-cy="navegacion-header"]').find('a').eq(3).invoke('text').should('equal', 'Contacto');  
        cy.get('[data-cy="navegacion-header"]').find('a').eq(3).invoke('attr', 'href').should('equal', '/contacto');
        cy.get('[data-cy="navegacion-header"]').find('a').eq(3).click()
        cy.get('[data-cy="heading-contacto"]').find('H1').invoke('text').should('equal', 'Contacto');
        cy.wait(1000);
        cy.go('back');

    });

    it('Prueba la Navegacion del Footer', () => {
        cy.visit('/');
        cy.get('[data-cy="navegacion-footer"]').should('exist');
        cy.get('[data-cy="navegacion-footer"]').should('have.class', 'navegacion');
        cy.get('[data-cy="navegacion-footer"]').find('a').should('have.length', 4); 
        
        //prueba los enlaces
        cy.get('[data-cy="navegacion-footer"]').find('a').eq(0).invoke('text').should('equal', 'Nosotros');  
        cy.get('[data-cy="navegacion-footer"]').find('a').eq(0).invoke('attr', 'href').should('equal', '/nosotros');
        cy.get('[data-cy="navegacion-footer"]').find('a').eq(0).click()
        cy.get('[data-cy="heading-nosotros"]').find('H1').invoke('text').should('equal', 'Conoce Sobre Nosotros');
        cy.get('[data-cy="heading-iconos"]').find('H2').invoke('text').should('equal', 'Mas Sobre Nosotros');
        cy.wait(1000);
        cy.go('back');
        cy.get('[data-cy="navegacion-footer"]').find('a').eq(1).invoke('text').should('equal', 'Propiedades');  
        cy.get('[data-cy="navegacion-footer"]').find('a').eq(1).invoke('attr', 'href').should('equal', '/propiedades');
        cy.get('[data-cy="navegacion-footer"]').find('a').eq(1).click()
        cy.get('[data-cy="heading-propiedades"]').find('H1').invoke('text').should('equal', 'Casas y Departamentos en Venta');
        cy.wait(1000);
        cy.go('back');
        cy.get('[data-cy="navegacion-footer"]').find('a').eq(2).invoke('text').should('equal', 'Blog');  
        cy.get('[data-cy="navegacion-footer"]').find('a').eq(2).invoke('attr', 'href').should('equal', '/blog');
        cy.get('[data-cy="navegacion-footer"]').find('a').eq(2).click()
        cy.get('[data-cy="heading-blog"]').find('H1').invoke('text').should('equal', 'Nuestro Blog');
        cy.wait(1000);
        cy.go('back');
        cy.get('[data-cy="navegacion-footer"]').find('a').eq(3).invoke('text').should('equal', 'Contacto');  
        cy.get('[data-cy="navegacion-footer"]').find('a').eq(3).invoke('attr', 'href').should('equal', '/contacto');
        cy.get('[data-cy="navegacion-footer"]').find('a').eq(3).click()
        cy.get('[data-cy="heading-contacto"]').find('H1').invoke('text').should('equal', 'Contacto');
        cy.wait(1000);
        cy.go('back');    });


});