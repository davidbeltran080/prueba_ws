<?php
    class conexion extends PDO{

        private $hostBd  = '127.0.0.1';
        private $port = '3306';
        private $nombreBd = 'ws_creditos';
        private $usuarioBd = 'root';
        private $passBd = '' ;

        public function __construct(){
            try{
                parent::__construct ('mysql:host=' . $this->hostBd . ';port=' . $this->port . ';dbname=' . $this->nombreBd . ';charset=utf8',$this->usuarioBd,$this->passBd , array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));

            }catch(PDOException $e){
                echo 'Eerror:'. $e->getMessage();
                exit;

            }
        }

    }

?>