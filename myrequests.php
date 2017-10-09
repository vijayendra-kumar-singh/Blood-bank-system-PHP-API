<?php 

	$number = $_GET['number'];
	
	require_once('dbConnect.php');
	
	$sql = "SELECT * FROM requests WHERE r_number=$number";
	 
	$r = mysqli_query($con,$sql);
	
	$check = mysqli_fetch_array(mysqli_query($con,$sql));
	
	if(isset($check)){
		
		$result = array();
	
		while($row = mysqli_fetch_array($r)){
		
			array_push($result,array(
				"id"=>$row['id'],
				"name"=>$row['name'],
	            "pincode"=>$row['pincode'],
	            "number"=>$row['number'],
	            "btype"=>$row['btype'],
	            "units"=>$row['units'],
	            "date"=>$row['date']
			));
		}

		if(sizeof($result)==0){

			echo json_encode(array('status'=>"fail",'result'=>"No request found"));

		}else{

			echo json_encode(array('status'=>"success",'result'=>$result));
		}

	} else {

		echo json_encode(array('status'=>"fail",'result'=>"No request found"));

	}
	
	mysqli_close($con);