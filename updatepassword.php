<?php 
	$number = $_GET['number'];
	$old = $_GET['old'];
	$new = $_GET['new'];
	
	$newpassword = password_hash($new, PASSWORD_DEFAULT);

	require_once('dbConnect.php');

	$sql = "SELECT password FROM users WHERE number='$number'";

	$check = mysqli_fetch_array(mysqli_query($con,$sql));

	if(isset($check)){

		$password = $check['password'];
		if (password_verify($old, $password)) {
 		    $q = "UPDATE users SET password = '$newpassword' WHERE number = $number;";
			if(mysqli_query($con,$q)){
				echo json_encode(array('status'=>"success"));
			} else {
				echo json_encode(array('status'=>"fail", 'result'=>"server error"));
			}
		} else {
			echo json_encode(array('status'=>"fail", 'result' => "Wrong password"));
		}
	} else {
		echo json_encode(array('status'=>"fail", 'result' => "No such user"));
	}
	mysqli_close($con);
