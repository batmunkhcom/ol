<?php

$data = array('a' => 'b', 'c' => 'd');

$url = "http://www.ol.me/test/result";

$return_code = check_api_status($url, $data);
$response = '';
switch ($return_code) {
    case 200:
//        echo $return_code . '..';
        $response = curl_rest("PUT", $url, '', 'a=1&b=2&c[]=c1&c[]=c2 c3');

        break;
    case 301:
        echo $return_code . ' ';
        $response = curl_rest("PUT", $url, "", '{"name" : "test"}');
        break;
    default:
        break;
}
