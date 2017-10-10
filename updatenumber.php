<?php

	$number = $_GET['number'];
	$base_number = $_GET['base'];
	$otp = $_GET['otp'];

	require_once('dbConnect.php');

	$sql = "SELECT * FROM `".$number."` WHERE otp='".$otp."';";

	$check = mysqli_fetch_array(mysqli_query($con,$sql));

	if(isset($check)){

		$q = "UPDATE users SET number = '$number' WHERE number = $base_number;";
		
			if(mysqli_query($con,$q)){

				$qq = "UPDATE requests SET r_number = '$number' WHERE r_number = $number;";

				mysqli_query($con,$qq);

				echo json_encode(array('status'=>"success", 'number'=>$number));

			} else {

				echo json_encode(array('status'=>"fail", 'result' => "Server error"));
			}
		
	} else {
		
		echo json_encode(array('status'=>"fail", 'result'=>"Wrong OTP"));
	}

	$d = "DROP table `".$number."`";
	
	mysqli_query($con,$d);
