<?php 
	
	$name = $_GET['name'];
	$number = $_GET['number'];
    $btype = $_GET['btype'];
    $pincode = $_GET['pincode'];
    $units = $_GET['units'];
    $r_number = $_GET['r_number'];
    $date = $_GET['date'];

    $sql = "INSERT INTO requests (name,btype,units,number,pincode,date,r_number) VALUES ('$name','$btype','$units','$number','$pincode','$date','$r_number')";
    
	require_once('dbConnect.php');

	function send_notification ($tokens, $message)
	{
		$url = 'https://fcm.googleapis.com/fcm/send';
		$fields = array(
			 'registration_ids' => $tokens,
			 'data' => $message
			);
		$headers = array(
			'Authorization:key = AAAAZCS3qE4:APA91bFRQrI2ByWhKBRcpRmnQT2xpb8fFuBmY-SxCiyC1ymxje2TxLi261IMSGw1pHrhLDYQh6SueVg1DfP10IjpjhJ6OI5hu-rUykVvdlti_8MqKhfRP338T_BIdELMO1V-tfr4E47P',
			'Content-Type: application/json'
			);
	   $ch = curl_init();
       curl_setopt($ch, CURLOPT_URL, $url);
       curl_setopt($ch, CURLOPT_POST, true);
       curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
       curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
       curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);  
       curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
       curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
       $result = curl_exec($ch);           
       if ($result === FALSE) {
           die('Curl failed: ' . curl_error($ch));
       }
       curl_close($ch);
       //echo $result;
	}

	if(mysqli_query($con,$sql)){

		echo json_encode(array('status' => "success"));

		$sqli = "SELECT `token` FROM `users` WHERE `number` != '$r_number' AND `pincode` = '$pincode' AND `utype` = 'Donor' AND `btype` = '$btype'";

		$res = mysqli_query($con,$sqli);
		
		$tokens = array();
		
		if(mysqli_num_rows($res) > 0 ){
			while ($row = mysqli_fetch_assoc($res)) {
				$tokens[] = $row["token"];
			}
		}
		if(sizeOf($tokens)>0){
		$message = array("message" => "New request from $name. Check out Now!");
		send_notification($tokens, $message);
		// echo $message_status;
		}

	}else{

		echo json_encode(array('status' => "fail", 'result'=>"Server error! Try later"));
	}
	
	mysqli_close($con);
