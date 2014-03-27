<?php
function post($key='') {

    if ($key=='') {
        return $_POST;
    } else {

        return $_POST[$key];
    }
}

function files($key){
    if ($key=='') {
        return $_FILES;
    } else {

        return $_FILES[$key];
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