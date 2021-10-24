<?php

namespace Controllers;
use MCV\Router;
use Model\Propiedad; 
use Model\Vendedor;
use Intervention\Image\ImageManagerStatic as Image; 

class VendedorController{
    public static function crear(Router $router){
        $errores = Vendedor::getErrores(); 
        $vendedor = new Vendedor();

        if ($_SERVER['REQUEST_METHOD']=== 'POST') {

            //creando una instancia de vendedor
            $vendedor = new Vendedor($_POST['vendedor']);
    
            //validar campos de formulario
            $errores = $vendedor->validar();
    
            if (empty($errores)) {
                $vendedor->guardar();
            }
        }

        $router->render('/vendedores/crear', [
            'vendedor' => $vendedor,
            'errores' => $errores
        ]);
    }
    public static function actualizar(Router $router){
        $id = validarORedireccionar('/admin');
        //obtener datos del vendedor para el formulario
        $vendedor = Vendedor::find($id); 
        $errores = Vendedor::getErrores();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            //Asignar los valores
            $args = $_POST['vendedor']; 
            //sincronizar los datos en memoria con lo que el usuario escribio
            $vendedor->sincronizar($args); 
            //validacion
            $errores = $vendedor->validar(); 
            //guardar informacion en la bd
            if (empty($errores)) {
                $vendedor->guardar();
            }
        }
    
        $router->render('/vendedores/actualizar', [
            'vendedor' => $vendedor,
            'errores' => $errores
        ]);
    }
    public static function eliminar(){
        if ($_SERVER['REQUEST_METHOD'] === "POST") {

            $id = $_POST['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT);
            
            if ($id) {
    
                $tipo = $_POST['tipo'];
    
                if (validarTipoContenido($tipo)){
                    $vendedor = Vendedor::find($id);
                    $vendedor->eliminar();
                }    
            }
        }
        
    }
};