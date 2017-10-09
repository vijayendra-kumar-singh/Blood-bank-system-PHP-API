<?php

	$number = $_GET['number'];
	$otp = $_GET['otp'];

	require_once('dbConnect.php');

	$sql = "SELECT * FROM `".$number."` WHERE otp='".$otp."';";

	$check = mysqli_fetch_array(mysqli_query($con,$sql));

	if(isset($check)){
		
		echo json_encode(array('status'=>"success", 'number'=>$number));
	
	} else {
		
		echo json_encode(array('status'=>"fail", 'result'=>"server error"));
	}

	$d = "DROP table `".$number."`";

	mysqli_query($con,$d);
 ?>