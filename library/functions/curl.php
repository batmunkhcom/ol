<?php

/**
 * This file is part of the miniCMS package.
 * (c) since 2005 BATMUNKH Moltov <contact@batmunkh.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
function check_api_status($url, $fields) {
    $fields = (is_array($fields)) ? http_build_query($fields) : $fields;

    if ($ch = curl_init($url)) {
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Length: ' . strlen($fields)));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        curl_exec($ch);

        $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        curl_close($ch);

        return (int) $status;
    } else {
        return false;
    }
}

function curl_rest($method, $uri, $query = NULL, $json = NULL, $options = NULL) {

    // holbolt bhgui bol holboh
    if (!isset($curl_handle)) {
        $curl_handle = curl_init();
    }
    if (!isset($curl_option_defaults)) {
        $curl_option_defaults = array();
    }
//    echo "DB operation: $method $uri $query $json\n";
    // command beldeh
    $options = array(
        CURLOPT_URL => $uri . "?" . $query,
        CURLOPT_CUSTOMREQUEST => $method, // GET POST PUT PATCH DELETE HEAD OPTIONS
        CURLOPT_POSTFIELDS => $json,
        CURLOPT_RETURNTRANSFER, 1
    );
    curl_setopt_array($curl_handle, ($options + $curl_option_defaults));

    // send request and wait for responce
//    $response = curl_exec($curl_handle);
    $response = json_decode(curl_exec($curl_handle), true);
//    echo "Responce from DB: \n";
//    print_r($response);

    return $response;
}
