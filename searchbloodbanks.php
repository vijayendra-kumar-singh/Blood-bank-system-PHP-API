<?php 
	
	$filter = $_GET['filter'];
	$value = $_GET['value'];
	
	require_once('dbConnect.php');

	$sql = "SELECT * FROM `blood_banks` WHERE `$filter` = '$value' ";

  $r = mysqli_query($con,$sql);

  if(!$r){

    echo json_encode(array('status'=>"fail",'result'=>"No BLood bank found"));
    
    exit();
  }

	$result = array();
	
  while($row = mysqli_fetch_array($r)){
  
    array_push($result,array(
      
      "name"=>$row['name'],
      "address"=>$row['address'],
      "state"=>$row['state'],
      "city"=>$row['city'],
      "district"=>$row['district'],
      "pincode"=>$row['pincode'],
      "contact"=>$row['contact'],
      "mobile"=>$row['mobile'],
      "email"=>$row['email'],
      "website"=>$row['website'],
      "component"=>$row['component'],
      "apheresis"=>$row['apheresis'],
      "license"=>$row['license'],
      "lat"=>$row['lat'],
      "lng"=>$row['lng']

    ));
  }

  if(sizeof($result)==0){

    echo json_encode(array('status'=>"fail",'result'=>"No BLood bank found"));

  }else{

    echo json_encode(array('status'=>"success",'result'=>$result, 'filter'=>$filter, 'value'=>$value));
  }

  mysqli_close($con);
?>