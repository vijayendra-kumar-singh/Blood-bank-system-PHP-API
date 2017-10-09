<?php

	$number = $_GET['number'];
	$otp = $_GET['otp'];

	require_once('dbConnect.php');

	$sql = "SELECT * FROM `".$number."` WHERE otp='".$otp."';";

	$check = mysqli_fetch_array(mysqli_query($con,$sql));

	if(isset($check)){

		$pass = rand(100000,999999);

		$password = password_hash($pass, PASSWORD_DEFAULT);

		$q = "UPDATE users SET password = '$password' WHERE number = $number;";
		
			if(mysqli_query($con,$q)){

				$newURL = "https://smsapi.engineeringtgr.com/send/?Mobile=9003692804&Password=456835459&Message=Your new password is '$pass'&To=$number";

				echo json_encode(array('status'=>"success", 'result'=>$pass));

				//header('Location: '.$newURL);

			} else {

				echo json_encode(array('status'=>"fail", 'result' => "Server error"));
			}
		
	} else {
		
		echo json_encode(array('status'=>"fail", 'result'=>"Wrong OTP"));
	}

	$d = "DROP table `".$number."`";

	mysqli_query($con,$d);