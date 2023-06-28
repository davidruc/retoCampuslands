<?php 
    namespace App;
    abstract class credentials{   
        protected $dbname = 'campuslands';
        protected $host = 'localhost';
        private $user = 'root';
        private $password = '';
        public function __get($name){
            return $this->{$name};
        }
    }
?>