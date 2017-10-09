<?php 
	
	$number = $_GET['number'];
	
	require_once('dbConnect.php');
	
	$sql = "SELECT * FROM users WHERE number=$number";
	
	$r = mysqli_query($con,$sql);

	$check = mysqli_fetch_array(mysqli_query($con,$sql));

	if (isset($check)) {

		$result = array();
		
		$row = mysqli_fetch_array(mysqli_query($con,$sql));
	
		array_push($result,array(
				"id"=>$row['id'],
				"name"=>$row['name'],
				"age"=>$row['age'],
				"number"=>$row['number'],
				"utype"=>$row['utype'],
				"btype"=>$row['btype'],
				"pincode"=>$row['pincode']
			));
	
		echo json_encode(array('status'=>"success",'result'=>$result));
	} else {

    	echo json_encode(array('status'=>"fail", "result"=>"User not found"));
    	
    	exit();
	}
		
	mysqli_close($con);