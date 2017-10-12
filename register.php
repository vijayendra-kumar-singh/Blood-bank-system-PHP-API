<?php

	$name = $_POST['name'];
	$number = $_POST['number'];
	$age = $_POST['age'];
	$pincode = $_POST['pincode'];
	$pass = $_POST['password'];
	$btype = $_POST['btype'];
	$utype = $_POST['utype'];
	$token = $_POST['token'];
	$sex = $_POST['sex'];

	$password = password_hash($pass, PASSWORD_DEFAULT);

	require_once('dbConnect.php');

	$sql = "INSERT INTO users (name,number,age,pincode,password,btype,utype,token,sex) VALUES ('$name','$number','$age','$pincode','$password','$btype','$utype', '$token', '$sex')";

	if(mysqli_query($con,$sql)){
		
		echo json_encode(array('status'=>"success", 'result'=>$utype));
		
	}else{
		
		echo json_encode(array('status'=>"fail", 'result'=>"server error"));
		
	}
	mysqli_close($con);
