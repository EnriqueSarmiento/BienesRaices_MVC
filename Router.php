<?php 

namespace MCV;

class Router{
    //todas las rutas
    public $rutasGET = [];
    public $rutasPOST = []; 

    public function get($url, $fn){
        $this->rutasGET[$url] = $fn; 
    }

    public function post($url, $fn){
        $this->rutasPOST[$url] = $fn; 
    }


    public function comprobarRutas(){
        session_start();
        //autenticacion de usuario
        $auth = $_SESSION['login']?? null; 

        //RUTAS PROTEGIDAS PARA ZONA ADMINISTRATIVA
        $rutasProtegidas = ['/admin', '/propiedades/crear', '/propiedades/actualizar', '/propiedades/eliminar', '/vendedores/crear', '/vendedores/actualizar', '/vendedores/eliminar']; 

        $urlActual = $_SERVER['PATH_INFO'] ?? "/"; 
        $metodo = $_SERVER['REQUEST_METHOD']; 

        if($_SERVER['REQUEST_METHOD'] === 'GET'){
            $fn = $this->rutasGET[$urlActual] ?? null;
        }else{
            $fn = $this->rutasPOST[$urlActual] ?? null;    
        }

        //Proteger las vistas
        if(in_array($urlActual, $rutasProtegidas) && !$auth){
            header('Location: /');
        }

        if($fn){
           // existe una funcion asociada
           call_user_func($fn, $this);
        }else{
            echo 'Pagina no encontrada. ERROR 404';
        }
    }

    public function render($view, $datos = []){
        //leyendo datos del arreglo $datos
        foreach($datos as $key => $value ){
            $$key = $value; 
        }

        ob_start(); //almacenando datos en memoria
        include_once __DIR__ . "/views/$view.php";
        $contenido = ob_get_clean(); //vaciando memoria y reasignado los datos a esta variable

        include_once __DIR__ . "/views/layout.php"; 
    }
}