<?php
    header('Access-Allow-Control-Origin: *');
    header('Content-Type: Application/json');

    include_once '../../config/Database.php';
    include_once '../../models/muthu.php';

    //DB connection
    $database = new Database();
    $db = $database->connect();

    //instantiate blog muthu object
    $muthu = new muthu($db);

    //get the email
    $muthu->_email = isset($_GET['_email']) ? $_GET['_email'] : die();
    $muthu->_password = isset($_GET['_password']) ? $_GET['_password'] : die();

    //get muthu object
    $muthu->login();


    //create muthu object

    $muthu_obj = array(
        '_ID' => $muthu->_ID,
        '_name' => $muthu->_name,
        '_sname' => $muthu->_sname,
        '_email' => $muthu->_email,
        '_pnum' => $muthu->_pnum,
        '_pnum2' => $muthu->_pnum2,
        '_active' => $muthu->_active,
        '_userType' => $muthu->_userType,
        '_password' => $muthu->_password,
    );

    print_r(json_encode($muthu_obj));
?>