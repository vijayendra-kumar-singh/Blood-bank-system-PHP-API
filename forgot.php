<?php

	$number = $_GET['number'];
	$otp = $_GET['otp'];

	require_once('dbConnect.php');

	$sql = "SELECT * FROM `".$number."` WHERE otp='".$otp."';";

	$check = mysqli_fetch_array(mysqli_query($con,$sql));

	if(isset($check)){

		$pass = rand(1000,9999);

		$password = password_hash($pass, PASSWORD_DEFAULT);

		$q = "UPDATE users SET password = '$password' WHERE number = $number;";
		
			if(mysqli_query($con,$q)){

				echo json_encode(array('status'=>"success", 'result'=>$pass));

			} else {

				echo json_encode(array('status'=>"fail", 'result' => "Server error"));
			}
		
	} else {
		
		echo json_encode(array('status'=>"fail", 'result'=>"Wrong OTP"));
	}

	$d = "DROP table `".$number."`";

	mysqli_query($con,$d);
