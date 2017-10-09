<?php

    $lat = $_GET['lat'];
    $lng = $_GET['lng'];
    $key = "AIzaSyByr97zEEAtyo_3obJwaDSCyEyrVCuA8us";

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

    $url = "https://maps.googleapis.com/maps/api/geocode/json?latlng=$lat,$lng&key=$key";
    
    $response = curl_get_contents($url, true);

    $json = json_decode($response, true);

    if($json['status'] == "OK") {

        $pincode = $json['results'][0]['address_components'][6]['long_name'];

        echo json_encode(array('status'=>"success", 'result' => $pincode));

    } else {

        echo json_encode(array('status'=>"fail", 'result' => $json['status']));

    }

?>