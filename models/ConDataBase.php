<?php
    class ConDataBase{      
         
        public $conn;
        
        public function __construct() {
            $host = "localhost";
            $user = "root";
            $pass = "";
            $db = "crud_table"; // DB name in myPHP //
            $this->conn = new mysqli($host, $user, $pass, $db);
        }   
    }
?>