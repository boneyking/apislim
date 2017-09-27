<?php 
    class PatronSingleton{
        private static $_instancia;
        private $_conexion;

        public static function Singleton(){
            if(!isset(self::$_instancia)){
                self::$_instancia = new self;
            }
            return self::$_instancia;
        }

        public function __construct(){
            $this->_conexion = new PDO("mysql:host=127.0.0.1;dbname=misclientes", "root", "admindev001");
        }

        public function __clone(){
			trigger_error('La clonación de este objeto no está permitida', E_USER_ERROR);
        }
        
        public function GetAll($query, $entity){
			$consulta = $this->_conexion->prepare($query);
			$consulta->execute();
			if($consulta->rowCount() > 0){
                $this->entity = $consulta->fetchAll(PDO::FETCH_OBJ);
				return $this->entity;
            }            
        }
        
        public function GetById($query, $entity){
			$consulta = $this->_conexion->prepare($query);
			$consulta->execute();
			if($consulta->rowCount() > 0){
                $this->entity = $consulta->fetchAll(PDO::FETCH_OBJ);
				return $this->entity;
            }
        }
        
        public function Add($query, $params){
            $stmt = $this->_conexion->prepare($query);
            $stmt->bindParam(':nombre', $params[0]);
            $stmt->bindParam(':apellidos', $params[1]);
            $respuesta = $stmt->execute();
            return $respuesta;
        }

        public function Update($query, $params){
            $stmt = $this->_conexion->prepare($query);
            $stmt->bindParam(':nombre', $params[0]);
            $stmt->bindParam(':apellidos', $params[1]);
            $respuesta = $stmt->execute();
            return $respuesta;
        }

        public function Delete($query){
            $stmt = $this->_conexion->prepare($query);
            $respuesta = $stmt->execute();
            return $respuesta;
        }
    }
?>