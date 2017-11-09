<?php 

    $token = $_GET['token'];
    $message = $_GET['message'];

    echo $token;

	function send_notification ($tokens, $messages)
	{
		$url = 'https://fcm.googleapis.com/fcm/send';
		$fields = array(
			 'registration_ids' => $tokens,
			 'data' => $message
			);
		$headers = array(
			'Authorization:key = AAAAG_sg7i0:APA91bH0CbymI1JYgNwGAPv_ehnhnh_hFKViDXFHHZyv9kAtM2tLftJ__Eqc5LOu9Drpj4OR9qSceaRkMsTR_rVN7Lz_Ggru00cIBtwwBLGbe6p_qa5J5zWFaSIFdOxZcDqlfrapMqR1',
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



    $tokens = array();
    
    $tokens[] = $token;

    print_r $tokens;

    $messages = array("message" => $message);
    //send_notification($tokens, $message);
