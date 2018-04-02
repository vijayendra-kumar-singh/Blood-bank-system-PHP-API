<?php

$url = "https://smsapi.engineeringtgr.com/send/?Mobile=0123456789&Password=1234&Message=Hello&To=1234567890";


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

$data = curl_get_contents($url);

$r = explode("<div style", $data);

echo $r[0];

?>