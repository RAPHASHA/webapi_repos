<?php
    class muthu{
        //properties for the muthu table 
        private $conn; 
        private $table = 'UserT';
         //properties for a muthu object
        public $_ID;
        public $_name;
        public $_sname;
        public $_pnum;
        public $_email; 
        public $_active;
        public $_userType;
        public $_password;
        
        function __construct($db)
        {
            $this->conn = $db;
        }
        
        //function to retrieve all users
        public function read(){
            $query = 'SELECT _ID, _name, _sname, _pnum, _email, _active, _userType, _password FROM ' . $this->table;
            
            $stmt = $this->conn->prepare($query);

            $stmt->execute();

            return $stmt;
        }

        //function to get user by ID
        public function read_user(){
            $query = 'SELECT _ID, _name, _sname, _email, _pnum, _active, _userType, _password FROM ' . $this->table .' WHERE _ID= ?';

            $stmt = $this->conn->prepare($query);

            //bind ID
            $stmt->bindParam(1, $this->_ID);

            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            //set params
            $this->_ID = $row['_ID'];
            $this->_name = $row['_name'];
            $this->_sname = $row['_sname'];
            $this->_email = $row['_email'];
            $this->_pnum = $row['_pnum'];
            $this->_active = $row['_active'];
            $this->_userType = $row['_userType'];
            $this->_password = $row['_password'];
        
        }

        //user login
        public function login(){
            $query = 'SELECT _ID, _name, _sname, _email, _pnum, _active, _userType, _password FROM ' . $this->table .' WHERE _email= ? ';

            $stmt = $this->conn->prepare($query);

            //bind email and password
            $stmt->bindParam(1, $this->_email);
            //$stmt->bindParam(2,$this->_password);

            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            $hash_pass = sha1($this->_password);
            
            if($hash_pass == $row['_password']){
                //set params
                $this->_ID = $row['_ID'];
                $this->_name = $row['_name'];
                $this->_sname = $row['_sname'];
                $this->_email = $row['_email'];
                $this->_pnum = $row['_pnum'];
                $this->_active = $row['_active'];
                $this->_userType = $row['_userType'];
                $this->_password = $row['_password'];
            }else{
                $this->_ID = null;
                $this->_name = null;
                $this->_sname = null;
                $this->_email = null;
                $this->_pnum = null;
                $this->_active = null;
                $this->_userType = null;
                $this->_password = null;
            }

            
        }

        //create a user
        public function create_user(){

            $query = 'INSERT INTO ' . $this->table . ' set _name = :name, _sname = :sname, _email = :email, 
            _pnum = :pnum, _active = :active, _userType = :userType, _password = :password';

            $stmt = $this->conn->prepare($query);
            
            //clean data
            $this->_name = htmlspecialchars($this->_name);
            $this->_sname = htmlspecialchars($this->_sname);
            $this->_email = htmlspecialchars($this->_email);
            $this->_pnum = htmlspecialchars($this->_pnum);
            $this->_active = htmlspecialchars($this->_active);
            $this->userType = htmlspecialchars($this->_userType);
            $this->_password = htmlspecialchars($this->_password);

            //bind data
            $stmt->bindParam(':name', $this->_name);
            $stmt->bindParam(':sname', $this->_sname);
            $stmt->bindParam(':email', $this->_email);
            $stmt->bindParam(':pnum', $this->_pnum);
            $stmt->bindParam(':active', $this->_active);
            $stmt->bindParam(':password', $this->_password);
            $stmt->bindParam(':userType', $this->_userType);
            

            if($stmt->execute()){
                return true;
            }

            //if something goes wrong
            printf("the error", $stmt->error);

            return false;
            

        }

        //delete user
        public function deleteUser(){

            $query = 'DELETE FROM ' . $this->table . ' WHERE _ID = :_ID';

            //prepare a statemetn 
            $stmt = $this->conn->prepare($query);


            //clean data
            $this->_ID = htmlspecialchars(strip_tags($this->_ID));

            //bind data
            $stmt->bindParam(':_ID', $this->_ID);

            //execute query
            if($stmt->execute()){
                return true;
            }
            //if something goes wrong
            printf('Error: ', $stmt->error);
            return false;


        }

        //update user details
        public function update(){
            $query = 'UPDATE ' . $this->table . ' SET  _name = :_name, _sname = :_sname,
             _email = :_email, _pnum = :_pnum, _active = :_active, _userType = :_userType,
              _password = :_password WHERE _ID = :_ID';

            //prepare statement
            $stmt = $this->conn->prepare($query);

            //clean data
            $this->_name = htmlspecialchars(strip_tags($this->_name));
            $this->_sname = htmlspecialchars(strip_tags($this->_sname));
            $this->_email = htmlspecialchars(strip_tags($this->_email));
            $this->_pnum = htmlspecialchars(strip_tags($this->_pnum));
            $this->userType = htmlspecialchars(strip_tags($this->_userType));
            $this->_password = htmlspecialchars(strip_tags($this->_password));
            $this->_active = htmlspecialchars(strip_tags($this->_active));
            $this->_ID =htmlspecialchars((strip_tags($this->_ID)));

            //bind data
            $stmt->bindParam(':_name', $this->_name);
            $stmt->bindParam(':_sname', $this->_sname);
            $stmt->bindParam(':_email', $this->_email);
            $stmt->bindParam(':_pnum', $this->_pnum);
            $stmt->bindParam(':_active', $this->_active);
            $stmt->bindParam(':_userType', $this->_userType);
            $stmt->bindParam(':_password', $this->_password);
            $stmt->bindParam(':_ID', $this->_ID);

            //execution
            if($stmt->execute()){
                return true;
            }

            //if something goes wrong
            printf("Error ya hone i ya baiza ", $stmt->error);
            return false;
        }

    }
?>