<?php

    $name = $_GET['name'];
    $number = $_GET['number'];
    $age = $_GET['age'];
    $pincode = $_GET['pincode'];
    $pass = $_GET['password'];
    $btype = $_GET['btype'];
    $utype = $_GET['utype'];
    $token = $_GET['token'];
    $sex = $_GET['sex'];

    $password = password_hash($pass, PASSWORD_DEFAULT);

    require_once('dbConnect.php');

    $sql = "INSERT INTO users (name,number,age,pincode,password,btype,utype,token,sex) VALUES ('$name','$number','$age','$pincode','$password','$btype','$utype', '$token', '$sex')";

    if(mysqli_query($con,$sql)){

        echo json_encode(array('status'=>"success", 'result'=>$utype, 'QUERY'=>$sql));

    }else{
        
        echo json_encode(array('status'=>"fail", 'result'=>"server error", 'QUERY'=>$sql));
    }
    mysqli_close($con);
