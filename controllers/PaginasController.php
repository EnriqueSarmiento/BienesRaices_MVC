<?php

namespace Controllers;
use MCV\Router;
use Model\Propiedad;
use PHPMailer\PHPMailer\PHPMailer;

class PaginasController{
    public static function index(Router $router){
        $propiedades = Propiedad::get(3);
        $inicio = true;
        $router->render('/paginas/index', [
            'propiedades' => $propiedades,
            'inicio' => $inicio
        ] );
    }
    public static function nosotros(Router $router){
        $router->render('/paginas/nosotros', []);
    }
    public static function propiedades(Router $router){
        $propiedades = Propiedad::all();
       
        $router->render('/paginas/propiedades', [
            'propiedades' => $propiedades
        ]);
    }
    public static function propiedad(Router $router){
        $id = validarORedireccionar('/propiedades');
        $propiedad = Propiedad::find($id);

        $router->render('/paginas/propiedad', [
            'propiedad' => $propiedad
        ]);
    }
    public static function blog(Router $router){
        $router->render('/paginas/blog', []);
    }
    public static function entrada(Router $router){
       $router->render('/paginas/entrada', []);
    }
    public static function contacto(Router $router){

        $mensaje = ''; 

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $respuesta = $_POST['contacto'];
            //Crear una nueva instancia de la clase PHPMailer
            $mail = new PHPMailer(); 

            //Configuracion SMTP
            $mail->isSMTP();
            $mail->Host = 'smtp.mailtrap.io';
            $mail->SMTPAuth = true;
            $mail->Username = '3f1155c3f59e6f';
            $mail->Password = 'fa916f45f88c41';
            $mail->Port = 2525; 
            $mail->SMTPSecure = 'tls';

            //configurando el email
            $mail->setFrom('admin@bienesraices.com');
            $mail->addAddress('admin@bienesraices.com', 'Bienes Raices');
            $mail-> Subject = 'Tienes un nuevo email de Bienes Raices';

            //Habilitar html
            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';
            //Definir el contenido
            $contenido = '<html>'; 
            $contenido .= '<p> Tienes un nuevo mensaje </p>';
            $contenido .= '<p> Nombre: ' . $respuesta['nombre'] . '</p>';
            $contenido .= '<p> Prefiere ser contactado por: ' . $respuesta['forma'] . '</p>';

                //enviar contenido correo de forma condicional
                if($respuesta['forma'] === 'email'){
                    //si el usuario selecciono email
                    $contenido .= '<p> email: ' . $respuesta['email'] . '</p>';
                } else{
                    //si el usuario selecciono telefono
                    $contenido .= '<p> Telefono: ' . $respuesta['telefono'] . '</p>';
                    $contenido .= '<p> El dia: ' . $respuesta['fecha'] . ' A la hora: ' . $respuesta['hora'] .'</p>';
                }

            $contenido .= '<p> Mensaje: ' . $respuesta['mensaje'] . '</p>';
            $contenido .= '<p> Prefiere Venta o Compra: ' . $respuesta['tipo'] . '</p>';
            $contenido .= '<p> Precio o Presupuesto: $' . $respuesta['precio'] . '</p>';
            $contenido .= ' </html>';
            
            $mail->Body = $contenido;
            $mail->AltBody = 'Esto es texto Alternativo sin HTML'; 

            //Enviar email
            if($mail->send()){
                $mensaje = 'Mensaje Enviado Correctamente';
            }else{
                $mensaje = 'El Mensaje no se pudo enviar';
            }

        }

        $router->render('/paginas/contacto', [
            'mensaje' => $mensaje
        ]);
    }

}