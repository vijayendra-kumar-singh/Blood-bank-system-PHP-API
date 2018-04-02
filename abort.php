<?php

	$number = $_GET['number'];

	require_once('dbConnect.php');

	$sql = "DROP table `".$number."`";

	$t = mysqli_query($con,$sql);

	if(!$t){
		
		echo json_encode(array('status'=>"fail"));

	} else {
		
			echo json_encode(array('status'=>"success"));
	}
	
?>