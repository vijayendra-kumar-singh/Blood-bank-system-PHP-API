<?php

    $lat = $_GET['lat'];
    $lng = $_GET['lng'];
    $key = "AIzaSyBKQ5uEHd-IW1xyneZHyCYbWnuZmpfId_I";

    function curl_get_contents($url)
    {
      $ch = curl_init($url);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
      curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
      $data = curl_exec($ch);
      curl_close($ch);
      return $data;
    }

    $y = 'https://maps.googleapis.com/maps/api/place/nearbysearch/json?location='.$lat.','.$lng.'&radius=25000&keyword=bloodbank&key='.$key;

    $result = curl_get_contents($y);

    $json = json_decode($result, true);

    $data = array();

    for ($i=0; $i<sizeof($json['results']); $i++) {

        $value = $json['results'][$i];

        if($value['types'][0] == "health" || $value['types'][0] == "hospital"){

            $id = $value['place_id'];

            $open = "NA";

            if(isset($value['opening_hours']['open_now'])) {
                if ($value['opening_hours']['open_now'] == true){
                    $open = "Yes";
                } else if ($value['opening_hours']['open_now'] == false) {
                    $open = "No";
                }
            }

            $place_details = "https://maps.googleapis.com/maps/api/place/details/json?placeid=$id&key=$key";

            $place = curl_get_contents($place_details);

            $details = json_decode($place, true);

            $web = "NA";

            if( isset( $details['result']['website'])) {
                $web = $details['result']['website'];
            }

            $rate = "NA";

            if( isset( $details['result']['rating'])) {
                $rate = $details['result']['rating'];
            }

            $num = "NA";

            if( isset($details['result']['formatted_phone_number'])) {
                $num = $details['result']['formatted_phone_number'];
            }

            array_push($data,array(
                    "open" => $open,
                    "address" => $details['result']['formatted_address'],
                    "number" => $num,
                    "name" => $details['result']['name'],
                    "lat" => $details['result']['geometry']['location']['lat'],
                    "lng" => $details['result']['geometry']['location']['lng'],
                    "website" => $web,
                    "rating" => $rate
                ));
        }
    }

    if(sizeof($data) != 0){

        echo json_encode(array('status' => "success", 'result'=>$data, 'mylat'=>$lat, 'mylng'=>$lng));
    
    } else {
        echo json_encode(array('status' => "fail", 'result'=>"Sorry, no Blood Bank found near your location. Try using Search!"));
    }

?>
