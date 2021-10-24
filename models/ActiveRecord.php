<?php 

namespace Model;

class ActiveRecord{
        // conectar base de datos
        protected static $db;
        protected static $columnaBD = [];
        protected static $tabla = '';

        //Arreglo de errores
        protected static $errores = [];
    
    
        public static function setDB($database){
            self::$db = $database;
        }
    
        public function guardar(){
    
            if (!is_null($this->id)){
            //ACTUALIZAR
                $this->actualizar();
            }else{
            //CREAR 
                $this->crear();
            }
        }
        public function crear(){
            //sanitizando los atributos
            $atributos = $this->sanitizarAtributos();
            
            $string = join(', ', array_values($atributos));
    
            $query = " INSERT INTO " . static::$tabla . " ( ";
            $query .= join(', ', array_keys($atributos));
            $query .= " ) VALUES ( ' ";
            $query .= join("', '", array_values($atributos));
            $query .= " ') ";
    
            $resultado = self::$db ->query($query);
    
            //mensaje de exito
            if ($resultado) {
                //redireccionando al usuario
                header('Location: /admin?resultado=1');
            }
    
        }
        public function actualizar(){
            //sanitizando los atributos
            $atributos = $this->sanitizarAtributos();
    
            $valores = [];
            foreach ($atributos as $key => $value) {
                $valores[] = "{$key}='$value'";
            }
    
            $query = "UPDATE " . static::$tabla . " SET ";
            $query.= join(', ',$valores);
            $query .= " WHERE id = '" . self::$db->escape_string($this->id) . "' ";
            $query .= " LIMIT 1 "; 
    
            $resultado = self::$db->query($query);
    
            if ($resultado) {
                //redireccionando al usuario
                header('Location: /admin?resultado=2');
            }
        }
        //eliminar el registro
        public function eliminar(){
            $query = " DELETE FROM " . static::$tabla ." WHERE id = " . self::$db->escape_string($this->id) . " LIMIT 1";
            
            $resultado = self::$db->query($query);
            if ($resultado) {
                $this->borrarImagen();
                header('location: /admin?resultado=3');
            }
        }
    
        //identificar y unir elementos de la base de datos. 
        public function atributos(){
            $atributos = [];
            foreach(static::$columnaBD as $columna){
                if ($columna === 'id') continue;
                $atributos[$columna] = $this->$columna; 
            }
            return $atributos;
        }
    
        public function sanitizarAtributos(){
            $atributos = $this->atributos();
            $sanitizado = [];
    
            foreach ($atributos as $key => $value) {
                $sanitizado[$key] = self::$db->escape_string($value);
            }
            return $sanitizado;
        }
        // subida de archivos
        public function setImagen($imagen){
            //elimina la imagen previa
            if(!is_null($this->id)){
                $this->borrarImagen();
            }
    
            //asignar al atributo de imagen el nombre de la imagen
            $this->imagen = $imagen; 
        }
        // eliminar archivos
        public function borrarImagen(){
            //comprobar que si existe el archivo
            $existeArchivo = file_exists(CARPETA_IMAGENES . $this->imagen);
            if($existeArchivo){
                unlink(CARPETA_IMAGENES . $this->imagen);
            }   
        }
    
        // arreglo errores
        public static function getErrores(){
            return static::$errores;
        }
    
        //Validacion
        public function validar(){
            static::$errores = []; 
            return static::$errores;
        }
        // lISTA TODAS Los registros
        public static function all(){
            $query = " SELECT * FROM " . static::$tabla;
    
            $resultado = self::consultaSQL($query);
    
            return $resultado;
        }
        // lISTA cant ESPECIFICA de registros
        public static function get($cantidad){
            $query = " SELECT * FROM " . static::$tabla . " LIMIT " . $cantidad;
    
            $resultado = self::consultaSQL($query);
    
            return $resultado;
        }
    
        // BUSCA UN REGISTRO POR SU ID
        public static function find($id){
            $query = " SELECT * FROM " . static::$tabla ." WHERE id = ${id} ";
    
            $resultado = self::consultaSQL($query);
    
             return array_shift($resultado);
        }
    
        public static function consultaSQL($query){
            //consultar la base de datos
            $resultado = self::$db->query($query);
            //iterar los resultados
            $array =[];
            while ($registro = $resultado->fetch_assoc()){
                $array[] = static::crearObjeto($registro);
            }
    
            //liberal la memoria
            $resultado->free();
    
            //retornar los resultados
            return $array;
        }
    
        protected static function crearObjeto($registro){
            $objeto = new static; 
    
            foreach ($registro as $key => $value) {
                if (property_exists( $objeto, $key )) {
                   $objeto->$key = $value; 
                }
            }
    
            return $objeto;
        }
        //sincronizar o actualiza el objeto en memoria con los cambios realizados por el usuario
        public function sincronizar( $args = [] ){
    
            foreach ($args as $key => $value) {
                if(property_exists($this, $key) && !is_null($value)){
                    $this->$key = $value; 
                }
            }
        }
}