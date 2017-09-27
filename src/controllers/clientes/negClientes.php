<?php
    require '../src/config/PatronSingleton.php';

    class NegClientes{
        public function GetAll(){
            $consulta = 'select * from clientes';
            $clientes = array();
            try{
                $nuevoSingleton = PatronSingleton::Singleton();
                $clientes = $nuevoSingleton->GetAll($consulta, $clientes);
                if(is_null($clientes))
                    $clientes = '{"error": {"message": "no hay registros"} }';
                return $clientes;
            }catch(PDOEXCEPTION $e){
                $clientes = '{"error": {"text": '.$e->getMessage().'} }';
            }
        }

        public function GetById($id){
            $consulta = 'select * from clientes where id =' . $id .'';
            $cliente = array();
            try{
                $nuevoSingleton = PatronSingleton::Singleton();
                $cliente = $nuevoSingleton->GetAll($consulta, $cliente);
                if(is_null($cliente))
                    $cliente = '{"error": {"message": "no hay registros"} }';
                return $cliente;
            }catch(PDOEXCEPTION $e){
                $cliente = '{"error": {"text": '.$e->getMessage().'} }';
            }
        }

        public function Add($params){
            $consulta = 'insert into clientes(nombre, apellidos) values(:nombre, :apellidos)';
            $respuesta = null;
            try{
                $nuevoSingleton = PatronSingleton::Singleton();
                $respuesta = $nuevoSingleton->Add($consulta, $params);
            }catch(PDOEXCEPTION $E){
                $respuesta = '{"error": {"text": '.$e->getMessage().'} }';
            }
            return $respuesta;
        }

        public function Update($id, $params){
            $consulta = 'update clientes set nombre = :nombre, apellidos = :apellidos where id = ' . $id .'';
            $respuesta = null;
            try{
                $nuevoSingleton = PatronSingleton::Singleton();
                $respuesta = $nuevoSingleton->Update($consulta, $params);
            }catch(PDOEXCEPTION $E){
                $respuesta = '{"error": {"text": '.$e->getMessage().'} }';
            }
            return $respuesta;
        }

        public function Delete($id){
            $consulta = 'delete from clientes where id = ' . $id .'';
            $respuesta = null;
            try{
                $nuevoSingleton = PatronSingleton::Singleton();
                $respuesta = $nuevoSingleton->Delete($consulta);
            }catch(PDOEXCEPTION $E){
                $respuesta = '{"error": {"text": '.$e->getMessage().'} }';
            }
            return $respuesta;
        }
    }

?>