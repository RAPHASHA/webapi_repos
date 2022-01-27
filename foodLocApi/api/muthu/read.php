<?php
    //headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: Application/json');

    include_once '../..//config/Database.php';
    include_once '../../models/muthu.php';

    //DB connection
    $database = new Database();
    $db = $database->connect();

    //instantiate blog muthu object
    $muthu = new muthu($db);
    
    //blog muthu query
    $result = $muthu->read();

    //get number of rows
    $numrows = $result->rowCount();

    //checking if there are any values in the table
    if($numrows>0){
        //array for users
        $muthus_array = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)){
            extract($row);

            $muthu_item = array(
                '_ID'=>$_ID,
                '_name'=>$_name,
                '_sname'=>$_sname,
                '_email'=>$_email,
                '_pnum'=>$_pnum,
                '_pnum2'=>$_pnum2,
                '_active'=>$_active,
                '_userType'=>$_userType,
                '_password' => $_password
            );

            //push the item to the array
            array_push($muthus_array, $muthu_item);
        }

        echo json_encode($muthus_array);

    }else{
        echo json_encode(
            array('message' => ' no data found in the tabel')
        );
    }

?>