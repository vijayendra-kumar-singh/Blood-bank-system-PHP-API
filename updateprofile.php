<?php 
	$pass = $_GET['password'];
	$id = $_GET['id'];
	$name = $_GET['name'];
	$age = $_GET['age'];
    $pincode = $_GET['pincode'];
    $utype = $_GET['utype'];
    $btype = $_GET['btype'];

    $password = password_hash($pass, PASSWORD_DEFAULT);
	
	require_once('dbConnect.php');

	$qq = "SELECT password FROM users WHERE id='$id'";

	$chk = mysqli_fetch_array(mysqli_query($con,$qq));

	if(isset($chk)){

		$password = $chk['password'];

		if (password_verify($pass, $password)) {

			$q = "UPDATE users SET name = '$name', age = '$age', btype = '$btype', pincode = '$pincode', utype = '$utype' WHERE id = $id;";
		
			if(mysqli_query($con,$q)){

				echo json_encode(array('status'=>"success", 'utype'=>$utype));

			} else {
				
				echo json_encode(array('status'=>"fail", 'result' => "Server error"));
			}

		} else {
    		
    		echo json_encode(array('status'=>"fail", 'result' => "Wrong password"));
		
		}

	} else {
	
		echo json_encode(array('status'=>"fail", 'result' => "No such user"));
	
	}

	mysqli_close($con);