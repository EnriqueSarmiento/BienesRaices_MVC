<?php

namespace Model;

class Vendedor extends ActiveRecord{
    //Conectar Base de Datos
    protected static $tabla = 'vendedores';
    protected static $columnaBD = ['id', 'nombre', 'apellido', 'telefono'];

    public $id;
    public $nombre;
    public $apellido;
    public $telefono;


    public function __construct($args = [])
    {
        $this->id = $args['id']?? null; 
        $this->nombre = $args['nombre']?? ''; 
        $this->apellido = $args['apellido']?? ''; 
        $this->telefono = $args['telefono']?? ''; 
    }

    //Validacion
    public function validar(){
    if (!$this->nombre) {
        self::$errores[] = "El nombre es obligatorio";
    }
    if (!$this->apellido) {
        self::$errores[] = "El apellido es obligatorio";
    }
    if (!$this->telefono) {
        self::$errores[] = "El telefono es obligatorio";
    }
    if (!preg_match('/[0-9]{10}/', $this->telefono)) {
        self::$errores[] = "No es un Telefono Valido";
    }
        
    return self::$errores; 
    }
   
}