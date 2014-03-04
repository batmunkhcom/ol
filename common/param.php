<?php

/**
 * M\Config::get('GET') iin utguudaas avna
 *
 * @param string $key $_GET[$key] geh met avah tulhuur ug
 *
 * @return type Description
 */
function get($key) {

    if (isset($get[$key])) {
        return $get[$key];
    } else {

        return false;
    }
}

/**
 * $_GET parameter iig M\Config-t onooj ugnu
 *
 * @param string $param Ugugduh
 */
function set_get_parameter($param, $value) {

    $get_value = \M\Config::get('GET');
    $get_value[$param] = $value;

    \M\Config::set('GET', $get_value);
}

/**
 * $_POST parameter iig M\Config-t onooj ugnu
 *
 * @param string $param Ugugduh
 */
function set_post_parameter($param, $value) {

    $post_value = \M\Config::get('POST');
    $post_value[$param] = $value;

    \M\Config::set('POST', $post_value);
}

/**
 * M\Config::get('POST') iin utguudaas avna
 *
 * @param string $key $_POST[$key] geh met avah tulhuur ug
 *
 * @return type Description
 */
function post($key='') {

    if ($key=='') {
        return $_POST;
    } else {

        return $_POST[$key];
    }
}

/**
 * M\Config::get('FILES') iin utguudaas avna
 *
 * @param string $key $_FILES[$key] geh met avah tulhuur ug
 * @param string $subkey $_FILES[$key][$subkey] geh met avah sub tulhuur ug
 *
 * @return type Description
 */
function files($key, $subkey) {

    $files = \M\Config::get('FILES');
    if (isset($files[$key][$subkey])) {
        return $files[$key][$subkey];
    } else {
        if (isset($files[$key])) {
            return $files[$key];
        }
        return false;
    }
}

function post_exists($key) {
    if (isset($_POST[$key])) {

        return true;
    }

    return false;
}

function get_exists($key) {
    if (isset($_GET[$key])) {

        return true;
    }

    return false;
}