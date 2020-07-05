<?php
    /*
        localhost is the location where the server is located
        root is the global username of server
        ' ' this root has no password protection, hence empty
        my_db is db with which we want to connect
    */
    header('Access-Control-Allow-Origin: *');
    $con = mysqli_connect('localhost','root','','aayog') or die ('unable to connect');
    $phone = $_POST['phone'];
    $pass  = $_POST['pass'];
    $check="SELECT * FROM users WHERE phone = '$phone' AND pass = '$pass'";
    $row = mysqli_num_rows(mysqli_query($con,$check));
        if ($row>=1)
        {
            $return = array(
                'stat' => 200,
                'message' => "Successful Login"
            );
            session_start(); 
            $_SESSION["phone"] = $phone ;
            print_r(json_encode($return));
        }
     else
        {    
            $return = array(
                'stat' => 403,
                'message' => " No User Exists"
            );
          print_r(json_encode((object)$return));
        }   
?>