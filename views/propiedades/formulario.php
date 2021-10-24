

            <fieldset>
                <legend>Informacion General</legend>

                <label for="titulo">Titulo:</label>
                <input type="text" id="titulo" name="propiedad[titulo]" placeholder="Titulo Propiedad" value="<?php echo s($propiedad->titulo); ?>">

                <label for="precio">Precio:</label>
                <input type="number" id="precio" name="propiedad[precio]" placeholder="Precio de la Propiedad" value="<?php echo s($propiedad->precio); ?>">

                <label for="imagen">Imagen:</label>
                <input type="file" id="imagen"  accept="image/jpeg, image/png" name="propiedad[imagen]">

                <?php  if ($propiedad->imagen): ?>
                    
                  <img src="/imagenes/<?php echo $propiedad->imagen ?>" alt="Imagen Porpiedad" class="imagen-small">                 
                
                <?php endif;?>

                <label for="descripcion">Descriocion:</label>
                <textarea id="descripcion" name="propiedad[descripcion]" cols="30" rows="10" > <?php echo s($propiedad->descripcion); ?></textarea>

            </fieldset>

            <fieldset>
                <legend>Informacion Propiedad</legend>

                <label for="habitaciones">Habitaciones:</label>
                <input type="number"        
                        id="habitaciones" 
                        name="propiedad[habitaciones]" 
                        placeholder="ej: 3" 
                        min="1" 
                        max="9" 
                        value="<?php echo s($propiedad->habitaciones); ?>" >

                <label for="wuc">Baños:</label>
                <input type="number" 
                        id="wuc" name="propiedad[wuc]" 
                        placeholder="ej: 3" 
                        min="1" max="9" 
                        value="<?php echo s($propiedad->wuc); ?>" >

                <label for="estacionamiento">Estacionamiento:</label>
                <input type="number" 
                        id="estacionamiento" 
                        name="propiedad[estacionamiento]" 
                        placeholder="ej: 3" 
                        min="1" max="9" 
                        value="<?php echo s($propiedad->estacionamiento); ?>" >

            </fieldset>

            <fieldset>
                <legend>Vendedor</legend>

                <label for="vendedor">Vendedor</label>
                <select name="propiedad[vendedorId]" id="vendedor">
                    <option value="" selected >--- Selecciona ---</option>
                    <?php foreach ($vendedores as $vendedor) : ?>
                        <option 
                            <?php echo $propiedad->vendedorId === $vendedor->id ? 'selected' : '';   ?>
                            value="<?php echo s($vendedor->id); ?>" >
                            <?php echo s( $vendedor->nombre) . " " . s($vendedor->apellido); ?>
                        </option>
                    <?php endforeach;?>   
                </select>
            </fieldset>
