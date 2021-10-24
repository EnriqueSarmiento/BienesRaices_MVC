<?php

namespace Model;

class Propiedad extends ActiveRecord{
    // Conectar Base de Datos
    protected static $tabla = 'propiedades'; 
    protected static $columnaBD = ['id', 'titulo', 'precio', 'imagen', 'descripcion', 'habitaciones', 'wuc', 'estacionamiento', 'creada', 'vendedorId'];

    public $id;
    public $titulo;
    public $precio;
    public $imagen;
    public $descripcion;
    public $habitaciones;
    public $wuc;
    public $estacionamiento;
    public $creada;
    public $vendedorId;

    public function __construct($args = [])
    {
        $this->id = $args['id']?? null; 
        $this->titulo = $args['titulo']?? ''; 
        $this->precio = $args['precio']?? ''; 
        $this->imagen = $args['imagen']?? ''; 
        $this->descripcion = $args['descripcion']?? ''; 
        $this->habitaciones = $args['habitaciones']?? ''; 
        $this->wuc = $args['wuc']?? ''; 
        $this->estacionamiento = $args['estacionamiento']?? ''; 
        $this->creada = date('Y/m/d'); 
        $this->vendedorId = $args['vendedorId']?? ''; 
    }

        //Validacion
    public function validar(){
        if (!$this->titulo) {
                self::$errores[] = "Debes agregar un titulo";
        }
        if (!$this->precio) {
                self::$errores[] = "Debes agregar un precio";
        }
        if (strlen($this->descripcion) < 50) {
                self::$errores[] = "Debes agregar una descripcion y debe tener al menos 50 caracteres";
        }
        if (!$this->habitaciones) {
                self::$errores[] = "Debes agregar al menos una habitacion";
        }
        if (!$this->wuc) {
                self::$errores[] = "Debes agregar al menos un baño";
        }
        if (!$this->estacionamiento) {
                self::$errores[] = "Debes agregar al menos un puesto de estacionamiento";
        }
        if (!$this->vendedorId) {
                self::$errores[] = "Debes agregar nombre del vendedor";
        }
        if (!$this->imagen) {
                self::$errores[] = 'La imagen es obligatoria';
        }
        
        return self::$errores; 
    }
   


}