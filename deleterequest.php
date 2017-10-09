<?php 

	$id = $_GET['id'];
	
	require_once('dbConnect.php');
	
	$sql = "DELETE FROM requests WHERE id=$id;";
	
	if(mysqli_query($con,$sql)){

		echo json_encode(array('status'=>"success"));

	}else{
		
		echo json_encode(array('status'=>"fail"));
	}
	
	mysqli_close($con);