<?php
    //headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: Aplication/json');
    header('Access-Control-Allow-Methos: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type, Access-Control-Allow-Methods, Authorisation, X-requested-With');

    include_once '../../config/Database.php';
    include_once '../../models/muthu.php';

    //initiate database
    $database = new Database();
    $db = $database->connect();

    //instantiate blog muthu object
    $mt = new muthu($db);

    //get raw posted data
    $data = json_decode(file_get_contents('php://input'));

    $hashed_password = sha1($data->_password);

    $mt->_name = $data->_name;
    $mt->_sname = $data->_sname;
    $mt->_pnum = $data->_pnum;
    $mt->_email = $data->_email;
    $mt->_password = $hashed_password;
    $mt->_active = $data->_active;
    $mt->_userType = $data->_userType;

    if($mt->create_user()){
        echo json_encode(
            array('message' => 'muthu added to the database')
        );
    }else{
        echo json_encode(
            array('message' => 'muthu not added')
        );
    }

?>