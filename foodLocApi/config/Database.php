<?php
    class Database{
        //connection vars, params
        private $host='localhost';
        private $username='raphasha';
        private $db_name='foodlocdb';
        private $password='yyDVrgL8ndtw8T49';
        private $conn;

        public function connect(){

            $this->conn = null;

            try{
                $this->conn = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db_name, $this->username, $this->password);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            }catch(PDOException $e){
                echo 'no connection erro:' . $e->getMessage();
            }

            return $this->conn;

        }



    }
?>