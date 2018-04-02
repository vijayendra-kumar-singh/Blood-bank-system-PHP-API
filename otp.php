<?php

	$number = $_GET['number'];

	$otp = rand(100000,999999);

	function curl_get_contents($url)
	{
	  $ch = curl_init($url);
	  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	  curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	  $data = curl_exec($ch);
	  curl_close($ch);
	  return $data;
	}

	function sendOTP($number, $con, $otp){
		
		$url = "http://smsapi.engineeringtgr.com/send/?Mobile=9003692804&Password=456835459&Message=Your%20Blood%20Help%20OTP%20is%20$otp.&To=$number";

		$data = curl_get_contents($url);
		
		$r = explode("<div style", $data);
		
		$re = json_decode($r[0], true);

		// if($re['status'] != "error"){

			$q = "DROP TABLE IF EXISTS `".$number."`";
			
			mysqli_query($con,$q);
			
			$c = "CREATE TABLE `".$number."` ( `otp` INT NOT NULL )";
			
			mysqli_query($con,$c);
			
			$i = "INSERT INTO `".$number."` (`otp`) VALUES ('".$otp."')";
			
			mysqli_query($con,$i);
	
			echo json_encode(array('status'=>"success",'number'=>$number, 'otp'=>$otp));

		// } else {

		// 	echo json_encode(array('status'=>"fail",'result'=>"Server error!"));

		// }		
		
	}

	require_once('dbConnect.php');

	$sql = "SELECT * FROM users WHERE number='$number';";

	$check = mysqli_fetch_array(mysqli_query($con,$sql));

	if(isset($check)){

		echo json_encode(array('status'=>"fail",'result'=>'Phone number already registered'));

	} else {

		sendOTP($number, $con, $otp);

	}
	
 ?>