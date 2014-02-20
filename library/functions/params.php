<?php

/**
 * This file is part of the miniCMS package.
 * (c) since 2005 BATMUNKH Moltov <contact@batmunkh.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * M\Config::get('GET') iin utguudaas avna
 *
 * @param string $key $_GET[$key] geh met avah tulhuur ug
 *
 * @return type Description
 */
function get($key) {

    $get = \Config::get('GET');
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

    $get_value = \Config::get('GET');
    $get_value[$param] = $value;

    \Config::set('GET', $get_value);
}

/**
 * $_POST parameter iig M\Config-t onooj ugnu
 *
 * @param string $param Ugugduh
 */
function set_post_parameter($param, $value) {

    $post_value = \Config::get('POST');
    $post_value[$param] = $value;

    \Config::set('POST', $post_value);
}

/**
 * M\Config::get('POST') iin utguudaas avna
 *
 * @param string $key $_POST[$key] geh met avah tulhuur ug
 *
 * @return type Description
 */
function post($key) {

    $post = \Config::get('POST');
    if (isset($post[$key])) {
        return $post[$key];
    } else {

        return false;
    }
}

function post_exists($key) {
    if (isset($_POST[$key])) {

        return true;
    }

    return false;
}
