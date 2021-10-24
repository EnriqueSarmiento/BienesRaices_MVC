<?php

namespace Model;

class Admin extends ActiveRecord{
    protected static $tabla = 'usuarios';
    protected static $columnasDB = ['id', 'email', 'password'];  

    public $id;
    public $email;
    public $password; 

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->email = $args['email'] ?? '';
        $this->password = $args['password'] ?? '';
    }

    public function validar(){
        if(!$this->email){
            self::$errores[] = 'Es necesario un correo electronico';
        }
        if(!$this->password){
            self::$errores [] = 'Es necesario una contrasena';
        }

        return self::$errores;
    }

    public function usuarioExiste(){
        //Query poasa consultar la base de datos
        $query = "SELECT * FROM ". self::$tabla. " WHERE email = '" . $this->email."' LIMIT 1 "; 

        //consultando
        $resultado = self::$db->query($query); 

        if (!$resultado->num_rows) {
            self::$errores[] = 'El usuario NO existe';
            return; 
        }

        return $resultado; 
    }

    public function comprobarPassword($resultado){
        $usuario = $resultado->fetch_object(); 

        //verifica el password
        $autenticado = password_verify($this->password, $usuario->password); 

        if(!$autenticado){
            self::$errores[] = 'El Password no es correcto';
        }
        
        return $autenticado; 
    }

    public function autenticar(){
        session_start(); 

        //Llenamos el arreglo de session
        $_SESSION['usuario'] = $this->email;
        $_SESSION['login'] = true; 

        //redireccionar al usuario
        header('location: /admin'); 
    }
}