<?php

namespace Controllers;
use MCV\Router;
use Model\Propiedad; 
use Model\Vendedor;
use Intervention\Image\ImageManagerStatic as Image; 

class PropiedadController{
    public static function index(Router $router){
        
        $propiedades = Propiedad::all();
        $vendedores = Vendedor::all();
        //mostrar mensaje condicional 
        $resultado= $_GET['resultado'] ?? null; 

        $router->render('propiedades/admin', [
            'propiedades' => $propiedades,
            'resultado' => $resultado,
            'vendedores' => $vendedores
        ]);
    }
    public static function crear(Router $router){
        $errores= Propiedad::getErrores();
        $propiedad = new Propiedad;
        $vendedores = Vendedor::all();

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $propiedad = new Propiedad($_POST['propiedad']);
            /** subida de archivos */
            // Generar un nombre unico
            $nombreImagen = md5(uniqid(rand(), true)) . '.jpg';
    
            //Setaer la Imagen
            //Realiza un rezise a la imagen con intervention
            if ($_FILES['propiedad']['tmp_name']['imagen']) {
                $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800, 600); 
                $propiedad->setImagen($nombreImagen);
            }
    
            //Validar los datos 
            $errores = $propiedad->validar();
    
            if (empty($errores)){
    
                //crear carpeta para subir imagenes
                if (!is_dir(CARPETA_IMAGENES)) {
                    mkdir(CARPETA_IMAGENES);
                }
                    
                //Subir imagen al servidor usando intervention
                $image->save( CARPETA_IMAGENES . $nombreImagen);
    
                // Guarda en la Base de Datos
                $propiedad->guardar();
            }
        }

        $router->render('propiedades/crear', [
            'propiedad' => $propiedad,
            'vendedores' => $vendedores,
            'errores' => $errores
        ]);
    }
    public static function actualizar(Router $router){
        $id = validarORedireccionar('/admin');
        $propiedad = Propiedad::find($id);
        //Validar los datos 
        $errores = $propiedad->validar();
        $vendedores = Vendedor::all();

        if ($_SERVER['REQUEST_METHOD']=== 'POST') {
            //Asignar los atributos
            $args = $_POST['propiedad'];
    
            $propiedad->sincronizar($args);
    
            //validar
            $errores = $propiedad->validar();
    
            /** subida de archivos */
            // Generar un nombre unico
            $nombreImagen = md5(uniqid(rand(), true)) . '.jpg';
    
            //Setaer la Imagen
            //Realiza un rezise a la imagen con intervention
            if ($_FILES['propiedad']['tmp_name']['imagen']) {
                $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800, 600); 
                $propiedad->setImagen($nombreImagen);
            }
    
            if (empty($errores)){
                //almacenar la imagen en disco duro
                if ($_FILES['propiedad']['tmp_name']['imagen']) {
                    $image->save(CARPETA_IMAGENES . $nombreImagen);           
                }
                $propiedad->guardar(); 
            }
        }
    

        $router->render('propiedades/actualizar', [
            'propiedad' => $propiedad,
            'errores' => $errores,
            'vendedores' => $vendedores
        ]);
    }

    public static function eliminar(Router $router){
        if ($_SERVER['REQUEST_METHOD'] === "POST") {

            $id = $_POST['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT);
            
            if ($id) {
                $tipo = $_POST['tipo'];
                if (validarTipoContenido($tipo)){
                    $propiedad = Propiedad::find($id);
                    $propiedad->eliminar();
                }    
            }
        }
    
    }
}