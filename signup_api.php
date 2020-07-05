<?php
    /*
        localhost is the location where the server is located
        root is the global username of server
        ' ' this root has no password protection, hence empty
        my_db is db with which we want to connect
    */
    header('Access-Control-Allow-Origin: *');
    $con = mysqli_connect('localhost','root','','aayog') or die ('unable to connect');
    $fname1 = $_POST['fname'];
    $fname = filter_var($fname1, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
    $lname1 = $_POST['lname'];
    $lname = filter_var($lname1, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
    $phone = $_POST['phone'];
    $sex = $_POST['sex'];
    $email1 = $_POST['email'];
    $email = filter_var($email1, FILTER_SANITIZE_EMAIL);
    $pass  = $_POST['pass'];
    $check="SELECT * FROM users WHERE phone = '$phone'";
    $row = mysqli_num_rows(mysqli_query($con,$check));
        if ($row>=1)
        {
            $return = array(
                'status' => 403,
                'message' => "User already exists."
            );
            http_response_code(403);
            print_r(json_encode($return));
        }
     else
        {   
            $sql = "INSERT INTO `users`(`fname`,`lname`,`phone`,`sex`,`email`,`pass`) VALUES('$fname','$lname','$phone','$sex','$email','$pass')";
             
            $result = mysqli_query($con,$sql);
            
            $return = array(
                'status' => 200,
                'message' => "Login Successful."
            );
            http_response_code(200);
            if($result) {
               session_start(); 
                $_SESSION["phone"] = $phone ;
               print_r(json_encode((object)$return));
            } 
            else {
                echo "unable to insert data";
            }
        }	
?>