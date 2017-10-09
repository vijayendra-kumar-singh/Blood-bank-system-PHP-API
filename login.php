<?php 
	
	$number = $_GET['number'];
	$pass = $_GET['password'];
	
	$sql = "SELECT password FROM users WHERE number='$number'";
	
	require_once('dbConnect.php');
	
	$check = mysqli_fetch_array(mysqli_query($con,$sql));
	
	if(isset($check)){

		$password = $check['password'];

		if (password_verify($pass, $password)) {

			$s = "SELECT utype FROM users WHERE number='$number'";

			$ch = mysqli_fetch_array(mysqli_query($con,$s));

			$u = $ch['utype'];

 		   echo json_encode(array('status'=>"success", 'utype'=>$u));
		} else {
    		echo json_encode(array('status'=>"Wrong password"));
		}
	}else{
		echo json_encode(array('status'=>"no such user"));
	}
	mysqli_close($con);


	