<main class="contenedor seccion" data-cy="heading-contacto">
        <h1>Contacto</h1> 
        <?php if ($mensaje) {?>
            <p data-cy="mensaje-formulario" class="alerta exito"><?php echo $mensaje ?></p>
        <?php }?>

        <picture>
            <source srcset="build/img/destacada3.webp" type="image/webp">
            <source srcset="build/img/destacada3.jpg" type="image/jpeg">
            <img loading="lazy" src="build/img/destacada3.jpg" alt="imagen contacto">
        </picture>

        <h2 data-cy="heading-formulario">Llene el Formulario de Contacto</h2>

        <form daya-cy="formulario-contacto" class="formulario" action="/contacto" method="POST" >
            <fieldset>
                <legend>Informacion Personal</legend>
                <label for="nombre">Nombre</label>
                <input data-cy="input-nombre" type="text" placeholder="Tu Nombre"  id="nombre" name="contacto[nombre]">

                <label for="mensaje">Mensaje</label>
                <textarea data-cy="input-mensaje" id="mensaje" cols="30" rows="10" name="contacto[mensaje]" ></textarea>

            </fieldset>

            <fieldset>
                <legend>Informacion Sobre la Propiedad</legend>
                
                <label for="opciones">Vende o Compra</label>
                <select data-cy="input-opciones" id="opciones" name="contacto[tipo]" >
                    <option value="" disabled selected>--seleccionar--</option>
                    <option value="Compra">Compra</option>
                    <option value="Vende">Vende</option>
                </select>

                <label for="presupuesto">Precio o Presupuesto</label>
                <input data-cy="input-presupuesto" type="number" id="presupuesto" placeholder="Tu Precio o Presupuesto" name="contacto[precio]" >
            </fieldset>

            <fieldset>
                <legend>Contacto</legend>

                <p>Como desea ser contactado</p>

                <div class="forma-contacto" >
                    <label for="contactar-telefono">Telefono</label>
                    <input data-cy="input-radio" name="contacto[forma]" type="radio" value="telefono" id="contactar-telefono"  >

                    <label for="contactar-email">Correo Electronico</label>
                    <input  data-cy="input-radio" name="contacto[forma]" type="radio" value="email" id="contactar-email">
                </div>

                <div id="contacto"></div>

            </fieldset>

            <input type="submit" value="enviar" class="boton-verde">

        </form>
    </main>
