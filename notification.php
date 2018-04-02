<?php 
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
       return $result;
	}
	
	require_once('dbConnect.php');
	$sql = "select token From users Where id='26'";
	$result = mysqli_query($con,$sql);
	$tokens = array();
	if(mysqli_num_rows($result) > 0 ){
		while ($row = mysqli_fetch_assoc($result)) {
			$tokens[] = $row["token"];
		}
	}
	mysqli_close($con);
	$message = array("message" => "Maa chod duga teri Bhosdi k");
	$message_status = send_notification($tokens, $message);
    echo $message_status;
 ?>