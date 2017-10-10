<?php 
	
	$pincode = $_GET['pincode'];
	$btype = $_GET['btype'];
	$number = $_GET['number'];
	
	require_once('dbConnect.php');

	$sql = "SELECT * FROM `users` WHERE `number` != '$number' AND `pincode` = '$pincode' AND `utype` = 'Donor' AND `btype` = '$btype'";
	
	$r = mysqli_query($con,$sql);
	
	$check = mysqli_fetch_array(mysqli_query($con,$sql));

	//echo $check;

	if(isset($check)){
	
		$result = array();
	
		while($row = mysqli_fetch_array($r)){
		
			array_push($result,array(
				"name"=>$row['name'],
	            "age"=>$row['age'],
	            "number"=>$row['number'],
	            "pincode"=>$row['pincode'],
				"btype"=>$row['btype'],
				"sex"=>$row['sex']
			));
		}

		if(sizeof($result)==0){

			echo json_encode(array('status'=>"fail",'result'=>"No donor found"));

		}else{

			echo json_encode(array('status'=>"success",'result'=>$result));
		}

	} else {
		echo json_encode(array('status'=>"fail",'result'=>"No donor found"));
	}

	mysqli_close($con);
