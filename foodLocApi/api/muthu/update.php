<?php

    header('Access-Control-Allow-Origin: *');
    header('Content-Type: Application/json');
    header('Access-Control-Allow-Methods: PUT');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requsted-With');

     include_once '../../config/Database.php';
     include_once '../../models/muthu.php';

     //connect to database
     $database = new Database();
     $db = $database->connect();

     //muthu obj
     $mt = new muthu($db);

     //get data
     $data = json_decode(file_get_contents('php://input'));

     //encrypt password
     $hashed_password = sha1($data->_password);

     //set values to update
     $mt->_ID = $data->_ID;
     $mt->_name = $data->_name;
     $mt->_sname = $data->_sname;
     $mt->_email = $data->_email;
     $mt->_pnum = $data->_pnum;
     $mt->_pnum2 = $data->_pnum2;
     $mt->_active = $data->_active;
     $mt->_userType = $data->_userType;
     $mt->_password = $hashed_password;
     
     if($mt->update()){
         echo json_encode(
             array('User '. $mt->_ID . ' updated')
         );
     }else{
         echo json_encode(
             array('User not updated')
         );
     }

?>