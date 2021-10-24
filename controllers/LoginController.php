<?php

namespace Controllers;
use MCV\Router;
use Model\Admin; 

class LoginController{

    public static function login(Router $router){
        $errores = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $auth = new Admin($_POST);

            $errores = $auth->validar();

            if (empty($errores)) {
                //verificar si el usuario existe
                $resultado = $auth->usuarioExiste();
                if(!$resultado){
                    $errores = Admin::getErrores();
                }else{
                //verificar el password
                    $autenticado = $auth->comprobarPassword($resultado);
                    if (!$autenticado) {
                        $errores = Admin::getErrores();
                    }else{
                      //autenticar el usuario
                        $auth->autenticar(); 
                    }
                }
            }
        }

        $router->render('auth/login', [
            'errores' => $errores
        ]);
    }
    public static function logout(){
        session_start();

        //eliminado el contenido del arreglo session
        $_SESSION = []; 

        header('Location: /');
    }
    
}