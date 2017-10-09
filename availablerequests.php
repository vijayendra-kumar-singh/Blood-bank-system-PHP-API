<?php 
	
	$number = $_GET['number'];
	
	require_once('dbConnect.php');
	
	$sql = "SELECT * FROM requests WHERE r_number!=$number ORDER BY `id` DESC";
	
	$r = mysqli_query($con,$sql);
	
	$check = mysqli_fetch_array(mysqli_query($con,$sql));

	if(isset($check)){
		
		$result = array();

	while($row = mysqli_fetch_array($r)){

			$time = strtotime($row['date']);
			$date = getDate($time);
			$current_date = time();

			if($date['0'] > $current_date){

				array_push($result,array(
					"name"=>$row['name'],
					"id"=>$row['id'],
		            "pincode"=>$row['pincode'],
		            "number"=>$row['number'],
		            "btype"=>$row['btype'],
		            "units"=>$row['units'],
		            "date"=>$row['date']
				));

			}
			
		}

		if(sizeof($result) != 0){

			echo json_encode(array('status'=>"success",'result'=>$result));

		} else {

			echo json_encode(array('status'=>"fail",'result'=>"No request found"));
		}

	} else {
		echo json_encode(array('status'=>"fail",'result'=>"No request found"));
	}
	
	mysqli_close($con);