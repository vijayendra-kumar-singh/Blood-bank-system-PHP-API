<?php

	$number = $_GET['number'];

	$otp = rand(100000,999999);

	require_once('dbConnect.php');

	$sql = "SELECT * FROM users WHERE number='$number';";

	$check = mysqli_fetch_array(mysqli_query($con,$sql));

	if(isset($check)){

		$q = "DROP TABLE IF EXISTS `".$number."`";
		
		mysqli_query($con,$q);
		
		$c = "CREATE TABLE `".$number."` ( `otp` INT NOT NULL )";
		
		mysqli_query($con,$c);
		
		$i = "INSERT INTO `".$number."` (`otp`) VALUES ('".$otp."')";
		
		mysqli_query($con,$i);

		$otpUrl = "Location:http://smsapi.engineeringtgr.com/send/?Mobile=9003692804&Password=456835459&Message=Your Blood Help OTP is ".$otp."&To=".$number;

		echo json_encode(array('status'=>"success",'number'=>$number, 'otp'=>$otp));

	} else {

		echo json_encode(array('status'=>"fail", 'result' => "No such user"));

	}
 
 ?>