<?php
    class Database{
        //connection vars, params
        private $host='sql11.freemysqlhosting.net';
        private $username='sql11467632';
        private $db_name='sql11467632';
        private $password='MjUn6tYTQ1';
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