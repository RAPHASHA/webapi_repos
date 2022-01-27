<?php

    header('Access-Control-Allow-Origin: *');
    header('Content-Type: Application/json');
    header('Access-Control-Allow-Methods: DELETE');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type,
     Access-Control-Allow-Methods, Authorisation, X-Requested-With');

     include_once '../../config/Database.php';
     include_once '../../models/muthu.php';

     //connect database
     $database = new Database();
     $db = $database->connect();

     //instantiate blog muthu object
     $mt = new muthu($db);

     //get the userID 
     $data = json_decode(file_get_contents('php://input'));

     //set ID to remove user
     $mt->_ID = $data->_ID;

     //removing the user
     if($mt->deleteUser()){
         echo json_encode(
             array('message' => 'User ' . $mt->_ID . ' is removed')
            );
     }else{
         echo json_encode(
             array('message' => 'user could not be removed')    
         );
     }



?>