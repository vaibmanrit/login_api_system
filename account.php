<?php
    /*
        localhost is the location where the server is located
        root is the global username of server
        ' ' this root has no password protection, hence empty
        my_db is db with which we want to connect
    */
          
    header('Access-Control-Allow-Origin: *');
    $con = mysqli_connect('localhost','root','','aayog') or die ('unable to connect');
    $return_arr= array();
    session_start();
   
    $phone=$_SESSION["phone"];
    $query="SELECT * FROM users WHERE phone = '$phone'";

    $result = mysqli_query($con,$query);
    $row=mysqli_fetch_array($result);
    $fname=$row['fname'];
    $lname=$row['lname'];
    
    $sex=$row['sex'];
    $email=$row['email'];
    $pass=$row['pass'];
    $return_arr= array(
        "fname" => $fname,
        "lname" => $lname,
        "phone" => $phone,
        "sex" => $sex,
        "email" => $email,
        "pass" => $pass,
    );
    echo json_encode($return_arr);
    ?>